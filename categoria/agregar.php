<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
$json=file_get_contents('php://input');
$params=json_decode($json);
require("../conexion.php");
$con=returnconnection();

 $mysqli=mysqli_query($con,"insert into categoria(cat_nombre,cat_descripcion) values
             ('$params->cat_nombre','$params->cat_descripcion')");             

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