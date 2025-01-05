@push('title')
    <title>Chat Setup | GBSell - eCommerce Solution </title>
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
                    <h3 class="block-title">Payment Gateway Setup</h3>
                </div>
                <div class="block-content">
                    <div class="col-lg-8 m-auto ">
                        <div class="row items-push">
                            <div class="col-md-4">
                              <div class="form-check form-block">
                                <input class="form-check-input" checked type="checkbox" id="cod_input" name="cod" onclick="return false;">
                                <label class="form-check-label" for="cod_input">
                                    <span class="d-flex align-items-center">
                                      <img class="img-avatar img-avatar48" src="http://127.0.0.1:8000/assets/media/photos/whatsapp.webp" alt="Cash on Delivery">
                                      <span class="ms-2">
                                        <span class="fw-bold">Whatsapp Chat</span>
                                      </span>
                                    </span>
                                  </label>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="cod_field" class="row justify-content-center mt-3">
                    <div class="col-md-10 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('chat.update', $shop_id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label d-block mb-0">Setup Whatsapp Chat</label>
                                            <small>Enter your Whatsapp number with country code.</small>
                                            <small class="d-block">As like this: <strong>8801700000000</strong></small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label class="form-label" for="phone">Number</label>
                                                <input type="number" class="form-control" id="number" name="phone" value="{{ $chat ? $chat->phone : '' }}">
                                                @error('phone')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label class="form-label" for="message">Message</label>
                                                <textarea class="form-control" name="message" id="message" cols="30" rows="5" maxlength="50" >{{ $chat ? $chat->message : '' }}</textarea>
                                                @error('message')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input" type="checkbox" {{ $chat && $chat->status == 1 ? 'checked' : '' }} id="status" name="status">
                                            <label class="form-check-label" for="status">Availability</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-alt-primary">{{ $chat ? 'Update' : 'Submit' }}</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.10.0/bootstrap-maxlength.min.js"></script>
<script>
    $(document).ready(function() {
    $('#message').maxlength({
        alwaysShow: true,
        placement: 'top-right'
    });
});
</script>
@endpush

