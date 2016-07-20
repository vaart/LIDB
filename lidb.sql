-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2016 at 12:07 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olsen_app1`
--

-- --------------------------------------------------------

--
-- Table structure for table `liquors`
--

CREATE TABLE `liquors` (
  `liquorID` int(11) NOT NULL,
  `liquorName` varchar(255) NOT NULL,
  `liquorType` varchar(255) NOT NULL,
  `liquorManufacturer` varchar(255) NOT NULL,
  `liquorAge` int(11) NOT NULL,
  `liquorCountryOfOrigin` varchar(255) NOT NULL,
  `liquorRating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `verificationToken` varchar(15) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `auth`, `city`, `verificationToken`, `verified`, `dateCreated`) VALUES
(12, '1', 'sha256:1000:WUwdPQ08GuNBtMZp&#47;iWzkO1hNpwadoJw:CT2GTeT6rJYh6sWr+EHKEdmcEuiCz2jV', '', '60WS_JQa8L', 0, '2016-07-19 21:48:19'),
(13, '2', 'sha256:1000:Py7xLLHIDOQshZWL&#47;Q5n9w9JHzhTSIxH:0BvCWYID+btJ+tIIBGEGRjQzb2OdlCRW', '', 'Pgw2@9~N1d', 0, '2016-07-19 21:50:14'),
(14, '3', 'sha256:1000:ln&#47;UoLvCKCB5mrQlR0SD0qrxf&#47;kvpT4k:H14geJFZeKbXvVRVK9aSDJlZJyrniYDO', '', 'a4LMCNzaCU', 0, '2016-07-19 21:51:07'),
(15, '6', 'sha256:1000:fHu1UVoZ0qBW+IDqQv0RQITE0PJvjwE1:6OKdDX8bpPXaLpDe7WDXBaCku0qwfRhh', '', 'R_bgmHLRCd', 0, '2016-07-19 23:48:41'),
(16, '1111', 'sha256:1000:w5mJh9Mbh9tP2Mu8cYWn4sMS3A+IApQQ:nAQ8BuoS6nV7TXvp8Fzl7bQghh8p8xQ+', '', 'BvfLWXgGP@', 0, '2016-07-20 00:24:48'),
(17, '123', 'sha256:1000:WNFp0+s2fFgejMK8RtsFr8fD9d7M1Vi3:RUWhg80hMsFCrCUHAk2PculainKtQdZ1', '', 'vZIbsh17B9', 0, '2016-07-20 00:37:02'),
(18, '1234', 'sha256:1000:zCv2bpw5hcpXYDDdJ23ZeQ65uub1W1UG:Zn8Ex4ta3rNj0hZRlriy+2aicGP3rFGF', '', 'ztEYXBUlDN', 0, '2016-07-20 00:37:37'),
(19, '12345', 'sha256:1000:sSKfM33TlVeJzG5SsHAZIkEOw&#47;WGnPaE:QNfYwbbIfufgDdvCl3Xb4gpTbIy2OH1E', '', 'R12nzsH@UU', 0, '2016-07-20 00:47:36'),
(20, '123456', 'sha256:1000:6xK+3TPOVBuTr8cAOkcYq+O6piGuhGJB:SU3h+GFO3qfBMibl&#47;gTjGiGSKU8KLJEz', '', 'VUS4kPFgmJ', 0, '2016-07-20 00:47:40'),
(21, 'qqqq', 'sha256:1000:JpfsyRhKtgQ7FKtR0uHqTlVm03PmSj+y:O+Rpoiorb3KOEPl+ry9yhm9vjk5ltXMa', '', 'i8GZxprunE', 0, '2016-07-20 00:47:45'),
(22, 'Roman', 'sha256:1000:bEhcDUAe4xkPXheMoAjRd1RT6iwh1Hu3:zgtyTNsu3NRdB4f9kXVPJ1Md55Hxg2Wr', '', 'itXSA3Yp@l', 0, '2016-07-20 01:55:06'),
(23, 'Roman1', 'sha256:1000:p2LA4Wgjqb1KZ7waP56+AEgpMKGTzg&#47;D:bgVSZq6MrYfo68B8E63xj7ltfltX1bk5', 'Brooklyn', 'nciT7NCLQr', 0, '2016-07-20 02:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `umID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `fieldKey` varchar(255) NOT NULL,
  `fieldValue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`umID`, `userID`, `fieldKey`, `fieldValue`) VALUES
(2, 12, 'u_name', ''),
(3, 12, 'u_name', ''),
(4, 12, 'u_name', ''),
(5, 12, 'u_name', ''),
(6, 12, 'u_name', ''),
(7, 12, 'u_name', ''),
(8, 12, 'u_name', ''),
(9, 12, 'u_name', ''),
(10, 12, 'u_name', ''),
(11, 12, 'u_name', ''),
(12, 12, 'u_name', ''),
(13, 12, 'u_name', ''),
(14, 12, 'u_name', ''),
(15, 12, 'u_name', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `sesID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `sessionID` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `browsername` varchar(255) NOT NULL,
  `browserversion` varchar(255) NOT NULL,
  `osplatform` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`sesID`, `userID`, `sessionID`, `active`, `browsername`, `browserversion`, `osplatform`, `dateCreated`) VALUES
(2, 12, 'd0b4htus04dh28ih5kr8vpe914', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 21:48:48'),
(3, 12, '8bocimd51rd3hog8j415s1fd63', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 23:32:04'),
(4, 13, '47ru8knr8li1dlglfjommnpoo4', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 21:51:02'),
(5, 14, 'h2n9v1v6brucmklf2igv69nvs0', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 21:51:13'),
(6, 14, 'qr57jo3i1v7vgoobp5bg3j9lm7', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 21:51:16'),
(7, 12, 'rqstot10mbdkjpvov06tnj6si4', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 23:32:15'),
(8, 12, '22rlm50nopsrl1pfc6voj5tv63', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 23:33:00'),
(9, 15, 'cdvmauk9koq23ss1d5j9rjjnm0', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-19 23:59:20'),
(10, 16, '0aojhfd99gldl05q0rqk2fe4g5', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 00:36:52'),
(11, 17, '9mik30k602cn237h2okdo4p5r5', 1, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 00:37:02'),
(12, 18, '98gop9oq6q1080j98f4kq8b9i3', 1, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 00:37:37'),
(13, 19, 'erto0249j85glercbl98ror6l3', 1, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 00:47:36'),
(14, 20, '5su0pmpomp11es1feh4nms5he5', 1, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 00:47:40'),
(15, 21, 'tm8scvupp57reoq2mb0e6fn1n4', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 01:07:57'),
(16, 12, 'acqvu5h2v1e7kbips6jds2uju6', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 01:26:24'),
(17, 22, 'a8ja8e3fh75e3frm7okqsfe6e5', 1, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 01:55:06'),
(18, 12, 'e0h7am6442v8b31ufe5oh4hef7', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 02:16:18'),
(19, 12, '59vkr52tq1vvbmmt0f6g5sna45', 0, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 02:28:31'),
(20, 23, '7a7q649cgg9bqc31pdqrhdg6b5', 1, 'Apple Safari', '9.1.2', 'mac', '2016-07-20 02:28:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `liquors`
--
ALTER TABLE `liquors`
  ADD PRIMARY KEY (`liquorID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`umID`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`sesID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `liquors`
--
ALTER TABLE `liquors`
  MODIFY `liquorID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `umID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `sesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
