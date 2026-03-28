<?php
class Conjuntos{
    public static function union($a,$b){return array_unique(array_merge($a,$b));}
    public static function inter($a,$b){return array_values(array_intersect($a,$b));}
    public static function dif($a,$b){return array_values(array_diff($a,$b));}
}
?>

<form method="POST">
<input name="a" placeholder="1,2,3">
<input name="b" placeholder="2,3,4">
<select name="op">
<option value="union">Unión</option>
<option value="inter">Intersección</option>
<option value="difAB">A-B</option>
<option value="difBA">B-A</option>
</select>
<button>Calcular</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $a = $_POST['a'] ?? '';
    $b = $_POST['b'] ?? '';
    $op = $_POST['op'] ?? '';

    if ($a === '' || $b === '' || $op === '') {
        echo "<p style='color:red;'>Error: Complete todos los campos.</p>";
        return;
    }

    $a = explode(',', str_replace(' ', '', $a));
    $b = explode(',', str_replace(' ', '', $b));

    $res = []; // 🔴 Inicialización obligatoria

    switch($op) {
        case 'union':
            $res = Conjuntos::union($a, $b);
            break;

        case 'inter':
            $res = Conjuntos::inter($a, $b);
            break;

        case 'difAB':
            $res = Conjuntos::dif($a, $b);
            break;

        case 'difBA':
            $res = Conjuntos::dif($b, $a);
            break;

        default:
            echo "<p style='color:red;'>Operación inválida</p>";
            return;
    }

    if (!is_array($res)) {
        echo "<p style='color:red;'>Error interno: resultado no válido.</p>";
        return;
    }

    echo "<p>Resultado: {" . implode(',', $res) . "}</p>";
}
?>
<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al Menu</button>