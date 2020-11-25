<?php

$id=$_POST["id"];
$nombre=$_POST["nombre"];
$guionista=$_POST["guionista"];
$productora=$_POST["productora"];
$situacion=$_POST["situacion"];


//Conexion a la base de datos y acceso a los datos

$conexion=mysqli_connect("localhost","root","","agenda");
mysqli_select_db($conexion,"agenda");
mysqli_query($conexion, "update contactos set id='$id',nombre='$nombre', guionista='$guionista',productora='$productora',situacion='$situacion' where id='$id'");

echo"<h3>El registro ha sido Actualizado Satisfactoriamente</h3>";
echo"<p><a href=index.html>Regresar</a>";

?>