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
		<dialog id="modal" closedBy="any">
			<div>
				<i class="fa-solid fa-circle-exclamation"></i>
				<h3>Cambio de nombre</h3>
				<p>
					<b>¡Cuidado!</b> Si vas a cambiar el nombre, tambien se va a remplazar el <b>URL</b> y el <b>QR</b>,
					por lo que deberas cambiar el link de tus redes sociales y las impresiones de tu restaurante.
				</p>
				<form method="dialog" class="botones">
					<button class="cancelar">Cancelar</button>
					<button id="accionar" class="accionar">Cambiar</button>
				</form>
			</div>
		</dialog>
		<x-header/>
		<div class="bento">
			<img class="fondo" src="{{asset('./img/fondo.avif')}}">
			<div class="contenido">
				<img src="{{asset('./img/sombrero.png')}}" class="imagen">
				<form id="nombre" class="nombre" method="POST" action="{{route('name')}}">
					@csrf
					<label for="name">Nombre del negocio</label>
					<div class="entrada">
						<input id="name" type="text" name="nombre" value="{{old('nombre', $usuario->restaurantes->nombre)}}" maxlength="45">
						<p id="contador"></p>
						<i class="fa-solid fa-pen"></i>
					</div>
					<input id="boton" type="button" name="" value="Guardar">
				</form>
				<?php Helper::mostrarError("nombre"); ?>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/modalNombre.js')}}"></script>
</x-app-layout>