<?php
session_start();
session_destroy(); // Encerra a sessão

echo "<p>Sessão encerrada com sucesso!</p>";
echo '<a href="Exercicio_1">Voltar ao login</a>';
?>