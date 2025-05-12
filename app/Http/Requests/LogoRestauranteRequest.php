<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoRestauranteRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"logo" => "required|image|mimes:jpeg,png,jpg|max:4096"
		];
	}

	public function messages(){
		return [
			"logo.required" => "La imagen es obligatoria.",
			"logo.image" => "El archivo debe ser una imagen.",
			"logo.mimes" => "La imagen debe ser de tipo: jpeg, png o jpg.",
			"logo.max" => "La imagen no debe ser mayor a 4 MB."
		];
	}
}
