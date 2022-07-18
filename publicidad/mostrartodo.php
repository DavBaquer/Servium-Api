<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select pub_id,pub_url,pub_descripcion from publicidad");
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