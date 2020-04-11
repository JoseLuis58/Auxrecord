-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 02:02 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auxrecord`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(10) NOT NULL,
  `BitacoraCodigo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraFecha` date NOT NULL,
  `BitacoraHoraInicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraHoraFinal` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraTipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraYear` int(4) NOT NULL,
  `CodeBita` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `care`
-- (See below for the actual view)
--
CREATE TABLE `care` (
`Id_Person` int(10)
,`Name_Person` varchar(20)
,`Egress_Hospital` varchar(3)
,`Observations` varchar(100)
,`Recommendation` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `medical_care`
--

CREATE TABLE `medical_care` (
  `Id_P` int(10) NOT NULL,
  `Egress_Hospital` varchar(3) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Observations` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Recommendation` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `Id_Medical` int(10) NOT NULL,
  `DNI_Person` int(11) NOT NULL,
  `Name_Person` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Adress` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Tel` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Place` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Pathogeny` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Family_Previous` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Food_Conditions` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nursing_event`
--

CREATE TABLE `nursing_event` (
  `Id_Nursing_Even` int(10) NOT NULL,
  `Id_Person` int(10) NOT NULL,
  `Name_Person` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Tel` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Adress` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Name_Acu` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Hour` datetime DEFAULT NULL,
  `Vital_Signs` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Reason_Consult` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `Id_Person` int(10) NOT NULL,
  `DNI_Person` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NULL',
  `Name_Person` varchar(60) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Last_Person` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Tel_Person` varchar(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Adress` char(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Rol` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `Code_Person` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`Id_Person`, `DNI_Person`, `Name_Person`, `Last_Person`, `Tel_Person`, `Adress`, `Rol`, `Code_Person`) VALUES
(1, '20113439', 'Malely', 'Santana Barbosa', '1371029201', 'Cra 131 # 134-44', 'Administrador', 'AC2070099-5');

-- --------------------------------------------------------

--
-- Table structure for table `studient`
--

CREATE TABLE `studient` (
  `Id_Studient` int(10) NOT NULL,
  `Grade` varchar(6) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Direc_Grade` varchar(60) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(10) NOT NULL,
  `Username` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Password` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Email` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Rol` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Photo` varchar(525) COLLATE utf8_spanish2_ci NOT NULL,
  `Gender` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `Code_Account` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Username`, `Password`, `Email`, `Rol`, `Photo`, `Gender`, `Code_Account`) VALUES
(1, 'MalelyB', 'FeyAlegria2020', 'malesaba@gmail.com', 'Administrador', 'TeacherFemaleAvatar.png', 'Femenino', 'AC2070099-5');

-- --------------------------------------------------------

--
-- Structure for view `care`
--
DROP TABLE IF EXISTS `care`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `care`  AS  select `nursing_event`.`Id_Person` AS `Id_Person`,`nursing_event`.`Name_Person` AS `Name_Person`,`medical_care`.`Egress_Hospital` AS `Egress_Hospital`,`medical_care`.`Observations` AS `Observations`,`medical_care`.`Recommendation` AS `Recommendation` from (`nursing_event` join `medical_care` on(`nursing_event`.`Id_Person` = `medical_care`.`Id_P`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`Id_Medical`);

--
-- Indexes for table `nursing_event`
--
ALTER TABLE `nursing_event`
  ADD PRIMARY KEY (`Id_Nursing_Even`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`Id_Person`);
ALTER TABLE `person` ADD FULLTEXT KEY `Adress` (`Adress`);

--
-- Indexes for table `studient`
--
ALTER TABLE `studient`
  ADD PRIMARY KEY (`Id_Studient`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `Id_Medical` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nursing_event`
--
ALTER TABLE `nursing_event`
  MODIFY `Id_Nursing_Even` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `Id_Person` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
