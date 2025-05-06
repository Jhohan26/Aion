<?php

use App\Models\Categoria;

$categorias = Categoria::where("restaurantes_id", $restaurante->id)
->orderBy("orden", "asc")
->with("productos")
->get();

?>

<x-app-layout title="{{$restaurante->nombre}}" css="plantilla1">
	<header>
		<a href="{{route('show', $restaurante->url)}}">
			<img src="{{asset('./img/sombrero.png')}}" class="logo">
		</a>
		<h1>Bienvenido a: <hr>
			<b>{{$restaurante->nombre}}</b>
		</h1>
	</header>
	<main>
		<section class="categorias">
			<h2>Categorías</h2>
			<div class="lista">
				<ul>
					@foreach($categorias as $categoria)
						<a href="#categoria-{{$categoria->id}}"><li>{{$categoria->nombre}}</li></a>
					@endforeach
				</ul>
				<i class="fa-solid fa-caret-right"></i>
			</div>
		</section>
		<section class="productos">
			@foreach($categorias as $categoria)
				<div id="categoria-{{$categoria->id}}" class="caja">
					<h3>{{$categoria->nombre}}</h3>
					@foreach($categoria->productos as $producto)
						<div class="producto">
							<img class="imagen" src="">
							<h4>{{$producto->nombre}}</h4>
							<p>${{$producto->precio}}</p>
						</div>
					@endforeach
				</div>
			@endforeach
		</section>
	</main>
</x-app-layout>