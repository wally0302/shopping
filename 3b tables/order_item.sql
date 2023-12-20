-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-12-20 10:50:08
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `order_item`
--

CREATE TABLE `order_item` (
  `itemID` int(11) NOT NULL,
  `oID` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `order_item`
--

INSERT INTO `order_item` (`itemID`, `oID`, `pID`, `amount`) VALUES
(1, 1, 2, 1),
(2, 1, 3, 1),
(3, 1, 4, 1),
(4, 2, 3, 1),
(5, 2, 4, 1),
(6, 2, 5, 1),
(7, 3, 5, 1),
(8, 3, 6, 1),
(9, 3, 4, 1),
(10, 4, 1, 1),
(11, 4, 2, 1),
(12, 4, 3, 1),
(13, 5, 3, 1),
(14, 5, 4, 1),
(15, 5, 5, 1),
(16, 6, 1, 3),
(17, 6, 2, 3),
(18, 6, 5, 1),
(19, 6, 6, 1),
(20, 6, 3, 1),
(21, 7, 1, 2),
(22, 7, 2, 1),
(23, 7, 3, 1),
(24, 7, 4, 1),
(25, 8, 1, 2),
(26, 8, 2, 1),
(27, 8, 3, 1),
(28, 9, 1, 2),
(29, 9, 2, 1),
(30, 9, 3, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
