@extends('layouts.frontend')
@section('content')
    <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home', ['shopUrl' => $shop->url])}}">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->


        <div class="bg-gray-7 pt-6 pb-3 mb-6">
            <div class="container">
                <div class="mb-8">
                    @include('frontend.customer.sidebar')
                    <!-- Tab Content -->
                    <div class="card borders-radius-17">
                        <div class="p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                            <div class="card-body">
                                <div class="tab-content" id="Jpills-tabContent">
                                    <div class="tab-pane fade active show" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="position-relative">
                                            <div class="border-bottom border-color-1 mb-2">
                                                <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">Wishlist Products</h3>
                                            </div>
                                            <!-- Products Body -->
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                                    <ul class="row list-unstyled products-group no-gutters">

                                                        @forelse ($products as $product )
                                                        <li class="col-6 col-md-3 col-xl-2 product-item mb-3">
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
                                                                                <a href="{{ route('shop.product', ['slug' => $product->slug, 'shopUrl' => $shop->url]) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-item__footer">
                                                                        @if ($product->variant->sortBy('current_price')->first()->regular_price != null)
                                                                        <div class="border-top pt-2 flex-center-between flex-wrap d-flex justify-content-center">
                                                                            <a href="{{route('wishlist.remove',['product_id' => $product->id, 'shopUrl' => $shop->url])}}" class="text-danger font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist <small>(Remove)</small></a>
                                                                        </div>
                                                                        @else
                                                                        <div class="border-top pt-2 flex-center-between flex-wrap d-flex justify-content-center mt-4">
                                                                            <a href="{{route('wishlist.remove',['product_id' => $product->id, 'shopUrl' => $shop->url])}}" class="text-danger font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist <small>(Remove)</small></a>
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

                                            <!-- End Products Body -->

                                            <!-- Products Pagination -->
                                            {{$products->links()}}
                                            <!-- End Products Pagination -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')

@endpush

