-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 19, 2024 alle 00:00
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biciclette`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `ID` int(11) NOT NULL,
  `IDstazione` int(11) NOT NULL,
  `RFID` int(11) NOT NULL,
  `longi` float NOT NULL,
  `lat` float NOT NULL,
  `stato` varchar(32) NOT NULL,
  `metri` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `bicicletta`
--

INSERT INTO `bicicletta` (`ID`, `IDstazione`, `RFID`, `longi`, `lat`, `stato`, `metri`) VALUES
(1, 1, 123456, 9.19, 45.4642, 'disponibile', 0),
(2, 1, 123457, 9.1901, 45.4643, 'disponibile', 0),
(3, 2, 123458, 9.185, 45.4668, 'Manutenzione', 0),
(4, 2, 123459, 9.1851, 45.4669, 'disponibile', 0),
(5, 3, 123460, 9.2343, 45.4824, 'noleggiata', 0),
(6, 3, 123461, 9.2344, 45.4825, 'noleggiata', 1000),
(7, 4, 123462, 9.1905, 45.4654, 'disponibile', 0),
(8, 4, 123463, 9.1906, 45.4655, 'disponibile', 0),
(13, 1, 1034560890, 45.4634, 9.1897, 'disponibile', 200.5),
(14, 1, 2147483557, 45.4641, 9.1895, 'disponibile', 180.2),
(15, 1, 147485547, 45.4649, 9.1889, 'noleggiata', 150.8),
(16, 1, 147583647, 45.4637, 9.1878, 'noleggiata', 130.1),
(17, 2, 2140483607, 45.4643, 9.1876, 'disponibile', 220.3),
(18, 2, 2047480647, 45.4639, 9.1884, 'noleggiata', 195.7),
(19, 2, 2047483607, 45.4648, 9.1892, 'disponibile', 210.6),
(20, 2, 2140483640, 45.4642, 9.1899, 'disponibile', 190.4),
(21, 3, 147403647, 45.4646, 9.1903, 'noleggiata', 170.9),
(22, 3, 123456789, 45.4644, 9.1901, 'disponibile', 240.8),
(23, 3, 2140483640, 45.4638, 9.1896, 'disponibile', 260.5),
(24, 3, 147003647, 45.4635, 9.1905, 'noleggiata', 180.3),
(25, 4, 140483047, 45.4633, 9.1912, 'disponibile', 290.7),
(26, 4, 147083640, 45.464, 9.1919, 'noleggiata', 270.2),
(27, 4, 2107483047, 45.4647, 9.1926, 'disponibile', 310.9),
(28, 4, 2100483047, 45.4645, 9.1932, 'disponibile', 280.6),
(30, 1, 1234567890, 45.4634, 9.1897, 'disponibile', 200.5),
(31, 1, 2147483647, 45.4641, 9.1895, 'Disponibile', 180.2),
(32, 1, 2147483647, 45.4649, 9.1889, 'noleggiata', 150.8),
(33, 1, 2147483647, 45.4637, 9.1878, 'noleggiata', 130.1),
(34, 2, 2147483647, 45.4643, 9.1876, 'disponibile', 220.3),
(35, 2, 2147483647, 45.4639, 9.1884, 'noleggiata', 195.7),
(36, 2, 2147483647, 45.4648, 9.1892, 'disponibile', 210.6),
(37, 2, 2147483647, 45.4642, 9.1899, 'disponibile', 190.4),
(38, 3, 2147483647, 45.4646, 9.1903, 'noleggiata', 170.9),
(39, 3, 123456789, 45.4644, 9.1901, 'disponibile', 240.8),
(40, 3, 2147483647, 45.4638, 9.1896, 'disponibile', 260.5),
(41, 3, 2147483647, 45.4635, 9.1905, 'noleggiata', 180.3),
(42, 2, 2147483647, 45.4633, 9.1912, 'disponibile', 290.7),
(43, 2, 2147483647, 45.464, 9.1919, 'noleggiata', 270.2),
(44, 2, 2147483647, 45.4647, 9.1926, 'disponibile', 310.9),
(45, 1, 2147483647, 45.4645, 9.1932, 'disponibile', 280.6),
(46, 1, 2147483647, 45.4639, 9.1925, 'noleggiata', 230.4),
(47, 1, 2109876543, 45.4634, 9.1918, 'disponibile', 330.7),
(48, 1, 1098765432, 45.4641, 9.1911, 'disponibile', 300.2),
(49, 1, 987654321, 45.4648, 9.1903, 'noleggiata', 260.9),
(50, 1, 2147483647, 45.4643, 9.1898, 'disponibile', 350.5),
(51, 1, 2147483647, 45.4637, 9.1904, 'noleggiata', 320.8),
(52, 1, 2147483647, 45.4645, 9.191, 'disponibile', 370.3),
(53, 1, 2147483647, 45.4639, 9.1916, 'disponibile', 340.6),
(54, 1, 2147483647, 45.4642, 9.1923, 'noleggiata', 290.2),
(55, 1, 2147483647, 45.4647, 9.1928, 'disponibile', 390.8),
(56, 1, 2147483647, 45.4641, 9.1935, 'Disponibile', 360.4),
(57, 1, 923456, 9.19, 45.4642, 'disponibile', 0),
(58, 1, 923457, 9.1901, 45.4643, 'disponibile', 0),
(59, 1, 923458, 9.185, 45.4668, 'Manutenzione', 0),
(60, 1, 923459, 9.1851, 45.4669, 'disponibile', 0),
(61, 1, 923460, 9.2343, 45.4824, 'disponibile', 0),
(62, 1, 923461, 9.2344, 45.4825, 'noleggiata', 1000),
(63, 1, 923462, 9.1905, 45.4654, 'disponibile', 0),
(64, 1, 923463, 9.1906, 45.4655, 'disponibile', 0),
(65, 1, 823756, 9.19, 45.4642, 'disponibile', 0),
(66, 1, 983457, 9.1901, 45.4643, 'disponibile', 0),
(67, 1, 928458, 9.185, 45.4668, 'Manutenzione', 0),
(68, 1, 923859, 9.1851, 45.4669, 'disponibile', 0),
(69, 1, 923480, 9.2343, 45.4824, 'disponibile', 0),
(70, 1, 927468, 9.2344, 45.4825, 'noleggiata', 1000),
(71, 1, 923962, 9.1905, 45.4654, 'disponibile', 0),
(72, 1, 123463, 9.1906, 45.4655, 'disponibile', 0),
(73, 1, 1523456, 9.19, 45.4642, 'disponibile', 0),
(74, 1, 153457, 9.1901, 45.4643, 'disponibile', 0),
(75, 1, 125358, 9.185, 45.4668, 'Manutenzione', 0),
(76, 1, 923459, 9.1851, 45.4669, 'disponibile', 0),
(77, 1, 923660, 9.2343, 45.4824, 'disponibile', 0),
(78, 1, 923661, 9.2344, 45.4825, 'noleggiata', 1000),
(79, 1, 926462, 9.1905, 45.4654, 'disponibile', 0),
(80, 1, 926463, 9.1906, 45.4655, 'disponibile', 0),
(81, 1, 926456, 9.19, 45.4642, 'disponibile', 0),
(82, 1, 923657, 9.1901, 45.4643, 'disponibile', 0),
(83, 1, 626458, 9.185, 45.4668, 'Manutenzione', 0),
(84, 1, 623659, 9.1851, 45.4669, 'disponibile', 0),
(85, 1, 623660, 9.2343, 45.4824, 'disponibile', 0),
(86, 1, 963461, 9.2344, 45.4825, 'noleggiata', 1000),
(87, 1, 926462, 9.1905, 45.4654, 'disponibile', 0),
(88, 1, 923663, 9.1906, 45.4655, 'disponibile', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `IDlocalita` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `numTelefono` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `carta` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `cartaComunale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `IDlocalita`, `nome`, `cognome`, `numTelefono`, `email`, `carta`, `password`, `cartaComunale`) VALUES
(1, 1, 'Mario', 'Rossi', 1234567890, 'mario.rossi@example.com', 2147483647, '7c6a180b36896a0a8c02787eeafb0e4c', 0),
(2, 2, 'Luca', 'Bianchi', 2147483647, 'luca.bianchi@example.com', 2147483647, '6cb75f652a9b52798eb6cf2201057c73', 1),
(3, 3, 'Giulia', 'Verdi', 2147483647, 'giulia.verdi@example.com', 2147483647, '819b0643d6b89dc9b579fdfc9094f28e', 2),
(4, 4, 'Anna', 'Neri', 2147483647, 'anna.neri@example.com', 2147483647, '34cc93ece0ba9e3f6f235d4af979b16c', 22),
(7, 6, 'b', 'b', 0, 'b@gma.c', 0, '$2y$10$FTZBawfcRsCytqQUCESHDez2X', 222),
(8, 7, 'a', 'a', 0, 'a', 0, '0cc175b9c0f1b6a831c399e269772661', 3),
(9, 8, 'c', 'c', 0, 'c', 0, '4a8a08f09d37b73795649038408b5f33', 33),
(10, 9, 'd', 'd', 0, 'd', 0, '8277e0910d750195b448797616e091ad', 333),
(11, 10, 'd', 'd', 0, 'd', 0, '8277e0910d750195b448797616e091ad', 4),
(12, 11, 'h', 'h', 0, 'h', 0, '2510c39011c5be704182423e3a695e91', 44),
(13, 12, 'h', 'h', 0, 'h', 0, 'd41d8cd98f00b204e9800998ecf8427e', 55),
(14, 13, 'l', 'l', 0, 'l', 0, '2db95e8e1a9267b7a1188556b2013b33', 5),
(15, 14, 'l', 'l', 0, 'l', 0, '2db95e8e1a9267b7a1188556b2013b33', 66),
(16, 15, 'p', 'p', 0, 'p', 0, '83878c91171338902e0fe0fb97a8c47a', 6),
(17, 16, 'u', 'u', 0, 'u', 0, '7b774effe4a349c6dd82ad4f4f21d34c', 7),
(18, 17, 'q', 'q', 0, 'q', 0, '7694f4a66316e53c8cdd9d9954bd611d', 77);

-- --------------------------------------------------------

--
-- Struttura della tabella `localita`
--

CREATE TABLE `localita` (
  `ID` int(11) NOT NULL,
  `via` varchar(32) NOT NULL,
  `citta` varchar(32) NOT NULL,
  `cap` varchar(32) NOT NULL,
  `provincia` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `localita`
--

INSERT INTO `localita` (`ID`, `via`, `citta`, `cap`, `provincia`) VALUES
(1, 'Via Roma', 'Milano', '20100', 'MI'),
(2, 'Corso Buenos Aires', 'Milano', '20131', 'MI'),
(3, 'Via della Moscova', 'Milano', '20121', 'MI'),
(4, 'Piazza Gae Aulenti', 'Milano', '20124', 'MI'),
(6, 'b', 'b', 'b', 'b'),
(7, 'a', 'a', '0', 'a'),
(8, 'c', 'c', '0', 'c'),
(9, 'd', 'd', '0', 'd'),
(10, 'd', 'd', '0', 'd'),
(11, 'h', 'h', '0', 'h'),
(12, 'h', 'h', '0', 'h'),
(13, 'l', 'l', '0', 'l'),
(14, 'l', 'l', '0', 'l'),
(15, 'p', 'p', '0', 'p'),
(16, 'u', 'u', '0', 'u'),
(17, 'qq', 'q', '0', 'q');

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `ID` int(11) NOT NULL,
  `IDbicicletta` int(11) NOT NULL,
  `IDcliente` int(11) NOT NULL,
  `dataInizio` datetime NOT NULL,
  `dataFine` datetime NOT NULL,
  `tipoOperazione` enum('noleggio','riconsegna','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `slotTotali` int(11) NOT NULL,
  `longi` float NOT NULL,
  `lat` float NOT NULL,
  `altro` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`ID`, `nome`, `slotTotali`, `longi`, `lat`, `altro`) VALUES
(1, 'Stazione Milano', 30, 9.19, 45.4642, 'Vicino alla stazione centrale'),
(2, 'Parco Milano', 20, 9.185, 45.4668, 'Parco pubblico'),
(3, 'Citta Studi Milano', 25, 9.2343, 45.4824, 'Zona universitaria'),
(4, 'Centro Milano', 40, 9.1905, 45.4654, 'Piazza del Duomo');

-- --------------------------------------------------------

--
-- Struttura della tabella `transizioni`
--

CREATE TABLE `transizioni` (
  `ID` int(11) NOT NULL,
  `IDcliente` int(11) NOT NULL,
  `TipoTransizione` varchar(32) NOT NULL,
  `importo` int(11) NOT NULL,
  `motivo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `transizioni`
--

INSERT INTO `transizioni` (`ID`, `IDcliente`, `TipoTransizione`, `importo`, `motivo`) VALUES
(1, 1, 'pagamento', 5, 'noleggio bicicletta'),
(2, 2, 'pagamento', 7, 'noleggio bicicletta');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `numTel` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  `IDlocalita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `nome`, `cognome`, `email`, `numTel`, `isAdmin`, `IDlocalita`) VALUES
(1, 'Admin', 'User', 'admin@example.com', 2147483647, 1, 1),
(2, 'Regular', 'User', 'user@example.com', 2147483647, 0, 2);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDstazione` (`IDstazione`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDlocalita` (`IDlocalita`);

--
-- Indici per le tabelle `localita`
--
ALTER TABLE `localita`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDbicicletta` (`IDbicicletta`,`IDcliente`),
  ADD KEY `IDcliente` (`IDcliente`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `transizioni`
--
ALTER TABLE `transizioni`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IDutente` (`IDcliente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IDlocalita` (`IDlocalita`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `localita`
--
ALTER TABLE `localita`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `transizioni`
--
ALTER TABLE `transizioni`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD CONSTRAINT `bicicletta_ibfk_1` FOREIGN KEY (`IDstazione`) REFERENCES `stazione` (`ID`);

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`IDlocalita`) REFERENCES `localita` (`ID`);

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`IDbicicletta`) REFERENCES `bicicletta` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`ID`);

--
-- Limiti per la tabella `transizioni`
--
ALTER TABLE `transizioni`
  ADD CONSTRAINT `transizioni_ibfk_1` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`ID`);

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`IDlocalita`) REFERENCES `localita` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
