<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Admin | {{ trans('auth.resetPassword') }}</title>
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="{{ asset('css/vendor/adminlte/AdminLTE.min.css') }}">
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
		    <div class="login-logo">
		        <a href="{{ route('home') }}">{{ trans('auth.forgotPassword') }}</a>
		    </div>
			@if(Session::has('status'))
				<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Un mail a été envoyé a cette adresse
				</div>
			@endif
		    <div class="login-box-body">
		        <form action="{{ route('reset.password.edit') }}" method="post">
		            {{ csrf_field() }}
		            <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
		                <input type="email" name="email" class="form-control" placeholder="{{ trans('form.email') }}">
		                <span class="fa fa-envelope form-control-feedback"></span>
						@if ($errors->has('email'))
							<span class="help-block">{{ $errors->first('email')}}</span>
						@endif
		            </div>
		            <div class="form-group">
		                <button type="submit" class="btn btn-danger btn-block btn-flat">{{ trans('auth.requestPassword') }}</button>
		            </div>
		        </form>
		    </div>
		</div>
		<script src="{{ asset('js/vendor/jquery-2.1.4.min.js') }}"></script>
		<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
	</body>
</html>
