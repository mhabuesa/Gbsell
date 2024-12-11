<div class="col-md-5 col-xl-3">
    <div id="one-inbox-side-nav" class="d-md-block push">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h6 class="block-title">Frontend Customize</h6>
        </div>
        <div class="block-content">
          <ul class="nav nav-pills flex-column push">

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('front.banner.image') ? 'active': ''}}" href="{{route('front.banner.image')}}">
                <span class="fs-sm">
                  <i class="fa fa-image me-1 opacity-50"></i> Banner Image
                </span>
              </a>
            </li>

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('front.banner.item') ? 'active': ''}}" href="{{route('front.banner.item')}}">
                <span class="fs-sm">
                  <i class="fa fa-image me-1 opacity-50"></i> Banner Item
                </span>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
