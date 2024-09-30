<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ladoA = isset($_POST['ladoA']) ? (float)$_POST['ladoA'] : 0;
    $ladoB = isset($_POST['ladoB']) ? (float)$_POST['ladoB'] : 0;
    $area = $ladoA * $ladoB;

    if ($area > 10) {
        echo "<h1>A área do retângulo de lados $ladoA e $ladoB metros é $area metros quadrados.</h1>";
    } else {
        echo "<h3>A área do retângulo de lados $ladoA e $ladoB metros é $area metros quadrados.</h3>";
    }
}
?>
