var mem = "none";

function insert(add){
	var dis = document.getElementById("display");
	dis.value = dis.value.concat(add);
}

function doit() {
	var dis = document.getElementById("display");
	dis.value = eval(dis.value);
}

function memsave(){
	mem = document.getElementById("display").value;
}

function memload(){
	if (mem=="none") return;
	document.getElementById("display").value = mem;
}