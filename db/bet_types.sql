/*
 Navicat Premium Data Transfer

 Source Server         : user2023
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : jbdb

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 13/12/2023 15:27:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bet_types
-- ----------------------------
DROP TABLE IF EXISTS `bet_types`;
CREATE TABLE `bet_types`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Display` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '显示名称',
  `Regex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '下注指令名称',
  `Bet_Min` int(11) NULL DEFAULT NULL COMMENT '最小下注',
  `Bet_Max` int(11) NULL DEFAULT NULL COMMENT '最大下注',
  `Bet_Max_Total` int(11) NULL DEFAULT NULL COMMENT '最大总下注',
  `Odds` decimal(11, 2) NULL DEFAULT NULL COMMENT '赔率',
  `Create_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `Update_Date` timestamp NULL DEFAULT NULL COMMENT '更新日期\r\n',
  `type` int(11) NULL DEFAULT 0 COMMENT '代码逻辑里的type,详细内容参考代码',
  `value` int(11) NULL DEFAULT 0 COMMENT '扩展值,用来表示和值',
  `玩法` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `赔率类型` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `业务玩法` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `Id`(`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bet_types
-- ----------------------------
INSERT INTO `bet_types` VALUES (16, '前后三玩法杂六', '前后三玩法', 100, 10000000, 10000000, 3.20, '2023-08-11 13:30:15', '2023-08-11 13:30:18', 0, 0, '前后三玩法杂六', '杂六赔率', '前后三玩法');
INSERT INTO `bet_types` VALUES (17, '百家乐', '前后三玩法', 100, 10000000, 10000000, 2.00, '2023-08-11 13:30:15', '2023-08-11 13:30:18', 0, 0, '百家乐', '杂六赔率', '前后三玩法');
INSERT INTO `bet_types` VALUES (18, '百家乐和局', '百家乐', 100, 10000000, 10000000, 8.00, '2023-12-12 14:26:54', '2023-12-12 14:26:59', 0, 0, '百家乐和局', '百家乐', '百家乐');
INSERT INTO `bet_types` VALUES (19, '百家乐对子', NULL, 100, 10000000, 10000000, 11.00, '2023-12-12 16:39:03', NULL, 0, 0, '百家乐对子', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
