<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function conectadb() {
        return pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
    }

    $conn = conectadb();
    if (!$conn) {
        die("Erro ao conectar ao banco de dados.");
    }

    // Obter todas as perguntas ativas
    $questionsResult = pg_query($conn, "SELECT id FROM questions");
    if (!$questionsResult) {
        die("Erro ao buscar perguntas: " . pg_last_error($conn));
    }

    $questions = pg_fetch_all($questionsResult);
    if (!$questions) {
        die("Nenhuma pergunta encontrada.");
    }

    // Preparar inserção para tabela de respostas
    $feedback = $_POST['feedback'] ?? null;
    $setorId = 1; // Exemplo: ID do setor ou dispositivo, pode ser variável.
    $dispositivoId = 1; // Exemplo: ID do dispositivo, também pode ser variável.

    foreach ($questions as $question) {
        $questionId = $question['id'];
        $response = $_POST["score_$questionId"] ?? null;

        // Preparar inserção na tabela de respostas
        if ($response !== null) {
            $query = "INSERT INTO responses (question_id, device_id, response_value, feedback) 
                      VALUES ($1, $2, $3, $4)";
            $result = pg_query_params($conn, $query, array($questionId, $dispositivoId, $response, $feedback));

            if (!$result) {
                echo "Erro ao enviar avaliação: " . pg_last_error($conn);
            }
        }
    }

    // Mensagem de agradecimento com CSS inline e cronômetro
    echo "<div style='display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh;'>
            <p style='color: green; font-size: 24px; font-weight: bold; text-align: center; margin-top: 20px;'>
                O Hospital Regional Alto Vale (HRAV) agradece sua resposta e ela é muito importante para nós.
            </p>
            <p style='color: #e0e0e0; font-size: 18px; text-align: center;'>Redirecionando para a tela inicial em <span id='countdown'>5</span> segundos...</p>
          </div>
          <script>
              let countdown = 5;
              const countdownElement = document.getElementById('countdown');
              const interval = setInterval(() => {
                  countdown--;
                  countdownElement.textContent = countdown;
                  if (countdown <= 0) {
                      clearInterval(interval);
                      window.location.href = 'index.php'; // Substitua 'index.php' pelo caminho da sua tela inicial
                  }
              }, 1000);
          </script>";

    pg_close($conn);
}
?>
