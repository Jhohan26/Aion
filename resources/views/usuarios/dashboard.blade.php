<?php

use App\Models\Usuario;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>

<x-app-layout title="Dashboard" css="dashboard">
	<x-nav seleccionado="1"/>
	<main>
		<header>
			<div class="titulo">
				<img src="{{asset('./img/sombrero.png')}}" class="imagen">
				<h2>{{$usuario->restaurantes->nombre}}</h2>
			</div>
			<div class="links">
				<a class="plan" href="#">Mejora tu plan</a>
				<a class="salir "href="{{route('close')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
				<a href=""><i class="fa-solid fa-gear"></i></a>
			</div>
		</header>
		<div class="bento">
			<img class="fondo" src="{{asset('./img/fondo.png')}}">
			<div class="contenido">
				<img src="{{asset('./img/sombrero.png')}}" class="imagen">
				<form class="nombre" method="POST" action="{{route('name')}}">
					@csrf
					<label for="name">Nombre del negocio</label>
					<div class="entrada">
						<input id="name" type="text" name="nombre" value="{{$usuario->restaurantes->nombre}}" maxlength="45">
						<p id="contador"></p>
						<i class="fa-solid fa-pen"></i>
					</div>
					<input type="submit" name="" value="Guardar">
				</form>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
</x-app-layout>