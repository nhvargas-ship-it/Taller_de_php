<?php
class Nodo {
    public $valor;
    public $izq;
    public $der;
    public function __construct($v) { $this->valor = $v; }
}

class ArbolBinario {
    public static function construirDesdePreIn($pre, $in) {
        if (empty($pre) || empty($in)) return null;

        $raizValor = $pre[0];
        $raiz = new Nodo($raizValor);

        $indice = array_search($raizValor, $in);

        $inIzq = array_slice($in, 0, $indice);
        $inDer = array_slice($in, $indice + 1);

        $preIzq = array_slice($pre, 1, count($inIzq));
        $preDer = array_slice($pre, 1 + count($inIzq));

        $raiz->izq = self::construirDesdePreIn($preIzq, $inIzq);
        $raiz->der = self::construirDesdePreIn($preDer, $inDer);

        return $raiz;
    }

    public static function imprimir($nodo) {
        if ($nodo == null) return "";
        return $nodo->valor . "(" . self::imprimir($nodo->izq) . "," . self::imprimir($nodo->der) . ")";
    }
}

?>

<form method="POST">
<input name="pre" placeholder="Preorden: A,B,D,E,C">
<input name="in" placeholder="Inorden: D,B,E,A,C">
<button>Construir Árbol</button>
</form>
<?php
if ($_POST) {
    $pre = explode(',', str_replace(' ', '', $_POST['pre']));
    $in = explode(',', str_replace(' ', '', $_POST['in']));

    $arbol = ArbolBinario::construirDesdePreIn($pre, $in);

    echo "Representación: ";
    echo ArbolBinario::imprimir($arbol);
}
?>
<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>