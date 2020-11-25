<?php

$nombre=$_POST["nombre"];
$id=$_POST["id"];
$guionista=$_POST["guionista"];
$productora=$_POST["productora"];
$situacion=$_POST["situacion"];


$conexion=mysqli_connect("localhost","root","","agenda");
mysqli_select_db($conexion,"agenda");

mysqli_query($conexion, "insert into contactos(id,nombre,guionista,productora,situacion) values('$id','$nombre','$guionista','$productora','$situacion')");
echo"<h3>Sus datos Fueron Almacenados Exitosamente</h3>";
echo"<p><a href=index.html>Regresar</a>";

?>