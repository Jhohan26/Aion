<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Restaurante;

class NameRestauranteRequest extends FormRequest
{

	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		$id = Restaurante::where("usuarios_id", session("sesion")["id"])->first()["id"];
		return [
			"nombre" => "required|min:3|max:45|unique:restaurantes,nombre,$id"
		];
	}

	public function messages(){
		return [
			"nombre.required" => "El nombre no puede ser vacio.",
			"nombre.min" => "El nombre debe tener al menos 3 caracteres.",
			"nombre.max" => "El nombre no puede tener más de 45 caracteres.",
			"nombre.unique" => "Este nombre ya se encuentra registrado.",
		];
	}
}
