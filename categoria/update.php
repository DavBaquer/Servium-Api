<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");


$json=file_get_contents('php://input');
$params=json_decode($json);

require("../conexion.php");
$con=returnconnection();

$mysqli=mysqli_query($con,"update categoria set cat_nombre='$params->cat_nombre',
                                        cat_descripcion='$params->cat_descripcion'
                                        where cat_id=$params->cat_id");
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
