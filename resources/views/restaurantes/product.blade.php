<?php

use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Producto;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$categorias = Categoria::where("restaurantes_id", $usuario->restaurantes->id)
->orderBy("orden", "asc")
->get();


$categoria_seleccionada = request()->query("categoria_seleccionada");

if ($categorias->contains("id", $categoria_seleccionada)){
	$productos = Producto::where("categorias_id", $categoria_seleccionada)
	->orderBy("orden", "asc")
	->get();
}


?>
<script type="text/javascript" src="{{asset('./js/sortable.js')}}"></script>
<x-app-layout title="Productos" css="product">
	<x-nav seleccionado="3"/>
	<main>
		<x-header/>
		<div class="bento">
			<form class="nuevo" method="POST" action="{{route('add')}}" enctype="multipart/form-data">
				@csrf
				<div class="entrada">
					<input id="name" type="text" name="nombre" value="{{old('nombre')}}" placeholder="Nombre del producto" maxlength="45">
					<p id="contador"></p>
					<i class="fa-solid fa-pen"></i>
				</div>
				<?php Helper::mostrarError("nombre") ?>
				<div class="entrada precio">
					<i class="fa-solid fa-dollar-sign"></i>
					<input class="entrada_precio" type="number" name="precio" value="{{old('precio')}}" placeholder="000.00" maxlength="45" step="0.01">
				</div>
				<?php Helper::mostrarError("precio") ?>
				<div class="entrada foto">
					<input type="file" id="imagen" name="imagen" class="archivo" accept=".jpg, .jpeg, .png">
					<label for="imagen" class="texto" id="texto">Selecciona una imagen (JPG, PNG)</label>
				</div>
				<?php Helper::mostrarError("imagen") ?>
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
			<div>
				@if(count($categorias) > 0)
					<form class="seleccionar" method="POST" action="{{route('choose')}}">
						@csrf
						<select id="categoria" name="categoria">
							@if(!isset($productos))
								<option disabled selected>Selecciona una categoria</option>
							@endif
							@foreach($categorias as $categoria)
							<option value="{{$categoria->id}}"
								<?php
									if(isset($categoria_seleccionada) && ($categoria_seleccionada == $categoria->id)){
										echo("selected");
									}
								?>
							>{{$categoria->nombre}}</option>
							@endforeach
						</select>
					</form>
					<form class="formulario_orden" method="POST" action="{{route('reorder')}}">
						@csrf
						<input type="hidden" name="orden" id="orden" value="">
						@if(isset($productos))
							<input type="hidden" name="categoria" value="{{$categoria_seleccionada}}">
							@if(count($productos) > 0)
								<div class="reorden">
								@foreach($productos as $producto)
									<div class="elemento" id="{{$producto->orden}}" data-id="{{$producto->orden}}">
										<span><i class="fa-solid fa-grip-lines"></i>{{$producto->nombre}}</span>
										<div class="acciones">
											<a href="{{route('modify', $producto)}}" class="accion editar"><i class="fa-solid fa-pen"></i></a>
											<a href="{{route('remove', $producto)}}" class="accion"><i class="fa-solid fa-trash-can"></i></a>
										</div>
									</div>
								@endforeach
								</div>
								@if(count($productos) > 1)
								<input type="submit" name="submit" value="Guardar">
								<a class="restablecer" href="{{route('product', compact('categoria_seleccionada'))}}">Restablecer</a>
								@endif
							@else
							<h3>Aún no tienes productos en esta categoria</h3>
							@endif
						@else
							<h3>Selecciona una categoria para reorganizar los productos</h3>
						@endif
					</form>
				@else
					<h3>Aún no tienes categorías D:</h3>
				@endif
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
	<script type="text/javascript">
		const formulario = document.getElementsByClassName("seleccionar")[0];
		const input = document.getElementById("categoria");

		input.addEventListener("input", (evento) => {
			// evento.preventDefault();
			formulario.submit();
		});

		document.getElementById("imagen").addEventListener("change", function(e) {
			const fileName = e.target.files[0] ? e.target.files[0].name : "No se ha seleccionado ningún archivo";
			document.getElementById("texto").textContent = fileName;
		});
	</script>
</x-app-layout>