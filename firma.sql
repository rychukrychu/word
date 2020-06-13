-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Lut 2015, 17:41
-- Wersja serwera: 5.6.21
-- Wersja PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `firma`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dni_pracy`
--

CREATE TABLE IF NOT EXISTS `dni_pracy` (
`id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `dzien_tygodnia` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `godzina_od` time NOT NULL,
  `godzina_do` time NOT NULL,
  `data_pracy` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dni_pracy`
--

INSERT INTO `dni_pracy` (`id`, `id_pracownika`, `dzien_tygodnia`, `godzina_od`, `godzina_do`, `data_pracy`) VALUES
(59, 7, 'Poniedziałek', '09:00:00', '22:00:00', '2014-01-13'),
(60, 7, 'Wtorek', '10:00:00', '22:00:00', '2014-01-14'),
(61, 7, 'Środa', '09:00:00', '22:00:00', '2015-02-25'),
(62, 7, 'Piątek', '12:00:00', '23:00:00', '2014-01-17'),
(63, 8, 'Wtorek', '09:00:00', '18:30:00', '2014-01-14'),
(64, 8, 'Czwartek', '09:00:00', '17:00:00', '2014-01-16'),
(65, 8, 'Sobota', '09:00:00', '15:00:00', '0000-00-00'),
(70, 9, 'Wtorek', '09:00:00', '17:00:00', '0000-00-00'),
(71, 9, 'Środa', '09:00:00', '19:00:00', '0000-00-00'),
(72, 9, 'Czwartek', '09:00:00', '19:00:00', '0000-00-00'),
(73, 9, 'Piątek', '12:00:00', '19:00:00', '0000-00-00'),
(74, 9, 'Sobota', '09:00:00', '18:00:00', '0000-00-00'),
(75, 10, 'Sobota', '09:00:00', '18:00:00', '0000-00-00'),
(76, 10, 'Niedziela', '09:00:00', '18:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lodzie`
--

CREATE TABLE IF NOT EXISTS `lodzie` (
  `id` int(4) NOT NULL,
  `typ` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `model` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `aurl` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE IF NOT EXISTS `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownika`, `imie`, `nazwisko`) VALUES
(7, 'Arkany', 'Gdynia'),
(8, 'Port', 'Kołobrzeg'),
(9, 'Plaża', 'Pobierowo'),
(10, 'Zatoka', 'Szczecin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE IF NOT EXISTS `rezerwacje` (
`id_rezerwacji` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `marka` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `model` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rezerwacje`
--

INSERT INTO `rezerwacje` (`id_rezerwacji`, `id_pracownika`, `id_klienta`, `data`, `godzina`, `data_dodania`, `marka`, `model`, `opis`) VALUES
(43, 8, 9, '2015-02-26', '00:00:00', '2015-02-18 21:29:53', 'żaglowa', 'maxus 33', 'brak'),
(44, 8, 10, '2015-02-19', '00:00:00', '2015-02-18 21:29:53', 'żaglowa', 'maxus 33', 'brak'),
(45, 10, 9, '2015-02-28', '00:00:00', '2015-02-18 22:03:45', 'Motorowa', 'Chaparral 1900 SLC – 150 KM', 'brak'),
(46, 7, 9, '2015-02-24', '00:00:00', '2015-02-18 22:04:24', 'Motorowa', 'QUICKSILVER 470 – 60KM', 'brak'),
(47, 9, 10, '2015-02-27', '00:00:00', '2015-02-18 22:05:15', 'motorowa', 'QUICKSILVER 470 – 60KM', 'br'),
(48, 8, 10, '2015-03-26', '00:00:00', '2015-02-18 22:06:00', 'żaglowa', 'Cobra 33 Sport', 'br'),
(49, 8, 11, '2015-03-19', '00:00:00', '2015-02-18 22:06:45', 'żaglowa', 'Cobra 33', 'brak'),
(50, 9, 10, '2015-02-27', '00:00:00', '2015-02-19 11:30:14', 'Motorowa', 'QUICKSILVER 470 – 60KM', 'br'),
(51, 10, 10, '2015-04-25', '00:00:00', '2015-02-19 11:30:40', 'żaglowa', 'Cobra 33', 'br'),
(52, 8, 9, '2015-04-16', '00:00:00', '2015-02-19 11:31:09', 'żaglowa', 'maxus 33', 'brak'),
(54, 9, 9, '2015-04-16', '00:00:00', '2015-02-19 11:31:47', 'Motorowa', 'QUICKSILVER 470 – 60KM', 'br');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stan_uslug`
--

CREATE TABLE IF NOT EXISTS `stan_uslug` (
`id_zlec` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `stan` int(11) NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `data_przyjecia` date NOT NULL,
  `marka` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `model` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `stan_uslug`
--

INSERT INTO `stan_uslug` (`id_zlec`, `id_klienta`, `id_pracownika`, `stan`, `opis`, `data_przyjecia`, `marka`, `model`) VALUES
(4, 8, 7, 2, 'czyszczenie', '2015-02-18', '', ''),
(5, 11, 9, 3, 'serwis silnika', '2015-02-18', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `rola` enum('klient','admin') COLLATE utf8_polish_ci NOT NULL DEFAULT 'klient',
  `email` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `aktywny` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `rola`, `email`, `aktywny`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3﻿', 'Krystian', 'Matusz', 'admin', '', 1),
(8, 'adam@x.pl', '1d7c2923c1684726dc23d2901c4d8157', 'Adam', 'Małysz', 'klient', 'adam@x.pl', 0),
(9, 'krystian@o2.pl', 'c75b6bdde1d90eb183d6fad61bb8da56', 'Krystian', 'Matusz', 'klient', 'krystian@o2.pl', 1),
(10, 'marek@o2.pl', 'e061c9aea5026301e7b3ff09e9aca2cf', 'Marek', 'Malec', 'klient', 'marek@o2.pl', 1),
(11, 'ewa@o2.pl', '14c0f73364d8d9ce0748e89e954e9e26', 'Ewa', 'Drzyzga', 'klient', 'ewa@o2.pl', 1),
(12, 'qewr@o2.pl', '7815696ecbf1c96e6894b779456d330e', 'asd', 'asd', 'klient', 'qewr@o2.pl', 1),
(13, 'ale@op.pl', '47bce5c74f589f4867dbd57e9ca9f808', 'asd', 'asdf', 'klient', 'ale@op.pl', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `dni_pracy`
--
ALTER TABLE `dni_pracy`
 ADD PRIMARY KEY (`id`), ADD KEY `id_pracownika` (`id_pracownika`);

--
-- Indexes for table `pracownicy`
--
ALTER TABLE `pracownicy`
 ADD PRIMARY KEY (`id_pracownika`);

--
-- Indexes for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
 ADD PRIMARY KEY (`id_rezerwacji`), ADD KEY `id_pracownika` (`id_pracownika`), ADD KEY `id_klienta` (`id_klienta`);

--
-- Indexes for table `stan_uslug`
--
ALTER TABLE `stan_uslug`
 ADD PRIMARY KEY (`id_zlec`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dni_pracy`
--
ALTER TABLE `dni_pracy`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT dla tabeli `stan_uslug`
--
ALTER TABLE `stan_uslug`
MODIFY `id_zlec` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `dni_pracy`
--
ALTER TABLE `dni_pracy`
ADD CONSTRAINT `dni_pracy_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
