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

<x-app-layout title="Dashboard" css="category">
	<x-nav seleccionado="2"/>
	<main>
		<x-header/>
		<div class="bento">
			@foreach($categorias as $categoria)
				{{$categoria->nombre}}
				<br>
			@endforeach
		</div>
	</main>
</x-app-layout>