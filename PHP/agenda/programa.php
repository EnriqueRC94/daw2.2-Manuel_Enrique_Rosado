<?php

if(empty($_POST["ingresar"]))
{
$_POST["ingresar"]=0;   
}

if(empty($_POST["eliminar"]))
{
$_POST["eliminar"]=0;   
}

if(empty($_POST["actualizar"]))
{
$_POST["actualizar"]=0;   
}

if(empty($_POST["ver"]))
{
$_POST["ver"]=0;   
}



$ingresar=$_POST["ingresar"];
$eliminar=$_POST["eliminar"];
$actualizar=$_POST["actualizar"];
$ver=$_POST["ver"];

if($ingresar)
{
    echo"<form method=POST action=ingresar.php>";
    echo"<center><h1>Agenda de comic</h1><h3>Ingresar Comic</h3>";
    echo"<p>Introduzca id de comic:<input type=number name=id required>";
    echo"<p>Introduzca Nombre de comic:<input type=text name=nombre>";
    echo"<p>Introduzca guionista de comic:<input type=text name=guionista>";
    echo"<p>Introduzca productora de comic:<select id='productora' name=productora>";
    echo"<option >Marvel</option>";
    echo"<option >Dc</option>";
    echo"<option >Image</option></select>";
    echo"<p>Introduzca situacion de comic:<label><input type='checkbox' value='1' name='opcion1' />Lo tengo</label>";
    echo"<label><input type='checkbox' value='2' name='opcion2' />Lo he leido</label>";
    echo"<label><input type='checkbox' value='3' name='opcion3' />Lo quiero</label>";

    echo"<p><input type=submit name=guardar value='Guardar comic'><input type=reset value=limpiar>";
    echo"<p><a href=index.html>Regresar</a></form>";
}

else if($eliminar)
{
    echo"<form method=POST action=eliminar.php>";
    echo"<center><h1>Lista de COmics</h1><h3>Eliminar Comic</h3>";
    echo"<p>Introduzca id del Comic que desea eliminar:<input type=number name=id required>";
    echo"<p><input type=submit name=eliminar value='Eliminar comic'>";
    echo"<p><a href=index.html>Regresar</a></form>";
}


else if($actualizar)
{
    echo"<form method=POST action=buscar.php>";
    echo"<center><h1>Agenda de Contactos</h1><h3>Actualizar Comic</h3>";
    echo"<p>Introduzca id del Comic que desea Actualizar:<input type=number name=id required>";
    echo"<p><input type=submit name=buscar value='Buscar comic'>";
    echo"<p><a href=index.html>Regresar</a></form>";
}



else if($ver)
{
   $conexion=mysqli_connect("localhost","root","","agenda");
   mysqli_select_db($conexion,"agenda");

   $buscar=mysqli_query($conexion, "select * from contactos");
   echo"<center><h1>Agenda de Comic</h1><h3>Ver Comic</h3>";
   echo"<table border=1><tr><td>id</td><td>Nombre</td><td>guionista</td><td>productora</td><td>situacion</td></tr>";
   while($dato=mysqli_fetch_array($buscar))
   {
    echo"<tr><td>";  
    echo $dato["id"];
    echo"</td><td>";
    echo $dato["nombre"]; 
    echo"</td><td>";
    echo $dato["guionista"];
    echo"</td><td>";
    echo $dato["productora"];
    echo"</td><td>";
    echo $dato["situacion"];
    echo"</td></tr>";
   }
   echo"</table>";

   $num=mysqli_num_rows($buscar);
   echo"<h3>Numero de registros: $num</h3>";
   echo"<p><a href=index.html>Regresar</a>";
}

?>