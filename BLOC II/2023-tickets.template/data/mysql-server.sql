-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Temps de generació: 17-11-2021 a les 21:51:16
-- Versió del servidor: 10.4.21-MariaDB-1:10.4.21+maria~focal
-- Versió de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `ticket`
--
CREATE DATABASE IF NOT EXISTS `ticket` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `ticket`;

-- --------------------------------------------------------

--
-- Estructura de la taula `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcament de dades per a la taula `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(0, 'open'),
(1, 'pending'),
(2, 'closed');

-- --------------------------------------------------------

--
-- Estructura de la taula `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `screenshot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcament de dades per a la taula `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `message`, `email`, `created`, `status_id`, `screenshot`) VALUES
(1, 'Test Ticket', 'This is your first ticket.', 'support@delusions.io', '2020-06-10 13:06:17', 0, ''),
(2, 'No arranca docker', 'No arraca el docker, mostra un missatge estrany.', 'support@ms.io', '2020-06-10 13:06:17', 0, '');

-- --------------------------------------------------------

--
-- Estructura de la taula `ticket_comment`
--

CREATE TABLE `ticket_comment` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcament de dades per a la taula `ticket_comment`
--

INSERT INTO `ticket_comment` (`id`, `ticket_id`, `msg`, `created`) VALUES
(1, 1, 'This is a test comment.', '2020-06-10 16:23:39');

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Bolcament de dades per a la taula `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'user', '$2a$12$IbwzfXkNSwabFBmBJGwu1.2t0J1YoDoJejmTQQGCBfDenMV2P1gn2'),
(2, 'admin', '$2a$12$7EMqJ04CQWMoD5SXrtBlnuSg0Gx8JQ8grG.dSvDb97kZ0dqYKOSNq');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TICKET_STATUS` (`status_id`);

--
-- Índexs per a la taula `ticket_comment`
--
ALTER TABLE `ticket_comment`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la taula `ticket_comment`
--
ALTER TABLE `ticket_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la taula `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_TICKET_STATUS` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
