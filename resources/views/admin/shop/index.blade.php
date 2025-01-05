@push('title')
    <title>Shops | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">

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
        .flatpickr-calendar {
            margin: 0 auto;
        }
    </style>
@endpush
@extends('layouts.backend')
@section('content')
    <div class="content mt-4">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Shops</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-sm table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Shop Name</th>
                                <th>Products</th>
                                <th>Created Date</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $key => $shop)
                                <tr>
                                    <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                    <td class="fw-semibold fs-sm">
                                        {{ $shop->name }}
                                    </td>
                                    <td>
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill {{ $shop->products->count() > 5 ? 'bg-success-light' : ($shop->products->count() > 0 ? 'bg-info-light' : 'bg-danger-light') }} text-info">
                                            {{ $shop->products->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($shop->created_at)->format('d M, Y') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($shop->expiry_date)->format('d M, Y') }}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                {{ $shop->status == 1 ? 'checked' : '' }} name="status"
                                                data-id="{{ $shop->id }}" data-status="{{ $shop->status }}"
                                                onchange="updateUserStatus(this)">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled me-1"
                                                href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-block-vcenter{{ $shop->id }}">
                                                <i class="fa fa-fw fa-calendar"></i>
                                            </a>
                                            <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled me-1"
                                                href="{{ route('admin.shop.details', $shop->id) }}">
                                                <i class="fa fa-fw fa-info-circle"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" aria-label="Remove Client"
                                                data-bs-original-title="Remove Client" onclick="deleteUser(this)"
                                                data-id="{{ $shop->id }}">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-block-vcenter{{ $shop->id }}" tabindex="-1"
                                    aria-labelledby="modal-block-vcenter" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="block block-rounded block-transparent mb-0">
                                                <div class="block-header">
                                                    <h3 class="block-title">Select Date Range</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <form action="{{ route('admin.subscription.update', $shop->id) }}" method="post">
                                                    @csrf
                                                    <div class="row mb-4 justify-content-center">
                                                        <div class="col-xl-7">
                                                            <input type="text" class="js-flatpickr form-control d-none"
                                                                id="example-flatpickr-inline"
                                                                name="date"
                                                                placeholder="Inline Datepicker" data-inline="true" required>
                                                        </div>
                                                    </div>
                                                    <div class="block-content block-content-full pt-0">
                                                        <button type="submit" class="btn btn-sm btn-primary w-100"
                                                            data-bs-dismiss="modal">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    {{-- Date Picker --}}
    <script src="{{ asset('assets') }}/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.js"></script>
    <script>
        One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-masked-inputs',
            'jq-rangeslider'
        ]);
    </script>

    <script>
        $('#userTable').DataTable();

        function deleteUser(button) {
            const id = $(button).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    let url = "{{ route('admin.shop.delete', ':id') }}";
                    url = url.replace(':id', id);
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                showToast(data.message, "success");
                                $(button).closest('tr').remove();
                            } else {
                                showToast(data.message, "error");
                            }
                        },
                        error: function(xhr) {
                            showToast("An error occurred: " + xhr.responseJSON.message, "error");
                        }
                    });

                }
            });
        }

        function updateUserStatus(element) {
            Swal.fire({
                title: "Are you sure?",
                text: "Will you change user status?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    updateUserStatusAjax(element);
                } else {
                    element.checked = !element.checked;
                }
            })
        }

        function updateUserStatusAjax(element) {
            const id = $(element).data('id');
            let url = "{{ route('admin.shop.status.update', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        showToast(data.message, "success");
                    } else {
                        showToast(data.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.log('xhr.responseText, status, error', xhr.responseText, status, error);
                    showToast('Something went wrong', "error");
                }
            });
        }
    </script>
@endpush
