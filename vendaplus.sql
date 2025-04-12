-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.40 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para vendaplus
CREATE DATABASE IF NOT EXISTS `vendaplus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vendaplus`;

-- Copiando estrutura para tabela vendaplus.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id_venda` int NOT NULL AUTO_INCREMENT,
  `produtos` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `status_venda` enum('S','N') NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_venda`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela vendaplus.vendas: ~6 rows (aproximadamente)
INSERT INTO `vendas` (`id_venda`, `produtos`, `valor`, `cliente`, `status_venda`, `data_venda`) VALUES
	(1, 'shampoo e condicionador', 30.00, 'alysson', 'S', '2025-02-10 12:25:00'),
	(7, 'tenis', 120.00, 'carlos', 'S', '2025-02-14 17:34:16'),
	(8, 'condicionador', 70.00, 'lay', 'N', '2025-02-15 08:52:05'),
	(9, 'teste', 100.00, 'teste', 'N', '2025-02-15 09:06:17'),
	(10, 'novo produto', 200.00, 'sahfasj', 'N', '2025-02-15 09:15:20'),
	(11, 'fone', 999.99, 'batman', 'S', '2025-02-15 09:18:29');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
