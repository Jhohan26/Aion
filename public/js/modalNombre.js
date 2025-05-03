const formulario = document.getElementById("nombre");
const modal = document.getElementById("modal");
const boton = document.getElementById("boton");
const accionar = document.getElementById("accionar");
const entrada = document.getElementById("name");

boton.addEventListener("click", () => modal.showModal());

function enviar(evento){
	evento.preventDefault();
	formulario.submit();
}

function evitar(evento){
	if(evento.key == "Enter"){
		evento.preventDefault();
		modal.showModal();
	}
}

entrada.addEventListener("keydown", evitar);
accionar.addEventListener("click", enviar);