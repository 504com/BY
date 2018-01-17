@extends('themes.definity')

@section('title', trans('auth.registration'))

@section('content')
    <div class="login-2">
        <div class="bg-overlay">
            <div class="container">
                <div class="row ws-m">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="form-wrapper">
                            <div class="form-content">
                                <h3 class="form-header">{{ trans('auth.register') }}</h3>
                                <form method="post" action="{{ route('register-submit') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group @if($errors->has('lastname')) has-error @endif">
                                        <input name="lastName" type="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}" placeholder="{{ trans('form.lastname-placeholder') }}">
                                        <label for="username">{{ trans('form.lastname') }}</label>
                                        @if($errors->has('lastname'))
                                            <p class="help-block">{{ $errors->first('lastname') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group @if($errors->has('email')) has-error @endif">
                                        <input name="email" type="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('form.email-placeholder') }}">
                                        <label for="username">{{ trans('form.email') }}</label>w
                                        @if($errors->has('email'))
                                            <p class="help-block">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group @if($errors->has('password')) has-error @endif">
                                        <input type="password" name="password" id="password" class="form-control">
                                        <label for="password">{{ trans('form.password') }}</label>
                                        @if($errors->has('password'))
                                            <p class="help-block">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                        <label for="password_confirmation">{{ trans('form.confirm-password') }}</label>
                                    </div>
                                    <input type="submit" class="btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
