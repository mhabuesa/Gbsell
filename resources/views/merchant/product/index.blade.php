@push('title')
    <title>Product List | GBSell - eCommerce Solution </title>
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
    <main id="main-container">
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Product List </h3>
                    @if (Auth::guard('merchant')->user()->permission == '1' ||
                            Auth::guard('merchant')->user()->permission == '2' ||
                            Auth::guard('merchant')->user()->permission == '4')
                        <div class="block-options">
                            <div class="block-options-item">
                                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary"> <i
                                        class="fa fa-plus"></i>
                                    Add Product</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive"
                            id="productTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th style="width: 150px;">Photo</th>
                                    <th>Name</th>
                                    <th>Product ID</th>
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Condition</th>
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Stock</th>
                                    @if (Auth::guard('merchant')->user()->permission == '1' ||
                                    Auth::guard('merchant')->user()->permission == '2')
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                                    @endif
                                    @if (Auth::guard('merchant')->user()->permission == '1' ||
                                            Auth::guard('merchant')->user()->permission == '2' ||
                                            Auth::guard('merchant')->user()->permission == '4')
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    @php
                                        $class = match ($product->condition) {
                                            'used' => 'bg-danger-light text-danger',
                                            'new' => 'bg-success-light text-success',
                                            'refurbished' => 'bg-warning-light text-warning',
                                            default => '',
                                        };
                                    @endphp
                                    <tr>
                                        <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            @if ($product->preview == null)
                                                <img src="{{ asset('assets') }}/media/photos/img.png" width="40"
                                                    alt="">
                                            @else
                                                <img src="{{ asset($product->preview) }}" class=""
                                                    style="width: 40px;" alt="Photo">
                                            @endif
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $product->product_code }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $product->name }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span
                                                class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill {{ $class }} text-capitalize">{{ $product->condition }}</span>
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $product->variant->sum('quantity') }}
                                        </td>
                                        @if (Auth::guard('merchant')->user()->permission == '1' ||
                                        Auth::guard('merchant')->user()->permission == '2')
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    {{ $product->status == 1 ? 'checked' : '' }} name="status"
                                                    data-id="{{ $product->id }}" data-status="{{ $product->status }}"
                                                    onchange="updateProductStatus(this)">
                                            </div>
                                        </td>
                                        @endif
                                        @if (Auth::guard('merchant')->user()->permission == '1' ||
                                                Auth::guard('merchant')->user()->permission == '2' ||
                                                Auth::guard('merchant')->user()->permission == '4')
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    @if (Auth::guard('merchant')->user()->permission == '1' || Auth::guard('merchant')->user()->permission == '2')
                                                        <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                            href="{{ route('product.inventory', $product->slug) }}"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            title="Product Inventory"
                                                            data-bs-content="You can add inventory for this product.">
                                                            <i class="fa fa-fw fa-boxes-stacked"></i>
                                                        </a>
                                                    @endif

                                                    @if (Auth::guard('merchant')->user()->permission == '1' ||
                                                            Auth::guard('merchant')->user()->permission == '2' ||
                                                            Auth::guard('merchant')->user()->permission == '4')
                                                        <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                            href="{{ route('product.edit', $product->slug) }}"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            title="Product Edit"
                                                            data-bs-content="You can edit this product">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </a>
                                                    @endif
                                                    @if (Auth::guard('merchant')->user()->permission == '1' || Auth::guard('merchant')->user()->permission == '2')
                                                        <button type="button"
                                                            class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                            onclick="deleteProduct(this)" data-id="{{ $product->id }}"
                                                            data-bs-toggle="popover" data-bs-placement="bottom"
                                                            title="Product Delete"
                                                            data-bs-content="You can delete this product">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script src="{{ asset('assets') }}/js/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <script>
        $('#productTable').DataTable();

        function deleteProduct(button) {
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

                    let url = "{{ route('product.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: url,
                        type: 'DELETE',
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

        function updateProductStatus(element) {
            Swal.fire({
                title: "Are you sure?",
                text: "Will you change Category status?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    updateProductStatusAjax(element);
                } else {
                    element.checked = !element.checked;
                }
            })
        }

        function updateProductStatusAjax(element) {
            const id = $(element).data('id');
            let url = "{{ route('product.status.update', ':id') }}";
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
