@extends('themes.definity')

@section('title', trans('booking.title'))

@section('head')
    <link rel="stylesheet" href="{{ asset('css/vendor/pickadate/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/pickadate/default.date.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/pickadate/default.time.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection

@section('navbar')
    <nav class="navbar navbar-default navbar-fixed-top mega navbar-small sticky-nav">
        @endsection

        @section('content')
            <section class="container">
                <h2 class="text-center title-create">Votre réservation</h2>
                <form method="post"
                      action="{{ route('restaurants.bookings.update', ['restaurant' => $restaurant->slug, 'booking' => $booking->id]) }}">
                    @if (count($errors) > 0)
                        <aside class="text-center alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <strong>Il y a des erreurs dans le formulaire</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </aside>
                    @endif
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $restaurant->id }}" name="id">
                    <input type="hidden"
                           @if(!is_null($booking))
                               value="{{\Carbon\Carbon::createFromDate($booking->start->format('y'),$booking->start->format('m'),$booking->start->format('d'))->dayOfWeek}}"
                            @else
                              value="1"
                            @endif
                           name="bookingDayNumber" id="bookingDayNumber">
                        <input type="hidden" value="{{ $booking->start->format('Y-m-d') }}" name="bookingDate" id="bookingDate">
                        {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-offset-2 col-md-4">
                            <div class="form-group @if($errors->has('name'))has-error @endif">
                                <input disabled="true" name="name" type="text" class="form-control" id="name" value="{{ $userLastname }}">
                                <label for="name">Nom <em>*</em></label>
                            </div>
                            <div class="form-group @if($errors->has('date') || $errors->has('date_submit'))has-error @endif">
                                <input data-url="{{ route('workhours.show', ['id' => $restaurant->id]) }}"
                                       class="form-control" type="text" name="date" id="date" value="@if(!is_null($booking)) {{$booking->start->format('d F, Y')}} @endif">
                                <label for="date">Date <em>*</em></label>
                            </div>
                            <div class="form-group @if($errors->has('time'))has-error @endif">
                                <select class="form-control" name="time" id="time">
                                        <option>Chargement heure de réservation</option>
                                </select>
                                <label for="time">Heure <em>*</em></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('phone'))has-error @endif">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="0601020304"
                                       value="@if(!is_null($booking)) {{$booking->phone}} @else {{ old('phone') }}  @endif">
                                <label for="phone">Numéro de Téléphone <em>*</em></label>
                            </div>
                            <div class="form-group @if($errors->has('guests'))has-error @endif">
                                <input name="guests"  min="1" class="form-control"
                                       type="number" id="guests" value="@if(!is_null($booking)) {{$booking->guests}} @else {{ old('guests') }}  @endif">
                                <label for="guests">Nombre de couverts <em>*</em></label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="details" id="details" rows="4"
                                          placeholder="Votre Message ici">@if(!is_null($booking)) {{$booking->details}} @else {{ old('details') }}  @endif</textarea>
                                <label for="txt-forms">Informations</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-large btn-colored-create">Modifier</button>
                    </div>
                </form>
            </section>
        @endsection

        @section('scripts')
            <script src="{{ asset('js/vendor/pickadate/picker.js') }}"></script>
            <script src="{{ asset('js/vendor/pickadate/picker.date.js') }}"></script>
            <script src="{{ asset('js/vendor/pickadate/picker.time.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/fr.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@endsection