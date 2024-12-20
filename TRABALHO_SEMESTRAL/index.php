<?php
// Código para conectar ao banco de dados e obter perguntas
function conectadb() {
    $dbconn = pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
    if (!$dbconn) {
        die("Erro ao conectar ao banco de dados.");
    }
    return $dbconn;
}

function getQuestions() {
    $conn = conectadb();
    $result = pg_query($conn, "SELECT id, question_text FROM questions");
    if (!$result) {
        die("Erro na consulta: " . pg_last_error($conn));
    }

    $questions = [];
    while ($row = pg_fetch_assoc($result)) {
        $questions[] = $row;
    }

    pg_close($conn);
    return $questions;
}

$questions = getQuestions();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        /* Estilo do emoji de administrador */
        .admin-icon {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            text-decoration: none;
            color: #333;
            cursor: pointer;
        }
        .admin-icon:hover {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <!-- Emoji de administrador -->
    <a href="login.php" class="admin-icon" title="Acesso Administrador">👤</a>

    <h1>Avaliação - Hospital Regional Alto Vale</h1>
    <p style="text-align: center; font-size: 14px; color: #555;">
        Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
    </p>

    <form id="evaluationForm" method="POST" action="submit.php">
        <?php foreach ($questions as $question): ?>
            <div class="question-block">
                <label><?= htmlspecialchars($question['question_text']) ?></label>
                <div class="scale">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <label class="scale-label">
                            <input type="radio" name="score_<?= $question['id'] ?>" value="<?= $i ?>" required>
                            <span><?= $i ?></span>
                        </label>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div>
            <label for="feedback">Feedback Adicional (opcional):</label><br>
            <textarea id="feedback" name="feedback" rows="4" cols="50"></textarea>
        </div>

        <button type="submit">Enviar Avaliação</button>
    </form>

    <p id="error-message" style="color: red; display: none;"></p>
    <script src="script.js"></script>
</body>
</html>
