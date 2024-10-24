<?php
// Configuração da conexão com o PostgreSQL
function getDbConnection() {
    $host = 'localhost';
    $port = '5432';
    $dbname = 'avaliacao_hospital';
    $user = 'postgres';
    $password = 'admin';

    $conn = pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");

    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . pg_last_error());
    }

    return $conn;
}
?>
