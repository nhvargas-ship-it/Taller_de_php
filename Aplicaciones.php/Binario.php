<?php
class Conversor {
    public static function binario($n){return decbin($n);}    
}

?>

<form method="POST">
<input name="num">
<button>Convertir</button>
</form>
<?php
if ($_POST) echo Conversor::binario($_POST['num']);
?>
<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>
