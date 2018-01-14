@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="row">
	        <div class="col-md-offset-2 col-md-8">
				<div class="box box-solid">
					<div class="box-header with-border">
						<i class="fa fa-sitemap"></i>
						<h3 class="box-title">Modification des informations</h3>
					</div>
					@if (session()->has('error'))
                        <ul>
                            <li style="color:red">{{ session()->get('error') }}</li>
                        </ul>
                    @endif
					@if($errors->any())
						<ul>
							@foreach($errors->all() as $error)
								<li style="color:red">{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form class="" action="{{ route('admin.modifications.edit') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="box-body">
							<div class="form-group col-xs-12 col-md-12 backShowImg">
								<img src="{{ asset('img/restaurants/'.$restaurant->picture) }}" class="thumbnail center-block img-responsive" alt="">
								<label for="picture">Photo</label>
								<input type="file" name="picture" id="picture">
								<p class="help-block">Image au format PNG ou JPG</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="description">Description</label>
								<textarea name="description" rows="4" class="form-control" id="description">{{ $restaurant->description }}</textarea>
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="flash">Description courte</label>
								<textarea name="flash" rows="4" maxlength="100" class="form-control" id="flash">{{ $restaurant->flash }}</textarea>
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label for="address">Adresse</label>
								<input type="text" name="address" class="form-control" id="address" value="{{ $restaurant->address }}">
							</div>
							<div class="form-group col-xs-12 col-md-3">
								<label for="city">Ville</label>
								<input type="text" name="city" class="form-control" id="city" value="{{ $restaurant->city }}">
							</div>
							<div class="form-group col-xs-6 col-md-3">
								<label for="zipcode">Code Postal</label>
								<input type="text" name="zipcode" class="form-control" id="zipcode" value="{{ $restaurant->zipcode }}">
							</div>
							<div class="form-group col-xs-6 col-md-4 col-lg-3">
								<label for="capacity">Capacité max</label>
								<input type="text" name="capacity" class="form-control" id="capacity" value="{{ $restaurant->capacity }}">
							</div>
							<div class="form-group col-xs-12 col-md-8 col-lg-6">
                                <label>Durée de réservation <em>(heures et minutes)</em></label>
                                <div class="col-xs-6">
                                    <input type="number" name="booking_duration_hour" class="form-control" min="0" value="{{ $booking_duration_hour }}">
                                </div>
                                <div class="col-xs-6">
                                    <select class="form-control" name="booking_duration_minute">
                                        <option value="00" @if($booking_duration_minute == "00") selected @endif>00</option>
                                        <option value="30" @if($booking_duration_minute == "30") selected @endif>30</option>
                                    </select>
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
