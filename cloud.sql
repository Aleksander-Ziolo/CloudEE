-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 17 Paź 2017, 17:38
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cloud`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `files`
--

CREATE TABLE `files` (
  `id` bigint(20) NOT NULL,
  `pid` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `ext` varchar(50) NOT NULL,
  `owner` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `updated` varchar(100) NOT NULL,
  `size` bigint(20) NOT NULL,
  `path` varchar(100) NOT NULL,
  `checksum` varchar(512) NULL
) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `log`
--

CREATE TABLE `log` (
  `id` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` text NOT NULL,
  `owner` text NOT NULL
) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `permissions` int(11) NOT NULL,
  `registerdate` varchar(100) NOT NULL,
  `storage` bigint(20) NOT NULL,
  `usedspace` bigint(20) NOT NULL,
  `encryption_mode` INT NULL
) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

