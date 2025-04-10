@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')
<link rel="stylesheet" href="{{ asset('/') }}css/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('/') }}flatpickr.style.css">
@endpush

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card rounded-0">
                <div class="card-header py-2 bg-white">
                    <h6 class="card-title mb-0">{{ $title }}</h6>
                </div>
                <div class="card-body">
                    <form method="POST" id="bill_form">
                        @csrf
                        @isset($edit)
                        <input type="hidden" name="update_id" id="update_id" value="{{ $edit->id }}">
                        @endisset
                        <x-select name="type" label="User Type" required="required" onchange="selectType(this.value)">
                            @foreach (TYPE as $key=>$value)
                            <option value="{{ $key }}" @isset($edit) {{ $edit->type == $key ? 'selected' : '' }} @endisset>{{ $value }}</option>
                            @endforeach
                        </x-select>
                        <x-select groupClass="d-none user_border" name="border_id" label="Border" required="required">
                            <option value="">-- Select Option --</option>
                            @foreach ($borders as $key=>$value)
                            <option value="{{ $key }}" @isset($edit) {{ $edit->border_id == $key ? 'selected' : '' }} @endisset>{{ $value }}</option>
                            @endforeach
                        </x-select>
                        <x-select name="bill_status_id" label="Bill Type" required="required">
                            <option value="">-- Select Option --</option>
                            @forelse ($billStatus as $id=>$value)
                            <option value="{{ $id }}" @isset($edit) {{ $edit->bill_status_id == $id ? 'selected' : '' }} @endisset>{{ $value }}</option>
                            @empty

                            @endforelse
                        </x-select>
                        <x-input type="number" name="amount" label="Amount" required="required" value="{{ round($edit->amount) ?? '' }}"/>
                        <x-textarea name="note" label="Note" value="{{ $edit->note ?? '' }}"></x-textarea>
                        <x-input name="bill_month" label="Bill Month" required="required" value="{{ dateFormat($edit->bill_month,'F Y') ?? date('F Y') }}"/>
                    </form>

                    <x-button label="Save" class="btn-primary" id="save_btn"/>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection

@push('scripts')
<script src="{{ asset('/') }}js/flatpickr.min.js"></script>
<script src="{{ asset('/') }}js/flatpickr.index.js"></script>
<script>
    flatpickr("#bill_month", {
        plugins: [new monthSelectPlugin({
            dateFormat: "F Y",
            altFormat: "F Y",
            theme: "light"
        })]
    });

    function selectType(type){
        if(type === 'all'){
            $('.user_border').addClass('d-none');
        }else{
            $('.user_border').removeClass('d-none');
        }
    }

    @if(isset($edit) && !empty($edit->border_id))
    selectType({{ $edit->border_id }});
    @endisset

    $(document).on('click','#save_btn',function(){
        var form = document.getElementById('bill_form');
        var formData = new FormData(form)
        $.ajax({
            url: "{{ route('app.hostel-admin.bills.store-or-update') }}",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                $('#save_btn span').addClass('spinner-border spinner-border-sm text-primary');
            },
            complete: function(){
                $('#save_btn span').removeClass('spinner-border spinner-border-sm text-primary');
            },
            success: function (data) {
                $('#bill_form').find('.is-invalid').removeClass('is-invalid');
                $('#bill_form').find('.error').remove();
                if (data.status == false) {
                    $.each(data.errors, function (key, value) {
                        $('#bill_form #' + key).addClass('is-invalid');
                        $('#bill_form #' + key).parent().append('<small class="error d-block text-left text-danger">' + value + '</small>');
                    });
                } else {
                    notification(data.status, data.message);
                    if (data.status == 'success') {
                        setInterval(() => {
                            window.location.href = "{{ route('app.hostel-admin.bills.index') }}";
                        }, 800);
                    }
                }
            },
            error: function (xhr, ajaxOption, thrownError) {
                console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
            }
        });
    });
</script>
@endpush
