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
                                        <form action="{{ route('admin.info.update') }}" method="POST">
                                            @csrf
                                            <div class="mb-2">
                                                <label class="form-label">Phone</label>
                                                <input type="phone" class="form-control w-100" name="phone" required value="{{ $info->phone }}">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control w-100" name="email" required value="{{ $info->email }}">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Address</label>
                                                <input type="address" class="form-control w-100" name="address" required value="{{ $info->address }}">
                                                @error('address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-2 text-center">
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
