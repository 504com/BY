@extends('themes.definity')

@section('title', $restaurant->name)

@section('navbar')
	<nav class="navbar navbar-default navbar-fixed-top mega navbar-trans">
@endsection

@section('content')
	<header class="page-title pt-large pt-dark pt-parallax pt-plax-lg-dark" data-stellar-background-ratio="0.4" style="background: url({{ asset('img/restaurants/'.$restaurant->picture) }}); background-size: cover; padding:150px 0; width: 100%;">
		<div class="container">
			<div class="row">

				<div class="col-sm-12 text-center imgResto">
					<h1>{{ $restaurant->name }}</h1>
					<span class="subheading"></span>
					<p>{{ $restaurant->flash }}</p>
				</div>

			</div>
		</div>
	</header>
    <section id="restaurant_menu" class="container" data-id="{{ $restaurant->id }}">
        <div class="row order-block">
            <div class="col-lg-8 col-xs-12 order-info">
                <restaurant v-bind:products="products" order="false"></restaurant>
            </div>
            <div class="col-lg-4 text-center info-resto">
				<a href="{{ route('restaurants.bookings.create', ['restaurant' => $restaurant->slug]) }}" class="btn-ghost btn-block btn-colored">Réserver</a>
                <h2>Les informations</h2>
                <p>{{ $restaurant->description }}</p>
                <div class="col-xs-12">
                    <h2 class="text-center">Les horaires</h2>

    				<div class="workhours">
                        @foreach($days as $day)
                            <div class="workhours-hours">
                                <p class="workhours-day">{{ trans('admin.'.$day->name) }}</p>
                                @if($workhours->contains('day_id', $day->id))
                                    @foreach($workhours->whereIn('day_id', $day->id) as $workhour)
                                        <p class="text-right">{{ date("H\hi", strtotime($workhour->start)) }} - {{ date("H\hi", strtotime($workhour->end)) }}</p>
                                    @endforeach
                                @else
                                    <p class="text-right">Fermé</p>
                                @endif
                            </div>
                        @endforeach
    				</div>
                </div>
            </div>
        </div>
    </section>
@endsection
