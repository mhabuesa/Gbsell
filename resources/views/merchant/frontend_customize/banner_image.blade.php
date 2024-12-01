@push('title')
    <title>Banner Image | GBSell - eCommerce Solution </title>
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content">
            <div class="row">
                @include('merchant.frontend_customize.menu')
                <div class="col-md-7 col-xl-9">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Banner Background Image</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="fullscreen_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content py-0">
                            <div class="pull-x">
                                <div class="block block-rounded">
                                    <div class="block-content block-content-full">
                                        <form action="{{ route('banner.image.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label">Image <small class="text-danger">(Image should be 1920x422)</small></label>
                                                <input type="file" class="form-control w-100" name="banner_image" id="banner" accept="image/jpg, image/jpeg, image/png" required onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                @error('banner_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Preview Image</label>
                                                   @if ($banner)
                                                        <img class="d-block"  src="{{ asset($banner->image) }}" width="600" id="image" alt="">
                                                   @else
                                                        <img class="d-block"  src="{{ asset('frontend/assets/img/1920X422/img1.jpg') }}" width="100%" id="image" alt="">
                                                   @endif
                                            </div>
                                            <div class="mb-4">
                                                <button type="submit" class="btn btn-primary">{{$banner ? 'Update': 'Submit' }}</button>
                                            </div>
                                        </form>
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
