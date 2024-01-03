-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-12-29 16:36:39
-- 服务器版本： 5.7.40-log
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `jbdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `bet_types`
--

CREATE TABLE `bet_types` (
  `Id` int(11) NOT NULL,
  `Display` varchar(255) DEFAULT NULL COMMENT '显示名称',
  `Regex` varchar(255) DEFAULT NULL COMMENT '下注指令名称',
  `Bet_Min` int(11) DEFAULT NULL COMMENT '最小下注',
  `Bet_Max` int(11) DEFAULT NULL COMMENT '最大下注',
  `Bet_Max_Total` int(11) DEFAULT NULL COMMENT '最大总下注',
  `Odds` decimal(11,2) DEFAULT NULL COMMENT '赔率',
  `Create_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `Update_Date` timestamp NULL DEFAULT NULL COMMENT '更新日期\r\n',
  `type` int(11) DEFAULT '0' COMMENT '代码逻辑里的type,详细内容参考代码',
  `value` int(11) DEFAULT '0' COMMENT '扩展值,用来表示和值',
  `玩法` varchar(255) DEFAULT NULL,
  `赔率类型` varchar(255) DEFAULT NULL,
  `业务玩法` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `bet_types`
--

INSERT INTO `bet_types` (`Id`, `Display`, `Regex`, `Bet_Min`, `Bet_Max`, `Bet_Max_Total`, `Odds`, `Create_Date`, `Update_Date`, `type`, `value`, `玩法`, `赔率类型`, `业务玩法`) VALUES
(25, '特码球玩法', '\\d\\/\\d\\/\\d+', 1000, 1000000, 1000000, '9.50', '2023-08-03 12:09:28', '2023-09-06 17:52:43', 0, 0, '特码球玩法', '特码球赔率', '特码球玩法'),
(26, '特码球大小单双玩法', '\\d\\/[大小单双]\\/\\d+', 1000, 3000000, 3000000, '1.98', '2023-08-03 12:11:35', '2023-09-06 17:52:43', 0, 0, '特码球大小单双玩法', '特码球大小单双赔率', '特码球玩法'),
(28, '龙虎和玩法龙虎', '[龙虎]\\d+', 1000, 3000000, 3000000, '1.98', '2023-08-04 05:38:07', '2023-09-06 17:52:43', 0, 0, '龙虎和玩法龙虎', '龙虎赔率', '龙虎和玩法'),
(29, '和值大小单双玩法', '[大小单双]\\d+', 1000, 5000000, 5000000, '1.98', '2023-08-04 05:38:41', '2023-09-06 17:52:43', 0, 0, '和值大小单双玩法', '和值大小单双赔率', '和值大小单双玩法'),
(211, '龙虎和玩法和', '和\\d+', 1000, 3000000, 3000000, '9.50', '2023-08-11 05:24:11', '2023-09-06 17:52:43', 0, 0, '龙虎和玩法和', '和赔率', '龙虎和玩法'),
(212, '前后三玩法豹子', '', 1000, 500000, 500000, '72.00', '2023-08-11 05:31:13', '2023-09-06 17:52:43', 0, 0, '前后三玩法豹子', '豹子赔率', '前后三玩法'),
(213, '前后三玩法顺子', NULL, 1000, 2000000, 2000000, '12.00', '2023-08-11 05:28:44', '2023-09-06 17:52:43', 0, 0, '前后三玩法顺子', '顺子赔率', '前后三玩法'),
(214, '前后三玩法对子', '前中后对子', 1000, 2000000, 2000000, '3.30', '2023-08-11 05:29:02', '2023-09-06 17:52:43', 0, 0, '前后三玩法对子', '对子赔率', '前后三玩法'),
(215, '前后三玩法半顺', '前半顺', 1000, 2000000, 2000000, '2.50', '2023-08-11 05:29:09', '2023-09-06 17:52:43', 0, 0, '前后三玩法半顺', '半顺赔率', '前后三玩法'),
(216, '前后三玩法杂六', '前后三玩法', 1000, 2000000, 2000000, '3.20', '2023-08-11 05:30:15', '2023-09-06 17:52:43', 0, 0, '前后三玩法杂六', '杂六赔率', '前后三玩法');

--
-- 转储表的索引
--

--
-- 表的索引 `bet_types`
--
ALTER TABLE `bet_types`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD KEY `Id` (`Id`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bet_types`
--
ALTER TABLE `bet_types`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
