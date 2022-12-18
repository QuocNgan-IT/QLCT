-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 18, 2022 lúc 04:28 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlychitieu`
--
CREATE DATABASE IF NOT EXISTS `quanlychitieu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quanlychitieu`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoan_chi_chinh`
--

CREATE TABLE `khoan_chi_chinh` (
  `ma_kcc` int(11) NOT NULL,
  `ten_kcc` varchar(50) NOT NULL,
  `mo_ta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khoan_chi_chinh`
--

INSERT INTO `khoan_chi_chinh` (`ma_kcc`, `ten_kcc`, `mo_ta`) VALUES
(1, 'Khoản chi thiết yếu', 'Bao gồm những khoản chi tiêu cần thiết như tiền thuê nhà, nhu yếu phẩm, các tiện ích, bảo hiểm y tế, lãi suất ngân hàng...'),
(2, 'Khoản chi linh hoạt', 'Bao gồm bất kỳ thứ gì không được coi là chi phí thiết yếu, như việc đi du lịch, ăn uống nhà hàng, mua sắm và vui chơi...'),
(3, 'Khoản tiết kiệm, đầu tư', 'Đây có thể là quỹ khẩn cấp, quỹ tiết kiệm hưu trí hoặc các khoản đầu tư khác, ví dụ chứng khoán...');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoan_chi_tieu`
--

CREATE TABLE `khoan_chi_tieu` (
  `ma_kct` int(11) NOT NULL,
  `ma_kcc` int(11) NOT NULL,
  `ma_nd` int(11) NOT NULL,
  `ten_kct` varchar(50) NOT NULL,
  `so_tien` int(11) NOT NULL,
  `mo_ta` text NOT NULL,
  `ngay_chi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khoan_chi_tieu`
--

INSERT INTO `khoan_chi_tieu` (`ma_kct`, `ma_kcc`, `ma_nd`, `ten_kct`, `so_tien`, `mo_ta`, `ngay_chi`) VALUES
(88, 1, 20, 'Tiền KTX', 600000, '', '2022-11-04 07:44:39'),
(90, 2, 20, 'Đốt tiền', 300000, '', '2022-10-14 09:19:42'),
(91, 2, 20, 'Test', 1000000, '', '2022-10-22 12:53:52'),
(92, 3, 20, 'Cổ phiếu', 1000000, 'Đốt tiền', '2022-10-22 13:48:54'),
(93, 3, 20, 'Góp quỹ khẩn cấp', 1000000, '', '2022-10-22 13:49:53'),
(94, 2, 20, 'Đốt tiền', 200000, '', '2022-11-02 15:19:29'),
(95, 3, 20, 'Test', 600000, '', '2022-11-09 15:34:20'),
(97, 3, 20, 'Mua vé số', 10000, '', '2022-11-05 02:42:08'),
(98, 1, 20, 'Test', 1000000, '456442', '2022-11-24 03:35:02'),
(105, 1, 20, 'Test', 1000000, '', '2022-11-02 03:12:09'),
(108, 1, 20, 'test', 600000, '', '2022-11-12 16:59:22'),
(109, 1, 20, 'Đốt tiền', 1000, 'Đốt tiền', '2022-11-23 16:17:20'),
(110, 1, 20, 'Đốt tiền', 5000000, 'Thử một lần làm Công tử Bạc Liêu, đốt tiền nấu trứng', '2022-11-29 22:44:15'),
(112, 1, 20, 'test', 1000, '', '2022-11-23 16:32:05'),
(113, 1, 20, 'test', 1000, '', '2022-11-23 16:32:34'),
(116, 1, 20, 'test', 500000, '', '2022-11-23 17:26:26'),
(121, 1, 20, 'Đốt tiền', 600000, '', '2022-11-23 18:47:11'),
(123, 2, 20, 'Mua điện thoại', 4500000, '', '2022-11-29 22:44:57'),
(132, 1, 20, 'Tiền KTX', 600000, 'Tiền ở KTX', '2022-12-01 18:01:38'),
(134, 3, 20, 'Tiền mua vé số', 20000, 'Ủng hộ cô bán vé số thui', '2022-12-01 18:04:02'),
(135, 1, 20, 'Tiền nhu yếu phẩm đầu tháng', 500000, 'Tiền mua bột giặt, nước xã, dầu gội, nước rửa chén,...', '2022-12-01 18:08:35'),
(137, 2, 20, 'Tiền ủng hộ World Cup', 2000000, 'Đặt cược tý cho mùa World Cup thêm sôi động :))', '2022-12-01 18:12:05'),
(138, 1, 20, 'Trả nợ', 2000000, 'Này thì sôi nổi...', '2022-12-02 18:12:56'),
(139, 3, 20, 'Mua vé số', 100000, 'Nay cô bán vé số dẫn theo mấy đứa con nữa :V', '2022-12-03 18:15:57'),
(140, 1, 20, 'Tiền Wifi', 270000, '', '2022-12-03 18:20:12'),
(141, 1, 20, 'Tiền BHYT', 500000, '', '2022-12-08 18:21:16'),
(143, 2, 20, 'In 3 quyển luận văn', 200000, '', '2022-12-08 09:40:23'),
(144, 2, 20, 'Test 1', 1000, '1', '2022-12-10 15:20:03'),
(145, 2, 20, 'Test 2', 2000, '2', '2022-12-10 15:20:13'),
(146, 2, 20, 'Test 3', 3000, '3', '2022-12-10 15:20:23'),
(147, 2, 20, 'Test 4', 4000, '4', '2022-12-10 15:20:31'),
(148, 2, 20, 'Test 5', 5000, '5', '2022-12-10 15:20:42'),
(149, 2, 20, 'Test 6', 6000, '6', '2022-12-10 15:20:49'),
(150, 2, 20, 'Test 7', 7000, '7', '2022-12-10 15:20:57'),
(151, 2, 20, 'Test 8', 8000, '8', '2022-12-10 15:21:06'),
(152, 2, 20, 'Test 9', 9000, '9', '2022-12-10 15:21:14'),
(161, 2, 20, 'Test 10', 10000, '', '2022-12-10 17:47:30'),
(162, 1, 20, 'test', 1000, '', '2022-12-10 17:48:06'),
(168, 2, 20, 'Test', 12000, 'mô tả', '2022-12-12 16:20:48'),
(169, 2, 20, 'Test', 3000000, '', '2022-12-12 16:22:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_hd`
--

CREATE TABLE `lich_su_hd` (
  `ma_lich_su_hd` int(11) NOT NULL,
  `ma_nd` int(11) NOT NULL,
  `ten_hd` varchar(50) NOT NULL,
  `noi_dung_cu` text NOT NULL,
  `noi_dung_moi` text NOT NULL,
  `ngay` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `lich_su_hd`
--

INSERT INTO `lich_su_hd` (`ma_lich_su_hd`, `ma_nd`, `ten_hd`, `noi_dung_cu`, `noi_dung_moi`, `ngay`) VALUES
(142, 20, 'Thêm khoản chi tiêu', '', 'Tiền KTX<br>Khoản chi thiết yếu<br>600 000 đ<br>Tiền ở KTX', '2022-12-01 18:01:38'),
(144, 20, 'Thêm khoản chi tiêu', '', 'Tiền mua vé số<br>Khoản tiết kiệm, đầu tư<br>20 000 000 đ<br>Ủng hộ cô bán vé số thui', '2022-12-01 18:04:02'),
(145, 20, 'Sửa khoản chi tiêu', 'Tiền mua vé số<br>Khoản tiết kiệm, đầu tư<br>20 000 000 đ<br>Ủng hộ cô bán vé số t...<br>2022-12-01 18:04:02', 'Tiền mua vé số<br>Khoản tiết kiệm, đầu tư<br>20 000 đ<br>Ủng hộ cô bán vé số t...<br>2022-12-01 18:04:02', '2022-12-01 18:07:48'),
(146, 20, 'Thêm khoản chi tiêu', '', 'Tiền nhu yếu phẩm đầu tháng<br>Khoản chi thiết yếu<br>500 000 đ<br>Tiền mua bột giặt, nư??...', '2022-12-01 18:08:35'),
(147, 20, 'Thêm khoản chi tiêu', '', 'Tiền ủng hộ World Cup<br>Khoản chi thiết yếu<br>2 000 000 đ<br>Đặt cược tý cho mùa Wo...', '2022-12-01 18:10:40'),
(148, 20, 'Xóa khoản chi tiêu', '', 'Tiền ủng hộ World Cup<br>Khoản chi thiết yếu<br>2 000 000 đ<br>Đặt cược tý cho mùa Wo...<br>2022-12-01 18:10:40', '2022-12-01 18:11:25'),
(149, 20, 'Thêm khoản chi tiêu', '', 'Tiền ủng hộ World Cup<br>Khoản chi linh hoạt<br>2 000 000 đ<br>Đặt cược tý cho mùa Wo...', '2022-12-01 18:12:05'),
(150, 20, 'Thêm khoản chi tiêu', '', 'Trả nợ<br>Khoản chi thiết yếu<br>2 000 000 đ<br>Này thì sôi nổi...', '2022-12-01 18:12:56'),
(151, 20, 'Thêm khoản chi tiêu', '', 'Mua vé số<br>Khoản tiết kiệm, đầu tư<br>100 000 đ<br>Nay cô bán vé số dẫn th...', '2022-12-01 18:15:57'),
(152, 20, 'Thêm khoản chi tiêu', '', 'Tiền Wifi<br>Khoản chi thiết yếu<br>270 000 đ<br>', '2022-12-01 18:20:12'),
(153, 20, 'Thêm khoản chi tiêu', '', 'Tiền BHYT<br>Khoản chi thiết yếu<br>500 000 đ<br>', '2022-12-01 18:21:16'),
(154, 20, 'Điều chỉnh tỷ lệ các khoản chi', '4 700 000 đ (47 %)<br>2 400 000 đ (24 %)<br>2 900 000 đ(29 %)', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '2022-12-02 00:37:35'),
(155, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>2 000 000 đ<br>', '2022-12-06 01:00:46'),
(156, 20, 'Sửa khoản chi tiêu', 'Trả nợ<br>Khoản chi thiết yếu<br>2 000 000 đ<br>Này thì sôi nổi...<br>2022-12-02 18:12:56', 'Trả nợ<br>Khoản chi thiết yếu<br>20 000 000 đ<br>Này thì sôi nổi...<br>2022-12-02 18:12:56', '2022-12-06 01:05:40'),
(157, 20, 'Sửa khoản chi tiêu', 'Trả nợ<br>Khoản chi thiết yếu<br>20 000 000 đ<br>Này thì sôi nổi...<br>2022-12-02 18:12:56', 'Trả nợ<br>Khoản chi thiết yếu<br>2 000 000 đ<br>Này thì sôi nổi...<br>2022-12-02 18:12:56', '2022-12-06 01:19:21'),
(158, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>2 000 000 đ<br><br>2022-12-06 01:00:46', '2022-12-06 01:19:33'),
(159, 20, 'Thêm khoản chi tiêu', '', 'In 3 quyển luận văn<br>Khoản chi linh hoạt<br>200 000 đ<br>', '2022-12-08 09:40:23'),
(161, 20, 'Thêm khoản chi tiêu', '', 'Test 1<br>Khoản chi linh hoạt<br>1 000 đ<br>1', '2022-12-10 15:20:03'),
(162, 20, 'Thêm khoản chi tiêu', '', 'Test 2<br>Khoản chi linh hoạt<br>2 000 đ<br>2', '2022-12-10 15:20:13'),
(163, 20, 'Thêm khoản chi tiêu', '', 'Test 3<br>Khoản chi linh hoạt<br>3 000 đ<br>3', '2022-12-10 15:20:23'),
(164, 20, 'Thêm khoản chi tiêu', '', 'Test 4<br>Khoản chi linh hoạt<br>4 000 đ<br>4', '2022-12-10 15:20:31'),
(165, 20, 'Thêm khoản chi tiêu', '', 'Test 5<br>Khoản chi linh hoạt<br>5 000 đ<br>5', '2022-12-10 15:20:42'),
(166, 20, 'Thêm khoản chi tiêu', '', 'Test 6<br>Khoản chi linh hoạt<br>6 000 đ<br>6', '2022-12-10 15:20:49'),
(167, 20, 'Thêm khoản chi tiêu', '', 'Test 7<br>Khoản chi linh hoạt<br>7 000 đ<br>7', '2022-12-10 15:20:57'),
(168, 20, 'Thêm khoản chi tiêu', '', 'Test 8<br>Khoản chi linh hoạt<br>8 000 đ<br>8', '2022-12-10 15:21:06'),
(169, 20, 'Thêm khoản chi tiêu', '', 'Test 9<br>Khoản chi linh hoạt<br>9 000 đ<br>9', '2022-12-10 15:21:14'),
(170, 20, 'Thêm khoản chi tiêu', '', 'Đốt tiền<br>Khoản chi linh hoạt<br>600 000 đ<br>', '2022-12-10 17:28:43'),
(171, 20, 'Xóa khoản chi tiêu', '', 'Đốt tiền<br>Khoản chi linh hoạt<br>600 000 đ<br><br>2022-12-10 17:28:43', '2022-12-10 17:29:55'),
(172, 20, 'Thêm khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br>', '2022-12-10 17:32:25'),
(173, 20, 'Điều chỉnh tỷ lệ các khoản chi', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '2022-12-10 17:35:01'),
(174, 20, 'Thêm khoản chi tiêu', '', 't<br>Khoản chi thiết yếu<br>1 000 đ<br>', '2022-12-10 17:35:12'),
(175, 20, 'Xóa khoản chi tiêu', '', 't<br>Khoản chi thiết yếu<br>1 000 đ<br><br>2022-12-10 17:35:12', '2022-12-10 17:35:41'),
(176, 20, 'Thêm khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br>', '2022-12-10 17:37:38'),
(177, 20, 'Thêm khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br>', '2022-12-10 17:37:51'),
(178, 20, 'Xóa khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br><br>2022-12-10 17:37:51', '2022-12-10 17:38:10'),
(179, 20, 'Xóa khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br><br>2022-12-10 17:37:38', '2022-12-10 17:38:13'),
(180, 20, 'Xóa khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br><br>2022-12-10 17:32:25', '2022-12-10 17:38:16'),
(181, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>1 000 đ<br>', '2022-12-10 17:42:20'),
(182, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>1 000 000 đ<br>', '2022-12-10 17:43:19'),
(183, 20, 'Điều chỉnh tỷ lệ các khoản chi', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '4 000 000 đ (40 %)<br>3 300 000 đ (33 %)<br>2 700 000 đ(27 %)', '2022-12-10 17:44:08'),
(184, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>10 000 000 đ<br>', '2022-12-10 17:44:34'),
(185, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>10 000 000 đ<br><br>2022-12-10 17:44:34', '2022-12-10 17:46:24'),
(186, 20, 'Điều chỉnh tỷ lệ các khoản chi', '4 000 000 đ (40 %)<br>3 300 000 đ (33 %)<br>2 700 000 đ(27 %)', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '2022-12-10 17:46:34'),
(187, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>1 000 000 đ<br><br>2022-12-10 17:43:19', '2022-12-10 17:47:14'),
(188, 20, 'Thêm khoản chi tiêu', '', 'Test 10<br>Khoản chi linh hoạt<br>10 000 đ<br>', '2022-12-10 17:47:30'),
(189, 20, 'Thêm khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br>', '2022-12-10 17:48:06'),
(190, 20, 'Thêm khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br>', '2022-12-10 17:48:22'),
(191, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>1 000 đ<br><br>2022-12-10 17:42:20', '2022-12-10 17:48:56'),
(192, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>600 000 đ<br>', '2022-12-10 17:57:11'),
(193, 20, 'Sửa khoản chi tiêu', 'Test<br>Khoản chi linh hoạt<br>600 000 đ<br><br>2022-12-10 17:57:11', 'Test<br>Khoản chi linh hoạt<br>600 000 đ<br>Sửa<br>2022-12-10 17:58:38', '2022-12-10 17:58:38'),
(194, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>600 000 đ<br>Sửa<br>2022-12-10 17:58:38', '2022-12-10 17:58:54'),
(195, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>2 000 000 đ<br>vượt ngân sách', '2022-12-10 18:02:26'),
(196, 20, 'Điều chỉnh tỷ lệ các khoản chi', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '6 000 000 đ (60 %)<br>2 400 000 đ (24 %)<br>1 600 000 đ(16 %)', '2022-12-10 18:03:09'),
(197, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>5 000 000 đ<br>Vượt thu nhập', '2022-12-10 18:03:48'),
(198, 20, 'Thay đổi thông tin người dùng', 'Huỳnh Quốc Ngạn<br>Nam<br>10 000 000 đ', 'Huỳnh Quốc Ngạn<br>Nam<br>15 000 000 đ', '2022-12-10 18:05:16'),
(199, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>5 000 000 đ<br>Vượt thu nhập<br>2022-12-10 18:03:48', '2022-12-10 18:07:04'),
(200, 20, 'Thay đổi thông tin người dùng', 'Huỳnh Quốc Ngạn<br>Nam<br>15 000 000 đ', 'Huỳnh Quốc Ngạn<br>Nam<br>10 000 000 đ', '2022-12-12 08:33:44'),
(201, 20, 'Điều chỉnh tỷ lệ các khoản chi', '6 000 000 đ (60 %)<br>2 400 000 đ (24 %)<br>1 600 000 đ(16 %)', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '2022-12-12 14:17:37'),
(202, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>2 000 000 đ<br>vượt ngân sách<br>2022-12-10 18:02:26', '2022-12-12 14:17:41'),
(203, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>2 000 000 đ<br>', '2022-12-12 14:27:31'),
(204, 20, 'Xóa khoản chi tiêu', '', 'Test<br>Khoản chi thiết yếu<br>2 000 000 đ<br><br>2022-12-12 14:27:31', '2022-12-12 14:28:13'),
(205, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>12 000 đ<br>mô tả', '2022-12-12 16:20:48'),
(206, 20, 'Xóa khoản chi tiêu', '', 'test<br>Khoản chi thiết yếu<br>1 000 đ<br><br>2022-12-10 17:48:22', '2022-12-12 16:21:46'),
(207, 20, 'Thêm khoản chi tiêu', '', 'Test<br>Khoản chi linh hoạt<br>5 000 000 đ<br>', '2022-12-12 16:22:46'),
(208, 20, 'Sửa khoản chi tiêu', 'Test<br>Khoản chi linh hoạt<br>5 000 000 đ<br><br>2022-12-12 16:22:46', 'Test<br>Khoản chi linh hoạt<br>3 000 000 đ<br><br>2022-12-12 16:22:46', '2022-12-12 16:23:39'),
(209, 20, 'Điều chỉnh tỷ lệ các khoản chi', '5 000 000 đ (50 %)<br>3 000 000 đ (30 %)<br>2 000 000 đ(20 %)', '4 000 000 đ (40 %)<br>5 400 000 đ (54 %)<br>600 000 đ(6 %)', '2022-12-12 16:23:48'),
(210, 20, 'Thay đổi thông tin người dùng', 'Huỳnh Quốc Ngạn<br>Nam<br>10 000 000 đ', 'Huỳnh Quốc Ngạn<br>Nam<br>15 000 000 đ', '2022-12-12 16:24:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `ma_nd` int(11) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `gioi_tinh` char(4) NOT NULL,
  `nam_sinh` year(4) NOT NULL,
  `thu_nhap` int(11) NOT NULL,
  `tai_khoan` varchar(20) NOT NULL,
  `mat_khau` varchar(32) NOT NULL,
  `ty_le_TY` int(3) NOT NULL,
  `ty_le_LH` int(3) NOT NULL,
  `ty_le_TKDT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`ma_nd`, `ho_ten`, `gioi_tinh`, `nam_sinh`, `thu_nhap`, `tai_khoan`, `mat_khau`, `ty_le_TY`, `ty_le_LH`, `ty_le_TKDT`) VALUES
(20, 'Huỳnh Quốc Ngạn', 'Nam', 2000, 15000000, 'demo', '202cb962ac59075b964b07152d234b70', 0, 0, 0),
(21, 'Huỳnh Quốc Ngạn', 'Nam', 2000, 15000000, 'test', '202cb962ac59075b964b07152d234b70', 0, 0, 0),
(22, 'Huỳnh Quốc Ngạn', 'Nam', 2000, 5000000, 'admin', '202cb962ac59075b964b07152d234b70', 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `noi_dung_tb`
--

CREATE TABLE `noi_dung_tb` (
  `ma_ndtb` int(11) NOT NULL,
  `ten_tb` varchar(50) NOT NULL,
  `noi_dung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `noi_dung_tb`
--

INSERT INTO `noi_dung_tb` (`ma_ndtb`, `ten_tb`, `noi_dung`) VALUES
(1, 'Vượt ngân sách', 'Vượt ngân sách <b>Khoản chi thiết yếu</b>'),
(2, 'Vượt ngân sách', 'Vượt ngân sách <b>Khoản chi linh hoạt</b>'),
(3, 'Vượt ngân sách', 'Vượt ngân sách <b>Khoản tiết kiệm, đầu tư</b>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_bao`
--

CREATE TABLE `thong_bao` (
  `ma_tb` int(11) NOT NULL,
  `ma_nd` int(11) NOT NULL,
  `ma_ndtb` int(11) NOT NULL,
  `ngay_tb` datetime NOT NULL DEFAULT current_timestamp(),
  `trang_thai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thong_bao`
--

INSERT INTO `thong_bao` (`ma_tb`, `ma_nd`, `ma_ndtb`, `ngay_tb`, `trang_thai`) VALUES
(31, 20, 2, '2022-12-12 16:24:07', 0),
(33, 20, 3, '2022-12-12 16:24:07', 0),
(48, 20, 1, '2022-12-12 16:24:07', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ty_le_kcc`
--

CREATE TABLE `ty_le_kcc` (
  `ma_ty_le` int(11) NOT NULL,
  `ma_nd` int(11) NOT NULL,
  `ma_kcc` int(11) NOT NULL,
  `ty_le` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ty_le_kcc`
--

INSERT INTO `ty_le_kcc` (`ma_ty_le`, `ma_nd`, `ma_kcc`, `ty_le`) VALUES
(4, 20, 1, 40),
(5, 20, 2, 54),
(6, 20, 3, 6),
(7, 21, 1, 50),
(8, 21, 2, 30),
(9, 21, 3, 20),
(10, 22, 1, 50),
(11, 22, 2, 30),
(12, 22, 3, 20);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `khoan_chi_chinh`
--
ALTER TABLE `khoan_chi_chinh`
  ADD PRIMARY KEY (`ma_kcc`);

--
-- Chỉ mục cho bảng `khoan_chi_tieu`
--
ALTER TABLE `khoan_chi_tieu`
  ADD PRIMARY KEY (`ma_kct`),
  ADD KEY `ma_nd` (`ma_nd`),
  ADD KEY `ma_kcc` (`ma_kcc`);

--
-- Chỉ mục cho bảng `lich_su_hd`
--
ALTER TABLE `lich_su_hd`
  ADD PRIMARY KEY (`ma_lich_su_hd`),
  ADD KEY `ma_nd` (`ma_nd`);

--
-- Chỉ mục cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`ma_nd`);

--
-- Chỉ mục cho bảng `noi_dung_tb`
--
ALTER TABLE `noi_dung_tb`
  ADD PRIMARY KEY (`ma_ndtb`);

--
-- Chỉ mục cho bảng `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD PRIMARY KEY (`ma_tb`),
  ADD KEY `ma_nd` (`ma_nd`),
  ADD KEY `ma_ndtb` (`ma_ndtb`);

--
-- Chỉ mục cho bảng `ty_le_kcc`
--
ALTER TABLE `ty_le_kcc`
  ADD PRIMARY KEY (`ma_ty_le`),
  ADD KEY `ma_nd` (`ma_nd`),
  ADD KEY `ma_kcc` (`ma_kcc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khoan_chi_chinh`
--
ALTER TABLE `khoan_chi_chinh`
  MODIFY `ma_kcc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khoan_chi_tieu`
--
ALTER TABLE `khoan_chi_tieu`
  MODIFY `ma_kct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT cho bảng `lich_su_hd`
--
ALTER TABLE `lich_su_hd`
  MODIFY `ma_lich_su_hd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `ma_nd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `noi_dung_tb`
--
ALTER TABLE `noi_dung_tb`
  MODIFY `ma_ndtb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thong_bao`
--
ALTER TABLE `thong_bao`
  MODIFY `ma_tb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `ty_le_kcc`
--
ALTER TABLE `ty_le_kcc`
  MODIFY `ma_ty_le` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `khoan_chi_tieu`
--
ALTER TABLE `khoan_chi_tieu`
  ADD CONSTRAINT `khoan_chi_tieu_ibfk_1` FOREIGN KEY (`ma_nd`) REFERENCES `nguoi_dung` (`ma_nd`),
  ADD CONSTRAINT `khoan_chi_tieu_ibfk_2` FOREIGN KEY (`ma_kcc`) REFERENCES `khoan_chi_chinh` (`ma_kcc`);

--
-- Các ràng buộc cho bảng `lich_su_hd`
--
ALTER TABLE `lich_su_hd`
  ADD CONSTRAINT `lich_su_hd_ibfk_1` FOREIGN KEY (`ma_nd`) REFERENCES `nguoi_dung` (`ma_nd`);

--
-- Các ràng buộc cho bảng `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD CONSTRAINT `thong_bao_ibfk_1` FOREIGN KEY (`ma_nd`) REFERENCES `nguoi_dung` (`ma_nd`),
  ADD CONSTRAINT `thong_bao_ibfk_2` FOREIGN KEY (`ma_ndtb`) REFERENCES `noi_dung_tb` (`ma_ndtb`);

--
-- Các ràng buộc cho bảng `ty_le_kcc`
--
ALTER TABLE `ty_le_kcc`
  ADD CONSTRAINT `ty_le_kcc_ibfk_1` FOREIGN KEY (`ma_nd`) REFERENCES `nguoi_dung` (`ma_nd`),
  ADD CONSTRAINT `ty_le_kcc_ibfk_2` FOREIGN KEY (`ma_kcc`) REFERENCES `khoan_chi_chinh` (`ma_kcc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
