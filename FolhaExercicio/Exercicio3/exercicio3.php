<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo da Área de um Quadrado</title>
</head>
<body>

    <h1>Calcular a Área de um Quadrado</h1>

    <form action="" method="POST">
        <label for="lado">Lado do quadrado (em metros):</label>
        <input type="number" step="0.01" name="lado" id="lado" required><br><br>

        <input type="submit" value="Calcular Área">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber o valor do lado enviado pelo formulário
        $lado = $_POST['lado'];

        // Calcular a área do quadrado
        $area = $lado * $lado;

        // Exibir o resultado
        echo "<h2>A área do quadrado de lado " . number_format($lado, 2, ',', '.') . " metros é " 
             . number_format($area, 2, ',', '.') . " metros quadrados.</h2>";
    }
    ?>

</body>
</html>
