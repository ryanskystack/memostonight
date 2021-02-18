-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 03:50 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memostonight`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` smallint(6) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_userid` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_name`, `admin_userid`, `admin_password`) VALUES
(1, 'Admin', 'admin', 'admin'),
(2, 'Ryan', 'ryan', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `celebrity_id` int(11) NOT NULL,
  `celebrity_first_name` varchar(30) NOT NULL,
  `celebrity_middle_name` varchar(30) NOT NULL,
  `celebrity_last_name` varchar(30) NOT NULL,
  `occupationId` smallint(6) NOT NULL,
  `celebrity_street_no` varchar(10) NOT NULL,
  `celebrity_street_name` varchar(30) NOT NULL,
  `stateId` smallint(6) NOT NULL,
  `postcodeId` int(11) DEFAULT NULL,
  `countryId` smallint(6) NOT NULL,
  `celebrity_email` varchar(40) NOT NULL,
  `celebrity_mobile_number` varchar(15) NOT NULL,
  `celebrity_picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`celebrity_id`, `celebrity_first_name`, `celebrity_middle_name`, `celebrity_last_name`, `occupationId`, `celebrity_street_no`, `celebrity_street_name`, `stateId`, `postcodeId`, `countryId`, `celebrity_email`, `celebrity_mobile_number`, `celebrity_picture`) VALUES
(4, 'शाह', 'रुख़', 'ख़ान', 1, '12A    ', 'John Street', 1, 1, 1, 'shahrukhkhan@gmail.com', '0421190123', '1398010215_shahrukh-khan.jpg'),
(5, 'Robert', 'Downey', 'Junior', 1, '7B  ', 'Mary Street', 1, 2, 1, 'robertdjr@gmail.com', '042935468', '1398012133_Robert-robert0.png'),
(6, 'سيف', 'علي', 'خان', 1, '29C ', 'Hopkins Street', 1, 3, 1, 'saifalikhan@gmail.com', '0469781354', '78849_v9_bb.jpg'),
(7, 'Bill', ' ', 'Gates', 6, '43D ', 'Plainsville', 1, 2, 1, 'billgates@microsoft.com', '0411354168', '1398011667_list-of-bill-gates-interviews.jpg'),
(8, 'Anushka', ' ', 'Sharma', 7, '47B ', 'George Street', 1, 5, 1, 'anushkasharma@gmail.com', '0469781325', '1398010484_anushka-sharma.jpg'),
(11, 'Salman', ' ', 'Khan', 1, '27A ', 'Chandlers Street', 1, 5, 1, 'sallubhai@gmail.com', '0412547841', '1398012218_Salman-Khan-100x100.jpg'),
(12, 'Jason', ' ', 'Statham', 1, '34D ', 'Malibu Street', 1, 5, 1, 'jasonstatham@gmail.com', '0451325975', '1398011894_NExpXFk2QjRUBB_1_zzb.jpg'),
(13, 'Sylvester', ' ', 'Stallone', 1, '45E ', 'Sunshine Lane', 1, 5, 1, 'sylvestorstallone@gmail.com', '0432542145', '1398012379_Sylvester_Stallone2010.jpg'),
(14, 'Jessica', ' ', 'Alba', 7, '41C ', 'Sunshine Lane', 1, 5, 1, 'jessicaalba@gmail.com', '0412485347', '1398011590_jessica_alba_photo.jpg'),
(15, 'Dwayne', ' ', 'Johnson', 1, '12D ', 'Dartbrook Road', 1, 2, 1, 'dwaynejohnson@gmail.com', '0457853124', '1398012010_photo (2).jpg'),
(16, 'Liam', ' ', 'Neeson', 1, '17A ', 'Harris Street', 1, 1, 1, 'liamneeson@gmail.com', '0472356846', '1236_v9_bb.jpg'),
(23, 'Christiano', ' ', 'Ronaldo', 3, '23 A ', 'Phillips Street', 1, 3, 1, 'christianocr7@gmail.com', '0450478351', '1398010973_Cristiano_Ronaldo.jpg'),
(26, 'Elon', ' ', 'Musk', 6, '23F ', 'Chandlers Street', 2, 7, 1, 'elonmusk@gmail.com', '0470614587', '3500.jpg'),
(27, 'Gal', ' ', 'Gadot', 2, '41A ', 'Prince Street', 3, 4, 3, 'galgadot@gmail.com', '0478124632', '5568..jpg'),
(28, 'Amanda', ' ', 'Seyfried', 2, '14C ', 'Smith Street', 2, 2, 2, 'amanda@gmail.com', '0478154345', '1156770_w980h638c1cx513cy360.jpg'),
(29, 'Ariana', ' ', 'Grande', 9, '78C ', 'Rowes Street', 4, 2, 4, 'ariana@gmail.com', '0487135487', 'ariana.jpg'),
(30, 'Beyonce', ' ', ' ', 9, '556A ', 'John Street', 0, 6, 3, 'beyonce@gmail.com', '0458764895', 'Beyonce.jpg'),
(31, 'Will', ' ', 'Smith', 1, '47D ', 'Blaire Street', 4, 4, 4, 'will@gmail.com', '0458765798', 'BilingualCelebritites_HUB.png'),
(32, 'Kendall', ' ', 'Jenner', 8, '91B ', 'Bower Street', 4, 3, 4, 'kendall@gmail.com', '0478652148', 'celebrities-mental-ilness-967440250.jpg'),
(33, 'Cara', ' ', 'Delevingne', 2, '14G ', 'Hunters Street', 4, 3, 4, 'cara@gmail.com', '0489416548', 'celebrities-mental-ilness-1058993518.jpg'),
(34, 'Ed', ' ', 'Sheeran', 9, '94A ', 'South Street', 3, 2, 3, 'ed@gmail.com', '0412648154', 'Ed.jpg'),
(35, 'Gigi', ' ', 'Hadid', 8, '15C ', 'John Street', 3, 3, 3, 'gigi@gmail.com', '0415678645', 'Gigi-Hadid.jpg'),
(36, 'Keanu', ' ', 'Reeves', 1, '15B ', 'Paul Street', 2, 2, 3, 'keanu@gmail.com', '0481649484', 'images.jfif'),
(37, 'Lucy', ' ', 'Boynton', 8, '41B ', 'Smith Street', 4, 4, 3, 'lucy@gmail.com', '0412648125', 'Lucy-Boynton.jpg'),
(38, 'Nick', ' ', 'Jonas', 9, '56 D ', 'William Street', 4, 2, 2, 'nick@gmail.com', '0456224789', 'nick-jonas-photo-420x420-gea62612-1461381911.jpg'),
(39, 'Priyanka', ' ', 'Chopra', 2, '41 S ', 'Jonas Street', 4, 4, 3, 'priyanka@gmail.com', '0412534876', 'priyanka.jpg'),
(40, 'Robin', ' ', 'Williams', 1, '87G ', 'Harris Street', 3, 3, 4, 'robin@gmail.com', '0487652134', 'Robin_Williams_-CC-Eva-Rinaldi-.jpg'),
(41, 'Selena', ' ', 'Gomez', 9, '56N ', 'Michael Street', 4, 3, 3, 'selena@gmail.com', '0489154187', 'Selena-Gomez.jpg'),
(43, 'Hrithik', ' ', 'Roshan', 1, '14T', 'Rawson Street', 3, 3, 3, 'hrithinkroshan@gmail.com', '0481648315', '26-Hrithik-Roshan-1.jpg'),
(44, 'Johnny', ' ', 'Depp', 1, '41 R', 'Maple Street', 4, 2, 4, 'Johnny@gmail.com', '0481648315', '442px-JohnnyDeppOct2011.jpg'),
(45, 'Scarlet', ' ', 'Johannson', 2, '46 E', 'Malibu Street', 3, 3, 3, 'scarlet@gmail.com', '0451687621', '105755683-1550853148548gettyimages-109478107.jpeg'),
(46, 'Angelina', ' ', 'Jolie', 2, '41W', 'Scarlet Street', 4, 2, 5, 'angelina@gmail.com', '0456879154', '140140193.jpg'),
(47, 'Chris', ' ', 'Hemsworth', 1, '14H ', 'John Street', 3, 1, 5, 'chris@gmail.com', '0456178944', '1581534626255_127160c6d45.webp'),
(48, 'William', ' ', 'Dafoe', 1, '14S', 'Hopkins Street', 3, 3, 2, 'william@gmail.com', '0458971654', 'download (1).jfif'),
(49, 'Mark', ' ', 'Ruffalo', 1, '97A', 'Charles Street', 3, 2, 3, 'mark@gmail.com', '0465871347', 'download.jfif'),
(50, 'Leonardo', ' ', 'DiCaprio', 1, '23A ', 'Scarlet Street', 4, 2, 2, 'leonardo@gmail.com', '0456874598', 'images (1).jfif'),
(51, 'Jim', ' ', 'Carrey', 1, '18G', 'Malibu Street', 4, 4, 4, 'jim@gmail.com', '0458975168', 'images (2).jfif'),
(52, 'Jennifer', ' ', 'Lawrence', 2, '98B', 'Hopkins Street', 3, 3, 3, 'jennifer@gmail.com', '0456589754', 'images (3).jfif'),
(53, 'Keira', ' ', 'Knightley', 2, '46D', 'Rawson Street', 3, 7, 3, 'keira@gmail.com', '04615987654', 'KeiraKnightly.jpg'),
(54, 'Emma', ' ', 'Stone', 2, '48C', 'Scarlet Street', 2, 2, 4, 'emmastone@gmail.com', '0416975354', 'x-1-1200x800.jpg'),
(55, 'John', ' ', 'Abraham', 1, '14B', 'Charles Street', 2, 3, 3, 'johnabraham@gmail.com', '0456781648', '1dfe6c87d253cafed1126db003b985c1.jpg'),
(56, 'Amitabh', ' ', 'Bachchan', 1, '18S', 'Rawson Street', 5, 5, 2, 'amitjee@gmail.com', '0456871679', '190px-AmitabhBachchan07.jpg'),
(57, 'Rishi', ' ', 'Kapoor', 1, '78B', 'Scarlet Street', 2, 3, 3, 'rishikapoor@gmail.com', '0497861561', '12202942-3x2-xlarge.jpg'),
(58, 'Anil', ' ', 'Kapoor', 1, '14S', 'Rawson Street', 2, 2, 1, 'anilkapoor@gmail.com', '0469871256', 'Anil-Kapoor.jpg'),
(59, 'Ranbir', ' ', 'Kapoor', 1, '78E', 'Hopkins Street', 2, 3, 3, 'ranbirkapoor@gmail.com', '0458716487', 'Bollywood-actor10014.jpg'),
(60, 'Fawad', 'Afzal', 'Khan', 1, '18B', 'Rawson Street', 3, 3, 3, 'fawadkhan@gmail.com', '0478512354', 'hindustan-khoobsurat-promotion-.webp'),
(61, 'Ranveer', ' ', 'Singh', 1, '14T', 'Hopkins Street', 3, 4, 3, 'ranveersingh@gmail.com', '0405641584', 'i656mages (1).jfif'),
(63, 'Amir', ' ', 'Khan', 1, '48S', 'Hopkins Street', 3, 3, 3, 'amirkhan@gmail.com', '045898781', 'images (46542).jfif'),
(64, 'Kader', ' ', 'Khan', 1, '18B ', 'Charles Street', 4, 4, 3, 'kaderkhan@gmail.com', '0456781264', '26-Hrithik-Roshan-1.jpg'),
(65, 'Ajay', ' ', 'Devgan', 1, '14B', 'Rawson Street', 4, 4, 3, 'ajaydevgan@gmail.com', '0487135487', 'main-qimg-611e11f.webp'),
(66, 'Irfan', ' ', 'Khan', 1, '49 C', 'Charles Street', 4, 2, 5, 'irfankhan@gmail.com', '0456971648', 'maxresdefault.jpg'),
(70, 'Michael', '', 'Jordan', 3, '20', 'Jordan st', 0, 6, 1, 'michael.jordan@gmail.com', '0425787587', 'michael-jordan.jpg'),
(79, 'Luiz', 'Alonso', 'Figo', 3, '10', 'Smith st', 0, 3, 1, 'luiz.figo@gmail.com', '0425787587', 'figo.jpg'),
(80, 'Tomasi', 'Alonso', 'Rosicky', 3, '16', 'Smith st', 6, 5, 2, 'tomasi.rosicky@gmail.com', '0425787534', 'rosicky.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `countryId` smallint(6) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `country`) VALUES
(1, 'Australia'),
(2, 'USA'),
(3, 'India'),
(4, 'China'),
(5, 'Singapore');

-- --------------------------------------------------------

--
-- Table structure for table `county_state`
--

CREATE TABLE `county_state` (
  `id` smallint(5) NOT NULL,
  `countyId` smallint(6) NOT NULL,
  `stateId` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `county_state`
--

INSERT INTO `county_state` (`id`, `countyId`, `stateId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 3, 16),
(13, 3, 17),
(14, 3, 18),
(15, 3, 19),
(16, 3, 20),
(17, 4, 12),
(18, 4, 13),
(19, 4, 14),
(20, 5, 21);

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE `occupation` (
  `occupationId` smallint(6) NOT NULL,
  `occupation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`occupationId`, `occupation`) VALUES
(1, 'Actor'),
(2, 'Actress'),
(3, 'Sports Person'),
(4, 'Athlete'),
(5, 'Politician'),
(6, 'Businessman'),
(7, 'Actress'),
(8, 'Model'),
(9, 'Singer');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateId` smallint(6) NOT NULL,
  `state` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateId`, `state`) VALUES
(1, 'NSW'),
(2, 'VIC'),
(3, 'QLD'),
(4, 'SA'),
(5, 'NT'),
(6, 'ACT'),
(7, 'WA'),
(8, 'California'),
(9, 'New York'),
(10, 'Texas'),
(11, ' Nevada'),
(12, ' Beijing'),
(13, ' Shanghai'),
(14, ' Hongkong'),
(16, ' Delhi'),
(17, ' Maharashtra'),
(18, ' Telangana'),
(19, ' Uttar Pradesh'),
(20, ' Bihar'),
(21, ' Central Region');

-- --------------------------------------------------------

--
-- Table structure for table `suburb_postcode`
--

CREATE TABLE `suburb_postcode` (
  `postcodeId` int(11) NOT NULL,
  `postcode` char(4) NOT NULL,
  `suburb` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suburb_postcode`
--

INSERT INTO `suburb_postcode` (`postcodeId`, `postcode`, `suburb`) VALUES
(1, '2142', 'Granville'),
(2, '2144', 'Auburn'),
(3, '2150', 'Parramatta'),
(4, '2560', 'Blair Athol'),
(5, '3175', 'Dandenong'),
(6, '3630', 'Shepparton'),
(7, '4340', 'Ashwell'),
(8, '6175', 'Singleton');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`celebrity_id`),
  ADD KEY `celebrity_state_id` (`stateId`),
  ADD KEY `celebrity_country_id` (`countryId`),
  ADD KEY `celebrity_occupation_id` (`occupationId`),
  ADD KEY `celebrities_ibfk_3` (`postcodeId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `county_state`
--
ALTER TABLE `county_state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countyId` (`countyId`),
  ADD KEY `stateId` (`stateId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `celebrities`
--
ALTER TABLE `celebrities`
  MODIFY `celebrity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `county_state`
--
ALTER TABLE `county_state`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `county_state`
--
ALTER TABLE `county_state`
  ADD CONSTRAINT `county_state_ibfk_1` FOREIGN KEY (`countyId`) REFERENCES `country` (`countryId`),
  ADD CONSTRAINT `county_state_ibfk_2` FOREIGN KEY (`stateId`) REFERENCES `state` (`stateId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
