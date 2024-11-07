<?php 
    class Jogador {
        private $nome;
        private $posicao;
        private $dataNascimento;
        private $numeroCamisa;
        public function __construct($nome, $posicao, $numeroCamisa) {
            $this->nome = $nome;
            $this->posicao = $posicao;
            $this->numeroCamisa = $numeroCamisa;            
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setPosicao($posicao) {
            $this->posicao = $posicao;
        }
        public function setDataNascimento($data) {
            $this->dataNascimento = $data;
        }
        public function setNumeroCamisa($numero) {
            $this->numeroCamisa = $numero;
        }
        public function getNumeroCamisa() {
            return $this->numeroCamisa;
        }
        public function getNome() {
            return $this->nome;
        }
    }
?>