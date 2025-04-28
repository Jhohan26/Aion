<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"id" => "required|exists:categorias",
			"nombre" => "required|min:3|max:45"
		];
	}

	public function messages(){
		return [
			"id.required" => "El link ha caducado por favor refresque.",
			"id.exists" => "El link ha caducado por favor refresque.",

			"nombre.required" => "El nombre de la categoria no puede ser vacio.",
			"nombre.min" => "El nombre de la categoria debe tener al menos 3 caracteres.",
			"nombre.max" => "El nombre de la categoria no puede tener más de 45 caracteres.",
		];
	}
}
