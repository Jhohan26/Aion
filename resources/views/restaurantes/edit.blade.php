<?php

use App\Models\Usuario;
use App\Models\Categoria;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>

<x-app-layout title="Editar Categoria" css="edit">
	<x-nav seleccionado="2"/>
	<main>
		<x-header/>
		<div class="bento">
			<h3>Editar la categoria: {{$categoria->nombre}}</h3>
			<form class="nuevo" method="POST" action="{{route('update')}}">
				@csrf
				<div class="entrada">
					<input type="hidden" name="id" value="{{$categoria->id}}">
					<input id="name" type="text" name="nombre" value="{{old('nombre', $categoria->nombre)}}" placeholder="Cambiar nombre" maxlength="45">
					<p id="contador"></p>
					<i class="fa-solid fa-pen"></i>
				</div>
				<?php Helper::mostrarError("nombre"); ?>
				<div class="botones">
					<input type="submit" name="" value="Guardar">
					<a class="atras" href="{{route('category')}}">Cancelar</a>
				</div>
			</form>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
</x-app-layout>