<?php
include("../conexion/conexion.php");
$conexion = conectar();
$query = $conexion->prepare("SELECT autor_id, nombres, ape_paterno, ape_materno FROM autor");
$query->execute();
$resultado = $query->get_result();
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Autores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }

        .table-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title is-1 has-text-centered">Autores</h1>
        <div class="text-right mb-3">
            <a href="create.html" class="button is-success">Nuevo Autor +</a>
        </div>
        <div class="table-container">
            <table class="table is-bordered is-hoverable">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th class="has-text-centered">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($autor = $resultado->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $autor['nombres'] . '</td>';
                        echo '<td>' . $autor['ape_paterno'] . '</td>';
                        echo '<td>' . $autor['ape_materno'] . '</td>';
                        echo '<td class="has-text-centered">';
                        echo '<a href="update.php?id=' . $autor['autor_id'] . '" class="button is-warning">Editar</a>';
                        echo '&nbsp';
                        echo '<a href="delete.php?id=' . $autor['autor_id'] . '" class="button is-danger">Eliminar</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="../index.html" class="button is-danger">Salir</a>
    </div>
</body>
</html>
