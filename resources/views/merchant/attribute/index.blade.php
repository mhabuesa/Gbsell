@push('title')
    <title>Attribute | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Attribute </h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="block block-rounded border border-gray-300  mb-4">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Category wise Attribute List </h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row">
                                        @foreach ($categories as $key => $category)
                                            <div class="col-lg-6">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title text-center">{{ $category->name }}</h3>
                                                </div>
                                                <table class="table table-bordered table-vcenter">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Size</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($category->attributes as $attribute)
                                                            <tr>
                                                                <td class="text-center">{{ $attribute->name }}</td>
                                                                <td class="text-center" style="width: 20%">
                                                                    <div class="btn-group">
                                                                        <a class="btn btn-sm btn-alt-secondary btn-edit"
                                                                            href="javascript:void(0);"
                                                                            data-id="{{ $attribute->id }}"
                                                                            data-name="{{ $attribute->name }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#edit_modal_{{ $attribute->id }}">
                                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                                        </a>


                                                                        <button type="button"
                                                                            class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                                            onclick="deleteAttribute(this)"
                                                                            data-id="{{ $attribute->id }}">
                                                                            <i class="fa fa-fw fa-times"></i>
                                                                        </button>

                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <!-- Edit Modal -->
                                                            <div class="modal" id="edit_modal_{{ $attribute->id }}"
                                                                tabindex="-1" aria-labelledby="modal-block-vcenter"
                                                                style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div
                                                                            class="block block-rounded block-transparent mb-0">
                                                                            <div class="block-header block-header-default">
                                                                                <h3 class="block-title">Edit Attribute</h3>
                                                                                <div class="block-options">
                                                                                    <button type="button"
                                                                                        class="btn-block-option"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <i class="fa fa-fw fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <form
                                                                                action="{{ route('attribute.update', $attribute->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('PUT')

                                                                                <div class="block-content fs-sm">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="attributeName_{{ $attribute->id }}"
                                                                                            class="form-label">Attribute
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control attributeName"
                                                                                            id="attributeName_{{ $attribute->id }}"
                                                                                            value="{{ $attribute->name }}"
                                                                                            name="attribute" required>
                                                                                    </div>

                                                                                </div>
                                                                                <div
                                                                                    class="block-content block-content-full text-end bg-body">
                                                                                    <button type="submit"
                                                                                        class="btn btn-sm btn-alt-primary me-1">Update</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-sm btn-alt-secondary me-1"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Edit Modal -->

                                                        @empty

                                                            <tr>
                                                                <td colspan="2" class="text-center bg-light">No Data
                                                                    Found</td>
                                                            </tr>
                                                        @endforelse

                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="block block-rounded border border-gray-300  mb-4">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Colors List </h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row">
                                        <table class="table table-bordered table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Size</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($colors as $color)
                                                    <tr>
                                                        <td class="text-center">{{ $color->name }}</td>
                                                        <td class="text-center" style="width: 20%">
                                                            <div class="btn-group">
                                                                <a class="btn btn-sm btn-alt-secondary btn-edit"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $color->id }}"
                                                                    data-name="{{ $color->name }}" data-bs-toggle="modal"
                                                                    data-bs-target="#edit_modal_{{ $color->id }}">
                                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                                </a>


                                                                <button type="button"
                                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                                    onclick="deleteAttribute(this)"
                                                                    data-id="{{ $color->id }}">
                                                                    <i class="fa fa-fw fa-times"></i>
                                                                </button>

                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Edit Modal -->
                                                    <div class="modal" id="edit_modal_{{ $color->id }}"
                                                        tabindex="-1" aria-labelledby="modal-block-vcenter"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="block block-rounded block-transparent mb-0">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">Edit Attribute</h3>
                                                                        <div class="block-options">
                                                                            <button type="button"
                                                                                class="btn-block-option"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <i class="fa fa-fw fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('attribute.update', $color->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="block-content fs-sm">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    for="attributeName_{{ $color->id }}"
                                                                                    class="form-label">Attribute
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                    class="form-control attributeName"
                                                                                    id="attributeName_{{ $color->id }}"
                                                                                    value="{{ $color->name }}"
                                                                                    name="attribute" required>
                                                                            </div>

                                                                        </div>
                                                                        <div
                                                                            class="block-content block-content-full text-end bg-body">
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-alt-primary me-1">Update</button>
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-alt-secondary me-1"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Edit Modal -->

                                                @empty

                                                    <tr>
                                                        <td colspan="2" class="text-center bg-light">No Data
                                                            Found</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="block block-rounded border border-gray-300">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Create Attribute</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <form action="{{ route('attribute.size.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="category">Category Name</label>
                                            <select name="category_id" id="category" class="form-select">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="size">Name </label>
                                            <div id="row" class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="attribute[]"
                                                        id="size" placeholder="Enter Attribute Name" required>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-danger ms-2 remove-option DeleteRow"
                                                            type="button"><i class="fa fa-x"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="newinput"></div>
                                            <div class="d-flex justify-content-start mt-1">
                                                <button id="rowAdder" type="button"
                                                    class="btn bg-flat-lighter btn-sm mt-1">
                                                    <span class="fa-sharp fa-solid fa-plus"></span> Add More
                                                </button>
                                            </div>
                                            @error('size')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <div class="mt-5 col-lg-12">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-dark w-50">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="block block-rounded border border-gray-300">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Create Color</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <form action="{{ route('color.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="color">Name </label>
                                            <div id="row_color" class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="color[]"
                                                        id="color" placeholder="Enter Color Name" required>
                                                    <div class="input-group-prepend">
                                                        <button
                                                            class="btn btn-danger ms-2 remove-option_color DeleteRow_color"
                                                            type="button"><i class="fa fa-x"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="newinput_color"></div>
                                            <div class="d-flex justify-content-start mt-1">
                                                <button id="rowAdder_color" type="button"
                                                    class="btn bg-flat-lighter btn-sm mt-1">
                                                    <span class="fa-sharp fa-solid fa-plus"></span> Add More
                                                </button>
                                            </div>
                                            @error('size')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <div class="mt-5 col-lg-12">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-dark w-50" type="submit">Submit</button>
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
    </main>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Row add button functionality
            $("#rowAdder").click(function() {
                let newRowAdd = `
                <div class="form-group mt-2" id="row">
                    <div class="input-group">
                        <input type="text" class="form-control" name="attribute[]" placeholder="Enter Attribute Name" required>
                        <div class="input-group-prepend">
                            <button class="btn btn-danger ms-2 remove-option" type="button"><i class="fa fa-x"></i></button>
                        </div>
                    </div>
                </div>`;
                $("#newinput").append(newRowAdd);
            });

            // Row delete button functionality
            $("body").on("click", ".remove-option", function() {
                // Check if more than one input field exists
                if ($("input[name='attribute[]']").length > 1) {
                    $(this).closest("#row").remove();
                }
            });
        });


        $(document).ready(function() {
            // Row add button functionality
            $("#rowAdder_color").click(function() {
                let newRowAdd_color = `
                <div id="row_color" class="form-group mt-2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="color[]"
                            id="color" placeholder="Enter Color Name" required>
                        <div class="input-group-prepend">
                            <button class="btn btn-danger ms-2 remove-option_color DeleteRow_color"
                                type="button"><i class="fa fa-x"></i></button>
                        </div>
                    </div>
                </div>`;
                $("#newinput_color").append(newRowAdd_color);
            });

            // Row delete button functionality
            $("body").on("click", ".remove-option_color", function() {
                // Check if more than one input field exists
                if ($("input[name='color[]']").length > 1) {
                    $(this).closest("#row_color").remove();
                }
            });
        });
    </script>


    <script>
        $('#attributeTable').DataTable();

        function deleteAttribute(button) {
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

                    let url = "{{ route('attribute.destroy', ':id') }}";
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
@endpush
