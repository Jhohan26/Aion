<?php

use App\Models\Usuario;

$usuario = Usuario::where("id", session("sesion")["id"])
->with("restaurantes")
->first();

?>
@vite(['resources/js/chat.js'])
<x-app-layout title="Dashboard" css="chat">
	<x-nav seleccionado="6"/>
	<main>
		<x-header/>
		<div class="bento">
			<div class="bienvenida" id="bienvenida">
				<div class="saludos">
					<h3>¡Bienvenido al chatbot!</h3>
					<h4>¡Hola! ¿Necesitas ayuda con la plataforma?<br>Estoy aquí para ayudarte.</h4>
				</div>
				<img src="{{asset('./img/robot.avif')}}" class="robot">
				<ul class="checks">
					<li><img src="{{asset('./img/check.avif')}}">Gestiona tu menú</li>
					<li><img src="{{asset('./img/check.avif')}}">Personaliza tu diseño</li>
					<li><img src="{{asset('./img/check.avif')}}">Organiza tus platos</li>
				</ul>
			</div>
			<div id="respuesta" class="respuesta hidden">
				<!-- <p class="usuario">Como puedo hacer un menu en 5 pasos?</p> -->
				<!-- <p class="bot">¡Claro! Crear un menú en nuestra plataforma es muy sencillo. Aquí te presento los 5 pasos principales:<br><br>1.  <b>Dashboard > Mi Menu Principal:</b>  Comienza en la sección "Mi Menu Principal". Aquí es donde defines la identidad visual de tu restaurante.<br>2.  <b>Personaliza el Diseño:</b>  Cambia el logo, el fondo y el nombre de tu restaurante. Recuerda que el nombre del restaurante está ligado a la URL y al QR, así que ten cuidado al modificarlo.<br>3.  <b>Define las Categorías:</b>  Ve a "Mis Categorías" y agrega las categorías que usarás en tu menú (ej: Entradas, Platos Principales, Postres, Bebidas). Puedes reordenarlas arrastrándolas. ¡Ojo! Eliminar una categoría también elimina los productos asociados.<br>4.  <b>Añade los Productos:</b>  Dirígete a "Mis Productos".  Para cada plato, ingresa: Nombre, Precio, Imagen, Categoría y Descripción.  La descripción es opcional.  Puedes reordenar los productos dentro de cada categoría arrastrándolos.<br>5.  <b>Mi Enlace y QR:</b>  Una vez que hayas configurado tu menú, ve a "Mi Enlace y QR".  Verás el enlace y el QR generados automáticamente.  Si necesitas cambiar el enlace, hazlo basándote en el nombre de tu restaurante.<br><br>¿Te gustaría que te guiara por alguno de estos pasos con más detalle, o quizás quieres empezar por una sección específica?<br></p> -->
			</div>
			<form id="chatear" class="chatear">
				<label>
					<input type="text" name="chat" id="chat" class="chat" placeholder="Pregunta lo que quieras">
					<button class="boton"><i class="fa-solid fa-paper-plane" id="icono"></i></button>
				</label>
			</form>
		</div>
	</main>
</x-app-layout>