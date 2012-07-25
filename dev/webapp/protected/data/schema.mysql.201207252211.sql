/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : plugins_dev

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2012-07-25 22:11:07
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tbl_product_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_categories`;
CREATE TABLE `tbl_product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) DEFAULT '1',
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `root` varchar(16) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_categories
-- ----------------------------
INSERT INTO `tbl_product_categories` VALUES ('1', 'Root', null, null, '1', '1', '16', null, '1', null, null, null);
INSERT INTO `tbl_product_categories` VALUES ('2', 'Computer', null, 'gdfgd f gdfg', '1', '2', '9', '1', '2', null, '2011-11-05 02:52:43', '2011-11-05 02:52:43');
INSERT INTO `tbl_product_categories` VALUES ('3', 'Keyboard', null, 'dfgdf', '1', '3', '4', '2', '3', null, '2011-11-05 02:57:50', '2011-11-05 02:57:50');
INSERT INTO `tbl_product_categories` VALUES ('4', 'Mouse', '13204586023673.jpg', '', '1', '5', '8', '2', '3', null, '2011-11-05 02:58:15', '2011-11-05 03:03:23');
INSERT INTO `tbl_product_categories` VALUES ('5', 'Acer', '13204586392390.jpg', '', '1', '6', '7', '2', '4', null, '2011-11-05 03:04:00', '2012-07-23 18:02:06');
INSERT INTO `tbl_product_categories` VALUES ('6', 'Thuc Pham Sach', null, '', '1', '10', '15', '1', '2', null, '2012-07-23 18:02:22', '2012-07-23 18:02:22');
INSERT INTO `tbl_product_categories` VALUES ('7', 'Rau An Toàn', null, '', '1', '11', '12', '6', '3', null, '2012-07-25 14:37:53', '2012-07-25 14:37:53');
INSERT INTO `tbl_product_categories` VALUES ('8', 'Thực Phẩm An Toàn', null, '', '1', '13', '14', '6', '3', null, '2012-07-25 14:38:14', '2012-07-25 14:38:39');

-- ----------------------------
-- Table structure for `tbl_product_category_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_category_item`;
CREATE TABLE `tbl_product_category_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_id` (`item_id`),
  KEY `fk_category_id` (`category_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_id` FOREIGN KEY (`item_id`) REFERENCES `tbl_product_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_category_item
-- ----------------------------
INSERT INTO `tbl_product_category_item` VALUES ('12', '7', '2');
INSERT INTO `tbl_product_category_item` VALUES ('13', '7', '4');
INSERT INTO `tbl_product_category_item` VALUES ('14', '7', '5');
INSERT INTO `tbl_product_category_item` VALUES ('16', '7', '7');
INSERT INTO `tbl_product_category_item` VALUES ('17', '7', '8');
INSERT INTO `tbl_product_category_item` VALUES ('18', '7', '9');
INSERT INTO `tbl_product_category_item` VALUES ('19', '7', '6');

-- ----------------------------
-- Table structure for `tbl_product_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_items`;
CREATE TABLE `tbl_product_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_items
-- ----------------------------
INSERT INTO `tbl_product_items` VALUES ('2', 'Cải Thìa', '13432264503081.jpg', '14000', 'Sản xuất tại Hưng Nguyên', 'Cải thìa được sản xuất ở vùng rau an toàn Hưng Nguyên với sự giám sát kỹ thuật chặt chẽ của DNTN Phú Tứ với tiêu chuẩn không hóa chất bảo vệ thực vật.', '1', '2012-07-25 16:27:30', '2012-07-25 16:30:24');
INSERT INTO `tbl_product_items` VALUES ('3', 'Rau Muống', '1343226700394.jpg', '8000', 'Sản xuất tại thành phố vinh', 'Cải thìa được sản xuất ở vùng rau an toàn của thành phố vinh với sự giám sát kỹ thuật chặt chẽ của DNTN Phú Tứ với tiêu chuẩn không hóa chất bảo vệ thực vật.', '1', '2012-07-25 16:31:40', '2012-07-25 16:31:40');
INSERT INTO `tbl_product_items` VALUES ('4', 'Rau Muống', '13432268923997.jpg', '8000', 'Sản xuất tại vùng rau an toàn của thành phố vinh', 'Cải thìa được sản xuất ở vùng rau an toàn Hưng Nguyên với sự giám sát kỹ thuật chặt chẽ của DNTN Phú Tứ với tiêu chuẩn không hóa chất bảo vệ thực vật.', '1', '2012-07-25 16:34:52', '2012-07-25 16:34:52');
INSERT INTO `tbl_product_items` VALUES ('5', 'Mướp Đắng', '1343227123405.jpg', '9000', 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An - Dưới sự giám sát chặt chẽ của DNTN Phú Tứ với tiêu chí \"Nói không với hóa chất bảo vệ thực vật\"', '1', '2012-07-25 16:38:43', '2012-07-25 16:38:43');
INSERT INTO `tbl_product_items` VALUES ('6', 'Giá Đỗ', '13432278331057.jpg', '17000', 'Sản xuất tại chỗ với công thức cổ truyền', 'Sản xuất tại chỗ với công thức cổ truyền của dân tộc. Sử dụng nguyên liệu đậu xanh lòng nổi tiếng của vùng đất thanh chương và nguồn nước ngầm tinh khiết, giá đỗ của công ty đảm bảo chất lượng cao nhất.', '1', '2012-07-25 16:42:53', '2012-07-25 16:50:33');
INSERT INTO `tbl_product_items` VALUES ('7', 'Cẩn Tây', '13432275662981.jpg', '12000', 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:46:06', '2012-07-25 16:46:06');
INSERT INTO `tbl_product_items` VALUES ('8', 'Cải Ngọt', '13432277582770.jpg', '9000', 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:49:18', '2012-07-25 16:49:18');
INSERT INTO `tbl_product_items` VALUES ('9', 'Cải Bẹ', '13432278121364.jpg', '7000', 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:50:12', '2012-07-25 16:50:12');
INSERT INTO `tbl_product_items` VALUES ('10', 'Cà Chua', '13432282532445.jpg', '15000', 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:57:33', '2012-07-25 16:57:33');
INSERT INTO `tbl_product_items` VALUES ('11', 'Cải Thảo', '13432283473397.jpg', '12000', 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:59:07', '2012-07-25 16:59:07');

-- ----------------------------
-- Table structure for `tbl_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles`;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles
-- ----------------------------
INSERT INTO `tbl_profiles` VALUES ('1', 'Admin', 'Administrator', '0000-00-00');
INSERT INTO `tbl_profiles` VALUES ('2', 'Demo', 'Demo', '0000-00-00');

-- ----------------------------
-- Table structure for `tbl_profiles_fields`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles_fields`;
CREATE TABLE `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles_fields
-- ----------------------------
INSERT INTO `tbl_profiles_fields` VALUES ('1', 'lastname', 'Last Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', '1', '3');
INSERT INTO `tbl_profiles_fields` VALUES ('2', 'firstname', 'First Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', '0', '3');
INSERT INTO `tbl_profiles_fields` VALUES ('3', 'birthday', 'Birthday', 'DATE', '0', '0', '2', '', '', '', '', '0000-00-00', 'UWjuidate', '{\"ui-theme\":\"redmond\"}', '3', '2');

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `saltkey` varchar(16) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', 'c1fcc27b17ec025bcbc0e287e98a236d26610368', 'webmaster@example.com', '1261146094', '1343219770', '1', '1', '1234567891230', 'ad1a172d73432cffb3f506885646390b');
INSERT INTO `tbl_users` VALUES ('2', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '1261146096', '0', '0', '1', '', '099f825543f7850cc038b90aaff39fac');
INSERT INTO `tbl_users` VALUES ('4', 'test', '4a93bb8f2a5d77c70f358cbe07e4e6b739043567', 'huyt2bt@webdev.vn', '1320389872', '1320396537', '0', '0', '4eb38cf04b5cb', '');
INSERT INTO `tbl_users` VALUES ('9', 'huytbt', 'ce46dcc0ceb76fcf18bc8edcbb5bd748af0890d2', 'huytbt@webdev.vn', '1320390511', '1320456076', '1', '1', '4eb3ad45f3e47', '9ea927ef933c468bc81280f554bd557f2bc83de0');
