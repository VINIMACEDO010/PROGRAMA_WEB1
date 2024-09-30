<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lado = isset($_POST['lado']) ? (float)$_POST['lado'] : 0;
    $area = $lado * $lado;

    echo "<p style='font-size: 24px; font-weight: bold;'>A área do quadrado de lado $lado metros é $area metros quadrados.</p>";
}
?>
