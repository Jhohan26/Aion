<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SaveUsuarioRequest;
use App\Http\Requests\StartUsuarioRequest;

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

	public function save(SaveUsuarioRequest $request){
		$usuario = Usuario::create($request->all());
		$sesion = $usuario->toArray();
		session(["sesion" => $sesion]);

		return redirect()->route("create");
	}

	public function start(StartUsuarioRequest $request){
		$usuario = Usuario::where("email", $request->email)->first();

		if(!Hash::check($request->password, $usuario->password)){
			return back()->withErrors([
				"email" => "La contraseña o el email es incorrecto.",
			]);
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