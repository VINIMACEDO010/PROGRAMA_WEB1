<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feira de Joãozinho</title>
</head>
<body>

    <h1>Cálculo de Despesas da Feira</h1>

    <form action="" method="POST">
        <label for="maca">Preço da Maçã (kg):</label>
        <input type="number" step="0.01" name="preco_maca" id="maca" required>
        <label for="quant_maca">Quantidade de Maçã (kg):</label>
        <input type="number" step="0.01" name="quant_maca" id="quant_maca" required><br><br>

        <label for="melancia">Preço da Melancia (kg):</label>
        <input type="number" step="0.01" name="preco_melancia" id="melancia" required>
        <label for="quant_melancia">Quantidade de Melancia (kg):</label>
        <input type="number" step="0.01" name="quant_melancia" id="quant_melancia" required><br><br>

        <label for="laranja">Preço da Laranja (kg):</label>
        <input type="number" step="0.01" name="preco_laranja" id="laranja" required>
        <label for="quant_laranja">Quantidade de Laranja (kg):</label>
        <input type="number" step="0.01" name="quant_laranja" id="quant_laranja" required><br><br>

        <label for="repolho">Preço do Repolho (kg):</label>
        <input type="number" step="0.01" name="preco_repolho" id="repolho" required>
        <label for="quant_repolho">Quantidade de Repolho (kg):</label>
        <input type="number" step="0.01" name="quant_repolho" id="quant_repolho" required><br><br>

        <label for="cenoura">Preço da Cenoura (kg):</label>
        <input type="number" step="0.01" name="preco_cenoura" id="cenoura" required>
        <label for="quant_cenoura">Quantidade de Cenoura (kg):</label>
        <input type="number" step="0.01" name="quant_cenoura" id="quant_cenoura" required><br><br>

        <label for="batatinha">Preço da Batatinha (kg):</label>
        <input type="number" step="0.01" name="preco_batatinha" id="batatinha" required>
        <label for="quant_batatinha">Quantidade de Batatinha (kg):</label>
        <input type="number" step="0.01" name="quant_batatinha" id="quant_batatinha" required><br><br>

        <input type="submit" value="Calcular Despesas">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dinheiroDisponivel = 50.00;

        // Receber os valores enviados pelo formulário
        $preco_maca = $_POST['preco_maca'];
        $quant_maca = $_POST['quant_maca'];
        $preco_melancia = $_POST['preco_melancia'];
        $quant_melancia = $_POST['quant_melancia'];
        $preco_laranja = $_POST['preco_laranja'];
        $quant_laranja = $_POST['quant_laranja'];
        $preco_repolho = $_POST['preco_repolho'];
        $quant_repolho = $_POST['quant_repolho'];
        $preco_cenoura = $_POST['preco_cenoura'];
        $quant_cenoura = $_POST['quant_cenoura'];
        $preco_batatinha = $_POST['preco_batatinha'];
        $quant_batatinha = $_POST['quant_batatinha'];

        // Calcular o valor total gasto
        $totalCompra = ($preco_maca * $quant_maca) + ($preco_melancia * $quant_melancia) + 
                       ($preco_laranja * $quant_laranja) + ($preco_repolho * $quant_repolho) +
                       ($preco_cenoura * $quant_cenoura) + ($preco_batatinha * $quant_batatinha);

        echo "<h2>O valor total da compra foi R$ " . number_format($totalCompra, 2, ',', '.') . "</h2>";

        if ($totalCompra > $dinheiroDisponivel) {
            $valorFaltante = $totalCompra - $dinheiroDisponivel;
            echo "<h3 style='color: red;'>Faltou R$ " . number_format($valorFaltante, 2, ',', '.') . " para pagar a compra.</h3>";
        } elseif ($totalCompra < $dinheiroDisponivel) {
            $valorRestante = $dinheiroDisponivel - $totalCompra;
            echo "<h3 style='color: blue;'>Joãozinho ainda pode gastar R$ " . number_format($valorRestante, 2, ',', '.') . ".</h3>";
        } else {
            echo "<h3 style='color: green;'>O saldo de Joãozinho foi esgotado. Ele utilizou exatamente R$ 50,00.</h3>";
        }
    }
    ?>

</body>
</html>
