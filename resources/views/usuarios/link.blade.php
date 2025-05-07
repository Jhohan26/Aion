<?php

use App\Models\Usuario;
use App\Models\Restaurante;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

$url = $usuario->restaurantes->url;

?>

<script type="text/javascript" src="{{asset('./js/qrcode.js')}}"></script>
<x-app-layout title="Editar Categoria" css="link">
	<x-nav seleccionado="5"/>
	<main>
		<x-header/>
		<div class="bento">
			<h3>Enlace y QR</h3>
			<p class="url">{{route('show', $url)}}</p>
			<div class="enlaces">
				<div id="qrcode"></div>
				<button class="descargar" id="descargar">Descargar</button>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('./js/orden.js')}}"></script>
	<script type="text/javascript" src="{{asset('./js/counter.js')}}"></script>
	<script type="text/javascript">
		const boton = document.getElementById("descargar");

		const qr = new QRCode(document.getElementById("qrcode"), {
			text: "{{route('show', $url)}}",
			width: 1024,
			height: 1024,
			colorDark : "#22252a",
			colorLight : "#f4f4ff",
		});

		setTimeout(() => {
			const imagen = document.querySelector("#qrcode img");

			boton.addEventListener("click", () => {
				const link = document.createElement("a");
				link.href = imagen.src;
				link.download = "QR.png";
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			});
		}, 500);
	</script>
</x-app-layout>