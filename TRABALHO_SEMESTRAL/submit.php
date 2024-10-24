<?php
function conectadb() {
    $dbconn = false;

    if (!$dbconn) {
        $dbconn = pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
    }

    return $dbconn; // Retorna a conexão
}

// Verificar se a conexão com o banco de dados foi bem-sucedida
$conn = conectadb();
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

$feedback = $_POST['feedback'];
$date = date('Y-m-d H:i:s');
$device_id = 1; // Exemplo de dispositivo, pode ser dinâmico
$sector_id = 1; // Exemplo de setor

// Inserir respostas das perguntas
foreach ($_POST as $key => $value) {
    if (strpos($key, 'score_') === 0) {
        $question_id = str_replace('score_', '', $key);
        $response = $value;

        $query = "INSERT INTO avaliacoes (setor_id, pergunta_id, dispositivo_id, resposta, feedback, data_hora)
                  VALUES ($sector_id, $question_id, $device_id, $response, '$feedback', '$date')";

        $result = pg_query($conn, $query);

        if (!$result) {
            die("Erro ao inserir dados: " . pg_last_error());
        }
    }
}

pg_close($conn); // Fechar a conexão

// Mensagem de agradecimento
echo "<p>O Hospital Regional Alto Vale (HRAV) agradece sua resposta e ela é muito importante para nós.</p>";
?>
