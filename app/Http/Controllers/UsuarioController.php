<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
		if (session()->has("sesion")){
			return view("usuarios/dashboard");
		}
		else{
			return redirect()->route("login");
		}
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

		return redirect()->route("create");
	}

	public function start(Request $request){
		$email = strtolower($request->email);
		$usuario = Usuario::where("email", $email);

		if($usuario->count() != 1){
			return "Email o contraseña incorrecta";
		}

		$usuario = $usuario->first();

		if(!Hash::check($request->contrasena, $usuario->password)){
			return "Email o contraseña incorrecta";
		}
		else{
			$sesion = $usuario->toArray();
			session(["sesion" => $sesion]);
			return redirect()->route("dashboard");
		}
	}

	public function close(){
		Session::flush();
		return redirect()->route("welcome");
	}
}