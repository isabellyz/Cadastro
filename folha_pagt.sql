-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 07-Out-2025 às 01:35
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `folha_pagt`
--
CREATE DATABASE IF NOT EXISTS `folha_pagt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `folha_pagt`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionarios`
--

CREATE TABLE IF NOT EXISTS `tb_funcionarios` (
  `N_Registro` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Funcionario` varchar(255) NOT NULL,
  `Data_Admissao` date NOT NULL,
  `Cargo` varchar(100) NOT NULL,
  `Qtde_Salarios` decimal(10,2) NOT NULL,
  `Salario_Bruto` decimal(10,2) NOT NULL,
  `INSS` decimal(10,2) NOT NULL,
  `Salario_Liquido` decimal(10,2) NOT NULL,
  PRIMARY KEY (`N_Registro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
