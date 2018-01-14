@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-xs-12 col-md-6">
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
				@elseif(session()->has('error'))
					<div class="row">
						<div class="col-xs-12 col-md-4">
							<div class="alert alert-warning fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('error') }}
							</div>
						</div>
					</div>
				@endif
				<div class="box">
					<div class="box-header">
					<h3 class="box-title">Liste des catégories</h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<th>#</th>
								<th>Nom</th>
								<th>Suppression</th>
							</thead>
							<tbody>
								@if (count($categories) === 0 )
									<tr>
										<td></td>
										<td><span class="label label-danger">Aucune catégorie enregistrée</span></td>
									</tr>
								@endif
								@foreach($categories as $category)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $category->name }}</td>
										<td><a href="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
	            </div>
	        </div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Ajouter une catégorie</a></li>
						<li><a href="#tab_2" data-toggle="tab">Modifier une catégorie</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<form method="post" class="form-horizontal" action="{{ route('admin.categories.create') }}">
								{{ csrf_field() }}
								<div class="box-body">
									<div class="form-group @if($errors->has('category-name')) has-error @endif">
										<label for="category-name" class="col-sm-4 control-label">Nom de la catégorie</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="category-name" name="category-name">
											@if ($errors->has('category-name'))
												<span class="help-block">{{ $errors->first('category-name')}}</span>
											@endif
										</div>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Ajouter</button>
								</div>
							</form>
						</div>
						<div class="tab-pane" id="tab_2">
							<form method="post" class="form-horizontal" action="{{ route('admin.categories.edit') }}">
								<input type="hidden" name="_method" value="PUT">
								{{ csrf_field() }}
								<div class="box-body">
									<label for="categoryId" class="col-sm-4 control-label">Choix de la catégorie</label>
									<div class="col-sm-8">
										<div class="form-group @if($errors->has('categoryId')) has-error @endif">
											<select class="form-control" name="categoryId">
												<option value="">Choisir une catégorie</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('categoryId'))
												<span class="help-block">{{ $errors->first('categoryId')}}</span>
											@endif
										</div>
									</div>
									<label for="categoryName" class="col-sm-4 control-label">Nouvelle valeur</label>
									<div class="col-sm-8">
										<div class="form-group @if($errors->has('categoryName')) has-error @endif">
											<input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Nouvelle valeur" value="{{ old('categoryName') }}">
											@if ($errors->has('categoryName'))
												<span class="help-block">{{ $errors->first('categoryName')}}</span>
											@endif
										</div>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-warning pull-right">Modifier</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
@endsection
