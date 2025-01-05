@extends('merchant.layout.app')
@push('title')
    <title>Product Inventory | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <style>
        /* Chrome, Safari, Edge, and Opera */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
@section('content')
    <div class="content content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Product Inventory - <span
                        class="p-2 rounded text-light bg-success">{{ $product->name }}</span> </h3>
                <div class="block-options">
                    <div class="block-options-item">
                        <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary"> <i
                                class="fa fa-arrow-left"></i>
                            Product List</a>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="block-content">
                        <div class="block block-rounded border border-gray-300">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Variant List</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="table table-responsive">
                                    <table class="table table-vcenter" id="inventoryTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 50px;">#</th>
                                                <th style="width: 150px;">Atribute</th>
                                                <th style="width: 150px;">Color</th>
                                                <th style="width: 150px;">Current Price</th>
                                                <th style="width: 150px;">Reguler Price</th>
                                                <th style="width: 150px;">Quantity</th>
                                                <th class="text-center" style="width: 100px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($variants as $key => $variant)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                                    <td>
                                                        {{ $variant->attribute->name }}
                                                    </td>
                                                    <td>
                                                        {{ $variant->color->name }}
                                                    </td>
                                                    <td>
                                                        {{ $variant->current_price }}
                                                    </td>
                                                    <td>
                                                        {{ $variant->regular_price }}
                                                    </td>
                                                    <td>
                                                        {{ $variant->quantity }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#inventory_modal_{{ $variant->id }}"
                                                                href="{{ route('category.edit', $variant->id) }}">
                                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                            </a>

                                                            <button type="button"
                                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                                onclick="deleteInventory(this)"
                                                                data-id="{{ $variant->id }}">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- Inventory Update Modal Start --}}
                                                <div class="modal" id="inventory_modal_{{ $variant->id }}" tabindex="-1"
                                                    aria-labelledby="inventory_modal_{{ $variant->id }}"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="block block-rounded block-transparent mb-0">
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title">Variant Update</h3>
                                                                    <div class="block-options">
                                                                        <button type="button" class="btn-block-option"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-fw fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <form
                                                                    action="{{ route('product.inventory.update', $variant->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="block-content fs-sm">
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-6">
                                                                                <div class="mt-2 mb-3">
                                                                                    <label for="attribute"
                                                                                        class="form-label"> Attribute
                                                                                    </label>
                                                                                    <select name="attribute_id"
                                                                                        id="attribute" class="form-select">
                                                                                        @foreach ($attributes as $attribute)
                                                                                            <option
                                                                                                value="{{ $attribute->id }}"
                                                                                                {{ $variant->attribute_id == $attribute->id ? 'selected' : '' }}>
                                                                                                {{ $attribute->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3 col-6">
                                                                                <div class="mt-2 mb-3">
                                                                                    <label for="color_id"
                                                                                        class="form-label"> Color
                                                                                    </label>
                                                                                    <select name="color_id" id="color_id"
                                                                                        class="form-select">
                                                                                        @foreach ($colors as $color)
                                                                                            <option
                                                                                                value="{{ $color->id }}"
                                                                                                {{ $variant->color_id == $color->id ? 'selected' : '' }}>
                                                                                                {{ $color->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-6">
                                                                                <div class="mt-2 mb-3">
                                                                                    <label for="current_price"
                                                                                        class="form-label"> Current Price
                                                                                    </label>
                                                                                    <input type="number" id="current_price"
                                                                                        class="form-control"
                                                                                        name="current_price"
                                                                                        placeholder="Current price"
                                                                                        value="{{ $variant->current_price }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-6">
                                                                                <div class="mt-2 mb-3">
                                                                                    <label for="regular_price"
                                                                                        class="form-label"> Regular Price
                                                                                    </label>
                                                                                    <input type="number" id="regular_price"
                                                                                        class="form-control"
                                                                                        name="regular_price"
                                                                                        placeholder="Regular price"
                                                                                        value="{{ $variant->regular_price }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-6">
                                                                                <div class="mt-2 mb-3">
                                                                                    <label for="quantity"
                                                                                        class="form-label"> Quantity
                                                                                    </label>
                                                                                    <input type="number" id="quantity"
                                                                                        class="form-control"
                                                                                        name="quantity"
                                                                                        placeholder="Quantity"
                                                                                        value="{{ $variant->quantity }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="block-content block-content-full text-end">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-alt-secondary me-1"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-primary"
                                                                            data-bs-dismiss="modal">Update Variant</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Inventory Update Modal End --}}
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No Variant Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="block-content">
                        <div class="block block-rounded border border-gray-300">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Add New Variant</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <form action="{{ route('product.inventory.store', $product->id) }}" method="POST">
                                    @csrf

                                    <div class="mb-3 mt-3">
                                        <div class="row" id="variants">
                                            <div class="col-sm-12 variant-options-container">
                                                <!-- Initial row will be here -->
                                                <div
                                                    class="row variant-option border border-gray-300 p-2 mx-2 mb-3 d-flex align-items-center justify-content-between">
                                                    <div class="col-lg-3 col-4">
                                                        <div class="mb-4">
                                                            <label class="form-label"
                                                                for="one-ecom-attribute">Attribute</label>
                                                            <select name="attribute_id[]" class="form-select" required>
                                                                <option value="">Select Attribute</option>
                                                                @foreach ($attributes as $attribute)
                                                                    <option value="{{ $attribute->id }}">
                                                                        {{ $attribute->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-4">
                                                        <div class="mb-4">
                                                            <label class="form-label"
                                                                for="one-ecom-extra-price">Color</label>
                                                            <select name="color_id[]" class="form-select" required>
                                                                <option value="">Select Color</option>
                                                                @foreach ($colors as $color)
                                                                    <option value="{{ $color->id }}">
                                                                        {{ $color->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="one-ecom-extra-price">Current
                                                                Price</label>
                                                            <input type="number" class="form-control"
                                                                name="current_price[]" placeholder="Current price"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-6">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="one-ecom-extra-price">Regular
                                                                Price</label>
                                                            <input type="number" class="form-control"
                                                                name="regular_price[]" placeholder="Regular price">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-6">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="one-ecom-extra-price">Quantity
                                                                (Stock)</label>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control"
                                                                    name="quantity[]" placeholder="Quantity" required>
                                                                <button class="btn btn-danger ms-2 remove-option"
                                                                    type="button"><i class="fa fa-x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-4">
                                                    <button id="add-more-option" class="btn btn-alt-primary mt-2"
                                                        type="button">
                                                        <i class="fa fa-plus"></i> Add More Option
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-primary w-50" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#inventoryTable').DataTable();

        function deleteInventory(button) {
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

                    let url = "{{ route('product.inventory.destroy', ':id') }}";
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
    </script>
    <script>
        $(document).ready(function() {
            // Function to create a variant option row dynamically
            function getVariantOptionTemplate() {
                return `
            <div class="row variant-option border border-gray-300 p-2 mx-2 mb-3 d-flex align-items-center justify-content-between">
                <div class="col-lg-3 col-4">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-attribute">Attribute</label>
                        <select name="attribute_id[]" class="form-select" required>
                            <option value="">Select Attribute</option>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 col-4">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-extra-price">Color</label>
                        <select name="color_id[]" class="form-select" required>
                            <option value="">Select Color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-4">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-extra-price">Current Price</label>
                        <input type="number" class="form-control" name="current_price[]" placeholder="Current price" required>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-extra-price">Regular Price</label>
                        <input type="number" class="form-control" name="regular_price[]" placeholder="Regular price" required>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-extra-price">Quantity (Stock)</label>
                        <div class="d-flex">
                            <input type="number" class="form-control" name="quantity[]" placeholder="Quantity" required>
                            <button class="btn btn-danger ms-2 remove-option" type="button"><i class="fa fa-x"></i></button>
                        </div>
                    </div>
                </div>
            </div>`;
            }

            // Add More Variant Button Click
            $("#add-more-option").on("click", function() {
                $(".variant-options-container").append(getVariantOptionTemplate());
            });

            // Remove Option Button Click
            $(document).on("click", ".remove-option", function() {
                if ($(".variant-options-container .variant-option").length > 1) {
                    $(this).closest(".variant-option").remove();
                } else {
                    showToast("At least one row is required.", "error");
                }
            });
        });

        function showToast(text, type = 'success') {
            let from, to;
            switch (type) {
                case 'error':
                    from = '#ff5b5c';
                    to = '#ff5b5c';
                    break;
                case 'success':
                    from = '#00b09b';
                    to = '#96c93d';
                    break;
                default:
                    from = '#00b09b';
                    to = '#96c93d';
                    break;
            }

            Toastify({
                text: text,
                duration: 3000,
                gravity: "top",
                position: "right",
                close: true,
                stopOnFocus: true,
                style: {
                    background: `linear-gradient(to right, ${from}, ${to})`
                },
            }).showToast();
        }
    </script>
@endpush
