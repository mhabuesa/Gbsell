@push('title')
    <title>Coupon List | GBSell - eCommerce Solution </title>
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
                    <h3 class="block-title">New Review List </h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-sm table-vcenter table-bordered table-striped" id="newReviewTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th style="width: 150px;">Product</th>
                                    <th style="width: 150px;">Rating</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Review</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($new_reviews as $key => $review)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                        <td class="fw-semibold fs-sm">
                                            <a href="{{ route('shop.product', ['slug' => $review->product->slug, 'shopUrl' => $shopUrl]) }}"
                                                target="_blank">
                                                {{ strlen($review->product->name) > 20 ? substr($review->product->name, 0, 20) . '...' : $review->product->name }}
                                            </a>
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->rating }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->name }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->email }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->review }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <form id="reviewApprove{{ $review->id }}" method="POST"
                                                    action="{{ route('review.approve', ['id' => $review->id]) }}">
                                                  @csrf
                                                  <a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                     data-id="{{ $review->id }}" onclick="confirmApprove(this)"
                                                     href="javascript:void(0)">
                                                      <i class="fa fa-fw fa-check"></i>
                                                  </a>
                                              </form>


                                                <button type="button"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    onclick="deleteNewReview(this)" data-id="{{ $review->id }}">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Approved Review List</h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-sm table-vcenter table-bordered table-striped" id="reviewTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th style="width: 150px;">Product</th>
                                    <th style="width: 150px;">Rating</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="d-none d-sm-table-cell" style="width: 15%;">Review</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($approved_reviews as $key => $review)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                        <td class="fw-semibold fs-sm">
                                            <a href="{{ route('shop.product', ['slug' => $review->product->slug, 'shopUrl' => $shopUrl]) }}"
                                                target="_blank">
                                                {{ strlen($review->product->name) > 20 ? substr($review->product->name, 0, 20) . '...' : $review->product->name }}
                                            </a>
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->rating }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->name }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->email }}
                                        </td>
                                        <td class="fw-semibold fs-sm">
                                            {{ $review->review }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    onclick="deleteReview(this)" data-id="{{ $review->id }}">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found</td>
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
        $('#newReviewTable').DataTable();

        function deleteNewReview(button) {
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

                    let url = "{{ route('review.destroy', ':id') }}";
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
        $('#reviewTable').DataTable();

        function deleteReview(button) {
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

                    let url = "{{ route('review.destroy', ':id') }}";
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
    function confirmApprove(element) {
        const reviewId = element.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to approve this review?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if user clicks "Yes"
                document.getElementById('reviewApprove' + reviewId).submit();
            }
        });
    }
</script>
@endpush
