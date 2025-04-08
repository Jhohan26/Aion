<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller{

	public function login(){
		return view("usuarios/login");
	}

	public function register(){
		return view("usuarios/register");
	}

	public function forget(){
		return view("usuarios/forget");
	}

	public function dashboard(){
		return view("usuarios/dashboard");
	}

	public function save(Request $request){
		if($request->email != $request->email2){
			return "No coinciden los emails";
		}
		else if($request->contrasena != $request->contrasena2){
			return "No coinciden las contraseña";
		}
		$usuario = new Usuario();
		$usuario->nombre = $request->usuario;
		$usuario->email = $request->email;
		$usuario->password = $request->contrasena;
		$usuario->email = $request->email;
		$usuario->created_at = now();

		$usuario->save();

		$sesion = $usuario->toArray();
		session(["sesion" => $sesion]);

		return redirect()->route("dashboard");

	}
}