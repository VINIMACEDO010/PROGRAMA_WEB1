<?php 

$salario1 = 1000;
$salario2 = 2000;

$salario2 = $salario1;

$salario2 += 1; 
$salario1 *= 1.1;

echo "Valor do Salário 2: " . $salario2 . "  Novo valor do Salário 1 com aumento de 10%:  " . $salario1;

?>