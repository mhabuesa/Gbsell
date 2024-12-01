<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header">
        <a class="fw-semibold text-dual" href="{{route('dashboard')}}">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">GBSell</span>
        </a>
        <div>
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                data-action="dark_mode_toggle">
                <i class="far fa-moon"></i>
            </button>
            <div class="dropdown d-inline-block ms-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-brush"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                    aria-labelledby="sidebar-themes-dropdown">
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light"
                        href="javascript:void(0)">
                        <span>Sidebar Light</span>
                    </a>
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark"
                        href="javascript:void(0)">
                        <span>Sidebar Dark</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light"
                        href="javascript:void(0)">
                        <span>Header Light</span>
                    </a>
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark"
                        href="javascript:void(0)">
                        <span>Header Dark</span>
                    </a>
                </div>
            </div>
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{Route::is('dashboard') ? 'active': ''}}" href="{{route('dashboard')}}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-heading">Shop Info</li>
                <li class="nav-main-item {{Route::is('shop.*') ? 'open': ''}} {{Route::is('payment.*') ? 'open': ''}} {{Route::is('sms.*') ? 'open': ''}} {{Route::is('delivery.*') ? 'open': ''}} {{Route::is('chat.*') ? 'open': ''}} {{Route::is('user.*') ? 'open': ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa-solid fa-shop"></i>
                        <span class="nav-main-link-name">Shop</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('shop.index') ? 'active' : '' }}" href="{{route('shop.index')}}">
                                <span class="nav-main-link-name">Shop Info</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('payment.index') ? 'active' : '' }}" href="{{route('payment.index')}}">
                                <span class="nav-main-link-name">PaymentGetway</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('sms.index') ? 'active' : '' }}" href="{{route('sms.index')}}">
                                <span class="nav-main-link-name">SMS System Configure</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('delivery.index') ? 'active' : '' }}" href="{{route('delivery.index')}}">
                                <span class="nav-main-link-name">Delivery System Configure</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('chat.index') ? 'active' : '' }}" href="{{route('chat.index')}}">
                                <span class="nav-main-link-name">Chat Support</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('user.*') ? 'active' : '' }}" href="{{route('user.index')}}">
                                <span class="nav-main-link-name">User & Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">Product Info</li>
                <li class="nav-main-item {{Route::is('product.*') ? 'open': ''}} {{Route::is('category.*') ? 'open': ''}} {{Route::is('attribute.*') ? 'open': ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa-solid fa-box-open"></i>
                        <span class="nav-main-link-name">Products</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('product.*') ? 'active' : '' }}" href="{{route('product.index')}}">
                                <span class="nav-main-link-name">Products</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is('category.*') ? 'active': ''}}" href="{{route('category.index')}}">
                                <span class="nav-main-link-name">Category</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('attribute.*') ? 'active' : '' }}" href="{{route('attribute.index')}}">
                                <span class="nav-main-link-name"> Attributes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{Route::is('coupon.*') ? 'active': ''}}" href="{{route('coupon.index')}}">
                        <i class="nav-main-link-icon fa-solid fa-ticket"></i>
                        <span class="nav-main-link-name">Coupon</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{Route::is('front.*') ? 'active': ''}}" href="{{route('front.banner.image')}}">
                        <i class="nav-main-link-icon fa-solid fa-ticket"></i>
                        <span class="nav-main-link-name">Frontend Customize</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
