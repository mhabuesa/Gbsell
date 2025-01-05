@push('title')
    <title>Shop Info | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('layouts.backend')
@section('content')
    <div class="content mt-5">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Shop Info Update</h3>
            </div>
            <div class="block-content">
                <div class="row d-flex justify-content-center">
                    <div class="col-6 col-lg-3">
                        <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                            <div class="block-content block-content-full">
                                <div class="fs-2 fw-semibold text-dark">
                                    @if ($shop->logo == null)
                                        <img src="{{ asset('assets') }}/media/photos/img.png" width="100" alt="">
                                    @else
                                        <img src="{{ asset($shop->logo) }}" width="200" alt="Logo">
                                    @endif
                                </div>
                            </div>
                            <div class="block-content py-2 bg-body-light">
                                <p class="fw-medium fs-sm text-muted mb-0">
                                    Shop Logo
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-10">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop Name</th>
                                        <td>{{ $shop->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop Phone</th>
                                        <td>{{ $shop->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop Email</th>
                                        <td>{{ $shop->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop City</th>
                                        <td>{{ $shop->city }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop Address</th>
                                        <td>{{ $shop->address }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Total Order</th>
                                        <td>{{ $shop->orders->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Total Amount</th>
                                        <td>{{ $shop->orders->sum('total') }}/=</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop Created At</th>
                                        <td>{{ $shop->created_at->format('d M, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold fs-sm">Shop Expired On</th>
                                        <td>{{ \Carbon\Carbon::parse($shop->expiry_date)->format('d M, Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
