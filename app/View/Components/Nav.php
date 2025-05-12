<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Nav extends Component{
	public string $primero = "";
	public string $centro = "";
	public string $ultimo = "";
	private $inicio1 = '<a href="';
	private $inicio2 = '"><li><i class="fa-solid ';
 	private $mitad = '"></i>';
	private $final = '</li></a>';
	private $iconos = [
		"fa-chart-pie",
		"fa-mobile-screen",
		"fa-sliders",
		"fa-burger",
		"fa-sheet-plastic",
		"fa-qrcode"
	];
	private $contenido = [
		"Dashboard",
		"Mi menú principal",
		"Mis Categorias",
		"Mis productos",
		"Mis plantillas",
		"Mi enlace y QR"
	];
	private $rutas = [
		"dashboard",
		"main",
		"category",
		"product",
		"template",
		"link"
	];

	public function __construct($seleccionado = 1){
		$seleccionado = (int) $seleccionado;
		$lista = [];

		for($i=0; $i<6; $i++){
			if($i != $seleccionado){
				$lista[] = $this->inicio1 . route($this->rutas[$i]) . $this->inicio2 . $this->iconos[$i] . $this->mitad . $this->contenido[$i] . $this->final;
			}
			else{
				$lista[] = $this->iconos[$i] . $this->mitad . $this->contenido[$i] . $this->final;
			}
		}

		for($i=0; $i<$seleccionado; $i++){
			$this->primero .= $lista[$i];
		}

		$this->centro = '<a href="'.route($this->rutas[$seleccionado]).'"><li class="seleccionado"><i class="fa-solid ' . $lista[$seleccionado];

		for($i=$seleccionado+1; $i<6; $i++){
			$this->ultimo .= $lista[$i];
		}
	}

	public function render(): View|Closure|string{
		return view('components.nav');
	}
}
