@extends('beautymail::templates.widgets')

@section('content')
	@include('beautymail::templates.widgets.articleStart')
		<h4 class="secondary"><strong>Votre réservation a été annulée</strong></h4>
		<div>
			<h4>Nom de la réservation</h4>
			<p>{{ $userLastname }}</p>
			<h4>Restaurant</h4>
			<p>{{ $restaurant->name }}</p>
			<h4>Date et heure</h4>
			<p>{{ $booking->start->format('d/m/Y') }} à {{ $booking->start->format('H\hi') }}</p>
		</div>
	@include('beautymail::templates.widgets.articleEnd')

	@include('beautymail::templates.widgets.newfeatureStart')
		@if($booking->order_id !== null)
		<h4 class="secondary"><strong>Récapitulatif de la commande</strong></h4>
		<table border="0" align="center" cellpadding="0" cellspacing="0" style="Margin:0 auto;" width="400px">
			<thead>
				<tr>
					<th align="left"></th>
					<th align="left"><p>{{ trans('cart.product') }}</p></th>
					<th align="left"><p>{{ trans('cart.quantity') }}</p></th>
					<th align="left"><p>Total</p></th>
				</tr>
			</thead>
			<tbody>
				@foreach($booking->order->products as $key => $product)
					<tr>
						<td style="width: 30px;"><h4>{{ $key + 1 }}</h4></td>
						<td style="width: 170px;"><h4>{{ $product->name }}</h4></td>
						<td style="width: 60px;"><h5>{{ $product->pivot->quantity }}</h5></td>
						<td style="width: 60px;"><h5>{{ number_format($product->pivot->quantity * $product->price, 2) }}€</h5></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	@include('beautymail::templates.widgets.newfeatureEnd')
@stop
