-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 24, 2024 lúc 08:59 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `officesupplies`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_user` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_user`, `admin_pass`, `level`) VALUES
(1, 'Nguyễn Đình Kiên', 'kien@gmail.com', 'kienadmin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `billId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `cusName` varchar(50) NOT NULL,
  `cusEmail` varchar(200) NOT NULL,
  `cusPhone` varchar(30) NOT NULL,
  `cusAddress` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `sum` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_bill`
--

INSERT INTO `tbl_bill` (`billId`, `userId`, `cusName`, `cusEmail`, `cusPhone`, `cusAddress`, `date`, `time`, `sum`, `discount`, `total`, `status`) VALUES
(22, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-05', '08:17:03', 210000, 20000, 190000, 2),
(23, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-05', '09:07:51', 210000, 0, 210000, 2),
(25, 8, 'Nguyễn Đức Huy', 'huy@gmail.com', '0123456789', 'Nghệ An', '2024-05-05', '15:44:49', 22500, 0, 22500, 2),
(26, 8, 'Nguyễn Đức Huy', 'huy@gmail.com', '0123456789', 'Nghệ An', '2024-05-05', '15:51:09', 198000, 20000, 178000, 2),
(28, 8, 'Nguyễn Đức Huy', 'huy@gmail.com', '0123456789', 'Nghệ An', '2024-05-06', '07:27:21', 198000, 20000, 178000, 2),
(29, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-13', '09:11:21', 31500, 0, 31500, 2),
(30, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-13', '09:57:57', 31500, 0, 31500, 2),
(32, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-14', '21:58:39', 22000, 0, 22000, 2),
(34, 8, 'Nguyễn Đức Huy', 'huy@gmail.com', '0123456789', 'Nghệ An', '2024-05-14', '22:01:32', 396000, 0, 396000, 2),
(35, 9, 'Ngô Quang Hiển', 'hien@gmail.com', '0858479123', 'Số 1, Ngõ 1, Từ Sơn, Bắc Ninh', '2024-05-14', '23:20:53', 128000, 50000, 78000, 2),
(39, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-19', '15:31:33', 523000, 0, 523000, 2),
(40, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-19', '17:59:09', 130000, 0, 130000, 2),
(41, 1, 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', '2024-05-19', '19:37:15', 231000, 0, 231000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `sesId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT '0',
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sesId`, `productName`, `price`, `quantity`, `color`, `productImage`) VALUES
(126, 7, '10', 'Bút máy Điểm 10 TP-FTC02', 99000, 7, 'Đen', '51f54ea6cb.png'),
(136, 7, '1', 'Bút máy Điểm 10 TP-FTC02', 99000, 2, 'Đen', '51f54ea6cb.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'Bút viết'),
(2, 'Văn phòng phẩm'),
(3, 'Dụng cụ học tập'),
(4, 'Mỹ thuật'),
(5, 'Giấy in'),
(6, 'Sách'),
(7, 'Combo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contactId` int(11) NOT NULL,
  `contactName` varchar(50) NOT NULL,
  `contactEmail` varchar(255) NOT NULL,
  `contactPhone` varchar(30) NOT NULL,
  `contactAddress` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`contactId`, `contactName`, `contactEmail`, `contactPhone`, `contactAddress`, `date`, `time`, `content`) VALUES
(13, 'Ngô Quang Hiển', 'hien@gmail.com', '0987654321', 'Bắc Ninh', '2024-05-14', '23:23:40', 'Hello World');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_discount`
--

CREATE TABLE `tbl_discount` (
  `discountId` int(9) NOT NULL,
  `discountName` varchar(50) NOT NULL,
  `discountStart` date NOT NULL,
  `discountEnd` date NOT NULL,
  `discountValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_discount`
--

INSERT INTO `tbl_discount` (`discountId`, `discountName`, `discountStart`, `discountEnd`, `discountValue`) VALUES
(1, 'giamgia20k', '2024-04-20', '2024-05-30', 20000),
(3, 'giamgia50k', '2024-05-01', '2024-05-15', 50000),
(6, 'giamgia30k', '2024-05-01', '2024-05-10', 30000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(30) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `billId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `productId`, `productName`, `userId`, `quantity`, `color`, `price`, `image`, `date`, `time`, `status`, `billId`) VALUES
(52, 11, 'Gôm tẩy nhân vật hoạt hình Gấu Pooh Disney Thiên Long E-032/PO', 1, 2, 'Xanh', 6000, '5f629b5fe9.png', '2024-05-05', '08:17:03', 1, 22),
(53, 7, 'Bút máy Điểm 10 TP-FTC02', 1, 2, 'Đỏ', 99000, '51f54ea6cb.png', '2024-05-05', '08:17:03', 1, 22),
(54, 11, 'Gôm tẩy nhân vật hoạt hình Gấu Pooh Disney Thiên Long E-032/PO', 1, 2, 'Xanh', 6000, '5f629b5fe9.png', '2024-05-05', '09:07:51', 1, 23),
(55, 7, 'Bút máy Điểm 10 TP-FTC02', 1, 2, 'Đỏ', 99000, '51f54ea6cb.png', '2024-05-05', '09:07:51', 1, 23),
(58, 10, 'Thước thẳng Thiên Long Disney Gấu Pooh SR-033/PO', 8, 3, '0', 7500, '6f2ea4dbd5.png', '2024-05-05', '15:44:49', 1, 25),
(59, 7, 'Bút máy Điểm 10 TP-FTC02', 8, 2, 'Xanh', 99000, '51f54ea6cb.png', '2024-05-05', '15:51:09', 1, 26),
(61, 7, 'Bút máy Điểm 10 TP-FTC02', 8, 2, 'Xanh', 99000, '51f54ea6cb.png', '2024-05-06', '07:27:21', 1, 28),
(62, 4, 'Bút Bi Thiên Long TL-027', 1, 3, 'Xanh', 5500, '023d630dce.png', '2024-05-13', '09:11:21', 1, 29),
(63, 10, 'Thước thẳng Thiên Long Disney Gấu Pooh SR-033/PO', 1, 2, '0', 7500, '6f2ea4dbd5.png', '2024-05-13', '09:11:21', 1, 29),
(64, 5, 'Bút lông dầu Thiên Long PM-04', 1, 2, 'Đỏ', 11700, 'e7b1fb7abd.png', '2024-05-13', '09:57:57', 2, 30),
(65, 6, 'Bút chì gỗ Thiên Long GP-018', 1, 2, '0', 4050, '3f72742a1a.png', '2024-05-13', '09:57:57', 2, 30),
(67, 4, 'Bút Bi Thiên Long TL-027', 1, 4, 'Xanh', 5500, '023d630dce.png', '2024-05-14', '21:58:39', 2, 32),
(69, 7, 'Bút máy Điểm 10 TP-FTC02', 8, 4, 'Xanh', 99000, '51f54ea6cb.png', '2024-05-14', '22:01:32', 2, 34),
(70, 4, 'Bút Bi Thiên Long TL-027', 9, 2, 'Xanh', 5500, '023d630dce.png', '2024-05-14', '23:20:53', 2, 35),
(71, 11, 'Gôm tẩy nhân vật hoạt hình Gấu Pooh Disney Thiên Long E-032/PO', 9, 3, 'Đen', 6000, '5f629b5fe9.png', '2024-05-14', '23:20:53', 2, 35),
(72, 7, 'Bút máy Điểm 10 TP-FTC02', 9, 1, 'Xanh', 99000, '51f54ea6cb.png', '2024-05-14', '23:20:53', 2, 35),
(77, 7, 'Bút máy Điểm 10 TP-FTC02', 1, 1, '0', 99000, '51f54ea6cb.png', '2024-05-19', '15:31:33', 2, 39),
(78, 68, 'Combo Mỹ Thuật tiện lợi 6 món – Set combo gồm bút lông màu, sáp màu, bút chì, chuốt, thước kẻ và gôm', 1, 1, '0', 424000, '1e1175f900.png', '2024-05-19', '15:31:33', 2, 39),
(79, 66, 'Combo mỹ thuật gấu Pooh (5 món tiện dụng, nhân vật hoạt hình ngộ nghĩnh)', 1, 1, '0', 130000, '156b65ef99.png', '2024-05-19', '17:59:09', 2, 40),
(80, 63, 'Gói dụng cụ văn phòng phẩm tiện lợi DCVP01', 1, 1, '0', 231000, '1312f394a2.png', '2024-05-19', '19:37:15', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productAmount` int(9) NOT NULL DEFAULT 0,
  `productPrice` int(11) NOT NULL DEFAULT 0,
  `productOldPrice` int(11) NOT NULL DEFAULT 0,
  `catId` int(9) UNSIGNED NOT NULL,
  `productStyle` tinyint(9) NOT NULL DEFAULT 1,
  `productColor` tinyint(4) NOT NULL DEFAULT 0,
  `productDesc` text NOT NULL,
  `productPro` text NOT NULL,
  `productSold` int(9) NOT NULL DEFAULT 0,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `productAmount`, `productPrice`, `productOldPrice`, `catId`, `productStyle`, `productColor`, `productDesc`, `productPro`, `productSold`, `productImage`) VALUES
(4, 'Bút Bi TL-027', 991, 5500, 5500, 1, 1, 1, 'Đây là một trong những cây bút đang được học sinh sử dụng nhiều nhất tại Việt Nam. Bút có thiết kế tối giản, nhưng tinh tế và ấn tượng. Toàn bộ thân bút làm từ nhựa trong, phối hợp hoàn hảo với màu ruột bút bên trong.', '- Đầu bi: 0.5mm, sản xuất tại Thụy Sĩ.		\r\n- Bút bi dạng bấm cò.		\r\n- Nơi tì ngón tay có tiết diện hình tam giác vừa vặn với tay cầm giúp giảm trơn tuột khi viết thường xuyên.		\r\n- Độ dài viết được: 1.600-2.000m		', 19, '023d630dce.png'),
(5, 'Bút lông dầu Thiên Long PM-04', 1000, 13000, 13000, 1, 1, 1, 'Bút lông dầu Thiên Long PM-04 là một trong những loại bút lông dầu được sử dụng phổ biến nhất tại Việt Nam. Bút có thiết kế rất hợp lý, dễ sử dụng, chất lượng ổn định. Bút lông dầu Thiên Long PM-04 là sản phẩm mới thuộc nhóm dụng cụ văn phòng, do Tập đoàn Thiên Long sản xuất. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế, kiểu dáng được cải tiến ấn tượng, thân bút cầm chắc tay, dễ cầm nắm, không gây mỏi tay khi sử dụng .', '- Sản phẩm có kiểu dáng hiện đại gồm 2 đầu bút khác nhau: đầu nhỏ và đầu lớn giúp đa dạng nét viết, thuận tiện khi sử dụng.	\r\n- Màu mực đậm tươi, mực ra đều và liên tục.	\r\n- Độ bám dính của mực tốt trên các vật liệu: Giấy, gỗ, da, nhựa, thủy tinh, kim loại, gốm, sứ, đĩa CD...	\r\n- Phù hợp cho: Nhân viên văn phòng, học sinh, sinh viên.	\r\n- 2 đầu bút kích thước: 0.4 mm và 1 mm	\r\n- Mực không độc hại	', 22, 'e7b1fb7abd.png'),
(6, 'Bút chì gỗ GP-018', 1000, 4500, 4500, 1, 1, 0, 'Bút chì gỗ Thiên Long GP-018 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập.', '- Bút chì thân gỗ, thân dạng hình lục giác, dễ cầm nắm khi viết. \r\n- Thân thiết kế đơn giản nhưng sang trọng, sơn một màu vàng.\r\n- Ruột chì loại 2B, mềm và đen. Nét đậm, lướt nhẹ nhàng trên bề mặt giấy.					', 17, '3f72742a1a.png'),
(7, 'Bút máy Điểm 10 TP-FTC02', 991, 110000, 110000, 1, 2, 1, 'Bút máy Điểm 10 TP-FTC09 phù hợp cho các cuộc thi viết chữ đẹp cấp trường, quận huyện, thành phố, được sử dụng chính trong các cuộc thi \"Em Yêu Chữ Đẹp\"', '- Trọng lượng: tương đối, không nặng, cũng không nhẹ, vừa tay cầm.\r\n- Bút sử dụng ngòi không mài, được làm bằng thép cao cấp, xi titanium màu vàng siêu bền.\r\n- Dùng ống mực FPIC-02, cắm vào là sử dụng đơn giản và tiện lợi.\r\n- Bút có 2 màu thân hồng và xanh dễ dàng cho các bé chọn lựa.', 39, '51f54ea6cb.png'),
(10, 'Thước thẳng Thiên Long Disney Gấu Pooh SR-033/PO', 1000, 7500, 7500, 3, 2, 0, 'Thước thẳng được chế tạo từ nhựa PS có độ bền cao. Được sử dụng nhiều trong học tập, cơ khí, vẽ các bảng kĩ thuật, xây dựng, vẽ tranh...', '- Độ bền cao, có thể tái chế.\r\n- Thước được bo tròn 4 cạnh giúp an toàn khi sử dụng.\r\n- Số và vạch to, rõ ràng, dễ nhìn.', 0, '6f2ea4dbd5.png'),
(11, 'Gôm tẩy nhân vật hoạt hình Gấu Pooh Disney Thiên Long E-032/PO', 997, 6000, 6000, 3, 2, 1, 'Gôm tẩy sạch, an toàn với mọi đối tượng sử dụng', '- Tẩy nhẹ tay, không để lại vết đen của chì trên giấy.\r\n- Không bị rách giấy, không bị gãy khi tẩy.', 3, '5f629b5fe9.png'),
(14, 'Bút xóa FO-CP02VN', 1000, 24000, 24000, 1, 2, 0, 'Bút xóa FlexOffice FO-CP02VN có kiểu dáng thân dẹp, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa màu xanh dương thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt.', '- Mực dạng dung môi lỏng	\r\n- Công nghệ vượt trội giúp mực xuống đều hơn.	\r\n- Bút ít bị tắc mực, độ che phủ bề mặt tốt hơn và mau khô, giúp cho chữ viết rõ ràng, không bị lem, nhòe.	\r\n- Xóa nhanh khô	\r\n- Che phủ tốt	\r\n- An toàn với tầng Ozone.	', 0, 'c8e6fae034.png'),
(15, 'Bút Gel Điểm 10 xóa được TP-GELE01', 1000, 14000, 14000, 1, 1, 1, 'là một sản phẩm có thiết kế đơn giản và hiện đại, được làm từ nhựa trong, sáng bóng sang trọng. Thiết kế của bút có những họa tiết nhân vật hoạt hình ngộ nghĩnh và đáng yêu, đặc biệt phù hợp cho học sinh tiểu học.', '- Bút gel Điểm 10 TP-GELE01 có thiết kế đơn giản và hiện đại. 	\r\n- Mực nước màu đậm và tươi sáng, viết êm trơn, ra đều và liên tục.	\r\n- Ngòi bút 0.5mm giúp nét viết mảnh, nhỏ.	\r\n- Đặc biệt có gôm trên nắp bút giúp tẩy sạch dễ dàng mực bút Gel.	', 0, '62c0dd8360.png'),
(16, 'Ruột bút bi BPR-06', 1000, 3000, 3000, 1, 1, 1, '\"Đầu bi có nắp đậy để bảo vệ ngòi bút, được làm từ hợp kim cao cấp, có dạng cone. Viết trơn, êm, mực ra đều và liên tục.\r\nRuột bút có khả năng viết được ít nhất 3000m (trên giấy ISO 12757). Sản phẩm cung cấp nhiều màu sắc lựa chọn như xanh, đen, đỏ, tím.\"', '- Đầu bi có nắp đậy để bảo vệ ngòi bút, được làm từ hợp kim cao cấp, đầu bút dạng cone.	\r\n- Viết trơn, êm, mực ra đều, liên tục.	\r\n- Viết được ít nhất 3000m (trên giấy ISO 12757)	\r\n- Mực có nhiều màu như: xanh, đen, đỏ, tím	', 0, 'f406f30aca.png'),
(17, 'Bút chì khúc PC-09', 1000, 5000, 5000, 1, 1, 1, 'Bút chì khúc HB Thiên Long PC-09 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên.', '- Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua. Ruột bút HB với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến.					\r\n- Ruột bút HB có màu chì đậm, ngòi mềm hạn chế gãy khi chuốt và đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp.					\r\n- Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao. Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo.				\r\n- Bút chì khúc HB Thiên Long PC-09 được thiết kế nhỏ gọn thân tròn giúp bạn dễ dàng cầm nắm và điều chỉnh nét vẽ. Đồng thời, bút còn dễ cất giữ trong bóp, giỏ xách khi đi học, tiện dùng khi cần. Bút có gắn sẵn gôm ở chuôi chì tiện lợi khi sử dụng.					', 0, 'f8d1994b44.png'),
(18, 'Mực bút máy Điểm 10 FPI-07', 1000, 9000, 9000, 1, 2, 1, ' là lựa chọn lý tưởng cho việc viết với bút máy. Với khả năng không lem trên giấy, mực bút đảm bảo viết mượt mà và dễ dàng,  không gây trở ngại khi sử dụng. Sản phẩm này được thiết kế để sử dụng cho nhiều loại bút máy khác nhau, mang lại sự linh hoạt trong việc sử dụng.', '- Mực không lem trên giấy	\r\n- Thích hợp cho các loại bút máy	\r\n- Không độc hại, đạt tiêu chuẩn Châu Âu EN71/3, EN71/9, và Mỹ ASTM D-4236	', 0, 'bcd1f3d90d.png'),
(19, 'Bút đế cắm PH-02', 1000, 25000, 25000, 1, 1, 1, 'Viết tốt trên giấy carbolet (lọai giấy mỏng, mặt láng). Bút chuyên để trên bàn làm việc nơi đông người như bàn tiếp tân, bưu điện, ngân hàng, siêu thị...', '- Sản phẩm có thiết kế 2 bút trên 1 đế cắm nhỏ gọn, tiện lợi, thích hợp sử dụng tại các địa điểm công cộng như Bưu điện, Ngân hàng …	\r\n- Đầu bi 0.7mm, dạng cone, mực ra đều, không bị chảy mực.	\r\n- Hai bút cùng màu xanh tiện lợi.	\r\n- Thích hợp viết trên nhiều loại giấy	\r\n-KHÔNG CHẢY MỰC KHI CẮM ĐỨNG	', 0, 'd6a9f95145.png'),
(20, 'Pin Alkaline AA', 1000, 22000, 22000, 2, 2, 0, 'Pin Alkaline AA của thương hiệu Flexio là sản phẩm được sản xuất tại Việt Nam, có trọng lượng là 26 gram cho mỗi vỉ 2 viên pin và 52 gram cho mỗi vỉ 4 viên pin. Pin này có điện thế là 1.5V và tuân thủ tiêu chuẩn TCCS 0167:2023/TL-PSC. Thời gian bảo quản của sản phẩm là 60 tháng.', '- Khả năng cung cấp năng lượng ổn định và lâu dài cho các thiết bị điện tử. \r\n- Tuy nhiên, cần bảo quản pin xa nguồn nhiệt và hóa chất\r\n- Không nên sử dụng cho trẻ dưới 3 tuổi.', 0, '4cc47e010c.png'),
(21, 'Sổ lò xo đường kẻ ngang  B5', 1000, 45900, 45900, 2, 1, 0, 'Sổ lò xo đường kẻ ngang B5 của thương hiệu Thiên Long là sản phẩm văn phòng phẩm có kích thước 176 x 250 mm. Sổ được làm từ giấy có định lượng 100 gsm và độ trắng đạt 76%, giúp cho việc viết và ghi chú trở nên dễ dàng và rõ ràng. Sổ có tổng cộng 120 trang.', '- Đặc điểm nổi bật của sổ lò xo Thiên Long B5 là khả năng sử dụng tiện lợi với lò xo đường kẻ ngang, giúp trang sách mở ra một cách dễ dàng và giữ cho trang sách được phẳng khi sử dụng. \r\n- Tuy nhiên, cần bảo quản sổ lò xo tránh xa nguồn nhiệt và hóa chất, và không nên sử dụng cho trẻ dưới 3 tuổi.', 0, '6bfab649d3.png'),
(22, 'Lốc 2 Pin đại D  BAC-R20/2', 1000, 30240, 30240, 2, 1, 0, 'Lốc 2 pin đại D BAC-R20/2 của thương hiệu Flexio là sản phẩm chất lượng với đặc tính ổn định và đáng tin cậy. Mỗi lốc pin có trọng lượng khoảng 79 gram, được thiết kế dành riêng cho loại pin D có điện thế là 1.5V. \r\nSản phẩm tuân thủ tiêu chuẩn TCCS 0167:2023/TL-PSC và được sản xuất tại Trung Quốc với xuất xứ từ Việt Nam. Thời gian bảo quản của pin là 36 tháng, đảm bảo khả năng lưu trữ năng lượng lâu dài.', '- Đặc điểm nổi bật của lốc pin này là khả năng cung cấp năng lượng ổn định và mạnh mẽ cho các thiết bị điện tử cần năng lượng lớn. \r\n- Tuy nhiên, cần bảo quản pin tránh xa nguồn nhiệt và hóa chất, đồng thời không nên sử dụng cho trẻ dưới 3 tuổi.', 0, '9607d77332.png'),
(23, 'Băng keo - Băng dính kéo 2 mặt GT-001', 1000, 27900, 27900, 2, 2, 0, 'Băng keo - Băng dính kéo 2 mặt GT-001 của thương hiệu Thiên Long là sản phẩm có thiết kế nhỏ gọn và tiện lợi. Kích thước của sản phẩm là 73.5 x 38 x 19 mm, với kích thước lõi keo là 6 x 8 mm. Thân của băng keo được làm từ chất liệu nhựa ABS - PS, mang lại độ bền và độ cứng cần thiết cho việc sử dụng.\r\nSản phẩm được đóng gói một cây cho mỗi kiện hàng, và có trọng lượng khoảng 17 gram, giúp việc mang theo và sử dụng dễ dàng.\r\nĐể bảo quản sản phẩm, cần tránh xa nguồn nhiệt và hóa chất, đồng thời không nên để cho trẻ dưới 3 tuổi tiếp xúc với sản phẩm này.', '- Đặc điểm : Keo bám dính tốt, không làm nhăn giấy.\r\n- Thân và nắp được làm từ nhựa ABS và PS.\r\n- Sản phẩm nhỏ gọn, dễ dàng mang theo bất cứ đâu, nắp đậy chống bụi bẩn.', 0, '57c6f696d7.png'),
(24, 'Bìa còng 50F4 FO-BC13', 1000, 57600, 57600, 2, 1, 0, 'Bìa được làm từ chất liệu 1 mặt si, mang lại vẻ ngoài mịn màng và chắc chắn. Sản phẩm được bán theo quy cách một bìa mỗi túi và có đơn vị tính là bìa. Màu sắc có sẵn là xanh và xanh đậm, tạo điểm nhấn cho tài liệu và sắp xếp văn phòng của bạn.\r\nĐể bảo quản bìa còng, cần tuân thủ các điều kiện về nhiệt độ và độ ẩm (nhiệt độ từ 10 đến 55 độ C và độ ẩm từ 55 đến 95% RH), đồng thời tránh xa nguồn nhiệt, dầu mỡ và các yếu tố khác có thể làm hỏng sản phẩm.', '- Bìa còng Flexoffice 50F4 FO-BC13 có khổ F4, dày 50mm. \r\n- Một mặt bìa được sản xuất từ vật liệu simili cao cấp, mặt trong phủ màng OPP.\r\n- Khóa và thanh kẹp giấy bằng thép chắc chắn, giữ được tính năng ổn định sau nhiều lần sử dụng.\r\n- Bìa dày dặn, cứng cáp, có thể lưu giữ tài liệu nhiều hơn\r\n- Một bìa chứa được 330 tờ F4, giúp việc lưu giữ tài liệu nhanh chóng và tiện lợi hơn\r\n- Có thể lưu được các loại bìa: Bìa lỗ, bìa kẹp nhựa,..', 0, '0d656fcad3.png'),
(25, 'Bìa thông tin - Checklist - Lưu trữ  hồ sơ A4 FO-IF01', 1000, 5500, 5500, 2, 1, 0, 'Bìa thông tin - Checklist - Lưu trữ hồ sơ A4 FO-IF01 của thương hiệu Fahasa là sản phẩm chất lượng được thiết kế để lưu trữ và bảo vệ các tài liệu, hồ sơ kích thước A4 một cách tiện lợi và hiệu quả.\r\nKích thước của sản phẩm là 335mm x 225mm, phù hợp với tài liệu kích thước A4. Bìa có trọng lượng khoảng 40 gram và độ dày chỉ 0.15 mm, giúp giữ cho tài liệu gọn nhẹ và dễ dàng di chuyển.\r\nSản phẩm được làm từ chất liệu nhựa PP, có độ trong suốt cao, giúp dễ dàng nhận biết và xem nội dung bên trong. Đơn vị tính của sản phẩm là bìa.', '- Được sử dụng trong các kho hàng để ghi chú thông tin hàng hóa, checklist màu sản phẩm.\r\n- Bìa thông tin treo bảng thông báo ở công ty, xí nghiệp giúp bảo quản văn bản tốt hơn.\r\n- Dùng cho học sinh làm bài tập thử dễ dàng bôi xóa với bút lông bảng.\r\n- Độ trong suốt và bám dính mực bút lông cao có thể tái sử dụng nhiều lần.\r\n- Có đường hàn đẹp mắt , chắc chắn.', 0, 'ba0b98e64a.png'),
(26, 'Bấm kim số 10 FO-ST03 (FS)', 1000, 31000, 31000, 2, 1, 0, 'Bấm kim số 10 FO-ST03 (FS) của thương hiệu FlexOffice là sản phẩm văn phòng phẩm chất lượng được thiết kế để bấm kết nối các tài liệu một cách chắc chắn và dễ dàng.\r\nSản phẩm được đóng gói theo quy cách như sau: mỗi hộp nhỏ chứa 01 cái bấm kim, 12 hộp nhỏ được đóng vào một hộp lớn, 20 hộp lớn được đóng vào một thùng carton, và mỗi thùng carton chứa tổng cộng 240 cái bấm kim.', '- Mẫu mã đẹp, thiết kế chắc chắn, thon gọn vừa tay cầm.\r\n- Màu sắc: màu ngẫu nhiên.\r\n- Vỏ bọc bằng nhựa cao cấp. Tay cầm làm bằng nhựa ABS giúp êm tay khi bấm.\r\n- Thân được làm từ thép không gỉ, sáng bóng, độ bền cao\r\n- Lò xo có độ đàn hồi tốt, bền khi sử dụng.\r\n- Bao bì sang trọng. Vỏ hộp được cán màng PP giúp chống thấm nước, hạn chế trầy xước và dễ dàng lau chùi, vệ sinh.\r\n- Bấm kim hoạt động nhẹ nhàng, trơn tru.\r\n- Sản phẩm đảm bảo đạt tiêu chuẩn chất lượng quốc tế, sử dụng thuận tiện, phù hợp cho giới văn phòng.\r\n- Sản phẩm phù hợp cho: Nhân viên văn phòng, học sinh, sinh viên, tiểu thương,...', 0, 'afaf079b93.png'),
(27, 'Băng keo đục OPP FO-BKD15', 1000, 34100, 34100, 2, 1, 0, 'Băng keo đục OPP FO-BKD15 của thương hiệu FlexOffice là sản phẩm chất lượng được thiết kế để sử dụng trong các công việc đóng gói và dán kín các hộp, bưu kiện, hoặc gói hàng.\r\nKích thước của băng keo là bề rộng 48mm và dài 150 Yard (~137m), đủ để sử dụng trong một thời gian dài mà không cần thay thế liên tục. Chất liệu chính của sản phẩm là OPP, mang lại độ bền và độ dính cao.\r\nSản phẩm được đóng gói theo quy cách 6 cuộn trong một lốc, giúp dễ dàng lưu trữ và sử dụng. Màu sắc của băng keo là đục, phù hợp với mọi loại mặt hàng mà bạn cần đóng gói.', '- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế, thân thiện với môi trường\r\n- Sản phẩm được làm từ màng BOPP có độ bền dai cao cộng keo tráng được lựa chọn để làm băng keo luôn đảm bảo độ dính cao, khả năng đàn hồi tốt.\r\n- Có thể dính rất chắc trên nhiều chất liệu khác nhau.', 0, 'acc9278390.png'),
(28, 'Bìa nút A5 FO-CBF06 - Trong suốt', 1000, 3300, 3300, 2, 1, 0, 'Bìa nút A5 FO-CBF06 của thương hiệu Flexoffice là sản phẩm chất lượng được thiết kế để bảo vệ và lưu trữ tài liệu kích thước A5 một cách tiện lợi và an toàn.\r\nKích thước của bìa là 260mm x 180mm, phù hợp với kích thước tài liệu A5. Trọng lượng của sản phẩm là 25 gram, giúp cho việc mang theo và sử dụng dễ dàng.\r\nBìa có sức chứa khoảng 20 tờ giấy A5 với định lượng 80gsm, đảm bảo rằng tài liệu được bảo quản trong tình trạng tốt nhất. \r\nChất liệu của bìa là nhựa PP trong suốt, giúp dễ dàng nhận biết và xem nội dung bên trong. Màu sắc của sản phẩm cũng là trong suốt, tạo ra một vẻ ngoài đẹp mắt và chuyên nghiệp.', '- Lưu trữ tài liệu, bài kiểm tra, tranh ảnh...\r\n- Độ bền đường hàn chắc chắn hơn.', 0, '41704bf0eb.png'),
(29, 'Bìa trình ký đơn A4 CB-01', 1000, 35000, 35000, 2, 2, 0, 'Sử dụng phù hợp với khổ giấy A4. Bìa cứng chắc. Kẹp bền chắc có tính đàn hồi cao giúp kẹp chặt tài liệu, hồ sơ. Hai góc kẹp được bọc nhựa, giúp kẹp chặt và không làm tài liệu nhăn hoặc rách. Mềm mại tạo cảm giác êm tay khi ký duyệt hoặc ghi chú trên hồ sơ, tài liệu.', '- Kiểu dáng trang nhã, sang trọng, thiết kế chắc chắn, không cong vênh, luôn giữ hồ sơ phẳng, lịch sự và tạo cảm giác thoải mái khi sử dụng\r\n- Làm từ nhựa PS, bề mặt siêu mịn, viết êm tay, dễ dàng ghi chép, ký duyệt trên tài liệu\r\n- Kẹp bằng kim loại cao cấp, sáng bóng, có lớp tráng dầu chống sét hạn chế oxy hóa theo thời gian, cứng cáp không han gỉ, độ bền cao\r\n- Được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế.', 0, 'c86ffca8af.png'),
(30, 'Bút dạ quang HL-012', 1000, 14000, 14000, 2, 1, 1, 'Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại. Đầu bút và ruột bút bằng polyester, dạng vát xéo. Vỏ bọc bằng nhựa PP. Bề rộng nét viết: 5mm', '- Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang HL012 là sản phẩm do Tập đoàn Thiên Long sản xuất.\r\n- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.\r\n- Kiểu dáng thon gọn, trẻ trung, không lăn khi đặt trên bàn.\r\n- Bút có kiểu dáng đơn giản, hiện đại. Thân vuông nhìn khỏe mạnh rất thích hợp với NVVP, SV...\r\n- Lượng mực nhiều, tăng thời gian sử dụng .\r\n- Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang HL012', 0, 'b81c4f4a01.png'),
(31, 'Bút lông bảng FlexOffice FO-WB-015', 1000, 10000, 10000, 2, 1, 1, 'Bút được sản xuất theo công nghệ hiện đại. Viết tốt, trơn, êm trên bảng trắng, thủy tinh và những bề mặt nhẵn bóng. Bề rộng nét viết 2.5mm Sử dụng mực mới, tốt, màu mực đậm, tươi sáng, dễ dàng xóa sạch ngay cả khi viết trên bảng lâu, không để lại bóng mực sau khi lau bảng và các bề mặt nhẵn bóng. Bơm mực dễ dàng, bao bì được thiết kế đẹp. Đầu bút xóa thuận tiện khi sử dụng. Mực không độc hại, đạt tiêu chuẩn an toàn quốc tế. Sợi Polyeste.', '- Không gây độc hại\r\n- Luôn đặt bút nằm ngang và đậy nắp sau khi sử dụng.\r\n- Có thể bơm thêm mực tái sử dụng nhiều lần.', 0, '2f0f644ac6.png'),
(32, 'Dao rọc giấy Flexoffice FO-KN01', 1000, 12000, 12000, 2, 1, 0, 'Dao rọc giấy FO-KN01 là một sản phẩm chất lượng từ thương hiệu FlexOffice, được thiết kế để cắt các tài liệu và giấy tờ một cách dễ dàng và chính xác.\r\nKích thước của dao là dài 137mm x rộng 9mm x dày 0.4mm, phù hợp với cỡ bàn tay và dễ dàng sử dụng. Thân dao được bọc bằng nhựa, giúp tạo cảm giác cầm nắm thoải mái và chắc chắn, trong khi lưỡi dao được làm từ thép, đảm bảo độ sắc và độ bền cao.', '- Sản phẩm được thiết kế thon gọn, có ngấn và răng trên cán dao, tạo cảm giác vừa thoải mái vừa chắc chắn và thuận tiện khi sử dụng.\r\n- Chuôi dao có rãnh để bẻ các đốt của lưỡi dao khi cần thiết.\r\n- Khóa dao giữ lưỡi dao cố định, an toàn khi sử dụng\r\n- Lưỡi dao làm bằng thép carbon bền, sắc bén, bề mặt sáng bóng, không trầy xước.\r\n- Dao rọc giấy 9mm FO-KN01 phù hợp cho nhân viên văn phòng, tiểu thương, nhà thiết kế,', 0, '4bbc2fbce4.png'),
(33, 'Giấy ghi chú 3x4 FO-SN04', 1000, 22000, 22000, 2, 1, 0, 'Giấy ghi chú 3x4 FO-SN04 là sản phẩm văn phòng phẩm đa dụng được thiết kế để ghi chú, ghi nhớ thông tin, và làm việc sắp xếp công việc một cách hiệu quả. Với kích thước 3x4 inch, sản phẩm phù hợp để sử dụng trong việc viết ghi chú nhỏ gọn và tiện lợi.\r\nSản phẩm có chất lượng tốt, giúp bảo đảm rằng các ghi chú được viết sẽ được giữ lại một cách chắc chắn và không bị bong tróc. Nó cũng dễ dàng di chuyển và dán vào bất kỳ bề mặt nào mà bạn cần.', '- Giúp các bạn quản lý tổ chức kế hoạch trong thời gian dài hạn.\r\n- Tiện lợi cho việc mang theo mọi lúc mọi nơi.\r\n- Ngay cả trong những lúc bận rộn nhất bạn cũng có thể ghi chú 1 cách dễ dàng.\r\n- Gồm nhiều tờ trong 1 xấp, có thể tháo dán và gỡ ra dễ dàng nhờ lớp keo mỏng.\r\n- Chất lượng: Đẹp, mịn, láng. Keo dính bền lâu nhưng dễ di dời.', 0, '99ac7e9ede.png'),
(34, 'Giấy Supreme A4/70 PP-S01', 1000, 80000, 80000, 2, 2, 0, '\"Giấy Supreme A4/70 PP-S01 là sản phẩm giấy văn phòng phẩm chất lượng cao với đặc điểm định lượng 70 A4, là loại giấy trắng đẹp nhất trên thị trường. Độ sắc nét cao của giấy giúp cho văn bản và hình ảnh in ra trở nên rõ ràng và sắc nét, ngay cả khi in 2 mặt không bị kẹt giấy. \r\nSản phẩm được thiết kế để hoạt động hiệu quả trên mọi loại máy in phun, máy in Laser, máy fax laser và máy photocopy. Khả năng in đảo 2 mặt mà không bị kẹt giấy giúp tăng cường sự tiện lợi và linh hoạt trong việc sử dụng.\"', '- Giấy Supreme định lượng 70 A4, là loại giấy trắng đẹp nhất trên thị trường, độ sắc nét cao, in 2 mặt không bị kẹt giấy, cho phép in, photocopy ra những văn bản, hình ảnh đẹp. Khách hàng có thể hoàn toàn yên tâm về chất lượng và giá cả khi sử dụng.\r\n- Thích hợp với tất cả các loại Máy in phun, máy in Laser, máy Fax laser, máy Photocopy.\r\n- In đảo 2 mặt không bị kẹt giấy. Giấy được đóng gói và nhập khẩu từ Thái Lan nên luôn đảm bảo chất lượng độ ổn định.', 0, '2ccb3f23b2.png'),
(35, 'Hộp đựng tài liệu - Hộp đựng hồ sơ A4 Thiên Long Flexoffice FO-DF002', 1000, 31900, 31900, 2, 1, 0, 'Sản phẩm thuộc thương hiệu FlexOffice có kích thước là 322 x 380 x 35 mm và được làm từ chất liệu nhựa PP, mang lại sự bền bỉ và độ bền cao. Độ dày của cover là 0.6 mm, giúp bảo vệ tài liệu bên trong một cách hiệu quả.', '- Cặp hồ sơ kích thước A4 phù hợp cho mọi đối tượng. \r\n- Thích hợp giấy tờ đi công tác, học thêm…sản phẩm phù hợp để lưu trữ và bảo quản các tài liệu, hồ sơ, hoặc vật phẩm văn phòng phẩm khác một cách an toàn và tiện lợi. \r\n- Thiết kế chắc chắn và kích thước phù hợp giúp sản phẩm trở thành một lựa chọn lý tưởng cho nhu cầu tổ chức và lưu trữ trong văn phòng hoặc cá nhân.', 0, '29052b283e.png'),
(36, 'Bút chì bấm PC-029 - Tích hợp chuốt chì trên thân bút - Màu thân ngẫu nhiên', 1000, 5000, 5000, 3, 2, 0, 'Bút chì bấm PC-029 của thương hiệu Thiên Long là sản phẩm chất lượng với tính năng tích hợp chuốt chì trên thân bút, giúp tiện lợi trong việc sử dụng và duy trì độ sắc của chì.\r\nLoại chì sử dụng là loại min chì 2mm, phù hợp với nhiều loại chì khác nhau từ 3H đến 3B và các loại chì khác. Sản phẩm tuân thủ tiêu chuẩn TCCS 19:2008/TL-BCB, đảm bảo chất lượng và hiệu suất khi sử dụng.', '- Sản phẩm là tích hợp chuốt chì trên thân bút, giúp tiết kiệm không gian và dễ dàng sử dụng ngay khi cần thiết.\r\n- Đồng thời, sản phẩm cũng được khuyến cáo tránh xa nguồn nhiệt và hóa chất, không thích hợp cho trẻ dưới 3 tuổi.', 0, '0046548bbc.png'),
(37, 'Máy chuốt chì tự động SE-001 - Không bao gồm pin', 1000, 132000, 132000, 3, 1, 0, 'Máy chuốt chì tự động SE-001 của thương hiệu Flexio là một sản phẩm tiện ích được thiết kế để tự động chuốt chì một cách nhanh chóng và thuận tiện. Với kích thước nhỏ gọn là 65 x 63 x 72 mm và trọng lượng chỉ 93 gram, máy dễ dàng mang theo và sử dụng ở mọi nơi.\r\nSản phẩm hoạt động trên nguồn điện áp 3V, cần sử dụng 2 pin AA (không bao gồm). Điều này giúp tiết kiệm năng lượng và tiện lợi cho việc thay thế pin.\r\nMáy được làm từ chất liệu ABS Plastic chắc chắn và bền bỉ, đảm bảo độ bền và tuổi thọ cao', '- Máy chuốt chì tự động SE-001 giúp tiết kiệm thời gian và công sức cho người dùng. \r\n- Bảo hành 30 ngày và chính sách 1 đổi 1 khi gặp sự cố, đảm bảo sự hài lòng của khách hàng. \r\n- Đồng thời, cũng cần tuân thủ các khuyến cáo về tránh nguồn nhiệt, hóa chất và không sử dụng cho trẻ dưới 3 tuổi.', 0, 'd408291e5d.png'),
(38, 'Tập học sinh 200 trang 4 ô ly ngang 60 gsm Điểm 10 TP-NB066 (hình ngẫu nhiên)', 1000, 22000, 22000, 3, 1, 0, 'Tập học sinh Thiên Long - Điểm 10 TP-NB066 (200 trang - 4 ôly ngang) bìa cán vân, thiết kế hoàn toàn mới, màu sắc và bố cục ấn tượng, rất thích hợp với học sinh THCS, THPT, SV.', '- Tập học sinh Thiên Long - Điểm 10 TP-NB066 (200 trang - 4 ôly ngang) là một sản phẩm mới thuộc nhóm sản phẩm tập học sinh, mang nhãn hiệu Điểm 10. \r\n- Sản phẩm được sản xuất theo công nghệ hiện đại, màu sắc đẹp, sắc nét.\r\n- Đây là loại giấy mỏng, thích hợp với các loại bút bi, gel.', 0, 'c8d6e925fc.png'),
(39, 'Bảng thông minh đa sắc EWB-001', 1000, 290000, 290000, 3, 1, 0, 'Là một sản phẩm thông minh và tiện ích cho việc ghi chú, học tập và làm việc hàng ngày. Với giá cả là 290.000đ, sản phẩm này mang lại sự tiện lợi và hiệu quả trong công việc.\r\nKích thước của bảng là 260 x 165 x 5.5 mm, làm cho nó trở thành một lựa chọn lý tưởng cho việc mang theo khi di chuyển hoặc để trên bàn làm việc mà không chiếm quá nhiều không gian.\r\nBảng thông minh có độ dày chỉ 5.5 mm, giúp nó trở nên nhẹ nhàng và dễ dàng sử dụng. Trọng lượng của sản phẩm là 156 gram, đủ nhẹ để bạn có thể mang theo mọi lúc mọi nơi mà không gặp bất kỳ khó khăn nào.', '- Dùng để ghi chép, học tập, vẽ phác thảo, sử dụng như giấy nháp và bảng truyền thống.', 0, '0f1ee880e2.png'),
(40, 'Giấy kiểm tra Điểm 10 TP-GKT05 - Dòng kẻ ngang 7mm', 1000, 19000, 19000, 3, 1, 0, 'Là sản phẩm chất lượng của thương hiệu Điểm 10, được thiết kế đặc biệt để phục vụ việc kiểm tra và đánh giá học sinh, sinh viên. Với giá cả hợp lý là 19.000đ, sản phẩm này đem lại giá trị và sự tiện lợi trong quá trình sử dụng.\r\nKích thước của giấy kiểm tra là 179 x 252 mm, phù hợp với việc viết và làm bài kiểm tra. Trọng lượng của sản phẩm là 30 gram, giúp việc mang theo và sử dụng trở nên thuận tiện.\r\nSản phẩm được đóng gói mỗi kiện bao gồm 20 tờ đôi và 6 tờ đơn, giúp tiết kiệm chi phí và dễ dàng sử dụng trong thời gian dài.\r\nGiấy kiểm tra Điểm 10 TP-GKT05 có dòng kẻ ngang 7mm và kích thước ô ly vuông là 5 ô ly (2,5 x 2,5) mm, giúp việc viết và ghi chép trở nên gọn gàng và dễ dàng hơn.\r\nĐộ trắng của giấy là 90%, cùng với định lượng 70 gsm, giúp bảo đảm rằng văn bản được viết ra trên giấy sẽ có độ tương phản và độ rõ nét cao.', '- Tặng kèm túi nhựa PP chắc chắn\r\n- Túi chứa được 20 tờ đôi và 6 tờ đơn\r\n- Túi nhựa có thể tái sử dụng để đựng các học cụ nhỏ gọn', 0, '841edbc789.png'),
(41, 'Bảng 2 mặt học Toán và Tiếng Việt theo chương trình Bộ Sách Giáo Khoa Chân Trời Sáng Tạo', 1000, 25000, 25000, 3, 2, 0, 'Là sản phẩm chất lượng của thương hiệu Điểm 10, được thiết kế đặc biệt để hỗ trợ việc học tập và ôn tập môn Toán và Tiếng Việt theo chương trình giáo dục Bộ Sách Giáo Khoa Chân Trời Sáng Tạo. Với giá cả là 25.000đ, sản phẩm này mang lại giá trị và sự tiện lợi trong quá trình học tập.\r\nKích thước của bảng là 318 x 218 x 2.2 mm, làm cho nó trở thành một lựa chọn lý tưởng cho việc sử dụng trong lớp học hoặc tại nhà.\r\nBảng được làm từ chất liệu nhựa PS chắc chắn và bền bỉ, giúp nó đảm bảo sự bền vững trong quá trình sử dụng. Trọng lượng của sản phẩm là 180 gram, đủ nhẹ để bạn có thể dễ dàng mang theo mọi lúc mọi nơi.\"', '- Mặt bảng mịn, dễ dàng bôi xóa, có thể lau rửa bằng nước.\r\n- Dòng kẻ đậm, rõ nét và được đánh số thứ tự giúp bé dễ canh dòng, ô ly khi viết.\r\n- Chất liệu bằng nhựa PS độ bền cao.', 0, '19c9c40d56.png'),
(42, 'Bút phấn nước FO-CM01 - Màu Cam', 1000, 29600, 29600, 3, 1, 0, 'Là một sản phẩm chất lượng, được thiết kế đặc biệt để sử dụng trong việc viết và tạo nét trang trí màu sắc. Với màu sắc cam rực rỡ, sản phẩm này có giá là 29.600đ, mang lại giá trị và sự tiện ích trong việc sáng tạo. \r\nBút phấn nước có bề rộng nét viết từ 2 đến 4.5 mm, giúp bạn linh hoạt trong việc tạo ra các đường nét với độ dày khác nhau, phù hợp cho việc viết và tô màu.\r\nSản phẩm được đóng gói mỗi kiện gồm 01 cây bút, giúp bảo quản và sử dụng dễ dàng.', '- Dễ lau bằng vải.\r\n- Dễ dàng thay thế ruột.\r\n- Đậy nắp sau khi dùng.\r\n- Không độc hại.', 0, '2b1755d874.png'),
(43, 'Bút dạ màu - bút marker 36 màu Colokit ART MARKER AM-C005 ', 1000, 294400, 320000, 4, 2, 0, 'Bút dạ màu - bút marker Thiên Long Colokit ART MARKER, hệ mực bền, mau khô. Thân bút có hai đầu Broad Chisle và Semi Brush, đầu bút dạng cọ và một đầu vát xéo. Dùng để viết, vẽ hoặc tô màu trên các loại giấy vẽ chuyên dụng hoặc trên các bề mặt kim loại, thủy tinh, nhựa, sứ.', '- Bút marker có 36 màu sắc đa dạng.\r\n- Đầu bút của sản phẩm bao gồm Broad Chisle và Semi Brush, giúp người dùng linh hoạt trong việc tạo nét vẽ.\r\n- Sản phẩm tuân thủ tiêu chuẩn TCCS 0161:2021/TL-BLMT, đảm bảo chất lượng và an toàn cho người sử dụng.\r\n- Kích thước hộp của bút là 164 x 126 x 117 mm, thuận tiện cho việc bảo quản và di chuyển.\"', 0, '73ee194782.png'),
(44, 'Tranh cuộn tô màu DIY Colokit CRO-C001', 1000, 36800, 40000, 4, 1, 0, 'Tranh cuộn tô màu DIY Thiên Long Colokit CRO-C001 là được sử dụng loại giấy vẽ mỹ thuật với thiết kế các hình ảnh theo chủ đề, định lượng giấy dày hơn, sử dụng tốt với các loại màu mà không sợ bị lem hay thấm.', '- Trọng lượng của sản phẩm là 180 gram, thuận tiện để di chuyển và sử dụng.\r\n- Kích thước của tranh là 50 x 70 cm, đủ lớn để tạo ra các tác phẩm nghệ thuật đẹp mắt.\r\n- Sản phẩm được đóng gói trong 05 tờ cho mỗi kiện, tiện lợi cho việc sử dụng và bảo quản.\r\n- Định lượng giấy là 100 gsm, đảm bảo độ bền và chất lượng cho quá trình tô màu.\r\n- Sản phẩm tuân thủ tiêu chuẩn TCCS 0168:2023/TL-GTM, đảm bảo an toàn cho người sử dụng.\r\n- Để bảo quản sản phẩm, cần tránh xa nguồn nhiệt và hóa chất.\"', 0, 'e9cbb81111.png'),
(45, 'Lọ màu nước Colokit WACO-C09', 1000, 12880, 14000, 4, 1, 1, 'Màu nước Thiên Long Colokit WACO-C09 dạng màu nước được đựng trong mỗi lọ nhựa dung tích 15ml trong suốt nhận diện được màu bên trong. Có nhiều màu để lựa chọn, màu trắng dùng để pha màu', '- Màu sắc tươi sáng, đúng chuẩn màu mỹ thuật.\r\n- Màu mềm mịn và đều. Độ hòa tan khi phối màu cao.\r\n- Độ phủ sau khi tô rất tốt, bền màu.\r\nRất thích hợp để tô, vẽ trên giấy khi học tập, tô tượng giải trí,…', 0, 'c40bb4bd91.png'),
(46, 'Bút sáp 18 màu Disney Pooh Colokit CR-C013/PO', 1000, 35880, 39000, 4, 1, 0, 'Sản phẩm được sản xuất bởi thương hiệu uy tín Colokit, đảm bảo chất lượng và đa dạng trong màu sắc.\r\nSử dụng chất liệu sáp an toàn cho trẻ em, giúp dễ dàng tô màu mà không gây hại cho sức khỏe.\r\nTuân thủ tiêu chuẩn TCCS 007:2011/TL-BSM, đảm bảo sản phẩm đáp ứng các yêu cầu về an toàn và chất lượng.\r\nĐóng gói 18 cây bút sáp trong mỗi hộp, tiện lợi cho việc sử dụng và bảo quản.\r\nKích thước hộp là 191 x 108 x 18 mm, phù hợp để mang theo khi cần.', '- Thân sáp hình trụ tròn, nhỏ vừa tay cầm của các bé.\r\n- Màu sắc tươi sáng đúng chuẩn màu mỹ thuật. Tô êm, ít bụi.\r\n- Màu phủ đều và bền màu.\r\n- Thân sáp có lớp giấy bảo vệ in hình nhân vật gấu Pooh đầy cá tính & độc đáo.\r\n- An toàn cho bé. Đạt chuẩn Châu Âu EN71/3, EN71/9, và Mỹ ASTM D-4236.\r\n- Hộp có màng định hình, bảo vệ sáp tốt và dễ lưu trữ.', 0, '119bf503e1.png'),
(47, 'Bột nặn Clever Dough Colokit MD-C008', 1000, 14720, 16000, 4, 1, 0, 'Sản phẩm được sản xuất bởi thương hiệu uy tín Colokit, đảm bảo chất lượng và an toàn cho trẻ em.\r\nSử dụng chất liệu bột an toàn và không độc hại, giúp trẻ em thỏa sức sáng tạo trong việc nặn và tạo hình.\r\nTuân thủ tiêu chuẩn TCCS 0100:2018/TL-BN, đảm bảo sản phẩm đáp ứng các yêu cầu về an toàn và chất lượng.\r\nSản phẩm có xuất xứ từ Việt Nam, đồng nghĩa với việc hỗ trợ nền công nghiệp và kinh tế nội địa.\r\nKhuyến cáo tránh xa nguồn nhiệt và hóa chất để bảo quản sản phẩm. Bột nặn Clever Dough không thích hợp cho trẻ dưới 3 tuổi để đảm bảo an toàn khi sử dụng.', '- Mềm hơn, mịn hơn, không dính tay.\r\n- Dễ tạo hình với khuôn, không dính khuôn\r\n- Có thể phối trộn màu với nhau.', 0, 'b7a684e482.png'),
(48, 'Vở vẽ Sketch Book for Art Colokit nhiều kích cỡ', 1000, 32200, 35000, 4, 2, 0, 'Sản phẩm được sản xuất bởi thương hiệu uy tín Colokit, đảm bảo chất lượng và đa dạng trong kích cỡ để phục vụ nhu cầu của người sử dụng.\r\nVở vẽ có hai kích thước phổ biến là A4 và A3, phù hợp cho cả việc vẽ tranh chi tiết nhỏ và tác phẩm lớn.\r\nSố trang của vở là 40 trang (không kể bìa), đủ để thực hiện nhiều dự án nghệ thuật.\r\nĐịnh lượng ruột của vở là 150 gsm, đảm bảo giấy chắc chắn và không bị nhòe khi sử dụng nước màu hoặc mực.\r\nĐộ trắng của giấy là 90%, tạo điều kiện tốt nhất cho việc vẽ và tô màu.\r\nSản phẩm tuân thủ tiêu chuẩn TCCS 0105:2019/TL-VOVE, đảm bảo an toàn và chất lượng cho người sử dụng.\r\nKhuyến cáo tránh xa nguồn nhiệt và hóa chất để bảo quản sản phẩm. Vở vẽ Sketch Book for Art Colokit không thích hợp cho trẻ dưới 3 tuổi để đảm bảo an toàn khi sử dụng.', '- Vở vẽ Sketch Book for Art Thiên Long Colokit là loại vở hỗ trợ vẽ mỹ thuật với thiết kế giấy chuyên dụng, định lượng giấy dày hơn, sử dụng tốt với các loại màu mà không sợ bị lem hay thấm.\r\n- Vở được thiết kế với chất liệu giấy chống thấm cực tốt với định lượng 150 gsm, loại bỏ hoàn toàn sơ giấy.', 0, '5d8c7c7115.png'),
(49, 'Bút sáp đa năng 12 màu rửa được Colo Art  Colokit-WSO-C001- Sáng tạo tranh nổi - Vừa là sáp màu - Vừa là màu nước - Tiêu chuẩn châu Âu', 1000, 107640, 117000, 4, 1, 0, 'Sản phẩm có thương hiệu Colokit, đảm bảo chất lượng và đa tính năng.\r\nTrọng lượng của sản phẩm là 150 gram, tiện lợi để sử dụng và mang theo khi cần.\r\nTính năng đa năng: Bút sáp này không chỉ có thể sử dụng như sáp màu mà còn có thể sử dụng như màu nước, giúp tạo ra những hiệu ứng độc đáo trong việc vẽ tranh.\r\nSản phẩm tuân thủ các tiêu chuẩn an toàn cao nhất, bao gồm tiêu chuẩn EN 71/3 của châu Âu và tiêu chuẩn ASTM D 4236 của Mỹ về độ an toàn mỹ thuật.\r\nKích thước của cây sáp: Chiều dài 101 mm, đường kính 11 mm, và khối lượng 9.2 gram, phù hợp để cầm và sử dụng.\r\nKhuyến cáo bảo quản sản phẩm tránh nguồn nhiệt và hóa chất, và không thích hợp cho trẻ dưới 3 tuổi để đảm bảo an toàn khi sử dụng.', '- Sản phẩm gồm 12 màu: Trắng, Vàng, Cam, Hồng, Đỏ, Đỏ Mận, Tím, Xanh Dương, Xanh Lá Lợt, Xanh Lá Đậm, Nâu Đỏ, Đen.\r\n- Sáp màu đa năng WSO-C001 an toàn, không độc hại, đáp ứng tiêu chuẩn châu Âu và Mỹ về độ an toàn cho trẻ em.\r\n- Bút sáp có màu tươi sáng, đậm, mịn, tô đều màu. Tô chồng màu tốt, độ phủ màu tốt. Di màu và phối trộn màu dễ dàng.\r\n- Bút sáp hòa tan được với nước và dầu lanh. Vẽ được trên nhiều bề mặt, lau rửa dễ dàng với nước khi vẽ trên các bề mặt láng.', 0, 'd1a9340eaa.png'),
(50, 'Bút chì màu chuyên nghiệp dạng lon 12/24/36 màu Colokit - Tiêu chuẩn châu Âu', 1000, 37720, 41000, 4, 1, 0, 'Bút chì màu chuyên nghiệp dạng lon Thiên Long Colokit CPC-C020, CPC-C021, CPC-C022 đạt tiêu chuẩn EN 71 về độ an toàn cho người sử dụng tại Liên minh châu Âu.', '- Bút chì màu được sử dụng nhiều trong hội họa, mỹ thuật.\r\n- Phù hợp với người mới bắt đầu đến vẽ chuyên nghiệp.\r\n- Bút chì màu với thân bút lục giác dễ cầm nắm và thân thiện với người sử dụng.\r\n- Màu sắc tươi sáng, bắt mắt.\r\n- Mỗi hộp đều có mút bảo vệ đầu ngòi.\r\n- Mỗi cốc đều có chuốt/ gọt bút chì ở nắp, thuận tiện cho việc sử dụng.', 0, '229b0fc1a9.png'),
(51, 'Bộ 12 Màu nước dạng nén Colokit WACO-C001', 1000, 63480, 69000, 4, 1, 0, 'Sản phẩm này có trọng lượng là 250 gram, nhẹ nhàng và dễ dàng mang theo khi cần thiết.\r\nChất liệu là dạng nén, giúp màu nước dễ dàng tan ra khi tiếp xúc với nước, tạo ra những đường nét màu sắc sống động.\r\nĐóng gói mỗi kiện bao gồm 12 màu nước và 01 cọ, đủ để bạn sử dụng cho các dự án vẽ và tô màu của mình.\r\nSản phẩm tuân thủ tiêu chuẩn châu Âu EN 71, đảm bảo an toàn và chất lượng cho người sử dụng.\r\nKích thước hộp của sản phẩm là 249 x 111 x 10 mm, còn kích thước của cọ là 140 mm, phù hợp để bạn bảo quản và sử dụng một cách thuận tiện.\"', '- Màu nước Colokit WACO-C001 có độ trong suốt cao.\r\n- Dạng nén tiện lợi, dễ dàng mang theo.', 0, '6e9eb3d85c.png'),
(52, '7 câu hỏi thần kỳ của mọi sếp giỏi', 1000, 150000, 150000, 6, 1, 0, 'Về sách The Coaching Habit – 7 câu hỏi “thần kỳ” của mọi sếp giỏi: Làm sao lãnh đạo nhân viên hiệu quả hơn? Tác giả Michael Bungay Stanier đã đặt ra câu hỏi này và tự trả lời bằng 7 câu hỏi “thần kỳ” mà các nhà quản lý nên thường xuyên đặt ra cho nhân viên để thay đổi thói quen lãnh đạo. Có rất nhiều cuốn sách về huấn luyện nhân viên bị người đọc gấp lại khi mới đọc được một nửa, nhưng The Coaching Habit – 7 câu hỏi “thần kỳ” của mọi sếp giỏi sẽ hấp dẫn bạn từ trang đầu đến trang cuối. Đây không chỉ là một cuốn sách mà còn là tiếng nói dẫn đường cho bạn, là người dẫn lối bạn vươn đến sự vĩ đại. Trở thành một nhà lãnh đạo giỏi huấn luyện nhân viên là một tư duy, một lối sống chứ không đơn thuần là một kỹ năng. Tác giả Michael đã truyền tải xuất sắc thông điệp này đến bạn đọc bằng nghệ thuật kể chuyện thú vị, những ví dụ thực tiễn và các phương pháp đã được kiểm chứng. Đây là cuốn sách phải đọc đối với những nhà lãnh đạo mong muốn kiến tạo sự khác biệt. Về tác giả Michael Bungay Stanier: Michael Bungay Stanier là nhà sáng lập, đồng thời là CEO của Box of Crayons, một công ty chuyên giúp các tổ chức trên toàn thế giới làm ít việc tốt hơn và nhiều công việc tuyệt vời hơn. Họ cung cấp cho các nhà quản lý bận rộn các công cụ để có thể huấn luyện nhân viên của mình trong vòng 10 phút hoặc ít hơn với chuyên môn cụ thể trong các lĩnh vực tài chính, dịch vụ chuyên nghiệp, dược phẩm và phân khúc hàng tiêu dùng. Michael thường xuyên nói chuyện với các khản giả trên toàn thế giới, trong đó có các buổi diễn thuyết tại Google, các hội nghị HRPA & SHRM, Hội thảo Phụ nữ nông thôn của Manibota và bất cứ nơi nào ở quê hương Toronto của ông.', '- Tác giả: Michael Bungay Stanier', 0, 'c89f07014c.png'),
(53, 'Ream giấy A5 70 gsm IK Copy (500 tờ) - Hàng nhập khẩu Indonesia', 1000, 44000, 44000, 5, 2, 0, 'Ream giấy A5 70 gsm IK Copy là sản phẩm giấy nhập khẩu từ Indonesia, mang lại chất lượng ổn định và đáng tin cậy. Với kích thước A5 và định lượng 70 gsm, sản phẩm này phục vụ cho nhu cầu in ấn và ghi chép hàng ngày của người dùng. \r\nQuy cách đóng gói 500 tờ / ream giúp đảm bảo người dùng có đủ giấy sử dụng trong một thời gian dài. Sản phẩm nên được bảo quản trong điều kiện nhiệt độ và độ ẩm nhất định để đảm bảo giấy luôn trong tình trạng tốt nhất.', '- Giấy đều màu.\r\n- Không gợn sóng, không xơ xước và không tách lớp.\r\n- Giấy láng, không bị đốm khác màu hay tạp chất xơ cứng.\r\n- Chữ in không bị nhòe, không lem kể cả in 2 mặt giấy.', 0, 'e870d59433.png'),
(54, 'Ream giấy IK Yellow đa năng A4 70 gsm (500 tờ) - Hàng nhập khẩu Indonesia', 1000, 86000, 86000, 5, 1, 0, 'Giấy IK Yellow đa dạng kích thước và định lượng, chất lượng hình ảnh sắc nét và rõ ràng; hạn chế xuyên thấu khi sao chép, in ấn tài liệu. IK Yellow thích hợp in 2 mặt và là sự lựa chọn lý tưởng cho hầu hết các thiết bị văn phòng như máy photocopy tốc độ cao, máy in phun, máy in lazer và máy fax.', '- Độ sáng cao 98%, độ trắng cao CIE 165.\r\n- Không kẹt giấy, độ bền tốt.\r\n- Thích hợp cho photocopy 2 mặt, độ chắn sáng cao hạn chế sự xuyên thấu.\r\n- Công nghệ Trutone cho màu sắc chân thật và hình ảnh sắc nét.', 0, '4ccaa70d6e.png'),
(55, 'Ream giấy A4 80 gsm IK Copy (500 tờ) - Hàng nhập khẩu Indonesia', 1000, 101000, 101000, 5, 1, 0, 'Ream giấy A4 80 gsm IK Copy là sản phẩm giấy nhập khẩu từ Indonesia, được đóng gói trong quy cách 500 tờ mỗi ream. Với độ dày 80 gsm và kích thước chuẩn A4, sản phẩm này phù hợp cho các nhu cầu in ấn và ghi chép hàng ngày. \r\nĐược sản xuất bởi thương hiệu IK, sản phẩm đảm bảo chất lượng và đáng tin cậy. Khuyến cáo bảo quản sản phẩm ở nhiệt độ từ 10 đến 55 độ C và độ ẩm từ 55 đến 95% RH để đảm bảo giấy luôn trong điều kiện tốt nhất.', '- Giấy đều màu.\r\n- Không gợn sóng, không xơ xước và không tách lớp.\r\n- Giấy láng, không bị đốm khác màu hay tạp chất xơ cứng.\r\n- Chữ in không bị nhòe, không lem kể cả in 2 mặt giấy.', 0, '8d2e13a335.png'),
(56, 'Ream giấy A3 70 gsm IK Copy (500 tờ)', 1000, 174000, 174000, 5, 2, 0, 'IK Copy là sự lựa chọn thích hợp cho mọi nhu cầu sử dụng. Thiết kế vượt trội chạy trên máy photocopy tốc độ cao, số lượng nhiều. Công nghệ Fast Copying ứng dụng trong IK Copy đã được kiểm chứng và tin dùng bởi chất lượng vận hành đồng bộ, không kẹt giấy.', '- Giấy đều màu.\r\n- Không gợn sóng, không xơ xước và không tách lớp.\r\n- Giấy láng, không bị đốm khác màu hay tạp chất xơ cứng.\r\n- Chữ in không bị nhòe, không lem kể cả in 2 mặt giấy.\r\n- Độ dày nâng cao, Độ chắn sáng cao, Độ mịn cải tiến, Hình ảnh sắc nét hơn.', 0, 'd7162dffc8.png'),
(57, 'Bài tập Tiếng Anh 9 Tập 1 (Không đáp án - Chương trình mới của Bộ GD&ĐT)', 1000, 42000, 42000, 6, 1, 0, 'Nhằm giúp các em học sinh có thêm tài liệu để ôn luyện và thực hành môn tiếng Anh 9 theo chương trình mới của Bộ Giáo Dục và Đào Tạo, chúng tôi biên soạn bộ sách Bài tập tiếng Anh 9. Bài tập tiếng Anh 9 gồm hai tập tương ứng với hai tập sách giáo khoa Tiếng Anh 9 của nhà xuất bản Giáo Dục Việt Nam hợp tác với Nhà Xuất bản Giáo dục Pearson. Bài tập tiếng Anh 9 - tập 1 gồm 6 đơn vị bài tập, được biên soạn theo sát nội dung của 6 đơn vị bài học trong sách Tiếng Anh 9 - tập 1. Mỗi đơn vị bài tập gồm 5 phần:', '- Phần A - Phonetics: các bài tập ngữ âm giúp củng cố khả năng phát âm và khả năng nhận biết các âm được phát âm giống nhau hoặc khác nhau. \r\n- Phần B - Vocabulary and Grammar: các bài tập về từ vựng và ngữ pháp giúp ôn luyện từ vựng và củng cố kiến thức ngữ pháp trong từng đơn vị bài học.\r\n- Phần C - Speaking: các bài tập đặt câu hỏi, hoàn tất đoạn hội thoại, sắp xếp đoạn hội thoại, v.v. giúp rèn luyện kỹ năng nói.\r\n- Phần D - Reading: các đoạn văn ngắn với các hình thức điền vào chỗ trống, chọn từ để điền vào chỗ trống, đọc và trả lời câu hỏi, đọc rồi viết T (true) hoặc F (false), v.v. giúp luyện tập và phát triển kỹ năng đọc hiểu.\r\n- Phần E - Writing: các bài tập viết câu hoặc viết đoạn văn giúp luyện tập kỹ năng viết. Sau phần bài tập của mỗi đơn vị bài tập có một bài kiểm tra (Test for Unit) và sau 3 đơn vị bài tập có một bài tự kiểm tra (Test Yourself) nhằm giúp các em ôn tập và củng cố kiến thức đã học.', 0, '5a39381d2c.png'),
(58, '35 Đề thi Tiếng Anh lớp 10 (Có đáp án)', 1000, 65000, 65000, 6, 1, 0, 'Nhằm giúp các em học sinh trung học cơ sở ôn luyện và làm quen với các dạng bài thi tuyển sinh vào lớp 10 môn tiếng anh, chúng tôi biên soạn “35 đề tiếng anh thi vào lớp 10”. Sách gồm 3 phần:', '- Phần căn bản: 20 đề, mỗi đề gồm 50-60 câu, kiểm tra kiến thức cơ bản theo chương trình tiếng anh khối trung học cơ sở của Bộ giáo dục và đào tạo.\r\n- Phần nâng cao: 15 câu, mỗi đề gồm 90-100 câu, kiểm tra kiến thức nâng cao, đặc biết về ngữ pháp, nhằm giúp các em ôn luyện để thi vào các trường chuyên hoặc lớp chuyên anh.\r\n- Một số đề thi tuyển sinh: gồm các đề thi tuyển sinh vào lớp 10 và lớp 10 chuyên anh từ năm học 2013–2014, 2014–2015, 2015-2016, 2016–2017, 2017–2018, 2018–2019 và 2019–2020.', 0, '98ada7f68e.png'),
(59, 'Sách kết nối', 1000, 220000, 220000, 6, 2, 0, 'Mạng xã hội tạo cho chúng ta áp lực phải tích cực hóa mọi chuyện. Bạn có thể đăng lên Facebook bức ảnh tươi cười trước tháp Eiffel, nhưng không ai biết thực tế chuyến đi đó đối với bạn khủng khiếp như thế nào.\r\nHàng trăm người theo dõi qua Instagram sẽ biết bạn gọi món gì trong bữa tối sang trọng tuần trước, nhưng chỉ những người có mối quan hệ đặc biệt với bạn mới biết bạn đang phải vật lộn với căn bệnh tiêu hóa suốt nhiều năm nay, hoặc biết trong bữa tối đó, bạn và người yêu đã bàn đến chuyện cùng nhau xây dựng tổ ấm hoặc cân nhắc những được mất của quyết định nghỉ việc.\r\nĐây chắc chắn là những chủ đề mà bạn sẽ không bao giờ đề cập với những người bạn trung học đã lâu không gặp hoặc những người đồng nghiệp chỉ thân thiết ở mức xã giao; đương nhiên, chúng cũng không phải là chủ đề thích hợp để trò chuyện cùng người cô mà bạn đến thăm hằng tuần. Nhưng những người có mối quan hệ đặc biệt với bạn sẽ biết điều gì đang thực sự xảy ra chỉ đơn giản vì họ hiểu bạn.\r\nCác mối quan hệ nằm trải dài trên một thang đo nhiều mức độ. Ở những mức độ thấp nhất, điều tồn tại giữa bạn và người kia là chỉ là mối liên hệ chứ không phải là sự kết nối. Nhưng khi mối quan hệ nằm ở đầu bên kia thang đo, bạn sẽ cảm thấy an toàn, được thấu hiểu, hỗ trợ, động viên và chấp nhận. \r\nỞ phần giữa thang đo, đó sẽ là những người cho bạn cảm giác gắn kết, nhưng trong số đó bạn chỉ muốn kết nối sâu sắc với một vài người. Câu hỏi đặt ra ở đây là: Làm thế nào để mối quan hệ của bạn với ai đó có thể tiến đến đầu bên kia của thang đo?', '- Những mối quan hệ đặc biệt hoàn toàn có thể được xây đắp, vun vén. Chúng sở hữu 6 dấu hiệu sau đây:\r\n- Bạn được hoàn toàn là chính mình, và người kia cũng vậy.\r\n- Cả hai bạn đều sẵn sàng thể hiện mặt mong manh và dễ bị tổn thương của mình trước mặt người kia.\r\n- Bạn tin người ấy sẽ không dùng những điều bạn chia sẻ để phản bội bạn.\r\n- Hai bạn có thể thành thật với nhau.\r\n- Hai bạn có thể giải quyết những xung đột theo tinh thần xây dựng.\r\n- Cả hai đều cam kết sẽ cùng nhau phát triển và trưởng thành.', 0, '7c02310526.png'),
(60, 'Ngữ pháp tiếng Anh', 1000, 89000, 89000, 6, 1, 0, 'Ngữ pháp Tiếng Anh với lần tái bản 2021 được tác giả Mai Lan Hương & Nguyễn Thanh Loan tổng hợp các chủ điểm ngữ pháp trọng yếu. Các chủ điểm ngữ pháp được trình bày rõ ràng, chi tiết.Sau mỗi chủ điểm ngữ pháp là phần bài tập nhằm giúp các bạn củng cố kiến thức đã học và có phần đáp án để giúp người học tự kiểm tra kết quả.', '- Cuốn sách này không chia theo chương và giải thích cặn kẽ từ lý thuyết cho đến từng ví dụ bài tập từ cơ bản đến nâng cao như cuốn Giải thích ngữ pháp Tiếng Anh.\r\n- Ngữ pháp Tiếng Anh được chia theo từng phân mục ngữ pháp: Tense, Sequence of tenses, Clauses and phrases, Expression of quantity, Styles (văn phong), Emphasis (dạng nhấn mạnh), The parts of speech (từ loại), Reported speech, The passive and active sentences, Sentences, Practice test và Đáp án bài tập.', 0, '0386f6bcc3.png'),
(61, 'Học gì để không thất nghiệp?', 1000, 96000, 96000, 6, 1, 0, 'Hai yếu tố quan trọng nhất có thể khiến việc học đại học của bạn diễn ra suôn sẻ hay không là thời gian và tiền bạc. Học đại học là một vụ đầu tư lớn với mục đích định hình tương lai của bạn, không chỉ trong sự nghiệp mà còn cả trong đời sống. Nếu không sớm nhận ra và sử dụng nguồn đầu tư đó một cách khôn ngoan, bạn sẽ tạo ra những thử thách không đáng có trong cuộc sống. \r\nĐầu tư vào đại học một cách khôn ngoan cũng sẽ mở ra những cơ hội bất ngờ cho bạn. Những sinh viên hiểu rõ về giá trị của học phí và xem đại học như một vụ đầu tư sẽ rời khỏi giảng đường với con đường sự nghiệp xán lạn. \r\nNgược lại, những ai coi 4 năm học đại học như một cuộc “cắm trại”, ai trả học phí cũng được, thường sẽ chật vật hơn rất nhiều sau khi ra trường. Họ cũng tốt nghiệp nhưng lại không có mục tiêu nghề nghiệp hoặc họ sẽ trở về quê, làm những công việc chỉ đủ tiền trang trải qua ngày. Học gì để không thất nghiệp? sẽ liệt kê những kỹ năng bạn cần trau dồi để thuyết phục nhà tuyển dụng chọn bạn, \r\ncũng như những công cụ bạn cần nắm trong tay để khiến những tổ chức nhận ra bạn là người phù hợp với vị trí họ đang tuyển dụng. Biết cách làm những việc cần làm chính là chìa khóa dẫn đến thành công trong công việc cũng như cuộc sống của bạn – và đó cũng là nội dung chính của quyển sách này.', '- Sách kỹ năng', 0, 'dfc2c68c4b.png'),
(62, 'Gói dụng cụ văn phòng trình ký', 1000, 268850, 283000, 7, 1, 0, '***Có thể thay thế sản phẩm tương đương nếu bất kỳ sản phẩm trong Combo hết hàng. Màu sản phẩm ngẫu nhiên.', '- Gói dụng cụ văn phòng trình ký, gồm:\r\n- 20 Cây bút bi, 05 Bút lông bảng, 05 Bút dạ quang, Giấy note, Miếng phân trang.', 0, '46f0e5222c.png'),
(63, 'Gói dụng cụ văn phòng phẩm tiện lợi DCVP01', 1000, 219450, 231000, 7, 2, 0, 'Gói dụng cụ văn phòng phẩm tiện lợi DCVP01 ', '- Gói dụng cụ văn phòng phẩm tiện lợi DCVP01 bao gồm :\r\n- 1 Gỡ kim Flexoffice FO-STR02\r\n- 1 Bộ bấm kim số 10 và kim bấm Flexoffice FO-ST02-S2\r\n- 2 Kẹp bướm Flexoffice 19mm FO-DC02\r\n- 2 Kẹp bướm Flexoffice 25mm FO-DC03\r\n- 2 Giấy ghi chú Flexoffice 3x3 FO-SN03\r\n- 5 Kẹp giấy Flexoffice FO-PAC01\r\n- 1 Bấm lỗ FO-PU01', 0, '1312f394a2.png'),
(64, 'Gói dụng cụ văn phòng phẩm tiện lợi DCVP04', 1000, 536085, 564300, 7, 1, 0, 'Gói dụng cụ văn phòng phẩm tiện lợi Flexoffice DCVP04', '- Gói dụng cụ văn phòng phẩm tiện lợi Flexoffice DCVP04 bao gồm :\r\n- 10 Bìa lá A4 Flexoffice FO-CH03\r\n- 100 Bìa lỗ A4 Flexoffice FO-CS03\r\n- 10 Bìa thông tin Flexoffice A4 FO-IF01\r\n- 4 Bìa cây Flexoffice FO-RC04\r\n- 10 Bìa Acco A4 Flexoffice FO-PPFFA4\r\n- 10 Bìa Report File A4 Flexoffice FO-RFA4\r\n- 10 Bìa nút F4 Flexoffice có in FO-CBF01', 0, '6071b4f38a.png'),
(65, 'Combo Xanh pastel dịu mát 08 món - Bộ dụng cụ học tập gồm Máy tính cầm tay Hot trend, sổ, bút trang trí, gôm, thước', 1000, 927770, 976600, 7, 1, 0, 'Combo dụng cụ học tập thể hiện cá tính - Tone Xanh pastel dịu mát - 08 món (Máy tính cầm tay Hot trend)', '- Bìa 30 lá A4 DB-002\r\n- Bìa nút màu Pastel F4 CBF-003\r\n- Máy tính khoa học Fx799VN, Sổ lò xo caro A5 MB-015 (màu ngẫu nhiên)\r\n- Bút lông Fiber Pen SWM-C008\r\n- Bút gel B FO-056\r\n- Gôm tẩy E-031 (màu ngẫu nhiên)\r\n- Thước nhựa 20 cm SR-010 (màu ngẫu nhiên).', 0, '38a4c5f8df.png'),
(66, 'Combo mỹ thuật gấu Pooh (5 món tiện dụng, nhân vật hoạt hình ngộ nghĩnh)', 999, 123500, 130000, 7, 2, 0, 'Combo mỹ thuật nhân vật hoạt hình gấu Pooh ngộ nghĩnh', '- Combo mỹ thuật nhân vật hoạt hình gấu Pooh ngộ nghĩnh, gồm: \r\n- Gôm\r\n- Tập tô màu\r\n- Thước\r\n- Bộ sáp 18 màu\r\n- Bút chì gỗ.', 1, '156b65ef99.png'),
(67, '[Combo Cấp 1] Trọn Bộ Dụng Cụ Học Tập Lớp 2 - 15 Món (Hộp đựng bút, Bút máy, Bút gel xoá được,...)', 1000, 400967, 422070, 7, 1, 0, '[Combo Cấp 1] Trọn Bộ Dụng Cụ Học Tập Lớp 2 - Nhập Học Năm Mới 2023 - 15 Món', '- [Combo Cấp 1] Trọn Bộ Dụng Cụ Học Tập Lớp 2-Nhập Học Năm Mới 2023-5 Món, gồm:\r\n- 01 Hộp viết\r\n- 01 Chuốt chì\r\n- 01 Kéo học sinh\r\n- 01 Bút máy\r\n- 01 Hộp sáp màu', 0, 'e5b7a033be.png'),
(68, 'Combo Mỹ Thuật tiện lợi 6 món – Set combo gồm bút lông màu, sáp màu, bút chì, chuốt, thước kẻ và gôm', 999, 402800, 424000, 7, 1, 0, 'Bộ dụng cụ mỹ thuật Colokit KIT-C014 với đầy đủ các dụng cụ cho các bé thích tô màu, vẽ tranh… Bộ sản phẩm rất thích hợp dùng làm quà tặng cho bé yêu, giúp bé có thể vừa chơi vừa học, kích thích sự sáng tạo của bé. Bộ sản phẩm với mẫu mã đẹp, tông màu tươi sáng phù hợp cho các bé.\r\nSản xuất đạt tiêu chuẩn theo tiêu chuẩn xuất khẩu sang Châu Âu.\r\nCác loại màu vẽ đảm bảo an toàn sức khỏe, màu vẽ không gây dị ứng cho da, không độc hại khi các bé lỡ ngậm phải.', '- Bộ dụng cụ mỹ thuật Colokit KIT-C014 gồm có:\r\n- 20 Bút lông màu- Fiber Pens\r\n- 24 Cây sáp màu Colokit\r\n- 02 Bút chì Neon\r\n- 1 Chuốt bút chì\r\n- 1 Thước kẻ 15cm\r\n- 1 Gôm tẩy', 1, '1e1175f900.png'),
(69, 'Bộ mỹ thuật cho bé từ 3-5 tuổi', 1000, 166364, 175120, 7, 1, 0, 'Bộ mỹ thuật cho bé từ 3-5 tuổi', '- Bộ mỹ thuật cho bé từ 3-5 tuổi, gồm:\r\n- Bìa nút F4\r\n- Vở vẽ A4\r\n- Chuốt chì\r\n- Gôm\r\n- Keo khô\r\n- Bút Chì gỗ\r\n- Giấy thủ công\r\n- Hộp sáp 24 màu\r\n- Bút lông 12 màu\r\n- Tập tô màu\r\n- Kéo học sinh.', 0, '5d87ddb387.png'),
(70, 'COMBO XANH DƯƠNG GIÚP BÉ HỌC NHANH HƠN VITAMIN - 1', 1000, 318725, 335500, 7, 2, 0, 'COMBO XANH DƯƠNG GIÚP BÉ HỌC NHANH HƠN VITAMIN - 1', '- BỘ COMBO XANH DƯƠNG GIÚP BÉ HỌC NHANH HƠN VITAMIN-1, bao gồm:\r\n- Bộ học cụ Colokit KIT-C01\r\n- Vở vẽ A4 Colokit SKB-C01\r\n- Bút sáp dầu Colokit OP-C017\r\n- Bút sáp màu Colokit CR-C038\r\n- 05 Bút Gel Điểm 10 xóa được TP-GELE01\r\n- Bảng bộ Điểm 10 B-015/DO\r\n- Xà phòng tiện lợi Thiên Long HS-002\r\n- Quà tặng Bút sáp màu Colokit CR-C035', 0, '30b4b37485.png');
INSERT INTO `tbl_product` (`productId`, `productName`, `productAmount`, `productPrice`, `productOldPrice`, `catId`, `productStyle`, `productColor`, `productDesc`, `productPro`, `productSold`, `productImage`) VALUES
(71, 'Combo 5 Ream giấy A5 70 gsm IK Copy (500 tờ) - Hàng nhập khẩu Indonesia', 1000, 209000, 220000, 7, 1, 0, 'Combo 5 Ream giấy A5 70 gsm IK Copy là sự kết hợp hoàn hảo giữa chất lượng và tính tiện lợi, giúp bạn tiết kiệm chi phí mà vẫn đảm bảo được nhu cầu sử dụng giấy trong công việc hàng ngày. ', '- Với các đặc điểm chung như kích thước A5 và định lượng 70 gsm, sản phẩm này phù hợp cho việc sử dụng trong văn phòng, giáo dục và các mục đích cá nhân khác.\r\n- Bạn sẽ có 5 ream giấy với mỗi ream có 500 tờ, tổng cộng là 2500 tờ giấy, giúp bạn không cần phải lo lắng về việc hết giấy trong một thời gian dài.\r\n- Đồng thời, giấy IK Copy nhập khẩu từ Indonesia, đảm bảo chất lượng và sự đa dạng trong sử dụng, phục vụ mọi nhu cầu của bạn. Điều này giúp bạn tiết kiệm thời gian và công sức khi mua sắm, đồng thời mang lại hiệu quả và tiện lợi trong công việc và học tập.', 0, '74a1ed0fbe.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_promote`
--

CREATE TABLE `tbl_promote` (
  `promoteId` int(9) NOT NULL,
  `promoteName` varchar(255) NOT NULL,
  `promoteStart` date NOT NULL,
  `promoteEnd` date NOT NULL,
  `promotePercent` tinyint(101) NOT NULL DEFAULT 0,
  `promoteKop` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_promote`
--

INSERT INTO `tbl_promote` (`promoteId`, `promoteName`, `promoteStart`, `promoteEnd`, `promotePercent`, `promoteKop`) VALUES
(7, '70 năm chiến thắng ĐBP', '2024-05-01', '2024-05-20', 10, 1),
(11, 'Quốc tế thiếu nhi', '2024-05-18', '2024-06-03', 8, 4),
(12, 'combo', '2024-05-20', '2024-06-03', 5, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_statistic`
--

CREATE TABLE `tbl_statistic` (
  `sta_id` int(11) NOT NULL,
  `sta_revenue` double NOT NULL,
  `sta_amount` int(11) NOT NULL,
  `sta_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_statistic`
--

INSERT INTO `tbl_statistic` (`sta_id`, `sta_revenue`, `sta_amount`, `sta_date`) VALUES
(1, 534000, 10, '2024-03-12'),
(2, 342000, 8, '2024-03-18'),
(3, 228900, 6, '2024-03-22'),
(4, 664600, 12, '2024-03-26'),
(5, 604600, 12, '2024-03-30'),
(6, 527000, 9, '2024-04-04'),
(7, 899000, 17, '2024-04-08'),
(8, 738500, 15, '2024-04-12'),
(9, 150000, 2, '2023-07-12'),
(10, 330000, 6, '2023-07-18'),
(11, 690000, 8, '2023-05-03'),
(12, 469000, 5, '2022-01-03'),
(13, 701000, 10, '2022-01-16'),
(14, 710000, 10, '2022-06-13'),
(15, 859000, 13, '2022-09-27'),
(16, 496000, 3, '2024-05-14'),
(17, 1100000, 20, '2024-01-04'),
(18, 889000, 16, '2024-01-08'),
(19, 900100, 18, '2024-01-12'),
(20, 600000, 11, '2024-01-16'),
(21, 736000, 16, '2024-01-20'),
(22, 680000, 14, '2024-01-24'),
(23, 803000, 10, '2024-01-28'),
(24, 1203000, 20, '2024-02-02'),
(25, 1500000, 22, '2024-02-06'),
(26, 1030000, 18, '2024-02-10'),
(27, 1800000, 19, '2024-02-14'),
(28, 1400000, 18, '2024-02-18'),
(29, 798000, 12, '2024-02-22'),
(30, 834000, 14, '2024-02-26'),
(31, 690000, 13, '2024-03-01'),
(32, 3680000, 21, '2024-03-05'),
(33, 2460000, 22, '2024-03-09'),
(34, 1700000, 20, '2024-03-13'),
(35, 1639000, 11, '2024-03-17'),
(36, 1000000, 18, '2024-03-21'),
(37, 1403000, 30, '2024-04-16'),
(38, 2440000, 26, '2024-04-20'),
(39, 2274000, 24, '2024-04-22'),
(40, 1589000, 18, '2024-04-26'),
(41, 1893400, 19, '2024-04-30'),
(42, 4500000, 32, '2024-05-01'),
(43, 3289000, 28, '2024-05-03'),
(44, 1394000, 14, '2024-05-05'),
(45, 1500800, 17, '2024-05-08'),
(46, 1930000, 21, '2024-05-11'),
(47, 2193500, 22, '2024-05-16'),
(48, 3189000, 36, '2024-05-17'),
(49, 4193400, 40, '2024-05-18'),
(50, 653000, 2, '2024-05-19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) UNSIGNED NOT NULL,
  `userName` varchar(50) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userPhone` varchar(30) NOT NULL,
  `userAddress` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `disable` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `userName`, `fullName`, `userEmail`, `userPhone`, `userAddress`, `password`, `disable`) VALUES
(1, 'kien1234', 'Nguyễn Đình Kiên', 'ndk241@gmail.com', '0987654321', 'số 20, Lĩnh Nam, Hoàng Mai, Hà Nội', 'e10adc3949ba59abbe56e057f20f883e', 0),
(8, 'user2', 'Nguyễn Đức Huy', 'huy@gmail.com', '0123456789', 'Nghệ An', 'e10adc3949ba59abbe56e057f20f883e', 0),
(9, 'user3', 'Ngô Quang Hiển', 'hien@gmail.com', '0858479123', 'Số 1, Ngõ 1, Từ Sơn, Bắc Ninh', '25d55ad283aa400af464c76d713c07ad', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`billId`),
  ADD KEY `userId` (`userId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Chỉ mục cho bảng `tbl_discount`
--
ALTER TABLE `tbl_discount`
  ADD PRIMARY KEY (`discountId`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `billId` (`billId`),
  ADD KEY `billId_2` (`billId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `catId` (`catId`);

--
-- Chỉ mục cho bảng `tbl_promote`
--
ALTER TABLE `tbl_promote`
  ADD PRIMARY KEY (`promoteId`);

--
-- Chỉ mục cho bảng `tbl_statistic`
--
ALTER TABLE `tbl_statistic`
  ADD PRIMARY KEY (`sta_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  MODIFY `billId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_discount`
--
ALTER TABLE `tbl_discount`
  MODIFY `discountId` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `tbl_promote`
--
ALTER TABLE `tbl_promote`
  MODIFY `promoteId` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_statistic`
--
ALTER TABLE `tbl_statistic`
  MODIFY `sta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `tbl_bill_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
