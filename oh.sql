-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 07, 2021 at 02:31 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oh`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachements`
--

CREATE TABLE `attachements` (
  `id` int(11) NOT NULL,
  `img_scr` text,
  `client_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_title` varchar(200) NOT NULL DEFAULT 'Mr',
  `client_names` varchar(100) NOT NULL,
  `serial_code` varchar(200) DEFAULT NULL,
  `client_nin` varchar(25) DEFAULT NULL,
  `client_contact` varchar(75) NOT NULL,
  `area_code` varchar(20) DEFAULT NULL,
  `plot_desc` text,
  `entity_type` varchar(100) NOT NULL DEFAULT 'Individual',
  `client_type` varchar(100) DEFAULT NULL,
  `reg_stat` int(11) DEFAULT '1',
  `profile_pic` varchar(200) NOT NULL DEFAULT 'no-image.png',
  `client_created_by` int(11) NOT NULL,
  `client_created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `national_ids`
--

CREATE TABLE `national_ids` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner_type` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

CREATE TABLE `next_of_kin` (
  `id` int(11) NOT NULL,
  `nok_names` varchar(100) NOT NULL,
  `nok_nin` varchar(25) NOT NULL,
  `nok_contact` varchar(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `nok_rel` varchar(100) NOT NULL,
  `nin_stat` varchar(3) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plots_assignment`
--

CREATE TABLE `plots_assignment` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `plot_type` varchar(255) NOT NULL,
  `plot_category` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plots_table`
--

CREATE TABLE `plots_table` (
  `id` int(11) NOT NULL,
  `plot_phase` varchar(100) NOT NULL,
  `plot_number` int(11) DEFAULT NULL,
  `plot_specifications` varchar(100) NOT NULL,
  `plot_measure_unit` varchar(100) NOT NULL,
  `plot_description` text,
  `plot_lat` varchar(100) DEFAULT NULL,
  `plot_long` varchar(100) DEFAULT NULL,
  `prev_owner` varchar(150) DEFAULT NULL,
  `serial_number` int(11) DEFAULT NULL,
  `plot_category` varchar(110) DEFAULT NULL,
  `plot_cost` int(15) NOT NULL,
  `plot_stat` int(11) NOT NULL DEFAULT '1',
  `plot_created_by` int(11) NOT NULL,
  `plot_created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachements`
--
ALTER TABLE `attachements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `national_ids`
--
ALTER TABLE `national_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `next_of_kin`
--
ALTER TABLE `next_of_kin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots_assignment`
--
ALTER TABLE `plots_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots_table`
--
ALTER TABLE `plots_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachements`
--
ALTER TABLE `attachements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `national_ids`
--
ALTER TABLE `national_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `next_of_kin`
--
ALTER TABLE `next_of_kin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plots_assignment`
--
ALTER TABLE `plots_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plots_table`
--
ALTER TABLE `plots_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
