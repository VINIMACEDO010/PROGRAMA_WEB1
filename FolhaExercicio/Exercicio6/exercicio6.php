<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $preco_maca = isset($_POST['preco_maca']) ? (float)$_POST['preco_maca'] : 0;
    $kg_maca = isset($_POST['kg_maca']) ? (float)$_POST['kg_maca'] : 0;

    $preco_melancia = isset($_POST['preco_melancia']) ? (float)$_POST['preco_melancia'] : 0;
    $kg_melancia = isset($_POST['kg_melancia']) ? (float)$_POST['kg_melancia'] : 0;

    $preco_laranja = isset($_POST['preco_laranja']) ? (float)$_POST['preco_laranja'] : 0;
    $kg_laranja = isset($_POST['kg_laranja']) ? (float)$_POST['kg_laranja'] : 0;

    $preco_repolho = isset($_POST['preco_repolho']) ? (float)$_POST['preco_repolho'] : 0;
    $kg_repolho = isset($_POST['kg_repolho']) ? (float)$_POST['kg_repolho'] : 0;

    $preco_cenoura = isset($_POST['preco_cenoura']) ? (float)$_POST['preco_cenoura'] : 0;
    $kg_cenoura = isset($_POST['kg_cenoura']) ? (float)$_POST['kg_cenoura'] : 0;

    $preco_batata = isset($_POST['preco_batata']) ? (float)$_POST['preco_batata'] : 0;
    $kg_batata = isset($_POST['kg_batata']) ? (float)$_POST['kg_batata'] : 0;

    $valor_maca = $preco_maca * $kg_maca;
    $valor_melancia = $preco_melancia * $kg_melancia;
    $valor_laranja = $preco_laranja * $kg_laranja;
    $valor_repolho = $preco_repolho * $kg_repolho;
    $valor_cenoura = $preco_cenoura * $kg_cenoura;
    $valor_batata = $preco_batata * $kg_batata;

    $valor_total = $valor_maca + $valor_melancia + $valor_laranja + $valor_repolho + $valor_cenoura + $valor_batata;
    $dinheiro = 50.00;
    $saldo = $dinheiro - $valor_total;

    if ($valor_total > $dinheiro) {
        $diferenca = $valor_total - $dinheiro;
        echo "<p style='color: red; font-size: 24px;'>O valor total da compra é R$ $valor_total. Joãozinho precisa de mais R$ $diferenca para completar a compra.</p>";
    } elseif ($valor_total < $dinheiro) {
        echo "<p style='color: blue; font-size: 24px;'>O valor total da compra é R$ $valor_total. Joãozinho ainda tem R$ $saldo disponíveis para gastar.</p>";
    } else {
        echo "<p style='color: green; font-size: 24px;'>O valor total da compra é R$ $valor_total. Joãozinho usou exatamente os R$ 50,00 disponíveis.</p>";
    }
}
?>
