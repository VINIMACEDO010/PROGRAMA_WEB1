<?php
session_start();

// Verificar se o usuário está logado como administrador
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Função para conectar ao banco de dados
function conectadb() {
    return pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
}

// Adicionar uma nova pergunta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_question'])) {
    $newQuestion = $_POST['new_question'];
    if (!empty($newQuestion)) {
        $conn = conectadb();
        $query = "INSERT INTO questions (question_text) VALUES ($1)";
        $result = pg_query_params($conn, $query, [$newQuestion]);
        pg_close($conn);
        $message = $result ? "Pergunta adicionada com sucesso!" : "Erro ao adicionar pergunta.";
    }
}

// Remover uma pergunta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_question_id'])) {
    $questionId = (int)$_POST['delete_question_id'];
    $conn = conectadb();
    $query = "DELETE FROM questions WHERE id = $1";
    $result = pg_query_params($conn, $query, [$questionId]);
    pg_close($conn);
    $message = $result ? "Pergunta removida com sucesso!" : "Erro ao remover pergunta.";
}

// Atualizar ID do dispositivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['device_id'])) {
    $deviceId = (int)$_POST['device_id'];
    $conn = conectadb();
    $query = "UPDATE dispositivos SET dispositivo_id = $1 WHERE setor_id = 1"; // Exemplo de atualização para setor específico
    $result = pg_query_params($conn, $query, [$deviceId]);
    pg_close($conn);
    $message = $result ? "ID do dispositivo atualizado com sucesso!" : "Erro ao atualizar o ID do dispositivo.";
}

// Obter todas as perguntas para exibição
$conn = conectadb();
$questionsResult = pg_query($conn, "SELECT id, question_text FROM questions");
$questions = pg_fetch_all($questionsResult);

// Obter todas as respostas e feedbacks
$responsesResult = pg_query($conn, "SELECT * FROM avaliacoes ORDER BY data_hora DESC LIMIT 10");
$responses = pg_fetch_all($responsesResult);
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Painel do Administrador</h1>
    <?php if (isset($message)): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Seção para Adicionar Pergunta -->
    <section>
        <h2>Adicionar Nova Pergunta</h2>
        <form method="POST">
            <input type="text" name="new_question" placeholder="Digite a nova pergunta" required>
            <button type="submit" name="add_question">Adicionar Pergunta</button>
        </form>
    </section>

    <!-- Seção para Remover Pergunta -->
    <section>
        <h2>Remover Pergunta Existente</h2>
        <form method="POST">
            <select name="delete_question_id" required>
                <option value="">Selecione uma pergunta para remover</option>
                <?php if ($questions): ?>
                    <?php foreach ($questions as $question): ?>
                        <option value="<?= htmlspecialchars($question['id']) ?>">
                            <?= htmlspecialchars($question['question_text']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>Nenhuma pergunta encontrada</option>
                <?php endif; ?>
            </select>
            <button type="submit">Remover Pergunta</button>
        </form>
    </section>

    <!-- Seção para Atualizar ID do Dispositivo -->
    <section>
        <h2>Atualizar ID do Dispositivo</h2>
        <form method="POST">
            <label for="device_id">ID do Dispositivo:</label>
            <input type="number" name="device_id" id="device_id" placeholder="Digite o ID do dispositivo" required>
            <button type="submit">Atualizar</button>
        </form>
    </section>

    <!-- Seção para Visualizar Respostas e Feedbacks -->
    <section>
        <h2>Respostas Recentes</h2>
        <?php if ($responses): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Data e Hora</th>
                        <th>Setor ID</th>
                        <th>Dispositivo ID</th>
                        <th>Feedback</th>
                        <th>Respostas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($responses as $response): ?>
                        <tr>
                            <td><?= htmlspecialchars($response['data_hora']) ?></td>
                            <td><?= htmlspecialchars($response['setor_id']) ?></td>
                            <td><?= htmlspecialchars($response['dispositivo_id']) ?></td>
                            <td><?= htmlspecialchars($response['feedback']) ?></td>
                            <td>
                                <?php
                                // Exibe as respostas (resposta_1, resposta_2, resposta_3)
                                for ($i = 1; $i <= 3; $i++) {
                                    echo "Pergunta $i: " . htmlspecialchars($response["resposta_$i"]) . "<br>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma resposta encontrada.</p>
        <?php endif; ?>
    </section>

    <a href="logout.php">Sair</a>
</body>
</html>
