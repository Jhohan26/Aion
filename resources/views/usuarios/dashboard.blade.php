<x-app-layout title="Dashboard" css="dashboard">
	<nav>
		<ul>
			<div class="nav antes">
				<div class="aion">
					<img class="icon" src="{{asset('./icons/aion_mono.svg')}}">
				</div>
				<a href="#"><li><i class="fa-solid fa-chart-pie"></i>Dashboard</li></a>
			</div>
			<a href=""><li class="seleccionado"><i class="fa-solid fa-mobile-screen"></i>Mi menú principal</li></a>
			<div class="nav despues">
				<a href="#"><li><i class="fa-solid fa-sliders"></i>Mis Categorias</li></a>
				<a href="#"><li><i class="fa-solid fa-burger"></i>Mis productos</li></a>
				<a href="#"><li><i class="fa-solid fa-qrcode"></i>Mi enlace y QR</li></a>
			</div>
			<div class="relleno"></div>
		</ul>
	</nav>
	<main>
		<header>
			<div class="titulo">
				<img src="{{asset('./img/sombrero.png')}}" class="imagen">
				<h2>Restaurante</h2>
			</div>
			<div class="links">
				<a href="#">Mejora tu plan</a>
				<button><i class="fa-solid fa-gear"></i></button>
			</div>
		</header>
		<div class="bento">
			<img class="fondo" src="{{asset('./img/fondo.png')}}">
			<div class="contenido">
				<img src="{{asset('./img/sombrero.png')}}" class="imagen">
				<form class="nombre">
					<label for="name">Nombre del negocio</label>
					<div class="entrada">
						<input type="text" name="name" value="Olmes Restaurante">
						<p>16/45</p>
						<i class="fa-solid fa-pen"></i>
					</div>
				</form>
			</div>
		</div>
	</main>
</x-app-layout>