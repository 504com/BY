@extends('themes.adminlte2')

@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total des utilisateurs</span>
						<span class="info-box-number">{{ count($users) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Liste des utilisateurs</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered dataTableList" cellspacing="0" width="100%">
							<thead>
								<th>#</th>
								<th>Nom</th>
								<th>Prénom</th>
								<th>E-mail</th>
								<th>Adresse</th>
								<th>Ville</th>
                                <th>Crée le</th>
							</thead>
							<tbody>
								@if (count($users) === 0 )
									<tr>
										<td></td>
										<td><span class="label label-danger">Aucun utilisateur enregistré</span></td>
										<td></td>
										<td></td>
                                        <td></td>
                                        <td></td>
										<td></td>
									</tr>
								@endif
								@foreach($users as $user)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $user->lastname }}</td>
										<td>{{ $user->firstname }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->address }}</td>
                                        <td>{{ $user->city }}</td>
										<td>{{ date('d/m/Y à H\hi', strtotime($user->created_at)) }}</td>
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
