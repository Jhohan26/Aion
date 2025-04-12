<x-app-layout title="Inicia Sesión" css="login">
	<form method="POST" action="{{route('start')}}">
		@csrf
		<h1>Iniciar Sesión</h1>
		<h6>Bienvenido de nuevo, ¡te estábamos esperando!</h6>

		<div class="inputs">
			<input type="text" name="email" placeholder="Email">
			<input type="password" name="contrasena" placeholder="Contraseña">
			<input class="iniciar" type="submit" value="Iniciar Sesión">
			<p>o</p>
			<a class="registrate" href="{{route('register')}}">Regístrate</a>
		</div>

		<a class="olvidado" href="{{route('forget')}}">¿Has olvidado tu contraseña?</a>
	</form>
</x-app-layout>