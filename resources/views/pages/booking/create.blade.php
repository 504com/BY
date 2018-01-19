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
            <header class="page-title sticky-head">
                <div class="container">
                    <div class="row">
                        <a class="btn-ghost btn-small btn-colored"
                           href="{{route('restaurants.show', ['slug'=> $restaurant->slug]) }}">Retour à la page
                            précédente</a>
                    </div>
                </div>
            </header>
            <section class="container">
                <h2 class="text-center title-create">Votre réservation</h2>
                <form method="post"
                      action="{{ route('restaurants.bookings.store', ['restaurant' => $restaurant->slug]) }}">
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
                    <div class="row">
                        <div class="col-md-offset-2 col-md-4">
                            <div class="form-group @if($errors->has('name'))has-error @endif">
                                <input name="name" type="text" class="form-control" id="name" value="{{ $userLastname }}">
                                <label for="name">Nom <em>*</em></label>
                            </div>
                            <div class="form-group @if($errors->has('date') || $errors->has('date_submit'))has-error @endif">
                                <input data-url="{{ route('workhours.show', ['id' => $restaurant->id]) }}"
                                       class="form-control" type="text" name="date" id="date">
                                <label for="date">Date <em>*</em></label>
                            </div>
                            <div class="form-group @if($errors->has('time'))has-error @endif">
                                <select class="form-control" name="time" id="time">
                                    <option>Choisissez un jour</option>
                                </select>
                                <label for="time">Heure <em>*</em></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('phone'))has-error @endif">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="0601020304"
                                       value="{{ old('phone') }}">
                                <label for="phone">Numéro de Téléphone <em>*</em></label>
                            </div>
                            <div class="form-group @if($errors->has('guests'))has-error @endif">
                                <input name="guests" value="{{ old('guests') }}" min="1" class="form-control"
                                       type="number" id="guests">
                                <label for="guests">Nombre de couverts <em>*</em></label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="details" id="details" rows="4"
                                          placeholder="Votre Message ici">{{ old('details') }}</textarea>
                                <label for="txt-forms">Informations</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div v-show="withOrder" class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <strong>Choisissez votre commande parmi la carte ci-dessous</strong>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" v-model="withOrder" name="with_order" v-on:change="displayCart">
                                Commande anticipée ?
                            </label>
                        </div>
                        <button class="btn btn-large btn-colored-create">Réserver</button>
                    </div>
                    <div v-if="withOrder" v-for="(product, key) in products">
                        <input type="hidden" v-bind:value="product.id" name="products[]">
                        <input type="hidden" v-bind:value="product.quantity" name="quantities[]">
                    </div>
                </form>
                <section class="row" v-show="withOrder">
                    <div class="col-md-12">
                        <div id="restaurant_menu" class="container" data-id="{{ $restaurant->id }}">
                            <restaurant v-bind:products="products" order="true"></restaurant>
                        </div>
                    </div>
                </section>
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