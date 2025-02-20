@extends('auth.app')
@push('styles')
@section('title','Login')
<style>
    .register-box span {
        font-weight: 500;
        font-size: 12px;
    }
    .register-box p {
        font-size: 14px;
        font-weight: 400;
    }
    .register-box p a {
        text-decoration: underline;
        color: #1b5fdf;
    }
    .register-box p a:hover {
        text-decoration: none;
    }
</style>
@endpush
@section('content')
<div class="container vh-100">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col-md-5 col-lg-4">
            <div class="card rounded-0">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="82" height="40" fill="none" viewBox="0 0 82 40"><path fill="#FFD43D" d="M73.365 19.71c0 2.904-2.241 5.31-5.27 5.31-3.03 0-5.228-2.406-5.228-5.31 0-2.905 2.199-5.312 5.228-5.312s5.27 2.407 5.27 5.311Z"></path><path fill="#FF0C81" d="M48.764 19.544c0 2.946-2.323 5.145-5.27 5.145-2.904 0-5.227-2.2-5.227-5.145 0-2.947 2.323-5.104 5.228-5.104 2.946 0 5.27 2.158 5.27 5.104Z"></path><path fill="#11EEFC" d="M20.074 25.02c3.029 0 5.27-2.406 5.27-5.31 0-2.905-2.241-5.312-5.27-5.312-3.03 0-5.228 2.407-5.228 5.311 0 2.905 2.199 5.312 5.228 5.312Z"></path><path fill="#171A26" d="M68.095 30.54c-6.307 0-11.12-4.897-11.12-10.872 0-5.934 4.855-10.83 11.12-10.83 6.349 0 11.162 4.938 11.162 10.83 0 5.975-4.855 10.871-11.162 10.871Zm0-5.52c3.03 0 5.27-2.406 5.27-5.31 0-2.905-2.24-5.312-5.27-5.312-3.029 0-5.228 2.407-5.228 5.311 0 2.905 2.199 5.312 5.228 5.312ZM43.08 40c-4.813 0-8.506-2.116-10.373-5.934l4.896-2.655c.913 1.784 2.614 3.195 5.394 3.195 3.486 0 5.85-2.448 5.85-6.473v-.374c-1.12 1.411-3.111 2.49-6.016 2.49-5.768 0-10.373-4.481-10.373-10.581 0-5.934 4.813-10.788 11.12-10.788 6.431 0 11.162 4.605 11.162 10.788v8.299C54.74 35.27 49.76 40 43.08 40Zm.415-15.311c2.946 0 5.27-2.2 5.27-5.145 0-2.947-2.324-5.104-5.27-5.104-2.905 0-5.228 2.158-5.228 5.104s2.323 5.145 5.228 5.145ZM20.074 30.54c-6.307 0-11.12-4.897-11.12-10.872 0-5.934 4.854-10.83 11.12-10.83 6.348 0 11.162 4.938 11.162 10.83 0 5.975-4.855 10.871-11.162 10.871Zm0-5.52c3.029 0 5.27-2.406 5.27-5.31 0-2.905-2.241-5.312-5.27-5.312-3.03 0-5.228 2.407-5.228 5.311 0 2.905 2.199 5.312 5.228 5.312ZM0 0h5.892v30H0V0ZM82 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path></svg>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-12">
                                <input type="email" name="email" required class="form-control form-control-sm rounded-0 shadow-none" id="email" placeholder="Email">
                                @error('email')
                                    <small class="d-block text-danger text-start">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input type="password" name="password" required class="form-control form-control-sm rounded-0 shadow-none" id="password" placeholder="Password">
                                @error('password')
                                    <small class="d-block text-danger text-start">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="register-box mt-2 text-center">
                        <span class="d-block">OR</span>
                        <p class="mb-0">You don't have an account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
