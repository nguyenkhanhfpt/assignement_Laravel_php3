-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 25, 2020 lúc 09:49 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php3_assignment`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id_bill` int(11) NOT NULL,
  `id_member` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_buy` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`id_bill`, `id_member`, `date_buy`, `status`) VALUES
(6708944, 'khanh', '2020-06-21 14:58:53', 1),
(31621145, 'khanh', '2020-06-21 14:41:12', 1),
(41356412, 'khanh', '2020-06-23 09:28:04', -1),
(42239422, 'khanh2', '2020-06-23 16:33:08', 0),
(66126304, 'khanh2', '2020-06-21 09:58:00', 1),
(75305635, 'khanh', '2020-06-21 15:08:00', 1),
(84408242, 'khanh', '2020-06-21 15:31:51', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id_category` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_category` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `img_category`) VALUES
(2, 'Bàn nội thất', 'categoryOfTable.png'),
(3, 'Sofas', 'categorySofas.png'),
(7, 'Đồ trang trí', 'deco.jpg'),
(8, 'Ghế nội thất', 'ghenoithat.jpg'),
(10, 'Tủ nội thất', 'tunoithat.jpg'),
(11, 'Đèn', 'dennoithat.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(10) UNSIGNED NOT NULL,
  `id_member` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_product` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id_comment`, `id_member`, `content`, `id_product`, `date_comment`) VALUES
(2, 'khanh', 'Tủ nhỏ có hộc kéo với chất liệu gỗ tre ép dày 18mm siêu cứng đang là một vật liệu mới thay thế gỗ tự nhiên với màu sắc đẹp mắt chống nước', 'Tu_nho', '2020-06-21 05:13:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_bills`
--

CREATE TABLE `detail_bills` (
  `id_detail_bill` int(10) UNSIGNED NOT NULL,
  `id_bill` int(11) NOT NULL,
  `id_product` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_buy` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `detail_bills`
--

INSERT INTO `detail_bills` (`id_detail_bill`, `id_bill`, `id_product`, `quantity_buy`, `amount`) VALUES
(2, 6708944, 'Tu_nho', 2, 1800000),
(3, 6708944, 'Tra_Sua_Okinawa2', 1, 7125000),
(4, 31621145, 'Ban_nhua_2', 1, 1200000),
(5, 75305635, 'Ban_Cafe_go_me_Tay_nguyen_tam_tron', 1, 1800000),
(6, 75305635, 'Ban-nhua', 1, 475000),
(7, 66126304, 'Tu_nho', 2, 1800000),
(8, 66126304, 'Tra_Sua_Okinawa2', 1, 7125000),
(9, 66126304, 'Ban_nhua_3', 1, 2800000),
(10, 66126304, 'Ghe_sac_mau', 1, 1100000),
(14, 84408242, 'Tu_nho', 1, 900000),
(19, 41356412, 'Ban_Cafe_go_me_Tay_nguyen_tam_tron', 1, 1800000),
(20, 41356412, 'Ghe_thu_gian,_cafe_hinh_Canh_Dieu_co_nem_nhieu_mau', 1, 1000000),
(21, 41356412, 'Ghe_cafe_lung_nem_nhung_chan_mau_dong', 1, 1200000),
(22, 41356412, 'Ghe_sofa_don_-_63x66x76_(cm)', 4, 15048000),
(23, 41356412, 'Ke_trang_tri_CASAN_5_tang_go_ket_hop_khung_sat_60x36x160(cm)', 1, 1700000),
(30, 42239422, 'Ban_lam_viec_ARGON_gap_gon_120x60x75(cm)', 2, 2376000),
(31, 42239422, 'Ghe_thu_gian,_cafe_hinh_Canh_Dieu_co_nem_nhieu_mau', 1, 1000000),
(32, 42239422, 'Ban_nhua_2', 1, 1200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id_member` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_member` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_member` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status_member` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id_member`, `name_member`, `email`, `phone_number`, `address`, `password`, `gender`, `img_member`, `role`, `status_member`, `remember_token`) VALUES
('khanh', 'Nguyễn Khánh', 'khanh26122000@gmail.com', '0868003429', '54/82 Nguyễn Lương Bằng, Liên Chiểu, Đà Nẵng', '$2y$10$0dXZwwaJahgyJM8IjR/.XeN1/U9hraYo9cmBjRVurAfMazj1fKoZC', 'Nam', 'user.jpg', 1, 1, 'lNodLTBOzHbkjTY7vQBOMzHMgiBrNOUawz0nE1SwFYntkXIrPcL2l0LFJ7OW'),
('khanh2', 'Nguyễn Khánh', 'khanhnpd02983@fpt.edu.vn', '0868003429', '82 Nguyễn Lương Bằng, Liên Chiểu, Đà Nẵng', '$2y$10$RAHya3DxTeX1SuIlKCOjE.qcCqaDsA6D28g1SGbfE7RQGIdvMQNdG', 'Nam', 'user.jpg', 0, 1, NULL);

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
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_06_11_142243_create_categories_table', 1),
(13, '2020_06_11_143026_create_products_table', 2),
(15, '2020_06_11_145424_create_members_table', 3),
(16, '2020_06_11_150551_create_comments_table', 4),
(18, '2020_06_11_150929_create_bills_table', 5),
(20, '2020_06_11_151327_create_detail_bills_table', 6),
(22, '2020_06_11_153126_add_foreign_product', 7),
(24, '2020_06_11_153720_add_foreign_comments', 8),
(25, '2020_06_11_154138_add_foreign_bills', 9),
(27, '2020_06_11_154444_add_foreign_detail_bills', 10),
(29, '2020_06_12_071730_add_nominations_product', 11),
(30, '2014_10_12_100000_create_password_resets_table', 12),
(31, '2020_06_18_140202_add_remember_token', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('khanh26122000@gmail.com', '$2y$10$04A4PxeyuXP8IIAehLT0ru6I5P2bmGpIFqaGWfeRi6G1Vf0YEGyUe', '2020-06-19 00:43:21'),
('khanhnpd02983@fpt.edu.vn', '$2y$10$Q5CWKPSnOnzIRZysdyGVn.j8g0d9xhuJxH65u2mtfMu4wijSt2iRW', '2020-06-19 00:45:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id_product` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_product` double NOT NULL,
  `sale` double(4,1) NOT NULL,
  `quantity_product` int(11) NOT NULL,
  `img_product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `decscription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `nomination` tinyint(4) NOT NULL,
  `img_product_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_product_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `name_product`, `price_product`, `sale`, `quantity_product`, `img_product`, `decscription`, `view`, `nomination`, `img_product_2`, `img_product_3`, `date`) VALUES
('Ban_Cafe_go_me_Tay_nguyen_tam_tron', 2, 'Bàn Cafe gỗ me Tây nguyên tấm tròn', 1800000, 0.0, 11, 'ban-cafe-go-me-tay-nguyen-tam-chan-gang-1.jpg', 'as', 25, 0, 'ban-cafe-go-me-tay-nguyen-tam-chan-gang-1.jpg', 'ban-cafe-go-me-tay-nguyen-tam-chan-gang-1.jpg', '2020-06-21 14:34:47'),
('Ban_lam_viec_ARGON_chan_gap_120x60x75(cm)', 2, 'Bàn làm việc ARGON chân gấp 120x60x75(cm)', 1500000, 0.0, 12, 'ban-lam-viec-chan-gap-4.jpg', 'Bàn làm việc ARRGON gấp gọn 120x60x75(cm) là sản phẩm thuộc hệ \"ARON\" với mặt bàn được làm hoàn toàn bằng gỗ tự nhiên đã qua xử lý chống cong vênh, chống mối mọt, bên ngoài được bảo vệ bởi một lớp PU chống thấm và phủ 2K chống trầy đảm bảo độ bền cho sản phẩm. Thiết kế đơn giản và tiện lợi, mặt bàn kích thước chuẩn giúp bạn có thể bố cục đồ đạc một cách dễ dàng.', 43, 1, 'ban-lam-viec-chan-gap-4.jpg', 'ban-lam-viec-chan-gap-4.jpg', '2020-06-21 14:32:58'),
('Ban_lam_viec_ARGON_gap_gon_120x60x75(cm)', 2, 'Bàn làm việc ARGON gấp gọn 120x60x75(cm)', 1200000, 1.0, 30, 'ban-argon-120-60-cm-nau-lau-07.jpg', 'Bàn làm việc ARRGON gấp gọn 120x60x75(cm) là sản phẩm thuộc hệ \"ARGON\" với mặt bàn được làm bằng gỗ cao su tiêu chuẩn AA dày 17mm rất ưu Việt , bên ngoài được bảo vệ bởi một lớp PU chống thấm và  chống trầy đảm bảo độ bền cho sản phẩm. Thiết kế đơn giản và tiện lợi, mặt bàn kích thước chuẩn giúp bạn có thể bố cục đồ đạc một cách dễ dàng. Hệ Chân Argon đặc biệt gấp gọn dễ dàng và rất chắc chắn', 2, 0, 'ban-argon-120-60-cm-nau-lau-05.jpg', 'ban-argon-120-60-cm-nau-lau-02.jpg', '2020-06-23 03:29:29'),
('Ban_nhua_2', 7, 'Kệ trang trí DRACO 3 tầng gỗ kết hợp khung sắt', 1200000, 0.0, 12, 'ke-trang-tri-3-tang-02.jpg', 'Kệ trang trí gỗ 3 tầng khung sắt 80x32x92(cm) sử dụng bộ khung sắt hình chữ L cố định ở 2 bên, giúp cho kệ sách có được độ ổn định, vững chắc và không bị rung lắc. Bộ khung sắt và kệ gỗ được làm tách rời nên rất dễ tháo rời, vận chuyển hoặc nâng cấp. Bạn cũng có thể sử dụng làm kệ trưng bày sản phẩm, nhờ vào thiết kế đơn giản, tiện dung và dễ kết hợp làm hệ thống nhiều kệ. \r\nKệ được kết hợp giữa khung sắt và gỗ cao su AA giúp mang lại chất lượng vượt trội mà lại rất tiết kiệm chi phí. Chất lượng gỗ cao su đạt chuẩn xuất khẩu, đã được xử lý chống cong vênh, chống mói mọt, được sơn phủ lớp PU chống thấm nước, thể hiện được màu sắc và đường vân gỗ uốn lượn rất sang trọng. Phần kệ và khung hoàn toàn được lắp lắp, bắt vít nên rất thuận thiện cho quá trình vận chuyển hoặc thay đổi. Với kích thước nhỏ gọn giúp cho chiếc kệ rất gọn gàng và dễ dàng đặt vào những góc nhỏ hẹp của căn nhà.', 30, 1, 'ke-trang-tri-3-tang-02.jpg', 'ke-trang-tri-3-tang-02.jpg', '2020-06-21 04:29:55'),
('Ban_nhua_3', 7, 'Kệ sách gỗ trang trí 5 tầng khung sắt hộp 120x34x162 (cm)', 2800000, 0.0, 12, 'Ke_trang_tri_m06-01.jpg', 'Kệ sách gỗ cao su 5 tầng tủ dưới chân gỗ 120x34x162 (cm) được thiết kế đơn giản với  màu sắc đẹp mắt và khung sắt sơn tĩnh điện hàn cố định chắc chắn, Kệ sách có 5 tầng giúp tăng khả năng lưu trữ, phối màu đẹp mắt nhờ sự đa dạnh trong màu gỗ như màu  tự màu tự nhiên, màu đen, và màu nâu lau của HOMEOFFICE. Bạn cũng có thể sử dụng làm kệ trưng bày sản phẩm, nhờ vào thiết kế đơn giản, tiện dung và dễ kết hợp làm hệ thống nhiều kệ. \r\nPhần kệ được làm bằng gỗ cao su AA chuẩn xuất khẩu, đã được xử lý công nghệ chống cong vênh, được sơn phủ lớp PU chống thấm nước, thể hiện màu sắc và chất gỗ vân tự nhiên rất sang trọng. Phần khung được làm bằng sắt hộp ô vuông, được sơn tĩnh điện chống gỉ, có độ bám dính cao chống gỉ tốt. Chất lượng sản phẩm tại Home Ofice luôn được đảm bảo nhờ quy trình sản xuất, hoàn thiện công phu. Ngoài ra, bạn còn nhận dược chế độ bảo hành 12 tháng, yên tâm sử dụng hơn.', 9, 1, 'Ke_trang_tri_m06-01.jpg', 'Ke_trang_tri_m06-01.jpg', '2020-06-18 08:27:43'),
('Ban-nhua', 8, 'Ghế nhựa', 500000, 5.0, 4, 'item-29.jpg', 'Ahihi', 10, 1, 'item-29.jpg', 'item-29.jpg', '2020-06-14 12:54:02'),
('Den_de_ban_lam_viec', 11, 'Đèn để bàn làm việc', 200000, 0.0, 12, 'item-11-511x511-241x268.jpg', 'Made of wood\r\nLinen upholstery\r\nMid-century modern style\r\nGrey,navy or green color\r\nWing-shaped arms\r\nConverts from sofa to sleeper', 9, 0, 'item-11-511x511-241x268.jpg', 'item-11-511x511-241x268.jpg', '2020-06-20 16:13:52'),
('Ghe_ban_cao_lung_nem_chan_go_hoa_van_tam_giac', 8, 'Ghế bàn cao lưng nệm chân gỗ hoa văn tam giác', 500000, 0.0, 40, 'ghe-eames-lung-nem-hoa-van-tam-giac-1.jpg', 'Ghế bàn cao lưng nhựa ABS chân sắt màu đen còn được biết đến với tên gọi phổ biến hơn là ghế Eames - loại ghế được làm từ nhự cao cấp ABS đúc nguyên khối. Với thiết những đường cong nâng niu cơ thể người sử dụng, giúp giảm áp lực lên lưng và đùi - mang lại cảm giác ngồi vô cùng dễ chịu và thoải mái trong thời gian dài.', 2, 0, 'ghe-eames-lung-nem-hoa-van-tam-giac-2.jpg', 'ghe-eames-lung-nem-hoa-van-tam-giac-4.jpg', '2020-06-23 03:15:41'),
('Ghe_ban_cao_lung_nhua_mau_vang', 8, 'Ghế bàn cao lưng nhựa màu vàng', 590000, 0.0, 30, 'GBC68003-2.jpg', 'Ghế bàn cao lưng nhựa màu vàng GBC68003 là mẫu ghế thuộc dòng thiết kế Eames nỏi tiếng, luôn mang một nguồn cảm hứng cho các không gian nội thất hiện đại. Vốn là một thiết kế có từ rất lâu đời nhưng mẫu ghế GBC68003 luôn năm trong sự lựa chọn tại những nơi sang trọng như nhà hàng, khách sạn. Mẫu ghế còn phù hợp cho không gian gia đình như mẫu ghế bàn ăn hoặc mẫu ghế cho phòng làm việc. Ghế GBC68003 màu vàng có kích thước rộng 46cm, sâu 530cm và cao 81cm, lưng ghế được làm chất liệu nhựa cứng có khả năng chịu lực cực tốt, chân ghế bằng chất liệu gỗ sồi sang trọng.', 1, 0, 'GBC68003-1.jpg', 'GBC68003-3.jpg', '2020-06-23 03:26:32'),
('Ghe_cafe_lung_nem_nhung_chan_mau_dong', 8, 'Ghế cafe lưng nệm nhung chân màu đồng', 1200000, 0.0, 30, 'ghe-cafe-simili-den-chan-dong-02.jpg', 'Ghế cafe lưng nệm nhung chân màu đồng là dòng ghế mang kiểu dáng hiện đại, thanh thoát dành cho các không giạn nội thất sang trọng.  Phần nệm ghế vải nhung nhiều màu kết hợp với đó là khung chân sắt sơn tĩnh điện màu đồng mang đến cảm giác sang trọng, với kiểu dáng tinh tế , màu sắc phong phú là một lựa chọn hoàn hảo cho Nội thất ngôi nhà bạn.', 1, 0, 'ghe-cafe-nem-xanh-chan-dong-01.jpg', 'ghe-cafe-simili-nau-chan-den-01.jpg', '2020-06-23 03:49:05'),
('Ghe_sac_mau', 8, 'Ghế sắc màu', 1100000, 0.0, 12, '08-1023x1023-241x268.png', 'ahihi', 2, 0, '08-1023x1023-241x268.png', '08-1023x1023-241x268.png', '2020-06-13 07:52:44'),
('Ghe_sofa_don_-_63x66x76_(cm)', 3, 'Ghế sofa đơn - 63x66x76 (cm)', 3800000, 1.0, 20, 'ghe-sofa-don-chadwick-01.jpg', 'Ghế Sofa Đơn GSD68018 sẽ là mtộ sự lựa chọn tuyệt vời cho không gian phòng khách nhỏ. Hoặc bạn cũng có thể dùng nó làm ghế ngồi đọc sách. Kích thước: 630 x 660 x 760 mm (DxRxC). Chất liệu: Khung gỗ dầu 100%, chân gỗ sồi nhập khẩu với vân gỗ tự nhiên rất đẹp, vải bố cao cấp (và hơn 200 loại vải + màu sắc khác nhau), mút D40 (D là độ co giãn của mút xốp).', 1, 0, 'ghe-sofa-don-chadwick-02.jpg', 'ghe-sofa-don-chadwick-03.jpg', '2020-06-23 03:32:48'),
('Ghe_thu_gian,_cafe_hinh_Canh_Dieu_co_nem_nhieu_mau', 8, 'Ghế thư giãn, cafe hình Cánh Diều có nệm nhiều màu', 1000000, 0.0, 30, 'ghe-cafe-thu-gian-canh-dieu-10.jpg', 'Ghế thư giãn, cafe hình Cánh Diều có nệm mẫu thiết kế hiện đại lấy ý tưởng từ cánh diều sáo với kích thước tiêu chuẩn xuất khẩu Châu Âu rộng rãi và thoải mái, hệ khung sắt tròn hàn cố định kiểu chân kết hợp với khung lưng chia làm 2 phần là hệ các khung sắt tròn nhỏ uốn cong tạo nên tư thế ngồi thư giãn hoặc cafe rất thoải mái, mẫu ghế kết hợp với bàn sắt rất đẹp mắt. Mẫu ghế có thể dùng làm ghế thư giãn trong phòng khách hoặc làm ghế cafe trong nội thất bàn ghế cafe rất đẹp mắt, sản phẩm được giới trẻ ưa chuộng là nơi chụp hình check in lý tưởng, Sản phẩm có hai màu đen trắng lựa chọn', 1, 0, 'ghe-cafe-thu-gian-canh-dieu-5.jpg', 'ghe-cafe-thu-gian-canh-dieu-4.jpg', '2020-06-23 03:46:24'),
('Ke_trang_tri_CASA_3_tang_go_ket_hop_khung_sat_40x36x93(cm)', 7, 'Kệ trang trí CASA 3 tầng gỗ kết hợp khung sắt 40x36x93(cm)', 950000, 0.0, 30, 'ke-trang-tri-casa-3-tang-01.jpg', 'Kệ trang trí CASA 3 tầng gỗ kết hợp khung sắt sở hữu một kiểu dáng đơn giản, gọn gàng mà lại tinh tế với 3 ngăn tầng để đồ rất tiện lợi, phần gỗ được thiết kế thêm viền tạo sự chắc chắn, kệ trang trí CASA sẽ là một món đồ nội thất đóng vai trò quan trọng trong ngôi nhà của bạn. Với kích thước nhỏ gọn của KS68090 40x36x91(cm)  giúp kệ trở nên ưu thế hơn hẳn trong các không gian chật hẹp, bạn hoàn toàn có thể đặt nó tại bất cứ đâu trong nhà mà không sợ chiếm diện tích. Bạn có thể tận dụng nó để làm kệ sách, kệ trang trí hoặc làm kệ trưng bày sản phẩm cho cửa hàng đều được.', 1, 0, 'ke-trang-tri-casa-3-tang-03.jpg', 'ke-trang-tri-casa-3-tang-kt.jpg', '2020-06-23 03:40:29'),
('Ke_trang_tri_CASAN_5_tang_go_ket_hop_khung_sat_60x36x160(cm)', 7, 'Kệ trang trí CASAN 5 tầng gỗ kết hợp khung sắt 60x36x160(cm)', 1700000, 0.0, 40, 'ke-trang-tri-casan-5-tang-01.jpg', 'KS68093 - Kệ trang trí CASAN 5 tầng gỗ kết hợp khung sắt  thuộc dòng kệ CASAN với thiết kế lạ mắt, gỗ cao su kết hợp khung sắt được gia công hoàn thiện tỉ mỉ, chắc chắn. Thiết kế phù hợp với không gian văn phòng và gia đình.Bạn cũng có thể sử dụng làm kệ trưng bày sản phẩm, nhờ vào thiết kế đơn giản, tiện dung và dễ kết hợp làm hệ thống nhiều kệ. \r\nPhần kệ được làm bằng gỗ cao su AA chuẩn xuất khẩu, đã được xử lý công nghệ chống cong vênh, được sơn phủ lớp PU chống thấm nước, thể hiện màu sắc và chất gỗ vân tự nhiên rất sang trọng. Phần khung được làm bằng sắt hộp ô vuông, được sơn tĩnh điện chống gỉ, có độ bám dính cao chống gỉ tốt. Chất lượng sản phẩm tại Home Ofice luôn được đảm bảo nhờ quy trình sản xuất, hoàn thiện công phu. Ngoài ra, bạn còn nhận dược chế độ bảo hành 12 tháng, yên tâm sử dụng hơn.', 3, 1, 'ke-trang-tri-casan-5-tang-02.jpg', 'ke-trang-tri-casan-5-tang-03.jpg', '2020-06-23 03:36:41'),
('Ke_tu_trang_tri_chan_Hairpin', 10, 'Kệ tủ trang trí chân Hairpin', 3800000, 0.0, 20, 'tutrangtri.jpg', 'Kệ tủ trang trí chân Hairpin ( Pinleg) (100x40x1100mm) với chất liệu 100% gỗ cao su ghép dày 17mm tiêu chuẩn AA, PU màu gỗ tự nhiên chất lượng bề mặt cực đẹp, hộc kéo lớn sơn trắng có khóa và các hệ đợt kệ cho nhiều không gian lưu trữ, phủ hợp với rất nhiều không gian sử dụng như làm kệ trang trí phòng khách, kệ hồ sơ văn phòng, kệ lưu trữ đồ đạc ..', 1, 0, 'tutrangtri2.jpg', 'tutrangtri3.jpg', '2020-06-23 03:12:18'),
('Tra_Sua_Okinawa', 10, 'Tủ cá nhân 2 hộc kéo LUZO gỗ cao su (50x35x78cm)', 1500000, 0.0, 12, 'tu-dau-giuong-go-2-ngan-keo-1.jpg', 'Tủ cá nhân 2 hộc kéo LUZO gỗ cao su (50x35x78cm) được làm bằng chất liệu gỗ cao su tiêu chuẩn AA sơn PU hoàn thiện màu sắc đẹp với 5 màu lựa chọn kích thước nhỏ có thể đặt tại bất cứ không gian nào, nhà ở hay văn phòng đều được. Thiết kế đơn giản với 2 hộc kéo và 1 tầng kệ giúp đa dạng không gian lưu trữ, mẫu tủ kệ cá nhân phù hợp cho nhữn không gian nhỏ hoặc phòng ngủ.', 4, 0, 'tu-dau-giuong-go-2-ngan-keo-1.jpg', 'tu-dau-giuong-go-2-ngan-keo-1.jpg', '2020-06-19 03:42:22'),
('Tra_Sua_Okinawa2', 3, 'Ghế sofa băng LOVESEATS', 7500000, 5.0, 12, 'sfb68024-ghe-sofa-bang-dai-loveseats-mau-trang.jpg', 'Ghế sofa băng LOVESEATS là chiếc ghế có thiết kế sang trọng, vừa vặn cho 1 căn phòng khách hiện đại và đủ ấn tượng với những người khách cũng như làm vừa lòng gia chủ. Kiểu dáng hiện đại, sang trọng với gam màu trung tính, hạn chế tối đa những rủi ro về màu sắc khi phối với các vật dụng nội thất khác nhau. Chiếc ghế này có chất liệu vải bố / nỉ / nhung / simili với hơn 200 loại vải và màu sắc khác nhau. Khung gỗ dầu chắc chắn, chân gỗ sồi nhập khẩu hoặc chân sắt.', 11, 0, 'sfb68024-ghe-sofa-bang-dai-loveseats-mau-trang.jpg', 'sfb68024-ghe-sofa-bang-dai-loveseats-mau-trang.jpg', '2020-06-21 14:35:00'),
('Tu_nho', 2, 'Tủ nhỏ', 1000000, 10.0, 9, 'item-05-511x511-241x268.jpg', 'Tủ nhỏ có hộc kéo với chất liệu gỗ tre ép dày 18mm siêu cứng đang là một vật liệu mới thay thế gỗ tự nhiên với màu sắc đẹp mắt chống nước tuyệt đối nên rất phù hợp cho không gian nhà bếp, thiết kế 3 tầng với hộc kéo dưới mặt giúp dễ dàng thao tác sử dụng, có thể dùng làm đảo bếp mini trong gia đình cũng rất tiện lợi.', 195, 1, '08-1023x1023-241x268.png', 'ban-cafe-go-me-tay-nguyen-tam-chan-gang-1.jpg', '2020-06-21 08:17:24');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `bills_id_member_foreign` (`id_member`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `comments_id_member_foreign` (`id_member`),
  ADD KEY `comments_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `detail_bills`
--
ALTER TABLE `detail_bills`
  ADD PRIMARY KEY (`id_detail_bill`),
  ADD KEY `detail_bills_id_bill_foreign` (`id_bill`),
  ADD KEY `detail_bills_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `products_id_category_foreign` (`id_category`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `detail_bills`
--
ALTER TABLE `detail_bills`
  MODIFY `id_detail_bill` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `detail_bills`
--
ALTER TABLE `detail_bills`
  ADD CONSTRAINT `detail_bills_id_bill_foreign` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id_bill`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_bills_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
