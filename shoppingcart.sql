-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 28 Lut 2023, 15:44
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `sku` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(2) DEFAULT NULL,
  `width` int(2) DEFAULT NULL,
  `length` int(2) DEFAULT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `type`, `sku`, `name`, `price`, `size`, `weight`, `height`, `width`, `length`, `img`) VALUES
(1, 'dvd', 'JVC200123', 'Acme DISC', '1.00', 700, NULL, NULL, NULL, NULL, 'cd.jpg'),
(2, 'dvd', 'JVC200123', 'Acme DISC', '1.00', 700, NULL, NULL, NULL, NULL, 'cd.jpg'),
(3, 'dvd', 'JVC200123', 'Acme DISC', '1.00', 700, NULL, NULL, NULL, NULL, 'cd.jpg'),
(4, 'dvd', 'JVC200123', 'Acme DISC', '1.00', 700, NULL, NULL, NULL, NULL, 'cd.jpg'),
(5, 'book', 'GGWP0007', 'War and Peace', '20.00', NULL, 2, NULL, NULL, NULL, 'book.jpg'),
(6, 'book', 'GGWP0007', 'War and Peace', '20.00', NULL, 2, NULL, NULL, NULL, 'book.jpg'),
(7, 'book', 'GGWP0007', 'War and Peace', '20.00', NULL, 2, NULL, NULL, NULL, 'book.jpg'),
(8, 'book', 'GGWP0007', 'War and Peace', '20.00', NULL, 2, NULL, NULL, NULL, 'book.jpg'),
(9, 'furniture', 'TR120555', 'Chair', '40.00', NULL, NULL, 24, 45, 15, 'chair.jpg'),
(10, 'furniture', 'TR120555', 'Chair', '40.00', NULL, NULL, 24, 45, 15, 'chair.jpg'),
(11, 'furniture', 'TR120555', 'Chair', '40.00', NULL, NULL, 24, 45, 15, 'chair.jpg'),
(12, 'furniture', 'TR120555', 'Chair', '40.00', NULL, NULL, 24, 45, 15, 'chair.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
