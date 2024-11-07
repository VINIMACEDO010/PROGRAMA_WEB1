<?php 

    class Gol {
        private $tempo;
        private $jogador;
        private $time;
        public function setTempo($tempo) {
            $this->tempo = $tempo; 
        }
        public function setJogador($jogador) {
            $this->jogador = $jogador;
        }
        public function setTime($time) {
            $this->time = $time;
        }
        public function getTime() {
            return $this->time;
        }
    }

?>