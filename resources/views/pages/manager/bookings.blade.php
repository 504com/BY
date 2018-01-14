@extends('themes.adminlte2')

@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des réservations</span>
						<span class="info-box-number">{{ count($bookings) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Liste des réservations</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>#</th>
								<th>Crée le</th>
								<th>Date réservée</th>
								<th>Personnes</th>
								<th>Détail de la réservation</th>
								<th>Détail de la commande</th>
							</thead>
							<tbody>
								@if (count($bookings) === 0 )
									<tr>
										<td></td>
										<td><span class="label label-danger">Aucune réservation enregistrée</span></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endif
								@foreach($bookings as $booking)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ date('d/m/Y à H\hi', strtotime($booking->created_at)) }}</td>
										<td>{{ date('d/m/Y à H\hi', strtotime($booking->start)) }}</td>
										<td>{{ $booking->guests }}</td>
										<td><a href="{{ route('manager.bookings.show', ['id' => $booking->id]) }}">Voir le détail</a></td>
										@if( $booking->order_id === null )
											<td><span class="label label-info">Pas de commande anticipée</span></td>
										@else
											<td><a href="{{ route('manager.orders.show', ['id' => $booking->order_id]) }}">Voir la commande</a></td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
