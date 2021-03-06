@extends('themes.definity')

@section('title', trans('home.title'))

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
    <section class="content">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<h3 class="profile-username text-center">Détail de la réservation</h3>
						<p class="text-muted text-center">Numéro : {{ $booking->id }}</p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Nom du client</b> <a class="pull-right">{{ $booking->organizer }}</a>
							</li>
							<li class="list-group-item">
								<b>Numéro de téléphone</b> <a class="pull-right">{{ $booking->phone }}</a>
							</li>
							<li class="list-group-item">
								<b>Nombre de couverts</b> <a class="pull-right">{{ $booking->guests }}</a>
							</li>
							<li class="list-group-item">
								<b>Date</b> <a class="pull-right">{{ $booking->start->format('d/m/Y à H\hi') }}</a>
							</li>
							<li class="list-group-item">
								<b>Message</b>
								@if($booking->details)
									<a class="pull-right">{{ $booking->details }}</a>
								@else
									<a class="pull-right"><em>pas de message</em></a>
								@endif
							</li>
						</ul>
						<a href="{{ route('manager.bookings.index') }}" class="btn btn-primary pull-right"><b>Retour à la liste des réservations</b></a>
					</div>
				</div>
			</div>
		</div>
    </section>
@endsection
