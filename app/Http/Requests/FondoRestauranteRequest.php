<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FondoRestauranteRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"fondo" => "required|image|mimes:jpeg,png,jpg|max:6144"
		];
	}

	public function messages(){
		return [
			"fondo.required" => "La imagen es obligatoria.",
			"fondo.image" => "El archivo debe ser una imagen.",
			"fondo.mimes" => "La imagen debe ser de tipo: jpeg, png o jpg.",
			"fondo.max" => "La imagen no debe ser mayor a 6 MB."
		];
	}
}
