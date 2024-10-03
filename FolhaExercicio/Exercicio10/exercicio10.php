<?php
// Definindo o array com os elementos da árvore
$tree = [
    'bsn' => [
        '3a Fase' => [
            'desenv Web',
            'bancoDados',
            'engSoft'
        ],
        '4a Fase' => [
            'Intro Web',
            'bancoDados 2',
            'engSoft 2'
        ]
    ]
];

// Função recursiva para percorrer e exibir a árvore
function exibirArvore($array, $nivel = 0) {
    // Incrementa o nível de indentação para cada chamada recursiva
    $espaco = str_repeat('- ', $nivel);
    
    foreach ($array as $chave => $valor) {
        // Se o valor for um array, exibir a chave e chamar a função recursivamente
        if (is_array($valor)) {
            echo $espaco . $chave . "<br>";
            exibirArvore($valor, $nivel + 1);  // Chamada recursiva
        } else {
            // Caso contrário, exibir o valor
            echo $espaco . $valor . "<br>";
        }
    }
}

// Exibindo a árvore
echo "<h1>Estrutura da Árvore</h1>";
exibirArvore($tree);
?>
