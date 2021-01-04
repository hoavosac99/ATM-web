-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 06, 2020 lúc 04:01 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laptrinhatm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenkhoan`
--

CREATE TABLE `chuyenkhoan` (
  `id_giaodich` int(20) NOT NULL,
  `id_gui` int(20) NOT NULL,
  `id_nhan` int(20) NOT NULL,
  `sotien` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyenkhoan`
--

INSERT INTO `chuyenkhoan` (`id_giaodich`, `id_gui`, `id_nhan`, `sotien`) VALUES
(1, 3888, 3889, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ruttien`
--

CREATE TABLE `ruttien` (
  `id_giaodich` int(20) NOT NULL,
  `id_user` int(20) NOT NULL,
  `sotien` int(20) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ruttien`
--

INSERT INTO `ruttien` (`id_giaodich`, `id_user`, `sotien`, `time`) VALUES
(1, 3888, 200000, '2020-07-06 08:45:28'),
(2, 3888, 100000, '2020-07-06 08:49:49'),
(3, 3888, 100000, '2020-07-06 08:51:07'),
(4, 3888, 100000, '2020-07-06 08:51:26'),
(5, 3888, 200000, '2020-07-06 08:52:52'),
(6, 3888, 200000, '2020-07-06 08:52:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` int(6) NOT NULL,
  `sodu` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `pin`, `sodu`) VALUES
(3888, 'Nguyễn Văn Phú', 555555, 1749930),
(3889, 'Nguyễn Văn Phêu', 123456, 100000040);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chuyenkhoan`
--
ALTER TABLE `chuyenkhoan`
  ADD PRIMARY KEY (`id_giaodich`),
  ADD KEY `id_gui` (`id_gui`),
  ADD KEY `id_nhan` (`id_nhan`);

--
-- Chỉ mục cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  ADD PRIMARY KEY (`id_giaodich`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chuyenkhoan`
--
ALTER TABLE `chuyenkhoan`
  MODIFY `id_giaodich` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  MODIFY `id_giaodich` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chuyenkhoan`
--
ALTER TABLE `chuyenkhoan`
  ADD CONSTRAINT `chuyenkhoan_ibfk_1` FOREIGN KEY (`id_gui`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `chuyenkhoan_ibfk_2` FOREIGN KEY (`id_nhan`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  ADD CONSTRAINT `ruttien_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
