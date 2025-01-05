<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>{{ $shop->name }} | eCommerce Solution </title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    @if ($shop->favicon)
        <link rel="shortcut icon" href="{{ asset($shop->favicon) }}">
    @else
        <link rel="shortcut icon" href="{{ asset('frontend') }}/assets/images/favicon.png">
    @endif
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap"
        rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/font-electro.css">

    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendor/hs-megamenu/src/hs.megamenu.css">
    <link rel="stylesheet"
        href="{{ asset('frontend') }}/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendor/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendor/slick-carousel/slick/slick.css">
    <link rel="stylesheet"
        href="{{ asset('frontend') }}/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/theme.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/custom.css">

    <!-- Extra CSS Libraries -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- Cookies --}}
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

    @stack('style')
    <style>
        @media (min-width: 1200px) {
            .hide-on-large {
                display: none !important;
            }
        }

        .whatsapp {
            display: inline-block;
            position: fixed;
            bottom: 65px;
            right: 12px;
            z-index: 100;
            transition: 0.3s ease-out;
            cursor: pointer;
        }

        @media (max-width: 1200px) {
            .whatsapp {
                display: inline-block;
                position: fixed;
                bottom: 130px;
                right: 12px;
                z-index: 100;
                transition: 0.3s ease-out;
                cursor: pointer;
            }
        }
    </style>
</head>

<body>

    <!-- ========== HEADER ========== -->
    <header id="header" class="u-header u-header-left-aligned-nav mb-4">
        <div class="u-header__section">
            <!-- Logo-Search-header-icons -->
            <div class="bg-primary">
                <div class="container">
                    <div class="row min-height-64 align-items-center position-relative">
                        <!-- Logo-offcanvas-menu -->
                        <div class="col-auto">
                            <div class="d-flex justify-content-space-between">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0 max-width-200 min-width-200">
                                    <!-- Logo -->
                                    <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center"
                                        href="{{ route('home', $shop->url) }}" aria-label="{{ $shop->name }}">
                                        @if ($shop->logo)
                                            <img class="u-header__navbar-brand-default" src="{{ asset($shop->logo) }}"
                                                alt="Logo">
                                        @else
                                            <h2 class="me-4 fw-bold fs-6">{{ $shop->name }}</h2>
                                        @endif
                                    </a>
                                    <!-- End Logo -->
                                </nav>
                                <!-- End Nav -->

                                <!-- Fullscreen Toggle Button -->
                                <button id="sidebarHeaderInvokerMenu" type="button"
                                    class="border-0 navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0 target-of-invoker-has-unfolds hide-on-large"
                                    aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false"
                                    data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                                    data-unfold-duration="500">
                                    <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                        <span class="u-hamburger__inner"></span>
                                    </span>
                                </button>
                                <!-- End Fullscreen Toggle Button -->
                            </div>

                            <!-- ========== HEADER SIDEBAR ========== -->
                            <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left"
                                aria-labelledby="sidebarHeaderInvokerMenu">
                                <div class="u-sidebar__scroller">
                                    <div class="u-sidebar__container">
                                        <div class="u-header-sidebar__footer-offset pb-0">
                                            <!-- Toggle Button -->
                                            <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                                <button type="button" class="close ml-auto"
                                                    aria-controls="sidebarHeader" aria-haspopup="true"
                                                    aria-expanded="false" data-unfold-event="click"
                                                    data-unfold-hide-on-scroll="false"
                                                    data-unfold-target="#sidebarHeader1"
                                                    data-unfold-type="css-animation"
                                                    data-unfold-animation-in="fadeInLeft"
                                                    data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                                    <span aria-hidden="true"><i
                                                            class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                                </button>
                                            </div>
                                            <!-- End Toggle Button -->

                                            <!-- Content -->
                                            <div class="js-scrollbar u-sidebar__body">
                                                <div id="headerSidebarContent"
                                                    class="u-sidebar__content u-header-sidebar__content">
                                                    <!-- Logo -->
                                                    <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical"
                                                        href="{{ route('home', $shop->url) }}"
                                                        aria-label="{{ $shop->name }}">
                                                        @if ($shop->logo)
                                                            <img class="u-header__navbar-brand-default"
                                                                src="{{ asset($shop->logo) }}" alt="Logo">
                                                        @else
                                                            <h2 class="me-4 fw-bold">{{ $shop->name }}</h2>
                                                        @endif
                                                    </a>
                                                    <!-- End Logo -->

                                                    <!-- List -->
                                                    <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                        <li class="u-has-submenu u-header-collapse__submenu mb-2">
                                                            <a class="nav-link u-header__nav-link border p-2 font-weight-bold rounded coursor-pointer"
                                                                href="{{ route('track', $shop->url) }}">
                                                                Track Orders
                                                            </a>
                                                        </li>

                                                        <li class="u-has-submenu u-header-collapse__submenu mb-2">
                                                            <a class="nav-link u-header__nav-link bg-success text-white p-2 font-weight-bold rounded coursor-pointer"
                                                                href="{{ route('signup') }}">
                                                                Become a Seller
                                                            </a>
                                                        </li>

                                                        @if (Auth::guard('customer')->check())
                                                            <li class="u-has-submenu u-header-collapse__submenu mb-2">
                                                                <a class="nav-link u-header__nav-link bg-danger text-white p-2 font-weight-bold rounded coursor-pointer"
                                                                    href="{{ route('customer.logout', ['shopUrl' => $shop->url]) }}">
                                                                    Sign Out
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="u-has-submenu u-header-collapse__submenu mb-2">
                                                                <a class="nav-link u-header__nav-link bg-primary p-2 font-weight-bold rounded coursor-pointer"
                                                                    href="{{ route('customer.auth', $shop->url) }}">
                                                                    Sign In
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                    <!-- End List -->
                                                </div>
                                            </div>
                                            <!-- End Content -->
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <!-- ========== END HEADER SIDEBAR ========== -->
                        </div>
                        <!-- End Logo-offcanvas-menu -->
                        <!-- Search Bar -->
                        <div class="mx-3 col d-none d-xl-block">
                            <form class="js-focus-state" action="{{ route('search', $shop->url) }}" method="GET">
                                <label class="sr-only" for="searchproduct">Search</label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control py-2 pl-5 font-size-15 border-right-0 height-42 border-width-0 rounded-left-pill border-primary"
                                        name="q" id="searchproduct-item" placeholder="Search for Products"
                                        aria-label="Search for Products" aria-describedby="searchProduct"
                                        value="{{ request()->q }}" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-dark height-42 py-2 px-3 rounded-right-pill"
                                            type="submit" id="searchProduct">
                                            <span class="ec ec-search font-size-20"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Search Bar -->
                        <!-- Header Icons -->
                        <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                            <div class="d-inline-flex">
                                <ul class="d-flex list-unstyled mb-0 align-items-center">
                                    <!-- Search -->
                                    <li class="col d-xl-none px-2 px-sm-3 position-static">
                                        <a id="searchClassicInvoker"
                                            class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary"
                                            href="javascript:;" role="button" data-toggle="tooltip"
                                            data-placement="top" title="Search" aria-controls="searchClassic"
                                            aria-haspopup="true" aria-expanded="false"
                                            data-unfold-target="#searchClassic" data-unfold-type="css-animation"
                                            data-unfold-duration="300" data-unfold-delay="300"
                                            data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                            data-unfold-animation-out="fadeOut">
                                            <span class="ec ec-search"></span>
                                        </a>

                                        <!-- Input -->
                                        <div id="searchClassic"
                                            class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2"
                                            aria-labelledby="searchClassicInvoker">
                                            <form class="js-focus-state input-group px-3"
                                                action="{{ route('search', $shop->url) }}" method="GET">
                                                <input class="form-control" type="search"
                                                    placeholder="Search Product" name="q"
                                                    value="{{ request()->q }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary px-3" type="submit"><i
                                                            class="font-size-18 ec ec-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Input -->
                                    </li>
                                    <!-- End Search -->

                                    <li class="col d-none d-xl-block"><a href="{{ route('wishlist', $shop->url) }}"
                                            class="text-gray-90" data-toggle="tooltip" data-placement="top"
                                            title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                    <li class="col d-none d-xl-block px-2 px-sm-3">
                                        @if (Auth::guard('customer')->check())
                                            <a href="{{ route('ordered.list', $shop->url) }}" class="text-gray-90"
                                                data-toggle="tooltip" data-placement="top" title="Dashboard">
                                                <i class="font-size-22 ec ec-user"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('customer.auth', $shop->url) }}" class="text-gray-90"
                                                data-toggle="tooltip" data-placement="top" title="Login or Register">
                                                <i class="font-size-22 ec ec-user"></i>
                                            </a>
                                        @endif

                                    </li>
                                    <li class="col pr-xl-0 px-2 px-sm-3">
                                        <a href="{{ route('cart', $shop->url) }}"
                                            class="text-gray-90 position-relative d-flex " data-toggle="tooltip"
                                            data-placement="top" title="Cart">
                                            <i class="font-size-22 ec ec-shopping-bag"></i>
                                            <span
                                                class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">{{ $totalProducts }}</span>
                                            <span
                                                class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">৳{{ $totalPrice }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Header Icons -->
                    </div>
                </div>
            </div>
            <!-- End Logo-Search-header-icons -->

            <!-- Vertical-and-secondary-menu -->
            <div class="box-shadow-1 d-none d-xl-block">
                <div class="container">
                    <div class="row">
                        <!-- Vertical Menu -->
                        <div class="col-md-1 d-none d-xl-block align-self-center me-4">
                            <div class="max-width-200 min-width-200">
                                <!-- Basics Accordion -->
                                <div id="basicsAccordion">
                                    <!-- Card -->
                                    <div class="card border-0">
                                        <div class="card-header card-collapse btn-remove-bg-hover border-0"
                                            id="basicsHeadingOne">
                                            <button type="button"
                                                class="btn-link btn-remove-bg-hover btn-block d-flex card-btn pyc-10 text-lh-1 pl-0 pr-4 shadow-none btn-primary bg-transparent rounded-top-lg border-0 font-weight-bold text-gray-90"
                                                data-toggle="collapse" data-target="#basicsCollapseOne"
                                                aria-expanded="true" aria-controls="basicsCollapseOne">
                                                <span class="text-gray-90">All Categories</span>
                                                <span class="ml-2 text-gray-90">
                                                    <span class="ec ec-arrow-down-search"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <div id="basicsCollapseOne" class="collapse vertical-menu v2"
                                            aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion">
                                            <div class="card-body p-0">
                                                <nav
                                                    class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                                    <div id="navBar"
                                                        class="collapse navbar-collapse u-header__navbar-collapse">
                                                        <ul class="navbar-nav u-header__navbar-nav border-top-primary">
                                                            @forelse ($categories as $category)
                                                                <li class="nav-item u-header__nav-item"
                                                                    data-event="hover" data-position="left">
                                                                    <a href="{{ route('category.product', ['slug' => $category->slug, 'shopUrl' => $shop->url]) }}"
                                                                        class="nav-link u-header__nav-link font-weight-bold">{{ $category->name }}</a>
                                                                </li>
                                                            @empty
                                                                <li class="nav-item u-header__nav-item"
                                                                    data-event="hover" data-position="left">
                                                                    <a href="javascript:void(0)"
                                                                        class="nav-link u-header__nav-link font-weight-bold">No
                                                                        Category</a>
                                                                </li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                                <!-- End Basics Accordion -->
                            </div>
                        </div>
                        <!-- End Vertical Menu -->
                        <!-- Secondary Menu -->
                        <div class="col secondary-menu">

                            <!-- Nav -->
                            <nav
                                class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                    <ul class="navbar-nav u-header__navbar-nav">
                                        <li class="nav-item u-header__nav-item mr-1 my-1">
                                            <a class="nav-link u-header__nav-link border p-2 font-weight-bold rounded coursor-pointer"
                                                href="{{ route('track', $shop->url) }}" aria-haspopup="true"
                                                aria-expanded="false" aria-labelledby="pagesSubMenu"><i
                                                    class="ec ec-transport mr-1 fs-5"></i>Track Orders</a>
                                        </li>

                                        <li class="nav-item u-header__nav-last-item mr-1 my-1">
                                            <a class="nav-link u-header__nav-link bg-success text-white p-2 font-weight-bold rounded coursor-pointer"
                                                href="{{ route('signup') }}" aria-haspopup="true"
                                                aria-expanded="false" aria-labelledby="pagesSubMenu">Become a
                                                Seller</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- End Nav -->
                        </div>
                        <!-- End Secondary Menu -->
                    </div>
                </div>
            </div>
            <!-- End Vertical-and-secondary-menu -->
        </div>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    @yield('content')
    <!-- ========== END MAIN CONTENT ========== -->

    {{-- @php
        $social = $shop->social()->firstOrget();
    @endphp --}}
    <!-- ========== FOOTER ========== -->
    <footer>
        <!-- Footer-bottom-widgets -->
        <div class="pt-8 pb-4 bg-gray-13">
            <div class="container mt-1">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="mb-6">
                            <a href="{{ route('home', $shop->url) }}" class="d-inline-block">
                                @if ($shop->logo)
                                    <img class="u-header__navbar-brand-default" width="200"
                                        src="{{ asset($shop->logo) }}" alt="Logo">
                                @else
                                    <h2 class="me-4 fw-bold fs-6">{{ $shop->name }}</h2>
                                @endif
                            </a>
                        </div>
                        <div class="mb-4">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <i class="ec ec-support text-primary font-size-56"></i>
                                </div>
                                <div class="col pl-3">
                                    <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                    <a href="tel:+80080018588"
                                        class="font-size-20 text-gray-90">{{ $shop->phone }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-1 font-weight-bold">Contact info</h6>
                            <address class="">
                                {{ $shop->address }}
                            </address>
                        </div>
                        <div class="my-4 my-md-4">
                            <ul class="list-inline mb-0 opacity-7">
                                @foreach ($shop->social()->get() as $social)
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                            href="{{ $social->link }}" target="_blank">
                                            <span class="{{ $social->icon }} btn-icon__inner"></span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            @if ($categories->count() > 0)
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Top Categories</h6>
                                    <!-- First 6 Categories -->
                                    <ul
                                        class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        @foreach ($categories->slice(0, 6) as $category)
                                            <li>
                                                <a class="list-group-item list-group-item-action text-capitalize"
                                                    href="{{ route('category.product', [$shop->url, $category->slug]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if ($categories->count() > 6)
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">More Categories</h6>
                                    <!-- Remaining Categories -->
                                    <ul
                                        class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        @foreach ($categories->slice(6) as $category)
                                            <li>
                                                <a class="list-group-item list-group-item-action text-capitalize"
                                                    href="{{ route('category.product', [$shop->url, $category->slug]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-12 col-md mb-4 mb-md-0">
                                <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                                <!-- List Group -->
                                <ul
                                    class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                    <li><a class="list-group-item list-group-item-action"
                                            href="{{ route('account', $shop->url) }}">My
                                            Account</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="{{ route('track', $shop->url) }}">Order
                                            Tracking</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="{{ route('wishlist', $shop->url) }}">Wish
                                            List</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="{{ route('cart', $shop->url) }}">Cart</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="{{ route('checkout', ['shopUrl' => $shop->url, 'coupon_code' => Session::get('coupon_code') ?? 0]) }}">Checkout</a>
                                    </li>

                                </ul>
                                <!-- End List Group -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer-bottom-widgets -->
        <!-- Footer-copy-right -->
        <div class="bg-gray-14 py-2">
            <div class="container">
                <div class="flex-center-between d-block d-md-flex">
                    <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">GBSELL</a> -
                        All rights Reserved</div>
                    <div class="text-md-right">
                        <span class="d-inline-block border rounded p-1">
                            Crafted with <i class="fa fa-heart text-danger font-weight-bold"></i> by <a class="font-weight-bold text-blue"
                                href="https://devhunter.dev" target="_blank">Dev Hunter</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer-copy-right -->
    </footer>
    <!-- ========== END FOOTER ========== -->
    <!-- ========== END SECONDARY CONTENTS ========== -->


    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <div class="d-flex justify-content-around align-items-center w-100">
            <div class="nav-item">
                <a class="nav-link" href="{{ route('home', $shop->url) }}"><i
                        class="fas fa-home fa-lg"></i><br>Home</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    <i class="fas fa-layer-group fa-lg"></i><br>Category
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('account', $shop->url) }}"><i
                        class="font-size-22 ec ec-user fa-lg"></i><br>Account</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('wishlist', $shop->url) }}"><i
                        class="font-size-22 ec ec-favorites fa-lg"></i><br>Wishlist</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('cart', $shop->url) }}"><i
                        class="fas fa-shopping-cart fa-lg"></i><br>Cart</a>
            </div>
        </div>
    </nav>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="u-sidebar__scroller">
            <div class="u-sidebar__container">
                <div class="u-header-sidebar__footer-offset pb-0">
                    <!-- Toggle Button -->
                    <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <!-- End Toggle Button -->

                    <!-- Content -->
                    <div class="js-scrollbar u-sidebar__body">
                        <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                            <!-- Logo -->
                            <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical"
                                href="{{ route('home', $shop->url) }}" aria-label="{{ $shop->name }}">
                                @if ($shop->logo)
                                    <img class="u-header__navbar-brand-default" width="100"
                                        src="{{ asset($shop->logo) }}" alt="Logo">
                                @else
                                    <h2 class="me-4 fw-bold">{{ $shop->name }}</h2>
                                @endif
                            </a>
                            <!-- End Logo -->

                            <!-- List -->
                            <ul id="headerSidebarList" class="u-header-collapse__nav">
                                <!-- Category Section Start -->
                                @forelse ($categories as $key => $category)
                                    <li class="u-has-submenu u-header-collapse__submenu">
                                        <a class="u-header-collapse__nav-link"
                                            href="{{ route('category.product', ['slug' => $category->slug, 'shopUrl' => $shop->url]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li class="u-has-submenu u-header-collapse__submenu">
                                        <span class="u-header-collapse__nav-link fw-bold">No Category</span>
                                    </li>
                                @endforelse
                                <!-- Category Section End -->
                            </ul>
                            <!-- End List -->
                        </div>
                    </div>
                    <!-- End Content -->
                </div>
            </div>
        </div>
    </div>

    @php
        $whatsapp = App\Models\ChatConfig::where('shop_id', $shop->shop_id)
            ->where('status', '1')
            ->first();
    @endphp

    @if ($whatsapp?->phone != null && $whatsapp?->message != null)
        <a href="https://wa.me/{{ $whatsapp?->phone }}?text={{ $whatsapp?->message }}" class="whatsapp"
            target="_blank">
            <img src="{{ asset('frontend') }}/assets/images/whatsapp.png" width="60" alt="">
        </a>
    @endif

    <!-- Go to Top -->
    <a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed"
        data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp"
        data-hide-effect="slideOutDown">
        <span class="fas fa-arrow-up u-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <!-- JS Global Compulsory -->
    <script src="{{ asset('frontend') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/bootstrap/bootstrap.min.js"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ asset('frontend') }}/assets/vendor/appear.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
    <script
        src="{{ asset('frontend') }}/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/slick-carousel/slick/slick.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- JS Electro -->
    <script src="{{ asset('frontend') }}/assets/js/hs.core.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.countdown.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.header.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.hamburgers.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.unfold.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.focus-state.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.malihu-scrollbar.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.validation.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.fancybox.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.onscroll-animation.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.slick-carousel.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.show-animation.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.go-to.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.selectpicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>




    <!-- JS Plugins Init. -->
    <script>
        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });
        });

        $(document).on('ready', function() {
            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function() {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function() {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();

                var target = $(this).data('target');

                if ($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');
        });
    </script>

    <!-- Extra JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Ajax setup
        const csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf
            }
        });


        // Toast
        function showToast(text, type = 'success') {
            let bg;
            switch (type) {
                case 'error':
                    from = '#ff5b5c';
                    to = '#ff5b5c';
                    break;
                case 'success':
                    from = '#00b09b';
                    to = '#96c93d';
                    break;
                default:
                    from = '#00b09b';
                    to = '#96c93d';
                    break;
            }
            console.log(type, bg);

            Toastify({
                text,
                duration: 5000,
                gravity: "top",
                position: "right",
                close: true,
                stopOnFocus: true,
                style: {
                    background: `linear-gradient(to right, ${from}, ${to})`
                },
                onClick: function() {}
            }).showToast();
        }
    </script>

    @if (session('success'))
        <script>
            showToast('{{ session('success') }}', 'success');
        </script>
    @endif

    @if (session('error'))
        <script>
            showToast('{{ session('error') }}', 'error');
        </script>
    @endif



    @stack('script')
</body>

</html>
