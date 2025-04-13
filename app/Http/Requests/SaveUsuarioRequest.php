<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUsuarioRequest extends FormRequest
{

	public function authorize(): bool
	{
		return true;
	}
	public function rules(): array
	{
		return [
			"nombre" => "required|min:5|max:45",
			"email" => "required|email|min:5|max:45|unique:usuarios",
			"email2" => "required|same:email",
			"password" => "required|min:8|max:45",
			"password2" => "required|same:password"
		];
	}

	public function messages(){
		return [
			"nombre.required" => "El nombre es obligatorio.",
			"nombre.min" => "El nombre debe tener al menos 5 caracteres.",
			"nombre.max" => "El nombre no puede tener más de 45 caracteres.",

			"email.required" => "El correo electrónico es obligatorio.",
			'email.email' => 'El correo electrónico debe ser una dirección válida.',
			"email.min" => "El correo electrónico debe tener al menos 5 caracteres.",
			"email.max" => "El correo electrónico no puede tener más de 45 caracteres.",
			"email.unique" => "Este correo electrónico ya se encuentra registrado.",

			"email2.required" => "La confirmación del correo electrónico es obligatoria.",
			"email2.same" => "Los correos electrónicos no coinciden.",

			"password.required" => "La contraseña es obligatoria.",
			"password.min" => "La contraseña debe tener al menos 8 caracteres.",
			"password.max" => "La contraseña no puede tener más de 45 caracteres.",

			"password2.required" => "La confirmación de la contraseña es obligatoria.",
			"password2.same" => "Las contraseñas no coinciden."
		];
	}
}
