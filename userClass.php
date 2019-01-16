<?php
class userClass
{
/* User Login */
public function userLogin($usernameEmail,$password)
{
try{
$db = getDB();
$hash_password= hash('sha256', $password); //Password encryption 
$stmt = $db->prepare("SELECT uid FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password"); 
$stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR) ;
$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
$stmt->execute();
$count=$stmt->rowCount();
$data=$stmt->fetch(PDO::FETCH_OBJ);
$db = null;
if($count)
{
$_SESSION['uid']=$data->uid; // Storing user session value
return true;
}
else
{
return false;
} 
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}

/* User Registration */
public function userRegistration($username,$password,$email,$name)
{
try{
$db = getDB();
echo 'hgh';
$st = $db->prepare("SELECT uid FROM users WHERE username=:username OR email=:email"); 
$st->bindParam("username", $username,PDO::PARAM_STR);
$st->bindParam("email", $email,PDO::PARAM_STR);
$st->execute();
$count=$st->rowCount();
if($count<1)
{
$stmt = $db->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
$stmt->bindParam("username", $username,PDO::PARAM_STR) ;
$hash_password= hash('sha256', $password); //Password encryption
$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
$stmt->bindParam("name", $name,PDO::PARAM_STR) ;
$stmt->execute();
$uid=$db->lastInsertId(); // Last inserted row id
$db = null;
$_SESSION['uid']=$uid;
return true;
}
else
{
$db = null;
return false;
}

} 
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
}

/* User Details */
public function userDetails($uid)
{
try{
$db = getDB();
$stmt = $db->prepare("SELECT email,username,name,rol FROM users WHERE uid=:uid"); 
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
return $data;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}






/* información del proyecto */
public function projectDeveloper($uid)
{
$arrayproyectos2=array();
$sql="SELECT * from project WHERE cod_project IN (SELECT cod_project FROM proj_users WHERE name_proj='Gestor de Proyectos SCRUM' AND username IN (SELECT username FROM users WHERE uid=:uid))";
try{
$db = getDB();
$stmt = $db->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL)); 
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
while ($fila = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      $datos = $fila;
      $nombre_proyectos[]=$datos;
      
      //print_r($datos);
      //print_r($nombre_proyectos);
    }
    
    //print_r($nombre_proyectos);
      
    $stmt = null;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}





public function rolDetails($uid)
{
try{
$db = getDB();
$stmt = $db->prepare("SELECT rol FROM users WHERE uid=:uid"); 
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
return $data;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}



public function projectsDetails($uid)

{
$arrayproyectos=array();
$sql="SELECT name_proj FROM proj_users WHERE username IN (SELECT username FROM users where uid=:uid)";
try{
$db = getDB();
$stmt = $db->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL)); 
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
while ($fila = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      $datos = $fila[0];
      $nombre_proyectos[]=$datos;
      
      //print_r($datos);
      //print_r($nombre_proyectos);
    }
    
    return $nombre_proyectos;
      
    $stmt = null;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
}
?>





