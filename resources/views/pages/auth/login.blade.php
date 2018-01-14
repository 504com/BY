@extends('themes.definity')

@section('title', trans('auth.connection'))

@section('content')
    <div class="login-2">
        <div class="bg-overlay">
            <div class="container">
                <div class="row ws-m">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="form-wrapper">
                            <div class="form-content">
                                <h3 class="form-header">{{ trans('auth.login') }}</h3>
                                <form action="{{ route('login-submit') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input name="email" type="email" id="email" class="form-control" placeholder="{{ trans('form.email-placeholder') }}">
                                        <label for="email">{{ trans('form.email') }}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="pass-login-2" class="form-control">
                                        <label for="pass-login-2">{{ trans('form.password') }}</label>
                                        <span class="pull-right"><a href="#" class="forget-pass-link">{{ trans('form.forget-password') }}</a></span>
                                    </div>
                                    <input type="submit" value="{{ trans('auth.connection') }}" class="btn">
                                </form>
                                <span class="cards-header">or signup with</span>
                            </div>
                            <div class="social-signup">
                                <a href="#" class="social-card fb-card">
                                    <span class="sc-lead">Facebook</span>
                                    <span class="sc-info">Sign up with</span>
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="social-card tw-card">
                                    <span class="sc-lead">Twitter</span>
                                    <span class="sc-info">Sign up with</span>
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('register-form') }}" class="email-signup pull-right">Signup with email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
