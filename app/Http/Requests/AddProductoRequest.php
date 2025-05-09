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
			"categorias_id" => "required|exists:categorias,id",
			"imagen" => "required|image|mimes:jpeg,png,jpg|max:4096"
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

			"categorias_id.required" => "La categoria es obligatoria.",
			"categorias_id_exists" => "La categoria no existe.",

			"imagen.required" => "La imagen es obligatoria.",
			"imagen.image" => "El archivo debe ser una imagen.",
			"imagen.mimes" => "La imagen debe ser de tipo: jpeg, png o jpg.",
			"imagen.max" => "La imagen no debe ser mayor a 4 MB."
		];
	}
}
