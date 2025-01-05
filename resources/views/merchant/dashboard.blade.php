@push('title')
    <title>Dashboard | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
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
        <div class="row items-push">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales Today</div>
                        <div class="fs-lg fw-normal text-dark">BDT- <strong>{{ $salesToday }}/=</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales This Week</div>
                        <div class="fs-lg fw-normal text-dark">BDT- <strong>{{ $salesThisWeek }}/=</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales This Month</div>
                        <div class="fs-lg fw-normal text-dark">BDT- <strong>{{ $salesThisMonth }}/=</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Website visits</div>
                        <div class="fs-lg fw-normal text-dark"><strong>{{ $visitors }}</strong></div>
                    </div>
                </a>
            </div>

        </div>
        <div class="row">

            <div class="col-xl-5 col-xxl-5 d-flex flex-column mb-3">
                <a href="{{ route('product.create') }}" class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-center align-items-center">
                        <div class="fw-medium text-muted mb-0 text-center">
                            <i class="fa-solid fa-plus fa-2xl"></i>
                            <h1 class="fs-5 fw-medium text-dark text-center mt-3">Add product in Your Shop</h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-xxl-4 d-flex flex-column mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0 border">
                    <div class="d-flex justify-content-between">
                        <div class="mt-3 m-4">
                            <span>Shop Info</span>
                            <h4>{{ $shop->name }}</h4>
                        </div>
                        <div class="mt-3 m-4">
                            <div id="qr-code-placeholder" class="fs-2 fw-semibold text-dark">
                                <!-- Placeholder image initially -->
                                <img src="{{ asset('assets') }}/media/photos/img.png" width="100"
                                    alt="QR Code Placeholder">
                            </div>
                        </div>

                    </div>
                    <div class="block-content py-2 bg-body-light mt-auto py-2">
                        <div class="row block-content pt-0 flex-grow-1 d-flex justify-content-between align-items-center">
                            <div class="col-11 d-flex justify-content-center">
                                <a href="{{ url($shop->url) }}" class="fs-5" id="url"
                                    target="_blank">{{ url($shop->url) }}</a>
                            </div>
                            <div class="col-1 text-end">
                                <a href="javascript:void(0)" id="copyBtn" onclick="copyToClipboard()">
                                    <i class="fa-regular fa-copy fs-3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-3 d-flex flex-column mb-2">
                <div class="row items-push flex-grow-1 ">

                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column h-100 mb-0">
                            <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                                <dl class="mb-0">
                                    <dt class="fs-3 fw-bold">{{ $ordersThisMonth }}</dt>
                                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Orders This Month </dd>
                                </dl>
                                <div class="item item-rounded-lg bg-body-light">
                                    <i class="fa-solid fs-3 fa-cart-shopping"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column h-100 mb-0">
                            <div
                                class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                                <dl class="mb-0">
                                    <dt class="fs-3 fw-bold">{{ $orderstotal }}</dt>
                                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Orders</dd>
                                </dl>
                                <div class="item item-rounded-lg bg-body-light">
                                    <i class="fa-solid fs-3 fa-cart-flatbed-suitcase"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-6 col-xxl-6 mt-2">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Top Sold Items </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="d-xl-table-cell">Name</th>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-sm">
                                    @forelse ($mostSoldProducts as $key => $product)
                                        <tr>
                                            <td>
                                                <p class="fs-sm fw-medium text-muted mb-0">{{ $key + 1 }}</p>
                                            </td>
                                            <td class="d-xl-table-cell">
                                                <p class="fs-sm fw-medium text-muted mb-0">{{ $product->name }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-sm fw-medium text-muted mb-0">{{ $product->total_sold }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-6 mt-2">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Low Stock Products</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="d-xl-table-cell">Name</th>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-sm">
                                    @foreach ($lowStockProducts as $key => $product)
                                        <tr>
                                            <td>
                                                <p class="fs-sm fw-medium text-muted mb-0">{{ $key + 1 }}</p>
                                            </td>
                                            <td class="d-xl-table-cell">
                                                <p class="fs-sm fw-medium text-muted mb-0">{{ $product->name }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-sm fw-medium text-muted mb-0">{{ $product->total_stock }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch(`/shop/{{ $shop->id }}/qr-code`)
                .then(response => response.json())
                .then(data => {
                    const qrCodePlaceholder = document.getElementById('qr-code-placeholder');
                    qrCodePlaceholder.innerHTML =
                        `<img src="data:image/png;base64, ${data.qr_image}" width="100" alt="QR Code"/>`;
                })
                .catch(error => console.error('Error fetching QR code:', error));
        });

        function copyToClipboard() {
            var copyText = document.getElementById("url");
            navigator.clipboard.writeText(copyText.textContent).then(function() {
                showToast('Shop URL Copied to clipboard', 'success');
            }).catch(function(error) {
                alert("Failed to copy text: " + error);
            });
        }
    </script>
@endpush
