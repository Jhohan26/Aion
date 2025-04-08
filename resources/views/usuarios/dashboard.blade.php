<x-app-layout title="Creado" css="register">
	<h1>Bienvenido {{session("sesion")["nombre"]}}</h1>
	<a href="{{route('close')}}">Cerrar sesion</a>
</x-app-layout>