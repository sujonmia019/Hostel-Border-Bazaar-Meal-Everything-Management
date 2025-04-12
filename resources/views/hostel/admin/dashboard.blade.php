@extends('layouts.app')
@section('title',$siteTitle)

@push('styles')
<style>
    .scrollable-table {
        max-height: 302px;
        overflow-y: auto;
    }
</style>
@endpush

@section('content')
@can('border')
    @include('hostel.border.dashboard')
@endcan

@can('hostel-admin')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">

        </div>
    </div>
</div>
@endcan
@endSection

@push('scripts')

@endpush
