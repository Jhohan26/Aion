const reorden = document.getElementsByClassName("reorden")[0];
const orden = document.getElementById("orden");

const sortable = new Sortable(reorden, {
	animation: 200,
	onEnd(evt){
		orden.value = sortable.toArray();
	}
});