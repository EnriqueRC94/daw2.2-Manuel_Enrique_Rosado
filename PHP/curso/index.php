<?

if ($_REQUEST['numero'])
    $numero = $_REQUEST['numero'];
else
    $numero = mt_rand(1,100);

if ($_REQUEST['intentos'])
    $intentos= $_REQUEST['intentos'];
else
    $intentos = 5;

if ($introducido = $_REQUEST['introducido'])
{
    if ($introducido == $numero)
    { echo "Enhorabuena"; die(); }
    elseif ($introducido > $numero)
        echo "Pon un número más bajo";
    else
        echo "Pon un número más alto";

    $intentos--;
}

echo "<form methos=post><input name=introducido><input
type=hidden name=intentos value=$intentos><input type=hidden name=numero
value=$numero><input type=submit></form>";

?>
