/*
 Navicat Premium Data Transfer

 Source Server         : Notebook
 Source Server Type    : MySQL
 Source Server Version : 100017
 Source Host           : 192.168.100.138:3306
 Source Schema         : osm_nrw

 Target Server Type    : MySQL
 Target Server Version : 100017
 File Encoding         : 65001

 Date: 09/03/2026 14:20:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = tis620 COLLATE = tis620_thai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$10$EDLUflQXpP4OahK6ftqEM.Q4phyX0TVXaoOK87OCB/hmuNVcsDUhS', 'admin', '2026-03-09 08:18:20');

-- ----------------------------
-- Table structure for volunteers
-- ----------------------------
DROP TABLE IF EXISTS `volunteers`;
CREATE TABLE `volunteers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `card_no` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `cid` varchar(13) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `birthdate` date NULL DEFAULT NULL,
  `house_no` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `village_no` varchar(3) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `subdistrict` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `year_start` varchar(4) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `blood_group` varchar(2) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `occupation` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `education_level` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `marital_status` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `unit_name` varchar(150) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `district` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT '',
  `province` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT '',
  `keyword` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = tis620 COLLATE = tis620_thai_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of volunteers
-- ----------------------------
INSERT INTO `volunteers` VALUES (1, '123456', '1360254682235', 'นายวิษณุ เสาะสาย', '2025-07-16', '47/2', '11', 'หนองระเวียง', '2531', 'B', 'รับจ้าง', 'ม.6', 'สมรส', 'รพ.สต.หรองระเวียง', '2025-07-16 19:31:59', 'พิมาย', 'นครราชสีมา', '');

SET FOREIGN_KEY_CHECKS = 1;
