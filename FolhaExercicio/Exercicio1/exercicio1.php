<?php
function somaValores($var1, $var2, $var3) {
    $soma = $var1 + $var2 + $var3;

    if ($var1 > 10) {
        echo "<p style='color: blue; font-size: 24px; font-weight: bold;'>A soma é: $soma</p>";
    } elseif ($var2 < $var3) {
        echo "<p style='color: green; font-size: 24px; font-weight: bold;'>A soma é: $soma</p>";
    } elseif ($var3 < $var1 && $var3 < $var2) {
        echo "<p style='color: red; font-size: 24px; font-weight: bold;'>A soma é: $soma</p>";
    } else {
        echo "<p style='font-size: 24px; font-weight: bold;'>A soma é: $soma</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $var1 = isset($_POST['var1']) ? (float)$_POST['var1'] : 0;
    $var2 = isset($_POST['var2']) ? (float)$_POST['var2'] : 0;
    $var3 = isset($_POST['var3']) ? (float)$_POST['var3'] : 0;

    somaValores($var1, $var2, $var3);
}
?>
