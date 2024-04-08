-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2024 at 01:14 PM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `answers` varchar(8191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(1) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer_1` varchar(63) NOT NULL,
  `answer_2` varchar(63) NOT NULL,
  `answer_3` varchar(63) DEFAULT NULL,
  `answer_4` varchar(63) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `subject_id`, `level_id`) VALUES
(1, 'Jak nazywa się liczba, która jest większa od 5, ale mniejsza od 7?', '6', '8', '3', '9', 1, 1),
(2, 'Rozwiąż działanie: 3 + 4 =', '7', '6', '5', '8', 1, 1),
(3, 'Ile wynosi 5 minus 2?', '3', '2', '4', '6', 1, 1),
(4, 'Jeśli masz 3 jabłka i dajesz 2 swojemu przyjacielowi, ile zostaje ci jabłek?', '1', '2', '0', '4', 1, 1),
(5, 'Jak nazywa się liczba, która jest większa od 10, ale mniejsza od 15?', '11, 12, 13 lub 14', '12, 13, 14 lub 16', '9, 11, 13 lub 14', '16, 17, 18 lub 19', 1, 1),
(6, 'Znajdź brakującą liczbę w ciągu: 5, 7, _ , 11, 13', '9', '6', '12', '3', 1, 1),
(7, 'Ile wynosi 2 razy 3?', '6', '5', '4', '7', 1, 1),
(8, 'Ile wynosi 8 podzielone przez 2?', '4', '6', '5', '2', 1, 1),
(9, 'Jeśli masz 5 cukierków i zjesz 3 z nich, ile cukierków zostanie?', '2', '3', '1', '4', 1, 1),
(10, 'Ile wynosi 3 razy 4?', '12', '14', '10', '8', 1, 1),
(11, 'Jakie jest pole kwadratu o boku długości 5 cm?', '25 cm²', '20 cm²', '24 cm²', '40 cm²', 1, 2),
(12, 'Oblicz obwód trójkąta równobocznego, jeśli jego bok ma długość 8 cm', '24 cm', '32 cm', '18 cm', '28 cm', 1, 2),
(13, 'Ile wynosi pierwiastek kwadratowy z liczby 144?', '12', '14', '11', '16', 1, 2),
(14, 'Oblicz pole trapezu, jeśli długość jednej podstawy wynosi 6 cm, drugiej 10 cm, a wysokość 8 cm', '64 cm²', '60 cm²', '68 cm²', '72 cm²', 1, 2),
(15, 'Jeśli jedna strona prostokąta ma długość 12 cm, a druga 8 cm, to ile wynosi jego pole?', '96 cm²', '88 cm²', '128 cm²', '86 cm²', 1, 2),
(16, 'Oblicz objętość prostopadłościanu o wymiarach 4 cm, 6 cm i 10 cm', '240 cm³', '300 cm³', '24 cm³', '640 cm³', 1, 2),
(17, 'Jakie jest pole powierzchni kuli o promieniu 5 cm?', '100π cm²', '20π cm²', '200π cm²', '150 cm²', 1, 2),
(18, 'Oblicz średnią arytmetyczną liczb 12, 18, 24, 30 i 36', '24', '28', '26', '22', 1, 2),
(19, 'Jeśli kąt wewnętrzny wielokąta wynosi 120 stopni, to ile ma kąt zewnętrzny?', '240 stopni', '180 stopni', '120 stopni', '160 stopni', 1, 2),
(20, 'Oblicz wartość wyrażenia: 3⋅(4+7)−5', '28', '42', '36', '32', 1, 2),
(21, 'Jaką liczbę otrzymasz, gdy dodasz 7 do 9?', '16', '15', '17', '14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Matematyka'),
(2, 'Historia'),
(3, 'Fizyka'),
(4, 'Angielski');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `login` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `admin`) VALUES
(1, 'admin', '998d915e18cdc601a58b9a8a322353ad4afce537', 1),
(2, 'user', '6a1e960b41f9323adb5f2aadb786118caa196933', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `id` (`level_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
