<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCategoriaRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"categoria" => "required|min:3|max:45"
		];
	}

	public function messages(){
		return [
			"categoria.required" => "El nombre de la categoria no puede ser vacio.",
			"categoria.min" => "El nombre de la categoria debe tener al menos 3 caracteres.",
			"categoria.max" => "El nombre de la categoria no puede tener más de 45 caracteres.",
		];
	}
}
