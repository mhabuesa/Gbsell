<div class="col-md-5 col-xl-3">
    <div id="one-inbox-side-nav" class="d-md-block push">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h6 class="block-title">Home Page Customize</h6>
        </div>
        <div class="block-content">
          <ul class="nav nav-pills flex-column push">

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('admin.home.favicon') ? 'active': ''}}" href="{{route('admin.home.favicon')}}">
                <span class="fs-sm">
                  <i class="fa-brands fa-pied-piper me-1 fa-lg"></i> Favicon
                </span>
              </a>
            </li>

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('admin.home.logo') ? 'active': ''}}" href="{{route('admin.home.logo')}}">
                <span class="fs-sm">
                    <i class="fa-brands fa-slack me-1 fa-lg"></i> Logo
                </span>
              </a>
            </li>

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('admin.home.info') ? 'active': ''}}" href="{{route('admin.home.info')}}">
                <span class="fs-sm">
                    <i class="fa-solid fa-circle-info me-1 fa-lg"></i> Info
                </span>
              </a>
            </li>

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('admin.home.social') ? 'active': ''}}" href="{{route('admin.home.social')}}">
                <span class="fs-sm">
                    <i class="fa-solid fa-envelope me-1 fa-lg"></i> Social Media
                </span>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
