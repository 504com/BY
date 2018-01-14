@extends('themes.definity')

@section('title', trans('home.title'))

@section('navbar')
	<nav class="navbar navbar-default navbar-fixed-top mega navbar-trans">
@endsection

@section('content')
    <div id="home" class="fw-slider-hero">
        <div class="fw-slider">
            <div class="fw-slider-item fw-slide-1">
                <div class="bg-overlay">
                    <div class="hero-content-wrapper">
                        <div class="hero-content">
                            <h1 class="hero-lead wow fadeInUp" data-wow-duration="2s">{{ $contents->blurb }}</h1>
                            <h4 class="h-alt hero-subheading wow fadeIn" data-wow-delay=".5s" data-wow-duration="1.5s">{{ $contents->subBlurb }}</h4>
                            <form class="form-inline text-center" id="search_location">
                                <div class="form-group geo-input">
                                    <div id="geolocation" class="btn btn-light btn-small by-color">
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </div>
                                    <input size="50" name="address" id="address" type="text" class="form-control" placeholder="Quelle est votre adresse ?">
									<button id="search" class="btn btn-light btn-round btn-small by-color"><i class="fa fa-search fa-2x"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <section class="container ft-steps-numbers">
            <div class="row by-section">

                <header class="sec-heading ws-s">
                    <h2>{{ $contents->catchPhrase1 }}</h2>
                </header>
                <div class="col-lg-4 col-md-6 mb-sm-100 ft-item mb-sm-100 ft-item wow fadeIn" data-wow-duration="1s">
                    <span class="ft-nbr">01</span>
                    <h4>{{ $contents->title_1 }}</h4>
                    <p>{{ $contents->text_1 }}</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-sm-100 ft-item mb-sm-100 ft-item wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                    <span class="ft-nbr">02</span>
                    <h4>{{ $contents->title_2 }}</h4>
                    <p>{{ $contents->text_2 }}</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-sm-100 ft-item mb-sm-100 ft-item wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                    <span class="ft-nbr">03</span>
                    <h4>{{ $contents->title_3 }}</h4>
                    <p>{{ $contents->text_3 }}</p>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="row">
                <header class="text-center ws-s">
                    <h2>{{ $contents->catchPhrase2 }}</h2>
                </header>
                @foreach($ranked as $restaurant)
                    <div class="col-lg-4 col-md-6 ws-s">
                        <div class="client-item">
                            <a href="{{ route('restaurants.show', ['slug' => $restaurant->slug]) }}"><img class="img-responsive picThumbnail" src="{{ asset('img/restaurants/'.$restaurant->picture) }}" alt="{{ $restaurant->name }}"></a>
                            <div class="item-content">
                                <h6>{{ $restaurant->name }}</h6>
                                <p>{{ $restaurant->flash }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="container">
            <div class="row">
                <header class="text-center ws-s">
                    <h2>{{ $contents->catchPhrase3 }}</h2>
                </header>
                @foreach($recent as $restaurant)
                    <div class="col-lg-4 col-md-6 ws-s">
                        <div class="client-item">
                            <a href="{{ route('restaurants.show', ['slug' => $restaurant->slug]) }}"><img class="img-responsive picThumbnail" src="{{ asset('img/restaurants/'.$restaurant->picture) }}" alt="{{ $restaurant->name }}"></a>
                            <div class="item-content">
                                <h6>{{ $restaurant->name }}</h6>
                                <p>{{ $restaurant->flash }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section id="skillsCircles" class="circles-counters">
            <div class="container">
                <div id="counters" class="row count-wrapper">
                    <div class="col-sm-6 col-lg-3 circle-item wow zoomIn" data-wow-duration=".6s" data-wow-delay=".3s">
                        <div class="chart" data-percent="75"><span class="circle-icon linea-basic-gear"></span></div>
                        <span class="circle-text">{{ trans('restaurant.rapidity') }}</span>
                    </div>
                    <div class="col-sm-6 col-lg-3 circle-item wow zoomIn" data-wow-duration=".6s">
                        <div class="chart" data-percent="75"><span class="circle-icon linea-basic-display"></span></div>
                        <span class="circle-text">{{ trans('restaurant.simplicity') }}</span>
                    </div>
                    <div class="col-sm-6 col-lg-3 circle-item wow zoomIn" data-wow-duration=".6s">
                        <div class="chart" data-percent="75"><span class="circle-icon linea-basic-photo"></span></div>
                        <span class="circle-text">{{ trans('restaurant.quality') }}</span>
                    </div>
                    <div class="col-sm-6 col-lg-3 circle-item wow zoomIn" data-wow-duration=".6s" data-wow-delay=".3s">
                        <div class="chart" data-percent="75"><span class="circle-icon linea-basic-star"></span></div>
                        <span class="circle-text">{{ trans('restaurant.halal') }}</span>
                    </div>
                </div>
            </div>
        </section>
		<div class="cta-newsletter">
			<div class="bg-overlay">
				<div class="cta-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
        					<h3 class="cta-lead h-alt wow fadeIn" data-wow-delay=".1s" data-wow-duration="1s">{{ $contents->descTitle }}</h3>
        					<p>{{ $contents->descText }}</p>
                        </div>
                    </div>
                </div>
				</div>
			</div>
		</div>
        <section class="number-counters">
            <div class="container">
                <div id="counters" class="row count-wrapper">
                    <input type="hidden" id="counter1" value="{{ $nbRestaurants }}">
                    <input type="hidden" id="counter2" value="{{ $nbProducts }}">
                    <input type="hidden" id="counter3" value="{{ $nbGuests }}">
                    <div class="col-md-3 mb-sm-100 count-item wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                        <span id="count-1" class="count-nbr">500</span>
                        <span class="count-text">{{ trans('restaurant.restaurateurs') }}</span>
                    </div>
                    <div class="col-md-3 mb-sm-100 count-item wow fadeIn" data-wow-duration="1s">
                        <span id="count-2" class="count-nbr">856</span>
                        <span class="count-text">{{ trans('restaurant.dishes') }}</span>
                    </div>
                    <div class="col-md-3 mb-sm-100 count-item wow fadeIn" data-wow-duration="1s">
                        <span class="count-nbr">7/7</span>
                        <span class="count-text">{{ trans('restaurant.support') }}</span>
                    </div>
                    <div class="col-md-3 count-item wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                        <span id="count-3" class="count-nbr">10590</span>
                        <span class="count-text">{{ trans('restaurant.satisfied') }}</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
<script src="{{ asset('js/latlon-geohash.js') }}"></script>
<script src="{{ asset('js/location.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwcWM5eZSndJHE_oVw00zmU35dZz8usxs&libraries=places&callback=initAutocomplete"
                async defer></script>
<script>if (window.location.hash == '#_=_'){
                    history.replaceState
                        ? history.replaceState(null, null, window.location.href.split('#')[0])
                        : window.location.hash = '';
                }
</script>
@endsection
