-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2026 às 02:07
-- Versão do servidor: 10.11.16-MariaDB
-- Versão do PHP: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cinetrack`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `biblioteca`
--

CREATE TABLE `biblioteca` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `filme_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_filme` (`usuario_id`,`filme_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `filme_id` (`filme_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `biblioteca_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `biblioteca_ibfk_2` FOREIGN KEY (`filme_id`) REFERENCES `filmes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
