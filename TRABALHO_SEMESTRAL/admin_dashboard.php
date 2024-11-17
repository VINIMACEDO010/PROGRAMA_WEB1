<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

function connectDB() {
    return pg_connect("host=localhost port=5432 dbname=avaliacao_hospital user=postgres password=admin");
}

$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_question'])) {
        $question = $_POST['new_question'];
        $addQuery = "ALTER TABLE responses ADD COLUMN response_" . strtolower(preg_replace('/\s+/', '_', $question)) . " TEXT";
        pg_query($conn, $addQuery);
        
        $insertQuery = "INSERT INTO questions (question_text) VALUES ($1)";
        pg_query_params($conn, $insertQuery, [$question]);
    } elseif (isset($_POST['delete_question'])) {
        $questionId = $_POST['delete_question'];
        $deleteQuery = "DELETE FROM questions WHERE id = $1";
        pg_query_params($conn, $deleteQuery, [$questionId]);
    }
}

$questions = pg_query($conn, "SELECT * FROM questions");
$responses = pg_query($conn, "SELECT * FROM responses");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        form {
            margin: 20px 0;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard do Administrador</h1>

        <h2>Adicionar Pergunta</h2>
        <form method="POST">
            <label for="new_question">Nova Pergunta:</label>
            <input type="text" id="new_question" name="new_question" required>
            <button type="submit">Adicionar</button>
        </form>

        <h2>Gerenciar Perguntas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($question = pg_fetch_assoc($questions)): ?>
                    <tr>
                        <td><?= htmlspecialchars($question['id']) ?></td>
                        <td><?= htmlspecialchars($question['question_text']) ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="delete_question" value="<?= $question['id'] ?>">
                                <button type="submit" style="background-color: red;">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Respostas Recebidas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Respostas</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($response = pg_fetch_assoc($responses)): ?>
                    <tr>
                        <td><?= htmlspecialchars($response['id']) ?></td>
                        <td><?= htmlspecialchars(json_encode($response)) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
