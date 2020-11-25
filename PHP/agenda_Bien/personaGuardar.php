<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$apellido = $_REQUEST["apellido"];
$telefono = (int)$_REQUEST["telefono"];
//$c_id = (int)$_REQUEST["c_id"];
$c_nombre = $_REQUEST["c_nombre"];
$estrella = isset($_REQUEST["estrella"]);

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);

//obtenemos el id de la categoria con el nombre guardado en el formulario al crear la persona
$sql = "SELECT id FROM categoria WHERE nombre=?";

$select = $conexionBD->prepare($sql);
$select->execute([$c_nombre]); // Se añade el parámetro a la consulta preparada.
$rs = $select->fetchAll();

$c_id = $rs[0]["id"];

if ($nuevaEntrada) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO persona (nombre, apellidos, telefono, estrella, categoriaId) VALUES (?,?,?,?,?)";
    $parametros = [$nombre, $apellido, $telefono, $estrella?1:0, $c_id];
} else {
    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, estrella=?, categoriaId=? WHERE id=?";
    $parametros = [$nombre, $apellido, $telefono, $estrella?1:0,  $c_id, $id];
}

$sentencia = $conexionBD->prepare($sql);
//Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
$sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

// Está todos correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);



// INTERFAZ:
// $nuevaEntrada
// $correcto
// $datosNoModificados
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php
// Todos bien tanto si se han guardado los datos nuevos como si no se habían modificado.
if ($correcto || $datosNoModificados) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if ($nuevaEntrada) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva persona.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos de la persona.</p>
    <?php } ?>

    <?php
}
?>

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>
</html>