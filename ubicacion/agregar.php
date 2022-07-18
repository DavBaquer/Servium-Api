<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');
$json=file_get_contents('php://input');
$params=json_decode($json);
require("../conexion.php");
$con=returnconnection();

 $mysqli=mysqli_query($con,"insert into ubicacion(ubi_direccion,ubi_ciudad,ubi_codpostal,ubi_barrio,pro_id,ubi_url) values
                     ('$params->ubi_direccion','$params->ubi_ciudad','$params->ubi_codpostal','$params->ubi_barrio',$params->pro_id,'$params->ubi_url')");                          

class Result{}
$response=new Result();
if(!$mysqli){
    $response->resultado='ERROR';
    $response->mensaje='LOS DATOS NO SE GUARDARON';
}else{
    $response->resultado='OK';
    $response->mensaje='LOS DATOS FUERON GUARDADOS CORRECTAMENTE';
}
echo json_encode($response);
?>