<?php

$id=$_POST["id"];
//Conexion a la base de datos y acceso a los datos
$conexion=mysqli_connect("localhost","root","","agenda");
mysqli_select_db($conexion,"agenda");
//Seleccion de todas las entidades para hacer la busqueda
$buscar=mysqli_query($conexion, "select * from contactos where id='$id'");

while($dato=mysqli_fetch_array($buscar))
{    
?>
<form method=POST action=actualizar.php>
<center><h1>Agenda de Contactos</h1><h3>Actualizar Comic</h3>
<p>Introduzca id de Contacto:<input type=number name=id required value=<?php echo $dato["id"]; ?>>
<p>Introduzca Nombre de comic:<input type=text name=nombre value=<?php echo $dato["nombre"]; ?>>
<p>Introduzca guionista de comic:<input type=text name=guionista value=<?php echo $dato["guionista"]; ?>>
 <!--Seleccionamos la editorial mediante un menu desplegable-->
        echo"<p>Introduzca productora de comic:<select id='productora' name=productora>";
            echo"<option >Marvel</option>";
            echo"<option >Dc</option>";
            echo"<option >Image</option>";
        echo"</select>";
<!-- Seleccionamos la situacion mediante unos checkBx (No he conseguido que me devuelva el valor del checkbox escogido)-->
<p>Introduzca situacion de comic:<label><input type='checkbox' value='1' name='opcion1' />Lo tengo</label>;
                echo"<label><input type='checkbox' value='2' name='opcion2' />Lo he leido</label>";
                echo"<label><input type='checkbox' value='3' name='opcion3' />Lo quiero</label><?php echo $dato["situacion"]; ?>";
<p><input type=submit name=guardar value='Actualizar comic'><input type=reset value=limpiar>
<p><a href=index.html>Regresar</a></form>

<?php
}

?>