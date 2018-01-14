@extends('themes.adminlte2')

@section('content')
    <section class="content">
        @if(session()->has('message'))
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="alert alert-success fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session()->get('message') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Modifier le mot de passe</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form method="post" class="form-horizontal" action="{{ route('manager.changepassword.update') }}">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group has-feedback @if($errors->has('old-password')) has-error @endif">
                                        <label for="old-password" class="col-sm-4 control-label">Ancien mot de passe</label>
                                        <div class="col-sm-8">
                                            <input type="password" name="old-password" class="form-control" id="old-password">
                                            <span class="fa fa-lock form-control-feedback"></span>
                                            @if ($errors->has('old-password'))
                                                <span class="help-block">{{ $errors->first('old-password')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                                        <label for="password" class="col-sm-4 control-label">Nouveau mot de passe</label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password" class="form-control" id="password">
                                            <span class="fa fa-lock form-control-feedback"></span>
                                            @if ($errors->has('password'))
                                                <span class="help-block">{{ $errors->first('password')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback @if($errors->has('password_confirmation')) has-error @endif">
                                        <label for="password_confirmation" class="col-sm-4 control-label">Confirmer mot de passe</label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                            <span class="fa fa-lock form-control-feedback"></span>
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
