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
			<div class="col-md-6">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Modifier mot de passe</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<form method="post" class="form-horizontal" action="{{ route('admin.password.edit') }}">
								{{ csrf_field() }}
								<div class="box-body">
									<div class="form-group @if($errors->has('old-password')) has-error @endif">
										<label for="old-password" class="col-sm-4 control-label">Ancien mot de passe</label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="old-password" name="old-password">
											@if ($errors->has('old-password'))
											<span class="help-block">{{ $errors->first('old-password')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('password')) has-error @endif">
										<label for="password" class="col-sm-4 control-label">Nouveau</label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="password" name="password">
											@if ($errors->has('password'))
											<span class="help-block">{{ $errors->first('password')}}</span>
											@endif
										</div>
									</div>
									<div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
										<label for="password_confirmation" class="col-sm-4 control-label">Confirmation</label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
											@if ($errors->has('password_confirmation'))
											<span class="help-block">{{ $errors->first('password_confirmation')}}</span>
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
