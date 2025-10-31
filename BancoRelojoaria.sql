CREATE DATABASE db_relojoaria;
USE db_relojoaria;

-- TABELA CLIENTE
CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30),
    sobrenome VARCHAR(50),
    cpf VARCHAR(11),
    tipo VARCHAR(20),
    telefone VARCHAR(20)
);

-- TABELA RELOGIO
CREATE TABLE relogio (
    id_relogio INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    num_serie VARCHAR(50),
    id_cliente INT,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

-- TABELA ORDEM DE SERVIÇO
CREATE TABLE ordem_servico (
    id_ordem INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(150),
    data_entrada DATE,
    valor FLOAT,
    forma_pgt VARCHAR(30),
    garantia VARCHAR(30),
    id_relogio INT,
    FOREIGN KEY (id_relogio) REFERENCES relogio(id_relogio)
);
