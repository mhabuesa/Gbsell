@push('title')
    <title>SMS System | GBSell - eCommerce Solution </title>
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
                <h3 class="block-title">SMS System Setup</h3>
            </div>
            <div class="block-content">
                <div class="col-lg-8 m-auto ">
                    <div class="row items-push d-flex justify-content-between">
                        <div class="col-md-4">
                            <div class="form-check form-block">
                                <input class="form-check-input" checked type="checkbox" id="cod_input" name="cod"
                                    onclick="return false;">
                                <label class="form-check-label" for="cod_input">
                                    <span class="d-flex align-items-center">
                                        <img class="img-avatar img-avatar48"
                                            src="http://127.0.0.1:8000/assets/media/photos/sms.png" alt="Cash on Delivery">
                                        <span class="ms-2">
                                            <span class="fw-bold">Bulk SMS BD</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @if ($balance)
                            <div class="col-md-4">
                                <div class="form-check form-block">
                                    <label class="form-check-label text-center">
                                        <div class="">
                                            Current Balance: <span class="fw-bold" id="balance">{{ $balance }}</span>
                                            <br>
                                        </div>
                                        <small><a href="https://bulksmsbd.net/bkash/newindex" target="_blank">Top Up
                                                Now</a></small>
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="cod_field" class="row justify-content-center mt-3">
                <div class="col-md-10 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('sms.update', $shop_id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label d-block mb-0">Configure Bulk SMS BD</label>
                                        <small>To enable Bulk SMS messaging, please create an account on <span><a
                                                    href="https://www.bulksmsbd.com" target="_blank">BULK SMS
                                                    BD</a></span>.</small>
                                        <small class="d-block">Once you've obtained your credentials, integrate them into
                                            your system to start using the Bulk SMS service.</small>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label class="form-label" for="api_key">Api Key</label>
                                            <input type="text" class="form-control" id="api_key" name="api_key"
                                                value="{{ $api_key }}">
                                            @error('api_key')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label class="form-label" for="sender_id">Sender ID</label>
                                            <input type="text" class="form-control" id="sender_id" name="sender_id"
                                                value="{{ $sender_id }}">
                                            @error('sender_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check form-switch form-check-inline">
                                        <input class="form-check-input" {{ $status == '1' ? 'checked' : '' }}
                                            type="checkbox" id="status" name="status">
                                        <label class="form-check-label" for="status">Availability</label>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <button type="submit"
                                        class="btn btn-alt-primary">{{ $api_key ? 'Update' : 'Submit' }}</button>
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
