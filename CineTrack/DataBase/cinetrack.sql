-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2026 às 02:06
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `tipo` enum('filme','serie') NOT NULL DEFAULT 'filme',
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

INSERT INTO `filmes` (`id`, `titulo`, `trailer`, `tipo`, `diretor`, `ano`, `genero`, `capa`, `destaque`, `descricao`) VALUES
(1, 'The Batman', 'https://youtu.be/rsQEor4y2hg?si=GOk81LPpKGZ8TGNQ', 'filme', 'Matt Reeves', 2022, 'Ação', 'capa-the-batman.webp', 'destaque-the-batman.jpg', 'A trama acompanha Bruce Wayne em seu segundo ano como vigilante, investigando uma série de assassinatos cometidos pelo Charada contra a elite corrupta de Gotham City.'),
(2, 'Homem Aranha', 'https://youtu.be/PlulyWs1kS4?si=Iv8ofNeQuiFhpmQ-', 'filme', 'Destin Daniel Cretton', 2026, 'Ação e Aventura.', 'capa-homem-aranha.png', 'destaque-homem-aranha.png', 'Quatro anos após o mundo esquecer sua identidade, Peter Parker vive isolado e atua como Homem-Aranha em tempo integral. Quando uma perigosa evolução física ameaça o seu controle sobre os próprios poderes, ele precisa enfrentar um novo e misterioso inimigo para proteger Nova York e as pessoas que ama.'),
(3, 'The Godfather Part II', 'https://youtu.be/9O1Iy9od7-A?si=smiLxO3YFneRBsYS', 'filme', 'Francis Ford Coppola', 1975, 'Crime e Drama.', 'capa-godfather-2.png', 'destaque-the-godfather-part2.jpg', 'Em duas linhas do tempo paralelas, o filme acompanha a ascensão do jovem imigrante Vito Corleone como um respeitado chefe da máfia em Nova York e, décadas depois, a luta implacável de seu filho Michael para expandir e proteger o império da família, custe o que custar.'),
(4, 'Scarface', 'https://youtu.be/cv276Wg3e7I?si=Dx2uyReRvDUa6UjS', 'filme', 'Brian De Palma', 1984, 'Drama e Crime', 'capa-scarface.jpg', 'destaque-scarface.webp', 'No início dos anos 1980, Tony Montana chega a Miami como um refugiado cubano sem dinheiro, mas movido por uma ambição implacável e o desejo de conquistar o \"sonho americano\" a qualquer custo. Ao lado de seu melhor amigo, Manny Ribera, ele mergulha no violento submundo do crime e elimina seus rivais para assumir o controle de um poderoso império do tráfico de cocaína. No entanto, conforme o dinheiro, o luxo e o poder aumentam, a paranoia, o vício e a desconfiança consomem Tony, levando-o a trair aliados, afastar quem ama e caminhar para uma queda trágica e sangrenta.'),
(5, 'Interestelar', 'https://youtu.be/UpGFBQOrZmQ?si=59GWcYGnbiIScGuH', 'filme', 'Christopher Nolan', 2014, 'Ficção Científica e Aventura', 'capa-interestellar.png', 'destaque-interestellar.jpg', 'Em um futuro onde a Terra agoniza entre tempestades de poeira e escassez, o ex-piloto Cooper precisa fazer a escolha mais difícil de sua vida: deixar seus filhos para trás e liderar uma missão desesperada através de um buraco de minhoca. Nessa jornada épica rumo ao desconhecido, uma equipe de astronautas desafia as leis da física e os limites do tempo para encontrar um novo lar para a humanidade — descobrindo que, na imensidão do universo, o amor é a única força capaz de atravessar dimensões.'),
(6, 'Peaky Blinders', 'https://youtu.be/svmIUWMVo2Y?si=h8XQU4xdLHHqleqs', 'serie', 'Steven Knight', 2013, 'Drama e Crime', 'capa-peaky-blinders.jpg', 'destaque-peaky-blinders.jpeg', 'Ambientada na Birmingham de 1919, Peaky Blinders acompanha a ascensão criminosa da família Shelby, liderada pelo frio e ambicioso veterano de guerra Thomas Shelby. Famosos por esconderem lâminas de navalha nas abas de suas boinas, eles expandem seu império através de apostas ilegais, contrabando e extorsão. Ao longo de seis temporadas, a busca por poder coloca o clã em conflito com gangues rivais, a máfia e o próprio governo britânico, explorando os traumas do pós-guerra e o alto preço da ambição.'),
(7, 'Breaking Bad', 'https://youtu.be/HhesaQXLuRY?si=fXA8FZ0JQNZj0O_f', 'serie', 'Vince Gilligan, George Vincent Gilligan', 2008, 'Crime e Suspense', 'capa-breaking-bad.jpeg', 'destaque-breaking-bad.webp', 'Breaking Bad acompanha Walter White, um professor de química frustrado que descobre ter um câncer terminal. Para garantir o futuro financeiro da família antes de morrer, ele usa seus conhecimentos para fabricar metanfetamina ao lado de seu ex-aluno Jesse Pinkman. Ao longo de cinco temporadas, o homem comum se transforma no implacável chefão do crime \"Heisenberg\", colocando sua família e seu cunhado policial em grave perigo.'),
(8, 'The Sopranos', 'https://youtu.be/KMx4iFcozK0?si=UnFd21HktWy8rmbQ', 'serie', 'Michael Imperioli, David Chase, Matthew Weiner', 1999, 'Drama e Crime', 'capa-the-sopranos.jpeg', 'destaque-the-sopranos.jpg', 'The Sopranos (Família Soprano) é uma aclamada série da HBO sobre Tony Soprano, um chefe da máfia de Nova Jersey. Após sofrer fortes ataques de pânico, ele passa a fazer terapia em segredo com a Dra. Jennifer Melfi. Ao longo de seis temporadas, Tony tenta equilibrar a violência do crime organizado com os dilemas de sua família. Revolucionária ao consolidar o anti-herói na TV, a produção é considerada uma das maiores obras da história.'),
(9, 'Mad Men', 'https://youtu.be/m7NChV93LBw?si=bJdo6ffsuoXomDgd', 'serie', 'Matthew Weiner, Kater Gordon, Erin Levy, Robert Towne', 2007, 'Drama', 'capa-mad-men.jpeg', 'destaque-mad-men.jpeg', 'Mad Men é um drama ambientado na Nova York dos anos 1960 sobre o competitivo mercado publicitário da Madison Avenue. A trama acompanha o talentoso e enigmático diretor criativo Don Draper, que esconde segredos do passado enquanto equilibra sua carreira de sucesso e sua conturbada vida pessoal. Ao longo de sete temporadas, a série retrata com precisão as transformações culturais da década, abordando temas como machismo, ambição e a evolução do papel da mulher no trabalho.'),
(10, 'The Bear', 'https://youtu.be/gBmkI4jlaIo?si=FRbb6bOSpHht5peF', 'serie', 'Christopher Storer, Joanna Calo, Catherine Schetina', 2022, 'Comédia Dramática', 'capa-the-bear.jpeg', 'destaque-the-bear.jpeg', 'A série The Bear (O Urso) acompanha Carmy, um jovem e premiado chef de alta gastronomia que abandona Nova York para assumir a lanchonete falida de sua família em Chicago após a morte trágica de seu irmão. Enquanto tenta salvar o negócio das dívidas e modernizar o cardápio, ele precisa lidar com uma equipe resistente a mudanças, o caos diário da cozinha e seus próprios traumas e luto. Com a ajuda da talentosa chef Sydney, Carmy busca transformar o restaurante em um ambiente de excelência, em uma trama intensa sobre paixão culinária, saúde mental e superação sob pressão.');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
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
