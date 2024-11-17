-- Criação da tabela de perguntas
CREATE TABLE questions (
    id SERIAL PRIMARY KEY,
    question_text TEXT NOT NULL
);

-- Criação da tabela de respostas
CREATE TABLE responses (
    id SERIAL PRIMARY KEY,
    question_id INT REFERENCES questions(id),  -- Referência à tabela de perguntas
    device_id INT NOT NULL,  -- ID do dispositivo
    response_value INT CHECK (response_value BETWEEN 0 AND 10),  -- Valor da resposta (de 0 a 10)
    feedback TEXT,  -- Feedback adicional
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Data e hora da resposta
);

-- Criação da tabela de avaliações gerais (feedback)
CREATE TABLE avaliacoes (
    id SERIAL PRIMARY KEY,
    setor_id INT NOT NULL,
    device_id INT NOT NULL,
    feedback TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserção de perguntas
INSERT INTO questions (question_text) VALUES
('Qual a probabilidade de você recomendar nosso hospital?'),
('Como você avalia o atendimento da equipe médica?'),
('Como você avalia o atendimento da equipe de enfermagem?');



