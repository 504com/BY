@extends('themes.definity')

@section('title', 'Réservation validée')

@section('content')
    <section id="booking-detail" class="container text-center">
        <article class="row">
            <div class="col-xs-offset-0 col-xs-12 col-md-offset-4 col-md-4">
                <header>
                    <h2>Réservation validée</h2>
					<p><em>Un mail de confirmation vous a été envoyé</em></p>
                </header>
                <ul class="list-square-check">
                    <li>
                        <h6>Restaurant</h6>
                        <p>{{ $restaurant->name }}</p>
                    </li>
                    <li>
                        <h6>Date de la réservation</h6>
                        <p>{{ $booking->start->format('d/m/Y') }}</p>
                    </li>
                    <li>
                        <h6>Heure de la réservation</h6>
                        <p>{{ $booking->start->format('H\hi') }}</p>
                    </li>
                </ul>
            </div>
        </article>
        @if($booking->order_id !== null)
            <article class="row">
				<div class="col-xs-12">
					<h2>Votre commande</h2>
					<div class="table-responsive">
						<table class="table checkout-table">
							<thead>
								<tr>
									<th></th>
									<th>{{ trans('cart.product') }}</th>
									<th>{{ trans('cart.quantity') }}</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach($booking->order->products as $key => $product)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $product->name }}</td>
									<td class="td-product-qty">{{ $product->pivot->quantity }}</td>
									<td>{{ number_format($product->pivot->quantity * $product->price, 2) }}€</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
            </article>
        @endif
    </section>
@endsection
