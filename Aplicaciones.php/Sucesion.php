

<div class="card">
    <h2>Matemáticas Interactivas</h2>
    
    <form method="POST">
        <label for="numero">Ingresa un número:</label>
        <input type="number" name="numero" id="numero" min="0" max="100" required value="<?php echo $_POST['numero'] ?? ''; ?>">
        
        <label for="operacion">Selecciona la operación:</label>
        <select name="operacion" id="operacion">
            <option value="fibonacci" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'fibonacci') ? 'selected' : ''; ?>>Sucesión de Fibonacci</option>
            <option value="factorial" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'factorial') ? 'selected' : ''; ?>>Factorial</option>
        </select>
        
        <button type="submit">Calcular Resultado</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $n = intval($_POST['numero']);
        $op = $_POST['operacion'];
        
        echo "<div class='result-box'>";
        
        if ($op === 'fibonacci') {
            echo "<strong>Sucesión de Fibonacci ($n términos):</strong><br>";
            echo implode(", ", calcularFibonacci($n));
        } else {
            if ($n > 170) { // Límite técnico de PHP para floats
                echo "<span class='error'>El número es demasiado grande para calcular el factorial.</span>";
            } else {
                echo "<strong>Factorial de $n:</strong><br>";
                echo number_format(calcularFactorial($n), 0, '', '');
            }
        }
        
        echo "</div>";
    }

    // Funciones Lógicas
    function calcularFibonacci($n) {
        $serie = [];
        $a = 0; $b = 1;
        for ($i = 0; $i < $n; $i++) {
            $serie[] = $a;
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }
        return $serie;
    }

    function calcularFactorial($n) {
        if ($n <= 1) return 1;
        $res = 1;
        for ($i = 2; $i <= $n; $i++) {
            $res *= $i;
        }
        return $res;
    }
    ?>
</div>

<br>
<button type="button" onclick="window.location.href='/Taller_de_php'">Volver al menú</button>