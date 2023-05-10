<?php
include("../conexion/conexion.php");
$conexion = conectar();
$libro_id = $_GET['id'];
$query = $conexion->prepare("DELETE FROM libro WHERE libro_id = ?");
$query->bind_param("i", $libro_id);
$query->execute();
header('Location: libros.php');
desconectar($conexion);
?>