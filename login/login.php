<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');

$json=file_get_contents('php://input');
$params=json_decode($json);
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select usu_id,usu_nombre,usu_correo,usu_rol,usu_imagen,usu_password from usuario where usu_correo='$params->usu_correo'");
session_start();
class Result{}
$response=new Result();
if($reg=mysqli_fetch_array($registros)){
       $pass=$reg['usu_password'];

    if(password_verify($params->usu_password,$pass)){
    $_SESSION['token']=sha1(uniqid(rand(),true));
   $response->resultado='OK';
   $response->mensaje="Usuario Logeado correctamente";
   $response->token=$_SESSION['token'];
   $response->resp=json_encode($reg);
   }else{
    session_destroy();
    $response->resultado='ERROR';
      $response->mensaje="Contraseña incorrecta";
   }
   
}else
{  
    session_destroy();
       $response->resultado='ERROR';
    $response->mensaje="NO se encontro ningun registro";

}
echo json_encode($response);
?>