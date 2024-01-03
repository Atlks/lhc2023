-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-12-29 16:42:27
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
-- 表的结构 `bot_words`
--

CREATE TABLE `bot_words` (
  `Id` int(11) NOT NULL COMMENT '唯一标识符',
  `Withdraw_Failed` longtext COMMENT '下分审核失败',
  `Withdraw_Success` longtext COMMENT '下分审核通过',
  `Withdraw_Finish` longtext COMMENT '下分申请成功',
  `StopBet_Waring` longtext COMMENT '封盘警告提示',
  `Recharge_Tips` longtext COMMENT '上分公告',
  `Recharge_Success` longtext COMMENT '上分审核通过',
  `Recharge_Failed` longtext COMMENT '上分审核拒绝',
  `Recharge_Finish` longtext COMMENT '上分申请成功',
  `StopBet_Notice` longtext COMMENT '封盘公告',
  `Button_Text` longtext COMMENT '通用按键配置文本',
  `Bet_Failed` longtext COMMENT '下注余额不足',
  `Start_Bet` longtext COMMENT '开始下注提示',
  `Recharge_Error` longtext COMMENT '上分余额不足',
  `Update_Date` timestamp NULL DEFAULT NULL COMMENT '修改日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `bot_words`
--

INSERT INTO `bot_words` (`Id`, `Withdraw_Failed`, `Withdraw_Success`, `Withdraw_Finish`, `StopBet_Waring`, `Recharge_Tips`, `Recharge_Success`, `Recharge_Failed`, `Recharge_Finish`, `StopBet_Notice`, `Button_Text`, `Bet_Failed`, `Start_Bet`, `Recharge_Error`, `Update_Date`) VALUES
(1, '【id】【换行】用户名：【用户】【换行】您的下分申请被拒绝，详情请联系：@JBSSCCW888', 'ID  【id】【换行】用户名：【用户】【换行】金额：【金额】【换行】 恭喜老板下分成功，请注意查收！', 'ID 【id】【换行】 用户名： 【用户】【换行】您的下分申请提交成功， 老板，您的下分申请已收到，期间请勿重复提交！', '>>>>>>> 提醒 <<<<<<<\n封盘剩余30秒！\n千5流水自由返水 群里输入返水两字即可返当前流水 ！！！\n全宇宙最火爆pc群，秒杀一切担保，千万美金下分无忧 无任何理由借口不下分 欢迎?各路大神来爆庄!\n\n', '上分唯一汇旺：` 966383858`（名称：金贝时时彩）               唯一上分地址TRC：   `TFtbotgCDd4gnttNdHLrjnTjizgLmF3Qjb`（点击地址自动复制）                                                                                            唯一客服号 @JBSSCKF666                                                             唯一财务号 @JBSSCCW888', 'ID： 【id】【换行】用户名：【用户】【换行】金额：【金额】【换行】您当前余额：【余额】【换行】恭喜老板上分成功！', '【id】【换行】用户名：【用户】【换行】您的上分申请被拒绝，查询不到充值记录！', 'ID 【id】【换行】用户名：【用户】【换行】您上分申请提交成功   请勿重复\r\n审核通过后会第一时间上分！', '⛔️下注结束，全体禁言停止下注！\n⚠️下注结束出现编辑 分数清0！\n⚠️多次下注等于叠加下注/加注！\n⚠️一切以机器人与系统录入为准，无争议！\n—— —— —— —— —— —— —— ——\n‼️主动私聊的都是骗子‼️\n‼️认准官方管理账号ID‼️\n‼️切勿相信私发的信息‼️\n—— —— —— —— —— —— —— ——', '[[{\"text\": \"查看余额\",\"callback_data\": \"query_balance\"},{\"text\": \"最近投注\",\"callback_data\": \"query_records\"}],[{\"text\": \"查看流水\",\"callback_data\": \"query_rebates\"},{\"text\": \"联系财务\",\"url\": \"https://t.me/JBSSCCW888\"}],[{\"text\": \"💥金貝集团·博彩官方频道💥\",\"url\": \"https://t.me/jbpc28\"}]]', '你的余额不足', '金貝集团\nHash时时彩赔率:\n——————————————————\n🔸总和 大小单双 (10-50000) 1.98倍\n🔸 1-5球 大小单双(10-30000) 1.98倍\n🔹 1-5球 特码(10-10000) 9.5倍\n🔹龙/虎(10-30000) 1.98倍 \n🔹和(10-30000) 9.5倍\n🔹前中后豹子 (10-5000) 72倍\n🔹前中后顺子(10-20000) 12倍\n🔹前中后杂六(10-20000) 3.2倍\n🔹前中后半顺(10-20000) 2.5倍\n🔸前中后对子(10-20000) 3.3倍\n——————————————————\n注:总和大小单双5万封，单个球3万封，数字10000封，最高赔付封顶58万!一切解释权归 金貝集团所有!', '上分余额不足', '2023-08-23 09:44:01');

--
-- 转储表的索引
--

--
-- 表的索引 `bot_words`
--
ALTER TABLE `bot_words`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD KEY `Id` (`Id`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bot_words`
--
ALTER TABLE `bot_words`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识符', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
