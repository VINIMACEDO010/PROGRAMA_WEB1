<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = isset($_POST['numero']) ? (int)$_POST['numero'] : 0;

    if ($numero % 2 === 0) {
        echo "<p style='color: green; font-size: 24px; font-weight: bold;'>Valor divisível por 2</p>";
    } else {
        echo "<p style='color: red; font-size: 24px; font-weight: bold;'>O valor não é divisível por 2</p>";
    }
}
?>
