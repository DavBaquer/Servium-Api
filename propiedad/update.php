<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");


$json=file_get_contents('php://input');
$params=json_decode($json);

require("../conexion.php");
$con=returnconnection();
$categoria=$params->categoria;
$transaccion=$params->transaccion;
$mysqli=mysqli_query($con,"update propiedad set pro_titulo='$params->pro_titulo',
                                        pro_descripcion='$params->pro_descripcion',
                                        pro_precio='$params->pro_precio',
                                        pro_alicuota='$params->pro_alicuota',
                                        cat_id='$categoria->cat_id',
                                        tra_id='$transaccion->tra_id'
                                        where pro_id=$params->pro_id");
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
