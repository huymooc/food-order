-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 07:42 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food-order`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `email`, `password`) VALUES
(22, 'Lê Anh Huy', 'anhhuy03', 'anhhuy482k3@gmail.com', 'anhhuy04082003'),
(23, 'Lê Anh Huy', 'admin', 'anhhuy482003@gmail.com', 'anhhuy2003'),
(24, 'Lê Tuấn Anh', 'tuananh', 'tuananh861999@gmail.com', 'anhhuy2003');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Pizza', 'Food_Category_557.jpg', 'Yes', 'Yes'),
(5, 'Burger', 'Food_Category_23.jpg', 'Yes', 'Yes'),
(12, 'SandWich', 'Food_Category_222.jpg', 'Yes', 'Yes'),
(15, 'Mì Ý', 'Food_Category_507.jpg', 'Yes', 'Yes'),
(16, 'Gà', 'Food_Category_415.jpg', 'Yes', 'Yes'),
(17, 'Bánh Ngọt', 'Food_Category_773.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sdt` int(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `sdt`, `message`) VALUES
(6, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'đồ ăn ngon !!!!'),
(7, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'ngon đấy chứ'),
(8, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'ngon đấy chứ'),
(9, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'ngon đấy chứ'),
(10, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'tôi muốn hợp tác với b'),
(11, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'tôi muốn hợp tác với b'),
(12, 'Lê Anh Huy', 'anhhuy482003@gmail.com', 369241673, 'b hãy sửa địa chỉ giao hàng hộ tôi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(18, 'vagitable sandwich', 'vagitables with sandwich', '20000.00', 'Food-Name-5843.jpg', 12, 'Yes', 'Yes'),
(19, 'sandwich chocolate', 'chokolate with sandwich', '30000.00', 'Food-Name-4954.jpg', 12, 'No', 'Yes'),
(20, 'margherita pizza', 'very testy and famous pizza', '80000.00', 'Food-Name-5771.jpg', 4, 'Yes', 'Yes'),
(21, 'simple pizza', 'average pizza', '95000.00', 'Food-Name-1564.jpg', 4, 'No', 'Yes'),
(22, 'simple burger', 'avarage burger', '30000.00', 'Food-Name-2660.jpg', 5, 'No', 'Yes'),
(23, 'special burger', 'very testy burger', '40000.00', 'Food-Name-9815.jpg', 5, 'Yes', 'Yes'),
(25, 'Mỳ ý xốt cay', 'Ngon bổ béo', '80000.00', 'Food-Name-5982.jpg', 15, 'Yes', 'Yes'),
(26, 'gà viên phô mai', 'Ngon béo, ngậy', '49998.00', 'Food-Name-9460.png', 16, 'Yes', 'Yes'),
(27, 'bánh cuộn socola', 'Thơm ngon, ngậy vị socola', '50000.00', 'Food-Name-5574.jpg', 17, 'Yes', 'Yes'),
(28, 'bánh socola đút lò', 'Socola ngon sánh mịn', '35000.00', 'Food-Name-6679.jpg', 17, 'Yes', 'Yes'),
(29, 'mỳ ý hải sản', 'Hải sản tươi ngon, đi kèm với xốt Pesto', '50000.00', 'Food-Name-2337.jpg', 15, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `status`, `username`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(6, 'margherita pizza', '80000.00', 1, '80000.00', 'Đã Giao', '', 'Lê Anh Huy', '0369241673', 'anhhuy482003@gmail.com', 'QL47'),
(7, 'special burger', '40000.00', 10, '400000.00', 'Đã Giao', '', 'Lê Thọ Tiến', '0981827122', 'akwhkd@gmail.com', 'Thọ Tân'),
(8, 'margherita pizza', '80000.00', 6, '480000.00', 'Đã Giao', '', 'Lê Văn Thụ', '0912378123', 'adkowqmwm@gmail.com', 'hà nội'),
(9, 'special burger', '40000.00', 30, '1200000.00', 'Đã Giao', '', 'Lê Thị Hoa', '0981827122', 'anhhuy0312@gmail.com', 'phố tân mai, hoàng mai'),
(11, 'special burger', '40000.00', 1, '40000.00', 'Đã Giao', '', 'Lê Anh Huy', '0912378123', 'anhhuy482003@gmail.com', 'tây nguyên'),
(12, 'special burger', '40000.00', 1, '40000.00', 'Đã Giao', '', 'Nguyễn thị mùi', '0128930112', 'dakxajsd@gmail.com', 'QL47'),
(13, 'vagitable sandwich', '20000.00', 1, '20000.00', 'Đã Giao', '', 'Lê Anh Huy', '0981827122', 'anhhuy482003@gmail.com', 'QL47'),
(14, 'vagitable sandwich', '20000.00', 1, '20000.00', 'Đã Giao', '', 'Lê Văn Huy', '098765123', 'anhhuy2003@gmail.com', 'Hà Nội'),
(15, 'margherita pizza', '80000.00', 1, '80000.00', 'Đã Giao', '', 'Lê Anh Huy', '0981827122', 'anhhuy482003@gmail.com', 'Cà Mau'),
(46, 'Mỳ ý xốt cay', '80000.00', 1, '80000.00', 'Đã Giao', 'huymooc03', 'Lê Anh Huy', '0981827122', 'anhhuy482003@gmail.com', 'QL47'),
(47, 'simple burger', '30000.00', 1, '30000.00', 'Đã Giao', 'huymooc03', 'Lê Anh Huy', '0912378123', 'anhhuy482003@gmail.com', 'QL47'),
(48, 'gà viên phô mai', '49998.00', 1, '49998.00', 'Đã Đặt', 'huymooc03', 'Lê Anh Huy', '0981827122', 'anhhuy482003@gmail.com', 'QL47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `full_name`, `username`, `email`, `password`, `created_at`) VALUES
(6, 'Lê Anh Huy', 'huymooc03', 'anhhuy482003@gmail.com', 'anhhuy2003', '2025-04-14 18:17:04'),
(7, 'Bùi Thị Bê', 'be123', 'be123@gmail.com', 'anhhuy2003', '2025-04-15 03:36:56');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
