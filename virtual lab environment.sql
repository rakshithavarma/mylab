-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 05:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtual lab environment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `emailid`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin@gvpce.ac.in', 'admin', 'admin', '2022-11-29 17:34:50');

--
-- Triggers `admins`
--
DELIMITER $$
CREATE TRIGGER `delete_from_users_a` BEFORE DELETE ON `admins` FOR EACH ROW BEGIN
   DELETE FROM users
   WHERE  users.username = OLD.username;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_into_users_a` AFTER INSERT ON `admins` FOR EACH ROW begin
   insert into users (role, firstname, lastname, emailid, username, password) values (3, new.firstname, new.lastname, new.emailid, new.username, new.password);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `subdatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `teacher_id`, `class_id`, `question`, `subdatetime`) VALUES
(1, 2, 1, 'Lists', '2022-11-29 00:00:00'),
(2, 2, 1, 'Dictionaries in Python', '2022-11-30 17:45:00'),
(3, 2, 1, '', '2022-12-07 17:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `asgn_id` int(11) NOT NULL,
  `sst` datetime NOT NULL,
  `eet` datetime NOT NULL,
  `diff` time NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`id`, `stud_id`, `username`, `class_id`, `asgn_id`, `sst`, `eet`, `diff`, `file_name`, `uploaded_on`) VALUES
(1, 4, '20131A05K7', 1, 1, '2022-11-29 05:57:00', '2022-11-29 05:57:02', '00:00:02', 'Lists in Python.pdf', '2022-11-29 17:57:13'),
(2, 4, '20131A05K7', 1, 2, '2022-11-29 05:57:17', '2022-11-29 05:57:19', '00:00:02', 'Dictionaries in Python.pdf', '2022-11-29 17:57:25'),
(3, 4, '20131A05K7', 1, 3, '2022-11-29 05:57:29', '2022-11-29 05:57:30', '00:00:01', 'Programs on files.pdf', '2022-11-29 17:57:36'),
(4, 8, '20131A05R5', 1, 1, '2022-11-29 06:20:38', '2022-11-29 06:20:40', '00:00:02', 'Python functions.pdf', '2022-11-29 18:20:58'),
(5, 8, '20131A05R5', 1, 2, '2022-11-29 06:21:03', '2022-11-29 06:21:05', '00:00:02', 'Functions, Modules and Packages notes.pdf', '2022-11-29 18:21:12'),
(6, 8, '20131A05R5', 1, 3, '2022-11-29 06:21:17', '2022-11-29 06:21:20', '00:00:03', 'Programs on files1.pdf', '2022-11-29 18:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_hints`
--

CREATE TABLE `chatbot_hints` (
  `id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `reply` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chatbot_hints`
--

INSERT INTO `chatbot_hints` (`id`, `question`, `reply`) VALUES
(1, 'Help', 'Greetings to MyLab!! I am your E-Lab Assistant\r\nHow can I help you today?'),
(2, 'HI||Hello||Hola||Hui||Hu', 'Hello, how are you.'),
(3, 'How are you', 'Good to see you again!'),
(4, 'what is your name||whats your name', 'My name is E-lab bot'),
(5, 'what should I call you', 'You can call me E-Lab Bot'),
(6, 'Where are your from', 'I am from India'),
(7, 'Bye||See you later||Have a Good Day', 'Sad to see you are going. Have a nice day'),
(8, 'About Lab', 'This is a Virtual Lab Environment which is used to access academic lab courses virtually'),
(9, 'About Assignment?', 'Click on your classroom to view your assigments. Open code playground to submit that assignment.'),
(10, 'About CodePlayground??', 'In this Code Playground section, you can write your code in all given languages and edit the code an'),
(11, 'About Upcoming Tasks?', 'Click on your classroom and then click on your upcoming tasks to view that respective weeks assignme'),
(12, 'To Change Password?', 'Please contact your administrator to change your account password\r\nadmin@gvpce.ac.in'),
(13, 'Contact or Complaint?', 'please send an email to admin@gvpce.ac.in regarding your issue'),
(14, 'About Submissions?', 'Click on Classroom and then click on\r\nSubmissions section to view Submissions');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(255) NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `subject_id` int(255) NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `section_id` int(10) NOT NULL,
  `section` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `teacher_id`, `subject_id`, `subject_title`, `code`, `thumbnail`, `section_id`, `section`) VALUES
(1, 2, 1, 'Python', '20CS1101', 'images/img_avatar.png', 6, 'CSD'),
(2, 2, 2, 'C Programming', '20CS1102', 'images/img_avatarc.png', 1, 'CSE 1');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `added_on` datetime NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message`, `added_on`, `type`) VALUES
(40, 'Greetings!! I am your E-Lab Assistant\r\nHow can I help you today?', '2022-11-26 08:20:20', 'bot');

-- --------------------------------------------------------

--
-- Table structure for table `reference_materials`
--

CREATE TABLE `reference_materials` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `file_name` varchar(300) NOT NULL,
  `name_of_the_reference` varchar(300) NOT NULL,
  `file_link` varchar(500) NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference_materials`
--

INSERT INTO `reference_materials` (`id`, `class_id`, `file_name`, `name_of_the_reference`, `file_link`, `uploaded_on`) VALUES
(1, 1, 'bst-python.pdf', 'Binary Search Trees', 'https://www.geeksforgeeks.org/binary-search-tree-set-1-search-and-insertion/', '2022-11-29 18:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(255) NOT NULL,
  `class_title` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `class_title`) VALUES
(6, 'CSD'),
(1, 'CSE 1'),
(2, 'CSE 2'),
(3, 'CSE 3'),
(4, 'CSE 4'),
(5, 'CSM');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `section` varchar(7) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `emailid`, `section`, `username`, `password`, `created_at`) VALUES
(1, 'Rakshitha', 'Varma K', '20131a05k7@gvpce.ac.in', 'CSD', '20131A05K7', '$2y$10$utxkoBi/qbBG8RoPiUSLSOD2jZFSoC8w3uCfCAi0mWyJ.1PahQzVS', '2022-11-29 17:37:25'),
(2, 'R.V.K.', 'Durga', '20131a05k9@gvpce.ac.in', 'CSE 1', '20131A05K9', '$2y$10$aQXmfku6iEKYstPFdQYZ9O7JjiU.fui5lXtasuFDFcQH3ucqK8fYu', '2022-11-29 17:37:51'),
(3, 'Sandeep', 'Davarasingi', '20131a05m2@gvpce.ac.in', 'CSE 2', '20131A05M2', '$2y$10$4TjPTVpSzUv9Ly0jGh/apeqFlV2R06Cq6itwOo4S58zN5NRWyj92G', '2022-11-29 17:38:16'),
(4, 'Undavalli', 'Chandini', '20131a05p5@gvpce.ac.in', 'CSE 3', '20131A05P5', '$2y$10$WH2nbc2IJqzDCKdjJJkYp.x56lCPZIVJaie/0wgC6SdfDdv1xwVtW', '2022-11-29 17:38:40'),
(5, 'Y. L. S.', 'Sreeja', '20131a05r5@gvpce.ac.in', 'CSD', '20131A05R5', '$2y$10$R55rXp3Qp9whlQ9EyHvlve9XG1rN39yMcm4cqzLvft0BxSm/MUs5.', '2022-11-29 17:56:26');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `delete_from_users` BEFORE DELETE ON `students` FOR EACH ROW BEGIN
   DELETE FROM users
   WHERE  users.username = OLD.username;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_into_users` AFTER INSERT ON `students` FOR EACH ROW begin
   insert into users (role, firstname, lastname, emailid, username, password) values (2, new.firstname, new.lastname, new.emailid, new.username, new.password);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `code`, `thumbnail`) VALUES
(1, 'Python', '20CS1101', 'images/img_avatar.png'),
(2, 'C Programming', '20CS1102', 'images/img_avatarc.png'),
(3, 'C++', '20CS1103', 'images/img_avatarcpp.png'),
(4, 'Object Oriented Java Programming', '20CS1104', 'images/img_avatarjava.png'),
(5, 'Data Structures and Algorithms', '20CS1105', 'images/img_avatardsa.png'),
(6, 'Operating Systems', '20CS1106', 'images/img_avataros.png');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `firstname`, `lastname`, `emailid`, `username`, `password`, `created_at`) VALUES
(2, 'Nivas', 'Y', 'nivas_y@gvpce.ac.in', 'nivas_y', '$2y$10$0E/jTFpAWOBd8EyBZLbTYOOe..2r0OXtvPk7QBy4322RSthazrziK', '2022-11-29 17:36:53'),
(1, 'Rakshitha', 'Varma K', 'rvarma2812@gvpce.ac.in', 'rakshithavarma', '$2y$10$3AdDWdfkX9JLAplk9/3euezhydxQ8Opta8hjMiF1xooOQqEBZjJGO', '2022-11-29 17:36:13');

--
-- Triggers `teachers`
--
DELIMITER $$
CREATE TRIGGER `delete_from_users_t` BEFORE DELETE ON `teachers` FOR EACH ROW BEGIN
   DELETE FROM users
   WHERE  users.username = OLD.username;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_into_users_t` AFTER INSERT ON `teachers` FOR EACH ROW begin
   insert into users (role, firstname, lastname, emailid, username, password) values (1, new.firstname, new.lastname, new.emailid, new.username, new.password);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `subdatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `teacher_id`, `class_id`, `question`, `subdatetime`) VALUES
(1, 2, 1, 'Insertion in BST', '2022-12-02 17:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `test_submissions`
--

CREATE TABLE `test_submissions` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `sst` datetime NOT NULL,
  `eet` datetime NOT NULL,
  `diff` time NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_submissions`
--

INSERT INTO `test_submissions` (`id`, `stud_id`, `username`, `class_id`, `test_id`, `sst`, `eet`, `diff`, `file_name`, `uploaded_on`) VALUES
(1, 4, '20131A05K7', 1, 1, '2022-11-29 06:16:36', '2022-11-29 06:16:39', '00:00:03', 'bst-python.pdf', '2022-11-29 18:16:47'),
(2, 8, '20131A05R5', 1, 1, '2022-11-29 06:21:33', '2022-11-29 06:21:35', '00:00:02', 'bst-python.pdf', '2022-11-29 18:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `firstname`, `lastname`, `emailid`, `username`, `password`, `created_at`) VALUES
(4, 2, 'Rakshitha', 'Varma K', '20131a05k7@gvpce.ac.in', '20131A05K7', '$2y$10$utxkoBi/qbBG8RoPiUSLSOD2jZFSoC8w3uCfCAi0mWyJ.1PahQzVS', '2022-11-29 17:37:25'),
(5, 2, 'R.V.K.', 'Durga', '20131a05k9@gvpce.ac.in', '20131A05K9', '$2y$10$aQXmfku6iEKYstPFdQYZ9O7JjiU.fui5lXtasuFDFcQH3ucqK8fYu', '2022-11-29 17:37:51'),
(6, 2, 'Sandeep', 'Davarasingi', '20131a05m2@gvpce.ac.in', '20131A05M2', '$2y$10$4TjPTVpSzUv9Ly0jGh/apeqFlV2R06Cq6itwOo4S58zN5NRWyj92G', '2022-11-29 17:38:16'),
(7, 2, 'Undavalli', 'Chandini', '20131a05p5@gvpce.ac.in', '20131A05P5', '$2y$10$WH2nbc2IJqzDCKdjJJkYp.x56lCPZIVJaie/0wgC6SdfDdv1xwVtW', '2022-11-29 17:38:40'),
(8, 2, 'Y. L. S.', 'Sreeja', '20131a05r5@gvpce.ac.in', '20131A05R5', '$2y$10$R55rXp3Qp9whlQ9EyHvlve9XG1rN39yMcm4cqzLvft0BxSm/MUs5.', '2022-11-29 17:56:26'),
(1, 3, 'admin', 'admin', 'admin@gvpce.ac.in', 'admin', 'admin', '2022-11-29 17:34:50'),
(3, 1, 'Nivas', 'Y', 'nivas_y@gvpce.ac.in', 'nivas_y', '$2y$10$0E/jTFpAWOBd8EyBZLbTYOOe..2r0OXtvPk7QBy4322RSthazrziK', '2022-11-29 17:36:53'),
(2, 1, 'Rakshitha', 'Varma K', 'rvarma2812@gvpce.ac.in', 'rakshithavarma', '$2y$10$3AdDWdfkX9JLAplk9/3euezhydxQ8Opta8hjMiF1xooOQqEBZjJGO', '2022-11-29 17:36:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot_hints`
--
ALTER TABLE `chatbot_hints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference_materials`
--
ALTER TABLE `reference_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_title` (`class_title`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_submissions`
--
ALTER TABLE `test_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chatbot_hints`
--
ALTER TABLE `chatbot_hints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `reference_materials`
--
ALTER TABLE `reference_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_submissions`
--
ALTER TABLE `test_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
