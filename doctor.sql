-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 04:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE `accountant` (
  `id` int(100) NOT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`) VALUES
(72, 'uploads/favicon7.png', 'Mr. Accountant', 'accountant@dms.com', 'New York, USA', '+880123456789', '', '112');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `request` varchar(100) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `room_id` varchar(500) DEFAULT NULL,
  `live_meeting_link` varchar(500) DEFAULT NULL,
  `app_time` varchar(500) DEFAULT NULL,
  `app_time_full_format` varchar(500) DEFAULT NULL,
  `payment_status` varchar(1000) DEFAULT NULL,
  `visit_description` varchar(1000) DEFAULT NULL,
  `visit_charges` varchar(1000) DEFAULT NULL,
  `payment_id` varchar(1000) DEFAULT NULL,
  `discount` varchar(1000) DEFAULT NULL,
  `grand_total` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `autoemailshortcode`
--

CREATE TABLE `autoemailshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autoemailshortcode`
--

INSERT INTO `autoemailshortcode` (`id`, `name`, `type`) VALUES
(1, '{firstname}', 'payment'),
(2, '{lastname}', 'payment'),
(3, '{name}', 'payment'),
(4, '{amount}', 'payment'),
(52, '{doctorname}', 'appoinment_confirmation'),
(42, '{firstname}', 'appoinment_creation'),
(51, '{name}', 'appoinment_confirmation'),
(50, '{lastname}', 'appoinment_confirmation'),
(49, '{firstname}', 'appoinment_confirmation'),
(48, '{hospital_name}', 'appoinment_creation'),
(47, '{time_slot}', 'appoinment_creation'),
(46, '{appoinmentdate}', 'appoinment_creation'),
(45, '{doctorname}', 'appoinment_creation'),
(44, '{name}', 'appoinment_creation'),
(43, '{lastname}', 'appoinment_creation'),
(26, '{name}', 'doctor'),
(27, '{firstname}', 'doctor'),
(28, '{lastname}', 'doctor'),
(29, '{company}', 'doctor'),
(41, '{doctor}', 'patient'),
(40, '{company}', 'patient'),
(39, '{lastname}', 'patient'),
(38, '{firstname}', 'patient'),
(37, '{name}', 'patient'),
(36, '{department}', 'doctor'),
(53, '{appoinmentdate}', 'appoinment_confirmation'),
(54, '{time_slot}', 'appoinment_confirmation'),
(55, '{hospital_name}', 'appoinment_confirmation'),
(56, '{start_time}', 'meeting_creation'),
(57, '{patient_name}', 'meeting_creation'),
(58, '{doctor_name}', 'meeting_creation'),
(59, '{hospital_name}', 'meeting_creation'),
(60, '{meeting_link}', 'meeting_creation'),
(61, '{name}', 'appoinment_creation_to_doctor'),
(62, '{firstname}', 'appoinment_creation_to_doctor'),
(63, '{hospital_name}', 'appoinment_creation_to_doctor'),
(64, '{patientname}', 'appoinment_creation_to_doctor'),
(65, '{time_slot}', 'appoinment_creation_to_doctor'),
(66, '{appoinmentdate}', 'appoinment_creation_to_doctor'),
(67, '{lastname}', 'appoinment_creation_to_doctor');

-- --------------------------------------------------------

--
-- Table structure for table `autoemailtemplate`
--

CREATE TABLE `autoemailtemplate` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autoemailtemplate`
--

INSERT INTO `autoemailtemplate` (`id`, `name`, `message`, `type`, `status`) VALUES
(1, 'Payment successful email to patient', '<p>Dear {name}, Your paying amount - Tk {amount} was successful.</p><p>Thank You</p>', 'payment', 'Active'),
(9, 'Appointment creation email to patient', 'Dear {name},<br />\r\nYou have an &nbsp;appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment.<br />\r\nFor more information contact with {hospital_name}<br />\r\nRegards', 'appoinment_creation', 'Active'),
(10, 'Appointment Confirmation email  to patient', 'Dear {name},<br />\r\nYour appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed.<br />\r\nFor more information contact with {hospital_name}<br />\r\nRegards', 'appoinment_confirmation', 'Active'),
(11, 'Meeting Schedule Notification To Patient', '<p>Dear {patient_name},</p>\r\n\r\n<p>You have a Live Video Meeting with {doctor_name} on {start_time}.<br />\r\nPlease click on this link to join the meeting&nbsp; {meeting_link} .<br />\r\nFor more information please contact with {hospital_name} .</p>\r\n\r\n<p>Regards</p>\r\n', 'meeting_creation', 'Active'),
(6, 'send joining confirmation to Doctor', '<p>Dear {name},<br />\r\nYou are appointed as a doctor&nbsp; in {department}.<br />\r\nThank You</p>\r\n\r\n<p>{company}</p>\r\n', 'doctor', 'Active'),
(8, 'Patient Registration Confirmation ', '<p>Dear {name},</p>\r\n\r\n<p>You are registered to {company} as a patient to {doctor}.</p>\r\n\r\n<p>Regards</p>\r\n', 'patient', 'Active'),
(12, 'Send Patient Appointment confirmation to Doctor', 'Dear {name}, <br> {patientname} creates a appointment  with you on {appoinmentdate} at {time_slot} . Please See details on your login panel. <br> Regards', 'appoinment_creation_to_doctor', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `autosmsshortcode`
--

CREATE TABLE `autosmsshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autosmsshortcode`
--

INSERT INTO `autosmsshortcode` (`id`, `name`, `type`) VALUES
(1, '{name}', 'payment'),
(2, '{firstname}', 'payment'),
(3, '{lastname}', 'payment'),
(4, '{amount}', 'payment'),
(55, '{appoinmentdate}', 'appoinment_confirmation'),
(54, '{doctorname}', 'appoinment_confirmation'),
(53, '{name}', 'appoinment_confirmation'),
(52, '{lastname}', 'appoinment_confirmation'),
(51, '{firstname}', 'appoinment_confirmation'),
(50, '{time_slot}', 'appoinment_creation'),
(49, '{appoinmentdate}', 'appoinment_creation'),
(48, '{hospital_name}', 'appoinment_creation'),
(47, '{doctorname}', 'appoinment_creation'),
(46, '{name}', 'appoinment_creation'),
(45, '{lastname}', 'appoinment_creation'),
(44, '{firstname}', 'appoinment_creation'),
(28, '{firstname}', 'doctor'),
(29, '{lastname}', 'doctor'),
(30, '{name}', 'doctor'),
(31, '{company}', 'doctor'),
(43, '{doctor}', 'patient'),
(42, '{company}', 'patient'),
(41, '{lastname}', 'patient'),
(40, '{firstname}', 'patient'),
(39, '{name}', 'patient'),
(38, '{department}', 'doctor'),
(56, '{time_slot}', 'appoinment_confirmation'),
(57, '{hospital_name}', 'appoinment_confirmation'),
(58, '{start_time}', 'meeting_creation'),
(59, '{patient_name}', 'meeting_creation'),
(60, '{doctor_name}', 'meeting_creation'),
(61, '{hospital_name}', 'meeting_creation'),
(62, '{meeting_link}', 'meeting_creation');

-- --------------------------------------------------------

--
-- Table structure for table `autosmstemplate`
--

CREATE TABLE `autosmstemplate` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autosmstemplate`
--

INSERT INTO `autosmstemplate` (`id`, `name`, `message`, `type`, `status`) VALUES
(1, 'Payment successful sms to patient', 'Dear {name},\r\n Your paying amount - Tk {amount} was successful.\r\nThank You\r\nPlease contact our support for further queries.', 'payment', 'Active'),
(12, 'Appointment Confirmation sms to patient', 'Dear {name},\r\nYour appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed.\r\nFor more information contact with {hospital_name}\r\nRegards', 'appoinment_confirmation', 'Active'),
(13, 'Appointment creation sms to patient', 'Dear {name},\r\nYou have an  appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment.\r\nFor more information contact with {hospital_name}\r\nRegards', 'appoinment_creation', 'Active'),
(14, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. Click on this link to join the meeting {meeting_link} . For more information contact with {hospital_name} .\r\nRegards ', 'meeting_creation', 'Active'),
(9, 'send appoint confirmation to Doctor', 'Dear {name},\nYou are appointed as a doctor in {department} .\nThank You\n{company}', 'doctor', 'Active'),
(11, 'Patient Registration Confirmation ', 'Dear {name},\n You are registred to {company} as a patient to {doctor}. \nRegards', 'patient', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bankb`
--

CREATE TABLE `bankb` (
  `id` int(100) NOT NULL,
  `group` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bankb`
--

INSERT INTO `bankb` (`id`, `group`, `status`) VALUES
(1, 'A+', '0 Bags'),
(2, 'A-', '0 Bags'),
(3, 'B+', '0 Bags'),
(4, 'B-', '0 Bags'),
(5, 'AB+', '0 Bags'),
(6, 'AB-', '0 Bags'),
(7, 'O+', '0 Bags'),
(8, 'O-', '0 Bags');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(100) NOT NULL,
  `bloodgroup` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `bloodgroup`) VALUES
(1, 'A+'),
(2, 'O+'),
(3, 'B+'),
(4, 'AB+'),
(5, 'A-'),
(6, 'O-'),
(7, 'B-'),
(8, 'AB-');

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_progress`
--

CREATE TABLE `daily_progress` (
  `id` int(100) NOT NULL,
  `date` varchar(1000) DEFAULT NULL,
  `datestamp` varchar(1000) DEFAULT NULL,
  `daily_description` varchar(1000) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `alloted_bed_id` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL,
  `nurse` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily_progress`
--

INSERT INTO `daily_progress` (`id`, `date`, `datestamp`, `daily_description`, `description`, `alloted_bed_id`, `hospital_id`, `time`, `nurse`) VALUES
(1, '01-03-2022', '1646071200', ' Reconvering', ' ajhsjkahdas', '63', NULL, '11:15 AM', '8');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_report`
--

CREATE TABLE `diagnostic_report` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `report` varchar(10000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dietician`
--

CREATE TABLE `dietician` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `department_name` varchar(1000) DEFAULT NULL,
  `appointment_confirmation` varchar(1000) DEFAULT NULL,
  `dietician_visit` varchar(1000) DEFAULT NULL,
  `visit_price` varchar(1000) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dietician`
--

INSERT INTO `dietician` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`, `department`, `department_name`, `appointment_confirmation`, `dietician_visit`, `visit_price`, `profile`) VALUES
(11, 'uploads/favicon6.png', 'Mr. Dietician', 'dietician@dms.com', 'Pottersbar, Hertfordshire, UK', '+880123456789', '', '', '1111', '111', 'Dietician', 'Active', '1', '300', 'Dietician');

-- --------------------------------------------------------

--
-- Table structure for table `dietician_visit`
--

CREATE TABLE `dietician_visit` (
  `id` int(100) NOT NULL,
  `dietician_id` varchar(1000) DEFAULT NULL,
  `dietician_name` varchar(1000) DEFAULT NULL,
  `visit_description` varchar(1000) DEFAULT NULL,
  `visit_charges` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dietician_visit`
--

INSERT INTO `dietician_visit` (`id`, `dietician_id`, `dietician_name`, `visit_description`, `visit_charges`, `status`) VALUES
(12, '1', 'Mr Dietician', 'Visit Price', '300', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(10) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(10) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `department_name` varchar(1000) DEFAULT NULL,
  `appointment_confirmation` varchar(1000) DEFAULT NULL,
  `doctor_visit` varchar(1000) DEFAULT NULL,
  `visit_price` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `department`, `profile`, `x`, `y`, `ion_user_id`, `department_name`, `appointment_confirmation`, `doctor_visit`, `visit_price`) VALUES
(1, '', 'Mr Doctor', 'doctor@dms.com', 'Collegepara, Rajbari', '+88012345678955', '54', 'Cardiac Specialized', '', '', '709', 'Cardiology', 'Active', '8', '300');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_visit`
--

CREATE TABLE `doctor_visit` (
  `id` int(100) NOT NULL,
  `doctor_id` varchar(1000) DEFAULT NULL,
  `doctor_name` varchar(1000) DEFAULT NULL,
  `visit_description` varchar(1000) DEFAULT NULL,
  `visit_charges` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_visit`
--

INSERT INTO `doctor_visit` (`id`, `doctor_id`, `doctor_name`, `visit_description`, `visit_charges`, `status`) VALUES
(12, '1', 'Mr Doctor', 'Visit Price', '100', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `message` varchar(10000) DEFAULT NULL,
  `reciepient` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `subject`, `date`, `message`, `reciepient`, `user`) VALUES
(60, 'Demo Email', '1668708333', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p><p>{phone}</p><p>{email}</p>', 'shkrish2014@gmail.com', '1'),
(61, 'Demo Email', '1668708364', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'sinehan001@gmail.com', '1'),
(62, 'Demo Email', '1668709106', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'shkrish2014@gmail.com', '1'),
(63, 'TEST', '1668709149', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'sinehan001@gmail.com', '1'),
(64, 'Demo Email', '1668709287', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'sinehan001@gmail.com', '1'),
(65, '', '1668709454', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'shkrish2014@gmail.com', '1'),
(66, 'Demo Email', '1668709723', '<p>Fuck You</p><p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'shkrish2014@gmail.com', '709'),
(67, 'Demo Email', '1668710537', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'shkrish2014@gmail.com', '109'),
(68, '', '1668834009', '<p>{phone}</p><p>{email}</p><p>{company}</p><p>{address}</p><p>{name}</p><p>{lastname}</p><p>{firstname}</p>', 'shkrish2014@gmail.com', '709');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(100) NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `smtp_host` varchar(1000) DEFAULT NULL,
  `smtp_port` varchar(1000) DEFAULT NULL,
  `send_multipart` varchar(1000) DEFAULT NULL,
  `mail_provider` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `admin_email`, `type`, `user`, `password`, `smtp_host`, `smtp_port`, `send_multipart`, `mail_provider`) VALUES
(1, 'info@codearistos.net', 'Domain Email', '', '', '', '', '', NULL),
(6, NULL, 'Smtp', 'sinehan007@gmail.com', 'Z2Zzd3JnaWxwbWN1aW11dA==', 'smtp.gmail.com', '587', '1', 'gmail');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `datestring` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `id` int(100) NOT NULL,
  `img_url` varchar(1000) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `img_url`, `name`, `profile`, `description`) VALUES
(1, 'uploads/images.jpg', 'Dr Momenuzzaman', 'Cardiac Specialized', 'Redantium, totam rem aperiam, eaque ipsa qu ab illo inventore veritatis et quasi architectos beatae vitae dicta sunt explicabo. Nemo enims sadips ipsums un.'),
(2, 'uploads/doctor.png', 'Dr RahmatUllah Asif', 'Cardiac Specialized', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(3, 'uploads/download_(2)2.png', 'Dr A.R.M. Jamil', 'Cardiac Specialized', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence');

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `id` int(50) NOT NULL,
  `folder_name` varchar(500) DEFAULT NULL,
  `patient` varchar(50) DEFAULT NULL,
  `add_date` varchar(50) DEFAULT NULL,
  `folder_path` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`id`, `folder_name`, `patient`, `add_date`, `folder_path`) VALUES
(98, 'test', '1', '11/22/21', '/uploads/documents/test'),
(99, 'test', '1', '11/22/21', '/uploads/documents/test'),
(100, 'kjkhkjhk', '1', '11/24/21', '/uploads/documents/kjkhkjhk');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Accountant', 'For Financial Activities'),
(4, 'Doctor', ''),
(5, 'Patient', ''),
(6, 'Nurse', ''),
(7, 'Pharmacist', ''),
(8, 'Laboratorist', ''),
(10, 'Receptionist', 'Receptionist'),
(11, 'Dietician', 'Diet Plans');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(100) NOT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `doctor`, `date`, `x`, `y`) VALUES
(80, '1', '1668880800', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `category_name` varchar(1000) DEFAULT NULL,
  `report` varchar(10000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `date_string` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `category`, `patient`, `doctor`, `date`, `category_name`, `report`, `status`, `user`, `patient_name`, `patient_phone`, `patient_address`, `doctor_name`, `date_string`) VALUES
(6, NULL, '1', '1', '1668708000', NULL, '<p><a href=\"https://google.com\">https://google.com</a></p><figure class=\"media\"><oembed url=\"https://www.youtube.com/watch?v=XKVyhMpI5No\"></oembed></figure><p>&nbsp;</p><p><img src=\"https://codearistos.net/demo/doctor-care/uploads/favicon.png\" alt=\"\"></p><p>&nbsp;</p>', 'sample_taken', '111', 'Mr. Patient', '+91 9940673890', 'Ka/5 Jagannathpur5', 'Mr Doctor', '18-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `laboratorist`
--

CREATE TABLE `laboratorist` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laboratorist`
--

INSERT INTO `laboratorist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`) VALUES
(3, 'uploads/favicon1.png', 'Mr Laboratorist', 'laboratorist@dms.com', 'Tampa, Florida, USA', '+880123456789', '', '', '111');

-- --------------------------------------------------------

--
-- Table structure for table `lab_category`
--

CREATE TABLE `lab_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `reference_value` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `role` varchar(1000) DEFAULT NULL,
  `ip_address` varchar(1000) DEFAULT NULL,
  `date_time` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `name`, `email`, `role`, `ip_address`, `date_time`) VALUES
(194, 'admin', 'admin@hms.com', 'Admin', '202.134.8.142', '27-04-2022 10:17:35'),
(193, 'Mr Doctor', 'doctor@hms.com', 'Doctor', '110.76.129.137', '13-04-2022 16:46:21'),
(192, 'Mr. Patient', 'patient@hms.com', 'Patient', '110.76.129.137', '13-04-2022 16:44:56'),
(191, 'admin', 'admin@hms.com', 'Admin', '110.76.129.137', '13-04-2022 16:44:17'),
(190, 'admin', 'admin@hms.com', 'Admin', '110.76.129.137', '13-04-2022 12:52:07'),
(189, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '11-04-2022 17:25:33'),
(188, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '11-04-2022 15:17:49'),
(187, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '07-04-2022 13:05:51'),
(186, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '06-04-2022 16:35:08'),
(185, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '05-04-2022 12:13:30'),
(184, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '30-03-2022 19:01:11'),
(183, 'admin', 'admin@hms.com', 'Admin', '37.111.193.120', '30-03-2022 10:48:14'),
(182, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '29-03-2022 17:42:10'),
(181, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '29-03-2022 12:41:42'),
(180, 'admin', 'admin@hms.com', 'Admin', '103.220.204.97', '27-03-2022 20:46:13'),
(195, 'admin', 'admin@hms.com', 'Admin', '103.135.233.55', '08-05-2022 08:42:51'),
(196, 'admin', 'admin@hms.com', 'Admin', '103.135.233.55', '08-05-2022 13:06:31'),
(197, 'admin', 'admin@hms.com', 'Admin', '110.76.129.137', '10-05-2022 10:57:26'),
(198, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '10-05-2022 10:58:32'),
(199, 'Mrs Nurse', 'nurse@hms.com', 'Nurse', '110.76.129.137', '10-05-2022 10:59:35'),
(200, 'Mr. Pharmacist', 'pharmacist@hms.com', 'Pharmacist', '110.76.129.137', '10-05-2022 11:00:22'),
(201, 'Mr Laboratorist', 'laboratorist@hms.com', 'Laboratorist', '110.76.129.137', '10-05-2022 11:01:10'),
(202, 'Mr. Accountant', 'accountant@hms.com', 'Accountant', '110.76.129.137', '10-05-2022 11:02:11'),
(203, 'Mr Receptionist', 'receptionist@hms.com', 'Receptionist', '110.76.129.137', '10-05-2022 11:03:20'),
(204, 'Mr. Patient', 'patient@hms.com', 'Patient', '110.76.129.137', '10-05-2022 11:04:17'),
(205, 'Mr Doctor', 'doctor@hms.com', 'Doctor', '110.76.129.137', '10-05-2022 11:05:15'),
(206, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '110.76.129.137', '10-05-2022 11:06:42'),
(207, 'Mr. Patient', 'patient@dms.com', 'Patient', '110.76.129.137', '10-05-2022 11:07:07'),
(208, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '110.76.129.137', '10-05-2022 11:07:36'),
(209, 'Mr. Accountant', 'accountant@dms.com', 'Accountant', '110.76.129.137', '10-05-2022 11:07:57'),
(210, 'Mr Laboratorist', 'laboratorist@dms.com', 'Laboratorist', '110.76.129.137', '10-05-2022 11:08:29'),
(211, 'Mr. Pharmacist', 'pharmacist@dms.com', 'Pharmacist', '110.76.129.137', '10-05-2022 11:08:58'),
(212, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '110.76.129.137', '10-05-2022 11:09:19'),
(213, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '10-05-2022 11:09:37'),
(214, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '110.76.129.137', '10-05-2022 12:24:41'),
(215, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '10-05-2022 12:25:08'),
(216, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '10-05-2022 12:59:30'),
(217, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '10-05-2022 18:53:27'),
(218, 'admin', 'admin@dms.com ', 'Admin', '110.76.129.137', '10-05-2022 19:01:03'),
(219, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '10-05-2022 19:20:00'),
(220, 'admin', 'admin@dms.com', 'Admin', '110.76.129.137', '11-05-2022 10:52:41'),
(221, 'admin', 'admin@dms.com', 'Admin', '::1', '17-11-2022 23:56:26'),
(222, 'admin', 'admin@dms.com', 'Admin', '::1', '17-11-2022 23:57:33'),
(223, 'admin', 'admin@gmail.com', 'Admin', '::1', '17-11-2022 23:58:04'),
(224, 'admin', 'admin@gmail.com', 'Admin', '::1', '18-11-2022 00:01:53'),
(225, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '18-11-2022 00:28:04'),
(226, 'Mr. Patient', 'patient@dms.com', 'Patient', '::1', '18-11-2022 00:30:18'),
(227, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '18-11-2022 00:39:29'),
(228, 'Mr Laboratorist', 'laboratorist@dms.com', 'Laboratorist', '::1', '18-11-2022 00:42:43'),
(229, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '18-11-2022 04:20:15'),
(230, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '18-11-2022 04:22:17'),
(231, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '18-11-2022 04:26:39'),
(232, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '18-11-2022 04:33:07'),
(233, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '18-11-2022 04:39:38'),
(234, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '19-11-2022 07:00:06'),
(235, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '19-11-2022 07:03:53'),
(236, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '19-11-2022 10:53:47'),
(237, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '19-11-2022 10:57:17'),
(238, 'admin', 'admin@gmail.com', 'Admin', '::1', '19-11-2022 10:57:31'),
(239, 'admin', 'admin@gmail.com', 'Admin', '::1', '19-11-2022 10:57:50'),
(240, 'admin', 'admin@gmail.com', 'Admin', '::1', '19-11-2022 10:59:03'),
(241, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '19-11-2022 10:59:33'),
(242, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '19-11-2022 11:00:16'),
(243, 'admin', 'admin@gmail.com', 'Admin', '::1', '19-11-2022 18:22:56'),
(244, 'admin', 'admin@gmail.com', 'Admin', '::1', '19-11-2022 21:43:19'),
(245, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '19-11-2022 22:42:06'),
(246, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '21-11-2022 16:38:52'),
(247, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '21-11-2022 16:40:00'),
(248, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '21-11-2022 22:05:29'),
(249, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '21-11-2022 22:08:25'),
(250, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '21-11-2022 22:15:46'),
(251, 'admin', 'admin@gmail.com', 'Admin', '::1', '21-11-2022 22:16:09'),
(252, 'admin', 'admin@gmail.com', 'Admin', '::1', '21-11-2022 22:26:00'),
(253, 'admin', 'admin@gmail.com', 'Admin', '::1', '21-11-2022 22:48:50'),
(254, 'admin', 'admin@gmail.com', 'Admin', '::1', '22-11-2022 04:17:11'),
(255, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 05:33:15'),
(256, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 05:50:55'),
(257, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 05:52:11'),
(258, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '23-11-2022 05:52:40'),
(259, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 06:29:22'),
(260, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 11:05:37'),
(261, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '23-11-2022 11:10:11'),
(262, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 11:13:49'),
(263, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 11:15:23'),
(264, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 11:16:26'),
(265, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '23-11-2022 11:16:42'),
(266, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '23-11-2022 11:20:32'),
(267, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 11:25:11'),
(268, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 17:25:34'),
(269, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 20:12:14'),
(270, 'admin', 'admin@gmail.com', 'Admin', '::1', '23-11-2022 20:25:17'),
(271, 'admin', 'admin@gmail.com', 'Admin', '::1', '24-11-2022 05:47:51'),
(272, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 05:48:08'),
(273, 'Mr. Patient', 'patient@dms.com', 'Patient', '::1', '24-11-2022 06:11:24'),
(274, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '24-11-2022 06:12:22'),
(275, 'admin', 'admin@gmail.com', 'Admin', '::1', '24-11-2022 06:17:52'),
(276, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 06:20:48'),
(277, 'admin', 'admin@gmail.com', 'Admin', '::1', '24-11-2022 06:23:04'),
(278, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 06:26:34'),
(279, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '24-11-2022 06:28:09'),
(280, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 06:28:47'),
(281, 'admin', 'admin@gmail.com', 'Admin', '::1', '24-11-2022 06:29:26'),
(282, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 06:34:13'),
(283, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 06:35:30'),
(284, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 12:53:38'),
(285, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 19:35:30'),
(286, 'Mrs Nurse', 'nurse@dms.com', 'Nurse', '::1', '24-11-2022 19:37:59'),
(287, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 19:38:46'),
(288, 'admin', 'admin@gmail.com', 'Admin', '::1', '24-11-2022 19:45:19'),
(289, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 19:45:41'),
(290, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 19:58:25'),
(291, 'Mr Doctor', 'doctor@dms.com', 'Doctor', '::1', '24-11-2022 19:58:35'),
(292, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 19:58:55'),
(293, 'admin', 'admin@gmail.com', 'Admin', '::1', '24-11-2022 20:04:00'),
(294, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '24-11-2022 20:09:09'),
(295, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 20:13:50'),
(296, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 20:22:13'),
(297, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '24-11-2022 20:26:14'),
(298, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '25-11-2022 04:18:43'),
(299, 'admin', 'admin@gmail.com', 'Admin', '::1', '25-11-2022 04:23:51'),
(300, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '25-11-2022 04:31:39'),
(301, 'Mr Receptionist', 'receptionist@dms.com', 'Receptionist', '::1', '25-11-2022 13:58:18'),
(302, 'Mr Dietician', 'dietician@dms.com', 'Dietician', '::1', '25-11-2022 14:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `manualemailshortcode`
--

CREATE TABLE `manualemailshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manualemailshortcode`
--

INSERT INTO `manualemailshortcode` (`id`, `name`, `type`) VALUES
(1, '{firstname}', 'email'),
(2, '{lastname}', 'email'),
(3, '{name}', 'email'),
(6, '{address}', 'email'),
(7, '{company}', 'email'),
(8, '{email}', 'email'),
(9, '{phone}', 'email');

-- --------------------------------------------------------

--
-- Table structure for table `manualsmsshortcode`
--

CREATE TABLE `manualsmsshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manualsmsshortcode`
--

INSERT INTO `manualsmsshortcode` (`id`, `name`, `type`) VALUES
(1, '{firstname}', 'sms'),
(2, '{lastname}', 'sms'),
(3, '{name}', 'sms'),
(4, '{email}', 'sms'),
(5, '{phone}', 'sms'),
(6, '{address}', 'sms'),
(10, '{company}', 'sms');

-- --------------------------------------------------------

--
-- Table structure for table `manual_email_template`
--

CREATE TABLE `manual_email_template` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manual_email_template`
--

INSERT INTO `manual_email_template` (`id`, `name`, `message`, `type`) VALUES
(7, 'vddfvdf', '<p>dvdfvdfvdfvd</p>\r\n', 'email'),
(8, 'Admin Template', '<p>{phone}</p>\r\n\r\n<p>{email}</p>\r\n\r\n<p>{company}</p>\r\n\r\n<p>{address}</p>\r\n\r\n<p>{name}</p>\r\n\r\n<p>{lastname}</p>\r\n\r\n<p>{firstname}</p>\r\n', 'email'),
(9, 'sadasdasd', '<p>{company}</p><p>{address}</p>', 'email');

-- --------------------------------------------------------

--
-- Table structure for table `manual_sms_template`
--

CREATE TABLE `manual_sms_template` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manual_sms_template`
--

INSERT INTO `manual_sms_template` (`id`, `name`, `message`, `type`) VALUES
(1, 'test', '{firstname} come to my offce {lastname}', 'sms'),
(8, 'dsdsdss3wew454', '{firstname}{address}{phone}{address}{email}{name}{lastname}{firstname}', 'sms'),
(3, 'sdgfgfdgfdgdf', '<p>{email}{instructor}{address} gfdgdfg</p>\r\n', 'email'),
(7, 'test223', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>dsfsf</td>\r\n			<td>sdfsdf</td>\r\n		</tr>\r\n		<tr>\r\n			<td>sdfdsf</td>\r\n			<td>dfdsf</td>\r\n		</tr>\r\n		<tr>\r\n			<td>dfdf</td>\r\n			<td>dfdfd</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n{email}{instructor}', 'email'),
(9, 'zxcxzczx', ' {address}{phone}', 'sms');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(100) NOT NULL,
  `patient_id` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_address` varchar(500) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `img_url` varchar(500) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `box` varchar(100) DEFAULT NULL,
  `s_price` varchar(100) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `generic` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `effects` varchar(100) DEFAULT NULL,
  `e_date` varchar(70) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(100) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `topic` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `meeting_id` varchar(100) DEFAULT NULL,
  `meeting_password` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `request` varchar(100) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `doctor_ion_id` varchar(100) DEFAULT NULL,
  `patient_ion_id` varchar(100) DEFAULT NULL,
  `appointment_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_settings`
--

CREATE TABLE `meeting_settings` (
  `id` int(100) NOT NULL,
  `api_key` varchar(100) DEFAULT NULL,
  `secret_key` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meeting_settings`
--

INSERT INTO `meeting_settings` (`id`, `api_key`, `secret_key`, `ion_user_id`, `y`) VALUES
(8, 'PEbvh2uESS6ryue3Kb3D0w', 'BZpvXJsvgqG6mN4Up1FuuWJQAY47w5QCWIAo', '709', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `z` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `z`, `ion_user_id`) VALUES
(8, 'uploads/favicon4.png', 'Mrs Nurse', 'nurse@dms.com', 'Uttara, Dhaka', '+880123456789', '', '', '', '109');

-- --------------------------------------------------------

--
-- Table structure for table `odontogram`
--

CREATE TABLE `odontogram` (
  `id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `Tooth32` varchar(30) NOT NULL,
  `Tooth31` varchar(30) NOT NULL,
  `Tooth30` varchar(30) NOT NULL,
  `Tooth29` varchar(30) NOT NULL,
  `Tooth28` varchar(30) NOT NULL,
  `Tooth27` varchar(30) NOT NULL,
  `Tooth26` varchar(30) NOT NULL,
  `Tooth25` varchar(30) NOT NULL,
  `Tooth24` varchar(30) NOT NULL,
  `Tooth23` varchar(30) NOT NULL,
  `Tooth22` varchar(30) NOT NULL,
  `Tooth21` varchar(30) NOT NULL,
  `Tooth20` varchar(30) NOT NULL,
  `Tooth19` varchar(30) NOT NULL,
  `Tooth18` varchar(30) NOT NULL,
  `Tooth17` varchar(30) NOT NULL,
  `Tooth16` varchar(30) NOT NULL,
  `Tooth15` varchar(30) NOT NULL,
  `Tooth14` varchar(30) NOT NULL,
  `Tooth13` varchar(30) NOT NULL,
  `Tooth12` varchar(30) NOT NULL,
  `Tooth11` varchar(30) NOT NULL,
  `Tooth10` varchar(30) NOT NULL,
  `Tooth9` varchar(30) NOT NULL,
  `Tooth8` varchar(30) NOT NULL,
  `Tooth7` varchar(30) NOT NULL,
  `Tooth6` varchar(30) NOT NULL,
  `Tooth5` varchar(30) NOT NULL,
  `Tooth4` varchar(30) NOT NULL,
  `Tooth3` varchar(30) NOT NULL,
  `Tooth2` varchar(30) NOT NULL,
  `Tooth1` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `odontogram`
--

INSERT INTO `odontogram` (`id`, `patient_id`, `Tooth32`, `Tooth31`, `Tooth30`, `Tooth29`, `Tooth28`, `Tooth27`, `Tooth26`, `Tooth25`, `Tooth24`, `Tooth23`, `Tooth22`, `Tooth21`, `Tooth20`, `Tooth19`, `Tooth18`, `Tooth17`, `Tooth16`, `Tooth15`, `Tooth14`, `Tooth13`, `Tooth12`, `Tooth11`, `Tooth10`, `Tooth9`, `Tooth8`, `Tooth7`, `Tooth6`, `Tooth5`, `Tooth4`, `Tooth3`, `Tooth2`, `Tooth1`, `description`) VALUES
(5, 6, '#9c00ff', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', '#00ba72', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', '#ff0000', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'Need follow up 3 days later'),
(4, 1, 'white', 'white', '#ff9000', '#ff9000', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', '#8e0101', '#9c00ff', 'white', 'white', 'white', 'white', '#8e0101', 'white', '#8e0101', '#8e0101', 'white', 'white', 'white', 'white', '#ff9000', '#ff9000', '#ff9000', 'white', 'Sober'),
(6, 7, '#9c00ff', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', '#00c0ff', '#ff0000', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', '#ff9000', 'white', 'white', 'white', 'white', '#ff9000', ''),
(7, 8, 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', ''),
(8, 9, 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', ''),
(9, 10, 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', ''),
(10, 0, 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', ''),
(11, 12, 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', '');

-- --------------------------------------------------------

--
-- Table structure for table `ot_payment`
--

CREATE TABLE `ot_payment` (
  `id` int(100) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor_c_s` varchar(100) DEFAULT NULL,
  `doctor_a_s_1` varchar(100) DEFAULT NULL,
  `doctor_a_s_2` varchar(100) DEFAULT NULL,
  `doctor_anaes` varchar(100) DEFAULT NULL,
  `n_o_o` varchar(100) DEFAULT NULL,
  `c_s_f` varchar(100) DEFAULT NULL,
  `a_s_f_1` varchar(100) DEFAULT NULL,
  `a_s_f_2` varchar(11) DEFAULT NULL,
  `anaes_f` varchar(100) DEFAULT NULL,
  `ot_charge` varchar(100) DEFAULT NULL,
  `cab_rent` varchar(100) DEFAULT NULL,
  `seat_rent` varchar(100) DEFAULT NULL,
  `others` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `doctor_fees` varchar(100) DEFAULT NULL,
  `hospital_fees` varchar(100) DEFAULT NULL,
  `gross_total` varchar(100) DEFAULT NULL,
  `flat_discount` varchar(100) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `birthdate` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `bloodgroup` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `patient_id` varchar(100) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `how_added` varchar(100) DEFAULT NULL,
  `appointment_confirmation` varchar(1000) DEFAULT NULL,
  `payment_confirmation` varchar(1000) DEFAULT NULL,
  `appointment_creation` varchar(1000) DEFAULT NULL,
  `meeting_schedule` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `img_url`, `name`, `email`, `doctor`, `address`, `phone`, `sex`, `birthdate`, `age`, `bloodgroup`, `ion_user_id`, `patient_id`, `add_date`, `registration_time`, `how_added`, `appointment_confirmation`, `payment_confirmation`, `appointment_creation`, `meeting_schedule`) VALUES
(1, 'uploads/624116.jpg', 'Mr. Patient', 'patient@dms.com', NULL, 'Ka/5 Jagannathpur5', '+91 9940673890', 'Male', '01-01-1987', '', NULL, '681', '101223', '01/30/19', '', '', NULL, NULL, 'Active', NULL),
(11, 'uploads/136949.jpg', 'Hari Krishna', 'harikrishna@dms.com', '1', 'ABC Street', '9876543210', 'Male', '26-10-2001', NULL, 'O+', '1581', '855166', '11/19/22', '1668876606', NULL, NULL, NULL, NULL, NULL),
(12, NULL, 'Sinehan', 'sinehan22@gmail.com', '1', 'No:1, ABC Street', '1234567890', 'Male', '30-11-2022', NULL, 'A+', '4893', '763708', '11/24/22', '1669248968', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_deposit`
--

CREATE TABLE `patient_deposit` (
  `id` int(10) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `deposited_amount` varchar(100) DEFAULT NULL,
  `amount_received_id` varchar(100) DEFAULT NULL,
  `deposit_type` varchar(100) DEFAULT NULL,
  `gateway` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `payment_from` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_material`
--

CREATE TABLE `patient_material` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `date_string` varchar(100) DEFAULT NULL,
  `folder` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `vat` varchar(100) NOT NULL DEFAULT '0',
  `x_ray` varchar(100) DEFAULT NULL,
  `flat_vat` varchar(100) DEFAULT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) DEFAULT NULL,
  `gross_total` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `hospital_amount` varchar(100) DEFAULT NULL,
  `doctor_amount` varchar(100) DEFAULT NULL,
  `category_amount` varchar(1000) DEFAULT NULL,
  `category_name` varchar(1000) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `deposit_type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `date_string` varchar(100) DEFAULT NULL,
  `payment_from` varchar(1000) DEFAULT NULL,
  `appointment_id` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymentgateway`
--

CREATE TABLE `paymentgateway` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `merchant_key` varchar(100) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `APIUsername` varchar(100) DEFAULT NULL,
  `APIPassword` varchar(100) DEFAULT NULL,
  `APISignature` varchar(100) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `publish` varchar(1000) DEFAULT NULL,
  `secret` varchar(1000) DEFAULT NULL,
  `public_key` varchar(1000) DEFAULT NULL,
  `store_id` varchar(1000) DEFAULT NULL,
  `store_password` varchar(1000) DEFAULT NULL,
  `merchant_mid` varchar(1000) DEFAULT NULL,
  `merchant_website` varchar(1000) DEFAULT NULL,
  `apiloginid` varchar(1000) DEFAULT NULL,
  `transactionkey` varchar(1000) DEFAULT NULL,
  `apikey` varchar(1000) DEFAULT NULL,
  `merchantcode` varchar(1000) DEFAULT NULL,
  `privatekey` varchar(1000) DEFAULT NULL,
  `publishablekey` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymentgateway`
--

INSERT INTO `paymentgateway` (`id`, `name`, `merchant_key`, `salt`, `x`, `y`, `APIUsername`, `APIPassword`, `APISignature`, `status`, `publish`, `secret`, `public_key`, `store_id`, `store_password`, `merchant_mid`, `merchant_website`, `apiloginid`, `transactionkey`, `apikey`, `merchantcode`, `privatekey`, `publishablekey`) VALUES
(1, 'PayPal', '', '', '', '', 'kjhjkj', 'sdfsdfsdfsd', 'sdfsdfds', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Pay U Money', 'Merchant Key ', 'Merchant Key ', '', '', '', '', 'Aaw-Fd69z.JLuiq13ejMN-CsSMuuAPEXWUFPF5QW9sD22fp1hosGIFKo', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'jkkjhjkh', 'jhjkhk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Paystack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, 'sk_test_c0b4a969e33564d0fdc6c781efb0300e6831689767786', 'pk_test_6511ce507f68769d3035234614ba03f3e7368f4erefd435', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'SSLCOMMERZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, 'vella5fe8cfbe4ed3a6786', 'vella5fe8cfbe4ed3a@ssl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Paytm', 'Jf1xPyzQNTUuRkkwtrtrt', NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, 'RyFhFm70546883391722', 'WEBSTAGING', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Authorize.Net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2LJcUm5498497L2', '46u3b3AMd44sJX5w', NULL, NULL, NULL, NULL),
(8, '2Checkout', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Merchant Code', 'Private key', 'Publishable Key');

-- --------------------------------------------------------

--
-- Table structure for table `payment_category`
--

CREATE TABLE `payment_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `c_price` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `d_commission` int(100) DEFAULT NULL,
  `h_commission` int(100) DEFAULT NULL,
  `code` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`) VALUES
(7, 'uploads/favicon6.png', 'Mr. Pharmacist', 'pharmacist@dms.com', 'Pottersbar, Hertfordshire, UK', '+880123456789', '', '', '110');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_expense`
--

CREATE TABLE `pharmacy_expense` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_expense_category`
--

CREATE TABLE `pharmacy_expense_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_payment`
--

CREATE TABLE `pharmacy_payment` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `vat` varchar(100) NOT NULL DEFAULT '0',
  `x_ray` varchar(100) DEFAULT NULL,
  `flat_vat` varchar(100) DEFAULT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) DEFAULT NULL,
  `gross_total` varchar(100) DEFAULT NULL,
  `hospital_amount` varchar(100) DEFAULT NULL,
  `doctor_amount` varchar(100) DEFAULT NULL,
  `category_amount` varchar(1000) DEFAULT NULL,
  `category_name` varchar(1000) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_payment_category`
--

CREATE TABLE `pharmacy_payment_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `c_price` varchar(100) DEFAULT NULL,
  `d_commission` int(100) DEFAULT NULL,
  `h_commission` int(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `symptom` varchar(100) DEFAULT NULL,
  `advice` varchar(1000) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `dd` varchar(100) DEFAULT NULL,
  `medicine` varchar(1000) DEFAULT NULL,
  `validity` varchar(100) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `lab_test` varchar(10000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pservice`
--

CREATE TABLE `pservice` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `code` varchar(1000) DEFAULT NULL,
  `alpha_code` varchar(1000) DEFAULT NULL,
  `price` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pservice`
--

INSERT INTO `pservice` (`id`, `name`, `code`, `alpha_code`, `price`, `active`) VALUES
(13, 'testing', 'p002', 'uiu100', '200', '1'),
(14, 'asdasdsa', '003', '007', '10000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`) VALUES
(7, '', 'Mr Receptionist', 'receptionist@dms.com', 'Collegepara, Rajbari', '+880123456789', '', '614');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `report_type` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `report_type`, `patient`, `description`, `doctor`, `date`, `add_date`) VALUES
(37, 'operation', 'Mr. Patient*681', 'Description', 'Mr Doctor', '17-11-2022', '11/18/22');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(100) NOT NULL,
  `img_url` varchar(1000) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `img_url`, `title`, `description`) VALUES
(1, 'uploads/featured-icon-3.png', 'Cardiac Excellence', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(2, 'uploads/featured-icon-4.png', 'Cancer Treatment', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(3, 'uploads/featured-icon-1.png', 'Stroke Management', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(4, 'uploads/featured-icon-6.png', '24 / 7 Support', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(5, 'uploads/featured-icon-2.png', 'Care', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `system_vendor` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `live_appointment_type` varchar(100) DEFAULT NULL,
  `vat` varchar(100) DEFAULT NULL,
  `login_title` varchar(100) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `invoice_logo` varchar(500) DEFAULT NULL,
  `payment_gateway` varchar(100) DEFAULT NULL,
  `sms_gateway` varchar(100) DEFAULT NULL,
  `codec_username` varchar(100) DEFAULT NULL,
  `codec_purchase_code` varchar(100) DEFAULT NULL,
  `timezone` varchar(1000) DEFAULT NULL,
  `emailtype` varchar(1000) DEFAULT NULL,
  `appointment_subtitle` varchar(1000) NOT NULL,
  `appointment_title` varchar(1000) NOT NULL,
  `appointment_description` varchar(1000) NOT NULL,
  `appointment_img_url` varchar(500) NOT NULL,
  `footer_message` varchar(1000) DEFAULT NULL,
  `show_odontogram_in_history` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_vendor`, `title`, `address`, `phone`, `email`, `facebook_id`, `currency`, `language`, `discount`, `live_appointment_type`, `vat`, `login_title`, `logo`, `invoice_logo`, `payment_gateway`, `sms_gateway`, `codec_username`, `codec_purchase_code`, `timezone`, `emailtype`, `appointment_subtitle`, `appointment_title`, `appointment_description`, `appointment_img_url`, `footer_message`, `show_odontogram_in_history`) VALUES
(1, 'Doctor Care', 'Doctor Clinic', 'Boropool, Rajbari-7700', '+0123456789', 'admin@demo.com', '#', '$', 'english', 'flat', 'jitsi', 'percentage', 'Login Title', 'uploads/logo-nonetext1.png', '', 'Stripe', 'MSG91', '', '', 'Asia/Dhaka', 'Smtp', '', '', '', '', 'By Code Aristos', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `site_gallery`
--

CREATE TABLE `site_gallery` (
  `id` int(10) NOT NULL,
  `img` varchar(500) NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_gallery`
--

INSERT INTO `site_gallery` (`id`, `img`, `position`, `status`) VALUES
(1, 'uploads/gallery-img-1.png', '1', 'Active'),
(2, 'uploads/gallery-img-2.png', '2', 'Active'),
(3, 'uploads/gallery-img-3.png', '3', 'Active'),
(4, 'uploads/gallery-img-4.png', '4', 'Active'),
(5, 'uploads/gallery-img-5.png', '5', 'Active'),
(6, 'uploads/gallery-img-6.png', '6', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `site_grid`
--

CREATE TABLE `site_grid` (
  `id` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_grid`
--

INSERT INTO `site_grid` (`id`, `category`, `title`, `description`, `img`, `position`, `status`) VALUES
(3, 'FEATURED', 'Professional surgeons', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum tenetur, aut veritatis maxime ducimus modi delectus vero expedita illo ratione, eveniet laboriosam cupiditate reiciendis, repellat minima. Optio consectetur inventore ipsa!', 'uploads/frature-img-1.png', '1', 'Active'),
(4, 'FEATURED', 'Good Care', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum tenetur, aut veritatis maxime ducimus modi delectus vero expedita illo ratione, eveniet laboriosam cupiditate reiciendis, repellat minima. Optio consectetur inventore ipsa!', 'uploads/frature-img-2.png', '2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `site_map`
--

CREATE TABLE `site_map` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_map`
--

INSERT INTO `site_map` (`id`, `name`, `url`) VALUES
(1, 'Patient', 'patient'),
(2, 'Appointment', 'appointment'),
(3, 'Doctor', 'doctor'),
(4, 'Doctor Visit', 'doctor/doctorvisit'),
(5, 'Add New Doctor', 'doctor/addNewView'),
(7, 'Nurse', 'nurse'),
(8, 'Add New Nurse', 'nurse/addNewView'),
(9, 'Add New Pharmacist', 'pharmacist/addNewView'),
(10, 'Pharmacist', 'pharmacist'),
(11, 'Add New Laboratorist', 'laboratorist/addNewView'),
(12, 'Laboratorist', 'laboratorist'),
(13, 'Add New Accountant', 'accountant/addNewView'),
(14, 'Accountant', 'accountant'),
(15, 'Add New Receptionist', 'receptionist/addNewView'),
(16, 'Receptionist', 'receptionist'),
(17, 'Payment List', 'finance/payment'),
(18, 'Add New Payment', 'finance/addPaymentView'),
(19, 'Payment Procedures List', 'finance/paymentCategory'),
(20, 'Add Payment Procedure', 'finance/addPaymentCategoryView'),
(21, 'Expense List', 'finance/expense'),
(22, 'Add New Expense', 'finance/addExpenseView'),
(23, 'Expense categories List', 'finance/expenseCategory'),
(24, 'Add New Expense categories List', 'finance/addExpenseCategoryView'),
(25, 'Prescription List', 'prescription/all'),
(26, 'Add New Prescription', 'prescription/addPrescriptionView'),
(27, 'Lab Report List', 'lab'),
(28, 'Add New Lab Report', 'lab/addLabView'),
(29, 'Add New Lab Template', 'lab/template'),
(30, 'Doctor Treatment History', 'appointment/treatmentReport'),
(31, 'Doctor Schedule List', 'schedule'),
(32, 'Doctor Holiday List', 'schedule/allHolidays'),
(33, 'Add New Appointment', 'appointment/addNewView'),
(34, 'Todays Appointment', 'appointment/todays'),
(35, 'Upcoming Appointment', 'appointment/upcoming'),
(36, 'Calendar', 'appointment/calendar'),
(37, 'Medicine List', 'medicine'),
(38, 'Add New Medicine', 'medicine/addMedicineView'),
(39, 'Medicine Category List', 'medicine/medicineCategory'),
(40, 'Add New Medicine Category', 'medicine/addCategoryView'),
(41, 'Medicine Stock Alert List', 'medicine/medicineStockAlert'),
(42, 'Pharmacy Dashboard', 'finance/pharmacy/home'),
(43, 'Dashboard', 'home'),
(44, 'Pharmacy Sales List', 'finance/pharmacy/payment'),
(45, 'Add New Pharmacy Sale', 'finance/pharmacy/addPaymentView'),
(46, 'Pharmacy Expenses List', 'finance/pharmacy/expense'),
(47, 'Add New Pharmacy Expense', 'finance/pharmacy/addExpenseView'),
(48, 'Pharmacy Expense Categories List', 'finance/pharmacy/expenseCategory'),
(49, 'Add New Pharmacy Expense Category', 'finance/pharmacy/addExpenseCategoryView'),
(50, 'Pharmacy Financial report', 'finance/pharmacy/financialReport'),
(51, 'Pharmacy Monthly Sales', 'finance/pharmacy/monthly'),
(52, 'Pharmacy Daily Sales', 'finance/pharmacy/daily'),
(53, 'Pharmacy Monthly Expense', 'finance/pharmacy/monthlyExpense'),
(54, 'Pharmacy Daily Expense', 'finance/pharmacy/dailyExpense'),
(63, 'Financial Report', 'finance/financialReport'),
(64, 'User Activity Report', 'finance/allUserActivityReport'),
(65, 'Doctor Commission', 'finance/doctorsCommission'),
(66, 'Monthly Financial report', 'finance/monthly'),
(67, 'Daily Financial report', 'finance/daily'),
(68, 'Monthly Financial Expense', 'finance/monthlyExpense'),
(69, 'Daily Financial Expense', 'finance/dailyExpense'),
(70, 'Expense Vs Income Report', 'finance/expenseVsIncome'),
(71, 'Birth Report', 'report/birth'),
(72, 'Operation Report', 'report/operation'),
(73, 'Expire Report', 'report/expire'),
(76, 'Auto Email Template List', 'email/autoEmailTemplate'),
(77, 'Send Email', 'email/sendView'),
(78, 'Email Settings', 'email/emailSettings'),
(79, 'Auto SMS Template List', 'sms/autoSMSTemplate'),
(80, 'Send SMS', 'sms/sendView'),
(81, 'SMS Settings', 'sms'),
(82, 'Settings', 'settings'),
(83, 'Payment Gateway Settings', 'pgateway'),
(84, 'Language Settings', 'settings/language'),
(85, 'Bulk Import', 'import'),
(86, 'Database Backup', 'settings/backups'),
(87, 'Transaction Logs List', 'transactionLogs'),
(88, 'User Login List', 'logs'),
(89, 'Profile', 'profile'),
(90, 'Case Manager', 'patient/caseList'),
(91, 'Patient Payment List', 'patient/patientPayments'),
(92, 'Document List', 'patient/documents'),
(93, 'Visit Website', 'frontend'),
(94, 'Website Settings', 'frontend/settings'),
(95, 'Review List', 'review'),
(96, 'Gridsection List', 'gridsection'),
(97, 'Gallery List', 'gallery'),
(98, 'Slide List', 'slide'),
(99, 'Service List', 'service'),
(100, 'Featured Doctor', 'featured'),
(101, 'Add Payment', 'finance/addPaymentView'),
(102, 'Add Expense', 'finance/addExpenseView'),
(103, 'Add Medicine', 'medicine/addMedicineView'),
(104, 'Add Medicine Category', 'medicine/addCategoryView'),
(109, 'Add Pharmacy Expense Category', 'finance/pharmacy/addExpenseCategoryView'),
(110, 'Add Pharmacy Expense', 'finance/pharmacy/addExpenseView'),
(111, 'Add Pharmacy Sale', 'finance/pharmacy/addPaymentView'),
(112, 'Add Appointment', 'appointment/addNewView'),
(113, 'Add Lab Template', 'lab/template'),
(114, 'Add Lab Report', 'lab/addLabView'),
(115, 'Add Prescription', 'prescription/addPrescriptionView'),
(116, 'Add Receptionist', 'receptionist/addNewView'),
(117, 'Add Accountant', 'accountant/addNewView'),
(118, 'Add Laboratorist', 'laboratorist/addNewView'),
(119, 'Add Pharmacist', 'pharmacist/addNewView'),
(120, 'Add Nurse', 'nurse/addNewView'),
(121, 'Add Doctor', 'doctor/addNewView'),
(122, 'Patient Service List', 'pservice'),
(123, 'Add Patient Service', 'pservice/addNew'),
(124, 'Add New Patient Service', 'pservice/addNew');

-- --------------------------------------------------------

--
-- Table structure for table `site_review`
--

CREATE TABLE `site_review` (
  `id` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `designation` varchar(500) CHARACTER SET utf8 NOT NULL,
  `review` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `img` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_review`
--

INSERT INTO `site_review` (`id`, `name`, `designation`, `review`, `img`, `status`) VALUES
(1, 'Test Reviewer 1', 'Reviewer, XYZ', '“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero expedita cumque assumenda cum neque, atque nesciunt, molestiae architecto doloremque quis, placeat ipsam quidem provident in! Illum voluptas harum animi consequatur! ”', 'uploads/doctor-icon-avatar-white136162-581.jpg', 'Active'),
(3, 'Test Reviewer 2', 'Reviewer, ABC', '“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero expedita cumque assumenda cum neque, atque nesciunt, molestiae architecto doloremque quis, placeat ipsam quidem provident in! Illum voluptas harum animi consequatur! ”', 'uploads/doctor-icon-avatar-white136162-582.jpg', 'Active'),
(4, 'Test Reviewer 3', 'Reviewer, NMP', '“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero expedita cumque assumenda cum neque, atque nesciunt, molestiae architecto doloremque quis, placeat ipsam quidem provident in! Illum voluptas harum animi consequatur! ”', 'uploads/doctor-icon-avatar-white136162-583.jpg', 'Active'),
(5, 'Test Reviewer 4', 'Reviewer, TRP', '“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero expedita cumque assumenda cum neque, atque nesciunt, molestiae architecto doloremque quis, placeat ipsam quidem provident in! Illum voluptas harum animi consequatur! ”', 'uploads/doctor-icon-avatar-white136162-584.jpg', 'Active'),
(6, 'Test Reviewer 5', 'Reviewer, CVB', '“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero expedita cumque assumenda cum neque, atque nesciunt, molestiae architecto doloremque quis, placeat ipsam quidem provident in! Illum voluptas harum animi consequatur! ”', 'uploads/doctor-icon-avatar-white136162-585.jpg', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `img_url` varchar(1000) DEFAULT NULL,
  `text1` varchar(500) DEFAULT NULL,
  `text2` varchar(500) DEFAULT NULL,
  `text3` varchar(500) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `title`, `img_url`, `text1`, `text2`, `text3`, `position`, `status`) VALUES
(1, 'Slider 1', 'uploads/1503411077revised-bhatia-homebanner-03.jpg', 'Welcome To Doctor Clinic', 'Doctor Care', 'Welcome', '2', 'Active'),
(2, 'Best Hospital management System', 'uploads/1707260345350542.jpg', 'Best Hospital management System', 'Best Hospital management System', 'Best Hospital management System', '1', 'Inactive'),
(5, 'dbfbfjsbjfjbbsjfb', 'uploads/inlinePreview2.jpg', 'jbfjsbjdf', 'jbfjbjfbjsb', 'jbfjbjsbfj', 'jbfjbjbsjf', 'Inactive'),
(6, 'Main BG', 'uploads/header-bg.png', 'The best doctors in Medicine!', 'in the world of modern medicine', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `message` varchar(1600) DEFAULT NULL,
  `recipient` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `api_id` varchar(100) DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  `authkey` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `sid` varchar(1000) DEFAULT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `sendernumber` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `name`, `username`, `password`, `api_id`, `sender`, `authkey`, `user`, `sid`, `token`, `sendernumber`, `link`) VALUES
(1, 'Clickatell', '', 'dmJiY3ZiY3Y=', '', NULL, NULL, '1', NULL, NULL, NULL, 'https://www.clickatell.com/'),
(2, 'MSG91', '', '', NULL, '+8801819636104', '373608AOJwu831621942b2P1', '1', NULL, NULL, NULL, 'https://msg91.com/'),
(5, 'Twilio', '', '', NULL, NULL, NULL, '1', 'Twilio SID', 'Twilio Token Password', 'Sender Number', 'https://www.twilio.com/'),
(6, 'Bulk Sms', 'VXNlcm5hbWU=', 'UGFzc3dvcmQ=', NULL, NULL, NULL, '1', NULL, NULL, NULL, 'https://www.bulksms.com/'),
(8, 'Bd Bulk Sms', '', '', NULL, NULL, NULL, '1', NULL, 'Bd Bulk Sms Token Password', NULL, 'https://bdbulksms.net/');

-- --------------------------------------------------------

--
-- Table structure for table `space`
--

CREATE TABLE `space` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `template` varchar(10000) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `time_schedule`
--

CREATE TABLE `time_schedule` (
  `id` int(100) NOT NULL,
  `doctor` varchar(500) DEFAULT NULL,
  `weekday` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_schedule`
--

INSERT INTO `time_schedule` (`id`, `doctor`, `weekday`, `s_time`, `e_time`, `s_time_key`, `duration`) VALUES
(120, '1', 'Friday', '08:00 PM', '08:45 PM', '240', '3');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int(100) NOT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `weekday` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `doctor`, `s_time`, `e_time`, `weekday`, `s_time_key`) VALUES
(2196, NULL, '01:30 PM', '01:45 PM', 'Tuesday', '162'),
(2197, NULL, '01:45 PM', '02:00 PM', 'Tuesday', '165'),
(2198, NULL, '02:00 PM', '02:15 PM', 'Tuesday', '168'),
(2199, NULL, '02:15 PM', '02:30 PM', 'Tuesday', '171'),
(2200, NULL, '02:30 PM', '02:45 PM', 'Tuesday', '174'),
(2201, NULL, '02:45 PM', '03:00 PM', 'Tuesday', '177'),
(2202, NULL, '03:00 PM', '03:15 PM', 'Tuesday', '180'),
(2203, NULL, '03:15 PM', '03:30 PM', 'Tuesday', '183'),
(2204, NULL, '03:30 PM', '03:45 PM', 'Tuesday', '186'),
(2205, NULL, '03:45 PM', '04:00 PM', 'Tuesday', '189'),
(2206, NULL, '04:00 PM', '04:15 PM', 'Tuesday', '192'),
(2207, NULL, '04:15 PM', '04:30 PM', 'Tuesday', '195'),
(2208, NULL, '04:30 PM', '04:45 PM', 'Tuesday', '198'),
(2209, NULL, '04:45 PM', '05:00 PM', 'Tuesday', '201'),
(2210, NULL, '05:00 PM', '05:15 PM', 'Tuesday', '204'),
(2211, NULL, '05:15 PM', '05:30 PM', 'Tuesday', '207'),
(2212, NULL, '05:30 PM', '05:45 PM', 'Tuesday', '210'),
(2213, NULL, '05:45 PM', '06:00 PM', 'Tuesday', '213'),
(2214, NULL, '06:00 PM', '06:15 PM', 'Tuesday', '216'),
(2215, NULL, '06:15 PM', '06:30 PM', 'Tuesday', '219'),
(2216, NULL, '06:30 PM', '06:45 PM', 'Tuesday', '222'),
(2217, NULL, '06:45 PM', '07:00 PM', 'Tuesday', '225'),
(2218, NULL, '07:00 PM', '07:15 PM', 'Tuesday', '228'),
(2219, NULL, '07:15 PM', '07:30 PM', 'Tuesday', '231'),
(2220, NULL, '07:30 PM', '07:45 PM', 'Tuesday', '234'),
(2221, NULL, '07:45 PM', '08:00 PM', 'Tuesday', '237'),
(2222, NULL, '08:00 PM', '08:15 PM', 'Tuesday', '240'),
(2223, NULL, '08:15 PM', '08:30 PM', 'Tuesday', '243'),
(2224, NULL, '08:30 PM', '08:45 PM', 'Tuesday', '246'),
(2225, NULL, '08:45 PM', '09:00 PM', 'Tuesday', '249'),
(2226, NULL, '09:00 PM', '09:15 PM', 'Tuesday', '252'),
(2227, NULL, '09:15 PM', '09:30 PM', 'Tuesday', '255'),
(2228, NULL, '09:30 PM', '09:45 PM', 'Tuesday', '258'),
(2229, NULL, '09:45 PM', '10:00 PM', 'Tuesday', '261'),
(2230, NULL, '10:00 PM', '10:15 PM', 'Tuesday', '264'),
(2231, NULL, '10:15 PM', '10:30 PM', 'Tuesday', '267'),
(2232, NULL, '10:30 PM', '10:45 PM', 'Tuesday', '270'),
(2233, NULL, '10:45 PM', '11:00 PM', 'Tuesday', '273'),
(2234, NULL, '11:00 PM', '11:15 PM', 'Tuesday', '276'),
(2235, NULL, '11:15 PM', '11:30 PM', 'Tuesday', '279'),
(2573, NULL, '12:00 AM', '12:15 AM', 'Friday', '0'),
(2574, NULL, '12:15 AM', '12:30 AM', 'Friday', '3'),
(2575, NULL, '12:30 AM', '12:45 AM', 'Friday', '6'),
(2576, NULL, '12:45 AM', '01:00 AM', 'Friday', '9'),
(2577, NULL, '01:00 AM', '01:15 AM', 'Friday', '12'),
(2578, NULL, '01:15 AM', '01:30 AM', 'Friday', '15'),
(2579, NULL, '01:30 AM', '01:45 AM', 'Friday', '18'),
(2580, NULL, '01:45 AM', '02:00 AM', 'Friday', '21'),
(2581, NULL, '02:00 AM', '02:15 AM', 'Friday', '24'),
(2582, NULL, '02:15 AM', '02:30 AM', 'Friday', '27'),
(2583, NULL, '02:30 AM', '02:45 AM', 'Friday', '30'),
(2584, NULL, '02:45 AM', '03:00 AM', 'Friday', '33'),
(2585, NULL, '03:00 AM', '03:15 AM', 'Friday', '36'),
(2586, NULL, '03:15 AM', '03:30 AM', 'Friday', '39'),
(2587, NULL, '03:30 AM', '03:45 AM', 'Friday', '42'),
(2588, NULL, '03:45 AM', '04:00 AM', 'Friday', '45'),
(2589, NULL, '04:00 AM', '04:15 AM', 'Friday', '48'),
(2590, NULL, '04:15 AM', '04:30 AM', 'Friday', '51'),
(2591, NULL, '04:30 AM', '04:45 AM', 'Friday', '54'),
(2592, NULL, '04:45 AM', '05:00 AM', 'Friday', '57'),
(2593, NULL, '05:00 AM', '05:15 AM', 'Friday', '60'),
(2594, NULL, '05:15 AM', '05:30 AM', 'Friday', '63'),
(2595, NULL, '05:30 AM', '05:45 AM', 'Friday', '66'),
(2596, NULL, '05:45 AM', '06:00 AM', 'Friday', '69'),
(2597, NULL, '06:00 AM', '06:15 AM', 'Friday', '72'),
(2598, NULL, '06:15 AM', '06:30 AM', 'Friday', '75'),
(2599, NULL, '06:30 AM', '06:45 AM', 'Friday', '78'),
(2600, NULL, '06:45 AM', '07:00 AM', 'Friday', '81'),
(2601, NULL, '07:00 AM', '07:15 AM', 'Friday', '84'),
(2602, NULL, '07:15 AM', '07:30 AM', 'Friday', '87'),
(2603, NULL, '07:30 AM', '07:45 AM', 'Friday', '90'),
(2604, NULL, '07:45 AM', '08:00 AM', 'Friday', '93'),
(2605, NULL, '08:00 AM', '08:15 AM', 'Friday', '96'),
(2606, NULL, '08:15 AM', '08:30 AM', 'Friday', '99'),
(2607, NULL, '08:30 AM', '08:45 AM', 'Friday', '102'),
(2608, NULL, '08:45 AM', '09:00 AM', 'Friday', '105'),
(2609, NULL, '09:00 AM', '09:15 AM', 'Friday', '108'),
(2610, NULL, '09:15 AM', '09:30 AM', 'Friday', '111'),
(2611, NULL, '09:30 AM', '09:45 AM', 'Friday', '114'),
(2612, NULL, '09:45 AM', '10:00 AM', 'Friday', '117'),
(2613, NULL, '10:00 AM', '10:15 AM', 'Friday', '120'),
(2614, NULL, '10:15 AM', '10:30 AM', 'Friday', '123'),
(2615, NULL, '10:30 AM', '10:45 AM', 'Friday', '126'),
(2616, NULL, '10:45 AM', '11:00 AM', 'Friday', '129');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` int(100) NOT NULL,
  `date_time` varchar(1000) DEFAULT NULL,
  `invoice_id` varchar(1000) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `deposit_type` varchar(1000) DEFAULT NULL,
  `payment_gateway` varchar(1000) DEFAULT NULL,
  `action` varchar(1000) DEFAULT NULL,
  `amount` varchar(1000) DEFAULT NULL,
  `user` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `date_time`, `invoice_id`, `patientname`, `deposit_type`, `payment_gateway`, `action`, `amount`, `user`) VALUES
(13, '27-04-2022 10:18', '50', 'Mr. Patient', 'Card', NULL, 'Added', '799', '1'),
(14, '10-05-2022 14:55', '53', 'Mr. Patient', 'Cash', NULL, 'Added', '1500', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2y$08$ZEWAEG9KMsbIMWi7jUDc..VWPP3yLLcm3Oq0I8BU3veJUTHvJZaxm', '', 'admin@gmail.com', '', 'g0wt205VJVb4a9819f14ce3d10dffe14f93680e2', 1607595309, 'zCeJpcj78CKqJ4sVxVbxcO', 1268889823, 1669328631, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(109, '113.11.74.192', 'Mrs Nurse', '$2y$08$WPs/d5prBKL4g466LmJJOegfds34Lvm.SwNGis0fm4TI4MhabpDs6', NULL, 'nurse@dms.com', NULL, NULL, NULL, NULL, 1435082243, 1669297079, 1, NULL, NULL, NULL, NULL),
(110, '113.11.74.192', 'Mr. Pharmacist', '$2y$08$bb5a9eRDBzCfkbs7J3/DSeyeeuprGIHYd0YASmhCpQDc0S7kSetdi', NULL, 'pharmacist@dms.com', NULL, NULL, NULL, 'mbeMop6vTuscFYmD2M4Iqu', 1435082359, 1652159338, 1, NULL, NULL, NULL, NULL),
(111, '113.11.74.192', 'Mr Laboratorist', '$2y$08$ngEJN.JIeISyQEMl3Lnf2esoRIZYaF8yrJIfvBLK7jFHKY1mu8Ixy', NULL, 'laboratorist@dms.com', NULL, NULL, NULL, NULL, 1435082438, 1668710563, 1, NULL, NULL, NULL, NULL),
(112, '113.11.74.192', 'Mr. Accountant', '$2y$08$oY2kYTks4phjKimdJ/GUSeuByVtn2EhnpsDscSvuh3mQjwe2NaNjy', NULL, 'accountant@dms.com', NULL, NULL, NULL, NULL, 1435082637, 1652159277, 1, NULL, NULL, NULL, NULL),
(614, '103.231.162.58', 'Mr Receptionist', '$2y$08$tX87H12nmemuCLF7obLmBevu5sCt0rq6z6SCF8ZZuLQvdJueLW7BC', NULL, 'receptionist@dms.com', NULL, NULL, NULL, NULL, 1505800835, 1669363098, 1, NULL, NULL, NULL, NULL),
(681, '103.231.161.30', 'Mr. Patient', '$2y$08$YFGa6ifhnaYLhkG1lleTd.Uk2zTYFLjQy7v6nWZKwCeJEWOhFnhNa', NULL, 'patient@dms.com', NULL, '0DZAWUWsz97df26954d73d2b737ccba18085d4a3', 1621654029, NULL, 1548872582, 1669248684, 1, NULL, NULL, NULL, NULL),
(709, '103.231.160.47', 'Mr Doctor', '$2y$08$SzIsDwhdR5VmCDa5OKI5BeHjXNerZJe3qegf.v8BzVQjs42VMY1f.', NULL, 'doctor@dms.com', NULL, NULL, NULL, NULL, 1558379920, 1669298315, 1, NULL, NULL, NULL, NULL),
(1574, '110.76.129.137', 'Dr. Shaibal Saha', '$2y$08$UHKn6FEN5aJJ5SpsNffCDOmCmJiwsYv31rqQvDKJ1uTqgtCFLlAaK', NULL, 'shaibal1211@gmail.com', NULL, NULL, NULL, NULL, 1644830414, NULL, 1, NULL, NULL, NULL, NULL),
(1581, '::1', 'Hari Krishna', '$2y$08$mIrYGEkar1t0SzVJ9.kpN.lVE/XQI.W36VjwKrjuP6VP2bH1DkKny', NULL, 'harikrishna@dms.com', NULL, NULL, NULL, NULL, 1668876606, NULL, 1, NULL, NULL, NULL, NULL),
(4892, '::1', 'Mr Dietician', '$2y$08$ZEWAEG9KMsbIMWi7jUDc..VWPP3yLLcm3Oq0I8BU3veJUTHvJZaxm', NULL, 'dietician@dms.com', NULL, NULL, NULL, NULL, 1669069922, 1669363233, 1, NULL, NULL, NULL, NULL),
(4893, '::1', 'Sinehan', '$2y$08$5Gq7S0L6ljC/dvLH2uMdkOxvwuIu042nVBHTbs570Zby9uOYXUmDK', NULL, 'sinehan22@gmail.com', NULL, NULL, NULL, NULL, 1669248968, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(111, 109, 6),
(112, 110, 7),
(113, 111, 8),
(114, 112, 3),
(616, 614, 10),
(683, 681, 5),
(711, 709, 4),
(5571, 1574, 4),
(5578, 1581, 5),
(5579, 4892, 11),
(5580, 4893, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vital_signs`
--

CREATE TABLE `vital_signs` (
  `id` int(100) NOT NULL,
  `patient_id` varchar(1000) DEFAULT NULL,
  `bmi_height` varchar(1000) DEFAULT NULL,
  `bmi_weight` varchar(1000) DEFAULT NULL,
  `respiratory_rate` varchar(1000) DEFAULT NULL,
  `oxygen_saturation` varchar(1000) DEFAULT NULL,
  `temperature` varchar(1000) DEFAULT NULL,
  `diastolic_blood_pressure` varchar(1000) DEFAULT NULL,
  `systolic_blood_pressure` varchar(1000) DEFAULT NULL,
  `add_date_time` varchar(1000) DEFAULT NULL,
  `heart_rate` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vital_signs`
--

INSERT INTO `vital_signs` (`id`, `patient_id`, `bmi_height`, `bmi_weight`, `respiratory_rate`, `oxygen_saturation`, `temperature`, `diastolic_blood_pressure`, `systolic_blood_pressure`, `add_date_time`, `heart_rate`, `hospital_id`) VALUES
(3, '1', '179', '80', '13', '99', '98', '80', '130', '13-01-2022 11:47:58', '30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` int(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `logo` varchar(1000) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `emergency` varchar(100) DEFAULT NULL,
  `support` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `block_1_text_under_title` varchar(500) DEFAULT NULL,
  `service_block__text_under_title` varchar(500) DEFAULT NULL,
  `doctor_block__text_under_title` varchar(500) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `twitter_id` varchar(100) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `youtube_id` varchar(100) DEFAULT NULL,
  `skype_id` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `twitter_username` varchar(1000) DEFAULT NULL,
  `appointment_title` varchar(1000) NOT NULL,
  `appointment_subtitle` varchar(1000) NOT NULL,
  `appointment_description` varchar(1000) NOT NULL,
  `appointment_img_url` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `title`, `description`, `logo`, `address`, `phone`, `emergency`, `support`, `email`, `currency`, `block_1_text_under_title`, `service_block__text_under_title`, `doctor_block__text_under_title`, `facebook_id`, `twitter_id`, `google_id`, `youtube_id`, `skype_id`, `x`, `twitter_username`, `appointment_title`, `appointment_subtitle`, `appointment_description`, `appointment_img_url`) VALUES
(1, 'Doctor Care', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus deleniti mollitia quibusdam natus dolorum quae id libero rerum ullam maxime molestias exercitationem incidunt, sunt, delectus consequuntur dignissimos ab iste fuga?', 'uploads/Code-Aristos-logo3.png', 'Bashundhara R/A, Dhaka', '018000000', '+0123456789', '+0123456789', 'admin@demo.com', '$', 'Best Doctor Care In The City', 'Aenean nibh ante, lacinia non tincidunt nec, lobortis ut tellus. Sed in porta diam.', 'We work with forward thinking clients to create beautiful, honest and amazing things that bring positive results.', 'https://www.facebook.com/rizvi.plabon', 'https://www.twitter.com/casoft', 'https://www.google.com/casoft', 'https://www.youtube.com/casoft', 'https://www.skype.com/casoft', NULL, 'codearistos', 'Why you should choose us?', 'WELCOME', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam nulla quibusdam nam autem, in quasi quae cumque, laborum optio nobis reprehenderit doloremque delectus voluptate. Maxime aliquam vitae adipisci sit numquam?', 'uploads/why-choose-us-doc.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountant`
--
ALTER TABLE `accountant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoemailshortcode`
--
ALTER TABLE `autoemailshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoemailtemplate`
--
ALTER TABLE `autoemailtemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autosmsshortcode`
--
ALTER TABLE `autosmsshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autosmstemplate`
--
ALTER TABLE `autosmstemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankb`
--
ALTER TABLE `bankb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_progress`
--
ALTER TABLE `daily_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostic_report`
--
ALTER TABLE `diagnostic_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dietician`
--
ALTER TABLE `dietician`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dietician_visit`
--
ALTER TABLE `dietician_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_visit`
--
ALTER TABLE `doctor_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorist`
--
ALTER TABLE `laboratorist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_category`
--
ALTER TABLE `lab_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manualemailshortcode`
--
ALTER TABLE `manualemailshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manualsmsshortcode`
--
ALTER TABLE `manualsmsshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_email_template`
--
ALTER TABLE `manual_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_sms_template`
--
ALTER TABLE `manual_sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odontogram`
--
ALTER TABLE `odontogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_payment`
--
ALTER TABLE `ot_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_deposit`
--
ALTER TABLE `patient_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_material`
--
ALTER TABLE `patient_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentgateway`
--
ALTER TABLE `paymentgateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_category`
--
ALTER TABLE `payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_expense`
--
ALTER TABLE `pharmacy_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_expense_category`
--
ALTER TABLE `pharmacy_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_payment`
--
ALTER TABLE `pharmacy_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_payment_category`
--
ALTER TABLE `pharmacy_payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pservice`
--
ALTER TABLE `pservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_gallery`
--
ALTER TABLE `site_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_grid`
--
ALTER TABLE `site_grid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_map`
--
ALTER TABLE `site_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_review`
--
ALTER TABLE `site_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `space`
--
ALTER TABLE `space`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_schedule`
--
ALTER TABLE `time_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountant`
--
ALTER TABLE `accountant`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `autoemailshortcode`
--
ALTER TABLE `autoemailshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `autoemailtemplate`
--
ALTER TABLE `autoemailtemplate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `autosmsshortcode`
--
ALTER TABLE `autosmsshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `autosmstemplate`
--
ALTER TABLE `autosmstemplate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bankb`
--
ALTER TABLE `bankb`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_progress`
--
ALTER TABLE `daily_progress`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diagnostic_report`
--
ALTER TABLE `diagnostic_report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dietician`
--
ALTER TABLE `dietician`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dietician_visit`
--
ALTER TABLE `dietician_visit`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor_visit`
--
ALTER TABLE `doctor_visit`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laboratorist`
--
ALTER TABLE `laboratorist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lab_category`
--
ALTER TABLE `lab_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `manualemailshortcode`
--
ALTER TABLE `manualemailshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `manualsmsshortcode`
--
ALTER TABLE `manualsmsshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manual_email_template`
--
ALTER TABLE `manual_email_template`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `manual_sms_template`
--
ALTER TABLE `manual_sms_template`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2882;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=616;

--
-- AUTO_INCREMENT for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `odontogram`
--
ALTER TABLE `odontogram`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ot_payment`
--
ALTER TABLE `ot_payment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_deposit`
--
ALTER TABLE `patient_deposit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1787;

--
-- AUTO_INCREMENT for table `patient_material`
--
ALTER TABLE `patient_material`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `paymentgateway`
--
ALTER TABLE `paymentgateway`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_category`
--
ALTER TABLE `payment_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pharmacy_expense`
--
ALTER TABLE `pharmacy_expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `pharmacy_expense_category`
--
ALTER TABLE `pharmacy_expense_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pharmacy_payment`
--
ALTER TABLE `pharmacy_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacy_payment_category`
--
ALTER TABLE `pharmacy_payment_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `pservice`
--
ALTER TABLE `pservice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_gallery`
--
ALTER TABLE `site_gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_grid`
--
ALTER TABLE `site_grid`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_map`
--
ALTER TABLE `site_map`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `site_review`
--
ALTER TABLE `site_review`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `space`
--
ALTER TABLE `space`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `time_schedule`
--
ALTER TABLE `time_schedule`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2623;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4894;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5581;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
