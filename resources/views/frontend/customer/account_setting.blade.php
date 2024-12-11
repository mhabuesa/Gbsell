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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Account Settings</li>
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
                                                            <form action="{{route('account.update', ['shopUrl' => $shop->url])}}" method="post" >
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{Auth::guard('customer')->user()->name}}" required>
                                                                    @error('name')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="{{Auth::guard('customer')->user()->email}}" required>
                                                                    @error('email')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone">Phone</label>
                                                                    <input type="phone" class="form-control" id="phone" name="phone" value="{{Auth::guard('customer')->user()->phone}}" required>
                                                                    @error('phone')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="address">Address</label>
                                                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{Auth::guard('customer')->user()->address}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password</label>
                                                                    <input type="password" class="form-control" id="password" name="password" value="" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </form>
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

