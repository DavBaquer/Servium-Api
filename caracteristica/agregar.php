<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
$json=file_get_contents('php://input');
$params=json_decode($json);
require("../conexion.php");
$con=returnconnection();

 $mysqli=mysqli_query($con,"insert into caracteristica(habitacion,bano_compartido,bano_master,bano_social,linea_telf,plantas,m_contruccion,m_terreno,anio_construccion,pro_id) values
 ($params->habitacion,$params->bano_compartido,$params->bano_master,$params->bano_social,$params->linea_telf,$params->plantas,$params->m_contruccion,$params->m_terreno,'$params->anio_construccion',$params->pro_id)");             

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