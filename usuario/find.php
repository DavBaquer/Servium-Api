<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select usu_nombre,usu_correo,usu_rol,usu_id,usu_imagen from usuario where usu_id=$_GET[id]");





class Result{}
$response=new Result();
if($reg=mysqli_fetch_array($registros)){
   $vec[]=$reg;
   $response->resultado='OK';
   $response->resp=json_encode($vec);
}else
{
    $response->resultado='OK';
    $response->mensaje="NO se encontro ningun registro";

}
echo json_encode($response);
header('Content-Type:application/json');

?>