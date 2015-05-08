/*
 Navicat MySQL Data Transfer

 Source Server         : workspace
 Source Server Version : 50615
 Source Host           : localhost
 Source Database       : boshang

 Target Server Version : 50615
 File Encoding         : utf-8

 Date: 05/07/2015 15:19:26 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `debtProtection`
-- ----------------------------
DROP TABLE IF EXISTS `debtProtection`;
CREATE TABLE `debtProtection` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `did` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  KEY `did_2` (`did`),
  CONSTRAINT `pro_debt` FOREIGN KEY (`did`) REFERENCES `debt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debtProtection`
-- ----------------------------
BEGIN;
INSERT INTO `debtProtection` VALUES ('1', 'upload/protection.png', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
