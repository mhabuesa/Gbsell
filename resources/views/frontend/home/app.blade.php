<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>GBSell | eCommerce Solution </title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset($info->favicon) }}">

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
    @stack('style')
</head>

<body>

    <!-- ========== HEADER ========== -->
    <header id="header" class="u-header u-header-left-aligned-nav border-bottom border-color-1">
        <div class="u-header__section">
            <!-- Topbar -->
            <div class="u-header-topbar py-2 d-none d-xl-block">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <div class="topbar-left">
                            <ul class="list-inline mb-0">
                                @if ($info->phone)
                                    <li
                                        class="list-inline-item u-header-topbar__nav-item u-header-topbar__nav-item-no-border mr-0">
                                        <a href="tel:{{ $info->phone }}}" class="u-header-topbar__nav-link"><i
                                                class="ec ec-phone text-primary mr-1"></i>{{ $info->phone }}</a>
                                    </li>
                                @endif
                                @if ($info->email)
                                    <li
                                        class="list-inline-item u-header-topbar__nav-item u-header-topbar__nav-item-no-border border-right pe-2">
                                        <a href="mailto:{{ $info->email }}}" class="u-header-topbar__nav-link"><i
                                                class="ec ec-mail text-primary mr-1"></i> {{ $info->email }}</a>
                                    </li>
                                @endif
                                @if ($info->facebook)
                                    <li
                                        class="list-inline-item u-header-topbar__nav-item u-header-topbar__nav-item-no-border m-0">
                                        <a class="btn font-size-15 btn-icon" style="height: 0px"
                                            href="{{ $info->facebook }}" target="_blank">
                                            <span class="fab fa-facebook-f btn-icon__inner"></span>
                                        </a>
                                    </li>
                                @endif
                                @if ($info->twitter)
                                    <li
                                        class="list-inline-item u-header-topbar__nav-item u-header-topbar__nav-item-no-border m-0">
                                        <a class="btn font-size-15 btn-icon" style="height: 0px"
                                            href="{{ $info->twitter }}" target="_blank">
                                            <span class="fab fa-twitter btn-icon__inner"></span>
                                        </a>
                                    </li>
                                @endif
                                @if ($info->instagram)
                                    <li
                                        class="list-inline-item u-header-topbar__nav-item u-header-topbar__nav-item-no-border m-0">
                                        <a class="btn font-size-15 btn-icon" style="height: 0px"
                                            href="{{ $info->instagram }}" target="_blank">
                                            <span class="fab fa-instagram btn-icon__inner"></span>
                                        </a>
                                    </li>
                                @endif
                                @if ($info->youtube)
                                    <li
                                        class="list-inline-item u-header-topbar__nav-item u-header-topbar__nav-item-no-border m-0">
                                        <a class="btn font-size-15 btn-icon" style="height: 0px"
                                            href="{{ $info->youtube }}" target="_blank">
                                            <span class="fab fa-youtube btn-icon__inner"></span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="topbar-right ml-auto">
                            <ul class="list-inline mb-0">
                                <li
                                    class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <a href="{{ route('order.track') }}" class="u-header-topbar__nav-link"><i
                                            class="ec ec-transport mr-1"></i> Track
                                        Your Order</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Topbar -->

            <!-- Logo-Search-header-icons -->
            <div class="py-2 py-xl-3 bg-success bg-xl-transparent">
                <div class="container">
                    <div class="row my-0dot5 my-xl-0 align-items-center position-relative">
                        <!-- Logo-offcanvas-menu -->
                        <div class="col-6 col-xl-2">
                            <!-- Nav -->
                            <nav class="navbar navbar-expand u-header__navbar py-0">
                                <!-- Fullscreen Toggle Button -->
                                <button id="sidebarHeaderInvoker" type="button"
                                    class="navbar-toggler d-block d-xl-none btn u-hamburger mr-3"
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

                                <!-- Logo -->
                                <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center mr-0"
                                    href="{{ route('index') }}">
                                    @if ($info->logo)
                                        <img class="u-header__navbar-brand-default" src="{{ asset($info->logo) }}"
                                            alt="Logo">
                                    @else
                                        <span class="smini-hide fs-5 tracking-wider">GBSell</span>
                                    @endif
                                </a>
                                <!-- End Logo -->
                            </nav>
                            <!-- End Nav -->

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
                                                    data-unfold-animation-out="fadeOutLeft"
                                                    data-unfold-duration="500">
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
                                                        href="{{ route('index') }}" aria-label="Electro">
                                                        <span class="fs-5 tracking-wider text-dark">GBSell</span>
                                                    </a>
                                                    <!-- End Logo -->

                                                    <!-- List -->
                                                    <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                        <li class="u-header-collapse__submenu">
                                                            <a href="{{ route('order.track') }}"
                                                                class="u-header-topbar__nav-link"><i
                                                                    class="ec ec-transport mr-1"></i> Track
                                                                Your Order</a>
                                                        </li>
                                                        <li class="u-header-collapse__submenu mt-3">
                                                            <a class="bg-success text-white p-2 font-weight-bold rounded coursor-pointer"
                                                                href="{{ route('signup') }}">Become a Seller</a>
                                                        </li>
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
                        <div class="col-7 pl-0 d-none d-xl-block">
                            <form class="js-focus-state" action="{{ route('searchAll') }}">
                                <label class="sr-only" for="searchproduct">Search</label>
                                <div class="input-group">
                                    <input type="search"
                                        class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary"
                                        name="q" id="searchproduct-item"
                                        placeholder="Search for Shop or Product" aria-label="Search for products"
                                        aria-describedby="searchProduct1" value="{{ request('q') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill"
                                            type="submit" id="searchProduct1">
                                            <span class="ec ec-search font-size-24"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Search Bar -->
                        <!-- Secondary Menu -->
                        <div class="col-3 d-none d-xl-block d-flex">
                            <div class="secondary-menu v1">
                                <!-- Nav -->
                                <nav
                                    class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space position-static">
                                    <!-- Navigation -->
                                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                        <ul class="navbar-nav u-header__navbar-nav justify-content-end">
                                            <!-- Featured Brands -->
                                            <li class="nav-item u-header__nav-item">
                                                <a class="bg-success text-white p-2 font-weight-bold rounded coursor-pointer"
                                                    href="{{ route('signup') }}">Become a Seller</a>
                                            </li>
                                            <!-- End Featured Brands -->
                                        </ul>
                                    </div>
                                    <!-- End Navigation -->
                                </nav>
                                <!-- End Nav -->
                            </div>
                        </div>
                        <!-- End Secondary Menu -->
                        <!-- Header Icons -->
                        <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                            <div class="d-inline-flex">
                                <ul class="d-flex list-unstyled mb-0">
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
                                                action="{{ route('searchAll') }}" method="GET">
                                                <input class="form-control" type="search"
                                                    placeholder="Search Shop or Product" name="q"
                                                    value="{{ request()->q }}" aria-label="Search Shop or Product">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success px-3" type="submit"><i
                                                            class="font-size-18 ec ec-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Input -->
                                    </li>
                                    <!-- End Search -->
                                </ul>
                            </div>
                        </div>
                        <!-- End Header Icons -->
                    </div>
                </div>
            </div>
            <!-- End Logo-Search-header-icons -->
        </div>
    </header>
    <!-- ========== END HEADER ========== -->

    @yield('content')

    <!-- ========== FOOTER ========== -->
    <footer>
        <!-- Footer-bottom-widgets -->

        <!-- End Footer-bottom-widgets -->
        <!-- Footer-copy-right -->
        <div class="bg-gray-14 py-2">
            <div class="container">
                <div class="flex-center-between d-block d-md-flex">
                    <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">GBSell</a> -
                        All rights Reserved</div>
                    <div class="text-md-right">
                        <span class="d-inline-block border rounded p-1">
                            Crafted with <i class="fa fa-heart text-danger font-weight-bold"></i> by <a
                                class="font-weight-bold text-blue" href="https://devhunter.dev" target="_blank">Dev
                                Hunter</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer-copy-right -->
    </footer>
    <!-- ========== END FOOTER ========== -->
    <!-- ========== END SECONDARY CONTENTS ========== -->

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
    <script src="{{ asset('frontend') }}/assets/vendor/svg-injector/dist/svg-injector.min.js"></script>
    <script
        src="{{ asset('frontend') }}/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/typed.js/lib/typed.min.js"></script>
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
    <script src="{{ asset('frontend') }}/assets/js/components/hs.svg-injector.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.go-to.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/components/hs.selectpicker.js"></script>

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
</body>

</html>
