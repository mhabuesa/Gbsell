@extends('layouts.frontend')

@section('content')
    <main id="content" role="main">
        <!-- Slider & Banner Section -->
        <div class="mb-4">
            <div class="container overflow-hidden">
                <div class="row">
                    <!-- Slider -->
                    <div class="col-xl pr-xl-2 mb-4 mb-xl-0">
                        <div
                            class="bg-img-hero mr-xl-1  overflow-hidden"style="background-image: url({{ asset($banner->image ?? 'frontend/assets/img/1920X422/img1.jpg') }});">
                            <div class="js-slick-carousel u-slick" data-autoplay="true" data-speed="7000"
                                data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start ml-9 mb-3 mb-md-5">

                                @foreach ($bannerItems as $bannerItem)
                                    <div class="js-slide bg-img-hero-center">
                                        <div class="row height-410-xl py-7 py-md-0 mx-0">
                                            <div class="d-none d-wd-block offset-1"></div>
                                            <div class="col-xl col-6 col-md-6 mt-md-8">
                                                <h1 class="font-size-64 text-lh-57 font-weight-light"
                                                    data-scs-animation-in="fadeInUp">
                                                    {{ $bannerItem->title }}
                                                </h1>
                                                <h6 class="font-size-15 font-weight-bold mb-3"
                                                    data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                                    {{ $bannerItem->subtitle }}
                                                </h6>
                                                <div class="mb-4" data-scs-animation-in="fadeInUp"
                                                    data-scs-animation-delay="300">
                                                    <span class="font-size-13">FROM</span>
                                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                                        <sup
                                                            class="">&#2547</sup>{{ $bannerItem->product->variant->sortBy('current_price')->first()->current_price }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('shop.product', ['slug' => $bannerItem->product->slug, 'shopUrl' => $shop->url]) }}"
                                                    class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                    data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                                    Start Buying
                                                </a>
                                            </div>
                                            <div class="col-xl-7 col-6 d-flex align-items-center ml-auto ml-md-0"
                                                data-scs-animation-in="zoomIn" data-scs-animation-delay="500">
                                                <img class="img-fluid" src="{{ asset($bannerItem->product->preview) }}"
                                                    alt="Image Description">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- End Slider -->

                </div>
            </div>
        </div>
        <div class="container">
            <!-- Feature List -->
            <div class="mb-6 row border rounded-lg mx-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                <!-- Feature List -->
                <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all py-3">
                    <div class="u-avatar mr-2">
                        <i class="text-primary ec ec-transport font-size-46"></i>
                    </div>
                    <div class="media-body text-center">
                        <span class="d-block font-weight-bold text-dark">Reliable Delivery</span>
                        <div class="text-secondary">Fast and efficient service</div>
                    </div>
                </div>
                <!-- End Feature List -->

                <!-- Feature List -->
                <div
                    class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                    <div class="u-avatar mr-2">
                        <i class="text-primary ec ec-customers font-size-56"></i>
                    </div>
                    <div class="media-body text-center">
                        <span class="d-block font-weight-bold text-dark">99 % Customer</span>
                        <div class=" text-secondary">Feedbacks</div>
                    </div>
                </div>
                <!-- End Feature List -->

                <!-- Feature List -->
                <div
                    class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                    <div class="u-avatar mr-2">
                        <i class="text-primary ec ec-returning font-size-46"></i>
                    </div>
                    <div class="media-body text-center">
                        <span class="d-block font-weight-bold text-dark">Easy Returns</span>
                        <div class="text-secondary">For all eligible products</div>
                    </div>
                </div>
                <!-- End Feature List -->

                <!-- Feature List -->
                <div
                    class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                    <div class="u-avatar mr-2">
                        <i class="text-primary ec ec-payment font-size-46"></i>
                    </div>
                    <div class="media-body text-center">
                        <span class="d-block font-weight-bold text-dark">Payment</span>
                        <div class=" text-secondary">Secure System</div>
                    </div>
                </div>
                <!-- End Feature List -->

                <!-- Feature List -->
                <div
                    class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
                    <div class="u-avatar mr-2">
                        <i class="text-primary ec ec-tag font-size-46"></i>
                    </div>
                    <div class="media-body text-center">
                        <span class="d-block font-weight-bold text-dark">Top Brands</span>
                        <div class="text-secondary">Quality you can trust</div>
                    </div>
                </div>
                <!-- End Feature List -->
            </div>
            <!-- End Feature List -->
        </div>

        <div class="container">
            <!-- Products -->
            <div class="mb-6">
                <!-- Nav nav-pills -->
                <div class="position-relative text-center z-index-2">
                    <div
                        class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Products</h3>
                    </div>
                </div>
                <!-- End Nav Pills -->
                <div class="row">

                    <div class="col-md pl-md-0">
                        <!-- Tab Content -->
                        <div class="tab-content" id="Bpills-tabContent">
                            <div class="tab-pane fade pt-2 show active" id="Bpills-one-example1" role="tabpanel"
                                aria-labelledby="Bpills-one-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters mb-0">

                                    @forelse ($products as $product)
                                        <li class="col-6 col-md-3 col-xl-2 product-item">
                                            <div class="product-item__outer h-100 mb-3">
                                                <div
                                                    class="product-item__inner {{ $products->count() == 1 ? 'remove-prodcut-hover' : '' }} px-xl-4 p-3">
                                                    <div class="product-item__body pb-xl-2">
                                                        <div class="mb-2"><a
                                                                href="{{ route('category.product', ['slug' => $product->category->slug, 'shopUrl' => $shop->url]) }}"
                                                                class="font-size-12 text-gray-5">{{ $product->category->name }}</a>
                                                        </div>
                                                        <h5 class="mb-1 product-item__title"><a
                                                                href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
                                                                class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                        </h5>
                                                        <div class="mb-2">
                                                            <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
                                                                class="d-block text-center"><img class="img-fluid"
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
                                                                <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
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
                                        <li class="col-12 col-md-12 col-wd-12 product-item bg-secondary rounded my-5">
                                            <h2 class="text-center m-auto text-white">No Products</h2>
                                        </li>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ $products->links() }}
        </div>

        <!-- Footer-top-widget -->
        <div class="container d-none d-lg-block mb-3">
            <div class="row d-flex justify-content-between">
                @if ($topRatedProducts->count() > 0)
                    <div class="col-wd-3 col-lg-4">
                        <div class="widget-column">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Top Rated 5 Products
                                </h3>
                            </div>
                            <ul class="list-unstyled products-group">
                                @foreach ($topRatedProducts as $product)
                                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                        <div class="col-auto">
                                            <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
                                                class="d-block width-75 text-center"><img class="img-fluid"
                                                    src="{{ asset($product->preview) }}" alt="{{ $product->name }}"
                                                    title="{{ $product->name }}"></a>
                                        </div>
                                        <div class="col pl-4 d-flex flex-column">
                                            <h5 class="product-item__title mb-0"><a
                                                    href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
                                                    class="text-blue font-weight-bold"> {{ $product->name }}</a>
                                            </h5>
                                            <div class="text-warning mb-1">
                                                @php
                                                    $rating = $product->reviews->avg('rating') ?? 0; // Calculate average rating if available, default to 0
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <small
                                                        class="{{ $i <= $rating ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                                @endfor
                                            </div>
                                            <div class="prodcut-price mt-1">
                                                <div class="font-size-15">
                                                    ৳{{ $product->variant->sortBy('current_price')->first()->current_price }}
                                                    @if ($product->variant->sortBy('current_price')->first()->regular_price)
                                                        <del
                                                            class="font-size-12 text-gray-9 ml-2">৳{{ $product->variant->sortBy('current_price')->first()->regular_price }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endif
                @if ($topSellingProducts->count() > 0)
                    <div class="col-wd-3 col-lg-4">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Top Selling Products</h3>
                        </div>
                        <ul class="list-unstyled products-group">

                            @foreach ($topSellingProducts as $product)
                                <li class="product-item product-item__list row no-gutters mb-2 remove-divider">
                                    <div class="col-auto">
                                        <a href="{{ route('shop.product', ['slug' => $product->products->slug, 'shopUrl' => $shop->url]) }}"
                                            class="d-block width-75 text-center"><img class="img-fluid"
                                                src="{{ asset($product->products->preview) }}"
                                                alt="{{ $product->products->name }}"
                                                title="{{ $product->products->name }}"></a>
                                    </div>
                                    <div class="col pl-4 d-flex flex-column">
                                        <h5 class="product-item__title mb-0"><a
                                                href="{{ route('shop.product', ['slug' => $product->products->slug, 'shopUrl' => $shop->url]) }}"
                                                class="text-blue font-weight-bold">{{ $product->products->name }}</a></h5>
                                        <div class="prodcut-price mt-2 flex-horizontal-center">
                                            <ins
                                                class="font-size-15 text-decoration-none">৳{{ $product->products->variant->sortBy('current_price')->first()->current_price }}</ins>
                                            @if ($product->products->variant->sortBy('current_price')->first()->regular_price)
                                                <del
                                                    class="font-size-12 text-gray-9 ml-2">৳{{ $product->products->variant->sortBy('current_price')->first()->regular_price }}</del>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endif
                @if ($recentProducts->count() > 0)
                    <div class="col-wd-3 col-lg-4">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Recent Viewed Products</h3>
                        </div>
                        <ul class="list-unstyled products-group">
                            @foreach ($recentProducts as $product)
                                <li class="product-item product-item__list row no-gutters mb-2 remove-divider">
                                    <div class="col-auto">
                                        <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
                                            class="d-block width-75 text-center"><img class="img-fluid"
                                                src="{{ asset($product->preview) }}" alt="{{ $product->name }}"
                                                title="{{ $product->name }}"></a>
                                    </div>
                                    <div class="col pl-4 d-flex flex-column">
                                        <h5 class="product-item__title mb-0"><a
                                                href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}"
                                                class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                        <div class="prodcut-price mt-2 flex-horizontal-center">
                                            <ins
                                                class="font-size-15 text-decoration-none">৳{{ $product->variant->sortBy('current_price')->first()->current_price }}</ins>
                                            @if ($product->variant->sortBy('current_price')->first()->regular_price)
                                                <del
                                                    class="font-size-12 text-gray-9 ml-2">৳{{ $product->variant->sortBy('current_price')->first()->regular_price }}</del>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Footer-top-widget -->
    </main>
@endsection
