<?php
use Illuminate\Support\MessageBag;

function mostrarError($campo){
	$errors = session('errors', new MessageBag());
	if($errors->has($campo)){
		$error = $errors->first($campo);
		echo("
			<div class='error'>
				<p>$error</p>
			</div>
		");
	}
}
?>

<x-app-layout title="Inicia Sesión" css="create">
	<form method="POST" action="{{route('saveres')}}">
		@csrf
		<h1>Crea tu Restaurante</h1>
		<h6>Comencemos hablando de tu negocio.</h6>

		<div class="inputs">
			<input type="text" name="nombre" placeholder="Nombre de tu restaurante" value="{{old('nombre')}}">
			<?php mostrarError("nombre"); ?>

			<textarea name="descripcion" placeholder="Descripción" value="{{old('descripcion')}}"></textarea>
			<?php mostrarError("descripcion"); ?>

			<input class="iniciar" type="submit" value="Crear">
		</div>
	</form>
</x-app-layout>