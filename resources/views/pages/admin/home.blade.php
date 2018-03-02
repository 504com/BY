@extends('themes.adminlte')

@section('head')
	<link rel="stylesheet" href="{{ asset('css/vendor/pickadate/default.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vendor/pickadate/default.date.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vendor/pickadate/default.time.css') }}">
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection

@section('content')
	<section class="content">
		<input type="hidden" value="{{ $restaurant->id }}" name="id">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Taux de remplissage h+1</span>
						<span class="info-box-number">{{ number_format((100 * $guests)/ $restaurant->capacity, 0) }} % ({{ $guests }}pers)</span>
						<div class="progress">
							<div class="progress-bar" style="width: {{ (100 * $guests)/ $restaurant->capacity }}%"></div>
						</div>
						<span class="progress-description">
							Capacité max {{ $restaurant->capacity }} personnes
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Réservations du jour</span>
						<span class="info-box-number" id="dayBookings">{{ count($dayBookings) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div id="inlineAjaxMsg" class="row">
				</div>
				@if(session()->has('message'))
					<div class="row">
						<div class="col-xs-10 col-md-6 col-lg-4">
							<div class="alert alert-success fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('message') }}
							</div>
						</div>
					</div>
				@elseif(session()->has('error'))
					<div class="row">
						<div class="col-xs-12 col-md-6 col-lg-4">
							<div class="alert alert-warning fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('error') }}
							</div>
						</div>
					</div>
				@endif
				<div id="dayBookingBox" class="box">
					<div class="box-header">
						<h3 class="box-title">Réservations du jour</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
							<th>#</th>
							<th>Nom / Téléphone</th>
							<th>Date réservée</th>
							<th>Personnes</th>
							<th>Détail de la réservation</th>
							<th>Détail de la commande</th>
							</thead>
							<tbody>
							@if (count($dayBookings) === 0)
								<tr>
									<td></td>
									<td><span class="label label-danger">Aucune réservation enregistrée</span></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							@endif
							@foreach ($dayBookings as $dayBooking)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $dayBooking->organizer }} / {{$dayBooking->phone }}</td>
									<td>{{ date('d/m/Y à H\hi', strtotime($dayBooking->start)) }}</td>
									<td>{{ $dayBooking->guests }}</td>
									<td><a href="{{ route('admin.bookings.show', ['id' => $dayBooking->id]) }}">Voir le détail</a></td>
									@if( $dayBooking->order_id === null )
										<td><span class="label label-info">Pas de commande anticipée</span></td>
									@else
										<td><a href="{{ route('admin.orders.show', ['id' => $dayBooking->order_id]) }}">Voir la commande</a></td>
									@endif
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div id="bookingListBox" class="box">
					<div class="box-header new-btn">
						<button id="addNewBookingBtn" type="button" class="tabledit-save-button btn btn-sm btn-warning">Nouvelle réservation</button>
					</div>
					<div class="box-header">
						<h3 class="box-title">Liste des réservations</h3>
					</div>
					<div class="box-body table-responsive">
						<table id="bookingTable" class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
							<th>#</th>
							<th>#</th>
							<th>Nom / Téléphone</th>
							<th>Date réservée</th>
							<th>Heure réservée</th>
							<th>Personnes</th>
							<th>Détail de la réservation</th>
							<th>Détail de la commande</th>
							<th></th>
							</thead>
							<tbody>
							@if (count($bookings) === 0)
								<tr>
									<td></td>
									<td><span class="label label-danger">Aucune réservation enregistrée</span></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							@endif
							@foreach ($bookings as $booking)
								<tr id="{{$booking->id}}">
									<td name="identifier" style="display: none;">{{$booking->id}}<input id="bookingId" class="tabledit-input tabledit-identifier" type="hidden" name="bookingId" value="{{$booking->id}}" disabled=""/></td>
									<td name="iteration">{{$loop->iteration}}</td>
									<td name="organizer">{{$booking->organizer}} / {{$booking->phone }}</td>
									<td name="dateColumn" class="tabledit-view-mode">
										<span class="tabledit-span">{{$booking->start->format('d/m/Y')}}</span>
									</td>
									<td name="timeColumn" class="tabledit-view-mode">
										<span class="tabledit-span">{{date('H\hi', strtotime($booking->start))}}</span>
									</td>
									<td name="guestsColmun">{{$booking->guests}}</td>
									<td name="detailBooking"><a href="{{ route('admin.bookings.show', ['id' => $booking->id]) }}">Voir le détail</a></td>
									@if( $booking->order_id === null )
										<td name="noBookingItems"><span class="label label-info">Pas de commande anticipée</span></td>
									@else
										<td name="detailOrder"><a href="{{ route('admin.orders.show', ['id' => $booking->order_id]) }}">Voir la commande</a></td>
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

@section('scripts')
	<script src="{{ asset('js/vendor/pickadate/picker.js') }}"></script>
	<script src="{{ asset('js/vendor/pickadate/picker.date.js') }}"></script>
	<script src="{{ asset('js/vendor/pickadate/picker.time.js') }}"></script>
	<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
	<script src="{{ asset('js/adminbooking.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/fr.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@endsection
