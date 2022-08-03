-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2022 at 11:24 AM
-- Server version: 5.7.33
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `DepartmentShortName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `DepartmentCode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'แผนกบุคคล', 'HR', 'HR001', '2017-11-01 07:16:25'),
(2, 'แผนกไอที', 'IT', 'IT001', '2017-11-01 07:19:37'),
(3, 'แผนกปฏิบัติการ', 'OP', 'OP1', '2017-12-02 21:28:56'),
(4, 'แผนกแอดมิน', 'AD', 'AD001', '2022-07-28 09:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) CHARACTER SET utf8 NOT NULL,
  `FirstName` varchar(150) CHARACTER SET utf8 NOT NULL,
  `LastName` varchar(150) CHARACTER SET utf8 NOT NULL,
  `EmailId` varchar(200) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(180) CHARACTER SET utf8 NOT NULL,
  `Gender` enum('ชาย','หญิง','อื่นๆ') CHARACTER SET utf8 NOT NULL,
  `Dob` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Department` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `City` varchar(200) CHARACTER SET utf8 NOT NULL,
  `Country` varchar(150) CHARACTER SET utf8 NOT NULL,
  `Phonenumber` char(11) CHARACTER SET utf8 NOT NULL,
  `Status` int(1) NOT NULL,
  `Type_Employee` enum('พนักงานทั่วไป','แอดมิน') CHARACTER SET utf8 DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `Type_Employee`, `RegDate`) VALUES
(3, 'AD00000001', 'Admin', 'Admin', 'Natthawat.Suetrong@gmail.com', 'e3afed0047b08059d0fada10f400c1e5', 'ชาย', '9 March, 1998', 'แผนกแอดมิน', 'Thai', 'Thai', 'Thai', '0955796789', 1, 'แอดมิน', '2022-07-28 09:56:44'),
(4, 'EMP00000002', 'ทดลองใหม่', 'ทดลองใหม่', 'Natthawat@bangkoksync.com', 'a3852ba83d29081a054cebba4ea62db7', 'ชาย', '9 March, 1998', 'แผนกไอที', 'ไทย', 'ไทย', 'ไทย', '0955796789', 1, 'พนักงานทั่วไป', '2022-07-28 10:02:31'),
(8, 'AD00000002', 'Natthawat', 'Suetrong', 'Natthawat@gmail.com', '823914b1f862aec6618599c339f3dd22', 'ชาย', '09/03/1998', 'แผนกแอดมิน', '483/15 Narathiwat 30,Nonsi Road,Chongnonsri,Yannawai,Bangkok,Thailand 10120', 'Bangkok', 'Thailand', '0955796789', 1, 'แอดมิน', '2022-07-28 11:40:59'),
(9, 'EMP00000001', 'ทดสอบ', 'ทดสอบ', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'ชาย', '1 July, 2022', 'แผนกบุคคล', '483/15 Narathiwat 30,Nonsi Road,Chongnonsri,Yannawai,Bangkok,Thailand 10120', 'Bangkok', 'Thailand', '0955796789', 1, 'พนักงานทั่วไป', '2022-07-28 11:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) CHARACTER SET utf8 NOT NULL,
  `ToDate` varchar(120) CHARACTER SET utf8 NOT NULL,
  `FromDate` varchar(120) CHARACTER SET utf8 NOT NULL,
  `Description` mediumtext CHARACTER SET utf8 NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext CHARACTER SET utf8,
  `AdminRemarkDate` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `empid`) VALUES
(7, 'Casual Leave', '30/11/2017', '29/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-19 13:11:21', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 23:26:27 ', 2, 1, 1),
(8, 'Medical Leave test', '21/10/2017', '25/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-20 11:14:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-12-02 23:24:39 ', 1, 1, 1),
(9, 'Medical Leave test', '08/12/2017', '12/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 18:26:01', NULL, NULL, 0, 1, 2),
(10, 'Restricted Holiday(RH)', '25/12/2017', '25/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 08:29:07', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 14:06:12 ', 1, 1, 1),
(11, 'Casual Leave', '22/02/2022', '22/02/2022', 'sad', '2020-11-03 05:20:58', NULL, NULL, 0, 1, 1),
(12, 'Casual Leave', '22/02/2022', '22/02/2022', 'sad', '2020-11-03 05:52:49', NULL, NULL, 0, 1, 1),
(13, 'Medical Leave test', '16/07/2022', '16/07/2022', 'mflv[', '2022-07-16 10:18:21', NULL, NULL, 0, 0, 1),
(14, 'Medical Leave test', '16/07/2022', '16/07/2022', 'ทดสอบ', '2022-07-16 10:19:19', NULL, NULL, 0, 0, 1),
(15, 'Casual Leave', '16/07/2022', '17/07/2022', 'ทดสอบ', '2022-07-16 10:19:34', NULL, NULL, 0, 1, 1),
(16, 'Restricted Holiday(RH)', '16 July, 2022', '17 July, 2022', 'test', '2022-07-16 10:38:28', 'ddf', '2022-07-24 15:03:29 ', 2, 1, 1),
(17, 'ลาพักร้อน', '09/03/2022', '10/03/2022', 'ลา', '2022-07-28 13:48:52', NULL, NULL, 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Description` mediumtext CHARACTER SET utf8,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'ลาพักร้อน', 'ลาพักร้อน', '2017-11-01 12:07:56'),
(2, 'การลาป่วย', 'การลาป่วย', '2017-11-06 13:16:09'),
(3, 'วันหยุดนักขัตฤกษ์', 'วันหยุดนักขัตฤกษ์', '2017-11-06 13:16:38'),
(4, 'ลากิจ', 'ลากิจ', '2022-07-28 11:47:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
