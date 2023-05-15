<?php
require_once "../config/conexion.php";
 
    $idrecure =$_GET['id'];
    
    echo "$idrecure";
    $consuleliminar="DELETE FROM `articulo` WHERE id='$idrecure'";
    $resultado = mysqli_query($conn, $consuleliminar);
    if($resultado){
        echo "Se elimino con exito";
        header('Location: portafolio.php');
    } else {
        echo "NO se pudo eliminar";
    }
    mysqli_close($conn);
?>