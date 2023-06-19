CREATE DATABASE bd_empresarial;

CREATE TABLE IF NOT EXISTS tb_Cliente (
    cpf VARCHAR(11) NOT NULL,
    nome VARCHAR(255) NULL,
    sobrenome VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    celular VARCHAR(11) NULL,
    logradouro VARCHAR(255) NULL,
    bairro VARCHAR(255) NULL,
    cidade VARCHAR(255) NULL,
    estado VARCHAR(2) NULL,
    cep VARCHAR(8) NULL,
    PRIMARY KEY(cpf)
);

CREATE TABLE IF NOT EXISTS tb_Produto (
    id INTEGER NOT NULL AUTO_INCREMENT,
    produto VARCHAR(255) NULL,
    valor FLOAT NULL,
    descricao VARCHAR(255) NULL,
    quantidade INTEGER NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS tb_Entrega (
	n_rastreio INTEGER NOT NULL AUTO_INCREMENT,
	tipo_entrega VARCHAR(45) NULL,
	data_entrega DATE NULL,
	frete FLOAT NULL,
	PRIMARY KEY(n_rastreio)
);

CREATE TABLE IF NOT EXISTS tb_Pagamento (
	id INTEGER NOT NULL AUTO_INCREMENT,
	n_parcelas INTEGER NULL,
	valor_parcela FLOAT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS tb_Pedido (
	id INTEGER NOT NULL AUTO_INCREMENT,
	entrega_n_rastreio INTEGER NULL,
	pagamento_id INTEGER NULL,
	cliente_cpf VARCHAR(11) NULL,
	tipo_pagamento VARCHAR(45) NULL,
	desconto FLOAT NULL,
	valor_total FLOAT NULL,
	data_pedido DATE NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(entrega_n_rastreio) REFERENCES tb_Entrega(n_rastreio),
	FOREIGN KEY(pagamento_id) REFERENCES tb_Pagamento(id),
	FOREIGN KEY(cliente_cpf) REFERENCES tb_Cliente(cpf)
);

CREATE TABLE IF NOT EXISTS tb_Itens_Pedido (
	produto_id INTEGER NULL,
	pedido_id INTEGER NULL,
	quantidade INTEGER NOT NULL,
	FOREIGN KEY(produto_id) REFERENCES tb_Produto(id),
	FOREIGN KEY(pedido_id) REFERENCES tb_Pedido(id)
);



/* Storage Procedures - Criação de tabelas */
DELIMITER $$
CREATE PROCEDURE CriarTabelaCliente()
BEGIN
	CREATE TABLE IF NOT EXISTS tb_Cliente (
    		cpf VARCHAR(11) NOT NULL,
    		nome VARCHAR(255) NULL,
    		sobrenome VARCHAR(255) NULL,
    		email VARCHAR(255) NULL,
    		celular VARCHAR(11) NULL,
    		logradouro VARCHAR(255) NULL,
    		bairro VARCHAR(255) NULL,
    		cidade VARCHAR(255) NULL,
    		estado VARCHAR(2) NULL,
    		cep VARCHAR(8) NULL,
    		PRIMARY KEY(cpf)
	);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CriarTabelaProduto()
BEGIN
	CREATE TABLE IF NOT EXISTS tb_Produto (
    		id INTEGER NOT NULL AUTO_INCREMENT,
    		produto VARCHAR(255) NULL,
    		valor FLOAT NULL,
    		descricao VARCHAR(255) NULL,
    		quantidade INTEGER NULL,
    		PRIMARY KEY(id)
	);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CriarTabelaEntrega()
BEGIN
	CREATE TABLE IF NOT EXISTS tb_Entrega (
		n_rastreio INTEGER NOT NULL AUTO_INCREMENT,
		tipo_entrega VARCHAR(45) NULL,
		data_entrega DATE NULL,
		frete FLOAT NULL,
		PRIMARY KEY(n_rastreio)
	);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CriarTabelaPagamento()
BEGIN
	CREATE TABLE IF NOT EXISTS tb_Pagamento (
		id INTEGER NOT NULL AUTO_INCREMENT,
		n_parcelas INTEGER NULL,
		valor_parcela FLOAT NULL,
		PRIMARY KEY(id)
	);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CriarTabelaPedido()
BEGIN
	CREATE TABLE IF NOT EXISTS tb_Pedido (
		id INTEGER NOT NULL AUTO_INCREMENT,
		entrega_n_rastreio INTEGER NULL,
		pagamento_id INTEGER NULL,
		cliente_cpf VARCHAR(11) NULL,
		tipo_pagamento VARCHAR(45) NULL,
		desconto FLOAT NULL,
		valor_total FLOAT NULL,
		data_pedido DATE NULL,
		PRIMARY KEY(id),
		FOREIGN KEY(entrega_n_rastreio) REFERENCES tb_Entrega(n_rastreio),
		FOREIGN KEY(pagamento_id) REFERENCES tb_Pagamento(id),
		FOREIGN KEY(cliente_cpf) REFERENCES tb_Cliente(cpf)
	);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CriarTabelaItensPedido()
BEGIN
	CREATE TABLE IF NOT EXISTS tb_Itens_Pedido (
		produto_id INTEGER,
		pedido_id INTEGER,
		quantidade INTEGER NOT NULL,
		FOREIGN KEY(produto_id) REFERENCES tb_Produto(id),
		FOREIGN KEY(pedido_id) REFERENCES tb_Pedido(id)
	);
END $$
DELIMITER ;



/* Storage Procedures - Selecionar quantidade */
DELIMITER $$
CREATE PROCEDURE SelecionarQtdClientes(OUT quantidade INT)
BEGIN
	SELECT COUNT(*) INTO quantidade FROM tb_Cliente;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE SelecionarQtdProdutos(OUT quantidade INT)
BEGIN
	SELECT COUNT(*) INTO quantidade FROM tb_Produto;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE SelecionarQtdEntregas(OUT quantidade INT)
BEGIN
	SELECT COUNT(*) INTO quantidade FROM tb_Entrega;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE SelecionarQtdPagamentos(OUT quantidade INT)
BEGIN
	SELECT COUNT(*) INTO quantidade FROM tb_Pagamento;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE SelecionarQtdPedidos(OUT quantidade INT)
BEGIN
	SELECT COUNT(*) INTO quantidade FROM tb_Pedido;
END $$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE SelecionarQtdRegistros(IN tabela VARCHAR(100), OUT quantidade INT)
BEGIN
	SET @sql = CONCAT('SELECT COUNT(*) INTO quantidade FROM ', tabela);
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END $$
DELIMITER ;