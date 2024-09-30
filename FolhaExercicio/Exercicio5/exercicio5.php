<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $base = isset($_POST['base']) ? (float)$_POST['base'] : 0;
    $altura = isset($_POST['altura']) ? (float)$_POST['altura'] : 0;
    $area = ($base * $altura) / 2;

    echo "<p style='font-size: 24px; font-weight: bold;'>A área do triângulo retângulo de base $base metros e altura $altura metros é $area metros quadrados.</p>";
}
?>
