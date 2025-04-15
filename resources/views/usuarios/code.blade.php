<x-app-layout title="Confirmar" css="code">
	<form method="POST" action="{{route('verify')}}">
		@csrf
		<h1>Verifica tu correo</h1>
		<h6>Revisa tu bandeja de entrada o tu carpeta de spam de <b>{{session("sesion")["email"]}}</b></h6>

		<div class="inputs">
			<input type="text" name="codigo" placeholder="Ingresa el codigo de verificación" maxlength="6">
			@error('codigo')
				<div class="error">
					<p>{{$message}}</p>
				</div>
			@enderror
			<input class="iniciar" type="submit" value="Continuar">
			<a href="{{route('createCode')}}">Reenviar codigo</a>

			<a href="#" onclick="window.history.back();">Corregir el correo electrónico</a>
		</div>


	</form>
</x-app-layout>