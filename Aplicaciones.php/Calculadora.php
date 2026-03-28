<?php
session_start();
class Calculadora {
    public static function operar($a,$b,$op) {
        switch($op){
            case '+': return $a+$b;
            case '-': return $a-$b;
            case '*': return $a*$b;
            case '/': return $b!=0?$a/$b:'Error';
            case '%': return ($a*$b)/100;
        }
    }
}

?>

<form method="POST">
<input name="a">
<input name="b">
<select name="op">
<option>+</option><option>-</option><option>*</option><option>/</option><option>%</option>
</select>
<button>=</button>
</form>

<?php
if (!isset($_SESSION['hist'])) $_SESSION['hist']=[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'] ?? '';
    $b = $_POST['b'] ?? '';
    $op = $_POST['op'] ?? '';

    if (isset($_POST['clear'])) {
        $_SESSION['hist'] = [];
    } else {
        if ($a === '' || $b === '') {
            echo "<p style='color:red;'>Error: Debe ingresar ambos números.</p>";
        } else {
            $res = Calculadora::operar($a, $b, $op);

            if ($res === 'Error') {
                echo "<p style='color:red;'>Error: División por cero.</p>";
            } else {
                $_SESSION['hist'][] = "$a $op $b = $res";
                echo "<p>$res</p>";
            }
        }
    }
}

foreach($_SESSION['hist'] as $h) echo "<p>$h</p>";
?>

<form method="POST"><button name="clear">Borrar historial</button></form>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>
<?php if(isset($_POST['clear'])) $_SESSION['hist']=[];?>
 