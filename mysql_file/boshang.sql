/*
 Navicat MySQL Data Transfer

 Source Server         : workspace
 Source Server Version : 50615
 Source Host           : localhost
 Source Database       : boshang

 Target Server Version : 50615
 File Encoding         : utf-8

 Date: 04/06/2015 16:25:09 PM
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
  `type` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '债券种类',
  `content` varchar(255) DEFAULT NULL COMMENT '债券详情',
  `risk_keep` int(5) NOT NULL COMMENT '风险保障金',
  `net_value` decimal(6,2) NOT NULL COMMENT '净值',
  `interest` decimal(4,2) NOT NULL COMMENT '利息',
  `add_time` int(20) NOT NULL COMMENT '债券添加时间',
  `dates` int(5) NOT NULL DEFAULT '0' COMMENT '债券时长',
  `total` int(8) NOT NULL DEFAULT '0' COMMENT '债券总值',
  `move` int(1) NOT NULL DEFAULT '0' COMMENT '趋势，0-趋平，1-盈利，2-亏损',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '还款情况 0-未还 1-已还',
  `top` int(1) NOT NULL DEFAULT '0' COMMENT '基金是否置顶;0-不置顶；1-置顶',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  CONSTRAINT `debt_type` FOREIGN KEY (`type`) REFERENCES `debtType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debt`
-- ----------------------------
BEGIN;
INSERT INTO `debt` VALUES ('1', '电影进击的巨人债券', '1', '进击的巨人进击的巨人进击的巨人进击的巨人进击的巨人进击的巨人', '20', '1.50', '12.00', '1423109401', '90', '150000', '0', '0', '1'), ('2', '电影奔跑吧兄弟债券', '1', '奔跑吧兄弟奔跑吧兄弟奔跑吧兄弟奔跑吧兄弟奔跑吧兄弟奔跑吧兄弟', '55', '0.70', '12.00', '1426409401', '90', '200000', '0', '0', '0'), ('3', '三峡水电站集资', '3', '三峡水电站集资啦么么么哒', '32', '0.60', '15.00', '1428228174', '90', '2000000', '0', '0', '0');
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
  `buy_month` int(2) NOT NULL DEFAULT '1' COMMENT '购买月份',
  `buy_year` int(4) DEFAULT '2014' COMMENT '购买年份',
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  CONSTRAINT `debt` FOREIGN KEY (`did`) REFERENCES `debt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='债券购买总表';

-- ----------------------------
--  Records of `debtBuy`
-- ----------------------------
BEGIN;
INSERT INTO `debtBuy` VALUES ('1', '1', '4', '21313123', '90', '10000', '4', '2015'), ('2', '2', '4', '22232323', '90', '50000', '4', '2015');
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
  `month` int(5) NOT NULL COMMENT '修改时间(月份)',
  `year` int(5) NOT NULL COMMENT '修改年份',
  `move` int(1) DEFAULT '0' COMMENT '趋势，0-趋平，1-盈利，2-亏损',
  PRIMARY KEY (`id`),
  KEY `bid` (`bid`),
  KEY `months` (`month`) USING BTREE,
  KEY `years` (`year`) USING BTREE,
  CONSTRAINT `buy_id` FOREIGN KEY (`bid`) REFERENCES `debtBuy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='债券修改记录';

-- ----------------------------
--  Records of `debtBuyList`
-- ----------------------------
BEGIN;
INSERT INTO `debtBuyList` VALUES ('3', '1', '5000', '1.20', '10.00', '2', '2014', '0'), ('4', '1', '5500', '1.20', '12.00', '3', '2014', '0'), ('5', '2', '6000', '1.20', '12.00', '2', '2014', '0'), ('6', '2', '5700', '1.20', '12.00', '3', '2014', '0');
COMMIT;

-- ----------------------------
--  Table structure for `debtType`
-- ----------------------------
DROP TABLE IF EXISTS `debtType`;
CREATE TABLE `debtType` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `choosable` int(1) NOT NULL DEFAULT '1' COMMENT '0-不可选；1-可选',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debtType`
-- ----------------------------
BEGIN;
INSERT INTO `debtType` VALUES ('1', '影视基金', '1'), ('2', '债券投资基金', '0'), ('3', '水利水电并购基金', '1'), ('4', '股票私募基金', '1'), ('5', '企业集资基金', '1');
COMMIT;

-- ----------------------------
--  Table structure for `frontUser`
-- ----------------------------
DROP TABLE IF EXISTS `frontUser`;
CREATE TABLE `frontUser` (
  `front_uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `real_name` varchar(8) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(25) DEFAULT NULL COMMENT '用户邮箱',
  `remember_token` varchar(255) DEFAULT NULL COMMENT '用户保持登录token',
  `updated_at` varchar(25) DEFAULT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`front_uid`),
  KEY `uid` (`uid`),
  CONSTRAINT `user` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `frontUser`
-- ----------------------------
BEGIN;
INSERT INTO `frontUser` VALUES ('2', '5', null, 'luo', '13618372995', null, 'BzFgwBVvjcOyoiZwCA30hozDFkZHqbIwnPWUYvXheaXaZZvrhApt0dKn1jmW', '2015-04-04 17:32:28', '2015-04-03 08:18:21'), ('3', '6', null, 'ding', '1587793654', null, null, '2015-04-03 08:25:22', '2015-04-03 08:25:22'), ('4', '7', null, 'tianling', '13399857034', null, 'vjevHHIiTqEsC5mD5RHXt8IMG0AUVQOGMBeHXqbaiPdaOojPthejhmAWUTlU', '2015-04-06 02:21:44', '2015-04-04 17:31:29'), ('5', '9', null, 'tianlin2', '13529194568', null, null, '2015-04-04 17:43:35', '2015-04-04 17:43:35');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(15) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `lock` int(1) NOT NULL DEFAULT '1' COMMENT '0-未锁定，1-用户被锁定',
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('5', '$2y$10$QEV5bXJ7f4Zgv.TsrCp/MucG/g.Il5jJyqrzEveBYzW4tVBaGKr42', '125.87.198.250', '1428113402', '0', null, '2015-04-04 02:10:02', null), ('6', null, null, null, '1', null, null, null), ('7', '$2y$10$G0MPMOrSrRDvkJRW4EZLru1obSO6o.qY2nvLkmMrfDj/tRKyLPsZe', '125.87.198.250', '1428168784', '0', '2015-04-04 17:31:29', '2015-04-04 17:33:04', null), ('8', null, null, null, '1', '2015-04-04 17:43:19', '2015-04-04 17:43:19', null), ('9', null, null, null, '1', '2015-04-04 17:43:35', '2015-04-04 17:43:35', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
