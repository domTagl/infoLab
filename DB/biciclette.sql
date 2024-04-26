-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 26, 2024 alle 09:59
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

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
  `RFID` int(11) NOT NULL,
  `longi` float NOT NULL,
  `lat` float NOT NULL,
  `stato` varchar(32) NOT NULL,
  `metri` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `bicistazione`
--

CREATE TABLE `bicistazione` (
  `ID` int(11) NOT NULL,
  `IDstazione` int(11) NOT NULL,
  `IDbicicletta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cartacomune`
--

CREATE TABLE `cartacomune` (
  `ID` int(11) NOT NULL,
  `comuneConsegna` varchar(32) NOT NULL,
  `codice` varchar(32) NOT NULL,
  `IDcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
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
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `ID` int(11) NOT NULL,
  `IDbicicletta` int(11) NOT NULL,
  `IDcliente` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` datetime NOT NULL,
  `tipoOperazione` enum('noleggio','riconsegna','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `spazioBici` int(11) NOT NULL,
  `longi` float NOT NULL,
  `lat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `bicistazione`
--
ALTER TABLE `bicistazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDstazione` (`IDstazione`,`IDbicicletta`),
  ADD KEY `IDbicicletta` (`IDbicicletta`);

--
-- Indici per le tabelle `cartacomune`
--
ALTER TABLE `cartacomune`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDutente` (`IDcliente`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
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
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `bicistazione`
--
ALTER TABLE `bicistazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cartacomune`
--
ALTER TABLE `cartacomune`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bicistazione`
--
ALTER TABLE `bicistazione`
  ADD CONSTRAINT `bicistazione_ibfk_1` FOREIGN KEY (`IDbicicletta`) REFERENCES `bicicletta` (`ID`),
  ADD CONSTRAINT `bicistazione_ibfk_2` FOREIGN KEY (`IDstazione`) REFERENCES `stazione` (`ID`);

--
-- Limiti per la tabella `cartacomune`
--
ALTER TABLE `cartacomune`
  ADD CONSTRAINT `cartacomune_ibfk_1` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`ID`);

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`IDbicicletta`) REFERENCES `bicicletta` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
