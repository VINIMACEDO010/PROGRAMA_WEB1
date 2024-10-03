<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo da Área de um Retângulo</title>
</head>
<body>

    <h1>Calcular a Área de um Retângulo</h1>

    <form action="" method="POST">
        <label for="lado_a">Lado A do retângulo (em metros):</label>
        <input type="number" step="0.01" name="lado_a" id="lado_a" required><br><br>

        <label for="lado_b">Lado B do retângulo (em metros):</label>
        <input type="number" step="0.01" name="lado_b" id="lado_b" required><br><br>

        <input type="submit" value="Calcular Área">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber os valores dos lados A e B enviados pelo formulário
        $lado_a = $_POST['lado_a'];
        $lado_b = $_POST['lado_b'];

        // Calcular a área do retângulo
        $area = $lado_a * $lado_b;

        // Exibir o resultado de acordo com a condição
        if ($area > 10) {
            echo "<h1>A área do retângulo de lados " . number_format($lado_a, 2, ',', '.') . " metros e " 
                 . number_format($lado_b, 2, ',', '.') . " metros é " 
                 . number_format($area, 2, ',', '.') . " metros quadrados.</h1>";
        } else {
            echo "<h3>A área do retângulo de lados " . number_format($lado_a, 2, ',', '.') . " metros e " 
                 . number_format($lado_b, 2, ',', '.') . " metros é " 
                 . number_format($area, 2, ',', '.') . " metros quadrados.</h3>";
        }
    }
    ?>

</body>
</html>
