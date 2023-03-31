-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 09:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_qld`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_439dkhd`
--

CREATE TABLE `list_439dkhd` (
  `id` int(11) NOT NULL,
  `mssv` varchar(100) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `lop` varchar(15) NOT NULL,
  `gioi_tinh` varchar(5) NOT NULL,
  `khoa` varchar(50) DEFAULT NULL,
  `fk_idhd` int(11) NOT NULL,
  `tenhoatdong` varchar(100) DEFAULT NULL,
  `noidunghoatdong` varchar(255) DEFAULT NULL,
  `hocki` varchar(100) DEFAULT NULL,
  `ngay_bd` date DEFAULT NULL,
  `fk_idct` int(11) NOT NULL DEFAULT 1,
  `trang_thai` varchar(20) DEFAULT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_439dkhd`
--

INSERT INTO `list_439dkhd` (`id`, `mssv`, `ho_ten`, `lop`, `gioi_tinh`, `khoa`, `fk_idhd`, `tenhoatdong`, `noidunghoatdong`, `hocki`, `ngay_bd`, `fk_idct`, `trang_thai`, `date_entered`) VALUES
(2, 'B1910439', 'Võ Phạm Thanh Quyền', 'DI19V7A8', 'Nữ', 'Công Nghê Thông Tin', 3, NULL, NULL, NULL, NULL, 3, NULL, '2022-11-21 13:27:15'),
(4, 'B1910439', 'Võ Phạm Thanh Quyền', 'DI19V7A8', 'Nữ', 'Công Nghê Thông Tin', 7, NULL, NULL, NULL, NULL, 3, NULL, '2022-11-21 13:27:27'),
(5, 'B1910439', 'Võ Phạm Thanh Quyền', 'DI19V7A8', 'Nữ', 'Công Nghê Thông Tin', 3, NULL, NULL, NULL, NULL, 3, NULL, '2022-11-18 02:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `list_b1910439`
--

CREATE TABLE `list_b1910439` (
  `id` int(11) NOT NULL,
  `mssv` varchar(50) NOT NULL,
  `ho_ten` varchar(150) NOT NULL,
  `gioi_tinh` varchar(10) NOT NULL,
  `lop` varchar(50) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `noi_sinh` varchar(255) NOT NULL,
  `thuong_tru` varchar(255) NOT NULL,
  `khoa` varchar(100) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_b1910439`
--

INSERT INTO `list_b1910439` (`id`, `mssv`, `ho_ten`, `gioi_tinh`, `lop`, `ngay_sinh`, `noi_sinh`, `thuong_tru`, `khoa`, `filename`, `date_entered`) VALUES
(2, 'B1910439', 'Võ Phạm Thanh Quyền', 'Nữ', 'DI19V7A8', '2001-08-23', 'Bệnh Viện Phụ Sản', 'Ấp Tân Long, Xã Tân Bình, Huyện Phụng Hiệp, Tỉnh Hậu Giang', 'Công Nghệ Thông Tin', '', '2022-11-21 13:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `list_chitiet`
--

CREATE TABLE `list_chitiet` (
  `id` int(11) NOT NULL,
  `trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_chitiet`
--

INSERT INTO `list_chitiet` (`id`, `trang_thai`) VALUES
(1, 'Đã Đăng Ký'),
(2, 'Không Tham Gia'),
(3, 'Có tham Gia');

-- --------------------------------------------------------

--
-- Table structure for table `list_danhgia`
--

CREATE TABLE `list_danhgia` (
  `id` int(10) UNSIGNED NOT NULL,
  `stt` varchar(10) NOT NULL,
  `m_tc` varchar(5) NOT NULL,
  `ten_tc` varchar(255) NOT NULL,
  `diem_td` varchar(11) NOT NULL,
  `dl_k` varchar(11) NOT NULL,
  `sv_dg` varchar(11) NOT NULL,
  `cvht_dg` varchar(11) NOT NULL,
  `diem_t` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_danhgia`
--

INSERT INTO `list_danhgia` (`id`, `stt`, `m_tc`, `ten_tc`, `diem_td`, `dl_k`, `sv_dg`, `cvht_dg`, `diem_t`) VALUES
(1, '1', 'I', 'I. Đánh giá về ý thức tham gia học tập (Điều 4, Quy chế Đánh giá kết quả rèn luyện)', '20', '0', '0', '0', '0'),
(2, '', 'I.a', 'a. Ý thức và thái độ trong học tập.', '', '', '', '', ''),
(3, '', 'I.b', ' b. Ý thức và thái độ tham gia các câu lạc bộ học thuật, các hoạt động học thuật, hoạt động ngoại khóa, hoạt động nghiên cứu khoa học.', '6', '0', '0', '0', '0'),
(4, '', 'I.b.1', ' Nghiên cứu khoa học (NCKH)', '', '', '', '', ''),
(5, '', '', '- Có tham gia đề tài NCKH của sinh viên hoặc của Khoa và cấp tương đương, có xác nhận của Chủ nhiệm đề tài (Không tính bài tập, tiểu luận, đồ án môn học, luận văn...)', '5', '0', '0', '0', '0'),
(6, '', 'I.b.2', 'Hoàn thành chứng chỉ ngoại ngữ, tin học.', '', '', '', '', ''),
(7, '', '', '- Ngoại ngữ không chuyên/chứng chỉ A/chuẩn khung Châu Âu.', '3', '0', '0', '0', '0'),
(8, '', '', '- Chứng chỉ B/chuẩn khung Châu Âu.', '5', '0', '0', '0', '0'),
(9, '', '', ' - Chứng chỉ C/chuẩn khung Châu Âu', '7', '0', '0', '0', '0'),
(10, '', '', ' - Riếng chứng chỉ ngoại ngữ, Chứng nhận Toefl >= 500 điểm; IELTS >= 5.0', '10', '0', '0', '0', '0'),
(11, '', 'I.b.3', 'Tham gia các kỳ thi chuyên ngành, thi Olympic...', '', '', '', '', ''),
(12, '', '', '- Có tham gia kỳ thi', '2', '0', '0', '0', '0'),
(13, '', '', ' - Đạt giải cấp Trường', '4', '0', '0', '0', '0'),
(14, '', '', '- Đạt giải cấp cao hơn.', '7', '0', '0', '0', '0'),
(15, '', 'I.c', ' c. Ý thức và thái độ tham gia các kỳ thi, cuộc thi.', '', '', '', '', ''),
(16, '', '', '  - Không vi phạm quy chế về thi, kiểm tra (Mỗi lần vi phạm trừ 03 điểm)', '6', '0', '0', '0', '0'),
(17, '', 'I.d', ' d. Tinh thần vượt khó, phấn đấu vươn lên trong học tập.', '', '', '', '', ''),
(18, '', '', ' - Có cố gắng, vượt khó trong học tập (có ĐTB học kỳ sau lớn hơn học kỳ trước đó; đối với SV năm thứ nhất, học kỳ I không có điểm dưới 4)', '2', '0', '0', '0', '0'),
(19, '', 'I.e', 'e. Kết quả học tập', '', '', '', '', ''),
(20, '', 'I.e.1', ' Kết quả học tập trong học kỳ:', '', '', '', '', ''),
(21, '', '', ' - Điểm trung bình chung học kỳ (ĐTBCHK) đạt >= 3,60', '8', '0', '0', '0', '0'),
(22, '', '', '- ĐTBCHK đạt từ 3,20 đến 3,59', '6', '0', '0', '0', '0'),
(23, '', '', ' - ĐTBCHK đạt từ 2,50 đến 3,19', '4', '0', '0', '0', '0'),
(24, '', '', '- ĐTBCHK đạt từ 2,00 đến 2,49', '2', '0', '0', '0', '0'),
(25, '2', 'II', 'II. Đánh giá về ý thức và kết quả chấp hành nội quy, quy chế, quy định trong nhà trường(Điều 5, Quy chế Đánh giá kết quả rèn luyện)', '25', '0', '0', '0', '0'),
(26, '', 'II.a', ' a. Ý thức chấp hành các văn bản chỉ đạo của ngành, của cơ quan chỉ đạo cấp trên được thực hiện trong nhà trường.', '', '', '', '', ''),
(27, '', '', ' - Không vi phạm và có ý thức tham gia thực hiện nghiêm túc các quy định của Lớp, nội quy, quy chế của trường, Khoa và các tổ chức trong nhà trường (Mỗi lần vi phạm trừ điểm theo quy định)', '15', '0', '0', '0', '0'),
(28, '', 'II.b', 'b. Ý thức chấp hành các nội quy, quy chế và các quy định khác được áp dụng trong nhà trường.', '', '', '', '', ''),
(29, '', '', ' - Giữ gìn vệ sinh, môi trường, bảo vệ cảnh quan môi trường,an ninh, trật tự nơi công cộng có xác nhận của Đoàn khoa.', '10', '0', '0', '0', '0'),
(30, '', '', ' - Giữ gìn an ninh, trật tự nơi công cộng vệ sinh, bảo vệ cảnh quan môi trường, nếp sống văn minh (có xác nhận của Đoàn Trường ...)', '10', '0', '0', '0', '0'),
(31, '3', 'III', 'III. Đánh giá về ý thức tham gia các hoạt động chính trị, xã hội, văn hóa, văn nghệ, thể thao, phòng chống tội phạm và các tệ nạn xã hội (Điều 6, Quy chế Đánh giá kết quả rèn luyện)', '20', '0', '0', '0', '0'),
(32, '', 'III.a', ' a. Ý thức và hiệu quả tham gia các hoạt động rèn luyện về chính trị, xã hội, văn hóa, văn nghệ, thể thao.', '', '', '', '', ''),
(33, '', '', ' - Tham gia đầy đủ các hoạt động chính trị, xã hội, văn hóa, văn nghệ, thể thao các cấp từ Lớp, Chi hội, Chi đoàn trở lên tổ chức (Mỗi lần vắng trừ 02 điểm từ cấp đơn vị lớp trở lên).', '12', '0', '0', '0', '0'),
(34, '', 'III.b', 'b. Ý thức tham gia các hoạt động công ích tình nguyện, công tác xã hội.', '', '', '', '', ''),
(35, '', '', ' - Cấp Bộ môn, Chi đoàn, Chi hội, Đội, Nhóm', '5', '0', '0', '0', '0'),
(36, '', 'III.c', 'c. Tham gia tuyên truyền, phòng chống tội phạm và các tệ nạn xã hội.', '', '', '', '', ''),
(37, '', '', '- Bằng khen trở lên.', '10', '0', '0', '0', '0'),
(38, '4', 'IV', 'IV. Đánh giá về ý thức công dân trong quan hệ cộng đồng (Điều 7, Quy chế Đánh giá kết quả rèn luyện)', '25', '0', '0', '0', '0'),
(39, '', 'IV.a', ' a. Ý thức chấp hành và tham gia tuyên truyền các chủ trương của Đảng, chính sách, pháp luật của Nhà nước trong cộng đồng.', '', '', '', '', ''),
(40, '', '', '- Không vi phạm pháp luật của Nhà nước (Nếu vi phạm pháp luật sẽ bị điểm 00 (điểm không)).', '15', '0', '0', '0', '0'),
(41, '', 'IV.b', ' b. Ý thức tham gia các hoạt động xã hội có thành tích được ghi nhận, biểu dương, khen thưởng.', '', '', '', '', ''),
(42, '', '', '- Tham gia đội nhóm sinh hoạt hướng đên lợi ích cộng đồng (tham gia công tác xã hội ở trường, nơi cư trú, địa phương).', '10', '0', '0', '0', '0'),
(43, '', 'IV.c', ' c. Có tinh thần chia sẻ, giúp đỡ người thân, người có khó khăn, hoạn nạn.', '', '', '', '', ''),
(44, '', '', '   - Có tinh thần giúp đỡ bạn bè trong học tập, trong cuộc sống.', '10', '0', '0', '0', '0'),
(45, '5', 'V', 'V. Đánh giá về ý thức và kết quả khi tham gia công tác cán bộ lớp, các đoàn thể, tổ chức trong nhà trường hoặc người học đạt được thành tích đặc biệt trong học tập, rèn luyện (Điều 8, Quy chế Đánh giá kết quả rèn luyện).', '10', '0', '0', '0', '0'),
(46, '', 'V.a', 'a. Ý thức, tinh thần thái độ, uy tín và hiệu quả công việc của người học được phân công nhiệm vụ quản lý lớp, các tổ chức Đảng, Đoàn thanh niên, Hội sinh viên và các tổ chức khác trong nhà trường.', '', '', '', '', ''),
(47, '', '', '- Lớp trưởng, Bí thư Chi đoàn, Ủy viên BCH đoàn thể cấp cao hơn Chi đoàn, BCH Hội sinh viên Trường, Liên Chi hội trưởng, Chi hội trưởng, Đội trưởng các Đội, Nhóm, Câu lạc bộ từ cấp khoa và tương đương.', '10', '0', '0', '0', '0'),
(48, '', 'V.b', ' b. Kỹ năng tổ chức, quản lý lớp, quản lý các tổ chức Đảng, Đoàn thanh niên, Hội sinh viên và các tổ chức khác trong nhà trường.', '', '', '', '', ''),
(49, '', '', ' - Là thành viên của các Ban chuyên môn Đoàn, Hội sinh viên trường hoàn thành nhiệm vụ có xác nhận của Đoàn hoặc Hội sinh viên.', '8', '0', '0', '0', '0'),
(50, '', 'V.c', 'c. Hỗ trợ và tham gia tích cực vào các hoạt động chung của lớp, tập thể, khoa và nhà trường.', '', '', '', '', ''),
(51, '', '', '  - Tích cực tham gia hỗ trợ các hoạt động, phong trào của cấp Khoa, sự kiện chung của nhà trường có xác nhận của đơn vị tổ chức sự kiện (Mỗi đợt tham gia được cộng 01 điểm).', '6', '0', '0', '0', '0'),
(52, '', 'V.d', 'd. Người học đạt được các thành tích đặc biệt trong học tập, rèn luyện.', '', '', '', '', ''),
(53, '', '', '  - Được kết nạp Đảng, hoặc được công nhận Đoàn viên ưu tú.', '6', '0', '0', '0', '0'),
(54, '', '', '- Đạt danh hiệu sinh viên 5 tốt cấp trường trở lên.', '6', '0', '0', '0', '0'),
(55, '', '', '- Đạt danh hiệu sinh viên 5 tốt cấp Khoa', '4', '0', '0', '0', '0'),
(56, '', '', ' - Phân loại Đảng viên được xếp loại mức 2', '2', '0', '0', '0', '0'),
(57, '', '', 'Tổng điểm', '100', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `list_hdb1910439`
--

CREATE TABLE `list_hdb1910439` (
  `id` int(11) NOT NULL,
  `noidung_hoatdong` varchar(500) NOT NULL,
  `hoc_ki` varchar(150) NOT NULL,
  `diemrl` int(11) NOT NULL,
  `xeploai` varchar(100) NOT NULL,
  `fk_b1910439` int(11) NOT NULL,
  `mssv` varchar(150) DEFAULT NULL,
  `ho_ten` varchar(150) DEFAULT NULL,
  `lop` varchar(150) DEFAULT NULL,
  `khoa` varchar(150) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_hdb1910439`
--

INSERT INTO `list_hdb1910439` (`id`, `noidung_hoatdong`, `hoc_ki`, `diemrl`, `xeploai`, `fk_b1910439`, `mssv`, `ho_ten`, `lop`, `khoa`, `filename`, `created_at`, `updated_at`) VALUES
(3, '', '', 0, '', 2, 'B1910439', NULL, NULL, NULL, '', '2022-11-23 07:02:34', '2022-11-05 15:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `list_hoatdong`
--

CREATE TABLE `list_hoatdong` (
  `id` int(11) NOT NULL,
  `tenhoatdong` varchar(255) NOT NULL,
  `noidunghoatdong` varchar(255) NOT NULL,
  `hocki` varchar(50) NOT NULL,
  `gio` varchar(50) NOT NULL,
  `ngay_bd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_hoatdong`
--

INSERT INTO `list_hoatdong` (`id`, `tenhoatdong`, `noidunghoatdong`, `hocki`, `gio`, `ngay_bd`) VALUES
(2, 'Chuyên Đề Hoạt Động Học Thuật', 'Lập Trình Game Cơ Bản', 'HK 1', '9 giờ', '2022-11-01'),
(3, 'Chuyên Đề Hoạt Động Lao Động', 'Lao Động Đoàn Khoa CNTT&TT', 'HK 1', '13 giờ', '2022-11-22'),
(4, 'Chuyên Đề Hoạt Động Học Thuật', 'Lập Trình Web Cơ Bản', 'HK 2', '10 giờ', '2022-11-14'),
(6, 'Chuyên Đề Hoạt Động Lao Động', 'Lao Động Đoàn Khoa CNTT&TT', 'HK 2', '15 giờ', '2022-11-08'),
(7, 'Chuyên Đề Hoạt Động Học Thuật', 'Lập Trình Java Cơ Bản', 'HK 1', '10 giờ', '2022-11-02'),
(10, 'Chuyên Đề Hoạt Động Học Thuật', 'Lập Trình C/C++ Cơ Bản', 'HK 2', '10 giờ', '2022-11-07'),
(12, 'Chuyên Đề Hoạt Động Học Thuật', 'Lập Trình C++', 'HK 1', '15 giờ', '2022-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `list_student`
--

CREATE TABLE `list_student` (
  `id` int(11) NOT NULL,
  `mssv` varchar(10) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `lop` varchar(50) NOT NULL,
  `khoa` varchar(150) NOT NULL,
  `gioi_tinh` varchar(10) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `noi_sinh` varchar(255) NOT NULL,
  `thuong_tru` varchar(255) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `noidung_hoatdong` varchar(255) NOT NULL,
  `hoc_ki` varchar(50) NOT NULL,
  `diemrl` int(11) NOT NULL,
  `xeploai` varchar(50) NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_student`
--

INSERT INTO `list_student` (`id`, `mssv`, `ho_ten`, `lop`, `khoa`, `gioi_tinh`, `ngay_sinh`, `noi_sinh`, `thuong_tru`, `filename`, `noidung_hoatdong`, `hoc_ki`, `diemrl`, `xeploai`, `date_entered`) VALUES
(4, 'B1910445', 'Hoàng Văn Thanh', 'DI19V7A8', 'Công Nghệ Thông Tin', 'Nam', '2001-03-28', 'Bệnh Viện', 'Ấp Kết Nghĩa', 'b1910445.docx', '', '', 0, '', '2022-11-23 06:49:45'),
(10, 'B1910487', 'Trần Thị Kim Yến', 'DI19V7A8', 'Công Nghê Thông Tin', 'Nữ', '2001-02-28', 'Sóc Trăng', 'Sóc Trăng', 'b1910487.docx', '', '', 0, '', '2022-11-21 13:26:34'),
(12, 'B1910161', 'Lê Thị Bích Trâm', 'DI19V7A6', 'Công Nghê Thông Tin', 'Nữ', '2001-06-15', 'Hậu Giang', 'Hậu Giang', 'b1910161.docx', '', '', 0, '', '2022-11-23 06:48:52'),
(15, 'B1910466', 'Trương Thị Cẩm Tiên', 'DI19V7A8', 'Công Nghê Thông Tin', 'Nữ', '2001-10-30', 'Bạc Liêu', 'Bạc Liêu', '', '', '', 0, '', '2022-11-23 06:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `list_svdkhd`
--

CREATE TABLE `list_svdkhd` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(150) NOT NULL,
  `mssv` varchar(15) NOT NULL,
  `gioi_tinh` varchar(5) NOT NULL,
  `lop` varchar(20) NOT NULL,
  `khoa` varchar(25) DEFAULT NULL,
  `fk_idhd` int(11) NOT NULL,
  `tenhoatdong` varchar(255) DEFAULT NULL,
  `noidunghoatdong` varchar(255) DEFAULT NULL,
  `hocki` varchar(150) DEFAULT NULL,
  `ngay_bd` date DEFAULT NULL,
  `id_ctht` int(11) NOT NULL DEFAULT 1,
  `trang_thai` varchar(100) NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_svdkhd`
--

INSERT INTO `list_svdkhd` (`id`, `ho_ten`, `mssv`, `gioi_tinh`, `lop`, `khoa`, `fk_idhd`, `tenhoatdong`, `noidunghoatdong`, `hocki`, `ngay_bd`, `id_ctht`, `trang_thai`, `date_entered`) VALUES
(1, 'Hoàng Văn Thanh', 'B1910445', 'Nam', 'DI19V7A8', 'Công Nghệ Thông Tin', 2, NULL, NULL, NULL, NULL, 2, '', '2022-11-18 08:27:11'),
(2, 'Lê Thị Bích Trâm', 'B1910161', 'Nữ', 'DI19V7A6', 'Công Nghệ Thông Tin', 10, NULL, NULL, NULL, NULL, 3, '', '2022-11-18 07:55:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_439dkhd`
--
ALTER TABLE `list_439dkhd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idhd` (`fk_idhd`),
  ADD KEY `fk_idct` (`fk_idct`);

--
-- Indexes for table `list_b1910439`
--
ALTER TABLE `list_b1910439`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_chitiet`
--
ALTER TABLE `list_chitiet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_danhgia`
--
ALTER TABLE `list_danhgia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_hdb1910439`
--
ALTER TABLE `list_hdb1910439`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_b1910439` (`fk_b1910439`);

--
-- Indexes for table `list_hoatdong`
--
ALTER TABLE `list_hoatdong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_student`
--
ALTER TABLE `list_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_svdkhd`
--
ALTER TABLE `list_svdkhd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idhd` (`fk_idhd`),
  ADD KEY `id_ctht` (`id_ctht`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_439dkhd`
--
ALTER TABLE `list_439dkhd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `list_b1910439`
--
ALTER TABLE `list_b1910439`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `list_chitiet`
--
ALTER TABLE `list_chitiet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_danhgia`
--
ALTER TABLE `list_danhgia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `list_hdb1910439`
--
ALTER TABLE `list_hdb1910439`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_hoatdong`
--
ALTER TABLE `list_hoatdong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `list_student`
--
ALTER TABLE `list_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `list_svdkhd`
--
ALTER TABLE `list_svdkhd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_439dkhd`
--
ALTER TABLE `list_439dkhd`
  ADD CONSTRAINT `list_439dkhd_ibfk_1` FOREIGN KEY (`fk_idhd`) REFERENCES `list_hoatdong` (`id`),
  ADD CONSTRAINT `list_439dkhd_ibfk_2` FOREIGN KEY (`fk_idct`) REFERENCES `list_chitiet` (`id`);

--
-- Constraints for table `list_hdb1910439`
--
ALTER TABLE `list_hdb1910439`
  ADD CONSTRAINT `list_hdb1910439_ibfk_1` FOREIGN KEY (`fk_b1910439`) REFERENCES `list_b1910439` (`id`);

--
-- Constraints for table `list_svdkhd`
--
ALTER TABLE `list_svdkhd`
  ADD CONSTRAINT `list_svdkhd_ibfk_1` FOREIGN KEY (`fk_idhd`) REFERENCES `list_hoatdong` (`id`),
  ADD CONSTRAINT `list_svdkhd_ibfk_2` FOREIGN KEY (`id_ctht`) REFERENCES `list_chitiet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
