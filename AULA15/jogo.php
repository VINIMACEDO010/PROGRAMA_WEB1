<?php 

    class jogo {
        private $timeA;
        private $timeB;
        private $gols;
        private $golTimeA;
        private $golTimeB;

        public function __construct() {
            $this->gols = Array();
            $this->golTimeA = 0;
            $this->golTimeB = 0;
        }
        public function setTimeA($time) {
            $this->timeA = $time;
        }
        public function setTimeB($time) {
            $this->timeB = $time;
        }
        public function AddGol($time, $jogador, $tempo) {
            $oGol = new Gol();
            $oGol->setTempo($tempo);
            $oGol->setJogador($jogador);
            $oGol->setTime($time);

            echo "Goool... Jogador: " . $jogador->getNome() . "<br>";

            if($time === $this->timeA) {
                $this->golTimeA++;
            } elseif($time === $this->timeB) {
                $this->golTimeB++;
            } else {
                return false;                
            }
            array_push($this->gols, $oGol);
            return true;
        }
        public function getNomeTimeVencedor() {
            if($this->golTimeA > $this->golTimeB) {
                $nomeTime = $this->timeA->getNome();
            } elseif($this->golTimeB > $this->golTimeA) {
                $nomeTime = $this->timeA->getNome();
            } else {
                return "Empatou";
            }
            return $nomeTime . ". Placar: " . $this->golTimeA . " a " . $this->golTimeB;
        }
    }

?>