<?php
include('../conexion/conexion.php');

$nombres = $_POST['nombres'];
$ape_paterno = $_POST['ape_paterno'];
$ape_materno = $_POST['ape_materno'];

$conexion = conectar();

$query = $conexion->prepare("INSERT INTO autor (nombres, ape_paterno, ape_materno) VALUES (?, ?, ?)");
$query->bind_param('sss', $nombres, $ape_paterno, $ape_materno);

$msg = '';
if ($query->execute()) {
    header("Location: autores.php");
} else {
    $msg = 'No se pudo crear el autor';
}

desconectar($conexion);
?>

