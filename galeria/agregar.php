<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
$json=file_get_contents('php://input');
$params=json_decode($json);
require("../conexion.php");
$con=returnconnection();

$data=$params->gal_imagen;
if($data!=""){
$mysqli=mysqli_query($con,"insert into galeria(gal_imagen,gal_tipo,pro_id,gal_nombre) values
('$data','$params->gal_tipo',$params->pro_id,'$params->gal_nombre')");          
}
class Result{}
$response=new Result();
if(!$mysqli){
    
    $response->resultado='ERROR';
    $response->mensaje='LOS DATOS NO SE GUARDARON';
}else{
    $response->resultado='OK';
    $response->mensaje='LOS DATOS FUERON GUARDADOS CORRECTAMENTE';
}

header('Content-Type:application/json');
echo json_encode($response);
?>