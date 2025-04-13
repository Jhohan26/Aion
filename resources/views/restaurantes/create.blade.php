<x-app-layout title="Inicia Sesión" css="create">
	<form method="POST" action="{{route('saveres')}}">
		@csrf
		<h1>Crea tu Restaurante</h1>
		<h6>Comencemos hablando de tu negocio.</h6>

		<div class="inputs">
			<input type="text" name="nombre" placeholder="Nombre de tu restaurante">
			<textarea name="descripcion" placeholder="Descripción"></textarea>
			<input class="iniciar" type="submit" value="Crear">
		</div>
	</form>
</x-app-layout>