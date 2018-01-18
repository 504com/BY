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
                        <th>#</th>
                        <th>Date réservée</th>
                        <th>Personnes</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @if (count($bookings) === 0 )
                            <tr>
                                <td></td>
                                <td><span class="label label-danger">Aucune réservation enregistrée</span></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ \App\Models\Restaurant::where('id', $booking->restaurant_id)->first()->slug }}</td>
                                    <td>{{ date('d/m/Y à H\hi', strtotime($booking->start)) }}</td>
                                    <td>{{ $booking->guests }}</td>
                                    <td>
                                        <a href="{{ route('restaurant.bookings.edit', ['id' => $booking->id]) }}" class="btn btn-very-small  btn-colored-update">Modifier</a>
                                        <a href="{{ route('restaurant.bookings.destroy', ['id' => $booking->id]) }}" class="btn btn-very-small btn-colored-update">Annuler</a>
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
