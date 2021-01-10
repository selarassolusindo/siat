-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2021 at 11:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siat`
--

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
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t01_company`
--

CREATE TABLE `t01_company` (
  `idcompany` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `Group_Kode` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t01_company`
--

INSERT INTO `t01_company` (`idcompany`, `Nama`, `Alamat`, `Kota`, `Group_Kode`, `created_at`, `updated_at`) VALUES
(1, 'PT LTS', 'Andhika Plaza', 'Surabaya', 'LTS', '2021-01-02 11:39:38', '2021-01-02 11:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `t02_customer`
--

CREATE TABLE `t02_customer` (
  `idcustomer` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t02_customer`
--

INSERT INTO `t02_customer` (`idcustomer`, `Kode`, `Nama`, `Alamat`, `Kota`, `created_at`, `updated_at`) VALUES
(1, 'C0001', 'Cus1', 'Ala1', 'Kot1', '2021-01-03 15:38:53', '2021-01-03 15:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `t03_shipper`
--

CREATE TABLE `t03_shipper` (
  `idshipper` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t03_shipper`
--

INSERT INTO `t03_shipper` (`idshipper`, `Kode`, `Nama`, `Alamat`, `Kota`, `created_at`, `updated_at`) VALUES
(1, 'S0001', 'Nam1', 'Ala1', 'Kot1', '2021-01-03 17:23:27', '2021-01-03 17:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `t04_vendor`
--

CREATE TABLE `t04_vendor` (
  `idvendor` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t04_vendor`
--

INSERT INTO `t04_vendor` (`idvendor`, `Kode`, `Nama`, `Alamat`, `Kota`, `created_at`, `updated_at`) VALUES
(1, 'V0001', 'Ven1xy', 'Ala1xy', 'Kot1xy', '2021-01-09 05:48:18', '2021-01-09 12:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `t05_armada`
--

CREATE TABLE `t05_armada` (
  `idarmada` int(11) NOT NULL,
  `Kode` varchar(5) NOT NULL,
  `Merk` varchar(50) NOT NULL,
  `Nopol` varchar(15) NOT NULL,
  `Norangka` varchar(50) NOT NULL,
  `Nomesin` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t05_armada`
--

INSERT INTO `t05_armada` (`idarmada`, `Kode`, `Merk`, `Nopol`, `Norangka`, `Nomesin`, `created_at`, `updated_at`) VALUES
(1, 'A0001', 'Mer1x', 'Nop1y', 'Nor1z', 'Nom1a', '2021-01-10 14:19:59', '2021-01-10 14:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `t06_sparepart`
--

CREATE TABLE `t06_sparepart` (
  `idsparepart` int(11) NOT NULL,
  `Kode` varchar(6) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t06_sparepart`
--

INSERT INTO `t06_sparepart` (`idsparepart`, `Kode`, `Nama`, `created_at`, `updated_at`) VALUES
(1, 'SP0001', 'Banx', '2021-01-10 16:53:44', '2021-01-10 16:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0');

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
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t01_company`
--
ALTER TABLE `t01_company`
  ADD PRIMARY KEY (`idcompany`);

--
-- Indexes for table `t02_customer`
--
ALTER TABLE `t02_customer`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indexes for table `t03_shipper`
--
ALTER TABLE `t03_shipper`
  ADD PRIMARY KEY (`idshipper`) USING BTREE;

--
-- Indexes for table `t04_vendor`
--
ALTER TABLE `t04_vendor`
  ADD PRIMARY KEY (`idvendor`) USING BTREE;

--
-- Indexes for table `t05_armada`
--
ALTER TABLE `t05_armada`
  ADD PRIMARY KEY (`idarmada`);

--
-- Indexes for table `t06_sparepart`
--
ALTER TABLE `t06_sparepart`
  ADD PRIMARY KEY (`idsparepart`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t01_company`
--
ALTER TABLE `t01_company`
  MODIFY `idcompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t02_customer`
--
ALTER TABLE `t02_customer`
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t03_shipper`
--
ALTER TABLE `t03_shipper`
  MODIFY `idshipper` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t04_vendor`
--
ALTER TABLE `t04_vendor`
  MODIFY `idvendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t05_armada`
--
ALTER TABLE `t05_armada`
  MODIFY `idarmada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t06_sparepart`
--
ALTER TABLE `t06_sparepart`
  MODIFY `idsparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
