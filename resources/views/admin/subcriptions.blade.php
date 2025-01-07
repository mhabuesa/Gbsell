@push('title')
    <title>Subscriptions List | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
@endpush
@extends('layouts.backend')
@section('content')
    <div class="content mt-4">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Subscriptions List</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-vcenter table-bordered table-striped js-dataTable-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Shop Name</th>
                                <th>Created Date</th>
                                <th>Package</th>
                                <th>Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $key => $shop)
                                <tr>
                                    <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                    <td class="fw-semibold fs-sm">
                                        {{ $shop->shop->name }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($shop->created_at)->format('d M, Y') }}
                                    </td>
                                    <td>
                                        {{ $shop->package == 1 ? '1 Month' : ($shop->package == 2 ? '6 Months' : '1 Year') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($shop->shop->expiry_date)->format('d M, Y') }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
@endpush
