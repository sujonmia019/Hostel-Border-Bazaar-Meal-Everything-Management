@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
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
                    <form action="{{ route('app.hostel-admin.bills.store-or-update') }}" method="POST">
                        @csrf
                        <x-select name="type" label="User Type" required="required" onchange="selectType(this.value)">
                            @foreach (TYPE as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-select>
                        <x-select groupClass="d-none user_border" name="border_id" label="Border" required="required">
                            <option value="">-- Select Option --</option>
                            @foreach ($borders as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-select>
                        <x-select name="bill_status_id" label="Bill Type" required="required">
                            <option value="">-- Select Option --</option>
                            @forelse ($billStatus as $id=>$value)
                            <option value="{{ $id }}">{{ $value }}</option>
                            @empty

                            @endforelse
                        </x-select>
                        <x-input type="number" name="amount" label="Amount" required="required"/>
                        <x-input name="bill_month" label="Bill Month" required="required"/>
                        <x-button type="submit" label="Save" class="btn-primary"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
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
</script>
@endpush
