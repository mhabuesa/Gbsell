@extends('layouts.frontend')
@push('style')
    <style>
        .view-details {
            cursor: pointer;
        }

        .view-details:hover {
            background-color: #f1f1f1;
            /* হোভার করার সময় রঙ পরিবর্তন */
        }

        .product-details-row {
            background-color: #312525;
            /* ডিটেইল রো */
        }

        tr:nth-child(odd) {
            background-color: lightskyblue !important;
        }

        tr:nth-child(even) {
            background-color: lightpink !important;
        }

        .view-details td {
            background-color: rgb(194, 194, 194) !important;
        }
    </style>
@endpush
@section('content')
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                    href="{{ route('home', ['shopUrl' => $shop->url]) }}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Order
                            </li>
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
                    <div class="card borders-radius-17 ">
                        <div class="p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                            <div class="card-body">
                                <div class="tab-content" id="Jpills-tabContent">
                                    <div class="tab-pane fade active show" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="position-relative">
                                            <div class="border-bottom border-color-1 mb-2">
                                                <h3
                                                    class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">
                                                    Order List</h3>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade pt-2 show active table-responsive"
                                                    id="pills-one-example1" role="tabpanel"
                                                    aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                                    <table class="table" id="orderTable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Order ID</th>
                                                                <th>Total Price</th>
                                                                <th>Status</th>
                                                                <th>Date</th>
                                                                <th>Details</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($orders as $key => $order)
                                                                <tr class="view-details">
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $order->order_id }}</td>
                                                                    <td>৳ {{ $order->total + $order->charge }}</td>
                                                                    <td
                                                                        class="text-capitalize {{ $order->status == 'cancelled' ? 'text-danger' : '' }}">
                                                                        {{ $order->status }}</td>
                                                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                                    <td>
                                                                        <a href="javascript:void(0)"
                                                                            data-id="{{ $order->id }}"
                                                                            class="text-black show-product-link"><strong>Show
                                                                                product</strong></a>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button type="button"
                                                                                class="badge badge-{{ $order->status != 'cancelled' ? 'dark' : 'secondary' }} dropdown-toggle"
                                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                                aria-expanded="false">Action</button>
                                                                            @if ($order->status != 'cancelled')
                                                                                <div class="dropdown-menu z-5"
                                                                                    x-placement="bottom-start"
                                                                                    style="position: absolute; transform: translate3d(0px, 75px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                                    <a class="dropdown-item" target="_blank"
                                                                                        href="{{ route('invoice', ['shopUrl' => $shop->url, 'order_id' => $order->order_id]) }}">Invoice</a>
                                                                                    <div class="dropdown-divider"></div>
                                                                                    <form
                                                                                        id="orderCancel{{ $order->id }}"
                                                                                        method="POST"
                                                                                        action="{{ route('order.cancel', ['shopUrl' => $shop->url, 'id' => $order->id]) }}">
                                                                                        @csrf
                                                                                        <button type="button"
                                                                                            class="text-danger dropdown-item"
                                                                                            data-id="{{ $order->id }}"
                                                                                            onclick="confirmCancel(this)">Cancel</button>
                                                                                    </form>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <!-- Hidden Row for Product Details -->
                                                                <tr class="product-details-row"
                                                                    id="details-{{ $order->id }}"
                                                                    style="display: none;">
                                                                    <td colspan="7">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Variation</th>
                                                                                    <th>Color</th>
                                                                                    <th>Quantity</th>
                                                                                    <th>Price</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($order->orderProducts as $index => $product)
                                                                                    <tr>
                                                                                        <td>{{ $index + 1 }}</td>
                                                                                        <td>{{ $product->products->name }}
                                                                                        </td>
                                                                                        <td>{{ $product->attribute->name }}
                                                                                        </td>
                                                                                        <td>{{ $product->color->name }}
                                                                                        </td>
                                                                                        <td>{{ $product->quantity }}</td>
                                                                                        <td>৳ {{ $product->price }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="7" class="text-center">No data found</td>
                                                                </tr>
                                                            @endforelse

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="7"
                                                                    class="mb-0 pb-0 {{ $orders->links() == '' ? 'p-3' : '' }}">
                                                                    {{ $orders->links() }}
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>
                                            </div>
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
    <script>
        $(document).ready(function() {
            let activeRow = null;

            $('.show-product-link').on('click', function(e) {
                e.stopPropagation();

                const orderId = $(this).data('id');
                const detailsRow = $('#details-' + orderId);

                if (activeRow && activeRow.attr('id') !== detailsRow.attr('id')) {
                    activeRow.hide();
                }

                if (detailsRow.is(':visible')) {
                    detailsRow.hide();
                    activeRow = null;
                } else {
                    detailsRow.show();
                    activeRow = detailsRow;
                }
            });

            $('table').on('click', function() {
                if (activeRow) {
                    activeRow.hide();
                    activeRow = null;
                }
            });
        });
    </script>

    <script>
        function confirmCancel(button) {
            const orderId = button.getAttribute('data-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this Order!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Cancel it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('orderCancel' + orderId).submit();
                }
            });
        }
    </script>
@endpush
