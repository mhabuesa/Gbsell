@push('title')
    <title>Order Report | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">


    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/flatpickr/flatpickr.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
    <style>
        .dt-length,
        .dt-info {
            display: none;
        }
    </style>
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <div class="block-options space-x-1">
                    <div class="d-inline-block">
                        <a href="{{ route('report.order') }}"
                            class="btn btn-sm btn-{{ Request::routeIs('report.order') ? 'primary' : 'alt-secondary' }}">
                            <i class="nav-main-link-icon fa-solid fa-cart-flatbed-suitcase"></i>
                            Order Report
                        </a>
                    </div>
                    <div class="d-inline-block">
                        <a href="{{ route('report.product') }}" class="btn btn-sm btn-alt-secondary">
                            <i class="nav-main-link-icon fa-solid fa-box-open"></i>
                            Product Report
                        </a>
                    </div>
                </div>
                <div class="block-options space-x-1">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-flask"></i>
                            Status
                            <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm"
                            aria-labelledby="dropdown-recent-orders-filters">
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="{{ route('report.order', 'pending') }}">
                                Pending
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="{{ route('report.order', 'delivering') }}">
                                Delivering
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="{{ route('report.order', 'delivered') }}">
                                Delivered
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="{{ route('report.order', 'cancel') }}">
                                Cancel

                            </a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-regular fa-calendar-days fa-lg"></i>
                            Filters
                            <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm"
                            aria-labelledby="dropdown-recent-orders-filters">
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="{{ route('report.order', 'week') }}">
                                This Week
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="{{ route('report.order', 'month') }}">
                                This Month
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                data-bs-toggle="modal" data-bs-target="#modal-block-vcenter" href="">
                                Custom Range
                                <span class="rounded-pill"><i class="fa-regular fa-calendar-days fa-xl"></i></span>
                            </a>
                        </div>
                    </div>
                    @if (!request()->is('report/order') || request()->has('form'))
                        <div class="dropdown d-inline-block">
                            <a href="{{ route('report.order') }}" class="btn btn-sm btn-alt-success">
                                <i class="fa-solid fa-retweet"></i>
                                Clear
                            </a>
                        </div>
                    @endif


                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th class="d-none d-xl-table-cell">Customer</th>
                                <th>Status</th>
                                <th class="d-none d-sm-table-cell text-end">Created</th>
                                <th class="d-none d-sm-table-cell text-end">Value</th>
                            </tr>
                        </thead>
                        <tbody class="fs-sm">
                            @forelse ($orders as $key => $order)
                                @php
                                    $statusClass = match ($order->status) {
                                        'pending' => 'bg-warning-light text-warning',
                                        'processing' => 'bg-info-light text-info',
                                        'delivering' => 'bg-success-light text-success',
                                        'delivered' => 'bg-success text-white',
                                        'cancel' => 'bg-danger-light text-danger',
                                        default => '',
                                    };
                                @endphp
                                <tr onclick="window.location='{{ route('order.details', $order->order_id) }}';"
                                    style="cursor: pointer;">
                                    <td>
                                        <a class="fw-semibold" href="javascript:void(0)">{{ $order->order_id }}</a>
                                        <p class="fs-sm fw-medium text-muted mb-0 text-capitalize">
                                            {{ $order->payment_method }}</p>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <a class="fw-semibold" href="javascript:void(0)">{{ $order->customer->name }}</a>
                                        <p class="fs-sm fw-medium text-muted mb-0">{{ $order->customer->phone }}</p>
                                    </td>
                                    <td>
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill {{ $statusClass }} text-uppercase">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell fw-semibold text-muted text-end">
                                        {{ $order->created_at->diffForHumans() }}</td>
                                    <td class="d-none d-sm-table-cell text-end">
                                        <strong> {{ $order->total }}/=</strong>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-block-vcenter" tabindex="-1" aria-labelledby="modal-block-vcenter"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Select Date Range</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('report.order') }}" method="GET">
                        <div class="block-content fs-sm pt-1">
                            <div class="mb-4">
                                <div class="input-daterange input-group" data-date-format="mm/dd/yyyy"
                                    data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    <input type="text" class="form-control" id="example-daterange1" name="from"
                                        placeholder="From" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" readonly>
                                    <span class="input-group-text fw-semibold">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                    <input type="text" class="form-control" id="example-daterange2" name="to"
                                        placeholder="To" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full pt-0">
                            <button type="submit" class="btn btn-sm btn-primary w-100"
                                data-bs-dismiss="modal">Perfect</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets') }}/js/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/be_tables_datatables.min.js"></script>
    {{-- Date Picker --}}
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script>
        One.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);
    </script>
@endpush
