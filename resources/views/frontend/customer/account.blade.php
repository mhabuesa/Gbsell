@extends('layouts.frontend')
@section('content')
    <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home', ['shopUrl' => $shop->url])}}">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Account</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->


        <div class="bg-gray-7 pt-6 pb-3 mb-6">
            <div class="container">
                <div class="mb-8">
                    @include('frontend.customer.sidebar')
                    <!-- Tab Content -->
                    <div class="card borders-radius-17">
                        <div class="p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                            <div class="card-body">
                                <div class="tab-content" id="Jpills-tabContent">
                                    <div class="tab-pane fade active show" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="position-relative">
                                            <div class="border-bottom border-color-1 mb-2">
                                                <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">Account</h3>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                                    <div class="row">
                                                        <div class="col-4 col-lg-2">
                                                            <div class="mb-2 border border-color-1 rounded {{Route::is('account') ? 'bg-primary': ''}}">
                                                                <a href="{{route('account', ['shopUrl' => $shop->url])}}" class="text-dark">
                                                                    <h3 class="section-title section-title__full mb-0 p-1 font-size-18">Account</h3>
                                                                </a>
                                                            </div>
                                                            <div class="mb-2 border border-color-1 rounded {{Route::is('account.setting') ? 'bg-primary': ''}}">
                                                                <a href="{{route('account.setting', ['shopUrl' => $shop->url])}}" class="text-dark">
                                                                    <h3 class="section-title section-title__full mb-0 p-1 font-size-18">Account Settings</h3>
                                                                </a>
                                                            </div>
                                                            <div class="mb-2 border border-color-1 rounded bg-danger d-inline-block">
                                                                <a href="{{route('customer.logout', ['shopUrl' => $shop->url])}}" class="text-light">
                                                                    <h3 class="mb-0 p-1 font-size-14"><i class="fas fa-sign-out-alt mx-1 "></i><span class="mr-1">Logout</span></h3>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 col-lg-6  m-auto">
                                                            <div class="form-group">
                                                                <h4>Account Information</h4>
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Name :</th>
                                                                        <td>{{Auth::guard('customer')->user()->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Phone :</th>
                                                                        <td>{{Auth::guard('customer')->user()->phone}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email :</th>
                                                                        <td>{{Auth::guard('customer')->user()->email}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Address :</th>
                                                                        <td>{{Auth::guard('customer')->user()->address}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pending Order :</th>
                                                                        <td>{{$pending_order}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Complated Order :</th>
                                                                        <td>{{$completed_order}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Cancelled Order :</th>
                                                                        <td>{{$cancelled_order}}</td>
                                                                    </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')

@endpush

