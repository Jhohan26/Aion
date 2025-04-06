@props(["title" => ""])

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aion - {{$title}}</title>
</head>
<body>
	{{$slot}}
	<footer>
		<div class="bg-gray-800 text-white py-4 mt-8">
			<div class="container mx-auto text-center">
				<p>&copy; {{ date('Y') }} Aion. Los derechos son libres hasta el momento que se elimine el repositorio.</p>
			</div>
		</div>
	</footer>
</body>
</html>