-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 08:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `username` varchar(40) NOT NULL,
  `password` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`username`, `password`) VALUES
('admin@569', 14169149);

-- --------------------------------------------------------

--
-- Table structure for table `book_details`
--

CREATE TABLE `book_details` (
  `title` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `stock` int(5) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_details`
--

INSERT INTO `book_details` (`title`, `image`, `author`, `category`, `stock`, `description`) VALUES
('Clean Code', 'Clean Code by Robert C. Martin.jpg', 'Robert C. Martin', 'Computer Science', 17, 'Teaches software craftsmanship and clean coding practices that help developers write readable, maintainable, and efficient code.'),
('Deep Learning Interviews', 'dl.jpg', 'Shlomo Kashani ', 'Computer Science', 30, 'A hands-on guide with practical questions and explanations for AI/ML interviews covering deep learning concepts.'),
('Effective Java', 'java.jpg', 'Joshua Bloch', 'Computer Science', 12, 'A must-read for Java developers, this book offers best practices, design patterns, and advanced tips to write robust, efficient, and maintainable Java code.'),
('Good to Great by Jim Collins', 'Good to Great by Jim Collins.png', 'Jim Collins', 'Business Management', 10, 'Explores how average companies become exceptional through disciplined leadership, culture, and strategy. Introduces the concept of the “Hedgehog Concept” and Level 5 Leadership'),
('Head First Java', 'head first java.jpg', 'Kathy Sierra', 'Computer Science', 15, 'A beginner-friendly, visually rich book that teaches Java with engaging examples and exercises. Great for building strong OOP and Java fundamentals.'),
('High Output Management', 'High Output Management by Andy Grove.jpg', 'Andrew S. Grove', 'Business Management', 25, 'Written by Intel’s former CEO, this is a hands-on guide to running a team or a company efficiently. Covers managing production, performance reviews, and how to scale operations.'),
('Introduction to Algorithms', 'Introduction to Algorithms.jpeg', 'Thomas H. Cormen', 'Computer Science', 15, 'Known as CLRS, this book provides comprehensive coverage of algorithms and data structures, widely used in academia and industry.'),
('Only the Paranoid Survive', 'Only the Paranoid Survive by Andy Grove.jpg', 'Andrew S. Grove', 'Business Management', 10, 'A deep dive into how businesses must constantly adapt to stay alive, especially during “strategic inflection points”—crucial times when a company must pivot or risk failure.'),
('PHP & MySQL: Server-side Web D', 'php.jpeg', 'Jon Duckett', 'Computer Science', 5, 'A well-designed and accessible book for learning PHP with MySQL. Covers backend web development concepts clearly with visuals and hands-on examples.'),
('The C++ Programming Language', 'c++.jpg', 'Bjarne Stroustrup', 'Computer Science', 8, 'Written by the creator of C++, this comprehensive guide covers all aspects of the language, from basics to advanced features like templates and STL.'),
('The Effective Executive', 'the Effective Executive by Peter Drucker.webp', 'Peter Drucker', 'Business Management', 17, 'Focuses on the habits and practices of effective leaders. Drucker argues that effectiveness can be learned and stresses decision-making, time management, and prioritization.'),
('The One Minute Manager', 'The One Minute Manager by Blanchard & Johnson.png', 'Ken Blanchard', 'Business Management', 15, 'Offers simple yet powerful methods for effective leadership, such as one-minute goal setting, praising, and reprimands. Ideal for fast-paced work environments.'),
('The Pragmatic Programmer', 'The Pragmatic Programmer.jpg', 'David Thomas', 'Computer Science', 11, 'Offers practical advice on coding, debugging, and managing software projects effectively, with tips to become a better developer.');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(40) NOT NULL,
  `sid` int(8) NOT NULL,
  `password` int(6) NOT NULL,
  `confirm_password` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `sid`, `password`, `confirm_password`) VALUES
('Parmar Yashrajsinh', 20250308, 141252, 141252),
('Kanani Yagnesh', 20250309, 123456, 123456);

-- --------------------------------------------------------

--
-- Table structure for table `student_id_password`
--

CREATE TABLE `student_id_password` (
  `sid` int(8) NOT NULL,
  `username` varchar(40) NOT NULL,
  `book_issued` varchar(30) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_id_password`
--

INSERT INTO `student_id_password` (`sid`, `username`, `book_issued`, `issue_date`, `return_date`) VALUES
(20250301, 'Kakadiya Ruchit', '', NULL, NULL),
(20250302, 'Shrimankar Hetvi', '', NULL, NULL),
(20250303, 'Manani Kinjal', '', NULL, NULL),
(20250304, 'Sanepara Manali', '', NULL, NULL),
(20250305, 'Kamaliya Hiten', '', NULL, NULL),
(20250306, 'Nakrani Dixita', '', NULL, NULL),
(20250307, 'Chavda Priyanshi', '', NULL, NULL),
(20250308, 'Parmar Yashrajsinh', 'Clean Code', '2025-07-19', '2025-08-18'),
(20250309, 'Kanani Yagnesh', '', NULL, NULL),
(20250310, 'Ramani Sanjana', '', NULL, NULL),
(20250311, 'Virani Khushi', '', NULL, NULL),
(20250312, 'Khanpara Utsav', '', NULL, NULL),
(20250313, 'Tank Jeenal', '', NULL, NULL),
(20250314, 'Tank Jatin', '', NULL, NULL),
(20250315, 'Sakariya Krisha', '', NULL, NULL),
(20250316, 'Kacha Payal', '', NULL, NULL),
(20250317, 'Patel Shrey', '', NULL, NULL),
(20250318, 'Sohala Krish', '', NULL, NULL),
(20250319, 'Ramani Chitrang', '', NULL, NULL),
(20250320, 'Dhola Aayush', '', NULL, NULL),
(20250321, 'Javiya Meet', '', NULL, NULL),
(20250322, 'Zinzala Vishal', '', NULL, NULL),
(20250323, 'Vaghani Bhargathi', '', NULL, NULL),
(20250324, 'Vaghani Krinal', '', NULL, NULL),
(20250325, 'Zoyora Dhruvi', '', NULL, NULL),
(20250326, 'Nagar Devanshi', '', NULL, NULL),
(20250328, 'Kalathiya Pruthil', '', NULL, NULL),
(20250332, 'Sukharamwala Krish', '', NULL, NULL),
(20250333, 'Ginoya Lav', '', NULL, NULL),
(20250334, 'Dudhat Harsh', '', NULL, NULL),
(20250335, 'Aakoliya Axita', '', NULL, NULL),
(20250336, 'Dhanani Krish', '', NULL, NULL),
(20250337, 'Chauhan Savan', '', NULL, NULL),
(20250338, 'Sangani Shweta', '', NULL, NULL),
(20250339, 'Thummar Roshan', '', NULL, NULL),
(20250340, 'Rajani Shruti', '', NULL, NULL),
(20250341, 'Kalsariya Vandanaben', '', NULL, NULL),
(20250342, 'Malankiya Mousam', '', NULL, NULL),
(20250343, 'Pandav Deep', '', NULL, NULL),
(20250344, 'Kachariya Siddhi', '', NULL, NULL),
(20250345, 'Gajera Yagnik', '', NULL, NULL),
(20250346, 'Rathod Madhvi', '', NULL, NULL),
(20250348, 'Kanthariya Suhani', '', NULL, NULL),
(20250349, 'Solanki Harsh', '', NULL, NULL),
(20250350, 'Ramani Parthavi', '', NULL, NULL),
(20250351, 'Goswami Vanditgiri', '', NULL, NULL),
(20250352, 'Bambhaniya Nikita', '', NULL, NULL),
(20250353, 'Asodariya Lucky', '', NULL, NULL),
(20250354, 'Dhankar Archi', '', NULL, NULL),
(20250355, 'Suhagiya Trusha', '', NULL, NULL),
(20250356, 'Koladiya Suhani', '', NULL, NULL),
(20250357, 'Jethva Aryan', '', NULL, NULL),
(20250358, 'Vegad Pavan', '', NULL, NULL),
(20250359, 'Kathiriya Priyanshi', '', NULL, NULL),
(20250360, 'Dhalani Jenish', '', NULL, NULL),
(20250361, 'Sojitra Dhruvi', '', NULL, NULL),
(20250364, 'Meghani Utsavkumar', '', NULL, NULL),
(20250366, 'Munjani Isha', '', NULL, NULL),
(20250367, 'Boghani Dipesa', '', NULL, NULL),
(20250368, 'Gorasiya Archana', '', NULL, NULL),
(20250370, 'Kathiriya Meet', '', NULL, NULL),
(20250371, 'Padhara Bhakti', '', NULL, NULL),
(20250372, 'Katrodiya Heet', '', NULL, NULL),
(20250373, 'Jasani Snehaben', '', NULL, NULL),
(20250374, 'Divora Lax', '', NULL, NULL),
(20250375, 'Prajapati Het', '', NULL, NULL),
(20250376, 'Variya Khushal', '', NULL, NULL),
(20250377, 'Bhesadadiya Darshita', '', NULL, NULL),
(20250378, 'Rabadiya Ishani', '', NULL, NULL),
(20250380, 'Zadafiya Yug', '', NULL, NULL),
(20250381, 'Chauhan Janvi', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `book_details`
--
ALTER TABLE `book_details`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `student_id_password`
--
ALTER TABLE `student_id_password`
  ADD PRIMARY KEY (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
