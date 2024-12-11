<div class="col-md-5 col-xl-3 ">
    <div id="one-inbox-side-nav" class="d-md-block push">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h6 class="block-title">Orders</h6>
        </div>
        <div class="block-content">
          <ul class="nav nav-pills flex-column push">

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('order.index') ? 'active': ''}}" href="{{route('order.index')}}">
                <span class="fs-sm">
                    <i class="fa-solid fa-cart-plus me-1 fa-lg"></i>New Order List
                </span>
              </a>
            </li>

            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('order.deliver') ? 'active': ''}}" href="{{route('order.deliver')}}">
                <span class="fs-sm">
                    <i class="fa-solid fa-truck fa-lg"></i> Order in Deliver
                </span>
              </a>
            </li>
            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('order.complate') ? 'active': ''}}" href="{{route('order.complate')}}">
                <span class="fs-sm">
                    <i class="fa-solid fa-car-on fa-lg me-1"></i> Order Complate
                </span>
              </a>
            </li>
            <li class="nav-item my-1">
              <a class="nav-link d-flex justify-content-between align-items-center {{Route::is('order.cancelled') ? 'bg-danger text-white': ''}}" href="{{route('order.cancelled')}}" style="color: rgb(235, 17, 17);">
                <span class="fs-sm">
                    <i class="fa-solid fa-rectangle-xmark fa-lg me-1"></i> Order Cancel
                </span>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
