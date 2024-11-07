<?php 

require_once 'conexaobd.php';

class query {
    private $sql;
    private $registros;
    private $connection;
    private $queryResource;

    public function __construct($oConn) {
        $this->registros = 0;
        $this->connection = $oConn;
    }

    public function open() {
        $this->queryResource = pg_query($this->connection->getInternalConnection(), $this->sql);
        if ($this->queryResource) {
            // Retorna a quantidade de linhas da query.
            $this->registros = pg_num_rows($this->queryResource);
            return true;
        } else {
            return false;
        }
    }

    public function getNextRow() {
        $row = pg_fetch_assoc($this->queryResource);
        if ($row) {
            return $row;
        }
        return false;
    }

    public function update($stabela, $aColunas, $aValores, $sWhere) {
        // Verifica se as colunas e os valores são arrays e se têm o mesmo número de elementos
        if (!is_array($aColunas) || !is_array($aValores) || count($aColunas) !== count($aValores)) {
            throw new InvalidArgumentException("Colunas e valores devem ser arrays de mesmo tamanho.");
        }

        // Constrói a cláusula SET
        $setClause = [];
        foreach ($aColunas as $index => $coluna) {
            $setClause[] = "$coluna = $" . ($index + 1);
        }
        $setClauseStr = implode(", ", $setClause);

        // Constrói a consulta SQL
        $sql = "UPDATE $stabela SET $setClauseStr WHERE $sWhere";

        // Executa a consulta com parâmetros
        $result = pg_query_params($this->connection->getInternalConnection(), $sql, $aValores);

        return $result;
    }

    public function insert($sTabela, $aColunas, $aValores) {
        // TODO: Implementar método de insert
    }

    public function delete($sTabela, $sWhere) {
        // TODO: Implementar método de delete
    }

    public function getRegistros() {
        return $this->registros;
    }

    public function setSql($sSql) {
        $this->sql = $sSql;
    }
}

?>
