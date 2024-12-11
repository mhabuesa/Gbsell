<div class="position-relative position-md-static px-md-6">
    <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0"
        id="pills-tab-8" role="tablist">
        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
            <a href="{{route('ordered.list', $shop->url)}}" class="nav-link {{Route::is('ordered.list') ? 'active': ''}}">Order List</a>
        </li>
        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
            <a href="{{route('wishlist', $shop->url)}}" class="nav-link {{Route::is('wishlist') ? 'active': ''}}">Wish List</a>
        </li>
        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
            <a href="{{route('account', $shop->url)}}" class="nav-link {{Route::is('account') ? 'active': ''}} {{Route::is('account.setting') ? 'active': ''}}">Account</a>
        </li>
    </ul>
</div>
