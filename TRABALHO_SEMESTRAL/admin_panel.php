<!-- admin_panel.php -->
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Função para conectar ao banco de dados
function conectadb() {
    $dbconn = pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
    return $dbconn;
}

// Conectar ao banco de dados
$conn = conectadb();

// Adicionar pergunta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_question'])) {
    $question_text = $_POST['new_question'];
    pg_query($conn, "INSERT INTO questions (question_text) VALUES ('$question_text')");
}

// Remover pergunta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_question_id'])) {
    $delete_question_id = $_POST['delete_question_id'];
    pg_query($conn, "DELETE FROM questions WHERE id = $delete_question_id");
}

// Buscar todas as perguntas e respostas
$questions_result = pg_query($conn, "SELECT * FROM questions");
$responses_result = pg_query($conn, "SELECT * FROM avaliacoes");

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Painel do Administrador</h2>

    <!-- Formulário para adicionar pergunta -->
    <form method="POST">
        <label for="new_question">Adicionar Nova Pergunta:</label>
        <input type="text" id="new_question" name="new_question" required>
        <button type="submit">Adicionar Pergunta</button>
    </form>

    <!-- Lista de perguntas existentes para remoção -->
    <h3>Perguntas Atuais:</h3>
    <ul>
        <?php while ($question = pg_fetch_assoc($questions_result)): ?>
            <li>
                <?= htmlspecialchars($question['question_text']) ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_question_id" value="<?= $question['id'] ?>">
                    <button type="submit">Remover</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>

    <!-- Lista de respostas -->
    <h3>Respostas Submetidas:</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Setor</th>
            <th>Dispositivo</th>
            <th>Feedback</th>
            <th>Data/Hora</th>
            <th>Respostas</th>
        </tr>
        <?php while ($response = pg_fetch_assoc($responses_result)): ?>
            <tr>
                <td><?= $response['id'] ?></td>
                <td><?= $response['setor_id'] ?></td>
                <td><?= $response['dispositivo_id'] ?></td>
                <td><?= htmlspecialchars($response['feedback']) ?></td>
                <td><?= $response['data_hora'] ?></td>
                <td><?= implode(', ', array_slice($response, 5)) ?></td> <!-- Exibe respostas -->
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="logout.php">Sair</a>
</body>
</html>
