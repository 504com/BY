@extends('beautymail::templates.widgets')

@section('content')
	@include('beautymail::templates.widgets.articleStart')
		<h4 class="secondary"><strong>Votre confirmation d'inscription</strong></h4>
		<div>
			<h4>Voici votre mot de passe, pensez à le modifier dès votre connexion</h4>
			<p>{{ $mdp }}</p>
			<br>
			<a href="#">Lien vers votre espace</a>
		</div>
	@include('beautymail::templates.widgets.articleEnd')
@stop
