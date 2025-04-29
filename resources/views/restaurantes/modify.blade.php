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

$categoria_seleccionada = $producto->categorias_id;

?>

<x-app-layout title="Editar Categoria" css="modify">
	<x-nav seleccionado="3"/>
	<main>
		<x-header/>
		<div class="bento">
			<h3>Editar el producto: {{$producto->nombre}}</h3>
			<form class="nuevo" method="POST" action="{{route('change')}}">
				@csrf
				<input type="hidden" name="id" value="{{$producto->id}}">
				<div class="entrada">
					<input id="name" type="text" name="nombre" value="{{old('nombre', $producto->nombre)}}" placeholder="Nombre del producto" maxlength="45">
					<p id="contador"></p>
					<i class="fa-solid fa-pen"></i>
				</div>
				<?php Helper::mostrarError("nombre") ?>
				<div class="entrada precio">
					<i class="fa-solid fa-dollar-sign"></i>
					<input class="entrada_precio" type="number" name="precio" value="{{old('precio', $producto->precio)}}" placeholder="000.00" maxlength="45" step="0.01">
				</div>
				<?php Helper::mostrarError("precio") ?>
				<select name="categorias_id" placeholder="hola">
					@foreach($categorias as $categoria)
						@if($producto->categorias_id == $categoria->id)
						<option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
						@else
						<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
						@endif
					@endforeach
				</select>
				<?php Helper::mostrarError("categorias_id") ?>
				<textarea placeholder="Descripción (opcional)" name="descripcion">{{old("descripcion", $producto->descripcion)}}</textarea>
				<?php Helper::mostrarError("descripcion") ?>
				<div class="botones">
					<input type="submit" name="" value="Guardar">
					<a class="atras" href="{{route('product', compact('categoria_seleccionada'))}}">Cancelar</a>
				</div>
			</form>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
</x-app-layout>