@push('title')
    <title>Shop Info | GBSell - eCommerce Solution </title>
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
                    <h3 class="block-title">Shop Info Update</h3>
                </div>
                <div class="block-content">
                    <div class="row d-flex justify-content-center">

                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="fs-2 fw-semibold text-dark">
                                        @if ($shop->logo == null)
                                            <img src="{{asset('assets')}}/media/photos/img.png" width="70" alt="">
                                        @else
                                            <img src="{{asset($shop->logo)}}" width="70" alt="Logo">
                                        @endif
                                    </div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="fw-medium fs-sm text-muted mb-0">
                                        Shop Logo
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" href="{{$shop->url}}" target="_blank">
                                <div class="block-content block-content-full">
                                    <div id="qr-code-placeholder" class="fs-2 fw-semibold text-dark">
                                        <!-- Placeholder image initially -->
                                        <img src="{{asset('assets')}}/media/photos/img.png" width="70" alt="QR Code Placeholder">
                                    </div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="fw-medium text-muted mb-0" style="font-size: 9px">
                                        {{$shop->url}}
                                    </p>
                                </div>
                            </a>
                        </div>

                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-8">
                            <form action="{{ route('shop.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label" for="shop_name">Shop Name</label>
                                    <input type="text" class="form-control" id="shop_name"
                                        name="shop_name" value="{{$shop->name}}">
                                        @error('shop_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="shop_phone">Phone</label>
                                    <input type="text" class="form-control" id="shop_phone"
                                        name="shop_phone" value="{{$shop->phone}}">
                                        @error('shop_phone')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="shop_email">Email</label>
                                    <input type="email" class="form-control" id="shop_email"
                                        name="shop_email" value="{{$shop->email}}" readonly="">
                                </div>
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="shop_type" class="form-label"> Shop Type </label>
                                            <select name="shop_type" id="" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option {{$shop->type == 'Clothing & Apparel' ? 'selected' : ''}} value="Clothing & Apparel">Clothing & Apparel</option>
                                                <option {{$shop->type == 'Shoes & Footwear' ? 'selected' : ''}} value="Shoes & Footwear">Shoes & Footwear</option>
                                                <option {{$shop->type == 'Accessories & Jewelry' ? 'selected' : ''}} value="Accessories & Jewelry">Accessories & Jewelry</option>
                                                <option {{$shop->type == 'Beauty & Cosmetics' ? 'selected' : ''}} value="Beauty & Cosmetics">Beauty & Cosmetics</option>
                                                <option {{$shop->type == 'Electronics & Gadgets' ? 'selected' : ''}} value="Electronics & Gadgets">Electronics & Gadgets</option>
                                                <option {{$shop->type == 'Home & Furniture' ? 'selected' : ''}} value="Home & Furniture">Home & Furniture</option>
                                                <option {{$shop->type == 'Books & Media' ? 'selected' : ''}} value="Books & Media">Books & Media</option>
                                                <option {{$shop->type == 'Toys & Games' ? 'selected' : ''}} value="Toys & Games">Toys & Games</option>
                                                <option {{$shop->type == 'Sports & Outdoors' ? 'selected' : ''}} value="Sports & Outdoors">Sports & Outdoors</option>
                                                <option {{$shop->type == 'Health & Wellness' ? 'selected' : ''}} value="Health & Wellness">Health & Wellness</option>
                                                <option {{$shop->type == 'Food & Beverage' ? 'selected' : ''}} value="Food & Beverage">Food & Beverage</option>
                                                <option {{$shop->type == 'Pet Supplies' ? 'selected' : ''}} value="Pet Supplies">Pet Supplies</option>
                                                <option {{$shop->type == 'Grocery' ? 'selected' : ''}} value="Grocery">Grocery</option>
                                                <option {{$shop->type == 'Pharmaceuticals' ? 'selected' : ''}} value="Pharmaceuticals">Pharmaceuticals</option>
                                                <option {{$shop->type == 'Utilities' ? 'selected' : ''}} value="Utilities">Utilities</option>
                                                <option {{$shop->type == 'Others' ? 'selected' : ''}} value="Others">Others</option>
                                            </select>
                                            @error('shop_type')
                                                <small class="text-danger px-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="shop_city" class="form-label"> City </label>
                                            <select class="js-select2 form-select" name="shop_city" id="shop_city"  style="width: 100%;" data-placeholder="Choose one..">
                                                <option></option>
                                                @foreach ($cities as $citie )
                                                <option {{$shop->city == $citie->name ? 'selected' : ''}} value="{{$citie->name}}">{{$citie->name}}</option>
                                                @endforeach
                                              </select>
                                            @error('shop_city')
                                                <small class="text-danger px-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="shop_address">Address</label>
                                    <input type="address" class="form-control" id="shop_address"
                                        name="shop_address" value="{{$shop->address}}" required>
                                        @error('shop_address')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="row">

                                        <div class="col-6 col-lg-3 m-auto">
                                            <span class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                                                <div class="block-content block-content-full">
                                                    <div class="fs-2 fw-semibold text-dark">
                                                        @if ($shop->logo == null)
                                                            <img id="image" src="{{asset('assets')}}/media/photos/img.png" width="100" alt="">
                                                        @else
                                                            <img id="image" src="{{asset($shop->logo)}}" width="100" alt="Logo">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="block-content py-2 bg-body-light">
                                                    <p class="fw-medium fs-sm text-muted mb-0">
                                                        Shop Logo
                                                    </p>
                                                </div>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="logo">Logo</label>
                                    <input class="form-control" id="logo" type="file" accept="image/*" name="logo" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter some nice description...">{{$shop->description}}</textarea>
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Shop URL</h3>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-8">
                            <form action="{{ route('shop.url.update', $shop->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <div class="row m-auto">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="shop_url">Shop URL</label>
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control" id="shop_url" name="shop_url" value="{{ $shop->url }}" onkeyup="checkShopURL(this.value)">
                                                <i id="status-icon" class="fs-4 mx-3 d-none"></i> <!-- Initial icon hidden -->
                                            </div>
                                            <small id="error-message" class="text-danger d-none">Enter your URL</small>
                                            @error('shop_url')
                                                <small class="text-danger px-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary" id="submit-button">Update</button>
                                </div>
                            </form>
                        </div>
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
    <script>One.helpersOnLoad(['jq-select2', 'jq-maxlength']);</script>

    <script>
        function checkShopURL(shopUrl) {
            const statusIcon = document.getElementById('status-icon');
            const errorMessage = document.getElementById('error-message');
            const submitButton = document.getElementById('submit-button');

            // Hide the error message when user starts typing
            errorMessage.classList.add('d-none');

            if (!shopUrl.trim()) {
                statusIcon.className = 'fs-4 mx-3 d-none';
                errorMessage.classList.remove('d-none');
                submitButton.disabled = true;
                return;
            }

            // Loading icon show if input is not empty
            statusIcon.className = 'fa fa-refresh text-success fs-4 mx-3';

            // AJAX request
            $.ajax({
                url: '/check-shop-url',
                type: 'GET',
                data: { shop_url: shopUrl.trim() },
                success: function(response) {
                    if (response.exists) {
                        statusIcon.className = 'fa-solid fa-x text-danger fs-4 mx-3';
                        submitButton.disabled = true;
                    } else if (response.available) {
                        statusIcon.className = 'fa fa-check text-success fs-4 mx-3';
                        submitButton.disabled = false;
                    } else {
                        statusIcon.className = 'fa fa-check text-success fs-4 mx-3';
                        submitButton.disabled = false;
                    }
                }
            });
        }
    </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                fetch(`/shop/{{$shop->id}}/qr-code`)
                    .then(response => response.json())
                    .then(data => {
                        const qrCodePlaceholder = document.getElementById('qr-code-placeholder');
                        // Replace placeholder image with the actual QR code
                        qrCodePlaceholder.innerHTML = `<img src="data:image/png;base64, ${data.qr_image}" width="70" alt="QR Code"/>`;
                    })
                    .catch(error => console.error('Error fetching QR code:', error));
            });
        </script>



@endpush
