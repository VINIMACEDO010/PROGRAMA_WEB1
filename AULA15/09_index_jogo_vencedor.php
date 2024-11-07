<?php 

    require_once 'model/time.php';
    require_once 'model/jogador.php';
    require_once 'model/jogo.php';
    require_once 'model/gol.php';

    //1 - Definir os times
    //1.1 - Criar uma instância do time 1
    $oTime1 = new time();
    $oTime1->setNome("Brasil");
    $oTime1->setAnoFundacao("1500");

    //1.2 - Criar uma instância do time 1
    $oTime2 = new time();
    $oTime2->setNome("Argentina");
    $oTime2->setAnoFundacao("1900");

    //2 - Definir os jogadores
    $oTime1->addJogador(new jogador("João", "Goleiro", 1));
    $oTime1->addJogador(new jogador("Neymar", "Atacante", 10));
    
    $oTime2->addJogador(new jogador("José", "Meio", 5));

    //3 - Criar o Jogo
    $oJogo = new Jogo();
    $oJogo->setTimeA($oTime1);
    $oJogo->setTimeB($oTime2);

    //4 - Assinalar GOLs
    $oJogo->AddGol($oTime1, $oTime1->getJogador(10), 10);
    $oJogo->AddGol($oTime2, $oTime2->getJogador(5), 15);
    $oJogo->AddGol($oTime1, $oTime1->getJogador(1), 35);

    //5 - Identificar qual foi o time vencedor
    echo $oJogo->getNomeTimeVencedor();
?>