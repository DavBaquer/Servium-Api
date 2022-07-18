<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select add_id,add_nombre,add_descripcion,car_id from adicional");
$vec=[];
while($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg;
}

$resp=json_encode($vec);
echo $resp;
header('Content-Type:application/json');

?>