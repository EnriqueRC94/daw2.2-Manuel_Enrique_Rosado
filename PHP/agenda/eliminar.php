<?php

$id=$_POST["id"];

$conexion=mysqli_connect("localhost","root","","agenda");
mysqli_select_db($conexion,"agenda");

mysqli_query($conexion, "delete from contactos where id='$id'");
echo"<h3>Sus datos Fueron Eliminados Exitosamente</h3>";
echo"<p><a href=index.html>Regresar</a>";

?>