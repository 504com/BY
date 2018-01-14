@extends('themes.adminlte2')

@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des restaurants</span>
						<span class="info-box-number">{{ $restaurants }}</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-calendar-check-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des utilisateurs</span>
						<span class="info-box-number">{{ $users }}</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des réservations</span>
						<span class="info-box-number">{{ $bookings }}</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-calendar-check-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des commandes</span>
						<span class="info-box-number">{{ $orders }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Global / année en cours</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="chart">
							<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
    <script src="{{ asset('js/vendor/chart.min.js') }}"></script>
    <script src="{{ asset('js/laroute.js') }}"></script>
@endsection