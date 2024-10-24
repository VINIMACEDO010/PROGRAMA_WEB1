-- Criação da tabela de perguntas
CREATE TABLE questions (
    id SERIAL PRIMARY KEY,
    question_text TEXT NOT NULL
);

-- Inserção de perguntas de exemplo
INSERT INTO questions (question_text) VALUES
('Qual a probabilidade de você recomendar nosso hospital?'),
('Como você avalia o atendimento da equipe médica?'),
('Como você avalia o atendimento da equipe de enfermagem?');

-- Criação da tabela de avaliações
CREATE TABLE avaliacoes (
    id SERIAL PRIMARY KEY,
    pergunta_id INT REFERENCES questions(id),
    setor_id INT NOT NULL,
    dispositivo_id INT NOT NULL,
    resposta INT CHECK (resposta BETWEEN 0 AND 10),
    feedback TEXT,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


select * from avaliacoes