<?php
class Utilidades {
    public static function limpiarTexto($texto) {
        $texto = str_replace('-', ' ', $texto);
        return preg_replace('/[^\\p{L} ]/u', '', $texto);
    }
}
?>

<?php
class Acronimo {
    public static function generar($frase) {
        $frase = Utilidades::limpiarTexto($frase);
        $palabras = explode(' ', $frase);
        $acro = '';
        foreach ($palabras as $p) {
            if ($p != '') $acro .= strtoupper($p[0]);
        }
        return $acro;
    }
}
?>

<form method="POST">
<input name="frase" placeholder="Ingrese frase">
<button>Generar</button>
</form>
<?php
if ($_POST) {
    echo Acronimo::generar($_POST['frase']);
}
?>
<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>