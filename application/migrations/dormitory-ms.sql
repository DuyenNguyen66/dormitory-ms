/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : dormitory-ms

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 16/06/2019 15:56:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `position_id` int(11) NULL DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `assigned` tinyint(4) NOT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE,
  INDEX `position_id`(`position_id`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  CONSTRAINT `group_id` FOREIGN KEY (`group_id`) REFERENCES `group_user` (`group_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `position_id` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for assignment
-- ----------------------------
DROP TABLE IF EXISTS `assignment`;
CREATE TABLE `assignment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `building_assign`(`building_id`) USING BTREE,
  CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `building_assign` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for bill
-- ----------------------------
DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill`  (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_type` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `total_pay` float(10, 0) NOT NULL,
  `deadline` int(11) NOT NULL,
  `paid` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`bill_id`) USING BTREE,
  INDEX `bill_type2`(`bill_type`) USING BTREE,
  INDEX `bill_room`(`room_id`) USING BTREE,
  INDEX `bill_term`(`term_id`) USING BTREE,
  CONSTRAINT `bill_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `bill_term` FOREIGN KEY (`term_id`) REFERENCES `term` (`term_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `bill_type2` FOREIGN KEY (`bill_type`) REFERENCES `bill_type` (`type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for bill_type
-- ----------------------------
DROP TABLE IF EXISTS `bill_type`;
CREATE TABLE `bill_type`  (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for building
-- ----------------------------
DROP TABLE IF EXISTS `building`;
CREATE TABLE `building`  (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`building_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ethnic
-- ----------------------------
DROP TABLE IF EXISTS `ethnic`;
CREATE TABLE `ethnic`  (
  `ethnic_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ethnic_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for floor
-- ----------------------------
DROP TABLE IF EXISTS `floor`;
CREATE TABLE `floor`  (
  `floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `building_id` int(11) NOT NULL,
  PRIMARY KEY (`floor_id`) USING BTREE,
  INDEX `building_id`(`building_id`) USING BTREE,
  CONSTRAINT `building_id` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for group_user
-- ----------------------------
DROP TABLE IF EXISTS `group_user`;
CREATE TABLE `group_user`  (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `posted_at` int(11) NOT NULL,
  `noti_type` tinyint(4) NOT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for position
-- ----------------------------
DROP TABLE IF EXISTS `position`;
CREATE TABLE `position`  (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`position_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for price
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price`  (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `bill_type` int(11) NOT NULL COMMENT '1: water | 2: electricity | 3: room',
  PRIMARY KEY (`price_id`) USING BTREE,
  INDEX `bill_type`(`bill_type`) USING BTREE,
  CONSTRAINT `bill_type` FOREIGN KEY (`bill_type`) REFERENCES `bill_type` (`type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for registration
-- ----------------------------
DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `registed` int(11) NOT NULL,
  `confirmed` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `room_id`(`room_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `term_id`(`term_id`) USING BTREE,
  CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `term_id` FOREIGN KEY (`term_id`) REFERENCES `term` (`term_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for religion
-- ----------------------------
DROP TABLE IF EXISTS `religion`;
CREATE TABLE `religion`  (
  `religion_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`religion_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 98 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for report_detail
-- ----------------------------
DROP TABLE IF EXISTS `report_detail`;
CREATE TABLE `report_detail`  (
  `building_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `num_paid` int(11) NOT NULL,
  `num_not_paid` int(11) NOT NULL,
  `expected_total` float(10, 0) NOT NULL,
  `actual_total` float(10, 0) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `report_id`(`report_id`) USING BTREE,
  CONSTRAINT `report_id` FOREIGN KEY (`report_id`) REFERENCES `reports` (`report_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for reports
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports`  (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `expected_total` float(10, 0) NULL DEFAULT NULL,
  `actual_total` float(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`report_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room`  (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '0: Male | 1: Female',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `building_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`room_id`) USING BTREE,
  INDEX `floor_id`(`floor_id`) USING BTREE,
  CONSTRAINT `floor_id` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`floor_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for room_pay
-- ----------------------------
DROP TABLE IF EXISTS `room_pay`;
CREATE TABLE `room_pay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `total_student` int(11) NOT NULL,
  `total_pay` float(10, 0) NOT NULL,
  `deadline` int(11) NOT NULL,
  `paid` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `term`(`term_id`) USING BTREE,
  INDEX `room`(`room_id`) USING BTREE,
  CONSTRAINT `room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `term` FOREIGN KEY (`term_id`) REFERENCES `term` (`term_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `student_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `student_card` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '0: Male | 1: Female',
  `birthday` int(255) NOT NULL,
  `religion_id` int(11) NULL DEFAULT NULL,
  `ethnic_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`student_id`) USING BTREE,
  INDEX `ethnic_id`(`ethnic_id`) USING BTREE,
  INDEX `religion_id`(`religion_id`) USING BTREE,
  CONSTRAINT `ethnic_id` FOREIGN KEY (`ethnic_id`) REFERENCES `ethnic` (`ethnic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `religion_id` FOREIGN KEY (`religion_id`) REFERENCES `religion` (`religion_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for term
-- ----------------------------
DROP TABLE IF EXISTS `term`;
CREATE TABLE `term`  (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`term_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
