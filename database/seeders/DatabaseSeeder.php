<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Restaurante;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder{
	private $seeders = [
		"Hamburguesas",
		"Perros",
		"Salchipapas",
		"Bebidas",
		"Adicionales"
	];

	private $productos = [
		"Hamburguesa Clásica" => 1,
		"Hamburguesa BBQ" => 1,
		"Hamburguesa Vegana" => 1,

		"Perro Clásico" => 2,
		"Perro con Queso" => 2,
		"Perro Especial" => 2,

		"Salchipapa Simple" => 3,
		"Salchipapa con Bacon" => 3,
		"Salchipapa con Queso" => 3,

		"Refresco" => 4,
		"Agua" => 4,
		"Cerveza" => 4,

		"Papas Fritas" => 5,
		"Aros de Cebolla" => 5,
		"Guacamole" => 5
	];

	public function run(): void{
		$usuario = new Usuario();
		$usuario->nombre = "Jhohan";
		$usuario->email = "jhohan.reyes@uniminuto.edu.co";
		$usuario->email_verified_at = now();
		$usuario->password = bcrypt("12345678");
		$usuario->telefono = "3202052470";
		$usuario->remember_token = random_int(100000, 999999);
		$usuario->save();

		$restaurante = new Restaurante();
		$restaurante->nombre = "Restaurante de Jhohan";
		$restaurante->url = Str::slug($restaurante->nombre);
		$restaurante->descripcion = "Descripcion epica";
		$restaurante->usuarios_id = 1;
		$restaurante->save();

		// Categoria::factory(5)->create();

		$orden = 1;
		foreach($this->seeders as $seeder){
			Categoria::create([
				"nombre" => $seeder,
				"orden" => $orden++,
				"restaurantes_id" => 1
			]);
		}

		$orden = 1;

		foreach($this->productos as $producto => $categoria){
			Producto::create([
				"nombre" => $producto,
				"precio" => random_int(1000, 999999),
				"orden" => $orden++,
				"categorias_id" => $categoria
			]);
			if($orden >= 4){
				$orden = 0;
			}
		}
	}
}
