<?php

$disciplinas = array(
    "Banco de dados" => "Marco",
    "Estrutura de dados" => "Bastos",
    "Adm de sistemas" => "Sandro",
    "Eng de Software" => "Julian",
    "Programação Web" => "Cléber"
);

foreach ($disciplinas as $disciplina => $professor) {
    echo "Disciplina: " . $disciplina . " - Professor: " . $professor;
    echo "<br>";
}
?>
