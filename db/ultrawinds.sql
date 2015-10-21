-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2015 at 10:43 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smc_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodation`
--

CREATE TABLE IF NOT EXISTS `accommodation` (
  `accommodation_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `accommodation_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accommodation_line`
--

CREATE TABLE IF NOT EXISTS `accommodation_line` (
  `accommodation_line_id` int(11) NOT NULL,
  `accommodation_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE IF NOT EXISTS `amenities` (
  `Amenities_id` int(11) NOT NULL,
  `Amenities_name` varchar(30) NOT NULL,
  `Amenities_description` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amenities_line`
--

CREATE TABLE IF NOT EXISTS `amenities_line` (
  `Amenities_line_id` int(11) NOT NULL,
  `Amenities_id` int(11) NOT NULL,
  `Room_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `Guest_id` int(11) NOT NULL,
  `Guest_email` varchar(30) NOT NULL,
  `Guest_password` varchar(25) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `Guest_address` varchar(30) NOT NULL,
  `Guest_contact_number` varchar(11) NOT NULL,
  `Company_Group` varchar(30) NOT NULL,
  `Guest_joindate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `inv_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `payable` int(11) NOT NULL,
  `Money` int(11) NOT NULL,
  `Money_change` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_id`, `reservation_id`, `payable`, `Money`, `Money_change`) VALUES
(1, 1, 1000, 1000, 0),
(2, 4, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `item_desc` varchar(30) NOT NULL,
  `item_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_desc`, `item_price`) VALUES
(1, 'pillow', 'pillow for all', 100),
(2, 'habol', 'habol ni', 100),
(3, 'bulad', 'bulad ni', 200),
(4, 'gapas', 'gapas with galoon', 200),
(5, 'bed', 'bed ni sya', 200);

-- --------------------------------------------------------

--
-- Table structure for table `other_services`
--

CREATE TABLE IF NOT EXISTS `other_services` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_services`
--

INSERT INTO `other_services` (`id`, `name`, `price`, `date`) VALUES
(1, ' Projector ', 1499, '0000-00-00 00:00:00'),
(2, 'Karaoke ', 449, '0000-00-00 00:00:00'),
(3, 'Horse Back Riding', 200, '0000-00-00 00:00:00'),
(4, 'Day Cottages ', 499, '0000-00-00 00:00:00'),
(5, 'Shuttle Service Roundtrip ', 899, '0000-00-00 00:00:00'),
(6, 'Shuttle Drop Only ', 499, '0000-00-00 00:00:00'),
(7, 'Toyota Super Grandia Van Round Trip ', 1499, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `other_services_details`
--

CREATE TABLE IF NOT EXISTS `other_services_details` (
  `id` int(25) NOT NULL,
  `reservation_id` int(25) NOT NULL,
  `other_services_id` int(25) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_services_details`
--

INSERT INTO `other_services_details` (`id`, `reservation_id`, `other_services_id`, `date`) VALUES
(51, 12, 1, '0000-00-00 00:00:00'),
(52, 13, 6, '0000-00-00 00:00:00'),
(53, 11, 1, '0000-00-00 00:00:00'),
(54, 11, 2, '0000-00-00 00:00:00'),
(55, 18, 2, '0000-00-00 00:00:00'),
(56, 18, 2, '0000-00-00 00:00:00'),
(57, 18, 2, '0000-00-00 00:00:00'),
(58, 19, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `personel`
--

CREATE TABLE IF NOT EXISTS `personel` (
  `pid` int(25) NOT NULL,
  `p_email` varchar(50) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_pass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `Reservation_id` int(11) NOT NULL,
  `Guest_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `Check_in_date` date NOT NULL,
  `Check_out_date` date NOT NULL,
  `rETA` time NOT NULL,
  `TotalPayable` int(25) NOT NULL,
  `DownPayment` int(25) NOT NULL,
  `status` varchar(30) NOT NULL,
  `Reservation_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_line`
--

CREATE TABLE IF NOT EXISTS `reservation_line` (
  `Reservation_line_id` int(11) NOT NULL,
  `Reservation_id` int(11) NOT NULL,
  `Room_id` int(11) NOT NULL,
  `subtotal` int(25) NOT NULL,
  `Tadults` int(11) NOT NULL,
  `Tchildren` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `Room_id` int(11) NOT NULL,
  `Room_number` int(11) NOT NULL,
  `room_desc` text NOT NULL,
  `Room_name` varchar(255) NOT NULL,
  `Room_price` int(25) NOT NULL,
  `qty` int(20) NOT NULL,
  `Room_dateuploaded` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_id`, `Room_number`, `room_desc`, `Room_name`, `Room_price`, `qty`, `Room_dateuploaded`) VALUES
(1, 1, 'Superior King', 'Superior King', 2099, 3, '2014-02-12'),
(2, 2, 'Premier King', 'Premier King', 3799, 1, '2014-02-14'),
(3, 3, 'standard double', 'standard double', 1799, 1, '0000-00-00'),
(4, 4, 'Deluxe Double', 'Deluxe Double', 2099, 10, '0000-00-00'),
(5, 5, '<br>Includes 2 bedrooms, 2 bathrooms\nkitchenette, big private veranda.\n<br> contains 3 double beds in total.\n<br>Max 15 guests if using existing bedding.\n<br>Does not come with breakfast.', 'Guest House/Villa', 6999, 1, '0000-00-00'),
(6, 6, 'Dual Cable', 'Zipline', 300, 1, '0000-00-00'),
(7, 7, 'Safari Tent Camping', 'Safari Tent Camping', 999, 10, '0000-00-00'),
(8, 8, 'Accommodates seated events for up to 160 guests. Minimum 50 guests required to use the venue.', 'Amphitheater', 10000, 1, '0000-00-00'),
(9, 9, 'Accommodates seated events for up to 60 guests. For a wedding ceremony setup, up to 100 guests may be accommodated.', 'Pavilion', 8000, 1, '0000-00-00'),
(10, 10, 'The area features 15 bathroom stalls, and can easily accommodate at least 300 guests.', 'Winds Open Area', 600, 10, '0000-00-00'),
(11, 11, 'The upper area of Winds features 15 bathroom stalls. The Multi-Purpose Giant Tents can accommodate at least 200 guests.', 'Multi Purpose Giant Tent', 6000, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `room_line`
--

CREATE TABLE IF NOT EXISTS `room_line` (
  `rdid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_line`
--

INSERT INTO `room_line` (`rdid`, `rid`) VALUES
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`accommodation_id`);

--
-- Indexes for table `accommodation_line`
--
ALTER TABLE `accommodation_line`
  ADD PRIMARY KEY (`accommodation_line_id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`Amenities_id`);

--
-- Indexes for table `amenities_line`
--
ALTER TABLE `amenities_line`
  ADD PRIMARY KEY (`Amenities_line_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`Guest_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `other_services`
--
ALTER TABLE `other_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_services_details`
--
ALTER TABLE `other_services_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_id`);

--
-- Indexes for table `reservation_line`
--
ALTER TABLE `reservation_line`
  ADD PRIMARY KEY (`Reservation_line_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_id`);

--
-- Indexes for table `room_line`
--
ALTER TABLE `room_line`
  ADD PRIMARY KEY (`rdid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `accommodation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `accommodation_line`
--
ALTER TABLE `accommodation_line`
  MODIFY `accommodation_line_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `Amenities_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `amenities_line`
--
ALTER TABLE `amenities_line`
  MODIFY `Amenities_line_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `Guest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `other_services`
--
ALTER TABLE `other_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `other_services_details`
--
ALTER TABLE `other_services_details`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `personel`
--
ALTER TABLE `personel`
  MODIFY `pid` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reservation_line`
--
ALTER TABLE `reservation_line`
  MODIFY `Reservation_line_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `room_line`
--
ALTER TABLE `room_line`
  MODIFY `rdid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
