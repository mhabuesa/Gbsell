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
    <link rel="shortcut icon" href="/assets/favicon.png">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap"
        rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendor/font-awesome/css/fontawesome-all.min.css">
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
                                    class="border-0 navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0 target-of-invoker-has-unfolds"
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
                                                        <!-- Home Section -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;" role="button"
                                                                data-toggle="collapse" aria-expanded="false"
                                                                aria-controls="headerSidebarHomeCollapse"
                                                                data-target="#headerSidebarHomeCollapse">
                                                                Home & Static Pages
                                                            </a>

                                                            <div id="headerSidebarHomeCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarHomeMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- Home - v1 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="index.html">Home v1</a></li>
                                                                    <!-- End Home - v1 -->
                                                                    <!-- Home - v2 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v2.html">Home v2</a></li>
                                                                    <!-- End Home - v2 -->
                                                                    <!-- Home - v3 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v3.html">Home v3</a></li>
                                                                    <!-- End Home - v3 -->
                                                                    <!-- Home - v3-full-color-bg -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v3-full-color-bg.html">Home
                                                                            v3.1</a></li>
                                                                    <!-- End Home - v3-full-color-bg -->
                                                                    <!-- Home - v4 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v4.html">Home v4</a></li>
                                                                    <!-- End Home - v4 -->
                                                                    <!-- Home - v5 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v5.html">Home v5</a></li>
                                                                    <!-- End Home - v5 -->
                                                                    <!-- Home - v6 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v6.html">Home v6</a></li>
                                                                    <!-- End Home - v6 -->
                                                                    <!-- Home - v7 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="home-v7.html">Home v7</a></li>
                                                                    <!-- End Home - v7 -->
                                                                    <!-- About -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="about.html">About</a></li>
                                                                    <!-- End About -->
                                                                    <!-- Contact v1 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="contact-v1.html">Contact v1</a></li>
                                                                    <!-- End Contact v1 -->
                                                                    <!-- Contact v2 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="contact-v2.html">Contact v2</a></li>
                                                                    <!-- End Contact v2 -->
                                                                    <!-- FAQ -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="faq.html">FAQ</a></li>
                                                                    <!-- End FAQ -->
                                                                    <!-- Store Directory -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="store-directory.html">Store
                                                                            Directory</a></li>
                                                                    <!-- End Store Directory -->
                                                                    <!-- Terms and Conditions -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="terms-and-conditions.html">Terms and
                                                                            Conditions</a></li>
                                                                    <!-- End Terms and Conditions -->
                                                                    <!-- 404 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="404.html">404</a></li>
                                                                    <!-- End 404 -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Home Section -->

                                                        <!-- Shop Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;"
                                                                data-target="#headerSidebarPagesCollapse"
                                                                role="button" data-toggle="collapse"
                                                                aria-expanded="false"
                                                                aria-controls="headerSidebarPagesCollapse">
                                                                Shop Pages
                                                            </a>

                                                            <div id="headerSidebarPagesCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarPagesMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- Shop Grid -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-grid.html">Shop
                                                                            Grid</a></li>
                                                                    <!-- End Shop Grid -->

                                                                    <!-- Shop Grid Extended -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-grid-extended.html">Shop
                                                                            Grid Extended</a></li>
                                                                    <!-- End Shop Grid Extended -->

                                                                    <!-- Shop List View -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-list-view.html">Shop
                                                                            List View</a></li>
                                                                    <!-- End Shop List View -->

                                                                    <!-- Shop List View Small -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-list-view-small.html">Shop
                                                                            List View Small</a></li>
                                                                    <!-- End Shop List View Small -->

                                                                    <!-- Shop Left Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-left-sidebar.html">Shop
                                                                            Left Sidebar</a></li>
                                                                    <!-- End Shop Left Sidebar -->

                                                                    <!-- Shop Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-full-width.html">Shop
                                                                            Full width</a></li>
                                                                    <!-- End Shop Full width -->

                                                                    <!-- Shop Right Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-right-sidebar.html">Shop
                                                                            Right Sidebar</a></li>
                                                                    <!-- End Shop Right Sidebar -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Shop Pages -->

                                                        <!-- Product Categories -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;"
                                                                data-target="#headerSidebarBlogCollapse"
                                                                role="button" data-toggle="collapse"
                                                                aria-expanded="false"
                                                                aria-controls="headerSidebarBlogCollapse">
                                                                Product Categories
                                                            </a>

                                                            <div id="headerSidebarBlogCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarBlogMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- 4 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-4-column-sidebar.html">4
                                                                            Column Sidebar</a></li>
                                                                    <!-- End 4 Column Sidebar -->

                                                                    <!-- 5 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">5
                                                                            Column Sidebar</a></li>
                                                                    <!-- End 5 Column Sidebar -->

                                                                    <!-- 6 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-6-column-full-width.html">6
                                                                            Column Full width</a></li>
                                                                    <!-- End 6 Column Full width -->

                                                                    <!-- 7 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-7-column-full-width.html">7
                                                                            Column Full width</a></li>
                                                                    <!-- End 7 Column Full width -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Product Categories -->

                                                        <!-- Single Product Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;"
                                                                data-target="#headerSidebarShopCollapse"
                                                                role="button" data-toggle="collapse"
                                                                aria-expanded="false"
                                                                aria-controls="headerSidebarShopCollapse">
                                                                Single Product Pages
                                                            </a>

                                                            <div id="headerSidebarShopCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarShopMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- Single Product Extended -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-extended.html">Single
                                                                            Product Extended</a></li>
                                                                    <!-- End Single Product Extended -->

                                                                    <!-- Single Product Fullwidth -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-fullwidth.html">Single
                                                                            Product Fullwidth</a></li>
                                                                    <!-- End Single Product Fullwidth -->

                                                                    <!-- Single Product Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/single-product-sidebar.html">Single
                                                                            Product Sidebar</a></li>
                                                                    <!-- End Single Product Sidebar -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Single Product Pages -->

                                                        <!-- Ecommerce Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;"
                                                                data-target="#headerSidebarDemosCollapse"
                                                                role="button" data-toggle="collapse"
                                                                aria-expanded="false"
                                                                aria-controls="headerSidebarDemosCollapse">
                                                                Ecommerce Pages
                                                            </a>

                                                            <div id="headerSidebarDemosCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarDemosMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- Shop -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop.html">Shop</a>
                                                                    </li>
                                                                    <!-- End Shop -->

                                                                    <!-- Cart -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/cart.html">Cart</a>
                                                                    </li>
                                                                    <!-- End Cart -->

                                                                    <!-- Checkout -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/checkout.html">Checkout</a>
                                                                    </li>
                                                                    <!-- End Checkout -->

                                                                    <!-- My Account -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/my-account.html">My
                                                                            Account</a></li>
                                                                    <!-- End My Account -->

                                                                    <!-- Track your Order -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/track-your-order.html">Track
                                                                            your Order</a></li>
                                                                    <!-- End Track your Order -->

                                                                    <!-- Compare -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/compare.html">Compare</a>
                                                                    </li>
                                                                    <!-- End Compare -->

                                                                    <!-- wishlist -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html">wishlist</a>
                                                                    </li>
                                                                    <!-- End wishlist -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Ecommerce Pages -->

                                                        <!-- Shop Columns -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;"
                                                                data-target="#headerSidebardocsCollapse"
                                                                role="button" data-toggle="collapse"
                                                                aria-expanded="false"
                                                                aria-controls="headerSidebardocsCollapse">
                                                                Shop Columns
                                                            </a>

                                                            <div id="headerSidebardocsCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebardocsMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- 7 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-7-columns-full-width.html">7
                                                                            Column Full width</a></li>
                                                                    <!-- End 7 Column Full width -->

                                                                    <!-- 6 Column Full width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-6-columns-full-width.html">6
                                                                            Column Full width</a></li>
                                                                    <!-- End 6 Column Full width -->

                                                                    <!-- 5 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-5-columns-sidebar.html">5
                                                                            Column Sidebar</a></li>
                                                                    <!-- End 5 Column Sidebar -->

                                                                    <!-- 4 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-4-columns-sidebar.html">4
                                                                            Column Sidebar</a></li>
                                                                    <!-- End 4 Column Sidebar -->

                                                                    <!-- 3 Column Sidebar -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/shop-3-columns-sidebar.html">3
                                                                            Column Sidebar</a></li>
                                                                    <!-- End 3 Column Sidebar -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Shop Columns -->

                                                        <!-- Blog Pages -->
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                href="javascript:;"
                                                                data-target="#headerSidebarblogsCollapse"
                                                                role="button" data-toggle="collapse"
                                                                aria-expanded="false"
                                                                aria-controls="headerSidebarblogsCollapse">
                                                                Blog Pages
                                                            </a>

                                                            <div id="headerSidebarblogsCollapse" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="headerSidebarblogsMenu"
                                                                    class="u-header-collapse__nav-list">
                                                                    <!-- Blog v1 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v1.html">Blog
                                                                            v1</a></li>
                                                                    <!-- End Blog v1 -->

                                                                    <!-- Blog v2 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v2.html">Blog
                                                                            v2</a></li>
                                                                    <!-- End Blog v2 -->

                                                                    <!-- Blog v3 -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-v3.html">Blog
                                                                            v3</a></li>
                                                                    <!-- End Blog v3 -->

                                                                    <!-- Blog Full Width -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/blog/blog-full-width.html">Blog
                                                                            Full Width</a></li>
                                                                    <!-- End Blog Full Width -->

                                                                    <!-- Single Blog Post -->
                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                            href="https://transvelo.github.io/electro-html/2.0/html/blog/single-blog-post.html">Single
                                                                            Blog Post</a></li>
                                                                    <!-- End Single Blog Post -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <!-- End Blog Pages -->
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
                            <form class="js-focus-state">
                                <label class="sr-only" for="searchproduct">Search</label>
                                <div class="input-group">
                                    <input type="email"
                                        class="form-control py-2 pl-5 font-size-15 border-right-0 height-42 border-width-0 rounded-left-pill border-primary"
                                        name="email" id="searchproduct-item" placeholder="Search for Products"
                                        aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                    <div class="input-group-append">

                                        <button class="btn btn-dark height-42 py-2 px-3 rounded-right-pill"
                                            type="button" id="searchProduct1">
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
                                            <form class="js-focus-state input-group px-3">
                                                <input class="form-control" type="search"
                                                    placeholder="Search Product">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary px-3" type="button"><i
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
                        <div class="col-md-auto d-none d-xl-block align-self-center">
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
                                                            @foreach ($categories as $category)
                                                                <li class="nav-item u-header__nav-item"
                                                                    data-event="hover" data-position="left">
                                                                    <a href="{{ route('category.product', ['slug' => $category->slug, 'shopUrl' => $shop->url]) }}"
                                                                        class="nav-link u-header__nav-link font-weight-bold">{{ $category->name }}</a>
                                                                </li>
                                                            @endforeach
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
                                        <li class="nav-item u-header__nav-item">
                                            <a class="nav-link u-header__nav-link" href="#"
                                                aria-haspopup="true" aria-expanded="false"
                                                aria-labelledby="pagesSubMenu">Featured Brands</a>
                                        </li>
                                        <li class="nav-item u-header__nav-last-item">
                                            <a class="text-gray-90 bg-dark text-white p-2 font-weight-bold rounded coursor-pointer"
                                                href="{{ route('signup') }}" target="_blank">
                                                Become a Seller
                                            </a>
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
                                    <img class="u-header__navbar-brand-default" width="200" src="{{ asset($shop->logo) }}"
                                        alt="Logo">
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
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="#">
                                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="#">
                                        <span class="fab fa-google btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="#">
                                        <span class="fab fa-twitter btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="#">
                                        <span class="fab fa-github btn-icon__inner"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-12 col-md mb-4 mb-md-0">
                                <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                                <!-- List Group -->
                                <ul
                                    class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Laptops
                                            & Computers</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Cameras
                                            & Photography</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Smart
                                            Phones & Tablets</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Video
                                            Games & Consoles</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">TV
                                            & Audio</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Gadgets</a>
                                    </li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Car
                                            Electronic & GPS</a></li>
                                </ul>
                                <!-- End List Group -->
                            </div>

                            <div class="col-12 col-md mb-4 mb-md-0">
                                <!-- List Group -->
                                <ul
                                    class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent mt-md-6">
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Printers
                                            & Ink</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Software</a>
                                    </li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Office
                                            Supplies</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Computer
                                            Components</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/product-categories-5-column-sidebar.html">Accesories</a>
                                    </li>
                                </ul>
                                <!-- End List Group -->
                            </div>

                            <div class="col-12 col-md mb-4 mb-md-0">
                                <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                                <!-- List Group -->
                                <ul
                                    class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/my-account.html">My
                                            Account</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/track-your-order.html">Order
                                            Tracking</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="https://transvelo.github.io/electro-html/2.0/html/shop/wishlist.html">Wish
                                            List</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="terms-and-conditions.html">Customer Service</a></li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="terms-and-conditions.html">Returns / Exchange</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="faq.html">FAQs</a>
                                    </li>
                                    <li><a class="list-group-item list-group-item-action"
                                            href="terms-and-conditions.html">Product Support</a></li>
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
                        All
                        rights Reserved</div>
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
                <a class="nav-link" href="#"><i class="fas fa-home fa-lg"></i><br>Home</a>
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
                                    <img class="u-header__navbar-brand-default" width="100" src="{{ asset($shop->logo) }}"
                                        alt="Logo">
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
