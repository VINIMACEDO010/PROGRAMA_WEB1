<?php

$dados = array(
    array("Matemática", 5, 8.5),
    array("Português", 2, 9),
    array("Geografia", 10, 6),
    array("Educação Física", 2, 8)
);

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Disciplina</th><th>Faltas</th><th>Média</th></tr>";

foreach ($dados as $linha) {
    echo "<tr>";
    foreach ($linha as $valor) {
        echo "<td>$valor</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
