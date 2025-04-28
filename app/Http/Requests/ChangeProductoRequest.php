<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProductoRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"id" => "required|exists:productos",
			"nombre" => "required|min:3|max:45",
			"precio" => "required|numeric",
			"descripcion" => "max:255",
			"categorias_id" => "required|exists:categorias,id"
		];
	}

	public function messages(){
		return [
			"id.required" => "El link ha caducado por favor refresque.",
			"id.exists" => "El link ha caducado por favor refresque.",

			"nombre.required" => "El nombre es obligatorio.",
			"nombre.min" => "El nombre debe tener al menos 3 caracteres.",
			"nombre.max" => "El nombre no puede tener más de 45 caracteres.",

			"descripcion.max" => "La descripcion no puede tener más de 255 caracteres.",

			"precio.required" => "El precio es obligatorio.",
			"precio.numeric" => "El precio debe ser numerico.",

			"categorias_id.required" => "La categoria es obligatoria.",
			"categorias_id_exists" => "La categoria no existe."
		];
	}
}
