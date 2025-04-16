<link rel="stylesheet" type="text/css" href="{{asset('./css/nav.css')}}">
<div class="espacio"></div>
<nav>
	<ul>
		<div class="nav antes">
			<div class="aion">
				<img class="icon" src="{{asset('./icons/aion_mono.svg')}}">
			</div>
		{!!$primero!!}
		</div>
		{!!$centro!!}
		<div class="nav despues">
			{!!$ultimo!!}
		</div>
		<div class="relleno"></div>
	</ul>
</nav>