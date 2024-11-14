<?php
// Iniciar sessão para gerenciar autenticação
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Credenciais de administrador (exemplo simples)
    $adminUsername = 'admin';
    $adminPassword = '123';

    // Obter dados do formulário de login
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar credenciais
    if ($username === $adminUsername && $password === $adminPassword) {
        // Se as credenciais estiverem corretas, redirecionar para a área de administração
        $_SESSION['logged_in'] = true;
        header('Location: admin_dashboard.php'); // Redireciona para o painel administrativo
        exit;
    } else {
        $error = "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container" style="max-width: 400px; margin: auto; padding-top: 50px;">
        <h2>Login Administrador</h2>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div>
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
