<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $table = "productos";

	protected $fillable = [
		"nombre",
		"descripcion",
		"precio",
		"imagen",
		"orden",
		"categorias_id"
	];

	protected function nombre(): Attribute{
		return Attribute::make(
			set: fn ($valor) => ucwords($valor)
		);
	}
}
