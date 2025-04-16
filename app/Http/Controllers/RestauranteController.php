<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use Illuminate\Support\Str;
use App\Http\Requests\SaveresRestauranteRequest;


class RestauranteController extends Controller{
	public function create(){
		return view("restaurantes/create");
	}

	public function saveres(SaveresRestauranteRequest $request){
		if (session()->has("sesion")){
			$datos = $request->all();
			$datos["url"] = Str::slug($request->nombre);
			$datos["usuarios_id"] = session("sesion")["id"];

			Restaurante::create($datos);

		return redirect()->route("dashboard");
		}
		else{
			return redirect()->route("login");
		}
	}

	public function show($restaurante){
		$nombre = $restaurante;
		$restaurante = str_replace(" ", "-", $restaurante);
		$restaurante = Restaurante::find($restaurante);
		if(isset($restaurante)){
			return view("restaurantes/show", compact("restaurante"));
		}
		else{
			$nombre = str_replace("-", " ", $nombre);
			$nombre = str_replace("%20", " ", $nombre);
			return "Parece que no existe $nombre";
		}
	}

	public function name(Request $request){
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
