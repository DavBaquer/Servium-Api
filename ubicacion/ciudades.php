<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select ubi_ciudad FROM ubicacion GROUP by ubi_ciudad");

class Result{}
$response=new Result();
$vec=[];

if(!$registros){
    $response->resultado='ERROR';
    $response->mensaje="NO se encontro ningun registro";
   
}else
{
    $vec=[];
    while($reg=mysqli_fetch_array($registros)){
        
        $vec[]=$reg;
        $response->resultado='OK';
        $response->resp=json_encode($vec);
    }
}


$resp=json_encode($response);
echo $resp
?>