<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyUsuarioRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"codigo" => "required|numeric|size:6"
		];
	}

	public function messages(){
		return [
			"codigo.required" => "El codigo de verificación es obligatorio.",
			"codigo.numeric" => "El codigo de verificación debe ser numerico",
			"codigo.size" => "El codigo de verificación debe contener 6 dígitos"
		];
	}
}
