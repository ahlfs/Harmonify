-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 12:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harmonify`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `AlbumID` int(11) UNSIGNED NOT NULL,
  `NamaAlbum` varchar(255) NOT NULL,
  `DeskripsiAlbum` text NOT NULL,
  `TanggalAlbum` date NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`AlbumID`, `NamaAlbum`, `DeskripsiAlbum`, `TanggalAlbum`, `UserID`) VALUES
(2, 'a', 'a', '2024-02-12', 101),
(6, 'hay', '', '2024-02-26', 1),
(7, 'tess', '', '2024-02-26', 1),
(8, 'abbbc', '', '2024-02-26', 1),
(13, 'Beruang', '', '2024-02-26', 102),
(14, 'bebek', '', '2024-02-26', 103),
(16, 'Kelincib', '', '2024-03-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `FotoID` int(11) UNSIGNED NOT NULL,
  `JudulFoto` varchar(255) NOT NULL,
  `DeskripsiFoto` text NOT NULL,
  `TanggalUnggah` date NOT NULL,
  `LokasiFile` varchar(255) NOT NULL,
  `AlbumID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Url` text NOT NULL,
  `Foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`FotoID`, `JudulFoto`, `DeskripsiFoto`, `TanggalUnggah`, `LokasiFile`, `AlbumID`, `UserID`, `Url`, `Foto`) VALUES
(1, 'Garfield', 'Catt', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707527501_06fa707dae191862ff90.jpg'),
(2, 'Wakkooo', 'smileeee', '2024-02-10', '', 0, 1, 'https://www.instagram.com/', '1707527669_4b287ed5be2c1722b362.jpg'),
(3, 'The Elegant Cat', 'need some huh?', '2024-02-10', '', 0, 1, 'https://www.instagram.com/', '1707527734_281b0e05a0089cf5b209.jpg'),
(4, 'Rabbbiiitttt', 'awwww', '2024-02-10', '', 0, 1, 'https://www.instagram.com/', '1707527759_fedc76581ba05689d8e9.jpg'),
(5, 'Unknown', 'Disney villain?', '2024-02-10', '', 0, 1, 'https://www.instagram.com/', '1707527810_6315280a491170db5766.jpg'),
(6, 'Cuphead', 'one of the greatest game of all time', '2024-02-10', '', 0, 1, 'https://www.instagram.com/', '1707527889_e7bf1cdca84580124a0d.jpg'),
(7, 'Powerpuff wallpaper', '❤️❤️❤️', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707527934_3a19bbdbf64d34bb6b84.jpg'),
(8, 'We Are Bears, We Are Best', 'actt', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707527969_99a416c2714da54c099d.jpg'),
(9, 'Powerpuff girlss', 'Assemble!!', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707527998_72b20469e13017d38dd4.jpg'),
(10, 'We Are Bears Wallpaper 4k', '....', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707528030_8fa42246bdb48d349601.jpg'),
(11, 'Zootopia Wallpaper Android', 'cheeseeee', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707895228_69919b08554598d5af17.jpg'),
(12, 'We Are Bears Poster', 'cute frrr', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707528092_1469c6208fec4117aa78.jpg'),
(13, 'Doctor', '????????????', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1709476379_61ed22592761b97202da.jpg'),
(14, 'Family Guys', 'just drinking soda', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707528227_5e7fd22a2d96cea02d0f.jpg'),
(15, 'Duckk', 'why he looks little upset?', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1707528269_d341bfb8e6907652382e.jpg'),
(16, 'Dinosaurrr attackkk in NYC', 'its green though', '2024-02-10', '', 0, 1, 'https://www.facebook.com/profile.php?id=100081067495764', '1709474900_32c4ee0e9bfd71149d79.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fotoalbum`
--

CREATE TABLE `fotoalbum` (
  `FotoAlbumID` int(11) UNSIGNED NOT NULL,
  `FotoID` int(11) UNSIGNED NOT NULL,
  `AlbumID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fotoalbum`
--

INSERT INTO `fotoalbum` (`FotoAlbumID`, `FotoID`, `AlbumID`) VALUES
(5, 2, 7),
(7, 23, 13),
(8, 24, 14),
(15, 6, 7),
(16, 4, 16),
(17, 13, 16);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `KomentarID` int(11) UNSIGNED NOT NULL,
  `FotoID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  `IsiKomentar` text NOT NULL,
  `TanggalKomentar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`KomentarID`, `FotoID`, `UserID`, `IsiKomentar`, `TanggalKomentar`) VALUES
(5, 12, 1, 'yey', '2024-02-13 20:23:54'),
(6, 7, 1, 'hayy', '2024-02-26 08:43:27'),
(11, 14, 1, 'Keren bgt woilah', '2024-03-01 09:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `LikeID` int(11) UNSIGNED NOT NULL,
  `FotoID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  `TanggalLike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`LikeID`, `FotoID`, `UserID`, `TanggalLike`) VALUES
(12, 12, 1, '2024-03-01'),
(13, 14, 1, '2024-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(25, '2024-01-07-075134', 'App\\Database\\Migrations\\Foto', 'default', 'App', 1707526346, 1),
(26, '2024-01-07-075153', 'App\\Database\\Migrations\\User', 'default', 'App', 1707526346, 1),
(27, '2024-01-07-075232', 'App\\Database\\Migrations\\Likefoto', 'default', 'App', 1707526346, 1),
(28, '2024-01-07-075244', 'App\\Database\\Migrations\\Komentarfoto', 'default', 'App', 1707526346, 1),
(29, '2024-01-07-081012', 'App\\Database\\Migrations\\Album', 'default', 'App', 1707526346, 1),
(30, '2024-02-10-003448', 'App\\Database\\Migrations\\FotoAlbum', 'default', 'App', 1707526346, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) UNSIGNED NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `PhotoProfile` varchar(255) NOT NULL,
  `Active` varchar(255) NOT NULL,
  `ActiveExpired` datetime DEFAULT NULL,
  `ResetToken` varchar(255) NOT NULL,
  `ResetTokenExpired` datetime DEFAULT NULL,
  `TemporaryEmail` varchar(255) NOT NULL,
  `TemporaryEmailToken` varchar(255) NOT NULL,
  `TemporaryEmailExpired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `PhotoProfile`, `Active`, `ActiveExpired`, `ResetToken`, `ResetTokenExpired`, `TemporaryEmail`, `TemporaryEmailToken`, `TemporaryEmailExpired`) VALUES
(1, 'ahlfs', '6c4f51b6654e83fb2dde0878cc57dbeb', 'ahlulfirdaus@gmail.com', 'Ahlull', '', '1709443803_b359a3d726d20a0c63ba.jpg', 'true', NULL, '', NULL, '', '', NULL),
(101, 'vaniaa', '6c4f51b6654e83fb2dde0878cc57dbeb', 'ahlulf30@gmail.com', '', '', '1707548788_d044b896f97c1354d0b1.jpg', 'true', '2024-02-11 14:00:03', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00'),
(103, 'ahlulfirdaus', '784a01c2951e90c8124f18568f70efc3', 'ahlulffirdaus@gmail.com', 'Ahlul Firdaus', '', '1708937265_8e18abebda43dbcab700.jpg', 'true', '2024-02-27 15:45:25', 'AZ2vBrBcFHgywH4f0FvogornhNVp1Mj91709008060', '2024-02-28 11:27:40', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`AlbumID`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`FotoID`);

--
-- Indexes for table `fotoalbum`
--
ALTER TABLE `fotoalbum`
  ADD PRIMARY KEY (`FotoAlbumID`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`KomentarID`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`LikeID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `AlbumID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `FotoID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `fotoalbum`
--
ALTER TABLE `fotoalbum`
  MODIFY `FotoAlbumID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `KomentarID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `LikeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
