<?php

use App\Models\Usuario;
use App\Models\Categoria;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$categorias = Categoria::where("restaurantes_id", $usuario->restaurantes->id)
->orderBy("orden", "asc")
->get();


?>
<script type="text/javascript" src="{{asset('./js/sortable.js')}}"></script>
<x-app-layout title="Productos" css="product">
	<x-nav seleccionado="3"/>
	<main>
		<x-header/>
		<div class="bento">
			<form class="nuevo" method="POST" action="{{route('add')}}">
				@csrf
				<div class="entrada">
					<input id="name" type="text" name="nombre" value="{{old('nombre')}}" placeholder="Nombre del producto" maxlength="45">
					<p id="contador"></p>
					<i class="fa-solid fa-pen"></i>
				</div>
				<?php Helper::mostrarError("nombre") ?>
				<div class="entrada precio">
					<i class="fa-solid fa-dollar-sign"></i>
					<input class="entrada_precio" type="number" name="precio" value="{{old('precio')}}" placeholder="000.00" maxlength="45">
				</div>
				<?php Helper::mostrarError("precio") ?>
				<select name="categorias_id" placeholder="hola">
					<option disabled selected>Selecciona una categoria</option>
					@foreach($categorias as $categoria)
					<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
					@endforeach
				</select>
				<?php Helper::mostrarError("categorias_id") ?>
				<textarea placeholder="Descripción (opcional)" name="descripcion">{{old("descripcion")}}</textarea>
				<?php Helper::mostrarError("descripcion") ?>
				<input type="submit" name="" value="Crear">
			</form>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
</x-app-layout>