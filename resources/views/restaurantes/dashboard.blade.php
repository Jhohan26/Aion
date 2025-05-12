<?php

use App\Models\Usuario;
use Illuminate\Support\MessageBag;
use App\Helpers\Helper;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>

<x-app-layout title="Dashboard" css="dashboard">
	<x-nav seleccionado="0"/>
	<main>
		<x-header/>
		<div class="bento">
			<div class="visitas">
				<i class="fa-solid fa-rotate"></i>
				<h3>{{$usuario->restaurantes->visitas}}</h3>
				<h4>Visitas</h4>
				<i class="fa-regular fa-eye"></i>
			</div>
		</div>
	</main>
</x-app-layout>