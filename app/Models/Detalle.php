<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
	protected $table = "detalles";

	protected $fillable = [
		"restaurantes_id",
		"plantillas_id"
	];
}
