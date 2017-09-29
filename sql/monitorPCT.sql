-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 29-09-2017 a les 13:33:08
-- Versió del servidor: 5.7.19-0ubuntu0.16.04.1
-- Versió de PHP: 7.0.24-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `monitorPCT`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `destinatari`
--

CREATE TABLE `destinatari` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `destinatari`
--

INSERT INTO `destinatari` (`id`, `nom`, `email`) VALUES
(1, 'adri', '666@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de la taula `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `tipus` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `rol`
--

INSERT INTO `rol` (`id`, `tipus`) VALUES
(1, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Estructura de la taula `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `site`
--

INSERT INTO `site` (`id`, `url`, `text`, `nota`) VALUES
(1, 'www.yonkies.com', 'test', 'test');

-- --------------------------------------------------------

--
-- Estructura de la taula `site_destinataris`
--

CREATE TABLE `site_destinataris` (
  `site_id` int(11) NOT NULL,
  `destinatari_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `site_destinataris`
--

INSERT INTO `site_destinataris` (`site_id`, `destinatari_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `user`
--

INSERT INTO `user` (`id`, `rol_id`, `username`, `password`) VALUES
(3, 1, 'admin', '$2y$10$SYtUUxCNDXXO/ecBUVXgxusaAPn/ozluIEIurKyd/FMSA72f7wRaO');

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `destinatari`
--
ALTER TABLE `destinatari`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `site_destinataris`
--
ALTER TABLE `site_destinataris`
  ADD PRIMARY KEY (`site_id`,`destinatari_id`),
  ADD KEY `IDX_78B2507BF6BD1646` (`site_id`),
  ADD KEY `IDX_78B2507B689888A7` (`destinatari_id`);

--
-- Index de la taula `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D6494BAB96C` (`rol_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `destinatari`
--
ALTER TABLE `destinatari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la taula `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la taula `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la taula `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `site_destinataris`
--
ALTER TABLE `site_destinataris`
  ADD CONSTRAINT `FK_78B2507B689888A7` FOREIGN KEY (`destinatari_id`) REFERENCES `destinatari` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_78B2507BF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Restriccions per la taula `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6494BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
