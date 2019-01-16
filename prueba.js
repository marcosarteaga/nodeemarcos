//funciones
var checkboxMarcado = false;
var nombreFormularioRelleno = false;
var comboProductOwner = false;
var comboScrumMaster = false;
var comboEquipos=false;
var errorform="";
var errorSprint="";




function crearFormulario(){



	//marco habilitado
	var elementDiv = document.getElementById("div_formulario");
    elementDiv.hidden = false;

	//h1 formulario
	//crea el h1
	var titulo_formulario = document.createElement("h1");
	//pone los atributos del h1
	titulo_formulario.setAttribute("id", "titulo");
	//es el texto del h1
	var texto_formulario = document.createTextNode("Formulario");
	//inserta el texto en el h1
	titulo_formulario.appendChild(texto_formulario);
	//hace un insert al principio del todo
	document.getElementById("div_formulario").insertBefore(titulo_formulario, document.getElementById("div_formulario").firstChild);
	//inserta un salto de linea
	//document.getElementById("div_formulario").appendChild(document.createElement("br"));

	//label nombre
	var label_nombre = document.createElement("label");
	label_nombre.setAttribute("for", "nombre");
	var texto_formulario = document.createTextNode("Nombre");
	label_nombre.appendChild(texto_formulario);
	document.getElementById("formulario_izquierda").appendChild(label_nombre);

	//text nombre
	var label_nombre = document.createElement("input");
	label_nombre.setAttribute("id", "nombre_proyecto");
	label_nombre.setAttribute("type", "text");
	label_nombre.setAttribute("name", "nombre");
	label_nombre.setAttribute("required", "true");
	document.getElementById("formulario_izquierda").appendChild(label_nombre);
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));

	//label descripcion
	var label_descripcion = document.createElement("label");
	label_descripcion.setAttribute("for", "descripcion");
	label_descripcion.setAttribute("name", "descripcion_proj");
	var texto_formulario = document.createTextNode("Descripcion");
	label_descripcion.appendChild(texto_formulario);
	document.getElementById("formulario_izquierda").appendChild(label_descripcion);

	//text descripcion
	var label_descripcion = document.createElement("textarea");
	label_descripcion.setAttribute("name", "descripcion");
	label_descripcion.setAttribute("cols", "30");
	label_descripcion.setAttribute("required", "true");
	document.getElementById("formulario_izquierda").appendChild(label_descripcion);
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));
/*
	//label descripcion
	var label_number = document.createElement("label");
	var texto_number = document.createTextNode("Codigo de proyecto");
	label_number.appendChild(texto_number);
	document.getElementById("formulario_izquierda").appendChild(label_number);
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));
	

	//text descripcion
	var numero_number = document.createElement("input");
	numero_number.setAttribute("id", "codigo_proyecto");
	numero_number.setAttribute("type","number");
	numero_number.setAttribute("name", "numero_proyecto");
	numero_number.setAttribute("required", "true");
	document.getElementById("formulario_izquierda").appendChild(numero_number);
*/
	//boton crear
	var crear_boton = document.createElement("input");
	crear_boton.setAttribute("onclick", "comprobacionesFormulario();");
	crear_boton.setAttribute("type","button");
	crear_boton.setAttribute("name","crear");
	crear_boton.setAttribute("value","Crear");
	crear_boton.setAttribute("id","boton_crear_dentro");
	document.getElementById("formulario").appendChild(crear_boton);



	document.getElementById('botonCrearProyecto').style.display="none";
	document.getElementById('botonCrearProyecto').classList.add("deshabilitar");

	var reload_boton=document.createElement("input");
	reload_boton.setAttribute("type","button");
	reload_boton.setAttribute("onclick", "location.reload();");
	reload_boton.setAttribute("value","Try Again");
	reload_boton.setAttribute("id","boton_reload");
	document.getElementById("formulario").appendChild(reload_boton);
}

function comprobacionesFormulario(){
	comprobarNombreFormularioRelleno();
	comprobarComboboxSeleccionadoMaster();
	comprobarComboboxSeleccionadoOwner();
	comprobarEquipos();
	respuestaFormulario();
}	

function comprobarNombreFormularioRelleno(){
	nombre_proyecto = document.getElementById("nombre_proyecto");
	if (document.getElementById("nombre_proyecto").value == "") {
		nombreFormularioRelleno = false;
	}
	else{
		nombreFormularioRelleno = true;
	}
}
function comprobarComboboxSeleccionadoMaster(){
	var lista_scrum_master = document.getElementById("campo_scrum_master");
    if(lista_scrum_master.selectedIndex !=0 )
    	comboScrumMaster = true;
    else{
    	comboScrumMaster = false;
    }
}
function comprobarComboboxSeleccionadoOwner(){
	var lista_product_owner = document.getElementById("campo_product_owner");
    if(lista_product_owner.selectedIndex !=0 )
    	comboProductOwner = true;
    else{
    	comboProductOwner = false;
    }
}

function comprobarEquipos(){
	var lista_Equipos = document.getElementById("campo_dev");
    if(lista_Equipos.selectedIndex !=0 )
    	comboEquipos = true;
    else{
    	comboEquipos = false;
    }
}

function respuestaFormulario(){
	if (nombreFormularioRelleno == false) {
		errorform="ha de introducir un nombre";

		validate(errorform);
	
		document.getElementById('boton_crear_dentro').style.display="none";
		document.getElementById('boton_reload').style.display="block";
		document.getElementById("nombre_proyecto").style.border="2px solid red";
	}
	
	if (comboScrumMaster == false) {
		errorform="ha de elegir un Scrum Master";
		validate(errorform);
		document.getElementById("campo_scrum_master").style.border="2px solid red";
	}
	if (comboProductOwner == false) {
		errorform="ha de elegir un Product Owner";
		validate(errorform);
		document.getElementById("campo_product_owner").style.border="2px solid red";
	}
	if (comboEquipos == false) {
		errorform="ha de elegir un Grupo";
		validate(errorform);
		document.getElementById("campo_dev").style.border="2px solid red";
	}
	else if (comboEquipos == true && nombreFormularioRelleno == true 
	&& comboScrumMaster == true && comboProductOwner == true) {
		document.getElementById("formulario").submit();
	}
}

document.addEventListener('DOMContentLoaded', function(){
	var crear_boton_creacion = document.createElement("input");
	crear_boton_creacion.setAttribute("onclick", "crearFormulario()");
	crear_boton_creacion.setAttribute("type","button");
	crear_boton_creacion.setAttribute("name","crearProyecto");
	crear_boton_creacion.setAttribute("value","Crear proyecto nuevo");
	crear_boton_creacion.setAttribute("id","botonCrearProyecto");
	document.getElementById("id_boton").appendChild(crear_boton_creacion);

});

function erroresFormulario(){
	var imageErrorfortmulario=document.createElement('IMG');
 	imageErrorfortmulario.setAttribute("src", "css/images/cancelar.png");
 	imageErrorfortmulario.setAttribute("width", "20px");
	var parrafoerror=document.createElement('p');
	var textoerror=document.createTextNode("No pueden existir campos vacios");
	parrafoerror.appendChild(textoerror);
	document.getElementById("error_proyecto").appendChild(parrafoerror);
  	document.getElementById("error_proyecto").style.display="block";
}




function validate(errorform)
{
 

	 var divErrorUser=document.createElement('div');//contendra errores de usuario.
	 var divImageErrorUser=document.createElement('div');//contendrá el icono de error.
	 var divParrafoUser=document.createElement('div');//contendrá el parrafo de error usuario.
	 var divImageParrafoUser=document.createElement('div');
	 var brUser=document.createElement("br");

	 var imageErrorUser=document.createElement('IMG');
	 imageErrorUser.setAttribute("src", "css/images/cancelar.png");
	 imageErrorUser.setAttribute("width", "20px");
	var parrafoUser=document.createElement('p');
	divParrafoUser.appendChild(parrafoUser);
	divParrafoUser.classList.add("text");
	divImageErrorUser.appendChild(imageErrorUser);
 	divImageErrorUser.classList.add("parpadea");
 	divImageErrorUser.classList.add("icono");

	divImageParrafoUser.appendChild(divImageErrorUser);
	divImageParrafoUser.appendChild(divParrafoUser);

	divImageParrafoUser.classList.add("contenedor");
	document.getElementById("error_proyecto").appendChild(brUser);
	
 	errorUser = document.createTextNode(errorform);
  	parrafoUser.appendChild(errorUser);

  	document.getElementById("error_proyecto").appendChild(divImageParrafoUser);
  	//divErrorUser.insertBefore(brUser,divImageParrafoUser);
  	
  	document.getElementById("error_proyecto").style.display="block";
	


}

function formatDate(date) {
    var d = new Date(date),
        day = '' + d.getDate(),
        month = '' + (d.getMonth()+1),
        year = d.getFullYear();

    if (day.length < 2) day = '0' + day;
    if (month.length < 2) month = '0' + month;

    return [year, day, month].join('-');
}

//alert(formatDate('03/01/2019'));

function crearSprint(){

	//marco habilitado
	var elementDiv = document.getElementById("div_formulario");
    elementDiv.hidden = false;
    var numSprint=document.getElementById('numero_sprint').innerHTML;
	//h1 formulario
	//crea el h1
	var titulo_sprint = document.createElement("h1");
	//pone los atributos del h1
	titulo_sprint.setAttribute("id", "titulo");
	//es el texto del h1
	Numero_Sprint=parseInt(numSprint);
	Numero_Sprint+=1;
	var texto_sprint = document.createTextNode("Sprint "+Numero_Sprint);
	//inserta el texto en el h1
	titulo_sprint.appendChild(texto_sprint);
	//hace un insert al principio del todo
	document.getElementById("div_formulario").insertBefore(titulo_sprint, document.getElementById("div_formulario").firstChild);

	//label Fecha Inicio
	var label_inicio = document.createElement("label");
	label_inicio.setAttribute("for", "FechaInicio");
	var texto_inicio = document.createTextNode("Fecha de Inicio");
	label_inicio.appendChild(texto_inicio);
	document.getElementById("formulario_izquierda").appendChild(label_inicio);

	//text Fecha Inicio
	var label_inicio = document.createElement("input");
	label_inicio.setAttribute("id", "FechaInicio");
	label_inicio.setAttribute("type", "date");
	label_inicio.setAttribute("name", "FechaInicio");
	label_inicio.setAttribute("required", "true");
	document.getElementById("formulario_izquierda").appendChild(label_inicio);
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));

	//label Fecha Final
	var label_final = document.createElement("label");
	label_final.setAttribute("for", "FechaFinal");
	label_final.setAttribute("name", "FechaFinal");
	var texto_final = document.createTextNode("Fecha de Finalización");
	label_final.appendChild(texto_final);
	document.getElementById("formulario_izquierda").appendChild(label_final);

	//text Fecha Final
	var label_final = document.createElement("input");
	label_final.setAttribute("id", "FechaFinal");
	label_final.setAttribute("type", "date");
	label_final.setAttribute("name", "FechaFinal");
	label_final.setAttribute("required", "true");
	document.getElementById("formulario_izquierda").appendChild(label_final);
	document.getElementById("formulario_izquierda").appendChild(document.createElement("br"));

	//label Horas totales
	var label_horas = document.createElement("label");
	var texto_horas = document.createTextNode("Horas totales");
	label_horas.appendChild(texto_horas);
	document.getElementById("formulario_izquierda").appendChild(label_horas);

	//text Horas totales
	var label_horas = document.createElement("input");
	label_horas.setAttribute("id", "horasTotales");
	label_horas.setAttribute("type","number");
	label_horas.setAttribute("name", "horasTotales");
	document.getElementById("formulario_izquierda").appendChild(label_horas);

	//boton crear
	var crear_sprint_dentro = document.createElement("input");
	crear_sprint_dentro.setAttribute("onclick", "comprobarSprintNuevo();");
	crear_sprint_dentro.setAttribute("type","button");
	crear_sprint_dentro.setAttribute("name","crearSprint");
	crear_sprint_dentro.setAttribute("value","Crear Sprint");
	crear_sprint_dentro.setAttribute("id","boton_crear_sprint_nuevo");
	document.getElementById("formulario").appendChild(crear_sprint_dentro);

	document.getElementById('botonCrearSprint').style.display="none";
	document.getElementById('botonCrearSprint').classList.add("deshabilitar");
}

function fechaInicioRellenado(){
	label_inicio = document.getElementById("FechaInicio");
	if (document.getElementById("FechaFinal").value == "") {
		contenidoFechaInicio = false;
	}
	else{
		contenidoFechaInicio = true;
	}
}

function fechaFinalRellenado(){
	label_final = document.getElementById("FechaFinal");
	if (document.getElementById("FechaFinal").value == "") {
		contenidoFechaFinal = false;
		console.log("hola, da error.");
	}
	else{
		contenidoFechaFinal = true;
	}
}

function horasTotalesRellenado(){
	numero_horas = document.getElementById("horasTotales");
	if (document.getElementById("horasTotales").value == "") {
		contenidoHorasTotales = false;
	}
	else{
		contenidoHorasTotales = true;
	}
}

function fechaInicioMayorQueHoy(){
	inicioSprint = document.getElementById("FechaInicio");
	fechaHoy = document.getElementById("Hoy");
	if (inicioSprint.value < fechaHoy.value) {
		inicioMayorHoy = false;
	}
	else{
		inicioMayorHoy = true;
	}
}

function fechaInicioMenorQueFinal(){
	label_inicio = document.getElementById("FechaInicio");
	label_final = document.getElementById("FechaFinal");
	if (label_inicio.value > label_final.value) {
		inicioMenorFinal = false;
	}
	else{
		inicioMenorFinal = true;
	}
}

function horasTotalesPositivas(){
	numero_horas = document.getElementById("horasTotales");
	if (numero_horas.value <= 0) {
		contenidoHorasPositivo = false;
	}
	else{
		contenidoHorasPositivo = true;
	}
}

function respuestaSprintNuevo(){
	if (contenidoFechaInicio == false) {
		errorSprint="Es necesario rellenar el campo 'Fecha de Inicio'.";
		validate(errorSprint);
	}
	if (contenidoFechaInicio == true) {
		if (inicioMayorHoy == false) {
			errorSprint="La fecha de inicio tiene que ser posterior a la fecha de hoy'.";
			validate(errorSprint);
		}
	}
	if (contenidoFechaFinal == false) {
		errorSprint="Es necesario rellenar el campo 'Fecha de Finalización'.";
		validate(errorSprint);
	}
	if (contenidoFechaInicio == true && contenidoFechaFinal == true) {
		if (inicioMenorFinal == false) {
			errorSprint="La fecha de inicio tiene que ser anterior a la fecha de finalización'.";
			validate(errorSprint);
		}
	}
	if (contenidoHorasTotales == false) {
		errorSprint="Es necesario rellenar el campo 'Horas totales'.";
		validate(errorSprint);
	}
	if (contenidoHorasTotales == true) {
		if (contenidoHorasPositivo == false) {
			errorSprint="La horas totales del Sprint siempre tienen que ser positivas'.";
			validate(errorSprint);
		}
	}
}

function comprobarSprintNuevo(){
	fechaInicioRellenado();
	fechaFinalRellenado();
	horasTotalesRellenado();
	fechaInicioMayorQueHoy();
	fechaInicioMenorQueFinal();
	horasTotalesPositivas();
	respuestaSprintNuevo();
}

document.addEventListener('DOMContentLoaded', function(){
	var boton_crear_sprint = document.createElement("input");
	boton_crear_sprint.setAttribute("onclick", "crearSprint()");
	boton_crear_sprint.setAttribute("type","button");
	boton_crear_sprint.setAttribute("name","crearSprint");
	boton_crear_sprint.setAttribute("value","Crear nuevo Sprint");
	boton_crear_sprint.setAttribute("id","botonCrearSprint");
	document.getElementById("boton_sprint").appendChild(boton_crear_sprint);
});

/*window.onload = function(){
	var fecha = new Date(); //Fecha actual
	var mes = fecha.getMonth()+1; //obteniendo mes
	var dia = fecha.getDate(); //obteniendo dia
	var ano = fecha.getFullYear(); //obteniendo año
	if(dia<10){
		dia='0'+dia; //agrega cero si el menor de 10
	}
	if(mes<10){
		mes='0'+mes //agrega cero si el menor de 10
	}
	var fechaHoy=dia+"/"+mes+"/"+ano;
}*/