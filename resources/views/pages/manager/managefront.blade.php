@extends('themes.adminlte2')

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-md-offset-2 col-md-8">
				@if(session()->has('message'))
					<div class="row">
						<div class="col-xs-10 col-md-4">
							<div class="alert alert-success fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('message') }}
							</div>
						</div>
					</div>
				@endif
				<div class="box box-solid">
					<div class="box-header with-border">
						<i class="fa fa-sitemap"></i>
						<h3 class="box-title">Modification des informations</h3>
					</div>
					@if($errors->any())
						<ul>
							@foreach($errors->all() as $error)
								<li style="color:red">{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form class="" action="{{ route('manager.managefront.edit') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}
						<div class="box-body">
                            <div class="row">
    							<div class="form-group col-xs-12">
    								<div class="col-md-7">
    									<img src="{{ asset('img/logo_noir_fond_transparent.png') }}" class="img-rounded center-block" width="70%" alt="">
    								</div>
    								<div class="form-group col-md-5 col-xs-12">
    									<label for="logo">Logo</label>
    									<input type="file" name="logo" id="logo">
    									<p class="help-block">Image au format PNG uniquement</p>
    								</div>
    							</div>
                            </div>
                            <div class="row">
    							<div class="form-group col-xs-12">
    								<div class="col-md-7">
    									<img src="{{ asset('img/background.jpg') }}" class="img-rounded center-block" width="70%" alt="">
    								</div>
    								<div class="form-group col-md-5 col-xs-12">
    									<label for="picture">Photo</label>
    									<input type="file" name="picture" id="picture">
    									<p class="help-block">Image au format JPG uniquement</p>
    								</div>
    							</div>
                            </div>
                            <div class="row">
                                <h2 class="text-center">Zone 1 <small>Message principal</small></h2>
                                <hr>
                                <div class="form-group col-xs-12">
                                    <div class="form-group col-xs-12">
                                        <div class="col-xs-12">
                                            <label for="blurb">Titre principal</label>
                                            <input type="text" name="blurb" class="form-control" id="blurb" value="{{ $frontContents->blurb }}">
                                        </div>
                                        <div class="col-xs-12">
                                            <label for="subBlurb">Sous-titre principal</label>
                                            <input type="text" name="subBlurb" class="form-control" id="subBlurb" value="{{ $frontContents->subBlurb }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h2 class="text-center">Zone 2 <small>{{ $frontContents->catchPhrase1 }}</small></h2>
                                <hr>
                                <div class="form-group col-lg-12">
                                    <div class="form-group col-xs-12">
                                        <label for="catchPhrase1">Titre principal</label>
                                        <input type="text" name="catchPhrase1" class="form-control" id="catchPhrase1" value="{{ $frontContents->catchPhrase1 }}">
                                    </div>
                                    <div class=" col-xs-12 col-md-6">
        								<div class="col-xs-12">
        									<label for="title_1">Titre 1</label>
        									<input type="text" name="title_1" class="form-control" id="title_1" value="{{ $frontContents->title_1 }}">
        								</div>
        								<div class="col-xs-12">
        									<label for="text_1">Texte 1</label>
        									<textarea class="form-control" rows="3" name="text_1" id="text_1">{{ $frontContents->text_1 }}</textarea>
        								</div>
                                    </div>
        							<div class="col-xs-12 col-md-6">
        								<div class="col-xs-12">
        									<label for="title_2">Titre 2</label>
        									<input type="text" name="title_2" class="form-control" id="title_2" value="{{ $frontContents->title_2 }}">
        								</div>
        								<div class="col-xs-12">
        									<label for="text_2">Texte 2</label>
        									<textarea class="form-control" rows="3" name="text_2" id="text_2">{{ $frontContents->text_2 }}</textarea>
        								</div>
        							</div>
        							<div class="col-xs-12 col-md-6">
        								<div class="col-xs-12">
        									<label for="title_3">Titre 3</label>
        									<input type="text" name="title_3" class="form-control" id="title_3" value="{{ $frontContents->title_3 }}">
        								</div>
        								<div class="col-xs-12">
        									<label for="text_3">Texte 3</label>
        									<textarea class="form-control" rows="3" name="text_3" id="text_3">{{ $frontContents->text_3 }}</textarea>
        								</div>
        							</div>
                                </div>
                            </div>
                            <div class="row">
                                <h2 class="text-center">Zone 3 <small>{{ $frontContents->catchPhrase2 }}</small></h2>
                                <hr>
                                <div class="form-group col-lg-12">
                                    <div class="form-group col-xs-12">
                                        <label for="catchPhrase2">Titre principal</label>
                                        <input type="text" name="catchPhrase2" class="form-control" id="catchPhrase2" value="{{ $frontContents->catchPhrase2 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h2 class="text-center">Zone 4 <small>{{ $frontContents->catchPhrase3 }}</small></h2>
                                <hr>
                                <div class="form-group col-lg-12">
                                    <div class="form-group col-xs-12">
                                        <label for="catchPhrase3">Titre principal</label>
                                        <input type="text" name="catchPhrase3" class="form-control" id="catchPhrase3" value="{{ $frontContents->catchPhrase3 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h2 class="text-center">Zone 5 <small>description</small></h2>
                                <hr>
                                <div class="form-group col-xs-12">
                                    <div class="form-group col-xs-12">
                                        <div class="col-xs-12">
                                            <label for="descTitle">Titre de la description</label>
                                            <input type="text" name="descTitle" class="form-control" id="descTitle" value="{{ $frontContents->descTitle }}">
                                        </div>
                                        <div class="col-xs-12">
                                            <label for="descText">Texte de la description</label>
                                            <textarea class="form-control" rows="8" name="descText" id="descText">{{ $frontContents->descText }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="text-center">Rayon de recherche</h2>
                            <hr>
							<div class="form-group col-lg-6">
								<div class="col-xs-12">
									<label for="radius">Rayon de recherche <em>(en km)</em></label>
									<input type="number" name="radius" class="form-control" id="radius" value="{{ $frontContents->radius }}">
								</div>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-warning">Modifier informations</button>
						</div>
					</form>
				</div>
	        </div>
		</div>
    </section>
@endsection
