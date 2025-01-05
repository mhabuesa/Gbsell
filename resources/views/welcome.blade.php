<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Home | Gaibandhasell @if (Auth::guard('merchant')->check())

        | {{ Auth::guard('merchant')->user()->name }}

        @endif</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="gaibandhasell.com">

		<link rel="stylesheet" href="{{asset('frontend')}}/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/style.css">
		<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/utilities.css">

		<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/custom.css">

		<link rel="stylesheet" href="{{asset('frontend')}}/assets/vendor/fullPage.js/dist/jquery.fullpage.min.css" type="text/css">
		<link rel="stylesheet" href="{{asset('frontend')}}/assets/vendor/slick/slick.min.css" type="text/css">
		<link rel="stylesheet" href="{{asset('frontend')}}/assets/vendor/vegas/vegas.min.css" type="text/css">
		<link rel="stylesheet" href="{{asset('frontend')}}/assets/vendor/fontawesome/css/all.min.css" type="text/css">
		<link rel="stylesheet" href="{{asset('frontend')}}/assets/vendor/themify-icons/css/themify-icons.css" type="text/css">

		<link href="../../css?family=Montserrat:200,300,400,500,700%7CMRoboto:300,400,500,700" rel="stylesheet">

		<link rel="shortcut icon" href="{{asset('frontend')}}/assets/images/favicon.ico">

	</head>
	<body>

		<div id="preloader" class="preloader preloader-dark">
			<div class="loader-status">
				<div class="circle-side"></div>
			</div>
		</div>

		<!-- Global Overlay -->
		<div class="global-overlay shadow-9">
			<div class="overlay-inner bg-image-holder bg-cover zoom-animation">
				<img src="{{asset('frontend')}}/assets/images/image-3.jpg" alt="background">
			</div>
			<div class="overlay-inner bg-black opacity-75"></div>
		</div>

		<!-- Frame -->
		<div class="frame d-none d-lg-block">
			<div class="frame-left"></div>
			<div class="frame-right"></div>
			<div class="frame-top"></div>
			<div class="frame-bottom"></div>
		</div>

		<div class="site-container">

			<!-- Site Header -->
			<header class="site-header header-fixed">
				<div class="overlay d-xl-none">
					<div class="overlay-inner bg-dark opacity-95"></div>
				</div>
				<nav class="navbar navbar-expand-xl navbar-dark">
					<!-- Logo -->
					<a href="#" class="navbar-brand logo">
						<img src="{{asset('frontend')}}/assets/images/logo.png" width="50" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#site-navbar" aria-controls="siteNavbar" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
					</button>
					<div class="collapse navbar-collapse" id="site-navbar">
						<ul id="navigation" class="navbar-nav ml-auto">
							<li data-menuanchor="home" class="nav-item">
								<a href="#home" class="nav-link">Home</a>
							</li>
							<li data-menuanchor="subscribe" class="nav-item">
								<a href="#subscribe" class="nav-link">Subscribe</a>
							</li>
							<li class="nav-item">
                                @if (Auth::guard('merchant')->check())
                                <a href="{{route('merchant.dashboard')}}" class="nav-link badge badge-primary rounded py-2 px-2 text-uppercase text-white bg-success fs-12">Dashboard</a>
                                @else
								<a href="{{route('signin')}}" class="nav-link badge badge-primary rounded py-2 px-2 text-uppercase text-white bg-success fs-12">Signin</a>
                                @endif
							</li>
						</ul>
					</div>
				</nav>
			</header>

			<!-- Button - Back to Top -->
			<button type="button" class="back-to-top">
				<i class="fas fa-angle-up"></i>
			</button>

			<!-- Page Content - Fullpage -->
			<div class="oli-fullpage">

				<section class="oli-section d-flex min-vh--100" data-anchor="home" data-tooltip="Home">
					<div class="container align-self-center text-center text-white">
						<h2 class="mb-3">Coming soon</h2>
						<h3 class="mb-3">We bulid Multivendor E-commerce Solutions.</h3>
						<h1 class="mb-5">Gaibandhasell</h1>
						<a href="#subscribe" class="btn btn-outline-white rounded-0 scrollto">Notify Me</a>
					</div>
				</section>

				<section class="oli-section d-flex min-vh-lg--100" data-anchor="subscribe" data-tooltip="Subscribe">
					<div class="container align-self-center text-white">
						<div class="row mb-5">
							<div class="col-12 col-lg-9 mx-lg-auto text-center">
								<h2 class="mb-3">Get our latest content in your inbox</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-lg-5 mx-lg-auto">
								<div class="subscribe-form">
									<form class="mb-0" id="sf" name="sf" action="include/subscribe.php" method="post" autocomplete="off">
										<div class="row">

											<div class="form-process"></div>

											<div class="col-12">
												<div class="form-group text-white mb-0">
													<input type="email" id="sf-email" name="sf-email" placeholder="Enter Your Email Address" class="form-control rounded-0 border--transparent required">
												</div>
											</div>

											<div class="col-12 d-none">
												<input type="text" id="sf-botcheck" name="sf-botcheck" value="" class="form-control">
											</div>

											<div class="col-12">
												<button class="btn btn-primary rounded-0 btn-block" type="submit" id="sf-submit" name="sf-submit">Notify Me</button>
											</div>

										</div>
									</form>
									<div class="subscribe-form-result"></div>
								</div>
							</div>
						</div>
					</div>
				</section>

			</div>

			<!-- Site Footer -->
			<footer class="site-footer footer-fixed footer-mobile-dark footer-light">
				<div class="container-fluid d-md-flex align-items-md-center justify-content-md-between">
					<nav class="social-nav social-nav-pinned">
						<ul>
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#"><i class="fab fa-pinterest"></i></a></li>
						</ul>
					</nav>
					<p class="mb-2 mb-xl-0">© 2024 Gaibandha Sell - All Rights Reserved</p>
					<nav class="usefull-nav">
						<ul>
							<li><a href="#">Terms of Service</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</nav>
				</div>
			</footer>

		</div>

		<script src="{{asset('frontend')}}/assets/vendor/jquery/dist/jquery.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/fullPage.js/dist/scrolloverflow.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/fullPage.js/dist/jquery.fullpage.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/jquery-form/dist/jquery.form.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/jQuery.countdown/dist/jquery.countdown.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/granim.js/dist/granim.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/slick/slick.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/vegas/vegas.min.js"></script>
		<script src="{{asset('frontend')}}/assets/vendor/jquery.mb.YTPlayer/jquery.mb.YTPlayer.min.js"></script>

		<script src="{{asset('frontend')}}/assets/js/main.js"></script>

	</body>
</html>
