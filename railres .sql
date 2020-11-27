SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railres`
--

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `card` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`u_name`,`card`);

-- INSERT INTO `users` (`f_name`, `l_name`, `email`, `password`, `gender`, `dob`, `mobile`) VALUES
-- ('ayush', 'tripathi', 'ayushtripathi51@gmail.com', '123456789', 'male','1999-04-02', 9453890182);


--
-- Table structure for table `train_list`
--
CREATE TABLE `train_list` (
  `Number` int(6) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Origin` varchar(20) NOT NULL,
  `Destination` varchar(20) NOT NULL,
  `Arrival` varchar(10) NOT NULL,
  `Departure` varchar(10) NOT NULL,
  `AC` int(11) NOT NULL,
  `SL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `train_list`
  ADD PRIMARY KEY (`Number`);

-- INSERT INTO `train_list` (`Number`, `Name`, `Origin`, `Destination`, `Arrival`, `Departure`, `AC`, `SL`) VALUES
-- (12009, 'SHATABDI EXP', 'BCT', 'ADI', '22:15', '06:25', 2500, 1000);

--
-- Table structure for table `booking`
--
CREATE TABLE `booking` (
  `uname` varchar(50) NOT NULL,
  `Tnumber` int(6) NOT NULL,
  `class` varchar(2) NOT NULL,
  `doj` date NOT NULL,
  `DOB` date NOT NULL,
  `fromstn` varchar(20) NOT NULL,
  `tostn` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `pnr` varchar(20) NOT NULL,
  `Aadhar` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- INSERT INTO `booking` (`uname`, `Tnumber`, `class`, `doj`, `DOB`, `fromstn`, `tostn`, `Name`, `Age`, `sex`, `Status`) VALUES
-- ('rishabh', 12009, '2A', '2017-04-28', '2017-04-26', 'SURAT', 'BARODA', 'rishabh', 20, 'male', 'seat details');

ALTER TABLE `booking`
  ADD PRIMARY KEY (`Aadhar`,`pnr`);


--
-- Table structure for table `seats_availability`
--
CREATE TABLE `seats_availability` (
  `train_no` int(6) NOT NULL,
  `train_name` varchar(20) NOT NULL,
  `doj` date NOT NULL,
  `AC` int(11) NOT NULL,
  `SL` int(11) NOT NULL,
  `AC_cnt` int(11) NOT NULL,
  `SL_cnt` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- INSERT INTO `seats_availability` (`train_no`, `train_name`, `doj`, `AC`, `SL`,`AC_cnt`,`SL_cnt`) VALUES
-- (12009, 'SHATABDI EXP', '2020-11-24', 5,5,90,120);

ALTER TABLE `seats_availability`
  ADD PRIMARY KEY (`train_no`,`doj`);

--
-- Table structure for table `interlist`
--
CREATE TABLE `interlist` (
`trainno` int(6) NOT NULL,
`trainname` varchar(20) NOT NULL,
`doj` date NOT NULL,
`route` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `interlist`
  ADD PRIMARY KEY (`trainno`,`doj`);

-- INSERT INTO `interlist` (`trainno`, `route`) VALUES
-- (12009, 'a(12:40#12:50),b(13:10#14:15),x(14:35#14:45),y(15:00#15:05),c(20:40#20:45)'),
-- (12931, 'k(11:15#12:50),x(14:30#14:32),y(15:55#16:00),l(16:23#16:30),c(17:35#17:40)');
-- Pad(22:30),x(22:50),y(14:30),Man(12:40)


-- AJMER(12:40#12:50),DELHI(13:10#13:45),AMBALA(14:35#14:45),CHANDIGARH(15:00#15:05),ROPAR(20:40#20:45)

-- DELHI(11:15#11:35),AMBALA(14:30#14:32),CHANDIGARH(15:55#16:00),MOHALI(16:23#16:30),ROPAR(17:35#17:40)

-- NARNAUL(10:00#10:25),REWARI(11:10#11:15),DELHI(12:40#12:55),AMBALA(13:35#13:50),CHANDIGARH(14:55#15:10),ROPAR(16:00,16:10)

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;