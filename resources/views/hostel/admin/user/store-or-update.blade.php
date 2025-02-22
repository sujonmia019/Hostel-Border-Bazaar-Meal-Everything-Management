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
                    <form method="POST" id="store_or_update_form" enctype="multipart/form-data">
                        @csrf
                        <x-input label="Name" name="name" required="required" value="{{ $user->name ?? '' }}" />
                        <x-input label="Username" name="username" required="required" value="{{ $user->username ?? '' }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection

@push('scripts')

@endpush
