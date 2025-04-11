@props([
	"title" => "",
	"css" => ""
])
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aion - {{$title}}</title>
	<link rel="icon" href="{{asset('logo.svg')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/'.$css.'.css') }}">
	<script src="https://kit.fontawesome.com/b48cdd04ea.js" crossorigin="anonymous"></script>
</head>
<body>
	{{$slot}}
</body>
</html>