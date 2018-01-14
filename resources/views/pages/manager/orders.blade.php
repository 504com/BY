@extends('themes.adminlte2')

@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Liste des commandes</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>#</th>
								<th>Restaurant</th>
								<th>Date réservée</th>
								<th>Crée le</th>
								<th>Détail de la commande</th>
							</thead>
							<tbody>
								@if (count($orders) === 0 )
									<tr>
										<td></td>
										<td><span class="label label-danger">Aucune commande enregistrée</span></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endif
								@foreach($orders as $order)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $order->restaurant->name }}</td>
										<td>{{ date('d/m/Y à H\hi', strtotime($order->order_date)) }}</td>
										<td>{{ date('d/m/Y à H\hi', strtotime($order->created_at)) }}</td>
										<td><a href="{{ route('manager.orders.show', ['id' => $order->id]) }}">Voir le détail</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
