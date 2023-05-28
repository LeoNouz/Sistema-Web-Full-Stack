CREATE DATABASE bd_empresarial;

CREATE TABLE tb_Cliente (
    cpf VARCHAR(11) NOT NULL,
    nome VARCHAR(255) NULL,
    sobrenome VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    celular VARCHAR(11) NULL,
    telefone VARCHAR(10) NULL,
    logradouro VARCHAR(255) NULL,
    bairro VARCHAR(255) NULL,
    cidade VARCHAR(255) NULL,
    estado VARCHAR(2) NULL,
    cep VARCHAR(8) NULL,
    PRIMARY KEY(cpf)
);

CREATE TABLE tb_Produto (
    id INTEGER NOT NULL AUTO_INCREMENT,
    produto VARCHAR(255) NULL,
    valor FLOAT NULL,
    descricao VARCHAR(255) NULL,
    quantidade INTEGER NULL,
    PRIMARY KEY(id)
);