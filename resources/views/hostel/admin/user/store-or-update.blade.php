@extends('layouts.app')
@section('title',$siteTitle)
@push('styles')

@endpush

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card rounded-0">
                <div class="card-body">
                    <form method="POST" id="user_form" enctype="multipart/form-data">
                        @csrf
                        @isset($user)
                            <input type="hidden" name="update_id" value="{{ $user->id }}">
                        @endisset
                        <x-input label="Name" name="name" required="required" value="{{ $user->name ?? '' }}" />
                        <x-input type="email" label="Email" name="email" required="required" value="{{ $user->email ?? '' }}" />
                        <x-input type="password" label="Password" name="password" required="required" />
                        <x-input type="password" label="Confirm Password" name="password_confirmation" required="required" />
                        <x-select label="Gender" name="gender" required="required">
                            <option value="">-- Select Option --</option>
                            @foreach (GENDER as $key=>$gender)
                            <option value="{{ $key }}" @isset($user) {{ $key == $user->gender ? 'selected' : '' }} @endisset>{{ $gender }}</option>
                            @endforeach
                        </x-select>
                        <x-input type="file" label="Image" name="image" />
                        <input type="hidden" name="old_image" value="{{ $user->image ?? '' }}">
                    </form>
                    <x-button parentClass="mt-3 text-end" class="btn-success" id="save-btn" label="Save"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection

@push('scripts')
    <script>
        $(document).on('click', '#save-btn', function(){
            var form = document.getElementById('user_form');
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('app.hostel-admin.users.store-or-update') }}",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#save-btn span').addClass('spinner-border spinner-border-sm text-light');
                },
                complete: function(){
                    $('#save-btn span').removeClass('spinner-border spinner-border-sm text-light');
                },
                success: function (data) {
                    $('#user_form').find('.is-invalid').removeClass('is-invalid');
                    $('#user_form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#user_form #' + key).addClass('is-invalid');
                            $('#user_form #' + key).parent().append(
                                '<small class="error d-block text-left text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            setInterval(() => {
                                window.location.href = "{{ route('app.hostel-admin.users.index') }}";
                            }, 600);
                        }
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });

        @isset($user)
        $(document).ready(function(){
            $('label[for="password"]').removeClass('required');
            $('label[for="password_confirmation"]').removeClass('required');
        });
        @endisset
    </script>
@endpush
