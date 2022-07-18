<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select ubi_id,ubi_direccion,ubi_ciudad,ubi_codpostal,ubi_barrio,pro_id,ubi_url from ubicacion");
$vec=[];
while($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg;
}

$resp=json_encode($vec);
echo $resp;
header('Content-Type:application/json');

?>