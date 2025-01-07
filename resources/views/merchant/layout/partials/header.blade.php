<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="">
                <p class="mt-1 mb-0">Hello, <span
                        class="fs-9 fw-bold">{{ Auth::guard('merchant')->user()->shop->name }}</span></p>
                <small
                    class="fs-9 fw-medium text-muted">{{ Auth::guard('merchant')->user()->shop->created_at->format('D j, M Y') }}</small>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::guard('merchant')->user()->photo == null)
                        <img class="rounded-circle" src="https://placehold.co/50" alt="photo" style="width: 21px;">
                    @else
                        <img class="rounded-circle" src="{{ asset(Auth::guard('merchant')->user()->photo) }}"
                            alt="photo" style="width: 21px;">
                    @endif
                    <span class="d-none d-sm-inline-block ms-2">{{ Auth::guard('merchant')->user()->name }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        @if (Auth::guard('merchant')->user()->photo == null)
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src="https://placehold.co/50"
                                alt="">
                        @else
                            <img class="img-avatar img-avatar48 img-avatar-thumb"
                                src="{{ asset(Auth::guard('merchant')->user()->photo) }}" alt="">
                        @endif
                        <p class="mt-2 mb-0 fw-medium">{{ Auth::guard('merchant')->user()->name }}</p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ route('profile.index') }}">
                            <span class="fs-sm fw-medium">Profile</span>
                        </a>
                    </div>
                    <div role="separator" class="dropdown-divider m-0"></div>
                    <div class="p-2">
                        <form method="POST" action="{{ route('signout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{ route('signout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="fs-sm fw-medium">Log Out</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="text-primary">•</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-body-light border-bottom text-center rounded-top notification-header">
                        <h5 class="dropdown-header text-uppercase">Notifications</h5>
                    </div>
                    <ul class="nav-items mb-0 notification-menu">
                        @forelse ($combinedData as $key => $data)
                            <li id="notification-{{ $data->id }}">
                                <a class="text-dark d-flex py-2"
                                    href="{{ $data->type == 'order' ? route('order.notification', $data->id) : route('review.notification', $data->id) }}">
                                    <div class="flex-shrink-0 me-2 ms-3">
                                        <i
                                            class="fa fa-fw {{ $data->type == 'order' ? 'fa-shopping-cart text-success' : 'fa-star text-primary' }}"></i>
                                    </div>
                                    <div class="flex-grow-1 pe-2">
                                        <div class="fw-semibold">You have a new <span
                                                class="text-capitalize">{{ $data->type }}</span></div>
                                        <span
                                            class="fw-medium text-muted">{{ $data->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>
                                <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                    <div class="flex-grow-1 pe-2">
                                        <div class="fw-semibold text-center">Notifications Not Available</div>
                                    </div>
                                </a>
                            </li>
                        @endforelse
                    </ul>
                    @if (count($combinedData) > 0)
                        <div id="clearBtn" class="p-2 border-top text-center clear-notification">
                            <a id="clear-notifications" class="d-inline-block fw-medium" href="javascript:void(0)">
                                <i class="fa fa-fw fa-eraser me-1 opacity-50"></i> Clear
                            </a>
                        </div>
                    @endif
                    <div id="notAvailable" class="p-2 border-top text-center clear-notification d-none">
                        <p class="d-inline-block fw-medium mb-0" >
                            Notifications Not Available
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@push('script')
    <script>
        $(document).ready(function() {
            $('#clear-notifications').click(function() {
                $.ajax({
                    url: '/clear-notifications',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('ul.nav-items li').remove();
                            $('#clearBtn').remove();
                            $('#notAvailable').removeClass('d-none');
                            showToast('Notifications cleared', 'success');
                        } else {
                            showToast('Failed to clear notifications', 'error');
                        }
                    },
                    error: function() {
                        showToast('An error occurred. Please try again', 'error');
                    }
                });
            });
        });
    </script>
@endpush
