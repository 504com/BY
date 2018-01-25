@extends('themes.definity')

@section('title', trans('home.title'))
@section('content')
<section class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total des réservations</span>
                        <span class="info-box-number">{{ count($bookings) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="box-header">
                    <h3 class="box-title">Liste des réservations</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
                        <thead>
                        <th  style="text-align: center">Détails </th>
                        <th  style="text-align: center">Modifier / Annuler</th>
                        </thead>
                        <tbody>
                        @if (count($bookings) === 0 )
                            <tr>
                                <td></td>
                                <td><span class="label label-danger">Aucune réservation enregistrée</span></td>
                            </tr>
                        @else
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>
                                        <p style="text-align: center">{{ \App\Models\Restaurant::where('id', $booking->restaurant_id)->first()->name }}</p>
                                        <p  style="text-align: center">{{ date('d/m/Y à H\hi', strtotime($booking->start)) }}</p>
                                        <p style="text-align: center">{{ $booking->guests }} personne(s)</p>
                                    </td>
                                    <td>
                                        <p style="margin: 0px 0px 10px 5px; text-align: center"><a  href="{{ route('restaurant.bookings.edit', ['id' => $booking->id]) }}" class="btn btn-very-small">Modifier</a></p>
                                        <p style="margin: 0px 0px 10px 5px; text-align: center"><a  href="{{ route('restaurant.bookings.destroy', ['id' => $booking->id]) }}" class="btn btn-very-small">Annuler</a></p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
        </div>
    </section>
</section>
@endsection


@section('scripts')
<script src="{{ asset('js/latlon-geohash.js') }}"></script>
<script src="{{ asset('js/location.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwcWM5eZSndJHE_oVw00zmU35dZz8usxs&libraries=places&callback=initAutocomplete"
                async defer></script>
<script>if (window.location.hash == '#_=_'){
                    history.replaceState
                        ? history.replaceState(null, null, window.location.href.split('#')[0])
                        : window.location.hash = '';
                }
</script>
@endsection
