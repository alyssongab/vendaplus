CREATE DATABASE vplus;

USE vplus;

CREATE TABLE vendas(
	id_venda INT PRIMARY KEY AUTO_INCREMENT,
	produtos TEXT NOT NULL,
	valor DECIMAL(5,2) NOT NULL,
	cliente VARCHAR(100) NOT NULL,
	status_venda ENUM('S', 'N') NOT NULL,
	data_venda DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO vendas 
(produtos, valor, cliente, status_venda)
VALUES
("shampoo e condicionador", 30, "alysson", "S");

SELECT * FROM vendas;