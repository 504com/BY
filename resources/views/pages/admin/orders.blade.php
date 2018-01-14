@inject('repo', 'App\Repositories\OrderRepository')

@extends('themes.adminlte')

@section('content')
    <section class="content">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				@if(session()->has('message'))
					<div class="row">
						<div class="col-xs-10 col-md-4">
							<div class="alert alert-success fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session()->get('message') }}
							</div>
						</div>
					</div>
				@endif
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Liste des commandes</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>Numéro</th>
								<th>Nom Client</th>
								<th>Date</th>
								<th>Total de la commande</th>
								<th>Détail de la commande</th>
								<th></th>
							</thead>
							<tbody>
								@if (sizeof($orders) === 0)
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><span class="label label-danger">Aucune Commande</span></td>
									<td></td>
								</tr>
								@endif
								@foreach ($orders as $order)
								<tr>
									<td>{{ $order->id }}</td>
									<td>{{ $order->user->email }}</td>
									<td>{{ $order->order_date->format('d/m/Y H\hi') }}</td>
									<td>{{ number_format($repo->getTotal($order->id)->total, 2) }}€</td>
									<td><a href="{{ route('admin.orders.show', ['order' => $order->id]) }}">Voir le détail</a></td>
									<td><a href="{{ route('admin.orders.destroy', ['id' => $order->id]) }}" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
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
