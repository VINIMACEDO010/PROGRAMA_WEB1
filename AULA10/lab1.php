<?php

function conectadb() {
    $dbconn = false;
    
    if (!$dbconn) {
        $dbconn = pg_connect("host=localhost port=5432 dbname=progweb user=postgres password=admin");
    }

    return $dbconn; // Retorna a conexão
}

/* Função para escrever uma linha da tabela */
function escreveLinhaTabela($pessoa) {
    echo "<tr>";
    foreach ($pessoa as $key => $value) {
        echo "<td>" . htmlspecialchars($value) . "</td>";
    }
    echo "</tr>";
}

/* É uma boa prática fazer a conexão com o SGBD e qualquer outra operação subsequente dentro de um try-catch */
try {
    /* Etapa 1 - Criar uma instância da classe de conexão e definir os parâmetros de conexão */
    $dbconn = conectadb();
    
    if ($dbconn) {
        echo "Database conectada..";

        $pesquisa = isset($_POST['campo_pesquisa']) ? "%" . $_POST['campo_pesquisa'] . "%" : null;

        if ($pesquisa) {
            /* Etapa 2 - Fazer uma query simples - retornará todas as pessoas na tabela tbpessoa */
            $result = pg_query_params($dbconn, "SELECT * FROM tbpessoa WHERE PESNOME ILIKE $1", array($pesquisa));

            if (pg_num_rows($result) > 0) {
                echo "<table border='1'>";
                while ($pessoa = pg_fetch_assoc($result)) {
                    escreveLinhaTabela($pessoa);
                }
                echo "</table>";
            } else {
                echo "Nada Encontrado";
            }
        } else {
            echo "Campo de pesquisa não preenchido.";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
