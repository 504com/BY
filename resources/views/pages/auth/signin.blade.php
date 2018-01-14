@extends('themes.definity')

@section('title', trans('auth.connection'))

@section('content')
    <div class="login-1">
        <div class="bg-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="panel-group" id="login-accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel top-panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title text-center">
                                        <a role="button" data-toggle="collapse" data-parent="#login-accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            {{ trans('auth.login') }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="form-login">
                                            <form method="post" action="{{ route('login-submit') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <input name="email" type="email" id="login_email" class="form-control" placeholder="{{ trans('form.email-placeholder') }}">
                                                </div>
                                                <div class="form-group text-center">
                                                    <input type="password" name="password" id="login_password" class="form-control" placeholder="{{ trans('form.password') }}">
                                                    <span class=""><a href="{{ route('reset.usersPassword.index') }}" class="forget-pass-link">{{ trans('form.forget-password') }}</a></span>
                                                </div>
												<button type="submit" class="btn-ghost col-xs-12 btn-submit btn-colored">{{ trans('auth.connection') }}</button>
												{{--<div class="form-group text-center">--}}
													{{--<p>OU</p>--}}
												{{--</div>--}}
												{{--<a class="btn col-xs-12 btn-facebook" href="{{ route('fb-login') }}">SE CONNECTER AVEC FACEBOOK</a>--}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel bottom-panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title text-center">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#login-accordion" href="#register-login-page-2" aria-expanded="false" aria-controls="register-login-page-2">
                                            {{ trans('auth.register') }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="register-login-page-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="form-register">
                                            <form method="post" action="{{ route('register-submit') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group @if($errors->has('email')) has-error @endif">
                                                    <input name="email" type="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('form.email-placeholder') }}">
                                                    <label for="username">{{ trans('form.email') }}</label>
                                                    @if($errors->has('email'))
                                                        <p class="help-block">{{ $errors->first('email') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group @if($errors->has('password')) has-error @endif">
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('form.password_min_char') }}">
                                                    <label for="password">{{ trans('form.password') }}</label>
                                                    @if($errors->has('password'))
                                                        <p class="help-block">{{ $errors->first('password') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                    <label for="password_confirmation">{{ trans('form.confirm-password') }}</label>
                                                </div>
												<button type="submit" class="btn-ghost col-xs-12 btn-submit btn-colored">{{ trans('auth.register') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
