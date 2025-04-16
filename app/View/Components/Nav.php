<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Nav extends Component{
	public string $primero = "";
	public string $centro = "";
	public string $ultimo = "";
	private $inicio = '<a href="#"><li><i class="fa-solid ';
	private $mitad = '"></i>';
	private $final = '</li></a>';
	private $iconos = [
		"fa-chart-pie",
		"fa-mobile-screen",
		"fa-sliders",
		"fa-burger",
		"fa-qrcode"
	];
	private $contenido = [
		"Dashboard",
		"Mi menú principal",
		"Mis Categorias",
		"Mis productos",
		"Mi enlace y QR"
	];
	public function __construct($seleccionado = 1){
		$seleccionado = (int) $seleccionado;
		$lista = [];

		for($i=0; $i<5; $i++){
			if($i != $seleccionado){
				$lista[] = $this->inicio . $this->iconos[$i] . $this->mitad . $this->contenido[$i] . $this->final;
			}
			else{
				$lista[] = $this->iconos[$i] . $this->mitad . $this->contenido[$i] . $this->final;
			}
		}

		for($i=0; $i<$seleccionado; $i++){
			$this->primero .= $lista[$i];
		}

		$this->centro = '<a href=""><li class="seleccionado"><i class="fa-solid ' . $lista[$seleccionado];

		for($i=$seleccionado+1; $i<5; $i++){
			$this->ultimo .= $lista[$i];
		}
	}

	public function render(): View|Closure|string{
		return view('components.nav');
	}
}
