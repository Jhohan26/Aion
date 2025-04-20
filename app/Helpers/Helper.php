<?php

namespace App\Helpers;

use Illuminate\Support\MessageBag;

class Helper{
	public static function mostrarError($campo){
		$errors = session('errors', new MessageBag());
		if($errors->has($campo)){
			$error = $errors->first($campo);
			echo("
				<div class='error'>
					<p>$error</p>
				</div>
			");
		}
	}
}