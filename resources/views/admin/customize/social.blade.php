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
                                        <form action="{{ route('admin.social.update') }}" method="POST">
                                            @csrf
                                            <div class="mb-2">
                                                <label class="form-label" for="facebook">Facebook</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $info->facebook }}">
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label" for="twitter">Twitter</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa-brands fa-twitter"></i>
                                                        </span>
                                                        <input type="twitter" class="form-control" id="twitter" name="twitter" value="{{ $info->twitter }}">
                                                    </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label" for="instagram">Instagram</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $info->instagram }}">
                                                    </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label" for="youtube">Youtube</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa-brands fa-youtube"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $info->youtube }}">
                                                    </div>
                                            </div>

                                            <div class="mb-2 text-center">
                                                <button type="submit" class="btn btn-primary w-50">Update</button>
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
