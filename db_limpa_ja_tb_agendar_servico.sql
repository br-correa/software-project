CREATE DATABASE  IF NOT EXISTS `db_limpa_ja`;
USE `db_limpa_ja`;
DROP TABLE IF EXISTS `tb_agendar_servico`;
CREATE TABLE `tb_agendar_servico` (
  `servico_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_servico` varchar(50) NOT NULL,
  `data_servico` date NOT NULL,
  `horario_servico` time NOT NULL,
  `mensagem` text DEFAULT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `agendamento` varchar(50) NOT NULL,
  PRIMARY KEY (`servico_id`)
);