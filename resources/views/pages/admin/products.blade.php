@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-xs-12">
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
						<div class="col-xs-10 col-md-4">
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
					<h3 class="box-title">Liste des produits</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>#</th>
								<th>Nom</th>
								<th>Description</th>
								<th>Prix</th>
								<th>Catégorie</th>
								<th></th>
							</thead>
							<tbody>
								@if (count($products) === 0 )
									<tr>
										<td></td>
										<td><span class="label label-danger">Aucune catégorie enregistrée</span></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endif
								@foreach($products as $product)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $product->name }}</td>
										<td>{{ $product->description }}</td>
										<td>{{ number_format($product->price, 2) }} €</td>
										<td>{{ $product->category->name }}</td>
										<td><a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-danger link"><i class="fa fa-times"></i></a></td>
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
						<li class="active"><a href="#tab_1" data-toggle="tab">Ajouter un produit</a></li>
						<li><a href="#tab_2" data-toggle="tab">Modifier un produit</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<form method="post" class="form-horizontal" action="{{ route('admin.products.create') }}">
								{{ csrf_field() }}
								<div class="box-body">
									<div class="form-group @if($errors->has('product-name')) has-error @endif">
										<label for="product-name" class="col-sm-4 control-label">Nom</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="product-name" value="{{ old('product-name') }}">
											@if ($errors->has('product-name'))
												<span class="help-block">{{ $errors->first('product-name')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('product-description')) has-error @endif">
										<label for="product-description" class="col-sm-4 control-label">Description</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="3" name="product-description">{{ old('product-description') }}</textarea>
											@if ($errors->has('product-description'))
												<span class="help-block">{{ $errors->first('product-description')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('product-price')) has-error @endif">
										<label for="product-price" class="col-sm-4 control-label">Prix</label>
										<div class="col-sm-8">
											<div class="input-group">
												<input type="number" class="form-control" min="0" step="0.01" name="product-price" placeholder="10.00" value="{{ old('product-price') }}">
												<div class="input-group-addon">€</div>
											</div>
											@if ($errors->has('product-price'))
												<span class="help-block">{{ $errors->first('product-price')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('product-category')) has-error @endif">
										<label for="product-category" class="col-sm-4 control-label">Categorie</label>
										<div class="col-sm-8">
											<select class="form-control" name="product-category">
												<option value="">Choisir une catégorie</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('product-category'))
												<span class="help-block">{{ $errors->first('product-category')}}</span>
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
							<form method="post" class="form-horizontal" action="{{ route('admin.products.edit') }}">
								<input type="hidden" name="_method" value="PUT">
								{{ csrf_field() }}
								<div class="box-body">
									<div class="form-group @if($errors->has('edit-product')) has-error @endif">
										<label for="product" class="col-sm-4 control-label">Produit a modifier</label>
										<div class="col-sm-8">
											<select data-url="{{ config('app.url') }}" id="edit-option" class="form-control" name="edit-product">
												<option value="">Choisir un produit</option>
												@foreach($products as $product)
													<option value="{{ $product->id }}">{{ $product->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('edit-product'))
												<span class="help-block">{{ $errors->first('edit-product')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('edit-product-name')) has-error @endif">
										<label for="edit-product-name" class="col-sm-4 control-label">Nom</label>
										<div class="col-sm-8">
											<input id="edit-name" type="text" class="form-control" name="edit-product-name" value="{{ old('edit-product-name') }}">
											@if ($errors->has('edit-product-name'))
												<span class="help-block">{{ $errors->first('edit-product-name')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('edit-product-description')) has-error @endif">
										<label for="edit-product-description" class="col-sm-4 control-label">Description</label>
										<div class="col-sm-8">
											<textarea id="edit-description" class="form-control" rows="3" name="edit-product-description">{{ old('edit-product-description') }}</textarea>
											@if ($errors->has('edit-product-description'))
												<span class="help-block">{{ $errors->first('edit-product-description')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('edit-product-price')) has-error @endif">
										<label for="edit-product-price" class="col-sm-4 control-label">Prix</label>
										<div class="col-sm-8">
											<div class="input-group">
												<input id="edit-price" type="number" class="form-control" min="0" step="0.01" name="edit-product-price" placeholder="10.00" value="{{ old('edit-product-price') }}">
												<div class="input-group-addon">€</div>
											</div>
											@if ($errors->has('edit-product-price'))
												<span class="help-block">{{ $errors->first('edit-product-price')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('edit-product-category')) has-error @endif">
										<label for="edit-product-category" class="col-sm-4 control-label">Categorie</label>
										<div class="col-sm-8">
											<select id="edit-category" class="form-control" name="edit-product-category">
												<option value="">Choisir une catégorie</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('edit-product-category'))
												<span class="help-block">{{ $errors->first('edit-product-category')}}</span>
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

@section('scripts')
    <script src="{{ asset('js/laroute.js') }}"></script>
@endsection