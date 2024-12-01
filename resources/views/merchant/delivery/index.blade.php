@push('title')
    <title>Delivery System | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Delivery System Setup</h3>
                </div>
                <div class="block-content">
                    <div class="col-lg-8 m-auto ">
                        <div class="row items-push">
                            <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" {{ $redx && $redx->status == 1 ? 'checked' : '' }} type="checkbox" value="" id="redx_input" name="redx_input">
                                <label class="form-check-label" for="redx_input">
                                    <span class="d-flex align-items-center">
                                      <img class="img-avatar img-avatar48" src="http://127.0.0.1:8000/assets/media/photos/redx.png" alt="Redx Delivery">
                                      <span class="ms-2">
                                        <span class="fw-bold">Redx</span>
                                      </span>
                                    </span>
                                  </label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" {{ $steadfast && $steadfast->status == 1 ? 'checked' : '' }} type="checkbox" value="" id="steadfast_input" name="steadfast_input">
                                <label class="form-check-label" for="steadfast_input">
                                  <span class="d-flex align-items-center">
                                    <img class="img-avatar img-avatar48" src="{{asset('assets')}}/media/photos/steadfast.jpeg" alt="">
                                    <span class="ms-2">
                                      <span class="fw-bold">Steadfast</span>
                                    </span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" {{ $pathao && $pathao->status == 1 ? 'checked' : '' }} type="checkbox" value="" id="pathao_input" name="pathao_input">
                                <label class="form-check-label" for="pathao_input">
                                  <span class="d-flex align-items-center">
                                    <img class="img-avatar img-avatar48" src="{{asset('assets')}}/media/photos/pathao.png" alt="">
                                    <span class="ms-2">
                                      <span class="fw-bold">Pathao</span>
                                    </span>
                                  </span>
                                </label>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="redx_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('delivery.redx', $shop_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="redx">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Configure <strong>Redx</strong> Delivery</label>
                                            <small>To get easy delivery system,  please configure Redx Courier. Dont't have Redx Merchant account? <span class="text-primary text-decoration-underline fs-6"><a href="https://redx.com.bd/registration/" target="_blank">Apply Now</a></span></small>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="redx_app_secret">Merchant App Secret</label>
                                                <div class="password-container d-flex">
                                                    <input type="password" class="form-control password-input" id="redx_app_secret" name="app_secret" value="{{ $redx && $redx->app_secret ? $redx->app_secret : ''}}" placeholder="Merchant App Secret">
                                                    <i class="fa fa-eye-slash toggle-password" id="toggleRedxAppSecret"></i>
                                                </div>
                                                @error('app_secret')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input" type="checkbox" {{ $redx && $redx->status == 1 ? 'checked' : '' }} id="status" name="status">
                                            <label class="form-check-label" for="status">Availability</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $redx ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="steadfast_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('delivery.steadfast', $shop_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="steadfast">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Configure <strong>Steadfast</strong> Delivery</label>
                                            <small>To get easy delivery system,  please configure Steadfast Courier. Dont't have Steadfast Merchant account? <span class="text-primary text-decoration-underline fs-6"><a href="https://steadfast.com.bd/register" target="_blank">Apply Now</a></span></small>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="api_key">Merchant API Key</label>
                                                <input type="text" class="form-control" id="api_key" name="api_key" value="{{ $steadfast && $steadfast->api_key ? $steadfast->api_key : ''}}" placeholder="Merchant API Key">
                                                @error('api_key')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="steadfast_app_secret">Merchant App Secret</label>
                                                <div class="password-container d-flex">
                                                    <input type="password" class="form-control password-input" id="steadfast_app_secret" name="app_secret" value="{{ $steadfast && $steadfast->app_secret ? $steadfast->app_secret : ''}}" placeholder="Merchant App Secret">
                                                    <i class="fa fa-eye-slash toggle-password" id="toggleSteadfastAppSecret"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input" type="checkbox" {{ $steadfast && $steadfast->status == 1 ? 'checked' : '' }} id="status" name="status">
                                            <label class="form-check-label" for="status">Availability</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $steadfast ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pathao_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-5">
                            <div class="card-body">
                                <form action="{{ route('delivery.pathao', $shop_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="pathao">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Configure <strong>Pathao</strong> Delivery</label>
                                            <small>To get easy delivery system,  please configure Pathao Courier. Dont't have Pathao Merchant account? <span class="text-primary text-decoration-underline fs-6"><a href="https://redx.com.bd/registration/" target="_blank">Apply Now</a></span></small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label class="form-label" for="store_id">Merchant Store ID</label>
                                                <input type="text" class="form-control" id="store_id" name="store_id" value="{{ $pathao && $pathao->store_id ? $pathao->store_id : ''}}" placeholder="Merchant Store ID">
                                                @error('store_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="client_id">Merchant Client ID</label>
                                                <input type="text" class="form-control" id="client_id" name="client_id" value="{{ $pathao && $pathao->client_id ? $pathao->client_id : ''}}" placeholder="Merchant Client ID">
                                                @error('client_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="client_secret">Merchant Client Secret</label>
                                                <div class="password-container d-flex">
                                                    <input type="password" class="form-control password-input" id="client_secret" name="client_secret" value="{{ $pathao && $pathao->client_secret ? $pathao->client_secret : '' }}" placeholder="Merchant Client Secret">
                                                    <i class="fa fa-eye-slash toggle-password" id="toggleClientSecret"></i>
                                                </div>
                                                @error('client_secret')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="username">Merchant Username</label>
                                                <input type="text" class="form-control" id="username" name="username" value="{{ $pathao && $pathao->username ? $pathao->username : ''}}" placeholder="Merchant Username">
                                                    @error('username')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="password">Merchant Password</label>
                                                <div class="password-container d-flex">
                                                    <input type="password" class="form-control password-input" id="password" name="password" value="{{ $pathao && $pathao->password ? $pathao->password : '' }}" placeholder="Merchant Password">
                                                    <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check form-switch form-check-inline">
                                                <input class="form-check-input" type="checkbox" {{ $pathao && $pathao->status == 1 ? 'checked' : '' }} id="status" name="status">
                                                <label class="form-check-label" for="status">Availability</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $pathao ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')

    <script>

        $(document).ready(function() {

            if ($('#redx_input').is(':checked')) {
                $('#redx_field').show();
            } else {
                $('#redx_field').hide();
            }

            $('#redx_input').change(function() {
                if ($(this).is(':checked')) {
                    $('#redx_field').slideDown();
                } else {
                    $('#redx_field').slideUp();
                }
            });
        });

        $(document).ready(function() {

            if ($('#steadfast_input').is(':checked')) {
                $('#steadfast_field').show();
            } else {
                $('#steadfast_field').hide();
            }

            $('#steadfast_input').change(function() {
                if ($(this).is(':checked')) {
                    $('#steadfast_field').slideDown();
                } else {
                    $('#steadfast_field').slideUp();
                }
            });
        });

        $(document).ready(function() {
            if ($('#pathao_input').is(':checked')) {
                $('#pathao_field').show();
            } else {
                $('#pathao_field').hide();
            }

            $('#pathao_input').change(function() {
                if ($(this).is(':checked')) {
                    $('#pathao_field').slideDown();
                } else {
                    $('#pathao_field').slideUp();
                }
            });
        });


    </script>

    <script>
        // Toggle Password Visibility for Redx Client Secret Field
        $('#toggleRedxAppSecret').on('click', function () {
            const redx_app_secretInput = $('#redx_app_secret');
            const icon = $(this);

            // Toggle the type attribute
            if (redx_app_secretInput.attr('type') === 'password') {
                redx_app_secretInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                redx_app_secretInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // Toggle Password Visibility for Steadfast Client Secret Field
        $('#toggleSteadfastAppSecret').on('click', function () {
            const steadfast_app_secretInput = $('#steadfast_app_secret');
            const icon = $(this);

            // Toggle the type attribute
            if (steadfast_app_secretInput.attr('type') === 'password') {
                steadfast_app_secretInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                steadfast_app_secretInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // Toggle Password Visibility for Pathao Password Field
        $('#togglePassword').on('click', function () {
            const passwordInput = $('#password');
            const icon = $(this);

            // Toggle the type attribute
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // Toggle Password Visibility for Pathao Client Secret Field
        $('#toggleClientSecret').on('click', function () {
            const clientSecretInput = $('#client_secret');
            const icon = $(this);

            // Toggle the type attribute
            if (clientSecretInput.attr('type') === 'password') {
                clientSecretInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                clientSecretInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    </script>


@endpush

