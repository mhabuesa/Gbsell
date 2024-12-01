@extends('layouts.frontend')

@section('content')
<main id="content" role="main">
    <!-- Slider & Banner Section -->
    <div class="mb-4">
        <div class="container overflow-hidden">
            <div class="row">
                <!-- Slider -->
                <div class="col-xl pr-xl-2 mb-4 mb-xl-0">
                    <div class="bg-img-hero mr-xl-1  overflow-hidden"style="background-image: url({{ asset($banner->image ?? 'frontend/assets/img/1920X422/img1.jpg') }});">
                        <div class="js-slick-carousel u-slick" data-autoplay="true" data-speed="7000"
                            data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start ml-9 mb-3 mb-md-5">

                           @foreach ($bannerItems as $bannerItem )
                           <div class="js-slide bg-img-hero-center">
                            <div class="row height-410-xl py-7 py-md-0 mx-0">
                                <div class="d-none d-wd-block offset-1"></div>
                                <div class="col-xl col-6 col-md-6 mt-md-8">
                                    <h1 class="font-size-64 text-lh-57 font-weight-light"
                                        data-scs-animation-in="fadeInUp">
                                        {{$bannerItem->title}}
                                    </h1>
                                    <h6 class="font-size-15 font-weight-bold mb-3"
                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">{{$bannerItem->subtitle}}
                                    </h6>
                                    <div class="mb-4" data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="font-size-13">FROM</span>
                                        <div class="font-size-50 font-weight-bold text-lh-45">
                                            <sup class="">&#2547</sup>{{$bannerItem->product->variant->sortBy('current_price')->first()->current_price}}
                                        </div>
                                    </div>
                                    <a href="{{route('shop.product', ['slug'=>$bannerItem->product->slug, 'shopUrl'=> $shop->url])}}"
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
                                        <div class="product-item__inner {{$products->count() == 1 ? 'remove-prodcut-hover': ''}} px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="{{ route('category.product', ['slug' => $product->category->slug, 'shopUrl' => $shop->url]) }}" class="font-size-12 text-gray-5">{{ $product->category->name }}</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}" class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                                <div class="mb-2">
                                                    <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}" class="d-block text-center"><img class="img-fluid" src="{{asset($product->preview)}}" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        @if ($product->variant->sortBy('current_price')->first()->regular_price != null)
                                                            <small class="text-gray-100"><del>৳ {{ $product->variant->sortBy('current_price')->first()->regular_price }}</del></small>
                                                        @else

                                                        @endif
                                                        <div class="text-gray-100">৳ {{ $product->variant->sortBy('current_price')->first()->current_price }}</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
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
                        <div class="tab-pane fade pt-2" id="Bpills-two-example1" role="tabpanel"
                            aria-labelledby="Bpills-two-example1-tab">
                            <ul class="row list-unstyled products-group no-gutters mb-0">
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Tablet White EliteBook
                                                        Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img2.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="col-6 col-md-4 col-wd-3 product-item remove-divider-xl remove-divider-md-lg">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item remove-divider-wd">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">GameConsole Destiny
                                                        Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img7.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="col-6 col-md-4 col-wd-3 product-item remove-divider-xl remove-divider-md-lg">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Tablet White EliteBook
                                                        Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img2.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">GameConsole Destiny
                                                        Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img7.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade pt-2" id="Bpills-three-example1" role="tabpanel"
                            aria-labelledby="Bpills-three-example1-tab">
                            <ul class="row list-unstyled products-group no-gutters mb-0">
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Tablet White EliteBook
                                                        Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img2.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="col-6 col-md-4 col-wd-3 product-item remove-divider-xl remove-divider-md-lg">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item remove-divider-wd">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">GameConsole Destiny
                                                        Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img7.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="col-6 col-md-4 col-wd-3 product-item remove-divider-xl remove-divider-md-lg">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Tablet White EliteBook
                                                        Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img2.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">GameConsole Destiny
                                                        Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img7.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade pt-2" id="Bpills-four-example1" role="tabpanel"
                            aria-labelledby="Bpills-four-example1-tab">
                            <ul class="row list-unstyled products-group no-gutters mb-0">
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Tablet White EliteBook
                                                        Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img2.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="col-6 col-md-4 col-wd-3 product-item remove-divider-xl remove-divider-md-lg">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item remove-divider-wd">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">GameConsole Destiny
                                                        Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img7.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="col-6 col-md-4 col-wd-3 product-item remove-divider-xl remove-divider-md-lg">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Tablet White EliteBook
                                                        Revolve 810 G2</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img2.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">Wireless Audio System
                                                        Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img1.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-4 col-wd-3 product-item remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html"
                                                        class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="text-blue font-weight-bold">GameConsole Destiny
                                                        Special Edition</a></h5>
                                                <div class="mb-2">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset('frontend') }}/assets/img/212X200/img7.jpg"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-top-widget -->
    <div class="container d-none d-lg-block mb-3">
        <div class="row">
            <div class="col-wd-3 col-lg-4">
                <div class="widget-column">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Featured Products</h3>
                    </div>
                    <ul class="list-unstyled products-group">
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="d-block width-75 text-center"><img class="img-fluid"
                                        src="{{ asset('frontend') }}/assets/img/75X75/img1.jpg" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a
                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                        class="text-blue font-weight-bold">Purple Wireless Headphones Solo 2 HD</a>
                                </h5>
                                <div class="prodcut-price mt-auto">
                                    <div class="font-size-15">$1149.00</div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="d-block width-75 text-center"><img class="img-fluid"
                                        src="{{ asset('frontend') }}/assets/img/75X75/img2.jpg" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a
                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                        class="text-blue font-weight-bold">Powerbank 1130 mAh Blue</a></h5>
                                <div class="prodcut-price mt-auto">
                                    <div class="font-size-15">$210.00</div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="d-block width-75 text-center"><img class="img-fluid"
                                        src="{{ asset('frontend') }}/assets/img/75X75/img3.jpg" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a
                                        href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                        class="text-blue font-weight-bold">Nerocool EN52377 Dead Silence Gaming Cube
                                        Case</a></h5>
                                <div class="prodcut-price mt-auto">
                                    <div class="font-size-15">$180.00</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-wd-3 col-lg-4">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Onsale Products</h3>
                </div>
                <ul class="list-unstyled products-group">
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{ asset('frontend') }}/assets/img/75X75/img4.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a
                                    href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="text-blue font-weight-bold">Yellow Earphones Waterproof with
                                    Bluetooth</a></h5>
                            <div class="prodcut-price mt-auto flex-horizontal-center">
                                <ins class="font-size-15 text-decoration-none">$110.00</ins>
                                <del class="font-size-12 text-gray-9 ml-2">$250.00</del>
                            </div>
                        </div>
                    </li>
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{ asset('frontend') }}/assets/img/75X75/img5.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a
                                    href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="text-blue font-weight-bold">Camera C430W 4k Waterproof</a></h5>
                            <div class="prodcut-price mt-auto flex-horizontal-center">
                                <ins class="font-size-15 text-decoration-none">$899.00</ins>
                                <del class="font-size-12 text-gray-9 ml-2">$1200.00</del>
                            </div>
                        </div>
                    </li>
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{ asset('frontend') }}/assets/img/75X75/img6.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a
                                    href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="text-blue font-weight-bold">Smartphone 6S 32GB LTE</a></h5>
                            <div class="prodcut-price mt-auto flex-horizontal-center">
                                <ins class="font-size-15 text-decoration-none">$2100.00</ins>
                                <del class="font-size-12 text-gray-9 ml-2">$3299.00</del>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-wd-3 col-lg-4">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Top Rated Products</h3>
                </div>
                <ul class="list-unstyled products-group">
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{ asset('frontend') }}/assets/img/75X75/img7.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a
                                    href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="text-blue font-weight-bold">Smartwatch 2.0 LTE Wifi Waterproof</a></h5>
                            <div class="text-warning mb-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                            </div>
                            <div class="prodcut-price mt-auto">
                                <div class="font-size-15">$725.00</div>
                            </div>
                        </div>
                    </li>
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{ asset('frontend') }}/assets/img/75X75/img8.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a
                                    href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="text-blue font-weight-bold">22Mps Camera 6200U with 500GB SDcard</a></h5>
                            <div class="text-warning mb-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="far fa-star text-muted"></small>
                            </div>
                            <div class="prodcut-price mt-auto">
                                <div class="font-size-15">$2999.00</div>
                            </div>
                        </div>
                    </li>
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{ asset('frontend') }}/assets/img/75X75/img9.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a
                                    href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html"
                                    class="text-blue font-weight-bold">Full Color LaserJet Pro M452dn</a></h5>
                            <div class="text-warning mb-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="far fa-star text-muted"></small>
                            </div>
                            <div class="prodcut-price mt-auto">
                                <div class="font-size-15">$439.00</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-wd-3 d-none d-wd-block">
                <a href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html" class="d-block"><img
                        class="img-fluid" src="{{ asset('frontend') }}/assets/img/330X360/img1.jpg" alt="Image Description"></a>
            </div>
        </div>
    </div>
    <!-- End Footer-top-widget -->
    <!-- Footer-newsletter -->
    <div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-newsletter font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                        </div>
                        <div class="col my-4 my-md-0">
                            <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$20 coupon for first
                                    shopping.</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="js-validate js-form-message">
                        <label class="sr-only" for="subscribeSrEmail">Email address</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email"
                                id="subscribeSrEmail" placeholder="Email address" aria-label="Email address"
                                aria-describedby="subscribeButton" required
                                data-msg="Please enter a valid email address.">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2"
                                    id="subscribeButton">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
</main>
@endsection

