<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get("/", function (){
	return view("welcome");
});

Route::get("/login", [UsuarioController::class, "login"])->name("login");
Route::get("/register", [UsuarioController::class, "register"])->name("register");
Route::get("/forget", [UsuarioController::class, "forget"])->name("forget");