<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable si es un usuario del sistema
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $table = "usuarios";

	protected $fillable = [
		"nombre",
		"email",
		"password",
		"telefono",
	];

	protected $hidden = [
		"password",
		"remember_token",
	];

	// Relaciones
	public function restaurantes()
	{
		return $this->hasMany(Restaurante::class, "usuarios_id");
	}
}
