-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 13 Lip 2018, 19:35
-- Wersja serwera: 5.5.60-0+deb8u1
-- Wersja PHP: 5.6.36-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `TS3AudioBot`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dashboard_auth`
--

CREATE TABLE IF NOT EXISTS `dashboard_auth` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dashboard_auth`
--

INSERT INTO `dashboard_auth` (`id`, `login`, `password`) VALUES
(0, 'admin', 'foobar');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dashboard_bots`
--

CREATE TABLE IF NOT EXISTS `dashboard_bots` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `server` text COLLATE utf8_polish_ci NOT NULL,
  `group` text COLLATE utf8_polish_ci NOT NULL,
  `channel` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `dashboard_auth`
--
ALTER TABLE `dashboard_auth`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_bots`
--
ALTER TABLE `dashboard_bots`
 ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
