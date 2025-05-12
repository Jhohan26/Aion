<?php

use App\Models\Usuario;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>

<link rel="stylesheet" type="text/css" href="{{asset('./css/header.css')}}">
<header>
	<div class="titulo">
		<img src="{{asset('./storage/'.$usuario->restaurantes->logo)}}" class="imagen">
		<h2>{{$usuario->restaurantes->nombre}}</h2>
	</div>
	<div class="links">
		<a class="plan" href="#">Mejora tu plan</a>
		<a class="salir "href="{{route('close')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
		<a href=""><i class="fa-solid fa-gear"></i></a>
	</div>
</header>