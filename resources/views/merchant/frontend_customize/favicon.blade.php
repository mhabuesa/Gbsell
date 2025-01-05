@push('title')
    <title>Favicon | GBSell - eCommerce Solution </title>
@endpush
@extends('merchant.layout.app')
@section('content')
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
                                    <div class="col-lg-6 m-auto">
                                        <form action="{{ route('favicon.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label">Image <small class="text-danger">(Image format should be <strong>PNG</strong> )</small></label>
                                                <input type="file" class="form-control w-100" name="favicon"
                                                    id="banner" accept="image/jpg, image/jpeg, image/png" required
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                @error('banner_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Preview Image</label>
                                                @if ($favicon)
                                                    <img class="d-block" src="{{ asset($favicon) }}" width="100"
                                                        id="image" alt="">
                                                @else
                                                    <img class="d-block" width="100"
                                                        src="{{ asset('frontend/assets/images/favicon.png') }}" id="image" alt="">
                                                @endif
                                            </div>
                                            <div class="mb-4 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary w-50">{{ $favicon ? 'Update' : 'Submit' }}</button>
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
    </div>
@endsection
