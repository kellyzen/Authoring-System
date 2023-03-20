-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 08:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studiodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_ID` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_description` varchar(150) NOT NULL,
  `c_type_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_ID`, `c_name`, `c_description`, `c_type_ID`, `user_ID`) VALUES
(1, 'Operating System & Concurrency', 'To explain how the internal structure of OS is designed and implemented for management of resources and provision of services.', 1, 1),
(2, 'Mathematics', 'Calculus, Statistic, Probability', 2, 2),
(3, 'Icing/ Frosting', 'A sweet, often creamy glaze made of sugar with water or milk, that is often enriched with ingredients like butter, egg whites, cream cheese, or flavor', 8, 2),
(4, 'Soil', 'To determine the different types of soil for planting.', 12, 2),
(5, 'History of Architecture', 'To learn the history of architecture from a different era.', 11, 1),
(6, 'Programming &amp; Algorithms', 'Learn different programming languages and algorithms.', 1, 2),
(7, 'Force', 'Force is an influence that can change the motion of an object', 4, 2),
(8, 'Computer Fundamentals', 'Reveal the fundamentals of a computer system.', 1, 1),
(9, 'Java', 'Polymorphism', 1, 1),
(10, 'Classical Music', 'Appreciate classical music and its history', 47, 1),
(12, 'Call of Duty', 'Shooting techniques', 31, 2),
(14, 'Debit/ Credit', 'blah blah blah...', 10, 2),
(16, 'Untitled', 'Add description here...', 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_type`
--

CREATE TABLE `course_type` (
  `c_type_ID` int(11) NOT NULL,
  `c_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_type`
--

INSERT INTO `course_type` (`c_type_ID`, `c_type`) VALUES
(1, 'Computer Science'),
(2, 'Mathematics'),
(3, 'Biology'),
(4, 'Physic'),
(5, 'Chemistry'),
(6, 'Environmental Science'),
(7, 'Aerospace'),
(8, 'Baking'),
(9, 'Information Technology'),
(10, 'Accounting'),
(11, 'Architecture'),
(12, 'Agriculture'),
(13, 'Aircraft'),
(14, 'Business'),
(15, 'Biomedical Science'),
(16, 'Engineering'),
(17, 'Chemical Engineering'),
(18, 'Civil Engineering'),
(19, 'Electrical & Electronic Engineering'),
(20, 'Mechanical Engineering'),
(21, 'Mechatronic Engineering'),
(22, 'Culinary Arts'),
(23, 'Counselling'),
(24, 'Dentistry'),
(25, 'Economics'),
(26, 'Politics'),
(27, 'Education'),
(28, 'Food Science'),
(29, 'Finance'),
(30, 'Geology'),
(31, 'Game'),
(32, 'Graphic Design'),
(33, 'Human Resource Manag'),
(34, 'Hospitality'),
(35, 'History'),
(36, 'Interior Design'),
(37, 'Journalism'),
(38, 'Law'),
(39, 'Language Studies'),
(40, 'Multimedia'),
(41, 'Marketing'),
(42, 'Marine Science'),
(43, 'Music'),
(44, 'Pharmacy'),
(45, 'Psychology'),
(46, 'Religious Studies'),
(47, 'Sport Science'),
(48, 'Tourism'),
(49, 'Veterinary');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `difficulty_ID` int(11) NOT NULL,
  `difficulty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`difficulty_ID`, `difficulty`) VALUES
(3, 'Advance'),
(1, 'Beginner'),
(2, 'Intermediate');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_ID` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_type` varchar(250) NOT NULL,
  `file_path` varchar(250) NOT NULL,
  `topic_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_ID`, `file_name`, `file_size`, `file_type`, `file_path`, `topic_ID`) VALUES
(6, 'When Will a Genetic Algorithm Outperform Hill-Climbing_', 764755, 'application/pdf', '../../Upload/Topic2/When Will a Genetic Algorithm Outperform Hill-Climbing_.pdf', 2),
(7, 'Hill Climbers and Mutational Heuristics in Hyperheuristics6_hyper', 157580, 'application/pdf', '../../Upload/Topic2/Hill Climbers and Mutational Heuristics in Hyperheuristics6_hyper.pdf', 2),
(13, '【TNT时代少年团 宋亚轩】《舞·象·之·年 第四篇章－年》重磅压轴曲《小小孩》「小小的小孩会站在他自己的舞台」【中文歌词字幕／ENG SUB】__ 1080H', 4024625, 'audio/mpeg', '../../Upload/Topic2/【TNT时代少年团 宋亚轩】《舞·象·之·年 第四篇章－年》重磅压轴曲《小小孩》「小小的小孩会站在他自己的舞台」【中文歌词字幕／ENG SUB】__ 1080H.mp3', 2),
(15, 'Web Design Handout.pdf', 521936, 'application/pdf', '../../Upload/Topic2/Web Design Handout.pdf', 2),
(16, 'Git installation.pdf', 690587, 'application/pdf', '../../Upload/Topic2/Git installation.pdf', 2),
(17, 'Git and Github Workshop.pdf', 464308, 'application/pdf', '../../Upload/Topic2/Git and Github Workshop.pdf', 2),
(19, 'Kelas Aktiviti1.pdf', 107231, 'application/pdf', '../../Upload/Topic2/Kelas Aktiviti1.pdf', 2),
(21, '2D Game Handout.pdf', 3780537, 'application/pdf', '../../Upload/Topic2/2D Game Handout.pdf', 2),
(23, 'Discrete_Mathematics_and_Its_Applications_(7th_Edition).pdf', 10128691, 'application/pdf', '../../Upload/Topic27/Discrete_Mathematics_and_Its_Applications_(7th_Edition).pdf', 27),
(24, 'math induction.pdf', 107062, 'application/pdf', '../../Upload/Topic27/math induction.pdf', 27),
(26, 'Stud.io database - ER diagram.png', 65532, 'image/png', '../../Upload/Topic2/Stud.io database - ER diagram.png', 2),
(27, 'Kayden.mp4', 17812312, 'video/mp4', '../../Upload/Topic2/Kayden.mp4', 2),
(28, 'happy birthday song.mp4', 940510, 'video/mp4', '../../Upload/Topic2/happy birthday song.mp4', 2),
(30, 'IEEE Certificate of Appreciation.pdf', 439684, 'application/pdf', '../../Upload/Topic2/IEEE Certificate of Appreciation.pdf', 2),
(41, 'image 5.png', 625883, 'image/png', '../../Upload/Topic2/image 5.png', 2),
(44, 'image 5-0-Enhanced-Animated.mp4', 4426469, 'video/mp4', '../../Upload/Topic2/image 5-0-Enhanced-Animated.mp4', 2),
(45, 'Albert-Lee-Story.mp4', 1257114, 'video/mp4', '../../Upload/Topic27/Albert-Lee-Story.mp4', 27),
(57, 'Albert Lees DeepStory.mp4', 1257114, 'video/mp4', '../../Upload/Topic2/Albert Lees DeepStory.mp4', 2),
(58, 'try.txt', 12, 'text/plain', '../../Upload/Topic2/try.txt', 2),
(59, 'howto.html', 6021, 'text/html', '../../Upload/Topic2/howto.html', 2),
(60, 'Past Years.zip', 576754, 'application/x-zip-compressed', '../../Upload/Topic2/Past Years.zip', 2),
(61, 'Coursework 1 Template 22.doc', 38912, 'application/msword', '../../Upload/Topic2/Coursework 1 Template 22.doc', 2),
(62, 'COMP2025-CW 1-CS-CW-Issue-22.docx', 20224, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '../../Upload/Topic2/COMP2025-CW 1-CS-CW-Issue-22.docx', 2),
(63, 'GRP C SEGP.pptx', 973063, 'application/vnd.openxmlformats-officedocument.presentationml.presentation', '../../Upload/Topic2/GRP C SEGP.pptx', 2),
(64, 'dark.css', 2075, 'text/css', '../../Upload/Topic2/dark.css', 2);

-- --------------------------------------------------------

--
-- Table structure for table `security_ques`
--

CREATE TABLE `security_ques` (
  `ques_ID` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `ques_section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security_ques`
--

INSERT INTO `security_ques` (`ques_ID`, `question`, `ques_section`) VALUES
(1, 'What is the name of your favorite childhood friend?', 1),
(2, 'What was the name of the first school you remember attending?', 1),
(3, 'Where was the destination of your most memorable school field trip?', 1),
(4, 'What was your maths teacher\'s surname in your 8th year of school?', 1),
(5, 'What was the name of your first stuffed toy?', 1),
(6, 'What was your driving instructor\'s first name?', 1),
(7, 'In what city or town did your mother and father meet?', 2),
(8, 'What elementary school did you attend?', 2),
(9, 'What is your mother’s maiden name?', 2),
(10, 'What was the first exam you failed?', 2),
(11, 'What was the name of the boy or the girl you first kissed?', 2),
(12, 'What is the middle name of your youngest child?', 2),
(13, 'What is the name of a college you applied to but didn\'t attend?', 3),
(14, 'What is your maternal grandmother\'s maiden name?', 3),
(15, 'What was your childhood nickname?', 3),
(16, 'What is your oldest sibling’s birthday month and year? (e.g., January 1900)', 3),
(17, 'What is your oldest cousin\'s first and last name?', 3),
(18, 'What was your childhood phone number including area code? (e.g., 000-000-0000)', 3);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topic_ID` int(11) NOT NULL,
  `topic_name` varchar(100) NOT NULL,
  `topic_description` varchar(150) NOT NULL,
  `difficulty_ID` int(11) DEFAULT NULL,
  `course_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topic_ID`, `topic_name`, `topic_description`, `difficulty_ID`, `course_ID`) VALUES
(1, 'Memory Management', 'To learn the different algorithms for storing/ retrieving memory.', 2, 1),
(2, 'Differentiation', 'dy/dx', 1, 2),
(3, 'Icing ingredients', 'How to mix icing?', 1, 3),
(4, 'Vanilla Buttercream', 'This vanilla buttercream frosting will be ready to turn any cake, cookie or cupcake into a special-occasion dessert', 3, 3),
(5, 'Linked List', 'Malloc(), Calloc(), Realloc()', 2, 6),
(6, 'Pointer', 'Ways to pass a pointer to a function.', 2, 6),
(7, 'File Processing', 'File processing consists of creating, storing, and/or retrieving the contents of a file from a recognizable medium. For example, it is used to save wo', 1, 6),
(8, 'Introduction', 'In physics, a force is an influence that can change the motion of an object. A force can cause an object with mass to change its velocity, i.e., to ac', 1, 7),
(9, 'Types of Force', 'Newton\'s Laws - Lesson 2 - Force and Its Representation', 1, 7),
(10, 'Powdered sugar icing', 'This easy, 3-ingredient Powdered Sugar Icing is perfect for bundt cakes, pound cakes, angel food cakes, cookies, and quick breads.', 1, 3),
(11, 'Structure, Union, Enumeration', 'struc and union cannot compare because there might be bytes of undefined data, only can compare one by one (for struc)', 2, 6),
(12, 'Array', 'Array is a group of contiguous memory locations with same type.', 1, 6),
(13, 'Past Year Papers', '- Past Year Paper 2020/2021\r\n- Past Year Paper 2019/2020\r\n- Past Year Paper 2019/2019', 3, 6),
(14, 'Newton’s first principle', ' a body that is at rest or moving at a uniform rate in a straight line will remain in that state until some force is applied to it', 2, 7),
(15, 'Newton’s second law', 'when an external force acts on a body, it produces an acceleration (change in velocity) of the body in the direction of the force', 2, 7),
(27, 'Linear Programming', 'Add description here...', 2, 2),
(29, 'Types of Force', 'Newton\'s Laws - Lesson 2 - Force and Its Representation', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `theme` varchar(10) NOT NULL DEFAULT 'light'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `username`, `firstname`, `lastname`, `email`, `password`, `theme`) VALUES
(1, 'John_Doe', 'John', 'Doe', 'JohnDoe@domain.com', 'Johndoe000&', 'light'),
(2, 'groupc', 'Grp', 'C', 'grpc@gmail.com', 'GroupC000!', 'dark'),
(3, 'kellyzen', 'Kelly', 'Tan', '02tankelly@gmail.com', 'Kellytan02!', 'light'),
(4, 'user1', 'user1', 'tan', 'hfykt10@nottingham.edu.my', 'Hfykt10!', 'light'),
(5, 'okayy', 'user2', 'try', '123@gmail.com', 'Trypassword123!', 'light'),
(7, 'admin', 'Kelly', 'Tan', 'mr.hamid@gmail.com', 'Helloworld1@', 'light');

-- --------------------------------------------------------

--
-- Table structure for table `user_security`
--

CREATE TABLE `user_security` (
  `security_ID` int(11) NOT NULL,
  `ques1_ID` int(11) NOT NULL,
  `ques2_ID` int(11) NOT NULL,
  `ques3_ID` int(11) NOT NULL,
  `ques1_ans` varchar(255) NOT NULL,
  `ques2_ans` varchar(255) NOT NULL,
  `ques3_ans` varchar(255) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_security`
--

INSERT INTO `user_security` (`security_ID`, `ques1_ID`, `ques2_ID`, `ques3_ID`, `ques1_ans`, `ques2_ans`, `ques3_ans`, `user_ID`) VALUES
(1, 5, 10, 15, 'Boston', 'Chinese', 'John', 1),
(2, 6, 8, 16, 'groupD', 'Nottingham', 'October 2000', 2),
(3, 2, 7, 17, 'SJK(C) Jalan Davidson', 'Selangor', 'Brandon Chong', 3),
(4, 4, 9, 18, 'Chong', 'Lew', '000-000-0000', 4),
(5, 6, 10, 14, 'User', 'Math', 'Chong', 5),
(7, 2, 7, 13, 'Kindergarten', 'New York City', 'Sunway', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_ID`),
  ADD KEY `c_type_ID` (`c_type_ID`),
  ADD KEY `course_ibfk_2` (`user_ID`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`c_type_ID`);

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`difficulty_ID`),
  ADD UNIQUE KEY `difficulty` (`difficulty`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_ID`),
  ADD KEY `TopicID` (`topic_ID`);

--
-- Indexes for table `security_ques`
--
ALTER TABLE `security_ques`
  ADD PRIMARY KEY (`ques_ID`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_ID`),
  ADD KEY `course_ID` (`course_ID`) USING BTREE,
  ADD KEY `difficulty_ID` (`difficulty_ID`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_security`
--
ALTER TABLE `user_security`
  ADD PRIMARY KEY (`security_ID`),
  ADD UNIQUE KEY `user_ID` (`user_ID`),
  ADD KEY `ques1_ID` (`ques1_ID`),
  ADD KEY `ques2_ID` (`ques2_ID`),
  ADD KEY `ques3_ID` (`ques3_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `c_type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `difficulty_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`c_type_ID`) REFERENCES `course_type` (`c_type_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`topic_ID`) REFERENCES `topic` (`topic_ID`) ON DELETE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`difficulty_ID`) REFERENCES `difficulty` (`difficulty_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `course` (`course_ID`) ON DELETE CASCADE;

--
-- Constraints for table `user_security`
--
ALTER TABLE `user_security`
  ADD CONSTRAINT `user_security_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_security_ibfk_2` FOREIGN KEY (`ques1_ID`) REFERENCES `security_ques` (`ques_ID`),
  ADD CONSTRAINT `user_security_ibfk_3` FOREIGN KEY (`ques2_ID`) REFERENCES `security_ques` (`ques_ID`),
  ADD CONSTRAINT `user_security_ibfk_4` FOREIGN KEY (`ques3_ID`) REFERENCES `security_ques` (`ques_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
