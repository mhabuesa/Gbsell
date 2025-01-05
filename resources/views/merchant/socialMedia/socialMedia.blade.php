@push('title')
    <title>Social Media Setup | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <div class="content content-boxed">
        <div class="row">
            <div class="col-lg-8">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Social Media List</h3>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-sm table-vcenter" id="userTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th style="width: 60px;">Icon</th>
                                        <th>Link</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mediaLinks as $key => $media)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                            <td class="fw-semibold fs-sm">
                                                <i class="{{ $media->icon }} fa-lg"></i>
                                            </td>
                                            <td class="fw-semibold fs-sm">
                                                {{ $media->link }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#inventory_modal_{{ $media->id }}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                        data-bs-toggle="tooltip" aria-label="Remove Client"
                                                        data-bs-original-title="Remove Client" onclick="deleteUser(this)"
                                                        data-id="{{ $media->id }}">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Social Update Modal Start --}}
                                        <div class="modal" id="inventory_modal_{{ $media->id }}" tabindex="-1"
                                            aria-labelledby="inventory_modal_{{ $media->id }}" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-rounded">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">Social Link Update</h3>
                                                        </div>
                                                        <div class="block-content block-content-full overflow-x-auto">
                                                            <form action="{{ route('socialMedia.update', $media->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="mb-2">
                                                                    <label class="form-label fs-sm mb-0">Social Link</label>
                                                                    <input type="text" class="form-control"
                                                                        name="link" value="{{ $media->link }}">
                                                                </div>

                                                                <div class="col-12 col-md-12 mt-5">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-primary w-100"
                                                                        data-bs-dismiss="modal">Update</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                        {{-- Inventory Update Modal End --}}
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Data Found</td>
                        </tr>
                        @endforelse

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Social Link Add</h3>
                </div>
                <div class="block-content">
                    <form action="{{ route('socialMedia.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="social_media" class="form-label">Social Media</label>
                            <select name="social_media" id="social_media" class="form-select"
                                onchange="updateIconAndValue()" required>
                                <option value="facebook" data-icon="fa-facebook-f">Facebook</option>
                                <option value="twitter" data-icon="fa-twitter">Twitter</option>
                                <option value="instagram" data-icon="fa-instagram">Instagram</option>
                                <option value="youtube" data-icon="fa-youtube">Youtube</option>
                                <option value="pinterest" data-icon="fa-pinterest">Pinterest</option>
                                <option value="tiktok" data-icon="fa-tiktok">Tiktok</option>
                            </select>
                            @error('social_media')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="link" class="form-label">Social Link</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i id="social-icon" class="fa-brands fa-facebook-f"></i>
                                </span>
                                <input type="text" class="form-control" id="link" name="link" required>

                                @error('link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <input type="text" class="form-control" id="icon" name="icon"
                            value="fa-brands fa-facebook-f" hidden>



                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
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

                    let url = "{{ route('socialMedia.delete', ':id') }}";
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
            let url = "{{ route('user.status.update', ':id') }}";
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
    <script>
        function updateIconAndValue() {
            const socialMediaSelect = document.getElementById('social_media');
            const selectedOption = socialMediaSelect.options[socialMediaSelect.selectedIndex];
            const iconClass = selectedOption.getAttribute('data-icon');
            const socialIcon = document.getElementById('social-icon');
            const iconInput = document.getElementById('icon');

            // Update the icon class
            socialIcon.className = `fa-brands ${iconClass}`;

            // Set the value of the hidden input field
            iconInput.value = `fa-brands ${iconClass}`;
        }
    </script>
@endpush
