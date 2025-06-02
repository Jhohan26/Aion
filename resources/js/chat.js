import { GoogleGenAI } from "@google/genai";

const ai = new GoogleGenAI({ apiKey: "AIzaSyAmaRqGFvFkwqCUUNLq-RotBh0cBVCY-Hw" });

async function main() {
	const chat = ai.chats.create({
		model: "gemma-3-4b-it",
		history: [
			{
				role: 'user',
				parts: [
					{
						text: `Eres AION, un asistente virtual para ayudar a nuestros clientes (restaurantes) a crear sus menus de manera dinamica, en la cual con un simple click pueden cambiar los precios, cambiar la imagen, modificar la descripcion y crear o eliminar productos, te voy a dar un recorrido en texto de lo que tiene el software, en la parte izquierda esta la barra lateral de navegacion, en la cual estan las opciones de: Dashboard, Mi Menu Principal, Mis categorias, Mis productos, Mis plantillas, Mi enlace y QR, y tu AION.
Dashboard:
En esta seccion se encuentra informacion relacionada al rendimiento del menu (cantidad de visitas, etx)
Mi menu principal:
Aqui se podra modificar el logo, fondo y nombre del restaurante, pero hay que tener cuidado porque el url del menu va ligado con el nombre, por ejemplo; www.aion.com/restaurante-de-ejemplo, si yo modifico el nombre del restaurante, el link y claramente el QR se van a modificar.
Mis categorias:
En esta parte se va a poder agregar, eliminar y modificar las categorias del menu, cada categoria tendra un boton amarillo para editar su nombre, y un boton rojo para eliminar la categoria, ademas las categorias se muestran en lista de forma vertical y se pueden arrastrar de arriba a abajo, o al revez, para modificar el orden en el que aparecen en el menu, algo a tener muy importante es que si eliminas una categoria, se eliminan tambien los productos asociados a ella (eliminacion por cascada).
Mis productos:
En esta seccion se encuentra la parte para agregar, modificar o eliminar los productos, cada producto debe tener estos atributos; nombre, precio, imagen, categoria y descripcion, el cual todos son obligatorios a excepcion de la descripcion, y tambien ocurre lo mismo con las categorias, se puede modificar el orden los productos arrastrando verticalmente, y se modifican por categoria, o sea primero se debe elegir la categoria que se quiere reordenar y luego ya aparecen los productos de esa categoria para poder reordenar.
Mis plantillas:
Aqui se muestran las plantillas disponibles para los menus, este no hay mucho que decir, se puede elegir cualquiera y aparece con boton verde los disponibles, y con un boton azul y desactivado el seleccionado.
Mi enlace y QR:
En esta seccion se muestra tanto el enlace y QR para acceder al menu, explicarle al usuario que si desea modificar el enlace, debe hacerlo basado al nombre de su restaurante y se genera automaticamente, y el enlace anterior queda vacio, por lo que toca acceder desde el nuevo enlace.
AION:
Aqui es donde estas tu, en esta seccion esta la vista de chat para interactuar entre el usuario y tu.

Todos los botones para crear son azules y tiene el texto 'Crear', mientras que todos los botones para guardar los cambios son verdes y tienen el texto 'guardar'.

Te voy a aclarar un poco sobre la logica del negocio, es que cada restaurante unicamente puede tener un menu a la vez, normalmente los precios estan en pesos colombianos aunque si el cliente usa otra moneda no hay problema, y puedes sugerir descripciones, precios o nombres a los productos
Puedes enriquecer las respuesta con algunos emojis`,
					},
				],
			},
			{
				role: 'model',
				parts: [
					{
						text: `¡Hola! ¿Necesitas ayuda con la plataforma? Estoy aquí para ayudarte.
Gestiona tu menú
Personaliza tu diseño
Organiza tus platos
¿Cómo puedo ayudarte?
	`,
					},
				],
			},
		],
	});

	const respuesta = document.getElementById("respuesta");
	const input = document.getElementById("chat");
	const formulario = document.getElementById("chatear");
	const bienvenida = document.getElementById("bienvenida");
	const icono = document.getElementById("icono");
	let primero = true;

	async function enviar(evento){
		evento.preventDefault();
		let mensaje = input.value;
		icono.classList.add("fa-spinner");
		icono.classList.remove("fa-paper-plane");
		let usuario = document.createElement("p");
		usuario.textContent = mensaje;
		usuario.classList.add("usuario");
		respuesta.appendChild(usuario);
		let burbuja = document.createElement("p");
		burbuja.classList.add("bot");
		burbuja.innerHTML = '<i class="fa-solid fa-circle"></i><i class="fa-solid fa-circle"></i><i class="fa-solid fa-circle"></i>';
		respuesta.appendChild(burbuja);
		respuesta.scrollTop = respuesta.scrollHeight;
		input.value = "";
		if (primero){
			bienvenida.classList.add("hidden");
			respuesta.classList.remove("hidden");
			primero = false;
		}
		let response = await chat.sendMessage({
			message: mensaje,
		});

		let formateado = response.text.replaceAll("\n", "<br>");
		formateado = formateado.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
		formateado = formateado.replaceAll("*", "•");
		burbuja.innerHTML = formateado;
		respuesta.appendChild(burbuja);
		icono.classList.add("fa-paper-plane");
		icono.classList.remove("fa-spinner");
		respuesta.scrollTop = respuesta.scrollHeight;
	}

	formulario.addEventListener("submit", enviar);
}
await main();