<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');

require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select car_id,habitacion,bano_compartido,bano_master,bano_social,linea_telf,plantas,m_contruccion,m_terreno,anio_construccion,pro_id from caracteristica where car_id=$_GET[id]");

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
?>