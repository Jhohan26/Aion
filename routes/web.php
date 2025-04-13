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

Route::get("/create", [RestauranteController::class, "create"])->name("create");
Route::post("/saveres", [RestauranteController::class, "saveres"])->name("saveres");