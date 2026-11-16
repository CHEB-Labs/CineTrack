-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/11/2026 às 20:30
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
  `filme_id` int(11) DEFAULT NULL,
  `status` enum('quero_ver','assistido','favorito') DEFAULT 'quero_ver'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `diretor` varchar(100) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `destaque` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `diretor`, `ano`, `genero`, `capa`, `destaque`, `descricao`) VALUES
(1, 'The Batman', 'Matt Reeves', 2022, 'Acao', 'capa-the-batman.webp', 'destaque-the-batman.jpg', 'A trama acompanha Bruce Wayne em seu segundo ano como vigilante, investigando uma série de assassinatos cometidos pelo Charada contra a elite corrupta de Gotham City.'),
(2, 'Homem Aranha', 'Destin Daniel Cretton', 2026, 'Ação e Aventura.', 'capa-homem-aranha.png', 'destaque-homem-aranha.png', 'Quatro anos após o mundo esquecer sua identidade, Peter Parker vive isolado e atua como Homem-Aranha em tempo integral. Quando uma perigosa evolução física ameaça o seu controle sobre os próprios poderes, ele precisa enfrentar um novo e misterioso inimigo para proteger Nova York e as pessoas que ama.'),
(3, 'The Godfather Part II', 'Francis Ford Coppola', 1975, 'Crime e Drama.', 'capa-godfather-2.png', 'destaque-the-godfather-part2.jpg', 'Em duas linhas do tempo paralelas, o filme acompanha a ascensão do jovem imigrante Vito Corleone como um respeitado chefe da máfia em Nova York e, décadas depois, a luta implacável de seu filho Michael para expandir e proteger o império da família, custe o que custar.'),
(4, 'Scarface', 'Brian De Palma', 1984, 'Drama e Crime', 'capa-scarface.jpg', 'destaque-scarface.webp', 'No início dos anos 1980, Tony Montana chega a Miami como um refugiado cubano sem dinheiro, mas movido por uma ambição implacável e o desejo de conquistar o \"sonho americano\" a qualquer custo. Ao lado de seu melhor amigo, Manny Ribera, ele mergulha no violento submundo do crime e elimina seus rivais para assumir o controle de um poderoso império do tráfico de cocaína. No entanto, conforme o dinheiro, o luxo e o poder aumentam, a paranoia, o vício e a desconfiança consomem Tony, levando-o a trair aliados, afastar quem ama e caminhar para uma queda trágica e sangrenta.'),
(5, 'Interestelar', 'Christopher Nolan', 2014, 'Ficção Científica e Drama.', 'capa-interestellar.png', 'destaque-interestellar.jpg', 'Em um futuro onde a Terra agoniza entre tempestades de poeira e escassez, o ex-piloto Cooper precisa fazer a escolha mais difícil de sua vida: deixar seus filhos para trás e liderar uma missão desesperada através de um buraco de minhoca. Nessa jornada épica rumo ao desconhecido, uma equipe de astronautas desafia as leis da física e os limites do tempo para encontrar um novo lar para a humanidade — descobrindo que, na imensidão do universo, o amor é a única força capaz de atravessar dimensões.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `criado_em`) VALUES
(5, 'vcsvaopagar', 'vcsvaopagar@gmail.com', '$2y$10$gEHJxee/HlUDUm64IPALkemg/9R/hzmvHMZ6ubFDKNB.4BAAYHDz6', '2026-11-16 04:17:11');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `filme_id` (`filme_id`);

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
