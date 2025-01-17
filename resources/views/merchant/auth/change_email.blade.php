@push('title')
    <title>Change Email | GBSell - eCommerce Solution </title>
@endpush
@extends('merchant.layout.auth')
@section('content')

<main id="main-container">
    <div class="bg-image" style="background-image: url('{{asset('assets')}}/media/photos/photo28@2x.jpg');">
        <div class="row g-0 bg-primary-dark-op">
            <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <a class="link-fx fw-semibold fs-2 text-white" href="{{route('index')}}">
                            GBSELL
                        </a>
                        <p class="text-white-75 me-xl-8 mt-2">
                            Welcome to your amazing app. Feel free to login and start managing your Shop and
                            Customers.
                        </p>
                    </div>
                </div>
                <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                    <p class="fw-medium text-white-50 mb-0">
                        <strong>GBSELL</strong> &copy; <span data-toggle="year-copy"></span>
                    </p>
                </div>
            </div>
            <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light">
                <div class="p-3 w-100 d-lg-none text-center">
                    <a class="link-fx fw-semibold fs-3 text-dark" href="index.html">
                        OneUI
                    </a>
                </div>
                <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <div class="text-center mb-5">
                            <p class="mb-3">
                                <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                            </p>
                            <h1 class="fw-bold mb-2">
                                Change Your Email
                            </h1>
                            <p class="fw-medium text-muted">
                                Update your email address to keep your account secure.
                            </p>
                        </div>
                        <div class="row g-0 justify-content-center">
                            <div class="col-sm-8 col-xl-4">
                                <form class="js-validation-signin" action="{{ route('changed.email', $id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg form-control-alt py-3" name="email" placeholder="Email">
                                        @error('email')
                                            <small class="text-danger px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <button type="submit" class="btn btn-lg btn-alt-primary">
                                            <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                    <p class="fw-medium text-black-50 py-2 mb-0">
                        <strong>GBSell 5.9</strong> &copy; <span data-toggle="year-copy"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
