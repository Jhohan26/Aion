<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Restaurante;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
	protected $model = Categoria::class;

	public function definition(): array
	{
	static $orden = 1;
		return [
			'nombre' => fake()->word(),
			'orden' => $orden++,
			'restaurantes_id' => 1
		];
	}
}
