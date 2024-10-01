<?php
// Definindo os valores do problema
$valor_avista = 22500.00;          // Valor do carro à vista
$valor_parcela = 489.65;           // Valor de cada parcela
$num_parcelas = 60;                // Número de parcelas

// Calculando o valor total das parcelas
$valor_total_parcelas = $valor_parcela * $num_parcelas;

// Calculando os juros pagos
$juros_pagos = $valor_total_parcelas - $valor_avista;

// Exibindo o resultado
echo "<h1>Cálculo dos Juros Pagos por Mariazinha</h1>";
echo "<p>O valor à vista do carro é R$ " . number_format($valor_avista, 2, ',', '.') . ".</p>";
echo "<p>O valor total das parcelas é R$ " . number_format($valor_total_parcelas, 2, ',', '.') . ".</p>";
echo "<p>Os juros pagos por Mariazinha serão de R$ " . number_format($juros_pagos, 2, ',', '.') . ".</p>";
?>
