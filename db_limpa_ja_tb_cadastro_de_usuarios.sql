CREATE DATABASE  IF NOT EXISTS `db_limpa_ja`;
USE `db_limpa_ja`;
DROP TABLE IF EXISTS `tb_cadastro_de_usuarios`;
CREATE TABLE `tb_cadastro_de_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(255) NOT NULL,
  `lavar_roupa` tinyint(1) DEFAULT NULL,
  `passar_roupa` tinyint(1) DEFAULT NULL,
  `limpar_casa` tinyint(1) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `celular` varchar(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
);