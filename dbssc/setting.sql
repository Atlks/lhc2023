-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-12-29 16:41:53
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
-- 表的结构 `setting`
--

CREATE TABLE `setting` (
  `Id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `value` bigint(11) DEFAULT '0',
  `s_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`Id`, `name`, `value`, `s_value`) VALUES
(1, '机器人Token', 0, '6326214984:AAHoyB0GjWQ7E5fhdWhWPxl7ZWrlWvAop5g'),
(2, '群聊天id', -1001811107977, NULL),
(3, '游戏状态', 1, NULL),
(4, '是否停止游戏', 0, NULL),
(5, '是否开启13/14算法赔率', 0, NULL),
(6, '下注时间', 60000, NULL),
(7, '警告时间', 30000, NULL),
(8, '封注时间', 20000, NULL),
(9, '自动到账', 4000, NULL),
(10, '计算', 0, NULL),
(11, '报警机器人Token', 0, '6056061945:AAEkeZfGNSl3vQ165nMkv2aXpaxlTbmaSLo'),
(12, '报警群', -1001566212448, NULL),
(13, '自动上分地址', 0, 'http://game.gq1sx.cc/index.php?s=Gamelogic/push_ssc&id='),
(14, '上分域名', 0, 'https://api.gq1sx.cc'),
(15, '开奖地址', 0, 'https://api.gq1sx.cc/game/result?issue='),
(16, 'key', 0, 'NA7T1LuS'),
(17, 'LongPolling最后一个updateId', 0, NULL),
(18, '检查机器人', 0, '6449627161:AAFT4Kk2uSLFAHY8xS2heaTvpAWnOjVWD_w'),
(19, '下一期地址', 0, 'https://api.gq1sx.cc/game/next');

--
-- 转储表的索引
--

--
-- 表的索引 `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD KEY `id` (`Id`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `setting`
--
ALTER TABLE `setting`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
