@push('title')
    <title>Product List | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
    <style>
        .dt-length,
        .dt-info {
            display: none;
        }
    </style>
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content content-boxed d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="block-content block-content-full text-center">
            <div class="fw-medium text-muted">
                <i class="fa-solid fa-lock fa-2x text-danger"></i>
                <h1 class="fs-5 fw-medium text-dark mt-3 mb-0">This Page Is Locked,</h1>
                <h4 class="fs-6 mt-1 fw-medium text-dark">Please <a href="{{ route('subscription.index') }}">Subscribe</a> To Unlock.</h4>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
