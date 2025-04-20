<?php
use App\Helpers\Helper;
?>

<x-app-layout title="Inicia Sesión" css="create">
	<form method="POST" action="{{route('saveres')}}">
		@csrf
		<h1>Crea tu Restaurante</h1>
		<h6>Comencemos hablando de tu negocio.</h6>

		<div class="inputs">
			<input type="text" name="nombre" placeholder="Nombre de tu restaurante" value="{{old('nombre')}}">
			<?php Helper::mostrarError("nombre"); ?>

			<textarea name="descripcion" placeholder="Descripción (opcional)" value="{{old('descripcion')}}"></textarea>
			<?php Helper::mostrarError("descripcion"); ?>

			<input class="iniciar" type="submit" value="Crear">
		</div>
	</form>
</x-app-layout>