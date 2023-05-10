<?php
include("../conexion/conexion.php");

if(isset($_POST['editar'])) {
    $libro_id=$_POST['libro_id'];
    $titulo=$_POST['titulo'];
    $autor=$_POST['autor'];
    $anio=$_POST['anio'];
    $especialidad=$_POST['especialidad'];
    $editorial=$_POST['editorial'];
    $url=$_POST['url'];

    $conexion=conectar();
    $query=$conexion->prepare("UPDATE libro SET titulo=?, autor_id=?, anio=?, especialidad=?, editorial=?, url=? WHERE libro_id=?");
    $query->bind_param("siisssi",$titulo,$autor,$anio,$especialidad,$editorial,$url,$libro_id);
    $query->execute();
    desconectar($conexion);

    header("Location: libros.php");
    exit();
}

$conexion=conectar();
$query=$conexion->prepare("SELECT * FROM libro WHERE libro_id=?");
$query->bind_param("i",$_GET['id']);
$query->execute();
$resultado=$query->get_result();
desconectar($conexion);
$libro=$resultado->fetch_assoc();

$conexion=conectar();
$query=$conexion->prepare("SELECT * FROM autor");
$query->execute();
$autores=$query->get_result();
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>
<body>
    <div class="container">
        <h1 class="title has-text-centered is-4 mb-4">Editar Libro</h1>
        <form method="POST" action="update.php">
            <input type="hidden" name="libro_id" value="<?php echo $libro['libro_id']; ?>">
            <div class="field">
                <label class="label" for="titulo">Título:</label>
                <div class="control">
                    <input type="text" class="input" id="titulo" name="titulo" value="<?php echo $libro['titulo']; ?>">
                </div>
            </div>
            <div class="field">
                <label class="label" for="autor">Autor:</label>
                <div class="control">
                    <div class="select">
                        <select id="autor" name="autor">
                            <?php
                            while ($autor=$autores->fetch_assoc()) {
                                if ($autor['autor_id']==$libro['autor_id']) {
                                    echo '<option value="'.$autor['autor_id'].'" selected>'.$autor['nombres'].' '.$autor['ape_paterno'].' '.$autor['ape_materno'].'</option>';
                                } else {
                                    echo '<option value="'.$autor['autor_id'].'">'.$autor['nombres'].' '.$autor['ape_paterno'].' '.$autor['ape_materno'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label" for="anio">Año:</label>
                <div class="control">
                    <input type="text" class="input" id="anio" name="anio" value="<?php echo $libro['anio']; ?>">
                </div>
            </div>
            <div class="field">
                <label class="label" for="especialidad">Especialidad:</label>
                <div class="control">
                    <input type="text" class="input" id="especialidad" name="especialidad" value="<?php echo $libro['especialidad']; ?>">
                </div>
            </div>
            <div class="field">
                <label class="label" for="editorial">Editorial:</label>
                <div class="control">
                    <input type="text" class="input" id="editorial" name="editorial" value="<?php echo $libro['editorial']; ?>">
                </div>
            </div>
            <div class="field">
                <label class="label" for="url">URL:</label>
                <div class="control">
                    <input type="text" class="input" id="url" name="url" value="<?php echo $libro['url']; ?>">
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" name="editar" class="button is-primary">Editar</button>
                </div>
                <div class="control">
                    <a href="libros.php" class="button is-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>