<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get("/", function (){
	return view("welcome");
});

Route::get("/login", [UsuarioController::class, "login"])->name("login");
Route::get("/register", [UsuarioController::class, "register"])->name("register");
Route::post("/save", [UsuarioController::class, "save"])->name("save");
Route::get("/forget", [UsuarioController::class, "forget"])->name("forget");
Route::get("/dashboard", [UsuarioController::class, "dashboard"])->name("dashboard");