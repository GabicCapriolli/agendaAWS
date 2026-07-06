CREATE DATABASE IF NOT EXISTS agenda;

USE agenda;

CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(120)
);

INSERT INTO contatos (nome, telefone, email)
VALUES
('João Silva','51999990001','joao@email.com'),
('Maria Souza','51999990002','maria@email.com');