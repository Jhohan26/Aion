<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurante extends Model{
	protected $table = "restaurantes";
	protected  $primaryKey = "url";

	protected function nombre(){
		return Attribute::make(
			set: function($valor){
				return ucwords($valor);
			}
		);
	}
	public function getRouteKeyName(){
		return "url";
	}
}
