<x-mail::message>
<h1 style="text-align: center;">
Hola {{$usuario["nombre"]}}
</h1>

<h2 style="text-align: center;">
codigo de un solo uso:
</h2>

<x-mail::panel>
<p style="text-align: center; font-weight: bold; font-size: 24px;">
{{$usuario["remember_token"]}}
</p>
</x-mail::panel>
El usuario se ha creado hace unos segundos, si no fuiste tu omite este mensaje y no compartas el codigo
</x-mail::message>