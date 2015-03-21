/*
 Navicat MySQL Data Transfer

 Source Server         : workspace
 Source Server Version : 50615
 Source Host           : localhost
 Source Database       : boshang

 Target Server Version : 50615
 File Encoding         : utf-8

 Date: 03/22/2015 00:07:45 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `debt`
-- ----------------------------
DROP TABLE IF EXISTS `debt`;
CREATE TABLE `debt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '债券编号',
  `title` varchar(50) DEFAULT NULL COMMENT '债券标题',
  `content` varchar(255) DEFAULT NULL COMMENT '债券详情',
  `risk_keep` int(5) NOT NULL COMMENT '风险保障金',
  `net_value` decimal(6,2) NOT NULL COMMENT '净值',
  `interest` decimal(4,2) NOT NULL COMMENT '利息',
  `add_time` int(20) NOT NULL COMMENT '债券添加时间',
  `dates` int(5) NOT NULL DEFAULT '0' COMMENT '债券时长',
  `total` int(8) NOT NULL DEFAULT '0' COMMENT '债券总值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debt`
-- ----------------------------
BEGIN;
INSERT INTO `debt` VALUES ('1', '电影进击的巨人债券', '进击的巨人进击的巨人进击的巨人进击的巨人进击的巨人进击的巨人', '0', '1.50', '12.00', '12132131', '90', '150000');
COMMIT;

-- ----------------------------
--  Table structure for `debtBuy`
-- ----------------------------
DROP TABLE IF EXISTS `debtBuy`;
CREATE TABLE `debtBuy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '债券编号',
  `did` int(10) unsigned NOT NULL COMMENT '债券id',
  `uid` int(10) NOT NULL COMMENT '购买用户id',
  `add_time` int(20) NOT NULL COMMENT '债券添加时间',
  `dates` int(5) NOT NULL COMMENT '债券时长',
  `total_buy` int(10) NOT NULL COMMENT '购买债券总金额',
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  CONSTRAINT `debt` FOREIGN KEY (`did`) REFERENCES `debt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='债券购买总表';

-- ----------------------------
--  Records of `debtBuy`
-- ----------------------------
BEGIN;
INSERT INTO `debtBuy` VALUES ('1', '1', '1', '21313123', '90', '10000');
COMMIT;

-- ----------------------------
--  Table structure for `debtBuyList`
-- ----------------------------
DROP TABLE IF EXISTS `debtBuyList`;
CREATE TABLE `debtBuyList` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '债券修改记录编号',
  `bid` int(10) unsigned NOT NULL COMMENT '债券购买记录编号',
  `risk_keep` int(5) NOT NULL COMMENT '风险保障金',
  `net_value` decimal(6,2) NOT NULL COMMENT '净值',
  `interest` decimal(4,2) NOT NULL COMMENT '利息',
  `month` datetime NOT NULL COMMENT '修改时间（xxxx年xxxx月）',
  PRIMARY KEY (`id`),
  KEY `bid` (`bid`),
  KEY `months` (`month`) USING BTREE,
  CONSTRAINT `buy_id` FOREIGN KEY (`bid`) REFERENCES `debtBuy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='债券修改记录';

-- ----------------------------
--  Records of `debtBuyList`
-- ----------------------------
BEGIN;
INSERT INTO `debtBuyList` VALUES ('1', '1', '0', '1.20', '13.00', '2015-03-21 23:45:34'), ('2', '1', '1200', '1.20', '13.00', '2015-04-01 23:46:19');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
