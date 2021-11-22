/*
 Navicat Premium Data Transfer

 Source Server         : mysql_local
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : sps_bbk

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 22/11/2021 15:53:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis_persyaratan
-- ----------------------------
DROP TABLE IF EXISTS `jenis_persyaratan`;
CREATE TABLE `jenis_persyaratan`  (
  `id_jenis_persyaratan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_jenis_persyaratan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis_persyaratan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_persyaratan
-- ----------------------------

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media`  (
  `id_media` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_relasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_entity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `path_media` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_media` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_jenis_persyaratan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_media` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1' COMMENT '1=pending, 2=tolak, 3=terima',
  `no_urut` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_media`) USING BTREE,
  CONSTRAINT `fk_id_jenis_persyaratan_media` FOREIGN KEY (`id_jenis_persyaratan`) REFERENCES `jenis_persyaratan` (`id_jenis_persyaratan`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of media
-- ----------------------------

-- ----------------------------
-- Table structure for persyaratan_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `persyaratan_perusahaan`;
CREATE TABLE `persyaratan_perusahaan`  (
  `id_perusahaan_persyaratan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_jenis_persyaratan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_media` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_perusahaan_persyaratan`) USING BTREE,
  CONSTRAINT `fk_id_jenis_perusahaan_persyaratan_perusahaan` FOREIGN KEY (`id_jenis_persyaratan`) REFERENCES `jenis_persyaratan` (`id_jenis_persyaratan`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_id_media_persyaratan_perusahaan` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_id_perusahaan_persyaratan_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahan`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of persyaratan_perusahaan
-- ----------------------------

-- ----------------------------
-- Table structure for perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE `perusahaan`  (
  `id_perusahan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_ceo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_perusahaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `provinsi_perusahaan` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kabupaten_perusahaan` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kecamatan_perusahaan` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kelurahan_perusahaan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_pos_perusahaan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_telp_perusahaan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fax_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_registrasi_perusahaan` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `jenis_perusahaan` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1' COMMENT '1=manufaktur, 2=importir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_perusahan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perusahaan
-- ----------------------------

-- ----------------------------
-- Table structure for perusahaan_pic
-- ----------------------------
DROP TABLE IF EXISTS `perusahaan_pic`;
CREATE TABLE `perusahaan_pic`  (
  `id_perusahaan_pic` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_lengkap_perusahaan_pic` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email_perusahaan_pic` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_telp_perusahaan_pic` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_perusahaan_pic`) USING BTREE,
  CONSTRAINT `fk_id_perusahaan_perusahaan_pic` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahan`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_id_user_perusahaan_pic` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perusahaan_pic
-- ----------------------------

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id_produk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_produk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `paten_merk_produk` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '2' COMMENT '1=ya, 2=tidak',
  `standar_sistem_mutu_produk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe_jenis_produk` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------

-- ----------------------------
-- Table structure for standar_sni
-- ----------------------------
DROP TABLE IF EXISTS `standar_sni`;
CREATE TABLE `standar_sni`  (
  `id_standar_sni` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_standar_sni` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_standar_sni`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of standar_sni
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_verifikasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_verifikasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1' COMMENT '1=pending, 2=tolak, 3=terima',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
