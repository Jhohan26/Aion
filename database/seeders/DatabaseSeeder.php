<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Restaurante;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Plantilla;
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

	private $imagenes = [
		"hamburguesas1.jpg",
		"hamburguesas2.jpg",
		"hamburguesas3.jpg",
		"perros1.jpg",
		"perros2.jpg",
		"perros3.jpg",
		"salchipapas1.jpg",
		"salchipapas2.jpg",
		"salchipapas3.jpg",
		"bebidas1.jpg",
		"bebidas2.jpg",
		"bebidas3.jpg",
		"adicionales1.jpg",
		"adicionales2.jpg",
		"adicionales3.jpg",
	];

	private $descripciones = [
		"Jugosa hamburguesa de res con lechuga, tomate y salsa especial.",
		"Hamburguesa de res con salsa barbacoa, cebolla caramelizada y queso cheddar.",
		"Deliciosa hamburguesa 100% vegetal con vegetales frescos y pan integral.",

		"Perro caliente tradicional con mostaza y kétchup.",
		"Salchicha con pan suave y una generosa porción de queso fundido.",
		"Perro caliente con todos los ingredientes: queso, tocineta, papitas y salsas.",

		"Papas fritas con salchichas en rodajas y salsa de la casa.",
		"Salchipapa tradicional con crujiente bacon encima.",
		"Salchipapa servida con queso rallado fundido por encima.",

		"Bebida gaseosa fría en variedad de sabores.",
		"Botella de agua natural, ideal para refrescarse.",
		"Cerveza nacional o importada bien fría.",

		"Crujientes papas fritas servidas con sal y aderezo opcional.",
		"Cebolla empanizada y frita hasta lograr un dorado perfecto.",
		"Dip cremoso de aguacate con tomate, cebolla y un toque de limón."
	];


	public function run(): void{
		Plantilla::create([
			"nombre" => "Plantilla AION",
			"preview" => "plantillas/plantilla1.png"
		]);
		Plantilla::create([
			"nombre" => "Plantilla Rojo acentuado",
			"preview" => "plantillas/plantilla2.png"
		]);

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

		$index = 0;
		foreach($this->productos as $producto => $categoria){
			Producto::create([
				"nombre" => $producto,
				"descripcion" => $this->descripciones[$index],
				"precio" => random_int(10, 999)*100,
				"imagen" => "productos/".$this->imagenes[$index],
				"orden" => $orden++,
				"categorias_id" => $categoria
			]);
			if($orden >= 4){
				$orden = 1;
			}
			$index++;
		}
	}
}
