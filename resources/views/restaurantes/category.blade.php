<?php

use App\Models\Usuario;
use App\Models\Categoria;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$categorias = Categoria::where("restaurantes_id", $usuario->restaurantes->id)
->orderBy("orden", "asc")
->get();

?>
<script type="text/javascript" src="{{asset('./js/sortable.js')}}"></script>
<x-app-layout title="Dashboard" css="category">
	<x-nav seleccionado="2"/>
	<main>
		<x-header/>
		<div class="bento">
			@if(count($categorias) > 0)
				<form class="formulario_orden" method="POST" action="{{route('order')}}">
					@csrf
					<input type="hidden" name="orden" id="orden">
					<div class="reorden">
					@foreach($categorias as $categoria)
						<div class="elemento" id="{{$categoria->orden}}" data-id="{{$categoria->orden}}">
							<i class="fa-solid fa-grip-lines"></i><span>{{$categoria->nombre}}</span>
						</div>
					@endforeach
					</div>
					@if(count($categorias) > 1)
					<input type="submit" name="submit" value="Guardar">
					<a href="{{route('category')}}">Reiniciar</a>
					@endif
				</form>
			@else
				<h3>Aún no tienes categorías D:</h3>
			@endif
			<form class="nuevo" method="POST" action="{{route('new')}}">
				@csrf
				<div class="entrada">
					<input id="name" type="text" name="categoria" value="{{old('categoria')}}" placeholder="Nueva categoría" maxlength="45">
					<p id="contador"></p>
					<i class="fa-solid fa-pen"></i>
				</div>
				<input type="submit" name="" value="Crear">
			</form>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
</x-app-layout>