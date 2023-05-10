<?php
include("../conexion/conexion.php");
if(isset($_GET['id'])){
    $autor_id=$_GET['id'];
    $conexion=conectar();
    $query=$conexion->prepare("SELECT nombres, ape_paterno, ape_materno FROM autor WHERE autor_id=?");
    $query->bind_param('i',$autor_id);
    $query->execute();
    $resultado=$query->get_result();
    $autor=$resultado->fetch_assoc();
    desconectar($conexion);
}
else{
    header("Location: autores.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Autor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>
<body>
    <div class="container">
        <div class="columns is-centered mt-5">
            <div class="column is-half">
                <div class="card">
                    <div class="card-header">
                        <h1 class="title is-4 has-text-centered">Editar Autor</h1>
                    </div>
                    <div class="card-content">
                        <form method="post" action="record_update.php" name="formulario">
                            <div class="field">
                                <label class="label" for="nombres">Nombres:</label>
                                <div class="control">
                                    <input type="text" class="input" name="nombres" id="nombres" maxlength="60" value="<?php echo $autor['nombres']?>" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="ape_paterno">Apellido Paterno:</label>
                                <div class="control">
                                    <input type="text" class="input" name="ape_paterno" id="ape_paterno" maxlength="40" value="<?php echo $autor['ape_paterno']?>" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="ape_materno">Apellido Materno:</label>
                                <div class="control">
                                    <input type="text" class="input" name="ape_materno" id="ape_materno" maxlength="40" value="<?php echo $autor['ape_materno']?>">
                                </div>
                            </div>
                            <div class="field is-grouped is-grouped-centered">
                                <div class="control">
                                    <input type="hidden" name="autor_id" value="<?php echo $autor_id?>">
                                    <button type="submit" class="button is-primary" name="submit">Guardar</button>
                                </div>
                                <div class="control">
                                    <a href="autores.php" class="button is-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
