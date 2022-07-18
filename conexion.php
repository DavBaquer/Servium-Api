<?php
function returnconnection(){
    $usuario="root";
    $contraseña="erick123";
    $nombre_bdd="bdservium";
    $uri="localhost";
    $con=mysqli_connect($uri,$usuario,$contraseña,$nombre_bdd);
    return $con;
}
?>