<!DOCTYPE html>
<html lang="en">

				<head>
								<meta charset="utf-8">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
								<meta name="author" content="Coderthemes">

								<!-- App favicon -->
								<link href="assets/images/favicon.ico" rel="shortcut icon">
								<!-- App title -->
								<title>APPSCYCLONE</title>

								<!-- App css -->
								<link type="text/css" href="/assets/css/bootstrap.min.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/core.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/components.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/icons.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/pages.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/menu.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/responsive.css" rel="stylesheet" />
								<link type="text/css" href="/assets/css/gCaptcha.css" rel="stylesheet" />
								<script src="https://www.google.com/recaptcha/api.js"></script>
								<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
								<!--[if lt IE 9]>
								<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
								<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
								<![endif]-->

								<script src="/assets/js/modernizr.min.js"></script>

				</head>

				<body>

								<!-- Loader -->
								<div id="preloader">
												<div id="status">
																<div class="spinner">
																				<div class="spinner-wrapper">
																								<div class="rotator">
																												<div class="inner-spin"></div>
																												<div class="inner-spin"></div>
																								</div>
																				</div>
																</div>
												</div>
								</div>

								<!-- HOME -->
								<section>
												<div class="container">
																<div class="row">
																				<div class="col-xs-12">
																								<div class="page-title-box">
																												<h4 class="page-title"><a href="/"><img
																																								src="https://appscyclone.com/_nuxt/img/logo.d04fdce.svg" alt=""></a>
																												</h4>
																												<ol class="breadcrumb m-0 p-0" style="margin-right: 50px;">
																																<li class="active">
																																				<a href="{{ route("login") }}">Log In</a>
																																</li>
																												</ol>
																												<div class="clearfix"></div>
																								</div>
																				</div>
																				@yield("content")
																</div>
												</div>

								</section>
								<!-- Site footer -->
								<footer class="site-footer">
												<div class="container">
																<div class="row">
																				<div class="col-sm-12 col-md-6">
																								<p class="text-justify">
																								<div style="margin-bottom:20px;">
																												<b style="font-size: 24px;">Are you prepared to create <br> something amazing?</b>
																								</div>
																								<p style="font-size: 16px;color:#71738B;margin-bottom:20px;">Please get in touch with us for any
																												other details you
																												may require.</p>
																								</p>
																								<button class="btn btn-inverse btn-rounded w-md waves-effect waves-light;" type="button"
																												style="margin-bottom:20px; width:170px; height:40px;font-size:16px;">Get an
																												estimate</button>
																				</div>

																				<div class="col-xs-6 col-md-3 middle-cgr">
																								<div>
																												<h6>Navigation</h6>
																												<ul class="footer-links">
																																<li><a href="http://scanfcode.com/category/c-language/">code</a></li>
																																<li><a href="http://scanfcode.com/category/front-end-development/">design</a></li>
																																<li><a href="http://scanfcode.com/category/back-end-development/">blockchain</a></li>
																																<li><a href="http://scanfcode.com/category/java-programming-language/">IoT</a></li>
																																<li><a href="http://scanfcode.com/category/android/">training</a></li>

																												</ul>
																								</div>
																				</div>

																				<div class="col-xs-6 col-md-3 middle-cgr">
																								<div>
																												<h6>Head Office</h6>
																												<ul class="footer-links">
																																<li style="word-wrap: break-word;width: 136px;">
																																				<a href="http://scanfcode.com/about/">168/6 Bui Thi Xuan Street
																																								Ward 3
																																								Tan Binh District
																																								Ho Chi Minh City
																																								Vietnam
																																				</a>
																																</li>
																												</ul>
																								</div>
																				</div>
																</div>
												</div>
												<div class="container">
																<div class="row">
																				<div class="col-md-8 col-sm-6 col-xs-12">
																								<div class="logo-appcyclone">
																												<img src="https://appscyclone.com/_nuxt/img/logo.d04fdce.svg" alt="">
																												<p class="copyright-text">Copyright &copy; 2023. All rights reserved.
																																<a href="#">Scanfcode</a>.
																												</p>
																								</div>
																				</div>

																				<div class="col-md-4 col-sm-6 col-xs-12">
																								<ul class="social-icons">
																												<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
																												<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
																												<li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
																												<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
																								</ul>
																				</div>
																</div>
												</div>
								</footer>
								<script>
												var resizefunc = [];
								</script>

								<!-- jQuery  -->
								<script src="/assets/js/jquery.min.js"></script>
								<script src="/assets/js/bootstrap.min.js"></script>
								<script src="/assets/js/detect.js"></script>
								<script src="/assets/js/fastclick.js"></script>
								<script src="/assets/js/jquery.blockUI.js"></script>
								<script src="/assets/js/waves.js"></script>
								<script src="/assets/js/jquery.slimscroll.js"></script>
								<script src="/assets/js/jquery.scrollTo.min.js"></script>

								<!-- App js -->
								<script src="/assets/js/jquery.core.js"></script>
								<script src="/assets/js/jquery.app.js"></script>
								@stack("scripts")
				</body>

</html>
