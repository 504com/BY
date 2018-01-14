<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin | Connexion</title>
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
                <a href="{{ route('home') }}">BY</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">{{ trans('auth.login') }}</p>
                <form action="{{ route('admin-login-submit') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="{{ trans('form.email') }}">
                        <span class="fa fa-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="{{ trans('form.password') }}">
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.connection') }}</button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{ route('reset.password.index') }}">{{ trans('form.forget-password') }}</a>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/vendor/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    </body>
</html>
