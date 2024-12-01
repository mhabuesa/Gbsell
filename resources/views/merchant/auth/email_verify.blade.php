<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>

<body>
    <div id="page-container">
        <main id="main-container">
            <div class="hero-static d-flex align-items-center">
                <div class="content">
                    <div class="row justify-content-center push">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <div class="block block-rounded mb-0">
                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                        <h1 class="h2 mb-1">OTP for your Account</h1>
                                        <p class="mb-2 fw-medium text-muted">
                                            Please use the mentioned OTP to login
                                        </p>
                                        <p class="fw-medium text-muted d-block">
                                            <strong>Your email is:</strong> <span
                                                class="text-primary">{{ $merchant->email }}</span>
                                        </p>
                                        <p class="fw-medium text-muted d-block">
                                            <strong>Your OTP is:</strong> <span
                                                class="text-primary">{{ $merchant->otp }}</span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
