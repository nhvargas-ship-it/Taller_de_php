<?php
class Estadistica {
    public static function promedio($arr) {
        return array_sum($arr)/count($arr);
    }
    public static function moda($arr) {
        $vals = array_count_values($arr);
        return array_search(max($vals), $vals);
    }
}

?>

<form method="POST">
<input name="nums" placeholder="1,2,3,4">
<button>Calcular</button>
</form>
<?php
if ($_POST) {
    $arr = explode(',', $_POST['nums']);
    echo "Promedio: ".Estadistica::promedio($arr);
    echo " Moda: ".Estadistica::moda($arr);
}
?>
<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>