@if($hours->isEmpty())
    <option disabled>Le restaurant est fermé ce jour</option>
@else
    @foreach($hours as $hour)
        @if(\Carbon\Carbon::now() < $hour)
            <option>{{ $hour->format('H:i') }}</option>
        @endif
    @endforeach
@endif