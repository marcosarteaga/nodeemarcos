<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
	include("config.php");
	include('userClass.php');
	echo "<form action='formcorreo.php' method='POST' >";
	echo "<p>Introduce tu correo electronico: </p>";
	echo "<input type='text' name='mail'><br><br>";
	echo "<input type='submit'value='Enviar' name='send'>";
	echo "</form>";
	$error=0;
	$conn = mysqli_connect('localhost','xus','xus123');
	mysqli_select_db($conn, 'scrum2');
	$consulta = ("SELECT * FROM users;");
	$resultat = mysqli_query($conn, $consulta);
	$arrayMail=[];
	while( $emails = mysqli_fetch_assoc($resultat)){
		//print_r($emails["email"]);
		array_push($arrayMail,$emails["email"] );
	}
	$mailUser = $_POST["mail"];
	if(isset($_POST["send"])){
		foreach ($arrayMail as $m) {
			if ($m==$_POST["mail"]) {
				enviarcorreo($mailUser);
				
			}else{
				$error=1;
			}
	}
	}
	if ($error==1) {
		echo "no valido";
	}
	
	function enviarcorreo($mailUser){
		$conn2 = mysqli_connect('localhost','xus','xus123');
		mysqli_select_db($conn2, 'scrum2');
		$consultaem = ("SELECT uid FROM users WHERE email = '$mailUser';");
		$resultatem = mysqli_query($conn2, $consultaem);
		while( $ema = mysqli_fetch_assoc($resultatem)){
			$uidNumber=$ema["uid"];
		};
		$correo = $mailUser;
		$titulo = "Recuperacion de contraseña";
		$mensaje = "http://ec2-54-158-157-91.compute-1.amazonaws.com/SCRUM/restablecerpss.php?userID=".$uidNumber;
		mail($correo, $titulo,$mensaje);
		header("Location:index.php");
			
	}
	
	?>

<p></p>
</body>
</html>