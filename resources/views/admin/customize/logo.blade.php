@push('title')
    <title>Favicon | GBSell - eCommerce Solution </title>
@endpush
@extends('layouts.backend')
@section('content')
    <div class="content mt-5">
        <div class="row">
            @include('admin.customize.menu')
            <div class="col-md-7 col-xl-9">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Logo</h3>
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
                                        <form action="{{ route('admin.logo.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label">Logo <small class="text-danger">(Image format should be <strong>PNG</strong> )</small></label>
                                                <input type="file" class="form-control w-100" name="logo"
                                                    id="banner" accept="image/jpg, image/jpeg, image/png" required
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                @error('banner_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Preview Image</label>
                                                @if ($logo != null)
                                                    <img class="d-block" src="{{ asset($logo) }}" width="100"
                                                        id="image" alt="">
                                                @else
                                                    <img class="d-block" width="100"
                                                        src="{{ asset('assets/media/photos/favicon.png') }}" id="image" alt="">
                                                @endif
                                            </div>
                                            <div class="mb-4 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary w-50">Update</button>
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
