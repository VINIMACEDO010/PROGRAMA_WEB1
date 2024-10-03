<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo da Área do Triângulo Retângulo</title>
</head>
<body>

    <h1>Calcular a Área de um Triângulo Retângulo</h1>

    <form action="" method="POST">
        <label for="base">Base do triângulo (em metros):</label>
        <input type="number" step="0.01" name="base" id="base" required><br><br>

        <label for="altura">Altura do triângulo (em metros):</label>
        <input type="number" step="0.01" name="altura" id="altura" required><br><br>

        <input type="submit" value="Calcular Área">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber os valores da base e da altura enviados pelo formulário
        $base = $_POST['base'];
        $altura = $_POST['altura'];

        // Calcular a área do triângulo retângulo
        $area = ($base * $altura) / 2;

        // Exibir o resultado
        echo "<h2>A área do triângulo de base " . number_format($base, 2, ',', '.') . " metros e altura " 
             . number_format($altura, 2, ',', '.') . " metros é " 
             . number_format($area, 2, ',', '.') . " metros quadrados.</h2>";
    }
    ?>

</body>
</html>
