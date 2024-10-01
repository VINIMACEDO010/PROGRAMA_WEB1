<?php
// Definindo o valor à vista da moto
$valor_moto = 8654.00;

// Função para calcular o valor da parcela com juros simples
function calcular_parcela($valor, $taxa_juros, $num_parcelas) {
    $montante = $valor * (1 + ($taxa_juros * $num_parcelas));  // Fórmula dos juros simples
    return $montante / $num_parcelas;  // Valor de cada parcela
}

// Definindo as opções de financiamento
$parcelas_24 = calcular_parcela($valor_moto, 0.015, 24);
$parcelas_36 = calcular_parcela($valor_moto, 0.020, 36);
$parcelas_48 = calcular_parcela($valor_moto, 0.025, 48);
$parcelas_60 = calcular_parcela($valor_moto, 0.030, 60);

// Exibindo os resultados
echo "<h1>Valor das Parcelas para a Compra da Moto</h1>";
echo "<p>Valor à vista da moto: R$ " . number_format($valor_moto, 2, ',', '.') . "</p>";

echo "<p>Para 24 vezes com juros de 1,5% ao mês: R$ " . number_format($parcelas_24, 2, ',', '.') . " por parcela</p>";
echo "<p>Para 36 vezes com juros de 2,0% ao mês: R$ " . number_format($parcelas_36, 2, ',', '.') . " por parcela</p>";
echo "<p>Para 48 vezes com juros de 2,5% ao mês: R$ " . number_format($parcelas_48, 2, ',', '.') . " por parcela</p>";
echo "<p>Para 60 vezes com juros de 3,0% ao mês: R$ " . number_format($parcelas_60, 2, ',', '.') . " por parcela</p>";
?>