<!doctype html>
<html class="no-js" lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>BY - @yield('title', trans('home.title'))</title>
	    <meta name="description" content="">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
	    <link rel="stylesheet" href="{{ asset('fonts/et-lineicons/css/style.css') }}">
	    <link rel="stylesheet" href="{{ asset('fonts/linea-font/css/linea-font.css') }}">
	    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/font-awesome.min.css') }}">
	    <link rel="stylesheet" href="{{ asset('css/vendor/slick.css') }}">
	    <link rel="stylesheet" href="{{ asset('css/vendor/magnific-popup.css') }}">
	    <link rel="stylesheet" href="{{ asset('css/vendor/animate.css') }}">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
        @section('head')
        @show
	    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
	</head>
	<body id="page-top">
		<div id="app">
			@if(Session::has('reset_password_success'))
				<div class="alert alert-success alert-dismissible flash_home">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Votre mot de passe à bien été modifié
				</div>
			@endif
		    <!--[if lt IE 8]>
		    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
		        <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		    <![endif]-->
		    @section('navbar')
		        <nav class="navbar navbar-default navbar-static-top mega">
            @show
	            <div class="container">
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('img/logo_noir_fond_transparent.png') }}" alt="BY - Logo"></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
                        <div v-cloak>
    	                    <ul class="nav navbar-nav navbar-right">
								<li>
									<a href="{{ route('bookings.index') }}"><i class="fa fa-sign-out"></i> {{ trans('home.booking') }}
									</a>
								</li>
    	                        @if(Auth::check())
    	                            <li>
    	                                <a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> {{ trans('auth.logout') }}
    	                                </a>
    	                            </li>
    	                        @else
    	                            <li>
    	                                <a href="{{ route('login-form') }}"><i class="fa fa-sign-in"></i> {{ trans('auth.connection') }}
    	                                </a>
    	                            </li>
    	                    	@endif
                                <li class="dropdown cart-nav">
    	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span v-if="products.length > 0" class="cart-notif">@{{ total.products }}</span>
    	                                <i class="fa fa-shopping-cart"></i> {{ trans('cart.title') }}</a>
    	                            <ul class="dropdown-menu cart-dropdown">
    	                                <li class="dropdown-header">{{ trans('cart.title') }}</li>
    	                                <li role="separator" class="divider cart-sep-top"></li>
    	                                <li v-for="(product, key) in products">
    	                                    <div class="cart-item">
    	                                        <a href="shop/shop-single.html"><img src="http://placehold.it/56x56" v-bind:alt="product.name" class="p-thumb"></a>
    	                                        <a v-on:click.prevent="removeFromCart(key)" href="#" class="cart-remove-btn"><span class="linea-arrows-square-remove"></span></a>
    	                                        <a href="shop/shop-single.html" class="cp-name">@{{ product.name }}</a>
    	                                        <p class="cp-price">@{{ product.quantity }} x @{{ product.price }} €</p>
    	                                    </div>
    	                                </li>
    	                                <li role="separator" class="divider cart-sep-bot"></li>
    	                                <li>
    	                                    <h6 class="item-totals">Total: <span>@{{ total.price.toFixed(2) }} €</span></h6>
    	                                </li>
    	                            </ul>
                                </li>
                            </ul>
                        </div>
	                </div>
	            </div>
	        </nav>
		    @yield('content')
			<footer class="footer-litle">
				<div class="gray-bg">
					<address>
						<ul>
							<li>
								<span class="linea-basic-paperplane adr-icon"></span>
								<div class="adr-group">
									<span class="adr-heading">Email</span>
									<span class="adr-info">contact@by-halal.fr</span>
								</div>
							</li>
						</ul>
					</address>
				</div>
				<div class="dark-bg">
					<div class="container footer-social-links">
						<div class="row">
							<ul>
								<li><a href="https://www.facebook.com/byhalalFR/" target="_blank">facebook</a></li>
								<li><a href="https://www.instagram.com/by_livraisonhalal/" target="_blank">instagram</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<small>&copy; 2017 Made by <a class="no-style-link" href="http://www.pixelsass.fr" target="_blank">PixelSass</a></small>
							</div>
							<div class="col-md-6">
								<small><a href="#page-top" class="pull-right to-the-top">Haut de page<i class="fa fa-angle-up"></i></a></small>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<script src="{{ asset('js/vendor/jquery-2.1.4.min.js') }}"></script>
		<script src="{{ asset('js/vendor/google-fonts.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.easing.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.waypoints.min.js') }}"></script>
		<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/vendor/bootstrap-hover-dropdown.min.js') }}"></script>
		<script src="{{ asset('js/vendor/smoothscroll.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.localScroll.min.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.scrollTo.min.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.parallax.js') }}"></script>
		<script src="{{ asset('js/vendor/slick.min.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.easypiechart.min.js') }}"></script>
		<script src="{{ asset('js/vendor/isotope.min.js') }}"></script>
		<script src="{{ asset('js/vendor/countup.min.js') }}"></script>
		<script src="{{ asset('js/vendor/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('js/vendor/wow.min.js') }}"></script>
		<script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
		<script src="{{ asset('js/laroute.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		<script src="{{ asset('js/booking.js') }}"></script>
		<script>
		    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
		</script>
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        @section('scripts')
        
        @show
		<script src="{{ asset('js/app.js') }}"></script>
	</body>
</html>
