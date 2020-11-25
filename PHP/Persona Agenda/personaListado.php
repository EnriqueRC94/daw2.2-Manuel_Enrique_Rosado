<?php
    require_once "_varios.php";

    $conexion = obtenerPdoConexionBD();

    $sql = "
               SELECT
                    p.id     AS p_id,
                    p.nombre AS p_nombre,
                    c.id     AS c_id,
                    c.nombre AS c_nombre
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoria_id = c.id
                ORDER BY p.nombre
        ";

    $select = $conexion->prepare($sql);
    $select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rs = $select->fetchAll();


    // INTERFAZ:
    // $rs
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Personas</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Categoría</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'personaFicha.php?id=<?=$fila["p_id"]?>'> <?= $fila["p_nombre"] ?> </a></td>
            <td><a href= 'categoriaFicha.php?id=<?=$fila["c_id"]?>'> <?= $fila["c_nombre"] ?> </a></td>
            <td><a href='personaEliminar.php?id=<?=$fila["p_id"]?>'> (X)                      </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='personaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>