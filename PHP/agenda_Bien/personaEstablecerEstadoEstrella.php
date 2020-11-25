<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$fav = $_REQUEST["fav"];

$sql = "UPDATE persona SET estrella = (NOT (SELECT estrella FROM persona WHERE id=?)) WHERE id=?";

$select = $conexionBD->prepare($sql);
$exito = $select->execute([$id,$id]);

header("Location: personaListado.php?fav=$fav");
?>