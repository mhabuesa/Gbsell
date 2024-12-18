@extends('frontend.home.app')
@push('style')
    <style>
        .timeline {
            position: relative;
            margin: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 20px;
            width: 2px;
            background: #ddd;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-left: 50px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            top: 0;
            left: 10px;
            width: 22px;
            height: 22px;
            background: #00967D;
            border-radius: 20%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 10px;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endpush
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <div class="container">
            <div class="track-parcel">
                <div class="row my-5">
                    <div class="col-lg-8 m-auto">
                        <div class="mb-3 text-center d-flex gap-2 flex-column">
                            <h4>Track Your Order</h4>
                            <p>Now you can easily track your Order</p>
                        </div>
                        <form action="{{ route('order.track')  }}" method="GET">
                            <div class="inner-page-search-box d-flex gap-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control rounded-left" name="order_id" required
                                        value="{{ request('order_id') }}" placeholder="Search Order ID here...">
                                    <button class="btn btn-dark height-43 py-2 px-3 rounded-right" type="submit"
                                        id="searchProduct1">
                                        <span class="ec ec-search font-size-15"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-10 m-auto">
                        <div class="card">
                            <div class="card-body">
                                @if ($data != null)
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <h5>Tracking Updates</h5>
                                            <div class="timeline">
                                                <div class="timeline-item">
                                                    @if (in_array($data?->status, ['pending', 'processing', 'delivering', 'delivered']))
                                                        <div class="timeline-icon">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    @else
                                                        <div class="timeline-icon bg-secondary">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="timeline-content">Order Pending!</div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item">
                                                    @if (in_array($data?->status, ['processing', 'delivering', 'delivered']))
                                                        <div class="timeline-icon">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    @else
                                                        <div class="timeline-icon bg-secondary">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="timeline-content">Order Placed!</div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item">
                                                    @if (in_array($data?->status, ['delivering', 'delivered']))
                                                        <div class="timeline-icon">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    @else
                                                        <div class="timeline-icon bg-secondary">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="timeline-content">Order Shipped!</div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item">
                                                    @if (in_array($data?->status, ['delivered']))
                                                        <div class="timeline-icon">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    @else
                                                        <div class="timeline-icon bg-secondary">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="timeline-content">Order Delivered!</div>
                                                    </div>
                                                </div>
                                                @if ($data?->status == 'cancel')
                                                    <div class="timeline-item">
                                                        <div class="timeline-icon bg-danger">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                        <div>
                                                            <div class="timeline-content text-danger">Order Canceled! </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4 d-flex">
                                            <div class="info">
                                                <h5>Order Details</h5>
                                                <div class="d-flex flex-column gap-1">
                                                    <p class="m-0"><span class="fw-bold text-dark">Date :</span>
                                                        {{ $data?->created_at->format('M d, Y h:i A') }}
                                                    </p>
                                                    <p class="m-0"> <span class="fw-bold text-dark">Shop :</span>
                                                        <span class="text-capitalize text-success fw-bold">
                                                            <a href="{{ route('home', $data?->shop->url ?? $shop->url) }}"
                                                                target="_blank" class="text-blue fw-bold">
                                                                {{ $data?->shop->name }}</a>
                                                        </span>
                                                    </p>
                                                    <p class="m-0"> <span class="fw-bold text-dark">Invoice :</span>
                                                        <span>
                                                            @if ($data?->order_id != '')
                                                                <a href="{{ route('invoice', [$data->shop->url, $data?->order_id]) }}"
                                                                    class="text-blue fw-bold" target="_blank">Tap to
                                                                    view</a>
                                                            @endif
                                                        </span>
                                                    </p>
                                                    @if ($data?->delivery_method)
                                                        <p class="m-0"> <span class="fw-bold text-dark">Delivery System
                                                                :</span>
                                                            <span class="text-capitalize text-success fw-bold">
                                                                {{ $data?->delivery_method }}
                                                            </span>
                                                        </p>
                                                    @endif
                                                    @if ($data?->tracking_code)
                                                        <p class="m-0"> <span class="fw-bold text-dark">Tracking Code
                                                                :</span>
                                                            <span>
                                                                <a href="https://steadfast.com.bd/t/{{ $data?->tracking_code }}"
                                                                    target="_blank" class="text-blue fw-bold">
                                                                    {{ $data?->tracking_code == '' ? '' : $data?->tracking_code }}
                                                                </a>
                                                            </span>
                                                        </p>
                                                    @endif
                                                    <p class="m-0"> <span class="fw-bold text-dark">Payment Method
                                                            :</span>
                                                        <span class="text-capitalize text-success fw-bold">
                                                            {{ $data?->payment_method == 'ssl' ? 'SSLCommerz' : $data?->payment_method }}
                                                        </span>
                                                    </p>

                                                    <p class="m-0 fs-5"> <span class="fw-bold text-dark">Payable Amount
                                                            :</span>
                                                        <span class="text-capitalize text-success fw-bold">
                                                            {{ number_format($data?->total) }} <span class="text-dark">/=</span>
                                                        </span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-5 border-secondary w-90 border-3 mx-auto">
                                        <div class="col-lg-6 mb-4">
                                            <div class="info">
                                                <h5>Delivery Info</h5>
                                                <div class="d-flex flex-column gap-1">
                                                    <p class="m-0"><span class="fw-bold text-dark">Name :</span>
                                                        {{ $data?->shipping->ship_name }}</p>
                                                    <p class="m-0"><span class="fw-bold text-dark">Phone :</span>
                                                        {{ $data?->shipping->ship_phone }}</p>
                                                    <p class="m-0"><span class="fw-bold text-dark">Email :</span>
                                                        {{ $data?->shipping->ship_email }}</p>
                                                    <p class="m-0"><span class="fw-bold text-dark">Address :</span>
                                                        {{ $data?->shipping->ship_address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="info">
                                                <h5>Billing Info</h5>
                                                <div class="d-flex flex-column gap-1">
                                                    <p class="m-0"><span class="fw-bold text-dark">Name :</span>
                                                        {{ $data?->billing->name }}</p>
                                                    <p class="m-0"><span class="fw-bold text-dark">Phone :</span>
                                                        {{ $data?->billing->phone }}</p>
                                                    <p class="m-0"><span class="fw-bold text-dark">Email :</span>
                                                        {{ $data?->billing->email }}</p>
                                                    <p class="m-0"><span class="fw-bold text-dark">Address :</span>
                                                        {{ $data?->billing->address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif (request('order_id') == '')
                                    <h5 class="text-center">Please Enter Your Order ID</h5>
                                @else
                                    <h5 class="text-center">No Order Found!</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection

@push('script')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
