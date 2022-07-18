<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");


$json=file_get_contents('php://input');
$params=json_decode($json);

require("../conexion.php");
$con=returnconnection();

$mysqli=mysqli_query($con,"update ubicacion set ubi_direccion='$params->ubi_direccion',
                                        ubi_ciudad='$params->ubi_ciudad',
                                        ubi_codpostal='$params->ubi_codpostal',
                                        ubi_barrio='$params->ubi_barrio',
                                        ubi_url='$params->ubi_url',
                                        pro_id='$params->pro_id'
                                        where ubi_id=$params->ubi_id");
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
