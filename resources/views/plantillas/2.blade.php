<?php

use App\Models\Categoria;

$categorias = Categoria::where("restaurantes_id", $restaurante->id)
->orderBy("orden", "asc")
->with("productos")
->get();

$restaurante->visitas++;
$restaurante->save();

?>

<x-app-layout title="{{$restaurante->nombre}}" css="plantilla2">
	<header>
		<h1>Bienvenido a <hr>
			<b>{{$restaurante->nombre}}</b>
		</h1>
		<a href="{{route('show', $restaurante->url)}}"><img src="{{asset('./storage/'.$restaurante->logo)}}"></a>
	</header>
	<main>
		@if($restaurante->fondo != "fondos/default.avif")
		<section>
			<article>
				<img class="fondo" src="{{asset('./storage/'.$restaurante->fondo)}}">
			</article>
		</section>
		@endif
		<nav>
			<h2>Categorías</h2>
			<ul>
				@foreach($categorias as $categoria)
					<a href="#categoria-{{$categoria->id}}"><li>{{$categoria->nombre}}</li></a>
				@endforeach
			</ul>
		</nav>
		@foreach($categorias as $categoria)
			<h3 id="categoria-{{$categoria->id}}">{{$categoria->nombre}}</h3>
			<section class="categoria">
				@foreach($categoria->productos as $producto)
					<article class="producto">
						<img class="imagen" src="{{asset('./storage/'.$producto->imagen)}}">
						<h4>{{$producto->nombre}}</h4>
						<p>{{$producto->descripcion}}</p>
						<h5>${{$producto->precio}}</h5>
					</article>
				@endforeach
			</section>
		@endforeach
	</main>
</x-app-layout>