-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2019 at 09:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auto`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertuser` (IN `firstname` VARCHAR(45), IN `lastname` VARCHAR(45), IN `apassword` VARCHAR(45), IN `atype` VARCHAR(45), IN `address` VARCHAR(45), IN `adharno` INT, IN `mobilenumber` INT, IN `gender` VARCHAR(45), IN `adate` VARCHAR(45), IN `email` VARCHAR(45), IN `autonumber` VARCHAR(45), IN `photo` VARCHAR(45), IN `adharcard` VARCHAR(45), IN `license` VARCHAR(45), IN `region` VARCHAR(45), IN `regionid` INT)  BEGIN
declare lastuserid int;

if atype='RegionAdmin' then 
INSERT INTO `user`(`first_name`, `last_name`, `user_password`, `user_type`, `address`, `adhar_no`, `mob_no`, `gender`, `date`, email,photo,adharcard,license,`status`) 
VALUES (firstname,lastname,sha(apassword),atype,address,adharno,mobilenumber,gender,adate,email,photo,adharcard,license,'Approved');
select last_insert_id() into lastuserid from dual;
insert into region(admin_id,region_name) values(lastuserid,region);
end if;


if atype='RikshaOwner' then 
INSERT INTO `user`(`first_name`, `last_name`, `user_password`, `user_type`, `address`, `adhar_no`, `mob_no`, `gender`, `date`, email,photo,adharcard,license) VALUES(firstname,lastname,sha(apassword),atype,address,adharno,mobilenumber,gender,adate,email,photo,adharcard,license);
select last_insert_id() into lastuserid from dual;
insert into auto(driver_id, auto_no,auto_approval_status,region_id) values(lastuserid,autonumber,'Pending',regionid);
end if;

if atype='Customer' then 
INSERT INTO `user`(`first_name`, `last_name`, `user_password`, `user_type`, `address`, `adhar_no`, `mob_no`, `gender`, `date`, email,photo,adharcard,`status`) VALUES (firstname,lastname,sha(apassword),atype,address,adharno,mobilenumber,gender,adate,email,photo,adharcard,'Approved');
end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `auto`
--

CREATE TABLE `auto` (
  `auto_id` int(11) NOT NULL COMMENT 'id of auto',
  `driver_id` int(11) NOT NULL COMMENT 'id of driver',
  `region_id` int(11) NOT NULL,
  `auto_no` varchar(45) NOT NULL COMMENT 'number of auto',
  `union_id` int(11) NOT NULL COMMENT 'id of union',
  `auto_approval_status` varchar(45) NOT NULL COMMENT 'approvel status of auto',
  `auto_availablity_status` varchar(45) NOT NULL COMMENT 'availablity status of auto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auto`
--

INSERT INTO `auto` (`auto_id`, `driver_id`, `region_id`, `auto_no`, `union_id`, `auto_approval_status`, `auto_availablity_status`) VALUES
(3, 6, 1, 'MH07A1555', 0, 'Approved', 'Available'),
(4, 7, 1, 'MH04N0426', 0, 'Approved', 'Available'),
(6, 10, 1, 'MH08H1998', 0, 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `autolocation`
--

CREATE TABLE `autolocation` (
  `auto_id` int(11) NOT NULL COMMENT 'id of auto',
  `auto_longitude` float NOT NULL COMMENT 'longitude of auto',
  `auto_lattitude` float NOT NULL COMMENT 'lattitude of auto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL COMMENT 'id of bill',
  `trip_id` int(11) NOT NULL COMMENT 'id of trip',
  `amount` int(11) NOT NULL COMMENT 'amount'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `driver_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `expenses_amount` int(11) NOT NULL,
  `expenses_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`driver_id`, `date`, `expenses_amount`, `expenses_type`) VALUES
(0, '0000-00-00', 100, 'abc'),
(0, '0000-00-00', 100, 'fthth'),
(0, '2019-03-26', 1000, 'yeryre'),
(0, '2019-03-26', 100, 'petrol'),
(0, '2019-03-26', 100, 'servicing'),
(2, '2019-03-27', 100, 'servicing'),
(2, '2019-03-27', 1333, 'other'),
(5, '2019-03-27', 300, 'petrol'),
(7, '2019-03-27', 1000, 'petrol'),
(7, '2019-03-28', 100, 'petrol'),
(5, '2019-03-29', 100, 'servicing'),
(7, '2019-03-31', 100, 'servicing'),
(7, '2019-03-31', 3000, 'other'),
(7, '2019-03-31', 12200, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL COMMENT 'feedback id',
  `customer_id` int(11) NOT NULL COMMENT 'id of customer',
  `trip_id` int(11) NOT NULL COMMENT 'id of auto',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT 'customer ratings',
  `comment` varchar(50) NOT NULL COMMENT 'customer comments'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `customer_id`, `trip_id`, `rating`, `comment`) VALUES
(1, 4, 3, 5, 'tooo goood'),
(2, 8, 4, 5, 'very good'),
(3, 4, 7, 3, 'Awesome ride'),
(4, 4, 9, 5, 'good'),
(5, 4, 10, 4, 'very very good...!');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL COMMENT 'id of region',
  `admin_id` int(11) NOT NULL,
  `region_name` varchar(20) NOT NULL COMMENT 'name of region'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `admin_id`, `region_name`) VALUES
(1, 1, 'kudal');

-- --------------------------------------------------------

--
-- Table structure for table `regionlocation`
--

CREATE TABLE `regionlocation` (
  `region_id` int(11) NOT NULL COMMENT 'id of region',
  `region_longitude` float NOT NULL COMMENT 'longitude of region',
  `region-lattitude` float NOT NULL COMMENT 'lattitude of region'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `source` varchar(45) NOT NULL,
  `destination` varchar(45) NOT NULL,
  `request_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `customer_id`, `auto_id`, `source`, `destination`, `request_status`) VALUES
(1, 4, 0, 'kudal', 'pune', 'Created'),
(2, 4, 0, 'kudal', 'pune', 'Created'),
(3, 4, 0, 'kudal', 'pune', 'Created'),
(4, 4, 1, 'kudal', 'pune', 'Completed'),
(5, 4, 0, 'kudal', 'pune', 'Created'),
(6, 4, 2, 'kudal', 'pune', 'Pending'),
(7, 4, 2, 'kudal', 'pune', 'Completed'),
(8, 4, 2, 'kudal', 'pune', 'Pending'),
(9, 4, 0, 'kudal', 'pune', 'Created'),
(10, 4, 0, 'kudal', 'pune', 'Created'),
(11, 4, 0, 'kudal', 'pune', 'Created'),
(12, 4, 4, 'kudal', 'pune', 'Completed'),
(13, 8, 4, 'kolhapur', 'sawantwadi', 'Completed'),
(14, 4, 4, 'kudal', 'oros', 'Completed'),
(15, 8, 3, 'mangaon', 'vengurla', 'Completed'),
(16, 4, 5, 'zarap', 'kudal', 'Completed'),
(17, 4, 0, 'zarap', 'kudal', 'Created'),
(18, 4, 4, 'zarap', 'kudal', 'Completed'),
(19, 4, 4, 'kudal', 'kudal', 'Completed'),
(20, 4, 4, 'kudal', 'kudal', 'Completed'),
(21, 4, 4, 'kolhapur', 'pune', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `trip_cost` int(11) NOT NULL,
  `trip_date` date NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`trip_id`, `trip_cost`, `trip_date`, `request_id`) VALUES
(1, 100, '0000-00-00', 4),
(2, 100, '2019-03-27', 7),
(3, 1000, '0000-00-00', 12),
(4, 100, '0000-00-00', 13),
(5, 100, '0000-00-00', 14),
(6, 10000, '0000-00-00', 15),
(7, 300, '0000-00-00', 16),
(8, 100, '2019-03-31', 17),
(9, 100, '2019-03-31', 20),
(10, 400, '2019-03-31', 21);

-- --------------------------------------------------------

--
-- Table structure for table `union`
--

CREATE TABLE `union` (
  `union_id` int(11) NOT NULL COMMENT 'id of union',
  `union_admin_id` int(11) NOT NULL COMMENT 'id of union admin',
  `union_address` varchar(30) NOT NULL COMMENT 'address of union',
  `region_id` int(11) NOT NULL COMMENT 'id of region'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unionlocation`
--

CREATE TABLE `unionlocation` (
  `union_id` int(11) NOT NULL COMMENT 'id of union',
  `union_longitude` float NOT NULL COMMENT 'longitude of union',
  `union_lattitude` float NOT NULL COMMENT 'lattitude of union'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL COMMENT 'id of user',
  `first_name` varchar(30) NOT NULL COMMENT 'name of user',
  `last_name` varchar(30) NOT NULL,
  `user_password` varchar(75) NOT NULL COMMENT 'password of user',
  `user_type` varchar(45) NOT NULL COMMENT 'type of user',
  `photo` varchar(75) NOT NULL,
  `address` varchar(75) NOT NULL,
  `adharcard` varchar(75) NOT NULL,
  `license` varchar(75) DEFAULT NULL,
  `adhar_no` varchar(45) NOT NULL,
  `mob_no` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `email` varchar(75) NOT NULL,
  `auto_no` varchar(30) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_password`, `user_type`, `photo`, `address`, `adharcard`, `license`, `adhar_no`, `mob_no`, `gender`, `date`, `email`, `auto_no`, `status`) VALUES
(1, 'Suraj', 'Salavi', '9a1f4bccc953a67086fc76b1c0e0a9272aae2dcc', 'RegionAdmin', 'SurajSalavi-photo.jpg', 'SURAJ ANANT SALAVI,, MANDESHET, GOTHOS,, Sind', 'SurajSalavi-adharcard.jpg', 'SurajSalavi-license.jpg', '1256345684', '2147483647', 'Male', '2019-03-05', 'surajsalavi4@gmail.com', NULL, 'Approved'),
(4, 'Suman', 'Rawool', '4615752cd4d36e5d41b2b09f4606c14f8c134765', 'Customer', 'SumanRawool-photo.jpg', 'shivapur', 'SumanRawool-adharcard.jpg', NULL, '2147483647', '2147483647', 'Male', '2019-03-22', 'suman@gmail.com', NULL, 'Approved'),
(6, 'Rohit', 'Sawant', '4db4f94daf2dc27ebfede843de2aed77c88a822e', 'RikshaOwner', 'RohitSawant-photo.jpg', 'Malvan', 'RohitSawant-adharcard.jpg', 'RohitSawant-license.jpg', '2147483647', '2147483647', 'Male', '2019-03-15', 'rohit@gmail.com', NULL, 'Approved'),
(7, 'Nikhil', 'Rawool', 'd36e671a37e64603e408883ed9be43ba9b8ccf79', 'RikshaOwner', 'NikhilRawool-photo.jpg', 'Sawantwadi', 'NikhilRawool-adharcard.jpg', 'NikhilRawool-license.jpg', '2147483647', '2147483647', 'Male', '2019-03-16', 'nikhil@gmail.com', NULL, 'Approved'),
(8, 'Mandar', 'Naik', '43597469e30228303714387c50397d22c540fa42', 'Customer', 'MandarNaik-photo.png', 'mandkuli', 'MandarNaik-adharcard.png', NULL, '2147483647', '2147483647', 'Male', '2019-03-21', 'mandar@gmail.com', NULL, 'Approved'),
(10, 'Ketan', 'Joshi', '3c2924fb731f8d95e0ccc785b82a8e0d085b49a9', 'RikshaOwner', 'KetanJoshi-photo.png', 'Zarap', 'KetanJoshi-adharcard.png', 'KetanJoshi-license.png', '1234567891', '2147483647', 'Male', '2019-03-15', 'ketan@gmail.com', NULL, 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `union-id` (`union_id`),
  ADD KEY `driver_id_2` (`driver_id`),
  ADD KEY `driver_id_3` (`driver_id`);

--
-- Indexes for table `autolocation`
--
ALTER TABLE `autolocation`
  ADD KEY `auto_id` (`auto_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `auto_id` (`trip_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `regionlocation`
--
ALTER TABLE `regionlocation`
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `union`
--
ALTER TABLE `union`
  ADD PRIMARY KEY (`union_id`),
  ADD KEY `union_admin_id` (`union_admin_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `unionlocation`
--
ALTER TABLE `unionlocation`
  ADD KEY `union_id` (`union_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto`
--
ALTER TABLE `auto`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of auto', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'feedback id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of region', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of user', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
