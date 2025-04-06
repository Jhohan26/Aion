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
			'nombre' => fake()->name(),
			'email' => fake()->unique()->safeEmail(),
			'email_verified_at' => fake()->boolean(80) ? now() : null,
			'password' => Hash::make('password'),
			'telefono' => fake()->optional()->phoneNumber(),
			'created_at' => now(),
			'updated_at' => now(),
		];
	}
}
