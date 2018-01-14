@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-xs-12">
				<div class="col-md-offset-3 col-md-6">
					<div class="box box-solid">
						<div class="box-header with-border">
							<i class="fa fa-cutlery"></i>
							<h3 class="box-title">Informations du restaurant</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<img src="{{ asset('img/restaurants/'.$restaurant->picture) }}" class="thumbnail img-responsive" alt="">
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12" style="margin: 20px 0">
									<dl>
										<dt>Nom :</dt>
										<p class="text-light-blue">{{ $restaurant->name }}</p>
										<dt>Adresse :</dt>
										<p class="text-light-blue">{{ $restaurant->address }}</p>
										<p class="text-light-blue">{{ $restaurant->zipcode }} {{ $restaurant->city }}</p>
										<dt>Description courte :</dt>
										<p class="text-light-blue">{{ $restaurant->flash }}</p>
										<dt>Description :</dt>
										<p class="text-light-blue">{{ $restaurant->description }}</p>
										<dt>Capacité maximum :</dt>
										<p class="text-light-blue">{{ $restaurant->capacity }} personnes</p>
										<dt>Durée de réservation :</dt>
										<p class="text-light-blue">{{ $booking_duration }}</p>
									</dl>
								</div>
							</div>
							<div class="text-center">
								<a href="{{ route('admin.modifications.show') }}" class="btn btn-app"><i class="fa fa-edit"></i>Modifier</a>
							</div>
						</div>
					</div>
				</div>
	        </div>
		</div>
    </section>
@endsection
