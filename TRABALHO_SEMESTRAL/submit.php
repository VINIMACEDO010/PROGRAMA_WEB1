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

// Inicializar um array para armazenar as respostas
$respostas = [];

// Coletar respostas das perguntas
foreach ($_POST as $key => $value) {
    if (strpos($key, 'score_') === 0) {
        $question_id = str_replace('score_', '', $key);
        // Assumindo que as perguntas são numeradas sequencialmente (1, 2, 3,...)
        $respostas[$question_id] = $value;
    }
}

// Inserir a única linha com todas as respostas
$query = "INSERT INTO avaliacoes (setor_id, dispositivo_id, feedback, data_hora, resposta_1, resposta_2, resposta_3)
          VALUES ($sector_id, $device_id, '$feedback', '$date', 
          {$respostas[1]}, {$respostas[2]}, {$respostas[3]})"; // Modifique para o número correto de respostas

$result = pg_query($conn, $query);

if (!$result) {
    die("Erro ao inserir dados: " . pg_last_error());
}

pg_close($conn); // Fechar a conexão

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
?>
