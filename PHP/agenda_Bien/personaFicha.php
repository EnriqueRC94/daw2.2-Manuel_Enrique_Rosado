<?php

require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];
$c_id = (int)$_REQUEST["c_id"];
//$c_nombre = $_REQUEST["c_nombre"];

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una persona existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);


//cogemos todos los nombres de categoría para hacer un select html
$sql = "SELECT * FROM categoria ORDER BY nombre";
$select = $conexion->prepare($sql);
$select->execute([]); // Se añade el parámetro a la consulta preparada.
$rsCategoria = $select->fetchAll();


if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $personaNombre = "<introduzca nombre>";
    $personaApellido = "<introduzca apellido>";
    $personaTelefono = "<introduzca telefono>";
    $personaEstrella = false;

} else { // Quieren VER la ficha de una persona existente, cuyos datos se cargan.
    $sql = "SELECT nombre, apellidos, telefono, estrella FROM persona WHERE id=?";


    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $personaNombre = $rs[0]["nombre"];
    $personaApellido = $rs[0]["apellidos"];
    $personaTelefono = $rs[0]["telefono"];
    $personaEstrella = ($rs[0]["estrella"] == 1); //convertimos a boolean
}



// INTERFAZ:
// $nuevaEntrada
// $personaNombre
// $personaApellido
// $personaTelefono
// $rsCategoria

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de persona</h1>
<?php } else { ?>
    <h1>Ficha de persona</h1>
<?php } ?>

<form method='post' action='personaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />


    <ul>
        <li>
            <strong>Nombre:   </strong>
            <input style='margin:10px' type='text' name='nombre'   value='<?=$personaNombre?>' />
        </li>
        <li>
            <strong>Apellido:   </strong>
            <input style='margin:10px' type='text' name='apellido'   value='<?=$personaApellido?>' />
        </li>
        <li>
            <strong>Teléfono: </strong>
            <input style='margin:10px' type='text' name='telefono' value='<?=$personaTelefono?>' />
        </li>
        <li>
            <strong>Categoría: </strong>
            <select style='margin:10px; width:200px;' name="c_nombre">
                <?php foreach ($rsCategoria as $fila) {
                    $nombre = $fila["nombre"];
                    if($c_id==$fila["id"])
                        echo "<option value=\"$nombre\" selected>$nombre</option>";
                    else
                        echo "<option value=\"$nombre\">$nombre</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong><label for='estrella'>Favorito:</label></strong>
            <input style='margin:10px; width:200px;' type='checkbox' name='estrella' <?= $personaEstrella ? "checked" : "" ?> />
        </li>
    </ul>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear persona' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <br />
        <br />
        <a href='personaEliminar.php?id=<?=$id?>'>Eliminar persona</a>
    <?php } ?>



</form>

<br />

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>

</html>