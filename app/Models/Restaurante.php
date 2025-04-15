<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurante extends Model{
	protected $table = "restaurantes";
	protected $primaryKey = "url";
	protected $fillable = [
		"nombre",
		"descripcion",
		"url",
		"usuarios_id",
	];

	protected function nombre(): Attribute{
		return Attribute::make(
			set: fn ($valor) => ucwords($valor)
		);
	}
	public function getRouteKeyName(){
		return "url";
	}
}
