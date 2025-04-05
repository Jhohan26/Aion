<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
	protected $model = Usuario::class;

	public function definition(): array
	{
		return [
			'nombre' => $this->faker->name(),
			'email' => $this->faker->unique()->safeEmail(),
			'password' => Hash::make('password'), // Puedes cambiarlo si quieres algo random
			'telefono' => $this->faker->optional()->phoneNumber(),
			'created_at' => now(),
			'updated_at' => now(),
		];
	}
}
