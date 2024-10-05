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

        // Inserção de dados
        if (isset($_POST['campo_primeiro_nome']) && isset($_POST['campo_sobrenome']) && isset($_POST['campo_email']) && isset($_POST['campo_password']) && isset($_POST['campo_cidade']) && isset($_POST['campo_estado'])) {

            // Sanitiza os dados de entrada
            $aDados = array(
                filter_var($_POST['campo_primeiro_nome'], FILTER_SANITIZE_STRING),
                filter_var($_POST['campo_sobrenome'], FILTER_SANITIZE_STRING),
                filter_var($_POST['campo_email'], FILTER_SANITIZE_EMAIL),
                filter_var($_POST['campo_password'], FILTER_SANITIZE_STRING),
                filter_var($_POST['campo_cidade'], FILTER_SANITIZE_STRING),
                filter_var($_POST['campo_estado'], FILTER_SANITIZE_STRING)
            );

            // Etapa 3 - Fazer a query de inserção dos dados (DML) com o array de valores
            $result = pg_query_params($dbconn, 
                "INSERT INTO TBPESSOA (PESNOME, PESSOBRENOME, PESEMAIL, PESPASSWORD, PESCIDADE, PESESTADO) 
                 VALUES ($1, $2, $3, $4, $5, $6)", 
                $aDados
            );

            // Verifica se a inserção foi bem-sucedida
            if ($result) {
                echo "Dados inseridos com sucesso!";
            } else {
                echo "Erro ao inserir dados: " . pg_last_error($dbconn);
            }
        }

        // Pesquisa
        if (isset($_POST['campo_primeiro_nome'])) {
            $pesquisa = "%" . filter_var($_POST['campo_primeiro_nome'], FILTER_SANITIZE_STRING) . "%";
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
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
