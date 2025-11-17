-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
('A Game of Thrones', 'imgi_59_A12tbaSby+L.jpg', 'George R.R. Martin', 'Fantasy', 20, 'The first book of A Song of Ice and Fire saga, where noble houses fight for the Iron Throne amid political intrigue, war, and dragons.'),
('Clean Codes', 'Clean Code by Robert C. Martin.jpg', 'Robert C. Martin', 'Computer Science', 15, 'Teaches software craftsmanship and clean coding practices that help developers write readable, maintainable, and efficient code.'),
('Deep Learning Interviews', 'dl.jpg', 'Shlomo Kashani ', 'Computer Science', 30, 'A hands-on guide with practical questions and explanations for AI/ML interviews covering deep learning concepts.'),
('Eat, Pray, Love', 'imgi_58_9780747589358.jpg', 'Elizabeth Gilbert', 'Travel & Tourism', 17, 'A memoir of self-discovery as Gilbert travels through Italy, India, and Bali, exploring food, spirituality, and love.'),
('Effective Java', 'java.jpg', 'Joshua Bloch', 'Computer Science', 12, 'A must-read for Java developers, this book offers best practices, design patterns, and advanced tips to write robust, efficient, and maintainable Java code.'),
('Good to Great by Jim Collins', 'Good to Great by Jim Collins.png', 'Jim Collins', 'Business Management', 10, 'Explores how average companies become exceptional through disciplined leadership, culture, and strategy. Introduces the concept of the “Hedgehog Concept” and Level 5 Leadership'),
('he Name of the Wind', 'imgi_50_bf73dea04b502ab8c9cf280727bb0db3.jpg', 'Patrick Rothfuss', 'Fantasy', 17, 'A magical journey following Kvothe, a gifted young man who becomes a legendary magician, musician, and hero.'),
('Head First Java', 'head first java.jpg', 'Kathy Sierra', 'Computer Science', 15, 'A beginner-friendly, visually rich book that teaches Java with engaging examples and exercises. Great for building strong OOP and Java fundamentals.'),
('High Output Management', 'High Output Management by Andy Grove.jpg', 'Andrew S. Grove', 'Business Management', 25, 'Written by Intel’s former CEO, this is a hands-on guide to running a team or a company efficiently. Covers managing production, performance reviews, and how to scale operations.'),
('In Patagonia', 'imgi_69_91L1OvAE3wL-636x1024.jpg', 'Bruce Chatwin', 'Travel & Tourism', 4, 'A modern classic travel narrative capturing the beauty, mystery, and eccentric characters of Patagonia in South America.'),
('Into the Wild', 'imgi_23_713SeNQjEAL._SL1428_.jpg', 'Jon Krakauer', 'Travel & Tourism', 14, 'The true story of Christopher McCandless, who gave up his possessions to explore the Alaskan wilderness in search of freedom and meaning.'),
('Introduction to Algorithms', 'Introduction to Algorithms.jpeg', 'Thomas H. Cormen', 'Computer Science', 15, 'Known as CLRS, this book provides comprehensive coverage of algorithms and data structures, widely used in academia and industry.'),
('On the Road', 'imgi_23_92b6c06203fedad753fdebefa2c62624.jpg', 'Jack Kerouac', 'Travel & Tourism', 13, 'A classic American road trip novel capturing the Beat Generation’s spirit of freedom, exploration, and spontaneous travel across the U.S.'),
('Only the Paranoid Survive', 'Only the Paranoid Survive by Andy Grove.jpg', 'Andrew S. Grove', 'Business Management', 10, 'A deep dive into how businesses must constantly adapt to stay alive, especially during “strategic inflection points”—crucial times when a company must pivot or risk failure.'),
('PHP & MySQL: Server-side Web D', 'php.jpeg', 'Jon Duckett', 'Computer Science', 5, 'A well-designed and accessible book for learning PHP with MySQL. Covers backend web development concepts clearly with visuals and hands-on examples.'),
('Shadow and Bone', 'imgi_55_9781250027436.jpg', 'Leigh Bardugo', 'Fantasy', 6, 'A soldier with a rare magical gift might save her war-torn country, but dark forces and dangerous secrets stand in her way.'),
('The Art of Travel', 'imgi_53_81i9hfEx8iL.jpg', 'Alain de Botton', 'Travel & Tourism', 11, 'A philosophical exploration of why we travel, what we expect, and how journeys shape our perception of the world.'),
('The C++ Programming Language', 'c++.jpg', 'Bjarne Stroustrup', 'Computer Science', 8, 'Written by the creator of C++, this comprehensive guide covers all aspects of the language, from basics to advanced features like templates and STL.'),
('The Effective Executive', 'the Effective Executive by Peter Drucker.webp', 'Peter Drucker', 'Business Management', 16, 'Focuses on the habits and practices of effective leaders. Drucker argues that effectiveness can be learned and stresses decision-making, time management, and prioritization.'),
('The Final Empire', 'imgi_55_308297e35aa98fa5272bd0c8ef913025.jpg', 'Brandon Sanderson', 'Fantasy', 8, 'A unique fantasy world where ingesting metals grants magical powers, and a group of rebels attempts to overthrow an immortal tyrant.'),
('The Geography of Bliss', 'imgi_51__5434_jbyGZmO.jpg', 'Eric Weiner', 'Travel & Tourism', 17, 'A humorous journey as Weiner travels to countries like Iceland, Bhutan, and Switzerland to discover the secrets of happiness.'),
('The Great Railway Bazaar', 'imgi_54_9780141038841.jpg', 'Paul Theroux', 'Travel & Tourism', 9, 'A famous railway journey across Europe, Asia, and the Middle East, full of adventure, cultural encounters, and unforgettable landscapes.'),
('The Hobbit', 'imgi_68_9780007487288.jpg', 'J.R.R. Tolkien', 'Fantasy', 15, 'A timeless adventure of Bilbo Baggins, who embarks on a quest with dwarves and the wizard Gandalf to reclaim treasure from the dragon Smaug.'),
('The Lean Startup', 'imgi_46_546x840.jpg', 'Eric Ries', 'Business Management', 17, 'A modern guide to building startups through innovation, validated learning, and agile product development.'),
('The One Minute Manager', 'The One Minute Manager by Blanchard & Johnson.png', 'Ken Blanchard', 'Business Management', 15, 'Offers simple yet powerful methods for effective leadership, such as one-minute goal setting, praising, and reprimands. Ideal for fast-paced work environments.'),
('The Pragmatic Programmer', 'The Pragmatic Programmer.jpg', 'David Thomas', 'Computer Science', 11, 'Offers practical advice on coding, debugging, and managing software projects effectively, with tips to become a better developer.'),
('The Way of Kings', 'imgi_61_81pJXhRLdoL._SL1500_.jpg', 'Brandon Sanderson', 'Fantasy', 11, 'The first book of The Stormlight Archive, featuring magical knights, epic wars, and a richly detailed world of political struggles.');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(40) NOT NULL,
  `sid` int(8) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `sid`, `password`) VALUES
('Parmar Yashrajsinh', 20250308, '92d7686741732b11eb4421248b74ae48'),
('Kanani Yagnesh', 20250309, 'e10adc3949ba59abbe56e057f20f883e'),
('Khanpara Utsav', 20250312, 'e10adc3949ba59abbe56e057f20f883e'),
('Tank Jatin', 20250314, 'e10adc3949ba59abbe56e057f20f883e'),
('diyora lax', 20250374, '93897cc117a734be93733779051c9926'),
('variya khushal', 20250376, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `name` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`name`, `review`, `title`) VALUES
('Kanani Yagnesh', 'This book is a must read for every developer, It shows how small habits in writing code can make a huge difference in readability and maintenance', 'Clean Codes'),
('Parmar Yashrajsinh', 'Clean Code completely changed the way I think about programming — it makes you realize that writing code is not just about making it work, but making it beautiful and easy to understand', 'Clean Codes'),
('Khanpara Utsav', 'Very nice book!!\r\n', 'Deep Learning Interviews');

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
(20250308, 'Parmar Yashrajsinh', 'Clean Codes', '2025-10-02', '2025-11-01'),
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
(20250331, 'Kalathiya Pruthil', 'In Patagonia', '2025-09-12', '2025-10-12'),
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
(20250374, 'Diyora Lax', 'The Effective Executive', '2025-09-18', '2025-10-18'),
(20250375, 'Prajapati Het', '', NULL, NULL),
(20250376, 'Variya Khushal', 'Shadow and Bone', '2025-10-01', '2025-10-31'),
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
  ADD PRIMARY KEY (`sid`),
  ADD KEY `fk_register_username` (`username`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `title` (`title`),
  ADD KEY `fk_username` (`name`);

--
-- Indexes for table `student_id_password`
--
ALTER TABLE `student_id_password`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`name`) REFERENCES `student_id_password` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
