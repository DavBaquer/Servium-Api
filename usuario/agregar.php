<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
$json=file_get_contents('php://input');
$params=json_decode($json);
require("../conexion.php");
$con=returnconnection();

$pass=$params->usu_password;

$hash=password_hash($pass,PASSWORD_DEFAULT);


 $mysqli=mysqli_query($con,"insert usuario(usu_nombre,usu_correo,usu_password,usu_rol,usu_imagen) values
             ('$params->usu_nombre','$params->usu_correo','$hash','$params->usu_rol','$params->usu_imagen')");             

class Result{}
$response=new Result();
if(!$mysqli){
    
    $response->resultado='ERROR';
    $response->mensaje='LOS DATOS NO SE GUARDARON';
}else{
    $response->resultado='OK';
    $response->mensaje='LOS DATOS FUERON GUARDADOS CORRECTAMENTE';
}

header('Content-Type:application/json');
echo json_encode($response);
?>