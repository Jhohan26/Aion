<?php

use App\Models\Usuario;
use App\Models\Plantilla;
use Illuminate\Support\MessageBag;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$plantillas = Plantilla::all();

?>

<x-app-layout title="Plantillas" css="template">
	<x-nav seleccionado="4"/>
	<main>
		<x-header/>
		<div class="bento">
			<div class="todos">
				<h3>Todas las plantillas</h3>
				<div class="plantillas">
					@foreach($plantillas as $plantilla)
						<div class="plantilla">
							<h4>{{$plantilla->nombre}}</h4>
							<img class="preview" src="{{asset('./storage/'.$plantilla->preview)}}">
							@if($plantilla->id == $usuario->restaurantes->plantillas_id)
								<a class="seleccionado">Seleccionado</a>
							@else
								<a href="{{route('select', $plantilla)}}">Seleccionar</a>
							@endif
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</main>
</x-app-layout>