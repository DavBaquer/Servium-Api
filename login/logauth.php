<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');

$json=file_get_contents('php://input');
$params=json_decode($json);
session_start();
class Result{}
$response=new Result();


if(!isset($_SESSION['token'])){
    session_destroy();

        $response->resultado='SESIÓN FINALIZADA';
    
    

}


echo json_encode($response);
?>