<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable si es un usuario del sistema
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
	use HasFactory, Notifiable;

	protected $table = "usuarios";

	protected $fillable = [
		"nombre",
		"email",
		"password",
		"remember_token"
	];

	protected $hidden = [
		"password"
	];

	protected function nombre(): Attribute{
		return Attribute::make(
			set: fn ($valor) => ucwords($valor)
		);
	}

	protected function email(): Attribute{
		return Attribute::make(
			set: fn ($valor) => strtolower($valor)
		);
	}

	public function restaurantes()
	{
		return $this->hasOne(Restaurante::class, "usuarios_id");
	}
}