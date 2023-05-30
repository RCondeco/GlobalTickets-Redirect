-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2023 às 01:38
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gt-redirect`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `url`
--

CREATE TABLE `url` (
  `ID` int(11) NOT NULL,
  `Long_URL` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Short_URL` varchar(12) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `url`
--

INSERT INTO `url` (`ID`, `Long_URL`, `Short_URL`, `User_ID`) VALUES
(1, 'https://www.youtube.com', 'AHHHH', 3),
(2, 'sefsef', 'riiw', 3),
(3, 'www.pornhub.com', 'kpr', 3),
(4, 'test,cin', 'p1dl', 3),
(5, 'test,cin', 'buol', 3),
(6, 'test,cin', 'o2hk', 3),
(7, 'WRECK', 'stql', 3),
(8, 'WRECK2', 'hdn1', 3),
(9, 'aaaa', 'm4bd', 3),
(10, 'test1', 'm0q0', 3),
(11, 'test1awf', 'hdg8', 3),
(12, 'ef', '51ku', 3),
(13, 'MONEY', 'p9bm', 3),
(14, 'MONEY2', 'ho5v', 3),
(15, 'moeny 3', 'rus4', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `url_user`
--

CREATE TABLE `url_user` (
  `User_ID` int(11) NOT NULL,
  `URL_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`) VALUES
(3, 'admin', '$2y$10$yFp37FdI7TyHNu3ZHETsauf80zuYki1uM1jLnbUsp2yyi9W1DIzky', 'admin@admin.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Short_URL` (`Short_URL`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `url`
--
ALTER TABLE `url`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
