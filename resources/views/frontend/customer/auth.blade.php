@extends('layouts.frontend')
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                    href="{{ route('home', ['shopUrl' => $shop->url]) }}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Login or
                                Register</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h3 class="text-center">Start Your Journey with Us</h3>
            </div>
            <div class="my-4 my-xl-8">
                <div class="row">
                    <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-4 d-flex justify-content-between">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Login</h3>
                        </div>
                        <p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>
                        <!-- End Title -->
                        <form action="{{ route('customer.logedin', $shop->url) }}" class="js-validate"
                            novalidate="novalidate" method="POST">
                            @csrf
                            <!-- Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="login_phone">Phone Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="phone" class="form-control" name="login_phone" id="login_phone"
                                    placeholder="01712000000" aria-label="01712000000" required=""
                                    data-msg="Please enter a valid phone number." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                    @error('login_phone')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="login_password">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="login_password" id="login_password"
                                    placeholder="Password" aria-label="Password" required=""
                                    data-msg="Your password is invalid. Please try again." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                    @error('login_password')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Form Group -->

                            <!-- Button -->
                            <div class="mb-1">
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                                    <a class="text-blue" href="{{ route('forgot.password', $shop->url) }}">Lost your password?</a>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                    </div>
                    <div class="col-md-1 d-none d-md-block">
                        <div class="flex-content-center h-100">
                            <div class="width-1 bg-1 h-100"></div>
                            <div
                                class="width-50 height-50 border border-color-1 rounded-circle flex-content-center font-italic bg-white position-absolute">
                                or</div>
                        </div>
                    </div>
                    <div class="col-md-5 ml-md-auto ml-xl-0 mr-xl-auto">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-4">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Register</h3>
                        </div>
                        <p class="text-gray-90 mb-4">Create new account today to reap the benefits of a personalized
                            shopping experience.</p>
                        <!-- End Title -->
                        <!-- Form Group -->
                        <form class="js-validate" novalidate="novalidate"
                            action="{{ route('customer.register', $shop->url) }}" method="POST">
                            @csrf
                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="name">Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter your Name" aria-label="Enter your Name" required=""
                                    data-msg="Please enter your Name." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                            </div>
                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="phone">Phone
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="phone" class="form-control" name="phone" id="phone"
                                    placeholder="Phone number" aria-label="Phone number" required=""
                                    data-msg="Please enter a valid Phone Number." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                @error('phone')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="email">Email address
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email address" aria-label="Email address" required=""
                                    data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                @error('email')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="password">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password" aria-label="Password" required=""
                                    data-msg="Please enter your password." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                @error('password')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="password_confirmation">Confirm Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirm Password"
                                    aria-label="Confirm Password" required=""
                                    data-msg="Please enter your Confirm password." data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                @error('password_confirmation')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="js-form-message mb-3">
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="showPassword"
                                        name="rememberCheckbox" data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                    <label class="custom-control-label form-label" for="showPassword">
                                        Show password
                                    </label>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <!-- Button -->
                            <div class="mb-6">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Register</button>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                        <h3 class="font-size-18 mb-3">Sign up today and you will be able to :</h3>
                        <ul class="list-group list-group-borderless">
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i>
                                Speed your way through checkout</li>
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i>
                                Apply coupon codes to best discount</li>
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i>
                                Track your orders easily</li>
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i>
                                Keep a record of all your purchases</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection

@push('script')
<script>
    document.getElementById('showPassword').addEventListener('change', function () {
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');

        if (this.checked) {
            passwordField.type = 'text';
            confirmPasswordField.type = 'text';
        } else {
            passwordField.type = 'password';
            confirmPasswordField.type = 'password';
        }
    });
</script>
@endpush
