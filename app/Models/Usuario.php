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

	protected $hidden = [
		"password",
		"remember_token",
	];

	protected function nombre(){
		return Attribute::make(
			set: function($valor){
				return ucfirst($valor);
			}
		);
	}

	// Relaciones
	public function restaurantes()
	{
		return $this->hasMany(Restaurante::class, "usuarios_id");
	}
}
