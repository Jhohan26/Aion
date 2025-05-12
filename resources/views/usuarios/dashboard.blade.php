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
			<form id="formulario_fondo" class="fondo" method="POST" action="{{route('fondo')}}" style="background-image: url('{{asset("./storage/".$usuario->restaurantes->fondo)}}');" enctype="multipart/form-data">
				@csrf
				<input id="fondo" name="fondo" type="file" accept=".jpg, .jpeg, .png">
				<label for="fondo"><i class="fa-solid fa-camera-rotate"></i><span>(PNG, JPG, JPEG)</span></label>
			</form>
			<div class="contenido">
				<form id="formulario_imagen" class="imagen" method="POST" action="{{route('logo')}}" style="background-image: url('{{asset("./storage/".$usuario->restaurantes->logo)}}');" enctype="multipart/form-data">
					@csrf
					<input id="logo" name="logo" type="file" accept=".jpg, .jpeg, .png">
					<label for="logo"><i class="fa-solid fa-camera-rotate"></i><span>(PNG, JPG, JPEG)</span></label>
				</form>
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
				<?php Helper::mostrarError("fondo"); ?>
				<?php Helper::mostrarError("logo"); ?>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/modalNombre.js')}}"></script>
	<script type="text/javascript">
		const logo = document.getElementById("logo");
		const formulario_imagen = document.getElementById("formulario_imagen");
		const fondo = document.getElementById("fondo");
		const formulario_fondo = document.getElementById("formulario_fondo");

		logo.addEventListener("change", function () {
			formulario_imagen.submit();
		});

		fondo.addEventListener("change", function () {
			formulario_fondo.submit();
		});
	</script>
</x-app-layout>