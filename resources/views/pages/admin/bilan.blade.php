@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-xs-12 col-md-6">
				@if(session()->has('message'))
					<div class="row">
						<div class="col-xs-8 col-md-6">
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
						<div class="col-xs-12 col-md-6">
							<div class="alert alert-warning fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('error') }}
							</div>
						</div>
					</div>
				@endif
	        </div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-8">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Réservations/Commandes année en cours</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="chart">
							<div id="chartContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/vendor/chart.min.js') }}"></script>
@endsection