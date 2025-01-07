<header id="page-header">
    <div class="content-header">
      <div class="d-flex align-items-center">
        <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
          <i class="fa fa-fw fa-bars"></i>
        </button>
        <button type="button" class="btn btn-sm btn-alt-secondary d-md-none" data-toggle="layout" data-action="header_search_on">
          <i class="fa fa-fw fa-search"></i>
        </button>
        <form class="d-none d-md-inline-block" action="be_pages_generic_search.html" method="POST">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
            <span class="input-group-text border-0">
              <i class="fa fa-fw fa-search"></i>
            </span>
          </div>
        </form>
      </div>
      <div class="d-flex align-items-center">
        <div class="dropdown d-inline-block ms-2">
          <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (auth()->user()->image == null)
                <img class="rounded-circle" src="https://placehold.co/50" alt="Header Avatar" style="width: 21px;">
            @else
                <img class="rounded-circle" src="{{ asset(Auth::user()->image)}}" alt="Header Avatar" style="width: 21px;">
            @endif
            <span class="d-none d-sm-inline-block ms-2">{{Auth::user()->name}}</span>
            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
            <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                @if (auth()->user()->image == null)
                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="https://placehold.co/50" alt="">
                @else
                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset(Auth::user()->image)}}" alt="">
                @endif
              <p class="mt-2 mb-0 fw-medium">{{Auth::user()->name}}</p>
              <p class="mb-0 text-muted fs-sm fw-medium">Web Developer</p>
            </div>
            <div class="p-2">
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.profile') }}">
                <span class="fs-sm fw-medium">Profile</span>
              </a>
            </div>
            <div role="separator" class="dropdown-divider m-0"></div>
            <div class="p-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="fs-sm fw-medium">Log Out</span>
                    </a>
                </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
      <div class="content-header">
        <form class="w-100" action="be_pages_generic_search.html" method="POST">
          <div class="input-group">
            <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
              <i class="fa fa-fw fa-times-circle"></i>
            </button>
            <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
          </div>
        </form>
      </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
      <div class="content-header">
        <div class="w-100 text-center">
          <i class="fa fa-fw fa-circle-notch fa-spin"></i>
        </div>
      </div>
    </div>
  </header>
