/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50531
 Source Host           : localhost:3306
 Source Schema         : osm_nrw

 Target Server Type    : MySQL
 Target Server Version : 50531
 File Encoding         : 65001

 Date: 16/07/2025 16:50:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for volunteers
-- ----------------------------
DROP TABLE IF EXISTS `volunteers`;
CREATE TABLE `volunteers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_no` varchar(50) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `cid` varchar(13) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `birthdate` date NULL DEFAULT NULL,
  `house_no` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `village_no` varchar(10) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `subdistrict` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `district` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `province` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `year_start` year(4) NULL DEFAULT NULL,
  `blood_group` varchar(5) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `occupation` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `education_level` varchar(100) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `marital_status` varchar(50) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `unit_name` varchar(150) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = tis620 COLLATE = tis620_thai_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of volunteers
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
