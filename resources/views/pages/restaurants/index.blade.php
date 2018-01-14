@extends('themes.definity')

@section('title', trans('restaurant.list'))

@section('content')
    <main class="container">
        <section class="row">
			@if(count($restaurants) == 0)
				<section class="container portfolio-layout portfolio-columns-boxed">
					<div class="row">
						<header class="sec-heading">
							<h2>Désolé</h2>
							<span class="subheading">Aucun résultat pour cette recherche</span>
						</header>
					</div>
				</section>
			@else
				<header class="text-center ws-s">
					<h2>{{ trans('restaurant.nearest') }}</h2>
				</header>
				@foreach($restaurants as $restaurant)
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
			@endif
        </section>
    </main>
@endsection
