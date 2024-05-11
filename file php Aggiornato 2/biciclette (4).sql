-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 11, 2024 alle 18:59
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
(5, 1, 123456, 45.4832, 9.2044, 'Disponibile', 100),
(6, 1, 234567, 45.4833, 9.2045, 'In uso', 200),
(7, 2, 345678, 41.9001, 12.5001, 'Disponibile', 150),
(8, 2, 456789, 41.9002, 12.5002, 'Disponibile', 120),
(9, 1, 123456, 45.4832, 9.2044, 'Disponibile', 100),
(10, 1, 234567, 45.4833, 9.2045, 'In uso', 200),
(11, 2, 345678, 41.9001, 12.5001, 'Disponibile', 150),
(12, 2, 456789, 41.9002, 12.5002, 'Disponibile', 120);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `IDlocalita` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `domicilio` varchar(64) NOT NULL,
  `numTelefono` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `carta` int(11) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(4, 'Via Roma', 'Milano', '20121', 'MI'),
(5, 'Via Garibaldi', 'Roma', '00153', 'RM');

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
(1, 'Duomo', 50, 45.4641, 9.1919, 'Duomo di Milano'),
(2, 'Stazione Centrale di Milano', 100, 45.4874, 9.2043, 'Piazza Duca d Aosta 1 Milano');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `localita`
--
ALTER TABLE `localita`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
