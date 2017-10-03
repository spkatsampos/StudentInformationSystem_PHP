-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 17 Μάη 2012 στις 16:25:44
-- Έκδοση Διακομιστή: 5.5.20
-- Έκδοση PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `katsampos`
--

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `lessons`
--

CREATE TABLE IF NOT EXISTS `lessons` (
  `id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL,
  `ects` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `sem`, `ects`, `start_date`, `end_date`) VALUES
('l1', 'Αεροδυναμική', 2, 12, 2002, 0),
('l2', 'Ανάλυση', 3, 1, 2008, 0),
('l3', 'Ανάλυση Πιέσεων Ελαστικών', 1, 10, 1998, 0),
('l4', 'Μηχανική 1', 6, 12, 1997, 0),
('l5', 'Σχεδίαση Ποδηλάτων', 2, 10, 2004, 0),
('l6', 'Οργάνωση και Διοίκηση Ποδηλατάδικου  ', 10, 1, 1998, 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `pam` varchar(15) NOT NULL,
  `lid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `professor`
--

INSERT INTO `professor` (`pam`, `lid`) VALUES
('p1', 'l2'),
('p3', 'l3'),
('p2', 'l4'),
('p2', 'l1'),
('p1', 'l5'),
('p1', 'l6');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `lid` varchar(15) NOT NULL,
  `sid` varchar(15) NOT NULL,
  `year` int(15) NOT NULL,
  `grade` float NOT NULL,
  PRIMARY KEY (`lid`,`sid`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `student`
--

INSERT INTO `student` (`lid`, `sid`, `year`, `grade`) VALUES
('l1', 's1', 2012, 0),
('l1', 's3', 2012, 0),
('l1', 's5', 2007, 3),
('l1', 's5', 2010, 8),
('l2', 's1', 2011, 8.5),
('l2', 's2', 2012, 7),
('l2', 's4', 2012, 9.5),
('l2', 's5', 2008, 2),
('l2', 's5', 2012, 0),
('l3', 's1', 2012, 0),
('l3', 's2', 2012, 0),
('l4', 's2', 2012, 0),
('l5', 's1', 2012, 4.5),
('l5', 's3', 2012, 3.5),
('l6', 's1', 2008, 4),
('l6', 's1', 2012, 0),
('l6', 's3', 2012, 0.5),
('l6', 's4', 2012, 6.5);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address` varchar(50) CHARACTER SET utf8 NOT NULL,
  `am` varchar(15) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`am`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`fname`, `lname`, `address`, `am`, `email`, `username`, `password`, `role`, `year`) VALUES
('Δήμητρα', 'Ματσούκα', 'Κηφισού', 'g1', 'dimats@kyklades.gr', 'matsouka', 'aeb2f900267700258639ff07670e0a68', 'secreterian', 1995),
('Παρθενόπη', 'Τσαπανίδου', 'Βυζαντίου', 'g2', 'parthtsap@kyklades.gr', 'tsap', 'dfbfc01a9c444bcd61c9243a46d011d7', 'secreterian', 1999),
('Γεώργιος', 'Παπανδρέου', 'Ιπποκράτους 23', 'p1', 'gap@kyklades.gr', 'gap', 'df9bcbd6578a1e49c06b7ec2874f9e23', 'professor', 2009),
('Μαρία', 'Μενούνος', 'Μάνης 23', 'p2', 'menounos@kyklades.gr', 'menoun', '75511440c9cf00ec8e08e7a932f5fca3', 'professor', 1996),
('Γίαννης', 'Χαραλαμπόπουλος', 'Θεοπούλου 27', 'p3', 'charal@aegan.gr', 'giannis', 'bdf340ebda3d3d9906be4ec88c763a65', 'professor', 1998),
('Γεώργιος', 'Τσιριμπιτίδης', 'Κλεοβούλου', 's1', 'kyk1@bde.kyklades.gr', 'kyk1', 'e1bdd8888a94d448eddcb75e710f80a8', 'student', 2008),
('Αρίσταρχος', 'Κουτσομυταχιλλέας', 'Αθηναίων 14', 's2', 'kyk2@bde.kyklades.gr', 'kyk2', 'f5817d93b212cfd91a1a3f78d2b1b80a', 'student', 2007),
('Δημήτριος', 'Καραπαπαγεώργογλου', 'Ζαχάρω 56', 's3', 'kyk3.bde.kyklades.gr', 'kyk3', 'c6f045f32361834f5bb5d69c24b8681a', 'student', 2008),
('Αφροδίτη', 'Καραμπάμια ', 'Περιβολακίων 17', 's4', 'kyk4@bde.kyklades.gr', 'kyk4', 'fb878cec26416d03305b62c33c675613', 'student', 2009),
('Αρχάγγελος', 'Αρβανιτάκης', 'Αγγέλων 5', 's5', 'kyk5@kyklades.gr', 'kyk5', '5f0bd3091ee594eaef65c0f5db542533', 'student', 2006);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
