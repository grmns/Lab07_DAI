<?php
include("../conexion/conexion.php");

$conexion = conectar();

$query = $conexion->prepare("SELECT autor_id, CONCAT(nombres, ' ', ape_paterno, ' ', ape_materno) AS nombre_completo FROM autor");
$query->execute();
$autores = $query->get_result()->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor_id = $_POST['autor'];
    $anio = $_POST['anio'];
    $especialidad = $_POST['especialidad'];
    $editorial = $_POST['editorial'];
    $url = $_POST['url'];
    
    $query = $conexion->prepare("INSERT INTO libro (titulo, autor_id, anio, especialidad, editorial, url) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param("siisss", $titulo, $autor_id, $anio, $especialidad, $editorial, $url);
    $query->execute();
    
    header('Location: libros.php');
}

desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered is-3">Agregar Libro</h1>
            <form method="POST">
                <div class="field">
                    <label class="label" for="titulo">Título:</label>
                    <div class="control">
                        <input type="text" name="titulo" id="titulo" class="input" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="autor">Autor:</label>
                    <div class="control">
                        <div class="select">
                            <select name="autor" id="autor" required>
                                <?php foreach ($autores as $autor): ?>
                                <option value="<?php echo $autor['autor_id']; ?>">
                                    <?php echo $autor['nombre_completo']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="anio">Año:</label>
                    <div class="control">
                        <input type="number" name="anio" id="anio" class="input" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="especialidad">Especialidad:</label>
                    <div class="control">
                        <input type="text" name="especialidad" id="especialidad" class="input" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="editorial">Editorial:</label>
                    <div class="control">
                        <input type="text" name="editorial" id="editorial" class="input" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="url">URL:</label>
                    <div class="control">
                        <input type="text" name="url" id="url" class="input" required>
                    </div>
                </div>
                <div class="field is-grouped is-grouped-centered">
                    <div class="control">
                        <button type="submit" class="button is-primary">Agregar Libro</button>
                    </div>
                    <div class="control">
                        <a href="libros.php" class="button is-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>