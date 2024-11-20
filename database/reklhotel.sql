-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 08:22 PM
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
-- Database: `reklhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` varchar(12) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `room_name` varchar(20) NOT NULL,
  `no_day` int(11) NOT NULL,
  `no_pax` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'confirm',
  `request` varchar(255) NOT NULL,
  `customer_id` varchar(12) NOT NULL,
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `checkin`, `checkout`, `room_name`, `no_day`, `no_pax`, `total`, `status`, `request`, `customer_id`, `room_id`) VALUES
('B001245', '2024-07-16', '2024-07-19', 'deluxe', 3, 2, 540.00, 'cancel', 'non smoking room', '021218011558', 201),
('B006306', '2024-07-07', '2024-07-09', 'standard', 2, 1, 300.00, 'confirm', 'add one more towel', '010203015423', 100),
('B011110', '2024-07-07', '2024-07-10', 'standard', 3, 2, 450.00, 'confirm', 'more towel and coffee instant', '921102015433', NULL),
('B024595', '2024-07-04', '2024-07-05', 'studio', 1, 5, 250.00, 'confirm', '', '000908050907', 308),
('B042468', '2024-07-06', '2024-07-08', 'deluxe', 2, 5, 360.00, 'confirm', 'early check in', '990705100809', 206),
('B045726', '2024-07-17', '2024-07-19', 'studio', 2, 2, 500.00, 'confirm', 'none', '030902030905', 309),
('B073149', '2024-07-17', '2024-07-19', 'standard', 2, 2, 300.00, 'confirm', 'none', '980202020908', 104),
('B073202', '2024-07-25', '2024-07-29', 'deluxe', 4, 3, 720.00, 'confirm', '', '780202030907', 209),
('B074466', '2024-07-19', '2024-07-21', 'standard', 2, 2, 300.00, 'confirm', 'I will late check in', '980807010998', 106),
('B093817', '2024-07-12', '2024-07-18', 'studio', 6, 2, 1500.00, 'confirm', 'add 3 towel ', '990801036783', 303);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `message_id` int(11) NOT NULL,
  `message_name` varchar(100) DEFAULT NULL,
  `message_email` varchar(50) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`message_id`, `message_name`, `message_email`, `subject`, `description`) VALUES
(1, 'faytin', 'faytin@gmail.com', 'service', 'goood service. '),
(2, 'nisha', 'nisha@gmail.com', 'Room', 'Clean room'),
(3, 'teme', 'teme@gmail.com', 'Room', 'goodddd'),
(4, 'shalin', 'shalin@gmail.com', 'ROOM PRICE', 'how much is standard room for one night?');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(12) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `phone_no`, `email`, `password`, `status`) VALUES
('000908050907', 'Daniel Hakimi Bin Ahmad Solihin', '0196783256', 'daniel@gmail.com', '', 'active'),
('010203015423', 'alif hakim', '0196653722', 'alif@gmail.com', '$2y$10$tQX0nXva/Tfo3vtNYHDrKelvsbbzIURZOtekGi5V1BhuRMtZVttU2', 'active'),
('020907030906', 'Nazirah Binti Ahmad Azizi', '01177903378', 'nazirah@gmail.com', '', 'active'),
('021218011558', 'fatin liyana', '0117465832', 'fatin@gmail.com', '$2y$10$8CI5rTidHz.qLsE/RyEMiO9bh3IWbMEQEx6bMq4pXqqj4JnwD6syu', 'active'),
('021345678764', 'mia', '0197753244', 'mia@gmail.com', '$2y$10$88wTx1VLXOrwH4baOzEt0O8yLhk95UYO1IoOHy0vfOmr.EScf9XVi', 'active'),
('030902030905', 'Zainal Bin Zaid', '0190870923', 'zainal@gmail.com', '', 'active'),
('087656543432', 'zaha', '0192234567', 'zaha@gmail.com', '$2y$10$zA0BDxJzpJAWvXX5Rez.Ju5fCPIMSBL52qNQAIlz41GFyeyLXLJFK', 'active'),
('780202030907', 'Amirul Naim bin Kamarulzaman', '0189037892', 'naim@gmail.com', '', 'active'),
('900308090107', 'Zamirul Bin Zakie', '0195682390', 'zamirul@gmail.com', '', 'active'),
('921102015433', 'Zainudin Bin Ahmad Zarul', '0187763422', 'zainudin@gamil.com', '$2y$10$TZ2WXYJXZBt9v7q2MMCe/..hFNxPJTvKeKBoKRtJHV8S8bh58ATHG', 'active'),
('960903030907', 'Zamirul Bin Zakie', '0198743290', 'zamirul@gmail.com', '', 'active'),
('970903010808', 'Nazirah Binti Ahmad Azizi', '01133694432', 'nazirah@gmail.com', '', 'active'),
('970903010873', 'Zamirul Bin Zakie', '01177638891', 'zamirul@gmail.com', '', 'active'),
('980202020908', 'Nadhirah Binti Rahum', '0198030907', 'nadhirah@gmail.com', '', 'active'),
('980807010998', 'Athirah Ayuni Binti Norizam', '0186542890', 'ayuni@gmail.com', '', 'active'),
('980901010808', 'Dayana Binti Khalid', '0178098632', 'dayana@gmail.com', '', 'active'),
('990619140983', 'Zamirul Bin Zakie', '0195682390', 'zamirul@gmail.com', '', 'active'),
('990705100809', 'Hanani Azmiera Binti Ahmad ', '0190037849', 'azmiera@gmail.com', '', 'active'),
('990801036783', 'Ahmad Shahril Bin Anuar', '0189762456', 'sharil@gmail.com', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(20) NOT NULL,
  `receipt_id` varchar(10) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_total` decimal(10,2) NOT NULL,
  `expirydate` varchar(5) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL DEFAULT 'card' COMMENT 'card/online/paypal\r\n',
  `card_name` varchar(50) DEFAULT NULL,
  `card_number` varchar(20) NOT NULL,
  `status` varchar(10) DEFAULT 'paid ' COMMENT 'paid/unpaid\r\n',
  `customer_id` varchar(12) DEFAULT NULL,
  `booking_id` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `receipt_id`, `payment_date`, `payment_total`, `expirydate`, `cvv`, `payment_type`, `card_name`, `card_number`, `status`, `customer_id`, `booking_id`) VALUES
('P003088474', '', '2024-07-05', 495.00, '12/34', '234', 'card', 'zainudin', '1234 5645 3780 8765', 'paid ', '921102015433', 'B011110'),
('P007217397', '', '2024-07-04', 330.00, '12/30', '123', 'card', 'alif', '1234 5678 9098 7654', 'paid ', '010203015423', 'B006306'),
('P009003486', '', '2024-07-04', 594.00, '12/27', '242', 'card', 'fatin liyana', '1234 5678 7652 3456', 'paid ', '021218011558', 'B001245');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'available' COMMENT 'available/unavailable',
  `availableAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `price`, `description`, `status`, `availableAt`) VALUES
(100, 'Standard Room', 150, '1 queen bed ', 'unavailable', '2024-07-09'),
(101, 'Standard Room', 150, '1 queen bed ', 'available', '2024-07-04'),
(102, 'Standard Room', 150, '1 queen bed ', 'available', '2024-07-04'),
(103, 'Standard Room', 150, '1 queen Bed', 'unavailable', '2024-07-16'),
(104, 'Standard Room', 150, '1 queen bed ', 'available', '2024-07-04'),
(105, 'Standard Room', 150, '1 queen bed ', 'available', '2024-07-04'),
(106, 'Standard Room', 150, 'twin single bed', 'available', '2024-07-04'),
(107, 'Standard Room', 150, 'twin single bed', 'available', '2024-07-09'),
(108, 'Standard Room', 150, 'twin single bed', 'available', '2024-07-04'),
(109, 'Standard Room', 150, 'twin single bed', 'available', '2024-07-04'),
(110, 'Standard Room', 150, 'twin single bed', 'available', '2024-07-04'),
(200, 'Deluxe Room', 180, '1 king bed', 'unavailable', '2024-07-16'),
(201, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(202, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(203, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(204, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(205, 'Deluxe Room', 180, '1 king bed', 'unavailable', '2024-07-16'),
(206, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(207, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(208, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(209, 'Deluxe Room', 180, '1 king bed', 'available', '2024-07-04'),
(210, 'Deluxe Room', 180, '1 king bed', 'unavailable', '2024-07-09'),
(300, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(301, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(302, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(303, 'Studio', 250, '1 king bed and 1 single bed', 'unavailable', '2024-07-18'),
(304, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(305, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(306, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(307, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(308, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(309, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(310, 'Studio', 250, '1 king bed and 1 single bed', 'available', '2024-07-04'),
(400, 'Suite', 280, '2 partition room 1 king bed and 1 single bed', 'unavailable', '2024-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(12) NOT NULL,
  `staff_tel` varchar(11) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `hire_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `country` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_tel`, `staff_name`, `staff_email`, `position`, `hire_date`, `address`, `state`, `zip_code`, `country`, `password`, `status`) VALUES
('010101105824', '01111241235', 'maimunah anjung', 'maimunah@gmail.com', 'Front Desk Agent', '2024-07-10', 'no.13 jalan seri putra 4/4 bandar seri putra', 'Selangor', '43000', 'Malaysia', '', 'inactive'),
('123456789876', '01111241235', 'Muhammad Haziq', 'haziq@gmail.com', 'Manager', '2024-07-01', 'no.13 jalan seri putra 4/4 bandar seri putra', 'Selangor', '43000', 'Malaysia', '$2y$10$Nc.gygXs5ifjA6R8liJ.POJ4vlTdLehyesEMAYIbAHJIQWK6uhivG', 'active'),
('980109140908', '0128965431', 'Nur Shalinda', 'shalinda@gmail.com', 'Server', '2024-03-14', '25 Jalan Seri Ayu 3 ', 'Melaka', '20980', 'Malaysia', '', 'inactive'),
('990709010806', '01137309105', 'Fatin Liyanha', 'fatin@gmail.com', 'Assistant Manager', '2023-11-08', '1349 Jalan Jambu 8', 'Johor', '81400', 'Malaysia', '$2y$10$uaxU7C5eOuGdxiyUJE.4FunxVDIBj51jpD4qHD5v11JSWPxpSoqS.', 'active'),
('hanum2441@gm', '01234125689', 'hanum', 'hanum2441@gmail.com', 'Housekeeping Staff', '2024-06-07', 'jalan puteri 4/5', 'Selangor', '45567', 'Malaysia', '$2y$10$caBQq6HL.LOl857kMKrAoeTyX1UcXGW6xOaYhmyPuHDfH7L0.K1WO', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_customer_booking` (`customer_id`),
  ADD KEY `fk_booking_room_id` (`room_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_customer_id` (`customer_id`),
  ADD KEY `fk_payment_booking_id` (`booking_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `fk_customer_booking` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `fk_payment_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
