<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
require("../conexion.php");
$con=returnconnection();

$registros=mysqli_query($con,"select car_id,habitacion,bano_compartido,bano_master,bano_social,linea_telf,plantas,m_contruccion,m_terreno,anio_construccion,pro_id from caracteristica");
$vec=[];
while($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg;
}

$resp=json_encode($vec);
echo $resp;
header('Content-Type:application/json');

?>