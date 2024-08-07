-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2024 at 02:34 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `subject`, `marks`) VALUES
(1, 'test', 'test', 40),
(4, 'sita', 'telugu', 80),
(5, 'khadar', 'maths', 100),
(6, 'nasrin', 'chemistry', 99),
(7, 'mahi', 'hindi', 70),
(8, 'rehana', 'english', 60),
(9, 'rehana', 'english', 60),
(10, 'rehana', 'english', 60),
(13, 'hila', 'test', 35),
(16, 'tina', 'biology', 78);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `password`) VALUES
(1, 'nasrin', '$2y$10$uRfYGpK3b0q.y/NunDCUkOl5YYojGyGaPUnrIla.fXeEf58DcAn7K'),
(2, 'test', '$2y$10$/62mtaumXMiiAt0pVSK1iOHxrG040fgIyGUTxE5cEAC6KexSVJsUm'),
(5, 'rehana', '$2y$10$HmCQLEtod3vp1lZ62/O4uevHoO6/tvPaE/9BHF4vJhCYnyI6w44BK'),
(6, 'nachu', '$2y$10$mVoWGxwyL/xarSnr1AWJbu5amIHI9cdzkhzaDvqrNjN4Fl3SUNaca'),
(7, 'test1', '$2y$10$NI56g95VoCLSyX2FKcW8IeL41XFqUJZmsqhy4fJEdbWB4pj67SakS'),
(8, '1234', '$2y$10$ahXOqQgICVs1QRpJAL32peY76NPq/4N6fbh0cY7t73fdqSGSLgIkW'),
(9, 'hii', '$2y$10$cybhpx79sn8Hs43lYL61kevhhL.ulwcZ8M0TMoNebJ0jlri4jI6qO'),
(10, 'hlll', '$2y$10$Ex2wfwPve4hYJXgWGriTWeW2XpfwoNuqqwrLI7/r.SJz75Y5RiDuG'),
(11, 'ggg', '$2y$10$P1vBHfHD7xXEAYmkAal1XuLLc11PsoT1P1inVSWWQl92W/3e3dLTa'),
(12, 'kkk', '$2y$10$KBzKLRETaXIiLrt8o/8oK.u1ZFEp8ngGF9W0zKnvNakhZHkaoqopG'),
(13, 'iii', '$2y$10$bwejebwplYZuiD1c4Z5w5O4J77RCMcsgcmXi/fEhEzkT/7tYyPRZe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
