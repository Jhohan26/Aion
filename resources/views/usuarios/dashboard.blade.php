<?php

use App\Models\Usuario;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>

<x-app-layout title="Dashboard" css="dashboard">
	<div class="espacio"></div>
	<nav>
		<ul>
			<div class="nav antes">
				<div class="aion">
					<img class="icon" src="{{asset('./icons/aion_mono.svg')}}">
				</div>
				<a href="#"><li><i class="fa-solid fa-chart-pie"></i>Dashboard</li></a>
			</div>
			<a href=""><li class="seleccionado"><i class="fa-solid fa-mobile-screen"></i>Mi menú principal</li></a>
			<div class="nav despues">
				<a href="#"><li><i class="fa-solid fa-sliders"></i>Mis Categorias</li></a>
				<a href="#"><li><i class="fa-solid fa-burger"></i>Mis productos</li></a>
				<a href="#"><li><i class="fa-solid fa-qrcode"></i>Mi enlace y QR</li></a>
			</div>
			<div class="relleno"></div>
		</ul>
	</nav>
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