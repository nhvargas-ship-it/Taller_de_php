

<div class="container">
    <h2> Constructor de Árboles</h2>
    <p>Ingresa al menos <strong>Inorden</strong> y uno de los otros dos (separados por comas o espacios).</p>
    
    <form method="POST">
        <label>Preorden (Raíz -> Izq -> Der):</label>
        <input type="text" name="preorder" placeholder="Ej: A, B, D, E, C" value="<?php echo $_POST['preorder'] ?? ''; ?>">
        
        <label>Inorden (Izq -> Raíz -> Der):</label>
        <input type="text" name="inorder" placeholder="Ej: D, B, E, A, C" value="<?php echo $_POST['inorder'] ?? ''; ?>">
        
        <label>Postorden (Izq -> Der -> Raíz):</label>
        <input type="text" name="postorder" placeholder="Ej: D, E, B, C, A" value="<?php echo $_POST['postorder'] ?? ''; ?>">
        
        <button type="submit">Construir Árbol</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pre = preg_split('/[\s,]+/', trim($_POST['preorder']), -1, PREG_SPLIT_NO_EMPTY);
        $in  = preg_split('/[\s,]+/', trim($_POST['inorder']), -1, PREG_SPLIT_NO_EMPTY);
        $post = preg_split('/[\s,]+/', trim($_POST['postorder']), -1, PREG_SPLIT_NO_EMPTY);

        echo "<div class='result'>";
        
        if (empty($in)) {
            echo "<span class='error'>Error: El recorrido Inorden es obligatorio.</span>";
        } elseif (!empty($pre) && count($pre) == count($in)) {
            echo "<strong>Resultado (Basado en Preorden + Inorden):</strong>\n\n";
            $builder = new TreeLogic();
            $root = $builder->buildFromPreIn($pre, $in, 0, count($in) - 1);
            $builder->display($root);
        } elseif (!empty($post) && count($post) == count($in)) {
            echo "<strong>Resultado (Basado en Postorden + Inorden):</strong>\n\n";
            $builder = new TreeLogic();
            $pIdx = count($post) - 1;
            $root = $builder->buildFromPostIn($post, $in, 0, count($in) - 1, $pIdx);
            $builder->display($root);
        } else {
            echo "<span class='error'>Error: Los recorridos deben tener la misma cantidad de elementos.</span>";
        }
        echo "</div>";
    }

    class Node {
        public $data; public $left; public $right;
        public function __construct($d) { $this->data = $d; }
    }

    class TreeLogic {
        private $preIdx = 0;

        public function buildFromPreIn($pre, $in, $start, $end) {
            if ($start > $end) return null;
            $node = new Node($pre[$this->preIdx++]);
            if ($start == $end) return $node;
            $idx = array_search($node->data, $in);
            $node->left = $this->buildFromPreIn($pre, $in, $start, $idx - 1);
            $node->right = $this->buildFromPreIn($pre, $in, $idx + 1, $end);
            return $node;
        }

        public function buildFromPostIn($post, $in, $start, $end, &$pIdx) {
            if ($start > $end) return null;
            $node = new Node($post[$pIdx--]);
            if ($start == $end) return $node;
            $idx = array_search($node->data, $in);
            $node->right = $this->buildFromPostIn($post, $in, $idx + 1, $end, $pIdx);
            $node->left = $this->buildFromPostIn($post, $in, $start, $idx - 1, $pIdx);
            return $node;
        }

        public function display($node, $level = 0) {
            if ($node) {
                $this->display($node->right, $level + 1);
                echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) . "|-- " . $node->data . "<br>";
                $this->display($node->left, $level + 1);
            }
        }
    }
    ?>
</div>


<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>