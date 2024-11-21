<?php

// Prática 4 
$SALARIO1 = 1000;
$SALARIO2 = 1000;

for ($i = 0; $i < 100; $i++) {
    $SALARIO1++;

    if ($i == 49) { 
        break;
    }
}
if ($SALARIO1 < $SALARIO2) {
    echo "<p>O valor final de SALARIO1 é: $SALARIO1</p>";
} else {
    echo "<p>SALARIO1 não é menor que SALARIO2. O valor final de SALARIO1 é: $SALARIO1</p>";
}
?>
