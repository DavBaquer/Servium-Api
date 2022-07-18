<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:aplication/json');

$json=file_get_contents('php://input');
$params=json_decode($json);

require("../conexion.php");
$con=returnconnection();
class Result{}
$response=new Result();
if($params->usu_password!=='' && $params->usu_password!==null){
    $hash=password_hash($params->usu_password,PASSWORD_DEFAULT);
    $mysqli=mysqli_query($con,"update usuario set usu_nombre='$params->usu_nombre',
                                           usu_correo='$params->usu_correo',
                                           usu_password='$hash',
                                           usu_imagen ='$params->usu_imagen',
                                           usu_rol='$params->usu_rol'
                                           where usu_id=$params->usu_id");

         if(!$mysqli){
             
             $response->resultado='ERROR';
             $response->mensaje='NO SE PUEDO ACTUALIZAR LA INFORMACION';
         }else{

             $response->resultado='OK';
             $response->mensaje='LOS DATOS FUERON MODIFICADOS CORRECTAMENTE';
         }
     }else{

         $mysqli=mysqli_query($con,"update usuario set usu_nombre='$params->usu_nombre',
         usu_correo='$params->usu_correo',
         usu_imagen ='$params->usu_imagen',
         usu_rol='$params->usu_rol'
         where usu_id=$params->usu_id");
         if(!$mysqli){
             
             $response->resultado='ERROR';
             $response->mensaje='NO SE PUEDO ACTUALIZAR LA INFORMACION';
         }else{

             $response->resultado='OK';
             $response->mensaje='LOS DATOS FUERON MODIFICADOS CORRECTAMENTE';
         }

     }

echo json_encode($response);
?>
