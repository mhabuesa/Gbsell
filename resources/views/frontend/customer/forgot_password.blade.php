@extends('layouts.frontend')
@push('style')
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                Verification</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h3 class="text-center">Forget Password </h3>
            </div>
            <div class="my-4 my-xl-8">
                <div class="row">
                    <div class="col-md-5 mb-8 mb-md-0 m-auto">
                        <form action="{{ route('forgot.otp', ['shopUrl' => $shop->url]) }}" class="js-validate" novalidate="novalidate" method="POST">
                            @csrf
                            <!-- Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="phone">Phone Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="01712000000"
                                    aria-label="01712000000" required="" data-msg="Please enter your phone number."
                                    data-error-class="u-has-error" data-success-class="u-has-success" value="{{ old('phone') }}">

                                @error('phone')
                                    <span class="text-danger mx-3 text-capitalize">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Form Group -->

                            <!-- Button -->
                            <div class="mb-1">
                                <div class="mb-3 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Send OTP</button>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection

@push('script')
    <script>
        // Initialize the countdown time (5 minutes in seconds)
        let countdownSeconds = 5 * 60;
        const timerElement = document.getElementById("timer");
        const resendLink = document.getElementById("resendOtpLink");

        function updateTimer() {
            // Calculate minutes and seconds
            const minutes = Math.floor(countdownSeconds / 60);
            const seconds = countdownSeconds % 60;

            // Update the timer display
            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (countdownSeconds > 0) {
                countdownSeconds--;
            } else {
                // Enable the Resend OTP link
                resendLink.classList.remove("text-mute", "disabled");
                resendLink.classList.add("text-blue");
                resendLink.style.pointerEvents = "auto"; // Enable link
                timerElement.textContent = "00:00";
                clearInterval(timerInterval); // Stop the timer
            }
        }

        // Disable link during countdown
        resendLink.style.pointerEvents = "none"; // Ensure link is disabled initially

        // Start the timer and update every second
        const timerInterval = setInterval(updateTimer, 1000);
    </script>
@endpush
