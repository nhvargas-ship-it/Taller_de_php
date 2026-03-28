<?php
class Matematica {
    public static function fibonacci($n) {
        $serie = [0,1];
        for ($i=2;$i<$n;$i++)
            $serie[] = $serie[$i-1]+$serie[$i-2];
        return $serie;
    }
    public static function factorial($n) {
        $res = 1;
        for ($i=1;$i<=$n;$i++) $res *= $i;
        return $res;
    }
}

?>

<form method="POST">
<input type="number" name="num">
<select name="op">
<option value="fib">Fibonacci</option>
<option value="fact">Factorial</option>
</select>
<button>Calcular</button>
</form>
<?php
if ($_POST) {
    if ($_POST['op']=='fib')
        print_r(Matematica::fibonacci($_POST['num']));
    else
        echo Matematica::factorial($_POST['num']);
}
?>
<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>