/*
 Navicat MySQL Data Transfer

 Source Server         : workspace
 Source Server Version : 50615
 Source Host           : localhost
 Source Database       : boshang

 Target Server Version : 50615
 File Encoding         : utf-8

 Date: 05/02/2015 12:33:47 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `activity`
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `time` int(5) NOT NULL COMMENT '持续时间',
  `click` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='贵宾优享项目列表';

-- ----------------------------
--  Records of `activity`
-- ----------------------------
BEGIN;
INSERT INTO `activity` VALUES ('2', '顶级别墅装修', '顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修顶级别墅装修', '2015-04-18 13:58:58', '2015-04-29 07:59:36', '30', '2'), ('3', '顶级跑车优惠', '顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠顶级跑车优惠', '2015-04-18 15:02:10', '2015-04-18 15:02:10', '30', '0');
COMMIT;

-- ----------------------------
--  Table structure for `activityOrder`
-- ----------------------------
DROP TABLE IF EXISTS `activityOrder`;
CREATE TABLE `activityOrder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `verify` int(1) NOT NULL DEFAULT '0',
  `sum` decimal(10,2) NOT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  CONSTRAINT `order_activity` FOREIGN KEY (`aid`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_activity_user` FOREIGN KEY (`uid`) REFERENCES `frontUser` (`front_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `activityOrder`
-- ----------------------------
BEGIN;
INSERT INTO `activityOrder` VALUES ('1', '2', '4', '0', '12000.56', null, null, null, null), ('2', '2', '4', '0', '135500.77', '2015-04-29 08:41:19', '2015-04-29 08:41:19', null, null), ('3', '2', '4', '0', '1444.00', '2015-05-01 09:14:16', '2015-05-01 09:14:16', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `activityPic`
-- ----------------------------
DROP TABLE IF EXISTS `activityPic`;
CREATE TABLE `activityPic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `url` varchar(100) NOT NULL,
  `isbanner` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  CONSTRAINT `pic_activity` FOREIGN KEY (`aid`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `activityPic`
-- ----------------------------
BEGIN;
INSERT INTO `activityPic` VALUES ('1', '2', 'upload/haozhai.png', '1'), ('2', '3', 'upload/paoche.png', '1'), ('3', '2', 'upload/jinji01.jpg', '0'), ('4', '2', 'upload/jinji01.jpg', '0'), ('5', '3', 'upload/jinji2.jpg', '0'), ('6', '3', 'upload/jinji2.jpg', '0');
COMMIT;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `name` varchar(25) NOT NULL,
  `level` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-普通管理员；2-超级管理员',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `admin_user` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('1', '10', 'tianling', '2'), ('2', '11', 'tianling11', '1'), ('3', '12', 'tianling112', '2');
COMMIT;

-- ----------------------------
--  Table structure for `agreement`
-- ----------------------------
DROP TABLE IF EXISTS `agreement`;
CREATE TABLE `agreement` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `use` int(1) NOT NULL DEFAULT '1' COMMENT '0-停用，1-使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户协议';

-- ----------------------------
--  Records of `agreement`
-- ----------------------------
BEGIN;
INSERT INTO `agreement` VALUES ('1', '法律信息及通知\n\n网站所有权，使用条款协议\n本使用条款和条件 (“使用条款”) 适用于网址为 www.apple.com 的苹果网站，以及苹果及其子公司和关联方链接至 www.apple.com 的所有相关网站，包括遍及全球的苹果网站 (合称为“本网站”)。本网站是苹果公司 (“苹果”) 及其许可人的财产。您使用本网站，即表示您同意本使用条款；如果您不同意，请勿使用本网站。\n\n苹果保留自行决定在任何时候变更、修改、增加或删除本使用条款部分内容的权利。您有责任定期查看本使用条款的变更。您在变更信息发布之后继续使用本网站，即表示您同意且接受该等变更。若您遵守本使用条款，苹果即授予您一项个人、非排他性、不可转让、有限的权利以登录并使用本网站。\n\n内容\n本网站包含的所有文字、图表、用户界面、可视界面、图片、商标、标识、声音、音乐、美术作品及计算机编码 (合称为“内容”)，包括但不限于该等内容的设计、结构、选择、协调、表达、“界面外观”及排序等，均属苹果所有、受苹果控制或许可给苹果使用，且受商业外观法、著作权法、专利法、商标法以及各类其他知识产权法和反不正当竞争法的保护。\n\n除本使用条款明确规定外，未经苹果事先明确书面同意，不得为出版或发行或为任何商业企业以任何方式 (包括“镜像”) 将本网站的任何部分及任何内容复制、再制、重印、上传、发布、公开展示、编码、翻译、传输或散布至任何其他计算机、服务器、网站或其他媒介。\n\n您可以使用苹果专为从本网站下载所提供的有关苹果产品和服务的信息 (如数据表、知识库文章及类似资料)，前提是：您 (1) 不得从该等文件的所有复本中移除任何所有权通知的文句；(2) 仅出于个人而非商业信息目的使用该等信息，且不得在任何网络计算机上复制或发布该等信息，或在任何媒介上散布该等信息；(3) 不得对该等信息作任何修改；以及 (4) 不得对该等文件做出进一步陈述或保证。\n\n您对本网站的使用\n您不可使用任何“深层链接”、“抓取页面”、“机器人”、“蜘蛛”或其他自动装置、程序、算法、方法或者任何相似或相同的手动程序，以访问、取得、复制或监测本网站任何部分或任何内容，或以任何方式复制或规避本网站或任何内容的导航结构或介绍，通过任何非本网站提供的方式，取得或试图取得任何资料、文件或信息。苹果有权禁止任何该等行为。\n\n您不可试图通过非法侵入、“破解”密码或任何其他非法方式，未经授权访问本网站的任何部分或功能，或者链接至本网站或任何苹果服务器的任何其他系统或网络，或者未经授权取得本网站提供的任何服务。\n\n您不可探查、扫描或测试本网站或链接至本网站之任何网络的弱点，亦不可违反本网站或链接至本网站之任何网络的安全或认证措施。您不可反向查找、追踪或寻求追踪任何关于本网站任何其他用户或访问者或苹果其他客户的信息，包括任何非您所有的苹果账户的来源；或为显示您个人所有信息以外的任何信息之目的，包括但不限于本网站提供的身份证明或信息，使用本网站或本网站提供的任何服务或信息。\n\n您同意不会采取任何行为，在本网站基础架构或苹果的系统或网络上，或者链接至本网站或苹果的任何系统或网络上，存储不合理或不成比例的大量数据。\n\n您同意不使用任何设备、软件或程序，干扰或试图干扰本网站的正常运行或于本网站进行的任何交易，或干扰或试图干扰他人使用本网站。\n\n您不可伪造信头或以其他方式操控识别功能，以伪造您通过本网站提交给苹果的任何信息或传输内容的来源，或者伪造本网站提供的任何服务的来源。您不可假冒他人、或假冒代表他人，或模仿任何其他个人或实体。\n\n您不可为任何非法或本使用条款禁止之目的使用本网站或任何内容，或者为教唆实施任何非法行为或侵犯苹果或他人权利的其他行为使用本网站或任何内容。\n\n购买，其他条款和条件\n额外条款和条件可能适用于商品或服务的购买，以及本网站的特定部分或功能，包括竞赛、促销或其他类似功能，所有该等条款均通过此处援引纳入本使用条款。您同意遵守该等其他条款和条件，包括说明您已达到使用或参加该等服务或功能的法定年龄的相关条款和条件。如果本使用条款与为本网站特定部分或本网站提供的任何服务所发布的或适用于上述内容的条款之间存在冲突，则后者条款内容适用于您对本网站该等部分内容的使用或对特定服务的使用。\n\n就其产品和服务承担的义务 (如有)，苹果仅受约定该等义务的协议约束，且本网站任何内容均不得解释为变更该等协议。\n\n苹果可不经通知随时修改本网站提供的任何产品或服务，或任何该等产品或服务的相关价格。本网站中关于产品和服务的资料可能过期，苹果不承诺更新本网站上关于该等产品和服务的资料。\n\n下列条款亦规定并适用于您对本网站的使用，而且通过此处援引纳入本使用条款：\n\n商标信息\n著作权信息\n    权利和许可\n    著作权侵权损害赔偿请求\n预防盗版行为\n    报告盗版行为\n苹果的建言政策\n软件许可信息\n法律联系人\n该等政策可能不时变更，且自本网站发布该等变更内容后立即生效。\n\n账户、密码及安全\n本网站提供的某些功能或服务可能要求您开立账户 (包括设置苹果 ID 和密码)。对于维护您持有账户信息的保密性，包括您的密码，您承担全部责任；且对于因您未能保持信息安全和保密而在您账户下发生的任何及所有行为，您承担全部责任。您同意立即通知苹果任何对您账户或密码未经授权的使用，或者任何其他对安全的破坏。如果您未能保持您账户信息安全且保密，导致您的苹果 ID、密码或账户被他人使用，从而使苹果或本网站的任何其他用户或访问者遭受损失，您可能为该等损失承担赔偿责任。\n\n未经苹果 ID、密码或账户持有人的明确允许和同意，任何时候您均不得使用任何其他人的苹果 ID、密码或账户。如果您未遵守该等义务，苹果不能也不会对因此产生的任何损失或损害承担责任。\n\n隐私\n苹果的隐私政策适用于本网站的使用，其条款通过此处援引构成本使用条款的一部分。请点击此处，查看苹果的隐私政策。此外，通过使用本网站，您承认并同意网络传输从不完全保密或安全。您理解，任何您发送至本网站的消息或信息均可能被他人阅读或拦截，即使有特别通知说明特定传输 (例如信用卡信息) 已加密。\n\n链接至其他网站及苹果网站\n本网站可能包含链向其他独立第三方网站的链接 (“链接网站”)。该等链接网站仅为方便访问者而提供。该等链接网站并非由苹果控制，对其内容，包括该等链接网站的任何信息或资料，苹果没有认同也不承担任何责任。您需自行独立判断您与该等链接网站的互动。\n\n免责声明\n苹果不承诺本网站或本网站的任何内容、服务或功能无任何错误或不中断，不承诺任何瑕疵将被纠正，或者您对本网站的使用将产生特定结果。本网站及其内容是基于“现状”且“可获得”而提供。本网站提供的所有信息可不经通知而变更。苹果不能确保您从本网站下载的任何资料或其他数据无病毒、无污染或不具破坏性。苹果不作任何明示或默示保证，包括任何正确性、非侵权、适销性及适用性的保证。对于任何及所有与您对本网站和/或任何苹果服务的使用有关的任何第三方的作为、不作为和行为，苹果概不承担责任。您对本网站及任何链接网站的使用，由您承担全部责任。如果对本网站或任何内容有任何不满意，您唯一的救济方式是停止使用本网站或任何该等内容。救济限制是双方协议的一部分。\n\n上述免责声明适用于因任何不履行、错误、疏忽、中断、删除、缺陷、操作或传输迟延、电脑病毒、通信线路故障、失窃或破坏或未经授权访问、篡改或使用 (无论是违约、侵权、过失或任何其他诉因) 而造成的任何损害、责任或伤害。\n\n苹果保留在任何时候不经通知进行以下任何行为的权利：(1) 基于任何原因，修改、中止或终止本网站或其任何部分的运行或访问；(2) 修改或变更本网站或其任何部分及任何适用政策或条款；以及 (3) 在进行定期或非定期维护、错误纠正或其他变更所必须时，中断本网站或其任何部分的运行。\n\n责任限制\n除法律禁止外，在任何情形下，苹果对任何间接、衍生、惩戒、附带或惩罚性损害，包括利益损失，概不向您承担责任，即使苹果已被告知可能发生该等损害。\n\n尽管本使用条款有其他规定，如果对任何因您使用本网站或其任何内容而产生的或以任何方式与之相关的任何损害或损失，苹果应向您承担责任，在任何情形下，苹果的责任均不得超过下列数额之较大者： (1) 在向苹果初次提出赔偿请求之日的前六个月内支付的，与本网站任何服务或功能有关的订购费用或类似费用的总额 (但不包括任何苹果硬件或软件产品或任何 AppleCare 或类似支持程序的购买价格)，或 (2) 100.00 美元。某些司法管辖区不允许责任限制，因此前述限制可能不适用于您。\n\n赔偿\n对于任何第三方向苹果提出的，因您使用本网站而产生的或与之有关的任何请求、损失、责任、主张或费用 (包括律师费)，您同意赔偿苹果及其管理人员、董事、股东、前任、利益承继人、员工、代理人、子公司和关联方，并使其免受损害。\n\n本使用条款的违反\n苹果可以披露其拥有的关于您的任何信息 (包括您的身份)，若苹果认为对于任何与您使用本网站相关的调查或投诉需要该等披露，或者对可能 (故意或非故意) 损害或干涉苹果的权利或财产或本网站访问者或用户 (包括苹果客户) 的权利或财产的人员进行确认、联系或提起诉讼需要该等披露。苹果始终保留权利，可以披露其认为遵守任何适用法律、法规、法律程序或政府要求所需披露的任何信息。苹果认为适用法律要求或允许该等披露，包括为欺诈保护之目的与其他公司或组织交换信息时，苹果亦可披露您的信息。\n\n您同意并认可，苹果可以保留您通过本网站或者本网站提供的任何服务与苹果之间进行的任何传输或交流，亦可披露该等数据，若法律要求该等保留或披露，或苹果认为出于以下目的该等保留或披露合理必要：(1) 为遵守法定程序，(2) 为执行本使用条款，(3) 为回应任何该等数据违反他人权利的主张，或 (4) 为保护苹果、苹果员工、本网站用户或访问者及公众的权利、财产或个人安全。\n\n您同意，若苹果认为您违反了本使用条款或可能与您使用本网站相关的其他协议或指引，苹果可以自行决定且无需提前通知，终止您访问本网站的权限和/或阻止您以后访问本网站。您亦同意，您对本使用条款的任何违反均构成非法及不公平的商业行为，且将对苹果造成无法弥补的损害 (金钱赔偿不能充分弥补该等损害)，且您同意苹果获得其在该等情况下认为必要或恰当的任何禁令救济或同等救济。此等救济是对苹果根据法律或衡平法享有的任何其他救济的补充。\n\n您同意，苹果可自行决定且无需提前通知，因下列原因终止您访问本网站的权限，包括 (但不限于)：(1) 应法律执行机构或其他政府机构的要求，(2) 应您的要求 (您自己要求删除账户)，(3) 本网站或本网站提供的任何服务的中止或重大修改，或 (4) 不可预期的技术问题。\n\n若因您违反本使用条款致使苹果对您提起法律诉讼，除法律授予苹果的任何其他救济外，苹果有权从您处获得且您同意支付所有合理的律师费及该等诉讼费用。您同意，因对本使用条款的任何违反而导致苹果终止您访问本网站的权限，苹果概不对您或任何第三方承担责任。\n\n管辖法律；争议解决\n您同意，所有与您访问或使用本网站有关的事项，包括所有争议，将受美国法律及加利福尼亚州法律管辖，但不适用其冲突法规定。您同意，加利福尼亚州圣克拉拉县的州法院和联邦法院具有属人管辖权且在该等法院审判，且您同意放弃对该等司法管辖权或审判地的任何异议。若您为欧盟的消费者，则前述关于审判地的规定不适用。若您为欧盟的消费者，您可在居住国法院提出主张。根据本使用条款提出的任何主张必须在诉讼原因发生后或禁止该等主张或诉讼原因后一 (1) 年内提起。根据单独的商品及服务采购条款和条件提起的主张不受此限制。除垫付费用外，不可寻求或接受损害赔偿金，但胜诉方有权获得费用和律师费。若您与苹果之间产生任何因您使用本网站或与之有关的纠纷或争议，双方应立即秉承善意尝试解决任何该等争议。若双方未能在合理时间 (不超过三十 (30) 天) 内解决任何该等争议，任何一方均可将该等纠纷或争议提交调解。若争议未能通过调解解决，双方有权寻求适用法律下提供的任何权利或救济。\n\n禁止时的无效事项\n苹果在其所处地美国加利福尼亚州库比蒂诺管理及运营网站 www.apple.com；其他苹果网站可在美国之外的不同地点进行管理与运营。尽管在全世界均可访问本网站，但并非所有通过本网站或在本网站上讨论、提及、供应或提供的功能、产品或服务均可由所有人或在所有地理位置获得，或适合或可以在美国之外使用。苹果保留权利，可以自行决定将任何功能、产品或服务的供应和数量限制于任何人或地理区域。在本网站上提供任何功能、产品或服务在禁止时均无效。若您选择在美国之外的地区访问本网站，您系出于您本人的决定，且您自行负责遵守适用的当地法律。\n\n其他\n您不得违反任何适用法律或法规，包括但不限于美国出口法律和法规，使用或出口或转出口任何内容或任何该等内容的复制或改制，或本网站提供的任何产品或服务。\n\n若本使用条款的任何条款被享有合法管辖权的法院或其他法庭裁定为无效或不可执行，则该等条款应在最低必要范围内予以限制或排除，并以最能体现本使用条款意图的有效条款予以替换，以使本使用条款继续完全有效。本使用条款构成您与苹果之间与您使用本网站相关的整体协议，并在此取代及取消您与苹果之间先前存在的与该等使用相关的任何及所有书面或口头协议或理解。除在您与苹果签订的采购协议中规定的情形外，苹果不接受任何对本使用条款的反要约，且在此明确拒绝所有该等反要约。苹果未能坚持或强制要求严格履行本使用条款，不应被视为苹果对任何条款或执行本使用条款的任何权利的放弃，而且苹果与您或任何其他第三方之间的任何行为不应被视为对本使用条款任何规定的修改。本使用条款不应被解释为赋予任何第三方任何权利或救济。\n\n苹果提供获取苹果国际数据的权限，因此可能包含对未在您所在国公布的苹果产品、程序和服务的引用或交叉引用。该等引用不表示您所在国的苹果意图公布该等产品、程序或服务。\n\n反馈与信息\n您在本网站提供的任何反馈均视为非保密。苹果可随时不受限制地使用该等信息。\n\n本网站所含信息可不经通知而变更。\nCopyright © 1997-2009 Apple Inc.保留一切权利。\nApple Inc., 1 Infinite Loop, Cupertino, CA 95014, USA.\n\n苹果法律组于 2009 年 11 月 20 日更新', '1');
COMMIT;

-- ----------------------------
--  Table structure for `charity`
-- ----------------------------
DROP TABLE IF EXISTS `charity`;
CREATE TABLE `charity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '爱心捐赠标题',
  `content` text NOT NULL COMMENT '爱心捐赠内容',
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `time` int(5) DEFAULT NULL,
  `click` int(5) DEFAULT '0' COMMENT '点击次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `charity`
-- ----------------------------
BEGIN;
INSERT INTO `charity` VALUES ('1', '帮助非洲男孩', '帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩帮助非洲男孩', '2015-04-18 14:34:38', '2015-04-29 08:00:08', '30', '2');
COMMIT;

-- ----------------------------
--  Table structure for `charityOrder`
-- ----------------------------
DROP TABLE IF EXISTS `charityOrder`;
CREATE TABLE `charityOrder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `sum` decimal(10,2) NOT NULL,
  `verify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-后台未审核；1-审核通过；2-审核未通过',
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`),
  CONSTRAINT `charity_user` FOREIGN KEY (`uid`) REFERENCES `frontUser` (`front_uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_charity` FOREIGN KEY (`cid`) REFERENCES `charity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `charityOrder`
-- ----------------------------
BEGIN;
INSERT INTO `charityOrder` VALUES ('1', '1', '4', '12000.00', '0', null, null, null, null), ('2', '1', '4', '12000.56', '0', null, null, null, '好心人啊'), ('3', '1', '4', '1444.00', '0', '2015-05-01 09:14:39', '2015-05-01 09:14:39', null, '好心人啊');
COMMIT;

-- ----------------------------
--  Table structure for `charityPic`
-- ----------------------------
DROP TABLE IF EXISTS `charityPic`;
CREATE TABLE `charityPic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL COMMENT '对应捐赠项目id',
  `url` varchar(100) NOT NULL,
  `isbanner` int(1) NOT NULL DEFAULT '0' COMMENT '是否作为banner，0-不是；1-是',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `isbanner` (`isbanner`) USING BTREE,
  CONSTRAINT `charity` FOREIGN KEY (`cid`) REFERENCES `charity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `charityPic`
-- ----------------------------
BEGIN;
INSERT INTO `charityPic` VALUES ('1', '1', 'upload/feizhou.png', '1');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='债券购买总表';

-- ----------------------------
--  Records of `debtBuy`
-- ----------------------------
BEGIN;
INSERT INTO `debtBuy` VALUES ('1', '1', '4', '21313123', '90', '10000', '4', '2015'), ('2', '2', '4', '22232323', '90', '50000', '4', '2015'), ('3', '1', '2', '21313213', '90', '5000', '4', '2015');
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
--  Table structure for `debtOrder`
-- ----------------------------
DROP TABLE IF EXISTS `debtOrder`;
CREATE TABLE `debtOrder` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `verify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-后台未审核 1-审核通过 2-审核未通过',
  `sum` decimal(10,2) DEFAULT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  KEY `uid` (`uid`),
  CONSTRAINT `debt_order` FOREIGN KEY (`did`) REFERENCES `debt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_user` FOREIGN KEY (`uid`) REFERENCES `frontUser` (`front_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debtOrder`
-- ----------------------------
BEGIN;
INSERT INTO `debtOrder` VALUES ('2', '1', '4', '0', '50000.00', '2015-04-11 23:58:25', '2015-04-11 23:58:25'), ('3', '1', '4', '0', '100.00', '2015-04-20 10:10:49', '2015-04-20 10:10:49'), ('4', '1', '4', '0', '100.00', '2015-04-20 10:12:52', '2015-04-20 10:12:52'), ('5', '1', '4', '0', '200.00', '2015-04-20 10:14:05', '2015-04-20 10:14:05'), ('6', '2', '4', '0', '14445.00', '2015-05-01 17:17:32', '2015-05-01 17:17:32');
COMMIT;

-- ----------------------------
--  Table structure for `debtPic`
-- ----------------------------
DROP TABLE IF EXISTS `debtPic`;
CREATE TABLE `debtPic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(10) unsigned NOT NULL,
  `url` varchar(100) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  KEY `did_2` (`did`),
  KEY `did_3` (`did`),
  CONSTRAINT `debt_pic` FOREIGN KEY (`did`) REFERENCES `debt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debtPic`
-- ----------------------------
BEGIN;
INSERT INTO `debtPic` VALUES ('1', '1', 'upload/jinji01.jpg', 'jpg'), ('2', '1', 'upload/jinji2.jpg', 'jpg'), ('3', '2', 'upload/benpao1.jpg', 'jpg'), ('4', '2', 'upload/benpao2.jpg', 'jpg'), ('5', '3', 'upload/sanxia1.jpeg', 'jpeg');
COMMIT;

-- ----------------------------
--  Table structure for `debtProtection`
-- ----------------------------
DROP TABLE IF EXISTS `debtProtection`;
CREATE TABLE `debtProtection` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `debtProtection`
-- ----------------------------
BEGIN;
INSERT INTO `debtProtection` VALUES ('1', 'upload/protection.png');
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
  `real_name` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(25) DEFAULT NULL COMMENT '用户邮箱',
  `remember_token` varchar(255) DEFAULT NULL COMMENT '用户保持登录token',
  `updated_at` varchar(25) DEFAULT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT '0' COMMENT '0-男;1-女',
  `monthlyIncome` decimal(10,2) DEFAULT '0.00' COMMENT '用户月收入',
  `companyIndustry` varchar(50) DEFAULT NULL,
  `companyScale` varchar(50) DEFAULT NULL,
  `userJob` varchar(30) DEFAULT NULL,
  `userIntro` text,
  `aboutUser` text,
  `idCard` varchar(20) DEFAULT NULL COMMENT '身份证号',
  PRIMARY KEY (`front_uid`),
  KEY `uid` (`uid`),
  CONSTRAINT `user` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `frontUser`
-- ----------------------------
BEGIN;
INSERT INTO `frontUser` VALUES ('2', '5', null, 'activity123', '13618374657', null, 'BzFgwBVvjcOyoiZwCA30hozDFkZHqbIwnPWUYvXheaXaZZvrhApt0dKn1jmW', '2015-04-30 04:35:17', '2015-04-03 08:18:21', '1123455666', '1', '200000.00', null, null, null, null, null, '530103199210293715'), ('3', '6', null, 'ding', '1587793654', null, null, '2015-04-03 08:25:22', '2015-04-03 08:25:22', null, '0', '0.00', null, null, null, null, null, null), ('4', '7', null, 'tianling', '13399857034', '2507073658@qq.com', 'xIth4o2xRozginvWBcwFybLXz36nb3OKwdyGu4ki8vU4AyGAQ1vcFgNQgIOW', '2015-04-09 11:15:07', '2015-04-04 17:31:29', null, '0', '0.00', null, null, null, null, null, null), ('5', '9', null, 'tianlin2', '13529194568', null, null, '2015-04-04 17:43:35', '2015-04-04 17:43:35', null, '0', '0.00', null, null, null, null, null, null), ('6', '13', null, '风天凌', '13399857036', null, null, '2015-04-30 18:00:04', '2015-04-30 18:00:04', null, null, null, null, null, null, null, null, null), ('7', '14', null, '风天凌12345', '13399857037', null, null, '2015-04-30 18:06:36', '2015-04-30 18:06:36', null, null, null, null, null, null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `introduce`
-- ----------------------------
DROP TABLE IF EXISTS `introduce`;
CREATE TABLE `introduce` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `use` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-在使用，0-停用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='公司介绍';

-- ----------------------------
--  Records of `introduce`
-- ----------------------------
BEGIN;
INSERT INTO `introduce` VALUES ('1', '法律信息及通知\n\n网站所有权，使用条款协议\n本使用条款和条件 (“使用条款”) 适用于网址为 www.apple.com 的苹果网站，以及苹果及其子公司和关联方链接至 www.apple.com 的所有相关网站，包括遍及全球的苹果网站 (合称为“本网站”)。本网站是苹果公司 (“苹果”) 及其许可人的财产。您使用本网站，即表示您同意本使用条款；如果您不同意，请勿使用本网站。\n\n苹果保留自行决定在任何时候变更、修改、增加或删除本使用条款部分内容的权利。您有责任定期查看本使用条款的变更。您在变更信息发布之后继续使用本网站，即表示您同意且接受该等变更。若您遵守本使用条款，苹果即授予您一项个人、非排他性、不可转让、有限的权利以登录并使用本网站。\n\n内容\n本网站包含的所有文字、图表、用户界面、可视界面、图片、商标、标识、声音、音乐、美术作品及计算机编码 (合称为“内容”)，包括但不限于该等内容的设计、结构、选择、协调、表达、“界面外观”及排序等，均属苹果所有、受苹果控制或许可给苹果使用，且受商业外观法、著作权法、专利法、商标法以及各类其他知识产权法和反不正当竞争法的保护。\n\n除本使用条款明确规定外，未经苹果事先明确书面同意，不得为出版或发行或为任何商业企业以任何方式 (包括“镜像”) 将本网站的任何部分及任何内容复制、再制、重印、上传、发布、公开展示、编码、翻译、传输或散布至任何其他计算机、服务器、网站或其他媒介。\n\n您可以使用苹果专为从本网站下载所提供的有关苹果产品和服务的信息 (如数据表、知识库文章及类似资料)，前提是：您 (1) 不得从该等文件的所有复本中移除任何所有权通知的文句；(2) 仅出于个人而非商业信息目的使用该等信息，且不得在任何网络计算机上复制或发布该等信息，或在任何媒介上散布该等信息；(3) 不得对该等信息作任何修改；以及 (4) 不得对该等文件做出进一步陈述或保证。\n\n您对本网站的使用\n您不可使用任何“深层链接”、“抓取页面”、“机器人”、“蜘蛛”或其他自动装置、程序、算法、方法或者任何相似或相同的手动程序，以访问、取得、复制或监测本网站任何部分或任何内容，或以任何方式复制或规避本网站或任何内容的导航结构或介绍，通过任何非本网站提供的方式，取得或试图取得任何资料、文件或信息。苹果有权禁止任何该等行为。\n\n您不可试图通过非法侵入、“破解”密码或任何其他非法方式，未经授权访问本网站的任何部分或功能，或者链接至本网站或任何苹果服务器的任何其他系统或网络，或者未经授权取得本网站提供的任何服务。\n\n您不可探查、扫描或测试本网站或链接至本网站之任何网络的弱点，亦不可违反本网站或链接至本网站之任何网络的安全或认证措施。您不可反向查找、追踪或寻求追踪任何关于本网站任何其他用户或访问者或苹果其他客户的信息，包括任何非您所有的苹果账户的来源；或为显示您个人所有信息以外的任何信息之目的，包括但不限于本网站提供的身份证明或信息，使用本网站或本网站提供的任何服务或信息。\n\n您同意不会采取任何行为，在本网站基础架构或苹果的系统或网络上，或者链接至本网站或苹果的任何系统或网络上，存储不合理或不成比例的大量数据。\n\n您同意不使用任何设备、软件或程序，干扰或试图干扰本网站的正常运行或于本网站进行的任何交易，或干扰或试图干扰他人使用本网站。\n\n您不可伪造信头或以其他方式操控识别功能，以伪造您通过本网站提交给苹果的任何信息或传输内容的来源，或者伪造本网站提供的任何服务的来源。您不可假冒他人、或假冒代表他人，或模仿任何其他个人或实体。\n\n您不可为任何非法或本使用条款禁止之目的使用本网站或任何内容，或者为教唆实施任何非法行为或侵犯苹果或他人权利的其他行为使用本网站或任何内容。\n\n购买，其他条款和条件\n额外条款和条件可能适用于商品或服务的购买，以及本网站的特定部分或功能，包括竞赛、促销或其他类似功能，所有该等条款均通过此处援引纳入本使用条款。您同意遵守该等其他条款和条件，包括说明您已达到使用或参加该等服务或功能的法定年龄的相关条款和条件。如果本使用条款与为本网站特定部分或本网站提供的任何服务所发布的或适用于上述内容的条款之间存在冲突，则后者条款内容适用于您对本网站该等部分内容的使用或对特定服务的使用。\n\n就其产品和服务承担的义务 (如有)，苹果仅受约定该等义务的协议约束，且本网站任何内容均不得解释为变更该等协议。\n\n苹果可不经通知随时修改本网站提供的任何产品或服务，或任何该等产品或服务的相关价格。本网站中关于产品和服务的资料可能过期，苹果不承诺更新本网站上关于该等产品和服务的资料。\n\n下列条款亦规定并适用于您对本网站的使用，而且通过此处援引纳入本使用条款：\n\n商标信息\n著作权信息\n    权利和许可\n    著作权侵权损害赔偿请求\n预防盗版行为\n    报告盗版行为\n苹果的建言政策\n软件许可信息\n法律联系人\n该等政策可能不时变更，且自本网站发布该等变更内容后立即生效。\n\n账户、密码及安全\n本网站提供的某些功能或服务可能要求您开立账户 (包括设置苹果 ID 和密码)。对于维护您持有账户信息的保密性，包括您的密码，您承担全部责任；且对于因您未能保持信息安全和保密而在您账户下发生的任何及所有行为，您承担全部责任。您同意立即通知苹果任何对您账户或密码未经授权的使用，或者任何其他对安全的破坏。如果您未能保持您账户信息安全且保密，导致您的苹果 ID、密码或账户被他人使用，从而使苹果或本网站的任何其他用户或访问者遭受损失，您可能为该等损失承担赔偿责任。\n\n未经苹果 ID、密码或账户持有人的明确允许和同意，任何时候您均不得使用任何其他人的苹果 ID、密码或账户。如果您未遵守该等义务，苹果不能也不会对因此产生的任何损失或损害承担责任。\n\n隐私\n苹果的隐私政策适用于本网站的使用，其条款通过此处援引构成本使用条款的一部分。请点击此处，查看苹果的隐私政策。此外，通过使用本网站，您承认并同意网络传输从不完全保密或安全。您理解，任何您发送至本网站的消息或信息均可能被他人阅读或拦截，即使有特别通知说明特定传输 (例如信用卡信息) 已加密。\n\n链接至其他网站及苹果网站\n本网站可能包含链向其他独立第三方网站的链接 (“链接网站”)。该等链接网站仅为方便访问者而提供。该等链接网站并非由苹果控制，对其内容，包括该等链接网站的任何信息或资料，苹果没有认同也不承担任何责任。您需自行独立判断您与该等链接网站的互动。\n\n免责声明\n苹果不承诺本网站或本网站的任何内容、服务或功能无任何错误或不中断，不承诺任何瑕疵将被纠正，或者您对本网站的使用将产生特定结果。本网站及其内容是基于“现状”且“可获得”而提供。本网站提供的所有信息可不经通知而变更。苹果不能确保您从本网站下载的任何资料或其他数据无病毒、无污染或不具破坏性。苹果不作任何明示或默示保证，包括任何正确性、非侵权、适销性及适用性的保证。对于任何及所有与您对本网站和/或任何苹果服务的使用有关的任何第三方的作为、不作为和行为，苹果概不承担责任。您对本网站及任何链接网站的使用，由您承担全部责任。如果对本网站或任何内容有任何不满意，您唯一的救济方式是停止使用本网站或任何该等内容。救济限制是双方协议的一部分。\n\n上述免责声明适用于因任何不履行、错误、疏忽、中断、删除、缺陷、操作或传输迟延、电脑病毒、通信线路故障、失窃或破坏或未经授权访问、篡改或使用 (无论是违约、侵权、过失或任何其他诉因) 而造成的任何损害、责任或伤害。\n\n苹果保留在任何时候不经通知进行以下任何行为的权利：(1) 基于任何原因，修改、中止或终止本网站或其任何部分的运行或访问；(2) 修改或变更本网站或其任何部分及任何适用政策或条款；以及 (3) 在进行定期或非定期维护、错误纠正或其他变更所必须时，中断本网站或其任何部分的运行。\n\n责任限制\n除法律禁止外，在任何情形下，苹果对任何间接、衍生、惩戒、附带或惩罚性损害，包括利益损失，概不向您承担责任，即使苹果已被告知可能发生该等损害。\n\n尽管本使用条款有其他规定，如果对任何因您使用本网站或其任何内容而产生的或以任何方式与之相关的任何损害或损失，苹果应向您承担责任，在任何情形下，苹果的责任均不得超过下列数额之较大者： (1) 在向苹果初次提出赔偿请求之日的前六个月内支付的，与本网站任何服务或功能有关的订购费用或类似费用的总额 (但不包括任何苹果硬件或软件产品或任何 AppleCare 或类似支持程序的购买价格)，或 (2) 100.00 美元。某些司法管辖区不允许责任限制，因此前述限制可能不适用于您。\n\n赔偿\n对于任何第三方向苹果提出的，因您使用本网站而产生的或与之有关的任何请求、损失、责任、主张或费用 (包括律师费)，您同意赔偿苹果及其管理人员、董事、股东、前任、利益承继人、员工、代理人、子公司和关联方，并使其免受损害。\n\n本使用条款的违反\n苹果可以披露其拥有的关于您的任何信息 (包括您的身份)，若苹果认为对于任何与您使用本网站相关的调查或投诉需要该等披露，或者对可能 (故意或非故意) 损害或干涉苹果的权利或财产或本网站访问者或用户 (包括苹果客户) 的权利或财产的人员进行确认、联系或提起诉讼需要该等披露。苹果始终保留权利，可以披露其认为遵守任何适用法律、法规、法律程序或政府要求所需披露的任何信息。苹果认为适用法律要求或允许该等披露，包括为欺诈保护之目的与其他公司或组织交换信息时，苹果亦可披露您的信息。\n\n您同意并认可，苹果可以保留您通过本网站或者本网站提供的任何服务与苹果之间进行的任何传输或交流，亦可披露该等数据，若法律要求该等保留或披露，或苹果认为出于以下目的该等保留或披露合理必要：(1) 为遵守法定程序，(2) 为执行本使用条款，(3) 为回应任何该等数据违反他人权利的主张，或 (4) 为保护苹果、苹果员工、本网站用户或访问者及公众的权利、财产或个人安全。\n\n您同意，若苹果认为您违反了本使用条款或可能与您使用本网站相关的其他协议或指引，苹果可以自行决定且无需提前通知，终止您访问本网站的权限和/或阻止您以后访问本网站。您亦同意，您对本使用条款的任何违反均构成非法及不公平的商业行为，且将对苹果造成无法弥补的损害 (金钱赔偿不能充分弥补该等损害)，且您同意苹果获得其在该等情况下认为必要或恰当的任何禁令救济或同等救济。此等救济是对苹果根据法律或衡平法享有的任何其他救济的补充。\n\n您同意，苹果可自行决定且无需提前通知，因下列原因终止您访问本网站的权限，包括 (但不限于)：(1) 应法律执行机构或其他政府机构的要求，(2) 应您的要求 (您自己要求删除账户)，(3) 本网站或本网站提供的任何服务的中止或重大修改，或 (4) 不可预期的技术问题。\n\n若因您违反本使用条款致使苹果对您提起法律诉讼，除法律授予苹果的任何其他救济外，苹果有权从您处获得且您同意支付所有合理的律师费及该等诉讼费用。您同意，因对本使用条款的任何违反而导致苹果终止您访问本网站的权限，苹果概不对您或任何第三方承担责任。\n\n管辖法律；争议解决\n您同意，所有与您访问或使用本网站有关的事项，包括所有争议，将受美国法律及加利福尼亚州法律管辖，但不适用其冲突法规定。您同意，加利福尼亚州圣克拉拉县的州法院和联邦法院具有属人管辖权且在该等法院审判，且您同意放弃对该等司法管辖权或审判地的任何异议。若您为欧盟的消费者，则前述关于审判地的规定不适用。若您为欧盟的消费者，您可在居住国法院提出主张。根据本使用条款提出的任何主张必须在诉讼原因发生后或禁止该等主张或诉讼原因后一 (1) 年内提起。根据单独的商品及服务采购条款和条件提起的主张不受此限制。除垫付费用外，不可寻求或接受损害赔偿金，但胜诉方有权获得费用和律师费。若您与苹果之间产生任何因您使用本网站或与之有关的纠纷或争议，双方应立即秉承善意尝试解决任何该等争议。若双方未能在合理时间 (不超过三十 (30) 天) 内解决任何该等争议，任何一方均可将该等纠纷或争议提交调解。若争议未能通过调解解决，双方有权寻求适用法律下提供的任何权利或救济。\n\n禁止时的无效事项\n苹果在其所处地美国加利福尼亚州库比蒂诺管理及运营网站 www.apple.com；其他苹果网站可在美国之外的不同地点进行管理与运营。尽管在全世界均可访问本网站，但并非所有通过本网站或在本网站上讨论、提及、供应或提供的功能、产品或服务均可由所有人或在所有地理位置获得，或适合或可以在美国之外使用。苹果保留权利，可以自行决定将任何功能、产品或服务的供应和数量限制于任何人或地理区域。在本网站上提供任何功能、产品或服务在禁止时均无效。若您选择在美国之外的地区访问本网站，您系出于您本人的决定，且您自行负责遵守适用的当地法律。\n\n其他\n您不得违反任何适用法律或法规，包括但不限于美国出口法律和法规，使用或出口或转出口任何内容或任何该等内容的复制或改制，或本网站提供的任何产品或服务。\n\n若本使用条款的任何条款被享有合法管辖权的法院或其他法庭裁定为无效或不可执行，则该等条款应在最低必要范围内予以限制或排除，并以最能体现本使用条款意图的有效条款予以替换，以使本使用条款继续完全有效。本使用条款构成您与苹果之间与您使用本网站相关的整体协议，并在此取代及取消您与苹果之间先前存在的与该等使用相关的任何及所有书面或口头协议或理解。除在您与苹果签订的采购协议中规定的情形外，苹果不接受任何对本使用条款的反要约，且在此明确拒绝所有该等反要约。苹果未能坚持或强制要求严格履行本使用条款，不应被视为苹果对任何条款或执行本使用条款的任何权利的放弃，而且苹果与您或任何其他第三方之间的任何行为不应被视为对本使用条款任何规定的修改。本使用条款不应被解释为赋予任何第三方任何权利或救济。\n\n苹果提供获取苹果国际数据的权限，因此可能包含对未在您所在国公布的苹果产品、程序和服务的引用或交叉引用。该等引用不表示您所在国的苹果意图公布该等产品、程序或服务。\n\n反馈与信息\n您在本网站提供的任何反馈均视为非保密。苹果可随时不受限制地使用该等信息。\n\n本网站所含信息可不经通知而变更。\nCopyright © 1997-2009 Apple Inc.保留一切权利。\nApple Inc., 1 Infinite Loop, Cupertino, CA 95014, USA.\n\n苹果法律组于 2009 年 11 月 20 日更新', '1');
COMMIT;

-- ----------------------------
--  Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `mgssage_user` FOREIGN KEY (`uid`) REFERENCES `frontUser` (`front_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户反馈表';

-- ----------------------------
--  Records of `message`
-- ----------------------------
BEGIN;
INSERT INTO `message` VALUES ('1', '4', '这app好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊', '2015-04-09 11:31:19', '2015-04-09 11:31:19'), ('2', '4', '这app好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊', '2015-04-09 11:34:03', '2015-04-09 11:34:03'), ('3', '4', '这app好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊好牛逼啊', '2015-04-09 19:40:38', '2015-04-09 19:40:38');
COMMIT;

-- ----------------------------
--  Table structure for `recharge`
-- ----------------------------
DROP TABLE IF EXISTS `recharge`;
CREATE TABLE `recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `sum` decimal(10,2) NOT NULL,
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `verify` int(1) unsigned DEFAULT '0' COMMENT '体现请求后台审核结果;0-后台未审核，1-审核通过，2-审核未通过',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `recharge_user` FOREIGN KEY (`uid`) REFERENCES `frontUser` (`front_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `recharge`
-- ----------------------------
BEGIN;
INSERT INTO `recharge` VALUES ('1', '4', '10000.00', '2015-04-10 21:57:48', '2015-04-10 21:57:48', '0'), ('2', '4', '10000.00', '2015-04-10 21:57:58', '2015-04-10 21:57:58', '0'), ('3', '4', '1000.00', '2015-04-20 10:22:23', '2015-04-20 10:22:23', '0');
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
  `modify` int(5) unsigned DEFAULT '0' COMMENT '信息修改次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('5', '$2y$10$QEV5bXJ7f4Zgv.TsrCp/MucG/g.Il5jJyqrzEveBYzW4tVBaGKr42', '125.87.198.250', '1428113402', '0', null, '2015-04-04 02:10:02', null, '0'), ('6', null, null, null, '1', null, null, null, '0'), ('7', '$2y$10$G0MPMOrSrRDvkJRW4EZLru1obSO6o.qY2nvLkmMrfDj/tRKyLPsZe', '125.87.198.250', '1428168784', '0', '2015-04-04 17:31:29', '2015-04-04 17:33:04', null, '0'), ('9', null, null, null, '1', '2015-04-04 17:43:35', '2015-04-04 17:43:35', null, '0'), ('10', '$2y$10$tyGiDi7d4oY9Yx7RMTpAm.JNTFsHPXRa2hNLPLulqnx/vFEfzGWTO', '127.0.0.1', '1429156105', '0', '2015-04-16 03:48:25', '2015-04-16 03:48:25', null, '0'), ('11', '$2y$10$1bI9v2gr96naJUblcV81ju198Ucaz4cv1TtWIXdjZM1Gw59ugtS8y', '127.0.0.1', '1429196438', '0', '2015-04-16 15:00:38', '2015-04-16 15:00:38', null, '0'), ('12', '$2y$10$X2RTjx1HcFfMNXNYgM7Ft.5CE5VKP7q80AwXhJkvhJYIC0m98urx6', '127.0.0.1', '1429344396', '0', '2015-04-18 08:06:36', '2015-04-18 08:06:36', null, '0'), ('13', '$2y$10$Qu62eiQsDHMdc1gKCin3pOl0W08CT2oFstydQw2veHHBqb/On3R4e', '127.0.0.1', '1430417106', '0', '2015-04-30 18:00:04', '2015-04-30 18:05:06', null, '0'), ('14', '$2y$10$Ex5sW0d7ZPWWcEVU3uMt1.rY7FbqXH7Mv2TlanIlYK7Er3Cd8EiSW', '127.0.0.1', '1430417232', '0', '2015-04-30 18:06:36', '2015-04-30 18:07:12', null, '0');
COMMIT;

-- ----------------------------
--  Table structure for `withdrawDeposit`
-- ----------------------------
DROP TABLE IF EXISTS `withdrawDeposit`;
CREATE TABLE `withdrawDeposit` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `sum` decimal(10,2) NOT NULL COMMENT '提现金额',
  `created_at` varchar(25) DEFAULT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  `verify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '体现请求后台审核结果;0-后台未审核，1-审核通过，2-审核未通过',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `withdraw_user` FOREIGN KEY (`uid`) REFERENCES `frontUser` (`front_uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户提现记录表';

-- ----------------------------
--  Records of `withdrawDeposit`
-- ----------------------------
BEGIN;
INSERT INTO `withdrawDeposit` VALUES ('1', '4', '10000.00', '2015-04-10 21:39:57', '2015-04-10 21:39:57', '0'), ('2', '4', '1000.00', '2015-04-20 10:22:50', '2015-04-20 10:22:50', '0'), ('3', '4', '1444.00', '2015-05-01 17:05:27', '2015-05-01 17:05:27', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
