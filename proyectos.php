

<?php
include('config.php');
include('session.php');
$userDetails=$userClass->userDetails($session_uid);
$projectDeveloper=$userClass->projectDeveloper($session_uid);
$nombre_usuario_proyecto=$userDetails->name;
$userRol=$userDetails->rol;
?>
<!DOCTYPE html>
<html>
<head>
	<!--<link  href="http://fonts.googleapis.com/css? family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">-->
	<link rel="stylesheet" type="text/css" href="css/codigo.css">
	<script type="text/javascript" defer src="botonMas.js"></script>
	<script type="text/javascript" src="prueba.js"></script>
	<link rel="stylesheet" href="css/materialize.min.css">
	<meta charset="utf-8">
	<title></title>


</head>
<body>
	<script src="js/jquery.js"></script>
	<script src="js/materialize.min.js"></script>
<div>	

	<div id="error_proyecto"><h3>ERRORES</h3></div>

	<nav class="blue-grey darken-4">
		<div class="nav-wrapper">
			<a href="" class="brand-logo"><?php echo $v1= $_GET['nom']; ?></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li id="nombre_usuario"><h3 id="nombeUsuario" style="color:white"><?php echo $userDetails->name; ?></h3></li>
				<li id="icono_logout"><a href="<?php echo BASE_URL; ?>logout.php"><img src="css/images/salida.png"></a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col m12">
				<div class="card-panel blue-grey lighten-4">
					<?php 
					$pdo=getDB();
					$sql="SELECT * from project WHERE cod_project IN (SELECT cod_project FROM proj_users WHERE name_proj='".$v1."' AND username IN (SELECT username FROM users WHERE name='".$nombre_usuario_proyecto."'))";
					foreach ($pdo->query($sql) as $row) {
			        //echo $row['id_project'] . "\t";
			        //echo $row['cod_project'] . "\t";
					$codProject=$row['cod_project'];
			        echo "<b>Nombre de Proyecto: </b>",$row['name_project'] . "\t<br>";
			        echo "<b>Descripción: </b>",$row['description'] . "\t<br>";
			        echo "<b>Product Owner: </b>",$row['product_owner'] . "\t<br>";
			        echo "<b>Scrum Master: </b>",$row['scrum_master'] . "\t<br>";
			        echo "<b>Grupo de desarrollo: </b>",$row['group_name'] . "\t<br>";
			        echo "<b>Fecha de inicio: </b>",$row['date_start'] . "\t<br>";
			        echo "<b>Fecha de finalización: </b>",$row['date_finish'] . "\t<br>";
			        //echo $row['comments'] . "\t";
			    	}
					?>
				</div>
			</div>
			
			<div id="contenedor_sprints_backlog">

				<div id="divSprint" class=" col s6 right">
					<div class="card-panel blue-grey lighten-4">SPRINTS</div>
					<div  id="contenedor_sprints" class="card-panel blue-grey lighten-4">


						<?php 
						$contar=0;
						$pdo=getDB();
						$sql="SELECT * from sprints WHERE cod_project IN (SELECT cod_project FROM proj_users WHERE name_proj='".$v1."' AND username IN (SELECT username FROM users WHERE name='".$nombre_usuario_proyecto."'))";
						
						$arrayFechasPHP=array();
						$totalSprints=0;
						$num=0;
						foreach ($pdo->query($sql) as $row) {
						echo "<button class=' boton_eliminar col s3 right' onclick='eliminarSprint()'>".'eliminar'."</button>";
						echo "<div id='sprintDiv$num' class='acordeon' style='background-color:#4f986c;color: #fff; cursor: pointer;  padding: 18px; width:100%; text-align: left; border: 1px solid white; transition: 0.4s;font: 20px Lato, sans-serif;'>".$row['name_sprint']."<img id='candado$num' onmouseover='hoverCandado(this)'  onmouseout='candadoCerrado(this)' class='candado' src='img/cerrado.png'> </div>";
						echo "<div class='panel' ondragenter='return enter(event)' ondragover='return over(event)' ondragleave='return leave(event)' ondrop='return drop(event)'style='padding: 0.18px;background-color: white;display: none;overflow: hidden;'>";
						echo "hola";
						/*
						echo "<p style='font: 16px Lato, sans-serif;'>";
						echo "<b>",$row['name_sprint'] . "\t</b><br>";
						echo "Fecha: ",$row['date_start'] . "\t - ";
						echo $row['date_finish'] . "\t";
						echo "<b style='float:right'>";
						echo "Horas totales: ",$row['total_hours'] . "\t <br>";
						echo "Horas restantes: ",$row['hours_left'] . "\t";
						echo "</b>";
						echo '<br><br>';
						echo "</p>";
						*/
						$fechaInicio=strtotime($row['date_start']);
						$fechaFin=strtotime($row['date_finish']);
						$fechaHoy=strtotime(date('Y-m-d'));
						
						array_push($arrayFechasPHP, $fechaInicio);
						array_push($arrayFechasPHP, $fechaFin);
						array_push($arrayFechasPHP, $fechaHoy);
						$totalSprints+=1;
						$contar=$contar+1;
						/*
						$sql1="SELECT * from specifications WHERE number_sprint=".$contar." AND cod_project IN (SELECT cod_project FROM proj_users WHERE name_proj='".$v1."' AND username IN (SELECT username FROM users WHERE name='".$nombre_usuario_proyecto."'))";
						foreach ($pdo->query($sql1) as $row1) {
				        echo "<b><font size='4'>",$row1['name_specification'] . "\t</font></b><br>";
				        echo $row1['description'] . "\t";
				        echo "<b style='float:right'>";
				        echo $row1['hours'] . " hours\t <br>";
				        echo $row1['date'] . "\t ";
				        echo "</b>";
				        echo '<br><br>';

				   		 }	
				   		 */
				   		 echo"</div>";
				   		 $num=$num+1;
						}
						$js_array = json_encode($arrayFechasPHP);
						echo "<p style='display:none' id='numero_sprint'>",$totalSprints . "\t</p>";
						?>
							<input type="date" id="Hoy" name="Hoy" value="<?php echo date("Y-m-d");?>" hidden>
							<div id="boton_sprint"></div>
							<div id="contenedor-formulario">
								<div id="div_formulario" hidden>
									<form id="formulario" method="post" action="prueba2.php">
									<div id="formulario_izquierda" class="col s6"></div>
									<div id="formulario_derecha" class="col s6"></div>
									</form>
								</div>
							</div>
						</div>
					</div>				
				</div>

				<div id="ultimoDiv" class=" col s6 left">
					<div class="card-panel blue-grey lighten-4">BACKLOG</div>
					<div id="divEspe" ondragenter="return enter(event)" ondragover="return over(event)" ondragleave="return leave(event)" ondrop="return drop(event)" class="card-panel blue-grey lighten-4">
						<?php 
						$pdo=getDB();
						$sql="SELECT * from specifications WHERE cod_project IN (SELECT cod_project FROM proj_users WHERE name_proj='".$v1."' AND username IN (SELECT username FROM users WHERE name='".$nombre_usuario_proyecto."'))";
						$dragnumber=0;
						foreach ($pdo->query($sql) as $row) {
						echo "<div class='cuadradito'id='mover_div$dragnumber' draggable='true' ondragstart='start(event)'' ondragend='end(event)style='margin-bottom: 10px;border: solid yellowgreen;' >";
				        echo "<b><font size='4'>",$row['name_specification'] . "\t</font></b><br>";
				        echo $row['description'] . "\t";
				        echo "<b style='float:right'>";
				        //echo $row['hours'] . " hours\t <br>";
				        echo "<input name='horas' type='text' ></input>\t <br>";
				        echo $row['date'] . "\t ";
				        echo "</b>";
				        echo '<br><br>';
				       	echo '</div>';
				       	$dragnumber=$dragnumber+1;
				    	}
						?>
				
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<section>
	



</section>

</body>
</html>


<script type="text/javascript">var typeUser = '<?php echo $userRol ?>' </script>
<script type="text/javascript">
		
	var acc = document.getElementsByClassName("acordeon");
	var panel = document.getElementsByClassName('panel');
	for (var i = 0; i < acc.length; i++) {
	    acc[i].onclick = function() {
	        var setClasses = !this.classList.contains('active');
	        setClass(acc, 'active', 'remove');
	        setClass(panel, 'show', 'remove');
	        if (setClasses) {
	            this.classList.toggle("active");
	            this.nextElementSibling.classList.toggle("show");
	        }
	    }
	}
	function setClass(els, className, fnName) {
	    for (var i = 0; i < els.length; i++) {
	        els[i].classList[fnName](className);
	    }
	}
	</script>
	<script type="text/javascript">var arrayFechas = '<?php echo $js_array ?>'; </script>
	<script type="text/javascript">
		var numero;
		x=0;
		for(var i=-1; acc.length; i++){
			if(arrayFechas[x+2]>arrayFechas[x] && arrayFechas[x+2]>arrayFechas[x+1]){
				acc[i].style.backgroundColor='grey';
			}else if(arrayFechas[x+2]>arrayFechas[x] && arrayFechas[x+2]<arrayFechas[x+1]){
				acc[i].style.backgroundColor='green';
			}else if(arrayFechas[x+2]<arrayFechas[x] && arrayFechas[x+2]<arrayFechas[x+1]){
				acc[i].style.backgroundColor='black';
				document.getElementsByClassName("boton_eliminar")[i].style.display="block";
			}
			x+=3;
		}
		function mostrarBoton(){
			if (typeUser="ScrumMaster"){
				document.getElementById('boton_sprint').style.display="none";
			}
			else{
				document.getElementById('boton_sprint').style.display="bock";
			}
		}
		mostrarBoton();
			
	function eliminarSprint(){
		
	var sprintNegro= document.getElementById("contenedor_sprints");
	console.log(sprintNegro.length);
	for(var i=0; acc.length; i++) {
		if (acc[i].style.backgroundColor=="black") {
			var hijoNegro=acc[i];
			var hermanoNegro = hijoNegro.nextSibling;
			sprintNegro.removeChild(hijoNegro);
			sprintNegro.removeChild(hermanoNegro);
			document.getElementsByClassName("boton_eliminar")[i].style.display="none";

		}
	}
}
</script>

<script type="text/javascript">
	contador = 0; // Variable global para tener poder poner un id unico a cada elemento cuando se clona.
        function start(e) {
            e.dataTransfer.effecAllowed = 'move'; // Define el efecto como mover (Es el por defecto)
            e.dataTransfer.setData("Data", e.target.id); // Coje el elemento que se va a mover
            e.dataTransfer.setDragImage(e.target, 0, 0); // Define la imagen que se vera al ser arrastrado el elemento y por donde se coje el elemento que se va a mover (el raton aparece en la esquina sup_izq con 0,0)
            e.target.style.opacity = '0.4'; 
        }

        function end(e){
            e.target.style.opacity = ''; // Pone la opacidad del elemento a 1           
            e.dataTransfer.clearData("Data");
        }

        function enter(e) {
            e.target.style.border = '3px dotted #555'; 
        }

        function leave(e) {
            e.target.style.border = ''; 
        }

        function over(e) {
            var elemArrastrable = e.dataTransfer.getData("Data"); // Elemento arrastrado
            var id = e.target.id; // Elemento sobre el que se arrastra
            
            // return false para que se pueda soltar
            if (id == 'divEspe'){
                return false; // Cualquier elemento se puede soltar sobre el div destino 1
            }

            if ((id == 'cuadro2')){
                return false; // En el cuadro2 se puede soltar cualquier elemento menos el elemento con id=arrastrable3
            }   

        }

    
        /**
        * 
        * Mueve el elemento
        *
        **/
        function drop(e){

            var elementoArrastrado = e.dataTransfer.getData("Data"); // Elemento arrastrado
            e.target.appendChild(document.getElementById(elementoArrastrado));
            e.target.style.border = '';  // Quita el borde
            tamContX = $('#'+e.target.id).width();
            tamContY = $('#'+e.target.id).height();

            tamElemX = $('#'+elementoArrastrado).width();
            tamElemY = $('#'+elementoArrastrado).height();
    
            posXCont = $('#'+e.target.id).position().left;
            posYCont = $('#'+e.target.id).position().top;

            // Posicion absoluta del raton
            x = e.layerX;
            y = e.layerY;

            // Si parte del elemento que se quiere mover se queda fuera se cambia las coordenadas para que no sea asi
            if (posXCont + tamContX <= x + tamElemX){
                x = posXCont + tamContX - tamElemX;
            }

            if (posYCont + tamContY <= y + tamElemY){
                y = posYCont + tamContY - tamElemY;
            }

            document.getElementById(elementoArrastrado).style.position = "absolute";
            document.getElementById(elementoArrastrado).style.left = x + "px";
            document.getElementById(elementoArrastrado).style.top = y + "px";
        }

        /**
        * 
        * Elimina el elemento que se mueve
        *
        **/
        function eliminar(e){
            var elementoArrastrado = document.getElementById(e.dataTransfer.getData("Data")); // Elemento arrastrado
            elementoArrastrado.parentNode.removeChild(elementoArrastrado); // Elimina el elemento
            e.target.style.border = '';   // Quita el borde
        }

        /**
        * 
        * Clona el elemento que se mueve
        *
        **/
        function clonar(e){
            var elementoArrastrado = document.getElementById(e.dataTransfer.getData("Data")); // Elemento arrastrado

            elementoArrastrado.style.opacity = ''; // Dejamos la opacidad a su estado anterior para copiar el elemento igual que era antes

            var elementoClonado = elementoArrastrado.cloneNode(true); // Se clona el elemento
            elementoClonado.id = "ElemClonado" + contador; // Se cambia el id porque tiene que ser unico
            contador += 1;  
            elementoClonado.style.position = "static";  // Se posiciona de forma "normal" (Sino habria que cambiar las coordenadas de la posición)  
            e.target.appendChild(elementoClonado); // Se añade el elemento clonado
            e.target.style.border = '';   // Quita el borde del "cuadro clonador"
        }
</script>

