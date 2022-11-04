-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 03:33 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindata`
--

CREATE TABLE `admindata` (
  `id` int(10) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passw` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admindata`
--

INSERT INTO `admindata` (`id`, `name`, `email`, `passw`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$93R/cSRvs3QxY6c4Ux3tzOCjWgFVXP6/.4foSjUI5zuj4J3bEm5iW'),
(2, 'diwash', 'diwash@gmail.com', '$2y$10$bcL0d66ndZxSYA4exryXO.rznaqJem6utfr0mCxO1oRmg9huu.nWq'),
(8, 'ram bahaadur khdka', 'ain@gmail.com', '$2y$10$wA6qXZ5nyytJoMe9gNTc0.VjGydueBOlgTLUIDruE4f0XYRtr7vCy'),
(10, 'Deepa Pokharel', 'add@gmail.com', '$2y$10$4yEPPFA17pT6t9R83./7JuHKjsYK4kpCyu/3SgWEfILfKKWawqQrG');

-- --------------------------------------------------------

--
-- Table structure for table `answerdata`
--

CREATE TABLE `answerdata` (
  `studentid` int(100) NOT NULL,
  `examid` bigint(100) NOT NULL,
  `questionid` int(100) NOT NULL,
  `qnumber` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark` int(100) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answerdata`
--

INSERT INTO `answerdata` (`studentid`, `examid`, `questionid`, `qnumber`, `correct`, `answer`, `mark`, `status`) VALUES
(1, 493832962, 19, 'Q.N.2', 'C', 'A', 2, 'wrong'),
(1, 493832962, 22, 'Q.N.5', 'B', 'B', 1, 'right'),
(1, 493832962, 23, 'Q.N.4', 'B', 'B', 1, 'right'),
(1, 493832962, 33, 'Q.N.3', 'A', 'B', 1, 'wrong'),
(1, 493832962, 34, 'Q.N.6', 'A', 'B', 1, 'wrong'),
(1, 493832962, 35, 'Q.N.1', 'A', 'Skip', 1, 'wrong'),
(1, 1607869212876, 40, 'Q.N.1', 'A', 'A', 2, 'right'),
(1, 1607869212876, 41, 'Q.N.2', 'B', 'A', 1, 'wrong'),
(1, 1607869212876, 43, 'Q.N.3', 'C', 'B', 1, 'wrong'),
(23, 493484428, 24, 'Q.N.1', 'C', 'A', 1, 'wrong'),
(23, 493832962, 19, 'Q.N.5', 'C', 'D', 2, 'wrong'),
(23, 493832962, 22, 'Q.N.3', 'B', 'B', 1, 'right'),
(23, 493832962, 23, 'Q.N.2', 'B', 'B', 1, 'right'),
(23, 493832962, 33, 'Q.N.6', 'A', 'B', 1, 'wrong'),
(23, 493832962, 34, 'Q.N.4', 'A', 'C', 1, 'wrong'),
(23, 493832962, 35, 'Q.N.1', 'A', 'A', 1, 'right'),
(23, 1607869212876, 40, 'Q.N.3', 'A', 'A', 2, 'right'),
(23, 1607869212876, 41, 'Q.N.2', 'B', 'A', 1, 'wrong'),
(23, 1607869212876, 43, 'Q.N.1', 'C', 'A', 1, 'wrong'),
(24, 493832962, 19, 'Q.N.1', 'C', 'C', 2, 'right'),
(24, 493832962, 22, 'Q.N.2', 'B', 'B', 1, 'right'),
(24, 493832962, 23, 'Q.N.3', 'B', 'B', 1, 'right'),
(24, 493832962, 33, 'Q.N.5', 'A', 'B', 1, 'wrong'),
(24, 493832962, 34, 'Q.N.6', 'A', 'B', 1, 'wrong'),
(24, 493832962, 35, 'Q.N.4', 'A', 'B', 1, 'wrong');

-- --------------------------------------------------------

--
-- Table structure for table `createexam`
--

CREATE TABLE `createexam` (
  `examid` bigint(100) NOT NULL,
  `teacherid` int(100) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `createexam`
--

INSERT INTO `createexam` (`examid`, `teacherid`, `createdon`) VALUES
(55483761, 1, '2020-12-07 21:23:00'),
(55557042, 1, '2020-12-07 21:24:17'),
(63520632, 1, '2020-10-07 23:36:58'),
(91848707, 1, '2020-12-09 11:15:45'),
(493484428, 1, '2020-12-10 15:31:44'),
(493832962, 1, '2020-12-10 15:31:09'),
(1607493875030, 1, '2020-12-09 11:49:34'),
(1607594694683, 1, '2020-12-10 15:53:17'),
(1607607865565, 1, '2020-12-10 19:29:16'),
(1607706538276, 1, '2020-12-11 22:53:58'),
(1607849068177, 1, '2020-12-13 14:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `enrollexam`
--

CREATE TABLE `enrollexam` (
  `examid` bigint(100) NOT NULL,
  `studentid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollexam`
--

INSERT INTO `enrollexam` (`examid`, `studentid`) VALUES
(493484428, 23),
(493832962, 1),
(493832962, 23),
(493832962, 24),
(1607869212876, 1),
(1607869212876, 23);

-- --------------------------------------------------------

--
-- Table structure for table `examdata`
--

CREATE TABLE `examdata` (
  `examid` bigint(100) NOT NULL,
  `examtitle` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `examtime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examdate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facedetection` int(2) DEFAULT NULL,
  `numberofquestions` int(100) NOT NULL,
  `totalmarks` int(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examdata`
--

INSERT INTO `examdata` (`examid`, `examtitle`, `examtime`, `examdate`, `facedetection`, `numberofquestions`, `totalmarks`, `status`) VALUES
(506070, 'my exam', '2:30 PM', 'jan 21 2016', 0, 5, 5, 0),
(506071, 'tyler', '2:30 PM', 'jan 21 2016', 0, 5, 5, 0),
(54192272, 'my exam', '22:01', '2020-12-09', 0, 23, 0, 0),
(54213451, 'my exam', '00:01', '2020-12-16', 1, 34, 0, 0),
(54628131, 'testing', '23:08', '2020-12-08', 0, 100, 0, 0),
(54798183, 'pewds', '23:11', '2020-12-22', 0, 300, 0, 0),
(54877164, 'my exam', '22:12', '2020-12-09', 0, 34, 0, 0),
(55071860, 'mrbeast', '22:15', '2020-12-01', 0, 56, 0, 0),
(55320066, 'nux', '23:20', '2020-12-02', 1, 69, 0, 0),
(55394213, 'nux', '23:21', '2020-12-24', 1, 34, 0, 0),
(55483761, 'my exam for fun', '23:22', '2020-12-01', 1, 23, 0, 0),
(55557042, 'dsfdsfdsfds', '21:26', '2020-12-27', 0, 34, 0, 0),
(55672402, 'my exam', '12:26', '2020-12-30', 1, 34, 0, 0),
(55743314, 'my exam', '21:29', '2020-12-29', 1, 45, 0, 0),
(62685351, 'get wreked', '23:24', '2020-12-16', 0, 76, 0, 0),
(63520632, 'jhgkjhjkhkhjk', '13:36', '2020-10-02', 0, 78, 0, 0),
(88446673, 'today ', '00:18', '2020-12-15', 1, 1, 0, 0),
(91848707, 'Database Management System', '14:00', '2020-12-11', 1, 30, 0, 0),
(493484428, 'Engineering Economics', '18:31', '2020-12-18', 1, 20, 0, 0),
(493832962, 'operating system two (MODIFIED)', '16:31', '2020-12-18', 1, 3, 0, 0),
(1607493875030, 'ooad exam', '01:49', '2020-12-17', 0, 23, 0, 0),
(1607494751393, 'my exam by dee[pa', '14:04', '2020-12-10', 1, 23, 0, 0),
(1607494782453, 'my exam 2', '13:04', '2020-12-16', 1, 3, 0, 0),
(1607594694683, 'final DBMS exam', '06:53', '2020-12-01', 1, 100, 0, 0),
(1607607865565, 'Sankhadevi ko exam', '22:29', '2020-12-25', 1, 100, 0, 0),
(1607706538276, 'Artificial Intelligence first term', '13:53', '2020-12-24', 1, 20, 0, 0),
(1607849068177, 'Electromagnetics', '04:29', '2020-12-23', 0, 2, 0, 0),
(1607869212876, 'Exam by second teacher', '23:05', '2020-12-16', 0, 23, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questiondata`
--

CREATE TABLE `questiondata` (
  `examid` bigint(100) NOT NULL,
  `questionid` int(100) NOT NULL,
  `questiontext` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `optionA` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionB` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionC` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionD` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correctoption` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `questionmark` int(30) NOT NULL,
  `questiontime` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questiondata`
--

INSERT INTO `questiondata` (`examid`, `questionid`, `questiontext`, `optionA`, `optionB`, `optionC`, `optionD`, `correctoption`, `questionmark`, `questiontime`) VALUES
(493832962, 19, 'what is kernel?', 'dfds', 'efd', 'dfdsfsd', 'fdsfsd', 'C', 2, 30),
(493832962, 22, 'What is memory?', 'dkfnldks', 'dkfndskmfkdmfkdmf', 'kdfndksf', 'dnfkdsfkdfmkd', 'B', 1, 30),
(493832962, 23, 'What is file system?', 'dskjfkldsjflkjds', 'dlkfjdskljflkdjf', 'd.fml;dskfl;dskf', 'dnfkjdlkfjdskf', 'B', 1, 30),
(493484428, 24, 'What is economics?', 'dfdsf', 'dgfgf', 'fgfg', 'fgfgfg', 'C', 1, 30),
(1607594694683, 26, 'Qufjdhsfjd', 'fkjfhgkjflkg', 'fgkjflkgj', 'dghfklgjlkf', 'gjlfkg;lkflg', 'A', 1, 30),
(1607594694683, 27, 'hdkjfskldfjgklsjf', 'djglfkglfkg', 'gkfjkljgf', 'fgjlkfjgkljfg', 'fljgklfjg', 'B', 1, 30),
(1607607865565, 29, 'Who is the prime minister?', 'kp oli', 'both', 'parchanda', 'noone', 'A', 1, 30),
(1607607865565, 31, 'ruhtfirejhgoirjgoi', 'fkrjgkljflkgf', 'gklrjelkgjr', 'rltjlorjglkr', 'gjlofkjglfdo', 'D', 1, 30),
(1607607865565, 32, 'rkjhgkerhgiljflgkjelkrg', 'rjgilrjlgkjre', 'jhfjkhgjfhkg', 'oi;oiao;k', 'dfhkjdshgfkljg', 'C', 1, 30),
(493832962, 33, 'What is My name?', 'fgkjdslk', 'fjdbjfkhdfsg', 'dfbdkjfjd', 'dkjfkdsgkfg', 'A', 1, 30),
(493832962, 34, 'Where do i live?', 'gdfdhkjf', 'dbfdkjhfjk', 'dfjhkjdhf', 'fjbdskjhfkd', 'A', 1, 30),
(493832962, 35, 'jhdfjkhdfd', 'ldkjfkldsjfkljdsf', 'djfhkjfdshkf', 'djshfkjhdfkdkf', 'fhdsjkhfkjdhfkd', 'A', 1, 30),
(1607706538276, 36, 'What is Artificial intelligence?', 'me', 'dvdsfsd', 'fdfdsfgfds', 'gfsdsdfsdf', 'A', 3, 45),
(1607706538276, 37, 'kfhsdkjfkghjkfhgjfhg', 'dfnd,nfm,dnsg', 'jgfkjgkjflkgjfklg', 'dfjndjnfjkgkj', 'gjjfkjghjkfghjkf', 'B', 4, 20),
(1607706538276, 38, 'jfhdsjkhjkhgkjfhg', 'gffnjgjkfg', 'fgnjkfghjkfg', 'gjfgkjg', 'gjkfhdkgj', 'C', 1, 30),
(1607849068177, 39, 'What is electromagnetics?', 'krktjire', 'lkjjfg', 'rkjgrjfl', 'dfndlfjk', 'B', 3, 45),
(1607869212876, 40, 'What is the capital of nepal?', 'ktm', 'chitwan', 'bkt', 'pokhara', 'A', 2, 30),
(1607869212876, 41, 'What is my name?', 'kgjlkfjg', 'dngnfbg', 'dfgkdsjl', 'fjdsnfksdmf', 'B', 1, 30),
(1607869212876, 43, 'jhlkjvkldsjfkds', 'kjdhfskdshfkj', 'kfbdsjkfhsdjk', 'djfkjdshfklsjd', 'dnf,dsnfndskl', 'C', 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `scheduleexam`
--

CREATE TABLE `scheduleexam` (
  `examid` bigint(100) NOT NULL,
  `studentid` int(10) NOT NULL,
  `attended` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scheduleexam`
--

INSERT INTO `scheduleexam` (`examid`, `studentid`, `attended`) VALUES
(493484428, 1, 'no'),
(493484428, 23, 'yes'),
(493484428, 24, 'no'),
(493832962, 1, 'yes'),
(493832962, 23, 'yes'),
(493832962, 24, 'yes'),
(1607607865565, 1, 'no'),
(1607869212876, 23, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `studentdata`
--

CREATE TABLE `studentdata` (
  `s_id` int(10) NOT NULL,
  `s_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_passw` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentdata`
--

INSERT INTO `studentdata` (`s_id`, `s_name`, `s_email`, `s_passw`) VALUES
(1, 'diwash', 'admin@gmail.com', '$2y$10$n2GIwtK7rO/rhO1qWPDwoO1hH6I/CWIKIO5VHMfGSBa7YLbkXdVwe'),
(15, 'Deepa Pokharel', 'deepa@gmail.com', '$2y$10$Cr../jsBbP.NpBlELwGrcu.bjQwVMLBlUD6qnsTosNWzmtelhEPr.'),
(22, 'diwash2000', 'pokharel@hgjhgjh', '$2y$10$vQlRS9CYt6IKTVrvqOoeJegx0jWndVGzOjVcQJrgbmk3FWdfw5KAC'),
(23, 'test student', 'test@gmail.com', '$2y$10$Ekb4LXy6V8aeJ/RZhQxRVOxc9SQV0uXDzrltTNEj.v5my5qOKkYJq'),
(24, 'abin acharya', 'abin@gmail.com', '$2y$10$yA2MrQZhIwIr3t9zo8Tzk.P4.L6qn54hY4V2jCRHSfSrG1nWkGal.');

-- --------------------------------------------------------

--
-- Table structure for table `teacherdata`
--

CREATE TABLE `teacherdata` (
  `t_id` int(100) NOT NULL,
  `t_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_passw` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacherdata`
--

INSERT INTO `teacherdata` (`t_id`, `t_name`, `t_email`, `t_passw`) VALUES
(1, 'diwashteacher', 'admin@gmail.com', '$2y$10$n2GIwtK7rO/rhO1qWPDwoO1hH6I/CWIKIO5VHMfGSBa7YLbkXdVwe'),
(5, 'Deepa Pokharel', 'adin@gmail.com', '$2y$10$cUj81Kl6N/T1wcNjltXCOe8Vj8dS9ZVeheNURKgwA1FVgN/YrKGZ6'),
(10, 'ram bababadur khdka', 'babadur@jdfkjsdkl.com', '$2y$10$qrCkaijEyxdCAYjtGbyh3uBjIzrAB6H4LnAZzof3w/taLaK4eTWKW'),
(12, 'test teacher', 'test@gmail.com', '$2y$10$Nj7CnzJ9cSkhQmwkwS2Rpe1/FWdsXcf1d33ocr2EM5PSxEL5DBkLi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answerdata`
--
ALTER TABLE `answerdata`
  ADD UNIQUE KEY `studentid` (`studentid`,`examid`,`questionid`),
  ADD KEY `examid` (`examid`,`questionid`),
  ADD KEY `questionid` (`questionid`);

--
-- Indexes for table `createexam`
--
ALTER TABLE `createexam`
  ADD PRIMARY KEY (`examid`),
  ADD KEY `teacherid` (`teacherid`),
  ADD KEY `examid` (`examid`);

--
-- Indexes for table `enrollexam`
--
ALTER TABLE `enrollexam`
  ADD UNIQUE KEY `examid` (`examid`,`studentid`),
  ADD KEY `studentid` (`studentid`);

--
-- Indexes for table `examdata`
--
ALTER TABLE `examdata`
  ADD PRIMARY KEY (`examid`),
  ADD KEY `examid` (`examid`);

--
-- Indexes for table `questiondata`
--
ALTER TABLE `questiondata`
  ADD PRIMARY KEY (`questionid`),
  ADD UNIQUE KEY `questionid` (`questionid`),
  ADD KEY `examid` (`examid`);

--
-- Indexes for table `scheduleexam`
--
ALTER TABLE `scheduleexam`
  ADD UNIQUE KEY `examid` (`examid`,`studentid`),
  ADD KEY `studentid` (`studentid`);

--
-- Indexes for table `studentdata`
--
ALTER TABLE `studentdata`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `teacherdata`
--
ALTER TABLE `teacherdata`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `t_id` (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindata`
--
ALTER TABLE `admindata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `examdata`
--
ALTER TABLE `examdata`
  MODIFY `examid` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1607869212877;

--
-- AUTO_INCREMENT for table `questiondata`
--
ALTER TABLE `questiondata`
  MODIFY `questionid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `studentdata`
--
ALTER TABLE `studentdata`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `teacherdata`
--
ALTER TABLE `teacherdata`
  MODIFY `t_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answerdata`
--
ALTER TABLE `answerdata`
  ADD CONSTRAINT `answerdata_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `studentdata` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answerdata_ibfk_2` FOREIGN KEY (`examid`) REFERENCES `examdata` (`examid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answerdata_ibfk_3` FOREIGN KEY (`questionid`) REFERENCES `questiondata` (`questionid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `createexam`
--
ALTER TABLE `createexam`
  ADD CONSTRAINT `createexam_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacherdata` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `createexam_ibfk_2` FOREIGN KEY (`examid`) REFERENCES `examdata` (`examid`);

--
-- Constraints for table `enrollexam`
--
ALTER TABLE `enrollexam`
  ADD CONSTRAINT `enrollexam_ibfk_1` FOREIGN KEY (`examid`) REFERENCES `examdata` (`examid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `enrollexam_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `studentdata` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questiondata`
--
ALTER TABLE `questiondata`
  ADD CONSTRAINT `FOREIGN` FOREIGN KEY (`examid`) REFERENCES `examdata` (`examid`);

--
-- Constraints for table `scheduleexam`
--
ALTER TABLE `scheduleexam`
  ADD CONSTRAINT `scheduleexam_ibfk_1` FOREIGN KEY (`examid`) REFERENCES `examdata` (`examid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scheduleexam_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `studentdata` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
