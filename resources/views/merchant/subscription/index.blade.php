@push('title')
    <title>Subscription | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">


    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/flatpickr/flatpickr.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
    <style>
        .dt-length,
        .dt-info {
            display: none;
        }

        .requirment {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
            background: blue;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px !important;

        }
    </style>
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Subscription Plan</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('subscription') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 m-auto mb-5">
                            <div class="block block-rounded border border-primary">
                                <div class="block-content block-content-full">
                                    <div class="py-2 text-center">
                                        @if ($expiry_date < date('Y-m-d'))
                                            {{-- Subscription expired --}}
                                            <h1 class="h3 fw-bold mb-1 text-danger">
                                                You are not subscribed to any plan.
                                            </h1>
                                            <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                                                Subscribe to unlock everything!
                                            </h2>
                                        @elseif ($remaining_days <= 15)
                                            {{-- Subscription expiring soon --}}
                                            <h1 class="h3 fs-3 fw-bold mb-1 text-warning">
                                                Subscription Ending Soon!
                                            </h1>
                                            <h2 class="fs-lg lh-base fw-medium mb-0">
                                                Your subscription will expire in <strong>{{ $remaining_days }}</strong>
                                                day{{ $remaining_days > 1 ? 's' : '' }}.
                                            </h2>
                                            <h2 class="fs-sm lh-base fw-medium mb-0">
                                                Renew now to continue enjoying all features without interruption!
                                            </h2>
                                        @else
                                            {{-- Subscription active --}}
                                            <h1 class="h3 fw-bold mb-1 text-success">
                                                Subscription Active!
                                            </h1>
                                            <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                                                Thank you for subscribing! You now have access to all features.
                                            </h2>
                                        @endif
                                    </div>
                                    {{-- Subscription expiry date --}}
                                    <div class="py-2 text-center">
                                        <h2 class="fs-base lh-base fw-medium mb-0">
                                            Your Subscription will expire on :
                                            <strong class="{{ $expiry_date < date('Y-m-d') ? 'text-danger' : 'text-success' }}">
                                                {{ $expiry_date }}
                                            </strong>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 m-auto">
                            <div class="row items-push">
                                <div class="col-md-10 m-auto">
                                    <p class="fs-lg fw-bold text-center">"Unlock All Features with Our Subscription
                                        Plans!"</p>
                                    <p class=" text-center">
                                        By subscribing to any of our plans, you'll gain complete access to all features
                                        without any restrictions. We believe in providing full value to our subscribers,
                                        ensuring that no features are locked or hidden. Choose the plan that suits your
                                        needs and enjoy an unrestricted experience!
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-block">
                                        <input type="radio" class="form-check-input" id="example-radio-block1"
                                            name="subscription" value="1" required>
                                        <label class="form-check-label" for="example-radio-block1">
                                            <span class="d-block fw-normal text-center my-3">
                                                <span class="fs-4 fw-semibold">Monthly</span>
                                                <span
                                                    class="d-block fs-5 fw-light py-3 m-3 bg-body-light rounded"><small>BDT</small>
                                                    <strong>500</strong> </span>
                                                <span class="d-block mb-2 fs-sm">"Subscribe to this plan and enjoy full
                                                    access
                                                    for<strong> 1 Month!</strong>"</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-block">
                                        <input type="radio" class="form-check-input" id="example-radio-block2"
                                            name="subscription" value="2" required>
                                        <label class="form-check-label" for="example-radio-block2">
                                            <span class="d-block fw-normal text-center my-3">
                                                <span class="fs-4 fw-semibold">Half-yearly</span>
                                                <span
                                                    class="d-block fs-5 fw-light py-3 m-3 bg-body-light rounded"><small>BDT</small>
                                                    <strong>3000</strong> </span>
                                                <span class="d-block mb-2 fs-sm">"Subscribe to this plan and enjoy full
                                                    access
                                                    for<strong> 6 Months!</strong>"</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-block">
                                        <input type="radio" class="form-check-input" id="example-radio-block3"
                                            name="subscription" value="3" required checked>
                                        <label class="form-check-label" for="example-radio-block3">
                                            <span class="fw-semibold requirment">Popular</span>
                                            <span class="d-block fw-normal text-center my-3">
                                                <span class="fs-4 fw-semibold">Yearly</span>
                                                <span
                                                    class="d-block fs-5 fw-light py-3 m-3 bg-body-light rounded"><small>BDT</small>
                                                    <strong>5000</strong> </span>
                                                <span class="d-block mb-2 fs-sm">"Subscribe to this plan and enjoy full
                                                    access
                                                    for<strong> 1 Year!</strong>"</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 m-auto">
                            <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets') }}/js/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/be_tables_datatables.min.js"></script>
    {{-- Date Picker --}}
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script>
        One.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);
    </script>
@endpush
