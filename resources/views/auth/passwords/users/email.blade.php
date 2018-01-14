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
									@if(Session::has('status'))
										<div class="alert alert-success alert-dismissible col-xs-12" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											Un mail a été envoyé a cette adresse
										</div>
									@endif
                                    <h4 class="panel-title text-center">{{ trans('auth.forgotPassword') }}</h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" style="padding-bottom:100px">
                                        <div class="form-login">
                                            <form method="post" action="{{ route('reset.usersPassword.edit') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group @if($errors->has('email')) has-error @endif">
                                                    <input name="email" type="email" id="login_email" class="form-control" placeholder="{{ trans('form.email-placeholder') }}">
													@if ($errors->has('email'))
														<span class="help-block">{{ $errors->first('email')}}</span>
													@endif
                                                </div>
												<button type="submit" class="btn-ghost col-xs-12 btn-submit btn-colored">{{ trans('auth.requestPassword') }}</button>
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
