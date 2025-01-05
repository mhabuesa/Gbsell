@extends('layouts.frontend')
@section('content')
    <main id="content" role="main" class="checkout-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home', ['shopUrl' => $shop->url])}}">Home</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Checkout
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-5">
                <h1 class="text-center">Checkout</h1>
            </div>

            <!-- End Accordion -->
            <form class="js-validate" action="{{ route('order.store', ['shopUrl' => $shop->url]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                        <div class="pl-lg-3 ">
                            <div class="bg-gray rounded-lg">
                                <!-- Order Summary -->
                                <div class="p-4 mb-4 checkout-table border border-color-1 rounded">
                                    <!-- Title -->
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                    </div>
                                    <!-- End Title -->

                                    <!-- Product Content -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $product)
                                                <tr class="cart_item">
                                                    <td>{{ $product['product_name'] }} &nbsp;<strong
                                                            class="product-quantity">× {{ $product['quantity'] }}</strong>
                                                    </td>
                                                    <td><span class="amount">৳
                                                            {{ $product['current_price'] * $product['quantity'] }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td id="subtotal">৳ <span id="subtotal-value">{{ $totalPrice }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping Destination</th>
                                                <td>
                                                    <div class="checkbox form-check form-check-inline ">
                                                        <div class="custom-control custom-radio d-flex align-items-center mr-3">
                                                            <input type="radio" class="custom-control-input" id="interCity" name="delivery" value="interCity" checked>
                                                            <label class="custom-control-label form-label" for="interCity">InterCity</label>
                                                        </div>
                                                        <div class="custom-control custom-radio d-flex align-items-center">
                                                            <input type="radio" class="custom-control-input" id="outSide" name="delivery" value="outSide">
                                                            <label class="custom-control-label form-label" for="outSide">OutSide</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>Flat rate ৳ <span id="shipping"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Disocunt</th>
                                                <td>৳<span id="discount">{{$discount ?? ''}}</span></td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td><strong id="total">৳ <span id="total-value">0.00</span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- End Product Content -->
                                    <div class="border-top border-width-2 border-color-1  mb-3">
                                        <!-- Basics Accordion -->
                                        <div id="basicsAccordion1">

                                            @if ($hasSslPayment)
                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingOne">
                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                        <input type="radio" class="custom-control-input"
                                                            id="stylishRadio1" name="payment" value="ssl" >
                                                        <label class="custom-control-label form-label" for="stylishRadio1"
                                                            data-toggle="collapse" data-target="#basicsCollapseOnee"
                                                            aria-expanded="true" aria-controls="basicsCollapseOnee">
                                                            SSLCommerz
                                                        </label>
                                                        <img class="ml-2" src="{{ asset('assets/media/photos/sslcommerz.png') }}" width="55px" alt="">
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseOnee"
                                                    class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                    aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        SSLCommerz supports multiple bank cards, mobile banking, and offers secure payment processing as a trusted partner..
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                            @endif

                                            @if ($hasBkashPayment)
                                                <!-- Card -->
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingTwo">
                                                        <div class="custom-control custom-radio d-flex align-items-center">
                                                            <input type="radio" class="custom-control-input"
                                                                id="secondStylishRadio1" name="payment" value="bkash">
                                                            <label class="custom-control-label form-label"
                                                                for="secondStylishRadio1" data-toggle="collapse"
                                                                data-target="#basicsCollapseTwo" aria-expanded="false"
                                                                aria-controls="basicsCollapseTwo">
                                                                Bkash payments
                                                            </label>
                                                            <img class="ml-2" src="{{ asset('assets/media/photos/bkash.png') }}" width="25px" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="basicsCollapseTwo"
                                                        class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                        aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion1">
                                                        <div class="p-4">
                                                            bKash supports easy and convenient payments through its platform.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card -->
                                            @endif


                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingThree">
                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                        <input type="radio" class="custom-control-input"
                                                            id="thirdstylishRadio1" name="payment" value="cod" checked="">
                                                        <label class="custom-control-label form-label"
                                                            for="thirdstylishRadio1" data-toggle="collapse"
                                                            {{ $codMessage?->note != null ? 'data-target=#basicsCollapseThree' : '' }} aria-expanded="false"
                                                            aria-controls="basicsCollapseThree">
                                                            Cash on delivery
                                                        </label>
                                                        <img class="ml-2" src="{{ asset('assets/media/photos/cod.png') }}" width="35px" alt="">
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseThree"
                                                    class="collapse {{ $codMessage?->note != null ? 'show' : '' }}  border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                    aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                       {{$codMessage?->note}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        </div>
                                        <!-- End Basics Accordion -->
                                    </div>

                                    <div class="d-none">
                                        <input type="text" id="couponDiscount" name="discount" value="{{$discount ?? ''}}">
                                        <input type="text" id="couponCode" name="coupon_code" value="{{ $coupon_code ?? ''}}">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 d-none d-md-inline-block">Place
                                        order</button>
                                </div>
                                <!-- End Order Summary -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 order-lg-1">
                        <div class="pb-7 mb-7">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                            </div>
                            <!-- End Title -->

                            <!-- Billing Form -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Full Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" placeholder="Please enter your Full name"
                                            aria-label="Please enter your Full name" required="" data-msg="Please enter your Full name."
                                            data-error-class="u-has-error" data-success-class="u-has-success"
                                            autocomplete="off" value="{{Auth::guard('customer')->user()?->name}}">

                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            City
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control js-select selectpicker dropdown-select" required="" name="city"
                                            data-msg="Please select City." data-error-class="u-has-error"
                                            data-success-class="u-has-success" data-live-search="true"
                                            data-style="form-control border-color-1 font-weight-normal">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->name }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-12">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Full Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="address" class="form-control" name="address"
                                            placeholder="Enter your address" aria-label="Enter your address" required=""
                                            data-msg="Please enter a valid address." data-error-class="u-has-error"
                                            data-success-class="u-has-success" value="{{Auth::guard('customer')->user()?->address}}">
                                    </div>
                                    <!-- End Input -->
                                </div>


                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Email address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="gmail@gmail.com" aria-label="gmail@gmail.com"
                                            required="" data-msg="Please enter a valid email address."
                                            data-error-class="u-has-error" data-success-class="u-has-success" value="{{Auth::guard('customer')->user()?->email}}">
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Phone
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="phone" name="phone" required class="form-control" placeholder="+8801712345678"
                                            aria-label="+8801712345678" data-msg="Please enter your last name."
                                            data-error-class="u-has-error" data-success-class="u-has-success" value="{{Auth::guard('customer')->user()?->phone}}">
                                            @error('phone')
                                                <span class="text-danger mx-3 text-capitalize">Enter a valid Phone number</span>
                                            @enderror
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="w-100"></div>
                            </div>
                            <!-- End Billing Form -->

                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Shipping Details</h3>
                            </div>
                            <!-- End Title -->
                            <!-- Accordion -->
                            <div id="shopCartAccordion3" class="accordion rounded mb-5">
                                <!-- Card -->
                                <div class="card border-0">
                                    <div id="shopCartHeadingFour"
                                        class="custom-control custom-checkbox d-flex align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress"
                                            name="ship_check">
                                        <label class="custom-control-label form-label" for="shippingdiffrentAddress"
                                            data-toggle="collapse" data-target="#shopCartfour" aria-expanded="false"
                                            aria-controls="shopCartfour">
                                            Ship to a different address?
                                        </label>
                                    </div>
                                    <div id="shopCartfour" class="collapse mt-5" aria-labelledby="shopCartHeadingFour"
                                        data-parent="#shopCartAccordion3" style="">
                                        <!-- Shipping Form -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Input -->
                                                <div class="js-form-message mb-6">
                                                    <label class="form-label">
                                                        Full Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="ship_name" placeholder="Please enter your Full name"
                                                        aria-label="Please enter your Full name" data-msg="Please enter your Full name."
                                                        data-error-class="u-has-error" data-success-class="u-has-success"
                                                        autocomplete="off">
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div class="w-100"></div>

                                            <div class="col-md-12">
                                                <!-- Input -->
                                                <div class="js-form-message mb-6">
                                                    <label class="form-label">
                                                        City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-control js-select selectpicker dropdown-select" name="ship_city"
                                                        data-msg="Please select City." data-error-class="u-has-error"
                                                        data-success-class="u-has-success" data-live-search="true"
                                                        data-style="form-control border-color-1 font-weight-normal">
                                                        <option value="">Select City</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div class="col-md-12">
                                                <!-- Input -->
                                                <div class="js-form-message mb-6">
                                                    <label class="form-label">
                                                        Street address
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="ship_address"
                                                        placeholder="470 Lucy Forks" aria-label="470 Lucy Forks"
                                                        data-msg="Please enter a valid address." data-error-class="u-has-error"
                                                        data-success-class="u-has-success">
                                                </div>
                                                <!-- End Input -->
                                            </div>


                                            <div class="col-md-6">
                                                <!-- Input -->
                                                <div class="js-form-message mb-6">
                                                    <label class="form-label">
                                                        Email address
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" class="form-control" name="ship_email"
                                                        placeholder="ship@gmail.com" aria-label="ship@gmail.com"
                                                        data-msg="Please enter a valid email address."
                                                        data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Input -->
                                                <div class="js-form-message mb-6">
                                                    <label class="form-label">
                                                        Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="phone" class="form-control" name="ship_phone" placeholder="+8801712345678"
                                                        aria-label="+8801712345678" data-msg="Please enter your last name."
                                                        data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                                <!-- End Input -->
                                            </div>
                                            <div class="w-100"></div>
                                        </div>
                                        <!-- End Shipping Form -->
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Accordion -->
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Order notes (optional)
                                </label>
                                <div class="input-group">
                                    <textarea class="form-control p-5" rows="4" name="note"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                            <!-- End Input -->
                            <button type="submit" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Place order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const interCity = document.getElementById('interCity');
        const outSide = document.getElementById('outSide');
        const shipping = document.getElementById('shipping');
        const subtotal = document.getElementById('subtotal-value');
        const discount = document.getElementById('discount');
        const total = document.getElementById('total-value');

        function updateShipping() {
            if (interCity.checked) {
                shipping.textContent = "100";
            } else if (outSide.checked) {
                shipping.textContent = "150";
            }
            updateTotal();
        }

        function updateTotal() {
            const subtotalValue = parseFloat(subtotal.textContent || 0);
            const shippingValue = parseFloat(shipping.textContent || 0);
            const discountValue = parseFloat(discount.textContent || 0);
            const totalValue = subtotalValue + shippingValue - discountValue;
            total.textContent = totalValue.toFixed(2);
        }

        // Update shipping when the selection changes
        interCity.addEventListener('change', updateShipping);
        outSide.addEventListener('change', updateShipping);

        // Ensure the shipping is set correctly on page load
        updateShipping();
    });
</script>

@if ($errors->has('ship_name') || $errors->has('ship_city') || $errors->has('ship_address') || $errors->has('ship_email') || $errors->has('ship_phone'))
    <script>
        showToast('Please fill in all required shipping details correctly.', 'error');
    </script>
@endif



@endpush
