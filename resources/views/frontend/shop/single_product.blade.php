@extends('layouts.frontend')
@push('style')
    <style>
        .fas.fa-star {
            color: gold;
        }

        .far.fa-star {
            color: #ccc;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .fs_20 {
            font-size: 20px !important;
        }
    </style>
@endpush
@section('content')
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                    href="{{ route('category.product', ['slug' => $product->category->slug, 'shopUrl' => $shop->url]) }}">{{ $product->category->name }}</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                {{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <!-- Single Product Body -->
            <div class="mb-14">
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-0">
                        <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true"
                            data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                            data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                            data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                            data-nav-for="#sliderSyncingThumb">

                            @foreach ($product->gallery as $gallery)
                                <div class="js-slide d-flex justify-content-center">
                                    <img class="img-fluid" src="{{ asset($gallery->image) }}" alt="Image Description">
                                </div>
                            @endforeach

                        </div>

                        <div id="sliderSyncingThumb"
                            class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                            data-infinite="true" data-slides-show="5" data-is-thumbs="true"
                            data-nav-for="#sliderSyncingNav">
                            @foreach ($product->gallery as $gallery)
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ asset($gallery->image) }}" alt="Image Description">
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-md-6 mb-lg-0">
                        <div class="mb-2">
                            <a href="#"
                                class="font-size-12 text-gray-5 mb-2 d-inline-block">{{ $product->category->name }}</a>
                            <h2 class="font-size-25 text-lh-1dot2">{{ $product->name }}</h2>
                            <div class="mb-2">
                                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="javascript:;">
                                    <div class="text-warning mr-2">
                                        <small class="{{ $ratingOutOf5 >= 1 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                        <small class="{{ $ratingOutOf5 >= 2 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                        <small class="{{ $ratingOutOf5 >= 3 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                        <small class="{{ $ratingOutOf5 >= 4 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                        <small class="{{ $ratingOutOf5 >= 5 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                    </div>
                                    <span class="text-secondary font-size-13">({{ $ratingsCount->totalReviews }} customer reviews)</span>
                                </a>
                            </div>
                            <p><strong>Product Code</strong>: {{ $product->product_code }}</p>
                            <div class="mb-2 mt-3">
                                <strong>Short Description</strong>
                                <div class="font-size-14 pl-3 ml-1 text-gray-110">
                                    {{ $product->short_description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
                        <div class="mb-2">
                            <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
                                <div class="text-gray-9 font-size-14 pb-2 border-color-1 border-bottom mb-3">Availability:
                                    <span class="font-weight-bold availability">
                                        {{ $product->variant->sortBy('current_price')->first()->quantity }} in stock
                                    </span>
                                </div>


                                <div class="price" id="price">
                                    <div class="mb-2">
                                        <div class="font-size-12">Current Price</div>
                                        <div class="font-size-36">৳ <span
                                                id="current_price">{{ $product->variant->sortBy('current_price')->first()->current_price }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="regular_price_div">
                                        <div class="font-size-12">Regular Price</div>
                                        <div class="font-size-18">
                                            <del>৳ <span
                                                    id="regular_price">{{ $product->variant->sortBy('current_price')->first()->regular_price }}</span></del>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('cart.store', $shop->url) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <h6 class="font-size-14">Quantity</h6>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 w-md-60 height-35 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input
                                                        class="js_result form-control h-auto border-0 rounded p-0 shadow-none"
                                                        type="text" value="1" name="quantity">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="js_minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                        href="javascript:;">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="js_plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                        href="javascript:;">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="font-size-14">Variant</h6>
                                        <!-- Select -->
                                        <select class="attribute_id form-select btn-block col-12 px-3" name="attribute_id"
                                            required>
                                            <option value="" class="bg-secondary text-white"> Select a Variant
                                            </option>
                                            @foreach ($variants as $variant)
                                                <option value="{{ $variant->attribute->id }}">
                                                    {{ $variant->attribute->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- End Select -->
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="font-size-14">Color</h6>
                                        <!-- Select -->
                                        <select name="color_id"
                                            class="color_id color color_avail form-select dropdown-select btn-block col-12 px-3"
                                            required>
                                            <option value=""> Select a Color</option>
                                            </selec>
                                            <!-- End Select -->
                                    </div>
                                    <input type="text" class="product_id" name="product_id"
                                        value="{{ $product->id }}" hidden>
                                    <div class="mb-2 pb-0dot5 mt-4">
                                        <button type="submit" name="submit_button" value="add_to_cart"
                                            class="btn btn-block btn-primary-dark submit_btn"><i
                                                class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</button>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="submit_button" value="buy_now"
                                            class="btn btn-block btn-dark submit_btn">Buy Now</button>
                                    </div>
                                </form>


                                <div class="flex-content-center flex-wrap">
                                    <a href="{{ route('wishlist.store', ['shopUrl' => $shop->url, 'product_id' => $product->id]) }}"
                                        class="text-gray-6 font-size-13 mr-2"><i
                                            class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Product Body -->
        </div>
        <div class="bg-gray-7 pt-6 pb-3 mb-6">
            <div class="container">

                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0"
                            id="pills-tab-8" role="tablist">
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="description-tab" data-toggle="pill" href="#description"
                                    role="tab" aria-controls="description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="review-tab" data-toggle="pill" href="#review" role="tab"
                                    aria-controls="review" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            <div class="tab-pane fade active show" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p>{!! $product->description !!}</p>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="row mb-8">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h3 class="font-size-18 mb-6">Based on {{ $ratingsCount->totalReviews }} reviews</h3>
                                            <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">  {{ number_format($ratingOutOf10, 1) }}</h2>
                                            <div class="text-lh-1">overall out of 10</div>
                                        </div>

                                        <!-- Ratings -->
                                        <ul class="list-unstyled">
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1"
                                                    href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16"
                                                            style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $ratingsCount->totalReviews > 0 ? ($ratingsCount->fiveStarReviews * 100) / $ratingsCount->totalReviews : 0 }}%;"
                                                                aria-valuenow="{{ $ratingsCount->fiveStarReviews }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $ratingsCount->totalReviews }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span
                                                            class="text-gray-90">{{ $ratingsCount->fiveStarReviews > 0 ? $ratingsCount->fiveStarReviews : 0 }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1"
                                                    href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16"
                                                            style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $ratingsCount->totalReviews > 0 ? ($ratingsCount->fourStarReviews * 100) / $ratingsCount->totalReviews : 0 }}%;"
                                                                aria-valuenow="{{ $ratingsCount->fourStarReviews }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $ratingsCount->totalReviews }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span
                                                            class="text-gray-90">{{ $ratingsCount->fourStarReviews > 0 ? $ratingsCount->fourStarReviews : 0 }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1"
                                                    href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16"
                                                            style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $ratingsCount->totalReviews > 0 ? ($ratingsCount->threeStarReviews * 100) / $ratingsCount->totalReviews : 0 }}%;"
                                                                aria-valuenow="{{ $ratingsCount->threeStarReviews }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $ratingsCount->totalReviews }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span
                                                            class="text-gray-90">{{ $ratingsCount->threeStarReviews > 0 ? $ratingsCount->threeStarReviews : 0 }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1"
                                                    href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16"
                                                            style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $ratingsCount->totalReviews > 0 ? ($ratingsCount->twoStarReviews * 100) / $ratingsCount->totalReviews : 0 }}%;"
                                                                aria-valuenow="{{ $ratingsCount->twoStarReviews }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $ratingsCount->totalReviews }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span
                                                            class="text-gray-90">{{ $ratingsCount->twoStarReviews > 0 ? $ratingsCount->twoStarReviews : 0 }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1"
                                                    href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16"
                                                            style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $ratingsCount->totalReviews > 0 ? ($ratingsCount->oneStarReviews * 100) / $ratingsCount->totalReviews : 0 }}%;"
                                                                aria-valuenow="{{ $ratingsCount->oneStarReviews }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $ratingsCount->totalReviews }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span
                                                            class="text-gray-90">{{ $ratingsCount->oneStarReviews > 0 ? $ratingsCount->oneStarReviews : 0 }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End Ratings -->
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="font-size-18 mb-5">Add a review</h3>
                                        <!-- Form -->
                                        <form class="js-validate" method="POST"
                                            action="{{ route('customer.review', $shop->url) }}">
                                            @csrf
                                            <div class="row align-items-center mb-4">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="rating" class="form-label mb-0">Your Rating <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <div href="#" class="d-block">
                                                        <div class="text-warning text-ls-n2 font-size-16"
                                                            id="rating-stars">
                                                            <small class="far fa-star text-muted fs_20 cursor-pointer"
                                                                data-value="1" data-toggle="tooltip" data-placement="top"
                                                                title="Bad">
                                                                <input type="radio" id="star1" value="1"
                                                                    name="rating" hidden>
                                                            </small>
                                                            <small class="far fa-star text-muted fs_20 cursor-pointer"
                                                                data-value="2" data-toggle="tooltip" data-placement="top"
                                                                title="Average">
                                                                <input type="radio" id="star2" value="2"
                                                                    name="rating" hidden>
                                                            </small>
                                                            <small class="far fa-star text-muted fs_20 cursor-pointer"
                                                                data-value="3" data-toggle="tooltip" data-placement="top"
                                                                title="Good">
                                                                <input type="radio" id="star3" value="3"
                                                                    name="rating" hidden>
                                                            </small>
                                                            <small class="far fa-star text-muted fs_20 cursor-pointer"
                                                                data-value="4" data-toggle="tooltip" data-placement="top"
                                                                title="Very Good">
                                                                <input type="radio" id="star4" value="4"
                                                                    name="rating" hidden>
                                                            </small>
                                                            <small class="far fa-star text-muted fs_20 cursor-pointer"
                                                                data-value="5" data-toggle="tooltip" data-placement="top"
                                                                title="Excellent">
                                                                <input type="radio" id="star5" value="5"
                                                                    name="rating" hidden>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="descriptionTextarea" class="form-label">Your
                                                        Review <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <textarea class="form-control" name="review" rows="3" id="descriptionTextarea"
                                                        data-msg="Please enter your message." data-error-class="u-has-error" data-success-class="u-has-success">{{ old('review') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="inputName" class="form-label">Name <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control" name="name"
                                                        id="inputName" aria-label="Alex Hecker" required=""
                                                        data-msg="Please enter your name." data-error-class="u-has-error"
                                                        data-success-class="u-has-success" value="{{ old('name') }}">
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="emailAddress" class="form-label">Email <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="email" class="form-control" name="email"
                                                        id="emailAddress" aria-label="alexhecker@pixeel.com"
                                                        required="" data-msg="Please enter a valid email address."
                                                        data-error-class="u-has-error" data-success-class="u-has-success" value="{{ old('email') }}">
                                                    <input type="text" name="product_id" value="{{ $product->id }}"
                                                        hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="offset-md-4 offset-lg-3 col-auto">
                                                    <button type="submit"
                                                        class="btn btn-primary-dark btn-wide transition-3d-hover">Add
                                                        Review</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Form -->
                                    </div>
                                </div>

                                @foreach ($reviews as $review)
                                    <!-- Review -->
                                    <div class="border-bottom border-color-1 pb-4 mb-4">
                                        <!-- Review Rating -->
                                        <div
                                            class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small
                                                    class="{{ $review->rating >= 1 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                                <small
                                                    class="{{ $review->rating >= 2 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                                <small
                                                    class="{{ $review->rating >= 3 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                                <small
                                                    class="{{ $review->rating >= 4 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                                <small
                                                    class="{{ $review->rating >= 5 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                            </div>
                                        </div>
                                        <!-- End Review Rating -->

                                        <p class="text-gray-90">{{ $review->review }}.</p>

                                        <!-- Reviewer -->
                                        <div class="mb-2">
                                            <strong>{{ $review->name }}</strong>
                                            <span class="font-size-13 text-gray-23">-
                                                {{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <!-- End Reviewer -->
                                    </div>
                                    <!-- End Review -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->

            </div>
        </div>
        </div>
        <div class="container">
            <!-- Related products -->
            <div class="mb-6">
                <div
                    class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                    <h3 class="section-title mb-0 pb-2 font-size-22">Related products</h3>
                </div>
                <ul class="row list-unstyled products-group no-gutters">

                    @forelse ($reletedProducts as $product)
                    <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner {{$reletedProducts->count() == 1 ? 'remove-prodcut-hover': ''}} px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="product-categories-7-column-full-width.html"
                                            class="font-size-12 text-gray-5">{{ $product->category->name }}</a></div>
                                    <h5 class="mb-1 product-item__title"><a href="single-product-fullwidth.html"
                                            class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                    <div class="mb-2">
                                        <a href="single-product-fullwidth.html" class="d-block text-center"><img
                                                class="img-fluid"
                                                src="{{ asset($product->preview) }}"
                                                alt="Image Description"></a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        <div class="prodcut-price">
                                            @if ($product->variant->sortBy('current_price')->first()->regular_price != null)
                                                <small class="text-gray-100"><del>৳
                                                        {{ $product->variant->sortBy('current_price')->first()->regular_price }}</del></small>
                                            @endif
                                            <div class="text-gray-100">৳
                                                {{ $product->variant->sortBy('current_price')->first()->current_price }}
                                            </div>
                                        </div>
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            <a href="single-product-fullwidth.html"
                                                class="btn-add-cart btn-primary transition-3d-hover"><i
                                                    class="ec ec-add-to-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item__footer">
                                    @if ($product->variant->sortBy('current_price')->first()->regular_price != null)
                                        <div
                                            class="border-top pt-2 flex-center-between flex-wrap d-flex justify-content-center">
                                            <a href="{{ route('wishlist.store', ['shopUrl' => $shop->url, 'product_id' => $product->id]) }}"
                                                class="text-gray-6 font-size-13 mr-2"><i
                                                    class="ec ec-favorites mr-1 font-size-15"></i>
                                                Wishlist</a>
                                        </div>
                                    @else
                                        <div
                                            class="border-top pt-2 flex-center-between flex-wrap d-flex justify-content-center mt-4">
                                            <a href="{{ route('wishlist.store', ['shopUrl' => $shop->url, 'product_id' => $product->id]) }}"
                                                class="text-gray-6 font-size-13 mr-2"><i
                                                    class="ec ec-favorites mr-1 font-size-15"></i>
                                                Wishlist</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty

                    @endforelse
                </ul>
            </div>
            <!-- End Related products -->
        </div>

    </main>
@endsection

@push('script')
    <script>
        document.querySelector('.js_plus').addEventListener('click', function() {
            let input = document.querySelector('.js_result');
            input.value = parseInt(input.value) + 1;
        });

        document.querySelector('.js_minus').addEventListener('click', function() {
            let input = document.querySelector('.js_result');
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            // Hide the parent div if regular_price is null
            $(document).ready(function() {
                // Get the regular_price value from the span
                var regularPrice = $('#regular_price').text().trim();

                // Check if regularPrice is empty or null
                if (!regularPrice || regularPrice === 'null') {
                    $('.regular_price').hide(); // Hide the parent div if regular_price is null
                } else {
                    $('.regular_price').show(); // Show the parent div if regular_price has a value
                }
            });



            $(document).on('change', '.attribute_id', function() {
                var attribute_id = $(this).val(); // Selected attribute ID
                var product_id = $('input[name="product_id"]').val(); // Product ID

                // Fetch colors for the selected attribute
                $.ajax({
                    url: '/{{ $shop_url }}/getAttribute',
                    type: 'GET',
                    data: {
                        'attribute_id': attribute_id,
                        'product_id': product_id
                    },
                    success: function(data) {
                        // Populate the color dropdown
                        $('.color_id').html(data);

                        // Automatically select the first color and fetch its price
                        var firstColorId = $('.color_id').val();
                        if (firstColorId) {
                            fetchPrice(product_id, attribute_id, firstColorId);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Fetch price when color is selected
            $(document).on('change', '.color_id', function() {
                var product_id = $('input[name="product_id"]').val();
                var attribute_id = $('.attribute_id').val();
                var color_id = $(this).val();

                fetchPrice(product_id, attribute_id, color_id);
            });

            // Function to fetch price
            function fetchPrice(product_id, attribute_id, color_id) {
                $.ajax({
                    url: '/{{ $shop_url }}/getPrice',
                    type: 'GET',
                    data: {
                        product_id: product_id,
                        attribute_id: attribute_id,
                        color_id: color_id
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update prices
                            $('#current_price').text(response.data.current_price);

                            // Update quantity and availability
                            var availableQuantity = response.data.quantity;
                            $('.availability').text(availableQuantity + ' in stock');

                            // Change color based on availability
                            if (availableQuantity <= 0) {
                                $('.availability')
                                    .removeClass('text-green')
                                    .addClass('text-red')
                                    .text('Out of Stock');

                                $('.submit_btn').prop('disabled', true);
                            } else {
                                $('.availability')
                                    .removeClass('text-red')
                                    .addClass('text-green');

                                // Enable the submit button when the product is in stock
                                $('.submit_btn').prop('disabled', false);
                            }

                            // Show/hide regular price div
                            if (response.data.regular_price !== null) {
                                $('#regular_price').text(response.data.regular_price);
                                $('#regular_price_div')
                                    .show(); // Show the regular price div if available
                            } else {
                                $('#regular_price_div')
                                    .hide(); // Hide the regular price div if not available
                            }
                        } else {
                            alert(response.message || 'Variant not available!');
                        }
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }

            $(document).ready(function() {
                // Get the availability value
                var availabilityText = $('.availability').text().trim(); // Get the text
                var availableQuantity = parseInt(availabilityText); // Extract the quantity as a number

                // Check if the quantity is less than or equal to 5
                if (!isNaN(availableQuantity)) {
                    if (availableQuantity < 5) {
                        $('.availability')
                            .removeClass('text-green') // Remove green class
                            .addClass('text-red'); // Add red class
                    } else {
                        $('.availability')
                            .removeClass('text-red') // Remove red class
                            .addClass('text-green'); // Add green class
                    }
                }
            });

        });
    </script>
    <script>
        // Add click event to the parent container
        document.getElementById('rating-stars').addEventListener('click', function(e) {
            // Check if the clicked element is a small tag or its child
            const clickedElement = e.target.closest('small');
            if (clickedElement) {
                const selectedRating = parseInt(clickedElement.getAttribute('data-value')); // Get the star value

                // Get all the stars
                const stars = this.querySelectorAll('small');

                // Update classes for stars
                stars.forEach((star, index) => {
                    if (index < selectedRating) {
                        // Add selected star class
                        star.classList.remove('far', 'text-muted');
                        star.classList.add('fas', 'text-warning');
                    } else {
                        // Add unselected star class
                        star.classList.remove('fas', 'text-warning');
                        star.classList.add('far', 'text-muted');
                    }
                });

                // Check the corresponding radio button
                const radioInput = clickedElement.querySelector('input');
                if (radioInput) {
                    radioInput.checked = true;
                }
            }
        });
    </script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                showToast('{{ $error }}', 'error');
            </script>
        @endforeach
    @endif
@endpush
