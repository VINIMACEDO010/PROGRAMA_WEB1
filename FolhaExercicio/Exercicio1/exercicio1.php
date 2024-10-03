<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soma de Três Valores</title>
</head>
<body>

    <h1>Calcular a Soma de Três Valores</h1>

    <form action="" method="POST">
        <label for="valor1">Valor 1:</label>
        <input type="number" name="valor1" id="valor1" required><br><br>

        <label for="valor2">Valor 2:</label>
        <input type="number" name="valor2" id="valor2" required><br><br>

        <label for="valor3">Valor 3:</label>
        <input type="number" name="valor3" id="valor3" required><br><br>

        <input type="submit" value="Calcular Soma">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber os valores enviados pelo formulário
        $valor1 = $_POST['valor1'];
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];

        // Calcular a soma dos três valores
        $soma = $valor1 + $valor2 + $valor3;

        // Verificar as condições e exibir o resultado com as cores correspondentes
        if ($valor1 > 10) {
            echo "<h2 style='color: blue;'>O resultado da soma é: $soma</h2>";
        } elseif ($valor2 < $valor3) {
            echo "<h2 style='color: green;'>O resultado da soma é: $soma</h2>";
        } elseif ($valor3 < $valor1 && $valor3 < $valor2) {
            echo "<h2 style='color: red;'>O resultado da soma é: $soma</h2>";
        } else {
            echo "<h2>O resultado da soma é: $soma</h2>";
        }
    }
    ?>

</body>
</html>
