<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Restaurante;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{

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
	}
}
