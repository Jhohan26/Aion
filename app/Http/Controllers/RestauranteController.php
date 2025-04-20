<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use Illuminate\Support\Str;
use App\Http\Requests\SaveresRestauranteRequest;
use App\Http\Requests\NameRestauranteRequest;


class RestauranteController extends Controller{
	public function create(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else if(Restaurante::where("usuarios_id", session("sesion")["id"])->first()){
			return redirect()->route("dashboard");
		}
		else{
			return view("restaurantes/create");
		}
	}

	public function saveres(SaveresRestauranteRequest $request){
		if(Restaurante::where("usuarios_id", session("sesion")["id"])->first()){
			return back()->withErrors([
				"nombre" => "Solo se puede crear un restaurante por usuario."
			]);
		}
		else if(Restaurante::where("url", Str::slug($request->nombre))->first()){
			return back()->withErrors([
				"nombre" => "Este nombre ya se encuentra registrado."
			]);
		}
		else{
			$datos = $request->all();
			$datos["url"] = Str::slug($request->nombre);
			$datos["usuarios_id"] = session("sesion")["id"];

			Restaurante::create($datos);

			return redirect()->route("dashboard");
		}

	}

	public function show($restaurante){
		$nombre = $restaurante;
		$restaurante = str_replace(" ", "-", $restaurante);
		$restaurante = str_replace("_", "-", $restaurante);
		$restaurante = Restaurante::find($restaurante);
		if(isset($restaurante)){
			return view("restaurantes/show", compact("restaurante"));
		}
		else{
			$nombre = str_replace("-", " ", $nombre);
			$nombre = str_replace("_", " ", $nombre);
			$nombre = str_replace("%20", " ", $nombre);
			return "Parece que no existe $nombre";
		}
	}

	public function name(NameRestauranteRequest $request){
		$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();

		$restaurante->nombre = $request->nombre;
		$restaurante->save();

		return redirect()->route("dashboard");
	}

	public function category(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("restaurantes/category");
		}
	}
}
