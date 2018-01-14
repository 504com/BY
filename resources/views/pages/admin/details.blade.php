@inject('repo', 'App\Repositories\OrderRepository')

@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Détail de la commande</h3>
			</div>
			<div class="col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Client : {{ $order->user->email }}</span>
						<span class="info-box-number">N° de la commande : {{ $order->id }}</span>
					</div>
				</div>
			</div>
			<div class="box-body">
				<table class="table table-striped table-bordered detailList" cellspacing="0" width="100%">
					<thead>
						<th></th>
						<th>Produit</th>
                        <th>Prix</th>
						<th>Quantité</th>
						<th>Total</th>
					</thead>
					<tbody>
						@foreach ($order->products as $product)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $product->name }}</td>
								<td>{{ number_format($product->price, 2) }}€</td>
								<td>{{ $product->pivot->quantity }}</td>
								<td>{{ number_format($product->price * $product->pivot->quantity, 2) }}€</td>
							</tr>
						@endforeach
					</tbody>
				</table><br>
			<div class="pull-right col-md-4">
				<div class="info-box bg-yellow">
					<span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">TOTAL</span>
						<span class="info-box-number">{{ number_format($repo->getTotal($order->id)->total, 2) }} €</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							...
						</span>
					</div>
				</div>
			</div>
		</div>
    </section>
@endsection
