<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get("/", function (){
	return view("welcome");
});

Route::get("/login", [UsuarioController::class, "login"]);