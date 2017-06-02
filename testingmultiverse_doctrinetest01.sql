-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 02-06-2017 a les 11:25:22
-- Versió del servidor: 10.1.21-MariaDB
-- Versió de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `testingmultiverse_doctrinetest01`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `productos`
--

CREATE TABLE `productos` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `productos`
--

INSERT INTO `productos` (`id`, `name`, `description`, `price`) VALUES
(1, 'Hola', 'fdasfsa', 'fdasdf'),
(2, 'fasdf', 'fasdfas', 'fdasfsa'),
(3, 'Bq AQUARIS', 'Movil BQ con Android', '140'),
(57, 'PS32', 'FASDFA', '32');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alternative` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `surname`, `description`, `email`, `password`, `image`, `alternative`) VALUES
(3, 'Rasmus', 'Lerdorf PHP', 'Creador de PHP', 'rasmus@lerdorf.com', 'contraseña de prueba', '', ''),
(4, 'Bruce', 'Wayne', 'Soy Batman', 'bruce@wayne.com', 'batman', 'null', 'null'),
(6, 'Bruce 2', 'Wayne', 'Soy Batman', 'bruce2@wayne.com', 'batman', 'null', 'null'),
(7, 'Victor', 'Robles', 'fadsdfa', 'victor@victor2.com', 'fasdfasfasfd', 'null', 'null'),
(8, 'fdasdfasd', 'fdasdfa', 'fasdfas', 'fasfdas@fas.com', 'fasdfas', 'null', 'null'),
(9, 'fasdfa', 'fasdfas', 'fasdfas', 'fasdfasdf@dig.com', 'fadsfas', '', ''),
(13, 'fdafsdfas', 'fasdfasdf', 'fdasdfa', 'sfdasdfas@das.com', '$2y$06$Y3Vyc29femVuZF9mcmFtZO/g4Ej.3wibRVDC10S09yiHKGvucRWsm', 'null', 'null'),
(15, 'Víctor', 'Robles', 'Soy programador web desde hace varios años asfdads', 'victor@victor.com', '$2y$06$Y3Vyc29femVuZF9mcmFtZO7KafSa6NR9m3cB8SXN1aQCBu0Nnnx9a', '', ''),
(16, 'gfdsgfsdfgsf', 'gsdgfsfg', 'gfsdgfsfg', 'sfgsd@hoads.com', '$2y$06$Y3Vyc29femVuZF9mcmFtZOgiSTxClxPJpJgGj8VNqKbHcsvks9icW', 'null', 'null'),
(17, 'amadeus', 'fasdfas jostin', 'fdasfdas', 'amadeus@gmail.com', '$2y$06$Y3Vyc29femVuZF9mcmFtZOmoUwZxSS7o7O4DHzmE7LRYbEIg3Zlje', '', '');

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT per la taula `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
