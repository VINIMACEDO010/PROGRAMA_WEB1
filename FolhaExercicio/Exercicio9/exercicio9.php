<?php
// Definindo o valor à vista da moto
$valor_moto = 8654.00;

// Função para calcular o montante com juros compostos
function calcular_parcela($valor, $taxa_juros, $num_parcelas) {
    $montante = $valor * pow((1 + $taxa_juros), $num_parcelas);  // Fórmula dos juros compostos
    return $montante / $num_parcelas;  // Valor de cada parcela
}

// Definindo as opções de financiamento
$parcelas_24 = calcular_parcela($valor_moto, 0.02, 24);
$parcelas_36 = calcular_parcela($valor_moto, 0.023, 36);
$parcelas_48 = calcular_parcela($valor_moto, 0.026, 48);
$parcelas_60 = calcular_parcela($valor_moto, 0.029, 60);

// Exibindo os resultados
echo "<h1>Valor das Parcelas para a Compra da Moto com Juros Compostos</h1>";
echo "<p>Valor à vista da moto: R$ " . number_format($valor_moto, 2, ',', '.') . "</p>";

echo "<p>Para 24 vezes com juros de 2% ao mês: R$ " . number_format($parcelas_24, 2, ',', '.') . " por parcela</p>";
echo "<p>Para 36 vezes com juros de 2,3% ao mês: R$ " . number_format($parcelas_36, 2, ',', '.') . " por parcela</p>";
echo "<p>Para 48 vezes com juros de 2,6% ao mês: R$ " . number_format($parcelas_48, 2, ',', '.') . " por parcela</p>";
echo "<p>Para 60 vezes com juros de 2,9% ao mês: R$ " . number_format($parcelas_60, 2, ',', '.') . " por parcela</p>";
?>
