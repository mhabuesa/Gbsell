@push('title')
    <title>New Order List | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <style>
        .pagination {
            display: flex;
            justify-content: end;
        }


        .hover_tr {
            cursor: pointer;
            /* Pointer cursor for clickable rows */
        }
    </style>
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content">
            <div class="row">
                @include('merchant.order.menu')
                <div class="col-md-7 col-xl-9 p-0">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">New Order List</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="fullscreen_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-hover table-sm table-vcenter" id="userTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th style="width: 25%;">Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Total Product</th>
                                            <th class="tetx-center">Price</th>
                                            <th class="tetx-center">Date</th>
                                            <th class="tetx-center">Status</th>
                                            <th class="tetx-center">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $key => $order)
                                            <tr class="hover_tr">
                                                <th class="text-center" scope="row">{{ $key + 1 }}.</th>
                                                <td class="fw-semibold fs-sm">
                                                    {{ $order->order_id }}
                                                </td>
                                                <td class="fw-semibold fs-sm">
                                                    {{ $order->customer->name }}
                                                </td>
                                                <td class="fw-semibold fs-sm">
                                                    {{ $order->orderProducts->count() }}
                                                </td>
                                                <td class="fw-semibold fs-sm">
                                                    {{ number_format($order->total) }}
                                                </td>

                                                <td class="fw-semibold fs-sm">
                                                    <small>{{ $order->created_at->format('d-M-Y') }}</small>
                                                </td>
                                                <!-- Last td -->
                                                <td class="no-click">
                                                    <div class="dropdown dropend text-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-alt-primary dropdown-toggle text-capitalize text-center"
                                                            id="dropdown-dropright-alt-primary" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ $order->status }}
                                                        </button>
                                                        <div class="dropdown-menu fs-sm"
                                                            aria-labelledby="dropdown-dropright-alt-primary" style="">
                                                        <form action="{{ route('order.status.update', $order->id) }}" method="POST" >
                                                            @csrf

                                                            <button type="submit" name="status" value="pending" class="dropdown-item" href="javascript:void(0)">Pending</button>
                                                            <button type="submit" name="status" value="processing" class="dropdown-item"
                                                            href="javascript:void(0)">Processing</button>
                                                            <button type="submit" name="status" value="delivered" class="dropdown-item" href="javascript:void(0)">Delivered</button>
                                                            <div class="dropdown-divider"></div>
                                                            <button type="submit" name="status" value="cancel" class="dropdown-item" href="javascript:void(0)">Cancel</button>

                                                        </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-uppercase">
                                                    <a href="{{ route('order.details', $order->order_id) }}"
                                                        class="btn btn-sm btn-alt-primary px-3">
                                                        <i class="fa fa-eye fa-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>



                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
        function redirectTo(url) {
            document.querySelectorAll('.hover_tr').forEach(row => {
                row.addEventListener('click', function(event) {
                    if (event.target.closest('.no-click')) {
                        event.stopPropagation();
                        return;
                    }
                    window.location.href = url;
                });
            });
        }

        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
@endpush
