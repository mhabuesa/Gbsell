@push('title')
    <title>Banner Items | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets') }}/css/oneui.min-5.9.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content">
        <div class="row">
            @include('merchant.frontend_customize.menu')
            <div class="col-md-7 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Add Banner Item</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="fullscreen_toggle"></button>
                                </div>
                            </div>
                            <div class="block-content py-0">
                                <div class="pull-x">
                                    <div class="block block-rounded">
                                        <div class="block-content block-content-full">
                                            <form action="{{ route('banner.item.create') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="title">Title</label>
                                                            <input type="text" class="form-control w-100" name="title"
                                                                id="title" required>
                                                            @error('title')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="subtitle">SubTitle</label>
                                                            <input type="text" class="form-control w-100" name="subtitle"
                                                                id="subtitle" required>
                                                            @error('subtitle')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label for="shop_city" class="form-label"> Product </label>
                                                            <select class="js-select2 form-select"
                                                                id="one-ecom-product-category" name="product_id"
                                                                data-placeholder="Choose one.." required>
                                                                <option></option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}">{{ $product->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('product_id')
                                                                <small class="text-danger px-2">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Banner Item List</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="fullscreen_toggle"></button>
                                </div>
                            </div>
                            <div class="block-content py-0">
                                <div class="pull-x">
                                    <div class="block block-rounded">
                                        <div class="block-content block-content-full">
                                            <table class="table table-vcenter" id="bannerTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Subtitle</th>
                                                        <th>Product</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($banners as $banner)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $banner->title }}</td>
                                                            <td>{{ $banner->subtitle }}</td>
                                                            <td>{{ $banner->product->name }}</td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        {{ $banner->status == 1 ? 'checked' : '' }}
                                                                        name="status" data-id="{{ $banner->id }}"
                                                                        data-status="{{ $banner->status }}"
                                                                        onchange="updateBannerStatus(this)">
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                                        href="{{ route('front.banner.item.edit', $banner->id) }}">
                                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                                        onclick="deleteBanner(this)"
                                                                        data-id="{{ $banner->id }}">
                                                                        <i class="fa fa-fw fa-times"></i>
                                                                    </button>

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
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets') }}/js/plugins/select2/js/select2.full.min.js"></script>
    <script>
        One.helpersOnLoad(['jq-select2', 'jq-maxlength']);
    </script>

    <script>
        $('#bannerTable').DataTable();

        function deleteBanner(button) {
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

                    let url = "{{ route('front.banner.item.delete', ':id') }}";
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

        function updateBannerStatus(element) {
            Swal.fire({
                title: "Are you sure?",
                text: "Will you change Banner status?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    updateBannerStatusAjax(element);
                } else {
                    element.checked = !element.checked;
                }
            })
        }

        function updateBannerStatusAjax(element) {
            const id = $(element).data('id');
            let url = "{{ route('banner.status.update', ':id') }}";
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
