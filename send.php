<?php
error_reporting(0);
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');
$json=file_get_contents('php://input');
$params=json_decode($json);


$nombre = $params->nombre;
$correo_electronico=$params->correo;
$telefono=$params->telefono;
$contenido=$params->mensaje;

$header = 'From: ' . $correo_electronico. " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";


$mensaje = "Este mensaje fue enviado por " . $nombre . " \r\n";
$mensaje .= "Su e-mail es: " . $correo_electronico . " \r\n";
$mensaje .= "Su telefono es: " . $telefono . " \r\n";
$mensaje .="mi consulta es:".$contenido . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para="erickdavidbarrera3b@gmail.com";
$asunto="informacion SERVIUM";

$resp=mail($para,$asunto,utf8_decode($mensaje), $header);

class Result{}
$response=new Result();
$response->resultado='OK';
$response->mensaje=$resp;


echo json_encode($response);
?>