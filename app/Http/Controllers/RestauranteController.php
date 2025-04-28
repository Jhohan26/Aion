<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Str;
use App\Http\Requests\SaveresRestauranteRequest;
use App\Http\Requests\NameRestauranteRequest;
use App\Http\Requests\NewCategoriaRequest;
use App\Http\Requests\AddProductoRequest;
use App\Http\Requests\UpdateCategoriaRequest;


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

	public function order(Request $request){
		if(strlen($request->orden) > 0){
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$orden = explode(",", $request->orden);

			$categorias = Categoria::where("restaurantes_id", $restaurante->id)->orderBy("orden", "asc")->get();

			for($i=0; $i<count($categorias); $i++){
				$categorias[$orden[$i]-1]->orden = $i+1;
				$categorias[$orden[$i]-1]->save();
			}
		}
		return redirect()->route("category");


	}

	public function new(NewCategoriaRequest $request){
		$categoria = new Categoria();
		$categoria->nombre = $request->categoria;
		$categoria->restaurantes_id = Restaurante::where("usuarios_id", session("sesion")["id"])->first()->id;
		$categoria->orden = Categoria::where("restaurantes_id", $categoria->restaurantes_id)->max("orden")+1;
		$categoria->save();

		return redirect()->route("category");
	}

	public function product(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("restaurantes/product");
		}
	}

	public function add(AddProductoRequest $request){
		$producto = $request->all();
		$categoria_seleccionada = $producto["categorias_id"];
		$producto["orden"] = Producto::where("categorias_id", $request->categorias_id)->max("orden")+1;
		Producto::create($producto);

		return redirect()->route("product", compact("categoria_seleccionada"));
	}

	public function delete($categoria){
		if(!isset($categoria)){
			return redirect()->route("dashboard");
		}
		else if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			$categoria = Categoria::find($categoria);
			if(!isset($categoria)){
				return redirect()->route("dashboard");
			}
			$restaurante = $categoria->restaurantes_id;
			if(Restaurante::where("id", $restaurante)->first()->usuarios_id != session("sesion")["id"]){
				return redirect()->route("dashboard");
			}
			else{
				$categoria->delete();
				$categorias = Categoria::where("restaurantes_id", $restaurante)->orderBy("orden", "asc")->get();
				for($i=0; $i<count($categorias); $i++){
					$categorias[$i]->orden = $i+1;
					$categorias[$i]->save();
				}
				return redirect()->route("category");
			}
		}
	}

	public function choose(Request $request){
		$categoria_seleccionada = $request->categoria;
		$productos = Producto::where("categorias_id", $categoria_seleccionada)->orderBy("orden", "asc")->get();
		return redirect()->route("product", compact("categoria_seleccionada"));
	}

	public function reorder(Request $Request){
		if(strlen($request->orden) > 0){
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$orden = explode(",", $request->orden);

			$productos = Producto::where("categorias_id", $request->categoria)->orderBy("orden")->get();

			for($i=0; $i<count($productos); $i++){
				$productos[$orden[$i]-1]->orden = $i+1;
				$productos[$orden[$i]-1]->save();
			}
		}
		return redirect()->route("category");
	}

	public function remove($producto){
		if(!isset($producto)){
			return redirect()->route("dashboard");
		}
		else if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			$producto = Producto::find($producto);
			if(!isset($producto)){
				return redirect()->route("dashboard");
			}
			$categoria_seleccionada = Categoria::find($producto->categorias_id);
			$restaurante = $categoria_seleccionada->restaurantes_id;
			if(Restaurante::where("id", $restaurante)->first()->usuarios_id != session("sesion")["id"]){
				return redirect()->route("dashboard");
			}
			else{
				$producto->delete();
				$producto = Producto::where("categorias_id", $producto->categorias_id)->orderBy("orden", "asc")->get();
				for($i=0; $i<count($producto); $i++){
					$producto[$i]->orden = $i+1;
					$producto[$i]->save();
				}
				return redirect()->route("product", compact("categoria_seleccionada"));
			}
		}
	}

	public function edit(Categoria $categoria){
		$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
		$categorias = Categoria::where("restaurantes_id", $restaurante->id)
		->get();
		if (!$categorias->contains("id", $categoria->id)){
			return redirect()->route("category");
		}
		else{
			return view("restaurantes/edit", compact("categoria"));
		}
	}

	public function update(UpdateCategoriaRequest $request){
		$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
		$categorias = Categoria::where("restaurantes_id", $restaurante->id)
		->get();
		if (!$categorias->contains("id", $request->id)){
			return redirect()->route("category");
		}
		else{
			$categoria = Categoria::find($request->id);
			$categoria->nombre = $request->nombre;
			$categoria->save();
			return redirect()->route("category");
		}
	}
}
