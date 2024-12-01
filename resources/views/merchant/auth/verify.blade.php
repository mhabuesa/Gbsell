@push('title')
    <title>Email Verification | GBSell - eCommerce Solution </title>
@endpush
@extends('merchant.layout.auth')
@section('content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('{{ asset('assets') }}/media/photos/photo28@2x.jpg');">
            <div class="row g-0 bg-primary-dark-op">
                <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                    <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                        <div class="w-100">
                            <a class="link-fx fw-semibold fs-2 text-white" href="index.html">
                                OneUI
                            </a>
                            <p class="text-white-75 me-xl-8 mt-2">
                                Welcome to your amazing app. Feel free to login and start managing your projects and
                                clients.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                        <p class="fw-medium text-white-50 mb-0">
                            <strong>GB Sell</strong> &copy; <span data-toggle="year-copy"></span>
                        </p>
                    </div>
                </div>
                <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light text-center">
                    <div class="p-3 w-100 d-lg-none">
                        <a class="link-fx fw-semibold fs-3 text-dark" href="index.html">
                            OneUI
                        </a>
                    </div>
                    <div class="p-4 w-100 flex-grow-1 d-flex align-items-center justify-content-center">
                        <div class="col-md-8 col-xl-6">
                            <div class="mb-5">
                                <p class="mb-3">
                                    <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                                </p>
                                <h1 class="fw-bold mb-2">
                                    Two Factor Authentication
                                </h1>
                                <p class="fw-medium text-muted">
                                    Please confirm your account by entering the authorization code sent to your Email
                                    {{ $email }}.
                                </p>
                            </div>
                            <form id="form-2fa" action="{{ route('merchant.verified', $email) }}" method="POST">
                                @csrf
                                <div class="d-flex items-center justify-content-center gap-1 gap-sm-2 mb-4">
                                    <input type="text"
                                        class="form-control form-control-alt form-control-lg text-center px-0"
                                        id="num1" name="num1" maxlength="1" style="width: 38px;"
                                        value="{{ old('num1') }}">
                                    <input type="text"
                                        class="form-control form-control-alt form-control-lg text-center px-0"
                                        id="num2" name="num2" maxlength="1" style="width: 38px;"
                                        value="{{ old('num2') }}">
                                    <input type="text"
                                        class="form-control form-control-alt form-control-lg text-center px-0"
                                        id="num3" name="num3" maxlength="1" style="width: 38px;"
                                        value="{{ old('num3') }}">
                                    <span class="d-flex align-items-center">-</span>
                                    <input type="text"
                                        class="form-control form-control-alt form-control-lg text-center px-0"
                                        id="num4" name="num4" maxlength="1" style="width: 38px;"
                                        value="{{ old('num4') }}">
                                    <input type="text"
                                        class="form-control form-control-alt form-control-lg text-center px-0"
                                        id="num5" name="num5" maxlength="1" style="width: 38px;"
                                        value="{{ old('num5') }}">
                                    <input type="text"
                                        class="form-control form-control-alt form-control-lg text-center px-0"
                                        id="num6" name="num6" maxlength="1" style="width: 38px;"
                                        value="{{ old('num6') }}">
                                </div>
                                <div class="mb-4">
                                    @if (
                                        $errors->has('num1') ||
                                            $errors->has('num2') ||
                                            $errors->has('num3') ||
                                            $errors->has('num4') ||
                                            $errors->has('num5') ||
                                            $errors->has('num6'))
                                        <small class="alert alert-danger px-2">Please enter your 6-digit code</small>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    @if (session('error'))
                                        <small class="alert alert-danger px-2">{{ session('error') }}</small>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-lg btn-alt-primary">
                                        Submit
                                        <i class="fa fa-fw fa-arrow-right ms-1 opacity-50"></i>
                                    </button>
                                </div>
                                <p class="fs-sm pt-4 text-muted mb-0">
                                    Change your Email? <a href="{{ route('change.email.view', $email) }}">Set a new one</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <div
                        class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                        <p class="fw-medium text-black-50 py-2 mb-0">
                            <strong>GB Sell</strong> &copy; <span data-toggle="year-copy"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script src="{{asset('assets')}}/js/pages/op_auth_two_factor.min.js"></script>
@endpush
