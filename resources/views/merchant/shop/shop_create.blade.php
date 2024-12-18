@push('title')
    <title>Shop Create | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets') }}/css/oneui.min-5.9.css">
@endpush
@extends('merchant.layout.auth')
@section('content')
    <main id="main-container">
        <div class="bg-primary-dark"
            style="background-image: url('http://127.0.0.1:8000/assets/media/photos/photo28@2x.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="row g-0 bg-primary-dark-op">

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
                                <h1 class="fw-bold mb-2"> You are almost done </h1>
                                <p class="fw-medium text-muted"> Start selling online in a few moments. </p>
                            </div>
                            <div class="row g-0 justify-content-center">
                                <div class="col-sm-8 col-xl-10">
                                    <form class="js-validation-signup" action="{{ route('shop.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="shop_name" class="form-label"> Shop Name </label>
                                                    <input type="text" class="form-control" id="shop_name"
                                                        name="shop_name" placeholder="Shop name"
                                                        value="{{ old('shop_name') }}" required>
                                                    @error('shop_name')
                                                        <small class="text-danger px-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="shop_url">Shop URL <small class="text-warning">(Can't change later)</small></label>
                                                    <div class="input-group">
                                                        <input type="text" id="shop_url" name="shop_url"
                                                            class="form-control" placeholder="Enter Shop URL" value="{{ old('shop_url') }}" required>
                                                        <span id="url_status_icon" class="input-group-text">
                                                            <i class="fa fa-spinner d-none" id="loading_icon"></i>
                                                            <i class="fa fa-check d-none" id="check_icon"></i>
                                                            <i class="fa fa-times d-none" id="cross_icon"></i>
                                                        </span>
                                                    </div>
                                                    <small id="url_feedback" class="form-text text-muted"></small>
                                                </div>
                                                @error('shop_url')
                                                    <small class="text-danger px-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="shop_phone" class="form-label"> Shop Phone </label>
                                                    <input type="number" class="form-control" id="shop_phone"
                                                        name="shop_phone" placeholder="Phone number"
                                                        value="{{ old('shop_phone') }}" required>
                                                    @error('shop_phone')
                                                        <small class="text-danger px-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="shop_email" class="form-label"> Shop Email </label>
                                                    <input type="email" class="form-control" id="shop_email"
                                                        name="shop_email" placeholder="Phone email"
                                                        value="{{ Auth::guard('merchant')->user()->email }}"
                                                        readonly="">
                                                    @error('shop_email')
                                                        <small class="text-danger px-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="shop_type" class="form-label"> Shop Type </label>
                                                    <select name="shop_type" id="" class="form-control" required>
                                                        <option value="">Select Type</option>
                                                        <option value="Clothing & Apparel">Clothing & Apparel</option>
                                                        <option value="Shoes & Footwear">Shoes & Footwear</option>
                                                        <option value="Accessories & Jewelry">Accessories & Jewelry</option>
                                                        <option value="Beauty & Cosmetics">Beauty & Cosmetics</option>
                                                        <option value="Electronics & Gadgets">Electronics & Gadgets</option>
                                                        <option value="Home & Furniture">Home & Furniture</option>
                                                        <option value="Books & Media">Books & Media</option>
                                                        <option value="Toys & Games">Toys & Games</option>
                                                        <option value="Sports & Outdoors">Sports & Outdoors</option>
                                                        <option value="Health & Wellness">Health & Wellness</option>
                                                        <option value="Food & Beverage">Food & Beverage</option>
                                                        <option value="Pet Supplies">Pet Supplies</option>
                                                        <option value="Grocery">Grocery</option>
                                                        <option value="Pharmaceuticals">Pharmaceuticals</option>
                                                        <option value="Utilities">Utilities</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    @error('shop_type')
                                                        <small class="text-danger px-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label for="shop_city" class="form-label"> City </label>
                                                    <select class="js-select2 form-select" id="one-ecom-product-category"
                                                        name="shop_city" style="width: 100%;"
                                                        data-placeholder="Choose one..">
                                                        <option></option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->name }}">{{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('shop_city')
                                                        <small class="text-danger px-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-4">
                                                    <label for="shop_address" class="form-label"> Address </label>
                                                    <input type="text" class="form-control" id="shop_address"
                                                        name="shop_address" placeholder="Shop Address"
                                                        value="{{ old('shop_address') }}" required>
                                                    @error('shop_address')
                                                        <small class="text-danger px-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="submit-button" class="btn btn-lg btn-alt-success">
                                                <i class="fa fa-fw fa-shop me-2 opacity-50"></i>Shop Create in a few
                                                moments
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
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script src="{{ asset('assets') }}/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.js"></script>
    <script>
        One.helpersOnLoad(['jq-select2', 'jq-maxlength']);
    </script>


    <script>
        $(document).ready(function() {
            $('#shop_url').on('input', function() {
                let shopUrl = $(this).val().trim().toLowerCase(); // Convert to lowercase here
                $('#loading_icon').removeClass('d-none'); // Show loading icon
                $('#check_icon, #cross_icon').addClass('d-none'); // Hide other icons

                if (shopUrl === '') {
                    $('#loading_icon').addClass('d-none'); // Hide loading icon
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/check-shop-url',
                    method: 'POST',
                    data: {
                        shop_url: shopUrl,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#loading_icon').addClass('d-none'); // Hide loading icon
                        if (response.exists) {
                            $('#cross_icon').removeClass('d-none'); // Show cross icon
                            $('#url_feedback').text('This URL is already taken').css('color',
                                'red');
                        } else {
                            $('#check_icon').removeClass('d-none'); // Show check icon
                            $('#url_feedback').text('This URL is available').css('color',
                                'green');
                        }
                    },
                    error: function() {
                        $('#loading_icon').addClass('d-none'); // Hide loading icon
                        $('#url_feedback').text('An error occurred. Please try again.').css(
                            'color', 'red');
                    }
                });
            });
        });
    </script>
@endpush
