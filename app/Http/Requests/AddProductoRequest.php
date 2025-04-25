<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductoRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"nombre" => "required|min:3|max:45",
			"descripcion" => "max:255",
			"precio" => "required|numeric",
			"categorias_id" => "required"
		];
	}

	public function messages(){
		return [
			"nombre.required" => "El nombre es obligatorio.",
			"nombre.min" => "El nombre debe tener al menos 3 caracteres.",
			"nombre.max" => "El nombre no puede tener más de 45 caracteres.",

			"descripcion.max" => "La descripcion no puede tener más de 255 caracteres.",

			"precio.required" => "El precio es obligatorio.",
			"precio.numeric" => "El precio debe ser numerico.",

			"categorias_id.required" => "La categoria es obligatoria."
		];
	}
}
