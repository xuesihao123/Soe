-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2020-05-25 09:13:51
-- 服务器版本： 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soe`
--

-- --------------------------------------------------------

--
-- 表的结构 `soe_comment`
--

CREATE TABLE `soe_comment` (
  `comment_Id` int(11) NOT NULL,
  `movie_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `comment_Content` varchar(2000) NOT NULL,
  `comment_Date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `soe_movie`
--

CREATE TABLE `soe_movie` (
  `movie_Id` int(11) NOT NULL,
  `movie_Name` varchar(100) NOT NULL,
  `movie_Type` varchar(10) NOT NULL,
  `movie_Brief` varchar(500) NOT NULL,
  `movie_Start` date NOT NULL,
  `movie_End` date NOT NULL,
  `movie_Time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `soe_order`
--

CREATE TABLE `soe_order` (
  `order_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `performance_Id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `soe_performance`
--

CREATE TABLE `soe_performance` (
  `performance_Id` int(11) NOT NULL,
  `movie_Id` int(11) NOT NULL,
  `theater_Id` int(11) NOT NULL,
  `performance_Start` datetime NOT NULL,
  `performance_End` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `soe_performance`
--

INSERT INTO `soe_performance` (`performance_Id`, `movie_Id`, `theater_Id`, `performance_Start`, `performance_End`) VALUES
(1, 1, 0, '2020-01-12 23:23:12', '2020-01-12 23:23:50');

-- --------------------------------------------------------

--
-- 表的结构 `soe_seat`
--

CREATE TABLE `soe_seat` (
  `seat_Id` int(11) NOT NULL,
  `theater_Id` int(11) NOT NULL,
  `seat_Col` int(11) NOT NULL,
  `seat_Row` int(11) NOT NULL,
  `seat_status` int(11) NOT NULL,
  `performance_Id` int(11) NOT NULL,
  `performance_End` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `soe_theater`
--

CREATE TABLE `soe_theater` (
  `theater_Id` int(11) NOT NULL,
  `theater_colnum` int(11) NOT NULL,
  `theater_rownum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `soe_user`
--

CREATE TABLE `soe_user` (
  `user_Id` int(11) NOT NULL,
  `user_Name` varchar(20) NOT NULL,
  `user_Password` varchar(100) NOT NULL,
  `user_Status` int(11) NOT NULL COMMENT '1为正常，2为冻结，3为注销,4为管理员',
  `user_Email` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `soe_user`
--

INSERT INTO `soe_user` (`user_Id`, `user_Name`, `user_Password`, `user_Status`, `user_Email`) VALUES
(1, 'xuesihao', 'e10adc3949ba59abbe56e057f20f883e', 1, '754769243@qq.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `soe_comment`
--
ALTER TABLE `soe_comment`
  ADD PRIMARY KEY (`comment_Id`);

--
-- Indexes for table `soe_movie`
--
ALTER TABLE `soe_movie`
  ADD PRIMARY KEY (`movie_Id`);

--
-- Indexes for table `soe_order`
--
ALTER TABLE `soe_order`
  ADD PRIMARY KEY (`order_Id`);

--
-- Indexes for table `soe_performance`
--
ALTER TABLE `soe_performance`
  ADD PRIMARY KEY (`performance_Id`);

--
-- Indexes for table `soe_theater`
--
ALTER TABLE `soe_theater`
  ADD PRIMARY KEY (`theater_Id`);

--
-- Indexes for table `soe_user`
--
ALTER TABLE `soe_user`
  ADD PRIMARY KEY (`user_Id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `soe_comment`
--
ALTER TABLE `soe_comment`
  MODIFY `comment_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `soe_movie`
--
ALTER TABLE `soe_movie`
  MODIFY `movie_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `soe_order`
--
ALTER TABLE `soe_order`
  MODIFY `order_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `soe_performance`
--
ALTER TABLE `soe_performance`
  MODIFY `performance_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `soe_theater`
--
ALTER TABLE `soe_theater`
  MODIFY `theater_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `soe_user`
--
ALTER TABLE `soe_user`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`root`@`localhost` EVENT `删除过期的演出计划的座位` ON SCHEDULE EVERY 1 DAY STARTS '2020-05-24 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM soe_seat WHERE now()>performance_End$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
