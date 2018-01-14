@extends('themes.adminlte2')

@section('content')
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
