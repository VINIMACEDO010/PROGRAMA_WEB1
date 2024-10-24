<?php
function conectadb() {
    $dbconn = false;

    if (!$dbconn) {
        $dbconn = pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
    }

    return $dbconn; // Retorna a conexão
}

function getQuestions() {
    $conn = conectadb(); // Usando a função de conexão

    if (!$conn) {
        die("Erro ao conectar ao banco de dados.");
    }

    $result = pg_query($conn, "SELECT id, question_text FROM questions");

    if (!$result) {
        die("Erro na consulta: " . pg_last_error());
    }

    $questions = [];
    while ($row = pg_fetch_assoc($result)) {
        $questions[] = $row;
    }

    pg_close($conn); // Fechar a conexão
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
</head>
<body>
    <h1>Formulário de Avaliação</h1>

    <form method="POST" action="submit.php">
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
    <script src="script.js"></script>
</body>
</html>
