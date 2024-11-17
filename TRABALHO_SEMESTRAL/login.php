<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === '123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php'); // Certifique-se de que o nome do arquivo está correto
        exit;
    } else {
        $error = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        form {
            margin: 0;
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
        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        p {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login do Administrador</h1>
        <?php if (!empty($error)): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
<div>
<button onclick="window.location.href='index.php'" style="padding: 8px 16px; font-size: 14px; width: 150px; display: block; margin: 0 auto;">Retornar</button>
</div>
</html>
