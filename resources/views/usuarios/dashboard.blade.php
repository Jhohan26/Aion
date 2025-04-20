<?php

use App\Models\Usuario;
use Illuminate\Support\MessageBag;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>

<x-app-layout title="Dashboard" css="dashboard">
	<x-nav seleccionado="1"/>
	<main>
		<x-header/>
		<div class="bento">
			<img class="fondo" src="{{asset('./img/fondo.avif')}}">
			<div class="contenido">
				<img src="{{asset('./img/sombrero.png')}}" class="imagen">
				<form class="nombre" method="POST" action="{{route('name')}}">
					@csrf
					<label for="name">Nombre del negocio</label>
					<div class="entrada">
						<input id="name" type="text" name="nombre" value="{{old('nombre', $usuario->restaurantes->nombre)}}" maxlength="45">
						<p id="contador"></p>
						<i class="fa-solid fa-pen"></i>
					</div>
					<input type="submit" name="" value="Guardar">
				</form>
				<?php Helper::mostrarError("nombre"); ?>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
</x-app-layout>