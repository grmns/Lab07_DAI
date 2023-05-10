<?php
include("../conexion/conexion.php");
$conexion=conectar();
$query=$conexion->prepare("SELECT libro.libro_id, libro.titulo, autor.nombres, autor.ape_paterno, autor.ape_materno, libro.anio, libro.especialidad, libro.editorial, libro.url FROM libro JOIN autor ON libro.autor_id = autor.autor_id");
$query->execute();
$resultado=$query->get_result();
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script>
        function abrirVentana(url) {
            var ventana = window.open(url, "ventanaEmergente", "width=1000,height=1000");
            ventana.focus();
}

    </script>
</head>
<body>
    <div class="container">
    <h1 class="title is-1 has-text-centered mb-4">Lista de Libros</h1>
        <div class="field is-grouped is-grouped-right mb-4">
            <a href="create.php" class="button is-primary">Agregar Libro</a>
        </div>
    <table class="table is-striped is-fullwidth">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Año</th>
                <th>Especialidad</th>
                <th>Editorial</th>
                <th>URL</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($libro=$resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$libro['titulo'].'</td>';
                echo '<td>'.$libro['nombres'].' '.$libro['ape_paterno'].' '.$libro['ape_materno'].'</td>';
                echo '<td>'.$libro['anio'].'</td>';
                echo '<td>'.$libro['especialidad'].'</td>';
                echo '<td>'.$libro['editorial'].'</td>';
                echo '<td><button onclick="abrirVentana(\''.$libro['url'].'\')" class="button is-success is-shadowed">Leer</button></td>';
                echo '<td><a href="update.php?id='.$libro['libro_id'].'" class="button is-warning is-shadowed">Editar</a> <a href="eliminar_libro.php?id='.$libro['libro_id'].'" class="button is-danger is-shadowed">Eliminar</a></td>';
                echo '</tr>';  
            }
            ?>
        </tbody>
    </table>
    <a href="../index.html" class="button is-danger">Salir</a>
    </div>
</body>
</html>
