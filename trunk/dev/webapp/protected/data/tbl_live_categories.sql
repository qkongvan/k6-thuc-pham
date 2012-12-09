/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : plugins_dev

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-12-09 16:09:47
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tbl_live_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_live_categories`;
CREATE TABLE `tbl_live_categories` (
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_live_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_live_category_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_live_category_item`;
CREATE TABLE `tbl_live_category_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_item_id` (`item_id`) USING BTREE,
  KEY `idx_caregory_id` (`category_id`) USING BTREE,
  CONSTRAINT `fk2` FOREIGN KEY (`item_id`) REFERENCES `tbl_live_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_live_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_live_category_item
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_live_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_live_items`;
CREATE TABLE `tbl_live_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_content` text,
  `content` text,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_live_items
-- ----------------------------
