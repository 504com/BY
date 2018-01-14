<!-- DAY -->
<div class="col-xs-7 col-md-4">
	<div class="form-group ">
		<label for="start">Jour</label>
		<div class="input-group">
			<select class="form-control" name="day[]">
				<option value="">Choisir un jour</option>
				@foreach(\App\Models\Day::all() as $day)
					<option value="{{ $day->id }}">{{ trans('admin.'.$day->name) }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
<!-- OPEN HOUR -->
<div class="col-xs-6 col-md-4">
	<div class="form-group ">
		<label for="start">Ouverture</label>
		<div class="input-group">
			<input type="text" name="start[]" class="form-control timepicker">
			<div class="input-group-addon">
				<i class="fa fa-clock-o"></i>
			</div>
		</div>
	</div>
</div>
<!-- CLOSE HOUR -->
<div class="col-xs-6 col-md-4">
	<div class="form-group ">
		<label for="end">Fermeture</label>
		<div class="input-group">
			<input type="text" name="end[]" class="form-control timepicker">
			<div class="input-group-addon">
				<i class="fa fa-clock-o"></i>
			</div>
		</div>
	</div>
</div>
