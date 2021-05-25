-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Maj 2021, 19:23
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cw14`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `category_id`) VALUES
(1, 'Jedrix. Umrę jutro', 'Robert Felix Crack', '16.80', 1),
(2, 'Dr. Stone tom 10', 'Boichi, Riichiro Inagaki', '24.99', 1),
(3, 'Niewidzialna Republika tom 3', 'Gabriel Hardman, Corinna Bechko', '35.60', 1),
(4, 'Sen w mroku', 'Szymon Hudon', '34.99', 2),
(5, 'Zmarli Pamiętają', 'Dominik Podworski', '24.20', 2),
(6, 'Dzień prawdy', 'Anna M. Brengos', '23.00', 3),
(7, 'Informacja zwrotna', 'Jakub Żulczyk', '26.62', 3),
(8, 'Dzień Armagedonu. Bitwa Jutlandzka', 'Wojciech Włódarczak', '27.25', 4),
(9, 'Sekrety Bieszczadów', 'Waldemar Bałda', '27.93', 4),
(10, 'Kruchy dom duszy', 'Jurgen Thorwald', '31.00', 4),
(11, 'Był sobie pies', 'W. Bruce Cameron', '10.15', 5),
(12, 'Niewolnica mafiosa', 'I.M. Darkss', '27.99', 6),
(26, 'Testowa książka', 'Testowy autor', '59.99', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `label`) VALUES
(1, 'Science-fiction'),
(2, 'Horror'),
(3, 'Kryminał'),
(4, 'Historyczna'),
(5, 'Przygodowa'),
(6, 'Romantyczna'),
(10, 'Testowa kategoria');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
