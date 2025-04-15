const contar = document.getElementById("name");
const contador = document.getElementById("contador");

function mostrarCantidad(evento){
	let texto;
	texto = contar.value.length + "/45";
	contador.textContent = texto;
}

mostrarCantidad();

contar.addEventListener("input", mostrarCantidad);