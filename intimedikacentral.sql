/*
 Navicat Premium Data Transfer

 Source Server         : intimedika
 Source Server Type    : MySQL
 Source Server Version : 50537
 Source Host           : 127.0.0.1:3306
 Source Schema         : intimedikacentral

 Target Server Type    : MySQL
 Target Server Version : 50537
 File Encoding         : 65001

 Date: 13/12/2019 17:01:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for inti_login
-- ----------------------------
DROP TABLE IF EXISTS `inti_login`;
CREATE TABLE `inti_login`  (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_user` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NULL DEFAULT NULL,
  `level` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'sales',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of inti_login
-- ----------------------------
INSERT INTO `inti_login` VALUES (9, '1', 'sarah', '$2y$10$Ee4SFfrJCb4qrcJGPMoheeLi/6Bhu9jmNXu6sA1nePwFcNJsgEfrS', 'supervisorsales');
INSERT INTO `inti_login` VALUES (10, '2', 'rapli', '$2y$10$K90vqP70oHzC5U1YZQCkhOdbaffVciSG3Akt2jpU8NzMckfZEqlHi', 'superadmin');
INSERT INTO `inti_login` VALUES (11, '3', 'pli', '$2y$10$nwHIkWVt3wlCUxtRPOLiJuGBGkyPLjnCuv7s6uiZeCRwinWrjF3Wq', 'sales');
INSERT INTO `inti_login` VALUES (12, '4', 'eggy', '$2y$12$VdhFdiBPydszgQuPZutdkOyn6f6swUiJ3mw/A7WgU4ZsiEmFGTn0G', 'sales');
INSERT INTO `inti_login` VALUES (13, '5', 'febrian', '$2y$10$DuWettnlXQNOKQMnoSGOCu8NyWpAOyDd5yzjdkanEjNaMaOxVeMLO', 'sales');
INSERT INTO `inti_login` VALUES (14, '6', 'cobarahmat', '$2y$10$7GE1xmo9TynjN4/4jEEyLOaFEYi0/Ef.PGN7o2IUYBdvjkCozTYp.', 'sales');
INSERT INTO `inti_login` VALUES (15, '7', 'iyul', '$2y$10$7GE1xmo9TynjN4/4jEEyLOaFEYi0/Ef.PGN7o2IUYBdvjkCozTYp.', 'sales');
INSERT INTO `inti_login` VALUES (16, '8', 'iyul', '$2y$10$i3s3KgTbCAlwFbIOVKxVweOJVkqbBPdiRnNjj9iBITIpeXpIzHoqm', 'sales');
INSERT INTO `inti_login` VALUES (17, '9', 'jul', '$2y$10$2nagMJ.OJMVbnfYsRpmrbu2zhUmGMEbcRmVUGaRDxuSs2CHNKHUji', 'sales');
INSERT INTO `inti_login` VALUES (18, '10', 'cobacoba', '$2y$10$I7.fy9Tfrt8IitqaZzqejOEQuPaU0FaU5bMXSa1O4wHTzE6qLrmq6', 'sales');
INSERT INTO `inti_login` VALUES (19, '11', 'admin', '$2y$10$BUrgYkzmFWeE6M1wDxImseE5P3gbj6ReO7R8iwyE7hziOeFNbsFrO', 'admin');
INSERT INTO `inti_login` VALUES (20, '12', 'eggy1998', '$2y$10$tbbu6Gyqbt3.YnguUGOmKOxHUpSvWPzWW4ijiLEHO7Y1L5XrVHMci', 'sales');
INSERT INTO `inti_login` VALUES (21, '13', '', '$2y$10$FNxFadUHpwsTwHlinsDvpOOXmSkJSn3/l0O0NfOq2xYBqKCBZZ2VW', 'pilih...');
INSERT INTO `inti_login` VALUES (22, '14', 'spvteten', '$2y$10$5dDN2hNNgVTi0E/NrS9R/OjbUQNNZNHlKNEOV4FW3gsyKADngSnWq', 'supervisorsales');
INSERT INTO `inti_login` VALUES (23, '15', 'user', '$2y$10$Fx/Z7/yzJznz94ZPMPFOvu1zwxRAgc1jBsJTp7Xr8S.aYApNPffVC', 'users');
INSERT INTO `inti_login` VALUES (24, '16', 'users', '$2y$10$P4qoQQ34q8wzM7yvloXk2evyNOaZADo1uR8/hkdnwKnGqRSz4w.Jy', 'users');
INSERT INTO `inti_login` VALUES (25, '17', 'dika', '$2y$10$CCnHaDIHL81Vo3FIKugfqO1JkvmXrGqs6.7eSCA3fneVDOIcuyYgi', 'sales');
INSERT INTO `inti_login` VALUES (26, '18', 'opal', '$2y$10$Yca3JzFcUkpiIJDVaF63M.f/F06ZQyGyfTeIZltxcbQGUhzYx/5WW', 'distributor');
INSERT INTO `inti_login` VALUES (27, '19', 'admin_demo', '$2y$10$cAn1EQZC0M5eydsWGu48wOQHoQslpzczV1OgTpD6mpkF/zQtCb54.', 'intiadmin');
INSERT INTO `inti_login` VALUES (28, '20', 'distrib', '$2y$10$0eapoHQHlQ6LkterdypFHuBIprVB5YzrGM3RWtok6cyPJq7Vii7pO', 'distributor');

-- ----------------------------
-- Table structure for inti_user
-- ----------------------------
DROP TABLE IF EXISTS `inti_user`;
CREATE TABLE `inti_user`  (
  `pk_user` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `targett` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approve_target` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `super_target` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of inti_user
-- ----------------------------
INSERT INTO `inti_user` VALUES (1, 'sarah', 'Sarah Ardhelia', 'sarah@intimedica.co', '85 Jl Bona', 'Jakarta Timur', 'indonesia', '', NULL, 'supervisorsales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (2, 'rapli', 'Rafli', 'z@gmail.com', 'asd', 'as', 'indonesia', 'a', NULL, 'superadmin', 'approved', '100000000000');
INSERT INTO `inti_user` VALUES (3, 'pli', 'Rafli Sariawan', 'r@gmail.com', 'Jatiwaringin', 'DKI Jakarta', 'pli', '12740', '3500000000', 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (4, 'eggy', 'Rahmat Setiawan', 'eggy22@yahoo.com', 'Jl Penggilingan', 'Jakarta Timur', 'indonesia', '13490', '1000000000', 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (5, 'febrian', 'Febrian Faturahman', 'febriamftr@intimedika.co', 'Jl. Rawa Semut', 'Bekasi Timur', 'indonesia', '17441', NULL, 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (8, 'iyul', 'rapli', 'm@gmail.com', 'q', 'q', 'indonesia', 'q', '20000000000', 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (9, 'jul', 'j', 'q@gmail.com', 'a', 'a', 'indonesia', 'q', NULL, 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (10, 'cobacoba', 'cobs2', 'ppk@gmail.com', '1141', 'llo', 'indonesia', '135221', NULL, 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (11, 'admin', 'admin regis', 'admin@intimedika.co', 'boulevard', 'jakarta', '...', '10109', NULL, 'admin', 'approved', NULL);
INSERT INTO `inti_user` VALUES (12, 'eggy1998', 'Rahmat Setiawan', 'rahmat22@intimedica.co', '1223', 'Jakarta', '...', '231', NULL, 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (13, '', '', '', '', '', 'Pilih...', '', NULL, 'pilih...', 'approved', NULL);
INSERT INTO `inti_user` VALUES (14, 'spvteten', 'Pak Teten', 'teten2@intimedika.co', 'Kelapa Gading', 'Jakarta Timur', '...', '2222', NULL, 'supervisorsales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (15, 'user', 'user', 'user@user.co', 'user', 'Jakarta Utara', '...', '', NULL, 'users', 'approved', NULL);
INSERT INTO `inti_user` VALUES (16, 'users', 'user', 'newuser@usernew', 'Front the Desk', 'Jakarta', '...', '', NULL, 'users', 'approved', NULL);
INSERT INTO `inti_user` VALUES (17, 'dika', 'dika', 'a@yahoo', 'bekasi', 'bekasi', '...', '', '1000000001', 'sales', 'approved', NULL);
INSERT INTO `inti_user` VALUES (18, 'opal', 'PT Opal', 'opal@intimedika.co', 'Jl. Medan', 'Medan', '...', '', '1000000000', 'distributor', 'approved', NULL);
INSERT INTO `inti_user` VALUES (19, 'admin_demo', 'Demo Admin', 'a@yahoo.com', 'Front', 'Jakarta', 'Indonesia', '', NULL, 'intiadmin', 'approved', NULL);
INSERT INTO `inti_user` VALUES (20, 'distrib', 'distrib', 'd@yahoo.com', 'distrib', 'distrib', 'Indonesia', NULL, NULL, 'distributor', 'approved', NULL);

-- ----------------------------
-- Table structure for sales_customer
-- ----------------------------
DROP TABLE IF EXISTS `sales_customer`;
CREATE TABLE `sales_customer`  (
  `pk_cust` int(11) NOT NULL,
  `koders_cust` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_cust` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hp_cust` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_cust` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jabatan_cust` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_cust` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat_cust` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `tlp_cust` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kota_cust` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `negara_cust` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pos_cust` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now_cust` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `npwp_cust` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dry_film_cust` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_cust`) USING BTREE,
  UNIQUE INDEX `koders_cust`(`koders_cust`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_customer
-- ----------------------------
INSERT INTO `sales_customer` VALUES (1, '', 'David', '092928', 'e@yahoo.com', 'Dr Radiologi', 'Rumah Sakit Cipto Mangunkusumo', 'Jl Rawamangun2', '0992828', 'Jakarta Timur', 'Choose...', '', '2019-11-25 14:17:11', '', '', NULL);
INSERT INTO `sales_customer` VALUES (2, 'RSBT', 'Dika', '09938', 'f@yahoo.com', 'Radiographer', 'Rumah Sakit Bunda Thamrin', 'Medan', '022249', 'Medan', 'Choose...', '', '2019-11-25 14:21:50', 'sarah', 'a', NULL);
INSERT INTO `sales_customer` VALUES (3, 'RSPR', 'Kunto', '089898989898', 'm@gmail.com', 'Radiographer', 'Rumah Sakit Pasar Rebo', 'Jl. Raya Bogor No.30', '012121212', 'DKI Jakarta', 'Choose...', '', '2019-11-25 10:34:28', 'pli', '92254554', NULL);
INSERT INTO `sales_customer` VALUES (4, 'RSUDJ', 'Sarah', '08898', 's@ymail.com', 'Radiographer', 'RSUD Jakarta', 'Jakarta Pusat', '022342', 'Jakarta', 'Choose...', '', '2019-11-25 12:11:39', 'pli', '9787676', NULL);
INSERT INTO `sales_customer` VALUES (5, 'RSIJ', 'Aji', '088929', 'a@yahoo.com', 'Radiographer', 'Rumah sakit Islam Jakarta', 'Jl Pondok Kopi', '0221', 'Jakarta', 'Choose...', NULL, '2019-11-26 15:03:35', 'pli', '2323', NULL);
INSERT INTO `sales_customer` VALUES (12, 'RSKJN', 'Irfan', '081818181', 'm@gmail.com', 'Management', 'RSUD Kajen', 'Jl. Pekalongan, kajen', '021212121', 'Pekalongan', 'Choose...', '', '2019-11-25 14:22:47', 'sarah', '1', NULL);
INSERT INTO `sales_customer` VALUES (13, 'RSHSM', 'Rohman Alhakim', '085858585', 'm@gmail.com', 'Kepala Radiologi', 'RS Harum Sisma Medika', 'Jl. Kalimalang N0.97', '021323232', 'Jakarta Timur', 'indonesia', '', '2019-11-25 13:42:46', 'pli', NULL, NULL);
INSERT INTO `sales_customer` VALUES (14, 'RSJA', 'arif hidayat', '0882221', 'hidayat@mail.com', 'Radiographer', 'Rumah Sakit Jakarta ', 'Jl Rawabadak', '0885454', 'Jakarta Timur', 'Choose...', '', '2019-11-26 15:03:44', 'pli', '11111', NULL);
INSERT INTO `sales_customer` VALUES (15, 'RSPAD', 'Ujang', '088547', 's@yahoo.com', 'Radiographer', 'RSPAD Gatot Subroto', 'Jl Senen', '887878', 'Jakarta Pusat', 'indonesia', '', '2019-11-26 13:12:35', 'eggy', NULL, NULL);
INSERT INTO `sales_customer` VALUES (16, 'RSBT2', 'kutamz', '081289580210122', 'andika@gmail.com', 'IT Medical', 'rumah sakit bunda thamrin', 'jl medan', '021-50000', 'medan', 'Choose...', '', '2019-11-26 15:06:21', 'dika', '3333333', NULL);
INSERT INTO `sales_customer` VALUES (17, 'RSAM', 'eggypen', '081289580210', 'e@gmail.com', 'IT', 'rumah sakit antam medika', 'jl bekasi2', '021-50000', 'medan', 'indonesia', '', '2019-12-13 16:00:25', 'opal', '55554', NULL);
INSERT INTO `sales_customer` VALUES (18, 'RSG', 'febrianpatur', '081289580210', 'e@gmail.com', 'IT', 'rumah sakit garut', 'jl medan', '021-50000', 'medan', '', '', '2019-11-26 15:14:46', 'dika', NULL, NULL);
INSERT INTO `sales_customer` VALUES (19, 'aa', 'a', 'a', 'a', 'aa', 'aa', 'aa', 'aaa', 'aaa', 'malaysia', '', '2019-12-02 13:15:32', 'pli', NULL, NULL);
INSERT INTO `sales_customer` VALUES (20, 'RS128', 'Anry', '88585', 'a@yahoo.com', 'Radiographer/Radiologi', 'Rumah Sakit 128', 'Jkpst', '888578588', 'Jakarta', 'indonesia', NULL, '2019-12-11 10:45:50', 'opal', '88787', NULL);
INSERT INTO `sales_customer` VALUES (21, 'RS127', 'Umar', '05454', 'a@yahoo.com', 'Radiographer/Radiologi', 'Rumah Sakit 127', 'Jkpst', '484848', 'Jakarta', 'indonesia', NULL, '2019-12-13 09:51:48', 'opal', '88878', NULL);
INSERT INTO `sales_customer` VALUES (22, 'RSUDPSRN', 'a', 'a', 'a', 'a', 'RSUD Pasuruan', 'a', '3434', 'aa', 'Choose...', NULL, '2019-12-11 16:22:16', 'opal', 'a', NULL);
INSERT INTO `sales_customer` VALUES (23, 'RSHSby', 'Armin', '002212', 'a@yahoo.com', 'Radiographer/Radiologi', 'Rumah Sakit Haji Surabaya', 'Jkpst', '3434', '78787', 'indonesia', NULL, '2019-12-11 16:22:50', 'opal', '77788787', NULL);
INSERT INTO `sales_customer` VALUES (24, 'RSH', 'Ujang', '55855', 'u@yahooc.com', 'Radiographer/Radiologi', 'Rumah Sakit Harapan', 'Alam Sutera', '8558', 'Tanggerang', 'indonesia', NULL, '2019-12-11 10:44:34', 'opal', '885585', NULL);
INSERT INTO `sales_customer` VALUES (25, 'RSMMC', NULL, NULL, NULL, NULL, 'Rumah Sakit MMC', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);
INSERT INTO `sales_customer` VALUES (26, 'RSBD', NULL, NULL, NULL, NULL, 'RS BANDUNG', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);
INSERT INTO `sales_customer` VALUES (27, 'RSJKT', NULL, NULL, NULL, NULL, 'RS JAKARTA', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);
INSERT INTO `sales_customer` VALUES (28, 'RSJKBRG', NULL, NULL, NULL, NULL, 'RS JAKABARING', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);
INSERT INTO `sales_customer` VALUES (29, 'RSJGKRS', NULL, NULL, NULL, NULL, 'RS JAGAKARSA', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);
INSERT INTO `sales_customer` VALUES (30, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'indonesia', '', '2019-12-11 08:30:26', 'pli', NULL, NULL);
INSERT INTO `sales_customer` VALUES (31, 'bbb', 'b', 'bb', 'b', 'bb', 'b', 'b', 'b', 'b', 'indonesia', '', '2019-12-11 08:33:03', 'pli', NULL, NULL);
INSERT INTO `sales_customer` VALUES (32, 'RS BRR', NULL, NULL, NULL, NULL, 'RS BURANGRANG', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);
INSERT INTO `sales_customer` VALUES (33, 'RSP', NULL, NULL, NULL, NULL, 'RS PAPUA', NULL, NULL, NULL, NULL, NULL, NULL, 'opal', NULL, NULL);

-- ----------------------------
-- Table structure for sales_funnel
-- ----------------------------
DROP TABLE IF EXISTS `sales_funnel`;
CREATE TABLE `sales_funnel`  (
  `pk` int(10) NOT NULL,
  `penawaran_fk` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_fk` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kota_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_penawaran` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `month_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `budget_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy6` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy5` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy4` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `buy_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status2_funnel` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `start_funnel` datetime NULL DEFAULT NULL,
  `end_funnel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approve2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approve` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `referensi_funnel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cancel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `harga_po` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_upload` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now30` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now50` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now70` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now85` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now90` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_presentasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now_presentasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mod_presentasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delete_funnel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approve_presentasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estimasi_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tanggal_kirim` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tanggal_terima` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kirim` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kirim50` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kirim100` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kirim70` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `resi_kirim` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `resi_terima` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tujuan_funnel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  UNIQUE INDEX `no_penawaran`(`no_penawaran`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_funnel
-- ----------------------------
INSERT INTO `sales_funnel` VALUES (81, NULL, ' 21', 'Rumah Sakit 127', '', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 09:51:18', NULL, 'approved', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, 'Saturday, 14-12-2019 09:52', 'Saturday, 14-12-2019 09:54', '100%', '50%', '100%', '70%', '5df2fd01247be.pdf', '5df2fd8083af4.pdf', 'distributor');
INSERT INTO `sales_funnel` VALUES (82, '67', ' 3', 'Rumah Sakit Pasar Rebo', 'DKI Jakarta', 'Q-0066/IPI//pli/XII/2019', 'IV', 'APBN', '100%', '90%', '85%', '70%', '50%', '30%', '100%', 'WIN', 'SUDAH DEAL', '2019-12-13 09:59:47', NULL, 'approved', 'approved', '5df2fefd1b770.pdf', 'pli', 'E-Catalogue', NULL, '650000', '2019-12-13 10:01:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, 'Friday, 13-12-2019 10:08', 'Saturday, 14-12-2019 10:08', '100%', '50%', '100%', '70%', '5df300c1c55bd.pdf', '5df300cd18481.pdf', 'sales');
INSERT INTO `sales_funnel` VALUES (83, NULL, ' 23', 'Rumah Sakit Haji Surabaya', '78787', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 10:11:45', NULL, 'approved', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, 'Friday, 13-12-2019 10:12', 'Saturday, 14-12-2019 10:12', '100%', '50%', '100%', '70%', '5df301b3cc898.pdf', '5df301c89db5e.pdf', 'distributor');
INSERT INTO `sales_funnel` VALUES (84, NULL, ' 23', 'Rumah Sakit Haji Surabaya', '78787', NULL, 'IV', 'APBD', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 10:49:13', NULL, 'approved', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, 'Friday, 13-12-2019 10:49', 'Saturday, 14-12-2019 10:51', '100%', '50%', '100%', '70%', '5df30a66b90c5.pdf', '5df30ab76b8cb.pdf', 'distributor');
INSERT INTO `sales_funnel` VALUES (85, '1', ' 3', 'Rumah Sakit Pasar Rebo', 'DKI Jakarta', 'Q-0000/IPI//pli/XII/2019', 'IV', 'APBN', '100%', '90%', '85%', '70%', '50%', '30%', '100%', 'WIN', 'SUDAH DEAL', '2019-12-13 10:54:15', NULL, 'approved', 'approved', '5df30c51ab71b.pdf', 'pli', 'E-Catalogue', NULL, '660000000', '2019-12-13 10:58:09', NULL, '2019-12-13 10:56:03', NULL, NULL, NULL, NULL, '14-12-2019', 'RIS', 'ada', 'approved', NULL, 'Friday, 13-12-2019 11:09', 'Friday, 13-12-2019 11:09', '100%', '50%', '100%', '70%', '5df30f074ebe9.pdf', '5df30f13bca87.pdf', 'sales');
INSERT INTO `sales_funnel` VALUES (86, '2', ' 14', 'Rumah Sakit Jakarta ', 'Jakarta Timur', 'Q-0001/IPI//pli/XII/2019', 'IV', 'APBD', '100%', '90%', '85%', '70%', '50%', '30%', '100%', 'WIN', 'USER COCOK DENGAN SPESIFIKASI BARANG', '2019-12-13 13:22:03', NULL, 'approved', 'approved', '5df3389fe935f.pdf', 'pli', 'E-Catalogue', NULL, '80000000', '2019-12-13 14:07:11', NULL, '2019-12-13 13:56:25', '2019-12-13 14:06:43', NULL, NULL, NULL, '14-12-2019', 'Intiwid SCP', 'ada', 'approved', NULL, 'Friday, 13-12-2019 14:22', 'Sunday, 15-12-2019 14:28', '100%', '50%', '100%', '70%', '5df33c35a0033.pdf', '5df33d89d0797.pdf', 'sales');
INSERT INTO `sales_funnel` VALUES (87, NULL, ' 20', 'Rumah Sakit 128', 'Jakarta', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 14:54:54', NULL, 'rejected', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_funnel` VALUES (88, NULL, ' 24', 'Rumah Sakit Harapan', 'Tanggerang', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 16:04:46', NULL, 'approved', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, 'Friday, 13-12-2019 16:09', 'Saturday, 14-12-2019 16:14', '100%', '50%', '100%', '70%', '5df35558cd977.pdf', '5df35665ee5ca.pdf', 'distributor');
INSERT INTO `sales_funnel` VALUES (89, NULL, ' 26', 'RS BANDUNG', '', NULL, 'IV', 'APBD', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 16:16:10', NULL, 'rejected', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_funnel` VALUES (90, '3', ' 4', 'RSUD Jakarta', 'Jakarta', 'Q-0002/IPI//pli/XII/2019', 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, '30%', '30%', 'Rejected by Spv. Sales', NULL, '2019-12-13 16:16:32', NULL, NULL, 'rejected', NULL, 'pli', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sales');
INSERT INTO `sales_funnel` VALUES (91, '4', ' 3', 'Rumah Sakit Pasar Rebo', 'DKI Jakarta', 'Q-0003/IPI//pli/XII/2019', 'IV', 'APBN', '100%', '90%', '85%', '70%', '50%', '30%', '100%', 'WIN', 'DEAL', '2019-12-13 16:17:26', NULL, 'rejected', 'approved', '5df3574f68be5.pdf', 'pli', 'E-Catalogue', NULL, '550000000', '2019-12-13 16:18:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sales');
INSERT INTO `sales_funnel` VALUES (92, NULL, ' 20', 'Rumah Sakit 128', 'Jakarta', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 16:33:24', NULL, 'rejected', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_funnel` VALUES (93, NULL, ' 20', 'Rumah Sakit 128', 'Jakarta', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 16:34:32', NULL, 'rejected', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_funnel` VALUES (94, NULL, ' 24', 'Rumah Sakit Harapan', 'Tanggerang', NULL, 'IV', 'APBD', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 16:34:50', NULL, 'rejected', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_funnel` VALUES (95, NULL, ' 20', 'Rumah Sakit 128', 'Jakarta', NULL, 'IV', 'APBN', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 'WIN', NULL, '2019-12-13 16:58:45', NULL, 'rejected', 'approved', NULL, 'opal', 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'distributor');

-- ----------------------------
-- Table structure for sales_funnel2
-- ----------------------------
DROP TABLE IF EXISTS `sales_funnel2`;
CREATE TABLE `sales_funnel2`  (
  `pk` int(11) NOT NULL,
  `customer_fk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_funnel2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kota_funnel2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `progress_funnel2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status_funnel2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tahun_funnel2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_funnel2
-- ----------------------------
INSERT INTO `sales_funnel2` VALUES (1, '32', 'RS BURANGRANG', NULL, '90%', 'Membutuhkan CT-SCAN & Dry Film', NULL, 'opal', '2019');
INSERT INTO `sales_funnel2` VALUES (2, '33', 'RS PAPUA', NULL, '90%', 'MEMBUTUHKAN DRY FILM & CT-SCAN', NULL, 'opal', '2019');

-- ----------------------------
-- Table structure for sales_kunjungan
-- ----------------------------
DROP TABLE IF EXISTS `sales_kunjungan`;
CREATE TABLE `sales_kunjungan`  (
  `pk_kunjungan` int(11) NOT NULL,
  `nama_kunjungan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hp_kunjungan` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_kunjungan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jabatan_kunjungan` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `koders_kunjungan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_kunjungan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat_kunjungan` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `tlp_kunjungan` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kota_kunjungan` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `negara_kunjungan` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pos_kunjungan` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `req_kunjungan` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `img_kunjungan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date_kunjungan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now_kunjungan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dry_film_kunjungan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hasil_kunjungan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_kunjungan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_kunjungan
-- ----------------------------
INSERT INTO `sales_kunjungan` VALUES (1, 'David', '092928', 'e@yahoo.com', 'Dr Radiologi', 'RSCM', 'Rumah Sakit Cipto Mangunkusumo', 'Jl Rawamangun', '0992828', 'Jakarta Timur', 'indonesia', '', 'DRY FILM', NULL, '22-11-2019 14:31', '2019-11-21 14:31:38', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (2, 'Dika', '09938', 'f@yahoo.com', 'Radiographer', 'RSBT', 'Rumah Sakit Bunda Thamrin', 'Medan', '022249', 'Medan', 'indonesia', '', 'Dry Film', NULL, '21-11-2019 14:32', '2019-11-21 14:32:51', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (3, 'Kunto', '089898989898', 'm@gmail.com', 'Radiographer', 'RSPR', 'Rumah Sakit Pasar Rebo', 'Jl. Raya Bogor No.30', '012121212', 'DKI Jakarta', 'indonesia', '', 'Dry Film', NULL, '22-11-2019 09:20', '2019-11-22 09:20:46', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (4, 'Sarah', '08898', 's@ymail.com', 'Radiographer', 'RSUDJ', 'RSUD Jakarta', 'Jakarta Pusat', '022342', 'Jakarta', 'indonesia', '', 'Rumah sakit meminta penawaran harga FILM Dry.', NULL, '22-11-2019 14:35', '2019-11-22 14:36:01', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (5, 'Irfan', '081818181', 'm@gmail.com', 'Management', 'RSKJN', 'RSUD Kajen', 'Jl. Pekalongan, kajen', '021212121', 'Pekalongan', 'indonesia', '', 'Film DT2B', NULL, NULL, '2019-11-25 13:26:58', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (6, 'Rohman Alhakim', '085858585', 'm@gmail.com', 'Kepala Radiologi', 'RSHSM', 'RS Harum Sisma Medika', 'Jl. Kalimalang N0.97', '021323232', 'Jakarta Timur', 'indonesia', '', 'CR-15x', NULL, NULL, '2019-11-25 13:42:46', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (7, 'arif hidayat', '0882221', 'hidayat@mail.com', 'Radiographer', 'RSJA', 'Rumah Sakit Jakarta ', 'Jl Rawabadak', '0885454', 'Jakarta Timur', 'indonesia', '', 'Meminta Penawaran Harga Modality', NULL, NULL, '2019-11-26 13:06:11', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (8, 'Salman Alfarisy', '088547', 's@yahoo.com', 'Radiographer', 'RSPAD', 'RSPAD Gatot Subroto', 'Jl Senen', '887878', 'Jakarta Pusat', 'indonesia', '', 'Meminta Penawaran Harga', NULL, NULL, '2019-11-26 13:12:35', NULL, 'eggy', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (9, 'Ahsan', '0993838', 'yemail.com', 'Radiographer', 'RSPAD', 'Rumah Sakit Gatot Subroto', 'Jl Senen', '00939398', 'Jl Senen', 'indonesia', '', 'Meminta Penawaran', NULL, NULL, '2019-11-26 13:35:28', NULL, 'iyul', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (10, 'kutamz', '081289580210', 'andika@gmail.com', 'IT Medical', 'RSBT', 'rumah sakit bunda thamrin', 'jl medan', '021-50000', 'medan', 'indonesia', '', 'penawaran CR', NULL, NULL, '2019-11-26 14:50:33', NULL, 'dika', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (11, 'kutamz', '081289580210', 'andika@gmail.com', 'IT Medical', 'RSBT2', 'rumah sakit bunda thamrin', 'jl medan', '021-50000', 'medan', 'malaysia', '', 'penawaran CR', NULL, NULL, '2019-11-26 14:52:29', NULL, 'dika', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (12, 'eggypen', '081289580210', 'e@gmail.com', 'IT', 'RSAM', 'rumah sakit antam medika', 'jl bekasi', '021-50000', 'medan', 'indonesia', '', 'penawaran CT scan', NULL, NULL, '2019-11-26 15:13:14', NULL, 'dika', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (13, 'febrianpatur', '081289580210', 'e@gmail.com', 'IT', 'RSG', 'rumah sakit garut', 'jl medan', '021-50000', 'medan', '', '', 'penawaran MRI', NULL, NULL, '2019-11-26 15:14:46', NULL, 'dika', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (14, 'a', 'a', 'a', 'aa', 'aa', 'aa', 'aa', 'aaa', 'aaa', 'malaysia', '', 'aaa', NULL, NULL, '2019-12-02 13:15:31', NULL, 'pli', NULL, NULL);
INSERT INTO `sales_kunjungan` VALUES (15, 'b', 'bb', 'b', 'bb', 'bbb', 'b', 'b', 'b', 'b', 'indonesia', '', 'b', NULL, NULL, '2019-12-11 08:33:03', NULL, 'pli', NULL, 'b');

-- ----------------------------
-- Table structure for sales_modality
-- ----------------------------
DROP TABLE IF EXISTS `sales_modality`;
CREATE TABLE `sales_modality`  (
  `pk_mod` int(11) NOT NULL,
  `nama_mod` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merk_mod` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `model_mod` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spek_mod` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `harga_mod` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `now_mod` varchar(99) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `stock_mod` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_mod`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_modality
-- ----------------------------
INSERT INTO `sales_modality` VALUES (1, 'CT SCAN', 'AGFAQA', '1019101', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '1000000000', '2019-11-26 13:55:13', '425');
INSERT INTO `sales_modality` VALUES (4, 'Film DT2B', 'AGFA', 'DT2B', 'FILM', '1200000', '2019-11-22 16:21:35', '203');
INSERT INTO `sales_modality` VALUES (5, 'Dry Film', 'CLEAR', 'Dry Film', 'Film Kering', '800000', '2019-11-20 13:58:43', '626');
INSERT INTO `sales_modality` VALUES (6, 'CT-SCAN15', 'AGFA', 'AGFA', 'CT-SCAN', '1000000000', '2019-11-22 14:43:56', '98');

-- ----------------------------
-- Table structure for sales_order
-- ----------------------------
DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE `sales_order`  (
  `pk_order` int(10) NOT NULL AUTO_INCREMENT,
  `fk_penawaran` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pk_mod_order` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_mod_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `model_mod_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merk_mod_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spek_mod_order` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `harga_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cust_fk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `koders_cust` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delete_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tujuan_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_order`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 136 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_order
-- ----------------------------
INSERT INTO `sales_order` VALUES (1, '1', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '650000000', '650000000', '1', NULL, ' 3', NULL, 'ada', 'sales');
INSERT INTO `sales_order` VALUES (2, '1', ' 4', 'Film DT2B', 'DT2B', 'AGFA', 'FILM', '1000000', '10000000', '10', NULL, ' 3', NULL, 'ada', 'sales');
INSERT INTO `sales_order` VALUES (3, '2', ' 5', 'Dry Film', 'Dry Film', 'CLEAR', 'Film Kering', '800000', '80000000', '100', NULL, ' 14', NULL, 'ada', 'sales');
INSERT INTO `sales_order` VALUES (4, '3', ' 5', 'Dry Film', 'Dry Film', 'CLEAR', 'Film Kering', '800000', '800000', '1', NULL, ' 4', NULL, 'ada', 'sales');
INSERT INTO `sales_order` VALUES (5, '4', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '550000000', '550000000', '1', NULL, ' 3', NULL, 'ada', 'sales');

-- ----------------------------
-- Table structure for sales_order2
-- ----------------------------
DROP TABLE IF EXISTS `sales_order2`;
CREATE TABLE `sales_order2`  (
  `pk_order` int(10) NOT NULL AUTO_INCREMENT,
  `fk_funnel2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pk_mod_order` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_mod_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `model_mod_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merk_mod_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spek_mod_order` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `harga_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cust_fk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `koders_cust` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delete_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tujuan_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_order`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 154 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_order2
-- ----------------------------
INSERT INTO `sales_order2` VALUES (1, '1', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '900000000', '900000000', '1', NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_order2` VALUES (2, '1', ' 5', 'Dry Film', 'Dry Film', 'CLEAR', 'Film Kering', '700000', '7700000', '11', NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_order2` VALUES (3, '2', ' 5', 'Dry Film', 'Dry Film', 'CLEAR', 'Film Kering', '800000', '8800000', '11', NULL, NULL, NULL, NULL, 'distributor');
INSERT INTO `sales_order2` VALUES (4, '2', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '650000000', '650000000', '1', NULL, NULL, NULL, NULL, 'distributor');

-- ----------------------------
-- Table structure for sales_order3
-- ----------------------------
DROP TABLE IF EXISTS `sales_order3`;
CREATE TABLE `sales_order3`  (
  `pk_order` int(10) NOT NULL AUTO_INCREMENT,
  `fk_funnel3` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pk_mod_order` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_mod_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `model_mod_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `merk_mod_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spek_mod_order` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `harga_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cust_fk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `koders_cust` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delete_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tujuan_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_order`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 142 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_order3
-- ----------------------------
INSERT INTO `sales_order3` VALUES (1, '84', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '500000000', '500000000', '1', NULL, ' 23', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (2, '84', ' 5', 'Dry Film', 'Dry Film', 'CLEAR', 'Film Kering', '700000', '8400000', '12', NULL, ' 23', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (3, '87', ' 4', 'Film DT2B', 'DT2B', 'AGFA', 'FILM', '1000000000', '1000000000', '1', NULL, ' 20', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (4, '88', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '850000000', '850000000', '1', NULL, ' 24', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (5, '88', ' 5', 'Dry Film', 'Dry Film', 'CLEAR', 'Film Kering', '500000', '2500000', '5', NULL, ' 24', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (6, '89', ' 4', 'Film DT2B', 'DT2B', 'AGFA', 'FILM', '1000000', '12000000', '12', NULL, ' 26', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (7, '92', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '500000000', '500000000', '1', NULL, ' 20', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (8, '93', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '550000000', '550000000', '1', NULL, ' 20', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (9, '94', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '500000000', '500000000', '1', NULL, ' 24', NULL, 'ada', 'distributor');
INSERT INTO `sales_order3` VALUES (10, '95', ' 1', 'CT SCAN', '1019101', 'AGFAQA', 'CT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nXT\r\nXT\r\nXR\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT\r\nCT', '500000000', '500000000', '1', NULL, ' 20', NULL, 'ada', 'distributor');

-- ----------------------------
-- Table structure for sales_penawaran
-- ----------------------------
DROP TABLE IF EXISTS `sales_penawaran`;
CREATE TABLE `sales_penawaran`  (
  `pk_penawaran` int(11) NOT NULL,
  `no_penawaran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pk_cust_penawaran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_penawaran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat_penawaran` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `kota_penawaran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_cust_penawaran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `month` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `budget_penawaran` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_penawaran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approve` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `referensi_penawaran` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_upload` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delete_penawaran` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_penawaran`) USING BTREE,
  UNIQUE INDEX `no_penawaran`(`no_penawaran`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_penawaran
-- ----------------------------
INSERT INTO `sales_penawaran` VALUES (1, 'Q-0000/IPI//pli/XII/2019', ' 3', 'Rumah Sakit Pasar Rebo', 'Jl. Raya Bogor No.30', 'DKI Jakarta', 'Kunto', NULL, 'APBN', '2019-12-13 10:54:15', '30%', NULL, 'approved', 'pli', 'E-Catalogue', NULL, 'ada');
INSERT INTO `sales_penawaran` VALUES (2, 'Q-0001/IPI//pli/XII/2019', ' 14', 'Rumah Sakit Jakarta ', 'Jl Rawabadak', 'Jakarta Timur', 'arif hidayat', NULL, 'APBD', '2019-12-13 13:22:03', '30%', NULL, 'approved', 'pli', 'E-Catalogue', NULL, 'ada');
INSERT INTO `sales_penawaran` VALUES (3, 'Q-0002/IPI//pli/XII/2019', ' 4', 'RSUD Jakarta', 'Jakarta Pusat', 'Jakarta', 'Sarah', NULL, 'APBN', '2019-12-13 16:16:32', '30%', NULL, 'rejected', 'pli', 'E-Catalogue', NULL, 'ada');
INSERT INTO `sales_penawaran` VALUES (4, 'Q-0003/IPI//pli/XII/2019', ' 3', 'Rumah Sakit Pasar Rebo', 'Jl. Raya Bogor No.30', 'DKI Jakarta', 'Kunto', NULL, 'APBN', '2019-12-13 16:17:26', '30%', NULL, 'approved', 'pli', 'E-Catalogue', NULL, 'ada');

-- ----------------------------
-- Table structure for sales_targeting
-- ----------------------------
DROP TABLE IF EXISTS `sales_targeting`;
CREATE TABLE `sales_targeting`  (
  `pk` int(10) NOT NULL,
  `funnel_fk` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_targeting` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kota_targeting` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_targeting` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `harga_po_targeting` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `approve` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pengiriman` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sales_targeting
-- ----------------------------
INSERT INTO `sales_targeting` VALUES (1, '84', 'Rumah Sakit Haji Surabaya', '78787', NULL, '508400000', NULL, 'opal', 'approved', 'terkirim');
INSERT INTO `sales_targeting` VALUES (2, '85', 'Rumah Sakit Pasar Rebo', 'DKI Jakarta', 'Q-0000/IPI//pli/XII/2019', '660000000', NULL, 'pli', 'approved', 'terkirim');
INSERT INTO `sales_targeting` VALUES (3, '86', 'Rumah Sakit Jakarta ', 'Jakarta Timur', 'Q-0001/IPI//pli/XII/2019', '80000000', NULL, 'pli', 'approved', 'terkirim');
INSERT INTO `sales_targeting` VALUES (4, '87', 'Rumah Sakit 128', 'Jakarta', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (5, '87', 'Rumah Sakit 128', 'Jakarta', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (6, '88', 'Rumah Sakit Harapan', 'Tanggerang', NULL, '852500000', NULL, 'opal', 'approved', 'terkirim');
INSERT INTO `sales_targeting` VALUES (7, '91', 'Rumah Sakit Pasar Rebo', 'DKI Jakarta', 'Q-0003/IPI//pli/XII/2019', '550000000', NULL, 'pli', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (8, '89', 'RS BANDUNG', '', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (9, '87', 'Rumah Sakit 128', 'Jakarta', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (10, '89', 'RS BANDUNG', '', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (11, '92', 'Rumah Sakit 128', 'Jakarta', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (12, '94', 'Rumah Sakit Harapan', 'Tanggerang', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (13, '93', 'Rumah Sakit 128', 'Jakarta', '', '', NULL, 'opal', 'rejected', NULL);
INSERT INTO `sales_targeting` VALUES (14, '95', '', '', NULL, '500000000', NULL, 'opal', 'rejected', NULL);

SET FOREIGN_KEY_CHECKS = 1;
