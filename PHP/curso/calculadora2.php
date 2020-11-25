<?php

//Parseamos los input a un valor int
$operando1 = (int) $_REQUEST["operando1"];
$operacion = $_REQUEST["operacion"];
$operando2 = (int) $_REQUEST["operando2"];





if ($operacion == "sum") {

    //realizamos la suma
    $resultado = $operando1+$operando2;


} else if($operacion == "res"){
    //realizamos la resta

    $resultado = $operando1 -$operando2;

} else if ($operacion == "mul") {

    //realizamos la multiplicacion
    $resultado = $operando1* $operando2;

} else if ($operacion == "div"){
    //realizamos la division
    if ($operando2 !=0)   {

        $resultado = $operando1 /$operando2;
    } else {

        //Aqui comprobamos si se intenta dividir entre 0
        $errorDivCero = true;

    }

}



$errorDivCero = false;




?>



<html lang="es">

<head>
<title></title>
</head>

<body>

<?php
//Error al dividir
if ($errorDivCero) {
    //Error al dividir

    echo "<p>No es posible dividir entre 0</p>";

} else {
//devolvemos el resultado de la operacion realizada
    echo "<p>El resultado de $operando1 $operacion $operando2 es igual a: $resultado</p>";


}
?>

</body>

</html>