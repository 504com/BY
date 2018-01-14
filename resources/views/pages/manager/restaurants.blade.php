@extends('themes.adminlte2')

@section('content')
	<section class="content">
		@if(session()->has('message'))
			<div class="row">
				<div class="col-xs-12 col-md-4">
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
					<div class="alert alert-danger fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						{{ session()->get('error') }}
					</div>
				</div>
			</div>
		@endif
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des restaurants</span>
						<span class="info-box-number">{{ count($restaurants) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Liste des restaurants</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>#</th>
								<th>Nom</th>
								<th>E-mail</th>
								<th>Téléphone</th>
								<th>Ville</th>
								<th>Date de création</th>
								<th>Détails</th>
							</thead>
							<tbody>
								@if (count($restaurants) === 0 )
									<tr>
										<td></td>
										<td><span class="label label-danger">Aucun restaurant enregistrée</span></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
                                        <td></td>
									</tr>
								@endif
								@foreach($restaurants as $restaurant)
									<tr>
										<td>{{ $restaurant->id }}</td>
										<td>{{ $restaurant->name }}</td>
										<td>{{ $restaurant->email }}</td>
										<td>{{ $restaurant->phone }}</td>
										<td>{{ $restaurant->city }}</td>
										<td>{{ date('d/m/Y à H\hi', strtotime($restaurant->created_at)) }}</td>
                                        <td><a class="btn btn-social-icon btn-twitter" href="{{ route('manager.restaurants.show', ['id' => $restaurant->id]) }}" title="Détails"><i class="fa fa-line-chart"></i></a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Ajouter un restaurant</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<form method="post" class="form-horizontal" action="{{ route('manager.restaurants.create') }}">
								{{ csrf_field() }}
								<div class="box-body">
									<div class="form-group @if($errors->has('name')) has-error @endif">
										<label for="name" class="col-sm-4 control-label">Nom du restaurant</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
											@if ($errors->has('name'))
												<span class="help-block">{{ $errors->first('name')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('email')) has-error @endif">
										<label for="email" class="col-sm-4 control-label">E-mail</label>
										<div class="col-sm-8">
											<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
											@if ($errors->has('email'))
												<span class="help-block">{{ $errors->first('email')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('phone')) has-error @endif">
										<label for="phone" class="col-sm-4 control-label">Téléphone</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
											@if ($errors->has('phone'))
												<span class="help-block">{{ $errors->first('phone')}}</span>
											@endif
										</div>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Ajouter</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Les mieux notés / Les nouveautés</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<form method="post" class="form-horizontal" action="{{ route('manager.restaurants.update') }}">
								<input name="_method" type="hidden" value="PATCH">
								{{ csrf_field() }}
								<div class="box-body">
									<div class="col-xs-6">
										<h4>Les mieux notés</h4>
										<div class="form-group @if($errors->has('first')) has-error @endif">
											<label for="first" class="col-sm-4 control-label">Premier</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="first" name="first" value="{{ $frontContents->rank_1 }}">
												@if ($errors->has('first'))
												<span class="help-block">{{ $errors->first('first')}}</span>
												@endif
											</div>
										</div>
										<div class="form-group @if($errors->has('second')) has-error @endif">
											<label for="second" class="col-sm-4 control-label">Second</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="second" name="second" value="{{ $frontContents->rank_2 }}">
												@if ($errors->has('second'))
												<span class="help-block">{{ $errors->second('second')}}</span>
												@endif
											</div>
										</div>
										<div class="form-group @if($errors->has('third')) has-error @endif">
											<label for="third" class="col-sm-4 control-label">Troisième</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="third" name="third" value="{{ $frontContents->rank_3 }}">
												@if ($errors->has('third'))
												<span class="help-block">{{ $errors->third('third')}}</span>
												@endif
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<h4>Les nouveautés</h4>
										<div class="form-group @if($errors->has('newFirst')) has-error @endif">
											<label for="newFirst" class="col-sm-4 control-label">Premier</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="newFirst" name="newFirst" value="{{ $frontContents->new_1 }}">
												@if ($errors->has('newFirst'))
												<span class="help-block">{{ $errors->first('newFirst')}}</span>
												@endif
											</div>
										</div>
										<div class="form-group @if($errors->has('newSecond')) has-error @endif">
											<label for="newSecond" class="col-sm-4 control-label">Second</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="newSecond" name="newSecond" value="{{ $frontContents->new_2 }}">
												@if ($errors->has('newSecond'))
												<span class="help-block">{{ $errors->first('newSecond')}}</span>
												@endif
											</div>
										</div>
										<div class="form-group @if($errors->has('newThird')) has-error @endif">
											<label for="newThird" class="col-sm-4 control-label">Troisième</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="newThird" name="newThird" value="{{ $frontContents->new_3 }}">
												@if ($errors->has('newThird'))
												<span class="help-block">{{ $errors->first('newThird')}}</span>
												@endif
											</div>
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
