@extends('frontend.home.app')
@section('content')
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <div class="container mt-2">
                <!-- Banner -->
                <dv class="d-flex justify-content-between flex-md-nowrap flex-wrap border-sm-bottom-0 mb-2">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Best Sellers </h3>
                    </dv>
                @if ($bestSellers->count() > 0)

                <div class="row mb-6 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">

                    @foreach ($bestSellers as $bestSeller)
                        <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                            <a href="{{ route('home', ['shopUrl' => $bestSeller->shop->url]) }}"
                                class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                                <div class="col-6 col-xl-7 col-wd-6 pr-0">
                                    @if ($bestSeller->shop->logo)
                                        <img class="img-fluid" src="{{ asset($bestSeller->shop->logo) }}"
                                            alt="{{ $bestSeller->shop->name }}">
                                    @else
                                        <img class="img-fluid" src="{{ asset('frontend') }}/assets/images/shop.png"
                                            alt="{{ $bestSeller->shop->name }}">
                                    @endif
                                </div>
                                <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                                    <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                        <strong>{{ $bestSeller->shop->name }}</strong>
                                    </div>
                                    <div class="link text-gray-90 font-weight-bold font-size-15">
                                        Visit Shop
                                        <span class="link__icon ml-1">
                                            <span class="link__icon-inner"><i
                                                    class="ec ec-arrow-right-categproes"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                @endif
                <!-- End Banner -->
            </div>
            <div class="container">
                <!-- Laptops & Computers -->
                <div class="mb-6 position-relative">
                    <dv
                        class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Shops </h3>
                    </dv>
                    <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0"
                        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">

                        @foreach ($shops->chunk(8) as $shopChunk)
                            <!-- Each chunk contains 8 products -->
                            <div class="js-slide">
                                <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                    @foreach ($shopChunk as $shop)
                                        <!-- Loop through each product in the chunk -->
                                        <li
                                            class="col-md-4 col-lg-3 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <div class="product-item__outer h-100 w-100">
                                                <div class="p-md-3 row no-gutters">
                                                    <a href="{{ route('home', ['shopUrl' => $shop->url]) }}"
                                                        class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                                                        <div class="col-6 col-xl-7 col-wd-6 pr-0">
                                                            @if ($shop->logo)
                                                                <img class="img-fluid" src="{{ asset($shop->logo) }}"
                                                                    alt="{{ $shop->name }}">
                                                            @else
                                                                <img class="img-fluid"
                                                                    src="{{ asset('frontend') }}/assets/images/shop.png"
                                                                    alt="{{ $shop->name }}">
                                                            @endif
                                                        </div>
                                                        <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                                                            <div
                                                                class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                                                {{ $shop->name }}
                                                            </div>
                                                            <div class="link text-gray-90 font-weight-bold font-size-15">
                                                                Visit Shop
                                                                <span class="link__icon ml-1">
                                                                    <span class="link__icon-inner"><i
                                                                            class="ec ec-arrow-right-categproes"></i></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End Laptops & Computers -->
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
                                                        <div class="product-item__body pb-xl-1">
                                                            <div class="mb-2"><a
                                                                    href="{{ route('home', $product->shop->url) }}"
                                                                    class="font-size-12 text-gray-5">{{ $product->shop->name }}</a>
                                                            </div>
                                                            <h5 class="mb-1 product-item__title"><a
                                                                    href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $product->shop->url]) }}"
                                                                    class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                            </h5>
                                                            <div class="mb-2">
                                                                <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $product->shop->url]) }}"
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
                                                                    <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $product->shop->url]) }}"
                                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                            class="ec ec-add-to-cart"></i></a>
                                                                </div>
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
                            </div>
                        </div>
                    </div>

                    {{ $products->links() }}
                </div>

                <!-- End Products -->
            </div>

        </main>
        <!-- ========== END MAIN CONTENT ========== -->
@endsection
