<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");


$json=file_get_contents('php://input');
$params=json_decode($json);

require("../conexion.php");
$con=returnconnection();

$mysqli=mysqli_query($con,"update caracteristica set habitacion='$params->habitacion',
                                        bano_compartido='$params->bano_compartido',
                                        bano_master='$params->bano_master',
                                        bano_social='$params->bano_social',
                                        linea_telf='$params->linea_telf',
                                        plantas='$params->plantas',
                                        m_contruccion='$params->m_contruccion',
                                        m_terreno='$params->m_terreno',
                                        anio_construccion='$params->anio_construccion',
                                        pro_id='$params->pro_id'
                                        where car_id=$params->car_id");
class Result{}
$response=new Result();
if(!$mysqli){
    
    $response->resultado='ERROR';
    $response->mensaje='NO SE PUEDE EDITAR';
}else{

$response->resultado='OK';
$response->mensaje='LOS DATOS FUERON MODIFICADOS CORRECTAMENTE';
}

header('Content-Type:aplication/json');
echo json_encode($response);

?>
