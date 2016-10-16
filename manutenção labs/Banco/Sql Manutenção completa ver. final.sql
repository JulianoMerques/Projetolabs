-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.24-log
-- Versão do PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `projetolabs`
--
CREATE DATABASE `projetolabs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projetolabs`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorio`
--

CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `capacidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao`
--

CREATE TABLE IF NOT EXISTS `manutencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `TipoManutencao_id` int(11) NOT NULL,
  `Laboratorio_id` int(11) NOT NULL,
  `Maquinas_mac` varchar(45) NOT NULL,
  `data` date DEFAULT NULL,
  `problema` varchar(255) DEFAULT NULL,
  `solucao` varchar(255) DEFAULT NULL,
  `Usuario_id` int(11) NOT NULL,
  `Turno_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Manutencao_TipoManutencao1` (`TipoManutencao_id`),
  KEY `fk_Manutencao_Laboratorio1` (`Laboratorio_id`),
  KEY `fk_Manutencao_Usuario1` (`Usuario_id`),
  KEY `fk_Manutencao_Turno1` (`Turno_id`),
  KEY `fk_Manutencao_Maquinas1` (`Maquinas_mac`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquinas`
--

CREATE TABLE IF NOT EXISTS `maquinas` (
  `mac` varchar(45) NOT NULL,
  `Patrimonio` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `conf_maquina` varchar(45) DEFAULT NULL,
  `Laboratorio_id1` int(11) NOT NULL,
  PRIMARY KEY (`mac`),
  KEY `fk_Maquinas_Laboratorio1` (`Laboratorio_id1`)
);

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_id` int(11) NOT NULL,
  `Sobrenome` varchar(100) DEFAULT NULL,
  `TipoManutencao_id` int(11) NOT NULL,
  `Laboratorio_id` int(11) NOT NULL,
  `Maquinas` varchar(1000) DEFAULT NULL,
  `Problema` varchar(1000) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Situacao` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Pedido_TipoManutencao1` (`TipoManutencao_id`),
  KEY `fk_Pedido_Laboratorio1` (`Laboratorio_id`),
  KEY `fk_Pedido_Usuario1` (`Usuario_id`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipomanutencao`
--

CREATE TABLE IF NOT EXISTS `tipomanutencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipomanutencao`
--

INSERT INTO `tipomanutencao` (`id`, `tipo`) VALUES
(1, 'Preventiva'),
(2, 'Instalação de programas'),
(3, 'Correção de erros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Monitor'),
(3, 'Professor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turno`
--

CREATE TABLE IF NOT EXISTS `turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `turno` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `turno`
--

INSERT INTO `turno` (`id`, `turno`) VALUES
(1, 'Manhã'),
(2, 'Tarde'),
(3, 'Noite');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `Turno_id` int(11) NOT NULL,
  `TipoUsuario_id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_Usuario_TipoUsuario1` (`TipoUsuario_id`),
  KEY `fk_Usuario_Turno1` (`Turno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `sobrenome`, `Turno_id`, `TipoUsuario_id`, `email`, `telefone`, `login`, `senha`) VALUES
(1, 'administrador', 'admin', 1, 1, 'administrador@outlook.com', '(22)2222-2222', 'admin', '05aece431d4b37616286be32c321548e'),

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD CONSTRAINT `fk_Manutencao_Laboratorio1` FOREIGN KEY (`Laboratorio_id`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Manutencao_Maquinas1` FOREIGN KEY (`Maquinas_mac`) REFERENCES `maquinas` (`mac`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Manutencao_TipoManutencao1` FOREIGN KEY (`TipoManutencao_id`) REFERENCES `tipomanutencao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Manutencao_Turno1` FOREIGN KEY (`Turno_id`) REFERENCES `turno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Manutencao_Usuario1` FOREIGN KEY (`Usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD CONSTRAINT `fk_Maquinas_Laboratorio1` FOREIGN KEY (`Laboratorio_id1`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Laboratorio1` FOREIGN KEY (`Laboratorio_id`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_TipoManutencao1` FOREIGN KEY (`TipoManutencao_id`) REFERENCES `tipomanutencao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`Usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_TipoUsuario1` FOREIGN KEY (`TipoUsuario_id`) REFERENCES `tipousuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_Turno1` FOREIGN KEY (`Turno_id`) REFERENCES `turno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
