


if(typeUser=="ProductOwner") {
	inputsNombreProyecto();
}else if(typeUser=="ScrumMaster"){
	DragAndDrop();
}


function inputsNombreProyecto(){
	var elementopadre = document.getElementById("ultimoDiv");
	var inputNombre = document.createElement("input");
	var inputBoton	= document.createElement("input");
	

	inputBoton.setAttribute("type", "image");
	inputBoton.setAttribute("src", "img/añadir.png");
	inputBoton.setAttribute("width", "25");
	inputBoton.setAttribute("height", "25");


	inputBoton.addEventListener("click",añadirEspecificacion);
	inputNombre.setAttribute("name","nombreEspe");

	insertarDespuesde(elementopadre,inputNombre);
	insertarDespuesde(inputNombre,inputBoton);
		
}

function añadirEspecificacion(){
	var elementopadre = document.getElementById("divEspe");
	var creardivnuevo = document.createElement('div');

	creardivnuevo.setAttribute("style", "margin-bottom: 10px;border: solid yellowgreen");
	var inputnombreproyecto = document.getElementsByName("nombreEspe")[0].value;
	var añadirtextoespecificacion = document.createTextNode(inputnombreproyecto);
	creardivnuevo.appendChild(añadirtextoespecificacion);
	creardivnuevo.appendChild(botonSubir());
	creardivnuevo.appendChild(botonBajar());
	creardivnuevo.appendChild(botonEliminar());
	elementopadre.appendChild(creardivnuevo);

}



function añadirBotones(element){
	element.appendChild(botonSubir());
	element.appendChild(botonBajar());
	element.appendChild(botonEliminar());


}


function insertarDespuesde(e,i){
	if(e.nextSibling){
		e.parentNode.insertBefore(i,e.nextSibling);

	} else {
		e.parentNode.appendChild(i);
	}
}


function botonSubir(){
	var imgsubir = document.createElement('img');
	imgsubir.setAttribute("src", "img/arriba.png");
	imgsubir.setAttribute("style","float:right");
	imgsubir.setAttribute("width", "25");
	imgsubir.setAttribute("height", "25");
	imgsubir.setAttribute('onclick', 'subir(this)');
	return imgsubir;
}
function botonBajar(){
	var imgbajar = document.createElement('img');
	imgbajar.setAttribute("src", "img/bajar.png");
	imgbajar.setAttribute("style","float:right");
	imgbajar.setAttribute("width", "25");
	imgbajar.setAttribute("height", "25");
	imgbajar.setAttribute('onclick', 'bajar(this)');
	return imgbajar;
}
function botonEliminar(){
	var imgeliminar = document.createElement('img');
	imgeliminar.setAttribute("src", "img/eliminar.png");
	imgeliminar.setAttribute("style","float:right");
	imgeliminar.setAttribute("width", "25");
	imgeliminar.setAttribute("height", "25");
	imgeliminar.setAttribute('onclick', 'eliminar(this)');
	return imgeliminar;
}

function subir(element){
	var elementAnterior = element.parentNode.previousSibling;

	var clonado = element.parentNode.cloneNode(true);
	var elementRaiz= element.parentNode.parentNode;

	
	var elementoPadre = element.parentNode;
	elementoPadre.parentNode.removeChild(elementoPadre);
	elementRaiz.insertBefore(clonado, elementAnterior);
}
function bajar(element){
	var elementSiguiente = element.parentNode.nextSibling.nextSibling;
	//Clonamos el elemento
	var clonado = element.parentNode.cloneNode(true);
	//Accedemos al elemento <ul> 
	var elementRaiz = element.parentNode.parentNode;

	var elementoPadre = element.parentNode;
	
	elementoPadre.parentNode.removeChild(elementoPadre);	
	elementRaiz.insertBefore(clonado, elementSiguiente);
}
function eliminar(element){
	var elementoPadre = element.parentNode;
	elementoPadre.parentNode.removeChild(elementoPadre);
}




function hoverCandado(element){
	var elementoPadreDiv = element.parentNode;
	if (elementoPadreDiv.style.backgroundColor=="black") {
		candadoAbierto(element);
	}

}




function candadoCerrado(element){
	element.setAttribute("src","img/cerrado.png");

}



function candadoAbierto(element){
	element.setAttribute("src","img/abierto.png");	

}

function DragAndDrop(){
	var divSprint = document.getElementsByClassName("acordeon");
	for (var i = 0; i < divSprint.length; i++) {
		if (divSprint[i].style.backgroundColor=="black") {
			var hermano = divSprint[i].nextSibling;
			hermano.setAttribute("id","cuadro2");

		}
	}

}
