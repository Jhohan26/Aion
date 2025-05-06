<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model{

	use HasFactory;

	protected $table = "categorias";

	protected $fillable = [
		"nombre",
		"orden",
		"restaurantes_id"
	];

	protected function nombre(): Attribute{
		return Attribute::make(
			set: fn ($valor) => ucwords($valor)
		);
	}

	public function productos(){
		return $this->hasMany(Producto::class, "categorias_id");
	}
}
