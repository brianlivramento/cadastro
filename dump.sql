-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 09, 2015 at 06:55 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sist_cadastro`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(60) NOT NULL,
  `dtnascimento_usuario` date NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `facebook_usuario` varchar(45) NOT NULL,
  `rg_usuario` varchar(45) NOT NULL,
  `cpf_usuario` varchar(45) NOT NULL,
  `endereco_usuario` varchar(60) NOT NULL,
  `cep_usuario` varchar(45) NOT NULL,
  `fone_usuario` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `dtnascimento_usuario`, `email_usuario`, `facebook_usuario`, `rg_usuario`, `cpf_usuario`, `endereco_usuario`, `cep_usuario`, `fone_usuario`) VALUES
(37, 'Teste Sbobrenome Teste', '1997-01-01', 'teste@teste.com.br', 'facebook.com/teste', '11.111.111-1', '367.388.308-90', 'Rua Teste Testeiros, numero 90', '55555-555', '(11) 44444-4444'),
(38, 'Teste Sbobrenome Teste', '1997-01-01', 'teste@teste.com.br', 'facebook.com/teste', '11.111.111-1', '367.388.308-90', 'Rua Teste Testeiros, numero 90', '22222-222', '(22) 22222-2222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;