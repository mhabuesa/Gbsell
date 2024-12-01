@push('title')
    <title>User List | GBSell - eCommerce Solution </title>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/dropzone/min/dropzone.min.css">
@endpush
@extends('merchant.layout.app')
@section('content')
    <main id="main-container">
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Users & Permission Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i>
                                Add User</a>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-sm table-vcenter" id="userTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th style="width: 150px;">Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user )

                                    <tr>
                                        <th class="text-center" scope="row">{{$key+1}}</th>
                                        <td class="fw-semibold fs-sm">
                                            @if ($user->photo == null)
                                                <img src="{{asset('assets')}}/media/photos/img.png" width="40" alt="">
                                            @else
                                                <img src="{{asset($user->photo)}}" width="40" class="img-avatar" style="width: 40px; height: 40px"  alt="Photo">
                                            @endif
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $user->name }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $user->email }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">
                                                @if ($user->permission == '2')
                                                    Admin
                                                @elseif ($user->permission == '3')
                                                    Moderator
                                                @elseif ($user->permission == '4')
                                                    Editor
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    {{ $user->status == 1 ? 'checked' : '' }} name="status"
                                                    data-id="{{ $user->id }}" data-status="{{ $user->status }}"
                                                    onchange="updateUserStatus(this)">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" href="{{ route('user.edit', $user->id) }}" >
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" aria-label="Remove Client"
                                                    data-bs-original-title="Remove Client" onclick="deleteUser(this)"
                                                    data-id="{{ $user->id }}">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>


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
    </main>
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

                let url = "{{ route('user.delete', ':id') }}";
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
@endpush
