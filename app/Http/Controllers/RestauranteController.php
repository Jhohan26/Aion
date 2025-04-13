<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use Illuminate\Support\Str;

class RestauranteController extends Controller{
	public function create(){
		return view("restaurantes/create");
	}

	public function saveres(Request $request){
		if (session()->has("sesion")){
		$restaurante = new Restaurante();
		$restaurante->nombre = $request->nombre;
		$restaurante->url = Str::slug($request->nombre);
		$restaurante->descripcion = $request->descripcion;
		$restaurante->usuarios_id = session("sesion")["id"];

		$restaurante->save();

		return redirect()->route("dashboard");
		}
		else{
			return redirect()->route("login");
		}
	}
}
