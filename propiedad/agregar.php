<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
$json=file_get_contents('php://input');
$params=json_decode($json);

require("../conexion.php");
$con=returnconnection();
mysqli_autocommit($con, false); 
$flag=true; 
$categoria=$params->categoria;
$transaccion=$params->transaccion;
$ubicacion=$params->ubicacion;
$caracteristica=$params->caracteristica;
$galeria=$params->fotos;
$adicionales=$params->adicionales;
$multimedia=$params->multimedia;


 $mysqli1=mysqli_query($con,"insert into propiedad(pro_titulo,pro_descripcion,pro_precio,pro_alicuota,cat_id,tra_id) values
             ('$params->pro_titulo','$params->pro_descripcion','$params->pro_precio','$params->pro_alicuota',$categoria->cat_id,$transaccion->tra_id)");             
 
if(!$mysqli1){
    $flag=false;
}
$pro_id=mysqli_insert_id($con);

if($ubicacion!=null){
$mysqli2=mysqli_query($con,"insert into ubicacion(ubi_direccion,ubi_ciudad,ubi_codpostal,ubi_barrio,pro_id,ubi_url) values
             ('$ubicacion->ubi_direccion','$ubicacion->ubi_ciudad','$ubicacion->ubi_codpostal','$ubicacion->ubi_barrio',$pro_id,'$ubicacion->ubi_url')");             
 if(!$mysqli2){
    $flag=false;
}
}

if($caracteristica!=null){
  

    $mysqli3=mysqli_query($con,"insert into caracteristica(habitacion,bano_compartido,bano_master,bano_social,linea_telf,plantas,m_contruccion,m_terreno,anio_construccion,pro_id) values
    ($caracteristica->habitacion,$caracteristica->bano_compartido,$caracteristica->bano_master,$caracteristica->bano_social,$caracteristica->linea_telf,$caracteristica->plantas,$caracteristica->m_contruccion,$caracteristica->m_terreno,'$caracteristica->anio_construccion',$pro_id)");             

    if(!$mysqli3){
        $flag=false;
    }

}

if($adicionales!=null){
          for($i = 0; $i < count($adicionales); ++$i){
            $item=$adicionales[$i];
            
             $mysqli4=mysqli_query($con,"insert into adicional(add_nombre,add_descripcion,pro_id) values
                 ('$item->add_nombre','$item->add_descripcion',$pro_id)");  
            
             if(!$mysqli4){
                 $flag=false;
             } 
         }
    } 



if($galeria!=null){
    for($i = 0; $i < count($galeria); ++$i){  
       $item=$galeria[$i];
       $data=$item->gal_imagen;
       if($data!=""){
       $mysqli5=mysqli_query($con,"insert into galeria(gal_imagen,gal_tipo,pro_id,gal_nombre) values
       ('$data','$item->gal_tipo',$pro_id,'$item->gal_nombre')");   
   
       if(!$mysqli5){
           $flag=false;
       }
    }
   }
   }

   if($multimedia!=null){
    $mysqli6=mysqli_query($con,"insert into multimedia(mul_video,pro_id) values
    ('$multimedia->mul_video',$pro_id)");  
    if(!$mysqli6){
        $flag=false;
    }          

   }

class Result{}
$response=new Result();
if(!$flag){
    mysqli_rollback($con); 
    $response->resultado='ERROR';
    $response->mensaje='LOS DATOS NO SE GUARDARON';
}else{
    mysqli_commit($con);
    $response->resultado='OK';
    $response->mensaje='LOS DATOS FUERON GUARDADOS CORRECTAMENTE';
}

header('Content-Type:application/json');
echo json_encode($response);
?>