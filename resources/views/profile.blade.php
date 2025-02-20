@extends('layouts.app')
@section('title','Profile')

@push('styles')
<style>

</style>
@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link rounded-0 border-0 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link rounded-0 border-0" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password" aria-selected="false">Password</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <form id="profile_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0 shadow-none" value="{{ $user->name }}">
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0 shadow-none" value="{{ $user->email }}">
                                </div>
                                <div class="mb-2">
                                    <label for="gender" class="required">Gender</label>
                                    <select name="gender" id="gender" class="form-control form-control-sm rounded-0 shadow-none">
                                        <option value="">Select Gender</option>
                                        @foreach (GENDER as $key=>$value)
                                        <option value="{{ $key }}" {{ $user->gender == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="image">image</label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0 shadow-none">
                                    <input type="hidden" name="old_image" value="{{ $user->image ?? '' }}">
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-sm btn-primary" id="save_btn" onclick="save_form('profile_form')"><span></span> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <form id="password_form" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for="old_password" class="required">Old Password</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control form-control-sm rounded-0 shadow-none">
                                </div>
                                <div class="mb-2">
                                    <label for="new_password" class="required">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control form-control-sm rounded-0 shadow-none">
                                </div>
                                <div class="mb-2">
                                    <label for="confirm_password" class="required">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm rounded-0 shadow-none">
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-sm btn-primary" id="save_btn" onclick="save_form('password_form')"><span></span> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection

@push('scripts')
    <script>
        function save_form(form_id){
            var form = document.getElementById(form_id);
            var formData = new FormData(form);
            var url;
            if(form_id == 'profile_form'){
                url = "{{ route('app.profile.update') }}";
            }else if(form_id == 'password_form'){
                url = "{{ route('app.password.update') }}";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#'+form_id+' #save_btn span').addClass('spinner-border spinner-border-sm text-primary');
                },
                complete: function(){
                    $('#'+form_id+' #save_btn span').removeClass('spinner-border spinner-border-sm text-primary');
                },
                success: function (data) {
                    $('#'+form_id).find('.is-invalid').removeClass('is-invalid');
                    $('#'+form_id).find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#'+form_id+' #' + key).addClass('is-invalid');
                            $('#'+form_id+' #' + key).parent().append(
                                '<small class="error text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            window.location.reload();
                        }
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        }
    </script>
@endpush
