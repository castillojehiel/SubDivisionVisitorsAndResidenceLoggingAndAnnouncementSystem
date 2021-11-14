-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2021 at 01:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fiestahomesdb`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetDataCenterCompleteName` (`ID` INT) RETURNS VARCHAR(512) CHARSET utf8mb4 RETURN (SELECT CONCAT(FirstName, ' ', MiddleName, ' ', LastName) as UserCompleteName FROM DataCenter WHERE DataCenterID = `ID`)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetTableColumns` (`tblName` VARCHAR(255), `tblAlias` VARCHAR(255)) RETURNS VARCHAR(512) CHARSET utf8mb4 RETURN (SELECT CONCAT('tblAlias','.',`COLUMN_NAME`)  as ColumnNames
        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
        WHERE `TABLE_SCHEMA`='fiestahomesdb' 
                AND `TABLE_NAME`='tblName'
        )$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetUserCompleteName` (`ID` INT) RETURNS VARCHAR(512) CHARSET utf8mb4 RETURN (SELECT CONCAT(FirstName, ' ', MiddleName, ' ', LastName) as UserCompleteName FROM useraccount WHERE UserID = `ID`)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `AnnouncementID` int(11) NOT NULL,
  `ATID` int(11) DEFAULT NULL,
  `Title` varchar(512) DEFAULT NULL,
  `Details` varchar(4000) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `isPublished` bit(1) DEFAULT NULL,
  `PublishedBy` int(11) DEFAULT NULL,
  `PublishedDateTime` datetime DEFAULT NULL,
  `UnpublishedBy` int(11) DEFAULT NULL,
  `UnpublishedDateTime` datetime DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`AnnouncementID`, `ATID`, `Title`, `Details`, `isActive`, `isPublished`, `PublishedBy`, `PublishedDateTime`, `UnpublishedBy`, `UnpublishedDateTime`, `ExpiryDate`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(1, 1, 'TEST - update', 'TEST - update', b'1', b'1', 1, '2021-10-24 16:01:24', 1, '2021-10-24 15:45:52', '2021-10-29', 1, '2021-10-24 08:31:00', 1, '2021-10-24 09:20:11'),
(2, 1, 'Test Announcement', 'this is a test announcement', b'1', b'1', 2, '2021-11-08 08:13:13', NULL, NULL, '2021-11-13', 1, '2021-11-08 08:13:10', NULL, NULL),
(3, 3, 'this is a test announcement', 'this is a test announcement', b'1', b'0', 3, '2021-11-11 20:06:27', 3, '2021-11-11 20:06:43', '2021-11-19', 1, '2021-11-11 20:06:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcementtypes`
--

CREATE TABLE `announcementtypes` (
  `ATID` int(11) NOT NULL,
  `Description` varchar(512) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcementtypes`
--

INSERT INTO `announcementtypes` (`ATID`, `Description`, `isActive`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(1, 'AnnouncementType 1', b'1', 1, '2021-10-22 06:11:58', 1, '2021-10-22 06:12:26'),
(2, 'AnnouncementType 2', b'1', 1, '2021-10-22 06:12:32', NULL, NULL),
(3, 'Type 3', b'1', 1, '2021-11-11 19:54:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blockedvistors`
--

CREATE TABLE `blockedvistors` (
  `BVID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `datacenter`
--

CREATE TABLE `datacenter` (
  `DataCenterID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `ContactNo` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `HouseHoldID` int(11) DEFAULT NULL,
  `QRCode` varchar(512) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `isResident` bit(1) DEFAULT NULL,
  `Userpass` varchar(255) NOT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `ResidentPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datacenter`
--

INSERT INTO `datacenter` (`DataCenterID`, `FirstName`, `MiddleName`, `LastName`, `Suffix`, `Gender`, `BirthDate`, `ContactNo`, `EmailAddress`, `HouseHoldID`, `QRCode`, `isActive`, `isResident`, `Userpass`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`, `ResidentPassword`) VALUES
(1, 'test', 'test', 'tes', 'test', 'Male', '2021-09-02', 'test', 'test@gmail.com', 0, 'ADMIN0001', b'1', b'1', 'admin', 1, '2021-09-01 03:59:57', 1, '2021-10-27 03:55:32', ''),
(8, 'ResidentData', 'Test', 'ResidentData', '', 'Male', '2021-10-21', '09123123', 'test@gmail.com', 3, 'RES00000008', b'1', b'1', 'admin', 1, '2021-10-28 19:21:21', NULL, NULL, ''),
(9, 'test', 'test', 'test', 'test', 'Male', '2021-10-01', 'test', 'test@gmail.com', NULL, 'VIS00000009', b'1', b'0', 'admin', 1, '2021-10-28 19:23:31', NULL, NULL, ''),
(10, 'res1', 'res1', 'res1', 'res1', 'Male', '2021-11-01', 'res1', 'res1@gmail.com', 3, 'RES00000010', b'1', b'1', '', 1, '2021-11-08 07:15:56', NULL, NULL, ''),
(11, 'dasd', 'asdasd', 'asdad', 'asdasd', 'Male', '2021-11-01', 'asdas', 'asdasda', 3, 'RES00000011', b'1', b'1', '', 8, '2021-11-11 02:38:20', NULL, NULL, ''),
(12, 'Resident1', 'Resident1 - update', 'Resident1', 'Resident1', 'Male', '2021-09-01', 'Resident1', 'Resident1@gmail.com', 4, 'RES00000012', b'1', b'1', '', 1, '2021-11-11 19:55:55', 1, '2021-11-11 19:56:30', ''),
(13, 'Visitor1', 'Visitor1', 'Visitor1', 'Visitor1', 'Male', '2021-11-04', 'Visitor1', 'Visitor1@gmail.com', NULL, 'VIS00000013', b'1', b'0', '0', 1, '2021-11-11 19:59:33', NULL, NULL, ''),
(14, 'Member1', 'Member1', 'Member1', 'Member1', 'Male', '2021-11-01', 'Member1', 'Member1@gmail.com', 3, 'RES00000014', b'1', b'1', '', 8, '2021-11-11 20:20:58', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `gateassignments`
--

CREATE TABLE `gateassignments` (
  `GAID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `GateID` int(11) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gatepasslogs`
--

CREATE TABLE `gatepasslogs` (
  `GPLogID` int(11) NOT NULL,
  `DataCenterID` int(11) DEFAULT NULL,
  `QRCode` varchar(255) DEFAULT NULL,
  `LogType` varchar(255) DEFAULT NULL,
  `LoggerType` varchar(255) DEFAULT NULL,
  `ScannedBy` int(11) DEFAULT NULL,
  `TargetHouseHoldID` int(11) DEFAULT NULL,
  `PurposeOfLog` varchar(512) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gatepasslogs`
--

INSERT INTO `gatepasslogs` (`GPLogID`, `DataCenterID`, `QRCode`, `LogType`, `LoggerType`, `ScannedBy`, `TargetHouseHoldID`, `PurposeOfLog`, `CreatedBy`, `CreatedDateTime`) VALUES
(2, 8, 'RES00000008', NULL, NULL, 3, NULL, NULL, 3, '2021-10-29 00:02:48'),
(3, 8, 'RES00000008', NULL, NULL, 3, NULL, NULL, 3, '2021-10-29 00:26:25'),
(4, 9, 'VIS00000009', NULL, NULL, 0, NULL, NULL, 0, '2021-10-29 00:55:35'),
(5, 8, 'RES00000008', NULL, NULL, 3, NULL, NULL, 3, '2021-11-01 18:01:26'),
(6, 8, 'RES00000008', NULL, NULL, 3, NULL, NULL, 3, '2021-11-01 18:16:23'),
(7, 8, 'RES00000008', NULL, NULL, 3, NULL, NULL, 3, '2021-11-11 20:25:27'),
(8, 8, 'RES00000008', NULL, NULL, 3, NULL, NULL, 3, '2021-11-11 20:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `gates`
--

CREATE TABLE `gates` (
  `GateID` int(11) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `householdcontactpersons`
--

CREATE TABLE `householdcontactpersons` (
  `HCPID` int(11) NOT NULL,
  `HouseHoldID` int(11) DEFAULT NULL,
  `ResidentID` int(11) DEFAULT NULL,
  `PriorityOrder` int(11) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT current_timestamp(),
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `householdcontactpersons`
--

INSERT INTO `householdcontactpersons` (`HCPID`, `HouseHoldID`, `ResidentID`, `PriorityOrder`, `isActive`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(12, 3, 8, NULL, b'1', 1, '2021-11-08 07:16:09', NULL, NULL),
(15, 4, 12, NULL, b'1', 1, '2021-11-11 20:02:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `households`
--

CREATE TABLE `households` (
  `HouseHoldID` int(11) NOT NULL,
  `HouseHoldName` varchar(255) DEFAULT NULL,
  `HouseNo` varchar(255) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`HouseHoldID`, `HouseHoldName`, `HouseNo`, `Street`, `isActive`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(3, 'Test House Hold Name', 'Test House NO', 'Streeettttt', b'1', 1, '2021-10-07 05:09:10', 1, '2021-11-08 07:16:08'),
(4, 'dela cruz', 'No 72', 'Stork str', b'1', 1, '2021-11-11 20:02:03', 1, '2021-11-11 20:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `reporttypes`
--

CREATE TABLE `reporttypes` (
  `ReportTypeID` int(11) NOT NULL,
  `Description` varchar(512) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reporttypes`
--

INSERT INTO `reporttypes` (`ReportTypeID`, `Description`, `isActive`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(9, 'Report Type 1 ', b'1', 1, '2021-10-17 20:31:42', 1, '2021-10-17 20:58:28'),
(10, 'Report Type 2', b'1', 1, '2021-10-17 20:32:01', 1, '2021-10-17 20:55:43'),
(11, 'Report Type 3', b'0', 1, '2021-10-17 20:58:40', 1, '2021-10-17 20:59:55'),
(12, 'Report Type 4', b'1', 1, '2021-11-11 20:12:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `residentreports`
--

CREATE TABLE `residentreports` (
  `ReportID` int(11) NOT NULL,
  `ReporterID` int(11) DEFAULT NULL,
  `ReportTypeID` int(11) DEFAULT NULL,
  `ReportDetails` varchar(512) DEFAULT NULL,
  `ReportStatus` varchar(255) DEFAULT NULL,
  `ReportRemarks` varchar(255) DEFAULT NULL,
  `ReportAcknowledgementRemarks` varchar(512) DEFAULT NULL,
  `AcknowledgedBy` varchar(11) DEFAULT NULL,
  `AcknowledgedDateTime` datetime(6) DEFAULT NULL,
  `ReportResolveRemarks` varchar(4000) DEFAULT NULL,
  `ResolvedBy` varchar(11) DEFAULT NULL,
  `ResolvedDateTime` datetime(6) DEFAULT NULL,
  `RejectionRemarks` varchar(4000) DEFAULT NULL,
  `RejectedBy` int(11) DEFAULT NULL,
  `RejectedDateTime` datetime(6) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residentreports`
--

INSERT INTO `residentreports` (`ReportID`, `ReporterID`, `ReportTypeID`, `ReportDetails`, `ReportStatus`, `ReportRemarks`, `ReportAcknowledgementRemarks`, `AcknowledgedBy`, `AcknowledgedDateTime`, `ReportResolveRemarks`, `ResolvedBy`, `ResolvedDateTime`, `RejectionRemarks`, `RejectedBy`, `RejectedDateTime`, `isActive`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(1, 1, 9, 'test', 'RESOLVED', NULL, 'test', '1', '2021-10-21 05:54:47.000000', 'test', '1', '2021-10-21 05:58:47.000000', NULL, NULL, NULL, b'1', 1, '2021-10-20 01:03:30', NULL, '2021-10-20 01:03:30'),
(2, 1, 9, 'testtttt', 'RESOLVED', NULL, 'test', '1', '2021-11-11 20:04:30.000000', 'test - ', '1', '2021-11-11 20:04:54.000000', NULL, NULL, NULL, b'1', 1, '2021-10-28 15:09:47', NULL, NULL),
(3, 1, 10, 'Test Submit Report type 2', 'ACKNOWLEDGE', NULL, 'TEST', '1', '2021-10-28 15:21:27.000000', NULL, NULL, NULL, NULL, NULL, NULL, b'1', 1, '2021-10-28 15:11:26', NULL, NULL),
(4, 8, 10, 'testt - update', 'ACKNOWLEDGE', NULL, 'test', '1', '2021-11-11 20:18:47.000000', NULL, NULL, NULL, NULL, NULL, NULL, b'1', 8, '2021-11-08 07:27:59', 8, '2021-11-08 08:12:05'),
(5, 8, 9, 'test - update', 'RESOLVED', NULL, 'test acknowledged', '1', '2021-11-11 00:48:26.000000', 'test Resolved', '1', '2021-11-11 00:49:32.000000', NULL, NULL, NULL, b'1', 8, '2021-11-11 00:47:40', 8, '2021-11-11 00:47:58'),
(6, 8, 9, 'zasdadsas as da', 'REJECT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 1, '2021-11-11 20:19:40.000000', b'1', 8, '2021-11-11 20:19:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scannerlogs`
--

CREATE TABLE `scannerlogs` (
  `ScanID` int(11) NOT NULL,
  `Module` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ScanValue` varchar(255) NOT NULL,
  `CreatedDateTime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scannerlogs`
--

INSERT INTO `scannerlogs` (`ScanID`, `Module`, `UserID`, `ScanValue`, `CreatedDateTime`) VALUES
(1, 'GATEPASS', 3, 'RES00000008', '2021-11-01 18:16:23.000000'),
(2, 'GATEPASS', 3, '', '2021-11-01 19:29:48.000000'),
(3, 'GATEPASS', 3, 'VIS00000009', '2021-11-01 19:30:13.000000'),
(4, 'GATEPASS', 3, 'VIS00000009', '2021-11-01 19:30:50.000000'),
(5, 'GATEPASS', 3, 'VIS00000009', '2021-11-02 05:36:14.000000'),
(6, 'GATEPASS', 3, 'VIS00000009', '2021-11-10 23:33:18.000000'),
(7, 'GATEPASS', 0, 'VIS00000009', '2021-11-10 23:33:30.000000'),
(8, 'GATEPASS', 0, 'VIS00000009', '2021-11-10 23:35:04.000000'),
(9, 'GATEPASS', 0, 'VIS00000009', '2021-11-11 00:22:51.000000'),
(10, 'GATEPASS', 0, 'VIS00000009', '2021-11-11 00:45:54.000000'),
(11, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:01:46.000000'),
(12, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:04:12.000000'),
(13, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:04:55.000000'),
(14, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:05:32.000000'),
(15, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:07:21.000000'),
(16, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:08:30.000000'),
(17, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 01:09:29.000000'),
(18, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 03:46:58.000000'),
(19, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 03:47:43.000000'),
(20, 'GATEPASS', 3, 'RES00000008', '2021-11-11 20:25:27.000000'),
(21, 'GATEPASS', 3, 'RES00000008', '2021-11-11 20:25:54.000000'),
(22, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 20:26:58.000000'),
(23, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 20:28:39.000000'),
(24, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 20:29:34.000000'),
(25, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 20:30:26.000000'),
(26, 'GATEPASS', 3, 'VIS00000009', '2021-11-11 20:30:54.000000');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `UserID` int(11) NOT NULL,
  `DataCenterID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `ContactNo` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `HouseHoldID` int(11) DEFAULT NULL,
  `QRCode` varchar(512) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `Username` varchar(512) NOT NULL,
  `Userpass` varchar(512) NOT NULL,
  `AccountType` varchar(512) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`UserID`, `DataCenterID`, `FirstName`, `MiddleName`, `LastName`, `Suffix`, `Gender`, `BirthDate`, `ContactNo`, `EmailAddress`, `HouseHoldID`, `QRCode`, `isActive`, `Username`, `Userpass`, `AccountType`, `CreatedBy`, `CreatedDateTime`, `UpdatedBy`, `UpdatedDateTime`) VALUES
(3, 1, 'test', 'test', 'tes', 'test', 'Male', '2021-09-02', 'test', 'test@gmail.com', NULL, 'STAFF00000003', b'1', 'dev01', 'dev01', NULL, 1, '2021-10-28 17:24:00', NULL, NULL),
(4, 0, 'Test2', '', '', '', '', '0000-00-00', '', '', NULL, 'STAFF00000004', b'1', '', '', NULL, 1, '2021-11-02 08:04:26', NULL, NULL),
(8, 0, 'User1', 'User1', 'User1', 'User1', 'Male', '2021-11-01', 'User1', 'User1@gmail.com', NULL, 'STAFF00000008', b'1', 'User1', 'User1', NULL, 1, '2021-11-11 20:12:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `VehicleID` int(11) NOT NULL,
  `HouseHoldID` int(11) DEFAULT NULL,
  `Model` varchar(512) DEFAULT NULL,
  `Color` varchar(255) DEFAULT NULL,
  `PlateNumber` varchar(255) DEFAULT NULL,
  `QRCode` varchar(255) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`VehicleID`, `HouseHoldID`, `Model`, `Color`, `PlateNumber`, `QRCode`, `CreatedBy`, `CreatedDateTime`) VALUES
(4, 3, 'VEHTest', 'red', 'CXR - 12313', 'VEH00000004', 8, '2021-11-11 02:53:22.000000'),
(5, 3, 'raptor', 'red', 'asadasd', 'VEH00000005', 8, '2021-11-11 20:21:23.000000');

-- --------------------------------------------------------

--
-- Table structure for table `visitorblacklist`
--

CREATE TABLE `visitorblacklist` (
  `VBID` int(11) NOT NULL,
  `VisitorID` int(11) NOT NULL,
  `HouseHoldID` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDateTime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitorblacklist`
--

INSERT INTO `visitorblacklist` (`VBID`, `VisitorID`, `HouseHoldID`, `CreatedBy`, `CreatedDateTime`) VALUES
(6, 9, 3, 8, '2021-11-11 20:30:01.000000');

-- --------------------------------------------------------

--
-- Table structure for table `visitorlogs`
--

CREATE TABLE `visitorlogs` (
  `VLID` int(11) NOT NULL,
  `VisitorID` int(11) NOT NULL,
  `isApproved` bit(1) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `RequestDateTime` datetime(6) DEFAULT NULL,
  `ScannedBy` int(11) DEFAULT NULL,
  `HouseHoldID` int(11) DEFAULT NULL,
  `ApprovedBy` int(11) DEFAULT NULL,
  `ApprovedDateTime` datetime(6) DEFAULT NULL,
  `ReasonForVisit` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitorlogs`
--

INSERT INTO `visitorlogs` (`VLID`, `VisitorID`, `isApproved`, `isActive`, `RequestDateTime`, `ScannedBy`, `HouseHoldID`, `ApprovedBy`, `ApprovedDateTime`, `ReasonForVisit`) VALUES
(1, 9, b'1', b'1', '2021-11-01 19:30:50.000000', 3, 3, 0, '0000-00-00 00:00:00.000000', ''),
(2, 9, b'0', b'1', '2021-11-02 05:36:14.000000', 3, 3, 0, '0000-00-00 00:00:00.000000', ''),
(3, 9, b'0', b'1', '2021-11-10 23:35:04.000000', 0, 3, 0, NULL, 'test'),
(4, 9, b'1', b'1', '2021-11-11 00:22:51.000000', 0, 3, 8, '2021-11-11 00:44:59.000000', 'Test reason for visit'),
(5, 9, b'0', b'0', '2021-11-11 00:45:54.000000', 0, 3, 0, NULL, 'TEST for reject'),
(6, 9, b'0', b'0', '2021-11-11 01:01:46.000000', 3, 3, 0, NULL, 'test'),
(7, 9, b'1', b'1', '2021-11-11 01:04:12.000000', 3, 3, 0, '2021-11-11 01:04:12.000000', 'test'),
(8, 9, b'1', b'1', '2021-11-11 01:04:55.000000', 3, 3, 0, '2021-11-11 01:04:55.000000', 'test visit whitelist'),
(9, 9, b'1', b'1', '2021-11-11 01:05:32.000000', 3, 3, 0, '2021-11-11 01:05:32.000000', 'test'),
(10, 0, b'0', b'1', '2021-11-11 01:06:40.000000', 0, 0, 0, NULL, '$Reason'),
(11, 9, b'1', b'1', '2021-11-11 01:07:21.000000', 3, 3, 0, '2021-11-11 01:07:21.000000', 'teststtttttt'),
(12, 9, b'1', b'1', '2021-11-11 01:08:30.000000', 3, 3, 0, '2021-11-11 01:08:30.000000', 'testttttttttttttttsssssssssss'),
(13, 9, b'0', b'0', '2021-11-11 01:09:29.000000', 3, 3, NULL, NULL, 'testttt black list'),
(14, 9, b'0', b'0', '2021-11-11 03:46:58.000000', 3, 3, NULL, NULL, 'test WITH VISITOR APP'),
(15, 9, b'1', b'1', '2021-11-11 03:47:43.000000', 3, 3, 8, '2021-11-11 20:27:43.000000', 'testttttt'),
(16, 9, b'1', b'1', '2021-11-11 20:26:58.000000', 3, 3, 8, '2021-11-11 20:28:11.000000', 'Test visitation'),
(17, 9, b'0', b'0', '2021-11-11 20:28:39.000000', 3, 3, NULL, NULL, 'Test Reject Visitation'),
(18, 9, b'1', b'1', '2021-11-11 20:29:34.000000', 3, 3, 0, '2021-11-11 20:29:34.000000', 'reason - whitelisted'),
(19, 9, b'0', b'0', '2021-11-11 20:30:26.000000', 3, 3, NULL, NULL, 'test - blacklisted'),
(20, 9, b'0', b'0', '2021-11-11 20:30:54.000000', 3, 3, NULL, NULL, 'testtttt - blacklist');

-- --------------------------------------------------------

--
-- Table structure for table `visitorwhitelist`
--

CREATE TABLE `visitorwhitelist` (
  `VWID` int(11) NOT NULL,
  `VisitorID` int(11) NOT NULL,
  `HouseHoldID` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDateTime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`AnnouncementID`),
  ADD KEY `ATID` (`ATID`);

--
-- Indexes for table `announcementtypes`
--
ALTER TABLE `announcementtypes`
  ADD PRIMARY KEY (`ATID`);

--
-- Indexes for table `blockedvistors`
--
ALTER TABLE `blockedvistors`
  ADD PRIMARY KEY (`BVID`);

--
-- Indexes for table `datacenter`
--
ALTER TABLE `datacenter`
  ADD PRIMARY KEY (`DataCenterID`);

--
-- Indexes for table `gateassignments`
--
ALTER TABLE `gateassignments`
  ADD PRIMARY KEY (`GAID`);

--
-- Indexes for table `gatepasslogs`
--
ALTER TABLE `gatepasslogs`
  ADD PRIMARY KEY (`GPLogID`);

--
-- Indexes for table `gates`
--
ALTER TABLE `gates`
  ADD PRIMARY KEY (`GateID`);

--
-- Indexes for table `householdcontactpersons`
--
ALTER TABLE `householdcontactpersons`
  ADD PRIMARY KEY (`HCPID`);

--
-- Indexes for table `households`
--
ALTER TABLE `households`
  ADD PRIMARY KEY (`HouseHoldID`);

--
-- Indexes for table `reporttypes`
--
ALTER TABLE `reporttypes`
  ADD PRIMARY KEY (`ReportTypeID`);

--
-- Indexes for table `residentreports`
--
ALTER TABLE `residentreports`
  ADD PRIMARY KEY (`ReportID`);

--
-- Indexes for table `scannerlogs`
--
ALTER TABLE `scannerlogs`
  ADD PRIMARY KEY (`ScanID`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`VehicleID`);

--
-- Indexes for table `visitorblacklist`
--
ALTER TABLE `visitorblacklist`
  ADD PRIMARY KEY (`VBID`);

--
-- Indexes for table `visitorlogs`
--
ALTER TABLE `visitorlogs`
  ADD PRIMARY KEY (`VLID`);

--
-- Indexes for table `visitorwhitelist`
--
ALTER TABLE `visitorwhitelist`
  ADD PRIMARY KEY (`VWID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `AnnouncementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcementtypes`
--
ALTER TABLE `announcementtypes`
  MODIFY `ATID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blockedvistors`
--
ALTER TABLE `blockedvistors`
  MODIFY `BVID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `datacenter`
--
ALTER TABLE `datacenter`
  MODIFY `DataCenterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gateassignments`
--
ALTER TABLE `gateassignments`
  MODIFY `GAID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gatepasslogs`
--
ALTER TABLE `gatepasslogs`
  MODIFY `GPLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gates`
--
ALTER TABLE `gates`
  MODIFY `GateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `householdcontactpersons`
--
ALTER TABLE `householdcontactpersons`
  MODIFY `HCPID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `households`
--
ALTER TABLE `households`
  MODIFY `HouseHoldID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reporttypes`
--
ALTER TABLE `reporttypes`
  MODIFY `ReportTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `residentreports`
--
ALTER TABLE `residentreports`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `scannerlogs`
--
ALTER TABLE `scannerlogs`
  MODIFY `ScanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `VehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitorblacklist`
--
ALTER TABLE `visitorblacklist`
  MODIFY `VBID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visitorlogs`
--
ALTER TABLE `visitorlogs`
  MODIFY `VLID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `visitorwhitelist`
--
ALTER TABLE `visitorwhitelist`
  MODIFY `VWID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`ATID`) REFERENCES `announcementtypes` (`ATID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
