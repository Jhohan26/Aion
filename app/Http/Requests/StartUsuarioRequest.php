<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartUsuarioRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"email" => "required|email|min:5|max:45|exists:usuarios",
			"password" => "required|min:8|max:45",
		];
	}

	public function messages(){
		return [
			"email.required" => "El correo electrónico es obligatorio.",
			'email.email' => 'El correo electrónico debe ser una dirección válida.',
			"email.min" => "El correo electrónico debe tener al menos 5 caracteres.",
			"email.max" => "El correo electrónico no puede tener más de 45 caracteres.",
			"email.exists" => "Este correo electrónico no se encuentra registrado.",

			"password.required" => "La contraseña es obligatoria.",
			"password.min" => "La contraseña debe tener al menos 8 caracteres.",
			"password.max" => "La contraseña no puede tener más de 45 caracteres."
		];
	}
}
