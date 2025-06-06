<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Plantilla;
use Illuminate\Support\Str;
use App\Http\Requests\SaveresRestauranteRequest;
use App\Http\Requests\NameRestauranteRequest;
use App\Http\Requests\NewCategoriaRequest;
use App\Http\Requests\AddProductoRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\ChangeProductoRequest;
use App\Http\Requests\LogoRestauranteRequest;
use App\Http\Requests\FondoRestauranteRequest;


class RestauranteController extends Controller{
	public function main(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("restaurantes/main");
		}
	}

	public function dashboard(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("restaurantes/dashboard");
		}
	}

	public function create(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else if(Restaurante::where("usuarios_id", session("sesion")["id"])->first()){
			return redirect()->route("main");
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

			return redirect()->route("main");
		}

	}

	public function show($restaurante){
		$nombre = $restaurante;
		$restaurante = str_replace(" ", "-", $restaurante);
		$restaurante = str_replace("_", "-", $restaurante);
		$restaurante = Restaurante::where("url", $restaurante)->first();
		if(isset($restaurante)){
			$plantilla = $restaurante->plantillas_id;
			return view("plantillas/$plantilla", compact("restaurante"));
		}
		else{
			$nombre = str_replace("-", " ", $nombre);
			$nombre = str_replace("_", " ", $nombre);
			$nombre = str_replace("%20", " ", $nombre);
			return "Parece que no existe $nombre";
		}
	}

	public function name(NameRestauranteRequest $request){
		$url = Str::slug($request->nombre);
		if(Restaurante::where("url", $url)->where("usuarios_id", "<>", session("sesion")["id"])->first()){
			return back()->withErrors([
				"nombre" => "Este nombre ya se encuentra registrado."
			]);
		}
		else{
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();

			$restaurante->nombre = $request->nombre;
			$restaurante->url = $url;
			$restaurante->save();

			return redirect()->route("main");
		}
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
		$producto["imagen"] = $request->file("imagen")->store("productos", "public");
		Producto::create($producto);

		return redirect()->route("product", compact("categoria_seleccionada"));
	}

	public function delete(Categoria $categoria){
		if(!isset($categoria)){
			return redirect()->route("main");
		}
		else if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			$restaurante = $categoria->restaurantes_id;
			if(Restaurante::where("id", $restaurante)->first()->usuarios_id != session("sesion")["id"]){
				return redirect()->route("main");
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

	public function reorder(Request $request){
		if(strlen($request->orden) > 0){
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$orden = explode(",", $request->orden);
			$categoria_seleccionada = $request->categoria;
			$productos = Producto::where("categorias_id", $request->categoria)->orderBy("orden")->get();

			for($i=0; $i<count($productos); $i++){
				$productos[$orden[$i]-1]->orden = $i+1;
				$productos[$orden[$i]-1]->save();
			}
		}
		return redirect()->route("product", compact("categoria_seleccionada"));
	}

	public function remove(Producto $producto){
		if(!isset($producto)){
			return redirect()->route("main");
		}
		else if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			$categoria_seleccionada = Categoria::find($producto->categorias_id);
			$restaurante = $categoria_seleccionada->restaurantes_id;
			if(Restaurante::where("id", $restaurante)->first()->usuarios_id != session("sesion")["id"]){
				return redirect()->route("main");
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
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
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

	public function modify(Producto $producto){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$categorias = Categoria::where("restaurantes_id", $restaurante->id)
			->get();
			if (!$categorias->contains("id", $producto->categorias_id)){
				return redirect()->route("category");
			}
			else{
				return view("restaurantes/modify", compact("producto"));
			}
		}
	}

	public function change(ChangeProductoRequest $request){
		$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
		$categorias = Categoria::where("restaurantes_id", $restaurante->id)
		->get();
		$categoria_seleccionada = $request->categorias_id;
		if (!$categorias->contains("id", $request->categorias_id)){
			return redirect()->route("product");
		}
		else{
			$producto = Producto::find($request->id);
			$producto->nombre = $request->nombre;
			$producto->precio = $request->precio;
			$producto->descripcion = $request->descripcion;
			$producto->categorias_id = $request->categorias_id;
			if ($request->hasFile("imagen")){
				$producto->imagen = $request->file("imagen")->store("productos", "public");
			}
			$producto->save();
			return redirect()->route("product", compact("categoria_seleccionada"));
		}
	}

	public function template(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("restaurantes/template");
		}
	}

	public function select(Plantilla $plantilla){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$restaurante->plantillas_id = $plantilla->id;
			$restaurante->save();
			return redirect()->route("template");
		}
	}

	public function logo(LogoRestauranteRequest $request){
		$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
		$restaurante->logo = $request->file("logo")->store("logos", "public");
		$restaurante->save();

		return redirect()->route("main");
	}

	public function fondo(FondoRestauranteRequest $request){
		$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
		$restaurante->fondo = $request->file("fondo")->store("fondos", "public");
		$restaurante->save();

		return redirect()->route("main");
	}

	public function erase(Restaurante $restaurante){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else if(!isset($restaurante)){
			return redirect()->route("main");
		}
		else{
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$restaurante->fondo = "fondos/default.avif";
			$restaurante->save();
			return redirect()->route("main");
		}
	}

	public function reset(Restaurante $restaurante){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else if(!isset($restaurante)){
			return redirect()->route("dashboard");
		}
		else{
			$restaurante = Restaurante::where("usuarios_id", session("sesion")["id"])->first();
			$restaurante->visitas = 0;
			$restaurante->save();
			return redirect()->route("dashboard");
		}
	}

	public function chat(){
		if (!session()->has("sesion")){
			return redirect()->route("login");
		}
		else if(!isset(session("sesion")["email_verified_at"])){
			return redirect()->route("createCode");
		}
		else{
			return view("restaurantes/chat");
		}
	}
}