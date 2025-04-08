<x-app-layout title="Regístrate" css="register">
	<form method="POST" action="{{route('save')}}">
		@csrf
		<h1>Regístrate</h1>
		<h6>Empieza a ofrecer una experiencia moderna a tus comensales.</h6>

		<div class="inputs">
			<input type="text" name="usuario" placeholder="Usuario" required>
			<input type="email" name="email" placeholder="Email" required>
			<input type="email" name="email2" placeholder="Repite el correo electrónico" required>
			<input type="password" name="contrasena" placeholder="Contraseña" required>
			<input type="password" name="contrasena2" placeholder="Repite la contraseña" required>
			<input class="iniciar" type="submit" value="Continuar" required>
			<p>o</p>
			<a class="registrate" href="{{route('login')}}">Login</a>
		</div>

		<a class="olvidado" href="{{route('forget')}}">¿Has olvidado tu contraseña?</a>
	</form>
</x-app-layout>