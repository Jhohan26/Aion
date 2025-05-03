const botones = document.getElementsByClassName("eliminar");
const accionar = document.getElementById("accionar");
let link;

function eliminar(evento){
	evento.preventDefault();
	link = this.href;
	modal.showModal();

	accionar.addEventListener("click", (evento) => {
		evento.preventDefault();
		window.location = link;
	});
}

for(let boton of botones){
	boton.addEventListener("click", eliminar);
}