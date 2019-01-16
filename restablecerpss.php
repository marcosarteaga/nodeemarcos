<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	$userID=$_GET["userID"];
	echo $userID;
	echo "<form method='post' >";
	echo "Introduce la nueva contraseña:<br>";
	echo "<input type='password' name='pass1'><br>";
	echo "Vuelve a introducir la nueva contraseña:<br>";
	echo "<input type='password' name='pass2'><br>";
	echo "<input type='submit' name='btsubmit' value='enviar'>";
	echo "</form>";
	$conn = mysqli_connect('localhost','xus','xus123');
	mysqli_select_db($conn, 'scrum2');
	if (isset($_POST["btsubmit"])) {
		if ($_POST["pass1"]==$_POST["pass2"]) {
			$pass=$_POST["pass1"];
			$conn = mysqli_connect('localhost','xus','xus123');
			mysqli_select_db($conn, 'scrum2');
			$update=("UPDATE users SET password = SHA2('$pass',256) WHERE uid='$userID';");
			$resultatem = mysqli_query($conn, $update);
		}
	}
?>
</body>
</html>