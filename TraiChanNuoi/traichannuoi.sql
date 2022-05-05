-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2022 lúc 09:12 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `traichannuoi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuatri`
--

CREATE TABLE `chuatri` (
  `ID` int(11) NOT NULL,
  `NgayChuaTri` datetime NOT NULL,
  `LoaiBenh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LoaiThuoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GhiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Chuong_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chuatri`
--

INSERT INTO `chuatri` (`ID`, `NgayChuaTri`, `LoaiBenh`, `LoaiThuoc`, `SoLuong`, `GhiChu`, `Chuong_ID`) VALUES
(2, '2022-04-19 00:00:00', 'Lở mồm long móng', 'Paracetamol - 10, panadol - 20', 12, NULL, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuong`
--

CREATE TABLE `chuong` (
  `ID` int(11) NOT NULL,
  `MaChuong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `NgayNhap` datetime DEFAULT NULL,
  `NhanVien_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chuong`
--

INSERT INTO `chuong` (`ID`, `MaChuong`, `SoLuong`, `NgayNhap`, `NhanVien_ID`) VALUES
(2, 'Chuong_01', 6, '2022-04-20 14:38:31', NULL),
(3, 'Chuong_02', 0, '2022-04-20 13:13:33', NULL),
(4, 'Chuong_03', 5, '2022-04-20 13:13:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_nhap`
--

CREATE TABLE `ct_nhap` (
  `ID` int(11) NOT NULL,
  `Giong_ID` int(11) NOT NULL,
  `Chuong_ID` int(11) NOT NULL,
  `Nhap_ID` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(65,0) NOT NULL,
  `Tong` decimal(65,0) NOT NULL,
  `CanNang` double(8,2) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_nhap`
--

INSERT INTO `ct_nhap` (`ID`, `Giong_ID`, `Chuong_ID`, `Nhap_ID`, `SoLuong`, `DonGia`, `Tong`, `CanNang`, `TinhTrang`) VALUES
(1, 2, 2, 1, 10, '1860000', '18600000', 380.00, 1),
(2, 3, 3, 2, 12, '2100000', '25200000', 80.00, 0),
(3, 4, 4, 2, 12, '2700000', '32400000', 120.00, 1),
(4, 3, 2, 3, 10, '2100000', '21000000', 140.00, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_xuat`
--

CREATE TABLE `ct_xuat` (
  `ID` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `TongTien` decimal(65,0) NOT NULL,
  `DonGia` decimal(65,0) NOT NULL,
  `TongCanNang` double(8,2) NOT NULL,
  `Xuat_ID` int(11) NOT NULL,
  `Chuong_ID` int(11) NOT NULL,
  `Giong_ID` int(11) DEFAULT NULL,
  `TinhTrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_xuat`
--

INSERT INTO `ct_xuat` (`ID`, `SoLuong`, `TongTien`, `DonGia`, `TongCanNang`, `Xuat_ID`, `Chuong_ID`, `Giong_ID`, `TinhTrang`) VALUES
(1, 5, '86400000', '48000', 360.00, 1, 2, 3, 1),
(2, 10, '597600000', '48000', 1245.00, 1, 3, 3, 1),
(3, 3, '66825000', '49500', 450.00, 2, 2, 2, 1),
(4, 2, '25740000', '49500', 260.00, 2, 4, 4, 1),
(5, 3, '45750000', '50000', 305.00, 3, 2, 2, 1),
(6, 2, '36000000', '50000', 360.00, 3, 3, 3, 1),
(7, 3, '50643000', '51000', 331.00, 4, 2, 2, 1),
(8, 5, '158100000', '51000', 620.00, 4, 4, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giong`
--

CREATE TABLE `giong` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gia` decimal(16,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giong`
--

INSERT INTO `giong` (`ID`, `Ten`, `Gia`) VALUES
(2, 'Heo Mini', '1860000'),
(3, 'Heo cỏ', '2100000'),
(4, 'Heo Ê Đê', '2700000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `ID` int(11) NOT NULL,
  `HoTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoiDung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TieuDe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayLH` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`ID`, `HoTen`, `Email`, `NoiDung`, `TieuDe`, `SDT`, `NgayLH`) VALUES
(1, 'Chu Chỉ Nhược', 'adminyugoshose@gmail.com', 'Chào admin.\r\nChúng tôi rất vui khi được hợp tác cùng các bạn. Hợp tác vui vẻ.\r\nCảm ơn bạn.', 'Hạch toán kinh tế chăn nuôi heo thịt công nghiệp trại 1000 con', '0778965634', '2022-04-23 15:42:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitin`
--

CREATE TABLE `loaitin` (
  `ID` int(11) NOT NULL,
  `Link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaitin`
--

INSERT INTO `loaitin` (`ID`, `Link`, `Ten`) VALUES
(2, 'ky-thuat-chan-nuoi', 'Kỹ thuật chăn nuôi'),
(3, 'thi-truong', 'Thị trường'),
(4, 'khoa-hoc-ky-thuat', 'Khoa học kỹ thuật');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_10_080244_create_giong_table', 1),
(3, '2022_04_10_080246_create_quyen_table', 1),
(4, '2022_04_10_080317_create_nhanvien_table', 1),
(5, '2022_04_10_080537_create_loaitin_table', 1),
(6, '2022_04_10_080637_create_tintuc_table', 1),
(7, '2022_04_10_080914_create_lienhe_table', 1),
(8, '2022_04_10_081330_create_nhap_table', 1),
(9, '2022_04_10_081659_create_chuong_table', 1),
(10, '2022_04_10_081913_create_xuat_table', 1),
(11, '2022_04_10_082119_create_ct_xuat_table', 1),
(12, '2022_04_10_082329_create_chuatri_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `ID` int(11) NOT NULL,
  `TaiKhoan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MatKhau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HoTen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GioiTinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DiaChi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Quyen_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`ID`, `TaiKhoan`, `MatKhau`, `HoTen`, `GioiTinh`, `Email`, `SDT`, `DiaChi`, `Status`, `remember_token`, `created_at`, `updated_at`, `Quyen_ID`) VALUES
(2, 'admin', '1234', 'Administrator', 'Nam', 'administrator', '0987654321', 'Sì gòn', 1, NULL, NULL, NULL, 1),
(3, 'truongtp', '1234', 'Trương Tam Phong', 'Nam', 'example@facebook.com', '0968456321', 'Hoàng Quốc Việt, Cầu Giấy, Hà Nội', 1, NULL, '2022-04-19 12:36:22', '2022-04-19 12:59:34', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap`
--

CREATE TABLE `nhap` (
  `ID` int(11) NOT NULL,
  `NgayNhap` datetime NOT NULL,
  `TongSL` int(11) NOT NULL,
  `TongTien` decimal(65,0) NOT NULL,
  `TongCanNang` double(16,0) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhap`
--

INSERT INTO `nhap` (`ID`, `NgayNhap`, `TongSL`, `TongTien`, `TongCanNang`, `TinhTrang`) VALUES
(1, '2022-04-20 09:44:43', 10, '18600000', 380, 1),
(2, '2022-04-20 13:13:33', 24, '57600000', 200, 1),
(3, '2022-04-20 14:38:31', 10, '21000000', 140, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `ID` int(11) NOT NULL,
  `TenQuyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GhiChu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`ID`, `TenQuyen`, `GhiChu`) VALUES
(1, 'admin', 'Quản trị viên'),
(2, 'staff', 'Nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `ID` int(11) NOT NULL,
  `TieuDe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Metatitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoiDung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayDang` datetime NOT NULL,
  `TrangThai` tinyint(1) NOT NULL,
  `LoaiTin_ID` int(11) NOT NULL,
  `NhanVien_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`ID`, `TieuDe`, `Metatitle`, `Anh`, `NoiDung`, `NgayDang`, `TrangThai`, `LoaiTin_ID`, `NhanVien_ID`) VALUES
(2, 'Hạch toán kinh tế chăn nuôi heo thịt công nghiệp trại 1000 con', 'hach-toan-kinh-te-chan-nuoi-heo-thit-cong-nghiep-trai-1000-con', 'ht-nuoi-heo.jpg', '<h2>Hiện nay chăn nu&ocirc;i heo thịt theo h&igrave;nh thức c&ocirc;ng nghiệp đang được b&agrave; con chăn nu&ocirc;i &aacute;p dụng rộng r&atilde;i v&agrave; mang lại hiệu quả kinh tế cao. Ng&agrave;nh chăn nu&ocirc;i heo nước ta đang dần lớn mạnh đ&aacute;p ứng xu thế cạnh tranh của thị trường ng&agrave;y c&agrave;ng lớn v&agrave; nhu cầu trong nước ng&agrave;y một tăng cao.</h2>\r\n\r\n<p>Chăn nu&ocirc;i heo theo h&igrave;nh thức c&ocirc;ng nghiệp đ&ograve;i hỏi người chăn nu&ocirc;i cần c&oacute; kinh nghiệm cũng như nắm được nhu cầu của thị trường chăn nu&ocirc;i.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sau một thời gian tiếp cận c&aacute;c trại chăn nu&ocirc;i tại khu vực Hưng Y&ecirc;n v&agrave; Hải Dương ch&uacute;ng t&ocirc;i đ&atilde; tổng hợp được những th&ocirc;ng tin hữu &iacute;ch, gi&uacute;p bạn đọc c&oacute; c&aacute;i nh&igrave;n cụ thể hơn về t&igrave;nh h&igrave;nh chăn nu&ocirc;i cũng như những rủi ro thường gặp của những hộ chăn&nbsp;<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">nu&ocirc;i heo</a>.</p>\r\n\r\n<p>Sau b&agrave;i viết hạch to&aacute;n kinh tế chăn&nbsp;<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">nu&ocirc;i heo</a>&nbsp;thịt tại n&ocirc;ng hộ, ch&uacute;ng t&ocirc;i tiếp tục đưa ra b&agrave;i viết hạch to&aacute;n chăn nu&ocirc;i heo thịt c&ocirc;ng nghiệp để bạn đọc c&oacute; c&aacute;i tổng quan hơn về ng&agrave;nh chăn&nbsp;<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">nu&ocirc;i heo</a>.</p>\r\n\r\n<p>Trong b&agrave;i viết n&agrave;y ch&uacute;ng t&ocirc;i chỉ hạch to&aacute;n chăn nu&ocirc;i heo thịt c&ocirc;ng nghiệp, với c&aacute;c chi ph&iacute; con giống, thức ăn, thuốc th&uacute; y&nbsp;m&agrave; kh&ocirc;ng đưa hạch to&aacute;n hao ph&iacute; trại cũng như c&aacute;c nguồn thu từ phụ phẩm chăn nu&ocirc;i.</p>\r\n\r\n<p><strong>1. Con giống</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Với chăn nu&ocirc;i heo thịt c&ocirc;ng nghiệp, do những chi ph&iacute; ban đầu cao n&ecirc;n con giống được sử dụng cần đ&ograve;i hỏi đ&aacute;p ứng được tốc độ ph&aacute;t triển cũng như tỷ lệ nạc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hiện nay c&aacute;c giống heo si&ecirc;u được sử dụng chủ yếu trong chăn nu&ocirc;i heo thịt chủ yếu c&oacute; m&aacute;u Pietran, Duroc, Landrace v&agrave; Yorkshire.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gi&aacute; một heo giống 10kg tại thị trường miền Bắc nước ta khoảng 1 - 1,4 triệu/con. Tại thị trường miền Nam gi&aacute; heo n&agrave;y khoảng 100.000đ/kg (heo &gt;20kg).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Như vậy gi&aacute; giống cho một đầu heo giống 10kg khoảng 1,2 triệu/con &rarr; Với quy m&ocirc; 1000 con heo thịt, chi ph&iacute; giống hết 1.200.000 x 1000 = 1.200.000.000đ (1)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>2. Thức ăn</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Với heo giống được bắt ở 10kg ta vẫn cần &uacute;m heo trong 15 ng&agrave;y đầu sau khi bắt.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thức ăn cần thiết cho heo thịt c&ocirc;ng nghiệp theo khuyến c&aacute;o của c&aacute;c c&ocirc;ng ty thức ăn chăn nu&ocirc;i gồm:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Thức ăn hỗn hợp cho heo con: với 1 heo giai đoạn n&agrave;y sử dụng hết 25kg thức ăn với gi&aacute; 18.00đ/kg &rarr; tiền thức ăn giai đoạn n&agrave;y 450.000đ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Thức ăn hỗn hợp cho heo giai đoạn heo thịt: giai đoạn nu&ocirc;i thịt heo sử dụng khoảng 125kg với gi&aacute; 13.200đ/kg &rarr; 1.650.000đ .</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Thức ăn hỗn hợp cho heo giai đoạn xuất b&aacute;n: heo giai đoạn n&agrave;y thường sử dụng khoảng 25kg thức ăn c&oacute; gi&aacute; khoảng 12.000đ/kg &rarr; số tiền thức ăn hết 300.000đ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sản xuất một heo thịt từ 10kg tới 100kg hơi chi ph&iacute; thức ăn l&agrave;: 450.000 + 1.650.000 +300.000 = 2.400.00đ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&rarr; Để nu&ocirc;i 1000 heo thịt theo phương thức an to&agrave;n sinh học (c&ugrave;ng v&agrave;o c&ugrave;ng ra) chi ph&iacute; thức ăn khoảng 2.400.000 x 1000 = 2.400.000.000đ (2).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>3. Thuốc th&uacute; y</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trong chăn nu&ocirc;i hiện nay vai tr&ograve; của th&uacute; y chiếm một vị thế quan trọng v&agrave; kh&ocirc;ng thể thiếu trong chăn nu&ocirc;i hiện nay.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Với quy tr&igrave;nh ph&ograve;ng bệnh hiện nay chi ph&iacute; cho 1 heo nu&ocirc;i thịt từ l&uacute;c 10kg tới khi xuất chuồng khoảng 180.000đ/con trong đ&oacute; chi ph&iacute; vaccine khoảng 80.000đ (10.000đ vaccine dịch tả, 25.000đ vaccine suyễn, 30.000đ vaccine PRRS, 25.000đ vaccine LMLM), 100.000đ chi ph&iacute; cho việc ph&ograve;ng kh&aacute;ng sinh v&agrave; thuốc bổ cho heo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&rarr; Như vậy để nu&ocirc;i 1000 heo thịt chi ph&iacute; thuốc th&uacute; y khoảng 180.000.000đ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ngo&agrave;i ra trại cần thiết c&oacute; 1 kỹ thuật, hiện nay trả lương cho 1 kỹ thuật khoảng 5.000.000đ/th&aacute;ng. Một lứa heo khoảng 4 th&aacute;ng &rarr; chi ph&iacute; cho kỹ thuật 4 x 5.000.000 = 20.000.000đ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tổng chi ph&iacute; th&uacute; y khoảng 180.000.000 + 20.000.000 = 200.000.000đ (3)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>4. Chi ph&iacute; nh&acirc;n c&ocirc;ng</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Với trại quy m&ocirc; 1000 heo thịt cần 2 c&ocirc;ng nh&acirc;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lương trả cho 1 c&ocirc;ng nh&acirc;n khoảng 3.000.000đ/th&aacute;ng &rarr; 2 c&ocirc;ng nh&acirc;n 6.000.000đ/th&aacute;ng &rarr; 6.000.000 x 4 = 24.000.000đ (4)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>5. Chi ph&iacute; điện nước</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Chi ph&iacute; tiền điện nước để vận h&agrave;nh trại gồm c&oacute;, điện thắp s&aacute;ng, điện &uacute;m heo, điện chạy d&agrave;n m&aacute;t, quạt . . . tất cả chi ph&iacute; tr&ecirc;n với trại k&iacute;n quy m&ocirc; 1000 heo thịt khoảng 5.000.000đ/th&aacute;ng.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Một lứa heo nu&ocirc;i khoảng gần 4 th&aacute;ng, như vậy chi ph&iacute; tiền điện hết khoảng 4x 5.000.000 = 20.000.000đ (5)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&rarr; Tổng chi ph&iacute; trong chăn nu&ocirc;i heo thịt c&ocirc;ng nghiệp chưa t&iacute;nh tới hao ph&iacute; chu&ocirc;ng nu&ocirc;i l&agrave;: (1) + (2) + (3) + (4) + (5 ) = 3.800.000.000đ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>6. Tổng thu</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tiền thu từ b&aacute;n heo: 100kg/1heo với gi&aacute; hiện nay khoảng 50.000đ/kg. Với trại quy m&ocirc; c&ocirc;ng nghiệp nu&ocirc;i 1000 con tỷ lệ chết khoảng 5%.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Như vậy ta c&oacute; thể t&iacute;nh thu từ việc b&aacute;n heo như sau. (1000 x 95%) x 100 x 50.000 = 4.750.000.000đ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"Hạch toán chăn nuôi lợn\" src=\"https://nguoichannuoi.vn/upload_images/images/kien-thuc-nha-nong/hach-toan.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Như vậy chăn nu&ocirc;i heo thịt theo hướng c&ocirc;ng nghiệp, giảm chi ph&iacute; v&agrave; n&acirc;ng cao hiệu quả kinh tế trong chăn nu&ocirc;i.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Với 1000 heo thịt, mỗi lứa tiền lời khoảng 4.750.000.000 &ndash; 3.800.000.000 = 950.000.000đ. Tuy nhi&ecirc;n trong b&agrave;i viết n&agrave;y ch&uacute;ng t&ocirc;i chưa t&iacute;nh tới khấu hao chuồng trại, rủi ro trong chăn nu&ocirc;i, l&atilde;i ng&acirc;n h&agrave;ng khi huy động vốn v&agrave; nhiều chi ph&iacute; ph&aacute;t sinh kh&aacute;c.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trong b&agrave;i viết n&agrave;y tất cả c&aacute;c số liệu đều được tham khảo thực tế chăn nu&ocirc;i th&aacute;ng 12/2014. Khi &aacute;p dụng v&agrave;o điều kiện chăn nu&ocirc;i mỗi trang trại ta c&oacute; số liệu chi ph&iacute; tại mỗi thời điểm v&agrave; mỗi trại l&agrave; kh&aacute;c nhau v&igrave; vậy cần c&oacute; sự thay đổi sao cho ph&ugrave; hợp với mỗi trại.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Việc chăn nu&ocirc;i heo thịt theo hướng c&ocirc;ng nghiệp với chi ph&iacute; cố định lớn nhưng hiệu quả kinh tế cao do thời gian chăn nu&ocirc;i thấp khoảng hơn 3 th&aacute;ng v&agrave; gi&aacute; heo b&aacute;n được lớn hơn rất nhiều so với gi&aacute; heo tại n&ocirc;ng hộ (heo lai).Việc chuyển hướng sang sử dụng c&aacute;c giống heo ngoại (heo si&ecirc;u) cho năng xuất cao đang được rất nhiều hộ chăn nu&ocirc;i sử dụng đ&atilde; mang lại hiệu quả kinh tế cao.</p>', '2022-04-19 20:29:32', 1, 2, NULL),
(3, 'Quản lý dịch bệnh trong giai đoạn úm heo', 'quan-ly-dich-benh-trong-giai-doan-um-heo', 'um-heo.jpg', '<h2>Heo con giai đoạn theo mẹ chủ yếu bị ảnh hưởng nặng do quản l&yacute;, chăm s&oacute;c, nu&ocirc;i dưỡng tuy nhi&ecirc;n cũng c&oacute; kh&ocirc;ng &iacute;t c&aacute;c t&aacute;c nh&acirc;n g&acirc;y bệnh c&oacute; ảnh hưởng tới heo trong giai đoạn n&agrave;y.Việc quản l&yacute; chăm s&oacute;c heo con trong giai đoạn n&agrave;y rất qua trọng, đặc biệt l&agrave; kỹ thuật &uacute;m heo gi&uacute;p giảm thiểu c&aacute;c t&aacute;c nh&acirc;n g&acirc;y bệnh ảnh hưởng tới sức khỏe đ&agrave;n heo.</h2>\r\n\r\n<p>Việc chăm s&oacute;c nu&ocirc;i dưỡng heo con giai đoạn theo mẹ để giảm thiểu hiện tượng heo con bị ốm, chết hay ph&aacute;t triển kh&ocirc;ng b&igrave;nh thường ch&uacute;ng ta cần ch&uacute; &yacute; tới c&aacute;c nguy&ecirc;n nh&acirc;n sau: Heo mẹ, t&aacute;c nh&acirc;n m&ocirc;i trường, c&aacute;c t&aacute;c nh&acirc;n g&acirc;y bệnh.</p>\r\n\r\n<p><br />\r\nHeo mẹ ảnh hưởng tới heo con giai đoạn n&agrave;y l&agrave; c&oacute; thể do: Trong thời gian mang thai, heo mẹ bị bệnh suy dinh dưỡng, c&aacute;c bệnh truyền nhiễm như: dịch tả, ph&oacute; thương h&agrave;n,&nbsp;Aujeszky, leptospirosis, brucellosis, PRRS&hellip; Trong thời gian nu&ocirc;i con; do heo mẹ mắc hội chứng MMA, bệnh s&ocirc;́t hậu sản hiện tượng sót nhau &hellip; hay do thay đổi thức ăn</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>C&aacute;c t&aacute;c nh&acirc;n tr&ecirc;n g&acirc;y ảnh hưởng lớn tới heo mẹ dẫn tới nguồn sữa cung cấp cho heo con kh&ocirc;ng ổn định hoặc mất hẳn, l&agrave;m rối loạn ti&ecirc;u h&oacute;a dẫn tới hiện tượng ti&ecirc;u chảy tr&ecirc;n heo con, đối với việc hiện tượng n&agrave;y cần ch&uacute; &yacute; đặc biệt tới việc chăm s&oacute;c nu&ocirc;i dưỡng hợp l&yacute; heo mẹ trong giai đoạn mang thai v&agrave; cho con b&uacute;. Đặc biệt ch&uacute; &yacute; tới việc ph&ograve;ng bệnh cho heo mẹ v&agrave; sử dụng thức ăn hợp l&yacute; cho heo mẹ, với heo mẹ giai đoạn cho con b&uacute; cần cho heo mẹ ăn tự do (kh&ocirc;ng hạn chế heo mẹ ăn) mức trung b&igrave;nh&nbsp;m&agrave; heo&nbsp;mẹ c&oacute; thể ăn được trong giai đoạn n&agrave;y l&agrave; 4 - 6kg thức ăn hỗn hợp.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>C&ocirc;ng thức t&iacute;nh lượng thức ăn cho heo mẹ</strong></p>\r\n\r\n<hr />\r\n<ul>\r\n	<li>Thức ăn cho heo mẹ = thức ăn cho heo mẹ duy tr&igrave; cơ thể + thức ăn cho việc tiết sữa nu&ocirc;i con</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Heo mẹ cần 1,8kg thức ăn hỗn hợp duy tr&igrave; cơ thể.</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Để nu&ocirc;i 1 heo con heo mẹ cần ăn 0,3kg thức ăn hỗn hợp</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Như vậy thức ăn cần thiết trong qu&aacute; tr&igrave;nh heo mẹ nu&ocirc;i con l&agrave;: 1,8 + 0,3 x n (n l&agrave; số heo con trong ổ)</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>VD để nu&ocirc;i một đ&agrave;n 10 heo con cần cho heo mẹ ăn 1,8 + 0,3 x10 = 4,8 kg thức ăn hỗn hợp</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ngo&agrave;i c&aacute;c yếu tố tr&ecirc;n c&ograve;n c&oacute; một số yếu tố quan trọng nữa m&agrave; ch&uacute;ng ta cần quan t&acirc;m đ&oacute; l&agrave; vấn đề về c&aacute;c mầm bệnh thường trực, dễ mắc cho<u>&nbsp;</u><a href=\"http://nguoichannuoi.com/heo-cfm99.html\">heo</a>&nbsp;trong giai đoạn n&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://nguoichannuoi.com/heo-cfm99.html\">Heo con theo mẹ</a>&nbsp;rất mẫn cảm với c&aacute;c điều kiện m&ocirc;i trường do vậy việc chăm s&oacute;c kh&ocirc;ng đ&uacute;ng kỹ thuật sẽ dẫn tới việc heo con mắc phải những bệnh th&ocirc;ng thường g&acirc;y ra hiện tượng ti&ecirc;u chảy như E.coli, PED, cầu tr&ugrave;ng, TGE, Rotavirus . . . tuy nhi&ecirc;n việc xử l&yacute; trong giai đoạn n&agrave;y gặp rất nhiều kh&oacute; khăn do heo con chưa ho&agrave;n thiện hệ thống ti&ecirc;u h&oacute;a, sức đề kh&aacute;ng c&ograve;n yếu trước c&aacute;c t&aacute;c nh&acirc;n m&ocirc;i trường.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>-&nbsp;Bệnh E.coli</strong>&nbsp;l&agrave; bệnh phổ biến với&nbsp;<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">heo con theo mẹ</a>&nbsp;kh&ocirc;ng được chăm s&oacute;c nu&ocirc;i dưỡng tốt. Nguy&ecirc;n nh&acirc;n l&agrave; do vi khuẩn E.coli c&oacute; trong ruột của heo g&acirc;y ra. C&aacute;c biểu hiện đặc trưng của bệnh l&agrave; ti&ecirc;u chảy ph&acirc;n trắng, ph&acirc;n trắng v&agrave; c&oacute; th&ecirc;m bọt. Heo con kh&ocirc;ng chịu b&uacute; mẹ dẫn tới bệnh c&agrave;ng th&ecirc;m trầm trọng.</p>\r\n\r\n<p>Ta c&oacute; thể xử l&yacute; bằng c&aacute;ch cho heo con uống Colistin, Amoxicillin,Ampicilin, Lincomycin nặng c&oacute; thể ti&ecirc;m cho heo tuy nhi&ecirc;n n&ecirc;n hạn chế v&igrave; ảnh hưởng tới sự ph&aacute;t triển của heo ở c&aacute;c giai đoạn sau.</p>\r\n\r\n<h2><strong>- Bệnh PED</strong>&nbsp;l&agrave; bệnh do Coronavirus g&acirc;y ra l&agrave;m ảnh hưởng nặng nề tới heo con, bệnh c&oacute; tỷ lệ chết rất cao.</h2>\r\n\r\n<p>C&aacute;c biểu hiện của bệnh</p>\r\n\r\n<p>&nbsp;+ Lười b&uacute;.</p>\r\n\r\n<p>+ N&ocirc;n mửa.</p>\r\n\r\n<p>+ Ph&acirc;n lỏng, c&oacute; m&agrave;u v&agrave;ng, c&oacute; sữa kh&ocirc;ng ti&ecirc;u v&agrave; m&ugrave;i rất tanh.</p>\r\n\r\n<p>+ Heo con sụt c&acirc;n nhanh do mất nước, heo con th&iacute;ch nằm l&ecirc;n bụng mẹ.</p>\r\n\r\n<p>+&nbsp;L&acirc;y lan rất nhanh (gần như 100%), chết trong 3-4 ng&agrave;y, x&aacute;c gầy</p>\r\n\r\n<p><br />\r\nĐối với PED việc sử dụng thuốc kh&aacute;ng sinh để điều trị ti&ecirc;u chảy thường kh&ocirc;ng hiệu quả&nbsp;ta c&oacute; thể sử dụng vaccine chuồng để hạn chế sự l&acirc;y lan của bệnh&nbsp;</p>\r\n\r\n<h2><strong>- Bệnh cầu tr&ugrave;ng heo&nbsp;con</strong>&nbsp;do k&yacute; sinh tr&ugrave;ng Isospora suis, thuộc nh&oacute;m protozoa nội b&agrave;o g&acirc;y ra, thường xảy ra đối với c&aacute;c trại c&oacute; quy tr&igrave;nh vệ sinh k&eacute;m v&agrave; mật độ nu&ocirc;i cao, độ ẩm&nbsp;chuồng cao.</h2>\r\n\r\n<p><br />\r\n+ Đầu ti&ecirc;n heo ti&ecirc;u chảy ph&acirc;n sệt, sau đ&oacute; trở n&ecirc;n lỏng (c&oacute; thể lẫn bọt) thường c&oacute; m&agrave;u trắng sữa.</p>\r\n\r\n<p>+ Ti&ecirc;u chảy k&eacute;o d&agrave;i 5-6 ng&agrave;y, ph&acirc;n c&oacute; m&agrave;u trắng chuyển dần sang m&agrave;u v&agrave;ng, nhưng cũng c&oacute; khi c&oacute; m&agrave;u n&acirc;u nhạt hoặc hơi x&aacute;m, ph&acirc;n ti&ecirc;u chảy thường mịn v&agrave; c&oacute; dịch nh&agrave;y.</p>\r\n\r\n<p>+ Heo nhiễm bệnh nặng, x&ugrave; l&ocirc;ng, gầy ốm, heo mất nước, mệt mỏi nhưng vẫn b&uacute;</p>\r\n\r\n<p>+ Tỉ lệ chết do bệnh cầu tr&ugrave;ng thấp (khoảng 20% heo mắc bệnh) nhưng l&agrave;m tăng trưởng k&eacute;m cho heo con cả giai đoạn trước v&agrave; sau cai sữa.</p>\r\n\r\n<p><br />\r\nViệc xử l&yacute; cầu tr&ugrave;ng thường c&oacute; ti&ecirc;n lượng tốt khi sử dụng Toltrazuril cho uống.</p>\r\n\r\n<p><br />\r\n- Ngo&agrave;i ra c&aacute;c nguy&ecirc;n nh&acirc;n do TGE, Clostridium, Rotavirus thường &iacute;t gặp trong giai đoạn n&agrave;y, ch&uacute;ng thường xuất hiện khi m&ocirc;i trường chăn nu&ocirc;i kh&ocirc;ng ph&ugrave; hợp như thiếu nhiệt trong m&ugrave;a đ&ocirc;ng, bị gi&oacute; l&ugrave;a . . .</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>C&aacute;c t&aacute;c nh&acirc;n tr&ecirc;n g&acirc;y thiệt hại nặng nề cho chăn nu&ocirc;i heo dẫn tới việc heo con ph&aacute;t triển kh&ocirc;ng đồng đều, thiệt hại đầu con v&agrave; lưu cữu mầm bệnh trong m&ocirc;i trường nu&ocirc;i.</p>\r\n\r\n<p><br />\r\nNgo&agrave;i ra c&aacute;c t&aacute;c nh&acirc;n tr&ecirc;n yếu tố dinh dưỡng trong giai đoạn cuối của giai đoạn n&agrave;y cũng ảnh hưởng sự ph&aacute;t triển của heo.</p>\r\n\r\n<p><br />\r\nViệc cung cấp thiếu nước sạch cho heo con cũng l&agrave; một nguy&ecirc;n nh&acirc;n dẫn tới hiện tượng ti&ecirc;u chảy tr&ecirc;n heo con.</p>\r\n\r\n<p><br />\r\n<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">Chăm s&oacute;c heo&nbsp;</a>con giai đoạn theo mẹ việc giữ ấm, kh&ocirc; v&agrave; sạch l&agrave; 3 yếu tố h&agrave;ng đầu v&agrave; quan trọng nhất quyết định th&agrave;ng c&ocirc;ng trong chăn nu&ocirc;i heo con. Ngo&agrave;i ra c&ocirc;ng t&aacute;c ph&ograve;ng bệnh cũng cần ch&uacute; &yacute; tới.</p>\r\n\r\n<p><br />\r\nNhư vậy ngo&agrave;i việc chăm s&oacute;c quản l&yacute;<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">&nbsp;heo con giai đoạn theo mẹ</a>, ta cần ch&uacute; &yacute; tới c&aacute;c nguy&ecirc;n nh&acirc;n dẫn tới heo con bị nhiễm c&aacute;c t&aacute;c nh&acirc;n b&ecirc;n ngo&agrave;i g&acirc;y hiện tượng ti&ecirc;u chảy, mất nước, giảm chất lượng con giống, ảnh hưởng tới c&aacute;c giai đoạn chăn nu&ocirc;i sau v&agrave; g&acirc;y thiệt hại kinh tế nặng nề.</p>', '2022-04-19 20:30:59', 1, 2, NULL),
(4, 'Giảm tỷ lệ protein thô khẩu phần giúp giảm chi phí thức ăn', 'giam-ty-le-protein-tho-khau-phan-giup-giam-chi-phi-thuc-an', 'cho-heo-an.jpg', '<h2>Những lợi &iacute;ch của khẩu phần thức ăn c&oacute; mức protein th&ocirc; thấp hơn mức khuyến nghị dinh dưỡng chuẩn được t&aacute;i thẩm định trong thời gian gần đ&acirc;y khi gi&aacute; cả nguy&ecirc;n liệu thức ăn chăn nu&ocirc;i tăng cao tr&ecirc;n to&agrave;n thế giới.</h2>\r\n\r\n<p>Những tiến bộ đạt được trong hai thập kỷ qua ở lĩnh vực di truyền học đ&atilde; tạo ra những d&ograve;ng heo hiện đại với t&iacute;nh trạng ph&aacute;t triển nhanh hơn, t&iacute;ch lũy nhiều protein v&agrave; &iacute;t mỡ hơn, mang lại một quầy thịt với độ nạc cao hơn. Đồng thời, ch&uacute;ng cũng c&oacute; khả năng ăn v&agrave;o tốt hơn, tạo điều kiện cho ch&uacute;ng thu nạp lượng thức ăn cao hơn mỗi bữa, thậm ch&iacute; ngay từ những ng&agrave;y đầu ti&ecirc;n của cuộc sống.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trong năm năm qua, gi&aacute; cả của c&aacute;c loại ngũ cốc v&agrave; c&aacute;c nguồn thực liệu cung protein đ&atilde; tăng 30-40%, v&agrave; điều n&agrave;y đ&atilde; buộc c&aacute;c chuy&ecirc;n gia dinh dưỡng xem x&eacute;t lại c&ocirc;ng thức dinh dưỡng theo hướng kinh tế nhất thay v&igrave; mục đ&iacute;ch tăng trọng cao nhất như trước đ&acirc;y. C&oacute; hai yếu tố quan trọng nhất cần được đồng thời c&acirc;n nhắc khi thiết lập loại khẩu phần mới, thỏa m&atilde;n t&igrave;nh h&igrave;nh kinh tế hiện tại. Hai yếu tố đ&oacute; l&agrave; tiềm năng di truyền v&agrave; chi ph&iacute; thức ăn. Mỗi yếu tố đ&ograve;i hỏi một c&aacute;ch tiếp cận kh&aacute;c nhau, sao cho c&aacute;c c&ocirc;ng thức khẩu phần c&oacute; chi ph&iacute; thấp nhất để đảm bảo lợi nhuận nhưng vẫn thỏa m&atilde;n y&ecirc;u cầu chất lượng thịt của người ti&ecirc;u d&ugrave;ng v&agrave; đồng thời cũng kh&ocirc;ng l&atilde;ng ph&iacute; tiềm năng di truyền của giống<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">&nbsp;heo</a>&nbsp;cao sản.</p>\r\n\r\n<p><strong>Khuyến nghị của c&aacute;c nh&agrave; cung cấp giống heo</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nhiều nh&agrave; cung cấp giống ng&agrave;y nay đề nghị khẩu phần<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">&nbsp;heo</a>&nbsp;với mức protein th&ocirc;, mức lysine ti&ecirc;u h&oacute;a thấp hơn so với chuẩn thường d&ugrave;ng trước đ&acirc;y, trong khi vẫn duy tr&igrave; mức năng lượng cao, cho tất cả c&aacute;c giai đoạn ph&aacute;t triển của heo thịt. Điều n&agrave;y xuất ph&aacute;t từ khả năng ti&ecirc;u thụ thức ăn nhiều hơn của c&aacute;c giống heo hiện đại, do đ&oacute; mặc d&ugrave; mức protein v&agrave; lysine giảm nhưng do ăn nhiều n&ecirc;n heo vẫn nhận được đủ mức dinh dưỡng theo nhu cầu h&agrave;ng ng&agrave;y cho mục đ&iacute;ch duy tr&igrave; v&agrave; tăng trưởng cơ thể.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tuy nhi&ecirc;n, h&agrave;m lượng của c&aacute;c axit amin (nồng độ c&aacute;c axit amin kh&aacute;c so với mức lysine) trong loại khẩu phần n&agrave;y vẫn c&ograve;n l&agrave; một vấn đề g&acirc;y tranh c&atilde;i. Hướng dẫn h&agrave;m lượng dinh dưỡng từ c&aacute;c c&ocirc;ng ty cung cấp giống heo kh&aacute;c nhau rất nhiều, đặc biệt l&agrave; khi n&oacute;i đến tỷ lệ axit amin. Kh&aacute; thường xuy&ecirc;n, c&aacute;c chuy&ecirc;n gia dinh dưỡng thường được y&ecirc;u cầu x&acirc;y dựng khẩu phần ch&iacute;nh x&aacute;c theo hướng dẫn của mỗi nh&agrave; cung cấp giống. Nhưng khi thỏa m&atilde;n những y&ecirc;u cầu dinh dưỡng như vậy, th&igrave; người chăn&nbsp;<a href=\"http://nguoichannuoi.com/heo-cfm99.html\">nu&ocirc;i heo</a>&nbsp;thường kh&ocirc;ng c&oacute; lợi nhuận tốt v&igrave; gi&aacute; thức ăn theo đ&oacute; l&agrave; qu&aacute; cao, đ&oacute; l&agrave; chưa kể sự lỗ l&atilde; do những nguy&ecirc;n nh&acirc;n hay bệnh tật kh&aacute;c g&acirc;y ra l&agrave;m cho hiệu suất tăng trọng k&eacute;m.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lợi &iacute;ch của protein khẩu phần ở mức vừa phải</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trước hết, khẩu phần c&oacute; protein th&ocirc; ở mức vừa phải v&agrave; tỷ lệ c&aacute;c axit amin c&acirc;n đối sẽ gi&uacute;p đảm bảo kh&ocirc;ng c&oacute; sự dư thừa protein khi thức ăn đi qua phần ruột non, v&agrave;o ruột gi&agrave; v&agrave; trở th&agrave;nh cơ chất cho c&aacute;c vi sinh vật trong ruột gi&agrave; l&ecirc;n men. Sở dĩ việc dư thừa protein v&agrave; l&ecirc;n men ở ruột gi&agrave; l&agrave; kh&ocirc;ng tốt v&igrave; g&acirc;y l&atilde;ng ph&iacute; chất dinh dưỡng, v&agrave; v&igrave; qu&aacute; tr&igrave;nh l&ecirc;n men ngăn cản khả năng hấp thu nước của đại tr&agrave;ng. Kết quả l&agrave; th&uacute; thường đi ph&acirc;n nh&atilde;o v&agrave; nghi&ecirc;m trọng hơn l&agrave; ti&ecirc;u chảy trong một số trường hợp. Dựa tr&ecirc;n kinh nghiệm thực tế, khẩu phần heo thịt c&oacute; mức protein th&ocirc; vừa phải, thường gi&uacute;p giảm đ&aacute;ng kể tỷ lệ &nbsp;ti&ecirc;u chảy m&agrave; kh&ocirc;ng biết nguy&ecirc;n nh&acirc;n cũng như giảm hiện tượng l&ograve;i trực tr&agrave;ng. Kết quả l&agrave; c&oacute; một sự cải thiện đ&aacute;ng kể về hiệu quả chuyển h&oacute;a thức ăn, độ đồng đều của heo v&agrave; lợi nhuận tổng thể.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ngo&agrave;i ra, bằng chứng nghi&ecirc;n cứu mới cho thấy c&oacute; một mối quan hệ t&iacute;ch cực giữa mức protein th&ocirc; khẩu phần thấp v&agrave; đặc điểm chất lượng thịt tăng, chẳng hạn như tăng h&agrave;m lượng mỡ trong nạc ở thịt thăn lưng v&agrave; m&ocirc;ng đ&ugrave;i, v&agrave; giảm độ d&agrave;y mỡ lưng. Tất nhi&ecirc;n, điều n&agrave;y c&ograve;n phụ thuộc v&agrave;o chất lượng của giống heo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sau hết, cũng n&ecirc;n được đề cập rằng khẩu phần chứa lượng protein vừa phải c&ograve;n gi&uacute;p l&agrave;m giảm b&agrave;i tiết nitơ ra m&ocirc;i trường đến 30-50%, t&ugrave;y thuộc v&agrave;o th&ocirc;ng số kỹ thuật ban đầu, th&agrave;nh phần thực liệu. N&oacute;i chung, tỷ lệ mỗi đơn vị % protein th&ocirc; giảm đi trong khẩu phần sẽ gi&uacute;p giảm b&agrave;i tiết nitơ khoảng 8%. V&igrave; vậy, khẩu phần protein vừa phải g&oacute;p phần to lớn trong việc bảo vệ m&ocirc;i trường, hướng tới một ng&agrave;nh n&ocirc;ng nghiệp bền vững hơn.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Khi n&oacute;i đến chiến lược nu&ocirc;i heo mới để giảm chi ph&iacute; thức ăn, trong khi vẫn đạt được lợi &iacute;ch tối đa của tiềm năng di truyền, một khẩu phần với mức protein th&ocirc; vừa phải kết hợp với sự c&acirc;n bằng cho tất cả c&aacute;c axit amin theo tỷ lệ với lysine ch&iacute;nh l&agrave; &quot;ch&igrave;a kh&oacute;a&quot; dẫn tới th&agrave;nh c&ocirc;ng.</p>', '2022-04-19 20:31:33', 1, 2, NULL),
(5, 'Giá heo hơi hôm nay 17/4: Chủ yếu tăng trong tuần này', 'gia-heo-hoi-hom-nay-17-4:-chu-yeu-tang-trong-tuan-nay', 'gia-heo(3).jpg', '<h2>Gi&aacute; heo hơi h&ocirc;m nay 17/4/2022 tại thị trường 3 miền giao dịch ở mức 53.000 - 58.000 đ/kg. Tuần n&agrave;y, thị trường heo hơi ba miền biến động từ 1.000 - 3.000 đ/kg.</h2>\r\n\r\n<ul>\r\n	<li><a href=\"https://nguoichannuoi.vn/gia-heo-hoi-hom-nay-134:-thi-truong-bien-dong-nhe-nd8799.html\" title=\"Giá heo hơi hôm nay 13/4: Thị trường biến động nhẹ\">Gi&aacute; heo hơi h&ocirc;m nay 13/4: Thị trường biến động nhẹ</a></li>\r\n	<li><a href=\"https://nguoichannuoi.vn/gia-heo-hoi-hom-nay-144:-mien-nam-bien-dong-nhe-nd8802.html\" title=\"Giá heo hơi hôm nay 14/4: Miền Nam biến động nhẹ\">Gi&aacute; heo hơi h&ocirc;m nay 14/4: Miền Nam biến động nhẹ</a></li>\r\n	<li><a href=\"https://nguoichannuoi.vn/gia-heo-hoi-hom-nay-164:-tang-them-1000---3000-dkg-nd8812.html\" title=\"Giá heo hơi hôm nay 16/4: Tăng thêm 1.000 - 3.000 đ/kg\">Gi&aacute; heo hơi h&ocirc;m nay 16/4: Tăng th&ecirc;m 1.000 - 3.000 đ/kg</a></li>\r\n</ul>\r\n\r\n<h2>Gi&aacute; heo hơi miền Bắc h&ocirc;m nay</h2>\r\n\r\n<p><a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">Gi&aacute; heo hơi h&ocirc;m nay</a>&nbsp;17/4&nbsp;tại thị trường miền Bắc đi ngang. Tuần n&agrave;y, thị trường heo hơi miền Bắc giảm nhẹ 1.000 đ/kg.</p>\r\n\r\n<p>Cụ thể, sau khi giảm 1.000 đ/kg so với tuần trước, Ph&uacute; Thọ hiện thu mua heo hơi với gi&aacute; 53.000 đ/kg, ngang bằng Y&ecirc;n B&aacute;i, L&agrave;o Cai, Th&aacute;i B&igrave;nh v&agrave; Ninh Thuận.</p>\r\n\r\n<p>Trong khi đ&oacute;, Vĩnh Ph&uacute;c ghi nhận mức gi&aacute; cao nhất khu vực l&agrave; 56.000 đ/kg, kh&ocirc;ng đổi so với tuần trước.</p>\r\n\r\n<p>C&aacute;c tỉnh th&agrave;nh c&ograve;n lại đang duy tr&igrave; gi&aacute; mua quanh mốc trung b&igrave;nh l&agrave; 54.000 đ/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 17/4/2022 tại thị trường miền Bắc đang giao dịch quanh mức 53.000 - 56.000 đ/kg.</p>\r\n\r\n<h2>Gi&aacute; heo hơi miền Trung v&agrave; T&acirc;y Nguy&ecirc;n h&ocirc;m nay</h2>\r\n\r\n<p><a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">Gi&aacute; heo</a>&nbsp;hơi h&ocirc;m nay 17/4&nbsp;tại miền Trung v&agrave; T&acirc;y Nguy&ecirc;n cũng kh&ocirc;ng c&oacute; biến động mới. Thị trường heo hơi tuần n&agrave;y của khu vực tăng từ 1.000 - 3.000 đ/kg.</p>\r\n\r\n<p>Theo đ&oacute;, Nghệ An, B&igrave;nh Định v&agrave; Đắk Lắk tăng 1.000 đ/kg, l&ecirc;n mốc 54.000 đ/kg, thấp nhất khu vực.</p>\r\n\r\n<p>Sau khi tăng 2.000 đ/kg, thương l&aacute;i tỉnh B&igrave;nh Thuận đang thu mua heo hơi với gi&aacute; 58.000 đ/kg.</p>\r\n\r\n<p>Một số tỉnh th&agrave;nh gồm Quảng B&igrave;nh, Quảng Trị v&agrave; L&acirc;m Đồng điều chỉnh tăng 3.000 đ/kg trong tuần n&agrave;y, giao dịch trong khoảng 55.000 - 57.000 đ/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 17/4/2022 ở miền Trung thu mua quanh mức 54.000 - 58.000 đ/kg.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Gi&aacute; heo hơi miền Nam h&ocirc;m nay</h2>\r\n\r\n<p>Tại miền Nam,&nbsp;<a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">gi&aacute; heo hơi</a>&nbsp;h&ocirc;m nay 17/4&nbsp;duy tr&igrave; mức giao dịch h&ocirc;m qua. Tuần n&agrave;y, thị trường heo hơi miền Nam tăng giảm tr&aacute;i chiều từ 1.000 - 3.000 đ/kg.</p>\r\n\r\n<p>Trong đ&oacute;, B&igrave;nh Dương, T&acirc;y Ninh, Vũng T&agrave;u, Đồng Th&aacute;p, Hậu Giang, C&agrave; Mau v&agrave; Bạc Li&ecirc;u biến động 1.000 đ/kg, hiện giao dịch trong khoảng 55.000 - 57.000 đ/kg.</p>\r\n\r\n<p>Long An hiện đang thu mua heo hơi 54.000 đ/kg, tăng 2000 đ/kg so với tuần trước.</p>\r\n\r\n<p>Ba địa phương gồm Đồng Nai, TP.HCM v&agrave; An Giang tăng 3.000 đ/kg, gi&aacute;&nbsp;heo hơi&nbsp;dao động trong khoảng 57.000 - 58.000 đ/kg trong tuần n&agrave;y.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 17/4/2022 to&agrave;n miền Nam tiếp tục giao dịch quanh ngưỡng 54.000 - 58.000 đ/kg.</p>', '2022-04-19 20:33:03', 1, 3, NULL),
(6, 'Giá heo hơi hôm nay 16/4: Tăng thêm 1.000 - 3.000 đ/kg', 'gia-heo-hoi-hom-nay-16-4:-tang-them-1.000---3.000-d-kg', 'chan-nuoi-lon.jpg', '<h2>Gi&aacute; heo hơi h&ocirc;m nay 16/4/2022 tại thị trường miền Trung v&agrave; miền Nam đang tăng 2.000 - 3.000 đ/kg. Trong khi đ&oacute;, thị trường heo hơi miền Bắc đi ngang.</h2>\r\n\r\n<ul>\r\n	<li><a href=\"https://nguoichannuoi.vn/gia-heo-hoi-hom-nay-124:-tang-nhe-vai-noi-nd8792.html\" title=\"Giá heo hơi hôm nay 12/4: Tăng nhẹ vài nơi\">Gi&aacute; heo hơi h&ocirc;m nay 12/4: Tăng nhẹ v&agrave;i nơi</a></li>\r\n	<li><a href=\"https://nguoichannuoi.vn/gia-heo-hoi-hom-nay-134:-thi-truong-bien-dong-nhe-nd8799.html\" title=\"Giá heo hơi hôm nay 13/4: Thị trường biến động nhẹ\">Gi&aacute; heo hơi h&ocirc;m nay 13/4: Thị trường biến động nhẹ</a></li>\r\n	<li><a href=\"https://nguoichannuoi.vn/gia-heo-hoi-hom-nay-144:-mien-nam-bien-dong-nhe-nd8802.html\" title=\"Giá heo hơi hôm nay 14/4: Miền Nam biến động nhẹ\">Gi&aacute; heo hơi h&ocirc;m nay 14/4: Miền Nam biến động nhẹ</a></li>\r\n</ul>\r\n\r\n<h2>Gi&aacute; heo hơi miền Bắc h&ocirc;m nay</h2>\r\n\r\n<p><a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">Gi&aacute; heo</a>&nbsp;hơi h&ocirc;m nay 16/4&nbsp;tại thị trường miền Bắc vẫn kh&ocirc;ng c&oacute; biến động mới. Đ&acirc;y l&agrave; phi&ecirc;n thứ 3 li&ecirc;n tiếp thị trường heo hơi miền Bắc đi ngang.</p>\r\n\r\n<p>Hiện tại, mức gi&aacute; thu mua heo hơi thấp nhất được ghi nhận tại c&aacute;c tỉnh Y&ecirc;n B&aacute;i, L&agrave;o Cai, Th&aacute;i Nguy&ecirc;n, Ph&uacute; Thọ v&agrave; Ninh B&igrave;nh l&agrave; 53.000 đ/kg.</p>\r\n\r\n<p>Ngoại trừ tỉnh Vĩnh Ph&uacute;c hiện đang giao dịch với gi&aacute; cao nhất khu vực l&agrave; 56.000 đ/kg, c&aacute;c địa phương c&ograve;n lại đang thu mua ổn định trong khoảng 54.000 - 55.000 đ/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 16/4/2022 tại thị trường miền Bắc đang giao dịch quanh mức 53.000 - 56.000 đ/kg.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Gi&aacute; heo hơi miền Trung v&agrave; T&acirc;y Nguy&ecirc;n h&ocirc;m nay</h2>\r\n\r\n<p><a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">Gi&aacute; heo hơi h&ocirc;m nay</a>&nbsp;16/4&nbsp;tại miền Trung v&agrave; T&acirc;y Nguy&ecirc;n c&oacute; nơi tăng tới 3.000 đ/kg.</p>\r\n\r\n<p>Cụ thể, sau khi nh&iacute;ch nhẹ một gi&aacute;, thương l&aacute;i tại Nghệ An, B&igrave;nh Định v&agrave; Đắk Lắk đang c&ugrave;ng thu mua heo hơi với gi&aacute; 54.000 đ/kg.</p>\r\n\r\n<p>C&aacute;c tỉnh Quảng B&igrave;nh, Quảng Trị v&agrave; L&acirc;m Đồng c&ugrave;ng tăng 2.000 đ/kg; hiện đang giao dịch heo hơi lần lượt l&agrave; 55.000 đ/kg v&agrave; 57.000 đ/kg.</p>\r\n\r\n<p>Tương tự, tỉnh B&igrave;nh Thuận tăng 3.000 đ/kg l&ecirc;n mức 58.000 đ/kg, cao nhất khu vực.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 16/4/2022 ở miền Trung thu mua quanh mức 54.000 - 58.000 đ/kg.</p>\r\n\r\n<h2>Gi&aacute; heo hơi miền Nam h&ocirc;m nay</h2>\r\n\r\n<p>Tại miền Nam,&nbsp;<a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">gi&aacute; heo hơi</a>&nbsp;h&ocirc;m nay 16/4&nbsp;tăng th&ecirc;m 1.000 - 3.000 đ/kg so với h&ocirc;m qua.</p>\r\n\r\n<p>Theo đ&oacute;, thương l&aacute;i tại T&acirc;y Ninh, Đồng Th&aacute;p, Đồng Nai v&agrave; Vũng T&agrave;u c&ugrave;ng tăng nhẹ 1.000 đ/kg l&ecirc;n khoảng 55.000 - 57.000 đ/kg.</p>\r\n\r\n<p>Sau khi tăng 2.000 đ/kg, tỉnh B&igrave;nh Phước, Long An v&agrave; B&igrave;nh Dương điều chỉnh giao dịch l&ecirc;n mức 54.000 đ/kg v&agrave; 56.000 đ/kg.</p>\r\n\r\n<p>TP HCM tăng cao nhất 3.000 đ/kg l&ecirc;n mức 57.000 đ/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 16/4/2022 to&agrave;n miền Nam tiếp tục giao dịch quanh ngưỡng 54.000 - 58.000 đ/kg.</p>\r\n\r\n<h2>Bảng gi&aacute; heo hơi h&ocirc;m nay</h2>\r\n\r\n<p>Dưới đ&acirc;y l&agrave;&nbsp;<a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">bảng gi&aacute; heo hơi</a>&nbsp;3 miền&nbsp;mới nhất h&ocirc;m nay 16/4/2022. Đơn vị: đ/kg</p>\r\n\r\n<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Địa phương</strong></td>\r\n			<td><strong>Gi&aacute;</strong></td>\r\n			<td><strong>Biến động</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\"><strong>Miền Bắc</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bắc Giang</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Y&ecirc;n B&aacute;i</td>\r\n			<td>53.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>L&agrave;o Cai</td>\r\n			<td>53.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Hưng Y&ecirc;n</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Nam Định</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Th&aacute;i Nguy&ecirc;n</td>\r\n			<td>53.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ph&uacute; Thọ</td>\r\n			<td>53.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Th&aacute;i B&igrave;nh</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>H&agrave; Nam</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Vĩnh Ph&uacute;c</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>H&agrave; Nội</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ninh B&igrave;nh</td>\r\n			<td>53.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tuy&ecirc;n Quang</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\"><strong>Miền Trung v&agrave; T&acirc;y Nguy&ecirc;n</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thanh H&oacute;a</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Nghệ An</td>\r\n			<td>54.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>H&agrave; Tĩnh</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Quảng B&igrave;nh</td>\r\n			<td>55.000</td>\r\n			<td>2.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Quảng Trị</td>\r\n			<td>57.000</td>\r\n			<td>2.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thừa Thi&ecirc;n Huế</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Quảng Nam</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Quảng Ng&atilde;i</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>B&igrave;nh Định</td>\r\n			<td>54.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kh&aacute;nh Ho&agrave;</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>L&acirc;m Đồng</td>\r\n			<td>57.000</td>\r\n			<td>2.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đắk Lắk</td>\r\n			<td>54.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ninh Thuận</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>B&igrave;nh Thuận</td>\r\n			<td>58.000</td>\r\n			<td>3.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\"><strong>Miền Nam</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>B&igrave;nh Phước</td>\r\n			<td>54.000</td>\r\n			<td>2.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đồng Nai</td>\r\n			<td>57.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>TP HCM</td>\r\n			<td>57.000</td>\r\n			<td>3.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>B&igrave;nh Dương</td>\r\n			<td>56.000</td>\r\n			<td>2.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>T&acirc;y Ninh</td>\r\n			<td>55.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Vũng T&agrave;u</td>\r\n			<td>57.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Long An</td>\r\n			<td>54.000</td>\r\n			<td>2.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đồng Th&aacute;p</td>\r\n			<td>56.000</td>\r\n			<td>1.000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>An Giang</td>\r\n			<td>58.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Vĩnh Long</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cần Thơ</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ki&ecirc;n Giang</td>\r\n			<td>54.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Hậu Giang</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>C&agrave; Mau</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tiền Giang</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bạc Li&ecirc;u</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tr&agrave; Vinh</td>\r\n			<td>55.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bến Tre</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>S&oacute;c Trăng</td>\r\n			<td>56.000</td>\r\n			<td>-</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><em>Bảng gi&aacute; heo hơi h&ocirc;m nay 16/4/2022 tại thị trường 3 miền</em></p>', '2022-04-19 20:33:57', 1, 3, NULL),
(7, 'Giá heo hơi hôm nay 10-4: Tuần này biến động từ 1.000 - 4.000 đ-kg', 'gia-heo-hoi-hom-nay-10-4:-tuan-nay-bien-dong-tu-1.000---4.000-d-kg', 'web11122020-1.jpg', '<h2>Gi&aacute; heo hơi h&ocirc;m nay 10/4/2022 tại thị trường 3 miền duy tr&igrave; quanh mức 52.000 - 57.000 đ/kg. Tuần n&agrave;y, thị trường heo hơi biến động tr&aacute;i chiều từ 1.000 - 4.000 đ/kg.</h2>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<h2>Gi&aacute; heo hơi miền Bắc h&ocirc;m nay</h2>\r\n\r\n<p><a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">Gi&aacute; heo hơi h&ocirc;m nay</a>&nbsp;10/4&nbsp;tại thị trường miền Bắc duy tr&igrave; ổn định. Tuần n&agrave;y, thị trường heo hơi miền Bắc biến động tr&aacute;i chiều từ 1.000 - 3.000 đ/kg.</p>\r\n\r\n<p>Cụ thể, sau khi giảm 3.000 đồng/kg, thương l&aacute;i tại Hưng Y&ecirc;n đang giao dịch với gi&aacute; 54.000 đồng/kg.</p>\r\n\r\n<p>Tr&aacute;i lại, tỉnh H&agrave; Nam v&agrave; Bắc Giang c&ugrave;ng tăng 1.000 đồng/kg, hiện đang thu mua&nbsp;heo hơi&nbsp;lần lượt l&agrave; 54.000 đồng/kg v&agrave; 55.000 đồng/kg.</p>\r\n\r\n<p>Sau khi tăng 2.000 đồng/kg, tỉnh Nam Định điều chỉnh giao dịch l&ecirc;n mức 54.000 đồng/kg.</p>\r\n\r\n<p>Tương tự, tỉnh Th&aacute;i B&igrave;nh n&acirc;ng gi&aacute; thu mua l&ecirc;n 55.000 đồng/kg sau khi tăng 3.000 đồng/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 10/4/2022 tại thị trường miền Bắc đang giao dịch quanh mức 53.000 - 56.000 đ/kg.</p>\r\n\r\n<h2>Gi&aacute; heo hơi miền Trung v&agrave; T&acirc;y Nguy&ecirc;n h&ocirc;m nay</h2>\r\n\r\n<p><a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">Gi&aacute; heo</a>&nbsp;hơi h&ocirc;m nay 10/4&nbsp;tại miền Trung v&agrave; T&acirc;y Nguy&ecirc;n đi ngang. Tuần n&agrave;y, thị trường heo hơi miền Trung tăng rải r&aacute;c từ 1.000 - 4.000 đ/kg.</p>\r\n\r\n<p>Theo đ&oacute;, c&aacute;c tỉnh Quảng Nam, Quảng Ng&atilde;i v&agrave; Ninh Thuận c&ugrave;ng nh&iacute;ch nhẹ 1.000 đồng/kg, hiện đang giao dịch tương ứng l&agrave; 54.000 - 55.000 đồng/kg.</p>\r\n\r\n<p>Sau khi tăng 2.000 đồng/kg v&agrave; 4.000 đồng/kg, thương l&aacute;i tại tỉnh Kh&aacute;nh H&ograve;a v&agrave; B&igrave;nh Thuận đang c&ugrave;ng thu mua heo hơi với gi&aacute; cao nhất khu vực l&agrave; 56.000 đồng/kg.</p>\r\n\r\n<p>Tỉnh Quảng Trị cũng tăng 3.000 đồng/kg l&ecirc;n mức 54.000 đồng/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 10/4/2022 ở miền Trung thu mua quanh mức 52.000 - 56.000 đ/kg.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Gi&aacute; heo hơi miền Nam h&ocirc;m nay</h2>\r\n\r\n<p>Tại miền Nam,&nbsp;<a href=\"https://nguoichannuoi.vn/tag/gi%C3%A1-heo\" rel=\"follow noopener\" target=\"_blank\">gi&aacute; heo hơi</a>&nbsp;h&ocirc;m nay 10/4&nbsp;giữ mức giao dịch h&ocirc;m qua. Tuần n&agrave;y, thị trường heo hơi miền Nam cũng đang biến động tr&aacute;i chiều.</p>\r\n\r\n<p>Trong đ&oacute;, c&aacute;c tỉnh B&igrave;nh Dương, An Giang, Tr&agrave; Vinh, Bến Tre v&agrave; S&oacute;c Trăng sau khi nh&iacute;ch nhẹ một gi&aacute; đ&atilde; điều chỉnh giao dịch l&ecirc;n khoảng 55.000 - 56.000 đồng/kg.</p>\r\n\r\n<p>C&aacute;c tỉnh gồm Vũng T&agrave;u, Cần Thơ, Đồng Th&aacute;p v&agrave; Vĩnh Long lần lượt tăng 2.000 - 3.000 đồng/kg, hiện đang thu mua heo hơi với gi&aacute; 55.000 - 56.000 đồng/kg.</p>\r\n\r\n<p>Tương tự, sau khi tăng 4.000 đồng/kg, thương l&aacute;i tại Bạc Li&ecirc;u đang giao dịch với gi&aacute; cao nhất khu vực l&agrave; 57.000 đồng/kg.</p>\r\n\r\n<p>Trong khi đ&oacute;, c&aacute;c tỉnh Đồng Nai, Long An v&agrave; Hậu Giang c&ugrave;ng giảm nhẹ 1.000 đồng/kg xuống c&ograve;n 52.000 - 54.000 đồng/kg.</p>\r\n\r\n<p>Như vậy, gi&aacute; heo hơi h&ocirc;m nay 10/4/2022 to&agrave;n miền Nam tiếp tục giao dịch quanh ngưỡng 52.000 - 57.000 đ/kg.</p>', '2022-04-19 20:34:27', 1, 3, NULL),
(8, 'Các phương pháp chẩn đoán thai nghén ở heo', 'cac-phuong-phap-chan-doan-thai-nghen-o-heo', 'thai-nghen-o-heo.jpg', '<h2>(Người Chăn Nu&ocirc;i) - Việc chẩn đo&aacute;n thai sớm cho heo nhằm ph&aacute;t hiện ch&iacute;nh x&aacute;c số heo mang thai trong tổng đ&agrave;n được phối, qua đ&oacute; dự đo&aacute;n số heo con sinh ra, sử dụng thuốc, vaccine&hellip;, để x&acirc;y dựng kế hoạch sản xuất ph&ugrave; hợp, giảm t&igrave;nh trạng stress ở heo n&aacute;i khi mang thai, cũng như tiết kiệm được chi ph&iacute; nh&acirc;n c&ocirc;ng trong quản l&yacute; v&agrave; chăm s&oacute;c tại trang trại.</h2>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<h2>Quan s&aacute;t động dục h&agrave;ng ng&agrave;y</h2>\r\n\r\n<p>Sau khi trứng được thụ tinh trong ống dẫn trứng, ph&ocirc;i sẽ di chuyển xung quanh 2 sừng của tử cung để trở n&ecirc;n c&aacute;ch đều nhau. Sự sống s&oacute;t của những con n&agrave;y đến ng&agrave;y thứ 10 hoặc 11 bắt đầu c&oacute; t&iacute;n hiệu mang thai nhưng sự thất bại v&agrave;o thời điểm n&agrave;y dẫn đến việc động dục trở lại theo chu kỳ hơi chậm 22 - 26 ng&agrave;y.</p>\r\n\r\n<p>Qu&aacute; tr&igrave;nh cấy ph&ocirc;i bắt đầu từ ng&agrave;y 12 - 14 v&agrave; cần c&oacute; tối thiểu 5 ph&ocirc;i thai để tiếp tục mang thai. Nếu trường hợp sảy thai v&agrave;o thời điểm n&agrave;y th&igrave; thời gian động dục trở lại sẽ chậm đến 23 - 38 ng&agrave;y v&igrave; thai đ&atilde; bắt đầu.</p>\r\n\r\n<p>Nếu qu&aacute; tr&igrave;nh mang thai được duy tr&igrave; cho đến khi ho&agrave;n th&agrave;nh qu&aacute; tr&igrave;nh cấy gh&eacute;p v&agrave; sau đ&oacute; kh&ocirc;ng ho&agrave;n to&agrave;n hấp thụ được, th&igrave; n&aacute;i sẽ mang thai giả trong một thời gian kh&aacute;c nhau v&agrave; sau đ&oacute; kh&ocirc;ng chuyển sang giai đoạn kh&aacute;c ở heo. Trong nhiều trường hợp, kết quả thử thai dương t&iacute;nh ngay từ sớm chỉ để ph&aacute;t hiện n&aacute;i &acirc;m t&iacute;nh sau đ&oacute;. Lưu &yacute;, việc thai lưu trong khoảng thời gian 15 - 35 ng&agrave;y c&oacute; thể cho kết quả x&eacute;t nghiệm dương t&iacute;nh giả.</p>\r\n\r\n<p>Nh&igrave;n từ b&ecirc;n ngo&agrave;i: N&aacute;i c&oacute; thai xuất hiện trạng th&aacute;i ph&ugrave; thũng ở tứ chi v&agrave; th&agrave;nh bụng. Tuyến v&uacute; bắt đầu ph&aacute;t triển to l&ecirc;n, b&egrave; ra. Heo ăn uống tốt v&agrave; ngủ ngon, bụng dần ph&aacute;t triển to l&ecirc;n. Heo kh&ocirc;ng c&oacute; xuất hiện biểu hiện động dục lại sau 3 tuần kể từ l&uacute;c phối.</p>\r\n\r\n<h2>Kiểm tra bi&ecirc;n độ</h2>\r\n\r\n<p>M&aacute;y kiểm tra bi&ecirc;n độ thường chỉ c&oacute; thể kiểm tra thai kỳ của heo ở ng&agrave;y 28 - 80. Tuy nhi&ecirc;n, m&aacute;y dễ cho kết quả dương t&iacute;nh giả nếu b&agrave;ng quang đầy v&agrave; qu&aacute; tr&igrave;nh qu&eacute;t kh&ocirc;ng t&igrave;m thấy tử cung.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>C&aacute;c x&eacute;t nghiệm Doppler</h2>\r\n\r\n<p>M&aacute;y si&ecirc;u &acirc;m Doppler ch&iacute;nh x&aacute;c hơn v&agrave; c&oacute; thể được sử dụng trong to&agrave;n bộ giai đoạn thai kỳ từ 26 ng&agrave;y đến đủ th&aacute;ng. Đ&acirc;y l&agrave; phương ph&aacute;p phổ biến nhất với độ ch&iacute;nh x&aacute;c cộng th&ecirc;m 90%. Những &acirc;m thanh được ph&aacute;t hiện trong thời kỳ đầu mang thai ph&aacute;t sinh từ những thay đổi trong lưu lượng m&aacute;u diễn ra trong c&aacute;c động mạch lớn cung cấp m&aacute;u cho tử cung. Chuyển động của thai nhi v&agrave; nhau thai cũng c&oacute; thể được ph&aacute;t hiện c&ugrave;ng với nhịp tim của thai nhi. Nhiễm tr&ugrave;ng thai, hấp thụ ph&ocirc;i hoặc động dục sớm c&oacute; thể cho kết quả dương t&iacute;nh giả v&agrave; tất nhi&ecirc;n việc diễn giải sai &acirc;m thanh hoặc thiếu kinh nghiệm c&oacute; thể dẫn đến kết quả sai. C&aacute;c băng &acirc;m thanh tr&igrave;nh diễn c&oacute; sẵn với thiết bị.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Sinh thiết &acirc;m đạo</h2>\r\n\r\n<p>Kỹ thuật n&agrave;y bao gồm việc loại bỏ một mảnh nhỏ của m&agrave;ng nhầy &acirc;m đạo bằng một dụng cụ đặc biệt. Dụng cụ được đưa v&agrave;o &acirc;m đạo 150 - 300 mm &eacute;p v&agrave;o m&agrave;ng v&agrave; phần cuối thao t&aacute;c cắt ra một đoạn nhỏ. Mẫu được đặt trong một hộp nhỏ với chất bảo quản đặc biệt v&agrave; được đưa đến ph&ograve;ng th&iacute; nghiệm để kiểm tra m&ocirc; học. Kỹ thuật n&agrave;y tốn thời gian, chi ph&iacute; v&agrave; &iacute;t được sử dụng.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Ph&acirc;n t&iacute;ch huyết thanh</h2>\r\n\r\n<p>Việc n&agrave;y c&oacute; thể được thực hiện sau ng&agrave;y thứ 22 bằng c&aacute;ch sử dụng một ống nhỏ để chọc v&agrave;o tĩnh mạch tai. Một ống mao mạch mỏng thu thập một đốm m&aacute;u, sau đ&oacute; được x&eacute;t nghiệm c&aacute;c hormone thai kỳ. N&oacute; tốn thời gian, tốn k&eacute;m v&agrave; &iacute;t được sử dụng. C&aacute;c kỹ thuật đang được ph&aacute;t triển để kiểm tra ph&acirc;n để ph&aacute;t hiện mang thai nhưng vẫn chưa được ho&agrave;n thiện để sử dụng cho mục đ&iacute;ch thương mại.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Si&ecirc;u &acirc;m</h2>\r\n\r\n<p>Thiết bị qu&eacute;t si&ecirc;u &acirc;m hiện đ&atilde; c&oacute; sẵn, tương tự như thiết bị được sử dụng tr&ecirc;n người để ph&aacute;t hiện thai ngh&eacute;n. N&oacute; đắt tiền nhưng rất ch&iacute;nh x&aacute;c v&agrave; c&oacute; thể hợp l&yacute; để sử dụng trong c&aacute;c trang trại lớn.</p>\r\n\r\n<p>Si&ecirc;u &acirc;m thai cho heo được tiến h&agrave;nh khi heo mang thai 22 - 30 ng&agrave;y. Kỹ thuật n&agrave;y gi&uacute;p &iacute;ch rất nhiều cho việc quản l&yacute; đ&agrave;n heo n&aacute;i trong chăn nu&ocirc;i c&ocirc;ng nghiệp, giảm t&igrave;nh trạng stress cho heo n&aacute;i trong giai đoạn mang thai. Giai đoạn heo mang thai 18 - 21 ng&agrave;y si&ecirc;u &acirc;m kh&oacute; ph&aacute;t hiện được heo c&oacute; mang thai hay kh&ocirc;ng. V&igrave; vậy, trong giai đoạn n&agrave;y heo n&aacute;i phải được kiểm tra lốc thủ c&ocirc;ng, kết hợp giữa k&iacute;ch th&iacute;ch hormone của heo đực v&agrave; k&iacute;ch th&iacute;ch vật l&yacute; của kỹ thuật vi&ecirc;n. C&aacute;ch si&ecirc;u &acirc;m: Để heo đứng, si&ecirc;u &acirc;m ở vị tr&iacute; giữa n&uacute;m v&uacute; thứ nhất v&agrave; n&uacute;m v&uacute; thứ 3 t&iacute;nh từ ph&iacute;a đu&ocirc;i heo. B&ocirc;i gel si&ecirc;u &acirc;m l&ecirc;n đầu d&ograve; v&agrave; đặt đầu d&ograve; vu&ocirc;ng g&oacute;c với bụng heo tại vị tr&iacute; x&aacute;c định. Sau đ&oacute; di chuyển đầu d&ograve; v&agrave; đặt nghi&ecirc;ng ở c&aacute;c g&oacute;c kh&aacute;c nhau để quan s&aacute;t to&agrave;n bộ t&uacute;i thai. T&uacute;i thai l&agrave; những khoảng đen đậm h&igrave;nh bầu dục hoặc tr&ograve;n tương đối, c&aacute;c t&uacute;i thai nằm cạnh nhau trong tử cung kh&aacute; giống với c&aacute;ch sắp xếp của ch&ugrave;m nho. Tuổi thai c&agrave;ng lớn k&iacute;ch thước t&uacute;i thai c&agrave;ng lớn v&agrave; c&oacute; thể thấy b&agrave;o thai b&ecirc;n trong t&uacute;i.</p>\r\n\r\n<p><em>Lưu &yacute;:</em>&nbsp;Khi si&ecirc;u &acirc;m n&ecirc;n để heo đứng thẳng lưng, nếu heo nghi&ecirc;ng lưng sang một b&ecirc;n c&oacute; thể g&acirc;y kh&oacute; ph&aacute;t hiện b&agrave;o thai. Trong qu&aacute; tr&igrave;nh si&ecirc;u &acirc;m n&ecirc;n d&ugrave;ng b&uacute;t ch&igrave; ghi số b&agrave;o thai dự kiến v&agrave;o thẻ n&aacute;i để so s&aacute;nh với số lượng thực tế khi heo đẻ ra. Đ&aacute;nh dấu những n&aacute;i mang thai nhiều con để điều chỉnh khẩu phần hợp l&yacute;, tr&aacute;nh t&igrave;nh trạng thiếu dinh dưỡng dẫn đến heo con sinh ra c&ograve;i cọc kh&oacute; nu&ocirc;i. Những heo kh&ocirc;ng mang thai cần được xử l&yacute; để hạn chế tối đa ng&agrave;y kh&ocirc;ng sản xuất của heo n&aacute;i.</p>', '2022-04-19 20:37:19', 1, 4, NULL);
INSERT INTO `tintuc` (`ID`, `TieuDe`, `Metatitle`, `Anh`, `NoiDung`, `NgayDang`, `TrangThai`, `LoaiTin_ID`, `NhanVien_ID`) VALUES
(9, 'Xử lý heo nái sau khi sinh bị sốt', 'xu-ly-heo-nai-sau-khi-sinh-bi-sot', 'gia-heo-4-10_1649832779.jpg', '<h2>(Người Chăn Nu&ocirc;i) - Hỏi: Heo n&aacute;i sau khi sinh 1 - 2 ng&agrave;y c&oacute; hiện tượng như &iacute;t ăn, sốt cao 40 - 41 độ C, nằm một chỗ, c&oacute; dịch trắng chảy ra ở &acirc;m hộ, c&oacute; khi c&oacute; dịch lợn cợn m&agrave;u hồng, m&ugrave;i h&ocirc;i tanh. Xin cho biết biện ph&aacute;p ph&ograve;ng trị?</h2>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<p><em><strong>Trả lời:</strong></em></p>\r\n\r\n<p>Theo m&ocirc; tả, heo n&aacute;i c&oacute; thể đ&atilde; bị bệnh vi&ecirc;m tử cung, nguy&ecirc;n nh&acirc;n do x&acirc;y x&aacute;t ni&ecirc;m mạc tử cung khi sinh đẻ, hay do thao t&aacute;c đỡ đẻ, do s&oacute;t nhau, nhau bị thối rữa.</p>\r\n\r\n<p>Để ph&ograve;ng bệnh bệnh n&agrave;y th&igrave; trước, sau khi đẻ cần vệ sinh chuồng trại sạch sẽ bằng Virkon tỷ lệ 1:400, đảm bảo chuồng lu&ocirc;n kh&ocirc; r&aacute;o, tho&aacute;ng. Khi đỡ đẻ bằng tay phải s&aacute;t tr&ugrave;ng tay thật kỹ, đi găng tay. Sau khi đẻ thụt rửa tử cung 4 - 5 lần, trong v&ograve;ng 2 - 3 ng&agrave;y với dung dịch thuốc t&iacute;m 1%. Cần ti&ecirc;m ph&ograve;ng đầy đủ c&aacute;c loại vaccine ph&ograve;ng bệnh cho heo, đảm bảo dinh dưỡng cho heo.</p>\r\n\r\n<p>Để điều trị bệnh, d&ugrave;ng nước c&oacute; pha thuốc t&iacute;m 1% thụt rửa tử cung. Căn cứ t&igrave;nh trạng bệnh của heo n&aacute;i, c&oacute; thể sử dụng c&aacute;c loại thuốc sau đ&acirc;y để điều trị: Hạ sốt: Analgine C; Kh&aacute;ng vi&ecirc;m: Dexamethasol, Hydrocortisol. Điều trị bằng kh&aacute;ng sinh c&oacute; thể chọn một trong những loại kh&aacute;ng sinh sau đ&acirc;y: Baytril 5%: 1 ml/20 kg trọng lượng hoặc Genta - Tylosin. Bổ sung một số loại vitamin nh&oacute;m B,C cho heo nhằm tăng sức đề kh&aacute;ng.</p>', '2022-04-19 20:37:42', 1, 4, NULL),
(10, 'Giá thức ăn chăn nuôi tăng 13 lần: Quên \'mỏ vàng\' trong nước', 'gia-thuc-an-chan-nuoi-tang-13-lan:-quen-\'mo-vang\'-trong-nuoc', 'gia-thuc-an-chan-nuoi(4).jpg', '<h2>Từ đầu năm 2022 đến nay, gi&aacute; thức ăn chăn nu&ocirc;i (TĂCN) li&ecirc;n tục tăng mạnh, đưa mặt h&agrave;ng n&agrave;y thiết lập kỷ lục nằm trong nh&oacute;m h&agrave;ng c&oacute; đ&agrave; tăng gi&aacute; nhiều nhất. Trong khi phải chi h&agrave;ng chục tỷ USD để nhập khẩu nguy&ecirc;n liệu, c&aacute;c nh&agrave; sản xuất lại đang bỏ qu&ecirc;n &ldquo;mỏ v&agrave;ng&rdquo; phụ phẩm n&ocirc;ng nghiệp trong nước.</h2>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<h2>Thuế nhập khẩu giảm, gi&aacute; b&aacute;n vẫn tăng</h2>\r\n\r\n<p>Theo ghi nhận, sau khi tăng gi&aacute; b&aacute;n trong th&aacute;ng 3, từ đầu th&aacute;ng 4 đến nay, c&aacute;c doanh nghiệp (DN) sản xuất TĂCN lớn tiếp tục điều chỉnh gi&aacute; b&aacute;n. Từ ng&agrave;y 1/4, Cty TNHH CJ Vina Agri tăng 400 đồng/kg với tất cả thức ăn đậm đặc, thức ăn cho lợn con, b&ograve;. Ngo&agrave;i ra, Cty cũng tăng 300 đồng/kg với thức ăn cho lợn n&aacute;i, thịt; g&agrave; thịt, đẻ; vịt nu&ocirc;i lấy thịt; d&ecirc;...</p>\r\n\r\n<p>Tương tự, Cty Greenfeed Việt Nam cũng th&ocirc;ng b&aacute;o đến hệ thống đại l&yacute; tăng th&ecirc;m 300 - 400 đồng/kg cho c&aacute;c sản phẩm t&ugrave;y loại. Ri&ecirc;ng Cty TNHH TĂCN Việt Trung tăng tới 500 đồng một kg cho một số sản phẩm. Cty Cổ phần chăn nu&ocirc;i CP Việt Nam sau khi tăng 400 đồng/kg với thức ăn cho lợn con v&agrave; 300 đồng/ kg với thức ăn hỗn hợp... trong th&aacute;ng 3, th&igrave; vừa tiếp tục tăng 400 đồng/kg với hầu hết c&aacute;c sản phẩm chăn nu&ocirc;i.</p>\r\n\r\n<p>Theo c&aacute;c DN, nguy&ecirc;n nh&acirc;n gi&aacute; tăng l&agrave; gi&aacute; nguy&ecirc;n liệu nhập khẩu để sản xuất thức ăn tiếp tục l&ecirc;n cao do thời tiết bất lợi từ c&aacute;c khu vực trồng ch&iacute;nh tr&ecirc;n thế giới tại c&aacute;c nước Nam Mỹ. Đồng thời, căng thẳng giữa Nga v&agrave; Ukraine cũng t&aacute;c động lớn đến gi&aacute; ng&ocirc; v&agrave; l&uacute;a mỳ tr&ecirc;n thị trường.</p>\r\n\r\n<table align=\"right\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>&ldquo;Tiềm năng chế biến, t&aacute;i sử dụng của phụ phẩm n&ocirc;ng nghiệp ở Việt Nam c&oacute; thể mang lại gi&aacute; trị đến 4 - 5 tỷ USD/năm, nhưng thực tế mới khai th&aacute;c được khoảng 275 triệu USD. Trong khi mỗi năm ch&uacute;ng ta phải nhập khoảng 10 tỷ USD c&aacute;c nguy&ecirc;n liệu từ nước ngo&agrave;i để sản xuất TĂCN&rdquo;. Đại diện Viện Chăn nu&ocirc;i</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Trong gần 2 năm trở lại đ&acirc;y, TĂCN đ&atilde; tăng gi&aacute; li&ecirc;n tiếp khoảng 13 lần, mỗi đợt tăng từ 200 đến 350 đồng/kg. Để giảm nhiệt đ&agrave; tăng gi&aacute; của mặt h&agrave;ng n&agrave;y, cuối năm 2021, Ch&iacute;nh phủ quyết định giảm thuế nhập khẩu một số nguy&ecirc;n liệu như l&uacute;a mỳ từ 3% xuống 0%, ng&ocirc; từ 5% xuống 2% để hỗ trợ người chăn nu&ocirc;i. Tuy nhi&ecirc;n, trong khi người d&acirc;n chưa một lần được DN th&ocirc;ng b&aacute;o giảm gi&aacute;, th&igrave; từ đầu năm 2022, gi&aacute; TĂCN tiếp tục leo thang.</p>\r\n\r\n<p>&Ocirc;ng Nguyễn Văn Chiến, Gi&aacute;m đốc HTX n&ocirc;ng nghiệp Đức Thắng (Ph&ugrave; Cừ, Hưng Y&ecirc;n) cho biết, với gi&aacute; TĂCN như hiện nay, người nu&ocirc;i nhỏ lẻ, thậm ch&iacute; l&agrave; c&aacute;c trang trại phần lớn đều rơi v&agrave;o thua lỗ. Đặc biệt, từ năm 2021 đến nay, gi&aacute; lợn hơi li&ecirc;n tục lao dốc khiến người chăn nu&ocirc;i c&agrave;ng gặp nhiều kh&oacute; khăn.</p>\r\n\r\n<p>&ldquo;C&oacute; thời điểm gi&aacute; lợn hơi rớt xuống c&ograve;n khoảng 30.000 đồng/kg, mỗi ng&agrave;y mở mắt ra hợp t&aacute;c x&atilde; lỗ cả trăm triệu đồng. L&uacute;c đ&oacute;, ch&uacute;ng t&ocirc;i l&acirc;m v&agrave;o cảnh tiến tho&aacute;i lưỡng nan, b&aacute;n kh&ocirc;ng được nhưng giữ nu&ocirc;i cũng chẳng xong. Từ năm ngo&aacute;i đến nay, nhiều hộ d&acirc;n trong x&atilde; tạm ngừng t&aacute;i đ&agrave;n, thậm ch&iacute; kh&ocirc;ng &iacute;t hộ đang bỏ trống chuồng&rdquo;, &ocirc;ng Chiến cho hay.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Chi 10 tỷ USD nhập khẩu</h2>\r\n\r\n<p>Thống k&ecirc; của Bộ NN&amp;PTNT cho thấy, tiềm năng chế biến, t&aacute;i sử dụng của phụ phẩm n&ocirc;ng nghiệp ở Việt Nam c&oacute; thể mang lại gi&aacute; trị đến 4 - 5 tỷ USD/năm, nhưng thực tế mới khai th&aacute;c được khoảng 275 triệu USD. Trong khi mỗi năm ch&uacute;ng ta phải nhập khoảng 10 tỷ USD c&aacute;c nguy&ecirc;n liệu từ nước ngo&agrave;i để sản xuất thức ăn chăn nu&ocirc;i.</p>\r\n\r\n<p>Trao đổi với PV, TS. Chu Mạnh Thắng, đại diện Viện Chăn nu&ocirc;i cho biết, sản xuất n&ocirc;ng nghiệp của Việt Nam đ&aacute;p ứng đủ nhu cầu cho 100 triệu d&acirc;n v&agrave; c&ograve;n thừa cho xuất khẩu. Hiện nay, nhiều phụ phẩm từ thủy sản, trồng trọt, chăn nu&ocirc;i&hellip; rất c&oacute; tiềm năng để sản xuất TĂCN, nhưng chưa được tận dụng, rất l&atilde;ng ph&iacute;.</p>\r\n\r\n<p>Chẳng hạn, phụ phẩm trồng trọt sau thu hoạch như rơm l&uacute;a với 42,8 triệu tấn, th&acirc;n c&acirc;y bắp 10 triệu tấn; rau, quả 3,6 triệu tấn, th&acirc;n c&acirc;y m&igrave; 3,1 triệu tấn, tr&aacute;i điều 3,1 triệu tấn v&agrave; c&aacute;c loại kh&aacute;c 6,1 triệu tấn&hellip; nhưng mới chỉ khai th&aacute;c được phần nhỏ. C&aacute;c loại phụ phẩm giết mổ (nội tạng, tiết gia s&uacute;c, gia cầm) ở c&aacute;c nước ti&ecirc;n tiến được sử dụng để sản xuất nguy&ecirc;n liệu TĂCN th&igrave; ở nước ta chủ yếu d&ugrave;ng cho người.</p>\r\n\r\n<p>Theo đại diện Viện Chăn nu&ocirc;i, nếu c&aacute;c nguy&ecirc;n liệu sẵn c&oacute; tại địa phương được sử dụng l&agrave;m thức ăn chăn nu&ocirc;i, c&oacute; thể gi&uacute;p gi&aacute; thức ăn chăn nu&ocirc;i giảm 300 - 1.000 đồng/kg.</p>\r\n\r\n<p>&ldquo;Sau qu&aacute; tr&igrave;nh nghi&ecirc;n cứu v&agrave; thử nghiệm sử dụng c&aacute;c sản phẩm n&agrave;y để l&agrave;m TĂCN, ch&uacute;ng t&ocirc;i nhận thấy sản phẩm c&oacute; gi&aacute; trị dinh dưỡng tương đương với c&aacute;c sản phẩm thức ăn hỗn hợp sản xuất từ nguy&ecirc;n liệu nhập khẩu. Nếu ch&uacute;ng ta giảm được 3% chi ph&iacute; TĂNC sẽ gi&uacute;p giảm được 2% gi&aacute; th&agrave;nh sản phẩm&rdquo;, &ocirc;ng Thắng n&oacute;i.</p>\r\n\r\n<p>&Ocirc;ng Nguyễn Kim Đo&aacute;n, Ph&oacute; chủ tịch Hiệp hội Chăn nu&ocirc;i Đồng Nai cho rằng, với đ&agrave; tăng gi&aacute; thức ăn chăn nu&ocirc;i như hiện nay, nhiều trang trại c&oacute; nguy cơ &ldquo;treo&rdquo; chuồng, đồng thời việc phục hồi chăn nu&ocirc;i sau dịch COVID-19 sẽ c&agrave;ng chật vật hơn. Để giảm sự phụ thuộc v&agrave;o nguồn nguy&ecirc;n liệu nhập khẩu, theo &ocirc;ng Đo&aacute;n, Ch&iacute;nh phủ cần c&oacute; ch&iacute;nh s&aacute;ch khuyến kh&iacute;ch DN chế biến phụ phẩm n&ocirc;ng nghiệp th&agrave;nh thức ăn chăn nu&ocirc;i.</p>\r\n\r\n<p>Thứ trưởng Bộ NN&amp;PTNT Ph&ugrave;ng Đức Tiến cho biết, trước việc gi&aacute; nguy&ecirc;n liệu sản xuất TĂCN tiếp tục duy tr&igrave; ở mức cao, Bộ NN&amp;PTNT đang đề xuất giảm thuế thu nhập cho DN sản xuất thức ăn chăn nu&ocirc;i, đồng thời điều chỉnh cơ cấu vật nu&ocirc;i theo hướng tăng chăn nu&ocirc;i gia s&uacute;c ăn cỏ, giảm chăn nu&ocirc;i lợn, gia cầm. Đặc biệt, sắp tới, Bộ NN&amp;PTNT sẽ phối hợp với c&aacute;c tỉnh, th&agrave;nh phố ở T&acirc;y Nguy&ecirc;n v&agrave; DN th&agrave;nh lập c&aacute;c hợp t&aacute;c x&atilde;, tập trung chủ yếu v&agrave;o trồng sắn v&agrave; ng&ocirc; để chủ động nguồn nguy&ecirc;n liệu thức ăn chăn nu&ocirc;i, giảm dần phụ thuộc v&agrave;o nhập khẩu.</p>\r\n\r\n<p>&Ocirc;ng Tiến khuyến c&aacute;o c&aacute;c DN giảm bớt c&aacute;c kh&acirc;u ph&acirc;n phối thương mại thức ăn chăn nu&ocirc;i v&igrave; phần lớn đang qua nhiều k&ecirc;nh đại l&yacute; trung gian. Với những DN đ&atilde; nhập khẩu nguy&ecirc;n liệu từ sớm th&igrave; chưa vội tăng gi&aacute; trong thời điểm n&agrave;y để hỗ trợ người chăn nu&ocirc;i.</p>', '2022-04-19 20:38:18', 1, 4, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuat`
--

CREATE TABLE `xuat` (
  `ID` int(11) NOT NULL,
  `TenNguoiMua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LoaiNguoiMua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayXuat` datetime NOT NULL,
  `TongSL` int(11) NOT NULL,
  `TongTien` decimal(65,0) NOT NULL,
  `TongCanNang` double(8,2) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `xuat`
--

INSERT INTO `xuat` (`ID`, `TenNguoiMua`, `SDT`, `LoaiNguoiMua`, `NgayXuat`, `TongSL`, `TongTien`, `TongCanNang`, `TinhTrang`) VALUES
(1, 'Nguyễn Thị Anh', '0968456321', 'Thương lái', '2022-04-20 20:53:30', 15, '684000000', 1605.00, 1),
(2, 'Trần Văn Bê', '0778965634', 'Hợp tác xã Đông Khuê', '2022-04-21 08:22:31', 5, '92565000', 710.00, 1),
(3, 'Lương Xuân Sáng', '0825645739', 'Doanh nghiệp chế biến', '2022-04-21 09:09:59', 5, '81750000', 665.00, 1),
(4, 'Chu Chỉ Nhược', '0978945632', 'Hợp tác xã Võ Đang', '2022-04-21 14:33:44', 8, '208743000', 951.00, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chuatri`
--
ALTER TABLE `chuatri`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `chuatri_chuong_id_foreign` (`Chuong_ID`);

--
-- Chỉ mục cho bảng `chuong`
--
ALTER TABLE `chuong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `chuong_nhanvien_id_foreign` (`NhanVien_ID`);

--
-- Chỉ mục cho bảng `ct_nhap`
--
ALTER TABLE `ct_nhap`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ct_nhap_giong_id_foreign` (`Giong_ID`),
  ADD KEY `ct_nhap_chuong_id_foreign` (`Chuong_ID`),
  ADD KEY `Nhap_ID` (`Nhap_ID`);

--
-- Chỉ mục cho bảng `ct_xuat`
--
ALTER TABLE `ct_xuat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ct_xuat_xuat_id_foreign` (`Xuat_ID`),
  ADD KEY `ct_xuat_chuong_id_foreign` (`Chuong_ID`),
  ADD KEY `Giong_ID` (`Giong_ID`);

--
-- Chỉ mục cho bảng `giong`
--
ALTER TABLE `giong`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loaitin`
--
ALTER TABLE `loaitin`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nhanvien_quyen_id_foreign` (`Quyen_ID`);

--
-- Chỉ mục cho bảng `nhap`
--
ALTER TABLE `nhap`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tintuc_loaitin_id_foreign` (`LoaiTin_ID`),
  ADD KEY `tintuc_nhanvien_id_foreign` (`NhanVien_ID`);

--
-- Chỉ mục cho bảng `xuat`
--
ALTER TABLE `xuat`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chuatri`
--
ALTER TABLE `chuatri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `chuong`
--
ALTER TABLE `chuong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ct_nhap`
--
ALTER TABLE `ct_nhap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ct_xuat`
--
ALTER TABLE `ct_xuat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `giong`
--
ALTER TABLE `giong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `loaitin`
--
ALTER TABLE `loaitin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhap`
--
ALTER TABLE `nhap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `xuat`
--
ALTER TABLE `xuat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chuatri`
--
ALTER TABLE `chuatri`
  ADD CONSTRAINT `chuatri_chuong_id_foreign` FOREIGN KEY (`Chuong_ID`) REFERENCES `chuong` (`ID`);

--
-- Các ràng buộc cho bảng `chuong`
--
ALTER TABLE `chuong`
  ADD CONSTRAINT `chuong_nhanvien_id_foreign` FOREIGN KEY (`NhanVien_ID`) REFERENCES `nhanvien` (`ID`);

--
-- Các ràng buộc cho bảng `ct_nhap`
--
ALTER TABLE `ct_nhap`
  ADD CONSTRAINT `ct_nhap_chuong_id_foreign` FOREIGN KEY (`Chuong_ID`) REFERENCES `chuong` (`ID`),
  ADD CONSTRAINT `ct_nhap_giong_id_foreign` FOREIGN KEY (`Giong_ID`) REFERENCES `giong` (`ID`),
  ADD CONSTRAINT `ct_nhap_ibfk_1` FOREIGN KEY (`Nhap_ID`) REFERENCES `nhap` (`ID`);

--
-- Các ràng buộc cho bảng `ct_xuat`
--
ALTER TABLE `ct_xuat`
  ADD CONSTRAINT `ct_xuat_chuong_id_foreign` FOREIGN KEY (`Chuong_ID`) REFERENCES `chuong` (`ID`),
  ADD CONSTRAINT `ct_xuat_ibfk_1` FOREIGN KEY (`Giong_ID`) REFERENCES `giong` (`ID`),
  ADD CONSTRAINT `ct_xuat_xuat_id_foreign` FOREIGN KEY (`Xuat_ID`) REFERENCES `xuat` (`ID`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_quyen_id_foreign` FOREIGN KEY (`Quyen_ID`) REFERENCES `quyen` (`ID`);

--
-- Các ràng buộc cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD CONSTRAINT `tintuc_loaitin_id_foreign` FOREIGN KEY (`LoaiTin_ID`) REFERENCES `loaitin` (`ID`),
  ADD CONSTRAINT `tintuc_nhanvien_id_foreign` FOREIGN KEY (`NhanVien_ID`) REFERENCES `nhanvien` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
