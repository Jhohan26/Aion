const contar = document.getElementById("name");
const contador = document.getElementById("contador");

contar.addEventListener("input", (evento) => {
	let texto;
	texto = contar.value.length + "/45";
	contador.textContent = texto;
});