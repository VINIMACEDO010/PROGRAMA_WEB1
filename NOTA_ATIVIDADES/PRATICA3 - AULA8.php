<?php 

$salario1 = 1000;
$salario2 = 2000;

$salario2 = $salario1;

$salario2 += 1; 
$salario1 *= 1.1;

echo "Valor do Salário 2:  $salario2   Novo valor do Salário 1 com aumento de 10%:   $salario1 <br>";


if ($salario1 > $salario2) {
    echo " O valor do salário 1 é maior que o salario 2";
} else {
    if ($salario1 < $salario2) {
        echo "O valor do salario 2 é maior que i salario 1";
    } else {
        echo "Os valores são iguais";
    }
}
for ($i = 1; $i <= 100; $i++) {

    $salario1++;
    if ($i == 50) {
        break; 
    }
}

if ($salario1 < $salario2) {
    echo " O valor do salário 1 é maior que o salario 2";
} 
?>

