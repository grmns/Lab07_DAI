<?php
include("../conexion/conexion.php");
if(isset($_GET['id'])){
    $autor_id=$_GET['id'];
    $conexion=conectar();
    $query=$conexion->prepare("DELETE FROM autor WHERE autor_id=?");
    $query->bind_param('i',$autor_id);
    $query->execute();
    $resultado=$query->get_result();
    desconectar($conexion);
    header("Location: autores.php");
}
else{
    header("Location: autores.php");
    exit();
}
?>