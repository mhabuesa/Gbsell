@push('title')
    <title>Banner Item Edit | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content content-boxed">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Banner Item</h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('front.banner.item') }}" class="btn btn-sm btn-primary"> <i
                                class="fa fa-arrow-left"></i> Back to List</a>
                    </div>
                </div>
            </div>

            <div id="cod_field" class="row justify-content-center mt-3">
                <div class="col-md-10 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action=" {{ route('banner.item.update', $banner->id) }} " method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $banner->title }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="subtitle">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                                        value="{{ $banner->subtitle }}">
                                    @error('subtitle')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="shop_city" class="form-label"> Product </label>
                                    <select class="js-select2 form-select" id="one-ecom-product-category" name="product_id"
                                        data-placeholder="Choose one.." required>
                                        <option> Select Product</option>
                                        @foreach ($products as $product)
                                            <option {{ $banner->product_id == $product->id ? 'selected' : '' }}
                                                value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <small class="text-danger px-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-alt-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
@endpush
