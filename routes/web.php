<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RestauranteController;

Route::get("/", function (){
	return view("welcome");
})->name("welcome");

Route::get("/login", [UsuarioController::class, "login"])->name("login");
Route::get("/register", [UsuarioController::class, "register"])->name("register");
Route::post("/save", [UsuarioController::class, "save"])->name("save");
Route::get("/forget", [UsuarioController::class, "forget"])->name("forget");
Route::post("/start", [UsuarioController::class, "start"])->name("start");
Route::get("/close", [UsuarioController::class, "close"])->name("close");
Route::get("/code", [UsuarioController::class, "code"])->name("code");
Route::get("/createCode", [UsuarioController::class, "createCode"])->name("createCode");
Route::post("/verify", [UsuarioController::class, "verify"])->name("verify");
Route::get("/link", [UsuarioController::class, "link"])->name("link");


Route::get("/create", [RestauranteController::class, "create"])->name("create");
Route::get("/main", [RestauranteController::class, "main"])->name("main");
Route::post("/saveres", [RestauranteController::class, "saveres"])->name("saveres");
Route::post("/name", [RestauranteController::class, "name"])->name("name");
route::get("/category", [RestauranteController::class, "category"])->name("category");
route::get("/product", [RestauranteController::class, "product"])->name("product");
Route::get("/delete/{categoria}", [RestauranteController::class, "delete"])->name("delete");
Route::get("/remove/{producto}", [RestauranteController::class, "remove"])->name("remove");
Route::get("/edit/{categoria}", [RestauranteController::class, "edit"])->name("edit");
Route::get("/modify/{producto}", [RestauranteController::class, "modify"])->name("modify");
Route::get("/select/{plantilla}", [RestauranteController::class, "select"])->name("select");
Route::get("/template", [RestauranteController::class, "template"])->name("template");
route::get("/{restaurante}", [RestauranteController::class, "show"])->name("show");
Route::post("/order", [RestauranteController::class, "order"])->name("order");
Route::post("/new", [RestauranteController::class, "new"])->name("new");
Route::post("/add", [RestauranteController::class, "add"])->name("add");
Route::post("/choose", [RestauranteController::class, "choose"])->name("choose");
Route::post("/reorder", [RestauranteController::class, "reorder"])->name("reorder");
Route::post("/update", [RestauranteController::class, "update"])->name("update");
Route::post("/change", [RestauranteController::class, "change"])->name("change");
Route::post("/logo", [RestauranteController::class, "logo"])->name("logo");
Route::post("/fondo", [RestauranteController::class, "fondo"])->name("fondo");
