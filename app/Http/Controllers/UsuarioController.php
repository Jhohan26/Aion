<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SaveUsuarioRequest;
use App\Http\Requests\StartUsuarioRequest;
use App\Http\Requests\VerifyUsuarioRequest;

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
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("usuarios/dashboard");
		}
	}

	public function save(SaveUsuarioRequest $request){
		$usuario = $request->all();
		$usuario["remember_token"] = random_int(100000, 999999);
		$usuario["password"] = bcrypt($usuario["password"]);
		$usuario = Usuario::create($usuario);
		session(["sesion" => $usuario]);

		return redirect()->route("createCode");
	}

	public function start(StartUsuarioRequest $request){
		$usuario = Usuario::where("email", $request->email)->first();

		if(!Hash::check($request->password, $usuario->password)){
			return back()->withErrors([
				"email" => "La contraseña o el email es incorrecto.",
			]);
		}
		else{
			session(["sesion" => $usuario]);
			return redirect()->route("dashboard");
		}
	}

	public function close(){
		Session::flush();
		return redirect()->route("welcome");
	}

	public function code(){
		if(session()->has("sesion") && !isset(session("sesion")["email_verified_at"])){
			return view("usuarios/code");
		}
		else{
			return redirect()->route("dashboard");
		}
	}

	public function verify(Request $request){
		if(session("sesion")["remember_token"] == $request->codigo){
			$usuario = Usuario::find(session("sesion")["id"]);
			$usuario->email_verified_at = now();
			$usuario->save();
			session(["sesion" => $usuario]);
			return redirect()->route("create");
		}
		else{
			return back()->withErrors([
				"codigo" => "El codigo de verificación es incorrecto.",
			]);
		}
	}

	public function createCode(){
		$usuario = Usuario::find(session("sesion")["id"]);
		$usuario->remember_token = random_int(100000, 999999);
		$usuario->save();
		session(["sesion" => $usuario]);
		Mail::to(session("sesion")["email"])->send(new VerifyEmail(session("sesion")));
		return redirect()->route("code");
	}

	public function link(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("usuarios/link");
		}
	}
}