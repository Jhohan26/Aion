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
<x-app-layout title="Categorias" css="category">
	<x-nav seleccionado="2"/>
	<main>
		<dialog id="modal" closedBy="any">
			<div>
				<i class="fa-solid fa-circle-exclamation"></i>
				<h3>Eliminar categoria</h3>
				<p>
					<b>¡Cuidado!</b> Si vas a eliminar la categoria, tambien se van a eliminar los <b>productos</b> de esta,
					esta acción <b>no</b> se puede deshacer.
				</p>
				<form method="dialog" class="botones">
					<button class="cancelar">Cancelar</button>
					<button id="accionar" class="accionar">Eliminar</button>
				</form>
			</div>
		</dialog>
		<x-header/>
		<div class="bento">
			<form class="nuevo" method="POST" action="{{route('new')}}">
				@csrf
				<div class="entrada">
					<input id="name" type="text" name="categoria" value="{{old('categoria')}}" placeholder="Nueva categoría" maxlength="45">
					<p id="contador"></p>
					<i class="fa-solid fa-pen"></i>
				</div>
				<?php Helper::mostrarError("categoria"); ?>
				<input type="submit" name="" value="Crear">
			</form>
			@if(count($categorias) > 0)
				<form class="formulario_orden" method="POST" action="{{route('order')}}">
					@csrf
					<input type="hidden" name="orden" id="orden">
					<div class="reorden">
					@foreach($categorias as $categoria)
						<div class="elemento" id="{{$categoria->orden}}" data-id="{{$categoria->orden}}">
							<span><i class="fa-solid fa-grip-lines"></i>{{$categoria->nombre}}</span>
							<div class="acciones">
								<a href="{{route('edit', $categoria)}}" class="accion editar"><i class="fa-solid fa-pen"></i></a>
								<a href="{{route('delete', $categoria)}}" class="accion eliminar"><i class="fa-solid fa-trash-can"></i></a>
							</div>
						</div>
					@endforeach
					</div>
					@if(count($categorias) > 1)
					<input type="submit" name="submit" value="Guardar">
					<a class="restablecer" href="{{route('category')}}">Restablecer</a>
					@endif
				</form>
			@else
				<h3>Aún no tienes categorías D:</h3>
			@endif
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/modalEliminar.js')}}"></script>
</x-app-layout>