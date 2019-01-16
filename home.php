<?php
include('config.php');
include('session.php');
//include('proyecjSessions');
$userDetails=$userClass->userDetails($session_uid);
$nombres_de_proyectos=$projectsDetails=$userClass->projectsDetails($session_uid);
$rolDetails=$userClass->rolDetails($session_uid);
$rol=$rolDetails->rol;
//echo $rol;
echo "<p style='display:none' id='roles'>" . $rol. "</p>";
?>

<!DOCTYPE html>
<html>
<head>
	<!--<link  href="http://fonts.googleapis.com/css? family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">-->
	<link rel="stylesheet" type="text/css" href="css/codigo.css">
	<link rel="stylesheet" href="css/materialize.min.css">
	<meta charset="utf-8">
	<script type="text/javascript" src="prueba.js"></script>
	<title></title>


</head>
<body>
	<script src="js/jquery.js"></script>
	<script src="js/materialize.min.js"></script>
<div class="content">
<div id=contenedor-listado_proyectos>

	<div id="error_proyecto"></div>

	<nav class="blue-grey darken-4">
		<div class="nav-wrapper">
			<a href="" class="brand-logo">Gestor de Proyectos SCRUM</a>
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
					<b style='float:right'><font size='4'>PROYECTOS</font></b><br>
					<?php for ($i=0; $i<count($nombres_de_proyectos);$i++){
					$text = $nombres_de_proyectos[$i];
					echo "<a style='font-size:18' href='proyectos.php?nom=$text'>" .$nombres_de_proyectos[$i]. "</a><br>";
					}?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col m12">
				<div class="card-panel blue-grey lighten-4">
					<div id="id_boton" ></div>
					<div id="contenedor-formulario">
						<div id="div_formulario" hidden>
							<form id="formulario" method="post" action="prueba2.php">
							<div id="formulario_izquierda" class="col s6">
							</div>
							<div id="formulario_derecha" class="col s6">
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<?php 
	   		$pdo = new PDO("mysql:host=localhost;dbname=scrum2","xus","xus123");		 
			// Prepare
			$consulta = $pdo->prepare("SELECT username FROM users where rol = 'ScrumMaster'");
			$consulta2 = $pdo->prepare("SELECT username FROM users where rol = 'ProductOwner'");
			$consulta3 = $pdo->prepare("SELECT group_name FROM groups");
			// Excecute
			$consulta->execute();
			$consulta2->execute();
			$consulta3->execute();
			$respuesta = $consulta->fetch();
			$respuesta2 = $consulta2->fetch();
			$respuesta3 = $consulta3->fetch();
		?>

</div>

</body>
</html>

<script type="text/javascript">
			var jsvarbutton=document.getElementById('roles').innerHTML;
			console.log(jsvarbutton);
			function mostrarBoton(){
				if (jsvarbutton!="ScrumMaster"){
					document.getElementById('id_boton').style.display="none";
				}
				else{
					document.getElementById('id_boton').style.display="block";
				}
			}
			mostrarBoton();
			
			//combobox scrum_master
			var select_combobox_scrum = document.createElement("select");
			select_combobox_scrum.setAttribute("id", "campo_scrum_master");
			select_combobox_scrum.setAttribute("name", "campo_scrum_master");
			select_combobox_scrum.setAttribute("class", "browser-default");
			select_combobox_scrum.setAttribute("required", "true");
			//opciones del combobox
			var opcion_por_defecto_scrum = document.createElement("option");
			opcion_por_defecto_scrum.setAttribute("value",'');
			var texto_opcion = document.createTextNode('Scrum Master');
			opcion_por_defecto_scrum.appendChild(texto_opcion);
			select_combobox_scrum.appendChild(opcion_por_defecto_scrum);
			<?php 
			while ($respuesta) {
				?>
				var opcion_combobox_scrum = document.createElement("option");
				opcion_combobox_scrum.setAttribute("value",'<?php echo "$respuesta[username]" ?>');
				var texto_opcion = document.createTextNode('<?php echo "$respuesta[username]" ?>');
				opcion_combobox_scrum.appendChild(texto_opcion);
				select_combobox_scrum.appendChild(opcion_combobox_scrum);
				<?php
			    $respuesta = $consulta->fetch();
			}
			?>
			document.getElementById("formulario_derecha").appendChild(select_combobox_scrum);
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			
			//combobox product_owner
			var select_combobox_product = document.createElement("select");
			select_combobox_product.setAttribute("id", "campo_product_owner");
			select_combobox_product.setAttribute("name", "campo_product_owner");
			select_combobox_product.setAttribute("class", "browser-default");
			select_combobox_product.setAttribute("required", "true");
			//opciones del combobox
			var opcion_por_defecto_product = document.createElement("option");
			opcion_por_defecto_product.setAttribute("value",'');
			var texto_opcion = document.createTextNode('Product Owner');
			opcion_por_defecto_product.appendChild(texto_opcion);
			select_combobox_product.appendChild(opcion_por_defecto_product);
			<?php 
			while ($respuesta2) {
				?>
				var opcion_combobox_product = document.createElement("option");
				opcion_combobox_product.setAttribute("value",'<?php echo "$respuesta2[username]" ?>');
				var texto_opcion = document.createTextNode('<?php echo "$respuesta2[username]" ?>');
				opcion_combobox_product.appendChild(texto_opcion);
				select_combobox_product.appendChild(opcion_combobox_product);
				<?php
			    $respuesta2 = $consulta2->fetch();
			}
			?>
			document.getElementById("formulario_derecha").appendChild(select_combobox_product);
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			
			//checkbox developers
			var select_combobox_dev = document.createElement("select");
			select_combobox_dev.setAttribute("id", "campo_dev");
			select_combobox_dev.setAttribute("name", "campo_dev");
			select_combobox_dev.setAttribute("class", "browser-default");
			select_combobox_dev.setAttribute("required", "true");
			//opciones del combobox
			var opcion_por_defecto_product = document.createElement("option");
			opcion_por_defecto_product.setAttribute("value",'');
			var texto_opcion = document.createTextNode('Grupos de Desarrollo');
			opcion_por_defecto_product.appendChild(texto_opcion);
			select_combobox_dev.appendChild(opcion_por_defecto_product);
			<?php 
			while ($respuesta3) {
				?>
				var opcion_combobox_dev = document.createElement("option");
				opcion_combobox_dev.setAttribute("value",'<?php echo "$respuesta3[group_name]" ?>');
				var texto_opcion = document.createTextNode('<?php echo "$respuesta3[group_name]" ?>');
				opcion_combobox_dev.appendChild(texto_opcion);
				select_combobox_dev.appendChild(opcion_combobox_dev);
				<?php
			    $respuesta3 = $consulta3->fetch();
			}
			?>
			document.getElementById("formulario_derecha").appendChild(select_combobox_dev);
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));
			document.getElementById("formulario_derecha").appendChild(document.createElement("br"));

			
		</script>