<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select usu_nombre,usu_correo,usu_rol,usu_id,usu_imagen from usuario");
class Result{}
$response=new Result();
if($registros){

$vec=[];
while($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg;
    $response->resultado='OK';
    $response->resp=json_encode($vec);
}

}else{
    $response->resultado='ERROR';
    $response->mensaje='NO se encontraron registros en la Base de datos';
}

echo json_encode($response);
?>