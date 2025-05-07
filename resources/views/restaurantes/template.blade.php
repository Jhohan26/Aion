<?php

use App\Models\Usuario;
use App\Models\Plantilla;
use App\Models\Detalles;
use Illuminate\Support\MessageBag;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$plantillas = Plantilla::all();

?>

<x-app-layout title="Dashboard" css="template">

	<x-nav seleccionado="4"/>
	<main>
		<x-header/>
		<div class="bento">
			<div class="todos">
				<h3>Todas las plantillas</h3>
				<div class="plantillas">
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
					<div class="plantilla">
						<h4>Nombre</h4>
						<img class="preview" src="{{asset('./img/preview.png')}}">
						<a class="seleccionar" href="">Seleccionar</a>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/modalNombre.js')}}"></script>
</x-app-layout>