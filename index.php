
<?php

include("config.php");
include('userClass.php');
$userClass = new userClass();

$errorMsgReg=false;
$errorMsgLoginUsername='';
$errorMsgLoginPass='';
$uservalidate='';
$passvalidate='';



/* Login Form */
if (!empty($_POST['loginSubmit'])) 
{
	$usernameEmail=$_POST['usernameEmail'];
	$password=$_POST['password'];

	//echo $usernameEmail;
	
	if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
	{
		$uid=$userClass->userLogin($usernameEmail,$password);
		if($uid)
		{
		$url=BASE_URL.'home.php';
		header("Location: $url"); // Page redirecting to home.php 	
		}
		else
		{
			?>
			<script type="text/javascript">
				var error = "usuario o contraseña no es correcta";
				var Condicion = 1;
			</script>
		<?php


		}
	}
	else if (strlen(trim($usernameEmail))>1 && strlen(trim($password))<1 )
	{
		?>
			<script type="text/javascript">
				var error = "Introduce una contraseña";
				var Condicion = 1;
			</script>
		<?php
	}

	else if (strlen(trim($usernameEmail))<1 && strlen(trim($password))>1 )
	{
		?>
			<script type="text/javascript">
				var error = "Introduce una usuarioç o mail";
				var Condicion = 1;
			</script>
		<?php
	}

	else if (strlen(trim($usernameEmail))<1 && strlen(trim($password))<1 )
	{
		?>
			<script type="text/javascript">
				var error = "Introduce un usuario y contraseña";
				var Condicion = 1;
			</script>
		<?php
	}
}



/* Signup Form */
if (!empty($_POST['signupSubmit'])) 
{
$username=$_POST['usernameReg'];
echo $username;
$email=$_POST['emailReg'];
echo $email;
$password=$_POST['passwordReg'];
echo $password;
$name=$_POST['nameReg'];
/* Regular expression check */
$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.([a-zA-Z]{2,4})$~i', $email);
$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);// ha de ser entre 6 y 20 caracteres

if($username_check && $email_check && $password_check && strlen(trim($name))>0) 
{ 
	
$uid=$userClass->userRegistration($username,$password,$email,$name);
if($uid)
{
$url=BASE_URL.'proyectos.html';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgReg="Username or Email already exists.";
}
}
}
?>






<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/codigo.css">

	<title></title>


</head>
<body>

<div id="errorMsgs"></div>
 
<div id="login">
<h3>Login</h3>
<form method="post" action=""name="login">
<label>Username or Email</label>
<input type="text" id="nickUser" name="usernameEmail" autocomplete="off" />
<label>Password</label>
<input type="password" id="nickPass" name="password" autocomplete="off"/>
<div class="botones">
<input type="submit" class="button" name="loginSubmit" value="Login"/>

<input type="submit" class="button" name="reload" value="Try Again" onClick="location.reload();"/>
</div>
</form>
<a class="linkmail"  href="formcorreo.php">Recuperar contraseña</a>
</div>

</body>


<script type="text/javascript">


document.getElementById("errorMsgs").style.display="none";	

function validate(error)
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
	if(Condicion==1)
	{
 	errorUser = document.createTextNode(error);
  	parrafoUser.appendChild(errorUser);
  	document.getElementById("errorMsgs").appendChild(divImageParrafoUser);
  	document.getElementById("errorMsgs").style.display="block";
	}


}
validate(error);

</script>


</html>
