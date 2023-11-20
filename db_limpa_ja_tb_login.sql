CREATE DATABASE  IF NOT EXISTS `db_limpa_ja`;
USE `db_limpa_ja`;
DROP TABLE IF EXISTS `tb_login`;
CREATE TABLE `tb_login` (
  `sessao_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_hora_login` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sessao_id`)
);