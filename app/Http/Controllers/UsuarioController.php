<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller{

	public function login(){
		return view("usuarios/login");
	}

	public function register(){
		return view("usuarios/register");
	}

	public function forget(){
		return view("usuarios/forget");
	}
}