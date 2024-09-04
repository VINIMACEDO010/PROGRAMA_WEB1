function adicionarLinhaTotalizadora() {
    const tabela = document.getElementById('tabelaNotas');
    const corpoTabela = tabela.getElementsByTagName('tbody')[0];
    const cabecalho = tabela.getElementsByTagName('thead')[0].getElementsByTagName('tr')[1];
    const colunas = cabecalho.getElementsByTagName('th').length;

    // Verifica se a linha de média já foi adicionada
    if (document.querySelector('#tabelaNotas tbody tr:last-child td:first-child').textContent === 'Média') {
        alert('Linha de média já adicionada.');
        return;
    }

    // Cria uma nova linha
    const linhaTotal = document.createElement('tr');
    const celula = document.createElement('td');
    celula.textContent = 'Média';
    linhaTotal.appendChild(celula);

    // Adiciona células com a média das matérias
    for (let i = 1; i < colunas; i++) {  // Garante que todas as colunas sejam percorridas
        const celula = document.createElement('td');
        let soma = 0;
        let cont = 0;

        // Soma as notas da coluna atual
        for (const linha of corpoTabela.getElementsByTagName('tr')) {
            const input = linha.getElementsByTagName('td')[i]?.getElementsByTagName('input')[0];
            if (input && input.value !== '') {
                soma += parseFloat(input.value);
                cont++;
            }
        }
        
        // Calcula a média e define o conteúdo da célula
        celula.textContent = cont ? (soma / cont).toFixed(1) : '-';
        linhaTotal.appendChild(celula);
    }

    // Adiciona a linha ao corpo da tabela
    corpoTabela.appendChild(linhaTotal);
}


function adicionarColunaTotalizadora() {
    const tabela = document.getElementById('tabelaNotas');
    const cabecalho = tabela.getElementsByTagName('thead')[0].getElementsByTagName('tr')[1];
    const corpoTabela = tabela.getElementsByTagName('tbody')[0];
    const colunas = cabecalho.getElementsByTagName('th').length;

    // Verifica se a coluna de média já foi adicionada
    if (cabecalho.getElementsByTagName('th')[colunas - 1].textContent === 'Média') {
        alert('Coluna de média já adicionada.');
        return;
    }

    // Adiciona uma nova célula no cabeçalho para a coluna de média
    const cabecalhoNovaColuna = document.createElement('th');
    cabecalhoNovaColuna.textContent = 'Média';
    cabecalho.appendChild(cabecalhoNovaColuna);

    // Adiciona a nova célula de média para cada linha do corpo da tabela
    for (const linha of corpoTabela.getElementsByTagName('tr')) {
        const celula = document.createElement('td');
        let soma = 0;
        let cont = 0;

        // Ajuste do loop para percorrer todas as colunas relevantes
        for (let i = 1; i < colunas - 1; i++) {
            const input = linha.getElementsByTagName('td')[i]?.getElementsByTagName('input')[0];
            if (input && input.value !== '') {
                soma += parseFloat(input.value);
                cont++;
            }
        }

        // Calcula a média e define o conteúdo da nova célula
        celula.textContent = cont ? (soma / cont).toFixed(1) : '-';
        linha.appendChild(celula);
    }
}
