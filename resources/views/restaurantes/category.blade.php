<?php

use App\Models\Usuario;
use App\Models\Categoria;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$categorias = Categoria::where("restaurantes_id", $usuario->restaurantes->id)
->orderBy("orden", "asc")
->get();

?>

<x-app-layout title="Dashboard" css="dashboard">
	<x-nav seleccionado="2"/>
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
			@foreach($categorias as $categoria)
				{{$categoria->nombre}}
				<br>
			@endforeach
		</div>
	</main>
</x-app-layout>