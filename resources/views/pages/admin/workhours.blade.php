@extends('themes.adminlte')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/vendor/pickadate/classic.css') }}">
@endsection

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-md-8">
				@if(session()->has('message'))
					<div class="row">
						<div class="col-xs-8 col-md-4">
							<div class="alert alert-success fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('message') }}
							</div>
						</div>
					</div>
				@endif
				<div class="box box-solid">
					<div class="box-header with-border">
						<i class="fa fa-sitemap"></i>
						<h3 class="box-title">Création des horaires</h3>
						<button id="addWorkhour" title="Ajouter un horaire" class="btn btn-success pull-right"><i class="fa fa-plus"></i></button>
					</div>
					@if($errors->any())
						<ul>
							@foreach($errors->all() as $error)
								<li style="color:red">{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form class="" action="{{ route('admin.workhours.create') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="box-body">
							<div id="workhours">
								@include('partials.forms.workhours')
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-info">Créer horaires</button>
						</div>
					</form>
				</div>
				<div class="box">
					<div class="box-header">
					<h3 class="box-title">Liste des horaires</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>Jour</th>
								<th>Ouverture</th>
								<th>Fermeture</th>
								<th></th>
							</thead>
							<tbody>
								@if (sizeof($workhours) === 0)
									<tr>
										<td><span class="label label-danger">Aucun horaire enregistré</span></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endif

								@foreach($workhours as $workhour)
									<tr>
										<td>{{ trans('admin.'.$days[$workhour->day_id -1]->name) }}</td>
										<td>{{ date('H\hi', strtotime($workhour->start)) }}</td>
										<td>{{ date('H\hi', strtotime($workhour->end)) }}</td>
										<td><a href="{{ route('admin.workhours.destroy', ['id' => $workhour->id]) }}" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
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
    <script src="{{ asset('js/vendor/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('js/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('js/vendor/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('js/vendor/pickadate/picker.time.js') }}"></script>
@endsection
