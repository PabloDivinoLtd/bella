-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2020 at 12:11 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patients`
--

-- --------------------------------------------------------

--
-- Table structure for table `insurancePolicy`
--

CREATE TABLE `insurancePolicy` (
  `id` int(20) NOT NULL,
  `policyName` varchar(20) NOT NULL,
  `insurerID` int(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `premiumAmount` varchar(20) NOT NULL,
  `sumInsured` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurancePolicy`
--

INSERT INTO `insurancePolicy` (`id`, `policyName`, `insurerID`, `description`, `premiumAmount`, `sumInsured`) VALUES
(1, 'Heart Policy', 1, 'We offer heart surgeries to infants and old age who are sick.', '54200', '2000000'),
(2, 'Life Assurance', 2, 'This offers assurance for people below the age of 54 years and so on.', '600000', '24000000'),
(3, 'Liberty 24Plus', 7, 'This covers anyone above the age of 24 years from insurance loss', '45545', '64000');

-- --------------------------------------------------------

--
-- Table structure for table `insurers`
--

CREATE TABLE `insurers` (
  `id` int(20) NOT NULL,
  `insurerName` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurers`
--

INSERT INTO `insurers` (`id`, `insurerName`, `address`) VALUES
(1, 'AAR Insurance', 'Nairobi, Kenya'),
(2, 'APA Insurance', 'Nairobi, Kenya'),
(3, 'AIG Insurance', 'Thika, Kenya'),
(4, 'CIC Life', 'Nairobi Kenya'),
(5, 'ICEA Lion', 'Nairobi, Kenya'),
(6, 'Kenya Orient', 'Nanyuki, Kenya'),
(7, 'Liberty Life Insuran', 'Nairobi, Kenya'),
(8, 'Jubilee Insurance', 'Nairobi, Kenya'),
(9, 'UAP Insurance', 'Nairobi, Kenya');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(20) NOT NULL,
  `patientID` int(20) NOT NULL,
  `invoiceDate` varchar(20) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `paymentStatus` tinyint(1) NOT NULL DEFAULT '0',
  `serviceDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `patientID`, `invoiceDate`, `amount`, `paymentStatus`, `serviceDescription`) VALUES
(1, 13, '2020-07-12', '15472', 0, ' For injections'),
(2, 12, '2020-07-12', '20000', 0, ' For heart transplant'),
(3, 11, '2020-07-12', '5000', 1, ' Consultation'),
(4, 11, '2020-07-13', '20000', 0, ' Injections for vitamins'),
(5, 1, '2020-07-23', '16000', 0, ' UltraSound and Pharmacy Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `age` int(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `bloodGroup` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `firstname`, `lastname`, `age`, `gender`, `phoneNumber`, `bloodGroup`, `address`) VALUES
(1, 'Bella', 'Njoki', 25, 'female', '0754236548', 'A', 'Nairobi Kenya'),
(2, 'John', 'DeMethew', 40, 'Male', '0732569841', 'B', 'Muranga, Kenya'),
(3, 'Mary', 'Wambui', 50, 'female', '0712458752', 'A', 'Nanyuki Kenya'),
(4, 'Dr Collins', 'Oduor', 40, 'Male', '0785365248', 'B+', 'Nairobi Kenya'),
(5, 'Prof Dalton ', 'Ndirangu', 50, 'Male', '0720321458', 'A', 'Nairobi Kenya'),
(6, 'James', 'Orengo', 55, 'Male', '0725487325', 'O', 'Kisumu Kenya'),
(7, 'HE Uhuru', 'Kenyatta', 54, 'Male', '0710242365', 'A', 'Nairobi Kenya'),
(8, 'Mitchelle', 'Njeri', 16, 'female', '0724569875', 'B', 'Nanyuki Kenya');

-- --------------------------------------------------------

--
-- Table structure for table `prints`
--

CREATE TABLE `prints` (
  `id` int(20) NOT NULL,
  `patientID` int(20) DEFAULT NULL,
  `printID` int(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scannerstatus`
--

CREATE TABLE `scannerstatus` (
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scannerstatus`
--

INSERT INTO `scannerstatus` (`status`) VALUES
(0),
(0),
(0),
(0),
(0),
(0),
(1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` varchar(50) NOT NULL,
  `postingdate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(20) NOT NULL,
  `patientID` int(20) NOT NULL,
  `policyID` int(20) NOT NULL,
  `subscriptionDate` date NOT NULL,
  `balance` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `patientID`, `policyID`, `subscriptionDate`, `balance`) VALUES
(1, 1, 1, '2020-07-23', 2000000),
(2, 4, 1, '2020-07-23', 2000000),
(3, 6, 3, '2020-07-23', 64000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `loginid` varchar(250) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `loginid`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insurancePolicy`
--
ALTER TABLE `insurancePolicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurers`
--
ALTER TABLE `insurers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prints`
--
ALTER TABLE `prints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insurancePolicy`
--
ALTER TABLE `insurancePolicy`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `insurers`
--
ALTER TABLE `insurers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `prints`
--
ALTER TABLE `prints`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
