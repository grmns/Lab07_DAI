<?php
include("../conexion/conexion.php");
    $autor_id=$_POST['autor_id'];
    $nombres=$_POST['nombres'];
    $ape_paterno=$_POST['ape_paterno'];
    $ape_materno=$_POST['ape_materno'];
    
    $conexion=conectar();
    $query=$conexion->prepare("UPDATE autor SET nombres=?, ape_paterno=?, ape_materno=? WHERE autor_id=?");
    $query->bind_param('sssi',$nombres, $ape_paterno, $ape_materno, $autor_id);
    $query->execute();
    desconectar($conexion);
    
    header("Location: autores.php");
    exit();
?>