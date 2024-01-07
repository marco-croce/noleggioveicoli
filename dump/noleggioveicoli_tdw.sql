-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 15, 2023 alle 12:32
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
-- Database: `noleggioveicoli_tdw`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tariffa_oraria` int(11) NOT NULL,
  `tariffa_giornaliera` int(11) NOT NULL,
  `tariffa_mensile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `tariffa_oraria`, `tariffa_giornaliera`, `tariffa_mensile`) VALUES
(1, 'SUV', 21, 61, 610),
(2, 'Station Wagon', 22, 54, 580),
(3, 'Compact', 16, 48, 540),
(4, 'Berlina', 12, 40, 520),
(5, 'Monovolume', 18, 42, 560),
(6, 'Cabriolet', 26, 60, 600),
(7, 'Coupé', 30, 70, 750);

-- --------------------------------------------------------

--
-- Struttura della tabella `contatto`
--

CREATE TABLE `contatto` (
  `id` int(10) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `icon2` varchar(50) NOT NULL,
  `collegamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `contatto`
--

INSERT INTO `contatto` (`id`, `tipo`, `contenuto`, `icon`, `icon2`, `collegamento`) VALUES
(1, 'Indirizzo', 'Via Roma, 150 - L\'Aquila (AQ) 67100', 'icon-map-o', 'map-marker', 'https://goo.gl/maps/H6bnDXEgH8hw41W8A'),
(2, 'Telefono', '+39 0862 001122', 'icon-mobile-phone', 'phone', 'tel:+390862001122'),
(3, 'Email', 'info@carbook.com', 'icon-envelope-o', 'envelope', 'mailto:info@carbook.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `feature`
--

CREATE TABLE `feature` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `feature`
--

INSERT INTO `feature` (`id`, `nome`) VALUES
(1, 'Aria Condizionata'),
(2, 'Seggiolino per bambini'),
(3, 'GPS'),
(4, 'Bagagliaio'),
(5, 'Musica'),
(6, 'Cintura di sicurezza'),
(8, 'Sistema di riconoscimento dei segnali stradali'),
(9, 'Bluetooth'),
(10, 'Computer di Bordo'),
(11, 'Audio Input'),
(12, 'Sistema di avviso di cambio di corsia'),
(13, 'Sistema di frenata automatica di emergenza'),
(14, 'Climate Control'),
(15, 'Chiusura Centralizzata'),
(16, 'Sistema di navigazione'),
(17, 'Telecamera di retromarcia'),
(18, 'Sensori di parcheggio'),
(19, 'Cruise control adattivo'),
(30, 'Audio di alta qualità');

-- --------------------------------------------------------

--
-- Struttura della tabella `feature_veicolo`
--

CREATE TABLE `feature_veicolo` (
  `id_veicolo` int(10) NOT NULL,
  `id_feature` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `feature_veicolo`
--

INSERT INTO `feature_veicolo` (`id_veicolo`, `id_feature`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 8),
(1, 10),
(1, 12),
(1, 13),
(1, 15),
(2, 1),
(2, 4),
(2, 9),
(2, 11),
(2, 14),
(3, 2),
(3, 6),
(3, 8),
(3, 12),
(3, 13),
(4, 1),
(4, 4),
(4, 9),
(4, 11),
(4, 18),
(5, 2),
(5, 4),
(5, 18),
(5, 19),
(6, 4),
(6, 8),
(6, 9),
(6, 16),
(6, 17),
(7, 2),
(7, 10),
(7, 11),
(7, 19),
(7, 30),
(8, 11),
(8, 12),
(8, 13),
(8, 14),
(9, 2),
(9, 11),
(9, 12),
(9, 13),
(9, 18),
(10, 1),
(10, 2),
(10, 3),
(10, 13),
(10, 14),
(10, 15),
(10, 30),
(11, 12),
(11, 19),
(11, 30),
(12, 4),
(12, 5),
(12, 6),
(12, 8),
(12, 9),
(13, 1),
(13, 4),
(13, 11),
(14, 3),
(14, 12),
(14, 13),
(14, 15),
(14, 16),
(14, 17),
(15, 2),
(15, 16),
(15, 17),
(15, 18),
(16, 2),
(16, 3),
(16, 10),
(16, 12),
(16, 13),
(16, 14),
(16, 16),
(17, 17),
(17, 18),
(17, 30),
(18, 2),
(18, 14),
(18, 15),
(18, 16),
(19, 3),
(19, 6),
(19, 10),
(20, 4),
(20, 12),
(20, 13),
(20, 15),
(21, 3),
(21, 6),
(21, 8),
(21, 11),
(21, 12),
(21, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `feedback`
--

CREATE TABLE `feedback` (
  `id_utente` int(10) NOT NULL,
  `id_veicolo` int(10) NOT NULL,
  `testo` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `stelle` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `feedback`
--

INSERT INTO `feedback` (`id_utente`, `id_veicolo`, `testo`, `data`, `stelle`, `active`) VALUES
(1, 1, 'Spettacolare!', '2023-06-01', 4, 1),
(1, 3, 'Pessima. Troppo lenta', '2023-07-12', 2, 1),
(2, 10, 'Praticamente ogni curva che fai rischi di morire! Che bello!', '2023-07-20', 5, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `oggetto` varchar(100) NOT NULL,
  `messaggio` varchar(500) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`id`, `email`, `nome`, `cognome`, `oggetto`, `messaggio`, `data`) VALUES
(21, 'alessiorossi@email.it', 'Alessio', 'Rossi', 'Oggetto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2023-07-15'),
(22, 'giovannibianchi@email.it', 'Giovanni', 'Bianchi', 'Oggetto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2023-07-13'),
(23, 'lucarossi@email.it', 'Luca', 'Rossi', 'Oggetto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2023-07-15'),
(24, 'simoneneri@email.it', 'Simone', 'Neri', 'Oggetto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2023-07-16');

-- --------------------------------------------------------

--
-- Struttura della tabella `noleggio`
--

CREATE TABLE `noleggio` (
  `id_utente` int(10) NOT NULL,
  `id_veicolo` int(10) NOT NULL,
  `data_ritiro` date NOT NULL,
  `data_riconsegna` date NOT NULL,
  `orario` time NOT NULL,
  `costo` double NOT NULL,
  `stato` enum('Da ritirare','In corso','Terminato') NOT NULL DEFAULT 'Da ritirare',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `noleggio`
--

INSERT INTO `noleggio` (`id_utente`, `id_veicolo`, `data_ritiro`, `data_riconsegna`, `orario`, `costo`, `stato`, `id`) VALUES
(1, 17, '2023-07-15', '2023-07-19', '12:05:00', 160, 'In corso', 1),
(10, 6, '2023-07-16', '2023-07-21', '15:00:00', 210, 'In corso', 2),
(8, 4, '2023-07-22', '2023-07-27', '16:10:00', 240, 'Da ritirare', 3),
(8, 9, '2023-07-15', '2023-07-15', '13:05:00', 72, 'Terminato', 4),
(1, 21, '2023-07-16', '2023-07-16', '15:05:00', 72, 'Terminato', 5),
(10, 9, '2023-08-06', '2023-08-09', '16:15:00', 120, 'Da ritirare', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `script` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`id`, `nome`, `script`) VALUES
(1, 'login', 'login.php'),
(2, 'admin', 'admin.php');

-- --------------------------------------------------------

--
-- Struttura della tabella `pagina`
--

CREATE TABLE `pagina` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pagina`
--

INSERT INTO `pagina` (`id`, `nome`) VALUES
(1, 'home'),
(2, 'about'),
(3, 'services'),
(4, 'pricing'),
(5, 'cars'),
(6, 'contact');

-- --------------------------------------------------------

--
-- Struttura della tabella `ruolo`
--

CREATE TABLE `ruolo` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descrizione` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ruolo`
--

INSERT INTO `ruolo` (`id`, `nome`, `descrizione`) VALUES
(1, 'utente', ''),
(2, 'amministratore', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `ruolo_operazione`
--

CREATE TABLE `ruolo_operazione` (
  `id_ruolo` int(10) NOT NULL,
  `id_operazione` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ruolo_operazione`
--

INSERT INTO `ruolo_operazione` (`id_ruolo`, `id_operazione`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `section`
--

CREATE TABLE `section` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `immagine` varchar(50) DEFAULT NULL,
  `paragrafo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `section`
--

INSERT INTO `section` (`id`, `nome`, `titolo`, `file`, `immagine`, `paragrafo`) VALUES
(1, 'Carousel', 'I veicoli consigliati', 'carousel', NULL, NULL),
(2, 'Statistiche', 'I numeri dell\'azienda', 'statistica', NULL, NULL),
(3, 'Richiesta', 'Il modo migliore per noleggiare un veicolo!', 'richiesta', NULL, NULL),
(4, 'Veicoli', 'Scegli un veicolo', 'veicoli', NULL, NULL),
(5, 'Benvenuto', 'Benvenuti su carbook!', 'welcome', 'about.jpg', 'Benvenuti nel nostro servizio di noleggio veicoli! Siamo qui per semplificarvi la vita offrendovi una vasta gamma di veicoli adatti a ogni tipo di viaggio e scopo.\r\n\r\nScegliete il nostro servizio di noleggio veicoli per beneficiare di tariffe competitive, veicoli affidabili e un servizio clienti eccellente. La vostra sicurezza è la nostra priorità, quindi tutti i nostri veicoli sono sottoposti a rigorosi controlli e offriamo assicurazioni complete.\r\n\r\nCosa state aspettando? Cliccate sul pulsante \"Noleggia\" qui sotto e iniziate la vostra prossima avventura con noi.'),
(6, 'Tariffe', 'Le tariffe associate ad ogni categoria', 'tariffe', NULL, NULL),
(7, 'Recensioni', 'I pareri dei nostri clienti', 'feedback', NULL, NULL),
(8, 'Contattaci', 'Hai bisogno di informazioni specifiche? Inviaci un messaggio adesso.', 'noleggio', 'bg_3.jpg', NULL),
(9, 'Servizi', 'I nostri servizi', 'service', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `section_pagina`
--

CREATE TABLE `section_pagina` (
  `id_section` int(10) NOT NULL,
  `id_pagina` int(10) NOT NULL,
  `ordine` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `section_pagina`
--

INSERT INTO `section_pagina` (`id_section`, `id_pagina`, `ordine`) VALUES
(1, 1, 2),
(2, 1, 7),
(2, 2, 2),
(3, 1, 1),
(4, 5, 1),
(5, 1, 3),
(5, 2, 1),
(6, 4, 1),
(7, 1, 6),
(7, 2, 3),
(8, 1, 5),
(8, 3, 2),
(9, 1, 4),
(9, 3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `servizio`
--

CREATE TABLE `servizio` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descrizione` varchar(500) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `icona` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `servizio`
--

INSERT INTO `servizio` (`id`, `nome`, `descrizione`, `active`, `icona`) VALUES
(1, 'Noleggi brevi', 'Ideale per le persone che hanno bisogno di un veicolo per brevi spostamenti, come una gita fuori porta o una visita in città.', 1, 'far fa-clock'),
(2, 'Assistenza Clienti', 'Mettiamo a disposizione un servizio di assistenza attivo 24 ore su 24, 7 giorni su 7.', 1, 'fa fa-headset'),
(3, 'Aeroporto', 'Ritiro e la consegna del veicolo direttamente presso l\'aeroporto', 1, 'fa fa-plane-departure'),
(4, 'Noleggio con conducente', 'Viene offerto un autista professionale che guiderà per voi.', 1, 'fas fa-user-tie'),
(6, 'Assistenza Stradale', 'Per ogni noleggio è inclusa l&#039;assistenza stradale gratuitamente h24.', 0, 'fa fa-truck');

-- --------------------------------------------------------

--
-- Struttura della tabella `social`
--

CREATE TABLE `social` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `social`
--

INSERT INTO `social` (`id`, `nome`, `link`) VALUES
(1, 'twitter', 'https://twitter.com'),
(2, 'facebook', 'https://fb.com'),
(3, 'instagram', 'https://instagram.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `statistica`
--

CREATE TABLE `statistica` (
  `id` int(10) NOT NULL,
  `numero` int(10) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `principale` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `statistica`
--

INSERT INTO `statistica` (`id`, `numero`, `titolo`, `active`, `principale`) VALUES
(1, 21, 'Auto', 1, 1),
(2, 3, 'Filiali', 1, 0),
(3, 42, 'Anni di esperienza', 1, 0),
(4, 500, 'Clienti soddisfatti', 1, 0),
(6, 18, 'Dipendenti', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(24) NOT NULL,
  `telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `email`, `password`, `telefono`) VALUES
(1, 'Marco', 'Croce', 'marcocroce@email.it', 'password', '3315040506'),
(2, 'Alex', 'Anghel', 'alexanghel@admin.it', 'password', '3345544101'),
(8, 'Mario', 'Rossi', 'mariorossi@email.it', 'password', '3332211444'),
(9, 'Marco', 'Croce', 'marcocroce@admin.it', 'password', '3315040506'),
(10, 'Alex', 'Anghel', 'alexanghel@email.it', 'password', '3345544101');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente_ruolo`
--

CREATE TABLE `utente_ruolo` (
  `id_utente` int(10) NOT NULL,
  `id_ruolo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente_ruolo`
--

INSERT INTO `utente_ruolo` (`id_utente`, `id_ruolo`) VALUES
(1, 1),
(2, 2),
(8, 1),
(9, 2),
(10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `veicolo`
--

CREATE TABLE `veicolo` (
  `id` int(10) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modello` varchar(50) NOT NULL,
  `n_posti` int(11) NOT NULL,
  `cambio` enum('Manuale','Automatico') NOT NULL,
  `alimentazione` enum('Benzina','Diesel','Elettrica','GPL','Ibrida') NOT NULL,
  `km_percorsi` int(10) NOT NULL,
  `targa` varchar(7) NOT NULL,
  `immagine` varchar(100) NOT NULL,
  `descrizione` varchar(1000) NOT NULL,
  `tariffa_oraria` double NOT NULL,
  `tariffa_giornaliera` double NOT NULL,
  `tariffa_mensile` double NOT NULL,
  `consigliato` tinyint(1) NOT NULL DEFAULT 0,
  `id_categoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `veicolo`
--

INSERT INTO `veicolo` (`id`, `marca`, `modello`, `n_posti`, `cambio`, `alimentazione`, `km_percorsi`, `targa`, `immagine`, `descrizione`, `tariffa_oraria`, `tariffa_giornaliera`, `tariffa_mensile`, `consigliato`, `id_categoria`) VALUES
(1, 'Renault', 'Captur', 5, 'Manuale', 'Benzina', 230000, 'ch556ht', 'captur.jpg', 'Il Renault Captur: uno stile audace e una versatilità eccezionale. Questo crossover compatto unisce un design moderno e distintivo a una praticità senza pari. Con il suo ampio spazio interno, il Renault Captur offre comfort e funzionalità ideali per ogni avventura. Sperimenta un\'esperienza di guida fluida e efficiente grazie alle sue caratteristiche innovative e all\'avanzata tecnologia. Affitta il Renault Captur per esplorare la città con stile o per affrontare le strade meno battute con sicurezza. Scopri l\'equilibrio perfetto tra stile, comfort e praticità con il Renault Captur.', 22, 40, 220, 1, 3),
(2, 'Mercedes', 'GLA', 5, 'Automatico', 'Diesel', 240000, 'cd546hu', 'gla.png', 'La Mercedes GLA: un crossover di lusso che unisce stile e prestazioni superiori. Con il suo design dinamico e moderno, la GLA cattura l\'attenzione ovunque vada. Grazie alla sua potenza e agilità, questa vettura offre un\'esperienza di guida emozionante e confortevole. L\'interno lussuoso e spazioso offre comfort e praticità per tutti i passeggeri. Con tecnologie all\'avanguardia e sistemi di sicurezza avanzati, la GLA ti offre tranquillità e fiducia su ogni strada. Affitta la Mercedes GLA per vivere un viaggio indimenticabile con stile e classe.', 28, 50, 250, 0, 2),
(3, 'Fiat', 'Punto', 5, 'Automatico', 'Diesel', 234222, 'aq234rf', 'punto.jpg', 'La Fiat Punto: un\'icona italiana di stile e affidabilità. Questa compatta versatile è perfetta per la vita urbana e per i lunghi viaggi. Con il suo design elegante e aerodinamico, la Punto si distingue sulla strada. Dotata di un motore potente ed efficiente, offre un\'esperienza di guida divertente e senza problemi. L\'interno accogliente e ben progettato offre comfort e spazio per te e i tuoi passeggeri. Affitta la Fiat Punto per vivere l\'autentica passione italiana per l\'automobile, combinata con la praticità di un veicolo di alta qualità.\r\n\r\n\r\n\r\n\r\n', 18, 28, 33, 0, 2),
(4, 'Fiat', '500', 4, 'Manuale', 'Benzina', 50000, 'qw348ij', '500.png', 'La Fiat 500: un&#039;icona di stile e divertimento su quattro ruote. Questa compatta di design vintage offre un mix irresistibile di eleganza e praticità. Con la sua dimensione compatta, la Fiat 500 è perfetta per la città, permettendoti di sfrecciare agilmente per le strade trafficate. Con il suo motore vivace ed efficiente, ti regalerà un&#039;esperienza di guida spensierata. L&#039;interno accogliente e ricco di personalità offre comfort e un&#039;atmosfera gioiosa. Affitta la Fiat 500 per un viaggio pieno di stile e divertimento, e lasciati conquistare dal suo fascino senza tempo.', 20, 50, 300, 1, 3),
(5, 'Renault', 'Clio', 5, 'Manuale', 'Benzina', 60000, 'ch676hy', 'clio.png', 'La Renault Clio: un&#039;auto compatta che unisce stile, affidabilità e versatilità. Con il suo design moderno e dinamico, la Clio cattura l&#039;attenzione ovunque vada. Dotata di un motore efficiente, offre un&#039;esperienza di guida agile e divertente. L&#039;interno spazioso e confortevole ti permette di viaggiare in totale comfort, sia che tu stia facendo brevi spostamenti in città o avventurandoti su strade più lunghe. Con tecnologie all&#039;avanguardia e caratteristiche di sicurezza avanzate, la Clio ti offre tranquillità e protezione durante ogni viaggio. Affitta la Renault Clio per goderti il mix perfetto di stile, praticità ed efficienza.', 25, 55, 320, 0, 5),
(6, 'Volkswagen', 'Golf', 5, 'Automatico', 'Diesel', 70000, 'cr994rc', 'golf.png', 'La Volkswagen Golf: una leggenda dell&#039;automobilismo che incarna l&#039;eleganza e l&#039;eccellenza tedesca. Con il suo design raffinato e atletico, la Golf si distingue per la sua presenza sulla strada. Grazie alla sua straordinaria dinamica di guida e alle prestazioni potenti, offre un&#039;esperienza di guida emozionante e responsiva. L&#039;interno spazioso e ben rifinito offre comfort e praticità per tutti i passeggeri. Dotata di tecnologie innovative e soluzioni intelligenti, la Golf ti offre connettività e sicurezza avanzate. Affitta la Volkswagen Golf per scoprire la perfezione dell&#039;ingegneria tedesca combinata con uno stile sofisticato.', 30, 60, 350, 1, 5),
(7, 'BMW', 'X1', 5, 'Automatico', 'Diesel', 80000, 'ch343fr', 'x1.png', 'La BMW X1: l&#039;eleganza e la versatilità in un unico pacchetto. Questo SUV compatto offre un design sportivo e dinamico che cattura l&#039;attenzione ovunque vada. Con la sua potenza e agilità, la X1 offre un&#039;esperienza di guida emozionante su strada e fuoristrada. L&#039;interno spazioso e lussuoso offre comfort e funzionalità per i passeggeri e i bagagli. Dotata di tecnologia all&#039;avanguardia e caratteristiche di sicurezza avanzate, la X1 ti offre tranquillità e sicurezza durante ogni viaggio. Affitta la BMW X1 per vivere un&#039;avventura senza compromessi, unendo stile, prestazioni e praticità in un unico veicolo.', 35, 70, 400, 0, 6),
(8, 'Mercedes', 'CLA', 4, 'Automatico', 'Benzina', 90000, 'ch442sm', 'cla.png', 'La Mercedes CLA: un coupé di lusso che combina eleganza e prestazioni straordinarie. Con il suo design audace e dinamico, la CLA attira gli sguardi ovunque vada. Con potenti motori e un&#039;agile maneggevolezza, offre un&#039;esperienza di guida avvincente e piacevole. L&#039;interno raffinato e tecnologicamente avanzato offre comfort e connettività di alto livello. Grazie alle sue caratteristiche di sicurezza all&#039;avanguardia, puoi goderti la strada con tranquillità. Affitta la Mercedes CLA per vivere una combinazione perfetta di lusso, prestazioni ed eleganza, e sperimentare il massimo piacere di guida.', 40, 80, 450, 1, 4),
(9, 'Audi', 'A4', 5, 'Automatico', 'Diesel', 100000, 'ed915xl', 'a4.png', 'Descrizione Audi A4', 45, 90, 500, 0, 4),
(10, 'BMW', 'Serie', 5, 'Automatico', 'Benzina', 110000, 'ch512er', 'm3.png', 'La BMW Serie 3: un&#039;esperienza di guida senza pari. Questa berlina di lusso combina eleganza e prestazioni eccezionali. Con il suo design affascinante e l&#039;innovativa tecnologia, la Serie 3 offre un comfort superiore e una maneggevolezza precisa. Lasciati conquistare dalla potenza del motore, dalla sicurezza avanzata e dall&#039;attenzione ai dettagli. Affitta la BMW Serie 3 per un viaggio indimenticabile, sia che tu stia percorrendo le strade cittadine o che tu stia affrontando una lunga strada panoramica. Vivi l&#039;emozione di guidare una delle auto più iconiche al mondo.', 50, 100, 550, 1, 4),
(11, 'Fiat', 'Panda', 4, 'Manuale', 'Benzina', 120000, 'qw222fg', 'panda.png', 'L&#039;Audi A4: un&#039;elegante berlina che incarna lo stile e la raffinatezza tedesca. Con il suo design sofisticato e aerodinamico, l&#039;A4 si distingue per la sua presenza sulla strada. Dotata di motori potenti e una maneggevolezza precisa, offre un&#039;esperienza di guida dinamica e coinvolgente. L&#039;interno lussuoso e tecnologicamente avanzato offre comfort e connettività all&#039;avanguardia. Grazie alle sue caratteristiche di sicurezza avanzate, puoi viaggiare con fiducia. Affitta l&#039;Audi A4 per vivere il lusso, la potenza e la raffinatezza combinati in un&#039;auto eccezionale. Scopri l&#039;emozione di guidare una vettura che soddisferà ogni tua aspettativa.', 18, 35, 200, 0, 5),
(12, 'Renault', 'Megane', 5, 'Manuale', 'Diesel', 130000, 'cd459uj', 'megane.png', 'La Renault Megane: un&#039;elegante berlina che combina stile, comfort e prestazioni. Con il suo design moderno e accattivante, la Megane si distingue sulla strada. Dotata di motori efficienti e una guida reattiva, offre un&#039;esperienza di guida dinamica e piacevole. L&#039;interno spazioso e ben rifinito offre comfort e praticità per i passeggeri. Grazie alle sue tecnologie innovative e alle caratteristiche di sicurezza avanzate, puoi viaggiare con tranquillità. Affitta la Renault Megane per goderti un&#039;auto che unisce eleganza, affidabilità e piacere di guida, offrendoti un&#039;esperienza di viaggio unica e confortevole.', 22, 40, 220, 1, 7),
(13, 'Volkswagen', 'Passat', 5, 'Automatico', 'Diesel', 140000, 'aa234ee', 'arteon.png', 'La Volkswagen Passat: un&#039;elegante berlina che unisce stile, comfort e affidabilità. Con il suo design raffinato e moderno, la Passat si distingue per la sua presenza sulla strada. Dotata di motori potenti ed efficienti, offre prestazioni eccellenti e una guida fluida. L&#039;interno spazioso e lussuoso offre comfort e praticità per tutti i passeggeri. Dotata di tecnologie all&#039;avanguardia e sistemi di sicurezza avanzati, la Passat ti offre tranquillità e protezione su ogni viaggio. Affitta la Volkswagen Passat per vivere il mix perfetto di eleganza, prestazioni e affidabilità, e goditi un&#039;esperienza di guida raffinata e senza compromessi.', 28, 50, 250, 0, 2),
(14, 'BMW', 'X3', 5, 'Automatico', 'Diesel', 150000, 'te454gt', 'x3.png', 'La BMW X3: un SUV di lusso che combina stile, potenza e versatilità. Con il suo design dinamico e imponente, la X3 cattura l&#039;attenzione ovunque vada. Dotata di motori potenti e una trazione intelligente, offre prestazioni eccezionali sia su strada che fuoristrada. L&#039;interno spazioso e lussuoso offre comfort e raffinatezza per i passeggeri e i bagagli. Grazie alle sue tecnologie all&#039;avanguardia e alle caratteristiche di sicurezza avanzate, la X3 ti offre una guida sicura e piacevole. Affitta la BMW X3 per esplorare il mondo con stile e potenza, e vivi un&#039;esperienza di guida premium in ogni dettaglio.', 35, 70, 400, 1, 1),
(15, 'Fiat', 'Tipo', 5, 'Manuale', 'Benzina', 160000, 'ac458jk', 'tipp.png', 'La Fiat Tipo: un&#039;economica e spaziosa berlina che offre comfort e affidabilità. Con il suo design semplice ma funzionale, la Tipo si adatta perfettamente alle tue esigenze quotidiane. L&#039;interno spazioso offre ampio spazio per i passeggeri e i bagagli, rendendola ideale per lunghi viaggi o per l&#039;uso familiare. Dotata di motori efficienti, garantisce una guida economica e senza problemi. Affitta la Fiat Tipo per un&#039;esperienza di guida pratica e conveniente, senza rinunciare al comfort e alla qualità italiana che caratterizzano i veicoli Fiat.', 20, 45, 280, 0, 4),
(16, 'Ford', 'Focus', 5, 'Manuale', 'Benzina', 170000, 'ag111er', 'focus.jpeg', 'La Ford Focus: una berlina versatile che combina stile, prestazioni ed efficienza. Con il suo design dinamico e contemporaneo, la Focus si distingue sulla strada. Dotata di motori potenti e una maneggevolezza precisa, offre un&#039;esperienza di guida coinvolgente e divertente. L&#039;interno spazioso e ben rifinito offre comfort e praticità per i passeggeri. Grazie alle sue tecnologie innovative e alle caratteristiche di sicurezza avanzate, la Focus ti offre tranquillità e sicurezza su ogni viaggio. Affitta la Ford Focus per goderti un&#039;auto che unisce performance, stile e praticità, offrendoti una guida entusiasmante e soddisfacente.', 25, 50, 300, 1, 4),
(17, 'Mercedes', 'C63s', 4, 'Automatico', 'Benzina', 180000, 'fj763lk', 'c63.png', 'La Mercedes-AMG C63 S: una berlina ad alte prestazioni che unisce l&#039;eleganza Mercedes al potere di AMG. Con il suo design aggressivo e sportivo, la C63 S cattura l&#039;attenzione ovunque vada. Dotata di un motore V8 biturbo potente, offre prestazioni straordinarie e un&#039;accelerazione fulminea. L&#039;interno lussuoso e tecnologicamente avanzato offre comfort e connettività di alto livello. Grazie alle sue caratteristiche di sicurezza all&#039;avanguardia e al telaio sportivo, la C63 S offre una guida dinamica e coinvolgente. Affitta la Mercedes-AMG C63 S per vivere un&#039;esperienza di guida esaltante, combinando lusso, potenza e prestazioni sportive in un unico veicolo.', 30, 60, 350, 0, 4),
(18, 'Audi', 'A3', 5, 'Automatico', 'Diesel', 190000, 'cd546tt', 'a3.png', 'L&#039;Audi A3: una berlina compatta che incarna l&#039;eleganza e l&#039;affidabilità tedesca. Con il suo design raffinato e moderno, l&#039;A3 si distingue per la sua presenza sulla strada. Dotata di motori efficienti e una guida aggraziata, offre un&#039;esperienza di guida dinamica e confortevole. L&#039;interno ben rifinito e tecnologicamente avanzato offre comfort e connettività di alto livello. Grazie alle sue caratteristiche di sicurezza all&#039;avanguardia, puoi viaggiare con tranquillità. Affitta l&#039;Audi A3 per sperimentare l&#039;unione perfetta tra stile, prestazioni e affidabilità, e goditi una guida di classe superiore in ogni momento.', 35, 70, 400, 1, 4),
(19, 'Volkswagen', 'Tiguan', 5, 'Automatico', 'Diesel', 200000, 'xd555gt', 'tiguan.png', 'Il Volkswagen Tiguan: un SUV versatile che unisce stile, comfort e praticità. Con il suo design moderno e robusto, il Tiguan si fa notare sulla strada. Dotato di motori efficienti e una trazione intelligente, offre prestazioni affidabili e una guida piacevole su diversi tipi di terreno. L&#039;interno spazioso e ben progettato offre comfort e flessibilità per i passeggeri e i bagagli. Grazie alle sue tecnologie avanzate e alle caratteristiche di sicurezza, il Tiguan ti offre tranquillità e protezione durante ogni viaggio. Affitta il Volkswagen Tiguan per un&#039;esperienza di guida versatile e avventurosa, combinando eleganza e funzionalità in un unico veicolo.', 40, 80, 450, 0, 1),
(20, 'BMW', 'Serie', 5, 'Automatico', 'Benzina', 210000, 'af441ih', 'm1.png', 'La BMW Serie 1: un&#039;elegante berlina compatta che combina agilità e stile distintivo. Con il suo design sportivo e dinamico, la Serie 1 si fa notare sulla strada. Dotata di motori potenti e una maneggevolezza precisa, offre un&#039;esperienza di guida emozionante e coinvolgente. L&#039;interno raffinato e tecnologicamente avanzato offre comfort e connettività all&#039;avanguardia. Grazie alle sue caratteristiche di sicurezza innovative, puoi viaggiare con tranquillità. Affitta la BMW Serie 1 per vivere il piacere di guidare un&#039;auto compatta di alta qualità, con prestazioni elevate e uno stile distintivo che ti farà distinguere ovunque tu vada.', 45, 90, 500, 1, 4),
(21, 'Opel', 'Corsa', 4, 'Manuale', 'Benzina', 220000, 'de540fg', 'corsa.png', 'L&#039;Opel Corsa: una compatta affidabile e versatile che offre comfort e praticità. Con il suo design moderno e compatto, la Corsa è perfetta per la vita urbana e per i viaggi su strada. Dotata di motori efficienti e una guida agile, offre un&#039;esperienza di guida piacevole e senza problemi. L&#039;interno accogliente e ben progettato offre comfort e praticità per i passeggeri. Grazie alle sue caratteristiche di sicurezza avanzate, puoi viaggiare con tranquillità. Affitta l&#039;Opel Corsa per goderti una vettura affidabile e funzionale, perfetta per le tue esigenze quotidiane e per esplorare nuovi percorsi con facilità.', 18, 35, 200, 0, 5);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `contatto`
--
ALTER TABLE `contatto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `feature_veicolo`
--
ALTER TABLE `feature_veicolo`
  ADD PRIMARY KEY (`id_veicolo`,`id_feature`);

--
-- Indici per le tabelle `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_utente`,`id_veicolo`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `noleggio`
--
ALTER TABLE `noleggio`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ruolo`
--
ALTER TABLE `ruolo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ruolo_operazione`
--
ALTER TABLE `ruolo_operazione`
  ADD PRIMARY KEY (`id_ruolo`,`id_operazione`);

--
-- Indici per le tabelle `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `section_pagina`
--
ALTER TABLE `section_pagina`
  ADD PRIMARY KEY (`id_section`,`id_pagina`);

--
-- Indici per le tabelle `servizio`
--
ALTER TABLE `servizio`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `statistica`
--
ALTER TABLE `statistica`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utente_ruolo`
--
ALTER TABLE `utente_ruolo`
  ADD PRIMARY KEY (`id_utente`,`id_ruolo`);

--
-- Indici per le tabelle `veicolo`
--
ALTER TABLE `veicolo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `contatto`
--
ALTER TABLE `contatto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `noleggio`
--
ALTER TABLE `noleggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `pagina`
--
ALTER TABLE `pagina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `ruolo`
--
ALTER TABLE `ruolo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `section`
--
ALTER TABLE `section`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `servizio`
--
ALTER TABLE `servizio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `social`
--
ALTER TABLE `social`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `statistica`
--
ALTER TABLE `statistica`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `veicolo`
--
ALTER TABLE `veicolo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
