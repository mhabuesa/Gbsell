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
@extends('layouts.backend')
@section('content')
    <div class="content mt-5">
        <div class="row items-push">
            <div class="col-12 col-md-3 col-lg-6 col-xl-2">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales Today</div>
                        <div class="fs-lg fw-normal text-dark">BDT- <strong>{{ $salesToday }}/=</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-3 col-lg-6 col-xl-2">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales This Week</div>
                        <div class="fs-lg fw-normal text-dark">BDT- <strong>{{ $salesThisWeek }}/=</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-3 col-lg-6 col-xl-2">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales This Month</div>
                        <div class="fs-lg fw-normal text-dark">BDT- <strong>{{ $salesThisMonth }}/=</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-3 col-lg-6 col-xl-2">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Orders This Month</div>
                        <div class="fs-lg fw-normal text-dark"><strong>{{ $ordersThisMonth }}</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-3 col-lg-6 col-xl-2">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Total Orders</div>
                        <div class="fs-lg fw-normal text-dark"><strong>{{ $orderstotal }}</strong></div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-3 col-lg-6 col-xl-2">
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
            <div class="col-sm-12 col-xxl-12 mt-2 m-auto">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Shops Expiring Soon</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Shop Name</th>
                                        <th>Merchant Name</th>
                                        <th>Expiry Date</th>
                                        <th>Expired On</th>
                                        <th>Url</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-sm">
                                    @foreach ($shops as $key => $shop)
                                        <tr>
                                            <td>
                                                <p class="fs-sm fw-medium mb-0">{{ $key + 1 }}</p>
                                            </td>
                                            <td>
                                                <img src="{{ asset($shop->logo) }}" width="50" alt="">
                                            </td>
                                            <td>
                                                <p class="fs-sm fw-medium mb-0">{{ $shop->name }}</p>
                                            </td>
                                            <td>
                                                <p class="fs-sm fw-medium mb-0">{{ $shop->merchant->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="fs-sm fw-medium mb-0">{{ $shop->expiry_date }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="fs-sm fw-medium mb-0">
                                                    @if ($shop->expiry_date && $shop->expiry_date > \Carbon\Carbon::now())
                                                        {{ number_format((new DateTime($shop->expiry_date))->diff(new DateTime())->days) }} days left
                                                    @else
                                                        Expired
                                                    @endif
                                                </p>

                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fs-sm fw-medium mb-0 me-2" id="shopUrl-{{ $loop->index }}">
                                                        {{ url($shop->url) }}</p>
                                                    <a href="javascript:void(0)" id="copyBtn-{{ $loop->index }}"
                                                        onclick="copyToClipboard('shopUrl-{{ $loop->index }}')">
                                                        <i class="fa-regular fa-copy fs-3"></i>
                                                    </a>
                                                </div>
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
        function copyToClipboard(elementId) {
            const textElement = document.getElementById(elementId);

            if (textElement) {
                navigator.clipboard.writeText(textElement.textContent.trim())
                    .then(() => {
                        showToast('Shop URL Copied to clipboard', 'success');
                    })
                    .catch(err => {
                        console.error('Failed to copy text: ', err);
                        showToast('Failed to copy. Please try again.', 'error');
                    });
            }
        }
    </script>
@endpush
