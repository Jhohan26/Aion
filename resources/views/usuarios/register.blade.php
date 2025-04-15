<?php
use Illuminate\Support\MessageBag;

function mostrarError($campo){
	$errors = session('errors', new MessageBag());
	if($errors->has($campo)){
		$error = $errors->first($campo);
		echo("
			<div class='error'>
				<p>$error</p>
			</div>
		");
	}
}
?>

<x-app-layout title="Regístrate" css="register">
	<form method="POST" action="{{route('save')}}">
		@csrf
		<h1>Regístrate</h1>
		<h6>Empieza a ofrecer una experiencia moderna a tus comensales.</h6>


		<div class="inputs">
			<input type="text" name="nombre" placeholder="Nombre" value="{{old('nombre')}}">
			<?php mostrarError("nombre"); ?>

			<input type="text" name="email" placeholder="Email" value="{{old('email')}}">
			<?php mostrarError("email"); ?>

			<input type="text" name="email2" placeholder="Repite el correo electrónico" value="{{old('email2')}}">
			<?php mostrarError("email2"); ?>

			<input type="password" name="password" placeholder="Contraseña">
			<?php mostrarError("password"); ?>

			<input type="password" name="password2" placeholder="Repite la contraseña">
			<?php mostrarError("password2"); ?>

			<input class="iniciar" type="submit" value="Continuar">
			<p>o</p>
			<a class="registrate" href="{{route('login')}}">Login</a>
		</div>

		<a class="olvidado" href="{{route('forget')}}">¿Has olvidado tu contraseña?</a>
	</form>
</x-app-layout>