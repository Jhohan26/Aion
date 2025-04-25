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
Route::get("/dashboard", [UsuarioController::class, "dashboard"])->name("dashboard");
Route::post("/start", [UsuarioController::class, "start"])->name("start");
Route::get("/close", [UsuarioController::class, "close"])->name("close");
Route::get("/code", [UsuarioController::class, "code"])->name("code");
Route::get("/createCode", [UsuarioController::class, "createCode"])->name("createCode");
Route::post("/verify", [UsuarioController::class, "verify"])->name("verify");


Route::get("/create", [RestauranteController::class, "create"])->name("create");
Route::post("/saveres", [RestauranteController::class, "saveres"])->name("saveres");
Route::post("/name", [RestauranteController::class, "name"])->name("name");
route::get("/category", [RestauranteController::class, "category"])->name("category");
route::get("/product", [RestauranteController::class, "product"])->name("product");
Route::get("/delete/{categoria}", [RestauranteController::class, "delete"])->name("delete");
route::get("/{restaurante}", [RestauranteController::class, "show"])->name("show");
Route::post("/order", [RestauranteController::class, "order"])->name("order");
Route::post("/new", [RestauranteController::class, "new"])->name("new");
Route::post("/add", [RestauranteController::class, "add"])->name("add");
Route::post("/choose", [RestauranteController::class, "choose"])->name("choose");