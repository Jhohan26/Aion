<x-app-layout title="Bienvenido" css="welcome">
	<header>
		<h1>AION</h1>
		<div>
			<img src="{{asset('./icons/aion_mono.svg')}}" class="logo">
		</div>
		<nav>
			<ul>
				<li><a href="#quienes">¿Quiénes somos?</a></li>
				<li><a class="boton" href="{{route('dashboard')}}">Empieza ahora</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<a href="https://wa.me/573228413950" target="_blank"><div class="whatsapp"><i class="fa-brands fa-whatsapp"></i></div></a>
		<section class="primero">
			<div>
				<h2>Digitaliza tu menú.</h2>
				<h3>Sorprende a tus clientes y Eleva tu restaurante</h3>
				<p>Con AION, crea menús inteligentes, visuales y elegantes accesibles desde un código QR</p>
				<a class="boton" href="{{route('dashboard')}}">Empieza ahora</a>
			</div>
			<img class="imagen1" src="{{asset('./img/index1.avif')}}">
		</section>
		<section id="quienes" class="segundo">
			<div>
				<h2>¿Quiénes somos?</h2>
				<h3>Somos AION, una nueva forma de conectar la experiencia gastronomica con las tecnología.</h3>
				<p>Creamos menús digitales inteligentes, visuales y elegantes accesibles desde un código QR, que ayudan a restaurantes, bares y pequeños negocios a destacarse y vender más.</p>
			</div>
			<img class="imagen2" src="{{asset('./img/index2.avif')}}">
		</section>
		<section class="tercero">
			<img class="imagen3" src="{{asset('./img/index3.avif')}}">
			<div>
				<h2>Nuestra filosofía</h2>
				<h3>Nacimos con una idea clara: hacer accesible lo que antes solo estaba al alcance de grandes restaurantes</h3>
				<p>Comienza tu menú desde unas plantillas frescas y modernas, organiza en segundos</p>
			</div>
		</section>
		<section class="cuarto">
			<h2>Lo que puedes hacer con AION</h2>
			<ul>
				<li>
					<div></div>
					<p>Gestionar tu menú con un panel sencillo e intuitivo.</p>
				</li>
				<li>
					<div></div>
					<p>Mostrar tu menú solo cuando lo necesites, con control total sobre tu servicio.</p>
				</li>
				<li>
					<div></div>
					<p>Personalizar tu carta con plantillas visuales y modernizadas.</p>
				</li>
			</ul>
		</section>
	</main>
</x-app-layout>