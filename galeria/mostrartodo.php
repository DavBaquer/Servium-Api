<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');

require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select gal_id,gal_imagen,gal_tipo,pro_id from galeria");
$vec=[];
while($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg;
}

$resp=json_encode($vec);
echo $resp;
?>