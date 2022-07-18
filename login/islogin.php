<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
header('Content-Type:application/json');

$json=file_get_contents('php://input');
$params=json_decode($json);
session_start();
class Result{}
$response=new Result();

//$_SESSION['token']='58afef2695d5a48025cd65a1dc6aaa9a30b8be01';
if(!isset($_SESSION['token'])){
    $response->resultado='ERROR NO SESSION';
}else{

    if($params->token==$_SESSION['token']){
        $response->resultado='OK';
    }else
    {  
        $response->resultado='ERROR NO IGUAL';
    
    }

}


echo json_encode($response);
?>