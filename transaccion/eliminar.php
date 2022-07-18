<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
require("../conexion.php");
$con=returnconnection();
$mysqli=mysqli_query($con,"delete from transaccion where tra_id=$_GET[id]");

class Result{}
$response=new Result();
if(!$mysqli){
    
    $response->resultado='ERROR';
    $response->mensaje='NO SE PUEDE ELIMINAR LOS DATOS';
}else{

$response->resultado='OK';
$response->mensaje='LOS DATOS FUERON ELIMINADOS CORRECTAMENTE';
}
header('Content-Type:aplication/json');
echo json_encode($response);

?>