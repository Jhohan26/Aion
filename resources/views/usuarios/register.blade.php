<x-app-layout title="Regístrate" css="register">
	<form method="POST">
		<h1>Regístrate</h1>
		<h6>Empieza a ofrecer una experiencia moderna a tus comensales.</h6>

		<div class="inputs">
			<input type="text" name="usuario" placeholder="Usuario">
			<input type="email" name="email" placeholder="Email">
			<input type="email" name="email2" placeholder="Repite el correo electrónico">
			<input type="password" name="contrasena" placeholder="Contraseña">
			<input type="password" name="contrasena2" placeholder="Repite la contraseña">
			<input class="iniciar" type="submit" value="Continuar">
			<p>o</p>
			<a class="registrate" href="{{route('login')}}">Login</a>
		</div>

		<a class="olvidado" href="{{route('forget')}}">¿Has olvidado tu contraseña?</a>
	</form>
</x-app-layout>