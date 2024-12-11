@push('title')
    <title>Payment Gateway | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <style>
        .danger_inpit:checked {
            background-color: #00ff4c !important;
            border-color: #00ff22 !important;
        }
        .danger_inpit {
            background-color: #ff0000 !important;
            border-color: #ff0000 !important;
        }
    </style>
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Payment Gateway Setup</h3>
                </div>
                <div class="block-content">
                    <div class="col-lg-8 m-auto ">
                        <div class="row items-push">
                            <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" checked type="checkbox" id="cod_input" name="cod" onclick="return false;">
                                <label class="form-check-label" for="cod_input">
                                    <span class="d-flex align-items-center">
                                      <img class="img-avatar img-avatar48" src="http://127.0.0.1:8000/assets/media/photos/cod.png" alt="Cash on Delivery">
                                      <span class="ms-2">
                                        <span class="fw-bold">Cash on Delivery</span>
                                      </span>
                                    </span>
                                  </label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" {{ $ssl && $ssl->status == 1 ? 'checked' : '' }} type="checkbox" value="" id="ssl_input" name="ssl_input">
                                <label class="form-check-label" for="ssl_input">
                                  <span class="d-flex align-items-center">
                                    <img class="img-avatar img-avatar48" src="{{asset('assets')}}/media/photos/sslcommerz.png" alt="">
                                    <span class="ms-2">
                                      <span class="fw-bold">SSL Commerz</span>
                                    </span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            {{-- <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" {{ $bkash && $bkash->status == 1 ? 'checked' : '' }} type="checkbox" value="" id="bkash_input" name="bkash_input">
                                <label class="form-check-label" for="bkash_input">
                                  <span class="d-flex align-items-center">
                                    <img class="img-avatar img-avatar48" src="{{asset('assets')}}/media/photos/bkash.png" alt="">
                                    <span class="ms-2">
                                      <span class="fw-bold">Bkash Merchant</span>
                                    </span>
                                  </span>
                                </label>
                              </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div id="cod_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('payment.cod', $shop_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="cod">
                                    <div class="row">

                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Cash on Delivery</label>
                                            <small>Cash on Delivery is a mandatory payment method and must be used.</small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label class="form-label" for="note">Payment Process Note</label>
                                                <textarea class="form-control" id="note" name="note" rows="4" placeholder="Enter some nice note...">{{ $cod && $cod->note ? $cod->note : ''}}</textarea>
                                                    @error('note')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $cod ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ssl_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('payment.ssl', $shop_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="ssl">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Configure SSL Commerz</label>
                                            <small>To get online payment please configure SSL Commerz. Dont't have SSL Commerz account? <span class="text-primary text-decoration-underline fs-6"><a href="https://join.sslcommerz.com/" target="_blank">Apply Now</a></span></small>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="store_id">Store ID</label>
                                                <input type="text" class="form-control" id="store_id" name="store_id" value="{{ $ssl && $ssl->store_id ? $ssl->store_id : ''}}">
                                                @error('store_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="store_password">Store Password</label>
                                                <input type="text" class="form-control" id="store_password" name="store_password" value="{{ $ssl && $ssl->store_password ? $ssl->store_password : ''}}">
                                                    @error('store_password')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input" type="checkbox" {{ $ssl && $ssl->status == 1 ? 'checked' : '' }} id="status" name="status">
                                            <label class="form-check-label" for="status">Availability</label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input danger_inpit" type="checkbox" {{ $ssl && $ssl->sendbox_status == 1 ?  ' ': 'checked' }} id="status" name="sendbox_status">
                                            <label class="form-check-label" for="status">Live Credentials</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $ssl ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div id="bkash_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-5">
                            <div class="card-body">
                                <form action="{{ route('payment.bkash', $shop_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="bkash">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Configure Bkash Merchant</label>
                                            <small>To get online payment please configure Bkash Merchant. Dont't have Bkash Merchant account? <span class="text-primary text-decoration-underline fs-6"><a href="https://www.bkash.com/en/business/merchant" target="_blank">Apply Now</a></span></small>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="store_id">Store ID</label>
                                                <input type="text" class="form-control" id="store_id" name="store_id" value="{{ $bkash && $bkash->store_id ? $bkash->store_id : ''}}">
                                                @error('store_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="store_password">Store Password</label>
                                                <input type="text" class="form-control" id="store_password" name="store_password" value="{{ $bkash && $bkash->store_password ? $bkash->store_password : ''}}">
                                                    @error('store_password')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check form-switch form-check-inline">
                                                <input class="form-check-input" type="checkbox" {{ $bkash && $bkash->status == 1 ? 'checked' : '' }} id="status" name="status">
                                                <label class="form-check-label" for="status">Availability</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $bkash ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </main>
@endsection

@push('script')

    <script>

        $(document).ready(function() {
            if ($('#ssl_input').is(':checked')) {
                $('#ssl_field').show();
            } else {
                $('#ssl_field').hide();
            }

            $('#ssl_input').change(function() {
                if ($(this).is(':checked')) {
                    $('#ssl_field').slideDown();
                } else {
                    $('#ssl_field').slideUp();
                }
            });
        });


        // $(document).ready(function() {
        //     $('#bkash_field').hide();

        //     $('#bkash_input').change(function() {
        //         if ($(this).is(':checked')) {
        //             $('#bkash_field').slideDown();
        //         } else {
        //             $('#bkash_field').slideUp();
        //         }
        //     });
        // });


        $(document).ready(function() {
            if ($('#bkash_input').is(':checked')) {
                $('#bkash_field').show();
            } else {
                $('#bkash_field').hide();
            }

            $('#bkash_input').change(function() {
                if ($(this).is(':checked')) {
                    $('#bkash_field').slideDown();
                } else {
                    $('#bkash_field').slideUp();
                }
            });
        });
    </script>

@endpush

