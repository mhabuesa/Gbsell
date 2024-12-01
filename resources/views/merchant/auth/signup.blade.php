@push('title')
    <title>Signup | GBSell - eCommerce Solution </title>
@endpush
@extends('merchant.layout.auth')
@section('content')

<main id="main-container">
    <div class="bg-primary-dark"
        style="background-image: url('{{ asset('assets') }}/media/photos/photo28@2x.jpg');">
        <div class="row g-0 bg-primary-dark-op">
            <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <a class="link-fx fw-semibold fs-2 text-white" href="{{ route('index') }}">
                            GBSell
                        </a>
                        <p class="text-white-75 me-xl-8 mt-2">
                            Creating a new account is completely free. Get started with few clicks to manage and
                            feel free to upgrade as your business grow.
                        </p>
                    </div>
                </div>
                <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                    <p class="fw-medium text-white-50 mb-0">
                        <strong>GBSell</strong> &copy; <span data-toggle="year-copy"></span>
                    </p>
                </div>
            </div>
            <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light">
                <div class="p-3 w-100 d-lg-none text-center">
                    <a class="link-fx fw-semibold fs-3 text-dark" href="{{ route('index') }}">
                        GBSell
                    </a>
                </div>
                <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <div class="text-center mb-5">
                            <p class="mb-3">
                                <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                            </p>
                            <h1 class="fw-bold mb-2">
                                Create Account
                            </h1>
                            <p class="fw-medium text-muted">
                                Get your access today in one easy step
                            </p>
                        </div>
                        <div class="row g-0 justify-content-center">
                            <div class="col-sm-8 col-xl-4">
                                <form class="js-validation-signup" action="{{ route('signup') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="text"
                                            class="form-control form-control-lg form-control-alt py-3"
                                            id="name" name="name" placeholder="Your Name">
                                        @error('name')
                                            <small class="text-danger px-2">Please enter your name</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="email"
                                            class="form-control form-control-lg form-control-alt py-3"
                                            id="email" name="email" placeholder="Email">
                                        @error('email')
                                            <small class="text-danger px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="password"
                                            class="form-control form-control-lg form-control-alt py-3"
                                            id="password" name="password" placeholder="Password">
                                        @error('password')
                                            <small class="text-danger px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="password"
                                            class="form-control form-control-lg form-control-alt py-3"
                                            id="password-confirm" name="password_confirmation"
                                            placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <small class="text-danger px-2">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-md-flex align-items-md-center justify-content-md-between">
                                            <div class="form-check">
                                                <label class="form-check-label fs-sm">Already have an
                                                    account?</label>
                                                <a class="fs-sm fw-medium"
                                                    href="{{ route('signin.view') }}">Sign In</a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-alt-success">
                                            <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Sign Up
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
                        <strong>GBSell</strong> &copy; <span data-toggle="year-copy"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
