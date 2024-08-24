// Função para calcular a média das notas por coluna
function calcularMediaNotas() {
    const tabela = document.getElementById('tabelaNotas');
    const linhas = tabela.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    const colunas = linhas[0].getElementsByClassName('nota').length;

    const somaNotas = Array(colunas).fill(0);
    const contagemNotas = Array(colunas).fill(0);

    for (let i = 0; i < linhas.length; i++) {
        const inputs = linhas[i].getElementsByClassName('nota');
        for (let j = 0; j < inputs.length; j++) {
            const valor = parseFloat(inputs[j].value);
            if (!isNaN(valor)) {
                somaNotas[j] += valor;
                contagemNotas[j]++;
            }
        }
    }

    const mediaNotas = somaNotas.map((soma, index) => contagemNotas[index] > 0 ? soma / contagemNotas[index] : 0);
    return mediaNotas;
}

// Função para adicionar a linha totalizadora com a média das matérias
function adicionarLinhaTotalizadora() {
    const tabela = document.getElementById('tabelaNotas');
    const tbody = tabela.getElementsByTagName('tbody')[0];
    const mediaNotas = calcularMediaNotas();

    // Remove a linha totalizadora existente, se houver
    const linhas = tbody.getElementsByTagName('tr');
    if (linhas.length > 0 && linhas[linhas.length - 1].classList.contains('total')) {
        tbody.removeChild(linhas[linhas.length - 1]);
    }

    // Cria a linha totalizadora
    const linhaTotalizadora = document.createElement('tr');
    linhaTotalizadora.classList.add('total');
    linhaTotalizadora.innerHTML = `<td><strong>Total</strong></td>`;
    mediaNotas.forEach(media => {
        const td = document.createElement('td');
        td.textContent = media.toFixed(1);
        linhaTotalizadora.appendChild(td);
    });

    tbody.appendChild(linhaTotalizadora);
}

// Função para adicionar a coluna com a média de cada aluno
function adicionarColunaTotalizadora() {
    const tabela = document.getElementById('tabelaNotas');
    const tbody = tabela.getElementsByTagName('tbody')[0];
    const linhas = tbody.getElementsByTagName('tr');
    const numNotas = linhas[0].getElementsByClassName('nota').length;

    // Remove a coluna de média existente, se houver
    for (let i = 0; i < linhas.length; i++) {
        const linha = linhas[i];
        if (linha.cells.length > numNotas + 1) {
            linha.deleteCell(-1);
        }
    }

    // Adiciona a nova coluna a cada linha
    for (let i = 0; i < linhas.length; i++) {
        const linha = linhas[i];
        const novaCelula = document.createElement('td');
        if (i === 0) { // Adiciona o cabeçalho da coluna
            novaCelula.innerHTML = '<strong>Média</strong>';
        } else { // Adiciona a média de cada aluno
            const inputs = linha.getElementsByClassName('nota');
            const soma = Array.from(inputs).reduce((acc, input) => acc + parseFloat(input.value || 0), 0);
            const media = inputs.length > 0 ? soma / inputs.length : 0;
            novaCelula.textContent = media.toFixed(1);
        }
        linha.appendChild(novaCelula);
    }
}
