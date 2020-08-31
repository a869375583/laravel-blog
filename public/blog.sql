/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 31/07/2020 15:35:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog_admin
-- ----------------------------
DROP TABLE IF EXISTS `blog_admin`;
CREATE TABLE `blog_admin`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `adminpass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of blog_admin
-- ----------------------------
INSERT INTO `blog_admin` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2130706433');

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cate_othername` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of blog_category
-- ----------------------------
INSERT INTO `blog_category` VALUES (1, '网站源码', 'coder');
INSERT INTO `blog_category` VALUES (2, '博客资讯', 'blog2');
INSERT INTO `blog_category` VALUES (3, '分类2', 'cate2');
INSERT INTO `blog_category` VALUES (4, '分类3', 'cate3');
INSERT INTO `blog_category` VALUES (5, '测试下', 'ceshi');

-- ----------------------------
-- Table structure for blog_post
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `cate_id` int(255) NULL DEFAULT NULL,
  `createTime` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `see` smallint(255) NULL DEFAULT NULL,
  `likeof` smallint(255) NULL DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of blog_post
-- ----------------------------
INSERT INTO `blog_post` VALUES (1, '第一篇文章', '<p>这是我写的第一篇文章1</p><p>53</p><p><br></p>', 1, '2020-07-12 13:39:51', 194, 200, NULL, NULL);
INSERT INTO `blog_post` VALUES (2, '第2篇文章', '<p>这是我写的第2篇文章</p><div id=\"toolbar-elem2647220690478129\"><br></div>', 1, '2020-07-12 13:40:01', 35, 14, NULL, NULL);
INSERT INTO `blog_post` VALUES (5, '432432', '<p>43243</p>', 2, '2020-07-13 21:12:53', 11, 1, NULL, NULL);
INSERT INTO `blog_post` VALUES (6, '432432', '<p>43243&nbsp;&nbsp;<br></p>', 2, '2020-07-13 21:14:09', NULL, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (7, '432432', '<p>43243&nbsp; 432432<br></p><p>43</p>', 2, '2020-07-13 21:14:16', 1, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (8, '432432', '43243', 2, '2020-07-13 21:14:20', NULL, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (9, '432432', '43243', 2, '2020-07-13 21:14:32', NULL, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (10, '432432', '43243', 2, '2020-07-13 21:14:33', NULL, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (11, 'blackcat自制资源付费高端主题', '32', 3, '2020-07-13 21:14:41', 5, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (12, 'blackcat自制资源付费高端主题', '32', 3, '2020-07-13 21:15:14', 4, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (13, '432432', '3213', 2, '2020-07-13 21:15:21', 2, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (14, '黑猫哈哈哈', '432', 4, '2020-07-13 21:15:37', NULL, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (15, 'blackcat自制资源付费高端主题323', '423', 1, '2020-07-13 21:15:59', NULL, 1, NULL, NULL);
INSERT INTO `blog_post` VALUES (16, '写一篇文章吧', '这是黑猫写的文章', 2, '2020-07-13 22:37:51', 2, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (19, 'collection', '<p>432</p>', 1, '2020-07-28 18:51:15', 1, NULL, NULL, NULL);
INSERT INTO `blog_post` VALUES (18, '新的文章', '<p>111</p>', 1, '2020-07-28 18:51:03', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for blog_system
-- ----------------------------
DROP TABLE IF EXISTS `blog_system`;
CREATE TABLE `blog_system`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `web_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of blog_system
-- ----------------------------
INSERT INTO `blog_system` VALUES (1, '黑猫博客吧', '全新起航', '博客,Blog', '单纯为了记录每日心情，学代码历程自建博客，黑猫blog', 'http://127.0.0.13', '/app/uploads/5f1fc08f272b3.png', '闽ICP备xxxx号');

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `avater_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES (1, 'heimao', '202cb962ac59075b964b07152d234b70', '2130706433', '/static/images/logo.png');
INSERT INTO `blog_user` VALUES (34, 'heimao888', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL);
INSERT INTO `blog_user` VALUES (33, '869375583@qq.com', '26c342943910c1f4c0d3da63030ddfa3', NULL, NULL);
INSERT INTO `blog_user` VALUES (32, 'a869375583', '26c342943910c1f4c0d3da63030ddfa3', NULL, NULL);
INSERT INTO `blog_user` VALUES (31, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2130706433', NULL);
INSERT INTO `blog_user` VALUES (35, 'erewtw', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL);
INSERT INTO `blog_user` VALUES (36, 'heimaonew', '26c342943910c1f4c0d3da63030ddfa3', NULL, NULL);
INSERT INTO `blog_user` VALUES (37, 'heimao5436', '26c342943910c1f4c0d3da63030ddfa3', NULL, '/static/images/avatar.jpg');
INSERT INTO `blog_user` VALUES (38, 'heimao54362', '26c342943910c1f4c0d3da63030ddfa3', '127.0.0.1', '/static/images/avatar.jpg');
INSERT INTO `blog_user` VALUES (39, 'heimao54365', '26c342943910c1f4c0d3da63030ddfa3', '127.0.0.1', '/static/images/avatar.jpg');

SET FOREIGN_KEY_CHECKS = 1;
