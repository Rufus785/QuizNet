-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
<<<<<<< HEAD
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 08:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
=======
-- Host: localhost
-- Generation Time: Jun 15, 2024 at 12:26 PM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.3.6
>>>>>>> 0f0de3a (Fixes difficulty level display)

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
<<<<<<< HEAD
  `answer` int(1) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

=======
  `answer` varchar(255) DEFAULT NULL,
  `attempt_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `was_hinted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `attempt_id`, `question_id`, `was_hinted`) VALUES
(551, '6', 68, 1, 0),
(552, '16', 68, 21, 0),
(553, '12', 68, 10, 0),
(554, '11, 12, 13 lub 14', 68, 5, 0),
(555, '6', 68, 7, 0),
(556, '4', 68, 8, 0),
(557, '3', 68, 3, 0),
(558, '4', 68, 24, 0),
(559, '2', 68, 9, 0),
(560, '7', 68, 2, 0),
(601, 'Liczba określająca więcej niż jednej osoby, rzeczy lub zjawiska.', 73, 44, 0),
(602, 'Wczoraj poszliśmy do kina.', 73, 39, 0),
(603, 'Rzeczownik, czasownik, przymiotnik.', 73, 35, 0),
(604, 'Zdanie pojedyncze, zdanie złożone współrzędnie, zdanie złożone podrzędnie.', 73, 43, 0),
(605, 'Imiesłów oznacza czynność, która miała miejsce przed inną czynnością.', 73, 41, 0),
(606, 'Rozkazujący, przypuszczający, warunkowy.', 73, 40, 0),
(607, 'Część mowy, która określa czasownik, przymiotnik lub inny przysłówek, mówiąc, jak, gdzie lub kiedy coś się dzieje', 73, 38, 0),
(608, 'Część zdania informująca o czynności, stanie lub procesie, który wykonuje podmiot.', 73, 37, 0),
(609, 'Osoba lub rzecz, które wykonuje czynność wyrażoną orzeczeniem', 73, 36, 0),
(610, 'Ona lubi czytać książki.', 73, 42, 0),
(631, NULL, 76, 41, 1),
(632, NULL, 76, 40, 1),
(633, NULL, 76, 42, 1),
(634, NULL, 76, 39, 0),
(635, NULL, 76, 44, 0),
(636, NULL, 76, 43, 0),
(637, NULL, 76, 36, 0),
(638, NULL, 76, 38, 0),
(639, NULL, 76, 37, 0),
(640, NULL, 76, 35, 0);

>>>>>>> 0f0de3a (Fixes difficulty level display)
-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `level` int(1) NOT NULL,
<<<<<<< HEAD
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

=======
  `start_time` int(40) NOT NULL,
  `end_time` int(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `user_id`, `subject_id`, `level`, `start_time`, `end_time`) VALUES
(68, 1, 1, 0, 1718437460, 1718437499),
(73, 1, 2, 0, 1718444712, 1718444900),
(76, 1, 2, 0, 1718452441, NULL);

>>>>>>> 0f0de3a (Fixes difficulty level display)
-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
<<<<<<< HEAD
  `answer_1` varchar(63) NOT NULL,
  `answer_2` varchar(63) NOT NULL,
  `answer_3` varchar(63) DEFAULT NULL,
  `answer_4` varchar(63) DEFAULT NULL,
=======
  `answer_1` varchar(255) NOT NULL,
  `answer_2` varchar(255) NOT NULL,
  `answer_3` varchar(255) DEFAULT NULL,
  `answer_4` varchar(255) DEFAULT NULL,
>>>>>>> 0f0de3a (Fixes difficulty level display)
  `subject_id` int(11) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `subject_id`, `level`) VALUES
(1, 'Jak nazywa się liczba, która jest większa od 5, ale mniejsza od 7?', '6', '8', '3', '9', 1, 0),
(2, 'Rozwiąż działanie: 3 + 4 =', '7', '6', '5', '8', 1, 0),
(3, 'Ile wynosi 5 minus 2?', '3', '2', '4', '6', 1, 0),
(4, 'Jeśli masz 3 jabłka i dajesz 2 swojemu przyjacielowi, ile zostaje ci jabłek?', '1', '2', '0', '4', 1, 0),
(5, 'Jak nazywa się liczba, która jest większa od 10, ale mniejsza od 15?', '11, 12, 13 lub 14', '12, 13, 14 lub 16', '9, 11, 13 lub 14', '16, 17, 18 lub 19', 1, 0),
(6, 'Znajdź brakującą liczbę w ciągu: 5, 7, _ , 11, 13', '9', '6', '12', '3', 1, 0),
(7, 'Ile wynosi 2 razy 3?', '6', '5', '4', '7', 1, 0),
(8, 'Ile wynosi 8 podzielone przez 2?', '4', '6', '5', '2', 1, 0),
(9, 'Jeśli masz 5 cukierków i zjesz 3 z nich, ile cukierków zostanie?', '2', '3', '1', '4', 1, 0),
(10, 'Ile wynosi 3 razy 4?', '12', '14', '10', '8', 1, 0),
(11, 'Jakie jest pole kwadratu o boku długości 5 cm?', '25 cm²', '20 cm²', '24 cm²', '40 cm²', 1, 1),
(12, 'Oblicz obwód trójkąta równobocznego, jeśli jego bok ma długość 8 cm', '24 cm', '32 cm', '18 cm', '28 cm', 1, 1),
(13, 'Ile wynosi pierwiastek kwadratowy z liczby 144?', '12', '14', '11', '16', 1, 1),
(14, 'Oblicz pole trapezu, jeśli długość jednej podstawy wynosi 6 cm, drugiej 10 cm, a wysokość 8 cm', '64 cm²', '60 cm²', '68 cm²', '72 cm²', 1, 1),
(15, 'Jeśli jedna strona prostokąta ma długość 12 cm, a druga 8 cm, to ile wynosi jego pole?', '96 cm²', '88 cm²', '128 cm²', '86 cm²', 1, 1),
(16, 'Oblicz objętość prostopadłościanu o wymiarach 4 cm, 6 cm i 10 cm', '240 cm³', '300 cm³', '24 cm³', '640 cm³', 1, 1),
(17, 'Jakie jest pole powierzchni kuli o promieniu 5 cm?', '100π cm²', '20π cm²', '200π cm²', '150 cm²', 1, 1),
(18, 'Oblicz średnią arytmetyczną liczb 12, 18, 24, 30 i 36', '24', '28', '26', '22', 1, 1),
(19, 'Jeśli kąt wewnętrzny wielokąta wynosi 120 stopni, to ile ma kąt zewnętrzny?', '240 stopni', '180 stopni', '120 stopni', '160 stopni', 1, 1),
(20, 'Oblicz wartość wyrażenia: 3⋅(4+7)−5', '28', '42', '36', '32', 1, 1),
(21, 'Jaką liczbę otrzymasz, gdy dodasz 7 do 9?', '16', '15', '17', '14', 1, 0),
(24, '2 2', '4', '3', '2', '1', 1, 0),
(25, 'Oblicz całkę:\r\n∫01(3x2+2x+1) dx\r\n', '7/3', '7/4', '5/4', '8/3', 1, 2),
(26, 'Rozwiąż równanie różniczkowe:\r\ndx/dy=y*ln⁡(y)\r\n', 'y=e^C*e^x, gdzie C jest stałą', 'y=e^C*e, gdzie C jest stałą', 'y=C^e*C^x, gdzie C jest stałą', 'y=e^C^x, gdzie C jest stałą', 1, 2),
(27, 'Znajdź wartości własne macierzy:\r\n2 1\r\n1 2', 'λ=3,λ=1', 'λ=2,λ=1', 'λ=1,λ=1', 'λ=3,λ=3', 1, 2),
(28, 'Rozwiąż równanie:\r\nsin⁡(x)=1/2\r\n', 'x=π/6​+2kπ lub x=(5π/6)+2kπ, gdzie k jest całkowitą', 'x=π/4​+2kπ lub x=(3π/2)+kπ, gdzie k jest całkowitą', 'x=π/7-2kπ lub x=(6π/5)+4kπ, gdzie k jest całkowitą', 'x=π/5+2kπ lub x=(6π/5)-4kπ, gdzie k jest całkowitą', 1, 2),
(29, 'Znajdź granicę:\r\nlim ⁡x→∞ (3x^2+2x+1)/(x^2−x+1)\r\n', '3', '4', '2', '1', 1, 2),
(30, 'Oblicz pochodną funkcji:\r\nf(x)=e^x^2', 'f′(x)=2xe^x^2', 'f′(x)=3xe^x^2', 'f′(x)=e^x^2', 'f′(x)=√(e^x^2)', 1, 2),
(31, 'Rozwiąż układ równań:\r\n{3x+4y=7, 5x−2y=−1\r\n', 'x=1,y=1', 'x=3,y=0', 'x=1,y=2', 'x=2,y=1', 1, 2),
(32, 'Oblicz całkę:\r\n∫1/xln⁡(x) dx\r\n', 'ln∣ln(x)∣+C', 'ln∣ln(x-1)∣+C', 'ln∣ln(3x)∣+C', 'ln∣ln(x^2)∣+C', 1, 2),
(33, 'Znajdź ekstrema funkcji:\r\nf(x)=x^3−3x^2+4', 'Minimum lokalne w x=2, maksimum lokalne w x=0', 'Minimum lokalne w x=3, maksimum lokalne w x=1', 'Minimum lokalne w x=0, maksimum lokalne w x=2', 'Minimum lokalne w x=1, maksimum lokalne w x=1', 1, 2),
(34, 'Rozwiąż równanie:\r\nx^4−16=0', 'x=2,−2,2i,−2i', 'x=1,−3,2i,−2i', 'x=1,−1,i,−2i', 'x=2,−1,2i,−3i', 1, 2),
(35, 'Jakie są trzy podstawowe części mowy?', 'Rzeczownik, czasownik, przymiotnik.', 'Liczebnik, zaimek, przysłówek.', 'Podmiot, orzeczenie, dopełnienie.', 'Rzeczownik, przymiotnik, spójnik.', 2, 0),
(36, 'Co to jest podmiot w zdaniu?', 'Osoba lub rzecz, które wykonuje czynność wyrażoną orzeczeniem', 'Część zdania opisująca miejsce.', 'Część zdania opisująca czas.\r\n', 'Część zdania określająca przyczynę.', 2, 0),
(37, 'Co to jest orzeczenie w zdaniu?', 'Część zdania informująca o czynności, stanie lub procesie, który wykonuje podmiot.', 'Część zdania określająca miejsce, gdzie znajduje się podmiot.\r\n', 'Część zdania określająca czas, w którym podmiot wykonuje czynności.\r\n', 'Część zdania opisująca emocje podmiota.', 2, 0),
(38, 'Co to jest przysłówek?', 'Część mowy, która określa czasownik, przymiotnik lub inny przysłówek, mówiąc, jak, gdzie lub kiedy coś się dzieje', 'Część zdania opisująca rzeczownik mówiąc, co, gdzie lub kiedy coś się dzieje', 'Część zdania opisująca liczbę.\r\n', 'Część zdania opisująca czasownik.', 2, 0),
(39, 'Podaj przykład zdania w czasie przeszłym.', 'Wczoraj poszliśmy do kina.', 'Wczoraj pójdziemy na spacer.', 'Jutro poszliśmy na basen.', 'Dziś idziemy do kina.', 2, 0),
(40, 'Jakie są trzy tryby czasownika?', 'Oznajmujący, rozkazujący, przypuszczający.', 'Odpowiadający, pytający, rozkazujący.', 'Odpowiadający, rozkazujący, warunkowy.', 'Rozkazujący, przypuszczający, warunkowy.', 2, 0),
(41, 'Co to jest imiesłów przysłówkowy uprzedni?', 'Imiesłów oznacza czynność, która miała miejsce przed inną czynnością.', 'Imiesłów oznaczający przyczynę jakiejkolwiek czynności.', 'Imiesłów oznaczający miejsce czynności.', 'Imiesłów oznaczający czas czynności.', 2, 0),
(42, 'Podaj przykład zdania z użyciem zaimka osobowego.', 'Ona lubi czytać książki.', 'Lubię oglądać telewizję.', 'Bawimy się na podwórku.', 'Zawsze chodzę do szkoły.', 2, 0),
(43, 'Jakie są podstawowe rodzaje zdań?', 'Zdanie pojedyncze, zdanie złożone współrzędnie, zdanie złożone podrzędnie.', 'Zdanie podwójne, zdanie złożone, zdanie zdolne.', 'Zdanie pojedyncze, zdanie skomplikowane, zdanie jednorodne.', 'Zdanie złożone podrzędnie, zdanie złożone zdania, zdanie złożone rozszerzone.', 2, 0),
(44, 'Co to jest liczba mnoga?', 'Liczba określająca więcej niż jednej osoby, rzeczy lub zjawiska.', 'Liczba określająca jedno zdarzenie.', 'Liczba określająca dwa zdarzenia.', 'Liczba określająca dużo zdarzeń.', 2, 0);

>>>>>>> 0f0de3a (Fixes difficulty level display)
-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Matma'),
(2, 'Język polski');

>>>>>>> 0f0de3a (Fixes difficulty level display)
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `login` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
<<<<<<< HEAD
=======
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `admin`) VALUES
(1, 'admin', '998d915e18cdc601a58b9a8a322353ad4afce537', 1);

--
>>>>>>> 0f0de3a (Fixes difficulty level display)
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

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
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=641;
>>>>>>> 0f0de3a (Fixes difficulty level display)

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
>>>>>>> 0f0de3a (Fixes difficulty level display)

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
>>>>>>> 0f0de3a (Fixes difficulty level display)

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
>>>>>>> 0f0de3a (Fixes difficulty level display)

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>> 0f0de3a (Fixes difficulty level display)

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
<<<<<<< HEAD
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
=======
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION;
>>>>>>> 0f0de3a (Fixes difficulty level display)

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attempts_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
