-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2023 at 09:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentzo`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `addressarray` text NOT NULL,
  `defaultaddress` int(11) NOT NULL,
  `areaid` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `addressarray`, `defaultaddress`, `areaid`) VALUES
(1, 'ULkqMTGBxsN', '[{\"address_id\":1,\"fullname\":\"Mohamad Soufan\",\"mobile\":\"97986666\",\"locality\":\"\",\"fulladdress\":\"Al khoud seven\",\"city\":\"Silvassa\",\"state\":\"8\",\"pincode\":\"123\",\"email\":\"soufan1982@gmail.com\",\"addresstype\":\"home\",\"city_id\":\"321\"},{\"address_id\":2,\"fullname\":\"Mohamad Soufan\",\"mobile\":\"97986666\",\"locality\":\"\",\"fulladdress\":\"Al khoud seven\",\"city\":\"Silvassa\",\"state\":\"8\",\"pincode\":\"123\",\"email\":\"soufan1982@gmail.com\",\"addresstype\":\"home\",\"city_id\":\"321\"}]', 2, 1),
(2, 'UV0cpGzEodR', '[{\"address_id\":\"2\",\"fullname\":\"Jony Paul\",\"mobile\":\"9874627973\",\"locality\":\"\",\"fulladdress\":\"KOLKATA\",\"city\":\"Kolkata\",\"state\":\"West Bengal\",\"pincode\":\"743144\",\"email\":\"paul.jony70@gmail.com\",\"addresstype\":\"home\",\"city_id\":\"1475\",\"state_id\":\"36\"}]', 2, 1),
(3, 'UWdvRe8buNT', '[{\"address_id\":1,\"fullname\":\"Mohamad Soufan\",\"email\":\"soufan1982@gmail.com\",\"country_code\":\"968\",\"mobile\":\"97986666\",\"fulladdress\":\"JG46+RJ3, Muscat, Oman\",\"lat\":\"23.60728482283035\",\"lng\":\"58.51193633062046\",\"country_id\":\"1\",\"country\":\"Oman\",\"region_id\":\"1\",\"region\":\"MUSCAT\",\"governorate_id\":\"5\",\"governorate\":\"AS SEEB\",\"area_id\":\"144\",\"area\":\"AL KHOUDH 7\",\"addresstype\":\"home\"}]', 1, 1),
(4, 'UPfM6WcVs3n', '[{\"address_id\":2,\"fullname\":\"yuvraj\",\"mobile\":\"7354570394\",\"locality\":\"bhopal\",\"fulladdress\":\"katara hillls bhopal\",\"city\":\"bhopal\",\"state\":\"Madhya Pradesh\",\"pincode\":\"985666\",\"email\":\"yuvi384756@gmail.com\",\"addresstype\":\"home\",\"city_id\":12}]', 2, 1),
(6, 'U24a3IOsyvt', '[{\"address_id\":3,\"fullname\":\"Yash Jasoliya\",\"mobile\":\"6354822620\",\"locality\":\"\",\"fulladdress\":\"kaliyabid\",\"city\":\"Bhuj\",\"state\":\"Gujarat\",\"pincode\":\"364001\",\"email\":\"yashjasoliya.software@gmail.com\",\"addresstype\":\"home\",\"lat\":\"Gujarat\",\"lang\":\"\"}]', 3, 1),
(7, 'UJxdjAhqKTa', '[{\"address_id\":1,\"fullname\":\"Yash Jasoliya\",\"mobile\":\"7383006215\",\"locality\":\"\",\"fulladdress\":\"kaliyabid\",\"city\":\"Bhavnagar\",\"state\":\"Gujarat\",\"pincode\":\"0\",\"email\":\"yashjasoliyay@gmail.com\",\"addresstype\":\"home\",\"lat\":\"Gujarat\",\"lang\":\"\"},{\"address_id\":2,\"fullname\":\"Yash Jasoliya\",\"mobile\":\"7383006215\",\"locality\":\"\",\"fulladdress\":\"kaliyabid\",\"city\":\"Bhavnagar\",\"state\":\"Gujarat\",\"pincode\":\"364001\",\"email\":\"yash@gamil.com\",\"addresstype\":\"home\",\"lat\":\"Gujarat\",\"lang\":\"\"},{\"address_id\":3,\"fullname\":\"jasoliya Yash\",\"mobile\":\"7383006215\",\"locality\":\"\",\"fulladdress\":\"akshardham\",\"city\":\"Bhavnagar\",\"state\":\"Gujarat\",\"pincode\":\"364001\",\"email\":\"jasoliyayash842@gmail.com\",\"addresstype\":\"home\",\"lat\":\"Gujarat\",\"lang\":\"\"}]', 3, 1),
(8, 'U1W3ufw5Fah', '[{\"address_id\":\"1\",\"fullname\":\"cks\",\"mobile\":\"9067686678\",\"locality\":\"\",\"fulladdress\":\"vrachha\",\"city\":\"Surat\",\"state\":\"Gujarat\",\"pincode\":\"395010\",\"email\":\"chiragsavaliya67@gmail.com\",\"addresstype\":\"home\",\"city_id\":\"396\",\"state_id\":\"12\"}]', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `seller_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `city` int(11) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `logo` text NOT NULL,
  `checksum` varchar(100) NOT NULL,
  `create_by` datetime DEFAULT NULL,
  `update_by` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`seller_id`, `fullname`, `companyname`, `phone`, `email`, `password`, `address`, `status`, `region`, `date`, `description`, `city`, `pincode`, `state`, `country`, `logo`, `checksum`, `create_by`, `update_by`, `role_id`) VALUES
(1, 'Kamal Bunkar', 'EBuy', '+9191404040888', 'kamalbunkar07@gmail.com', 'QUVPSDZibW5xNFhKMG5haVIxbkQzUT09', 'address : ', 1, 0, '2021-11-09 00:00:00', 'dsdasd', 1111, '333705', 29, 1, '{\"72-72\":\"2022-01-27\\/fleekmart2145747688-72-72.jpeg\",\"200-200\":\"2022-01-27\\/fleekmart2145747688-200-200.jpeg\",\"166-200\":\"2022-01-27\\/fleekmart2145747688-166-200.jpeg\",\"600-600\":\"2022-01-27\\/fleekmart2145747688-600-600.jpeg\",\"500-600\":\"2022-01-27\\/fleekmart2145747688-500-600.jpeg\"}', '05230570f1aVIBz9121947', NULL, '2023-08-23 06:13:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appuser_login`
--

CREATE TABLE `appuser_login` (
  `id` int(11) NOT NULL,
  `user_unique_id` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` int(11) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `login_method` enum('google','facebook','general') NOT NULL,
  `profile_pic` text NOT NULL,
  `status` int(11) NOT NULL,
  `flagid` int(11) NOT NULL,
  `firebase_token` varchar(255) NOT NULL,
  `create_by` datetime NOT NULL,
  `update_by` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appuser_login`
--

INSERT INTO `appuser_login` (`id`, `user_unique_id`, `fullname`, `address`, `city`, `pincode`, `state`, `country`, `region`, `phone`, `email`, `password`, `login_method`, `profile_pic`, `status`, `flagid`, `firebase_token`, `create_by`, `update_by`) VALUES
(1, 'UWdvRe8buNT', 'Mohamad Soufan', '', 0, '', 0, 0, 0, '', 'soufan1982@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTte--rVVHWftoG_psILfAUR3wtbIHfJjPXV9VxwFvOA=s96-c', 1, 0, '', '2023-08-11 00:17:46', '0000-00-00 00:00:00'),
(2, 'UHfsEvjd4iG', 'Susanta Kundu', '', 0, '', 0, 0, 0, '', 'susantakunduinpl@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtcfqQ6oA3PlDScGz0MRmUD9wQtgQxI5Yb-1IeDpKVoa=s96-c', 1, 0, '', '2023-08-11 16:42:58', '0000-00-00 00:00:00'),
(3, 'UWhoNjAIrSk', 'Kavish jayanthinathan', '', 0, '', 0, 0, 0, '', 'kavish78@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTte7uq62kqLs8AGfaNbzP_FVKIQO5cf-xsy-nZWl-ujD=s96-c', 1, 0, '', '2023-08-11 21:44:50', '0000-00-00 00:00:00'),
(4, 'U6Hd4kUeJSR', 'kamal bunkar', '', 0, '', 0, 0, 0, '', 'kamal.bunkar07@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtcSTLEQ_QAQj1TdY9qTQf-sFg1IvjcvFd1OUIhVwO9tp1A=s96-c', 1, 0, '', '2023-08-12 08:34:02', '0000-00-00 00:00:00'),
(5, 'UPfM6WcVs3n', 'Yuvi Singh', '', 0, '', 0, 0, 0, '', 'yuvi384756@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTte5oVSdOEccPBpLV8DRWUlb5tJ_uKeN7kOdEmeM55Po=s96-c', 1, 0, '', '2023-08-12 09:16:29', '0000-00-00 00:00:00'),
(6, 'UJxdjAhqKTa', 'Yash Jasoliya', '', 0, '', 0, 0, 0, '', 'yashjasoliyay@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtfRpwgTbtU1k7Yvzg0Wc9V1Kfh6t3eenzRKI9UXPYuD1w=s96-c', 1, 0, '', '2023-08-12 12:05:15', '0000-00-00 00:00:00'),
(7, 'Uu9EIa7McYb', 'Sonali Giri', '', 0, '', 0, 0, 0, '', 'sonaligiri120@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtfb8kcmxezA_8WHyXwYUcx0lYcAO-A2iF3RUKw06UjW=s96-c', 1, 0, '', '2023-08-12 14:30:50', '0000-00-00 00:00:00'),
(8, 'U5SpUdyLJtK', 'ZAHRAT AL SAWSEN', '', 0, '', 0, 0, 0, '', 'zahratalsawsen2@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtfiHMd1GLh8faq2ZvYtQLFpr9IEmiynxGnKvBhZ6eyfbLQ=s96-c', 1, 0, '', '2023-08-12 18:47:33', '0000-00-00 00:00:00'),
(9, 'UV0cpGzEodR', 'JONY PAUL', '', 0, '', 0, 0, 0, '9874627973', 'paul.jony70@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtcg-uDQvDwVqswEpba8b8liB9Re5xDnIauoR1Guu6saFA=s96-c', 1, 0, '', '2023-08-13 11:47:11', '0000-00-00 00:00:00'),
(10, 'U4IfM5e8TbY', 'Saabdik Admin', '', 0, '', 0, 0, 0, '', 'saabdik007@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtcmteC9S07Zf_WpVqdvPPAiyD-WX5SX3PoJDns28qiy=s96-c', 1, 0, '', '2023-08-14 10:25:32', '0000-00-00 00:00:00'),
(11, 'UwBEnxGM5vz', 'Yuvi Solanki``', '', 0, '', 0, 0, 0, '', 'yuviraj2938@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtc8DQxBJUF_nJn75EKmNGxlCupLIJK-mKj520DbGfOj=s96-c', 1, 0, '', '2023-08-14 14:22:20', '0000-00-00 00:00:00'),
(12, 'UefSqmn4VtR', 'Yuvraj', '', 0, '', 0, 0, 0, '', 'yuvrajsinghsolanki2406@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtcdPW5PdINzVMDzLJDAnDI_ByJ_C3mMen9dquN9tlJF83M=s96-c', 1, 0, '', '2023-08-16 09:01:18', '0000-00-00 00:00:00'),
(14, 'UkFJLO0ZU52', 'kamal G', '', 0, '', 0, 0, 0, '9790090678', 'kamalgk211@gmail.com', '', 'general', '', 1, 0, '', '2023-08-26 23:07:46', '0000-00-00 00:00:00'),
(15, 'UDEFzXWJIuR', 'test', '', 0, '', 0, 0, 0, '8200721023\r\n\r\n\r\n', 'kamalgk212@gmail.com\r\n', '', 'general', '', 1, 0, '', '2023-09-02 17:58:15', '0000-00-00 00:00:00'),
(16, 'Uk3HQSMJLOl', 'kamal', '', 0, '', 0, 0, 0, '9144040888', NULL, '', 'general', '', 1, 0, '', '2023-09-03 10:06:23', '0000-00-00 00:00:00'),
(17, 'U2HQxFraJmD', 'Desert Vessel', '', 0, '', 0, 0, 0, '', 'desertvesseloman@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/AAcHTtfC5ZZNTOg-5aFs8HJ1SRCM9ves10zMqG_egBJvAqCF=s96-c', 1, 0, '', '2023-09-07 11:31:12', '0000-00-00 00:00:00'),
(18, 'U24a3IOsyvt', 'Yash Jasoliya', '', 0, '', 0, 0, 0, '6354822602', 'jasoliyayash842@gmail.com', '', 'general', '', 1, 0, '', '2023-09-08 09:02:34', '0000-00-00 00:00:00'),
(19, 'UHflRpdEVKU', 'chirag savaliya', '', 0, '', 0, 0, 0, '', 'chiragsavaliya68@gmail.com', '', 'google', 'https://lh3.googleusercontent.com/a/ACg8ocIpgRAS-q0Qi3ALrjX_QKlWxS9a_A1ayimppkOBrU2c=s96-c', 1, 0, '', '2023-10-09 16:01:44', '0000-00-00 00:00:00'),
(20, 'U1W3ufw5Fah', 'Chirag Savaliya', '', 0, '', 0, 0, 0, '9067686678', 'chiragsavaliya67@gmail.com', '', 'general', '', 1, 0, '', '2023-11-10 12:26:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `app_user_otp`
--

CREATE TABLE `app_user_otp` (
  `phone` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_user_otp`
--

INSERT INTO `app_user_otp` (`phone`, `otp`, `created_at`) VALUES
('paul.jony70@gmail.com', '876619', '2023-07-17 05:54:56'),
('8275754286', '332869', '2023-07-18 13:16:11'),
('71033000', '124017', '2023-07-21 13:19:47'),
('adnanjilani123@gmail.com', '898266', '2023-07-22 04:39:57'),
('kamal.bunkar07@gmail.com', '345442', '2023-07-25 12:50:50'),
('9302650674', '120583', '2023-07-29 12:12:21'),
('72252372', '250716', '2023-08-01 13:41:45'),
('98893349', '467714', '2023-08-02 15:12:31'),
('joymaacable@gmail.com', '752034', '2023-08-22 06:05:13'),
('97986666', '755200', '2023-08-23 09:39:07'),
('saabdik007@gmail.com', '448780', '2023-08-23 22:21:11'),
('78945612', '235002', '2023-08-25 10:32:40'),
('7354570390', '600728', '2023-08-26 18:23:18'),
('susantakunduinpl@gmail.com', '338758', '2023-09-03 03:38:35'),
('6354822602', '813955', '2023-09-18 06:32:19'),
('9874627971', '318428', '2023-11-16 20:14:13'),
('jasoliyayash842@gmail.com', '458703', '2023-11-23 08:00:04'),
('7354570394', '101303', '2023-11-23 11:21:13'),
('9068790678', '730286', '2023-11-23 11:23:57'),
('9790090678', '028620', '2023-11-23 11:59:02'),
('9836872040', '866957', '2023-11-23 18:33:34'),
('9144040888', '773891', '2023-12-06 13:37:21'),
('chiragsavaliya67@gmail.com', '599115', '2023-12-12 10:09:37'),
('9067686678', '154828', '2023-12-14 04:41:14'),
('yashjasoliyay@gmail.com', '598850', '2023-12-14 10:31:00'),
('9874627973', '925961', '2023-12-22 05:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `governorate_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `governorate_id`, `name`, `name_ar`) VALUES
(1, 1, 'AL RAAWIA', 'الراوية'),
(2, 1, 'MIABEEN', 'ميابين'),
(3, 1, 'OLD MUSCAT', 'مسقط القديمة'),
(4, 1, 'AL ALAM PALACE', 'قصر العلم'),
(5, 1, 'AL TAWAIN', 'الطويان'),
(6, 1, 'HARAMEL', 'حرامل'),
(7, 2, 'RUWI', 'روي'),
(8, 2, 'AL WADI AL KABIR', 'الوادي الكبير'),
(9, 2, 'AL WALJA', 'الولجة'),
(10, 2, 'WADI ADAI', 'وادي عدي'),
(11, 2, 'AL WUTAYYAH', 'الوطية'),
(12, 2, 'MUTRAH', 'مطرح'),
(13, 2, 'DARSAIT', 'دارسيت'),
(14, 2, 'AL ZAAHIA', 'الزاهية'),
(15, 2, 'HALAT AL SAGHAH', 'حلة الصاغة'),
(16, 2, 'HALAT AL QURAYIN', 'حلة القرين'),
(17, 2, 'QURUM', 'القرم'),
(18, 2, 'SIDAB', 'سداب'),
(19, 2, 'AL BUSTAN', 'البستان'),
(20, 2, 'YITI', 'يتي'),
(21, 2, 'AL KAYRAN', 'الخيران'),
(22, 2, 'AL SIYFAH', 'السيفة'),
(23, 2, 'OLD MUSCAT', 'مسقط القديمة'),
(24, 2, 'HILAT AL SAD', 'حلة السد'),
(25, 2, 'JUBROOH', 'جبروه'),
(26, 2, 'QANTAB', 'قنتب'),
(27, 2, 'AL ZUBAADIAH', 'الزبادية'),
(28, 2, 'AL WASHL', 'الوشل'),
(29, 2, 'AL HAMRIA', 'الحمرية'),
(30, 2, 'AL TAWYAN', 'الطويان'),
(31, 3, 'GHALA', 'غلا'),
(32, 3, 'AS SARUJ', 'الصاروج'),
(33, 3, 'AL ANSAB', 'الانصب'),
(34, 3, 'MADINAT AS SULTAN QABOOS', 'مدينة السلطان قابوس'),
(35, 3, 'FALAJ AS SHAM', 'فلج الشام'),
(36, 3, 'AL GHUBRAH AL JANUBIA', 'الغبرة الجنوبية'),
(37, 3, 'AL GHUBRAH AL SHAMALYYAH', 'الغبرة الشمالية'),
(38, 3, 'BAWSHAR HEIGHTS', 'مرتفعات بوشر'),
(39, 3, 'AL AWABI', 'العوابي'),
(40, 3, 'AL KHUWAIR', 'الخوير'),
(41, 3, 'MADINAT AL ILLAM', 'مدينة الاعلام'),
(42, 3, 'GHALA INDUSTRIAL', 'غلا الصناعية'),
(43, 3, 'AL MUNAA HEIGHTS', 'مرتفعات المنى'),
(44, 3, 'HAY AL MUNAA', 'حي المنى'),
(45, 3, 'AL SHAEBIA', 'الشعبية'),
(46, 3, 'HAY AL BAYDAA', 'حي البيضاء'),
(47, 3, 'HAY AL SALAM', 'حي السلام'),
(48, 3, 'ROYAL HOSPITAL', 'مستشفى السلطاني'),
(49, 3, 'AL QURUM AL SHAMALYYAH', 'القرم الشمالية'),
(50, 3, 'AL ANSAB HEIGHTS', 'مرتفعات القرم'),
(51, 3, 'AL FATAH', 'الفتح'),
(52, 3, 'AL AZAIBA', 'العذيبة'),
(53, 3, 'BANI OMRAN', 'بني عمران'),
(54, 3, 'SANB', 'صنب'),
(55, 3, 'AFLAJ', 'افلج'),
(56, 3, 'GAL', 'جال'),
(57, 3, 'AL MUSFAH', 'المسفاة'),
(58, 3, 'RAMDA', 'رمده'),
(59, 3, 'AL AMIN MOSQUE', 'منطقة جامع محمد الامين'),
(60, 3, 'OLD BAWSHAR', 'بوشر القديمة'),
(61, 3, 'BAWSHAR 6', 'بوشر السادسه'),
(62, 4, 'AL HSHIA', 'الحشية'),
(63, 4, 'AL MAZRA AL HADRI', 'المزرع الحدري'),
(64, 4, 'SIH AL ZABI', 'سيح الظبي الخامسة 1'),
(65, 4, 'AL AMRAT HEIGHTS 3', 'مرتفعات العامرات 3'),
(66, 4, 'AL SUDAYRAT MADINAT AL NUHDAH', 'السديرات بمدينة النهضة'),
(67, 4, 'SIH AL ZABI 1', 'سيح الظبي 1'),
(68, 4, 'SIH AL ZABI 4', 'سيح الظبي 4'),
(69, 4, 'SIH AL ZABI 6', 'سيح الظبي 6'),
(70, 4, 'AL NAHDAH 11', 'النهضة 11'),
(71, 4, 'AL MAHAJ 1', 'المحج 1'),
(72, 4, 'AL ATKEIAH', 'العتكية 3'),
(73, 4, 'AL MANTQAH 5', 'المنطقة 5'),
(74, 4, 'AL MANTQAH 8', 'المنطقة 8'),
(75, 4, 'AL MANTQAH 6', 'المنطقة 6'),
(76, 4, 'AL MANTQAH 4', 'المنطقة 4'),
(77, 4, 'AL MANTQAH 7', 'المنطقة 7'),
(78, 4, 'AL BEIJRAH', 'البجرية'),
(79, 4, 'AL EHSAAN', 'الاحسان'),
(80, 4, 'AL MANTQAH 2', 'المنطقة 2'),
(81, 4, 'AL MANTQAH 9', 'المنطقة 9'),
(82, 4, 'DUQL', 'دقل'),
(83, 4, 'AL NAHDAH', 'النهضة'),
(84, 4, 'AL AQABAH', 'العقبة'),
(85, 4, 'AL JUFINAH', 'الجفنية'),
(86, 4, 'OLD AL AMERAT', 'العامرات القديمة'),
(87, 4, 'SIXTH HEIGHTS', 'المرتفعات السادسة'),
(88, 4, 'BERAYAN', 'بيرين'),
(89, 4, 'AL SHAEBIA', 'الشعبية'),
(90, 4, 'AL MAHAJ 4', 'المحج 4'),
(91, 4, 'AL NAHDAH 10', 'النهضة 10'),
(92, 4, 'AL WASIT', 'الواسط'),
(93, 4, 'AL MULITAQAH', 'الملتقى'),
(94, 4, 'AL MAHAJ TWO', 'المحج 2'),
(95, 4, 'SIH AL ZABI 2', 'سيح الظبي 2'),
(96, 4, 'HEIGHTS SEVEN', 'المرتفعات 7'),
(97, 4, 'AL NAHDA 10', 'النهضة 10'),
(98, 4, 'HEIGHTS NINE', 'المرتفعات 9'),
(99, 4, 'AL HAJIR', 'الحاجر'),
(100, 4, 'WADI HATAAT', 'وادي حطاط'),
(101, 4, 'JAHALUT', 'جحلوت'),
(102, 4, 'AL EATKIA', 'العتكية '),
(103, 4, 'HEIGHTS ONE', 'المرتفعات 1'),
(104, 4, 'HEIGHTS THREE', 'المرتفعات 3'),
(105, 5, 'HAIL AL AWAMIR', 'حيل العوامر'),
(106, 5, 'AL KHARAIS', 'الخريس'),
(107, 5, 'WADI AL ARASH', 'وادي العرش'),
(108, 5, 'AL SEEB SOUK', 'سوق السيب'),
(109, 5, 'AL MAWALEH SOUTH 2', 'الموالح الجنوبية'),
(110, 5, 'AL MAWALEH AL SHAMALYYAH', 'الموالح الشمالية'),
(111, 5, 'AL HAIL AL JANUBIA', 'الحيل الجنوبية'),
(112, 5, 'AL HAIL AL SHAMALYYAH', 'الحيل الشمالية'),
(113, 5, 'AL KHOUDH AL BELAD', 'الخوض البلد'),
(114, 5, 'HAY AL NIBRASE', 'حي النبراس'),
(115, 5, 'HAY AL MAEMURAH', 'حي المعمورة'),
(116, 5, 'HAY AL MASHIAL', 'حي المشاعل'),
(117, 5, 'HAY AL AZZ', 'حي العز'),
(118, 5, 'HAY AL NOOR', 'حي النور'),
(119, 5, 'AL KHOUDH AL HAY AL TEJARY', 'الخوض الحي التجاري'),
(120, 5, 'AL HAIL', 'الحيل'),
(121, 5, 'AL MAWALEH', 'الموالح'),
(122, 5, 'AL RUSAYL', 'الرسيل'),
(123, 5, 'AL MABBILAH 8', 'المعبيلة 8'),
(124, 5, 'AL MABILLAH AL SHAMALLYAH', 'المعبيلة الشمالية'),
(125, 5, 'HALAT AL NASSER', 'حلة النصر'),
(126, 5, 'HALAT AL FATEH', 'حلة الفتح'),
(127, 5, 'AL SHARADI', 'الشرادي'),
(128, 5, 'HALAT AL SIDER', 'حلة السدر'),
(129, 5, 'HALAT AL QALAH', 'حلة القلعة'),
(130, 5, 'SUR AL HADID', 'سور ال الحديد'),
(131, 5, 'WADI AL BAHAYIS', 'وادي البحائص'),
(132, 5, 'WADI AL LAWAMI', 'وادي اللوامي'),
(133, 5, 'AL MOUJ', 'الموج'),
(134, 5, 'AL MABILLAH 7', 'المعبيلة 7'),
(135, 5, 'AL MABILLAH INDUSTRIAL', 'المعبيلة الصناعية'),
(136, 5, 'AL MABILLAH 6', 'المعبيلة 6'),
(137, 5, 'AL MABILLAH AL JANUBIAH', 'المعبيلة الجنوبية'),
(138, 5, 'SULTAN QABOOS UNIVERSITY', 'جامعة السلطان قابوس'),
(139, 5, 'AL MABILLAH HAY AL JINAN', 'المعبيلة حي الجنان'),
(140, 5, 'AL KHOUDH 6', 'الخوض 6'),
(141, 5, 'AL MURTAFAH CAMP', 'معسكر المرتفعة'),
(142, 5, 'AL MATTAR HEIGHTS', 'مرتفعات المطار'),
(143, 5, 'AL KHOUD 3', 'الخوض 3'),
(144, 5, 'AL KHOUDH 7', 'الخوض 7'),
(145, 5, 'AL MABILLAH 4', 'المعبيلة 4'),
(146, 5, 'AL KHOUDH SOUQ', 'سوق الخوض'),
(147, 5, 'WAHAT AL MAARIFAH', 'واحة المعرفة'),
(148, 5, 'SULTAN QABOOS UNIVERSITY HOSPITAL', 'مستشفى الجامعة'),
(149, 5, 'AL GHASHAYBAH', 'الغشية'),
(150, 5, 'ALKHOUDH 5', 'الخوض 5'),
(151, 5, 'ARMY HOSPITAL', 'مستشفى العسكري'),
(152, 5, 'AL SHAEBIA', 'الخوض الشعبية'),
(153, 5, 'HAY AL KAWTHAER', 'حي الكوثر'),
(154, 5, 'AL MAABILAH 1', 'المعبيلة 1'),
(155, 5, 'HAY AL TADAMOON', 'حي التضامن'),
(156, 5, 'AL MAABILAH 5', 'المعبيلة 5'),
(157, 5, 'HAY AL ZUAFFERAN', 'حي الزعغران'),
(158, 5, 'HAY AL RAHBAH', 'حي الرحبة'),
(159, 5, 'HAY AL AIN', 'حي العين'),
(160, 5, 'AL MAABILAH 2', 'المعبيلة 2'),
(161, 5, 'HAY AL SHAROOQ', 'حي الشروق'),
(162, 5, 'HALAT AL BUNOOD', 'حلة البنود'),
(163, 5, 'HAY AL SALAM', 'حي السلام'),
(164, 5, 'AL MAABILAH 3', 'المعبيلة 3'),
(165, 5, 'HALAT AL YOUSIF', 'حلة ال يوسف'),
(166, 5, 'HALAT AL SADD', 'حلة السد'),
(167, 5, 'AL KHOUD ALJADIDA', 'الخوض الجديدة'),
(168, 5, 'HAY ALBARAKA', 'حي البركة'),
(169, 5, 'HAI ALNUZHA', 'حي النزهة'),
(170, 5, 'HAI ALKAYR', 'حي الخير'),
(171, 5, 'AL KHOUD FOUR', 'الخوض 4'),
(172, 6, 'BAMAH', 'بمة'),
(173, 6, 'AL SAWAQIM', 'السواقم'),
(174, 6, 'AL JANIN', 'الجنين'),
(175, 6, 'AL MISFAH', 'المسفاة'),
(176, 6, 'AL SHAHBARI', 'اشهباري'),
(177, 6, 'AL TRAIF', 'الطريف'),
(178, 6, 'AL SIH', 'السيح'),
(179, 6, 'AL SELIL', 'السليل'),
(180, 6, 'AL SULHA', 'الصلحة'),
(181, 6, 'HAY AL DAHER', 'حي الظاهر'),
(182, 6, 'DAGHMAR/AL BELAD', 'دغمر البلاد'),
(183, 6, 'DAGHMAR/AL FAALA', 'دغمر الفالع'),
(184, 6, 'AL QATEEF', 'القطيف'),
(185, 6, 'AL JAZIR', 'الجزير'),
(186, 6, 'DAGHMAR', 'دغمر'),
(187, 6, 'FINS', 'فنس'),
(188, 6, 'AL SAHIL', 'الساحل'),
(189, 6, 'KULAYAT', 'كليات'),
(190, 6, 'FINS INNER STREET', 'فنس الشارع الداخلي'),
(191, 6, 'AL HUBABIAH', 'الهبوبية'),
(192, 6, 'AL SHAHBARI', 'الشهباري'),
(193, 6, 'HAIL AL GHAFF', 'حيل الغاف'),
(194, 6, 'AL JININ', 'الجنين'),
(195, 6, 'AL KHUBAR', 'الخوبار'),
(196, 6, 'HIFAZ', 'حيفظ'),
(197, 6, 'AL MAALAH', 'المعلاة'),
(198, 6, 'AL SOWQ', 'السوق'),
(199, 6, 'AL HAJIR', 'الحاجر'),
(200, 6, 'KHARIB', 'كريب'),
(201, 6, 'AL FAYAED MEETING POINT', 'الفياض نقطة التقاء'),
(202, 6, 'AFAA', 'عفا'),
(203, 6, 'AL WAZ', 'الويز'),
(204, 6, 'AL SUNEIAH 1', 'الصناعية الاولى'),
(205, 6, 'SALHA HEIGHTS', 'مرتفعات صلحة'),
(206, 6, 'AL RAMLA', 'الرملة'),
(207, 6, 'SIA AL HADRIA', 'صيا الحدرية'),
(208, 6, 'WADI AL ARABIN', 'وادي العربين'),
(209, 6, 'WADI AL RIHAAB AL SWAQIM', 'وادي الرحاب السواقم'),
(210, 6, 'DABAB', 'ضباب'),
(211, 6, 'HAI AL RIHAB', 'حي الرحاب'),
(212, 6, 'AL FALIJ', 'الفليج'),
(213, 6, 'EIRQI', 'عرقي'),
(214, 6, 'MIHYAA', 'محياء'),
(215, 6, 'AL AYNAIN', 'العينين'),
(216, 6, 'AL MASILA', 'المسيلة'),
(217, 7, 'KHAFDI', 'خفدي'),
(218, 7, 'AL HAZM', 'الحزم'),
(219, 7, 'AL TAYKHA', 'الطيخة الرستاق'),
(220, 7, 'AL WASHIL', 'الوشيل'),
(221, 7, 'AL IRAQI', 'العراقي'),
(222, 7, 'HAY AL AMJAAD', 'حي الامجاد'),
(223, 7, 'HAY AL BATIN', 'حي الباطن'),
(224, 7, 'DARIS', 'دارس'),
(225, 7, 'FALAJ AL ALYI', 'فلج العالي'),
(226, 7, 'FALAJ AL WASTA', 'فلج الوسطى'),
(227, 7, 'AL RUSTAQ AL HADITHA', 'الرستاق الحديثة'),
(228, 7, 'JAMMA', 'جماء'),
(229, 7, 'HAY AS SAADAH', 'حي السعادة'),
(230, 7, 'AL MANSUR', 'المنصور'),
(231, 7, 'AL SHABIKAH', 'الشبيكة'),
(232, 7, 'AL MISFAH', 'المسفاة'),
(233, 7, 'FALAJ AL SHARAH', 'فلج الشراة'),
(234, 7, 'AL MAZAHEIT', 'المزاحيط'),
(235, 7, 'HAY AL NAHDAH', 'حي النهضة'),
(236, 7, 'AL SHEIBIA', 'الشعبية'),
(237, 7, 'AL JUROOF', 'الجروف'),
(238, 7, 'AL TAYKHAH', 'الطيخة ا'),
(239, 7, 'AL GHASHB', 'الغشب'),
(240, 7, 'AL BASHAYER', 'البشاير'),
(241, 7, 'WABIL', 'وبل'),
(242, 7, 'HAY AL SAREH', 'حي الصرح'),
(243, 7, 'AL RUSTAQ INDUSTRIAL', 'صناعية الرستاق'),
(244, 7, 'AL DAHAAS', 'الدهاس'),
(245, 7, 'AL KHILW', 'الخليو'),
(246, 7, 'AL MARBAA', 'المرباء'),
(247, 7, 'FALAJ AL HADITH', 'فلج الحديث'),
(248, 7, 'AINI', 'عيني'),
(249, 7, 'AL MAHADER', 'المحاضر'),
(250, 7, 'QUSRAA', 'قصرى'),
(251, 7, 'AL AILYAA', 'العلاية'),
(252, 7, 'AL DAHER', 'الظاهر'),
(253, 7, 'AL HALAH', 'الحلة'),
(254, 7, 'AL JAZIRAH', 'الجزيرة'),
(255, 7, 'HAY AL SHARAF', 'حي الشرف'),
(256, 7, 'WADI BANI OUF', 'وادي بني عوف'),
(257, 7, 'TAWI AL NIZWANI', 'طوي النزواني'),
(258, 7, 'AL RUMAYNAH', 'الرمانية'),
(259, 7, 'AIN AL QUSFAH', 'عين الكثفة'),
(260, 7, 'WADI BANI GHAFFER', 'وادي بني غافر خفدي'),
(261, 7, 'AL TUBAQAH', 'الطباقة'),
(262, 7, 'FALAJ AL SELAF', 'فلج السليف'),
(263, 7, 'WADI AL HAIMLII (AL HOWQAYN ROUNDABOUT)', 'وادي الحيميلي دوار الحوقين'),
(264, 7, 'AL HOWQAYN (HOWQYN ROUNDABOUT)', 'دوار الحوقين'),
(265, 7, 'WADI BANI HNI (MAJLAS RASEYAT)', 'وادي بني هني مجلس راسيات'),
(266, 7, 'WADI AL SAHTAN (TUPAKAH)', 'وادي السحتن طباقة'),
(267, 7, 'WADI BANI OUF (AL AMJAAD)', 'وادي بني عوف الامجاد'),
(268, 7, 'AL MSMAYDAH', 'المسميدة'),
(269, 7, 'BAIT AL QARIN', 'بيت القرن'),
(270, 7, 'AL HASHAA', 'الحشاة'),
(271, 8, 'HALBAN', 'حلبان'),
(272, 8, 'AL ABYAD', 'الابيض'),
(273, 8, 'BAB AL DAFUR ALSHAMALIYAH', 'باب الظفور الشمالية'),
(274, 8, 'BAB AL DAFUR AL GHARBIA', 'باب الظفور الغربية'),
(275, 8, 'AIN AL THAWARAH', 'عين الثوارة'),
(276, 8, 'NAKHAL HEIGHTS', 'مرتفعات نخل'),
(277, 8, 'TAWI AL QASFAH', 'طوي القصفة'),
(278, 8, 'MARKAZ AL MADENAH (CITY CENTER)', 'مركز المدينة'),
(279, 8, 'AL AQAYBAH', 'العقيبة'),
(280, 8, 'AL SADIAH', 'السعدية'),
(281, 8, 'AL SHAEBIA', 'الشعبية'),
(282, 8, 'BAB ALDAFUR AL JANUBIA', 'باب الظفور الجنوبية'),
(283, 8, 'GHZIL', 'غزيل'),
(284, 8, 'HAY AL RUDWAN', 'حي الرضوان'),
(285, 8, 'SIH AL RASAS', 'سيح الرصاص'),
(286, 8, 'AL SARIR', 'السرير'),
(287, 8, 'AL TAWIA', 'الطوية'),
(288, 8, 'AL SOUQ', 'السوق'),
(289, 8, 'AL TW', 'الطو'),
(290, 8, 'BWA', 'بوة'),
(291, 8, 'AL MAHALIL', 'المهاليل'),
(292, 8, 'WADI MUSTAL', 'وادي مستل'),
(293, 8, 'AL HASANAT', 'الحسنات'),
(294, 9, 'AL HAAJR', 'الهجار'),
(295, 9, 'AL RAMI', 'الرامي'),
(296, 9, 'THQUP', 'ثقب'),
(297, 9, 'AL GHARB', 'الغرب'),
(298, 9, 'WADI BANI KHARUS', 'وادي بني خروص'),
(299, 9, 'AL MAHWDAWTH', 'المحدوث'),
(300, 9, 'AL AWABI INDUSTRIAL', 'صناعية العوابي'),
(301, 9, 'AL AWABI SOWQ', 'سوق العوابي'),
(302, 9, 'AL RAMI', 'الرامي'),
(303, 9, 'SULAN', 'سلان'),
(304, 9, 'AL NAHDAH', 'النهضة'),
(305, 9, 'TAWI SIH', 'طوي سيح'),
(306, 9, 'AL SELIL', 'السليل'),
(307, 9, 'MARKAZ AL MADENAH (CITY CENTER)', 'مركز الولاية'),
(308, 9, 'AL FATAH', 'الفتح'),
(309, 9, 'AL DAHER', 'الظاهر'),
(310, 9, 'AL SHAEBIA AL SHARQYAH', 'الشعبية الشرقية'),
(311, 9, 'AL SHAEBIA AL GHARBIYAH', 'الشعبية الغربية'),
(312, 9, 'HALAT AL SAD', 'حلة السد'),
(313, 9, 'STAI', 'ستال'),
(314, 10, 'AL MELADAH', 'الملدة'),
(315, 10, 'WEDAM AL GHAF', 'ودام الغاف'),
(316, 10, 'WEDAM AL SAHIL', 'ودام الساحل'),
(317, 10, 'BURJ AL KHAMIS', 'برج آل خميس'),
(318, 10, 'AL QART', 'القرط'),
(319, 10, 'AL MUGHSER', 'المغسر'),
(320, 10, 'AL QURAYHAT', 'القريحات'),
(321, 10, 'AL BIDAYAH', 'البديعة'),
(322, 10, 'AL SHARIS', 'الشرس'),
(323, 10, 'AL SHAEBIA', 'الشعبية'),
(324, 10, 'ABO ABALI AL SAHIL', 'ابو عبالي الساحل'),
(325, 10, 'MAHARH', 'محارة'),
(326, 10, 'AL TRAIF AL SHAMALIYAH', 'الطريف الشمالية'),
(327, 10, 'AL MARAGHAH', 'المراغة'),
(328, 10, 'AL TRAIF', 'الطريف'),
(329, 10, 'AL AWAID', 'العويد'),
(330, 10, 'AL THARMAD', 'الثرمد'),
(331, 10, 'AL AIS', 'العيص'),
(332, 10, 'HALAT ZIDJAL', 'حلة الزدجال'),
(333, 10, 'AL QURYAM', 'القريم'),
(334, 10, 'QURI', 'قري'),
(335, 10, 'AL SUNAEIAH', 'الصناعية'),
(336, 10, 'AL HUSIN', 'الحصن'),
(337, 10, 'HALAT AL BALUCH', 'حلة البلوش'),
(338, 10, 'HAY AL NAHDAH', 'حي النهضة'),
(339, 10, 'AL MUSAYNIEA', 'المصينعة'),
(340, 11, 'AL BLAH', 'البلة'),
(341, 11, 'QARHAT AL BALUCH', 'قرحة البلوش'),
(342, 11, 'HALAT AL AJAM', 'حلة العجم'),
(343, 11, 'AL MARAG', 'المراغ'),
(344, 11, 'AL MURISY', 'المريصي'),
(345, 11, 'AL BASIT', 'الباسط'),
(346, 11, 'AL AQIR', 'العقير'),
(347, 11, 'AL MARIGHAT', 'المريغات'),
(348, 11, 'AL JANINA', 'الجنينة'),
(349, 11, 'AL SAWADI', 'السوادي الساحل'),
(350, 11, 'SAWADI AL HAKMAN', 'سوادي الحكمان'),
(351, 11, 'AL AWQDAH AL JANUBIYAH', 'العقدة الجنوبية'),
(352, 11, 'AL AWQDAH AL SHARQYAH', 'العقدة الشرقية'),
(353, 11, 'AL FAGHARAH', 'الفاغرة'),
(354, 11, 'QRIHA', 'قريحة'),
(355, 11, 'BIDII', 'بدي'),
(356, 11, 'WAHRA', 'وهرة'),
(357, 11, 'AL HAFRI AL JANUBIYAH', 'الحفري الجنوبية'),
(358, 11, 'AL JAHIS', 'الجاحس'),
(359, 11, 'AL HADEEB', 'الحضيب'),
(360, 11, 'AL SURAYMAH', 'الصريمة'),
(361, 11, 'AL MARFFA', 'المرفع'),
(362, 11, 'AL TAMATM', 'الطماطم'),
(363, 11, 'AL THARAMED', 'الثرامد'),
(364, 11, 'AL NAEMAN', 'النعمان'),
(365, 11, 'HAFRI AL SUR', 'حفري السور'),
(366, 11, 'HAFRI AL BAHER', 'حفري البحر'),
(367, 11, 'AL SHAMAL', 'الشمال'),
(368, 11, 'AL SAYLAHAH', 'السلاحة'),
(369, 11, 'HAY ASIM', 'حي عاصم'),
(370, 11, 'AL HARAM', 'الهرم'),
(371, 11, 'AL SAWMAHAN AL JANUBIAH', 'الصومحان الجنوبية'),
(372, 11, 'AL SAWMAHAN AL SHAMALIYAH', 'الصومحان الشمالية'),
(373, 11, 'AL JAHLAH', 'الجحيلة'),
(374, 11, 'SALWAA', 'سلوى'),
(375, 11, 'AL ABER', 'العبر'),
(376, 11, 'ABO MAHAR', 'ابو محار'),
(377, 11, 'SAQSUQ', 'سقسوق'),
(378, 11, 'AL HASANAT', 'الحسنات'),
(379, 11, 'HAY AL SALAM', 'حي السلام'),
(380, 11, 'AL HARADI', 'الحرادي'),
(381, 11, 'AL NOOR', 'النور'),
(382, 11, 'HAY AL AZZAH', 'حي العزة'),
(383, 11, 'MUZRA AL HARTH', 'مزرع الحرث'),
(384, 11, 'AL RMAYIS', 'الرميس'),
(385, 11, 'AL MANUMAH', 'المنومة'),
(386, 11, 'AL NASEEM', 'النسيم'),
(387, 11, 'AL FALAYJ HAY AL TAYBEEN', 'الفليج حي الطيبين'),
(388, 11, 'AL SHAKHAKET', 'الشخاخيط'),
(389, 11, 'HALAT AL FAWAYRIS', 'حلة الفوارس'),
(390, 11, 'AL KHUAYRAT', 'الخويرات'),
(391, 11, 'AL SOWQ', 'السوق'),
(392, 11, 'AL QURIHAH', 'القريحة'),
(393, 11, 'AL SUNAEIAH', 'الصناعية'),
(394, 11, 'AL WAHRAH', 'الوهرة'),
(395, 11, 'AL MAZRAA', 'المزرع'),
(396, 11, 'ABO AL NAKEL', 'ابو النخيل'),
(397, 12, 'AL LAAJAL', 'اللاجال'),
(398, 12, 'HAPRAA', 'حبرا'),
(399, 12, 'AL MARIGHA', 'المريغة'),
(400, 12, 'AL WASIT', 'الواسط'),
(401, 12, 'AFEE', 'افي'),
(402, 12, 'MASALAMAT', 'مسلمات'),
(403, 12, 'AL TAWIA', 'الطوية'),
(404, 13, 'MAJZ AL KUBRA', 'مجز الكبرى'),
(405, 13, 'AL AUAYNAT', 'العوينات'),
(406, 13, 'MAJIS', 'مجيس'),
(407, 13, 'GHIL AL SHUBUL', 'غيل الشبول'),
(408, 13, 'AL HAMBAR', 'الهمبار'),
(409, 13, 'SALLAN', 'صلان'),
(410, 13, 'AL TRAIF', 'الطريف'),
(411, 13, 'FALAJ AL QABAYIL', 'فلج القبائل'),
(412, 13, 'AL GHASHBA', 'الغشبة'),
(413, 13, 'AL SUWAUHRA', 'الصويحرة'),
(414, 13, 'AL AFIFA', 'العفيفة'),
(415, 13, 'HARAT AL SHAIK', 'حارة الشيخ'),
(416, 13, 'AL KHUAYRIA', 'الخويرية'),
(417, 13, 'MUWALIH', 'مويلح'),
(418, 13, 'MAJIS', 'مجيس'),
(419, 13, 'AL HAJRAH', 'الحجرة'),
(420, 13, 'AL WAQAYBAH', 'الوقيبة'),
(421, 13, 'AWTAB', 'عوتب'),
(422, 13, 'AL AWHI', 'العوهي'),
(423, 13, 'AL MULTAQAH', 'الملتقى'),
(424, 13, 'SIH AL MAKAREM', 'سيح المكارم'),
(425, 13, 'HAY AL RUFFAH', 'حي الرفعة'),
(426, 13, 'AL JUFRAAH', 'الجفرة'),
(427, 13, 'AL ZOOFARAN', 'الزعفران'),
(428, 13, 'OMQ', 'عمق'),
(429, 13, 'AL SANGAR', 'الصنجر'),
(430, 13, 'AL HADERAH', 'الحظيرة'),
(431, 13, 'AL SAPARAH', 'الصبارة'),
(432, 13, 'AL QALAA', 'القلعة'),
(433, 13, 'AL SOWQ', 'السوق'),
(434, 13, 'AL SOWAHYRAH AL JADIDAH', 'الصويحرة الجديدة'),
(435, 13, 'AL SHAEBIA', 'الشعبية'),
(436, 13, 'KHUR AL SIYABI', 'خور السيابي'),
(437, 13, 'AL SHEZAW', 'الشيزاو'),
(438, 13, 'SNDHA', 'سندهة'),
(439, 13, 'AL GHIL AL GHARB', 'الغيل الغرب'),
(440, 13, 'AL GHIL AL SHIL', 'الغيل الساحل'),
(441, 13, 'MAJZ AL KHUBRAA', 'مجز الكبرى البوابة'),
(442, 13, 'KHARAWAN', 'كروان'),
(443, 14, 'DEL AL ABDUL SALAM', 'ديل آل عبدالسلام'),
(444, 14, 'OLD AL HAWII', 'الحويل القديمة'),
(445, 14, 'AL FULIJ', 'الفليج'),
(446, 14, 'MAJZ AL SUGHRAA', 'مجز الصغرى'),
(447, 14, 'KHUR AL HAMAM', 'خور الحمام'),
(448, 14, 'MUKHILIF', 'مخيليف'),
(449, 14, 'SHIDAH', 'شيدة'),
(450, 14, 'AL KSHSDAH', 'الخشدة'),
(451, 14, 'KHUR AL MELH', 'خور الملح'),
(452, 14, 'ABU AL DAROUS', 'ابو الظروس'),
(453, 14, 'AL RADAH', 'الردة'),
(454, 14, 'UM AL JAREEF', 'ام الجعاريف'),
(455, 14, 'HALAT AL BURJ', 'حلة البرج'),
(456, 14, 'MUQAASAH', 'مقاعسة'),
(457, 14, 'DUQAL', 'دقال'),
(458, 14, 'AL LUHAYBAN', 'الليهبان'),
(459, 14, 'AL AQER', 'العقير'),
(460, 14, 'AL SAHMI', 'الصحمي'),
(461, 14, 'AL RAKBI', 'الراكبي'),
(462, 14, 'WADI MAHMOOM', 'وادي المحموم'),
(463, 14, 'AL GHWAYSAH', 'الغويصه'),
(464, 14, 'SUR AL SHYADI', 'سور الشيادي'),
(465, 14, 'HALAT AL SOWQ', 'حلة السوق'),
(466, 14, 'HALAT AL ZAAB', 'حلة الزعاب'),
(467, 14, 'AL MANQAL', 'المنقل'),
(468, 14, 'AL HOWAYL AL JADIDAH', 'الحويل الجديدة'),
(469, 14, 'SAHAM HEIGHTS', 'مرتفعات صحم'),
(470, 14, 'BATAHAA AL SHAKHER', 'بطحاء الشخر'),
(471, 14, 'AL SUNEIAH', 'الصناعية'),
(472, 14, 'AL RAWDAH', 'الروضة'),
(473, 14, 'AL MUHAB', 'المهاب'),
(474, 14, 'SIH AL TAYBAT', 'سيح الطيبات'),
(475, 14, 'AL MARFFA', 'المرفع'),
(476, 14, 'AL RADAH', 'الردة'),
(477, 14, 'AL HADEEB', 'الحضيب'),
(478, 14, 'HAFIT', 'حفيت'),
(479, 14, 'DEL AL BURIK', 'ديل آل بريك'),
(480, 14, 'HALAT AL KAHAEEL', 'حلة الكحاحيل'),
(481, 14, 'AL BUTNAYAH', 'البطنية'),
(482, 14, 'UM AL JAREEF', 'ام الجعاريف'),
(483, 14, 'SUR AL BALUCH', 'سور البلوش'),
(484, 14, 'RUWILAT AL BADU', 'رويلة البدو'),
(485, 14, 'AL SHARAYAH', 'الشريعة'),
(486, 14, 'AL BASH', 'البش'),
(487, 14, 'AL QURI', 'القري'),
(488, 14, 'AL MAQALA', 'المعقلة'),
(489, 15, 'KHASEBAT AL BU SAID', 'قصبية آل بو سعيد'),
(490, 15, 'AL HAJRII', 'الهجاري'),
(491, 15, 'AL BARIK', 'البريك'),
(492, 15, 'AL SARHAAT', 'السرحات'),
(493, 15, 'AL QURII', 'القري'),
(494, 15, 'AL QUSAYBAH', 'القصبية'),
(495, 15, 'QUSAYBAHAT AL ZAAB', 'قصبية الزعاب'),
(496, 15, 'KHUR AL RASL', 'خور رسل'),
(497, 15, 'HALAT SOWQ', 'حلة السوق'),
(498, 15, 'AL KHABURAH HEIGHTS', 'مرتفعات الخابورة'),
(499, 15, 'AL QASIF', 'القصف'),
(500, 15, 'AL BURIK HEIGHTS', 'مرتفعات البريك'),
(501, 15, 'AL KHUWAIRAT', 'الخويرات'),
(502, 15, 'AL HAJIR', 'الحاجر'),
(503, 15, 'KHUR AL HIND', 'خور الهند'),
(504, 15, 'SUR QUTAIT', 'سور قطيط'),
(505, 15, 'KHASEBAT AL AWASINAH', 'قصبية الحواسنة'),
(506, 15, 'HALAT AL HUSIN', 'حلة الحصن'),
(507, 15, 'AL RUDAYDAH', 'الرديدة'),
(508, 15, 'ABBASAH', 'عباسة'),
(509, 15, 'KHASEBAT AL BURIK', 'قصبية آل بريك'),
(510, 15, 'AL MUSAILAH', 'المسيلة'),
(511, 15, 'SUR AL DUWAHINAH', 'سور الدواحنة'),
(512, 15, 'AL AWAAN', 'العوان'),
(513, 15, 'MUHAIDIB', 'محيضيب'),
(514, 15, 'AL WASIT', 'الواسط'),
(515, 15, 'AL HUJAYRAH', 'الحجيرة'),
(516, 15, 'FALIJ BANI RABIEA', 'فلج بني ربيعة'),
(517, 15, 'AL GHIZIN', 'الغيزين'),
(518, 16, 'AL BIDAYAH', 'البداية'),
(519, 16, 'AL KHUDRA', 'الخضراء'),
(520, 16, 'AL MUBREH', 'المبرح'),
(521, 16, 'DYAN AL BUSAID', 'ضيان البوسعيد'),
(522, 16, 'AL THARMAD', 'الثرمد'),
(523, 16, 'AL FAW', 'الفاو'),
(524, 16, 'UM SIH NORTH', 'ام سيح الشمالية'),
(525, 16, 'AL SUBAIKHI', 'الصبيخي'),
(526, 16, 'QARIH BANI KHAROUS', 'قارح بني خروص'),
(527, 16, 'AL GHRAYFA', 'الغريفة'),
(528, 16, 'KHBIT AL NAWAFIL', 'خبة النوافل'),
(529, 16, 'SUR AL HILAL', 'سور آل هلال'),
(530, 16, 'DYAN AL JAHAWIR', 'ضيان الجهاور'),
(531, 16, 'SUR HAYAAN', 'سور هيان'),
(532, 16, 'KHBIT AL KHAMIS', 'خبة آل خميس'),
(533, 16, 'KHUDRAA AL BU RASHID', 'خضراء آل بورشيد'),
(534, 16, 'SIH AL RAHMAAT', 'سيح الرحمات'),
(535, 16, 'GHLIL AL HANADEES', 'غليل الهناديس'),
(536, 16, 'HALAT AL NAHDAH', 'حلة النهضة'),
(537, 16, 'AL RADAH', 'الردة'),
(538, 16, 'BATAHAA AL OUD', 'بطحاء العود'),
(539, 16, 'BATAHAA AL HILAL', 'بطحاء هلال'),
(540, 16, 'BATAHAA AL SAHIL', 'بطحاء الساحل'),
(541, 16, 'BATAHAA AL JADIDA', 'بطحاء الجديدة'),
(542, 16, 'AL MANFASH', 'المنفش'),
(543, 16, 'KHBAT AL NAEMEEN', 'خبة النعامين'),
(544, 16, 'KHBAT AL ABDULLAH', 'خبة آل عبدالله'),
(545, 16, 'KHBAT AL', 'خبة المعاول'),
(546, 16, 'SUR AL RABIE', 'سور الربيع'),
(547, 16, 'AL AFRAAD', 'الافراض'),
(548, 16, 'AL NUBRAH', 'النبرة'),
(549, 16, 'AL WASITA', 'الوسطى'),
(550, 16, 'AL SOWQ', 'السوق'),
(551, 16, 'AL SHRAYSAH', 'الشريسة'),
(552, 16, 'HALAT AL SOWQ', 'حلة السوق'),
(553, 16, 'HALAT AL HUSIN', 'حلة الحصن'),
(554, 16, 'AL SHATER', 'الشاطر'),
(555, 16, 'AL SUNEIAH', 'الصناعية'),
(556, 16, 'AL AQDAH', 'العقدة'),
(557, 16, 'AL RUDAYDAH', 'الرديدة'),
(558, 16, 'AL QARIH', 'القارح'),
(559, 16, 'AL HINDIAH', 'الهندية'),
(560, 16, 'GHALIL AL MASAEED', 'غليل المساعيد'),
(561, 16, 'HALAT AL HUSEEN', 'حلة الحصن'),
(562, 16, 'AL QARIH', 'القرحة'),
(563, 16, 'AL GHLAYLAH', 'الغليلة'),
(564, 16, 'BO RAGHWAH', 'بورغوة'),
(565, 16, 'HALAT AL JUD', 'حلة الجود'),
(566, 16, 'SUR AL HIAAN', 'سور آل هيان'),
(567, 16, 'KHUDRAA AL SOUQ', 'خضراء السوق'),
(568, 16, 'HALAT AL SOALY', 'حلة الصولي'),
(569, 16, 'KHUDRAA AL SAWABIE', 'خضراء السوابع'),
(570, 16, 'AL SUR', 'السور'),
(571, 16, 'AL BASIT', 'الباسط'),
(572, 16, 'AL MUKHTAM', 'المخطم'),
(573, 16, 'KHUDRAA AL GHDANAAT', 'خضراء الغدانات'),
(574, 16, 'SIH AL RAHMAAT', 'سيح الرحمات'),
(575, 16, 'AL AREEQ', 'العريق'),
(576, 16, 'DAYAN', 'ضيان'),
(577, 16, 'BDI AL AMOOD', 'بدي العمود'),
(578, 16, 'MASHYIQ', 'مشايق'),
(579, 16, 'KUDRAH AL SAAD', 'خضراء آل سعد'),
(580, 16, 'BADIEUH', 'بديعوه'),
(581, 16, 'AL HUJAYRAH', 'الحجيرة'),
(582, 16, 'MASIH', 'مسيح'),
(583, 16, 'HALAT AL QAHDIMAH', 'الحلة القديمة'),
(584, 16, 'AL WASIT', 'الواسط'),
(585, 16, 'QARYYAT AL JAZMA', 'قرية الجزماء'),
(586, 16, 'AL OUAYDAT', 'العويدات'),
(587, 16, 'AL MATAMER', 'المعتمر'),
(588, 16, 'UM AL SIH AL JANUBAIH', 'ام سيح الجنوبية'),
(589, 16, 'AL BARIDAH', 'الباردة'),
(590, 16, 'AL GHADIRAH', 'الغديرة'),
(591, 16, 'BATHAA AL SUWR', 'بطحاء السور'),
(592, 16, 'AL HADIB', 'الحضيب'),
(593, 17, 'SUR AL ABRI', 'سور العبري'),
(594, 17, 'AL NAEMAA', 'النعمى'),
(595, 17, 'AL AQER', 'العقر'),
(596, 17, 'KHUDRAWAYN', 'خضراوين'),
(597, 17, 'ASWAD', 'اسود'),
(598, 17, 'HAMYARA', 'حميراء'),
(599, 17, 'TRAIF HAJI', 'طريف حجي'),
(600, 17, 'ABO BAQARAH', 'ابو بقرة'),
(601, 17, 'AL OMANI', 'العماني'),
(602, 17, 'AL DAWANIJ', 'الدوانيج'),
(603, 17, 'AL SIYFIA', 'السيفية'),
(604, 17, 'MURIR AL MATARISH', 'مرير المطاريش'),
(605, 17, 'MURIR AL DARAMEKAH', 'مرير الدرامكة'),
(606, 17, 'AL MURAH', 'المرة'),
(607, 17, 'AL BALEDAH', 'البليدة'),
(608, 17, 'JBAYLAH-TOMAYT', 'جبيلة طميط'),
(609, 17, 'JBAYLAH-AJEEB', 'جبيلة عجيب'),
(610, 17, 'JBAYLAH-ALFAA', 'جبيلة الفى'),
(611, 17, 'AL WADIYYAT', 'الوديات'),
(612, 17, 'AL HAMLAYAH', 'الهاملية'),
(613, 17, 'AL FIRFARAH', 'الفرفارة'),
(614, 17, 'SUR KUZIMA', 'سور خزيمة'),
(615, 17, 'SUR HAMMAD', 'سور حماد'),
(616, 17, 'SUR AL BALUCH', 'سور البلوش'),
(617, 17, 'ASRAR BANI OMAR', 'اسرار بني عمر'),
(618, 17, 'AL FIRFARAH', 'الفرفارة'),
(619, 17, 'AL SOWQ', 'السوق'),
(620, 17, 'TRIF AL MAKHAMRAH', 'طريف المخامرة'),
(621, 17, 'SHAEBAT AL SHOURTAH', 'شعبية الشرطة'),
(622, 17, 'ASRAR BANI SAD', 'اسرار بني سعد'),
(623, 17, 'AL GHURIFFAH', 'الغريفة'),
(624, 17, 'AL GHAWABI', 'الغوابي'),
(625, 17, 'SHAEBIAT AL MADARIS', 'شعبية المدارس'),
(626, 17, 'KHATMAT MULAHAH', 'خطمة ملاحة'),
(627, 17, 'TAMIT', 'طميت'),
(628, 17, 'SUR AL MAZZARE', 'سور المزاريع'),
(629, 17, 'HILA SOUTH', 'الحلة الجنوبية'),
(630, 18, 'AL ZAAHIA', 'الزاهية'),
(631, 18, 'GDFAN', 'غضفان'),
(632, 18, 'HALAT AL SHAIK', 'حلة الشيخ'),
(633, 18, 'OQDAT AL MAWANIE', 'عقدة الموانع'),
(634, 18, 'STATE CENTER', 'مركز الولاية'),
(635, 18, 'AL GHUZIL', 'الغزيل'),
(636, 18, 'LIWA AL JADIDAH', 'لوى الجديدة'),
(637, 18, 'MUKHILIF', 'مخيليف'),
(638, 18, 'HARMUOL', 'حرمول'),
(639, 18, 'NBER', 'نبر'),
(640, 18, 'AL RAMILAH', 'الرميلة'),
(641, 18, 'MADINA AL AHLAM', 'مدينة الاحلام'),
(642, 18, 'AL SHAEBIA GHARB', 'الشعبية غرب'),
(643, 18, 'INDUSTRIAL AREA', 'المنطقة الصناعية'),
(644, 18, 'HALAT AL HAD', 'حلة الحد'),
(645, 18, 'WADI AL QASAB', 'وادي القصب'),
(646, 18, 'FAZAH', 'فزح'),
(647, 18, 'RAHAB', 'رحب'),
(648, 19, 'KAMA', 'كمة'),
(649, 19, 'MARFAE DARS', 'مرفع دراس'),
(650, 19, 'AL SAQRIA', 'الصقرية'),
(651, 19, 'GHABRAT NIZWA', 'غبرة نزوى'),
(652, 19, 'BARKAT AL MOUZ', 'بركة الموز الحيل'),
(653, 19, 'HAY AL TURATH', 'حي التراث'),
(654, 19, 'WADI AL SUMAYT', 'وادي سميط'),
(655, 19, 'BARKAT AL MOUZ-NEW AREA', 'بركة الموز المنطقة الجديدة'),
(656, 19, 'AL WASIT', 'الواسط'),
(657, 19, 'FARQ', 'فرق'),
(658, 19, 'AL SAD', 'السد'),
(659, 19, 'KARSHAA', 'كرشاء'),
(660, 19, 'AL MAAMIR', 'المعيمير'),
(661, 19, 'AL MUETAMIR', 'المعتمر'),
(662, 19, 'TAMISA', 'طيمساء'),
(663, 19, 'AL ACADIMIAH', 'الاكاديمية'),
(664, 19, 'AL RADAH', 'الردة'),
(665, 19, 'AL RADAH AL JADIDAH', 'الردة الجديدة'),
(666, 19, 'GHAAF AL SHEIKH', 'غاف الشيخ'),
(667, 19, 'HAY AL AIN', 'حي العين'),
(668, 19, 'AL ADESAYIA', 'العداسية'),
(669, 19, 'AL AIN', 'العين'),
(670, 19, 'AL GHANTEQ', 'الغنتيق'),
(671, 19, 'SAAL', 'سعال'),
(672, 19, 'AL SUWAYQ', 'السويق'),
(673, 19, 'AL RAWAYSHIAH', 'الرويشية'),
(674, 19, 'AL AQER', 'العقر'),
(675, 19, 'AL SAALAYIA', 'السعالية'),
(676, 19, 'SEBAA', 'سيبا'),
(677, 19, 'AL MUDAH', 'المدة'),
(678, 19, 'DARIS', 'دارس'),
(679, 19, 'KUDRAH AL SARANI', 'خضرااء الصراني'),
(680, 19, 'AL GHUBRAH', 'الغبرة'),
(681, 19, 'AL SAWAYHRAYIA', 'السويحرية'),
(682, 19, 'AL MADAYFI', 'المديفي'),
(683, 19, 'HAY AL SALAM', 'حي السلام'),
(684, 19, 'AL SHARAYAH', 'الشريعة'),
(685, 19, 'AL KHAZAYNAH', 'الخزينة'),
(686, 19, 'AL SOWQ', 'السوق'),
(687, 19, 'HAIL FARQ', 'حيل فرق'),
(688, 19, 'NIZWA UNIVERSITY', 'جامعة نزوى'),
(689, 19, 'BARKAT AL MOUZ-AL SHARAYAH', 'بركة الموز الشريعة'),
(690, 19, 'POLICE ACADEMY', 'اكادمية الشرطة'),
(691, 19, 'AL RAHBAH', 'الرحبة'),
(692, 19, 'RADAT AL BUSAIED', 'ردة البوسعيد'),
(693, 19, 'AL GHAFFTAYN', 'الغافتين'),
(694, 19, 'TAWI AL NISF', 'طوي النصف'),
(695, 19, 'SINAEIAT TAWI AL NIF', 'صناعية طوي النص'),
(696, 19, 'SHIRIJAT', 'شريجات'),
(697, 19, 'JAHFAN', 'جحفان'),
(698, 19, 'AL MUAYDIN', 'المويدين'),
(699, 19, 'AL MUDAYBI', 'المضيبي'),
(700, 20, 'AL BELAD', 'البلاد'),
(701, 20, 'MAMAD', 'معمد'),
(702, 20, 'AZ', 'عز'),
(703, 20, 'HAY AL JAMA\'A', 'حي الجامع'),
(704, 20, 'AL MARAA', 'المعرى'),
(705, 20, 'AL BAYAED', 'البياض'),
(706, 20, 'MAHULE', 'محيول'),
(707, 20, 'AL SHAEBIA', 'الشعبية'),
(708, 20, 'ABO AL SURWG', 'ابو الصروج'),
(709, 20, 'MARKAZ AL MADENAH (CITY CENTER)', 'مركز المدينة'),
(710, 20, 'AL FEQYAN', 'الفيقين'),
(711, 20, 'AL FENIN', 'الفينين'),
(712, 20, 'MATAN', 'متان'),
(713, 21, 'AL BASHAYER NEAR THE MAIN STREET', 'البشائر الشارع العام'),
(714, 21, 'AL QALEA', 'القلعة'),
(715, 21, 'AL SHAEBIA', 'الشعبية'),
(716, 21, 'AL EILAYA', 'العلاية'),
(717, 21, 'AL MAHRUQIA', 'المحروقية'),
(718, 21, 'AL BISITIN', 'البيسيتين'),
(719, 21, 'AL RAHBA', 'الرحبة'),
(720, 21, 'AL SALIL', 'السليل'),
(721, 21, 'AL SAAKIBIA', 'الساكبية'),
(722, 21, 'AL SHAABINA', 'الشابنة'),
(723, 21, 'AL SAMIRAT', 'السميرات'),
(724, 21, 'AL EANQAA', 'العنقاء'),
(725, 21, 'HARAT ALRENZ', 'حارة الرنز'),
(726, 21, 'HOSN AL HAWASHIM', 'حصن الهواشم'),
(727, 21, 'AL FALIJ', 'الفليج'),
(728, 21, 'AL JAMIE', 'الجامع'),
(729, 21, 'AL ZABAR', 'الزبار'),
(730, 21, 'AL HANDALI', 'الحندلي'),
(731, 21, 'HAI AL SAFAA', 'حي الصفاء'),
(732, 22, 'WASIT AL MADINAH', 'وسط المدينة'),
(733, 22, 'AL MURKAAD', 'المركاض'),
(734, 22, 'AL ABREEN (ROUNDABOUT)', 'العبرين الدوار'),
(735, 22, 'QALAT AL MUSALAH (CITY CENTER)', 'قلعة المصالحة'),
(736, 22, 'WADI GHWL', 'وادي غول'),
(737, 22, 'AL SHAEBIA', 'الشعبية'),
(738, 22, 'KADM', 'كدم'),
(739, 22, 'QARAYT BANI SUBH', 'قرية بني صبح'),
(740, 22, 'AL HARIJA', 'الحريجة'),
(741, 22, 'AL MUNAYZAF', 'المنيزف'),
(742, 22, 'AL SAHMA', 'السحمة'),
(743, 22, 'AL HEDA', 'الحدة'),
(744, 22, 'AL RADIDA', 'الرديدة'),
(745, 22, 'TAWI SALIM', 'طوي سليم'),
(746, 23, 'AL GHAFAAT (AL MARKAZ)', 'الغافات المركز'),
(747, 23, 'BISAYIA', 'بسياء'),
(748, 23, 'AL MAEMUR', 'المعمور'),
(749, 23, 'AL HABI', 'الحبي'),
(750, 23, 'AL MAEMURAH', 'المعمورة'),
(751, 23, 'WADI QURAYYAT', 'وادي قريات'),
(752, 23, 'JUMAH', 'جماح'),
(753, 23, 'CITY CENTER', 'مركز المدينة'),
(754, 23, 'HAY AL SAAD', 'حي السعد'),
(755, 23, 'BELAD SAYT-HAY AL SALAM', 'بلاد سيت حي السلام'),
(756, 23, 'MAWAYHE AL MUR', 'مويهي المر'),
(757, 23, 'WADI AL A\'ALA (APPROACHING TO AL GHAFFAT)', 'وادي الاعلى الغافات'),
(758, 23, 'AL EASHI (APPROACHING TO AL GHAFFAT)', 'العيشي الغافات'),
(759, 23, 'WADI QURAYYAT (NEAR TO AL GHAFFAT BRIDGE)', 'وادي قريات جسر الغافات'),
(760, 23, 'AL FATAH', 'الفتح'),
(761, 23, 'KHMAILAH', 'خميلة'),
(762, 23, 'JEBRIN', 'جبرين'),
(763, 23, 'ALKHARM', 'الخرم'),
(764, 23, 'AL GHAFFAT', 'الغافات'),
(765, 23, 'AL HAFER', 'الحافات'),
(766, 23, 'BELAD SAYT', 'بلاد سيت'),
(767, 23, 'SANT (AL GAFFAT)', 'سنت الغافات'),
(768, 23, 'AL A\'ALA ( AL GAFFAT)', 'الاعلى الغافات'),
(769, 23, 'AL AESHI (AL GAFFAT)', 'العيشي الغافات'),
(770, 23, 'MURIK (AL GAFFAT)', 'مريخ الغافات'),
(771, 23, 'AL SAFALA', 'السفالة'),
(772, 23, 'SIH AL MAEASHI (NEAR THE STREET)', 'سيح المعاشي الشارع'),
(773, 23, 'AL MUSTAGHFER', 'المستغفر'),
(774, 23, 'GHUBRAHAT BAHLA', 'غبرة بهلاء'),
(775, 23, 'AL MISTAH', 'المسطاح'),
(776, 23, 'AL KATWAH', 'الخطوة'),
(777, 23, 'AIN WADLAH', 'عين وضلح'),
(778, 23, 'FL', 'فل'),
(779, 23, 'AL HASHIA', 'الحشية'),
(780, 23, 'AL FARAJ', 'الفراج'),
(781, 23, 'AL KHADRA', 'الخضراء'),
(782, 23, 'HARAT AL GHAF', 'حارة الغاف'),
(783, 23, 'TAWI AL NIS', 'طوي النص'),
(784, 23, 'AL RAKA', 'الركة'),
(785, 23, 'AL KHRAIS', 'الخريص'),
(786, 23, 'TANUF', 'تنوف'),
(787, 23, 'AL BARID', 'البريد'),
(788, 23, 'AL SOUQ', 'السوق'),
(789, 23, 'AL BIDAA', 'البدعة'),
(790, 23, 'AL HAFER', 'الحافر'),
(791, 23, 'AL SAYH AL ABIAD', 'السيح الابيض'),
(792, 23, 'AL MAEMUR BAHLA', 'المعمور بهلاء'),
(793, 23, 'AL MAEMURAH', 'المعمورة'),
(794, 24, 'LEZG', 'لزغ'),
(795, 24, 'AL KHUBAR', 'الخوبار'),
(796, 24, 'SIJAA', 'سيجاء'),
(797, 24, 'AL MEDARAH', 'المدرة'),
(798, 24, 'SOUMRAH', 'صومرة'),
(799, 24, 'AL DASSER', 'الدسر'),
(800, 24, 'AL GHABRA (SAFALET SUMAIL)', 'الغبرة سفالة سمائل'),
(801, 24, 'WADI BANI RAWAHAH', 'وادي بني رواحة'),
(802, 24, 'AL SAWAYREJ', 'الصويريج'),
(803, 24, 'QURN AL JARIAH', 'قرن الجارية'),
(804, 24, 'AL JAYLAH-AL TAWAYKAT', 'الجيلة الطويخات'),
(805, 24, 'AL JAYLAH-AL MUKHATATAT AL JADIDAH', 'الجيلة المخططات الجديدة'),
(806, 24, 'TAWI AL NSS', 'طوي النص'),
(807, 24, 'SUROR', 'سرور'),
(808, 24, 'FALAJAT', 'فلجات'),
(809, 24, 'AL HAJIR', 'الحاجر'),
(810, 24, 'WADI BANI RAWAHAH', 'وادي بني رواحة جسر الغافية'),
(811, 24, 'WADI QURI', 'وادي قري'),
(812, 24, 'WADI MAHRAM (AL AFIAYAH BRIDGE)', 'وادي محرم جسر العافية'),
(813, 24, 'AL AAWAYNAH', 'العوينة'),
(814, 24, 'AL ALYAH', 'العلاية'),
(815, 24, 'MANAL', 'منال'),
(816, 24, 'AL AJAM', 'العجم'),
(817, 24, 'AL SAFALA', 'السفالة'),
(818, 24, 'MRMRAAMI', 'مرمرامي'),
(819, 24, 'AL BEER', 'البير'),
(820, 24, 'HSAS', 'هصاص'),
(821, 24, 'AL HOUB', 'الهوب'),
(822, 24, 'HIL', 'هيل'),
(823, 24, 'AL AFIAH BRIDGE', 'جسر العافية'),
(824, 24, 'AL SAFA', 'الصفاء'),
(825, 24, 'AL MUNABK', 'المنابك'),
(826, 24, 'AL FAYHAA', 'الفيحاء'),
(827, 24, 'SRUR', 'سرور'),
(828, 24, 'AL FAGHARAH', 'الفاغرة'),
(829, 24, 'AL DAN', 'الدن'),
(830, 24, 'AL MISFAH', 'المسفاة'),
(831, 24, 'AL JANAAT', 'الجناة'),
(832, 24, 'FARAWAH', 'فاروة'),
(833, 24, 'AL NAJID', 'النجيد'),
(834, 24, 'AL DIR', 'الدير'),
(835, 24, 'LUEBA', 'لعبة'),
(836, 24, 'HAI AL MAZRAEA', 'حي المزرعة'),
(837, 24, 'AL ABRAHIMIA', 'الابراهيمية'),
(838, 24, 'FALIJ AL MURAGHA', 'فلج المراغة'),
(839, 24, 'TAWI DAHMAN', 'طوي دهمان'),
(840, 25, 'QALAT AL AWAMIR', 'قلعة العوامر'),
(841, 25, 'MAGHYUTH', 'مغيوث'),
(842, 25, 'HARAT AL RAHAA', 'حارة الرحي'),
(843, 25, 'AL TUOQ', 'الطوق'),
(844, 25, 'EMTI', 'امطي'),
(845, 25, 'SIMA', 'سيما'),
(846, 25, 'IZKI HEIGHTS', 'مرتفعات ازكي'),
(847, 25, 'SHAFA/MASAKEN AL MUDARAAT', 'شافع مسكن المدرعات'),
(848, 25, 'AL QURAYTAEN', 'القريتين'),
(849, 25, 'AL SHAAMAAHT', 'السحاماة'),
(850, 25, 'AL REHAB', 'الرحاب'),
(851, 25, 'TAWI AL LITHA', 'طوي اللثة'),
(852, 25, 'AL MUDFAEIAH', 'المدفعية'),
(853, 25, 'IZKI HOSPITAL', 'مستشفى ازكي'),
(854, 25, 'AL OWAYNAH', 'العوينة'),
(855, 25, 'AL DAHER', 'الظاهر'),
(856, 25, 'AL REYSIS', 'الرسيس'),
(857, 25, 'WADI AL HAJR', 'وادي الحجر'),
(858, 25, 'WADI AL SHUBAK', 'وادي الشباك'),
(859, 25, 'AL HAMAYDAH', 'الحميضة'),
(860, 25, 'MUQAZAH', 'مقزح'),
(861, 25, 'AL ALAM', 'العلم'),
(862, 25, 'AL GHALIL', 'الغليل'),
(863, 25, 'NIZAR', 'نزار'),
(864, 25, 'QAROTE AL SHAMALIYYAH', 'قاروت الجنوبية'),
(865, 25, 'QAROTE AL JANUBIAH', 'قاروت الشمالية'),
(866, 25, 'AL WEDI', 'الودي'),
(867, 25, 'HAMIM', 'حميم'),
(868, 25, 'AL MUSFYAA', 'المصفياء'),
(869, 25, 'YMIN', 'يمن'),
(870, 25, 'QURN QATAAR', 'قرن قطار'),
(871, 25, 'SADII', 'سدي'),
(872, 25, 'AL KHARMAA', 'الخرماء'),
(873, 25, 'AL MANZELAYAH', 'المنزلية'),
(874, 25, 'TAWI AL AQBAH', 'طوي العقبة'),
(875, 25, 'QURAYSAA', 'قريصاء'),
(876, 25, 'AL MIDFAEIA', 'المدفعية'),
(877, 25, 'HARAT AL YEMN', 'حارة ليمن'),
(878, 25, 'AL TIBBI', 'الطيبي'),
(879, 25, 'ZAKIT', 'زكيت'),
(880, 25, 'SINAEIAT QALAET AL AWAMIR', 'صناعية قلعة العوامر'),
(881, 25, 'AL SIYAHI', 'السياحي'),
(882, 25, 'AL WASIT', 'الواسط'),
(883, 25, 'HABL HADID', 'حبل حديد'),
(884, 25, 'ALSUQ AL QADIM', 'السوق القديم'),
(885, 25, 'AL AQIL', 'العاقل'),
(886, 25, 'AL HILYU', 'الحليو'),
(887, 25, 'AL HUMAYDAYN', 'الحميضين'),
(888, 25, 'AL SULIMI', 'السليمي'),
(889, 25, 'AL HAMDAYN', 'الحمضين'),
(890, 25, 'AL SHEBANIA', 'الشعبانية'),
(891, 26, 'BIDBID', 'بدبد'),
(892, 26, 'FANJA', 'فنجاء'),
(893, 26, 'FANJA-NATAYIL', 'فنجاء نطايل'),
(894, 26, 'FANJA-HALAT AL BAREED', 'فنجاء حلة البريد'),
(895, 26, 'FANJA-AL NAHDAH', 'فنجاء النهضة'),
(896, 26, 'FANJA-AL QUDS', 'فنجاء القدس'),
(897, 26, 'AL JIFNAYN', 'الجفنين'),
(898, 26, 'AL SIH AL AHAMAR', 'السيح الاحمر'),
(899, 26, 'AL AMEKAAT', 'العامقات'),
(900, 26, 'NAFFAA', 'نفعاء'),
(901, 26, 'FANJA-AL SHAEBIAH', 'فنجاء الشعبية'),
(902, 26, 'AL SAADI', 'السعادي'),
(903, 26, 'SIH AL MAADIN', 'سيح المعيدن'),
(904, 26, 'MAAZRA BIN SAAD', 'مزرع بن سعد'),
(905, 26, 'FAYHA', 'فيحة'),
(906, 26, 'SA\'AL', 'سعال'),
(907, 26, 'THAMED', 'ثميد'),
(908, 26, 'AL FIRFARAH', 'الفرفارة'),
(909, 26, 'AL SHERGHA', 'الشرجة'),
(910, 26, 'HAMIM', 'حميم'),
(911, 26, 'AL FADAEIA', 'الفضاعية'),
(912, 26, 'AL HILA AL JADIDA', 'الحلة الجديدة'),
(913, 26, 'AL KHUBI', 'الخوبي'),
(914, 26, 'AL MULTAQAA', 'الملتقى'),
(915, 26, 'FANJA WADI MANSUR', 'فنجاء وادي منصور'),
(916, 26, 'HALAT AL HOSN', 'حلة الحصن'),
(917, 27, 'ALL AREAS', 'جميع المناطق'),
(918, 19, 'KAMA', 'كمة'),
(919, 19, 'MARFAE DARS', 'مرفع دراس'),
(920, 19, 'AL SAQRIA', 'الصقرية'),
(921, 19, 'GHABRAT NIZWA', 'غبرة نزوى'),
(922, 19, 'BARKAT AL MOUZ', 'بركة الموز الحيل'),
(923, 19, 'HAY AL TURATH', 'حي التراث'),
(924, 19, 'WADI AL SUMAYT', 'وادي سميط'),
(925, 19, 'BARKAT AL MOUZ-NEW AREA', 'بركة الموز المنطقة الجديدة'),
(926, 19, 'AL WASIT', 'الواسط'),
(927, 19, 'FARQ', 'فرق'),
(928, 19, 'AL SAD', 'السد'),
(929, 19, 'KARSHAA', 'كرشاء'),
(930, 19, 'AL MAAMIR', 'المعيمير'),
(931, 19, 'AL MUETAMIR', 'المعتمر'),
(932, 19, 'TAMISA', 'طيمساء'),
(933, 19, 'AL ACADIMIAH', 'الاكاديمية'),
(934, 19, 'AL RADAH', 'الردة'),
(935, 19, 'AL RADAH AL JADIDAH', 'الردة الجديدة'),
(936, 19, 'GHAAF AL SHEIKH', 'غاف الشيخ'),
(937, 19, 'HAY AL AIN', 'حي العين'),
(938, 19, 'AL ADESAYIA', 'العداسية'),
(939, 19, 'AL AIN', 'العين'),
(940, 19, 'AL GHANTEQ', 'الغنتيق'),
(941, 19, 'SAAL', 'سعال'),
(942, 19, 'AL SUWAYQ', 'السويق'),
(943, 19, 'AL RAWAYSHIAH', 'الرويشية'),
(944, 19, 'AL AQER', 'العقر'),
(945, 19, 'AL SAALAYIA', 'السعالية'),
(946, 19, 'SEBAA', 'سيبا'),
(947, 19, 'AL MUDAH', 'المدة'),
(948, 19, 'DARIS', 'دارس'),
(949, 19, 'KUDRAH AL SARANI', 'خضرااء الصراني'),
(950, 19, 'AL GHUBRAH', 'الغبرة'),
(951, 19, 'AL SAWAYHRAYIA', 'السويحرية'),
(952, 19, 'AL MADAYFI', 'المديفي'),
(953, 19, 'HAY AL SALAM', 'حي السلام'),
(954, 19, 'AL SHARAYAH', 'الشريعة'),
(955, 19, 'AL KHAZAYNAH', 'الخزينة'),
(956, 19, 'AL SOWQ', 'السوق'),
(957, 19, 'HAIL FARQ', 'حيل فرق'),
(958, 19, 'NIZWA UNIVERSITY', 'جامعة نزوى'),
(959, 19, 'BARKAT AL MOUZ-AL SHARAYAH', 'بركة الموز الشريعة'),
(960, 19, 'POLICE ACADEMY', 'اكادمية الشرطة'),
(961, 19, 'AL RAHBAH', 'الرحبة'),
(962, 19, 'RADAT AL BUSAIED', 'ردة البوسعيد'),
(963, 19, 'AL GHAFFTAYN', 'الغافتين'),
(964, 19, 'TAWI AL NISF', 'طوي النصف'),
(965, 19, 'SINAEIAT TAWI AL NIF', 'صناعية طوي النص'),
(966, 19, 'SHIRIJAT', 'شريجات'),
(967, 19, 'JAHFAN', 'جحفان'),
(968, 19, 'AL MUAYDIN', 'المويدين'),
(969, 19, 'AL MUDAYBI', 'المضيبي'),
(970, 20, 'AL BELAD', 'البلاد'),
(971, 20, 'MAMAD', 'معمد'),
(972, 20, 'AZ', 'عز'),
(973, 20, 'HAY AL JAMA\'A', 'حي الجامع'),
(974, 20, 'AL MARAA', 'المعرى'),
(975, 20, 'AL BAYAED', 'البياض'),
(976, 20, 'MAHULE', 'محيول'),
(977, 20, 'AL SHAEBIA', 'الشعبية'),
(978, 20, 'ABO AL SURWG', 'ابو الصروج'),
(979, 20, 'MARKAZ AL MADENAH (CITY CENTER)', 'مركز المدينة'),
(980, 20, 'AL FEQYAN', 'الفيقين'),
(981, 20, 'AL FENIN', 'الفينين'),
(982, 20, 'MATAN', 'متان'),
(983, 21, 'AL BASHAYER NEAR THE MAIN STREET', 'البشائر الشارع العام'),
(984, 21, 'AL QALEA', 'القلعة'),
(985, 21, 'AL SHAEBIA', 'الشعبية'),
(986, 21, 'AL EILAYA', 'العلاية'),
(987, 21, 'AL MAHRUQIA', 'المحروقية'),
(988, 21, 'AL BISITIN', 'البيسيتين'),
(989, 21, 'AL RAHBA', 'الرحبة'),
(990, 21, 'AL SALIL', 'السليل'),
(991, 21, 'AL SAAKIBIA', 'الساكبية'),
(992, 21, 'AL SHAABINA', 'الشابنة'),
(993, 21, 'AL SAMIRAT', 'السميرات'),
(994, 21, 'AL EANQAA', 'العنقاء'),
(995, 21, 'HARAT ALRENZ', 'حارة الرنز'),
(996, 21, 'HOSN AL HAWASHIM', 'حصن الهواشم'),
(997, 21, 'AL FALIJ', 'الفليج'),
(998, 21, 'AL JAMIE', 'الجامع'),
(999, 21, 'AL ZABAR', 'الزبار'),
(1000, 21, 'AL HANDALI', 'الحندلي'),
(1001, 21, 'HAI AL SAFAA', 'حي الصفاء'),
(1002, 22, 'WASIT AL MADINAH', 'وسط المدينة'),
(1003, 22, 'AL MURKAAD', 'المركاض'),
(1004, 22, 'AL ABREEN (ROUNDABOUT)', 'العبرين الدوار'),
(1005, 22, 'QALAT AL MUSALAH (CITY CENTER)', 'قلعة المصالحة'),
(1006, 22, 'WADI GHWL', 'وادي غول'),
(1007, 22, 'AL SHAEBIA', 'الشعبية'),
(1008, 22, 'KADM', 'كدم'),
(1009, 22, 'QARAYT BANI SUBH', 'قرية بني صبح'),
(1010, 22, 'AL HARIJA', 'الحريجة'),
(1011, 22, 'AL MUNAYZAF', 'المنيزف'),
(1012, 22, 'AL SAHMA', 'السحمة'),
(1013, 22, 'AL HEDA', 'الحدة'),
(1014, 22, 'AL RADIDA', 'الرديدة'),
(1015, 22, 'TAWI SALIM', 'طوي سليم'),
(1016, 23, 'AL GHAFAAT (AL MARKAZ)', 'الغافات المركز'),
(1017, 23, 'BISAYIA', 'بسياء'),
(1018, 23, 'AL MAEMUR', 'المعمور'),
(1019, 23, 'AL HABI', 'الحبي'),
(1020, 23, 'AL MAEMURAH', 'المعمورة'),
(1021, 23, 'WADI QURAYYAT', 'وادي قريات'),
(1022, 23, 'JUMAH', 'جماح'),
(1023, 23, 'CITY CENTER', 'مركز المدينة'),
(1024, 23, 'HAY AL SAAD', 'حي السعد'),
(1025, 23, 'BELAD SAYT-HAY AL SALAM', 'بلاد سيت حي السلام'),
(1026, 23, 'MAWAYHE AL MUR', 'مويهي المر'),
(1027, 23, 'WADI AL A\'ALA (APPROACHING TO AL GHAFFAT)', 'وادي الاعلى الغافات'),
(1028, 23, 'AL EASHI (APPROACHING TO AL GHAFFAT)', 'العيشي الغافات'),
(1029, 23, 'WADI QURAYYAT (NEAR TO AL GHAFFAT BRIDGE)', 'وادي قريات جسر الغافات'),
(1030, 23, 'AL FATAH', 'الفتح'),
(1031, 23, 'KHMAILAH', 'خميلة'),
(1032, 23, 'JEBRIN', 'جبرين'),
(1033, 23, 'ALKHARM', 'الخرم'),
(1034, 23, 'AL GHAFFAT', 'الغافات'),
(1035, 23, 'AL HAFER', 'الحافات'),
(1036, 23, 'BELAD SAYT', 'بلاد سيت'),
(1037, 23, 'SANT (AL GAFFAT)', 'سنت الغافات'),
(1038, 23, 'AL A\'ALA ( AL GAFFAT)', 'الاعلى الغافات'),
(1039, 23, 'AL AESHI (AL GAFFAT)', 'العيشي الغافات'),
(1040, 23, 'MURIK (AL GAFFAT)', 'مريخ الغافات'),
(1041, 23, 'AL SAFALA', 'السفالة'),
(1042, 23, 'SIH AL MAEASHI (NEAR THE STREET)', 'سيح المعاشي الشارع'),
(1043, 23, 'AL MUSTAGHFER', 'المستغفر'),
(1044, 23, 'GHUBRAHAT BAHLA', 'غبرة بهلاء'),
(1045, 23, 'AL MISTAH', 'المسطاح'),
(1046, 23, 'AL KATWAH', 'الخطوة'),
(1047, 23, 'AIN WADLAH', 'عين وضلح'),
(1048, 23, 'FL', 'فل'),
(1049, 23, 'AL HASHIA', 'الحشية'),
(1050, 23, 'AL FARAJ', 'الفراج'),
(1051, 23, 'AL KHADRA', 'الخضراء'),
(1052, 23, 'HARAT AL GHAF', 'حارة الغاف'),
(1053, 23, 'TAWI AL NIS', 'طوي النص'),
(1054, 23, 'AL RAKA', 'الركة'),
(1055, 23, 'AL KHRAIS', 'الخريص'),
(1056, 23, 'TANUF', 'تنوف'),
(1057, 23, 'AL BARID', 'البريد'),
(1058, 23, 'AL SOUQ', 'السوق'),
(1059, 23, 'AL BIDAA', 'البدعة'),
(1060, 23, 'AL HAFER', 'الحافر'),
(1061, 23, 'AL SAYH AL ABIAD', 'السيح الابيض'),
(1062, 23, 'AL MAEMUR BAHLA', 'المعمور بهلاء'),
(1063, 23, 'AL MAEMURAH', 'المعمورة'),
(1064, 24, 'LEZG', 'لزغ'),
(1065, 24, 'AL KHUBAR', 'الخوبار'),
(1066, 24, 'SIJAA', 'سيجاء'),
(1067, 24, 'AL MEDARAH', 'المدرة'),
(1068, 24, 'SOUMRAH', 'صومرة'),
(1069, 24, 'AL DASSER', 'الدسر'),
(1070, 24, 'AL GHABRA (SAFALET SUMAIL)', 'الغبرة سفالة سمائل'),
(1071, 24, 'WADI BANI RAWAHAH', 'وادي بني رواحة'),
(1072, 24, 'AL SAWAYREJ', 'الصويريج'),
(1073, 24, 'QURN AL JARIAH', 'قرن الجارية'),
(1074, 24, 'AL JAYLAH-AL TAWAYKAT', 'الجيلة الطويخات'),
(1075, 24, 'AL JAYLAH-AL MUKHATATAT AL JADIDAH', 'الجيلة المخططات الجديدة'),
(1076, 24, 'TAWI AL NSS', 'طوي النص'),
(1077, 24, 'SUROR', 'سرور'),
(1078, 24, 'FALAJAT', 'فلجات'),
(1079, 24, 'AL HAJIR', 'الحاجر'),
(1080, 24, 'WADI BANI RAWAHAH', 'وادي بني رواحة جسر الغافية'),
(1081, 24, 'WADI QURI', 'وادي قري'),
(1082, 24, 'WADI MAHRAM (AL AFIAYAH BRIDGE)', 'وادي محرم جسر العافية'),
(1083, 24, 'AL AAWAYNAH', 'العوينة'),
(1084, 24, 'AL ALYAH', 'العلاية'),
(1085, 24, 'MANAL', 'منال'),
(1086, 24, 'AL AJAM', 'العجم'),
(1087, 24, 'AL SAFALA', 'السفالة'),
(1088, 24, 'MRMRAAMI', 'مرمرامي'),
(1089, 24, 'AL BEER', 'البير'),
(1090, 24, 'HSAS', 'هصاص'),
(1091, 24, 'AL HOUB', 'الهوب'),
(1092, 24, 'HIL', 'هيل'),
(1093, 24, 'AL AFIAH BRIDGE', 'جسر العافية'),
(1094, 24, 'AL SAFA', 'الصفاء'),
(1095, 24, 'AL MUNABK', 'المنابك'),
(1096, 24, 'AL FAYHAA', 'الفيحاء'),
(1097, 24, 'SRUR', 'سرور'),
(1098, 24, 'AL FAGHARAH', 'الفاغرة'),
(1099, 24, 'AL DAN', 'الدن'),
(1100, 24, 'AL MISFAH', 'المسفاة'),
(1101, 24, 'AL JANAAT', 'الجناة'),
(1102, 24, 'FARAWAH', 'فاروة'),
(1103, 24, 'AL NAJID', 'النجيد'),
(1104, 24, 'AL DIR', 'الدير'),
(1105, 24, 'LUEBA', 'لعبة'),
(1106, 24, 'HAI AL MAZRAEA', 'حي المزرعة'),
(1107, 24, 'AL ABRAHIMIA', 'الابراهيمية'),
(1108, 24, 'FALIJ AL MURAGHA', 'فلج المراغة'),
(1109, 24, 'TAWI DAHMAN', 'طوي دهمان'),
(1110, 25, 'QALAT AL AWAMIR', 'قلعة العوامر'),
(1111, 25, 'MAGHYUTH', 'مغيوث'),
(1112, 25, 'HARAT AL RAHAA', 'حارة الرحي'),
(1113, 25, 'AL TUOQ', 'الطوق'),
(1114, 25, 'EMTI', 'امطي'),
(1115, 25, 'SIMA', 'سيما'),
(1116, 25, 'IZKI HEIGHTS', 'مرتفعات ازكي'),
(1117, 25, 'SHAFA/MASAKEN AL MUDARAAT', 'شافع مسكن المدرعات'),
(1118, 25, 'AL QURAYTAEN', 'القريتين'),
(1119, 25, 'AL SHAAMAAHT', 'السحاماة'),
(1120, 25, 'AL REHAB', 'الرحاب'),
(1121, 25, 'TAWI AL LITHA', 'طوي اللثة'),
(1122, 25, 'AL MUDFAEIAH', 'المدفعية'),
(1123, 25, 'IZKI HOSPITAL', 'مستشفى ازكي'),
(1124, 25, 'AL OWAYNAH', 'العوينة'),
(1125, 25, 'AL DAHER', 'الظاهر'),
(1126, 25, 'AL REYSIS', 'الرسيس'),
(1127, 25, 'WADI AL HAJR', 'وادي الحجر'),
(1128, 25, 'WADI AL SHUBAK', 'وادي الشباك'),
(1129, 25, 'AL HAMAYDAH', 'الحميضة'),
(1130, 25, 'MUQAZAH', 'مقزح'),
(1131, 25, 'AL ALAM', 'العلم'),
(1132, 25, 'AL GHALIL', 'الغليل'),
(1133, 25, 'NIZAR', 'نزار'),
(1134, 25, 'QAROTE AL SHAMALIYYAH', 'قاروت الجنوبية'),
(1135, 25, 'QAROTE AL JANUBIAH', 'قاروت الشمالية'),
(1136, 25, 'AL WEDI', 'الودي'),
(1137, 25, 'HAMIM', 'حميم'),
(1138, 25, 'AL MUSFYAA', 'المصفياء'),
(1139, 25, 'YMIN', 'يمن'),
(1140, 25, 'QURN QATAAR', 'قرن قطار'),
(1141, 25, 'SADII', 'سدي'),
(1142, 25, 'AL KHARMAA', 'الخرماء'),
(1143, 25, 'AL MANZELAYAH', 'المنزلية'),
(1144, 25, 'TAWI AL AQBAH', 'طوي العقبة'),
(1145, 25, 'QURAYSAA', 'قريصاء'),
(1146, 25, 'AL MIDFAEIA', 'المدفعية'),
(1147, 25, 'HARAT AL YEMN', 'حارة ليمن'),
(1148, 25, 'AL TIBBI', 'الطيبي'),
(1149, 25, 'ZAKIT', 'زكيت'),
(1150, 25, 'SINAEIAT QALAET AL AWAMIR', 'صناعية قلعة العوامر'),
(1151, 25, 'AL SIYAHI', 'السياحي'),
(1152, 25, 'AL WASIT', 'الواسط'),
(1153, 25, 'HABL HADID', 'حبل حديد'),
(1154, 25, 'ALSUQ AL QADIM', 'السوق القديم'),
(1155, 25, 'AL AQIL', 'العاقل'),
(1156, 25, 'AL HILYU', 'الحليو'),
(1157, 25, 'AL HUMAYDAYN', 'الحميضين'),
(1158, 25, 'AL SULIMI', 'السليمي'),
(1159, 25, 'AL HAMDAYN', 'الحمضين'),
(1160, 25, 'AL SHEBANIA', 'الشعبانية'),
(1161, 26, 'BIDBID', 'بدبد'),
(1162, 26, 'FANJA', 'فنجاء'),
(1163, 26, 'FANJA-NATAYIL', 'فنجاء نطايل'),
(1164, 26, 'FANJA-HALAT AL BAREED', 'فنجاء حلة البريد'),
(1165, 26, 'FANJA-AL NAHDAH', 'فنجاء النهضة'),
(1166, 26, 'FANJA-AL QUDS', 'فنجاء القدس'),
(1167, 26, 'AL JIFNAYN', 'الجفنين'),
(1168, 26, 'AL SIH AL AHAMAR', 'السيح الاحمر'),
(1169, 26, 'AL AMEKAAT', 'العامقات'),
(1170, 26, 'NAFFAA', 'نفعاء'),
(1171, 26, 'FANJA-AL SHAEBIAH', 'فنجاء الشعبية'),
(1172, 26, 'AL SAADI', 'السعادي'),
(1173, 26, 'SIH AL MAADIN', 'سيح المعيدن'),
(1174, 26, 'MAAZRA BIN SAAD', 'مزرع بن سعد'),
(1175, 26, 'FAYHA', 'فيحة'),
(1176, 26, 'SA\'AL', 'سعال'),
(1177, 26, 'THAMED', 'ثميد'),
(1178, 26, 'AL FIRFARAH', 'الفرفارة'),
(1179, 26, 'AL SHERGHA', 'الشرجة'),
(1180, 26, 'HAMIM', 'حميم'),
(1181, 26, 'AL FADAEIA', 'الفضاعية'),
(1182, 26, 'AL HILA AL JADIDA', 'الحلة الجديدة'),
(1183, 26, 'AL KHUBI', 'الخوبي'),
(1184, 26, 'AL MULTAQAA', 'الملتقى'),
(1185, 26, 'FANJA WADI MANSUR', 'فنجاء وادي منصور'),
(1186, 26, 'HALAT AL HOSN', 'حلة الحصن'),
(1187, 27, 'ALL AREAS', 'جميع المناطق'),
(1188, 28, 'AL SUNAEIAH', 'الصناعية'),
(1189, 28, 'AL SHRQAH', 'الشرجة'),
(1190, 28, 'HAY AL MATTAR', 'حي المطار'),
(1191, 28, 'AL SHAEBIA', 'الشعبية'),
(1192, 28, 'AL SHARAYAH AL JADIDAH', 'الشربة الجديدة'),
(1193, 28, 'AL HAJIR', 'الحاجر'),
(1194, 28, 'AL SEEBAH', 'السيبة'),
(1195, 28, 'BURAYDAH', 'بريدة'),
(1196, 28, 'SEKAT AL SOWQ', 'سكة السوق'),
(1197, 28, 'OLD SOWQ', 'السوق القديم'),
(1198, 28, 'HAY AL SALAM', 'حي السلام'),
(1199, 28, 'AL WAYIM', 'الويم'),
(1200, 28, 'BANI MOHAMMAD OBIED', 'بني محمد عبيد'),
(1201, 28, 'HARAT KUMZARAH', 'حارة الكمازرة'),
(1202, 28, 'AL NAHDAH', 'النهضة'),
(1203, 28, 'AL HAALAH', 'الحالة'),
(1204, 28, 'AL WASTAA', 'الوسطى'),
(1205, 28, 'QUDA', 'قدى'),
(1206, 28, 'AL HARF', 'الحرف'),
(1207, 28, 'AL SAYLAN', 'السليان'),
(1208, 28, 'MAWWAH', 'موة'),
(1209, 28, 'SEEMA', 'سيما'),
(1210, 28, 'SAL ASFAL', 'سل اسفل'),
(1211, 28, 'SAL AALA', 'سل اعلى'),
(1212, 28, 'AL MUQYAD', 'المقياض'),
(1213, 28, 'KABAS AL QASIR', 'كبس القصر'),
(1214, 28, 'HAL KHUB', 'هل خب'),
(1215, 28, 'AL JAZIM', 'الجزم'),
(1216, 28, 'HAY AL EDARI', 'حي الاداري'),
(1217, 29, 'GHAMDA', 'غمضاء'),
(1218, 29, 'BUKHA', 'بخاء'),
(1219, 29, 'AL JARY', 'الجري'),
(1220, 29, 'AL JADI', 'الجادي'),
(1221, 29, 'BUKHA', 'بخا'),
(1222, 29, 'FADGHA', 'فضغاء'),
(1223, 29, 'TAYBAT', 'تيبات'),
(1224, 29, 'AL HARAH AL SHARQIYAH', 'الحارة الشرقية'),
(1225, 29, 'SAGERAH', 'صغيرة'),
(1226, 30, 'AL BAYAH', 'البيعة'),
(1227, 30, 'SIH AL DEER', 'سيح الدير'),
(1228, 30, 'AL MASIH', 'المسيح'),
(1229, 30, 'KHARSHA', 'كرشا'),
(1230, 30, 'AL SHAEBIA', 'الشعبية'),
(1231, 30, 'QUROON AL SAYD', 'قرون الصيد'),
(1232, 30, 'AL GHRABIAH', 'الغرابية'),
(1233, 30, 'AL KHUBAH', 'الخبة'),
(1234, 30, 'AL HAJIR', 'الحاجر'),
(1235, 30, 'HALQ AL WADI', 'حلق الوادي'),
(1236, 30, 'ANSOR', 'انصور'),
(1237, 30, 'QUROON AL SAYD', 'قرون الصيد'),
(1238, 30, 'QUSTAYNIAH', 'قسطينية'),
(1239, 30, 'TAWAHI', 'تواهي'),
(1240, 30, 'SIH AL JAMAHIRAH', 'سيح الجماهرة'),
(1241, 30, 'TAB AL KHATIB', 'تب الخطيب'),
(1242, 30, 'AL SHAEBIA', 'الشعبية'),
(1243, 30, 'AL BELAD', 'البلاد'),
(1244, 30, 'AL HARAH', 'الحارة'),
(1245, 30, 'LAMYAA', 'لمياء'),
(1246, 31, 'EAST SALALAH', 'صلالة الشرقية'),
(1247, 31, 'WEST SALALAH', 'صلالة الغربية'),
(1248, 31, 'AL WADI', 'الوادي'),
(1249, 31, 'AL MUATAZAH', 'المعتزة'),
(1250, 31, 'RAYSUT', 'ريسوت'),
(1251, 31, 'AL HAFFA', 'الحافة'),
(1252, 31, 'AL QAWF', 'القوف'),
(1253, 31, 'AL QARED', 'القرض'),
(1254, 31, 'AD DAHARIZ NORTH', 'الدهاريز الشمالية'),
(1255, 31, 'AD DAHARIZ SOUTH', 'الدهاريز الجنوبية'),
(1256, 31, 'AS SAADH SOUTH', 'السعادة الجنوبية'),
(1257, 31, 'AS SAADH NORTH', 'السعادة الشمالية'),
(1258, 31, 'SALALAH AL JADIDAH', 'صلالة الجديدة'),
(1259, 31, 'SHALNOOT', 'صحلنوت'),
(1260, 31, 'AL HASAYLAH', 'الحصيلة'),
(1261, 31, 'AL GHARBIA', 'الغربية'),
(1262, 31, 'AWQAD AL JANUBIA', 'عوقد الجنوبية'),
(1263, 31, 'AWQAD AL SHAMALIYYAH', 'عوقد الشمالية'),
(1264, 31, 'SALALAH AL WASITA', 'صلالة الوسطى'),
(1265, 31, 'AL SUNAEIAH', 'الصناعية'),
(1266, 31, 'UNIVERSITY DORMS', 'سكنات الجامعة'),
(1267, 31, 'RAYSUT', 'ريسوت'),
(1268, 31, 'AL BELAID', 'البليد'),
(1269, 31, 'AL MAMOORAH', 'المعمورة'),
(1270, 31, 'SAHAL ATEEN', 'سهل اتين'),
(1271, 31, 'RZAT', 'رزات'),
(1272, 31, 'AL SOWQ AL MARKAZI', 'السوق المركزي'),
(1273, 32, 'TAQAH', 'طاقة'),
(1274, 33, 'MIRBAT', 'مرباط'),
(1275, 34, 'AL AIJAH', 'العيجة'),
(1276, 34, 'RAAS AL HAD', 'رأس الحد'),
(1277, 34, 'RAAS AL JANZ', 'رأس الجنز'),
(1278, 34, 'SIH AL MATTAR', 'سيح المطار'),
(1279, 34, 'AL RASHAH', 'الرشة'),
(1280, 34, 'AL MUSFIAH', 'المصفية'),
(1281, 34, 'MUKHA', 'مخة'),
(1282, 34, 'AL SHIRYAH', 'الشرية'),
(1283, 34, 'AL MURATAFAH', 'المرتفعة'),
(1284, 34, 'NAEMA', 'نعمة'),
(1285, 34, 'SKAKAYRAH', 'سكيكرة'),
(1286, 34, 'BELAD SUR', 'بلاد صور'),
(1287, 34, 'BO QULAA', 'بو قلع'),
(1288, 34, 'THE HOSPITAL HEIGHTS', 'مرتفعات المستشفى'),
(1289, 34, 'AL TELEVISION HEIGHTS', 'مرتفعات التلفزيون'),
(1290, 34, 'HAY AL NOOR', 'حي النور'),
(1291, 34, 'NASMA', 'نسمة'),
(1292, 34, 'AL SAT', 'السط'),
(1293, 34, 'AL SABKHAH', 'الصبخة'),
(1294, 34, 'SHYAA', 'شياع'),
(1295, 34, 'FARAHAT', 'فرحات'),
(1296, 34, 'AL HUSAINIAH', 'الحصينية'),
(1297, 34, 'TAY (AS SULTAN QABOOS MOSQUE)', 'طي جامع السلطان قابوس'),
(1298, 34, 'TAHWA (AS SULTAN QABOOS MOSQUE)', 'طهوة جامع السلطان قابوس'),
(1299, 34, 'AL FALAYJ (AS SULTAN QABOOS MOSQUE)', 'الفليج جامع السلطان قابوس'),
(1300, 34, 'AL GHLAYLAH', 'الغليلة'),
(1301, 34, 'TIWI (INNER STREET)', 'طيوي الشارع الداخلي'),
(1302, 34, 'HAY AL SHAROOQ (NEAR THE GATE)', 'حي الشروق عند البوابة'),
(1303, 34, 'AL BAR', 'البر'),
(1304, 34, 'AL SAHIL', 'الساحل'),
(1305, 34, 'AL SHAEBIA', 'الشعبية'),
(1306, 34, 'KHARABAA', 'كهرباء'),
(1307, 34, 'JABEL EID', 'جبل عيد'),
(1308, 34, 'MUKRMAH', 'مخرمة'),
(1309, 34, 'AL SENAYSLAH', 'السنيسلة'),
(1310, 34, 'AL AIS', 'العيص'),
(1311, 34, 'BAMAH (NEAR THE STREET)', 'بمة الشارع العام'),
(1312, 34, 'QALHAT', 'قلهات الشارع العام'),
(1313, 34, 'AL SOUQ', 'السوق'),
(1314, 34, 'AL JABAL AL WARDI', 'الجبل الوردي'),
(1315, 34, 'RIDAGH', 'رضاغ'),
(1316, 34, 'AL AFIFA', 'العفيفة'),
(1317, 34, 'SIH AL HASANAT', 'سيح الحسنات'),
(1318, 34, 'KHUR JIRAMAN', 'خور جراما'),
(1319, 35, 'AL NAHDA', 'النهضة'),
(1320, 35, 'AL MAEMURAH', 'المعمورة'),
(1321, 35, 'MURA', 'مرة'),
(1322, 35, 'HARAT AL NUZHAH', 'حارة النزهة'),
(1323, 35, 'SHABEAT AL WAFI', 'شعبية الوافي'),
(1324, 35, 'AL MANSURAYIAH', 'المنصورية'),
(1325, 35, 'SIH AL NAQAH', 'سيح الناقة'),
(1326, 35, 'TAWI ASHA', 'طوي عاشة'),
(1327, 35, 'AL KAMIL SOWQ', 'سوق الكامل'),
(1328, 35, 'HARAT AL TAWAEEN', 'حارة الطواعين'),
(1329, 35, 'SHOF AL AIN', 'شوف العين'),
(1330, 35, 'AL MANSURAYIAH', 'المنصورية'),
(1331, 35, 'AL WAFI SOWQ', 'سوق الوافي'),
(1332, 35, 'SUBAKH', 'صباغ'),
(1333, 35, 'TAWI HATROOSH', 'طوي حتروش'),
(1334, 35, 'GHBAYRAT', 'غبيرات'),
(1335, 35, 'HADIR BELAD', 'حدر بلاد'),
(1336, 35, 'TAWI ASHA', 'طوي عاشة'),
(1337, 35, 'AL BUAYRID', 'البويرد'),
(1338, 35, 'HARAT AL SARAHNAH', 'حارة السراحنة'),
(1339, 35, 'SAIF AL SHAAWRI', 'سيف الشاوري'),
(1340, 35, 'AL HAYOO', 'الحيو'),
(1341, 35, 'SIH AL HAADRI', 'سيح الحدري'),
(1342, 35, 'AL MAHSURIAH', 'المصورية'),
(1343, 35, 'SHESHAH', 'شيشة'),
(1344, 35, 'RUMAILAH', 'رميلة'),
(1345, 35, 'MAZRAT AL RAED', 'مزرعة الرائد'),
(1346, 35, 'TAWI HATIM', 'طوي حاتم'),
(1347, 35, 'SABT (NEAR THE BRIDGE)', 'سبت عند الجسر'),
(1348, 35, 'IZ', 'عز'),
(1349, 35, 'HUMAYADA', 'حميضة'),
(1350, 35, 'HARAT AL GHWALIN', 'حارة الغوالين'),
(1351, 35, 'MISHBAHIN', 'مشباحين'),
(1352, 35, 'MAHYUL', 'محيول'),
(1353, 35, 'AL ASKANDARIA', 'الاسكندرية'),
(1354, 36, 'AL MARIBII', 'المريبي'),
(1355, 36, 'AL SUNAEIAH', 'الصناعية'),
(1356, 36, 'SIH AL SHARQI', 'سيح الشرجي'),
(1357, 36, 'AL ATHWAH', 'العذوة'),
(1358, 36, 'RAFEEAH', 'رفيعة'),
(1359, 36, 'HARAT AL SAWAWIE', 'حارة الصواويع'),
(1360, 36, 'FALAYZ MAHUL', 'فليج محيول'),
(1361, 36, 'AL SOWQ', 'السوق '),
(1362, 36, 'AL SHAEBIA', 'الشعبية');
INSERT INTO `areas` (`id`, `governorate_id`, `name`, `name_ar`) VALUES
(1363, 36, 'AL HUSIN', 'الحصن'),
(1364, 36, 'TAWI AMMER', 'طوي عامر'),
(1365, 36, 'SIH AL MUQAHIMA', 'سيح المقاحمة'),
(1366, 36, 'AL SAMEIAH', 'الصمية'),
(1367, 36, 'MSILAH', 'مسيلة'),
(1368, 36, 'SHABAT AL OUD', 'شعبة العود'),
(1369, 36, 'AL GHANIMAH', 'الغنيمة'),
(1370, 36, 'AL LAWYAH', 'اللوية'),
(1371, 36, 'SIH AL MATER', 'سيح مطير'),
(1372, 36, 'MANJELYAH', 'منجيلة'),
(1373, 36, 'AL SHAHIMAT', 'الشحيمات'),
(1374, 36, 'AL MUNJRAED', 'المنجرد'),
(1375, 36, 'AL RADA', 'الردة'),
(1376, 36, 'FALIJ AL MASHAYIKH', 'فلج المشايخ'),
(1377, 36, 'AL GHAMLUL', 'الغملول'),
(1378, 36, 'AL SAAQITA', 'الساقطة'),
(1379, 37, 'SIH SNIDAH', 'سيح سندة'),
(1380, 37, 'SIH QURIHAH', 'سيح قريحة'),
(1381, 37, 'SIH AL ULA', 'سيح العلا'),
(1382, 37, 'SIH AL SADER', 'سيح الصادر'),
(1383, 37, 'AL SUNAEIAH', 'الصناعية'),
(1384, 37, 'AL HAIRAH', 'الحيرة'),
(1385, 37, 'AL SOWQ', 'السوق'),
(1386, 37, 'SIH AL AIRSHAAN', 'سيح العرشان'),
(1387, 37, 'LITAQ', 'ليتاق'),
(1388, 37, 'HAY AL RAQIE', 'حي الراقي'),
(1389, 37, 'AL LWYIAH', 'اللوية'),
(1390, 37, 'AL SELIL', 'السليل'),
(1391, 37, 'FULI', 'فلي'),
(1392, 37, 'AL QURHA', 'القرحة'),
(1393, 37, 'AL DAHER', 'الظاهر'),
(1394, 37, 'AL ZUBAAD', 'الزباد'),
(1395, 37, 'SIH ZUBAYRI', 'سيح زبيري'),
(1396, 37, 'AL TAYBAH', 'الطيبة'),
(1397, 37, 'SLAL', 'صلال'),
(1398, 37, 'AL SHAEBIAH', 'الشعبية'),
(1399, 37, 'GHWAILAH (SHELL STATION)', 'غويلة'),
(1400, 37, 'SIH AL QURIHA', 'سيح قريحة'),
(1401, 37, 'AL MUARAAH', 'المعارة'),
(1402, 37, 'AL FALAYJ', 'الفليج'),
(1403, 37, 'AL MADYWYRA', 'المديويرة'),
(1404, 38, 'NEAR THE BRIDGE', 'قريب من الجسر'),
(1405, 38, 'MUQIL', 'مقل'),
(1406, 38, 'EUMQ', 'عمق'),
(1407, 38, 'ALEAQR', 'العقر'),
(1408, 38, 'ALQARYA', 'القرية'),
(1409, 38, 'ALHUJRA', 'الحجرة'),
(1410, 38, 'ALJUHLA', 'الجحلة'),
(1411, 38, 'DUH', 'دوه'),
(1412, 38, 'SIH ALHIL', 'سيح الحيل'),
(1413, 38, 'SIH ALRAFEI', 'سيح الرفيع'),
(1414, 38, 'MUZAYRAE', 'مزيرع'),
(1415, 38, 'ALKHUTAH', 'الخطاه'),
(1416, 38, 'JABAL HAYIH', 'جبل حيه'),
(1417, 38, 'SHIRAJ JADAL', 'شراج جدل'),
(1418, 38, 'ALRAFIEA', 'الرفيعة'),
(1419, 38, 'SHARAJAT FATIMA', 'شرجة فاطمة'),
(1420, 38, 'ALEADAFAYN', 'العدفين'),
(1421, 38, 'HARAT AL HISN', 'حارة الحصن'),
(1422, 38, 'FATAWAH', 'فطواه'),
(1423, 38, 'ALSAYH ALEALI', 'السيح العالي'),
(1424, 38, 'JURIF EALIN', 'جرف علي'),
(1425, 38, 'HALFAN', 'حلفا'),
(1426, 38, 'HARAT BANI YOUSUF', 'حارة بني يوسف'),
(1427, 38, 'BIDEATAN', 'بضعة'),
(1428, 38, 'ALSSYDAFY', 'السيدافي'),
(1429, 38, 'ALQAHM', 'القحم'),
(1430, 38, 'ALWISHAH', 'الوشاح'),
(1431, 38, 'ALEABIA', 'العابية'),
(1432, 38, 'TAWI SAEID', 'طوي سعيد'),
(1433, 38, 'ALRAMIL', 'الرميل'),
(1434, 38, 'BUAYRA', 'بويرة'),
(1435, 39, 'AL FATAH', 'الفتح'),
(1436, 39, 'AL AFLAAJ', 'الافلاج'),
(1437, 39, 'AL SHARQ', 'الشارق'),
(1438, 39, 'AL MUKHTARAE', 'المخترع'),
(1439, 39, 'AL KHASHBA', 'الخشبة'),
(1440, 39, 'AL AINAYN', 'العينين'),
(1441, 39, 'AL ZAHEB', 'الزاهب'),
(1442, 39, 'AL RADAH', 'الردة'),
(1443, 39, 'AL BUWAYTEEN', 'البويطن'),
(1444, 39, 'AL SUDAYRAH', 'السديرة'),
(1445, 39, 'AL WAFI', 'الوافي'),
(1446, 39, 'AL JARDAA (NEAR THE BRIDGE)', 'الجرداء الجسر'),
(1447, 39, 'AL ZUBAYDI', 'الزيدي'),
(1448, 39, 'ALHALQAT ALGHARBIA', 'الحلة الغربية'),
(1449, 39, 'ALBAHIA', 'الباهية'),
(1450, 39, 'WADI ALDUWH', 'وادي الدوح'),
(1451, 39, 'ALQABIL', 'القابل'),
(1452, 39, 'ALBATHA', 'البطحاء'),
(1453, 39, 'ALAFLAJ MAHATAT ALMHA', 'الافلاج محطة المها'),
(1454, 39, 'ALZAHRA', 'الزهراء'),
(1455, 40, 'ALSUWQ', 'السوق'),
(1456, 40, 'ALMAGHDAR', 'المغدر'),
(1457, 40, 'ALMAGHDAR AL JADEEDA', 'المغدر الجديدة'),
(1458, 40, 'ALSHAEBIA', 'الشعبية'),
(1459, 40, 'ALHANZALI', 'الحنظلي'),
(1460, 40, 'SIH ALKHASHITA', 'سيح الخشيتة'),
(1461, 40, 'ALWASIT', 'الواسط'),
(1462, 40, 'JAFR QUTBA', 'جفر قطبة'),
(1463, 40, 'ALEUYUN', 'العيون'),
(1464, 40, 'ALHUYD', 'الحويض'),
(1465, 40, 'ALMUSALAA', 'المصلى'),
(1466, 40, 'ALMUNTARIB', 'المنترب'),
(1467, 40, 'ALMUTILIE', 'المطيلع'),
(1468, 40, 'ALSINAEIA', 'الصناعية'),
(1469, 40, 'SAFNAN', 'صفنان'),
(1470, 40, 'ALJUAYEA', 'الجويعة'),
(1471, 40, 'ALMUJAZA', 'المجازة'),
(1472, 40, 'ALKHURAYS', 'الخريص'),
(1473, 40, 'ALSHAEBIA', 'الشعبية'),
(1474, 40, 'BARZMAN', 'برزمان'),
(1475, 40, 'ALTALL', 'التل'),
(1476, 41, 'ALNABE', 'النبع'),
(1477, 41, 'ALRAWDE', 'الروضة'),
(1478, 41, 'MURTAFAT ALRAWDA', 'مرتفعات الروضة'),
(1479, 41, 'ALAKHDAR', 'الاخضر'),
(1480, 41, 'ALSHARIA', 'الشريعة'),
(1481, 41, 'ALSUWYRYJ', 'الصويريج'),
(1482, 41, 'ALMAEMURA', 'المعمورة'),
(1483, 41, 'ALMAYSIR', 'الميسر'),
(1484, 41, 'SAMD ALJADIDA', 'سمد الجديدة'),
(1485, 41, 'LAZIQ', 'لزق'),
(1486, 42, 'AL MUNTARIB', 'المنترب'),
(1487, 42, 'AL WASIL', 'الواصل'),
(1488, 42, 'AL DAHER', 'الظاهر'),
(1489, 42, 'AL HOWYAH', 'الحوية'),
(1490, 42, 'AL SHARQ', 'الشارق'),
(1491, 42, 'AL YWFI', 'اليوفي'),
(1492, 42, 'AL GHABI', 'الغبي'),
(1493, 42, 'SHOF AL AIN', 'شوف العين'),
(1494, 42, 'AL YAHIS', 'الياحس'),
(1495, 42, 'AL RAKAH', 'الركة'),
(1496, 42, 'SHAHIK', 'شاحك'),
(1497, 42, 'ARISH', 'عريش'),
(1498, 42, 'AL DASSER', 'الداسر'),
(1499, 42, 'AL GHUBRAH', 'الغبرة'),
(1500, 42, 'AL SHAYKH', 'الشيخ'),
(1501, 43, 'AL MUDAYRB', 'المضيرب'),
(1502, 43, 'AL DARAYZ', 'الدريز'),
(1503, 43, 'AL MUATARED', 'المعترض'),
(1504, 43, 'AL QABIL', 'القابل'),
(1505, 43, 'TAWI ADEI', 'طوي عدي'),
(1506, 43, 'MURTINAY', 'مرطيني'),
(1507, 43, 'AL GHALJAY', 'الغالجي'),
(1508, 43, 'AL SARM', 'الصرم'),
(1509, 43, 'MUAIRED', 'معيريض'),
(1510, 43, 'AL SHAWAR', 'الشوار'),
(1511, 43, 'FALAJ MASOUD', 'فلج مسعود'),
(1512, 43, 'AZZ', 'عز'),
(1513, 43, 'AL DAFRAH', 'الظفرة'),
(1514, 43, 'WADI NAAM (BUTAYN)', 'وادي نام بطين'),
(1515, 43, 'MUGHSER', 'مغسر'),
(1516, 43, 'ALDIMA', 'الدمة'),
(1517, 43, 'AL NABA', 'النبأ'),
(1518, 44, 'AL SAFALAH', 'السفالة'),
(1519, 44, 'AL YAHMADI', 'اليحمدي'),
(1520, 44, 'AL THABTI', 'الثابتي'),
(1521, 44, 'AL NASEEB', 'النصيب'),
(1522, 44, 'SIH AL AFIAH', 'سيح العافية'),
(1523, 44, 'AL MUETARID', 'المعترض'),
(1524, 44, 'MASROON', 'مصرون'),
(1525, 44, 'AL SAFEEH', 'الصفيح'),
(1526, 44, 'AL HAYMAH', 'الحايمة'),
(1527, 44, 'AL ALYAH', 'العالية'),
(1528, 44, 'AL KANTARAH', 'القناطر'),
(1529, 44, 'AL KAWALIYAH', 'الخويلية'),
(1530, 44, 'AL SIBAKH', 'السباخ'),
(1531, 44, 'AL MAWAYLIH', 'المويلح'),
(1532, 44, 'AL FALAYJ', 'الفليج'),
(1533, 44, 'AL FALAYJ AL JADIDAH', 'الفليج الجديدة'),
(1534, 44, 'MUQYBERAH', 'مقيبرة'),
(1535, 44, 'AL TENMAH', 'التنمة'),
(1536, 44, 'AL AQABAH', 'العقبة'),
(1537, 44, 'AL QELAH', 'القلة'),
(1538, 44, 'AL SHAEBIA', 'الشعبية'),
(1539, 44, 'AL MUNZAFAH', 'المنزفة'),
(1540, 44, 'AL HAZM', 'الحزم'),
(1541, 44, 'AL JARDAA', 'الجرداء'),
(1542, 44, 'AL ALYAH', 'العلاية'),
(1543, 44, 'AL SHAKABEET', 'الشخابيط'),
(1544, 44, 'AL DAKEEK', 'الدكيك'),
(1545, 44, 'MUGHDER', 'مغيدر'),
(1546, 44, 'AL SHARQIA UNIVERSITY', 'جامعة الشرقية'),
(1547, 44, 'AL NASEEB', 'النصيب'),
(1548, 44, 'SIH AL SHUBAL', 'سيح الشبول'),
(1549, 44, 'AL QUFISY', 'القفيصي'),
(1550, 44, 'AL MARANI', 'المراني'),
(1551, 44, 'SIH AL SHAQABIT', 'سيح الشخابيط'),
(1552, 44, 'ALSAYH ALJADID', 'السيح الجديد'),
(1553, 44, 'MINTAQAT ALNIJADI', 'منطقة النجادي'),
(1554, 45, 'MAHLAH', 'محلاح'),
(1555, 45, 'BAED', 'بعد'),
(1556, 45, 'NAQSI', 'نقصي'),
(1557, 45, 'HINDRUT', 'هندروت'),
(1558, 45, 'MAS', 'مس'),
(1559, 45, 'SIH BIRIQA', 'سيح برقة'),
(1560, 45, 'MUZBIR', 'مزبر'),
(1561, 45, 'BADIEAT AL RUHBIIYN', 'بديعة الرحبيين'),
(1562, 45, 'GHIADA', 'غياضة'),
(1563, 45, 'BADIEAT AL JAWABIR', 'بديعة الجوابر'),
(1564, 45, 'SHAT', 'شات'),
(1565, 45, 'ALZAAHIR', 'الظاهر'),
(1566, 45, 'ALSUBUL', 'السبل'),
(1567, 45, 'ALRASILI', 'الرسيلي'),
(1568, 45, 'ALHAMAM', 'الحمام'),
(1569, 45, 'QUR', 'قر'),
(1570, 45, 'ALEALIA', 'العلية'),
(1571, 45, 'EAQDA', 'عقداء'),
(1572, 45, 'ALGHIAN', 'الغيان'),
(1573, 45, 'ALGHABIRA', 'الغبيرة'),
(1574, 45, 'ALMUDBIGHA', 'المدبغة'),
(1575, 45, 'ALHAJIR', 'الحاجر'),
(1576, 46, 'ALKHURAYS', 'الخريص'),
(1577, 46, 'ALSHUWIEI', 'الشويعي'),
(1578, 46, 'ALWASHL', 'الوشل'),
(1579, 46, 'ALGHABIRA', 'الغبيراء'),
(1580, 46, 'ALGHARIBIN', 'الغريبين'),
(1581, 46, 'ALEALYA', 'العلياء'),
(1582, 46, 'ALHUBAAT', 'الحباط'),
(1583, 46, 'ALFALIJ', 'الفليج'),
(1584, 46, 'SIH ALBADAWR', 'سيح البدور'),
(1585, 46, 'WADI EINDAM', 'وادي عندام'),
(1586, 46, 'ALWASHIH', 'الواشحي'),
(1587, 46, 'ALMISTAH', 'المسطاح'),
(1588, 46, 'SIH ALSARAA', 'سيح السراء'),
(1589, 47, 'FEDA', 'فدى'),
(1590, 47, 'DUT', 'دوت'),
(1591, 47, 'AILAYAT DANK', 'علاية ضنك'),
(1592, 47, 'AL DUWAHIRAYH', 'الظويهرية'),
(1593, 47, 'HAY AL BARAKH', 'حي البركة'),
(1594, 47, 'AL BAREED', 'البريد'),
(1595, 47, 'AL MAADAA', 'المعذاء'),
(1596, 47, 'AL KHABIB', 'الخبيب'),
(1597, 47, 'AL AZIZI', 'العزيزي'),
(1598, 47, 'DANK AL JADIDAH', 'ضنك الجديدة'),
(1599, 47, 'AL AAWAYNAH', 'العوينة'),
(1600, 47, 'ABO KARBAA', 'ابو كربا'),
(1601, 47, 'SAFALAT AL WAHSHAA', 'سفالة الوحشا'),
(1602, 47, 'SAFALAT AL SHOKOOR', 'سفالة الشكور'),
(1603, 47, 'ALEAQABII', 'العقبي'),
(1604, 48, 'AL IRAQI', 'العراقي'),
(1605, 48, 'TANAAM', 'تنعم'),
(1606, 48, 'AL SALAYF', 'السليف'),
(1607, 48, 'AL AINAYN', 'العينين'),
(1608, 48, 'BAAT', 'بات'),
(1609, 48, 'DAHER AL FAWARYS', 'ظاهر الفوارس'),
(1610, 48, 'KAWAAS', 'كاواس'),
(1611, 48, 'HAY AL NAHDAH', 'حي النهضة'),
(1612, 48, 'AL MURTAFEA', 'المرتفع'),
(1613, 48, 'AL DERAYZ', 'الدريز'),
(1614, 48, 'AL AKHUDAR', 'الاخضر'),
(1615, 48, 'AL TAYIB', 'الطيب'),
(1616, 48, 'HARAT AL BALUCH', 'حارة البلوش'),
(1617, 48, 'AL RABYAH', 'الرابية'),
(1618, 48, 'AL DUBAYSHI', 'الدبيشي'),
(1619, 48, 'AL WAHEARAH', 'الوهرة'),
(1620, 48, 'AL JAHILI', 'الجاهلي'),
(1621, 48, 'ASBAYBQ', 'عسبيبق'),
(1622, 48, 'SHABEIAT IBRI', 'شعبية عبري'),
(1623, 48, 'HAY AL MAZRAA', 'حي المزرع'),
(1624, 48, 'AL MAHYOL', 'المحيول'),
(1625, 48, 'AL SHAEBIA', 'الشعبية'),
(1626, 48, 'AL QALAEE', 'القلعي'),
(1627, 48, 'AL AUROBAH', 'العروبة'),
(1628, 48, 'MANTIQAT AL SAFA', 'منطقة الصفا'),
(1629, 48, 'AL SULAMI', 'السلمي'),
(1630, 48, 'HAJAR', 'هجار'),
(1631, 48, 'AL MAZAM', 'المازم'),
(1632, 48, 'HAY AL AQABAH', 'حي العقبة'),
(1633, 48, 'AL BELAYDAH ', 'البليدة'),
(1634, 48, 'HAY AS SAADAH', 'حي السعادة'),
(1635, 48, 'AL SUBAIKHI', 'الصبيخي'),
(1636, 48, 'AL LATHYLAH', 'اللثيلة'),
(1637, 48, 'AL BATIN', 'البطائن'),
(1638, 48, 'AL SAD', 'السد'),
(1639, 48, 'IBRI HEIGHTS', 'مرتفعات عبري'),
(1640, 48, 'ALMIZHAR', 'المظهار'),
(1641, 48, 'ALJABIL', 'الجبيل'),
(1642, 48, 'WADI ALEAYN', 'وادي العين'),
(1643, 48, 'KABARATAN', 'كبارة'),
(1644, 48, 'ALMAEASHI', 'المعاشي'),
(1645, 48, 'EUMALA', 'عملاء'),
(1646, 48, 'EABLA', 'عبلة'),
(1647, 48, 'ALHIJR', 'الهجر'),
(1648, 48, 'ALBANA', 'البانة'),
(1649, 48, 'MAQNIAAT', 'مقنيات'),
(1650, 48, 'ALHUMANIA', 'الحومانية'),
(1651, 48, 'MUSKAN', 'مسكن'),
(1652, 48, 'ALHIAL', 'الحيال'),
(1653, 48, 'AL RAHBA', 'الرحبة'),
(1654, 48, 'KAHANAT', 'كهنات'),
(1655, 48, 'AL NAJID', 'النجيد'),
(1656, 48, 'ALHYAL', 'الهيال'),
(1657, 48, 'HAJAYRIMAT', 'هجيرمات'),
(1658, 48, 'SUID ALMA', 'سويد الماء'),
(1659, 48, 'AL RAWDA', 'الروضة'),
(1660, 48, 'AL JIBIYA', 'الجبية'),
(1661, 48, 'BILAD ALSHUHUM', 'بلاد الشهوم'),
(1662, 48, 'AL MAHYUL', 'المحيول'),
(1663, 48, 'DAMA', 'ضم'),
(1664, 49, 'AL ALU', 'العلو'),
(1665, 49, 'AL RAKI', 'الراكي'),
(1666, 49, 'AL SAWADER', 'الصوادر'),
(1667, 49, 'DAHER AL FAWARYS', 'ظاهر الفوارس'),
(1668, 49, 'AL FALAJ', 'الفلج'),
(1669, 49, 'AL KHABURAH', 'الخابورة'),
(1670, 49, 'AL WAQBAH (MAIDAN STATION)', 'الوقبة'),
(1671, 49, 'SABKHAT SOHAR (MAIDAN STATION)', 'صبخة صحار'),
(1672, 49, 'AL ARID', 'العارض'),
(1673, 49, 'MUJZI (MAHIL AL YAMAN)', 'مجزي'),
(1674, 49, 'FALAJ AL SUDAYRIYIN', 'فلج السديرين'),
(1675, 49, 'AL MADAAM', 'المدام'),
(1676, 49, 'AL SUFRI', 'الصفري'),
(1677, 49, 'KHARSH', 'كرش'),
(1678, 49, 'AL MURIIY ', 'المريي'),
(1679, 49, 'AL SHWAEAH', 'الشوعية'),
(1680, 49, 'AL JAZAYRAT ', 'الجزيرات'),
(1681, 49, 'HAY AL RASHAD', 'حي الرشاد'),
(1682, 49, 'KHADAL', 'خدل'),
(1683, 49, 'AL MANJURIA', 'المنجورية'),
(1684, 49, 'WADI MUEIDAN', 'وادي معيدن'),
(1685, 49, 'HIL ALMANADHIRA', 'حيل المناذرة'),
(1686, 49, 'ZAHIR ALFAWARIS', 'ظاهر الفوارس'),
(1687, 49, 'AL MARAYI', 'المريي'),
(1688, 49, 'AL RAWDA', 'الروضة'),
(1689, 49, 'AL BUYRDA', 'البويردة'),
(1690, 49, 'SAYE', 'صيع'),
(1691, 50, 'AD DUQM', 'الدقم'),
(1692, 51, 'HAYMA', 'هيماء'),
(1693, 52, 'SARAA', 'صعراء'),
(1694, 52, 'AL RABI', 'الرابي'),
(1695, 52, 'HARAT AL QADI', 'حارة القاضي'),
(1696, 52, 'AL KHUDRA', 'الخضراء'),
(1697, 52, 'HAMASH', 'حماسة'),
(1698, 52, 'AL KUDRAH AL JADIDAH', 'الخضراء الجديدة'),
(1699, 52, 'SARAA AL JADIDAH', 'صعراء الجديدة'),
(1700, 52, 'ARID JAW', 'ارض الجو'),
(1701, 52, 'WADI AL JEZI', 'وادي الجزي'),
(1702, 52, 'AL SHARAYAH', 'الشريعة'),
(1703, 52, 'AL HALAH', 'الحلة'),
(1704, 52, 'AL SHANGHAH', 'الشندغة'),
(1705, 52, 'KUDRAH AL SIH', 'خضراء السيح'),
(1706, 52, 'AL AQDAH', 'العقدة'),
(1707, 52, 'AL GHURIFFAH', 'الغريفة'),
(1708, 52, 'HARAT ABDULAZIZ', 'حارة عبدالعزيز'),
(1709, 52, 'AL QURAMTAH', 'القرامطة'),
(1710, 52, 'HARAT AL SELM', 'حارة السلم'),
(1711, 52, 'AL NAFFHAT', 'النفحات'),
(1712, 52, 'MURABA AZAN', 'مربع عزان'),
(1713, 52, 'OLD SOWQ', 'السوق القديم'),
(1714, 52, 'AL BURAYMI UNIVERSITY', 'جامعة البريمي'),
(1715, 52, 'BARHOUZ', 'بارهوز'),
(1716, 53, 'MAHADAH', 'محضة'),
(1717, 54, 'AS SUNAYNAH', 'السنينة');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_set`
--

CREATE TABLE `attribute_set` (
  `sno` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attribute_set`
--

INSERT INTO `attribute_set` (`sno`, `name`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Laptop', 1, '2023-06-29 10:28:08', '2023-06-29 04:58:08', '1'),
(2, 'Women Fashion', 1, '2023-07-05 11:12:20', '2023-07-05 05:42:20', '1'),
(3, 'Men Fashion', 1, '2023-07-05 11:20:28', '2023-07-05 05:50:28', '1'),
(4, 'Lamp', 1, '2023-07-05 01:54:28', '2023-07-05 08:24:28', '1'),
(6, 'Computer', 1, '2023-10-08 05:37:36', '2023-10-08 12:07:36', '1'),
(7, 'Camera', 1, '2023-11-22 10:23:55', '2023-11-22 04:53:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_set_product_info`
--

CREATE TABLE `attribute_set_product_info` (
  `id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `product_info_set_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attribute_set_product_info`
--

INSERT INTO `attribute_set_product_info` (`id`, `attribute_set_id`, `product_info_set_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2023-06-29 05:04:14', '2023-06-29 05:04:14'),
(3, 1, 2, '2023-06-29 05:04:14', '2023-06-29 05:04:14'),
(4, 2, 1, '2023-07-05 05:42:20', '2023-07-05 05:42:20'),
(5, 2, 3, '2023-07-05 05:48:17', '2023-07-05 05:48:17'),
(7, 4, 1, '2023-07-05 08:24:28', '2023-07-05 08:24:28'),
(8, 3, 1, '2023-07-22 13:35:48', '2023-07-22 13:35:48'),
(9, 3, 3, '2023-07-22 13:35:48', '2023-07-22 13:35:48'),
(10, 1, 4, '2023-08-01 09:21:33', '2023-08-01 09:21:33'),
(14, 6, 1, '2023-10-08 12:07:36', '2023-10-08 12:07:36'),
(15, 6, 2, '2023-10-08 12:07:36', '2023-10-08 12:07:36'),
(16, 6, 5, '2023-10-08 12:07:36', '2023-10-08 12:07:36'),
(17, 7, 1, '2023-11-22 04:53:55', '2023-11-22 04:53:55'),
(18, 7, 5, '2023-11-22 04:53:55', '2023-11-22 04:53:55'),
(19, 7, 7, '2023-11-22 04:53:55', '2023-11-22 04:53:55'),
(20, 7, 8, '2023-11-22 04:53:55', '2023-11-22 04:53:55'),
(21, 7, 9, '2023-11-22 04:53:55', '2023-11-22 04:53:55'),
(22, 7, 10, '2023-11-22 04:53:55', '2023-11-22 04:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `account_holder_name`, `account_number`, `bank_name`, `bank_address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Mohamad soufan ', 'bStvdjRrQjEyazlJeEVDRFNNZkFkQT09', 'Bank muscat', 'Al mawalih', 'UWdvRe8buNT', '2023-09-01 07:51:44', '2023-09-01 07:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `img_url` text NOT NULL,
  `banner_id` varchar(200) NOT NULL,
  `banner_order` int(11) NOT NULL,
  `clicktype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_name_ar` varchar(100) NOT NULL,
  `brand_img` text NOT NULL,
  `brand_site_url` varchar(255) DEFAULT NULL,
  `popular_brand` tinyint(1) NOT NULL,
  `brand_order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_name_ar`, `brand_img`, `brand_site_url`, `popular_brand`, `brand_order`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Nike', 'Nike', '{\"72-72\":\"2023-07-26\\/64c104309d3b4.webp\",\"200-200\":\"2023-07-26\\/64c104309d3b4.webp\",\"280-310\":\"2023-07-26\\/64c104309d3b4.webp\",\"400-200\":\"2023-07-26\\/64c104309d3b4.webp\",\"430-590\":\"2023-07-26\\/64c104309d3b4.webp\",\"600-810\":\"2023-07-26\\/64c104309d3b4.webp\"}', '', 0, 0, 1, '2023-07-26 11:31:12', '2023-07-26 11:31:12', ''),
(2, 'Trendyol', 'ترنديول', '{\"72-72\":\"2023-07-07\\/64a7266ca3b7a.webp\",\"200-200\":\"2023-07-07\\/64a7266ca3b7a.webp\",\"280-310\":\"2023-07-07\\/64a7266ca3b7a.webp\",\"400-200\":\"2023-07-07\\/64a7266ca3b7a.webp\",\"430-590\":\"2023-07-07\\/64a7266ca3b7a.webp\",\"600-810\":\"2023-07-07\\/64a7266ca3b7a.webp\"}', 'https://www.trendyol.com', 0, 0, 1, '2023-06-29 10:59:01', '2023-06-29 05:29:01', '1'),
(3, 'Samsung', 'سامسونج', '{\"72-72\":\"2023-07-04\\/64a3fbf822c51.webp\",\"200-200\":\"2023-07-04\\/64a3fbf822c51.webp\",\"280-310\":\"2023-07-04\\/64a3fbf822c51.webp\",\"400-200\":\"2023-07-04\\/64a3fbf822c51.webp\",\"430-590\":\"2023-07-04\\/64a3fbf822c51.webp\",\"600-810\":\"2023-07-04\\/64a3fbf822c51.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:31:12', '2023-07-04 11:01:12', '1'),
(4, 'ONIDA', 'أونيدا', '{\"72-72\":\"2023-07-04\\/64a3fc1063cb4.webp\",\"200-200\":\"2023-07-04\\/64a3fc1063cb4.webp\",\"280-310\":\"2023-07-04\\/64a3fc1063cb4.webp\",\"400-200\":\"2023-07-04\\/64a3fc1063cb4.webp\",\"430-590\":\"2023-07-04\\/64a3fc1063cb4.webp\",\"600-810\":\"2023-07-04\\/64a3fc1063cb4.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:31:36', '2023-07-04 11:01:36', '1'),
(5, 'Monginis', 'مونجيني', '{\"72-72\":\"2023-07-04\\/64a3fc6839011.webp\",\"200-200\":\"2023-07-04\\/64a3fc6839011.webp\",\"280-310\":\"2023-07-04\\/64a3fc6839011.webp\",\"400-200\":\"2023-07-04\\/64a3fc6839011.webp\",\"430-590\":\"2023-07-04\\/64a3fc6839011.webp\",\"600-810\":\"2023-07-04\\/64a3fc6839011.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:33:04', '2023-07-04 11:03:04', '1'),
(6, 'Car Red', 'سيارة حمراء', '{\"72-72\":\"2023-07-04\\/64a3fc79dae8f.webp\",\"200-200\":\"2023-07-04\\/64a3fc79dae8f.webp\",\"280-310\":\"2023-07-04\\/64a3fc79dae8f.webp\",\"400-200\":\"2023-07-04\\/64a3fc79dae8f.webp\",\"430-590\":\"2023-07-04\\/64a3fc79dae8f.webp\",\"600-810\":\"2023-07-04\\/64a3fc79dae8f.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:33:21', '2023-07-04 11:03:21', '1'),
(7, 'Castrol', 'كاسترول', '{\"72-72\":\"2023-07-04\\/64a3fc885c709.webp\",\"200-200\":\"2023-07-04\\/64a3fc885c709.webp\",\"280-310\":\"2023-07-04\\/64a3fc885c709.webp\",\"400-200\":\"2023-07-04\\/64a3fc885c709.webp\",\"430-590\":\"2023-07-04\\/64a3fc885c709.webp\",\"600-810\":\"2023-07-04\\/64a3fc885c709.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:33:36', '2023-07-04 11:03:36', '1'),
(8, 'Britaniya', 'بريتانيا', '{\"72-72\":\"2023-07-04\\/64a3fc9b5cb73.webp\",\"200-200\":\"2023-07-04\\/64a3fc9b5cb73.webp\",\"280-310\":\"2023-07-04\\/64a3fc9b5cb73.webp\",\"400-200\":\"2023-07-04\\/64a3fc9b5cb73.webp\",\"430-590\":\"2023-07-04\\/64a3fc9b5cb73.webp\",\"600-810\":\"2023-07-04\\/64a3fc9b5cb73.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:33:55', '2023-07-04 11:03:55', '1'),
(9, 'boAt', 'قارب', '{\"72-72\":\"2023-07-04\\/64a3fcadb600d.webp\",\"200-200\":\"2023-07-04\\/64a3fcadb600d.webp\",\"280-310\":\"2023-07-04\\/64a3fcadb600d.webp\",\"400-200\":\"2023-07-04\\/64a3fcadb600d.webp\",\"430-590\":\"2023-07-04\\/64a3fcadb600d.webp\",\"600-810\":\"2023-07-04\\/64a3fcadb600d.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:34:13', '2023-07-04 11:04:13', '1'),
(10, 'Ramco', 'رامكو', '{\"72-72\":\"2023-07-04\\/64a3fcc3dea2b.webp\",\"200-200\":\"2023-07-04\\/64a3fcc3dea2b.webp\",\"280-310\":\"2023-07-04\\/64a3fcc3dea2b.webp\",\"400-200\":\"2023-07-04\\/64a3fcc3dea2b.webp\",\"430-590\":\"2023-07-04\\/64a3fcc3dea2b.webp\",\"600-810\":\"2023-07-04\\/64a3fcc3dea2b.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:34:35', '2023-07-04 11:04:35', '1'),
(11, 'CERA', 'سيرا', '{\"72-72\":\"2023-07-04\\/64a3fcd62d4c5.webp\",\"200-200\":\"2023-07-04\\/64a3fcd62d4c5.webp\",\"280-310\":\"2023-07-04\\/64a3fcd62d4c5.webp\",\"400-200\":\"2023-07-04\\/64a3fcd62d4c5.webp\",\"430-590\":\"2023-07-04\\/64a3fcd62d4c5.webp\",\"600-810\":\"2023-07-04\\/64a3fcd62d4c5.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:34:54', '2023-07-04 11:04:54', '1'),
(12, 'LG', 'ال جي', '{\"72-72\":\"2023-07-04\\/64a3fced6215f.webp\",\"200-200\":\"2023-07-04\\/64a3fced6215f.webp\",\"280-310\":\"2023-07-04\\/64a3fced6215f.webp\",\"400-200\":\"2023-07-04\\/64a3fced6215f.webp\",\"430-590\":\"2023-07-04\\/64a3fced6215f.webp\",\"600-810\":\"2023-07-04\\/64a3fced6215f.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:35:17', '2023-07-04 11:05:17', '1'),
(13, 'MARUTI SUZUKI', 'ماروتي سوزوكي', '{\"72-72\":\"2023-07-04\\/64a3fd024a645.webp\",\"200-200\":\"2023-07-04\\/64a3fd024a645.webp\",\"280-310\":\"2023-07-04\\/64a3fd024a645.webp\",\"400-200\":\"2023-07-04\\/64a3fd024a645.webp\",\"430-590\":\"2023-07-04\\/64a3fd024a645.webp\",\"600-810\":\"2023-07-04\\/64a3fd024a645.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:35:38', '2023-07-04 11:05:38', '1'),
(14, 'Lenskart', 'لينسكارت', '{\"72-72\":\"2023-07-04\\/64a3fd116c449.webp\",\"200-200\":\"2023-07-04\\/64a3fd116c449.webp\",\"280-310\":\"2023-07-04\\/64a3fd116c449.webp\",\"400-200\":\"2023-07-04\\/64a3fd116c449.webp\",\"430-590\":\"2023-07-04\\/64a3fd116c449.webp\",\"600-810\":\"2023-07-04\\/64a3fd116c449.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:35:53', '2023-07-04 11:05:53', '1'),
(15, 'Hero Lectro', 'البطل يكترو', '{\"72-72\":\"2023-07-04\\/64a3fd3ad229d.webp\",\"200-200\":\"2023-07-04\\/64a3fd3ad229d.webp\",\"280-310\":\"2023-07-04\\/64a3fd3ad229d.webp\",\"400-200\":\"2023-07-04\\/64a3fd3ad229d.webp\",\"430-590\":\"2023-07-04\\/64a3fd3ad229d.webp\",\"600-810\":\"2023-07-04\\/64a3fd3ad229d.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:36:34', '2023-07-04 11:06:34', '1'),
(16, 'Balajis', 'بلاجي', '{\"72-72\":\"2023-07-04\\/64a3fd55b4cfa.webp\",\"200-200\":\"2023-07-04\\/64a3fd55b4cfa.webp\",\"280-310\":\"2023-07-04\\/64a3fd55b4cfa.webp\",\"400-200\":\"2023-07-04\\/64a3fd55b4cfa.webp\",\"430-590\":\"2023-07-04\\/64a3fd55b4cfa.webp\",\"600-810\":\"2023-07-04\\/64a3fd55b4cfa.webp\"}', 'https://www.balajiwafers.com/products/', 0, 0, 1, '2023-07-04 04:37:01', '2023-07-04 11:07:01', '1'),
(17, 'Ultratech', 'الترا تك', '{\"72-72\":\"2023-07-04\\/64a3fd8252e18.webp\",\"200-200\":\"2023-07-04\\/64a3fd8252e18.webp\",\"280-310\":\"2023-07-04\\/64a3fd8252e18.webp\",\"400-200\":\"2023-07-04\\/64a3fd8252e18.webp\",\"430-590\":\"2023-07-04\\/64a3fd8252e18.webp\",\"600-810\":\"2023-07-04\\/64a3fd8252e18.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:37:46', '2023-07-04 11:07:46', '1'),
(18, 'Ford', 'معقل', '{\"72-72\":\"2023-07-04\\/64a3fd96ab15b.webp\",\"200-200\":\"2023-07-04\\/64a3fd96ab15b.webp\",\"280-310\":\"2023-07-04\\/64a3fd96ab15b.webp\",\"400-200\":\"2023-07-04\\/64a3fd96ab15b.webp\",\"430-590\":\"2023-07-04\\/64a3fd96ab15b.webp\",\"600-810\":\"2023-07-04\\/64a3fd96ab15b.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:38:06', '2023-07-04 11:08:06', '1'),
(19, 'Godrej', 'جودريج', '{\"72-72\":\"2023-07-04\\/64a3fdafd41c0.webp\",\"200-200\":\"2023-07-04\\/64a3fdafd41c0.webp\",\"280-310\":\"2023-07-04\\/64a3fdafd41c0.webp\",\"400-200\":\"2023-07-04\\/64a3fdafd41c0.webp\",\"430-590\":\"2023-07-04\\/64a3fdafd41c0.webp\",\"600-810\":\"2023-07-04\\/64a3fdafd41c0.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:38:31', '2023-07-04 11:08:31', '1'),
(20, 'Maggi', 'ماجي', '{\"72-72\":\"2023-07-04\\/64a3fdfebe2de.webp\",\"200-200\":\"2023-07-04\\/64a3fdfebe2de.webp\",\"280-310\":\"2023-07-04\\/64a3fdfebe2de.webp\",\"400-200\":\"2023-07-04\\/64a3fdfebe2de.webp\",\"430-590\":\"2023-07-04\\/64a3fdfebe2de.webp\",\"600-810\":\"2023-07-04\\/64a3fdfebe2de.webp\"}', 'https://www.adidas.co.in/', 0, 0, 1, '2023-07-04 04:39:50', '2023-07-04 11:09:50', '1'),
(21, 'Shoping from noon uae', 'تسوق من موقع نون الامارات', '{\"72-72\":\"2023-07-21\\/64ba4346b3b63.webp\",\"200-200\":\"2023-07-21\\/64ba4346b3b63.webp\",\"280-310\":\"2023-07-21\\/64ba4346b3b63.webp\",\"400-200\":\"2023-07-21\\/64ba4346b3b63.webp\",\"430-590\":\"2023-07-21\\/64ba4346b3b63.webp\",\"600-810\":\"2023-07-21\\/64ba4346b3b63.webp\"}', 'https://www.noon.com/uae-ar/', 0, 0, 1, '2023-07-21 02:05:18', '2023-07-21 08:35:18', '1'),
(26, 'Sony', '', '{\"72-72\":\"2023-12-13\\/6579746d80988.webp\",\"200-200\":\"2023-12-13\\/6579746d80988.webp\",\"280-310\":\"2023-12-13\\/6579746d80988.webp\",\"400-200\":\"2023-12-13\\/6579746d80988.webp\",\"430-590\":\"2023-12-13\\/6579746d80988.webp\",\"600-810\":\"2023-12-13\\/6579746d80988.webp\"}', '', 0, 0, 1, '2023-12-13 02:37:57', '2023-12-13 09:07:57', '1'),
(27, 'test', 'test', '{\"72-72\":\"2023-12-13\\/65797fb2d4780.webp\",\"200-200\":\"2023-12-13\\/65797fb2d4780.webp\",\"280-310\":\"2023-12-13\\/65797fb2d4780.webp\",\"400-200\":\"2023-12-13\\/65797fb2d4780.webp\",\"430-590\":\"2023-12-13\\/65797fb2d4780.webp\",\"600-810\":\"2023-12-13\\/65797fb2d4780.webp\"}', NULL, 0, 0, 0, '2023-12-13 03:26:02', '2023-12-13 09:56:02', 'SVR6og303Vm');

-- --------------------------------------------------------

--
-- Table structure for table `buy_from_another_country_requests`
--

CREATE TABLE `buy_from_another_country_requests` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `product_quantity` int(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_des` text NOT NULL,
  `product_img_1` varchar(255) NOT NULL,
  `product_img_2` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `status` enum('requested','processed','rejected','ordered','cancelled') NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buy_from_another_country_requests`
--

INSERT INTO `buy_from_another_country_requests` (`id`, `order_id`, `user_id`, `product_link`, `product_quantity`, `product_size`, `product_color`, `product_des`, `product_img_1`, `product_img_2`, `country`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, NULL, 'UPfM6WcVs3n', 'https://www.adidas.co.in/ultra-4d-shoes/GY5913.html', 1, 'xx', 'rede', 'i need red color tshirt M size', '2023-07-10/64ab90d14a61a.webp', '2023-07-10/64ab90d155485.webp', 'Turkey', 'requested', NULL, '2023-07-10 05:02:09', '2023-07-10 05:02:09'),
(2, NULL, 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 1, '6', 'B', 'Tff', '2023-07-14/64b1946b93b86.webp', '2023-07-14/64b1946b970cc.webp', 'Turkey', 'requested', NULL, '2023-07-14 18:31:07', '2023-07-14 18:31:07'),
(3, NULL, 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 1, '34', 'Black', 'Hkk', '2023-07-17/64b4c876aebc5.webp', '2023-07-17/64b4c876b4cc2.webp', 'Turkey', 'rejected', NULL, '2023-07-17 04:49:58', '2023-07-17 04:49:58'),
(4, 'ODRXYZBIE071394', 'UPfM6WcVs3n', 'https://www.nike.com/in/w/womens-air-force-1-shoes-5e1x6z5sj3yzy7ok', 1, 'large', 'black', 'good', '2023-07-22/64bbbec6be3a5.webp', '2023-07-22/64bbbec6bf11f.webp', 'Turkey', 'processed', NULL, '2023-07-22 11:34:30', '2023-07-22 11:34:30'),
(5, 'ODRQBZ0GV051685', 'UPfM6WcVs3n', 'https://www.nike.com/in/t/jordan-stay-loyal-2-shoes-sDkgDk/DQ8401-006', 1, '7', 'blue', 'some detailfh jg jgjgj', '2023-07-22/64bbc0e139f32.webp', '2023-07-22/64bbc0e1442da.webp', 'Turkey', 'ordered', NULL, '2023-07-22 11:43:29', '2023-07-22 15:48:52'),
(6, NULL, 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 12, '12', '12', '12', '2023-07-23/64bcfc09680e5.webp', '2023-07-23/64bcfc096a9b0.webp', 'Turkey', 'requested', NULL, '2023-07-23 10:08:09', '2023-07-23 10:08:09'),
(7, 'ODRDIBQW4010448', 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 12, 'M', 'RED', 'RED', '2023-07-24/64be3ea70be4b.webp', '2023-07-24/64be3ea70e12a.webp', 'Turkey', 'requested', NULL, '2023-07-24 09:04:39', '2023-07-24 09:04:39'),
(8, 'ODRKDIGR6010522', 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 12, '12', '12', '`2', '2023-07-24/64be3ec261715.webp', '2023-07-24/64be3ec262aa2.webp', 'Turkey', 'ordered', NULL, '2023-07-24 09:05:06', '2023-08-03 17:38:05'),
(9, 'ODR5D8LPX010580', 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 787, '78', '78', '78', '2023-07-24/64be3eef50c75.webp', '2023-07-24/64be3eef51550.webp', 'Turkey', 'requested', NULL, '2023-07-24 09:05:51', '2023-07-24 09:05:51'),
(10, 'ODRCKLPDF030920', 'UPfM6WcVs3n', 'https://www.adidas.co.in/own-the-run-woven-astro-pants/HR6611.html', 3, 'm', 'blue', 'need 3 item with same color blue', '2023-07-24/64be4563711ce.webp', '2023-07-24/64be456374849.webp', 'Turkey', 'processed', NULL, '2023-07-24 09:33:23', '2023-07-24 09:33:23'),
(11, 'ODRCI1AGZ015664', 'UPfM6WcVs3n', 'https://www.ebuy.om/login', 121, 'SIZE', '13', '11', '2023-07-24/64be4ad8bc713.webp', '2023-07-24/64be4ad8be00b.webp', 'Turkey', 'requested', NULL, '2023-07-24 09:56:40', '2023-07-24 09:56:40'),
(12, 'ODRXLUQDK020722', 'UPfM6WcVs3n', 'https://www.ebuy.om/login', 10, '10', '10', '10', '2023-07-24/64be4d613b2a4.webp', '2023-07-24/64be4d613bad7.webp', 'Turkey', 'processed', NULL, '2023-07-24 10:07:29', '2023-07-24 10:07:29'),
(13, NULL, 'UPfM6WcVs3n', 'https://www.ebuy.om/login', 89, '8', '9', '8989', '2023-07-24/64be4db34bb0e.webp', '2023-07-24/64be4db34d7f3.webp', 'Turkey', 'requested', NULL, '2023-07-24 10:08:51', '2023-07-24 10:08:51'),
(14, 'ODRYI1ZGS105925', 'UPfM6WcVs3n', 'https://www.ebuy.om/cream-coloured-and-red-floral-silk-blend-saree?pid=Pm9tEaeuYr3&sku=Cream-Coloured-and-Red-Floral-Silk-Blend-Saree&sid=SVR6og303Vm', 5, 'Large', 'Red', 'Good fabric', '2023-08-01/64c8ad684eee9.webp', '2023-08-01/64c8ad685087c.webp', 'Turkey', 'processed', NULL, '2023-08-01 06:59:52', '2023-08-01 06:59:52'),
(15, 'ODRCFDK2Z110382', 'UPfM6WcVs3n', 'https://www.ebuy.om/cream-coloured-and-red-floral-silk-blend-saree?pid=Pm9tEaeuYr3&sku=Cream-Coloured-and-Red-Floral-Silk-Blend-Saree&sid=SVR6og303Vm', 6, 'Large', 'Red', 'Good Fabric', '2023-08-01/64c8ae3e85b19.webp', '2023-08-01/64c8ae3e87006.webp', 'Turkey', 'rejected', NULL, '2023-08-01 07:03:26', '2023-08-01 07:03:26'),
(16, 'ODRM32TYG022731', 'UPfM6WcVs3n', 'https://assets.myntassets.com/h_720,q_90,w_540/v1/assets/images/24155188/2023/7/24/70188541-4edd-4a14-895d-cb48fcb9df221690174926883TokyoTalkiesPinkTop6.jpg', 10, 'Large', 'Pink', 'Good', '2023-08-01/64c8de17f1a54.webp', '2023-08-01/64c8de1804364.webp', 'Turkey', 'requested', NULL, '2023-08-01 10:27:36', '2023-08-01 10:27:36'),
(17, 'ODRBUIFDZ023397', 'UPfM6WcVs3n', 'https://assets.myntassets.com/h_720,q_90,w_540/v1/assets/images/24155188/2023/7/24/70188541-4edd-4a14-895d-cb48fcb9df221690174926883TokyoTalkiesPinkTop6.jpg', 56, 'Large', 'Pink, Red', 'Good', '2023-08-01/64c8df76e3edc.webp', '2023-08-01/64c8df76e8f5b.webp', 'Turkey', 'ordered', NULL, '2023-08-01 10:33:26', '2023-08-03 17:42:32'),
(18, 'ODRLZDUHJ032852', 'UPfM6WcVs3n', 'https://www.ebuy.om/login', 12, '12', '12', '12', '2023-08-01/64c8ec6c615bf.webp', '2023-08-01/64c8ec6c63882.webp', 'Turkey', 'requested', NULL, '2023-08-01 11:28:44', '2023-08-01 11:28:44'),
(19, 'ODRYD86Y2033826', 'UPfM6WcVs3n', 'https://www.ebuy.om/login', 89, '89', '89', '89', '2023-08-01/64c8eecbdb6b1.webp', '2023-08-01/64c8eecbdc144.webp', 'Turkey', 'requested', NULL, '2023-08-01 11:38:51', '2023-08-01 11:38:51'),
(20, 'ODRHAEC8B022386', 'UPfM6WcVs3n', 'http://localhost/ebuy/', 10, '10', '10', '10', '2023-08-03/64cb80154bcb0.webp', '2023-08-03/64cb80154dd5c.webp', 'Turkey', 'processed', NULL, '2023-08-03 10:23:17', '2023-08-03 10:23:17'),
(21, 'ODRWZCVBA121094', 'UPfM6WcVs3n', 'http://localhost/ebuy/', 10, '10', '10', '10', '2023-08-04/64ccb2791a883.webp', '2023-08-04/64ccb2791dab1.webp', 'Turkey', 'requested', NULL, '2023-08-04 08:10:33', '2023-08-04 08:10:33'),
(22, 'ODR1QXUTH033571', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-04/64cce272ed0ff.webp', '2023-08-04/64cce272ef001.webp', 'Turkey', 'requested', NULL, '2023-08-04 11:35:14', '2023-08-04 11:35:14'),
(23, 'ODRRPC5JF033576', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-04/64cce2858c4e9.webp', '2023-08-04/64cce2858dc0c.webp', 'Turkey', 'requested', NULL, '2023-08-04 11:35:33', '2023-08-04 11:35:33'),
(24, 'ODRDKQY2L033698', 'UPfM6WcVs3n', 'http://localhost/ebuy/', 10, '10', '10', '10', '2023-08-04/64cce2ca4c26d.webp', '2023-08-04/64cce2ca4db81.webp', 'Turkey', 'requested', NULL, '2023-08-04 11:36:42', '2023-08-04 11:36:42'),
(25, 'ODRXDITMN040487', 'UPfM6WcVs3n', 'http://localhost/ebuy/', 10, '10', '10', '10', '2023-08-04/64cce9576e7aa.webp', '2023-08-04/64cce95770596.webp', 'Turkey', 'requested', NULL, '2023-08-04 12:04:39', '2023-08-04 12:04:39'),
(26, 'ODRF1KNRH04307', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-04/64ccef56711f4.webp', '2023-08-04/64ccef56737b0.webp', 'Turkey', 'requested', NULL, '2023-08-04 12:30:14', '2023-08-04 12:30:14'),
(27, 'ODRHYGTRN043516', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-04/64ccf08a98e6d.webp', '2023-08-04/64ccf08a9a923.webp', 'Turkey', 'requested', NULL, '2023-08-04 12:35:22', '2023-08-04 12:35:22'),
(28, 'ODRVPJBAG051019', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-04/64ccf8cb46229.webp', '2023-08-04/64ccf8cb47bf1.webp', 'Turkey', 'requested', NULL, '2023-08-04 13:10:35', '2023-08-04 13:10:35'),
(29, 'ODR8ZVGBW05149', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-04/64ccf9bd40c61.webp', '2023-08-04/64ccf9bd42292.webp', 'Turkey', 'requested', NULL, '2023-08-04 13:14:37', '2023-08-04 13:14:37'),
(30, 'ODR7TKN1X09131', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-05/64cdda5da40c4.webp', '2023-08-05/64cdda5da68ef.webp', 'Turkey', 'requested', NULL, '2023-08-05 05:13:01', '2023-08-05 05:13:01'),
(31, 'ODRW2J4X7100441', 'UPfM6WcVs3n', '', 10, '10', '10', '10', '2023-08-05/64cde65d6a7b2.webp', '2023-08-05/64cde65d6c226.webp', 'Turkey', 'requested', NULL, '2023-08-05 06:04:13', '2023-08-05 06:04:13'),
(32, 'ODRAPLWSB103610', 'UPfM6WcVs3n', 'https', 10, 'size', 'red', 'hello', '2023-08-05/64cdedd6f2e7d.webp', '2023-08-05/64cdedd70061b.webp', 'Turkey', 'requested', NULL, '2023-08-05 06:36:07', '2023-08-05 06:36:07'),
(33, 'ODRJ9NIZG035281', 'UPfM6WcVs3n', 'https://www.adidas.co.in/vs-pace-2.0-shoes/HP6007.html', 1, 'Large', 'White', 'Good', '2023-08-12/64d7728602a81.webp', '2023-08-12/64d7728609cb9.webp', 'Turkey', 'rejected', NULL, '2023-08-12 11:52:38', '2023-08-12 11:52:38'),
(34, 'ODRZJRQNP09246', 'UPfM6WcVs3n', 'https://www.ebuy.om/buy-from-turkey', 5, 'Red', 'Large', 'Long', '2023-08-17/64ddaf2046483.webp', '2023-08-17/64ddaf20485be.webp', 'Turkey', 'requested', NULL, '2023-08-17 05:24:48', '2023-08-17 05:24:48'),
(35, 'ODRFICUWX102754', 'UPfM6WcVs3n', 'https://www.bussinesshub.com/', 2, 'Large', 'Red', 'Good', '2023-08-17/64ddbdb8ce574.webp', '2023-08-17/64ddbdb8df1f2.webp', 'Turkey', 'requested', NULL, '2023-08-17 06:27:04', '2023-08-17 06:27:04'),
(36, 'ODR8LZXFT120975', 'U4IfM5e8TbY', 'https://www.ebuy.om/login', 1, '6', '6', '6', '2023-08-18/64de7e6e2d0f0.webp', '2023-08-18/64de7e6e2fd73.webp', 'Turkey', 'requested', NULL, '2023-08-17 20:09:18', '2023-08-17 20:09:18'),
(37, 'ODRB8QKZR121390', 'U4IfM5e8TbY', 'https://www.ebuy.om/login', 8, 'M', 'RED', 'I want RED', '2023-08-18/64de7f645cef3.webp', '2023-08-18/64de7f645d8ae.webp', 'Turkey', 'requested', NULL, '2023-08-17 20:13:24', '2023-08-17 20:13:24'),
(38, 'ODRUPQWQR121416', 'U4IfM5e8TbY', 'https://www.ebuy.om/login', 7, 'M', 'RED', 'I want RED', '2023-08-18/64de7f899ee9a.webp', '2023-08-18/64de7f899f9c0.webp', 'Turkey', 'requested', NULL, '2023-08-17 20:14:01', '2023-08-17 20:14:01'),
(39, 'ODRSKLP4R121564', 'U4IfM5e8TbY', 'https://www.ebuy.om/login', 9, 'M', 'RED', 'I want RED', '2023-08-18/64de7fc896ef9.webp', '2023-08-18/64de7fc897851.webp', 'Turkey', 'requested', NULL, '2023-08-17 20:15:04', '2023-08-17 20:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `cartdetails`
--

CREATE TABLE `cartdetails` (
  `id` int(11) NOT NULL,
  `prod_id` varchar(200) NOT NULL,
  `attr_sku` varchar(500) NOT NULL,
  `vendor_id` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `refer_id` varchar(200) NOT NULL,
  `affiliated_by` varchar(255) DEFAULT NULL,
  `qoute_id` bigint(20) NOT NULL,
  `rent_price` varchar(50) NOT NULL,
  `rent_from_date` datetime DEFAULT NULL,
  `rent_to_date` datetime DEFAULT NULL,
  `cart_type` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cartdetails`
--

INSERT INTO `cartdetails` (`id`, `prod_id`, `attr_sku`, `vendor_id`, `user_id`, `qty`, `refer_id`, `affiliated_by`, `qoute_id`, `rent_price`, `rent_from_date`, `rent_to_date`, `cart_type`, `created_at`) VALUES
(21, 'PyfvpXVKR2t', 'Realistic-Artificial-Silk', 'SVR6og303Vm', 'UJxdjAhqKTa', 1, '0', NULL, 412052483, '', NULL, NULL, '', '2023-12-19 07:07:51'),
(33, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'UkFJLO0ZU52', 1, '', '', 912053278, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2023-12-09 12:02:27'),
(34, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'UJxdjAhqKTa', 1, '0', NULL, 1112063359, '', NULL, NULL, '', '2023-12-11 13:03:09'),
(35, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'U1W3ufw5Fah', 1, '0', '', 1512102827, '125', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rent', '2023-12-15 04:58:21'),
(38, 'PvaNrJZT89y', 'Samsung-BA122', 'SVR6og303Vm', 'U6Hd4kUeJSR', 1, '', '', 1312124717, '1450.00', '2023-12-26 00:00:00', '2023-12-28 00:00:00', 'Rent', '2023-12-13 09:26:30'),
(43, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'UV0cpGzEodR', 1, '', '', 2212112311, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2023-12-22 07:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(80) NOT NULL,
  `cat_name_ar` varchar(100) NOT NULL,
  `sub_title` varchar(500) NOT NULL,
  `sub_title_ar` varchar(150) NOT NULL,
  `cat_slug` varchar(200) NOT NULL,
  `cat_img` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `cat_order` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `commission_fees` decimal(20,2) DEFAULT NULL,
  `web_banner` text NOT NULL,
  `app_banner` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_name_ar`, `sub_title`, `sub_title_ar`, `cat_slug`, `cat_img`, `parent_id`, `cat_order`, `status`, `commission_fees`, `web_banner`, `app_banner`, `created_at`, `updated_at`, `created_by`) VALUES
(7, 'ELECTRONICS', 'الكترونيات', 'ELECTRONICS', 'الكترونيات', 'electronics', '{\"72-72\":\"2023-11-02\\/65432fba1e96b.webp\",\"200-200\":\"2023-11-02\\/65432fba1e96b.webp\",\"280-310\":\"2023-11-02\\/65432fba1e96b.webp\",\"400-200\":\"2023-11-02\\/65432fba1e96b.webp\",\"430-590\":\"2023-11-02\\/65432fba1e96b.webp\",\"600-810\":\"2023-11-02\\/65432fba1e96b.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bc1eee203.webp\",\"200-200\":\"2023-07-04\\/64a3bc1eee203.webp\",\"280-310\":\"2023-07-04\\/64a3bc1eee203.webp\",\"400-200\":\"2023-07-04\\/64a3bc1eee203.webp\",\"430-590\":\"2023-07-04\\/64a3bc1eee203.webp\",\"600-810\":\"2023-07-04\\/64a3bc1eee203.webp\"}', '{\"72-72\":\"2023-11-02/65432ff14d94a.webp\",\"200-200\":\"2023-11-02/65432ff14d94a.webp\",\"280-310\":\"2023-11-02/65432ff14d94a.webp\",\"400-200\":\"2023-11-02/65432ff14d94a.webp\",\"430-590\":\"2023-11-02/65432ff14d94a.webp\",\"600-810\":\"2023-11-02/65432ff14d94a.webp\"}', '2023-07-04 11:58:46', '2023-07-04 06:28:47', '1'),
(8, 'MEN', 'أزياء الرجال', 'MEN', 'أزياء الرجال', 'men', '{\"72-72\":\"2023-07-04\\/64a3bc94390d0.webp\",\"200-200\":\"2023-07-04\\/64a3bc94390d0.webp\",\"280-310\":\"2023-07-04\\/64a3bc94390d0.webp\",\"400-200\":\"2023-07-04\\/64a3bc94390d0.webp\",\"430-590\":\"2023-07-04\\/64a3bc94390d0.webp\",\"600-810\":\"2023-07-04\\/64a3bc94390d0.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bc9448c66.webp\",\"200-200\":\"2023-07-04\\/64a3bc9448c66.webp\",\"280-310\":\"2023-07-04\\/64a3bc9448c66.webp\",\"400-200\":\"2023-07-04\\/64a3bc9448c66.webp\",\"430-590\":\"2023-07-04\\/64a3bc9448c66.webp\",\"600-810\":\"2023-07-04\\/64a3bc9448c66.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3bc945793c.webp\",\"200-200\":\"2023-07-04\\/64a3bc945793c.webp\",\"280-310\":\"2023-07-04\\/64a3bc945793c.webp\",\"400-200\":\"2023-07-04\\/64a3bc945793c.webp\",\"430-590\":\"2023-07-04\\/64a3bc945793c.webp\",\"600-810\":\"2023-07-04\\/64a3bc945793c.webp\"}', '2023-07-04 12:00:44', '2023-07-04 06:30:44', '1'),
(9, 'WOMEN', 'أزياء النساء ', 'WOMEN', 'أزياء النساء ', 'women', '{\"72-72\":\"2023-07-04\\/64a3bcc4c5371.webp\",\"200-200\":\"2023-07-04\\/64a3bcc4c5371.webp\",\"280-310\":\"2023-07-04\\/64a3bcc4c5371.webp\",\"400-200\":\"2023-07-04\\/64a3bcc4c5371.webp\",\"430-590\":\"2023-07-04\\/64a3bcc4c5371.webp\",\"600-810\":\"2023-07-04\\/64a3bcc4c5371.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bcc4c68a4.webp\",\"200-200\":\"2023-07-04\\/64a3bcc4c68a4.webp\",\"280-310\":\"2023-07-04\\/64a3bcc4c68a4.webp\",\"400-200\":\"2023-07-04\\/64a3bcc4c68a4.webp\",\"430-590\":\"2023-07-04\\/64a3bcc4c68a4.webp\",\"600-810\":\"2023-07-04\\/64a3bcc4c68a4.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3bcc4c796c.webp\",\"200-200\":\"2023-07-04\\/64a3bcc4c796c.webp\",\"280-310\":\"2023-07-04\\/64a3bcc4c796c.webp\",\"400-200\":\"2023-07-04\\/64a3bcc4c796c.webp\",\"430-590\":\"2023-07-04\\/64a3bcc4c796c.webp\",\"600-810\":\"2023-07-04\\/64a3bcc4c796c.webp\"}', '2023-07-04 12:01:32', '2023-07-04 06:31:32', '1'),
(10, 'HOME', 'البيت', 'HOME', 'البيت', 'home', '{\"72-72\":\"2023-07-04\\/64a3bd05ccad4.webp\",\"200-200\":\"2023-07-04\\/64a3bd05ccad4.webp\",\"280-310\":\"2023-07-04\\/64a3bd05ccad4.webp\",\"400-200\":\"2023-07-04\\/64a3bd05ccad4.webp\",\"430-590\":\"2023-07-04\\/64a3bd05ccad4.webp\",\"600-810\":\"2023-07-04\\/64a3bd05ccad4.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bd05d4cb0.webp\",\"200-200\":\"2023-07-04\\/64a3bd05d4cb0.webp\",\"280-310\":\"2023-07-04\\/64a3bd05d4cb0.webp\",\"400-200\":\"2023-07-04\\/64a3bd05d4cb0.webp\",\"430-590\":\"2023-07-04\\/64a3bd05d4cb0.webp\",\"600-810\":\"2023-07-04\\/64a3bd05d4cb0.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3bd05d8c5b.webp\",\"200-200\":\"2023-07-04\\/64a3bd05d8c5b.webp\",\"280-310\":\"2023-07-04\\/64a3bd05d8c5b.webp\",\"400-200\":\"2023-07-04\\/64a3bd05d8c5b.webp\",\"430-590\":\"2023-07-04\\/64a3bd05d8c5b.webp\",\"600-810\":\"2023-07-04\\/64a3bd05d8c5b.webp\"}', '2023-07-04 12:02:37', '2023-07-04 06:32:37', '1'),
(11, 'BEAUTY & FRAGRANCE', 'الجمال والعطور', 'BEAUTY & FRAGRANCE', 'الجمال والعطور', 'beauty-and-fragrance', '{\"72-72\":\"2023-07-04\\/64a3bd9b984b6.webp\",\"200-200\":\"2023-07-04\\/64a3bd9b984b6.webp\",\"280-310\":\"2023-07-04\\/64a3bd9b984b6.webp\",\"400-200\":\"2023-07-04\\/64a3bd9b984b6.webp\",\"430-590\":\"2023-07-04\\/64a3bd9b984b6.webp\",\"600-810\":\"2023-07-04\\/64a3bd9b984b6.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bd9b9a66b.webp\",\"200-200\":\"2023-07-04\\/64a3bd9b9a66b.webp\",\"280-310\":\"2023-07-04\\/64a3bd9b9a66b.webp\",\"400-200\":\"2023-07-04\\/64a3bd9b9a66b.webp\",\"430-590\":\"2023-07-04\\/64a3bd9b9a66b.webp\",\"600-810\":\"2023-07-04\\/64a3bd9b9a66b.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3bd9b9b10d.webp\",\"200-200\":\"2023-07-04\\/64a3bd9b9b10d.webp\",\"280-310\":\"2023-07-04\\/64a3bd9b9b10d.webp\",\"400-200\":\"2023-07-04\\/64a3bd9b9b10d.webp\",\"430-590\":\"2023-07-04\\/64a3bd9b9b10d.webp\",\"600-810\":\"2023-07-04\\/64a3bd9b9b10d.webp\"}', '2023-07-04 12:05:07', '2023-07-04 06:35:07', '1'),
(12, 'BABY', 'البيبي', 'BABY', 'البيبي', 'baby', '{\"72-72\":\"2023-07-04\\/64a3bea34e59b.webp\",\"200-200\":\"2023-07-04\\/64a3bea34e59b.webp\",\"280-310\":\"2023-07-04\\/64a3bea34e59b.webp\",\"400-200\":\"2023-07-04\\/64a3bea34e59b.webp\",\"430-590\":\"2023-07-04\\/64a3bea34e59b.webp\",\"600-810\":\"2023-07-04\\/64a3bea34e59b.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bea34e958.webp\",\"200-200\":\"2023-07-04\\/64a3bea34e958.webp\",\"280-310\":\"2023-07-04\\/64a3bea34e958.webp\",\"400-200\":\"2023-07-04\\/64a3bea34e958.webp\",\"430-590\":\"2023-07-04\\/64a3bea34e958.webp\",\"600-810\":\"2023-07-04\\/64a3bea34e958.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3bea34eb93.webp\",\"200-200\":\"2023-07-04\\/64a3bea34eb93.webp\",\"280-310\":\"2023-07-04\\/64a3bea34eb93.webp\",\"400-200\":\"2023-07-04\\/64a3bea34eb93.webp\",\"430-590\":\"2023-07-04\\/64a3bea34eb93.webp\",\"600-810\":\"2023-07-04\\/64a3bea34eb93.webp\"}', '2023-07-04 12:09:31', '2023-07-04 06:39:31', '1'),
(13, 'TOYS', 'ألعاب الأطفال', 'TOYS', 'ألعاب الأطفال', 'toys', '{\"72-72\":\"2023-07-04\\/64a3bed960924.webp\",\"200-200\":\"2023-07-04\\/64a3bed960924.webp\",\"280-310\":\"2023-07-04\\/64a3bed960924.webp\",\"400-200\":\"2023-07-04\\/64a3bed960924.webp\",\"430-590\":\"2023-07-04\\/64a3bed960924.webp\",\"600-810\":\"2023-07-04\\/64a3bed960924.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3bed960fc1.webp\",\"200-200\":\"2023-07-04\\/64a3bed960fc1.webp\",\"280-310\":\"2023-07-04\\/64a3bed960fc1.webp\",\"400-200\":\"2023-07-04\\/64a3bed960fc1.webp\",\"430-590\":\"2023-07-04\\/64a3bed960fc1.webp\",\"600-810\":\"2023-07-04\\/64a3bed960fc1.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3bed9611cb.webp\",\"200-200\":\"2023-07-04\\/64a3bed9611cb.webp\",\"280-310\":\"2023-07-04\\/64a3bed9611cb.webp\",\"400-200\":\"2023-07-04\\/64a3bed9611cb.webp\",\"430-590\":\"2023-07-04\\/64a3bed9611cb.webp\",\"600-810\":\"2023-07-04\\/64a3bed9611cb.webp\"}', '2023-07-04 12:10:25', '2023-07-04 06:40:25', '1'),
(14, 'SPORTS', 'الرياضة', 'SPORTS', 'الرياضة', 'sports', '{\"72-72\":\"2023-07-04\\/64a3c2ca6bb96.webp\",\"200-200\":\"2023-07-04\\/64a3c2ca6bb96.webp\",\"280-310\":\"2023-07-04\\/64a3c2ca6bb96.webp\",\"400-200\":\"2023-07-04\\/64a3c2ca6bb96.webp\",\"430-590\":\"2023-07-04\\/64a3c2ca6bb96.webp\",\"600-810\":\"2023-07-04\\/64a3c2ca6bb96.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-07-04\\/64a3c2ca6bf17.webp\",\"200-200\":\"2023-07-04\\/64a3c2ca6bf17.webp\",\"280-310\":\"2023-07-04\\/64a3c2ca6bf17.webp\",\"400-200\":\"2023-07-04\\/64a3c2ca6bf17.webp\",\"430-590\":\"2023-07-04\\/64a3c2ca6bf17.webp\",\"600-810\":\"2023-07-04\\/64a3c2ca6bf17.webp\"}', '{\"72-72\":\"2023-07-04\\/64a3c2ca6c136.webp\",\"200-200\":\"2023-07-04\\/64a3c2ca6c136.webp\",\"280-310\":\"2023-07-04\\/64a3c2ca6c136.webp\",\"400-200\":\"2023-07-04\\/64a3c2ca6c136.webp\",\"430-590\":\"2023-07-04\\/64a3c2ca6c136.webp\",\"600-810\":\"2023-07-04\\/64a3c2ca6c136.webp\"}', '2023-07-04 12:27:14', '2023-07-04 06:57:14', '1'),
(15, 'Mobiles & Accessories', 'موبايلات واكسسواراتها', 'Mobiles & Accessories', 'موبايلات واكسسواراتها', 'mobiles-and-accessories', '{\"72-72\":\"2023-07-04\\/64a3da9827906.webp\",\"200-200\":\"2023-07-04\\/64a3da9827906.webp\",\"280-310\":\"2023-07-04\\/64a3da9827906.webp\",\"400-200\":\"2023-07-04\\/64a3da9827906.webp\",\"430-590\":\"2023-07-04\\/64a3da9827906.webp\",\"600-810\":\"2023-07-04\\/64a3da9827906.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:08:48', '2023-07-04 08:38:48', '1'),
(16, 'Laptops & Computers', 'أجهزة الكمبيوتر المحمولة وأجهزة الكمبيوتر', 'Laptops & Computers', 'أجهزة الكمبيوتر المحمولة وأجهزة الكمبيوتر', 'laptops-and-computers', '{\"72-72\":\"2023-07-04\\/64a3e3bc90356.webp\",\"200-200\":\"2023-07-04\\/64a3e3bc90356.webp\",\"280-310\":\"2023-07-04\\/64a3e3bc90356.webp\",\"400-200\":\"2023-07-04\\/64a3e3bc90356.webp\",\"430-590\":\"2023-07-04\\/64a3e3bc90356.webp\",\"600-810\":\"2023-07-04\\/64a3e3bc90356.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:47:48', '2023-07-04 09:17:48', '1'),
(17, 'Video Games', 'ألعاب الفيديو', 'Video Games', 'ألعاب الفيديو', 'video-games', '{\"72-72\":\"2023-07-04\\/64a3e3e43bf14.webp\",\"200-200\":\"2023-07-04\\/64a3e3e43bf14.webp\",\"280-310\":\"2023-07-04\\/64a3e3e43bf14.webp\",\"400-200\":\"2023-07-04\\/64a3e3e43bf14.webp\",\"430-590\":\"2023-07-04\\/64a3e3e43bf14.webp\",\"600-810\":\"2023-07-04\\/64a3e3e43bf14.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:48:28', '2023-07-04 09:18:28', '1'),
(18, 'Televisions', 'التلفزيونات', 'Televisions', 'التلفزيونات', 'televisions', '{\"72-72\":\"2023-07-04\\/64a3e40c164dc.webp\",\"200-200\":\"2023-07-04\\/64a3e40c164dc.webp\",\"280-310\":\"2023-07-04\\/64a3e40c164dc.webp\",\"400-200\":\"2023-07-04\\/64a3e40c164dc.webp\",\"430-590\":\"2023-07-04\\/64a3e40c164dc.webp\",\"600-810\":\"2023-07-04\\/64a3e40c164dc.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:49:08', '2023-07-04 09:19:08', '1'),
(19, 'Home Appliances', 'أجهزة منزلية', 'Home Appliances', 'أجهزة منزلية', 'home-appliances', '{\"72-72\":\"2023-07-04\\/64a3e446462c9.webp\",\"200-200\":\"2023-07-04\\/64a3e446462c9.webp\",\"280-310\":\"2023-07-04\\/64a3e446462c9.webp\",\"400-200\":\"2023-07-04\\/64a3e446462c9.webp\",\"430-590\":\"2023-07-04\\/64a3e446462c9.webp\",\"600-810\":\"2023-07-04\\/64a3e446462c9.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:50:06', '2023-07-04 09:20:06', '1'),
(20, 'Power Banks', 'باور بانك', 'Power Banks', 'باور بانك', 'power-banks', '{\"72-72\":\"2023-07-04\\/64a3e4d1a0c3e.webp\",\"200-200\":\"2023-07-04\\/64a3e4d1a0c3e.webp\",\"280-310\":\"2023-07-04\\/64a3e4d1a0c3e.webp\",\"400-200\":\"2023-07-04\\/64a3e4d1a0c3e.webp\",\"430-590\":\"2023-07-04\\/64a3e4d1a0c3e.webp\",\"600-810\":\"2023-07-04\\/64a3e4d1a0c3e.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:52:25', '2023-07-04 09:22:25', '1'),
(21, 'Headphones & Earphones', 'سماعات وسماعات', 'Headphones & Earphones', 'سماعات وسماعات', 'headphones-and-earphones', '{\"72-72\":\"2023-07-04\\/64a3e4e534066.webp\",\"200-200\":\"2023-07-04\\/64a3e4e534066.webp\",\"280-310\":\"2023-07-04\\/64a3e4e534066.webp\",\"400-200\":\"2023-07-04\\/64a3e4e534066.webp\",\"430-590\":\"2023-07-04\\/64a3e4e534066.webp\",\"600-810\":\"2023-07-04\\/64a3e4e534066.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:52:45', '2023-07-04 09:22:45', '1'),
(22, 'Speakers', 'مكبرات الصوت', 'Speakers', 'مكبرات الصوت', 'speakers', '{\"72-72\":\"2023-07-04\\/64a3e4f64ef7f.webp\",\"200-200\":\"2023-07-04\\/64a3e4f64ef7f.webp\",\"280-310\":\"2023-07-04\\/64a3e4f64ef7f.webp\",\"400-200\":\"2023-07-04\\/64a3e4f64ef7f.webp\",\"430-590\":\"2023-07-04\\/64a3e4f64ef7f.webp\",\"600-810\":\"2023-07-04\\/64a3e4f64ef7f.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:53:02', '2023-07-04 09:23:02', '1'),
(23, 'Wearable Devices', 'الأجهزة القابلة للارتداء', 'Wearable Devices', 'الأجهزة القابلة للارتداء', 'wearable-devices', '{\"72-72\":\"2023-07-04\\/64a3e4fc810cb.webp\",\"200-200\":\"2023-07-04\\/64a3e4fc810cb.webp\",\"280-310\":\"2023-07-04\\/64a3e4fc810cb.webp\",\"400-200\":\"2023-07-04\\/64a3e4fc810cb.webp\",\"430-590\":\"2023-07-04\\/64a3e4fc810cb.webp\",\"600-810\":\"2023-07-04\\/64a3e4fc810cb.webp\"}', 7, 0, 1, NULL, '', '', '2023-07-04 02:53:08', '2023-07-04 09:23:08', '1'),
(24, 'Plain Cases', 'حالات عادية', 'Plain Cases', 'حالات عادية', 'plain-cases', '{\"72-72\":\"2023-07-04\\/64a3eb6783726.webp\",\"200-200\":\"2023-07-04\\/64a3eb6783726.webp\",\"280-310\":\"2023-07-04\\/64a3eb6783726.webp\",\"400-200\":\"2023-07-04\\/64a3eb6783726.webp\",\"430-590\":\"2023-07-04\\/64a3eb6783726.webp\",\"600-810\":\"2023-07-04\\/64a3eb6783726.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 03:20:31', '2023-07-04 09:50:31', '1'),
(25, 'Designer Cases', 'حالات المصمم', 'Designer Cases', 'حالات المصمم', 'designer-cases', '{\"72-72\":\"2023-07-04\\/64a3fe577eb5f.webp\",\"200-200\":\"2023-07-04\\/64a3fe577eb5f.webp\",\"280-310\":\"2023-07-04\\/64a3fe577eb5f.webp\",\"400-200\":\"2023-07-04\\/64a3fe577eb5f.webp\",\"430-590\":\"2023-07-04\\/64a3fe577eb5f.webp\",\"600-810\":\"2023-07-04\\/64a3fe577eb5f.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:41:19', '2023-07-04 11:11:19', '1'),
(26, 'Screen Guards', 'واقيات الشاشة', 'Screen Guards', 'واقيات الشاشة', 'screen-guards', '{\"72-72\":\"2023-07-04\\/64a3ff253c03e.webp\",\"200-200\":\"2023-07-04\\/64a3ff253c03e.webp\",\"280-310\":\"2023-07-04\\/64a3ff253c03e.webp\",\"400-200\":\"2023-07-04\\/64a3ff253c03e.webp\",\"430-590\":\"2023-07-04\\/64a3ff253c03e.webp\",\"600-810\":\"2023-07-04\\/64a3ff253c03e.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:44:45', '2023-07-04 11:14:45', '1'),
(27, 'Camera Lens Protectors', 'واقيات عدسة الكاميرا', 'Camera Lens Protectors', 'واقيات عدسة الكاميرا', 'camera-lens-protectors', '{\"72-72\":\"2023-07-04\\/64a3ff508102d.webp\",\"200-200\":\"2023-07-04\\/64a3ff508102d.webp\",\"280-310\":\"2023-07-04\\/64a3ff508102d.webp\",\"400-200\":\"2023-07-04\\/64a3ff508102d.webp\",\"430-590\":\"2023-07-04\\/64a3ff508102d.webp\",\"600-810\":\"2023-07-04\\/64a3ff508102d.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:45:28', '2023-07-04 11:15:28', '1'),
(28, 'Tablet Accessories', 'ملحقات التابلت', 'Tablet Accessories', 'ملحقات التابلت', 'tablet-accessories', '{\"72-72\":\"2023-07-04\\/64a3ff781979c.webp\",\"200-200\":\"2023-07-04\\/64a3ff781979c.webp\",\"280-310\":\"2023-07-04\\/64a3ff781979c.webp\",\"400-200\":\"2023-07-04\\/64a3ff781979c.webp\",\"430-590\":\"2023-07-04\\/64a3ff781979c.webp\",\"600-810\":\"2023-07-04\\/64a3ff781979c.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:46:08', '2023-07-04 11:16:08', '1'),
(29, 'Mobile Cable', 'كابل الموبايل', 'Mobile Cable', 'كابل الموبايل', 'mobile-cable', '{\"72-72\":\"2023-07-04\\/64a3ff949cae7.webp\",\"200-200\":\"2023-07-04\\/64a3ff949cae7.webp\",\"280-310\":\"2023-07-04\\/64a3ff949cae7.webp\",\"400-200\":\"2023-07-04\\/64a3ff949cae7.webp\",\"430-590\":\"2023-07-04\\/64a3ff949cae7.webp\",\"600-810\":\"2023-07-04\\/64a3ff949cae7.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:46:36', '2023-07-04 11:16:36', '1'),
(30, 'Mobile Charger', 'شاحن الهاتف', 'Mobile Charger', 'شاحن الهاتف', 'mobile-charger', '{\"72-72\":\"2023-07-04\\/64a3ffafe60bd.webp\",\"200-200\":\"2023-07-04\\/64a3ffafe60bd.webp\",\"280-310\":\"2023-07-04\\/64a3ffafe60bd.webp\",\"400-200\":\"2023-07-04\\/64a3ffafe60bd.webp\",\"430-590\":\"2023-07-04\\/64a3ffafe60bd.webp\",\"600-810\":\"2023-07-04\\/64a3ffafe60bd.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:47:03', '2023-07-04 11:17:03', '1'),
(31, 'Mobile Pouches', 'الحقائب المحمولة', 'Mobile Pouches', 'الحقائب المحمولة', 'mobile-pouches', '{\"72-72\":\"2023-07-04\\/64a3ffcdcb659.webp\",\"200-200\":\"2023-07-04\\/64a3ffcdcb659.webp\",\"280-310\":\"2023-07-04\\/64a3ffcdcb659.webp\",\"400-200\":\"2023-07-04\\/64a3ffcdcb659.webp\",\"430-590\":\"2023-07-04\\/64a3ffcdcb659.webp\",\"600-810\":\"2023-07-04\\/64a3ffcdcb659.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:47:33', '2023-07-04 11:17:33', '1'),
(32, 'Mobile Flash', 'فلاش موبايل', 'Mobile Flash', 'فلاش موبايل', 'mobile-flash', '{\"72-72\":\"2023-07-04\\/64a3ffe552462.webp\",\"200-200\":\"2023-07-04\\/64a3ffe552462.webp\",\"280-310\":\"2023-07-04\\/64a3ffe552462.webp\",\"400-200\":\"2023-07-04\\/64a3ffe552462.webp\",\"430-590\":\"2023-07-04\\/64a3ffe552462.webp\",\"600-810\":\"2023-07-04\\/64a3ffe552462.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:47:57', '2023-07-04 11:17:57', '1'),
(33, 'Mobile Holder', 'حامل موبايل', 'Mobile Holder', 'حامل موبايل', 'mobile-holder', '{\"72-72\":\"2023-07-04\\/64a4000929c95.webp\",\"200-200\":\"2023-07-04\\/64a4000929c95.webp\",\"280-310\":\"2023-07-04\\/64a4000929c95.webp\",\"400-200\":\"2023-07-04\\/64a4000929c95.webp\",\"430-590\":\"2023-07-04\\/64a4000929c95.webp\",\"600-810\":\"2023-07-04\\/64a4000929c95.webp\"}', 15, 0, 1, NULL, '', '', '2023-07-04 04:48:33', '2023-07-04 11:18:33', '1'),
(34, 'Laptops', 'أجهزة الكمبيوتر المحمولة', 'Laptops', 'أجهزة الكمبيوتر المحمولة', 'laptops', '{\"72-72\":\"2023-07-04\\/64a400593377c.webp\",\"200-200\":\"2023-07-04\\/64a400593377c.webp\",\"280-310\":\"2023-07-04\\/64a400593377c.webp\",\"400-200\":\"2023-07-04\\/64a400593377c.webp\",\"430-590\":\"2023-07-04\\/64a400593377c.webp\",\"600-810\":\"2023-07-04\\/64a400593377c.webp\"}', 16, 0, 1, NULL, '', '', '2023-07-04 04:49:53', '2023-07-04 11:19:53', '1'),
(35, 'Gaming Laptops', 'أجهزة الكمبيوتر المحمولة المخصصة للألعاب', 'Gaming Laptops', 'أجهزة الكمبيوتر المحمولة المخصصة للألعاب', 'gaming-laptops', '{\"72-72\":\"2023-07-04\\/64a4009aa5434.webp\",\"200-200\":\"2023-07-04\\/64a4009aa5434.webp\",\"280-310\":\"2023-07-04\\/64a4009aa5434.webp\",\"400-200\":\"2023-07-04\\/64a4009aa5434.webp\",\"430-590\":\"2023-07-04\\/64a4009aa5434.webp\",\"600-810\":\"2023-07-04\\/64a4009aa5434.webp\"}', 16, 0, 1, NULL, '', '', '2023-07-04 04:50:58', '2023-07-04 11:20:58', '1'),
(36, 'Desktop PCs', 'أجهزة كمبيوتر سطح المكتب', 'Desktop PCs', 'أجهزة كمبيوتر سطح المكتب', 'desktop-pcs', '{\"72-72\":\"2023-07-04\\/64a400dfae586.webp\",\"200-200\":\"2023-07-04\\/64a400dfae586.webp\",\"280-310\":\"2023-07-04\\/64a400dfae586.webp\",\"400-200\":\"2023-07-04\\/64a400dfae586.webp\",\"430-590\":\"2023-07-04\\/64a400dfae586.webp\",\"600-810\":\"2023-07-04\\/64a400dfae586.webp\"}', 16, 0, 1, NULL, '', '', '2023-07-04 04:52:07', '2023-07-04 11:22:07', '1'),
(37, 'Mini PCs', 'أجهزة كمبيوتر صغيرة', 'Mini PCs', 'أجهزة كمبيوتر صغيرة', 'mini-pcs', '{\"72-72\":\"2023-07-04\\/64a4010b0cce4.webp\",\"200-200\":\"2023-07-04\\/64a4010b0cce4.webp\",\"280-310\":\"2023-07-04\\/64a4010b0cce4.webp\",\"400-200\":\"2023-07-04\\/64a4010b0cce4.webp\",\"430-590\":\"2023-07-04\\/64a4010b0cce4.webp\",\"600-810\":\"2023-07-04\\/64a4010b0cce4.webp\"}', 16, 0, 1, NULL, '', '', '2023-07-04 04:52:51', '2023-07-04 11:22:51', '1'),
(38, 'All in One PCs', 'أجهزة كمبيوتر الكل في واحد', 'All in One PCs', 'أجهزة كمبيوتر الكل في واحد', 'all-in-one-pcs', '{\"72-72\":\"2023-07-04\\/64a40127dfd76.webp\",\"200-200\":\"2023-07-04\\/64a40127dfd76.webp\",\"280-310\":\"2023-07-04\\/64a40127dfd76.webp\",\"400-200\":\"2023-07-04\\/64a40127dfd76.webp\",\"430-590\":\"2023-07-04\\/64a40127dfd76.webp\",\"600-810\":\"2023-07-04\\/64a40127dfd76.webp\"}', 16, 0, 1, NULL, '', '', '2023-07-04 04:53:19', '2023-07-04 11:23:19', '1'),
(39, 'Tower PCs', 'كمبيوتر تاور', 'Tower PCs', 'كمبيوتر تاور', 'tower-pcs', '{\"72-72\":\"2023-07-04\\/64a401423e0cc.webp\",\"200-200\":\"2023-07-04\\/64a401423e0cc.webp\",\"280-310\":\"2023-07-04\\/64a401423e0cc.webp\",\"400-200\":\"2023-07-04\\/64a401423e0cc.webp\",\"430-590\":\"2023-07-04\\/64a401423e0cc.webp\",\"600-810\":\"2023-07-04\\/64a401423e0cc.webp\"}', 16, 0, 1, NULL, '', '', '2023-07-04 04:53:46', '2023-07-04 11:23:46', '1'),
(40, 'Gaming Consoles', 'Gaming Consoles', 'لعب لوحات المفاتيح', 'Gaming Consoles', 'gaming-consoles', '{\"72-72\":\"2023-07-04\\/64a41526a1824.webp\",\"200-200\":\"2023-07-04\\/64a41526a1824.webp\",\"280-310\":\"2023-07-04\\/64a41526a1824.webp\",\"400-200\":\"2023-07-04\\/64a41526a1824.webp\",\"430-590\":\"2023-07-04\\/64a41526a1824.webp\",\"600-810\":\"2023-07-04\\/64a41526a1824.webp\"}', 17, 0, 1, NULL, '', '', '2023-07-04 06:18:38', '2023-07-04 12:48:38', '1'),
(41, 'Gaming Mouse', 'ماوس الألعاب', 'Gaming Mouse', 'ماوس الألعاب', 'gaming-mouse', '{\"72-72\":\"2023-07-04\\/64a415787ce9e.webp\",\"200-200\":\"2023-07-04\\/64a415787ce9e.webp\",\"280-310\":\"2023-07-04\\/64a415787ce9e.webp\",\"400-200\":\"2023-07-04\\/64a415787ce9e.webp\",\"430-590\":\"2023-07-04\\/64a415787ce9e.webp\",\"600-810\":\"2023-07-04\\/64a415787ce9e.webp\"}', 17, 0, 1, NULL, '', '', '2023-07-04 06:20:00', '2023-07-04 12:50:00', '1'),
(42, 'Gaming Keyboards', 'لوحات مفاتيح الألعاب', 'Gaming Keyboards', 'لوحات مفاتيح الألعاب', 'gaming-keyboards', '{\"72-72\":\"2023-07-04\\/64a4159abceeb.webp\",\"200-200\":\"2023-07-04\\/64a4159abceeb.webp\",\"280-310\":\"2023-07-04\\/64a4159abceeb.webp\",\"400-200\":\"2023-07-04\\/64a4159abceeb.webp\",\"430-590\":\"2023-07-04\\/64a4159abceeb.webp\",\"600-810\":\"2023-07-04\\/64a4159abceeb.webp\"}', 17, 0, 1, NULL, '', '', '2023-07-04 06:20:34', '2023-07-04 12:50:34', '1'),
(43, 'Gamepads', 'غمبد', 'Gamepads', 'غمبد', 'gamepads', '{\"72-72\":\"2023-07-04\\/64a415c1ac7ee.webp\",\"200-200\":\"2023-07-04\\/64a415c1ac7ee.webp\",\"280-310\":\"2023-07-04\\/64a415c1ac7ee.webp\",\"400-200\":\"2023-07-04\\/64a415c1ac7ee.webp\",\"430-590\":\"2023-07-04\\/64a415c1ac7ee.webp\",\"600-810\":\"2023-07-04\\/64a415c1ac7ee.webp\"}', 17, 0, 1, NULL, '', '', '2023-07-04 06:21:13', '2023-07-04 12:51:13', '1'),
(44, 'Games', 'ألعاب', 'Games', 'ألعاب', 'games', '{\"72-72\":\"2023-07-04\\/64a415db7c0d7.webp\",\"200-200\":\"2023-07-04\\/64a415db7c0d7.webp\",\"280-310\":\"2023-07-04\\/64a415db7c0d7.webp\",\"400-200\":\"2023-07-04\\/64a415db7c0d7.webp\",\"430-590\":\"2023-07-04\\/64a415db7c0d7.webp\",\"600-810\":\"2023-07-04\\/64a415db7c0d7.webp\"}', 17, 0, 1, NULL, '', '', '2023-07-04 06:21:39', '2023-07-04 12:51:39', '1'),
(45, 'Topwear', 'توبوير', 'topwear', 'توبوير', 'topwear', '{\"72-72\":\"2023-08-01\\/64c8b1dfc04b6.webp\",\"200-200\":\"2023-08-01\\/64c8b1dfc04b6.webp\",\"280-310\":\"2023-08-01\\/64c8b1dfc04b6.webp\",\"400-200\":\"2023-08-01\\/64c8b1dfc04b6.webp\",\"430-590\":\"2023-08-01\\/64c8b1dfc04b6.webp\",\"600-810\":\"2023-08-01\\/64c8b1dfc04b6.webp\"}', 8, 0, 1, NULL, '', '', '2023-08-01 12:48:55', '2023-08-01 07:18:55', '1'),
(46, 'T-Shirts', 'قمصان', 't-shirt', 'قمصان', 't-shirts', '{\"72-72\":\"2023-08-01\\/64c8b27fe13f5.webp\",\"200-200\":\"2023-08-01\\/64c8b27fe13f5.webp\",\"280-310\":\"2023-08-01\\/64c8b27fe13f5.webp\",\"400-200\":\"2023-08-01\\/64c8b27fe13f5.webp\",\"430-590\":\"2023-08-01\\/64c8b27fe13f5.webp\",\"600-810\":\"2023-08-01\\/64c8b27fe13f5.webp\"}', 45, 0, 1, NULL, '', '', '2023-08-01 12:51:35', '2023-08-01 07:21:35', '1'),
(47, 'Western Wear', 'ملابس غربية', 'Western Wear', 'ملابس غربية', 'western-wear', '{\"72-72\":\"2023-08-01\\/64c8dab44b8db.webp\",\"200-200\":\"2023-08-01\\/64c8dab44b8db.webp\",\"280-310\":\"2023-08-01\\/64c8dab44b8db.webp\",\"400-200\":\"2023-08-01\\/64c8dab44b8db.webp\",\"430-590\":\"2023-08-01\\/64c8dab44b8db.webp\",\"600-810\":\"2023-08-01\\/64c8dab44b8db.webp\"}', 9, 0, 1, NULL, '', '', '2023-08-01 03:43:08', '2023-08-01 10:13:08', '1'),
(49, 'artificial jewellery', '', 'artificial jewellery', '', 'artificial-jewellery', '{\"72-72\":\"2023-11-03\\/6544dbadf19c4.webp\",\"200-200\":\"2023-11-03\\/6544dbadf19c4.webp\",\"280-310\":\"2023-11-03\\/6544dbadf19c4.webp\",\"400-200\":\"2023-11-03\\/6544dbadf19c4.webp\",\"430-590\":\"2023-11-03\\/6544dbadf19c4.webp\",\"600-810\":\"2023-11-03\\/6544dbadf19c4.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-11-03\\/6544dbae0ec39.webp\",\"200-200\":\"2023-11-03\\/6544dbae0ec39.webp\",\"280-310\":\"2023-11-03\\/6544dbae0ec39.webp\",\"400-200\":\"2023-11-03\\/6544dbae0ec39.webp\",\"430-590\":\"2023-11-03\\/6544dbae0ec39.webp\",\"600-810\":\"2023-11-03\\/6544dbae0ec39.webp\"}', '{\"72-72\":\"2023-11-03\\/6544dbae1ea17.webp\",\"200-200\":\"2023-11-03\\/6544dbae1ea17.webp\",\"280-310\":\"2023-11-03\\/6544dbae1ea17.webp\",\"400-200\":\"2023-11-03\\/6544dbae1ea17.webp\",\"430-590\":\"2023-11-03\\/6544dbae1ea17.webp\",\"600-810\":\"2023-11-03\\/6544dbae1ea17.webp\"}', '2023-11-03 05:08:21', '2023-11-03 11:38:22', '1'),
(50, 'sherwani', '', 'sherwani', '', 'sherwani', '{\"72-72\":\"2023-11-03\\/6544df117099f.webp\",\"200-200\":\"2023-11-03\\/6544df117099f.webp\",\"280-310\":\"2023-11-03\\/6544df117099f.webp\",\"400-200\":\"2023-11-03\\/6544df117099f.webp\",\"430-590\":\"2023-11-03\\/6544df117099f.webp\",\"600-810\":\"2023-11-03\\/6544df117099f.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-11-03\\/6544df1171099.webp\",\"200-200\":\"2023-11-03\\/6544df1171099.webp\",\"280-310\":\"2023-11-03\\/6544df1171099.webp\",\"400-200\":\"2023-11-03\\/6544df1171099.webp\",\"430-590\":\"2023-11-03\\/6544df1171099.webp\",\"600-810\":\"2023-11-03\\/6544df1171099.webp\"}', '{\"72-72\":\"2023-11-03\\/6544df11716e0.webp\",\"200-200\":\"2023-11-03\\/6544df11716e0.webp\",\"280-310\":\"2023-11-03\\/6544df11716e0.webp\",\"400-200\":\"2023-11-03\\/6544df11716e0.webp\",\"430-590\":\"2023-11-03\\/6544df11716e0.webp\",\"600-810\":\"2023-11-03\\/6544df11716e0.webp\"}', '2023-11-03 05:22:49', '2023-11-03 11:52:49', '1'),
(51, 'Camera', '', 'Camera', '', 'camera', '{\"72-72\":\"2023-11-03\\/6544e0ea22e03.webp\",\"200-200\":\"2023-11-03\\/6544e0ea22e03.webp\",\"280-310\":\"2023-11-03\\/6544e0ea22e03.webp\",\"400-200\":\"2023-11-03\\/6544e0ea22e03.webp\",\"430-590\":\"2023-11-03\\/6544e0ea22e03.webp\",\"600-810\":\"2023-11-03\\/6544e0ea22e03.webp\"}', 7, 0, 1, NULL, '', '', '2023-11-03 05:30:42', '2023-11-03 12:00:42', '1'),
(52, 'decoration', '', 'decoration', '', 'decoration', '{\"72-72\":\"2023-11-03\\/6544e1eb80cd0.webp\",\"200-200\":\"2023-11-03\\/6544e1eb80cd0.webp\",\"280-310\":\"2023-11-03\\/6544e1eb80cd0.webp\",\"400-200\":\"2023-11-03\\/6544e1eb80cd0.webp\",\"430-590\":\"2023-11-03\\/6544e1eb80cd0.webp\",\"600-810\":\"2023-11-03\\/6544e1eb80cd0.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-11-03\\/6544e1eb833ac.webp\",\"200-200\":\"2023-11-03\\/6544e1eb833ac.webp\",\"280-310\":\"2023-11-03\\/6544e1eb833ac.webp\",\"400-200\":\"2023-11-03\\/6544e1eb833ac.webp\",\"430-590\":\"2023-11-03\\/6544e1eb833ac.webp\",\"600-810\":\"2023-11-03\\/6544e1eb833ac.webp\"}', '{\"72-72\":\"2023-11-03\\/6544e1eb85b0e.webp\",\"200-200\":\"2023-11-03\\/6544e1eb85b0e.webp\",\"280-310\":\"2023-11-03\\/6544e1eb85b0e.webp\",\"400-200\":\"2023-11-03\\/6544e1eb85b0e.webp\",\"430-590\":\"2023-11-03\\/6544e1eb85b0e.webp\",\"600-810\":\"2023-11-03\\/6544e1eb85b0e.webp\"}', '2023-11-03 05:34:59', '2023-11-03 12:04:59', '1'),
(54, 'cks test', 'cks test', '', '', 'cks-test', '{\"72-72\":\"2023-12-13\\/65795623e173c.webp\",\"200-200\":\"2023-12-13\\/65795623e173c.webp\",\"280-310\":\"2023-12-13\\/65795623e173c.webp\",\"400-200\":\"2023-12-13\\/65795623e173c.webp\",\"430-590\":\"2023-12-13\\/65795623e173c.webp\",\"600-810\":\"2023-12-13\\/65795623e173c.webp\"}', 7, 0, 0, NULL, '', '', '2023-12-13 12:28:43', '2023-12-13 06:58:44', 'SVR6og303Vm'),
(55, 'Sport', '', 'All sports items', '', 'sport', '{\"72-72\":\"2023-12-13\\/6579741b4c7c1.webp\",\"200-200\":\"2023-12-13\\/6579741b4c7c1.webp\",\"280-310\":\"2023-12-13\\/6579741b4c7c1.webp\",\"400-200\":\"2023-12-13\\/6579741b4c7c1.webp\",\"430-590\":\"2023-12-13\\/6579741b4c7c1.webp\",\"600-810\":\"2023-12-13\\/6579741b4c7c1.webp\"}', 0, 0, 1, NULL, '{\"72-72\":\"2023-12-13\\/6579741b4d5dd.webp\",\"200-200\":\"2023-12-13\\/6579741b4d5dd.webp\",\"280-310\":\"2023-12-13\\/6579741b4d5dd.webp\",\"400-200\":\"2023-12-13\\/6579741b4d5dd.webp\",\"430-590\":\"2023-12-13\\/6579741b4d5dd.webp\",\"600-810\":\"2023-12-13\\/6579741b4d5dd.webp\"}', '{\"72-72\":\"2023-12-13\\/6579741b4df32.webp\",\"200-200\":\"2023-12-13\\/6579741b4df32.webp\",\"280-310\":\"2023-12-13\\/6579741b4df32.webp\",\"400-200\":\"2023-12-13\\/6579741b4df32.webp\",\"430-590\":\"2023-12-13\\/6579741b4df32.webp\",\"600-810\":\"2023-12-13\\/6579741b4df32.webp\"}', '2023-12-13 02:36:35', '2023-12-13 09:06:35', '1'),
(56, 'Cricket', '', 'Cricket', '', 'cricket', '{\"72-72\":\"2023-12-13\\/6579745019dc2.webp\",\"200-200\":\"2023-12-13\\/6579745019dc2.webp\",\"280-310\":\"2023-12-13\\/6579745019dc2.webp\",\"400-200\":\"2023-12-13\\/6579745019dc2.webp\",\"430-590\":\"2023-12-13\\/6579745019dc2.webp\",\"600-810\":\"2023-12-13\\/6579745019dc2.webp\"}', 55, 0, 1, NULL, '', '', '2023-12-13 02:37:28', '2023-12-13 09:07:28', '1'),
(57, 'VR headset ', 'VR headset ', '', '', 'vr-headset', '{\"72-72\":\"2023-12-13\\/6579748a6d2bc.webp\",\"200-200\":\"2023-12-13\\/6579748a6d2bc.webp\",\"280-310\":\"2023-12-13\\/6579748a6d2bc.webp\",\"400-200\":\"2023-12-13\\/6579748a6d2bc.webp\",\"430-590\":\"2023-12-13\\/6579748a6d2bc.webp\",\"600-810\":\"2023-12-13\\/6579748a6d2bc.webp\"}', 0, 0, 1, NULL, '', '', '2023-12-13 02:38:26', '2023-12-13 09:08:26', 'SVR6og303Vm');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `message_id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `seller_id` varchar(255) DEFAULT NULL,
  `send_by` enum('user','seller') DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `admin_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`message_id`, `order_id`, `product`, `user_id`, `seller_id`, `send_by`, `message`, `seen`, `admin_seen`, `created_at`, `updated_at`) VALUES
(1, 'ODR6WLTNF035720', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hi', 1, 1, '2023-11-29 05:49:30', '2023-11-29 11:19:31'),
(2, 'ODR6WLTNF035720', 'P3j0EAd5zx4', 'U1W3ufw5Fah', 'SVR6og303Vm', 'seller', 'Hello', 0, 1, '2023-11-29 05:49:42', '2023-11-29 05:49:42'),
(3, 'ODRSJ3AFM124568', 'P3j0EAd5zx4', 'U1W3ufw5Fah', 'SVR6og303Vm', 'user', 'hi', 0, 1, '2023-11-29 13:29:27', '2023-11-29 13:29:27'),
(4, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hi', 1, 0, '2023-11-30 11:40:15', '2023-12-13 17:42:41'),
(5, 'ODRSHDLLB020487', 'P3j0EAd5zx4', 'U1W3ufw5Fah', 'SVR6og303Vm', 'seller', 'hi', 1, 0, '2023-12-01 09:53:16', '2023-12-01 15:24:03'),
(6, 'ODRSHDLLB020487', 'P3j0EAd5zx4', 'U1W3ufw5Fah', 'SVR6og303Vm', 'user', 'hi', 1, 0, '2023-12-01 09:54:10', '2023-12-01 15:24:19'),
(7, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 10:50:06', '2023-12-02 16:20:12'),
(8, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-02 10:50:23', '2023-12-02 16:22:28'),
(9, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 10:54:00', '2023-12-02 16:24:02'),
(10, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 11:00:19', '2023-12-02 16:30:23'),
(11, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 11:00:26', '2023-12-02 16:30:27'),
(12, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 11:04:01', '2023-12-13 17:42:41'),
(13, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 11:04:17', '2023-12-13 17:42:41'),
(14, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller', 1, 0, '2023-12-02 13:59:47', '2023-12-05 16:11:50'),
(15, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hello ', 1, 0, '2023-12-04 06:35:34', '2023-12-05 16:11:50'),
(16, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', '1', 1, 0, '2023-12-04 06:39:37', '2023-12-05 16:11:50'),
(17, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', '1', 1, 0, '2023-12-04 06:43:41', '2023-12-05 16:11:50'),
(18, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'how many days are bhai diwali wishes for the way you are you ui and you can do na ki nahi kar sakte kya cho me to am lagi hai to kya re ho raha h na bhai ki mera dost ko onTap hai to kya re ho gaya bro ', 1, 0, '2023-12-05 04:41:36', '2023-12-05 16:11:50'),
(19, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:12:47', '2023-12-08 07:12:47'),
(20, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:12:49', '2023-12-08 07:12:49'),
(21, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:12:50', '2023-12-08 07:12:50'),
(22, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:12:50', '2023-12-08 07:12:50'),
(23, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:12:50', '2023-12-08 07:12:50'),
(24, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:12:50', '2023-12-08 07:12:50'),
(25, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:13:10', '2023-12-08 07:13:10'),
(26, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:13:10', '2023-12-08 07:13:10'),
(27, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:13:11', '2023-12-08 07:13:11'),
(28, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:13:11', '2023-12-08 07:13:11'),
(29, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:13:13', '2023-12-08 07:13:13'),
(30, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-08 07:13:16', '2023-12-08 07:13:16'),
(31, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hello ', 0, 0, '2023-12-08 14:08:25', '2023-12-08 14:08:25'),
(32, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'hello ', 0, 0, '2023-12-08 14:09:18', '2023-12-08 14:09:18'),
(33, 'ODRLJNHP9050274', 'P3j0EAd5zx4', 'UkFJLO0ZU52', 'SVR6og303Vm', 'user', 'hello', 1, 0, '2023-12-09 11:36:02', '2023-12-13 12:53:25'),
(34, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hi', 1, 0, '2023-12-09 13:07:37', '2023-12-09 18:39:44'),
(35, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'seller', 1, 0, '2023-12-09 13:09:30', '2023-12-09 18:39:44'),
(36, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'seller', 'hi yes', 1, 0, '2023-12-09 13:09:47', '2023-12-09 18:39:48'),
(37, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'my order is ', 1, 0, '2023-12-09 13:10:11', '2023-12-09 18:40:12'),
(38, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', '23423423', 1, 0, '2023-12-09 13:10:16', '2023-12-09 18:40:18'),
(39, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'oihoiuh', 0, 0, '2023-12-09 13:49:19', '2023-12-09 13:49:19'),
(40, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hi', 0, 0, '2023-12-09 13:49:40', '2023-12-09 13:49:40'),
(41, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', '1', 0, 0, '2023-12-12 09:43:28', '2023-12-12 09:43:28'),
(42, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ????', 0, 0, '2023-12-12 09:44:42', '2023-12-12 09:44:42'),
(43, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ????', 0, 0, '2023-12-12 09:46:32', '2023-12-12 09:46:32'),
(44, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller', 0, 0, '2023-12-12 10:30:18', '2023-12-12 10:30:18'),
(45, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller 2', 0, 0, '2023-12-12 10:30:48', '2023-12-12 10:30:48'),
(46, 'ODRNRAPQ8043650', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ????', 0, 0, '2023-12-12 10:32:37', '2023-12-12 10:32:37'),
(47, 'ODR5BI1P809185', 'PyfvpXVKR2t', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ????', 1, 0, '2023-12-12 10:34:56', '2023-12-13 12:53:50'),
(48, 'ODRH3VGNR105716', 'P3j0EAd5zx4', 'U24a3IOsyvt', 'SVR6og303Vm', 'user', 'Hello Seller 2', 0, 0, '2023-12-12 10:35:36', '2023-12-12 10:35:36'),
(49, 'ODR5BI1P809185', 'PyfvpXVKR2t', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ????', 1, 0, '2023-12-12 10:42:01', '2023-12-13 12:53:50'),
(50, 'ODRGJELRQ04251', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ', 0, 0, '2023-12-12 10:47:22', '2023-12-12 10:47:22'),
(51, 'ODRGJELRQ04251', 'P3j0EAd5zx4', 'UJxdjAhqKTa', 'SVR6og303Vm', 'user', 'hello ????', 0, 0, '2023-12-12 10:47:32', '2023-12-12 10:47:32'),
(52, 'ODRLJNHP9050274', 'P3j0EAd5zx4', 'UkFJLO0ZU52', 'SVR6og303Vm', 'seller', 'hi', 0, 0, '2023-12-13 07:23:27', '2023-12-13 07:23:27'),
(53, 'ODR5BI1P809185', 'PyfvpXVKR2t', 'UJxdjAhqKTa', 'SVR6og303Vm', 'seller', 'hi', 0, 0, '2023-12-13 07:23:54', '2023-12-13 07:23:54'),
(54, 'ODRYFS2A3010321', 'PxZ3aQ9BvRF', 'U6Hd4kUeJSR', 'SVR6og303Vm', 'seller', 'HI', 0, 0, '2023-12-13 07:52:34', '2023-12-13 07:52:34'),
(55, 'ODRLJNHP9050274', 'P3j0EAd5zx4', 'UkFJLO0ZU52', 'SVR6og303Vm', 'seller', 'hi', 0, 0, '2023-12-13 09:27:13', '2023-12-13 09:27:13'),
(56, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:12:44', '2023-12-13 17:44:37'),
(57, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello', 1, 0, '2023-12-13 12:14:43', '2023-12-13 17:53:47'),
(58, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hi', 1, 0, '2023-12-13 12:14:49', '2023-12-13 17:53:47'),
(59, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello', 1, 0, '2023-12-13 12:16:12', '2023-12-13 17:53:47'),
(60, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:23:49', '2023-12-13 17:54:40'),
(61, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello', 1, 0, '2023-12-13 12:24:41', '2023-12-13 17:54:43'),
(62, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello', 1, 0, '2023-12-13 12:24:46', '2023-12-13 17:54:47'),
(63, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:25:19', '2023-12-13 17:55:20'),
(64, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:25:23', '2023-12-13 17:55:24'),
(65, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello', 1, 0, '2023-12-13 12:44:02', '2023-12-13 18:19:41'),
(66, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hi', 1, 0, '2023-12-13 12:44:04', '2023-12-13 18:19:41'),
(67, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'user', 'Hello', 1, 0, '2023-12-13 12:44:07', '2023-12-13 18:19:41'),
(68, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:49:44', '2023-12-13 18:19:46'),
(69, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:49:49', '2023-12-13 18:19:50'),
(70, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Heelo', 1, 0, '2023-12-13 12:50:19', '2023-12-13 18:20:20'),
(71, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'HI', 1, 0, '2023-12-13 12:50:22', '2023-12-13 18:20:24'),
(72, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:50:23', '2023-12-13 18:20:24'),
(73, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:50:24', '2023-12-13 18:20:26'),
(74, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:50:25', '2023-12-13 18:20:26'),
(75, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:50:26', '2023-12-13 18:20:28'),
(76, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:50:27', '2023-12-13 18:20:28'),
(77, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:50:28', '2023-12-13 18:20:30'),
(78, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:24', '2023-12-13 18:21:26'),
(79, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'HI', 1, 0, '2023-12-13 12:51:31', '2023-12-13 18:21:32'),
(80, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:40', '2023-12-13 18:21:42'),
(81, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:51:42', '2023-12-13 18:21:44'),
(82, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:43', '2023-12-13 18:21:44'),
(83, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:51:45', '2023-12-13 18:21:46'),
(84, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:46', '2023-12-13 18:21:48'),
(85, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'HI', 1, 0, '2023-12-13 12:51:47', '2023-12-13 18:21:48'),
(86, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:48', '2023-12-13 18:21:50'),
(87, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'hi', 1, 0, '2023-12-13 12:51:49', '2023-12-13 18:21:50'),
(88, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:50', '2023-12-13 18:21:52'),
(89, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:51:51', '2023-12-13 18:21:52'),
(90, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:51:52', '2023-12-13 18:21:54'),
(91, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'HI', 1, 0, '2023-12-13 12:51:53', '2023-12-13 18:21:54'),
(92, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:53:32', '2023-12-13 18:23:32'),
(93, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:54:16', '2023-12-14 10:11:27'),
(94, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:54:18', '2023-12-14 10:11:27'),
(95, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hi', 1, 0, '2023-12-13 12:54:19', '2023-12-14 10:11:27'),
(96, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'UV0cpGzEodR', 'SVR6og303Vm', 'seller', 'Hello', 1, 0, '2023-12-13 12:54:20', '2023-12-14 10:11:27'),
(97, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'U1W3ufw5Fah', 'SVR6og303Vm', 'user', 'hii', 0, 0, '2023-12-14 04:41:40', '2023-12-14 04:41:40'),
(98, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'U1W3ufw5Fah', 'SVR6og303Vm', 'user', 'this is chirag', 0, 0, '2023-12-14 04:41:51', '2023-12-14 04:41:51'),
(99, 'ODRCD39HS123133', 'P3j0EAd5zx4', 'U6Hd4kUeJSR', 'SVR6og303Vm', 'user', 'this is kamal', 0, 0, '2023-12-14 04:43:47', '2023-12-14 04:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(80) NOT NULL,
  `state_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_code`) VALUES
(1, 'Kolhapur', 21),
(2, 'Port Blair', 1),
(3, 'Adilabad', 2),
(4, 'Adoni', 2),
(5, 'Amadalavalasa', 2),
(6, 'Amalapuram', 2),
(7, 'Anakapalle', 2),
(8, 'Anantapur', 2),
(9, 'Badepalle', 2),
(10, 'Banganapalle', 2),
(11, 'Bapatla', 2),
(12, 'Bellampalle', 2),
(13, 'Bethamcherla', 2),
(14, 'Bhadrachalam', 2),
(15, 'Bhainsa', 2),
(16, 'Bheemunipatnam', 2),
(17, 'Bhimavaram', 2),
(18, 'Bhongir', 2),
(19, 'Bobbili', 2),
(20, 'Bodhan', 2),
(21, 'Chilakaluripet', 2),
(22, 'Chirala', 2),
(23, 'Chittoor', 2),
(24, 'Cuddapah', 2),
(25, 'Devarakonda', 2),
(26, 'Dharmavaram', 2),
(27, 'Eluru', 2),
(28, 'Farooqnagar', 2),
(29, 'Gadwal', 2),
(30, 'Gooty', 2),
(31, 'Gudivada', 2),
(32, 'Gudur', 2),
(33, 'Guntakal', 2),
(34, 'Guntur', 2),
(35, 'Hanuman Junction', 2),
(36, 'Hindupur', 2),
(37, 'Hyderabad', 2),
(38, 'Ichchapuram', 2),
(39, 'Jaggaiahpet', 2),
(40, 'Jagtial', 2),
(41, 'Jammalamadugu', 2),
(42, 'Jangaon', 2),
(43, 'Kadapa', 2),
(44, 'Kadiri', 2),
(45, 'Kagaznagar', 2),
(46, 'Kakinada', 2),
(47, 'Kalyandurg', 2),
(48, 'Kamareddy', 2),
(49, 'Kandukur', 2),
(50, 'Karimnagar', 2),
(51, 'Kavali', 2),
(52, 'Khammam', 2),
(53, 'Koratla', 2),
(54, 'Kothagudem', 2),
(55, 'Kothapeta', 2),
(56, 'Kovvur', 2),
(57, 'Kurnool', 2),
(58, 'Kyathampalle', 2),
(59, 'Macherla', 2),
(60, 'Machilipatnam', 2),
(61, 'Madanapalle', 2),
(62, 'Mahbubnagar', 2),
(63, 'Mancherial', 2),
(64, 'Mandamarri', 2),
(65, 'Mandapeta', 2),
(66, 'Manuguru', 2),
(67, 'Markapur', 2),
(68, 'Medak', 2),
(69, 'Miryalaguda', 2),
(70, 'Mogalthur', 2),
(71, 'Nagari', 2),
(72, 'Nagarkurnool', 2),
(73, 'Nandyal', 2),
(74, 'Narasapur', 2),
(75, 'Narasaraopet', 2),
(76, 'Narayanpet', 2),
(77, 'Narsipatnam', 2),
(78, 'Nellore', 2),
(79, 'Nidadavole', 2),
(80, 'Nirmal', 2),
(81, 'Nizamabad', 2),
(82, 'Nuzvid', 2),
(83, 'Ongole', 2),
(84, 'Palacole', 2),
(85, 'Palasa Kasibugga', 2),
(86, 'Palwancha', 2),
(87, 'Parvathipuram', 2),
(88, 'Pedana', 2),
(89, 'Peddapuram', 2),
(90, 'Pithapuram', 2),
(91, 'Pondur', 2),
(92, 'Ponnur', 2),
(93, 'Proddatur', 2),
(94, 'Punganur', 2),
(95, 'Puttur', 2),
(96, 'Rajahmundry', 2),
(97, 'Rajam', 2),
(98, 'Ramachandrapuram', 2),
(99, 'Ramagundam', 2),
(100, 'Rayachoti', 2),
(101, 'Rayadurg', 2),
(102, 'Renigunta', 2),
(103, 'Repalle', 2),
(104, 'Sadasivpet', 2),
(105, 'Salur', 2),
(106, 'Samalkot', 2),
(107, 'Sangareddy', 2),
(108, 'Sattenapalle', 2),
(109, 'Siddipet', 2),
(110, 'Singapur', 2),
(111, 'Sircilla', 2),
(112, 'Srikakulam', 2),
(113, 'Srikalahasti', 2),
(115, 'Suryapet', 2),
(116, 'Tadepalligudem', 2),
(117, 'Tadpatri', 2),
(118, 'Tandur', 2),
(119, 'Tanuku', 2),
(120, 'Tenali', 2),
(121, 'Tirupati', 2),
(122, 'Tuni', 2),
(123, 'Uravakonda', 2),
(124, 'Venkatagiri', 2),
(125, 'Vicarabad', 2),
(126, 'Vijayawada', 2),
(127, 'Vinukonda', 2),
(128, 'Visakhapatnam', 2),
(129, 'Vizianagaram', 2),
(130, 'Wanaparthy', 2),
(131, 'Warangal', 2),
(132, 'Yellandu', 2),
(133, 'Yemmiganur', 2),
(134, 'Yerraguntla', 2),
(135, 'Zahirabad', 2),
(136, 'Rajampet', 2),
(137, 'Along', 3),
(138, 'Bomdila', 3),
(139, 'Itanagar', 3),
(140, 'Naharlagun', 3),
(141, 'Pasighat', 3),
(142, 'Abhayapuri', 4),
(143, 'Amguri', 4),
(144, 'Anandnagaar', 4),
(145, 'Barpeta', 4),
(146, 'Barpeta Road', 4),
(147, 'Bilasipara', 4),
(148, 'Bongaigaon', 4),
(149, 'Dhekiajuli', 4),
(150, 'Dhubri', 4),
(151, 'Dibrugarh', 4),
(152, 'Digboi', 4),
(153, 'Diphu', 4),
(154, 'Dispur', 4),
(156, 'Gauripur', 4),
(157, 'Goalpara', 4),
(158, 'Golaghat', 4),
(159, 'Guwahati', 4),
(160, 'Haflong', 4),
(161, 'Hailakandi', 4),
(162, 'Hojai', 4),
(163, 'Jorhat', 4),
(164, 'Karimganj', 4),
(165, 'Kokrajhar', 4),
(166, 'Lanka', 4),
(167, 'Lumding', 4),
(168, 'Mangaldoi', 4),
(169, 'Mankachar', 4),
(170, 'Margherita', 4),
(171, 'Mariani', 4),
(172, 'Marigaon', 4),
(173, 'Nagaon', 4),
(174, 'Nalbari', 4),
(175, 'North Lakhimpur', 4),
(176, 'Rangia', 4),
(177, 'Sibsagar', 4),
(178, 'Silapathar', 4),
(179, 'Silchar', 4),
(180, 'Tezpur', 4),
(181, 'Tinsukia', 4),
(182, 'Amarpur', 5),
(183, 'Araria', 5),
(184, 'Areraj', 5),
(185, 'Arrah', 5),
(186, 'Asarganj', 5),
(187, 'Aurangabad', 5),
(188, 'Bagaha', 5),
(189, 'Bahadurganj', 5),
(190, 'Bairgania', 5),
(191, 'Bakhtiarpur', 5),
(192, 'Banka', 5),
(193, 'Banmankhi Bazar', 5),
(194, 'Barahiya', 5),
(195, 'Barauli', 5),
(196, 'Barbigha', 5),
(197, 'Barh', 5),
(198, 'Begusarai', 5),
(199, 'Behea', 5),
(200, 'Bettiah', 5),
(201, 'Bhabua', 5),
(202, 'Bhagalpur', 5),
(203, 'Bihar Sharif', 5),
(204, 'Bikramganj', 5),
(205, 'Bodh Gaya', 5),
(206, 'Buxar', 5),
(207, 'Chandan Bara', 5),
(208, 'Chanpatia', 5),
(209, 'Chhapra', 5),
(210, 'Colgong', 5),
(211, 'Dalsinghsarai', 5),
(212, 'Darbhanga', 5),
(213, 'Daudnagar', 5),
(214, 'Dehri-on-Sone', 5),
(215, 'Dhaka', 5),
(216, 'Dighwara', 5),
(217, 'Dumraon', 5),
(218, 'Fatwah', 5),
(219, 'Forbesganj', 5),
(220, 'Gaya', 5),
(221, 'Gogri Jamalpur', 5),
(222, 'Gopalganj', 5),
(223, 'Hajipur', 5),
(224, 'Hilsa', 5),
(225, 'Hisua', 5),
(226, 'Islampur', 5),
(227, 'Jagdispur', 5),
(228, 'Jamalpur', 5),
(229, 'Jamui', 5),
(230, 'Jehanabad', 5),
(231, 'Jhajha', 5),
(232, 'Jhanjharpur', 5),
(233, 'Jogabani', 5),
(234, 'Kanti', 5),
(235, 'Katihar', 5),
(236, 'Khagaria', 5),
(237, 'Kharagpur', 5),
(238, 'Kishanganj', 5),
(239, 'Lakhisarai', 5),
(240, 'Lalganj', 5),
(241, 'Madhepura', 5),
(242, 'Madhubani', 5),
(243, 'Maharajganj', 5),
(244, 'Mahnar Bazar', 5),
(245, 'Makhdumpur', 5),
(246, 'Maner', 5),
(247, 'Manihari', 5),
(248, 'Marhaura', 5),
(249, 'Masaurhi', 5),
(250, 'Mirganj', 5),
(251, 'Mokameh', 5),
(252, 'Motihari', 5),
(253, 'Motipur', 5),
(254, 'Munger', 5),
(255, 'Murliganj', 5),
(256, 'Muzaffarpur', 5),
(257, 'Narkatiaganj', 5),
(258, 'Naugachhia', 5),
(259, 'Nawada', 5),
(260, 'Nokha', 5),
(261, 'Patna', 5),
(262, 'Piro', 5),
(263, 'Purnia', 5),
(264, 'Rafiganj', 5),
(265, 'Rajgir', 5),
(266, 'Ramnagar', 5),
(267, 'Raxaul Bazar', 5),
(268, 'Revelganj', 5),
(269, 'Rosera', 5),
(270, 'Saharsa', 5),
(271, 'Samastipur', 5),
(272, 'Sasaram', 5),
(273, 'Sheikhpura', 5),
(274, 'Sheohar', 5),
(275, 'Sherghati', 5),
(276, 'Silao', 5),
(277, 'Sitamarhi', 5),
(278, 'Siwan', 5),
(279, 'Sonepur', 5),
(280, 'Sugauli', 5),
(281, 'Sultanganj', 5),
(282, 'Supaul', 5),
(283, 'Warisaliganj', 5),
(284, 'Ahiwara', 7),
(285, 'Akaltara', 7),
(286, 'Ambagarh Chowki', 7),
(287, 'Ambikapur', 7),
(288, 'Arang', 7),
(289, 'Bade Bacheli', 7),
(290, 'Balod', 7),
(291, 'Baloda Bazar', 7),
(292, 'Bemetra', 7),
(293, 'Bhatapara', 7),
(294, 'Bilaspur', 7),
(295, 'Birgaon', 7),
(296, 'Champa', 7),
(297, 'Chirmiri', 7),
(298, 'Dalli-Rajhara', 7),
(299, 'Dhamtari', 7),
(300, 'Dipka', 7),
(301, 'Dongargarh', 7),
(302, 'Durg-Bhilai Nagar', 7),
(303, 'Gobranawapara', 7),
(304, 'Jagdalpur', 7),
(305, 'Janjgir', 7),
(306, 'Jashpurnagar', 7),
(307, 'Kanker', 7),
(308, 'Kawardha', 7),
(309, 'Kondagaon', 7),
(310, 'Korba', 7),
(311, 'Mahasamund', 7),
(312, 'Mahendragarh', 7),
(313, 'Mungeli', 7),
(314, 'Naila Janjgir', 7),
(315, 'Raigarh', 7),
(316, 'Raipur', 7),
(317, 'Rajnandgaon', 7),
(318, 'Sakti', 7),
(319, 'Tilda Newra', 7),
(320, 'Amli', 8),
(321, 'Silvassa', 8),
(322, 'Daman and Diu', 9),
(323, 'Daman and Diu', 9),
(324, 'Asola', 10),
(325, 'Delhi', 10),
(326, 'Aldona', 11),
(327, 'Curchorem Cacora', 11),
(328, 'Madgaon', 11),
(329, 'Mapusa', 11),
(330, 'Margao', 11),
(331, 'Marmagao', 11),
(332, 'Panaji', 11),
(333, 'Ahmedabad', 12),
(334, 'Amreli', 12),
(335, 'Anand', 12),
(336, 'Ankleshwar', 12),
(337, 'Bharuch', 12),
(338, 'Bhavnagar', 12),
(339, 'Bhuj', 12),
(340, 'Cambay', 12),
(341, 'Dahod', 12),
(342, 'Deesa', 12),
(344, 'Dholka', 12),
(345, 'Gandhinagar', 12),
(346, 'Godhra', 12),
(347, 'Himatnagar', 12),
(348, 'Idar', 12),
(349, 'Jamnagar', 12),
(350, 'Junagadh', 12),
(351, 'Kadi', 12),
(352, 'Kalavad', 12),
(353, 'Kalol', 12),
(354, 'Kapadvanj', 12),
(355, 'Karjan', 12),
(356, 'Keshod', 12),
(357, 'Khambhalia', 12),
(358, 'Khambhat', 12),
(359, 'Kheda', 12),
(360, 'Khedbrahma', 12),
(361, 'Kheralu', 12),
(362, 'Kodinar', 12),
(363, 'Lathi', 12),
(364, 'Limbdi', 12),
(365, 'Lunawada', 12),
(366, 'Mahesana', 12),
(367, 'Mahuva', 12),
(368, 'Manavadar', 12),
(369, 'Mandvi', 12),
(370, 'Mangrol', 12),
(371, 'Mansa', 12),
(372, 'Mehmedabad', 12),
(373, 'Modasa', 12),
(374, 'Morvi', 12),
(375, 'Nadiad', 12),
(376, 'Navsari', 12),
(377, 'Padra', 12),
(378, 'Palanpur', 12),
(379, 'Palitana', 12),
(380, 'Pardi', 12),
(381, 'Patan', 12),
(382, 'Petlad', 12),
(383, 'Porbandar', 12),
(384, 'Radhanpur', 12),
(385, 'Rajkot', 12),
(386, 'Rajpipla', 12),
(387, 'Rajula', 12),
(388, 'Ranavav', 12),
(389, 'Rapar', 12),
(390, 'Salaya', 12),
(391, 'Sanand', 12),
(392, 'Savarkundla', 12),
(393, 'Sidhpur', 12),
(394, 'Sihor', 12),
(395, 'Songadh', 12),
(396, 'Surat', 12),
(397, 'Talaja', 12),
(398, 'Thangadh', 12),
(399, 'Tharad', 12),
(400, 'Umbergaon', 12),
(401, 'Umreth', 12),
(402, 'Una', 12),
(403, 'Unjha', 12),
(404, 'Upleta', 12),
(405, 'Vadnagar', 12),
(406, 'Vadodara', 12),
(407, 'Valsad', 12),
(408, 'Vapi', 12),
(409, 'Vapi', 12),
(410, 'Veraval', 12),
(411, 'Vijapur', 12),
(412, 'Viramgam', 12),
(413, 'Visnagar', 12),
(414, 'Vyara', 12),
(415, 'Wadhwan', 12),
(416, 'Wankaner', 12),
(417, 'Adalaj', 12),
(418, 'Adityana', 12),
(419, 'Alang', 12),
(420, 'Ambaji', 12),
(421, 'Ambaliyasan', 12),
(422, 'Andada', 12),
(423, 'Anjar', 12),
(424, 'Anklav', 12),
(425, 'Antaliya', 12),
(426, 'Arambhada', 12),
(427, 'Atul', 12),
(428, 'Ballabhgarh', 13),
(429, 'Ambala', 13),
(430, 'Ambala', 13),
(431, 'Asankhurd', 13),
(432, 'Assandh', 13),
(433, 'Ateli', 13),
(434, 'Babiyal', 13),
(435, 'Bahadurgarh', 13),
(436, 'Barwala', 13),
(437, 'Bhiwani', 13),
(438, 'Charkhi Dadri', 13),
(439, 'Cheeka', 13),
(440, 'Ellenabad 2', 13),
(441, 'Faridabad', 13),
(442, 'Fatehabad', 13),
(443, 'Ganaur', 13),
(444, 'Gharaunda', 13),
(445, 'Gohana', 13),
(446, 'Gurgaon', 13),
(447, 'Haibat(Yamuna Nagar)', 13),
(448, 'Hansi', 13),
(449, 'Hisar', 13),
(450, 'Hodal', 13),
(451, 'Jhajjar', 13),
(452, 'Jind', 13),
(453, 'Kaithal', 13),
(454, 'Kalan Wali', 13),
(455, 'Kalka', 13),
(456, 'Karnal', 13),
(457, 'Ladwa', 13),
(458, 'Mahendragarh', 13),
(459, 'Mandi Dabwali', 13),
(460, 'Narnaul', 13),
(461, 'Narwana', 13),
(462, 'Palwal', 13),
(463, 'Panchkula', 13),
(464, 'Panipat', 13),
(465, 'Pehowa', 13),
(466, 'Pinjore', 13),
(467, 'Rania', 13),
(468, 'Ratia', 13),
(469, 'Rewari', 13),
(470, 'Rohtak', 13),
(471, 'Safidon', 13),
(472, 'Samalkha', 13),
(473, 'Shahbad', 13),
(474, 'Sirsa', 13),
(475, 'Sohna', 13),
(476, 'Sonipat', 13),
(477, 'Taraori', 13),
(478, 'Thanesar', 13),
(479, 'Tohana', 13),
(480, 'Yamunanagar', 13),
(481, 'Arki', 14),
(482, 'Baddi', 14),
(483, 'Bilaspur', 14),
(484, 'Chamba', 14),
(485, 'Dalhousie', 14),
(486, 'Dharamsala', 14),
(487, 'Hamirpur', 14),
(488, 'Mandi', 14),
(489, 'Nahan', 14),
(490, 'Shimla', 14),
(491, 'Solan', 14),
(492, 'Sundarnagar', 14),
(493, 'Jammu', 15),
(494, 'Achabbal', 15),
(495, 'Akhnoor', 15),
(496, 'Anantnag', 15),
(497, 'Arnia', 15),
(498, 'Awantipora', 15),
(499, 'Bandipore', 15),
(500, 'Baramula', 15),
(501, 'Kathua', 15),
(502, 'Leh', 15),
(503, 'Punch', 15),
(504, 'Rajauri', 15),
(505, 'Sopore', 15),
(506, 'Srinagar', 15),
(507, 'Udhampur', 15),
(508, 'Amlabad', 16),
(509, 'Ara', 16),
(510, 'Barughutu', 16),
(511, 'Bokaro Steel City', 16),
(512, 'Chaibasa', 16),
(513, 'Chakradharpur', 16),
(514, 'Chandrapura', 16),
(515, 'Chatra', 16),
(516, 'Chirkunda', 16),
(517, 'Churi', 16),
(518, 'Daltonganj', 16),
(519, 'Deoghar', 16),
(520, 'Dhanbad', 16),
(521, 'Dumka', 16),
(522, 'Garhwa', 16),
(523, 'Ghatshila', 16),
(524, 'Giridih', 16),
(525, 'Godda', 16),
(526, 'Gomoh', 16),
(527, 'Gumia', 16),
(528, 'Gumla', 16),
(529, 'Hazaribag', 16),
(530, 'Hussainabad', 16),
(531, 'Jamshedpur', 16),
(532, 'Jamtara', 16),
(533, 'Jhumri Tilaiya', 16),
(534, 'Khunti', 16),
(535, 'Lohardaga', 16),
(536, 'Madhupur', 16),
(537, 'Mihijam', 16),
(538, 'Musabani', 16),
(539, 'Pakaur', 16),
(540, 'Patratu', 16),
(541, 'Phusro', 16),
(542, 'Ramngarh', 16),
(543, 'Ranchi', 16),
(544, 'Sahibganj', 16),
(545, 'Saunda', 16),
(546, 'Simdega', 16),
(547, 'Tenu Dam-cum- Kathhara', 16),
(548, 'Arasikere', 17),
(549, 'Bangalore', 17),
(550, 'Belgaum', 17),
(551, 'Bellary', 17),
(552, 'Chamrajnagar', 17),
(553, 'Chikkaballapur', 17),
(554, 'Chintamani', 17),
(555, 'Chitradurga', 17),
(556, 'Gulbarga', 17),
(557, 'Gundlupet', 17),
(558, 'Hassan', 17),
(559, 'Hospet', 17),
(560, 'Hubli', 17),
(561, 'Karkala', 17),
(562, 'Karwar', 17),
(563, 'Kolar', 17),
(564, 'Kota', 17),
(565, 'Lakshmeshwar', 17),
(566, 'Lingsugur', 17),
(567, 'Maddur', 17),
(568, 'Madhugiri', 17),
(569, 'Madikeri', 17),
(570, 'Magadi', 17),
(571, 'Mahalingpur', 17),
(572, 'Malavalli', 17),
(573, 'Malur', 17),
(574, 'Mandya', 17),
(575, 'Mangalore', 17),
(576, 'Manvi', 17),
(577, 'Mudalgi', 17),
(578, 'Mudbidri', 17),
(579, 'Muddebihal', 17),
(580, 'Mudhol', 17),
(581, 'Mulbagal', 17),
(582, 'Mundargi', 17),
(583, 'Mysore', 17),
(584, 'Nanjangud', 17),
(585, 'Pavagada', 17),
(586, 'Puttur', 17),
(587, 'Rabkavi Banhatti', 17),
(588, 'Raichur', 17),
(589, 'Ramanagaram', 17),
(590, 'Ramdurg', 17),
(591, 'Ranibennur', 17),
(592, 'Robertson Pet', 17),
(593, 'Ron', 17),
(594, 'Sadalgi', 17),
(595, 'Sagar', 17),
(596, 'Sakleshpur', 17),
(597, 'Sandur', 17),
(598, 'Sankeshwar', 17),
(599, 'Saundatti-Yellamma', 17),
(600, 'Savanur', 17),
(601, 'Sedam', 17),
(602, 'Shahabad', 17),
(603, 'Shahpur', 17),
(604, 'Shiggaon', 17),
(605, 'Shikapur', 17),
(606, 'Shimoga', 17),
(607, 'Shorapur', 17),
(608, 'Shrirangapattana', 17),
(609, 'Sidlaghatta', 17),
(610, 'Sindgi', 17),
(611, 'Sindhnur', 17),
(612, 'Sira', 17),
(613, 'Sirsi', 17),
(614, 'Siruguppa', 17),
(615, 'Srinivaspur', 17),
(616, 'Talikota', 17),
(617, 'Tarikere', 17),
(618, 'Tekkalakota', 17),
(619, 'Terdal', 17),
(620, 'Tiptur', 17),
(621, 'Tumkur', 17),
(622, 'Udupi', 17),
(623, 'Vijayapura', 17),
(624, 'Wadi', 17),
(625, 'Yadgir', 17),
(626, 'Adoor', 18),
(627, 'Akathiyoor', 18),
(628, 'Alappuzha', 18),
(629, 'Ancharakandy', 18),
(630, 'Aroor', 18),
(631, 'Ashtamichira', 18),
(632, 'Attingal', 18),
(633, 'Avinissery', 18),
(634, 'Chalakudy', 18),
(635, 'Changanassery', 18),
(636, 'Chendamangalam', 18),
(637, 'Chengannur', 18),
(638, 'Cherthala', 18),
(639, 'Cheruthazham', 18),
(640, 'Chittur-Thathamangalam', 18),
(641, 'Chockli', 18),
(642, 'Erattupetta', 18),
(643, 'Guruvayoor', 18),
(644, 'Irinjalakuda', 18),
(645, 'Kadirur', 18),
(646, 'Kalliasseri', 18),
(647, 'Kalpetta', 18),
(648, 'Kanhangad', 18),
(649, 'Kanjikkuzhi', 18),
(650, 'Kannur', 18),
(651, 'Kasaragod', 18),
(652, 'Kayamkulam', 18),
(653, 'Kochi', 18),
(654, 'Kodungallur', 18),
(655, 'Kollam', 18),
(656, 'Koothuparamba', 18),
(657, 'Kothamangalam', 18),
(658, 'Kottayam', 18),
(659, 'Kozhikode', 18),
(660, 'Kunnamkulam', 18),
(661, 'Malappuram', 18),
(662, 'Mattannur', 18),
(663, 'Mavelikkara', 18),
(664, 'Mavoor', 18),
(665, 'Muvattupuzha', 18),
(666, 'Nedumangad', 18),
(667, 'Neyyattinkara', 18),
(668, 'Ottappalam', 18),
(669, 'Palai', 18),
(670, 'Palakkad', 18),
(671, 'Panniyannur', 18),
(672, 'Pappinisseri', 18),
(673, 'Paravoor', 18),
(674, 'Pathanamthitta', 18),
(675, 'Payyannur', 18),
(676, 'Peringathur', 18),
(677, 'Perinthalmanna', 18),
(678, 'Perumbavoor', 18),
(679, 'Ponnani', 18),
(680, 'Punalur', 18),
(681, 'Quilandy', 18),
(682, 'Shoranur', 18),
(683, 'Taliparamba', 18),
(684, 'Thiruvalla', 18),
(685, 'Thiruvananthapuram', 18),
(686, 'Thodupuzha', 18),
(687, 'Thrissur', 18),
(688, 'Tirur', 18),
(689, 'Vadakara', 18),
(690, 'Vaikom', 18),
(691, 'Varkala', 18),
(692, 'Kavaratti', 19),
(693, 'Ashok Nagar', 20),
(694, 'Balaghat', 20),
(695, 'Betul', 20),
(696, 'Bhopal', 20),
(697, 'Burhanpur', 20),
(698, 'Chhatarpur', 20),
(699, 'Dabra', 20),
(700, 'Datia', 20),
(701, 'Dewas', 20),
(702, 'Dhar', 20),
(703, 'Fatehabad', 20),
(704, 'Gwalior', 20),
(705, 'Indore', 20),
(706, 'Itarsi', 20),
(707, 'Jabalpur', 20),
(708, 'Katni', 20),
(709, 'Kotma', 20),
(710, 'Lahar', 20),
(711, 'Lundi', 20),
(712, 'Maharajpur', 20),
(713, 'Mahidpur', 20),
(714, 'Maihar', 20),
(715, 'Malajkhand', 20),
(716, 'Manasa', 20),
(717, 'Manawar', 20),
(718, 'Mandideep', 20),
(719, 'Mandla', 20),
(720, 'Mandsaur', 20),
(721, 'Mauganj', 20),
(722, 'Mhow Cantonment', 20),
(723, 'Mhowgaon', 20),
(724, 'Morena', 20),
(725, 'Multai', 20),
(726, 'Murwara', 20),
(727, 'Nagda', 20),
(728, 'Nainpur', 20),
(729, 'Narsinghgarh', 20),
(730, 'Narsinghgarh', 20),
(731, 'Neemuch', 20),
(732, 'Nepanagar', 20),
(733, 'Niwari', 20),
(734, 'Nowgong', 20),
(735, 'Nowrozabad', 20),
(736, 'Pachore', 20),
(737, 'Pali', 20),
(738, 'Panagar', 20),
(739, 'Pandhurna', 20),
(740, 'Panna', 20),
(741, 'Pasan', 20),
(742, 'Pipariya', 20),
(743, 'Pithampur', 20),
(744, 'Porsa', 20),
(745, 'Prithvipur', 20),
(746, 'Raghogarh-Vijaypur', 20),
(747, 'Rahatgarh', 20),
(748, 'Raisen', 20),
(749, 'Rajgarh', 20),
(750, 'Ratlam', 20),
(751, 'Rau', 20),
(752, 'Rehli', 20),
(753, 'Rewa', 20),
(754, 'Sabalgarh', 20),
(755, 'Sagar', 20),
(756, 'Sanawad', 20),
(757, 'Sarangpur', 20),
(758, 'Sarni', 20),
(759, 'Satna', 20),
(760, 'Sausar', 20),
(761, 'Sehore', 20),
(762, 'Sendhwa', 20),
(763, 'Seoni', 20),
(764, 'Seoni-Malwa', 20),
(765, 'Shahdol', 20),
(766, 'Shajapur', 20),
(767, 'Shamgarh', 20),
(768, 'Sheopur', 20),
(769, 'Shivpuri', 20),
(770, 'Shujalpur', 20),
(771, 'Sidhi', 20),
(772, 'Sihora', 20),
(773, 'Singrauli', 20),
(774, 'Sironj', 20),
(775, 'Sohagpur', 20),
(776, 'Tarana', 20),
(777, 'Tikamgarh', 20),
(778, 'Ujhani', 20),
(779, 'Ujjain', 20),
(780, 'Umaria', 20),
(781, 'Vidisha', 20),
(782, 'Wara Seoni', 20),
(783, 'Ahmednagar', 21),
(784, 'Akola', 21),
(785, 'Amravati', 21),
(786, 'Aurangabad', 21),
(787, 'Baramati', 21),
(788, 'Chalisgaon', 21),
(789, 'Chinchani', 21),
(790, 'Devgarh', 21),
(791, 'Dhule', 21),
(792, 'Dombivli', 21),
(793, 'Durgapur', 21),
(794, 'Ichalkaranji', 21),
(795, 'Jalna', 21),
(796, 'Kalyan', 21),
(797, 'Latur', 21),
(798, 'Loha', 21),
(799, 'Lonar', 21),
(800, 'Lonavla', 21),
(801, 'Mahad', 21),
(802, 'Mahuli', 21),
(803, 'Malegaon', 21),
(804, 'Malkapur', 21),
(805, 'Manchar', 21),
(806, 'Mangalvedhe', 21),
(807, 'Mangrulpir', 21),
(808, 'Manjlegaon', 21),
(809, 'Manmad', 21),
(810, 'Manwath', 21),
(811, 'Mehkar', 21),
(812, 'Mhaswad', 21),
(813, 'Miraj', 21),
(814, 'Morshi', 21),
(815, 'Mukhed', 21),
(816, 'Mul', 21),
(817, 'Mumbai', 21),
(818, 'Murtijapur', 21),
(819, 'Nagpur', 21),
(820, 'Nalasopara', 21),
(821, 'Nanded-Waghala', 21),
(822, 'Nandgaon', 21),
(823, 'Nandura', 21),
(824, 'Nandurbar', 21),
(825, 'Narkhed', 21),
(826, 'Nashik', 21),
(827, 'Navi Mumbai', 21),
(828, 'Nawapur', 21),
(829, 'Nilanga', 21),
(830, 'Osmanabad', 21),
(831, 'Ozar', 21),
(832, 'Pachora', 21),
(833, 'Paithan', 21),
(834, 'Palghar', 21),
(835, 'Pandharkaoda', 21),
(836, 'Pandharpur', 21),
(837, 'Panvel', 21),
(838, 'Parbhani', 21),
(839, 'Parli', 21),
(840, 'Parola', 21),
(841, 'Partur', 21),
(842, 'Pathardi', 21),
(843, 'Pathri', 21),
(844, 'Patur', 21),
(845, 'Pauni', 21),
(846, 'Pen', 21),
(847, 'Phaltan', 21),
(848, 'Pulgaon', 21),
(849, 'Pune', 21),
(850, 'Purna', 21),
(851, 'Pusad', 21),
(852, 'Rahuri', 21),
(853, 'Rajura', 21),
(854, 'Ramtek', 21),
(855, 'Ratnagiri', 21),
(856, 'Raver', 21),
(857, 'Risod', 21),
(858, 'Sailu', 21),
(859, 'Sangamner', 21),
(860, 'Sangli', 21),
(861, 'Sangole', 21),
(862, 'Sasvad', 21),
(863, 'Satana', 21),
(864, 'Satara', 21),
(865, 'Savner', 21),
(866, 'Sawantwadi', 21),
(867, 'Shahade', 21),
(868, 'Shegaon', 21),
(869, 'Shendurjana', 21),
(870, 'Shirdi', 21),
(871, 'Shirpur-Warwade', 21),
(872, 'Shirur', 21),
(873, 'Shrigonda', 21),
(874, 'Shrirampur', 21),
(875, 'Sillod', 21),
(876, 'Sinnar', 21),
(877, 'Solapur', 21),
(878, 'Soyagaon', 21),
(879, 'Talegaon Dabhade', 21),
(880, 'Talode', 21),
(881, 'Tasgaon', 21),
(882, 'Tirora', 21),
(883, 'Tuljapur', 21),
(884, 'Tumsar', 21),
(885, 'Uran', 21),
(886, 'Uran Islampur', 21),
(887, 'Wadgaon Road', 21),
(888, 'Wai', 21),
(889, 'Wani', 21),
(890, 'Wardha', 21),
(891, 'Warora', 21),
(892, 'Warud', 21),
(893, 'Washim', 21),
(894, 'Yevla', 21),
(895, 'Uchgaon', 21),
(896, 'Udgir', 21),
(897, 'Umarga', 21),
(898, 'Umarkhed', 21),
(899, 'Umred', 21),
(900, 'Vadgaon Kasba', 21),
(901, 'Vaijapur', 21),
(902, 'Vasai', 21),
(903, 'Virar', 21),
(904, 'Vita', 21),
(905, 'Yavatmal', 21),
(906, 'Yawal', 21),
(907, 'Imphal', 22),
(908, 'Kakching', 22),
(909, 'Lilong', 22),
(910, 'Mayang Imphal', 22),
(911, 'Thoubal', 22),
(912, 'Jowai', 23),
(913, 'Nongstoin', 23),
(914, 'Shillong', 23),
(915, 'Tura', 23),
(916, 'Aizawl', 24),
(917, 'Champhai', 24),
(918, 'Lunglei', 24),
(919, 'Saiha', 24),
(920, 'Dimapur', 25),
(921, 'Kohima', 25),
(922, 'Mokokchung', 25),
(923, 'Tuensang', 25),
(924, 'Wokha', 25),
(925, 'Zunheboto', 25),
(950, 'Anandapur', 26),
(951, 'Anugul', 26),
(952, 'Asika', 26),
(953, 'Balangir', 26),
(954, 'Balasore', 26),
(955, 'Baleshwar', 26),
(956, 'Bamra', 26),
(957, 'Barbil', 26),
(958, 'Bargarh', 26),
(959, 'Bargarh', 26),
(960, 'Baripada', 26),
(961, 'Basudebpur', 26),
(962, 'Belpahar', 26),
(963, 'Bhadrak', 26),
(964, 'Bhawanipatna', 26),
(965, 'Bhuban', 26),
(966, 'Bhubaneswar', 26),
(967, 'Biramitrapur', 26),
(968, 'Brahmapur', 26),
(969, 'Brajrajnagar', 26),
(970, 'Byasanagar', 26),
(971, 'Cuttack', 26),
(972, 'Debagarh', 26),
(973, 'Dhenkanal', 26),
(974, 'Gunupur', 26),
(975, 'Hinjilicut', 26),
(976, 'Jagatsinghapur', 26),
(977, 'Jajapur', 26),
(978, 'Jaleswar', 26),
(979, 'Jatani', 26),
(980, 'Jeypur', 26),
(981, 'Jharsuguda', 26),
(982, 'Joda', 26),
(983, 'Kantabanji', 26),
(984, 'Karanjia', 26),
(985, 'Kendrapara', 26),
(986, 'Kendujhar', 26),
(987, 'Khordha', 26),
(988, 'Koraput', 26),
(989, 'Malkangiri', 26),
(990, 'Nabarangapur', 26),
(991, 'Paradip', 26),
(992, 'Parlakhemundi', 26),
(993, 'Pattamundai', 26),
(994, 'Phulabani', 26),
(995, 'Puri', 26),
(996, 'Rairangpur', 26),
(997, 'Rajagangapur', 26),
(998, 'Raurkela', 26),
(999, 'Rayagada', 26),
(1000, 'Sambalpur', 26),
(1001, 'Soro', 26),
(1002, 'Sunabeda', 26),
(1003, 'Sundargarh', 26),
(1004, 'Talcher', 26),
(1005, 'Titlagarh', 26),
(1006, 'Umarkote', 26),
(1007, 'Karaikal', 27),
(1008, 'Mahe', 27),
(1009, 'Puducherry', 27),
(1010, 'Yanam', 27),
(1011, 'Ahmedgarh', 28),
(1012, 'Amritsar', 28),
(1013, 'Barnala', 28),
(1014, 'Batala', 28),
(1015, 'Bathinda', 28),
(1016, 'Bhagha Purana', 28),
(1017, 'Budhlada', 28),
(1018, 'Chandigarh', 28),
(1019, 'Dasua', 28),
(1020, 'Dhuri', 28),
(1021, 'Dinanagar', 28),
(1022, 'Faridkot', 28),
(1023, 'Fazilka', 28),
(1024, 'Firozpur', 28),
(1025, 'Firozpur Cantt.', 28),
(1026, 'Giddarbaha', 28),
(1027, 'Gobindgarh', 28),
(1028, 'Gurdaspur', 28),
(1029, 'Hoshiarpur', 28),
(1030, 'Jagraon', 28),
(1031, 'Jaitu', 28),
(1032, 'Jalalabad', 28),
(1033, 'Jalandhar', 28),
(1034, 'Jalandhar Cantt.', 28),
(1035, 'Jandiala', 28),
(1036, 'Kapurthala', 28),
(1037, 'Karoran', 28),
(1038, 'Kartarpur', 28),
(1039, 'Khanna', 28),
(1040, 'Kharar', 28),
(1041, 'Kot Kapura', 28),
(1042, 'Kurali', 28),
(1043, 'Longowal', 28),
(1044, 'Ludhiana', 28),
(1045, 'Malerkotla', 28),
(1046, 'Malout', 28),
(1047, 'Mansa', 28),
(1048, 'Maur', 28),
(1049, 'Moga', 28),
(1050, 'Mohali', 28),
(1051, 'Morinda', 28),
(1052, 'Mukerian', 28),
(1053, 'Muktsar', 28),
(1054, 'Nabha', 28),
(1055, 'Nakodar', 28),
(1056, 'Nangal', 28),
(1057, 'Nawanshahr', 28),
(1058, 'Pathankot', 28),
(1059, 'Patiala', 28),
(1060, 'Patran', 28),
(1061, 'Patti', 28),
(1062, 'Phagwara', 28),
(1063, 'Phillaur', 28),
(1064, 'Qadian', 28),
(1065, 'Raikot', 28),
(1066, 'Rajpura', 28),
(1067, 'Rampura Phul', 28),
(1068, 'Rupnagar', 28),
(1069, 'Samana', 28),
(1070, 'Sangrur', 28),
(1071, 'Sirhind Fatehgarh Sahib', 28),
(1072, 'Sujanpur', 28),
(1073, 'Sunam', 28),
(1074, 'Talwara', 28),
(1075, 'Tarn Taran', 28),
(1076, 'Urmar Tanda', 28),
(1077, 'Zira', 28),
(1078, 'Zirakpur', 28),
(1079, 'Bali', 29),
(1080, 'Banswara', 29),
(1081, 'Ajmer', 29),
(1082, 'Alwar', 29),
(1083, 'Bandikui', 29),
(1084, 'Baran', 29),
(1085, 'Barmer', 29),
(1086, 'Bikaner', 29),
(1087, 'Fatehpur', 29),
(1088, 'Jaipur', 29),
(1089, 'Jaisalmer', 29),
(1090, 'Jodhpur', 29),
(1091, 'Kota', 29),
(1092, 'Lachhmangarh', 29),
(1093, 'Ladnu', 29),
(1094, 'Lakheri', 29),
(1095, 'Lalsot', 29),
(1096, 'Losal', 29),
(1097, 'Makrana', 29),
(1098, 'Malpura', 29),
(1099, 'Mandalgarh', 29),
(1100, 'Mandawa', 29),
(1101, 'Mangrol', 29),
(1102, 'Merta City', 29),
(1103, 'Mount Abu', 29),
(1104, 'Nadbai', 29),
(1105, 'Nagar', 29),
(1106, 'Nagaur', 29),
(1107, 'Nargund', 29),
(1108, 'Nasirabad', 29),
(1109, 'Nathdwara', 29),
(1110, 'Navalgund', 29),
(1111, 'Nawalgarh', 29),
(1112, 'Neem-Ka-Thana', 29),
(1113, 'Nelamangala', 29),
(1114, 'Nimbahera', 29),
(1115, 'Nipani', 29),
(1116, 'Niwai', 29),
(1117, 'Nohar', 29),
(1118, 'Nokha', 29),
(1119, 'Pali', 29),
(1120, 'Phalodi', 29),
(1121, 'Phulera', 29),
(1122, 'Pilani', 29),
(1123, 'Pilibanga', 29),
(1124, 'Pindwara', 29),
(1125, 'Pipar City', 29),
(1126, 'Prantij', 29),
(1127, 'Pratapgarh', 29),
(1128, 'Raisinghnagar', 29),
(1129, 'Rajakhera', 29),
(1130, 'Rajaldesar', 29),
(1131, 'Rajgarh (Alwar)', 29),
(1132, 'Rajgarh (Churu', 29),
(1133, 'Rajsamand', 29),
(1134, 'Ramganj Mandi', 29),
(1135, 'Ramngarh', 29),
(1136, 'Ratangarh', 29),
(1137, 'Rawatbhata', 29),
(1138, 'Rawatsar', 29),
(1139, 'Reengus', 29),
(1140, 'Sadri', 29),
(1141, 'Sadulshahar', 29),
(1142, 'Sagwara', 29),
(1143, 'Sambhar', 29),
(1144, 'Sanchore', 29),
(1145, 'Sangaria', 29),
(1146, 'Sardarshahar', 29),
(1147, 'Sawai Madhopur', 29),
(1148, 'Shahpura', 29),
(1149, 'Shahpura', 29),
(1150, 'Sheoganj', 29),
(1151, 'Sikar', 29),
(1152, 'Sirohi', 29),
(1153, 'Sojat', 29),
(1154, 'Sri Madhopur', 29),
(1155, 'Sujangarh', 29),
(1156, 'Sumerpur', 29),
(1157, 'Suratgarh', 29),
(1158, 'Taranagar', 29),
(1159, 'Todabhim', 29),
(1160, 'Todaraisingh', 29),
(1161, 'Tonk', 29),
(1162, 'Udaipur', 29),
(1163, 'Udaipurwati', 29),
(1164, 'Vijainagar', 29),
(1165, 'Gangtok', 30),
(1166, 'Calcutta', 36),
(1167, 'Arakkonam', 31),
(1168, 'Arcot', 31),
(1169, 'Aruppukkottai', 31),
(1170, 'Bhavani', 31),
(1171, 'Chengalpattu', 31),
(1172, 'Chennai', 31),
(1173, 'Chinna salem', 31),
(1174, 'Coimbatore', 31),
(1175, 'Coonoor', 31),
(1176, 'Cuddalore', 31),
(1177, 'Dharmapuri', 31),
(1178, 'Dindigul', 31),
(1179, 'Erode', 31),
(1180, 'Gudalur', 31),
(1181, 'Gudalur', 31),
(1182, 'Gudalur', 31),
(1183, 'Kanchipuram', 31),
(1184, 'Karaikudi', 31),
(1185, 'Karungal', 31),
(1186, 'Karur', 31),
(1187, 'Kollankodu', 31),
(1188, 'Lalgudi', 31),
(1189, 'Madurai', 31),
(1190, 'Nagapattinam', 31),
(1191, 'Nagercoil', 31),
(1192, 'Namagiripettai', 31),
(1193, 'Namakkal', 31),
(1194, 'Nandivaram-Guduvancheri', 31),
(1195, 'Nanjikottai', 31),
(1196, 'Natham', 31),
(1197, 'Nellikuppam', 31),
(1198, 'Neyveli', 31),
(1199, 'O\' Valley', 31),
(1200, 'Oddanchatram', 31),
(1201, 'P.N.Patti', 31),
(1202, 'Pacode', 31),
(1203, 'Padmanabhapuram', 31),
(1204, 'Palani', 31),
(1205, 'Palladam', 31),
(1206, 'Pallapatti', 31),
(1207, 'Pallikonda', 31),
(1208, 'Panagudi', 31),
(1209, 'Panruti', 31),
(1210, 'Paramakudi', 31),
(1211, 'Parangipettai', 31),
(1212, 'Pattukkottai', 31),
(1213, 'Perambalur', 31),
(1214, 'Peravurani', 31),
(1215, 'Periyakulam', 31),
(1216, 'Periyasemur', 31),
(1217, 'Pernampattu', 31),
(1218, 'Pollachi', 31),
(1219, 'Polur', 31),
(1220, 'Ponneri', 31),
(1221, 'Pudukkottai', 31),
(1222, 'Pudupattinam', 31),
(1223, 'Puliyankudi', 31),
(1224, 'Punjaipugalur', 31),
(1225, 'Rajapalayam', 31),
(1226, 'Ramanathapuram', 31),
(1227, 'Rameshwaram', 31),
(1228, 'Rasipuram', 31),
(1229, 'Salem', 31),
(1230, 'Sankarankoil', 31),
(1231, 'Sankari', 31),
(1232, 'Sathyamangalam', 31),
(1233, 'Sattur', 31),
(1234, 'Shenkottai', 31),
(1235, 'Sholavandan', 31),
(1236, 'Sholingur', 31),
(1237, 'Sirkali', 31),
(1238, 'Sivaganga', 31),
(1239, 'Sivagiri', 31),
(1240, 'Sivakasi', 31),
(1241, 'Srivilliputhur', 31),
(1242, 'Surandai', 31),
(1243, 'Suriyampalayam', 31),
(1244, 'Tenkasi', 31),
(1245, 'Thammampatti', 31),
(1246, 'Thanjavur', 31),
(1247, 'Tharamangalam', 31),
(1248, 'Tharangambadi', 31),
(1249, 'Theni Allinagaram', 31),
(1250, 'Thirumangalam', 31),
(1251, 'Thirunindravur', 31),
(1252, 'Thiruparappu', 31),
(1253, 'Thirupuvanam', 31),
(1254, 'Thiruthuraipoondi', 31),
(1255, 'Thiruvallur', 31),
(1256, 'Thiruvarur', 31),
(1257, 'Thoothukudi', 31),
(1258, 'Thuraiyur', 31),
(1259, 'Tindivanam', 31),
(1260, 'Tiruchendur', 31),
(1261, 'Tiruchengode', 31),
(1262, 'Tiruchirappalli', 31),
(1263, 'Tirukalukundram', 31),
(1264, 'Tirukkoyilur', 31),
(1265, 'Tirunelveli', 31),
(1266, 'Tirupathur', 31),
(1267, 'Tirupathur', 31),
(1268, 'Tiruppur', 31),
(1269, 'Tiruttani', 31),
(1270, 'Tiruvannamalai', 31),
(1271, 'Tiruvethipuram', 31),
(1272, 'Tittakudi', 31),
(1273, 'Udhagamandalam', 31),
(1274, 'Udumalaipettai', 31),
(1275, 'Unnamalaikadai', 31),
(1276, 'Usilampatti', 31),
(1277, 'Uthamapalayam', 31),
(1278, 'Uthiramerur', 31),
(1279, 'Vadakkuvalliyur', 31),
(1280, 'Vadalur', 31),
(1281, 'Vadipatti', 31),
(1282, 'Valparai', 31),
(1283, 'Vandavasi', 31),
(1284, 'Vaniyambadi', 31),
(1285, 'Vedaranyam', 31),
(1286, 'Vellakoil', 31),
(1287, 'Vellore', 31),
(1288, 'Vikramasingapuram', 31),
(1289, 'Viluppuram', 31),
(1290, 'Virudhachalam', 31),
(1291, 'Virudhunagar', 31),
(1292, 'Viswanatham', 31),
(1293, 'Agartala', 33),
(1294, 'Badharghat', 33),
(1295, 'Dharmanagar', 33),
(1296, 'Indranagar', 33),
(1297, 'Jogendranagar', 33),
(1298, 'Kailasahar', 33),
(1299, 'Khowai', 33),
(1300, 'Pratapgarh', 33),
(1301, 'Udaipur', 33),
(1302, 'Achhnera', 34),
(1303, 'Adari', 34),
(1304, 'Agra', 34),
(1305, 'Aligarh', 34),
(1306, 'Allahabad', 34),
(1307, 'Amroha', 34),
(1308, 'Azamgarh', 34),
(1309, 'Bahraich', 34),
(1310, 'Ballia', 34),
(1311, 'Balrampur', 34),
(1312, 'Banda', 34),
(1313, 'Bareilly', 34),
(1314, 'Chandausi', 34),
(1315, 'Dadri', 34),
(1316, 'Deoria', 34),
(1317, 'Etawah', 34),
(1318, 'Fatehabad', 34),
(1319, 'Fatehpur', 34),
(1320, 'Fatehpur', 34),
(1321, 'Greater Noida', 34),
(1322, 'Hamirpur', 34),
(1323, 'Hardoi', 34),
(1324, 'Jajmau', 34),
(1325, 'Jaunpur', 34),
(1326, 'Jhansi', 34),
(1327, 'Kalpi', 34),
(1328, 'Kanpur', 34),
(1329, 'Kota', 34),
(1330, 'Laharpur', 34),
(1331, 'Lakhimpur', 34),
(1332, 'Lal Gopalganj Nindaura', 34),
(1333, 'Lalganj', 34),
(1334, 'Lalitpur', 34),
(1335, 'Lar', 34),
(1336, 'Loni', 34),
(1337, 'Lucknow', 34),
(1338, 'Mathura', 34),
(1339, 'Meerut', 34),
(1340, 'Modinagar', 34),
(1341, 'Muradnagar', 34),
(1342, 'Nagina', 34),
(1343, 'Najibabad', 34),
(1344, 'Nakur', 34),
(1345, 'Nanpara', 34),
(1346, 'Naraura', 34),
(1347, 'Naugawan Sadat', 34),
(1348, 'Nautanwa', 34),
(1349, 'Nawabganj', 34),
(1350, 'Nehtaur', 34),
(1351, 'NOIDA', 34),
(1352, 'Noorpur', 34),
(1353, 'Obra', 34),
(1354, 'Orai', 34),
(1355, 'Padrauna', 34),
(1356, 'Palia Kalan', 34),
(1357, 'Parasi', 34),
(1358, 'Phulpur', 34),
(1359, 'Pihani', 34),
(1360, 'Pilibhit', 34),
(1361, 'Pilkhuwa', 34),
(1362, 'Powayan', 34),
(1363, 'Pukhrayan', 34),
(1364, 'Puranpur', 34),
(1365, 'Purquazi', 34),
(1366, 'Purwa', 34),
(1367, 'Rae Bareli', 34),
(1368, 'Rampur', 34),
(1369, 'Rampur Maniharan', 34),
(1370, 'Rasra', 34),
(1371, 'Rath', 34),
(1372, 'Renukoot', 34),
(1373, 'Reoti', 34),
(1374, 'Robertsganj', 34),
(1375, 'Rudauli', 34),
(1376, 'Rudrapur', 34),
(1377, 'Sadabad', 34),
(1378, 'Safipur', 34),
(1379, 'Saharanpur', 34),
(1380, 'Sahaspur', 34),
(1381, 'Sahaswan', 34),
(1382, 'Sahawar', 34),
(1383, 'Sahjanwa', 34),
(1385, 'Sambhal', 34),
(1386, 'Samdhan', 34),
(1387, 'Samthar', 34),
(1388, 'Sandi', 34),
(1389, 'Sandila', 34),
(1390, 'Sardhana', 34),
(1391, 'Seohara', 34),
(1394, 'Shahganj', 34),
(1395, 'Shahjahanpur', 34),
(1396, 'Shamli', 34),
(1399, 'Sherkot', 34),
(1401, 'Shikohabad', 34),
(1402, 'Shishgarh', 34),
(1403, 'Siana', 34),
(1404, 'Sikanderpur', 34),
(1405, 'Sikandra Rao', 34),
(1406, 'Sikandrabad', 34),
(1407, 'Sirsaganj', 34),
(1408, 'Sirsi', 34),
(1409, 'Sitapur', 34),
(1410, 'Soron', 34),
(1411, 'Suar', 34),
(1412, 'Sultanpur', 34),
(1413, 'Sumerpur', 34),
(1414, 'Tanda', 34),
(1415, 'Tanda', 34),
(1416, 'Tetri Bazar', 34),
(1417, 'Thakurdwara', 34),
(1418, 'Thana Bhawan', 34),
(1419, 'Tilhar', 34),
(1420, 'Tirwaganj', 34),
(1421, 'Tulsipur', 34),
(1422, 'Tundla', 34),
(1423, 'Unnao', 34),
(1424, 'Utraula', 34),
(1425, 'Varanasi', 34),
(1426, 'Vrindavan', 34),
(1427, 'Warhapur', 34),
(1428, 'Zaidpur', 34),
(1429, 'Zamania', 34),
(1430, 'Almora', 35),
(1431, 'Bazpur', 35),
(1432, 'Chamba', 35),
(1433, 'Dehradun', 35),
(1434, 'Haldwani', 35),
(1435, 'Haridwar', 35),
(1436, 'Jaspur', 35),
(1437, 'Kashipur', 35),
(1438, 'kichha', 35),
(1439, 'Kotdwara', 35),
(1440, 'Manglaur', 35),
(1441, 'Mussoorie', 35),
(1442, 'Nagla', 35),
(1443, 'Nainital', 35),
(1444, 'Pauri', 35),
(1445, 'Pithoragarh', 35),
(1446, 'Ramnagar', 35),
(1447, 'Rishikesh', 35),
(1448, 'Roorkee', 35),
(1449, 'Rudrapur', 35),
(1450, 'Sitarganj', 35),
(1451, 'Tehri', 35),
(1452, 'Muzaffarnagar', 34),
(1454, 'Alipurduar', 36),
(1455, 'Arambagh', 36),
(1456, 'Asansol', 36),
(1457, 'Baharampur', 36),
(1458, 'Bally', 36),
(1459, 'Balurghat', 36),
(1460, 'Bankura', 36),
(1461, 'Barakar', 36),
(1462, 'Barasat', 36),
(1463, 'Bardhaman', 36),
(1464, 'Bidhan Nagar', 36),
(1465, 'Chinsura', 36),
(1466, 'Contai', 36),
(1467, 'Cooch Behar', 36),
(1468, 'Darjeeling', 36),
(1469, 'Durgapur', 36),
(1470, 'Haldia', 36),
(1471, 'Howrah', 36),
(1472, 'Islampur', 36),
(1473, 'Jhargram', 36),
(1474, 'Kharagpur', 36),
(1475, 'Kolkata', 36),
(1476, 'Mainaguri', 36),
(1477, 'Mal', 36),
(1478, 'Mathabhanga', 36),
(1479, 'Medinipur', 36),
(1480, 'Memari', 36),
(1481, 'Monoharpur', 36),
(1482, 'Murshidabad', 36),
(1483, 'Nabadwip', 36),
(1484, 'Naihati', 36),
(1485, 'Panchla', 36),
(1486, 'Pandua', 36),
(1487, 'Paschim Punropara', 36),
(1488, 'Purulia', 36),
(1489, 'Raghunathpur', 36),
(1490, 'Raiganj', 36),
(1491, 'Rampurhat', 36),
(1492, 'Ranaghat', 36),
(1493, 'Sainthia', 36),
(1494, 'Santipur', 36),
(1495, 'Siliguri', 36),
(1496, 'Sonamukhi', 36),
(1497, 'Srirampore', 36),
(1498, 'Suri', 36),
(1499, 'Taki', 36),
(1500, 'Tamluk', 36),
(1501, 'Tarakeswar', 36),
(1502, 'Chikmagalur', 17),
(1503, 'Davanagere', 17),
(1504, 'Dharwad', 17),
(1505, 'Gadag', 17),
(1506, 'Chennai', 31),
(1507, 'Coimbatore', 31),
(1508, 'Chandigarh', 6),
(1509, 'Leh', 37),
(1510, 'Amman', 38),
(1511, 'Zarqa', 38),
(1512, 'Vikasnagar', 35),
(1513, 'Az-Zarqa', 38),
(1514, 'Abdali', 38),
(1515, 'abdoun', 38),
(1516, 'Abdali', 38),
(1517, 'Abdoun', 38),
(1518, 'Abdullah Ghosheh Street', 38),
(1519, 'Abu Alia', 38),
(1520, 'Abu Nseir', 38),
(1521, 'AL Bayader', 38),
(1522, 'Al Bnayyat', 38),
(1523, 'AL Fuhais', 38),
(1524, 'AL Jubeiha', 38),
(1525, 'AL Hummar', 38),
(1526, 'AL Kursi', 38),
(1527, 'Bader AL Jadeda', 38),
(1528, 'Dahiet AL Ameer Hasan', 38),
(1529, 'Deir Ghbar', 38),
(1530, 'Hay Al Baraka', 38),
(1531, 'Jabal Amman', 38),
(1532, 'Khalda', 38),
(1533, 'Marka', 38),
(1534, 'Mahis', 38),
(1535, 'Mecca Street', 38),
(1536, 'Naour', 38),
(1537, 'Ras El Ain', 38),
(1538, 'Seventh Circle', 38),
(1539, 'Shafa Badran', 38),
(1540, 'Sports City', 38),
(1541, 'Swelieh', 38),
(1542, 'Tabarbour', 38),
(1543, 'Tla Al Ali', 38),
(1544, 'Um El Summaq', 38),
(1545, 'Um Sous', 38),
(1546, 'Wadi El Seer', 38);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('2p6pmmbjjtk7lvanc6k3f8juski0a2ej', '::1', 1703248031, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730333234383033313b726563656e745f73657373696f6e7c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d726563656e746c795f7669657765645f70726f64756374737c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d757365725f69647c733a31313a225556306370477a456f6452223b757365725f6e616d657c733a393a224a4f4e59205041554c223b757365725f70686f6e657c733a31303a2239383734363237393733223b757365725f656d61696c7c733a32313a227061756c2e6a6f6e79373040676d61696c2e636f6d223b6c6f676765645f696e7c623a313b716f7574655f69647c733a31303a2232323132313132333131223b),
('3hv7a4lnn83bdboqjus8oca3g232rli5', '::1', 1703239847, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730333233393834373b726563656e745f73657373696f6e7c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d726563656e746c795f7669657765645f70726f64756374737c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d757365725f69647c733a31313a225556306370477a456f6452223b757365725f6e616d657c733a393a224a4f4e59205041554c223b757365725f70686f6e657c733a31303a2239383734363237393733223b757365725f656d61696c7c733a32313a227061756c2e6a6f6e79373040676d61696c2e636f6d223b6c6f676765645f696e7c623a313b716f7574655f69647c733a31303a2232323132313132333131223b),
('ettflnk989fja2683osj9tqg75qona8b', '::1', 1703246691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730333234363639313b726563656e745f73657373696f6e7c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d726563656e746c795f7669657765645f70726f64756374737c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d757365725f69647c733a31313a225556306370477a456f6452223b757365725f6e616d657c733a393a224a4f4e59205041554c223b757365725f70686f6e657c733a31303a2239383734363237393733223b757365725f656d61696c7c733a32313a227061756c2e6a6f6e79373040676d61696c2e636f6d223b6c6f676765645f696e7c623a313b716f7574655f69647c733a31303a2232323132313132333131223b),
('h3avbod817odgj1jtvii94bep9anll2q', '::1', 1703248553, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730333234383531343b726563656e745f73657373696f6e7c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d726563656e746c795f7669657765645f70726f64756374737c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d757365725f69647c733a31313a225556306370477a456f6452223b757365725f6e616d657c733a393a224a4f4e59205041554c223b757365725f70686f6e657c733a31303a2239383734363237393733223b757365725f656d61696c7c733a32313a227061756c2e6a6f6e79373040676d61696c2e636f6d223b6c6f676765645f696e7c623a313b716f7574655f69647c733a31303a2232323132313132333131223b),
('krkkbi8i5nb3k3h7a6gv4fk3bcriobk4', '::1', 1703310566, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730333331303536363b),
('u332sb138o4tqs5p6j9umj3g40pkr2l5', '::1', 1703248514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730333234383531343b726563656e745f73657373696f6e7c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d726563656e746c795f7669657765645f70726f64756374737c613a323a7b693a303b733a31313a22504634444c4f583641785a223b693a313b733a31313a2250336a30454164357a7834223b7d757365725f69647c733a31313a225556306370477a456f6452223b757365725f6e616d657c733a393a224a4f4e59205041554c223b757365725f70686f6e657c733a31303a2239383734363237393733223b757365725f656d61696c7c733a32313a227061756c2e6a6f6e79373040676d61696c2e636f6d223b6c6f676765645f696e7c623a313b716f7574655f69647c733a31303a2232323132313132333131223b);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `countrycode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `name_ar`, `countrycode`) VALUES
(1, 'india', '', '91');

-- --------------------------------------------------------

--
-- Table structure for table `coupancode`
--

CREATE TABLE `coupancode` (
  `sno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `coupon_type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `cap_value` int(11) NOT NULL,
  `min_order` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `activate` varchar(10) NOT NULL,
  `user_apply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupancode`
--

INSERT INTO `coupancode` (`sno`, `name`, `coupon_type`, `value`, `cap_value`, `min_order`, `fromdate`, `todate`, `activate`, `user_apply`) VALUES
(1, 'COUPON', 2, 10, 5, 15, '2023-07-31', '2023-08-02', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupancode_vendor`
--

CREATE TABLE `coupancode_vendor` (
  `sno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `coupandesc` text NOT NULL,
  `coupon_type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `cap_value` int(11) NOT NULL,
  `min_order` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `activate` varchar(10) NOT NULL,
  `user_apply` int(11) NOT NULL,
  `vendor_id` varchar(200) NOT NULL,
  `terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `countryid` int(11) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `countryid`, `symbol`, `description`) VALUES
(2, 'Rupee', 0, '₹', ''),
(6, 'Omani Rials', 0, 'OMR', '');

-- --------------------------------------------------------

--
-- Table structure for table `days_price`
--

CREATE TABLE `days_price` (
  `days_id` int(11) NOT NULL,
  `days` varchar(50) NOT NULL,
  `price` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `days_price`
--

INSERT INTO `days_price` (`days_id`, `days`, `price`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(2, '1 Days', '200', 1, '2023-10-31 07:23:17', '2023-10-31 13:53:17', '1'),
(3, '2 Days', '350', 1, '2023-10-31 07:23:26', '2023-10-31 13:53:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy_bankdetails`
--

CREATE TABLE `deliveryboy_bankdetails` (
  `id` int(11) NOT NULL,
  `deliveryboy_id` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `acc_no` varchar(50) NOT NULL,
  `ifsccode` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `createby` datetime NOT NULL,
  `updateby` datetime NOT NULL,
  `verifed` int(11) NOT NULL,
  `verified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy_login`
--

CREATE TABLE `deliveryboy_login` (
  `id` int(11) NOT NULL,
  `deliveryboy_unique_id` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` int(11) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile_pic` text NOT NULL,
  `id_proof` text NOT NULL,
  `address_proof` text NOT NULL,
  `vehicle_number` varchar(200) NOT NULL,
  `vehicle_docs` text NOT NULL,
  `insurance_docs` text NOT NULL,
  `status` int(11) NOT NULL,
  `flagid` int(11) NOT NULL,
  `create_by` datetime NOT NULL,
  `update_by` datetime NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `token_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy_orders`
--

CREATE TABLE `delivery_boy_orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `delivery_boy` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `email_title` varchar(500) NOT NULL,
  `email_subject` varchar(500) NOT NULL,
  `email_body` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `email_title`, `email_subject`, `email_body`, `created_at`) VALUES
(1, 'Order Update Email', 'Order Status Updated', '<!DOCTYPE html\n  PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n\n<head>\n  <meta charset=\"UTF-8\">\n  <meta content=\"width=device-width, initial-scale=1\" name=\"viewport\">\n  <meta name=\"x-apple-disable-message-reformatting\">\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n  <meta content=\"telephone=no\" name=\"format-detection\">\n  <title>New Template</title><!--[if (mso 16)]>\n    <style type=\"text/css\">\n    a {text-decoration: none;}\n    </style>\n    <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>\n<xml>\n    <o:OfficeDocumentSettings>\n    <o:AllowPNG></o:AllowPNG>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n    </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n  <style type=\"text/css\">\n    #outlook a {\n      padding: 0;\n    }\n\n    .es-button {\n      mso-style-priority: 100 !important;\n      text-decoration: none !important;\n    }\n\n    a[x-apple-data-detectors] {\n      color: inherit !important;\n      text-decoration: none !important;\n      font-size: inherit !important;\n      font-family: inherit !important;\n      font-weight: inherit !important;\n      line-height: inherit !important;\n    }\n\n    .es-desk-hidden {\n      display: none;\n      float: left;\n      overflow: hidden;\n      width: 0;\n      max-height: 0;\n      line-height: 0;\n      mso-hide: all;\n    }\n\n    @media only screen and (max-width:600px) {\n\n      p,\n      ul li,\n      ol li,\n      a {\n        line-height: 150% !important\n      }\n\n      h1,\n      h2,\n      h3,\n      h1 a,\n      h2 a,\n      h3 a {\n        line-height: 120%\n      }\n\n      h1 {\n        font-size: 24px !important;\n        text-align: center\n      }\n\n      h2 {\n        font-size: 20px !important;\n        text-align: center\n      }\n\n      h3 {\n        font-size: 16px !important;\n        text-align: center\n      }\n\n      .es-header-body h1 a,\n      .es-content-body h1 a,\n      .es-footer-body h1 a {\n        font-size: 24px !important\n      }\n\n      .es-header-body h2 a,\n      .es-content-body h2 a,\n      .es-footer-body h2 a {\n        font-size: 20px !important\n      }\n\n      .es-header-body h3 a,\n      .es-content-body h3 a,\n      .es-footer-body h3 a {\n        font-size: 16px !important\n      }\n\n      .es-menu td a {\n        font-size: 9px !important\n      }\n\n      .es-header-body p,\n      .es-header-body ul li,\n      .es-header-body ol li,\n      .es-header-body a {\n        font-size: 12px !important\n      }\n\n      .es-content-body p,\n      .es-content-body ul li,\n      .es-content-body ol li,\n      .es-content-body a {\n        font-size: 9px !important\n      }\n\n      .es-footer-body p,\n      .es-footer-body ul li,\n      .es-footer-body ol li,\n      .es-footer-body a {\n        font-size: 9px !important\n      }\n\n      .es-infoblock p,\n      .es-infoblock ul li,\n      .es-infoblock ol li,\n      .es-infoblock a {\n        font-size: 9px !important\n      }\n\n      *[class=\"gmail-fix\"] {\n        display: none !important\n      }\n\n      .es-m-txt-c,\n      .es-m-txt-c h1,\n      .es-m-txt-c h2,\n      .es-m-txt-c h3 {\n        text-align: center !important\n      }\n\n      .es-m-txt-r,\n      .es-m-txt-r h1,\n      .es-m-txt-r h2,\n      .es-m-txt-r h3 {\n        text-align: right !important\n      }\n\n      .es-m-txt-l,\n      .es-m-txt-l h1,\n      .es-m-txt-l h2,\n      .es-m-txt-l h3 {\n        text-align: left !important\n      }\n\n      .es-m-txt-r img,\n      .es-m-txt-c img,\n      .es-m-txt-l img {\n        display: inline !important\n      }\n\n      .es-button-border {\n        display: block !important\n      }\n\n      a.es-button,\n      button.es-button {\n        font-size: 20px !important;\n        display: block !important;\n        border-left-width: 0px !important;\n        border-right-width: 0px !important;\n        padding-left: 0px !important;\n        padding-right: 0px !important\n      }\n\n      .es-adaptive table,\n      .es-left,\n      .es-right {\n        width: 100% !important\n      }\n\n      .es-content table,\n      .es-header table,\n      .es-footer table,\n      .es-content,\n      .es-footer,\n      .es-header {\n        width: 100% !important;\n        max-width: 600px !important\n      }\n\n      .es-adapt-td {\n        display: block !important;\n        width: 100% !important\n      }\n\n      .adapt-img {\n        width: 100% !important;\n        height: auto !important\n      }\n\n      .es-m-p0 {\n        padding: 0 !important\n      }\n\n      .es-m-p0r {\n        padding-right: 0 !important\n      }\n\n      .es-m-p0l {\n        padding-left: 0 !important\n      }\n\n      .es-m-p0t {\n        padding-top: 0 !important\n      }\n\n      .es-m-p0b {\n        padding-bottom: 0 !important\n      }\n\n      .es-m-p20b {\n        padding-bottom: 20px !important\n      }\n\n      .es-mobile-hidden,\n      .es-hidden {\n        display: none !important\n      }\n\n      tr.es-desk-hidden,\n      td.es-desk-hidden,\n      table.es-desk-hidden {\n        width: auto !important;\n        overflow: visible !important;\n        float: none !important;\n        max-height: inherit !important;\n        line-height: inherit !important\n      }\n\n      tr.es-desk-hidden {\n        display: table-row !important\n      }\n\n      table.es-desk-hidden {\n        display: table !important\n      }\n\n      td.es-desk-menu-hidden {\n        display: table-cell !important\n      }\n\n      .es-menu td {\n        width: 1% !important\n      }\n\n      table.es-table-not-adapt,\n      .esd-block-html table {\n        width: auto !important\n      }\n\n      table.es-social {\n        display: inline-block !important\n      }\n\n      table.es-social td {\n        display: inline-block !important\n      }\n\n      .es-m-p5 {\n        padding: 5px !important\n      }\n\n      .es-m-p5t {\n        padding-top: 5px !important\n      }\n\n      .es-m-p5b {\n        padding-bottom: 5px !important\n      }\n\n      .es-m-p5r {\n        padding-right: 5px !important\n      }\n\n      .es-m-p5l {\n        padding-left: 5px !important\n      }\n\n      .es-m-p10 {\n        padding: 10px !important\n      }\n\n      .es-m-p10t {\n        padding-top: 10px !important\n      }\n\n      .es-m-p10b {\n        padding-bottom: 10px !important\n      }\n\n      .es-m-p10r {\n        padding-right: 10px !important\n      }\n\n      .es-m-p10l {\n        padding-left: 10px !important\n      }\n\n      .es-m-p15 {\n        padding: 15px !important\n      }\n\n      .es-m-p15t {\n        padding-top: 15px !important\n      }\n\n      .es-m-p15b {\n        padding-bottom: 15px !important\n      }\n\n      .es-m-p15r {\n        padding-right: 15px !important\n      }\n\n      .es-m-p15l {\n        padding-left: 15px !important\n      }\n\n      .es-m-p20 {\n        padding: 20px !important\n      }\n\n      .es-m-p20t {\n        padding-top: 20px !important\n      }\n\n      .es-m-p20r {\n        padding-right: 20px !important\n      }\n\n      .es-m-p20l {\n        padding-left: 20px !important\n      }\n\n      .es-m-p25 {\n        padding: 25px !important\n      }\n\n      .es-m-p25t {\n        padding-top: 25px !important\n      }\n\n      .es-m-p25b {\n        padding-bottom: 25px !important\n      }\n\n      .es-m-p25r {\n        padding-right: 25px !important\n      }\n\n      .es-m-p25l {\n        padding-left: 25px !important\n      }\n\n      .es-m-p30 {\n        padding: 30px !important\n      }\n\n      .es-m-p30t {\n        padding-top: 30px !important\n      }\n\n      .es-m-p30b {\n        padding-bottom: 30px !important\n      }\n\n      .es-m-p30r {\n        padding-right: 30px !important\n      }\n\n      .es-m-p30l {\n        padding-left: 30px !important\n      }\n\n      .es-m-p35 {\n        padding: 35px !important\n      }\n\n      .es-m-p35t {\n        padding-top: 35px !important\n      }\n\n      .es-m-p35b {\n        padding-bottom: 35px !important\n      }\n\n      .es-m-p35r {\n        padding-right: 35px !important\n      }\n\n      .es-m-p35l {\n        padding-left: 35px !important\n      }\n\n      .es-m-p40 {\n        padding: 40px !important\n      }\n\n      .es-m-p40t {\n        padding-top: 40px !important\n      }\n\n      .es-m-p40b {\n        padding-bottom: 40px !important\n      }\n\n      .es-m-p40r {\n        padding-right: 40px !important\n      }\n\n      .es-m-p40l {\n        padding-left: 40px !important\n      }\n\n      .es-desk-hidden {\n        display: table-row !important;\n        width: auto !important;\n        overflow: visible !important;\n        max-height: inherit !important\n      }\n    }\n  </style>\n</head>\n\n<body\n  style=\"width:100%;font-family:arial, \'helvetica neue\', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0\">\n  <div class=\"es-wrapper-color\" style=\"background-color:#FFFFFF\"><!--[if gte mso 9]>\n			<v:background xmlns:v=\"urn:schemas-microsoft-com:vml\" fill=\"t\">\n				<v:fill type=\"tile\" color=\"#ffffff\"></v:fill>\n			</v:background>\n		<![endif]-->\n    <table class=\"es-wrapper\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"\n      style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FFFFFF\">\n      <tr>\n        <td valign=\"top\" style=\"padding:0;Margin:0\">\n          <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-header\" align=\"center\"\n            style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top\">\n            <tr>\n              <td align=\"center\" style=\"padding:0;Margin:0\">\n                <table bgcolor=\"#ffffff\" class=\"es-header-body\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"\n                  style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px\">\n                  <tr>\n                    <td class=\"esdev-adapt-off\" align=\"left\" style=\"padding:20px;Margin:0\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" class=\"esdev-mso-table\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px\">\n                        <tr>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-left\" align=\"left\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">\n                              <tr>\n                                <td class=\"es-m-p0r\" valign=\"top\" align=\"center\" style=\"padding:0;Margin:0;width:415px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td align=\"left\" style=\"padding:0;Margin:0;font-size:0px\"><a target=\"_blank\"\n                                          href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:13px\"><img\n                                            src=\"{BASE_URL}assets_web/images/logo-appbar.png\"\n                                            alt=\"Logo\"\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"\n                                            width=\"100\" title=\"Logo\" height=\"42\"></a></td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                          <td style=\"padding:0;Margin:0;width:20px\"></td>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" align=\"right\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:125px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td style=\"padding:0;Margin:0\">\n                                        <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"es-menu\"\n                                          role=\"presentation\"\n                                          style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                          <tr class=\"images\">\n                                            <td align=\"center\" valign=\"top\" width=\"33.33%\" id=\"esd-menu-id-0\"\n                                              style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                              <a target=\"_blank\" href=\"{BASE_URL}myaddress\"\n                                                style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#926B4A;font-size:13px\"><img\n                                                  src=\"{BASE_URL}assets_web/images/icons/profile.png\"\n                                                  alt=\"Profile\" title=\"Profile\" width=\"20\" height=\"20\"\n                                                  style=\"display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;vertical-align:middle\"></a>\n                                            </td>\n                                            <td align=\"center\" valign=\"top\" width=\"33.33%\" id=\"esd-menu-id-1\"\n                                              style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                              <a target=\"_blank\" href=\"{BASE_URL}wishlist\"\n                                                style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#926B4A;font-size:13px\"><img\n                                                  src=\"{BASE_URL}assets_web/images/icons/wishlist.png\"\n                                                  alt=\"Wishlist\" title=\"Wishlist\" width=\"20\" height=\"20\"\n                                                  style=\"display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;vertical-align:middle\"></a>\n                                            </td>\n                                            <td align=\"center\" valign=\"top\" width=\"33.33%\" id=\"esd-menu-id-2\"\n                                              style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                              <a target=\"_blank\" href=\"{BASE_URL}cart\"\n                                                style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#926B4A;font-size:13px\"><img\n                                                  src=\"{BASE_URL}assets_web/images/icons/bag.png\"\n                                                  alt=\"Cart\" title=\"Cart\" width=\"20\" height=\"20\"\n                                                  style=\"display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;vertical-align:middle\"></a>\n                                            </td>\n                                          </tr>\n                                        </table>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                  <tr>\n                    <td align=\"left\" style=\"padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;width:560px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0\">\n                                  <h1\n                                    style=\"Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;font-size:26px;font-style:normal;font-weight:bold;color:#333333\">\n                                    {ORDER_STATUS}</h1>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td style=\"padding:0;Margin:0;padding-top:5px;padding-bottom:5px\">\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:23px;color:#666666;font-size:15px;text-align:justify\">\n                                    <strong>Hi {USER_NAME},</strong>\n                                  </p>\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:20px;color:#666666;font-size:13px;text-align:justify\">\n                                    {ORDER_MESSAGE}</p>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                </table>\n              </td>\n            </tr>\n          </table>\n          <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-content\" align=\"center\"\n            style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%\">\n            <tr>\n              <td align=\"center\" style=\"padding:0;Margin:0\">\n                <table bgcolor=\"#ffffff\" class=\"es-content-body\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"\n                  style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px\">\n                  <tr>\n                    <td class=\"esdev-adapt-off es-m-p10\" align=\"left\"\n                      background=\"{BASE_URL}assets_web/images/icons/horizontal-bar.png\"\n                      style=\"padding:20px;margin:0;background-repeat:no-repeat;background-position:center center\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" class=\"esdev-mso-table\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px\">\n                        <tr>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-left\" align=\"left\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:129px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" bgcolor=\"#efefef\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#efefef\"\n                                    role=\"presentation\">\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"padding:0;Margin:0;padding-top:10px;padding-left:15px;padding-right:15px;font-size:0px\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/circle.png\"\n                                            alt\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"\n                                            width=\"30\" height=\"30\"></a>\n                                      </td>\n                                    </tr>\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"Margin:0;padding-top:5px;padding-bottom:10px;padding-left:10px;padding-right:10px\">\n                                        <p\n                                          style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                          <span style=\"font-size:12px\">{FIRST_STATUS}<br></span>{FIRST_STATUS_VAL}\n                                        </p>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                          <td style=\"padding:0;Margin:0;width:15px\"></td>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-left\" align=\"left\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:129px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" bgcolor=\"#efefef\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#efefef\"\n                                    role=\"presentation\">\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"padding:0;Margin:0;padding-top:10px;padding-left:15px;padding-right:15px;font-size:0px\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/circle.png\"\n                                            alt\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"\n                                            width=\"30\" height=\"30\"></a>\n                                      </td>\n                                    </tr>\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"Margin:0;padding-top:5px;padding-bottom:10px;padding-left:10px;padding-right:10px\">\n                                        <p\n                                          style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                          <span style=\"font-size:12px\">{SECOND_STATUS}</span><br>{SECOND_STATUS_VAL}\n                                        </p>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                          <td style=\"padding:0;Margin:0;width:15px\"></td>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-left\" align=\"left\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:129px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" bgcolor=\"#efefef\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#efefef\"\n                                    role=\"presentation\">\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"padding:0;Margin:0;padding-top:10px;padding-left:15px;padding-right:15px;font-size:0px\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/circle.png\"\n                                            alt\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"\n                                            width=\"30\" height=\"30\"></a>\n                                      </td>\n                                    </tr>\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"Margin:0;padding-top:5px;padding-bottom:10px;padding-left:10px;padding-right:10px\">\n                                        <p\n                                          style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                          <span style=\"font-size:12px\">{THIRD_STATUS}<br></span>{THIRD_STATUS_VAL}\n                                        </p>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                          <td style=\"padding:0;Margin:0;width:15px\"></td>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-right\" align=\"right\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:128px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" bgcolor=\"#efefef\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#efefef\"\n                                    role=\"presentation\">\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"padding:0;Margin:0;padding-top:10px;padding-left:15px;padding-right:15px;font-size:0px\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/circle.png\"\n                                            alt\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"\n                                            width=\"30\" height=\"30\"></a>\n                                      </td>\n                                    </tr>\n                                    <tr>\n                                      <td align=\"center\"\n                                        style=\"Margin:0;padding-top:5px;padding-bottom:10px;padding-left:10px;padding-right:10px\">\n                                        <p\n                                          style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                          <span style=\"font-size:12px\">{FOURTH_STATUS}<br></span>{FOURTH_STATUS_VAL}\n                                        </p>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                  <tr>\n                    <td align=\"left\" style=\"padding:5px;Margin:0\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;width:590px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td align=\"center\" style=\"padding:0;Margin:0\"><!--[if mso]><a href=\"{BUTTON_LINK}\" target=\"_blank\" hidden>\n	<v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" esdevVmlButton href=\"{BUTTON_LINK}\" \n                style=\"height:41px; v-text-anchor:middle; width:197px\" arcsize=\"50%\" stroke=\"f\"  fillcolor=\"#666666\">\n		<w:anchorlock></w:anchorlock>\n		<center style=\'color:#ffffff; font-family:arial, \"helvetica neue\", helvetica, sans-serif; font-size:15px; font-weight:400; line-height:15px;  mso-text-raise:1px\'>{BUTTON_TEXT}</center>\n	</v:roundrect></a>\n<![endif]--><!--[if !mso]><!-- --><span class=\"es-button-border msohide\"\n                                    style=\"border-style:solid;border-color:#2CB543;background:#666666;border-width:0px;display:inline-block;border-radius:30px;width:auto;mso-hide:all\"><a\n                                      href=\"{BUTTON_LINK}\" class=\"es-button\" target=\"_blank\"\n                                      style=\"mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:18px;padding:10px 20px 10px 20px;display:inline-block;background:#666666;border-radius:30px;font-family:arial, \'helvetica neue\', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;mso-padding-alt:0;mso-border-alt:10px solid #666666\">{BUTTON_TEXT}</a></span><!--<![endif]--></td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                  <tr>\n                    <td align=\"left\" style=\"padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;width:560px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td align=\"center\" style=\"padding:0;Margin:0\">\n                                  <h2\n                                    style=\"Margin:0;line-height:33px;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;font-size:22px;font-style:normal;font-weight:bold;color:#333333\">\n                                    ORDER # {ORDER_ID}</h2>\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                    {ORDER_DATE}</p>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td align=\"left\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\">\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#a0937d;font-size:12px\">\n                                    ITEMS ORDERED</p>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td align=\"center\"\n                                  style=\"padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0\">\n                                  <table border=\"0\" width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\n                                    role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td\n                                        style=\"padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px\">\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                  {PRODUCTS_DETAILS}\n                  <tr>\n                    <td align=\"left\" style=\"padding:0;Margin:0;padding-left:20px;padding-right:20px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;width:560px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td align=\"center\"\n                                  style=\"padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0\">\n                                  <table border=\"0\" width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\n                                    role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      {HR}\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                  <tr>\n                    <td class=\"esdev-adapt-off\" align=\"left\"\n                      style=\"padding:0;Margin:0;padding-left:20px;padding-right:20px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" class=\"esdev-mso-table\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px\">\n                        <tr>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-left\" align=\"left\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:466px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td align=\"right\" style=\"padding:0;Margin:0\">\n                                        {PRICE_DETAILS_KEY}\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                          <td style=\"padding:0;Margin:0;width:20px\"></td>\n                          <td class=\"esdev-mso-td\" valign=\"top\" style=\"padding:0;Margin:0\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-right\" align=\"right\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right\">\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0;width:74px\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td align=\"right\" style=\"padding:0;Margin:0\">\n                                        {PRICE_DETAILS_VALUE}\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                  <tr>\n                    <td align=\"left\" style=\"padding:0;Margin:0;padding-left:20px;padding-right:20px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;width:560px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td align=\"left\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0;padding-top:10px\">\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#a0937d;font-size:12px\">\n                                    {SHIPPING_ADDRESS_HEAD}</p>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td align=\"center\"\n                                  style=\"padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0\">\n                                  <table border=\"0\" width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\n                                    role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td\n                                        style=\"padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px\">\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td align=\"left\" style=\"padding:0;Margin:0\">\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                    {SHIPPING_ADDRESS}\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                </table>\n              </td>\n            </tr>\n          </table>\n          <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-content\" align=\"center\"\n            style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%\">\n            <tr>\n              <td align=\"center\" bgcolor=\"#fef8ed\" style=\"padding:0;Margin:0;background-color:#fef8ed\">\n                <table bgcolor=\"#fef8ed\" class=\"es-content-body\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"\n                  style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fef8ed;width:600px\">\n                  <tr>\n                    <td class=\"es-m-p10r es-m-p10l\" align=\"left\"\n                      style=\"Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;width:560px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td style=\"padding:0;Margin:0\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"es-menu\"\n                                    role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr class=\"links-images-left\">\n                                      <td align=\"center\" valign=\"top\" width=\"33.33%\" id=\"esd-menu-id-0\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#a0937d;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/free-delivery.png\"\n                                            alt=\"FAST DELIVERY\" title=\"FAST DELIVERY\" align=\"absmiddle\" width=\"25\"\n                                            height=\"25\"\n                                            style=\"display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;padding-right:15px;vertical-align:middle\">FAST\n                                          DELIVERY</a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" width=\"33.33%\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;border-left:1px solid #a0937d\"\n                                        id=\"esd-menu-id-1\"><a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#a0937d;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/high-quality.png\"\n                                            alt=\"HIGH QUALITY\" title=\"HIGH QUALITY\" align=\"absmiddle\" width=\"25\"\n                                            height=\"25\"\n                                            style=\"display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;padding-right:15px;vertical-align:middle\">HIGH\n                                          QUALITY</a></td>\n                                      <td align=\"center\" valign=\"top\" width=\"33.33%\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;border-left:1px solid #a0937d\"\n                                        id=\"esd-menu-id-2\"><a target=\"_blank\" href=\"{BASE_URL}\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#a0937d;font-size:12px\"><img\n                                            src=\"{BASE_URL}assets_web/images/icons/best-choice.png\"\n                                            alt=\"BEST CHOICE\" title=\"BEST CHOICE\" align=\"absmiddle\" width=\"25\"\n                                            height=\"25\"\n                                            style=\"display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;padding-right:15px;vertical-align:middle\">BEST\n                                          CHOICE</a></td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                </table>\n              </td>\n            </tr>\n          </table>\n          <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-footer\" align=\"center\"\n            style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#E3CDC1;background-repeat:repeat;background-position:center top\">\n            <tr>\n              <td align=\"center\" bgcolor=\"#ffffff\" style=\"padding:0;Margin:0;background-color:#ffffff\">\n                <table class=\"es-footer-body\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"\n                  style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px\">\n                  <tr>\n                    <td align=\"left\"\n                      style=\"Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px\">\n                      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"\n                        style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                        <tr>\n                          <td align=\"left\" style=\"padding:0;Margin:0;width:560px\">\n                            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" role=\"presentation\"\n                              style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                              <tr>\n                                <td style=\"padding:0;Margin:0\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"es-menu\"\n                                    role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr class=\"links\">\n                                      <td align=\"center\" valign=\"top\" width=\"25%\" id=\"esd-menu-id-0\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}faq\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#666666;font-size:14px\">Faq\n                                        </a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" width=\"25%\" id=\"esd-menu-id-1\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}feedback\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#666666;font-size:14px\">Feedback</a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" width=\"25%\" id=\"esd-menu-id-2\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}contact\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#666666;font-size:14px\">Contact</a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" width=\"25%\" id=\"esd-menu-id-2\"\n                                        style=\"Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0\">\n                                        <a target=\"_blank\" href=\"{BASE_URL}help\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, \'helvetica neue\', helvetica, sans-serif;color:#666666;font-size:14px\">Help\n                                        </a>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td align=\"center\"\n                                  style=\"padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0\">\n                                  <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-table-not-adapt es-social\"\n                                    role=\"presentation\"\n                                    style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\">\n                                    <tr>\n                                      <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;padding-right:20px\"><a\n                                          target=\"_blank\" href=\"https://facebook.com/\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px\"><img\n                                            title=\"Facebook\"\n                                            src=\"{BASE_URL}assets_web/images/icons/facebook-logo-black.png\"\n                                            alt=\"Fb\" width=\"32\" height=\"32\"\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"></a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;padding-right:20px\"><a\n                                          target=\"_blank\" href=\"https://twitter.com/home\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px\"><img\n                                            title=\"Twitter\"\n                                            src=\"{BASE_URL}assets_web/images/icons/twitter-logo-black.png\"\n                                            alt=\"Tw\" width=\"32\" height=\"32\"\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"></a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0;padding-right:20px\"><a\n                                          target=\"_blank\" href=\"https://www.instagram.com/\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px\"><img\n                                            title=\"Instagram\"\n                                            src=\"{BASE_URL}assets_web/images/icons/instagram-logo-black.png\"\n                                            alt=\"Inst\" width=\"32\" height=\"32\"\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"></a>\n                                      </td>\n                                      <td align=\"center\" valign=\"top\" style=\"padding:0;Margin:0\"><a target=\"_blank\"\n                                          href=\"https://youtube.com/\"\n                                          style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px\"><img\n                                            title=\"Youtube\"\n                                            src=\"{BASE_URL}assets_web/images/icons/youtube-logo-black.png\"\n                                            alt=\"Yt\" width=\"32\" height=\"32\"\n                                            style=\"display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic\"></a>\n                                      </td>\n                                    </tr>\n                                  </table>\n                                </td>\n                              </tr>\n                              <tr>\n                                <td align=\"center\" style=\"padding:0;Margin:0;padding-top:10px;padding-bottom:10px\">\n                                  <p\n                                    style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, \'helvetica neue\', helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px\">\n                                    This email was sent from a notification-only address that cannot accept incoming\n                                    email. Please do not reply to this message.\n                                    <br><a target=\"_blank\"\n                                      style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#a0937d;font-size:12px\"\n                                      href=\"https://www.ebuy.om/privacy\">Privacy policy</a> | <a target=\"_blank\"\n                                      style=\"-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#a0937d;font-size:12px\"\n                                      href=\"https://www.ebuy.om/term_and_conditions\">Terms & Condition</a>\n                                  </p>\n                                </td>\n                              </tr>\n                            </table>\n                          </td>\n                        </tr>\n                      </table>\n                    </td>\n                  </tr>\n                </table>\n              </td>\n            </tr>\n          </table>\n        </td>\n      </tr>\n    </table>\n  </div>\n</body>\n\n</html>', '2023-12-21 05:52:39');
INSERT INTO `email_template` (`id`, `email_title`, `email_subject`, `email_body`, `created_at`) VALUES
(2, 'Cancel Order Email', 'Your Booking has been cancelled', '<table style=\"width: 100%!important;\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px!important; text-align: center; margin: 0 auto; background-color: #0a0909;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%; text-align: left; padding-top: 5px;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"site_url\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none;\" src=\"site_logo\" alt=\"\" border=\"0\" /> </a></td>\r\n<td style=\"width: 60%; text-align: right; padding-top: 5px;\">\r\n<p style=\"color: #ffffff; font-family: Arial; font-size: 16px; text-align: right; font-style: normal; font-stretch: normal;\">Order:&nbsp;<span style=\"font-weight: bold;\">Cancelled</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\">\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px; background-color: #fff; padding-top: 20px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" align=\"left\">\r\n<table border=\"0\" width=\"350\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 12px; font-weight: normal; font-style: normal; font-stretch: normal; margin-top: 0px; line-height: 14px; padding-top: 0px; margin-bottom: 7px;\">Hi <span style=\"font-weight: bold; color: #191919;\"> {USER_NAME},</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; color: #878787; line-height: 14px; padding-top: 0px; margin-top: 0px; margin-bottom: 7px;\">Your Order has been Cancelled.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\" width=\"250\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 11px; font-weight: normal; text-align: right; font-style: normal; line-height: 14px; font-stretch: normal; margin-top: 0px; padding-top: 0px; margin-bottom: 7px;\">Order placed on <span style=\"font-weight: bold; color: #000;\">{ORDER_DATE}</span></p>\r\n<p style=\"font-family: Arial; font-size: 11px; color: #878787; line-height: 14px; text-align: right; padding-top: 0px; margin-top: 0; margin-bottom: 7px;\">Order ID <span style=\"font-weight: bold; color: #000;\">{ORDER_ID}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" style=\"background-color: rgba(245,245,245,0.5); background: rgba(245,245,245,0.5); border: .08em solid #6ed49e; border-radius: 2px; padding-top: 20px; padding-bottom: 20px;\" align=\"left\">\r\n<table style=\"margin-bottom: 20px; padding-left: 15px;\" border=\"0\" width=\"360\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-bottom: 20px; margin-top: 0px;\"><span style=\"display: inline-block; width: 125px; min-width: 125px; max-width: 125px;\">Amount</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{AMOUNT_PAID} </span></p>\r\n<p style=\"margin-bottom: 0px; margin-top: 0;\"><a style=\"background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;\" href=\"{MANAGE_ORDER}\" target=\"_blank\" rel=\"noopener noreferrer\">Manage Your Order</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin-bottom: 30px; padding-right: 15px;\" border=\"0\" width=\"225\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<div style=\"max-width: 220px; padding-top: 0px; margin-bottom: 20px;\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 20px; color: #212121; margin-top: 0px; margin-bottom: 4px;\">Order Details</p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\">{USER_NAME} <br /> <span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\"> {USER_EMAIL} </span></p>\r\n</div>\r\n<p style=\"line-height: 1.56; margin-top: 0; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 14px; font-weight: bold; text-align: left; color: #212121; display: block; line-height: 20px; margin-bottom: 4px;\">SMS updates sent to</span> <span style=\"font-family: Arial; font-size: 12px; color: #212121;\">{USER_PHONE}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"padding-left: 15px; padding-right: 15px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; text-align: left; color: #212121; padding-top: 0px; padding-bottom: 0px; line-height: 19px; margin-top: 0; margin-bottom: 0;\">You will receive the next update when the item in your order is packed/shipped by the seller.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin-top: 0px;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #f0f0f0; font-size: 0px; line-height: 0px;\" bgcolor=\"#f0f0f0\" height=\"1\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"background-color: #fff; width: 642px; max-width: 642px; padding: 0px 20px 0px 20px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>{PRODUCTS_DETAILS}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 642px; max-width: 642px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin: 0; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"color: #212121; display: block; margin: 0 auto; clear: both;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; display: block;\" align=\"left\" valign=\"top\">\r\n<table style=\"margin-bottom: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"40%\">&nbsp;</td>\r\n<td align=\"right\" width=\"34%\">\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; line-height: 14px; padding-top: 0px; margin-bottom: 0;\"><span style=\"color: #212121; text-align: right; font-weight: bold;\">Amount</span></p>\r\n</td>\r\n<td>\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; padding-top: 0px; margin-bottom: 0;\"><span style=\"padding-right: 0px; font-weight: bold;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 640px; max-width: 640px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr class=\"m_-4345841705994091849col\" style=\"color: #212121;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; border-bottom: 1px solid #f0f0f0;\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 1.86; color: #212121;\">Thank you for Order with {STORE_NAME}!</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; margin-top: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 60%; text-align: left;\">&nbsp;</td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{APP_LINK}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{AND_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{IOS_APP}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{IOS_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"margin: 0 auto; width: 600px; max-width: 600px; margin-top: 4px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style=\"font-family: Arial; font-size: 10px; color: #878787;\">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2022-06-27 14:56:55'),
(3, 'Place order Email Template', 'Your Order has been successfully placed', '<table style=\"width: 100%!important;\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px!important; text-align: center; margin: 0 auto; background-color: #0a0909;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%; text-align: left; padding-top: 5px;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"site_url\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none;\" src=\"site_logo\" alt=\"\" border=\"0\" /> </a></td>\r\n<td style=\"width: 60%; text-align: right; padding-top: 5px;\">\r\n<p style=\"color: #ffffff; font-family: Arial; font-size: 16px; text-align: right; font-style: normal; font-stretch: normal;\">Order:&nbsp;<span style=\"font-weight: bold;\">Placed</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\">\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px; background-color: #fff; padding-top: 20px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" align=\"left\">\r\n<table border=\"0\" width=\"350\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 12px; font-weight: normal; font-style: normal; font-stretch: normal; margin-top: 0px; line-height: 14px; padding-top: 0px; margin-bottom: 7px;\">Hi <span style=\"font-weight: bold; color: #191919;\"> {USER_NAME},</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; color: #878787; line-height: 14px; padding-top: 0px; margin-top: 0px; margin-bottom: 7px;\">Your Order has been successfully placed.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\" width=\"250\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 11px; font-weight: normal; text-align: right; font-style: normal; line-height: 14px; font-stretch: normal; margin-top: 0px; padding-top: 0px; margin-bottom: 7px;\">Order placed on <span style=\"font-weight: bold; color: #000;\">{ORDER_DATE}</span></p>\r\n<p style=\"font-family: Arial; font-size: 11px; color: #878787; line-height: 14px; text-align: right; padding-top: 0px; margin-top: 0; margin-bottom: 7px;\">Order ID <span style=\"font-weight: bold; color: #000;\">{ORDER_ID}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" style=\"background-color: rgba(245,245,245,0.5); background: rgba(245,245,245,0.5); border: .08em solid #6ed49e; border-radius: 2px; padding-top: 20px; padding-bottom: 20px;\" align=\"left\">\r\n<table style=\"margin-bottom: 20px; padding-left: 15px;\" border=\"0\" width=\"360\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-bottom: 20px; margin-top: 0px;\"><span style=\"display: inline-block; width: 125px; min-width: 125px; max-width: 125px;\">Amount</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin-bottom: 30px; padding-right: 15px;\" border=\"0\" width=\"225\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<div style=\"max-width: 220px; padding-top: 0px; margin-bottom: 20px;\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 20px; color: #212121; margin-top: 0px; margin-bottom: 4px;\">Order Details</p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\">{USER_NAME} <br /> <span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\"> {USER_EMAIL} </span></p>\r\n</div>\r\n<p style=\"line-height: 1.56; margin-top: 0; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 14px; font-weight: bold; text-align: left; color: #212121; display: block; line-height: 20px; margin-bottom: 4px;\">SMS updates sent to</span> <span style=\"font-family: Arial; font-size: 12px; color: #212121;\">{USER_PHONE}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"padding-left: 15px; padding-right: 15px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; text-align: left; color: #212121; padding-top: 0px; padding-bottom: 0px; line-height: 19px; margin-top: 0; margin-bottom: 0;\">Thank you for your Order. We will send a confirmation when your order status update by our partners.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin-top: 0px;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #f0f0f0; font-size: 0px; line-height: 0px;\" bgcolor=\"#f0f0f0\" height=\"1\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"background-color: #fff; width: 642px; max-width: 642px; padding: 0px 20px 0px 20px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>{PRODUCTS_DETAILS}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 642px; max-width: 642px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin: 0; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"color: #212121; display: block; margin: 0 auto; clear: both;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; display: block;\" align=\"left\" valign=\"top\">\r\n<table style=\"margin-bottom: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"40%\">&nbsp;</td>\r\n<td align=\"right\" width=\"34%\">\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; line-height: 14px; padding-top: 0px; margin-bottom: 0;\"><span style=\"color: #212121; text-align: right; font-weight: bold;\">Amount</span></p>\r\n</td>\r\n<td>\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; padding-top: 0px; margin-bottom: 0;\"><span style=\"padding-right: 0px; font-weight: bold;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 640px; max-width: 640px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr class=\"m_-4345841705994091849col\" style=\"color: #212121;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; border-bottom: 1px solid #f0f0f0;\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 1.86; color: #212121;\">Thank you for Order with <a href=\"https://www.ebuy.om/\">{STORE_NAME}!</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; margin-top: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 60%; text-align: left;\">&nbsp;</td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{APP_LINK}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{AND_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{IOS_APP}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{IOS_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"margin: 0 auto; width: 600px; max-width: 600px; margin-top: 4px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style=\"font-family: Arial; font-size: 10px; color: #878787;\">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2023-08-26 11:57:59'),
(4, 'Return Order Email ', 'Return Order Email ', '<p>&nbsp;Return Order Email&nbsp;</p>', '2021-03-14 07:55:07'),
(5, 'Order Delivered', 'Your order has been delivered', '<table style=\"width: 100%!important;\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px!important; text-align: center; margin: 0 auto; background-color: #0a0909;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%; text-align: left; padding-top: 5px;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"site_url\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none;\" src=\"site_logo\" alt=\"\" border=\"0\" /> </a></td>\r\n<td style=\"width: 60%; text-align: right; padding-top: 5px;\">\r\n<p style=\"color: #ffffff; font-family: Arial; font-size: 16px; text-align: right; font-style: normal; font-stretch: normal;\">Order:&nbsp;<span style=\"font-weight: bold;\">Delivered</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\">\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px; background-color: #fff; padding-top: 20px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" align=\"left\">\r\n<table border=\"0\" width=\"350\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 12px; font-weight: normal; font-style: normal; font-stretch: normal; margin-top: 0px; line-height: 14px; padding-top: 0px; margin-bottom: 7px;\">Hi <span style=\"font-weight: bold; color: #191919;\"> {USER_NAME},</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; color: #878787; line-height: 14px; padding-top: 0px; margin-top: 0px; margin-bottom: 7px;\">Your Order has been successfully delivered.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\" width=\"250\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 11px; font-weight: normal; text-align: right; font-style: normal; line-height: 14px; font-stretch: normal; margin-top: 0px; padding-top: 0px; margin-bottom: 7px;\">Order ID {<strong>ORDER_ID</strong>}</p>\r\n<p style=\"font-family: Arial; font-size: 11px; color: #878787; line-height: 14px; text-align: right; padding-top: 0px; margin-top: 0; margin-bottom: 7px;\">&nbsp;</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" style=\"background-color: rgba(245,245,245,0.5); background: rgba(245,245,245,0.5); border: .08em solid #6ed49e; border-radius: 2px; padding-top: 20px; padding-bottom: 20px;\" align=\"left\">\r\n<table style=\"margin-bottom: 20px; padding-left: 15px;\" border=\"0\" width=\"360\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 20px;\"><span style=\"display: inline-block; width: 125px; vertical-align: top;\">Order placed on</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{ORDER_DATE}</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-bottom: 20px; margin-top: 0px;\"><span style=\"display: inline-block; width: 125px; min-width: 125px; max-width: 125px;\">Amount</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{AMOUNT_PAID} </span></p>\r\n<p style=\"margin-bottom: 0px; margin-top: 0;\"><a style=\"background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;\" href=\"{MANAGE_ORDER}\" target=\"_blank\" rel=\"noopener noreferrer\">Manage Your Order</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin-bottom: 30px; padding-right: 15px;\" border=\"0\" width=\"225\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<div style=\"max-width: 220px; padding-top: 0px; margin-bottom: 20px;\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 20px; color: #212121; margin-top: 0px; margin-bottom: 4px;\">Order Details</p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\">{USER_NAME} <br /> <span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\"> {USER_EMAIL}</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\">{USER_ADDRESS}</span></p>\r\n</div>\r\n<p style=\"line-height: 1.56; margin-top: 0; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 14px; font-weight: bold; text-align: left; color: #212121; display: block; line-height: 20px; margin-bottom: 4px;\">SMS updates sent to</span> <span style=\"font-family: Arial; font-size: 12px; color: #212121;\">{USER_PHONE}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"padding-left: 15px; padding-right: 15px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; text-align: left; color: #212121; padding-top: 0px; padding-bottom: 0px; line-height: 19px; margin-top: 0; margin-bottom: 0;\">Thank you for your Order. We will send a confirmation when your Order status update by our partners.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin-top: 0px;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #f0f0f0; font-size: 0px; line-height: 0px;\" bgcolor=\"#f0f0f0\" height=\"1\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"background-color: #fff; width: 642px; max-width: 642px; padding: 0px 20px 0px 20px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>{PRODUCTS_DETAILS}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 642px; max-width: 642px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin: 0; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"color: #212121; display: block; margin: 0 auto; clear: both;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; display: block;\" align=\"left\" valign=\"top\">\r\n<table style=\"margin-bottom: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"40%\">&nbsp;</td>\r\n<td align=\"right\" width=\"34%\">\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; line-height: 14px; padding-top: 0px; margin-bottom: 0;\"><span style=\"color: #212121; text-align: right; font-weight: bold;\">Amount</span></p>\r\n</td>\r\n<td>\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; padding-top: 0px; margin-bottom: 0;\"><span style=\"padding-right: 0px; font-weight: bold;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 640px; max-width: 640px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr class=\"m_-4345841705994091849col\" style=\"color: #212121;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; border-bottom: 1px solid #f0f0f0;\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 1.86; color: #212121;\">Thank you for Order with {STORE_NAME}!</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; margin-top: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 60%; text-align: left;\">&nbsp;</td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{APP_LINK}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{AND_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{IOS_APP}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{IOS_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"margin: 0 auto; width: 600px; max-width: 600px; margin-top: 4px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style=\"font-family: Arial; font-size: 10px; color: #878787;\">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2022-06-27 14:55:12');
INSERT INTO `email_template` (`id`, `email_title`, `email_subject`, `email_body`, `created_at`) VALUES
(6, 'Order Received Notification', 'Order Received', '<!DOCTYPE html\r\n    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta content=\"width=device-width, initial-scale=1\" name=\"viewport\">\r\n    <meta name=\"x-apple-disable-message-reformatting\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <meta content=\"telephone=no\" name=\"format-detection\">\r\n    <title></title>\r\n    <!--[if (mso 16)]>\r\n    <style type=\"text/css\">\r\n    a {text-decoration: none;}\r\n    </style>\r\n    <![endif]-->\r\n    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->\r\n    <!--[if gte mso 9]>\r\n<xml>\r\n    <o:OfficeDocumentSettings>\r\n    <o:AllowPNG></o:AllowPNG>\r\n    <o:PixelsPerInch>96</o:PixelsPerInch>\r\n    </o:OfficeDocumentSettings>\r\n</xml>\r\n<![endif]-->\r\n    <!--[if !mso]><!-- -->\r\n    <style>\r\n        /* CONFIG STYLES Please do not delete and edit CSS styles below */\r\n        /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */\r\n        #outlook a {\r\n            padding: 0;\r\n        }\r\n\r\n        .ExternalClass {\r\n            width: 100%;\r\n        }\r\n\r\n        .ExternalClass,\r\n        .ExternalClass p,\r\n        .ExternalClass span,\r\n        .ExternalClass font,\r\n        .ExternalClass td,\r\n        .ExternalClass div {\r\n            line-height: 100%;\r\n        }\r\n\r\n        .es-button {\r\n            mso-style-priority: 100 !important;\r\n            text-decoration: none !important;\r\n        }\r\n\r\n        a[x-apple-data-detectors] {\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n            font-size: inherit !important;\r\n            font-family: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n        }\r\n\r\n        .es-desk-hidden {\r\n            display: none;\r\n            float: left;\r\n            overflow: hidden;\r\n            width: 0;\r\n            max-height: 0;\r\n            line-height: 0;\r\n            mso-hide: all;\r\n        }\r\n\r\n        /*\r\nEND OF IMPORTANT\r\n*/\r\n        s {\r\n            text-decoration: line-through;\r\n        }\r\n\r\n        body {\r\n            width: 100%;\r\n            font-family: \'Open Sans\', sans-serif;\r\n            -webkit-text-size-adjust: 100%;\r\n            -ms-text-size-adjust: 100%;\r\n        }\r\n\r\n        table {\r\n            mso-table-lspace: 0pt;\r\n            mso-table-rspace: 0pt;\r\n            border-collapse: collapse;\r\n            border-spacing: 0px;\r\n        }\r\n\r\n        table td,\r\n        html,\r\n        body,\r\n        .es-wrapper {\r\n            padding: 0;\r\n            Margin: 0;\r\n        }\r\n\r\n        .es-content,\r\n        .es-header,\r\n        .es-footer {\r\n            table-layout: fixed !important;\r\n            width: 100%;\r\n        }\r\n\r\n        img {\r\n            display: block;\r\n            border: 0;\r\n            outline: none;\r\n            text-decoration: none;\r\n            -ms-interpolation-mode: bicubic;\r\n        }\r\n\r\n        table tr {\r\n            border-collapse: collapse;\r\n        }\r\n\r\n        p,\r\n        hr {\r\n            Margin: 0;\r\n        }\r\n\r\n        h1,\r\n        h2,\r\n        h3,\r\n        h4,\r\n        h5 {\r\n            Margin: 0;\r\n            line-height: 120%;\r\n            mso-line-height-rule: exactly;\r\n            font-family: roboto, \'helvetica neue\', helvetica, arial, sans-serif;\r\n        }\r\n\r\n        p,\r\n        ul li,\r\n        ol li,\r\n        a {\r\n            -webkit-text-size-adjust: none;\r\n            -ms-text-size-adjust: none;\r\n            mso-line-height-rule: exactly;\r\n        }\r\n\r\n        .es-left {\r\n            float: left;\r\n        }\r\n\r\n        .es-right {\r\n            float: right;\r\n        }\r\n\r\n        .es-p5 {\r\n            padding: 5px;\r\n        }\r\n\r\n        .es-p5t {\r\n            padding-top: 5px;\r\n        }\r\n\r\n        .es-p5b {\r\n            padding-bottom: 5px;\r\n        }\r\n\r\n        .es-p5l {\r\n            padding-left: 5px;\r\n        }\r\n\r\n        .es-p5r {\r\n            padding-right: 5px;\r\n        }\r\n\r\n        .es-p10 {\r\n            padding: 10px;\r\n        }\r\n\r\n        .es-p10t {\r\n            padding-top: 10px;\r\n        }\r\n\r\n        .es-p10b {\r\n            padding-bottom: 10px;\r\n        }\r\n\r\n        .es-p10l {\r\n            padding-left: 10px;\r\n        }\r\n\r\n        .es-p10r {\r\n            padding-right: 10px;\r\n        }\r\n\r\n        .es-p15 {\r\n            padding: 15px;\r\n        }\r\n\r\n        .es-p15t {\r\n            padding-top: 15px;\r\n        }\r\n\r\n        .es-p15b {\r\n            padding-bottom: 15px;\r\n        }\r\n\r\n        .es-p15l {\r\n            padding-left: 15px;\r\n        }\r\n\r\n        .es-p15r {\r\n            padding-right: 15px;\r\n        }\r\n\r\n        .es-p20 {\r\n            padding: 20px;\r\n        }\r\n\r\n        .es-p20t {\r\n            padding-top: 20px;\r\n        }\r\n\r\n        .es-p20b {\r\n            padding-bottom: 20px;\r\n        }\r\n\r\n        .es-p20l {\r\n            padding-left: 20px;\r\n        }\r\n\r\n        .es-p20r {\r\n            padding-right: 20px;\r\n        }\r\n\r\n        .es-p25 {\r\n            padding: 25px;\r\n        }\r\n\r\n        .es-p25t {\r\n            padding-top: 25px;\r\n        }\r\n\r\n        .es-p25b {\r\n            padding-bottom: 25px;\r\n        }\r\n\r\n        .es-p25l {\r\n            padding-left: 25px;\r\n        }\r\n\r\n        .es-p25r {\r\n            padding-right: 25px;\r\n        }\r\n\r\n        .es-p30 {\r\n            padding: 30px;\r\n        }\r\n\r\n        .es-p30t {\r\n            padding-top: 30px;\r\n        }\r\n\r\n        .es-p30b {\r\n            padding-bottom: 30px;\r\n        }\r\n\r\n        .es-p30l {\r\n            padding-left: 30px;\r\n        }\r\n\r\n        .es-p30r {\r\n            padding-right: 30px;\r\n        }\r\n\r\n        .es-p35 {\r\n            padding: 35px;\r\n        }\r\n\r\n        .es-p35t {\r\n            padding-top: 35px;\r\n        }\r\n\r\n        .es-p35b {\r\n            padding-bottom: 35px;\r\n        }\r\n\r\n        .es-p35l {\r\n            padding-left: 35px;\r\n        }\r\n\r\n        .es-p35r {\r\n            padding-right: 35px;\r\n        }\r\n\r\n        .es-p40 {\r\n            padding: 40px;\r\n        }\r\n\r\n        .es-p40t {\r\n            padding-top: 40px;\r\n        }\r\n\r\n        .es-p40b {\r\n            padding-bottom: 40px;\r\n        }\r\n\r\n        .es-p40l {\r\n            padding-left: 40px;\r\n        }\r\n\r\n        .es-p40r {\r\n            padding-right: 40px;\r\n        }\r\n\r\n        .es-menu td {\r\n            border: 0;\r\n        }\r\n\r\n        .es-menu td a img {\r\n            display: inline-block !important;\r\n        }\r\n\r\n        /* END CONFIG STYLES */\r\n        a {\r\n            text-decoration: none;\r\n        }\r\n\r\n        p,\r\n        ul li,\r\n        ol li {\r\n            font-family: \'Open Sans\', sans-serif;\r\n            line-height: 150%;\r\n        }\r\n\r\n        ul li,\r\n        ol li {\r\n            Margin-bottom: 15px;\r\n            margin-left: 0;\r\n        }\r\n\r\n        .es-menu td a {\r\n            text-decoration: none;\r\n            display: block;\r\n            font-family: \'Open Sans\', sans-serif;\r\n        }\r\n\r\n        .es-wrapper {\r\n            width: 100%;\r\n            height: 100%;\r\n            background-repeat: repeat;\r\n            background-position: center top;\r\n        }\r\n\r\n        .es-wrapper-color,\r\n        .es-wrapper {\r\n            background-color: #eff2f7;\r\n        }\r\n\r\n        .es-header {\r\n            background-color: #0050d8;\r\n            background-repeat: repeat;\r\n            background-position: center top;\r\n        }\r\n\r\n        .es-header-body {\r\n            background-color: #0c66ff;\r\n        }\r\n\r\n        .es-header-body p,\r\n        .es-header-body ul li,\r\n        .es-header-body ol li {\r\n            color: #efefef;\r\n            font-size: 12px;\r\n        }\r\n\r\n        .es-header-body a {\r\n            color: #ffffff;\r\n            font-size: 12px;\r\n        }\r\n\r\n        .es-content-body {\r\n            background-color: #fefefe;\r\n        }\r\n\r\n        .es-content-body p,\r\n        .es-content-body ul li,\r\n        .es-content-body ol li {\r\n            color: #8492a6;\r\n            font-size: 14px;\r\n        }\r\n\r\n        .es-content-body a {\r\n            color: #0c66ff;\r\n            font-size: 14px;\r\n        }\r\n\r\n        .es-footer {\r\n            background-color: #141b24;\r\n            background-repeat: repeat;\r\n            background-position: center top;\r\n        }\r\n\r\n        .es-footer-body {\r\n            background-color: #273444;\r\n        }\r\n\r\n        .es-footer-body p,\r\n        .es-footer-body ul li,\r\n        .es-footer-body ol li {\r\n            color: #8492a6;\r\n            font-size: 12px;\r\n        }\r\n\r\n        .es-footer-body a {\r\n            color: #ffffff;\r\n            font-size: 12px;\r\n        }\r\n\r\n        .es-infoblock,\r\n        .es-infoblock p,\r\n        .es-infoblock ul li,\r\n        .es-infoblock ol li {\r\n            line-height: 120%;\r\n            font-size: 16px;\r\n            color: #ffffff;\r\n        }\r\n\r\n        .es-infoblock a {\r\n            font-size: 16px;\r\n            color: #ffffff;\r\n        }\r\n\r\n        h1 {\r\n            font-size: 26px;\r\n            font-style: normal;\r\n            font-weight: bold;\r\n            color: #3c4858;\r\n        }\r\n\r\n        h2 {\r\n            font-size: 18px;\r\n            font-style: normal;\r\n            font-weight: normal;\r\n            color: #3c4858;\r\n        }\r\n\r\n        h3 {\r\n            font-size: 16px;\r\n            font-style: normal;\r\n            font-weight: bold;\r\n            color: #888888;\r\n            letter-spacing: 0px;\r\n        }\r\n\r\n        .es-header-body h1 a,\r\n        .es-content-body h1 a,\r\n        .es-footer-body h1 a {\r\n            font-size: 26px;\r\n        }\r\n\r\n        .es-header-body h2 a,\r\n        .es-content-body h2 a,\r\n        .es-footer-body h2 a {\r\n            font-size: 18px;\r\n        }\r\n\r\n        .es-header-body h3 a,\r\n        .es-content-body h3 a,\r\n        .es-footer-body h3 a {\r\n            font-size: 16px;\r\n        }\r\n\r\n        a.es-button,\r\n        button.es-button {\r\n            padding: 15px 30px 15px 30px;\r\n            display: inline-block;\r\n            background: #0c66ff;\r\n            border-radius: 0px;\r\n            font-size: 14px;\r\n            font-family: \'Open Sans\', sans-serif;\r\n            font-weight: bold;\r\n            font-style: normal;\r\n            line-height: 120%;\r\n            color: #ffffff;\r\n            text-decoration: none;\r\n            width: auto;\r\n            text-align: center;\r\n            mso-padding-alt: 0;\r\n            mso-border-alt: 10px solid #0c66ff;\r\n        }\r\n\r\n        .es-button-border {\r\n            border-style: solid solid solid solid;\r\n            border-color: #0c66ff #0c66ff #0c66ff #0c66ff;\r\n            background: #0c66ff;\r\n            border-width: 0px 0px 0px 0px;\r\n            display: inline-block;\r\n            border-radius: 0px;\r\n            width: auto;\r\n        }\r\n\r\n        .msohide {\r\n            mso-hide: all;\r\n        }\r\n\r\n        /* RESPONSIVE STYLES Please do not delete and edit CSS styles below. If you don\'t need responsive layout, please delete this section. */\r\n        @media only screen and (max-width: 600px) {\r\n\r\n            p,\r\n            ul li,\r\n            ol li,\r\n            a {\r\n                line-height: 150% !important;\r\n            }\r\n\r\n            h1,\r\n            h2,\r\n            h3,\r\n            h1 a,\r\n            h2 a,\r\n            h3 a {\r\n                line-height: 120%;\r\n            }\r\n\r\n            h1 {\r\n                font-size: 28px !important;\r\n                text-align: left;\r\n            }\r\n\r\n            h2 {\r\n                font-size: 20px !important;\r\n                text-align: left;\r\n            }\r\n\r\n            h3 {\r\n                font-size: 14px !important;\r\n                text-align: left;\r\n            }\r\n\r\n            h1 a {\r\n                text-align: left;\r\n            }\r\n\r\n            .es-header-body h1 a,\r\n            .es-content-body h1 a,\r\n            .es-footer-body h1 a {\r\n                font-size: 28px !important;\r\n            }\r\n\r\n            h2 a {\r\n                text-align: left;\r\n            }\r\n\r\n            .es-header-body h2 a,\r\n            .es-content-body h2 a,\r\n            .es-footer-body h2 a {\r\n                font-size: 20px !important;\r\n            }\r\n\r\n            h3 a {\r\n                text-align: left;\r\n            }\r\n\r\n            .es-header-body h3 a,\r\n            .es-content-body h3 a,\r\n            .es-footer-body h3 a {\r\n                font-size: 14px !important;\r\n            }\r\n\r\n            .es-menu td a {\r\n                font-size: 12px !important;\r\n            }\r\n\r\n            .es-header-body p,\r\n            .es-header-body ul li,\r\n            .es-header-body ol li,\r\n            .es-header-body a {\r\n                font-size: 12px !important;\r\n            }\r\n\r\n            .es-content-body p,\r\n            .es-content-body ul li,\r\n            .es-content-body ol li,\r\n            .es-content-body a {\r\n                font-size: 12px !important;\r\n            }\r\n\r\n            .es-footer-body p,\r\n            .es-footer-body ul li,\r\n            .es-footer-body ol li,\r\n            .es-footer-body a {\r\n                font-size: 12px !important;\r\n            }\r\n\r\n            .es-infoblock p,\r\n            .es-infoblock ul li,\r\n            .es-infoblock ol li,\r\n            .es-infoblock a {\r\n                font-size: 12px !important;\r\n            }\r\n\r\n            *[class=\"gmail-fix\"] {\r\n                display: none !important;\r\n            }\r\n\r\n            .es-m-txt-c,\r\n            .es-m-txt-c h1,\r\n            .es-m-txt-c h2,\r\n            .es-m-txt-c h3 {\r\n                text-align: center !important;\r\n            }\r\n\r\n            .es-m-txt-r,\r\n            .es-m-txt-r h1,\r\n            .es-m-txt-r h2,\r\n            .es-m-txt-r h3 {\r\n                text-align: right !important;\r\n            }\r\n\r\n            .es-m-txt-l,\r\n            .es-m-txt-l h1,\r\n            .es-m-txt-l h2,\r\n            .es-m-txt-l h3 {\r\n                text-align: left !important;\r\n            }\r\n\r\n            .es-m-txt-r img,\r\n            .es-m-txt-c img,\r\n            .es-m-txt-l img {\r\n                display: inline !important;\r\n            }\r\n\r\n            .es-button-border {\r\n                display: block !important;\r\n            }\r\n\r\n            a.es-button,\r\n            button.es-button {\r\n                font-size: 14px !important;\r\n                display: block !important;\r\n                border-bottom-width: 20px !important;\r\n                border-right-width: 0px !important;\r\n                border-left-width: 0px !important;\r\n                padding-left: 0px !important;\r\n                padding-right: 0px !important;\r\n            }\r\n\r\n            .es-btn-fw {\r\n                border-width: 10px 0px !important;\r\n                text-align: center !important;\r\n            }\r\n\r\n            .es-adaptive table,\r\n            .es-btn-fw,\r\n            .es-btn-fw-brdr,\r\n            .es-left,\r\n            .es-right {\r\n                width: 100% !important;\r\n            }\r\n\r\n            .es-content table,\r\n            .es-header table,\r\n            .es-footer table,\r\n            .es-content,\r\n            .es-footer,\r\n            .es-header {\r\n                width: 100% !important;\r\n                max-width: 600px !important;\r\n            }\r\n\r\n            .es-adapt-td {\r\n                display: block !important;\r\n                width: 100% !important;\r\n            }\r\n\r\n            .adapt-img {\r\n                width: 100% !important;\r\n                height: auto !important;\r\n            }\r\n\r\n            .es-m-p0 {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            .es-m-p0r {\r\n                padding-right: 0 !important;\r\n            }\r\n\r\n            .es-m-p0l {\r\n                padding-left: 0 !important;\r\n            }\r\n\r\n            .es-m-p0t {\r\n                padding-top: 0 !important;\r\n            }\r\n\r\n            .es-m-p0b {\r\n                padding-bottom: 0 !important;\r\n            }\r\n\r\n            .es-m-p20b {\r\n                padding-bottom: 20px !important;\r\n            }\r\n\r\n            .es-mobile-hidden,\r\n            .es-hidden {\r\n                display: none !important;\r\n            }\r\n\r\n            tr.es-desk-hidden,\r\n            td.es-desk-hidden,\r\n            table.es-desk-hidden {\r\n                width: auto !important;\r\n                overflow: visible !important;\r\n                float: none !important;\r\n                max-height: inherit !important;\r\n                line-height: inherit !important;\r\n            }\r\n\r\n            tr.es-desk-hidden {\r\n                display: table-row !important;\r\n            }\r\n\r\n            table.es-desk-hidden {\r\n                display: table !important;\r\n            }\r\n\r\n            td.es-desk-menu-hidden {\r\n                display: table-cell !important;\r\n            }\r\n\r\n            table.es-table-not-adapt,\r\n            .esd-block-html table {\r\n                width: auto !important;\r\n            }\r\n\r\n            table.es-social {\r\n                display: inline-block !important;\r\n            }\r\n\r\n            table.es-social td {\r\n                display: inline-block !important;\r\n            }\r\n\r\n            .es-desk-hidden {\r\n                display: table-row !important;\r\n                width: auto !important;\r\n                overflow: visible !important;\r\n                max-height: inherit !important;\r\n            }\r\n\r\n            .h-auto {\r\n                height: auto !important;\r\n            }\r\n\r\n            .es-m-p5 {\r\n                padding: 5px !important;\r\n            }\r\n\r\n            .es-m-p5t {\r\n                padding-top: 5px !important;\r\n            }\r\n\r\n            .es-m-p5b {\r\n                padding-bottom: 5px !important;\r\n            }\r\n\r\n            .es-m-p5r {\r\n                padding-right: 5px !important;\r\n            }\r\n\r\n            .es-m-p5l {\r\n                padding-left: 5px !important;\r\n            }\r\n\r\n            .es-m-p10 {\r\n                padding: 10px !important;\r\n            }\r\n\r\n            .es-m-p10t {\r\n                padding-top: 10px !important;\r\n            }\r\n\r\n            .es-m-p10b {\r\n                padding-bottom: 10px !important;\r\n            }\r\n\r\n            .es-m-p10r {\r\n                padding-right: 10px !important;\r\n            }\r\n\r\n            .es-m-p10l {\r\n                padding-left: 10px !important;\r\n            }\r\n\r\n            .es-m-p15 {\r\n                padding: 15px !important;\r\n            }\r\n\r\n            .es-m-p15t {\r\n                padding-top: 15px !important;\r\n            }\r\n\r\n            .es-m-p15b {\r\n                padding-bottom: 15px !important;\r\n            }\r\n\r\n            .es-m-p15r {\r\n                padding-right: 15px !important;\r\n            }\r\n\r\n            .es-m-p15l {\r\n                padding-left: 15px !important;\r\n            }\r\n\r\n            .es-m-p20 {\r\n                padding: 20px !important;\r\n            }\r\n\r\n            .es-m-p20t {\r\n                padding-top: 20px !important;\r\n            }\r\n\r\n            .es-m-p20r {\r\n                padding-right: 20px !important;\r\n            }\r\n\r\n            .es-m-p20l {\r\n                padding-left: 20px !important;\r\n            }\r\n\r\n            .es-m-p25 {\r\n                padding: 25px !important;\r\n            }\r\n\r\n            .es-m-p25t {\r\n                padding-top: 25px !important;\r\n            }\r\n\r\n            .es-m-p25b {\r\n                padding-bottom: 25px !important;\r\n            }\r\n\r\n            .es-m-p25r {\r\n                padding-right: 25px !important;\r\n            }\r\n\r\n            .es-m-p25l {\r\n                padding-left: 25px !important;\r\n            }\r\n\r\n            .es-m-p30 {\r\n                padding: 30px !important;\r\n            }\r\n\r\n            .es-m-p30t {\r\n                padding-top: 30px !important;\r\n            }\r\n\r\n            .es-m-p30b {\r\n                padding-bottom: 30px !important;\r\n            }\r\n\r\n            .es-m-p30r {\r\n                padding-right: 30px !important;\r\n            }\r\n\r\n            .es-m-p30l {\r\n                padding-left: 30px !important;\r\n            }\r\n\r\n            .es-m-p35 {\r\n                padding: 35px !important;\r\n            }\r\n\r\n            .es-m-p35t {\r\n                padding-top: 35px !important;\r\n            }\r\n\r\n            .es-m-p35b {\r\n                padding-bottom: 35px !important;\r\n            }\r\n\r\n            .es-m-p35r {\r\n                padding-right: 35px !important;\r\n            }\r\n\r\n            .es-m-p35l {\r\n                padding-left: 35px !important;\r\n            }\r\n\r\n            .es-m-p40 {\r\n                padding: 40px !important;\r\n            }\r\n\r\n            .es-m-p40t {\r\n                padding-top: 40px !important;\r\n            }\r\n\r\n            .es-m-p40b {\r\n                padding-bottom: 40px !important;\r\n            }\r\n\r\n            .es-m-p40r {\r\n                padding-right: 40px !important;\r\n            }\r\n\r\n            .es-m-p40l {\r\n                padding-left: 40px !important;\r\n            }\r\n        }\r\n\r\n        /* END RESPONSIVE STYLES */\r\n        .es-p-default {\r\n            padding-top: 20px;\r\n            padding-right: 15px;\r\n            padding-bottom: 0px;\r\n            padding-left: 15px;\r\n        }\r\n\r\n        .es-p-all-default {\r\n            padding: 0px;\r\n        }\r\n    </style>\r\n    <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i\" rel=\"stylesheet\">\r\n    <link href=\"https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i\" rel=\"stylesheet\">\r\n    <!--<![endif]-->\r\n</head>\r\n\r\n<body>\r\n    <div class=\"es-wrapper-color\">\r\n        <!--[if gte mso 9]>\r\n			<v:background xmlns:v=\"urn:schemas-microsoft-com:vml\" fill=\"t\">\r\n				<v:fill type=\"tile\" color=\"#eff2f7\"></v:fill>\r\n			</v:background>\r\n		<![endif]-->\r\n        <table class=\"es-wrapper\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n            <tbody>\r\n                <tr>\r\n                    <td class=\"esd-email-paddings\" valign=\"top\">\r\n                        <table class=\"es-header esd-header-popover\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td class=\"esd-stripe\" align=\"center\" bgcolor=\"#999\"\r\n                                        style=\"background-color: #999999;\">\r\n                                        <table class=\"es-header-body\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\"\r\n                                            bgcolor=\"#dedede\" align=\"center\" style=\"background-color: #dedede;\">\r\n                                            <tbody>\r\n                                                <tr>\r\n                                                    <td class=\"esd-structure es-p20t es-p20b es-p15r es-p15l\"\r\n                                                        align=\"left\">\r\n                                                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\r\n                                                            <tbody>\r\n                                                                <tr>\r\n                                                                    <td class=\"es-m-p0r esd-container-frame\" width=\"570\"\r\n                                                                        valign=\"top\" align=\"center\">\r\n                                                                        <table width=\"100%\" cellspacing=\"0\"\r\n                                                                            cellpadding=\"0\">\r\n                                                                            <tbody>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-image es-m-txt-c\"\r\n                                                                                        style=\"font-size: 0px;\"><a\r\n                                                                                            target=\"_blank\"\r\n                                                                                            href=\"{BASE_URL}\"><img\r\n                                                                                                src=\"{BASE_URL}assets_web/images/logo-appbar.png\"\r\n                                                                                                alt\r\n                                                                                                style=\"display: block;\"\r\n                                                                                                width=\"100\"></a></td>\r\n                                                                                </tr>\r\n                                                                            </tbody>\r\n                                                                        </table>\r\n                                                                    </td>\r\n                                                                </tr>\r\n                                                            </tbody>\r\n                                                        </table>\r\n                                                    </td>\r\n                                                </tr>\r\n                                            </tbody>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                        <table class=\"es-content\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td class=\"esd-stripe\" align=\"center\">\r\n                                        <table class=\"es-content-body\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\"\r\n                                            bgcolor=\"#fefefe\" align=\"center\" style=\"background-color: #fefefe;\">\r\n                                            <tbody>\r\n                                                <tr>\r\n                                                    <td class=\"esd-structure es-p20t es-p15r es-p15l\" align=\"left\"\r\n                                                        bgcolor=\"#ffffff\" style=\"background-color: #ffffff;\">\r\n                                                        <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                                            <tbody>\r\n                                                                <tr>\r\n                                                                    <td width=\"570\" class=\"esd-container-frame\"\r\n                                                                        align=\"center\" valign=\"top\">\r\n                                                                        <table cellpadding=\"0\" cellspacing=\"0\"\r\n                                                                            width=\"100%\">\r\n                                                                            <tbody>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-text\">\r\n                                                                                        <h1>Order Received</h1>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"left\" class=\"esd-block-text es-p10t\">\r\n                                                                                        <p><strong>Hello&nbsp;Admin,</strong><br><span style=\"font-size:13px;\">{EMAIL_MESSAGE}</span></p>\r\n                                                                                        <p style=\"font-size: 13px;\"></p>\r\n                                                                                        <p style=\"font-size: 16px; text-align: center; color: #000000;\"><strong>ORDER#{ORDER_ID}</strong></p>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                            </tbody>\r\n                                                                        </table>\r\n                                                                    </td>\r\n                                                                </tr>\r\n                                                            </tbody>\r\n                                                        </table>\r\n                                                    </td>\r\n                                                </tr>\r\n                                                {PRODUCT_DETAILS}\r\n                                                <tr>\r\n                                                    <td class=\"esd-structure es-p10t es-p5b es-p15r es-p15l\"\r\n                                                        align=\"left\">\r\n                                                        <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                                            <tbody>\r\n                                                                <tr>\r\n                                                                    <td width=\"570\" class=\"esd-container-frame\"\r\n                                                                        align=\"center\" valign=\"top\">\r\n                                                                        <table cellpadding=\"0\" cellspacing=\"0\"\r\n                                                                            width=\"100%\">\r\n                                                                            <tbody>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-spacer es-p20b es-p20r es-p20l\"\r\n                                                                                        style=\"font-size:0\">\r\n                                                                                        <table border=\"0\" width=\"100%\"\r\n                                                                                            height=\"100%\"\r\n                                                                                            cellpadding=\"0\"\r\n                                                                                            cellspacing=\"0\">\r\n                                                                                            <tbody>\r\n                                                                                                <tr>\r\n                                                                                                    <td\r\n                                                                                                        style=\"border-bottom: 1px solid #cccccc; background: unset; height:1px; width:100%; margin:0px 0px 0px 0px;\">\r\n                                                                                                    </td>\r\n                                                                                                </tr>\r\n                                                                                            </tbody>\r\n                                                                                        </table>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"left\"\r\n                                                                                        class=\"esd-block-text es-p10t es-p20b es-p10l es-m-p0l\">\r\n                                                                                        <p style=\"font-size: 15px;\">\r\n                                                                                            <strong>Customer\r\n                                                                                                Details</strong></p>\r\n                                                                                        <p><strong>Name:</strong>\r\n                                                                                            {CUSTOMER_NAME}</p>\r\n                                                                                        <p><strong>Email:</strong>\r\n                                                                                            {CUSTOMER_EMAIL}</p>\r\n                                                                                        <p><strong>Phone:</strong>\r\n                                                                                            {CUSTOMER_PHONE}</p>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-text es-p20t\">\r\n                                                                                        <p style=\"font-size: 12px;\">Log\r\n                                                                                            In to Admin Panel to manage\r\n                                                                                            this order</p>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-button es-p20b\">\r\n                                                                                        <!--[if mso]><a href=\"https://viewstripo.email/\" target=\"_blank\" hidden>\r\n	<v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" esdevVmlButton href=\"https://viewstripo.email/\" \r\n                style=\"height:46px; v-text-anchor:middle; width:179px\" arcsize=\"0%\" stroke=\"f\"  fillcolor=\"#ff6600\">\r\n		<w:anchorlock></w:anchorlock>\r\n		<center style=\'color:#ffffff; font-family:\"Open Sans\", sans-serif; font-size:14px; font-weight:700; line-height:14px;  mso-text-raise:1px\'>Manage Order</center>\r\n	</v:roundrect></a>\r\n<![endif]-->\r\n                                                                                        <!--[if !mso]><!-- --><span\r\n                                                                                            class=\"msohide es-button-border\"\r\n                                                                                            style=\"background: #ff6600;\"><a\r\n                                                                                                href=\"{BASE_URL}admin/buy-from-turkey-orders.php\"\r\n                                                                                                class=\"es-button es-button-1690229776237\"\r\n                                                                                                target=\"_blank\"\r\n                                                                                                style=\"background: #ff6600; padding: 15px 30px;\">Manage\r\n                                                                                                Order</a></span>\r\n                                                                                        <!--<![endif]-->\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                            </tbody>\r\n                                                                        </table>\r\n                                                                    </td>\r\n                                                                </tr>\r\n                                                            </tbody>\r\n                                                        </table>\r\n                                                    </td>\r\n                                                </tr>\r\n                                            </tbody>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                        <table cellpadding=\"0\" cellspacing=\"0\" class=\"es-footer esd-footer-popover\" align=\"center\">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td class=\"esd-stripe\" align=\"center\" bgcolor=\"#999\"\r\n                                        style=\"background-color: #999999;\">\r\n                                        <table class=\"es-footer-body\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\"\r\n                                            bgcolor=\"#dedede\" align=\"center\" style=\"background-color: #dedede;\">\r\n                                            <tbody>\r\n                                                <tr>\r\n                                                    <td class=\"esd-structure es-p40t es-p40b es-p15r es-p15l\"\r\n                                                        align=\"left\">\r\n                                                        <!--[if mso]><table width=\"570\" cellpadding=\"0\" \r\n                        cellspacing=\"0\"><tr><td width=\"173\" valign=\"top\"><![endif]-->\r\n                                                        <table class=\"es-left\" cellspacing=\"0\" cellpadding=\"0\"\r\n                                                            align=\"left\">\r\n                                                            <tbody>\r\n                                                                <tr>\r\n                                                                    <td class=\"es-m-p20b esd-container-frame\"\r\n                                                                        width=\"173\" align=\"left\">\r\n                                                                        <table width=\"100%\" cellspacing=\"0\"\r\n                                                                            cellpadding=\"0\">\r\n                                                                            <tbody>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-image es-m-txt-c\"\r\n                                                                                        style=\"font-size: 0px;\"><a\r\n                                                                                            target=\"_blank\"\r\n                                                                                            href=\"{BASE_URL}\"><img\r\n                                                                                                src=\"{BASE_URL}assets_web/images/logo-appbar.png\"\r\n                                                                                                alt\r\n                                                                                                style=\"display: block;\"\r\n                                                                                                width=\"105\"></a></td>\r\n                                                                                </tr>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"center\"\r\n                                                                                        class=\"esd-block-social es-m-txt-c es-p15t\"\r\n                                                                                        style=\"font-size:0\">\r\n                                                                                        <table cellpadding=\"0\"\r\n                                                                                            cellspacing=\"0\"\r\n                                                                                            class=\"es-table-not-adapt es-social\">\r\n                                                                                            <tbody>\r\n                                                                                                <tr>\r\n                                                                                                    <td align=\"center\"\r\n                                                                                                        valign=\"top\"\r\n                                                                                                        esd-tmp-icon-type=\"facebook\"\r\n                                                                                                        class=\"es-p10r\">\r\n                                                                                                        <a target=\"_blank\"\r\n                                                                                                            href><img\r\n                                                                                                                src=\"{BASE_URL}assets_web/images/icons/facebook-logo-white.png\"\r\n                                                                                                                alt=\"Fb\"\r\n                                                                                                                title=\"Facebook\"\r\n                                                                                                                width=\"32\"></a>\r\n                                                                                                    </td>\r\n                                                                                                    <td align=\"center\"\r\n                                                                                                        valign=\"top\"\r\n                                                                                                        esd-tmp-icon-type=\"twitter\"\r\n                                                                                                        class=\"es-p10r\">\r\n                                                                                                        <a target=\"_blank\"\r\n                                                                                                            href><img\r\n                                                                                                                src=\"{BASE_URL}assets_web/images/icons/twitter-logo-white.png\"\r\n                                                                                                                alt=\"Tw\"\r\n                                                                                                                title=\"Twitter\"\r\n                                                                                                                width=\"32\"></a>\r\n                                                                                                    </td>\r\n                                                                                                    <td align=\"center\"\r\n                                                                                                        valign=\"top\"\r\n                                                                                                        esd-tmp-icon-type=\"youtube\"\r\n                                                                                                        class=\"es-p10r\">\r\n                                                                                                        <a target=\"_blank\"\r\n                                                                                                            href><img\r\n                                                                                                                src=\"{BASE_URL}assets_web/images/icons/youtube-logo-white.png\"\r\n                                                                                                                alt=\"Yt\"\r\n                                                                                                                title=\"Youtube\"\r\n                                                                                                                width=\"32\"></a>\r\n                                                                                                    </td>\r\n                                                                                                    <td align=\"center\"\r\n                                                                                                        valign=\"top\"\r\n                                                                                                        esd-tmp-icon-type=\"instagram\">\r\n                                                                                                        <a target=\"_blank\"\r\n                                                                                                            href><img\r\n                                                                                                                src=\"{BASE_URL}assets_web/images/icons/instagram-logo-white.png\"\r\n                                                                                                                alt=\"Ig\"\r\n                                                                                                                title=\"Instagram\"\r\n                                                                                                                width=\"32\"></a>\r\n                                                                                                    </td>\r\n                                                                                                </tr>\r\n                                                                                            </tbody>\r\n                                                                                        </table>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                            </tbody>\r\n                                                                        </table>\r\n                                                                    </td>\r\n                                                                </tr>\r\n                                                            </tbody>\r\n                                                        </table>\r\n                                                        <!--[if mso]></td><td width=\"20\"></td><td width=\"377\" valign=\"top\"><![endif]-->\r\n                                                        <table class=\"es-right\" cellspacing=\"0\" cellpadding=\"0\"\r\n                                                            align=\"right\">\r\n                                                            <tbody>\r\n                                                                <tr>\r\n                                                                    <td class=\"esd-container-frame\" width=\"377\"\r\n                                                                        align=\"left\">\r\n                                                                        <table width=\"100%\" cellspacing=\"0\"\r\n                                                                            cellpadding=\"0\">\r\n                                                                            <tbody>\r\n                                                                                <tr>\r\n                                                                                    <td align=\"left\"\r\n                                                                                        class=\"esd-block-text es-m-txt-c\">\r\n                                                                                        <p>EBuy is a premier e-commerce\r\n                                                                                            platform - one-stop\r\n                                                                                            destination for all your\r\n                                                                                            shopping needs!. we also\r\n                                                                                            offer the unique advantage\r\n                                                                                            of ordering items directly\r\n                                                                                            from Turkey, known for its\r\n                                                                                            rich heritage of exquisite\r\n                                                                                            craftsmanship and\r\n                                                                                            high-quality goods. High\r\n                                                                                            Quality products, Shipping\r\n                                                                                            Anywhere & Easy Return.</p>\r\n                                                                                    </td>\r\n                                                                                </tr>\r\n                                                                            </tbody>\r\n                                                                        </table>\r\n                                                                    </td>\r\n                                                                </tr>\r\n                                                            </tbody>\r\n                                                        </table>\r\n                                                        <!--[if mso]></td></tr></table><![endif]-->\r\n                                                    </td>\r\n                                                </tr>\r\n                                            </tbody>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                    </td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n    </div>\r\n</body>\r\n\r\n</html>', '2023-08-17 19:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `event_image` varchar(500) NOT NULL,
  `cat_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `name`, `event_image`, `cat_id`) VALUES
(11, 'New', '{\"72-72\":\"2023-11-22\\/655d98c500efb.webp\",\"200-200\":\"2023-11-22\\/655d98c500efb.webp\",\"280-310\":\"2023-11-22\\/655d98c500efb.webp\",\"400-200\":\"2023-11-22\\/655d98c500efb.webp\",\"430-590\":\"2023-11-22\\/655d98c500efb.webp\",\"600-810\":\"2023-11-22\\/655d98c500efb.webp\"}', '49'),
(12, 'Diwali offers', '{\"72-72\":\"2023-11-22\\/655d98f660629.webp\",\"200-200\":\"2023-11-22\\/655d98f660629.webp\",\"280-310\":\"2023-11-22\\/655d98f660629.webp\",\"400-200\":\"2023-11-22\\/655d98f660629.webp\",\"430-590\":\"2023-11-22\\/655d98f660629.webp\",\"600-810\":\"2023-11-22\\/655d98f660629.webp\"}', '52'),
(13, 'Diwali offers', '{\"72-72\":\"2023-11-22\\/655d9910843d0.webp\",\"200-200\":\"2023-11-22\\/655d9910843d0.webp\",\"280-310\":\"2023-11-22\\/655d9910843d0.webp\",\"400-200\":\"2023-11-22\\/655d9910843d0.webp\",\"430-590\":\"2023-11-22\\/655d9910843d0.webp\",\"600-810\":\"2023-11-22\\/655d9910843d0.webp\"}', '11'),
(14, 'latest', '{\"72-72\":\"2023-11-22\\/655d992a025f6.webp\",\"200-200\":\"2023-11-22\\/655d992a025f6.webp\",\"280-310\":\"2023-11-22\\/655d992a025f6.webp\",\"400-200\":\"2023-11-22\\/655d992a025f6.webp\",\"430-590\":\"2023-11-22\\/655d992a025f6.webp\",\"600-810\":\"2023-11-22\\/655d992a025f6.webp\"}', '10'),
(15, 'shaadi', '{\"72-72\":\"2023-12-13\\/65797a2abe845.webp\",\"200-200\":\"2023-12-13\\/65797a2abe845.webp\",\"280-310\":\"2023-12-13\\/65797a2abe845.webp\",\"400-200\":\"2023-12-13\\/65797a2abe845.webp\",\"430-590\":\"2023-12-13\\/65797a2abe845.webp\",\"600-810\":\"2023-12-13\\/65797a2abe845.webp\"}', '11,51,22,50,47');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'What is an FAQ Page?', 'Lorem ipsum dolor, sit amet consectetur adipisicing.', 1, '2023-12-07 05:55:20', '2023-12-07 12:25:20', '1'),
(2, 'Why do you need an FAQ page?', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 1, '2023-12-07 06:35:18', '2023-12-07 13:05:18', '1'),
(3, 'What about product return?', 'You will get alert on your email when can the delivery boy will come to your location for pickup the product.', 1, '2023-12-13 02:35:02', '2023-12-13 09:05:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `faq_form`
--

CREATE TABLE `faq_form` (
  `contact_id` int(11) NOT NULL,
  `ticket_id` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq_form`
--

INSERT INTO `faq_form` (`contact_id`, `ticket_id`, `user_name`, `user_email`, `subject`, `content`, `create_at`) VALUES
(1, 'tkt89335091', 'chirag', 'chiragsavaliya67@gmail.com', 'faq data', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum aperiam. Perspiciatis, porro!.', '2023-12-07 15:37:25'),
(2, 'tkt51254929', 'ravi', 'chiragsavaliya67@gmail.com', 'test', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum aperiam. Perspiciatis, porro!.', '2023-12-07 15:47:39'),
(4, 'tkt13208387', 'ajay', 'chiragsavaliya67@gmail.com', 'new', 'test data', '2023-12-07 16:49:17'),
(5, 'tkt16245179', 'vimal', 'chiragsavaliya67@gmail.com', 'top data', 'new', '2023-12-07 16:54:11'),
(6, 'tkt91578914', 'cks', 'chiragsavaliya67@gmail.com', 'new inq', 'today', '2023-12-15 15:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `firebase_notification`
--

CREATE TABLE `firebase_notification` (
  `id` int(11) NOT NULL,
  `clicktype` varchar(200) NOT NULL,
  `pid` varchar(200) NOT NULL,
  `prod_name` text NOT NULL,
  `sid` varchar(200) NOT NULL,
  `noti_title` text NOT NULL,
  `noti_body` text NOT NULL,
  `sku` varchar(200) NOT NULL,
  `noti_img` text NOT NULL,
  `cid` varchar(200) NOT NULL,
  `search` text NOT NULL,
  `home` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firebase_notification`
--

INSERT INTO `firebase_notification` (`id`, `clicktype`, `pid`, `prod_name`, `sid`, `noti_title`, `noti_body`, `sku`, `noti_img`, `cid`, `search`, `home`, `created_at`) VALUES
(1, '1', 'PIxivLeB2hS', 'APPLE 2020 Macbook Air M1', 'SVR6og303Vm', 'Chirag', 'Chirag', 'APPLE-2020-Macbook-Air-M1', '{\"72-72\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"200-200\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"280-310\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"400-200\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"430-590\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"600-810\":\"2023-07-04\\/64a3d2f0b2986.webp\"}', '0', '0', '0', '2023-08-02 06:37:29'),
(2, '2', '0', 'Home Appliances', '0', 'Jony', 'Jony', '0', '{\"72-72\":\"2023-07-04\\/64a3e446462c9.webp\",\"200-200\":\"2023-07-04\\/64a3e446462c9.webp\",\"280-310\":\"2023-07-04\\/64a3e446462c9.webp\",\"400-200\":\"2023-07-04\\/64a3e446462c9.webp\",\"430-590\":\"2023-07-04\\/64a3e446462c9.webp\",\"600-810\":\"2023-07-04\\/64a3e446462c9.webp\"}', '19', '0', '0', '2023-08-02 06:39:15'),
(4, '4', '0', 'Home Appliances', '0', 'Kamal', 'Kamal', '0', '{\"72-72\":\"2023-07-04\\/64a3e446462c9.webp\",\"200-200\":\"2023-07-04\\/64a3e446462c9.webp\",\"280-310\":\"2023-07-04\\/64a3e446462c9.webp\",\"400-200\":\"2023-07-04\\/64a3e446462c9.webp\",\"430-590\":\"2023-07-04\\/64a3e446462c9.webp\",\"600-810\":\"2023-07-04\\/64a3e446462c9.webp\"}', '19', '0', '0', '2023-08-02 06:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `governorates`
--

INSERT INTO `governorates` (`id`, `region_id`, `name`, `name_ar`) VALUES
(1, 1, 'MUSCAT', 'مسقط'),
(2, 1, 'MUTRAH', 'مطرح'),
(3, 1, 'BAWSHAR', 'بوشر'),
(4, 1, 'AL AMRAT', 'العامرات'),
(5, 1, 'AS SEEB', 'السيب'),
(6, 1, 'QURAYYAT', 'قريات'),
(7, 10, 'AR RUSTAQ', 'الرستاق'),
(8, 10, 'NAKHAL', 'نخل'),
(9, 10, 'AL AWABI', 'العوابي'),
(10, 10, 'AL MUSANAAH', 'المصنعة'),
(11, 10, 'BARKA', 'بركاء'),
(12, 10, 'WADI AL MAAWIL', 'وادي المعاول'),
(13, 11, 'SUHAR', 'صحار'),
(14, 11, 'SAHAM', 'صحم'),
(15, 11, 'AL KHABURAH', 'الخابورة'),
(16, 11, 'AS SUWAYQ', 'السويق'),
(17, 11, 'SHINAS', 'شناص'),
(18, 11, 'LIWA', 'لوى'),
(19, 7, 'NIZWA', 'نزوى'),
(20, 7, 'MANAH', 'منح'),
(21, 7, 'ADAM', 'آدم'),
(22, 7, 'AL HAMRA', 'الحمراء'),
(23, 7, 'BAHLA', 'بهلاء'),
(24, 7, 'SAMAIL', 'سمائل'),
(25, 7, 'IZKI', 'ازكي'),
(26, 7, 'BIDBID', 'بدبد'),
(27, 7, 'AL JABAL AL AKHUDAR', 'الجبل الاخضر'),
(28, 7, 'NIZWA', 'نزوى'),
(29, 7, 'MANAH', 'منح'),
(30, 7, 'ADAM', 'آدم'),
(31, 7, 'AL HAMRA', 'الحمراء'),
(32, 7, 'BAHLA', 'بهلاء'),
(33, 7, 'SAMAIL', 'سمائل'),
(34, 7, 'IZKI', 'ازكي'),
(35, 7, 'BIDBID', 'بدبد'),
(36, 7, 'AL JABAL AL AKHUDAR', 'الجبل الاخضر'),
(37, 2, 'KHASAB', 'خصب'),
(38, 2, 'BUKHA', 'بخاء'),
(39, 2, 'DABA', 'دباء'),
(40, 3, 'SALALAH', 'صلالة'),
(41, 3, 'TAQAH', 'طاقة'),
(42, 3, 'MIRBAT', 'مرباط'),
(43, 4, 'SUR', 'صور'),
(44, 4, 'AL KAMIL WA AL WAFI', 'الكامل والوافي'),
(45, 4, 'JAALAN BANI BU HASAN', 'جعلان بني بو حسن'),
(46, 4, 'JAALAN BANI BU ALI', 'جعلان بني بو علي'),
(47, 5, 'WADI BANI KHALID', 'وادي بني خالد'),
(48, 5, 'AL MUDAYBI', 'المضيبي'),
(49, 5, 'SINAW', 'سناو'),
(50, 5, 'SAMAD AL SHAN', 'سمد الشأن'),
(51, 5, 'BIDIYAH', 'بدية'),
(52, 5, 'AL QABIL', 'القابل'),
(53, 5, 'IBRA', 'ابراء'),
(54, 5, 'DAMA WA AT TAIYIN', 'دماء والطائيين'),
(55, 5, 'KHDRA BANI DAFAA', 'خضراء بني دفاع'),
(56, 6, 'DANK', 'ضنك'),
(57, 6, 'IBRI', 'عبري'),
(58, 6, 'YANQUL', 'ينقل'),
(59, 8, 'AD DUQM', 'الدقم'),
(60, 8, 'HAYMA', 'هيماء'),
(61, 9, 'AL BURAYMI', 'البريمي'),
(62, 9, 'MAHADAH', 'محضة'),
(63, 9, 'AS SUNAYNAH', 'السنينة');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_banner`
--

CREATE TABLE `homepage_banner` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `section` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `homepage_banner`
--

INSERT INTO `homepage_banner` (`id`, `type`, `image`, `link`, `section`, `cat_id`) VALUES
(1, 'top1', '{\"200-200\":\"2023-11-04/65462a010fbe1.webp\",\"1920-680\":\"2023-11-04/65462a010fbe1.webp\"}', '#', 'section1', 0),
(2, 'top2', '{\"200-200\":\"2023-12-09/657460e78874d.webp\",\"1920-680\":\"2023-12-09/657460e78874d.webp\"}', '#', 'section1', 0),
(3, 'top3', '{\"200-200\":\"2023-11-04/6546281c11987.webp\",\"1920-680\":\"2023-11-04/6546281c11987.webp\"}', '#', 'section1', 0),
(4, 'sec2cat1', '{\"200-200\":\"2023-02-11/images-7565455199-200-200.jpg\",\"700-330\":\"2023-02-11/images-7565455199-700-330.jpg\"}', '#', 'section2', 0),
(5, 'sec2pd1', '{\"200-200\":\"2023-02-11/5ce6bd0c210000b90ed0ed6a273628663-200-200.jpeg\",\"320-330\":\"2023-02-11/5ce6bd0c210000b90ed0ed6a273628663-320-330.jpeg\"}', '#', 'section2', 0),
(6, 'sec2pd2', '{\"200-200\":\"2023-02-11/fashion-banner-template-design-6b9a0533f5d66d60be3f3d038675f383-screen185088424-200-200.jpg\",\"320-330\":\"2023-02-11/fashion-banner-template-design-6b9a0533f5d66d60be3f3d038675f383-screen185088424-320-330.jpg\"}', '#', 'section2', 0),
(7, 'sec2ad', '{\"200-200\":\"2023-02-11/c953767aad9b00663cdc9586146929cb1323622421-200-200.jpg\",\"430-680\":\"2023-02-11/c953767aad9b00663cdc9586146929cb1323622421-430-680.jpg\"}', '#', 'section2', 0),
(8, 'sec2pd3', '{\"200-200\":\"2023-02-11/ce990c0668729dc4bafeb093ecb964dc1552229388-200-200.jpg\",\"320-330\":\"2023-02-11/ce990c0668729dc4bafeb093ecb964dc1552229388-320-330.jpg\"}', '#', 'section2', 0),
(10, 'sec2cat2', '{\"200-200\":\"2023-02-11/3ba679fa46d14c310ee8008891ea57541895972665-200-200.jpg\",\"700-330\":\"2023-02-11/3ba679fa46d14c310ee8008891ea57541895972665-700-330.jpg\"}', '#', 'section2', 0),
(14, 'bottom1', '{\"610-400\":\"2023-11-06/6548c1bae1615.webp\"}', '#', 'section8', 0),
(15, 'bottom2', '{\"610-400\":\"2023-10-25/6538cf4b1837b.webp\"}', '#', 'section8', 0),
(16, 'bottom3', '{\"610-400\":\"2023-10-25/6538ce9b2b3a8.webp\"}', '#', 'section8', 0),
(17, 'sec2pd4', '{\"200-200\":\"2023-02-11/4ab994aa22ef942921a39f48a489ab0d1888323269-200-200.jpg\",\"320-330\":\"2023-02-11/4ab994aa22ef942921a39f48a489ab0d1888323269-320-330.jpg\"}', '#', 'section2', 0),
(21, 'sec5cat4', '{\"470-720\":\"2023-07-05/64a53ef84f026.webp\"}', '', 'section5', 34),
(23, 'sec5cat6', '{\"470-720\":\"2023-07-05/64a542199d513.webp\"}', '', 'section5', 14),
(24, 'sec3', '{\"1930-150\":\"2023-07-05/64a545325a028.webp\"}', '#', 'section4', 0),
(25, 'sec5cat7', '{\"470-720\":\"2023-07-05/64a54264e76eb.webp\"}', '', 'section5', 8),
(26, 'sec5cat8', '{\"470-720\":\"2023-11-02/6543349b08ada.webp\"}', '', 'section5', 9),
(27, 'sec6', '{\"1900-320\":\"2023-07-22/64bb54f55611e.webp\"}', '#', 'section6', 0),
(29, 'sec5cat12', '{\"470-720\":\"2023-05-10/cattegary-cdrround-image-gt694380723-470-720.jpg\"}', '', 'section5', 0),
(30, 'sec5cat10', '{\"470-720\":\"2023-06-20/6490c713e845d.webp\"}', '', 'section5', 0),
(31, 'sec5cat11', '{\"470-720\":\"2023-05-04/whatsapp-image-2023-04-07-at-10.00.24-am-1145203014-470-720.jpeg\"}', '', 'section5', 5),
(34, 'sec10', '{\"1900-320\":\"2023-07-05/64a547b6e4764.webp\"}', '#', 'section10', 0),
(35, 'sec11', '{\"1900-320\":\"2023-07-22/64bb551a488e1.webp\"}', '#', 'section11', 0),
(36, 'sec12', '{\"1900-320\":\"2023-07-05/64a54e3ae8d51.webp\"}', '#', 'section12', 0),
(37, 'section_four_banner1', '{\"200-200\":\"2023-08-01/64c82b7ca0175.webp\",\"1920-680\":\"2023-08-01/64c82b7ca0175.webp\"}', '#', 'section_four_banner', 0),
(38, 'section_four_banner2', '{\"200-200\":\"2023-08-01/64c82b862ec59.webp\",\"1920-680\":\"2023-08-01/64c82b862ec59.webp\"}', '#', 'section_four_banner', 0),
(39, 'section_four_banner3', '{\"200-200\":\"2023-10-25/6538ceab3ee12.webp\",\"1920-680\":\"2023-10-25/6538ceab3ee12.webp\"}', '#', 'section_four_banner', 0),
(40, 'section_four_banner4', '{\"200-200\":\"2023-08-01/64c82b9b9dd05.webp\",\"1920-680\":\"2023-08-01/64c82b9b9dd05.webp\"}', '#', 'section_four_banner', 0),
(41, 'sec5cat1', '{\"470-720\":\"2023-12-09/65746d9d3404e.webp\"}', '', 'section5', 46),
(42, 'sec5cat2', '{\"470-720\":\"2023-11-03/6544e4bfb73fc.webp\"}', '', 'section5', 50),
(43, 'sec5cat3', '{\"470-720\":\"2023-11-03/6544e505c4c8e.webp\"}', '', 'section5', 52),
(44, 'sec5cat5', '{\"470-720\":\"2023-11-03/6544e53b6de70.webp\"}', '', 'section5', 51),
(46, 'prod_section1_title', 'Best selling products', '', 'prod_section1_title', 0),
(47, 'section_four_banner5', '{\"200-200\":\"2023-11-06/6548bc6652d70.webp\",\"1920-680\":\"2023-11-06/6548bc6652d70.webp\"}', '#', 'section_four_banner', 0),
(48, 'bottom4', '{\"610-400\":\"2023-11-06/6548c1cbd23e5.webp\"}', '#', 'section8', 0),
(49, 'prod_section2_title', 'new', '', 'prod_section2_title', 0),
(50, 'top_notification', 'Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! ShopNow', 'https://www.rentzo.co.in/pink-floral-embroidered-sherwani?pid=P58moSCI2e1&sku=Pink-Floral-Embroidered-Sherwani&sid=SVR6og303Vm', 'top_notification', 0);

-- --------------------------------------------------------

--
-- Table structure for table `homepage_banners`
--

CREATE TABLE `homepage_banners` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `layout` int(11) NOT NULL,
  `orders` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `homepage_banners`
--

INSERT INTO `homepage_banners` (`id`, `title`, `layout`, `orders`, `created_at`) VALUES
(20, 'Category ', 7, 0, '2023-03-03 06:18:53'),
(21, 'Top banner', 6, 4, '2023-04-28 21:06:08'),
(22, 'Todays deal', 0, 2, '2023-03-04 07:51:29'),
(23, 'Top Selling', 0, 4, '2023-03-03 06:27:37'),
(24, 'banner small', 4, 2, '2023-04-28 21:05:53'),
(25, 'Trending Products', 0, 6, '2023-03-03 06:29:15'),
(26, '3x1 banner', 2, 7, '2023-06-18 08:47:35'),
(27, 'YOU MAY LIKE', 1, 8, '2023-03-04 07:52:05'),
(28, 'banner', 4, 3, '2023-04-28 21:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `home_category`
--

CREATE TABLE `home_category` (
  `id` int(11) NOT NULL,
  `img_url` text NOT NULL,
  `clicktype` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `home_category`
--

INSERT INTO `home_category` (`id`, `img_url`, `clicktype`, `cat_id`, `cat_order`, `created_at`) VALUES
(2, '', 1, 26, 1, '2023-05-11 12:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `home_custom_banner`
--

CREATE TABLE `home_custom_banner` (
  `id` int(11) NOT NULL,
  `img_url` text NOT NULL,
  `banner_id` varchar(100) NOT NULL,
  `clicktype` int(11) NOT NULL,
  `banner_for` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `home_custom_banner`
--

INSERT INTO `home_custom_banner` (`id`, `img_url`, `banner_id`, `clicktype`, `banner_for`, `created_at`) VALUES
(83, '', '38', 1, '20', '2023-05-25 04:45:21'),
(84, '', '26', 1, '20', '2023-05-25 04:45:26'),
(90, '{\"72-72\":\"2023-05-25\\/banner733076868-72-72.png\",\"200-200\":\"2023-05-25\\/banner733076868-200-200.png\",\"280-310\":\"2023-05-25\\/banner733076868-280-310.png\",\"400-200\":\"2023-05-25\\/banner733076868-400-200.png\",\"430-590\":\"2023-05-25\\/banner733076868-430-590.png\",\"600-810\":\"2023-05-25\\/banner733076868-600-810.png\"}', '38', 1, '24', '2023-05-25 04:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `import_product2_saw2hcdgtaa`
--

CREATE TABLE `import_product2_saw2hcdgtaa` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fail_reason` text NOT NULL,
  `name_arabic` text NOT NULL,
  `name` text NOT NULL,
  `sku` text NOT NULL,
  `url_key` text NOT NULL,
  `attribute_set` text NOT NULL,
  `product_type` text NOT NULL,
  `categories` text NOT NULL,
  `short_description` text NOT NULL,
  `arabic_short_description` text NOT NULL,
  `description` text NOT NULL,
  `arabic_description` text NOT NULL,
  `mrp` text NOT NULL,
  `price` text NOT NULL,
  `tax_class` text NOT NULL,
  `qty` text NOT NULL,
  `stock_status` text NOT NULL,
  `visibility` text NOT NULL,
  `country_of_manufacture` text NOT NULL,
  `hsn_code` text NOT NULL,
  `product_purchase_limit` text NOT NULL,
  `brand` text NOT NULL,
  `return_policy` text NOT NULL,
  `configurable_variations` text NOT NULL,
  `remarks` text NOT NULL,
  `youtube_video_link` text NOT NULL,
  `related_skus` text NOT NULL,
  `upsell_skus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `import_product2_sln82lwrpfg`
--

CREATE TABLE `import_product2_sln82lwrpfg` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fail_reason` text NOT NULL,
  `name_arabic` text NOT NULL,
  `name` text NOT NULL,
  `sku` text NOT NULL,
  `url_key` text NOT NULL,
  `attribute_set` text NOT NULL,
  `product_type` text NOT NULL,
  `categories` text NOT NULL,
  `short_description` text NOT NULL,
  `arabic_short_description` text NOT NULL,
  `description` text NOT NULL,
  `arabic_description` text NOT NULL,
  `mrp` text NOT NULL,
  `price` text NOT NULL,
  `tax_class` text NOT NULL,
  `qty` text NOT NULL,
  `stock_status` text NOT NULL,
  `visibility` text NOT NULL,
  `country_of_manufacture` text NOT NULL,
  `hsn_code` text NOT NULL,
  `product_purchase_limit` text NOT NULL,
  `brand` text NOT NULL,
  `return_policy` text NOT NULL,
  `configurable_variations` text NOT NULL,
  `remarks` text NOT NULL,
  `youtube_video_link` text NOT NULL,
  `related_skus` text NOT NULL,
  `upsell_skus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `import_product_saw2hcdgtaa`
--

CREATE TABLE `import_product_saw2hcdgtaa` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fail_reason` text NOT NULL,
  `name_arabic` text NOT NULL,
  `name` text NOT NULL,
  `sku` text NOT NULL,
  `url_key` text NOT NULL,
  `attribute_set` text NOT NULL,
  `product_type` text NOT NULL,
  `categories` text NOT NULL,
  `short_description` text NOT NULL,
  `arabic_short_description` text NOT NULL,
  `description` text NOT NULL,
  `arabic_description` text NOT NULL,
  `mrp` text NOT NULL,
  `price` text NOT NULL,
  `tax_class` text NOT NULL,
  `qty` text NOT NULL,
  `stock_status` text NOT NULL,
  `visibility` text NOT NULL,
  `country_of_manufacture` text NOT NULL,
  `hsn_code` text NOT NULL,
  `product_purchase_limit` text NOT NULL,
  `brand` text NOT NULL,
  `return_policy` text NOT NULL,
  `configurable_variations` text NOT NULL,
  `remarks` text NOT NULL,
  `youtube_video_link` text NOT NULL,
  `related_skus` text NOT NULL,
  `upsell_skus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `import_product_saw2hcdgtaa`
--

INSERT INTO `import_product_saw2hcdgtaa` (`id`, `status`, `fail_reason`, `name_arabic`, `name`, `sku`, `url_key`, `attribute_set`, `product_type`, `categories`, `short_description`, `arabic_short_description`, `description`, `arabic_description`, `mrp`, `price`, `tax_class`, `qty`, `stock_status`, `visibility`, `country_of_manufacture`, `hsn_code`, `product_purchase_limit`, `brand`, `return_policy`, `configurable_variations`, `remarks`, `youtube_video_link`, `related_skus`, `upsell_skus`) VALUES
(13, 2, 'Product attribute Set not found.\nProduct categories cat1, cat2, cat3 not found.\nProduct tax class not found.\nProduct brand not found.\nProduct return policy not found.\nProduct related skus Jeans, Kamal2121 not found.\n', '', 'T-Shirt - Black', 't-shirt-black', 't-shirt-black', 'Default', 'simple', 'cat1,cat2,cat3', 'asfasf', '', 'qwrqwrqrqwrqwrqrwq', '', '10', '5', 've2', '5', 'In Stock', 'Not Visible Individually', 'india', '31313', '2', 'All Out', 'Samsung', '', 'mowe w', '', 'Jeans,Kamal2121', ''),
(14, 2, 'Product attribute Set not found.\nProduct categories cat2 not found.\nProduct tax class not found.\nProduct manufacture country not found.\nProduct brand not found.\nProduct return policy not found.\nProduct upsell skus Jeans, Kamal2121 not found.\n', '', 'T-Shirt - Red', 't-shirt-red', 't-shirt-red', 'Default', 'simple', 'cat2', 'fsaf', '', 'wqwgewgew', '', '20', '5', 'tax class 18%', '5', 'Out of Stock', 'Not Visible Individually', 'usa', '3123', '', 'All Out', 'hvuuuu', '', '', '', '', 'Jeans,Kamal2121'),
(15, 2, 'Product attribute Set not found.\nProduct categories cat3 not found.\nProduct tax class not found.\nProduct manufacture country not found.\nProduct brand not found.\nProduct configurable variations color attribute Black.size value not found.\n', '', 'T-Shirt', 't-shirt', 't-shirt', 'Default', 'configurable', 'cat3', 'fsf', '', 'ggwegwegw', '', '30', '5', 'tax class 18%', '2', 'In Stock', 'Catalog, Search', 'uk', '312', '', 've', '', 'sku=shirt-black-xl,color=Black.size=xl', '', '', '', ''),
(16, 2, 'Product attribute Set not found.\nProduct categories cat3 not found.\nProduct tax class not found.\nProduct manufacture country not found.\nProduct brand not found.\nProduct configurable variations color attribute Red value not found.\n', '', 'T-Shirt', 't-shirt', 't-shirt', 'Default', 'configurable', 'cat3', 'gsdg', '', 'gwegwegweg', '', '40', '5', 'tax class 18%', '2', 'In Stock', 'Catalog, Search', 'uk', '312', '', 've', '', 'sku=shirt-red-xl,color=Red,size=xl', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `import_product_sln82lwrpfg`
--

CREATE TABLE `import_product_sln82lwrpfg` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fail_reason` text NOT NULL,
  `name_arabic` text NOT NULL,
  `name` text NOT NULL,
  `sku` text NOT NULL,
  `url_key` text NOT NULL,
  `attribute_set` text NOT NULL,
  `product_type` text NOT NULL,
  `categories` text NOT NULL,
  `short_description` text NOT NULL,
  `arabic_short_description` text NOT NULL,
  `description` text NOT NULL,
  `arabic_description` text NOT NULL,
  `mrp` text NOT NULL,
  `price` text NOT NULL,
  `tax_class` text NOT NULL,
  `qty` text NOT NULL,
  `stock_status` text NOT NULL,
  `visibility` text NOT NULL,
  `country_of_manufacture` text NOT NULL,
  `hsn_code` text NOT NULL,
  `product_purchase_limit` text NOT NULL,
  `brand` text NOT NULL,
  `return_policy` text NOT NULL,
  `configurable_variations` text NOT NULL,
  `remarks` text NOT NULL,
  `youtube_video_link` text NOT NULL,
  `related_skus` text NOT NULL,
  `upsell_skus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'rz0usTeThur7kus05tNE', 1, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `sno` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `setdefault` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`sno`, `name`, `setdefault`) VALUES
(1, 'Arabic', 0),
(2, 'English', 0);

-- --------------------------------------------------------

--
-- Table structure for table `language_phrase`
--

CREATE TABLE `language_phrase` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `phrase` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language_phrase`
--

INSERT INTO `language_phrase` (`id`, `language_id`, `phrase`, `message`) VALUES
(1, 1, 'mobile_numeric', ''),
(2, 2, 'mobile_numeric', ''),
(3, 1, 'mobile_mandatory', ''),
(4, 2, 'mobile_mandatory', ''),
(5, 1, 'sms_disabled', ''),
(6, 2, 'sms_disabled', ''),
(7, 1, 'sms_failed', ''),
(8, 2, 'sms_failed', ''),
(9, 1, 'sms_sent', ''),
(10, 2, 'sms_sent', ''),
(11, 1, 'otp_mandatory', ''),
(12, 2, 'otp_mandatory', ''),
(13, 1, 'invalid_otp', ''),
(14, 2, 'invalid_otp', ''),
(15, 1, 'login_successfully', ''),
(16, 2, 'login_successfully', ''),
(17, 1, 'user_status', ''),
(18, 2, 'user_status', ''),
(19, 1, 'user_status_disabled', ''),
(20, 2, 'user_status_disabled', ''),
(21, 1, 'no_record_found', ''),
(22, 2, 'no_record_found', ''),
(23, 1, 'popular_product', ''),
(24, 2, 'popular_product', ''),
(25, 1, 'cart_invalid_request', ''),
(26, 2, 'cart_invalid_request', ''),
(27, 1, 'please_try_again', ''),
(28, 2, 'please_try_again', ''),
(29, 1, 'cart_updated', ''),
(30, 2, 'cart_updated', ''),
(31, 1, 'cart_added', ''),
(32, 2, 'cart_added', ''),
(33, 1, 'cart_deleted', ''),
(34, 2, 'cart_deleted', ''),
(35, 1, 'cart_details', ''),
(36, 2, 'cart_details', ''),
(37, 1, 'wishlist_added', ''),
(38, 2, 'wishlist_added', ''),
(39, 1, 'wishlist_updated', ''),
(40, 2, 'wishlist_updated', ''),
(41, 1, 'wishlist_deleted', ''),
(42, 2, 'wishlist_deleted', ''),
(43, 1, 'cart_empty', ''),
(44, 2, 'cart_empty', ''),
(45, 1, 'address_added', ''),
(46, 2, 'address_added', ''),
(47, 1, 'address_details', ''),
(48, 2, 'address_details', ''),
(49, 1, 'address_deleted', ''),
(50, 2, 'address_deleted', ''),
(51, 1, 'address_updated', ''),
(52, 2, 'address_updated', ''),
(53, 1, 'address_empty', ''),
(54, 2, 'address_empty', ''),
(55, 1, 'checkout_details', ''),
(56, 2, 'checkout_details', ''),
(57, 1, 'wishlist_details', ''),
(58, 2, 'wishlist_details', ''),
(59, 1, 'related_product', ''),
(60, 2, 'related_product', ''),
(61, 1, 'upsell_product', ''),
(62, 2, 'upsell_product', ''),
(63, 1, 'username_mendatory', ''),
(64, 2, 'username_mendatory', ''),
(65, 1, 'username_mandatory', ''),
(66, 2, 'username_mandatory', ''),
(67, 1, 'email_mandatory', ''),
(68, 2, 'email_mandatory', ''),
(69, 1, 'invalid_address_id', ''),
(70, 2, 'invalid_address_id', ''),
(71, 1, 'invalid_request', ''),
(72, 2, 'invalid_request', ''),
(73, 1, 'success_order', ''),
(74, 2, 'success_order', ''),
(75, 1, 'order_details', ''),
(76, 2, 'order_details', ''),
(77, 1, 'brand_results', ''),
(78, 2, 'brand_results', ''),
(79, 1, 'sku_required', ''),
(80, 2, 'sku_required', ''),
(81, 1, 'brand_product', ''),
(82, 2, 'brand_product', ''),
(83, 1, 'user_id_mandatory', ''),
(84, 2, 'user_id_mandatory', ''),
(85, 1, 'order_id_mandatory', ''),
(86, 2, 'order_id_mandatory', ''),
(87, 1, 'sub_category', ''),
(88, 2, 'sub_category', ''),
(89, 1, 'product_filter', ''),
(90, 2, 'product_filter', ''),
(91, 1, 'order_empty', ''),
(92, 2, 'order_empty', ''),
(93, 1, 'product_attribute_mandotary', 'الرجاء تحديد سمة المنتج'),
(94, 2, 'product_attribute_mandotary', 'Please select product attribute'),
(95, 1, 'product_stock_limit', ''),
(96, 2, 'product_stock_limit', ''),
(97, 1, 'product_purchase_limit', ''),
(98, 2, 'product_purchase_limit', ''),
(99, 1, 'product_id_mandatory', ''),
(100, 2, 'product_id_mandatory', ''),
(101, 1, 'already_cancelled', ''),
(102, 2, 'already_cancelled', ''),
(103, 1, 'order_returned', ''),
(104, 2, 'order_returned', ''),
(105, 1, 'category_mandatory', ''),
(106, 2, 'category_mandatory', ''),
(107, 1, 'search_mandotary', ''),
(108, 2, 'search_mandotary', ''),
(109, 1, 'wishlist_empty', ''),
(110, 2, 'wishlist_empty', ''),
(111, 1, 'product_id_missing', ''),
(112, 2, 'product_id_missing', ''),
(113, 1, 'no_product_found', ''),
(114, 2, 'no_product_found', ''),
(115, 1, 'no_user_found', ''),
(116, 2, 'no_user_found', ''),
(117, 1, 'not_purchased_product', ''),
(118, 2, 'not_purchased_product', ''),
(119, 1, 'review_title_missing', ''),
(120, 2, 'review_title_missing', ''),
(121, 1, 'review_rating_numeric', ''),
(122, 2, 'review_rating_numeric', ''),
(123, 1, 'review_rating_error', ''),
(124, 2, 'review_rating_error', ''),
(125, 1, 'category_id_mandatory', ''),
(126, 2, 'category_id_mandatory', ''),
(127, 1, 'phone_mandatory', ''),
(128, 2, 'phone_mandatory', ''),
(129, 1, 'not_exist', ''),
(130, 2, 'not_exist', ''),
(131, 1, 'order_cancelled', ''),
(132, 2, 'order_cancelled', ''),
(133, 1, 'invalid_otp', ''),
(134, 2, 'invalid_otp', ''),
(135, 1, 'phone_already_exist', ''),
(136, 2, 'phone_already_exist', ''),
(137, 1, 'user_not_exist', ''),
(138, 2, 'user_not_exist', ''),
(139, 1, 'user_name_mandatory', ''),
(140, 2, 'user_name_mandatory', ''),
(141, 1, 'invalid_request', ''),
(142, 2, 'invalid_request', ''),
(143, 1, 'product_out_of_stock', ''),
(144, 2, 'product_out_of_stock', ''),
(145, 1, 'pincode_mandatory', ''),
(146, 2, 'pincode_mandatory', ''),
(147, 1, 'wishlist_invalid_request', ''),
(148, 2, 'wishlist_invalid_request', ''),
(149, 1, 'payment_id_mandatory', ''),
(150, 2, 'payment_id_mandatory', ''),
(151, 1, 'invalid_address_id', ''),
(152, 2, 'invalid_address_id', ''),
(153, 1, 'user_id_missing', ''),
(154, 2, 'user_id_missing', ''),
(155, 1, 'congigure_attribute_required', ''),
(156, 2, 'congigure_attribute_required', ''),
(157, 1, 'invalid_coupon', ''),
(158, 2, 'invalid_coupon', ''),
(159, 1, 'coupon_applied_successfully', ''),
(160, 2, 'coupon_applied_successfully', ''),
(161, 1, 'applied_exced', ''),
(162, 2, 'applied_exced', ''),
(163, 1, 'coupon_expired', ''),
(164, 2, 'coupon_expired', ''),
(165, 1, 'login_to_apply_coupon', ''),
(166, 2, 'login_to_apply_coupon', ''),
(167, 1, 'address_invalid_request', ''),
(168, 2, 'address_invalid_request', ''),
(169, 1, 'status_mandatory', ''),
(170, 2, 'status_mandatory', ''),
(171, 1, 'invalid_delivery_boy', ''),
(172, 2, 'invalid_delivery_boy', ''),
(173, 1, 'invalid_order', ''),
(174, 2, 'invalid_order', ''),
(175, 1, 'otp_required', ''),
(176, 2, 'otp_required', ''),
(177, 1, 'city_mandatory', ''),
(178, 2, 'city_mandatory', ''),
(179, 1, 'not_purchased_product', ''),
(180, 2, 'not_purchased_product', ''),
(181, 1, 'review_added', ''),
(182, 2, 'review_added', ''),
(183, 1, 'login_requireed', ''),
(184, 2, 'login_requireed', ''),
(185, 1, 'prod_id_mandatory', ''),
(186, 2, 'prod_id_mandatory', ''),
(187, 1, 'amount_less_coupon_limit', ''),
(188, 2, 'amount_less_coupon_limit', ''),
(189, 1, 'address_mandatory', ''),
(190, 2, 'address_mandatory', ''),
(191, 1, 'amount_less_coupon_limit', ''),
(192, 2, 'amount_less_coupon_limit', ''),
(193, 1, 'pincode_mandatory', ''),
(194, 2, 'pincode_mandatory', ''),
(195, 1, 'state_mandatory', ''),
(196, 2, 'state_mandatory', ''),
(197, 1, 'vendor_id_required', ''),
(198, 2, 'vendor_id_required', ''),
(199, 1, 'required_field_missing', ''),
(200, 2, 'required_field_missing', ''),
(201, 1, 'request_has_been_submitted_succesfully', ''),
(202, 2, 'request_has_been_submitted_succesfully', ''),
(203, 1, 'new_phrase', ''),
(204, 2, 'new_phrase', ''),
(205, 1, 'invalid_mobile_or_email', ''),
(206, 2, 'invalid_mobile_or_email', ''),
(207, 1, 'mobile_or_email_mandatory', ''),
(208, 2, 'mobile_or_email_mandatory', ''),
(209, 1, 'invalid_mobile_or_email_otp', ''),
(210, 2, 'invalid_mobile_or_email_otp', ''),
(211, 1, 'wrong_otp', ''),
(212, 2, 'wrong_otp', ''),
(213, 1, 'order_placed_succesfully', ''),
(214, 2, 'order_placed_succesfully', ''),
(215, 1, 'invalid_filter', ''),
(216, 2, 'invalid_filter', ''),
(217, 1, 'request_has_been_submitted_succesfully', ''),
(218, 2, 'request_has_been_submitted_succesfully', ''),
(219, 2, 'phone_or_email_already_exist', ''),
(220, 0, 'wishlist_details', ''),
(221, 0, 'no_record_found', ''),
(222, 0, 'cart_details', ''),
(223, 2, 'add_money_succesfully', ''),
(224, 1, 'add_money_succesfully', ''),
(225, 2, 'otp_validated', ''),
(226, 0, 'cart_empty', ''),
(227, 0, 'wishlist_empty', ''),
(228, 0, 'order_empty', ''),
(229, 0, 'address_empty', ''),
(230, 0, 'cart_invalid_request', ''),
(231, 0, 'wishlist_invalid_request', ''),
(232, 1, 'get_wallet_data_succesfully', ''),
(233, 0, 'sms_sent', ''),
(234, 0, 'login_successfully', ''),
(235, 0, 'get_wallet_data_succesfully', ''),
(236, 0, 'add_money_succesfully', ''),
(237, 0, 'cart_added', ''),
(238, 0, 'checkout_details', ''),
(239, 0, 'related_product', ''),
(240, 0, 'upsell_product', ''),
(241, 0, 'wishlist_added', ''),
(242, 0, 'wishlist_deleted', ''),
(243, 1, 'otp_validated', ''),
(244, 0, 'cart_updated', ''),
(245, 0, 'invalid_mobile_or_email_otp', ''),
(246, 0, 'order_details', ''),
(247, 0, 'user_id_mandatory', ''),
(248, 1, 'mobile_or_email_invalid', ''),
(249, 0, 'address_details', ''),
(250, 2, 'insufficient_balance', ''),
(251, 0, 'not_exist', ''),
(252, 0, 'already_cancelled', ''),
(253, 2, 'please_enter_an_amount_between_1.00_omr_and_25.00_omr', ''),
(254, 2, 'no_trasactions_found', ''),
(255, 0, 'user_not_exist', ''),
(256, 0, 'product_filter', ''),
(257, 0, 'enter_a_valid_amount', ''),
(258, 0, 'invalid_otp', ''),
(259, 0, 'mobile_or_email_mandatory', ''),
(260, 0, 'phone_or_email_already_exist', ''),
(261, 0, 'product_stock_limit', ''),
(262, 0, 'username_mandatory', ''),
(263, 0, 'brand_results', ''),
(264, 0, 'brand_product', ''),
(265, 1, 'banner_results', ''),
(266, 0, 'banner_results', ''),
(267, 2, 'user_already_exists', ''),
(268, 2, 'invalid_phone_or_email_otp', ''),
(269, 2, 'banner_results', ''),
(270, 2, 'no_data_found', ''),
(271, 2, 'get_wallet_data_succesfully', '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(4, 1, 2, 'hi', '2023-11-25 08:18:46'),
(5, 2, 1, 'hello', '2023-11-25 08:18:46'),
(6, 1, 2, 'ok', '2023-11-25 08:19:22'),
(7, 1, 2, 'hi', '2023-11-25 08:36:15'),
(8, 1, 2, 'hello', '2023-11-25 08:38:02'),
(9, 1, 2, 'hcshc', '2023-11-25 08:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `subtitle` text NOT NULL,
  `image` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `subtitle`, `image`, `date`) VALUES
(1, 'Get 30% off on womans', 'buy any 1 & get 30% off', 'marurang_logo.png', '2023-03-11 14:11:48'),
(2, 'new notification day 1', 'day 1 noti 1', '2023-03-11/rajasthani-lehanga-11937954346-430-590.jpeg', '2023-04-11 18:35:07'),
(3, 'noti 4 day ago ', 'don\'t show this noti 4 day ago', '2023-04-10/bewakoof-1476165296-430-590.jpeg', '2023-04-10 12:38:03'),
(4, '10 days ago', 'not sdf', 'marurang_logo.png', '2023-03-07 18:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sno` int(11) NOT NULL,
  `order_id` varchar(30) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_orderid` text DEFAULT NULL,
  `payment_id` text DEFAULT NULL,
  `payment_mode` varchar(100) DEFAULT NULL,
  `qoute_id` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime NOT NULL DEFAULT current_timestamp(),
  `curriername` varchar(100) DEFAULT NULL,
  `trackid` text DEFAULT NULL,
  `deliveryid` varchar(100) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `mobile` varchar(200) DEFAULT NULL,
  `locality` varchar(200) DEFAULT NULL,
  `fulladdress` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `governorate` varchar(255) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `lng` varchar(100) DEFAULT NULL,
  `pincode` varchar(200) DEFAULT NULL,
  `addresstype` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `coupon_code` varchar(100) DEFAULT NULL,
  `coupon_value` varchar(250) DEFAULT NULL,
  `buy_from` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sno`, `order_id`, `user_id`, `status`, `total_price`, `payment_orderid`, `payment_id`, `payment_mode`, `qoute_id`, `create_date`, `update_date`, `curriername`, `trackid`, `deliveryid`, `discount`, `fullname`, `mobile`, `locality`, `fulladdress`, `city`, `cityid`, `state`, `state_id`, `area`, `country`, `region`, `governorate`, `lat`, `lng`, `pincode`, `addresstype`, `email`, `total_qty`, `coupon_code`, `coupon_value`, `buy_from`) VALUES
(1, 'ODRCD39HS123133', 'UV0cpGzEodR', 'Placed', 23500, '', 'Pay12345', 'COD', '3011123173', '2023-11-30 12:31:33', '2023-11-30 07:01:33', NULL, NULL, NULL, 244, 'Jony Paul', '9874627973', NULL, 'KOLKATA', 'Adoni', 4, 'Andhra Pradesh', NULL, '', '1', '', '', '', '', NULL, 'Home', 'paul.jony70@gmail.com', 1, '', '0', NULL),
(2, 'ODRSHDLLB020487', 'U1W3ufw5Fah', 'Placed', 22500, '', 'Pay12345', 'COD', '3011012184', '2023-11-30 14:04:02', '2023-11-30 08:34:02', NULL, NULL, NULL, 244, 'chirag', '9067686678', NULL, 'vrachha', 'Surat', 396, 'Gujarat', NULL, '', '1', '', '', '', '', NULL, 'Home', 'chiragsavaliya67@gmail.com', 1, '', '0', NULL),
(3, 'ODRH3VGNR105716', 'U24a3IOsyvt', 'Placed', 2040, '', 'ORD021220235289', 'online_payment', '', '2023-12-02 10:57:00', '2023-12-02 05:27:00', NULL, NULL, NULL, 960, 'Yash Jasoliya', '6354822602', NULL, 'kaliyabid', NULL, NULL, NULL, NULL, '', '1', '', '', '20.5937', '78.9629', NULL, 'home', 'jasoliyayash842@gmail.com', 2, '', '0', NULL),
(4, 'ODRITUDDJ050419', 'U24a3IOsyvt', 'Placed', 756, '', 'ORD041220233171', 'online_payment', '', '2023-12-04 17:04:28', '2023-12-04 11:34:28', NULL, NULL, NULL, 244, 'Yash Jasoliya', '6354822620', NULL, 'kaliyabid', NULL, NULL, NULL, NULL, '', '1', '', '', '20.5937', '78.9629', NULL, 'home', 'yashjasoliya.software@gmail.com', 1, '', '0', NULL),
(5, 'ODRAZVWZN041568', 'UJxdjAhqKTa', 'Placed', 756, '', 'ORD051220231974', 'online_payment', '', '2023-12-05 16:15:09', '2023-12-05 10:45:09', NULL, NULL, NULL, 244, 'Yash Jasoliya', '7383006215', NULL, 'kaliyabid', NULL, NULL, NULL, NULL, '', '1', '', '', '20.5937', '78.9629', NULL, 'home', 'yashjasoliyay@gmail.com', 1, '', '0', NULL),
(6, 'ODR5BI1P809185', 'UJxdjAhqKTa', 'Placed', 189, '', 'ORD061220234586', 'online_payment', '', '2023-12-06 09:18:38', '2023-12-06 03:48:38', NULL, NULL, NULL, 11, 'Yash Jasoliya', '7383006215', NULL, 'kaliyabid', NULL, NULL, NULL, NULL, '', '1', '', '', '20.5937', '78.9629', NULL, 'home', 'yashjasoliyay@gmail.com', 1, '', '0', NULL),
(7, 'ODRV3IB2A125761', 'UJxdjAhqKTa', 'Placed', 756, '', 'ORD081220236502', 'online_payment', '', '2023-12-08 12:57:29', '2023-12-08 07:27:29', NULL, NULL, NULL, 244, 'Yash Jasoliya', '7383006215', NULL, 'kaliyabid', NULL, NULL, NULL, NULL, '', '1', '', '', '20.5937', '78.9629', NULL, 'home', 'yash@gamil.com', 1, '', '0', NULL),
(8, 'ODRL1TJ5V040364', 'UJxdjAhqKTa', 'Placed', 756, '', 'ORD091220232070', 'online_payment', '', '2023-12-09 16:03:58', '2023-12-09 10:33:58', NULL, NULL, NULL, 244, 'jasoliya Yash', '7383006215', NULL, 'akshardham', NULL, NULL, NULL, NULL, '', '1', '', '', '20.5937', '78.9629', NULL, 'home', 'jasoliyayash842@gmail.com', 1, '', '0', NULL),
(9, 'ODRGJELRQ04251', 'UJxdjAhqKTa', 'Placed', 756, '', 'ORD091220235498', 'online_payment', '', '2023-12-09 16:25:22', '2023-12-09 10:55:22', NULL, NULL, NULL, 244, 'jasoliya Yash', '7383006215', NULL, 'akshardham', 'select city', NULL, 'select state', NULL, '', '1', '', '', '20.5937', '78.9629', '364001', 'home', 'jasoliyayash842@gmail.com', 1, '', '0', NULL),
(10, 'ODRNRAPQ8043650', 'UJxdjAhqKTa', 'Placed', 756, '', 'ORD091220239893', 'online_payment', '', '2023-12-09 16:36:54', '2023-12-09 11:06:54', NULL, NULL, NULL, 244, 'jasoliya Yash', '7383006215', NULL, 'akshardham', 'Bhavnagar', NULL, 'Gujarat', NULL, '', '1', '', '', '20.5937', '78.9629', '364001', 'home', 'jasoliyayash842@gmail.com', 1, '', '0', NULL),
(11, 'ODRLJNHP9050274', 'UkFJLO0ZU52', 'Placed', 756, '', 'Pay12345', 'COD', '0912050062', '2023-12-09 17:02:35', '2023-12-09 11:32:35', NULL, NULL, NULL, 244, 'Kavitha Kesavan', '7440114899', NULL, 'Flat 311, Robert Lewis House', 'Vellore', 1287, 'Tamil Nadu', NULL, '', '1', '', '', '', '', NULL, 'Home', 'kavitha.kesaven@gmail.com', 1, '', '', NULL),
(12, 'ODRYFS2A3010321', 'U6Hd4kUeJSR', 'Placed', 44290, '', 'Pay12345', 'COD', '1312124717', '2023-12-13 13:03:12', '2023-12-13 07:33:12', NULL, NULL, NULL, 710, 'kamal bunkar', '9144040888', NULL, 'Flat 03, sagar royal villas', 'Bhopal', 696, 'Madhya Pradesh', NULL, '', '1', '', '', '', '', NULL, 'Home', 'kamal.bunkar07@gmail.com', 1, '', '', NULL),
(13, 'ODRRFCM5P124445', 'UV0cpGzEodR', 'Placed', 23500, '', 'Pay12345', 'COD', '1412124383', '2023-12-14 12:44:21', '2023-12-14 07:14:21', NULL, NULL, NULL, 244, 'Jony Paul0', '9874627973', NULL, 'Ichapur Bidhanpally West', 'Kolkata', 1475, 'West Bengal', NULL, '', '1', '', '', '', '', NULL, 'Home', 'chiragsavaliya67@gmail.com', 1, '', '', NULL),
(14, 'ODRBE5RCI060530', 'UV0cpGzEodR', 'Placed', 1500, '', 'Pay12345', 'COD', '1612055917', '2023-12-16 18:05:09', '2023-12-16 18:05:09', NULL, NULL, NULL, 0, 'yuvraj', '7354570394', NULL, 'katara hillls bhopal', 'Ashok Nagar', 693, 'Madhya Pradesh', 20, NULL, '1', NULL, NULL, NULL, NULL, '985666', 'Home', 'yuvi384756@gmail.com', 0, 'undefined', '', NULL),
(15, 'ODRZ3YGCW060777', 'UV0cpGzEodR', 'Placed', 500, '', 'Pay12345', 'COD', '1612055917', '2023-12-16 18:07:00', '2023-12-16 18:07:00', NULL, NULL, NULL, 0, 'yuvraj', '7354570394', NULL, 'katara hillls bhopal', 'Ashok Nagar', 693, 'Madhya Pradesh', 20, NULL, '1', NULL, NULL, NULL, NULL, '985666', 'Home', 'paul.jony70@gmail.com', 0, 'undefined', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_chat`
--

CREATE TABLE `order_chat` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `deliveryid` varchar(50) DEFAULT NULL,
  `prod_id` varchar(200) NOT NULL,
  `prod_sku` varchar(500) NOT NULL,
  `vendor_id` varchar(200) DEFAULT NULL,
  `prod_name` varchar(500) NOT NULL,
  `prod_name_ar` varchar(500) NOT NULL,
  `prod_img` text NOT NULL,
  `prod_attr` text DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `prod_price` float NOT NULL,
  `shipping` float NOT NULL,
  `discount` float DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `status_date` datetime NOT NULL,
  `refund_amt` int(11) DEFAULT NULL,
  `refund_txnno` varchar(20) DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `pickup_status` varchar(200) DEFAULT NULL,
  `return_status` int(11) DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `return_updateby` datetime DEFAULT NULL,
  `invoice_number` varchar(200) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `tracking_id` varchar(500) DEFAULT NULL,
  `tracking_url` text DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `return_last_date` date DEFAULT NULL,
  `coupon_code` varchar(100) DEFAULT NULL,
  `coupon_value` varchar(250) DEFAULT NULL,
  `product_hsn_code` varchar(50) DEFAULT NULL,
  `product_unique_code` varchar(50) NOT NULL,
  `seller_price` varchar(100) DEFAULT NULL,
  `admin_profit` varchar(100) NOT NULL,
  `tds` varchar(100) DEFAULT NULL,
  `tcs` varchar(100) NOT NULL,
  `gross_amount` varchar(100) NOT NULL,
  `gst_input` varchar(100) NOT NULL,
  `net_amount` varchar(100) NOT NULL,
  `taxable_amount` varchar(50) NOT NULL,
  `cgst` varchar(50) NOT NULL,
  `sgst` varchar(50) NOT NULL,
  `igst` varchar(50) NOT NULL,
  `reverse_shipping` varchar(50) NOT NULL,
  `print_label` text NOT NULL,
  `pickup_type` varchar(50) DEFAULT NULL,
  `p_weight` varchar(50) DEFAULT NULL,
  `p_length` varchar(50) DEFAULT NULL,
  `p_width` varchar(50) DEFAULT NULL,
  `p_height` varchar(50) DEFAULT NULL,
  `courier_name` text DEFAULT NULL,
  `rent_from_date` timestamp NULL DEFAULT NULL,
  `rent_to_date` timestamp NULL DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `security_deposit` varchar(50) DEFAULT NULL,
  `kyc_document` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `deliveryid`, `prod_id`, `prod_sku`, `vendor_id`, `prod_name`, `prod_name_ar`, `prod_img`, `prod_attr`, `qty`, `prod_price`, `shipping`, `discount`, `create_date`, `update_date`, `status`, `status_date`, `refund_amt`, `refund_txnno`, `refund_date`, `pickup_date`, `pickup_status`, `return_status`, `return_reason`, `return_updateby`, `invoice_number`, `delivery_date`, `tracking_id`, `tracking_url`, `otp`, `return_last_date`, `coupon_code`, `coupon_value`, `product_hsn_code`, `product_unique_code`, `seller_price`, `admin_profit`, `tds`, `tcs`, `gross_amount`, `gst_input`, `net_amount`, `taxable_amount`, `cgst`, `sgst`, `igst`, `reverse_shipping`, `print_label`, `pickup_type`, `p_weight`, `p_length`, `p_width`, `p_height`, `courier_name`, `rent_from_date`, `rent_to_date`, `type`, `security_deposit`, `kyc_document`) VALUES
(1, 'ODRCD39HS123133', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 23500, 0, 0, '2023-11-30 12:31:33', '2023-11-30 07:01:33', 'Placed', '2023-11-30 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000264', '0000-00-00', NULL, NULL, NULL, '2023-12-02', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '22380.95', '0', '0', '1119.05', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-01 00:00:00', '2023-12-05 00:00:00', 'Rent', '22000', NULL),
(2, 'ODRSHDLLB020487', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 22500, 0, 0, '2023-11-30 14:04:02', '2023-12-02 06:39:27', 'Completed', '2023-12-02 06:39:27', NULL, NULL, NULL, '2023-12-01 15:57:04', NULL, NULL, NULL, NULL, 'JO-2324-000265', '0000-00-00', NULL, NULL, NULL, '2023-12-02', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '21428.57', '0', '0', '1071.43', '0', '', 'self', NULL, NULL, NULL, NULL, NULL, '2023-12-01 00:00:00', '2023-12-01 00:00:00', 'Rent', '22000', NULL),
(3, 'ODRH3VGNR105716', NULL, 'P58moSCI2e1', 'Pink-Floral-Embroidered-Sherwani', 'SVR6og303Vm', 'Pink Floral Embroidered Sherwani', '', '2023-11-03/6544e05ef34d5.webp', '[]', 1, 1284, 0, 716, '2023-12-02 10:57:00', '2023-12-02 05:27:00', 'Placed', '2023-12-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000266', '0000-00-00', NULL, NULL, NULL, '0000-00-00', '', '0', '', 'PI505106', '1200', '7', '12.2', '12.2', '1175.6', '1.26', '1174.34', '1222.86', '0', '0', '61.14', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(4, 'ODRH3VGNR105716', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-02 10:57:00', '2023-12-02 05:27:00', 'Placed', '2023-12-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000267', '0000-00-00', NULL, NULL, NULL, '2023-12-04', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(5, 'ODRITUDDJ050419', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-04 17:04:28', '2023-12-04 11:34:28', 'Placed', '2023-12-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000268', '0000-00-00', NULL, NULL, NULL, '2023-12-06', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(6, 'ODRAZVWZN041568', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-05 16:15:09', '2023-12-05 10:45:09', 'Cancelled', '2023-12-05 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000269', '0000-00-00', NULL, NULL, NULL, '2023-12-07', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(7, 'ODR5BI1P809185', NULL, 'PyfvpXVKR2t', 'Realistic-Artificial-Silk', 'SVR6og303Vm', 'Realistic Artificial Silk', '', '2023-11-03/6544e31a593e7.webp', '[]', 1, 189, 0, 11, '2023-12-06 09:18:38', '2023-12-06 03:48:38', 'Cancelled', '2023-12-06 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000270', '0000-00-00', NULL, NULL, NULL, '0000-00-00', '', '0', '', 'RE238465', '180', '5', '1.8', '1.8', '176.4', '0.9', '175.5', '180', '0', '0', '9', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(8, 'ODRV3IB2A125761', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-08 12:57:29', '2023-12-08 07:27:29', 'Placed', '2023-12-08 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000271', '0000-00-00', NULL, NULL, NULL, '2023-12-10', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(9, 'ODRL1TJ5V040364', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-09 16:03:58', '2023-12-09 10:33:58', 'Placed', '2023-12-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000272', '0000-00-00', NULL, NULL, NULL, '2023-12-11', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(10, 'ODRGJELRQ04251', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-09 16:25:22', '2023-12-09 10:55:22', 'Placed', '2023-12-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000273', '0000-00-00', NULL, NULL, NULL, '2023-12-11', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(11, 'ODRNRAPQ8043650', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-09 16:36:54', '2023-12-09 11:06:54', 'Placed', '2023-12-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000274', '0000-00-00', NULL, NULL, NULL, '2023-12-11', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(12, 'ODRLJNHP9050274', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 756, 0, 244, '2023-12-09 17:02:35', '2023-12-13 15:03:51', 'Accepted', '2023-12-09 00:00:00', NULL, NULL, NULL, '2023-12-15 15:03:51', NULL, NULL, NULL, NULL, 'JO-2324-000275', '0000-00-00', NULL, NULL, NULL, '2023-12-11', '', '0', '62112', 'DP217956', '700', '8', '7.18', '7.18', '685.64', '1.44', '684.2', '720', '0', '0', '36', '', '', 'self', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', NULL, NULL),
(13, 'ODRYFS2A3010321', NULL, 'PxZ3aQ9BvRF', 'Samsung-CC112-Camera', 'SVR6og303Vm', 'Samsung CC112 Camera', '', '2023-12-13/6579559e6e8de.webp', '[]', 1, 44290, 0, 710, '2023-12-13 13:03:13', '2023-12-13 13:21:01', 'Shipped', '2023-12-13 13:21:01', NULL, NULL, NULL, '2023-12-18 13:17:59', NULL, NULL, NULL, NULL, 'JO-2324-000276', '2023-12-18', '', '', NULL, '2023-12-15', '', '0', '544412', 'SA241816', '43000', '3', '420.76', '420.76', '42158.48', '0.54', '42157.94', '42180.95', '0', '0', '2109.05', '0', '', 'self', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', NULL, NULL),
(14, 'ODRRFCM5P124445', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 23500, 0, 0, '2023-12-14 12:44:21', '2023-12-14 19:18:44', 'Packed', '2023-12-14 19:18:44', NULL, NULL, NULL, '2023-12-14 12:49:35', NULL, NULL, NULL, NULL, 'JO-2324-000277', '2023-12-16', '', '', NULL, '2023-12-16', '', '0', '62112', 'DP217956', '700', '1', '7.18', '7.18', '685.64', '0.18', '685.46', '22380.95', '0', '0', '1119.05', '0', '', 'self', NULL, NULL, NULL, NULL, NULL, '2024-01-01 00:00:00', '2024-01-05 00:00:00', 'Rent', '22000', NULL),
(15, 'ODRBE5RCI060530', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 0, 0, 0, '2023-12-16 18:05:09', '2023-12-16 18:05:09', 'Placed', '2023-12-16 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JO-2324-000278', '0000-00-00', NULL, NULL, NULL, '2023-12-18', 'undefined', '0', '62112', 'DP217956', '700', '1', '7.18', '7.18', '685.64', '0.18', '685.46', '1428.57', '0', '0', '71.43', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-22 18:30:00', '2023-12-26 18:30:00', 'Rent', '22000', '2023-12-16/647652248women-top-6.jpg'),
(16, 'ODRZ3YGCW060777', NULL, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'Dpofirs Digital Camera 1080P', '', '2023-11-03/6544e186c6a6a.webp', '[]', 1, 0, 0, 0, '2023-12-16 18:07:00', '2023-12-16 19:02:30', 'Delivered', '2023-12-16 19:02:30', NULL, NULL, NULL, '2023-12-16 18:27:39', NULL, NULL, NULL, NULL, 'JO-2324-000279', '0000-00-00', NULL, NULL, NULL, '2023-12-18', 'undefined', '0', '62112', 'DP217956', '700', '1', '7.18', '7.18', '685.64', '0.18', '685.46', '476.19', '0', '0', '23.81', '0', '', 'self', NULL, NULL, NULL, NULL, NULL, '2023-12-15 18:30:00', '2023-12-15 18:30:00', 'Rent', '22000', '2023-12-16/975052802women-top-9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking_status`
--

CREATE TABLE `order_tracking_status` (
  `id` int(11) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_tracking_status`
--

INSERT INTO `order_tracking_status` (`id`, `order_id`, `product_id`, `status`, `message`, `created_at`) VALUES
(1, 'ODRSHDLLB020487', 'P3j0EAd5zx4', 'Shipped', 'today', '2023-12-01 16:26:29'),
(2, 'ODRSHDLLB020487', 'P3j0EAd5zx4', 'Delivered', 'today', '2023-12-02 17:51:41'),
(3, 'ODRSHDLLB020487', 'P3j0EAd5zx4', 'Return Request', 'today', '2023-12-02 17:53:32'),
(4, 'ODRYFS2A3010321', 'PxZ3aQ9BvRF', 'Packed', '', '2023-12-13 13:19:48'),
(5, 'ODRYFS2A3010321', 'PxZ3aQ9BvRF', 'Shipped', 'your order has been shipped', '2023-12-13 13:21:01'),
(6, 'ODRRFCM5P124445', 'P3j0EAd5zx4', 'Packed', 'today', '2023-12-14 17:56:16'),
(24, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Packed', '', '2023-12-16 18:45:33'),
(25, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:46:51'),
(26, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:47:02'),
(27, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:47:56'),
(28, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:48:03'),
(29, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:48:30'),
(30, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:48:46'),
(31, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:51:17'),
(32, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:51:29'),
(33, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:51:36'),
(34, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:51:59'),
(35, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:52:20'),
(36, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:53:41'),
(37, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:54:07'),
(38, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:54:29'),
(39, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:55:37'),
(40, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Shipped', '', '2023-12-16 18:57:00'),
(41, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 18:59:10'),
(42, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 18:59:39'),
(43, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 18:59:49'),
(44, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 18:59:57'),
(45, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 19:00:21'),
(46, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 19:02:20'),
(47, 'ODRZ3YGCW060777', 'P3j0EAd5zx4', 'Delivered', '', '2023-12-16 19:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pages_id` int(11) NOT NULL,
  `page_title` text NOT NULL,
  `page_dsc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pages_id`, `page_title`, `page_dsc`) VALUES
(1, 'About', 'About data');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `seller_id` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `from_date` varchar(50) NOT NULL,
  `to_date` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `transection_id` varchar(50) NOT NULL,
  `invoice_proof` text NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `seller_id`, `amount`, `from_date`, `to_date`, `payment_status`, `transection_id`, `invoice_proof`, `create_date`, `update_date`) VALUES
(1, 'S1lpztIfHJn', '0', '2023-09-16', '2023-09-20', 'paid', 'csc12s1c', '{\"72-72\":\"2023-12-04\\/656db98a6754d.webp\",\"200-200\":\"2023-12-04\\/656db98a6754d.webp\",\"280-310\":\"2023-12-04\\/656db98a6754d.webp\",\"400-200\":\"2023-12-04\\/656db98a6754d.webp\",\"430-590\":\"2023-12-04\\/656db98a6754d.webp\",\"600-810\":\"2023-12-04\\/656db98a6754d.webp\"}', '2023-09-20 10:23:43', '2023-12-04 15:35:38'),
(2, 'SdCeACa0Ylj', '0', '2023-09-16', '2023-09-20', 'No Due', '', '', '2023-09-20 10:23:43', '0000-00-00 00:00:00'),
(3, 'SMwXDvp23uj', '0', '2023-09-16', '2023-09-20', 'No Due', '', '', '2023-09-20 10:23:43', '0000-00-00 00:00:00'),
(4, 'SRqrYdjMsuW', '0', '2023-09-16', '2023-09-20', 'No Due', '', '', '2023-09-20 10:23:43', '0000-00-00 00:00:00'),
(5, 'SVR6og303Vm', '18.82', '2023-09-16', '2023-09-20', 'pending', '', '', '2023-09-20 10:23:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `popular_product`
--

CREATE TABLE `popular_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `popular_product`
--

INSERT INTO `popular_product` (`id`, `product_id`, `type`, `created_at`) VALUES
(52, 'P0FlGOLjoRM', 'New', '2023-05-18 11:41:20'),
(53, 'P9DmeopaHwW', 'home_bottom', '2023-05-18 11:47:50'),
(54, 'P0FlGOLjoRM', 'home_bottom', '2023-05-18 11:48:21'),
(55, 'P0FlGOLjoRM', 'Offers', '2023-05-18 11:53:50'),
(56, 'Pi3dq28YyfG', 'New', '2023-05-20 06:56:02'),
(57, 'Pi3dq28YyfG', 'Offers', '2023-05-20 09:12:31'),
(63, 'PHYOXmywg18', 'Offers', '2023-05-20 21:08:44'),
(68, 'PHYOXmywg18', 'Most', '2023-05-25 13:21:53'),
(73, 'PtZRBD19y8u', 'New', '2023-06-14 06:22:49'),
(74, 'PGVlxc40bt1', 'New', '2023-06-19 21:06:58'),
(75, 'PH847cs0bk9', 'New', '2023-06-19 21:07:06'),
(76, 'Piq5xwNuZng', 'New', '2023-06-19 21:07:21'),
(77, 'PtO9XhSimKM', 'Popular', '2023-06-19 21:07:47'),
(78, 'PH847cs0bk9', 'Recommended', '2023-06-19 21:07:57'),
(79, 'PvQ7awrzJR3', 'Offers', '2023-06-19 21:08:08'),
(80, 'PGVlxc40bt1', 'Popular', '2023-06-19 21:09:28'),
(81, 'Pryhn78WDk4', 'Most', '2023-06-19 21:11:39'),
(83, 'PGVlxc40bt1', 'Custom', '2023-06-19 21:12:13'),
(84, 'PvQ7awrzJR3', 'home_bottom', '2023-06-19 21:13:21'),
(85, 'P9087PImiwn', 'home_bottom', '2023-06-19 21:16:12'),
(86, 'PYimVawjSed', 'New', '2023-06-26 05:31:46'),
(87, 'Po0i5fyrTIt', 'New', '2023-06-26 05:31:53'),
(108, 'PZPXMmjO7c2', 'New', '2023-11-04 11:00:29'),
(109, 'PyfvpXVKR2t', 'New', '2023-11-04 11:00:50'),
(111, 'P3j0EAd5zx4', 'New', '2023-11-04 11:01:19'),
(112, 'P58moSCI2e1', 'New', '2023-11-04 11:01:32'),
(113, 'P3j0EAd5zx4', 'Popular', '2023-11-04 11:01:49'),
(114, 'PyfvpXVKR2t', 'Recommended', '2023-11-04 11:02:32'),
(115, 'P58moSCI2e1', 'Offers', '2023-11-04 11:03:07'),
(116, 'PZPXMmjO7c2', 'Offers', '2023-11-04 11:03:16'),
(118, 'PIxivLeB2hS', 'Most', '2023-11-04 11:04:27'),
(119, 'P3j0EAd5zx4', 'Most', '2023-11-04 11:04:35'),
(120, 'PE26FIKxnrO', 'Custom', '2023-11-04 11:05:11'),
(121, 'PMOhg3ypAtr', 'Custom', '2023-11-04 11:05:41'),
(122, 'PIxivLeB2hS', 'home_bottom', '2023-11-06 07:24:32'),
(123, 'P3j0EAd5zx4', 'prod_section_1', '2023-11-06 07:46:40'),
(124, 'P58moSCI2e1', 'prod_section_2', '2023-11-06 11:01:34'),
(125, 'P58moSCI2e1', 'prod_section_1', '2023-11-07 12:24:31'),
(126, 'PyfvpXVKR2t', 'prod_section_1', '2023-11-07 12:24:40'),
(127, 'PIxivLeB2hS', 'prod_section_1', '2023-11-07 12:24:57'),
(128, 'P9WAS7UpdNL', 'prod_section_1', '2023-11-07 12:25:06'),
(129, 'PF4DLOX6AxZ', 'prod_section_1', '2023-11-07 12:25:26'),
(130, 'PE26FIKxnrO', 'prod_section_1', '2023-11-07 12:26:12'),
(131, 'PE26FIKxnrO', 'prod_section_2', '2023-11-07 12:26:23'),
(132, 'P9WAS7UpdNL', 'prod_section_2', '2023-11-07 12:26:30'),
(133, 'PF4DLOX6AxZ', 'prod_section_2', '2023-11-07 12:26:38'),
(134, 'PuL71pefTY9', 'prod_section_2', '2023-11-07 12:27:16'),
(135, 'P5YPCG1W4Sj', 'prod_section_2', '2023-11-07 12:27:24'),
(136, 'PZPXMmjO7c2', 'prod_section_2', '2023-11-07 12:27:59'),
(137, 'PSpjLQRcCX7', 'prod_section_2', '2023-11-07 12:28:12'),
(138, 'PvaNrJZT89y', 'prod_section_1', '2023-12-13 09:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL,
  `prod_attr_id` int(11) NOT NULL,
  `prod_id` varchar(100) NOT NULL,
  `attr_value` varchar(1000) NOT NULL,
  `vendor_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `prod_attr_id`, `prod_id`, `attr_value`, `vendor_id`) VALUES
(1, 2, 'PF4DLOX6AxZ', '{\"0\":\"#43549f\",\"1\":\"#4870FF\"}', 'SVR6og303Vm'),
(2, 2, 'P9WAS7UpdNL', '{\"0\":\"#a0b8f9\",\"1\":\"#ff47cb\"}', 'SVR6og303Vm'),
(3, 2, 'PE26FIKxnrO', '{\"0\":\"#303030\",\"1\":\"#43549f\"}', 'SVR6og303Vm'),
(4, 2, 'PMOhg3ypAtr', '{\"0\":\"#303030\",\"1\":\"#F42525\",\"2\":\"#ff4040\"}', 'SVR6og303Vm'),
(5, 11, 'PMOhg3ypAtr', '{\"0\":\"SleevesLess\"}', 'SVR6og303Vm'),
(6, 2, 'PAJDpio1yhc', '{\"0\":\"#303030\",\"1\":\"#F42525\"}', 'SVR6og303Vm'),
(7, 1, 'PAJDpio1yhc', '{\"0\":\"M\",\"1\":\"S\"}', 'SVR6og303Vm');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_conf`
--

CREATE TABLE `product_attributes_conf` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_attributes_conf`
--

INSERT INTO `product_attributes_conf` (`id`, `attribute_id`, `attribute_value`) VALUES
(1, 1, 'M'),
(2, 1, 'L'),
(3, 2, '#F42525'),
(4, 2, '#FAFF1C'),
(5, 2, '#4870FF'),
(6, 2, '1'),
(8, 4, 'Cotton'),
(9, 4, 'Synthetic'),
(10, 1, 'S'),
(11, 1, 'XL'),
(12, 1, 'XXL'),
(14, 5, 'A  Line'),
(18, 2, '#43549f'),
(20, 2, '#a0b8f9'),
(23, 2, '#ffffff'),
(24, 2, '#f9f0f0'),
(25, 2, '#c5d2ec'),
(26, 2, '#cdcdd4'),
(27, 2, '#9fb6cd'),
(28, 2, '#c45fa4'),
(29, 2, '#ff47cb'),
(30, 2, '#c267a7'),
(32, 2, '#ff4040'),
(33, 2, '#ee3b3b'),
(35, 2, '#303030'),
(37, 2, '#dedede'),
(38, 1, 'Free Size'),
(39, 4, 'rayon'),
(40, 13, 'Combo Of 2'),
(41, 13, 'Combo Of 3'),
(42, 13, 'Combo Of 4'),
(43, 13, 'Combo Of 5'),
(44, 13, 'Combo Of 6'),
(45, 13, 'Couples Sets'),
(46, 13, 'Kurti With Saree'),
(47, 13, 'Single'),
(48, 12, 'Semi- Stitched'),
(49, 12, 'Stitched'),
(50, 12, 'Unstitched'),
(51, 11, 'Long Sleeves'),
(52, 11, 'Short Sleeves'),
(53, 11, 'SleevesLess'),
(54, 11, 'Three-Quarter Sleeves'),
(55, 7, 'Daily'),
(56, 7, 'Festive'),
(57, 7, 'Maternity'),
(58, 7, 'Office'),
(59, 7, 'Party'),
(60, 7, 'Wedding'),
(61, 6, 'Boot'),
(62, 6, 'Court'),
(63, 6, 'Cowl'),
(64, 6, 'Holter'),
(65, 6, 'Horse shoe'),
(66, 6, 'Mandarin'),
(67, 6, 'Notch'),
(68, 6, 'Off-Shoulder'),
(69, 6, 'Paan'),
(70, 6, 'Round'),
(71, 6, 'Scoop'),
(72, 6, 'Shawl'),
(73, 6, 'Shirt'),
(74, 6, 'Stylished'),
(75, 6, 'Square'),
(76, 6, 'Surplice'),
(77, 6, 'Sweet Heart'),
(78, 6, 'Tie-up'),
(79, 6, 'V-Neck'),
(80, 9, 'Applique'),
(81, 9, 'Checked'),
(82, 9, 'Chikankari'),
(83, 9, 'Colorblocked'),
(84, 9, 'Dyed / Washed'),
(85, 9, 'Embellished'),
(86, 9, 'Embroidered'),
(87, 9, 'Printed'),
(88, 9, 'Self-Desigen'),
(89, 9, 'Solid'),
(90, 9, 'Striped'),
(91, 9, 'Woven Design'),
(92, 9, 'Zari Embroidered '),
(93, 9, 'Zari Woven '),
(94, 8, 'Aari Work '),
(95, 8, 'Applique '),
(96, 8, 'Beads & Stones'),
(97, 8, 'Brocade'),
(98, 8, 'Brooch '),
(99, 8, 'Cutouts'),
(100, 8, 'Cutwork'),
(101, 8, 'Embroidered'),
(102, 8, 'Frills'),
(103, 8, 'Gota Work '),
(104, 8, 'Jacquard'),
(105, 8, 'Lace Border'),
(106, 8, 'Mirror Work '),
(107, 8, 'Mukaish '),
(108, 8, 'Net'),
(109, 8, 'Patchwork'),
(110, 8, 'Pintucks'),
(111, 8, 'Pom-Pom'),
(112, 8, 'Ruffle'),
(113, 8, 'Sequinned'),
(114, 8, 'Show Button'),
(115, 8, 'Tassels and Latkans'),
(116, 8, 'Tie-Ups '),
(117, 8, 'Zardozi'),
(118, 5, 'Anarkali '),
(119, 5, 'Angrakha'),
(120, 5, 'Assymerical'),
(121, 5, 'C-Cut'),
(122, 5, 'Cowl'),
(123, 5, 'Crop Top Kurti'),
(124, 5, 'Dhoti'),
(125, 5, 'Empire'),
(126, 5, 'Flared'),
(127, 5, 'Gown'),
(128, 5, 'Hight-Slit'),
(129, 5, 'Hight-Low'),
(130, 5, 'Jacket Kurta'),
(131, 5, 'Kaftan'),
(132, 5, 'Layered'),
(133, 5, 'maxi Kurta'),
(134, 5, 'Naira Cut '),
(135, 5, 'Pakistani'),
(136, 5, 'Panelled'),
(137, 5, 'pleated'),
(138, 5, 'Short'),
(139, 5, 'Short Kurti'),
(140, 5, 'Shrug Kurti'),
(141, 5, 'Straight'),
(142, 5, 'Tiered'),
(143, 5, 'Tunic'),
(144, 5, 'Maternity'),
(145, 10, 'Abstract'),
(146, 10, 'Animal '),
(147, 10, 'Applique'),
(148, 10, 'Aztec'),
(149, 10, 'Bandhani'),
(150, 10, 'Batik'),
(151, 10, 'Block '),
(152, 10, 'Bohemian'),
(153, 10, 'Botanical'),
(154, 10, 'Checked'),
(155, 10, 'Chevron'),
(156, 10, 'Colorblocked '),
(157, 10, 'Embellished'),
(158, 10, 'Ethnic Motif'),
(159, 10, 'Floral'),
(160, 10, 'Foil '),
(161, 10, 'Geometric'),
(162, 10, 'Graphic'),
(163, 10, 'Herringbone'),
(164, 10, 'Houndstooth'),
(165, 10, 'Ikat'),
(166, 10, 'Kalamkari'),
(167, 10, 'Leheriya'),
(168, 10, 'Madhubani'),
(169, 10, 'Micro'),
(170, 10, 'Paisley '),
(171, 10, 'Polka Dot'),
(172, 10, 'Quirky'),
(173, 10, 'Ribbon '),
(174, 10, 'Scenic'),
(175, 10, 'Shibori'),
(176, 10, 'Solid'),
(177, 10, 'Stripe'),
(178, 10, 'Tie & dye'),
(179, 10, 'Tribal '),
(180, 10, 'Warli'),
(181, 10, 'Woven Design'),
(182, 10, 'Zari Butta '),
(183, 4, 'Acrylic'),
(184, 4, 'Art Silk'),
(185, 4, 'Bamboo'),
(186, 4, 'Banarasi Silk'),
(187, 4, 'Chambray'),
(188, 4, 'Chanderi Cotton'),
(189, 4, 'Shandevi Silk '),
(190, 4, 'Chiffon'),
(191, 4, 'Cotton Blend '),
(192, 4, 'Cotton Combric'),
(193, 4, 'Cotton Line '),
(194, 4, 'Cotton Silk '),
(195, 4, 'Cotton Slub '),
(196, 4, 'Crepe'),
(197, 4, 'Denim '),
(198, 4, 'Dupion Silk '),
(199, 4, 'Georgette'),
(200, 4, 'Jacquard '),
(201, 4, 'Jute Cotton '),
(202, 4, 'Jute Khadi '),
(203, 4, 'Jute Silk '),
(204, 4, 'Khadi Cotton '),
(205, 4, 'Net '),
(206, 4, 'Nylon '),
(207, 4, 'Organza '),
(208, 4, 'Paper Silk '),
(209, 4, 'Pashmina '),
(210, 4, 'Polychiffon '),
(211, 4, 'Polyster '),
(212, 4, 'Rayon Slub '),
(213, 4, 'Satin'),
(214, 4, 'satin silk '),
(215, 4, 'Shantoon silk '),
(216, 4, 'Silk Blend  '),
(217, 4, 'Soft Silk '),
(218, 4, 'Super Net '),
(219, 4, 'Velvet '),
(220, 4, 'Vichitra Silk '),
(221, 4, 'Viscose '),
(222, 4, 'Viscose Rayon'),
(223, 4, 'Viscose Silk'),
(224, 4, 'Voile '),
(225, 4, 'Wool'),
(226, 1, '2-2'),
(227, 1, '2-4'),
(228, 1, '2-6'),
(229, 1, '2-8'),
(235, 4, '20-20'),
(236, 2, 'Carousel Pink'),
(237, 2, 'color 1'),
(238, 2, 'color 2'),
(239, 21, 'color 1'),
(240, 21, 'color 2'),
(241, 21, 'color 3'),
(242, 21, 'color 4'),
(243, 21, 'color 5'),
(244, 22, '1'),
(245, 22, '2'),
(246, 22, '3'),
(247, 22, '4'),
(248, 22, '5'),
(249, 22, '6'),
(250, 22, '7'),
(251, 1, 'SS');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_set`
--

CREATE TABLE `product_attributes_set` (
  `id` int(11) NOT NULL,
  `attribute` varchar(200) NOT NULL,
  `attribute_ar` varchar(255) NOT NULL,
  `attribute_value` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_attributes_set`
--

INSERT INTO `product_attributes_set` (`id`, `attribute`, `attribute_ar`, `attribute_value`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Size', '', '', 1, NULL, '2023-02-22 10:42:07', ''),
(2, 'Color', '', '', 1, NULL, '2023-03-03 08:26:23', ''),
(4, 'Fabric', '', '', 1, NULL, '2023-03-11 09:08:07', ''),
(5, 'Fit/Shape', '', '', 1, NULL, '2023-05-15 05:08:00', ''),
(6, 'Neck', '', '', 1, NULL, '2023-05-14 19:24:19', ''),
(7, 'Occasion', '', '', 1, NULL, '2023-05-15 04:38:21', ''),
(8, 'Ornamentation', '', '', 1, NULL, '2023-05-15 04:39:00', ''),
(9, 'Pattern', '', '', 1, NULL, '2023-05-15 04:39:11', ''),
(10, 'Print &  Pattern', '', '', 1, NULL, '2023-05-15 04:39:34', ''),
(11, 'Sleeve length', '', '', 1, NULL, '2023-05-15 04:42:20', ''),
(12, 'Stitch Type', '', '', 1, NULL, '2023-05-15 04:40:10', ''),
(13, 'Combo Of ', '', '', 1, NULL, '2023-05-15 04:40:26', ''),
(21, 'D.NO', '', '', 1, NULL, '2023-06-04 03:27:46', ''),
(22, 'colors', '', '', 1, NULL, '2023-06-15 07:29:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `vendor_prod_id` int(11) NOT NULL,
  `product_sku` varchar(100) NOT NULL,
  `prod_attr_value` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `mrp` float NOT NULL,
  `stock` int(11) NOT NULL,
  `conf_image` text NOT NULL,
  `notify_on_stock_below` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `product_id`, `vendor_prod_id`, `product_sku`, `prod_attr_value`, `price`, `mrp`, `stock`, `conf_image`, `notify_on_stock_below`, `created_at`, `updated_at`) VALUES
(1, 'PF4DLOX6AxZ', 9, 'Floral-Embroidered-Art-Silk-Unstitched-Dress-Material-#43549f', '{\"0\":\"#43549f\"}', 10.5, 20, 2000000, '{\"72-72\":\"2023-07-17/64b4cf6dc5c54.webp\",\"200-200\":\"2023-07-17/64b4cf6dc5c54.webp\",\"280-310\":\"2023-07-17/64b4cf6dc5c54.webp\",\"400-200\":\"2023-07-17/64b4cf6dc5c54.webp\",\"430-590\":\"2023-07-17/64b4cf6dc5c54.webp\",\"600-810\":\"2023-07-17/64b4cf6dc5c54.webp\"}', 1, '2023-07-17 10:49:41', '2023-07-17 05:19:41'),
(2, 'PF4DLOX6AxZ', 9, 'Floral-Embroidered-Art-Silk-Unstitched-Dress-Material-#4870FF', '{\"0\":\"#4870FF\"}', 10.5, 20, 2000000, '{\"72-72\":\"2023-07-17/64b4cf6dc7ad8.webp\",\"200-200\":\"2023-07-17/64b4cf6dc7ad8.webp\",\"280-310\":\"2023-07-17/64b4cf6dc7ad8.webp\",\"400-200\":\"2023-07-17/64b4cf6dc7ad8.webp\",\"430-590\":\"2023-07-17/64b4cf6dc7ad8.webp\",\"600-810\":\"2023-07-17/64b4cf6dc7ad8.webp\"}', 1, '2023-07-17 10:49:41', '2023-07-17 05:19:41'),
(3, 'P9WAS7UpdNL', 10, 'Embroidered-Sequinned-Unstitched-Dress-Material-#a0b8f9', '{\"0\":\"#a0b8f9\"}', 31.5, 40, 22000000, '{\"72-72\":\"2023-07-17/64b4cfd8e862c.webp\",\"200-200\":\"2023-07-17/64b4cfd8e862c.webp\",\"280-310\":\"2023-07-17/64b4cfd8e862c.webp\",\"400-200\":\"2023-07-17/64b4cfd8e862c.webp\",\"430-590\":\"2023-07-17/64b4cfd8e862c.webp\",\"600-810\":\"2023-07-17/64b4cfd8e862c.webp\"}', 1, '2023-07-17 10:51:28', '2023-07-17 05:21:28'),
(4, 'P9WAS7UpdNL', 10, 'Embroidered-Sequinned-Unstitched-Dress-Material-#ff47cb', '{\"0\":\"#ff47cb\"}', 31.5, 40, 2147483647, '{\"72-72\":\"2023-07-17/64b4cfd8e8f74.webp\",\"200-200\":\"2023-07-17/64b4cfd8e8f74.webp\",\"280-310\":\"2023-07-17/64b4cfd8e8f74.webp\",\"400-200\":\"2023-07-17/64b4cfd8e8f74.webp\",\"430-590\":\"2023-07-17/64b4cfd8e8f74.webp\",\"600-810\":\"2023-07-17/64b4cfd8e8f74.webp\"}', 1, '2023-07-17 10:51:28', '2023-07-17 05:21:28'),
(5, 'PE26FIKxnrO', 11, 'encore-by-INVICTUS-303030', '{\"0\":\"#303030\"}', 200, 378, 1000, '', 0, '2023-08-24 00:00:00', '2023-08-24 06:10:39'),
(6, 'PE26FIKxnrO', 11, 'encore-by-INVICTUS-43549f', '{\"0\":\"#43549f\"}', 300, 378, 1000, '', 0, '2023-08-24 00:00:00', '2023-08-24 06:10:39'),
(7, 'PMOhg3ypAtr', 18, 'Roadister-#303030-SleevesLess', '{\"0\":\"#303030\",\"1\":\"SleevesLess\"}', 500, 700, 49, '{\"72-72\":\"2023-09-11/64feb3c2cade0.webp\",\"200-200\":\"2023-09-11/64feb3c2cade0.webp\",\"280-310\":\"2023-09-11/64feb3c2cade0.webp\",\"400-200\":\"2023-09-11/64feb3c2cade0.webp\",\"430-590\":\"2023-09-11/64feb3c2cade0.webp\",\"600-810\":\"2023-09-11/64feb3c2cade0.webp\"}', 1, '2023-09-11 10:29:22', '2023-09-12 05:55:36'),
(8, 'PMOhg3ypAtr', 18, 'Roadister-#F42525-SleevesLess', '{\"0\":\"#F42525\",\"1\":\"SleevesLess\"}', 400, 600, 49, '{\"72-72\":\"2023-09-11/64feb3c2cf51d.webp\",\"200-200\":\"2023-09-11/64feb3c2cf51d.webp\",\"280-310\":\"2023-09-11/64feb3c2cf51d.webp\",\"400-200\":\"2023-09-11/64feb3c2cf51d.webp\",\"430-590\":\"2023-09-11/64feb3c2cf51d.webp\",\"600-810\":\"2023-09-11/64feb3c2cf51d.webp\"}', 1, '2023-09-11 10:29:22', '2023-09-12 05:55:36'),
(9, 'PMOhg3ypAtr', 18, 'Roadister-#ff4040-SleevesLess', '{\"0\":\"#ff4040\",\"1\":\"SleevesLess\"}', 300, 500, 49, '{\"72-72\":\"2023-09-11/64feb3c2d0d5d.webp\",\"200-200\":\"2023-09-11/64feb3c2d0d5d.webp\",\"280-310\":\"2023-09-11/64feb3c2d0d5d.webp\",\"400-200\":\"2023-09-11/64feb3c2d0d5d.webp\",\"430-590\":\"2023-09-11/64feb3c2d0d5d.webp\",\"600-810\":\"2023-09-11/64feb3c2d0d5d.webp\"}', 1, '2023-09-11 10:29:22', '2023-09-12 05:55:36'),
(10, 'PAJDpio1yhc', 19, 'HP-IS123-#303030-M', '{\"0\":\"#303030\",\"1\":\"M\"}', 168, 200, 3, '', 1, '2023-10-08 16:20:33', '2023-10-08 12:20:33'),
(11, 'PAJDpio1yhc', 19, 'HP-IS123-#303030-S', '{\"0\":\"#303030\",\"1\":\"S\"}', 168, 200, 3, '', 1, '2023-10-08 16:20:33', '2023-10-08 12:20:33'),
(12, 'PAJDpio1yhc', 19, 'HP-IS123-#F42525-M', '{\"0\":\"#F42525\",\"1\":\"M\"}', 168, 200, 2, '', 1, '2023-10-08 16:20:33', '2023-10-08 12:20:33'),
(13, 'PAJDpio1yhc', 19, 'HP-IS123-#F42525-S', '{\"0\":\"#F42525\",\"1\":\"S\"}', 168, 200, 1, '', 1, '2023-10-08 16:20:33', '2023-10-08 12:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0,
  `prod_id` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `cat_id`, `prod_id`, `created_at`, `updated_at`) VALUES
(5, 9, 'PSpjLQRcCX7', '2023-07-05 11:36:47', '2023-07-05 06:06:47'),
(6, 9, 'P5YPCG1W4Sj', '2023-07-05 13:48:35', '2023-07-05 08:18:35'),
(8, 19, 'PyEXPlSz70I', '2023-07-05 14:00:39', '2023-07-05 08:30:39'),
(9, 34, 'PIxivLeB2hS', NULL, '2023-07-05 11:00:42'),
(10, 9, 'PF4DLOX6AxZ', '2023-07-17 10:49:41', '2023-07-17 05:19:41'),
(11, 9, 'P9WAS7UpdNL', '2023-07-17 10:51:28', '2023-07-17 05:21:28'),
(12, 46, 'PE26FIKxnrO', '2023-08-01 13:31:06', '2023-08-01 09:31:06'),
(13, 46, 'PuL71pefTY9', '2023-08-01 15:38:28', '2023-08-01 10:08:28'),
(14, 47, 'PqIZtmKj1bc', '2023-08-01 14:26:10', '2023-08-01 10:26:10'),
(18, 19, 'PlQaDBj6SCs', '2023-08-30 00:00:00', '2023-08-30 00:00:00'),
(19, 46, 'PMOhg3ypAtr', '2023-09-11 10:29:22', '2023-09-11 06:29:22'),
(20, 34, 'PAJDpio1yhc', '2023-10-08 16:20:33', '2023-10-08 12:20:33'),
(27, 19, 'PJYrUOcWS1o', '2023-11-02 11:38:05', '2023-11-02 07:38:05'),
(28, 38, 'PnQCA34gWB1', '2023-11-02 13:35:02', '2023-11-02 09:35:02'),
(29, 19, 'Pz3lqeIkwQK', '2023-11-03 10:56:18', '2023-11-03 05:26:18'),
(30, 49, 'PZPXMmjO7c2', '2023-11-03 15:50:55', '2023-11-03 11:50:55'),
(31, 50, 'P58moSCI2e1', '2023-11-03 15:58:22', '2023-11-03 11:58:23'),
(32, 51, 'P3j0EAd5zx4', '2023-11-03 16:03:18', '2023-11-03 12:03:18'),
(33, 52, 'PyfvpXVKR2t', '2023-11-03 16:10:02', '2023-11-03 12:10:02'),
(34, 11, 'Pxuyhzd6rei', '2023-11-21 10:45:26', '2023-11-21 06:45:26'),
(37, 51, 'PWqFCZ0L5I7', '2023-11-22 15:19:36', '2023-11-22 11:19:36'),
(38, 46, 'PGCSU4EqDnJ', '2023-12-12 00:00:00', '2023-12-12 00:00:00'),
(39, 51, 'PxZ3aQ9BvRF', '2023-12-13 12:26:30', '2023-12-13 06:56:30'),
(40, 51, 'PvaNrJZT89y', '2023-12-13 14:54:03', '2023-12-13 09:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `prod_name` varchar(500) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_fulldetail` text NOT NULL,
  `prod_name_ar` text NOT NULL,
  `prod_desc_ar` text NOT NULL,
  `prod_fulldetail_ar` text NOT NULL,
  `prod_rating` float NOT NULL DEFAULT 0,
  `prod_rating_count` int(11) NOT NULL DEFAULT 0,
  `prod_img_url` text NOT NULL,
  `featured_img` text NOT NULL,
  `attr_set_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `prod_type` int(11) NOT NULL,
  `price_type` int(11) NOT NULL,
  `web_url` text NOT NULL,
  `product_sku` varchar(100) NOT NULL,
  `product_visibility` varchar(100) NOT NULL,
  `product_manuf_country` int(11) NOT NULL,
  `product_hsn_code` varchar(100) NOT NULL,
  `prod_weight` varchar(100) NOT NULL,
  `product_video_url` text NOT NULL,
  `return_policy_id` int(11) NOT NULL,
  `product_unique_id` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL,
  `is_heavy` int(11) NOT NULL,
  `shipping` int(11) NOT NULL DEFAULT 0,
  `product_unique_code` varchar(50) NOT NULL,
  `usage_info` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `day1_price` varchar(50) NOT NULL,
  `day3_price` varchar(50) NOT NULL,
  `day5_price` varchar(50) NOT NULL,
  `day7_price` varchar(50) NOT NULL,
  `security_deposit` varchar(50) NOT NULL,
  `city` text NOT NULL,
  `is_buy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `status`, `prod_name`, `prod_desc`, `prod_fulldetail`, `prod_name_ar`, `prod_desc_ar`, `prod_fulldetail_ar`, `prod_rating`, `prod_rating_count`, `prod_img_url`, `featured_img`, `attr_set_id`, `brand_id`, `prod_type`, `price_type`, `web_url`, `product_sku`, `product_visibility`, `product_manuf_country`, `product_hsn_code`, `prod_weight`, `product_video_url`, `return_policy_id`, `product_unique_id`, `created_at`, `updated_at`, `created_by`, `is_heavy`, `shipping`, `product_unique_code`, `usage_info`, `type`, `day1_price`, `day3_price`, `day5_price`, `day7_price`, `security_deposit`, `city`, `is_buy`) VALUES
(4, 1, 'APPLE 2020 Macbook Air M1', '&lt;p&gt;(8 GB/256 GB SSD/Mac OS Big Sur) MGN63HN/A&nbsp;&nbsp;(13.3 inch, Space Grey, 1.29 kg)&lt;/p&gt;', '&lt;p&gt;This Apple Macbook is powered by the Apple M1 chip and is easily portable so that you can carry it with you anywhere you want. This thin and light notebook is equipped with an 8-core CPU to handle all your tasks more efficiently. The 8-core GPU of this notebook takes graphic-intensive games and apps to a whole new level. It also comes with a 16-core Neural Engine to do machine learning tasks more effectively. Its fan-less design offers silent operations and has a long-lasting battery life which can last up to 18 hours on a single charge.&lt;/p&gt;', 'ابل ماك بوك اير', '&lt;p&gt;(8 جيجابايت / 256 جيجابايت SSD / Mac OS Big Sur) MGN63HN / A (13.3 بوصة ، رمادي فلكي ، 1.29 كجم)&lt;/p&gt;', '&lt;p&gt;يعمل جهاز ابل ماك بوك Apple Macbook هذا بواسطة شريحة Apple M1 وهو سهل الحمل بحيث يمكنك حمله معك في أي مكان تريده. تم تجهيز هذا الكمبيوتر الدفتري النحيف والخفيف بوحدة معالجة مركزية ثمانية النواة للتعامل مع جميع مهامك بكفاءة أكبر. تنقل وحدة معالجة الرسوميات ثماني النوى لهذا الكمبيوتر المحمول الألعاب والتطبيقات ذات الرسومات المكثفة إلى مستوى جديد تمامًا. كما يأتي مع محرك عصبي 16 نواة للقيام بمهام التعلم الآلي بشكل أكثر فعالية. يوفر تصميمه الخالي من المروحة عمليات صامتة وعمر بطارية طويل الأمد يمكن أن يستمر حتى 18 ساعة بشحنة واحدة.&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-07-04\\/64a3d2f0b3816.webp\",\"200-200\":\"2023-07-04\\/64a3d2f0b3816.webp\",\"280-310\":\"2023-07-04\\/64a3d2f0b3816.webp\",\"400-200\":\"2023-07-04\\/64a3d2f0b3816.webp\",\"430-590\":\"2023-07-04\\/64a3d2f0b3816.webp\",\"600-810\":\"2023-07-04\\/64a3d2f0b3816.webp\"},{\"72-72\":\"2023-07-04\\/64a3d2f0b46b2.webp\",\"200-200\":\"2023-07-04\\/64a3d2f0b46b2.webp\",\"280-310\":\"2023-07-04\\/64a3d2f0b46b2.webp\",\"400-200\":\"2023-07-04\\/64a3d2f0b46b2.webp\",\"430-590\":\"2023-07-04\\/64a3d2f0b46b2.webp\",\"600-810\":\"2023-07-04\\/64a3d2f0b46b2.webp\"},{\"72-72\":\"2023-07-04\\/64a3d2f0b8bcc.webp\",\"200-200\":\"2023-07-04\\/64a3d2f0b8bcc.webp\",\"280-310\":\"2023-07-04\\/64a3d2f0b8bcc.webp\",\"400-200\":\"2023-07-04\\/64a3d2f0b8bcc.webp\",\"430-590\":\"2023-07-04\\/64a3d2f0b8bcc.webp\",\"600-810\":\"2023-07-04\\/64a3d2f0b8bcc.webp\"},{\"72-72\":\"2023-07-05\\/64a54d5ac4116.webp\",\"200-200\":\"2023-07-05\\/64a54d5ac4116.webp\",\"280-310\":\"2023-07-05\\/64a54d5ac4116.webp\",\"400-200\":\"2023-07-05\\/64a54d5ac4116.webp\",\"430-590\":\"2023-07-05\\/64a54d5ac4116.webp\",\"600-810\":\"2023-07-05\\/64a54d5ac4116.webp\"},{\"72-72\":\"2023-07-05\\/64a54d5ac53b8.webp\",\"200-200\":\"2023-07-05\\/64a54d5ac53b8.webp\",\"280-310\":\"2023-07-05\\/64a54d5ac53b8.webp\",\"400-200\":\"2023-07-05\\/64a54d5ac53b8.webp\",\"430-590\":\"2023-07-05\\/64a54d5ac53b8.webp\",\"600-810\":\"2023-07-05\\/64a54d5ac53b8.webp\"},{\"72-72\":\"2023-07-05\\/64a54d5ac6d98.webp\",\"200-200\":\"2023-07-05\\/64a54d5ac6d98.webp\",\"280-310\":\"2023-07-05\\/64a54d5ac6d98.webp\",\"400-200\":\"2023-07-05\\/64a54d5ac6d98.webp\",\"430-590\":\"2023-07-05\\/64a54d5ac6d98.webp\",\"600-810\":\"2023-07-05\\/64a54d5ac6d98.webp\"}]', '{\"72-72\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"200-200\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"280-310\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"400-200\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"430-590\":\"2023-07-04\\/64a3d2f0b2986.webp\",\"600-810\":\"2023-07-04\\/64a3d2f0b2986.webp\"}', 1, 2, 1, 0, 'apple-2020-macbook-air-m1', 'APPLE-2020-Macbook-Air-M1', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PIxivLeB2hS', '2023-07-04 13:36:08', '2023-07-04 08:06:08', '1', 0, 0, 'AP898075', '', '', '1000', '', '', '', '', '396,406,', ''),
(5, 1, 'Women Printed Viscose Rayon Straight Kurta', '&lt;p&gt;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&lt;/p&gt;', '&lt;p&gt;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&lt;/p&gt;', 'المرأة مطبوعة فسكوزي رايون مستقيم كورتا', '&lt;p&gt;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&nbsp;Women Printed Viscose Rayon Straight Kurta&lt;/p&gt;', '&lt;p&gt;المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة مطبوعة فسكوزي رايون مستقيم كورتا المرأة مطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا المرأة المطبوعة فسكوزي رايون مستقيم كورتا&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-07-05\\/64a508776a4a7.webp\",\"200-200\":\"2023-07-05\\/64a508776a4a7.webp\",\"280-310\":\"2023-07-05\\/64a508776a4a7.webp\",\"400-200\":\"2023-07-05\\/64a508776a4a7.webp\",\"430-590\":\"2023-07-05\\/64a508776a4a7.webp\",\"600-810\":\"2023-07-05\\/64a508776a4a7.webp\"},{\"72-72\":\"2023-07-05\\/64a508776ad5b.webp\",\"200-200\":\"2023-07-05\\/64a508776ad5b.webp\",\"280-310\":\"2023-07-05\\/64a508776ad5b.webp\",\"400-200\":\"2023-07-05\\/64a508776ad5b.webp\",\"430-590\":\"2023-07-05\\/64a508776ad5b.webp\",\"600-810\":\"2023-07-05\\/64a508776ad5b.webp\"},{\"72-72\":\"2023-07-05\\/64a508776b74b.webp\",\"200-200\":\"2023-07-05\\/64a508776b74b.webp\",\"280-310\":\"2023-07-05\\/64a508776b74b.webp\",\"400-200\":\"2023-07-05\\/64a508776b74b.webp\",\"430-590\":\"2023-07-05\\/64a508776b74b.webp\",\"600-810\":\"2023-07-05\\/64a508776b74b.webp\"},{\"72-72\":\"2023-07-05\\/64a508776c9d6.webp\",\"200-200\":\"2023-07-05\\/64a508776c9d6.webp\",\"280-310\":\"2023-07-05\\/64a508776c9d6.webp\",\"400-200\":\"2023-07-05\\/64a508776c9d6.webp\",\"430-590\":\"2023-07-05\\/64a508776c9d6.webp\",\"600-810\":\"2023-07-05\\/64a508776c9d6.webp\"},{\"72-72\":\"2023-07-05\\/64a508776dc16.webp\",\"200-200\":\"2023-07-05\\/64a508776dc16.webp\",\"280-310\":\"2023-07-05\\/64a508776dc16.webp\",\"400-200\":\"2023-07-05\\/64a508776dc16.webp\",\"430-590\":\"2023-07-05\\/64a508776dc16.webp\",\"600-810\":\"2023-07-05\\/64a508776dc16.webp\"},{\"72-72\":\"2023-07-05\\/64a508776e5cc.webp\",\"200-200\":\"2023-07-05\\/64a508776e5cc.webp\",\"280-310\":\"2023-07-05\\/64a508776e5cc.webp\",\"400-200\":\"2023-07-05\\/64a508776e5cc.webp\",\"430-590\":\"2023-07-05\\/64a508776e5cc.webp\",\"600-810\":\"2023-07-05\\/64a508776e5cc.webp\"},{\"72-72\":\"2023-07-05\\/64a508777103f.webp\",\"200-200\":\"2023-07-05\\/64a508777103f.webp\",\"280-310\":\"2023-07-05\\/64a508777103f.webp\",\"400-200\":\"2023-07-05\\/64a508777103f.webp\",\"430-590\":\"2023-07-05\\/64a508777103f.webp\",\"600-810\":\"2023-07-05\\/64a508777103f.webp\"}]', '{\"72-72\":\"2023-07-05\\/64a5087768661.webp\",\"200-200\":\"2023-07-05\\/64a5087768661.webp\",\"280-310\":\"2023-07-05\\/64a5087768661.webp\",\"400-200\":\"2023-07-05\\/64a5087768661.webp\",\"430-590\":\"2023-07-05\\/64a5087768661.webp\",\"600-810\":\"2023-07-05\\/64a5087768661.webp\"}', 2, 16, 1, 0, 'women-printed-viscose-rayon-straight-kurta', 'Women-Printed-Viscose-Rayon-Straight-Kurta', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PSpjLQRcCX7', '2023-07-05 11:36:47', '2023-07-05 06:06:47', 'SVR6og303Vm', 0, 0, 'WO212643', '', '', '700', '', '', '', '', '1242,396,1157,', ''),
(6, 1, 'Men White & Teal Blue Slim Fit Striped Casual Shirt', '&lt;p&gt;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;&lt;/p&gt;', '&lt;p&gt;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;Men White &amp; Teal Blue Slim Fit Striped Casual Shirt&nbsp;&lt;/p&gt;', 'قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال', '&lt;p&gt;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&lt;/p&gt;', '&lt;p&gt;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&nbsp;قميص كاجوال مخطط بقصة ضيقة باللونين الأبيض والأزرق المخضر للرجال&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-07-05\\/64a5275b3d4e6.webp\",\"200-200\":\"2023-07-05\\/64a5275b3d4e6.webp\",\"280-310\":\"2023-07-05\\/64a5275b3d4e6.webp\",\"400-200\":\"2023-07-05\\/64a5275b3d4e6.webp\",\"430-590\":\"2023-07-05\\/64a5275b3d4e6.webp\",\"600-810\":\"2023-07-05\\/64a5275b3d4e6.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b3ed06.webp\",\"200-200\":\"2023-07-05\\/64a5275b3ed06.webp\",\"280-310\":\"2023-07-05\\/64a5275b3ed06.webp\",\"400-200\":\"2023-07-05\\/64a5275b3ed06.webp\",\"430-590\":\"2023-07-05\\/64a5275b3ed06.webp\",\"600-810\":\"2023-07-05\\/64a5275b3ed06.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b4201d.webp\",\"200-200\":\"2023-07-05\\/64a5275b4201d.webp\",\"280-310\":\"2023-07-05\\/64a5275b4201d.webp\",\"400-200\":\"2023-07-05\\/64a5275b4201d.webp\",\"430-590\":\"2023-07-05\\/64a5275b4201d.webp\",\"600-810\":\"2023-07-05\\/64a5275b4201d.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b43441.webp\",\"200-200\":\"2023-07-05\\/64a5275b43441.webp\",\"280-310\":\"2023-07-05\\/64a5275b43441.webp\",\"400-200\":\"2023-07-05\\/64a5275b43441.webp\",\"430-590\":\"2023-07-05\\/64a5275b43441.webp\",\"600-810\":\"2023-07-05\\/64a5275b43441.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b43e36.webp\",\"200-200\":\"2023-07-05\\/64a5275b43e36.webp\",\"280-310\":\"2023-07-05\\/64a5275b43e36.webp\",\"400-200\":\"2023-07-05\\/64a5275b43e36.webp\",\"430-590\":\"2023-07-05\\/64a5275b43e36.webp\",\"600-810\":\"2023-07-05\\/64a5275b43e36.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b463b1.webp\",\"200-200\":\"2023-07-05\\/64a5275b463b1.webp\",\"280-310\":\"2023-07-05\\/64a5275b463b1.webp\",\"400-200\":\"2023-07-05\\/64a5275b463b1.webp\",\"430-590\":\"2023-07-05\\/64a5275b463b1.webp\",\"600-810\":\"2023-07-05\\/64a5275b463b1.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b48025.webp\",\"200-200\":\"2023-07-05\\/64a5275b48025.webp\",\"280-310\":\"2023-07-05\\/64a5275b48025.webp\",\"400-200\":\"2023-07-05\\/64a5275b48025.webp\",\"430-590\":\"2023-07-05\\/64a5275b48025.webp\",\"600-810\":\"2023-07-05\\/64a5275b48025.webp\"},{\"72-72\":\"2023-07-05\\/64a5275b4b497.webp\",\"200-200\":\"2023-07-05\\/64a5275b4b497.webp\",\"280-310\":\"2023-07-05\\/64a5275b4b497.webp\",\"400-200\":\"2023-07-05\\/64a5275b4b497.webp\",\"430-590\":\"2023-07-05\\/64a5275b4b497.webp\",\"600-810\":\"2023-07-05\\/64a5275b4b497.webp\"}]', '{\"72-72\":\"2023-07-05\\/64a5275b3be80.webp\",\"200-200\":\"2023-07-05\\/64a5275b3be80.webp\",\"280-310\":\"2023-07-05\\/64a5275b3be80.webp\",\"400-200\":\"2023-07-05\\/64a5275b3be80.webp\",\"430-590\":\"2023-07-05\\/64a5275b3be80.webp\",\"600-810\":\"2023-07-05\\/64a5275b3be80.webp\"}', 2, 9, 1, 0, 'men-white-and-teal-blue-slim-fit-striped-casual-shirt', 'Men-White-and-Teal-Blue-Slim-Fit-Striped-Casual-Shirt', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'P5YPCG1W4Sj', '2023-07-05 13:48:35', '2023-07-05 08:18:35', '1', 0, 0, 'ME839366', '', '', '600', '', '', '', '', '396,406,', ''),
(8, 1, 'WEIRD WOLF 3 Colour Mode LED Study/Desk/ Table Lamp', '&lt;p&gt;WEIRD WOLF 3 Colour Mode LED Study/Desk/ Table Lamp&nbsp;WEIRD WOLF 3 Colour Mode LED Study/Desk/ Table Lamp&lt;/p&gt;', '&lt;p&gt;Weird Wolf LED Table Lamp is a multifunctional desk light that comes with Pencil Holder to keep your desk clutter free. It has USB Charging function and can be charged with micro-USB cable(included in the box) plugged either to a phone charger, laptop or powerbank. It has a removable 1200mAh lithium type 18650 battery.&lt;/p&gt;', 'غريب 3 وضع اللون دراسة الصمام الثنائي الباعث للضوء / مكتب / مصباح طاولة', '&lt;p&gt;غريب 3 وضع اللون دراسة الصمام الثنائي الباعث للضوء / مكتب / مصباح طاولة&nbsp;غريب 3 وضع اللون دراسة الصمام الثنائي الباعث للضوء / مكتب / مصباح طاولة&lt;/p&gt;', '&lt;p&gt;Weird Wolf LED Table Lamp هو مصباح مكتب متعدد الوظائف يأتي مع حامل أقلام رصاص للحفاظ على مكتبك خاليًا من الفوضى. تحتوي على وظيفة شحن USB ويمكن شحنها بكابل micro-USB (مضمن في العلبة) موصول إما بشاحن الهاتف أو الكمبيوتر المحمول أو powerbank. يحتوي على بطارية ليثيوم من النوع 18650 قابلة للإزالة بسعة 1200 مللي أمبير في الساعة.&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-07-05\\/64a52a2f868c7.webp\",\"200-200\":\"2023-07-05\\/64a52a2f868c7.webp\",\"280-310\":\"2023-07-05\\/64a52a2f868c7.webp\",\"400-200\":\"2023-07-05\\/64a52a2f868c7.webp\",\"430-590\":\"2023-07-05\\/64a52a2f868c7.webp\",\"600-810\":\"2023-07-05\\/64a52a2f868c7.webp\"},{\"72-72\":\"2023-07-05\\/64a52a2f8949a.webp\",\"200-200\":\"2023-07-05\\/64a52a2f8949a.webp\",\"280-310\":\"2023-07-05\\/64a52a2f8949a.webp\",\"400-200\":\"2023-07-05\\/64a52a2f8949a.webp\",\"430-590\":\"2023-07-05\\/64a52a2f8949a.webp\",\"600-810\":\"2023-07-05\\/64a52a2f8949a.webp\"},{\"72-72\":\"2023-07-05\\/64a52a2f8c783.webp\",\"200-200\":\"2023-07-05\\/64a52a2f8c783.webp\",\"280-310\":\"2023-07-05\\/64a52a2f8c783.webp\",\"400-200\":\"2023-07-05\\/64a52a2f8c783.webp\",\"430-590\":\"2023-07-05\\/64a52a2f8c783.webp\",\"600-810\":\"2023-07-05\\/64a52a2f8c783.webp\"},{\"72-72\":\"2023-07-05\\/64a52a2f8e2c8.webp\",\"200-200\":\"2023-07-05\\/64a52a2f8e2c8.webp\",\"280-310\":\"2023-07-05\\/64a52a2f8e2c8.webp\",\"400-200\":\"2023-07-05\\/64a52a2f8e2c8.webp\",\"430-590\":\"2023-07-05\\/64a52a2f8e2c8.webp\",\"600-810\":\"2023-07-05\\/64a52a2f8e2c8.webp\"},{\"72-72\":\"2023-07-05\\/64a52a2f9182f.webp\",\"200-200\":\"2023-07-05\\/64a52a2f9182f.webp\",\"280-310\":\"2023-07-05\\/64a52a2f9182f.webp\",\"400-200\":\"2023-07-05\\/64a52a2f9182f.webp\",\"430-590\":\"2023-07-05\\/64a52a2f9182f.webp\",\"600-810\":\"2023-07-05\\/64a52a2f9182f.webp\"},{\"72-72\":\"2023-07-05\\/64a52a2f94ee3.webp\",\"200-200\":\"2023-07-05\\/64a52a2f94ee3.webp\",\"280-310\":\"2023-07-05\\/64a52a2f94ee3.webp\",\"400-200\":\"2023-07-05\\/64a52a2f94ee3.webp\",\"430-590\":\"2023-07-05\\/64a52a2f94ee3.webp\",\"600-810\":\"2023-07-05\\/64a52a2f94ee3.webp\"}]', '{\"72-72\":\"2023-07-05\\/64a52a2f83c8c.webp\",\"200-200\":\"2023-07-05\\/64a52a2f83c8c.webp\",\"280-310\":\"2023-07-05\\/64a52a2f83c8c.webp\",\"400-200\":\"2023-07-05\\/64a52a2f83c8c.webp\",\"430-590\":\"2023-07-05\\/64a52a2f83c8c.webp\",\"600-810\":\"2023-07-05\\/64a52a2f83c8c.webp\"}', 4, 19, 1, 0, 'weird-wolf-3-colour-mode-led-studydesk-table-lamp', 'WEIRD-WOLF-3-Colour-Mode-LED-StudyDesk-Table-Lamp', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PyEXPlSz70I', '2023-07-05 14:00:39', '2023-07-05 08:30:39', '1', 0, 0, 'WE877843', '', '', '300', '', '', '', '', '333,338,385,396,', ''),
(9, 1, 'Floral Embroidered Art Silk Unstitched Dress Material', '&lt;p&gt;Floral Embroidered Art Silk Unstitched Dress Material&lt;/p&gt;', '&lt;p&gt;Floral Embroidered Art Silk Unstitched Dress Material&lt;/p&gt;', 'فستان مطرز بالزهور من الحرير غير المخيط', '&lt;p&gt;فستان مطرز بالزهور من الحرير غير المخيط&lt;/p&gt;', '&lt;p&gt;فستان مطرز بالزهور من الحرير غير المخيط&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-07-17\\/64b4cf6db9624.webp\",\"200-200\":\"2023-07-17\\/64b4cf6db9624.webp\",\"280-310\":\"2023-07-17\\/64b4cf6db9624.webp\",\"400-200\":\"2023-07-17\\/64b4cf6db9624.webp\",\"430-590\":\"2023-07-17\\/64b4cf6db9624.webp\",\"600-810\":\"2023-07-17\\/64b4cf6db9624.webp\"}]', '{\"72-72\":\"2023-07-17\\/64b4cf6db8587.webp\",\"200-200\":\"2023-07-17\\/64b4cf6db8587.webp\",\"280-310\":\"2023-07-17\\/64b4cf6db8587.webp\",\"400-200\":\"2023-07-17\\/64b4cf6db8587.webp\",\"430-590\":\"2023-07-17\\/64b4cf6db8587.webp\",\"600-810\":\"2023-07-17\\/64b4cf6db8587.webp\"}', 2, 16, 2, 0, 'floral-embroidered-art-silk-unstitched-dress-material', 'Floral-Embroidered-Art-Silk-Unstitched-Dress-Material', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PF4DLOX6AxZ', '2023-07-17 10:49:41', '2023-07-17 05:19:41', '1', 0, 0, 'FL505396', '', '', '800', '', '', '', '', '396,406,', ''),
(10, 1, 'Embroidered Sequinned Unstitched Dress Material', '&lt;p&gt;Embroidered Sequinned Unstitched Dress Material&lt;/p&gt;', '&lt;p&gt;Embroidered Sequinned Unstitched Dress Material&lt;/p&gt;', 'فستان مطرز بالترتر غير مخيط', '&lt;p&gt;فستان مطرز بالترتر غير مخيط&lt;/p&gt;', '&lt;p&gt;فستان مطرز بالترتر غير مخيط&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-07-17\\/64b4cfd8e3174.webp\",\"200-200\":\"2023-07-17\\/64b4cfd8e3174.webp\",\"280-310\":\"2023-07-17\\/64b4cfd8e3174.webp\",\"400-200\":\"2023-07-17\\/64b4cfd8e3174.webp\",\"430-590\":\"2023-07-17\\/64b4cfd8e3174.webp\",\"600-810\":\"2023-07-17\\/64b4cfd8e3174.webp\"}]', '{\"72-72\":\"2023-07-17\\/64b4cfd8e1ddb.webp\",\"200-200\":\"2023-07-17\\/64b4cfd8e1ddb.webp\",\"280-310\":\"2023-07-17\\/64b4cfd8e1ddb.webp\",\"400-200\":\"2023-07-17\\/64b4cfd8e1ddb.webp\",\"430-590\":\"2023-07-17\\/64b4cfd8e1ddb.webp\",\"600-810\":\"2023-07-17\\/64b4cfd8e1ddb.webp\"}', 2, 6, 2, 0, 'embroidered-sequinned-unstitched-dress-material', 'Embroidered-Sequinned-Unstitched-Dress-Material', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'P9WAS7UpdNL', '2023-07-17 10:51:28', '2023-07-17 05:21:28', '1', 0, 0, 'EM630313', '', '', '1200', '', '', '', '', '1242,396,', ''),
(11, 1, 'encore by INVICTUS', '&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;p&gt;100% Original Products&lt;/p&gt;\r\n&lt;p&gt;Pay on delivery might be available&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Easy 14 days returns and exchanges&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;&nbsp;&lt;/div&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Try &amp; Buy might be available&lt;/div&gt;\r\n&lt;/div&gt;', '&lt;div&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Charcoal&nbsp;T-shirt for men&lt;/li&gt;\r\n&lt;li&gt;Varsity printed&lt;/li&gt;\r\n&lt;li&gt;Regular length&lt;/li&gt;\r\n&lt;li&gt;Round neck&lt;/li&gt;\r\n&lt;li&gt;Short, regular sleeves&lt;/li&gt;\r\n&lt;li&gt;Knitted cotton fabric&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-sizeFitDesc&quot;&gt;\r\n&lt;h4 class=&quot;pdp-sizeFitDescTitle pdp-product-description-title&quot;&gt;Size &amp; Fit&lt;/h4&gt;\r\n&lt;p class=&quot;pdp-sizeFitDescContent pdp-product-description-content&quot;&gt;Regular Fit&lt;br /&gt;Size worn by the model: M&lt;br /&gt;Chest: 39&quot;&lt;br /&gt;Height: 6&#039;2&quot;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-sizeFitDesc&quot;&gt;\r\n&lt;h4 class=&quot;pdp-sizeFitDescTitle pdp-product-description-title&quot;&gt;Material &amp; Care&lt;/h4&gt;\r\n&lt;p class=&quot;pdp-sizeFitDescContent pdp-product-description-content&quot;&gt;60% Cotton and 40% Polyester&lt;br /&gt;Machine wash&lt;/p&gt;\r\n&lt;/div&gt;', 'الظهور بواسطة INVICTUS', '&lt;p&gt;منتجات أصلية 100٪&lt;br /&gt;قد يكون الدفع عند التسليم متاحًا&lt;br /&gt;سهولة الإرجاع والاستبدال لمدة 14 يومًا&lt;br /&gt;جرب واشتري قد تكون متاحة&lt;/p&gt;', '&lt;p&gt;تيشيرت فحم رجالي&lt;br /&gt;اسكواش مطبوعة&lt;br /&gt;الطول العادي&lt;br /&gt;رقبة مستديرة&lt;br /&gt;أكمام قصيرة منتظمة&lt;br /&gt;نسيج قطن محبوك&lt;/p&gt;\r\n&lt;p&gt;الحجم والملاءمة&lt;br /&gt;تناسب منتظم&lt;br /&gt;المقاس الذي يرتديه الموديل: M.&lt;br /&gt;الصدر: 39 &quot;&lt;br /&gt;الارتفاع: 6&#039;2 &quot;&lt;/p&gt;\r\n&lt;p&gt;المواد والعناية&lt;br /&gt;60٪ قطن و 40٪ بوليستر&lt;br /&gt;غسالة&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-08-01\\/64c8d0da18b1c.webp\",\"200-200\":\"2023-08-01\\/64c8d0da18b1c.webp\",\"280-310\":\"2023-08-01\\/64c8d0da18b1c.webp\",\"400-200\":\"2023-08-01\\/64c8d0da18b1c.webp\",\"430-590\":\"2023-08-01\\/64c8d0da18b1c.webp\",\"600-810\":\"2023-08-01\\/64c8d0da18b1c.webp\"},{\"72-72\":\"2023-08-01\\/64c8d0da190aa.webp\",\"200-200\":\"2023-08-01\\/64c8d0da190aa.webp\",\"280-310\":\"2023-08-01\\/64c8d0da190aa.webp\",\"400-200\":\"2023-08-01\\/64c8d0da190aa.webp\",\"430-590\":\"2023-08-01\\/64c8d0da190aa.webp\",\"600-810\":\"2023-08-01\\/64c8d0da190aa.webp\"}]', '{\"72-72\":\"2023-08-01\\/64c8d0da0cdeb.webp\",\"200-200\":\"2023-08-01\\/64c8d0da0cdeb.webp\",\"280-310\":\"2023-08-01\\/64c8d0da0cdeb.webp\",\"400-200\":\"2023-08-01\\/64c8d0da0cdeb.webp\",\"430-590\":\"2023-08-01\\/64c8d0da0cdeb.webp\",\"600-810\":\"2023-08-01\\/64c8d0da0cdeb.webp\"}', 3, 1, 1, 0, 'encore-by-invictus', 'encore-by-INVICTUS', '1', 1, '544412', '100', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 2, 'PE26FIKxnrO', '2023-08-01 13:31:06', '2023-08-01 09:31:06', '1', 0, 0, 'EN913905', '', '', '200', '', '', '', '', '396,406,', ''),
(12, 1, 'Men Charcoal Melange Graphic Printed T-shirt', '&lt;div&gt;\r\n&lt;div class=&quot;meta-container&quot;&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;100% Original Products&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Pay on delivery might be available&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Easy 14 days returns and exchanges&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Try &amp; Buy might be available&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-offers-container&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;div&gt;\r\n&lt;p class=&quot;pdp-product-description-content&quot;&gt;Charcoal printed T-shirt, has a round neck, short sleeves&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-sizeFitDesc&quot;&gt;\r\n&lt;h4 class=&quot;pdp-sizeFitDescTitle pdp-product-description-title&quot;&gt;Size &amp; Fit&lt;/h4&gt;\r\n&lt;p class=&quot;pdp-sizeFitDescContent pdp-product-description-content&quot;&gt;The model (height 6&#039;) is wearing a size M&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-sizeFitDesc&quot;&gt;\r\n&lt;h4 class=&quot;pdp-sizeFitDescTitle pdp-product-description-title&quot;&gt;Material &amp; Care&lt;/h4&gt;\r\n&lt;p class=&quot;pdp-sizeFitDescContent pdp-product-description-content&quot;&gt;55% cotton, 45% polyester&lt;br /&gt;Machine-wash&lt;/p&gt;\r\n&lt;/div&gt;', 'تي شيرت رجالي بطبعة فحمي', '&lt;p&gt;منتجات أصلية 100٪&lt;br /&gt;قد يكون الدفع عند التسليم متاحًا&lt;br /&gt;سهولة الإرجاع والاستبدال لمدة 14 يومًا&lt;br /&gt;جرب واشتري قد تكون متاحة&lt;/p&gt;', '&lt;p&gt;تيشيرت بلون فحمي بياقة دائرية وأكمام قصيرة&lt;/p&gt;\r\n&lt;p&gt;الحجم والملاءمة&lt;br /&gt;يرتدي العارض (ارتفاع 6 &#039;) مقاس M&lt;/p&gt;\r\n&lt;p&gt;المواد والعناية&lt;br /&gt;55٪ قطن ، 45٪ بوليستر&lt;br /&gt;غسالة&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-08-01\\/64c8d99cbd5dc.webp\",\"200-200\":\"2023-08-01\\/64c8d99cbd5dc.webp\",\"280-310\":\"2023-08-01\\/64c8d99cbd5dc.webp\",\"400-200\":\"2023-08-01\\/64c8d99cbd5dc.webp\",\"430-590\":\"2023-08-01\\/64c8d99cbd5dc.webp\",\"600-810\":\"2023-08-01\\/64c8d99cbd5dc.webp\"},{\"72-72\":\"2023-08-01\\/64c8d99cbfa48.webp\",\"200-200\":\"2023-08-01\\/64c8d99cbfa48.webp\",\"280-310\":\"2023-08-01\\/64c8d99cbfa48.webp\",\"400-200\":\"2023-08-01\\/64c8d99cbfa48.webp\",\"430-590\":\"2023-08-01\\/64c8d99cbfa48.webp\",\"600-810\":\"2023-08-01\\/64c8d99cbfa48.webp\"},{\"72-72\":\"2023-08-01\\/64c8d99cc18dc.webp\",\"200-200\":\"2023-08-01\\/64c8d99cc18dc.webp\",\"280-310\":\"2023-08-01\\/64c8d99cc18dc.webp\",\"400-200\":\"2023-08-01\\/64c8d99cc18dc.webp\",\"430-590\":\"2023-08-01\\/64c8d99cc18dc.webp\",\"600-810\":\"2023-08-01\\/64c8d99cc18dc.webp\"},{\"72-72\":\"2023-08-01\\/64c8d99cc3469.webp\",\"200-200\":\"2023-08-01\\/64c8d99cc3469.webp\",\"280-310\":\"2023-08-01\\/64c8d99cc3469.webp\",\"400-200\":\"2023-08-01\\/64c8d99cc3469.webp\",\"430-590\":\"2023-08-01\\/64c8d99cc3469.webp\",\"600-810\":\"2023-08-01\\/64c8d99cc3469.webp\"}]', '{\"72-72\":\"2023-08-01\\/64c8d99cb9f31.webp\",\"200-200\":\"2023-08-01\\/64c8d99cb9f31.webp\",\"280-310\":\"2023-08-01\\/64c8d99cb9f31.webp\",\"400-200\":\"2023-08-01\\/64c8d99cb9f31.webp\",\"430-590\":\"2023-08-01\\/64c8d99cb9f31.webp\",\"600-810\":\"2023-08-01\\/64c8d99cb9f31.webp\"}', 3, 12, 1, 0, 'men-charcoal-melange-graphic-printed-t-shirt', 'men-charcoal-melange-graphic-printed-t-shirt', '1', 2, '544412', '100', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 3, 'PuL71pefTY9', '2023-08-01 15:38:28', '2023-08-01 10:08:28', 'SVR6og303Vm', 0, 0, 'ME434142', '', '', '700', '', '', '', '', '333,338,385,396,', ''),
(13, 1, 'Pink Shoulder Strap Smocking Detailed Crop Fitted Top', '&lt;div&gt;\r\n&lt;div class=&quot;meta-container&quot;&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;100% Original Products&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Pay on delivery might be available&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Easy 14 days returns and exchanges&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Try &amp; Buy might be available&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-offers-container&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;div&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Pink crop fitted&nbsp;top&lt;/li&gt;\r\n&lt;li&gt;Solid&lt;/li&gt;\r\n&lt;li&gt;Shoulder straps&lt;/li&gt;\r\n&lt;li&gt;Sleeveless&lt;/li&gt;\r\n&lt;li&gt;Smocked detail&lt;/li&gt;\r\n&lt;li&gt;Woven&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-sizeFitDesc&quot;&gt;\r\n&lt;h4 class=&quot;pdp-sizeFitDescTitle pdp-product-description-title&quot;&gt;Size &amp; Fit&lt;/h4&gt;\r\n&lt;p class=&quot;pdp-sizeFitDescContent pdp-product-description-content&quot;&gt;The model (height 5&#039;8) is wearing a size S&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;pdp-sizeFitDesc&quot;&gt;\r\n&lt;h4 class=&quot;pdp-sizeFitDescTitle pdp-product-description-title&quot;&gt;Material &amp; Care&lt;/h4&gt;\r\n&lt;p class=&quot;pdp-sizeFitDescContent pdp-product-description-content&quot;&gt;Polyester&lt;br /&gt;Machine Wash&lt;/p&gt;\r\n&lt;/div&gt;', 'حزام كتف وردي مزين بقصة ضيقة ومفصل', '&lt;p&gt;منتجات أصلية 100٪&lt;br /&gt;قد يكون الدفع عند التسليم متاحًا&lt;br /&gt;سهولة الإرجاع والاستبدال لمدة 14 يومًا&lt;br /&gt;جرب واشتري قد تكون متاحة&lt;/p&gt;', '&lt;p&gt;توب قصير وردي ملائم&lt;br /&gt;صلب&lt;br /&gt;أحزمة الكتف&lt;br /&gt;بلا أكمام&lt;br /&gt;تفاصيل مدخنة&lt;br /&gt;منسوجة&lt;/p&gt;\r\n&lt;p&gt;الحجم والملاءمة&lt;br /&gt;العارضة (ارتفاع 5&#039;8) ترتدي مقاس S.&lt;/p&gt;\r\n&lt;p&gt;المواد والعناية&lt;br /&gt;البوليستر&lt;br /&gt;غسالة&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-08-01\\/64c8ddc29dd57.webp\",\"200-200\":\"2023-08-01\\/64c8ddc29dd57.webp\",\"280-310\":\"2023-08-01\\/64c8ddc29dd57.webp\",\"400-200\":\"2023-08-01\\/64c8ddc29dd57.webp\",\"430-590\":\"2023-08-01\\/64c8ddc29dd57.webp\",\"600-810\":\"2023-08-01\\/64c8ddc29dd57.webp\"},{\"72-72\":\"2023-08-01\\/64c8ddc2a1e2b.webp\",\"200-200\":\"2023-08-01\\/64c8ddc2a1e2b.webp\",\"280-310\":\"2023-08-01\\/64c8ddc2a1e2b.webp\",\"400-200\":\"2023-08-01\\/64c8ddc2a1e2b.webp\",\"430-590\":\"2023-08-01\\/64c8ddc2a1e2b.webp\",\"600-810\":\"2023-08-01\\/64c8ddc2a1e2b.webp\"},{\"72-72\":\"2023-08-01\\/64c8ddc2a5599.webp\",\"200-200\":\"2023-08-01\\/64c8ddc2a5599.webp\",\"280-310\":\"2023-08-01\\/64c8ddc2a5599.webp\",\"400-200\":\"2023-08-01\\/64c8ddc2a5599.webp\",\"430-590\":\"2023-08-01\\/64c8ddc2a5599.webp\",\"600-810\":\"2023-08-01\\/64c8ddc2a5599.webp\"}]', '{\"72-72\":\"2023-08-01\\/64c8ddc29746a.webp\",\"200-200\":\"2023-08-01\\/64c8ddc29746a.webp\",\"280-310\":\"2023-08-01\\/64c8ddc29746a.webp\",\"400-200\":\"2023-08-01\\/64c8ddc29746a.webp\",\"430-590\":\"2023-08-01\\/64c8ddc29746a.webp\",\"600-810\":\"2023-08-01\\/64c8ddc29746a.webp\"}', 2, 1, 1, 0, 'pink-shoulder-strap-smocking-detailed-crop-fitted-top', 'pink-shoulder-strap-smocking-detailed-crop-fitted-top', '2', 2, '5407', '120', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PqIZtmKj1bc', '2023-08-01 14:26:10', '2023-08-01 10:26:10', '1', 0, 0, 'PI750723', '', '', '290', '', '', '', '', '1242,396,1157,', ''),
(17, 0, 'Men Solid Polo Neck Cotton Blend (220 gsm) Green T-Shirt', '', 'Men Solid Polo Neck Cotton Blend (220 gsm) Green T-Shirt', '', '', '', 0, 0, '', '', 1, 1, 1, 0, '', 'Men-Solid-Polo-Neck-Cotton-Blend-220-gsm-Green-T-Shirt', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PlQaDBj6SCs', '2023-08-30 00:00:00', '2023-08-30 04:53:19', 'SVR6og303Vm', 0, 0, '', '', '', '350', '', '', '', '', '333,338,', ''),
(18, 1, 'Roadister', '&lt;p class=&quot;pdp-name&quot;&gt;Men Maroon Typography Printed Cotton T-shirt&lt;/p&gt;', '&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;100% Original Products&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Pay on delivery might be available&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Easy 14 days returns and exchanges&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;meta-info&quot;&gt;\r\n&lt;div class=&quot;meta-desc&quot;&gt;Try &amp; Buy might be available&lt;/div&gt;\r\n&lt;/div&gt;', 'رودستر', '&lt;p&gt;تي شيرت قطني مطبوع بطباعة كستنائي للرجال&lt;/p&gt;', '&lt;p&gt;منتجات أصلية 100%&lt;br /&gt;قد يكون الدفع عند التسليم متاحًا&lt;br /&gt;إرجاع واستبدال سهل خلال 14 يومًا&lt;br /&gt;قد تكون تجربة وشراء متاحة&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-09-11\\/64feb3c2bc30c.webp\",\"200-200\":\"2023-09-11\\/64feb3c2bc30c.webp\",\"280-310\":\"2023-09-11\\/64feb3c2bc30c.webp\",\"400-200\":\"2023-09-11\\/64feb3c2bc30c.webp\",\"430-590\":\"2023-09-11\\/64feb3c2bc30c.webp\",\"600-810\":\"2023-09-11\\/64feb3c2bc30c.webp\"},{\"72-72\":\"2023-09-11\\/64feb3c2bdde9.webp\",\"200-200\":\"2023-09-11\\/64feb3c2bdde9.webp\",\"280-310\":\"2023-09-11\\/64feb3c2bdde9.webp\",\"400-200\":\"2023-09-11\\/64feb3c2bdde9.webp\",\"430-590\":\"2023-09-11\\/64feb3c2bdde9.webp\",\"600-810\":\"2023-09-11\\/64feb3c2bdde9.webp\"},{\"72-72\":\"2023-09-11\\/64feb3c2bfd9c.webp\",\"200-200\":\"2023-09-11\\/64feb3c2bfd9c.webp\",\"280-310\":\"2023-09-11\\/64feb3c2bfd9c.webp\",\"400-200\":\"2023-09-11\\/64feb3c2bfd9c.webp\",\"430-590\":\"2023-09-11\\/64feb3c2bfd9c.webp\",\"600-810\":\"2023-09-11\\/64feb3c2bfd9c.webp\"}]', '{\"72-72\":\"2023-09-11\\/64feb3c2ba544.webp\",\"200-200\":\"2023-09-11\\/64feb3c2ba544.webp\",\"280-310\":\"2023-09-11\\/64feb3c2ba544.webp\",\"400-200\":\"2023-09-11\\/64feb3c2ba544.webp\",\"430-590\":\"2023-09-11\\/64feb3c2ba544.webp\",\"600-810\":\"2023-09-11\\/64feb3c2ba544.webp\"}', 3, 14, 2, 0, 'roadister', 'Roadister', '3', 2, '544412', '100', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 2, 'PMOhg3ypAtr', '2023-09-11 10:29:22', '2023-09-11 06:29:22', '1', 0, 0, 'RO855492', '', '', '500', '', '', '', '', '396,406,', ''),
(19, 1, 'HP IS123', '&lt;p&gt;sdfa&lt;/p&gt;\r\n&lt;p&gt;sadfas&lt;/p&gt;', '&lt;p&gt;sfdasd&lt;/p&gt;\r\n&lt;p&gt;fcasc&lt;/p&gt;', 'HP IS123', '&lt;p&gt;sdfcs&lt;/p&gt;', '&lt;p&gt;wdfcwe&lt;/p&gt;', 0, 0, '[{\"72-72\":\"2023-10-08\\/65229e916fc8c.webp\",\"200-200\":\"2023-10-08\\/65229e916fc8c.webp\",\"280-310\":\"2023-10-08\\/65229e916fc8c.webp\",\"400-200\":\"2023-10-08\\/65229e916fc8c.webp\",\"430-590\":\"2023-10-08\\/65229e916fc8c.webp\",\"600-810\":\"2023-10-08\\/65229e916fc8c.webp\"},{\"72-72\":\"2023-10-08\\/65229e917c036.webp\",\"200-200\":\"2023-10-08\\/65229e917c036.webp\",\"280-310\":\"2023-10-08\\/65229e917c036.webp\",\"400-200\":\"2023-10-08\\/65229e917c036.webp\",\"430-590\":\"2023-10-08\\/65229e917c036.webp\",\"600-810\":\"2023-10-08\\/65229e917c036.webp\"}]', '{\"72-72\":\"2023-10-08\\/65229e9162fe7.webp\",\"200-200\":\"2023-10-08\\/65229e9162fe7.webp\",\"280-310\":\"2023-10-08\\/65229e9162fe7.webp\",\"400-200\":\"2023-10-08\\/65229e9162fe7.webp\",\"430-590\":\"2023-10-08\\/65229e9162fe7.webp\",\"600-810\":\"2023-10-08\\/65229e9162fe7.webp\"}', 6, 8, 2, 0, 'hp-is123', 'HP-IS123', '1', 2, '62111', '400', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 2, 'PAJDpio1yhc', '2023-10-08 16:20:33', '2023-10-08 12:20:33', '1', 0, 0, 'HP511238', '', '', '490', '', '', '', '', '396,406,', ''),
(27, 1, 'tv', '&lt;p&gt;cscscs cscss&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p&gt;cs cs cs&nbsp;&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '', '{\"72-72\":\"2023-11-02\\/654351dd3b49d.webp\",\"200-200\":\"2023-11-02\\/654351dd3b49d.webp\",\"280-310\":\"2023-11-02\\/654351dd3b49d.webp\",\"400-200\":\"2023-11-02\\/654351dd3b49d.webp\",\"430-590\":\"2023-11-02\\/654351dd3b49d.webp\",\"600-810\":\"2023-11-02\\/654351dd3b49d.webp\"}', 6, 9, 1, 0, 'tv', 'tv', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PJYrUOcWS1o', '2023-11-02 11:38:05', '2023-11-02 07:38:05', '1', 0, 0, 'TV476497', 'cs c s cs', '2', '1001', '2001', '3001', '4001', '', '1242,396,1157,', ''),
(28, 1, 'laptop', '&lt;p&gt;cscs&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p&gt;cssc&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '', '{\"72-72\":\"2023-11-02\\/65436d464581d.webp\",\"200-200\":\"2023-11-02\\/65436d464581d.webp\",\"280-310\":\"2023-11-02\\/65436d464581d.webp\",\"400-200\":\"2023-11-02\\/65436d464581d.webp\",\"430-590\":\"2023-11-02\\/65436d464581d.webp\",\"600-810\":\"2023-11-02\\/65436d464581d.webp\"}', 1, 9, 1, 0, 'laptop', 'laptop', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PnQCA34gWB1', '2023-11-02 13:35:02', '2023-11-02 09:35:02', '1', 0, 0, 'LA157016', 'cscs c', '1', '100', '200', '300', '400', '', '333,338,385,396,406,', ''),
(29, 1, 'cks', '&lt;p&gt;cscsc&nbsp;&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p&gt;cscs&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '', '{\"72-72\":\"2023-11-03\\/6544847a12912.webp\",\"200-200\":\"2023-11-03\\/6544847a12912.webp\",\"280-310\":\"2023-11-03\\/6544847a12912.webp\",\"400-200\":\"2023-11-03\\/6544847a12912.webp\",\"430-590\":\"2023-11-03\\/6544847a12912.webp\",\"600-810\":\"2023-11-03\\/6544847a12912.webp\"}', 6, 16, 1, 0, 'cks', 'cks', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'Pz3lqeIkwQK', '2023-11-03 10:56:18', '2023-11-03 05:26:18', 'SVR6og303Vm', 0, 0, 'CK132279', 'vddv', '1', '11', '20', '30', '40', '', '396,406,', ''),
(30, 1, 'wedding jewellery', '&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;Base Metal&nbsp;:&nbsp;Copper&lt;/p&gt;\r\n&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;Plating&nbsp;:&nbsp;Gold Plated&lt;/p&gt;\r\n&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;Stone Type&nbsp;:&nbsp;American Diamond&lt;/p&gt;\r\n&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;Sizing&nbsp;:&nbsp;Adjustable&lt;/p&gt;\r\n&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;Type&nbsp;:&nbsp;As Per Image&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;necklace,jewellery,mangalsutra,set,earrings,long,high,quality,rose,gold,plated,chain,one,gram,heavy,copper,saree,artificial,zinc,neck,white,stone,silver,necklace,jewellery,combo,tops,items,imitation,pendant,full,rani,designs,dabu,haarwedding,jewellery,for,bride,necklace,south,indian,temple,haldi,yellow,flower,american,diamond,setsnecklace,jewellery,choker,earrings,set,jewelry,for,women,ladies,girls,simple,design,lehenganecklace,jhumka,bridal,jewellery,with,kundan,haram,handmade,ad,stone,antique,collection,earringnecklace,jhumka,bridal,jewellery,with,kundan,haram,handmade,ad,stone,antique,collection,earring&lt;/p&gt;\r\n&lt;p class=&quot;sc-jSUZER jcewMM pre pre&quot;&gt;Country of Origin&nbsp;:&nbsp;India&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '[{\"72-72\":\"2023-11-03\\/6544de9f1e170.webp\",\"200-200\":\"2023-11-03\\/6544de9f1e170.webp\",\"280-310\":\"2023-11-03\\/6544de9f1e170.webp\",\"400-200\":\"2023-11-03\\/6544de9f1e170.webp\",\"430-590\":\"2023-11-03\\/6544de9f1e170.webp\",\"600-810\":\"2023-11-03\\/6544de9f1e170.webp\"}]', '{\"72-72\":\"2023-11-03\\/6544de9f1ca7c.webp\",\"200-200\":\"2023-11-03\\/6544de9f1ca7c.webp\",\"280-310\":\"2023-11-03\\/6544de9f1ca7c.webp\",\"400-200\":\"2023-11-03\\/6544de9f1ca7c.webp\",\"430-590\":\"2023-11-03\\/6544de9f1ca7c.webp\",\"600-810\":\"2023-11-03\\/6544de9f1ca7c.webp\"}', 2, 21, 1, 0, 'wedding-jewellery', 'wedding-jewellery', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PZPXMmjO7c2', '2023-11-03 15:50:55', '2023-11-03 11:50:55', '1', 0, 0, 'WE609836', '', '1', '205', '', '', '', '', '1242,396,1157,', ''),
(31, 1, 'Pink Floral Embroidered Sherwani', '&lt;p&gt;This Pink Floral Embroidered Sherwani is an excellent option for the bashful yet fashionable gentleman. It does not scream for attention but makes its presence felt with understated elegance.&nbsp;&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p&gt;This Pink Floral Embroidered Sherwani is an excellent option for the bashful yet fashionable gentleman. It does not scream for attention but makes its presence felt with understated elegance. The pink sherwani has an embroidered collar in a dense and intricate pattern, in Resham, Pearl and Dori embroidery, with the embroidery in scattered floral pattern on the body. The ivory churidar bottoms are a pleasing contrast to the light colour palette.&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '[{\"72-72\":\"2023-11-03\\/6544e05f06688.webp\",\"200-200\":\"2023-11-03\\/6544e05f06688.webp\",\"280-310\":\"2023-11-03\\/6544e05f06688.webp\",\"400-200\":\"2023-11-03\\/6544e05f06688.webp\",\"430-590\":\"2023-11-03\\/6544e05f06688.webp\",\"600-810\":\"2023-11-03\\/6544e05f06688.webp\"}]', '{\"72-72\":\"2023-11-03\\/6544e05ef34d5.webp\",\"200-200\":\"2023-11-03\\/6544e05ef34d5.webp\",\"280-310\":\"2023-11-03\\/6544e05ef34d5.webp\",\"400-200\":\"2023-11-03\\/6544e05ef34d5.webp\",\"430-590\":\"2023-11-03\\/6544e05ef34d5.webp\",\"600-810\":\"2023-11-03\\/6544e05ef34d5.webp\"}', 3, 2, 1, 0, 'pink-floral-embroidered-sherwani', 'Pink-Floral-Embroidered-Sherwani', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'P58moSCI2e1', '2023-11-03 15:58:22', '2023-11-03 11:58:23', '1', 0, 0, 'PI505106', '', '2', '200', '400', '800', '2000', '2500', '395,406,', ''),
(32, 1, 'Dpofirs Digital Camera 1080P', '&lt;ul class=&quot;a-unordered-list a-vertical a-spacing-mini&quot;&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;High Resolution: The pocket camera supports up to 48MP image resolution and 4K video resolution, making your photo and video recording clearer and smoother.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;ul class=&quot;a-unordered-list a-vertical a-spacing-mini&quot;&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;Built in Fill Light: Even in dark places, the built in fill light can be turned on and off according to the scene. Although it is a mini camera, it also has various functions such as selfie, continuous shooting, anti shake and so on.&lt;/span&gt;&lt;/li&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;Easy to Use and Portable: With intuitive buttons, an easy to use arrangement, and an English language instruction manual, even children and beginners can use the digital camera right away. Comes with a camera wrist strap, you can also keep it in your pocket or carry it by hand for easy portability.&lt;/span&gt;&lt;/li&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;550mAh Battery: The camera comes with a rechargeable Li Ion battery, comes with a USB cable to charge the camera directly, and you can also easily transfer photos and videos from the camera to your computer and share them on social media. Camera supports memory cards up to 128GB, not included.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '[{\"72-72\":\"2023-11-22\\/655d8b3c0ef2f.webp\",\"200-200\":\"2023-11-22\\/655d8b3c0ef2f.webp\",\"280-310\":\"2023-11-22\\/655d8b3c0ef2f.webp\",\"400-200\":\"2023-11-22\\/655d8b3c0ef2f.webp\",\"430-590\":\"2023-11-22\\/655d8b3c0ef2f.webp\",\"600-810\":\"2023-11-22\\/655d8b3c0ef2f.webp\"},{\"72-72\":\"2023-11-22\\/655d8b3c10cb4.webp\",\"200-200\":\"2023-11-22\\/655d8b3c10cb4.webp\",\"280-310\":\"2023-11-22\\/655d8b3c10cb4.webp\",\"400-200\":\"2023-11-22\\/655d8b3c10cb4.webp\",\"430-590\":\"2023-11-22\\/655d8b3c10cb4.webp\",\"600-810\":\"2023-11-22\\/655d8b3c10cb4.webp\"},{\"72-72\":\"2023-11-22\\/655d8b3c11ddd.webp\",\"200-200\":\"2023-11-22\\/655d8b3c11ddd.webp\",\"280-310\":\"2023-11-22\\/655d8b3c11ddd.webp\",\"400-200\":\"2023-11-22\\/655d8b3c11ddd.webp\",\"430-590\":\"2023-11-22\\/655d8b3c11ddd.webp\",\"600-810\":\"2023-11-22\\/655d8b3c11ddd.webp\"},{\"72-72\":\"2023-11-22\\/655d8bc87016e.webp\",\"200-200\":\"2023-11-22\\/655d8bc87016e.webp\",\"280-310\":\"2023-11-22\\/655d8bc87016e.webp\",\"400-200\":\"2023-11-22\\/655d8bc87016e.webp\",\"430-590\":\"2023-11-22\\/655d8bc87016e.webp\",\"600-810\":\"2023-11-22\\/655d8bc87016e.webp\"},{\"72-72\":\"2023-11-22\\/655d8bc870eee.webp\",\"200-200\":\"2023-11-22\\/655d8bc870eee.webp\",\"280-310\":\"2023-11-22\\/655d8bc870eee.webp\",\"400-200\":\"2023-11-22\\/655d8bc870eee.webp\",\"430-590\":\"2023-11-22\\/655d8bc870eee.webp\",\"600-810\":\"2023-11-22\\/655d8bc870eee.webp\"}]', '{\"72-72\":\"2023-11-03\\/6544e186c6a6a.webp\",\"200-200\":\"2023-11-03\\/6544e186c6a6a.webp\",\"280-310\":\"2023-11-03\\/6544e186c6a6a.webp\",\"400-200\":\"2023-11-03\\/6544e186c6a6a.webp\",\"430-590\":\"2023-11-03\\/6544e186c6a6a.webp\",\"600-810\":\"2023-11-03\\/6544e186c6a6a.webp\"}', 7, 3, 1, 0, 'dpofirs-digital-camera-1080p', 'Dpofirs-Digital-Camera-1080P', '1', 1, '62112', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 2, 'P3j0EAd5zx4', '2023-11-03 16:03:18', '2023-11-03 12:03:18', '1', 0, 0, 'DP217956', '&lt;div class=&quot;co8aDb&quot;&gt;&lt;strong&gt;READ YOUR CAMERA MANUAL before taking any photographs.&lt;/strong&gt;&lt;/div&gt;\r\n&lt;div class=&quot;RqBzHd&quot;&gt;\r\n&lt;ol class=&quot;X5LH0c&quot;&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Check your batteries. ...&lt;/li&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Remove the lens cap.&lt;/li&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Turn off the LCD. ( ...&lt;/li&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Make sure your camera is set for automatic mode. ...&lt;/li&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Bring the camera up to your eye and look through the viewfinder. ...&lt;/li&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Press the shutter button all the way down. ...&lt;/li&gt;\r\n&lt;li class=&quot;TrT0Xe&quot;&gt;Turn off the camera.&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;/div&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '2', '500', '1000', '1500', '2000', '22000', '333,338,385,396', '1'),
(33, 1, 'Realistic Artificial Silk', '&lt;ul class=&quot;a-unordered-list a-vertical a-spacing-mini&quot;&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;✔️WONDERFUL DECORATION FOR WEDDINGS AND OTHER OCCASIONS: These lush artificial wisteria vines are beautiful and a perfect symbol of spring and renewed life for any occasion.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;ul class=&quot;a-unordered-list a-vertical a-spacing-mini&quot;&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;✔️HIGH QUALITY ARTIFICIAL FLOWERS AND FOLIAGE. The petals of the flowers are made of silk. Both the flowers and leaves are delicately painted in soft colors for a realistic look.&lt;/span&gt;&lt;/li&gt;\r\n&lt;li class=&quot;a-spacing-mini&quot;&gt;&lt;span class=&quot;a-list-item&quot;&gt;✔️VIBRANT COLORS: The Wisteria flowers are well made and feel just like real flowers, Pure natural style, simple and elegant. You can hang it on the wall, doors, swing, mirrors and anywhere as you like to enjoy with artificial leaves vine.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '', '{\"72-72\":\"2023-11-03\\/6544e31a593e7.webp\",\"200-200\":\"2023-11-03\\/6544e31a593e7.webp\",\"280-310\":\"2023-11-03\\/6544e31a593e7.webp\",\"400-200\":\"2023-11-03\\/6544e31a593e7.webp\",\"430-590\":\"2023-11-03\\/6544e31a593e7.webp\",\"600-810\":\"2023-11-03\\/6544e31a593e7.webp\"}', 4, 10, 1, 0, 'realistic-artificial-silk', 'Realistic-Artificial-Silk', '1', 1, '', '', '2023-07-05\\/180825-01-laptop1461848141848636135.mp4', 0, 'PyfvpXVKR2t', '2023-11-03 16:10:02', '2023-11-03 12:10:02', '1', 0, 0, 'RE238465', '', '2', '200', '500', '700', '1000', '', '395,', ''),
(34, 1, 'latest products', '&lt;p&gt;new&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p&gt;new&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '', '{\"72-72\":\"2023-11-21\\/655c52060b61f.webp\",\"200-200\":\"2023-11-21\\/655c52060b61f.webp\",\"280-310\":\"2023-11-21\\/655c52060b61f.webp\",\"400-200\":\"2023-11-21\\/655c52060b61f.webp\",\"430-590\":\"2023-11-21\\/655c52060b61f.webp\",\"600-810\":\"2023-11-21\\/655c52060b61f.webp\"}', 3, 10, 1, 0, 'latest-products', 'latest-products', '1', 1, '', '', '', 0, 'Pxuyhzd6rei', '2023-11-21 10:45:26', '2023-11-21 06:45:26', '1', 0, 0, 'LA458247', 'latest', '2', '100', '200', '300', '500', '2001', '333,338,385,396,406,', ''),
(37, 1, 'new cam', '&lt;p&gt;cams&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '&lt;p&gt;cams&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', '', '', 0, 0, '', '{\"72-72\":\"2023-11-22\\/655de3c8deac8.webp\",\"200-200\":\"2023-11-22\\/655de3c8deac8.webp\",\"280-310\":\"2023-11-22\\/655de3c8deac8.webp\",\"400-200\":\"2023-11-22\\/655de3c8deac8.webp\",\"430-590\":\"2023-11-22\\/655de3c8deac8.webp\",\"600-810\":\"2023-11-22\\/655de3c8deac8.webp\"}', 7, 3, 1, 0, 'new-cam', 'new-cam', '1', 1, '', '', '', 0, 'PWqFCZ0L5I7', '2023-11-22 15:19:36', '2023-11-22 11:19:36', '1', 0, 0, 'NE399934', '', '', '100', '200', '300', '400', '2000', '1242,396,1157,', '1'),
(38, 1, 'tshirt', '', 'colour black', '', '', '', 0, 0, '', '{\"72-72\":\"2023-12-12\\/6578423594da4.webp\",\"200-200\":\"2023-12-12\\/6578423594da4.webp\",\"280-310\":\"2023-12-12\\/6578423594da4.webp\",\"400-200\":\"2023-12-12\\/6578423594da4.webp\",\"430-590\":\"2023-12-12\\/6578423594da4.webp\",\"600-810\":\"2023-12-12\\/6578423594da4.webp\"}', 1, 1, 1, 0, '', 'tshirt', '1', 1, '', '', '', 0, 'PGCSU4EqDnJ', '2023-12-12 00:00:00', '2023-12-12 11:21:25', 'SVR6og303Vm', 0, 0, '', '', '', '', '', '', '', '', '395,406,', '');
INSERT INTO `product_details` (`id`, `status`, `prod_name`, `prod_desc`, `prod_fulldetail`, `prod_name_ar`, `prod_desc_ar`, `prod_fulldetail_ar`, `prod_rating`, `prod_rating_count`, `prod_img_url`, `featured_img`, `attr_set_id`, `brand_id`, `prod_type`, `price_type`, `web_url`, `product_sku`, `product_visibility`, `product_manuf_country`, `product_hsn_code`, `prod_weight`, `product_video_url`, `return_policy_id`, `product_unique_id`, `created_at`, `updated_at`, `created_by`, `is_heavy`, `shipping`, `product_unique_code`, `usage_info`, `type`, `day1_price`, `day3_price`, `day5_price`, `day7_price`, `security_deposit`, `city`, `is_buy`) VALUES
(39, 1, 'Samsung CC112 Camera', '&lt;ul&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;4K/HD format, High-performance Fast Hybrid AF, Phase-detection AF, The Sony full-frame advantage, BIONZ X?speed and precision (High-speed processing faithfully reproduces textures and details in real time, as seen by the naked eye), Expressive moviemaking, Pro-quality XAVC S format, Meticulous craftsmanship, Multi Frame NR (Noise Reduction), Anti-dust system and coating, Meticulously crafted controls, Time code / Clean HDMI output, Convenient tiltable LCD screen, WiFi &amp; NFC(One-touch remote and one-touch sharing)&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;Effective Pixels: 24.3 MP&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;Sensor Type: CMOS&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;WiFi Available&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;Full HD&lt;/li&gt;\r\n&lt;/ul&gt;', '&lt;p&gt;&nbsp;&lt;/p&gt;\r\n&lt;p&gt;Click breathtaking photos and blur-free videos with this Sony &alpha;7 II DSLR camera - it provides you immense freedom to reinvent your photography skills. This high-quality camera features a 5-axis Image Stabilisation, a 35 mm Full-frame 24.3 MP Exmor CMOS Sensor, and a Sony BIONZ X Image Processing Engine to allow you to capture detailed, crisp, and blur-free images and movies.&lt;/p&gt;\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n&lt;div class=&quot;flxcaE&quot;&gt;In The Box&lt;/div&gt;\r\n&lt;table class=&quot;_14cfVK&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr class=&quot;_1s_Smc row&quot;&gt;\r\n&lt;td class=&quot;URwL2w col col-12-12&quot;&gt;\r\n&lt;ul&gt;\r\n&lt;li class=&quot;_21lJbe&quot;&gt;1 Camera, Lens SEL2870, Lens Hood, Lens Cap, Lens Rear Cap, Power Cord, Rechargeable Battery NP-FW50, AC Adaptor AC-UD10, Shoulder Strap, Body Cap, Accessory Shoe Cap, Eyepiece Cup, Micro USB Cable, Camera Bag&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;', '', '', '', 0, 0, '[{\"72-72\":\"2023-12-13\\/6579559e6fe81.webp\",\"200-200\":\"2023-12-13\\/6579559e6fe81.webp\",\"280-310\":\"2023-12-13\\/6579559e6fe81.webp\",\"400-200\":\"2023-12-13\\/6579559e6fe81.webp\",\"430-590\":\"2023-12-13\\/6579559e6fe81.webp\",\"600-810\":\"2023-12-13\\/6579559e6fe81.webp\"},{\"72-72\":\"2023-12-13\\/6579559e71a53.webp\",\"200-200\":\"2023-12-13\\/6579559e71a53.webp\",\"280-310\":\"2023-12-13\\/6579559e71a53.webp\",\"400-200\":\"2023-12-13\\/6579559e71a53.webp\",\"430-590\":\"2023-12-13\\/6579559e71a53.webp\",\"600-810\":\"2023-12-13\\/6579559e71a53.webp\"}]', '{\"72-72\":\"2023-12-13\\/6579559e6e8de.webp\",\"200-200\":\"2023-12-13\\/6579559e6e8de.webp\",\"280-310\":\"2023-12-13\\/6579559e6e8de.webp\",\"400-200\":\"2023-12-13\\/6579559e6e8de.webp\",\"430-590\":\"2023-12-13\\/6579559e6e8de.webp\",\"600-810\":\"2023-12-13\\/6579559e6e8de.webp\"}', 7, 3, 1, 0, 'samsung-cc112-camera', 'Samsung-CC112-Camera', '1', 1, '544412', '300', '', 2, 'PxZ3aQ9BvRF', '2023-12-13 12:26:30', '2023-12-13 06:56:30', 'SVR6og303Vm', 0, 0, 'SA241816', '&lt;p&gt;Here is usage instruction :-&lt;/p&gt;\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n&lt;p&gt;1 - Open camera with dry hand.&nbsp;&lt;/p&gt;\r\n&lt;p&gt;2 - Don&#039;t use watch to clean camera lens&lt;/p&gt;', '', '1940', '5499', '8999', '12999', '35000', '696,1433,325,37', '1'),
(40, 1, 'Samsung BA122', '&lt;table class=&quot;_14cfVK&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr class=&quot;_1s_Smc row&quot;&gt;\r\n&lt;td class=&quot;URwL2w col col-12-12&quot;&gt;\r\n&lt;ul&gt;\r\n&lt;li class=&quot;_21lJbe&quot;&gt;1 Camera, Lens SEL2870, Lens Hood, Lens Cap, Lens Rear Cap, Power Cord, Rechargeable Battery NP-FW50, AC Adaptor AC-UD10, Shoulder Strap, Body Cap, Accessory Shoe Cap, Eyepiece Cup, Micro USB Cable, Camera Bag&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;', '&lt;p&gt;Click breathtaking photos and blur-free videos with this Sony &alpha;7 II DSLR camera - it provides you immense freedom to reinvent your photography skills. This high-quality camera features a 5-axis Image Stabilisation, a 35 mm Full-frame 24.3 MP Exmor CMOS Sensor, and a Sony BIONZ X Image Processing Engine to allow you to capture detailed, crisp, and blur-free images and movies.&lt;/p&gt;\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;4K/HD format, High-performance Fast Hybrid AF, Phase-detection AF, The Sony full-frame advantage, BIONZ X?speed and precision (High-speed processing faithfully reproduces textures and details in real time, as seen by the naked eye), Expressive moviemaking, Pro-quality XAVC S format, Meticulous craftsmanship, Multi Frame NR (Noise Reduction), Anti-dust system and coating, Meticulously crafted controls, Time code / Clean HDMI output, Convenient tiltable LCD screen, WiFi &amp; NFC(One-touch remote and one-touch sharing)&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;Effective Pixels: 24.3 MP&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;Sensor Type: CMOS&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;WiFi Available&lt;/li&gt;\r\n&lt;li class=&quot;_21Ahn-&quot;&gt;Full HD&lt;/li&gt;\r\n&lt;/ul&gt;', '', '', '', 0, 0, '[{\"72-72\":\"2023-12-13\\/657978330b52a.webp\",\"200-200\":\"2023-12-13\\/657978330b52a.webp\",\"280-310\":\"2023-12-13\\/657978330b52a.webp\",\"400-200\":\"2023-12-13\\/657978330b52a.webp\",\"430-590\":\"2023-12-13\\/657978330b52a.webp\",\"600-810\":\"2023-12-13\\/657978330b52a.webp\"},{\"72-72\":\"2023-12-13\\/657978330cd7e.webp\",\"200-200\":\"2023-12-13\\/657978330cd7e.webp\",\"280-310\":\"2023-12-13\\/657978330cd7e.webp\",\"400-200\":\"2023-12-13\\/657978330cd7e.webp\",\"430-590\":\"2023-12-13\\/657978330cd7e.webp\",\"600-810\":\"2023-12-13\\/657978330cd7e.webp\"},{\"72-72\":\"2023-12-13\\/657978330d5bd.webp\",\"200-200\":\"2023-12-13\\/657978330d5bd.webp\",\"280-310\":\"2023-12-13\\/657978330d5bd.webp\",\"400-200\":\"2023-12-13\\/657978330d5bd.webp\",\"430-590\":\"2023-12-13\\/657978330d5bd.webp\",\"600-810\":\"2023-12-13\\/657978330d5bd.webp\"}]', '{\"72-72\":\"2023-12-13\\/657978330a826.webp\",\"200-200\":\"2023-12-13\\/657978330a826.webp\",\"280-310\":\"2023-12-13\\/657978330a826.webp\",\"400-200\":\"2023-12-13\\/657978330a826.webp\",\"430-590\":\"2023-12-13\\/657978330a826.webp\",\"600-810\":\"2023-12-13\\/657978330a826.webp\"}', 7, 3, 1, 0, 'samsung-ba122', 'Samsung-BA122', '1', 1, '62112', '300', '', 2, 'PvaNrJZT89y', '2023-12-13 14:54:03', '2023-12-13 09:24:03', 'SVR6og303Vm', 0, 0, 'SA623645', '&lt;p&gt;1 - Please don&#039;t use water to clean the lens&lt;/p&gt;\r\n&lt;p&gt;2 - awsdf&lt;/p&gt;', '', '500', '1450', '2200', '3100', '20000', '696,325', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_hsn_code`
--

CREATE TABLE `product_hsn_code` (
  `id` int(11) NOT NULL,
  `hsn_code` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_hsn_code`
--

INSERT INTO `product_hsn_code` (`id`, `hsn_code`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, '62111', 1, NULL, '2023-04-29 04:52:18', ''),
(2, '62112', 1, '2023-04-29 10:22:27', '2023-04-29 04:52:27', ''),
(3, '544412', 1, '2023-04-29 10:22:41', '2023-04-29 04:52:41', ''),
(7, '5407', 1, '2023-06-15 15:21:00', '2023-06-15 09:51:00', ''),
(8, '6204', 1, '2023-06-15 15:21:18', '2023-06-15 09:51:18', ''),
(9, '6307', 1, '2023-06-15 15:21:28', '2023-06-15 09:51:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(11) NOT NULL,
  `prod_id` varchar(20) NOT NULL,
  `product_info_set_id` int(11) NOT NULL,
  `product_info_set_val_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `prod_id`, `product_info_set_id`, `product_info_set_val_id`, `created_at`, `updated_at`) VALUES
(7, 'PSpjLQRcCX7', 1, 1, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(8, 'PSpjLQRcCX7', 1, 2, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(9, 'PSpjLQRcCX7', 3, 5, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(10, 'PSpjLQRcCX7', 3, 6, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(11, 'PSpjLQRcCX7', 3, 7, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(12, 'PSpjLQRcCX7', 3, 8, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(13, 'PSpjLQRcCX7', 3, 9, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(14, 'PSpjLQRcCX7', 3, 10, '2023-07-05 06:06:47', '2023-07-05 06:06:47'),
(15, 'P5YPCG1W4Sj', 1, 1, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(16, 'P5YPCG1W4Sj', 1, 2, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(17, 'P5YPCG1W4Sj', 3, 5, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(18, 'P5YPCG1W4Sj', 3, 6, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(19, 'P5YPCG1W4Sj', 3, 7, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(20, 'P5YPCG1W4Sj', 3, 8, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(21, 'P5YPCG1W4Sj', 3, 9, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(22, 'P5YPCG1W4Sj', 3, 10, '2023-07-05 08:18:35', '2023-07-05 08:18:35'),
(31, 'PyEXPlSz70I', 1, 1, '2023-07-05 08:30:39', '2023-07-05 08:30:39'),
(32, 'PyEXPlSz70I', 1, 2, '2023-07-05 08:30:39', '2023-07-05 08:30:39'),
(33, 'PF4DLOX6AxZ', 1, 1, '2023-07-17 05:19:41', '2023-07-17 05:19:41'),
(34, 'PF4DLOX6AxZ', 1, 2, '2023-07-17 05:19:41', '2023-07-17 05:19:41'),
(35, 'P9WAS7UpdNL', 1, 1, '2023-07-17 05:21:28', '2023-07-17 05:21:28'),
(36, 'P9WAS7UpdNL', 1, 2, '2023-07-17 05:21:28', '2023-07-17 05:21:28'),
(37, 'PE26FIKxnrO', 1, 1, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(38, 'PE26FIKxnrO', 1, 2, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(39, 'PE26FIKxnrO', 1, 11, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(40, 'PE26FIKxnrO', 3, 5, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(41, 'PE26FIKxnrO', 3, 6, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(42, 'PE26FIKxnrO', 3, 7, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(43, 'PE26FIKxnrO', 3, 8, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(44, 'PE26FIKxnrO', 3, 9, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(45, 'PE26FIKxnrO', 3, 10, '2023-08-01 09:31:06', '2023-08-01 09:31:06'),
(46, 'PuL71pefTY9', 1, 1, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(47, 'PuL71pefTY9', 1, 2, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(48, 'PuL71pefTY9', 1, 11, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(49, 'PuL71pefTY9', 3, 5, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(50, 'PuL71pefTY9', 3, 6, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(51, 'PuL71pefTY9', 3, 7, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(52, 'PuL71pefTY9', 3, 8, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(53, 'PuL71pefTY9', 3, 9, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(54, 'PuL71pefTY9', 3, 10, '2023-08-01 10:08:28', '2023-08-01 10:08:28'),
(55, 'PvEbMdUkePK', 1, 1, '2023-08-07 21:05:29', '2023-08-07 21:05:29'),
(56, 'PvEbMdUkePK', 1, 2, '2023-08-07 21:05:29', '2023-08-07 21:05:29'),
(57, 'PvEbMdUkePK', 1, 11, '2023-08-07 21:05:29', '2023-08-07 21:05:29'),
(58, 'PIxivLeB2hS', 1, 1, '2023-08-12 12:10:35', '2023-08-12 12:10:35'),
(59, 'PIxivLeB2hS', 1, 2, '2023-08-12 12:10:35', '2023-08-12 12:10:35'),
(60, 'PIxivLeB2hS', 1, 11, '2023-08-12 12:10:35', '2023-08-12 12:10:35'),
(61, 'PIxivLeB2hS', 2, 3, '2023-08-12 12:10:35', '2023-08-12 12:10:35'),
(62, 'PIxivLeB2hS', 2, 4, '2023-08-12 12:10:35', '2023-08-12 12:10:35'),
(63, 'PIxivLeB2hS', 4, 12, '2023-08-12 12:10:35', '2023-08-12 12:10:35'),
(64, 'PE26FIKxnrO', 1, 1, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(65, 'PE26FIKxnrO', 1, 2, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(66, 'PE26FIKxnrO', 1, 11, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(67, 'PE26FIKxnrO', 3, 5, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(68, 'PE26FIKxnrO', 3, 6, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(69, 'PE26FIKxnrO', 3, 7, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(70, 'PE26FIKxnrO', 3, 8, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(71, 'PE26FIKxnrO', 3, 9, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(72, 'PE26FIKxnrO', 3, 10, '2023-08-24 06:10:39', '2023-08-24 06:10:39'),
(73, 'PMOhg3ypAtr', 1, 1, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(74, 'PMOhg3ypAtr', 1, 2, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(75, 'PMOhg3ypAtr', 1, 11, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(76, 'PMOhg3ypAtr', 3, 5, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(77, 'PMOhg3ypAtr', 3, 6, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(78, 'PMOhg3ypAtr', 3, 7, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(79, 'PMOhg3ypAtr', 3, 8, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(80, 'PMOhg3ypAtr', 3, 9, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(81, 'PMOhg3ypAtr', 3, 10, '2023-09-11 06:29:22', '2023-09-11 06:29:22'),
(82, 'PAJDpio1yhc', 1, 1, '2023-10-08 12:20:33', '2023-10-08 12:20:33'),
(83, 'PAJDpio1yhc', 2, 3, '2023-10-08 12:20:33', '2023-10-08 12:20:33'),
(84, 'PAJDpio1yhc', 5, 13, '2023-10-08 12:20:33', '2023-10-08 12:20:33'),
(121, 'PWqFCZ0L5I7', 1, 1, '2023-11-22 11:19:36', '2023-11-22 11:19:36'),
(122, 'PWqFCZ0L5I7', 5, 13, '2023-11-22 11:19:36', '2023-11-22 11:19:36'),
(123, 'PWqFCZ0L5I7', 7, 21, '2023-11-22 11:19:36', '2023-11-22 11:19:36'),
(124, 'PWqFCZ0L5I7', 8, 24, '2023-11-22 11:19:36', '2023-11-22 11:19:36'),
(125, 'PWqFCZ0L5I7', 9, 27, '2023-11-22 11:19:36', '2023-11-22 11:19:36'),
(126, 'PWqFCZ0L5I7', 10, 29, '2023-11-22 11:19:36', '2023-11-22 11:19:36'),
(133, 'P3j0EAd5zx4', 1, 2, '2023-12-09 08:05:56', '2023-12-09 08:05:56'),
(134, 'P3j0EAd5zx4', 5, 14, '2023-12-09 08:05:56', '2023-12-09 08:05:56'),
(135, 'P3j0EAd5zx4', 7, 22, '2023-12-09 08:05:56', '2023-12-09 08:05:56'),
(136, 'P3j0EAd5zx4', 8, 25, '2023-12-09 08:05:56', '2023-12-09 08:05:56'),
(137, 'P3j0EAd5zx4', 9, 27, '2023-12-09 08:05:56', '2023-12-09 08:05:56'),
(138, 'P3j0EAd5zx4', 10, 30, '2023-12-09 08:05:56', '2023-12-09 08:05:56'),
(139, 'PxZ3aQ9BvRF', 1, 2, '2023-12-13 06:56:30', '2023-12-13 06:56:30'),
(140, 'PxZ3aQ9BvRF', 5, 13, '2023-12-13 06:56:30', '2023-12-13 06:56:30'),
(141, 'PxZ3aQ9BvRF', 7, 22, '2023-12-13 06:56:30', '2023-12-13 06:56:30'),
(142, 'PxZ3aQ9BvRF', 8, 24, '2023-12-13 06:56:30', '2023-12-13 06:56:30'),
(143, 'PxZ3aQ9BvRF', 9, 27, '2023-12-13 06:56:30', '2023-12-13 06:56:30'),
(144, 'PxZ3aQ9BvRF', 10, 30, '2023-12-13 06:56:30', '2023-12-13 06:56:30'),
(145, 'PxZ3aQ9BvRF', 1, 2, '2023-12-13 07:16:04', '2023-12-13 07:16:04'),
(146, 'PxZ3aQ9BvRF', 5, 13, '2023-12-13 07:16:04', '2023-12-13 07:16:04'),
(147, 'PxZ3aQ9BvRF', 7, 22, '2023-12-13 07:16:04', '2023-12-13 07:16:04'),
(148, 'PxZ3aQ9BvRF', 8, 24, '2023-12-13 07:16:04', '2023-12-13 07:16:04'),
(149, 'PxZ3aQ9BvRF', 9, 27, '2023-12-13 07:16:04', '2023-12-13 07:16:04'),
(150, 'PxZ3aQ9BvRF', 10, 30, '2023-12-13 07:16:04', '2023-12-13 07:16:04'),
(151, 'PvaNrJZT89y', 1, 1, '2023-12-13 09:24:03', '2023-12-13 09:24:03'),
(152, 'PvaNrJZT89y', 5, 14, '2023-12-13 09:24:03', '2023-12-13 09:24:03'),
(153, 'PvaNrJZT89y', 7, 22, '2023-12-13 09:24:03', '2023-12-13 09:24:03'),
(154, 'PvaNrJZT89y', 8, 25, '2023-12-13 09:24:03', '2023-12-13 09:24:03'),
(155, 'PvaNrJZT89y', 9, 28, '2023-12-13 09:24:03', '2023-12-13 09:24:03'),
(156, 'PvaNrJZT89y', 10, 30, '2023-12-13 09:24:03', '2023-12-13 09:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_info_set`
--

CREATE TABLE `product_info_set` (
  `id` int(11) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `attribute_ar` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_info_set`
--

INSERT INTO `product_info_set` (`id`, `attribute`, `attribute_ar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Colour', '', 1, '2023-06-29 04:57:12', '2023-06-29 04:57:12'),
(2, 'Screen size', '', 1, '2023-06-29 05:00:19', '2023-06-29 05:00:19'),
(3, 'Size', 'مقاس', 1, '2023-07-05 05:47:59', '2023-07-05 05:47:59'),
(4, 'DImensions', 'أبعاد', 1, '2023-08-01 09:20:23', '2023-08-01 09:20:23'),
(5, 'RAM', 'RAM', 1, '2023-10-08 12:05:01', '2023-10-08 12:05:01'),
(7, 'Internal Storage', 'Internal Storage', 1, '2023-11-22 04:50:22', '2023-11-22 04:50:22'),
(8, 'Brand', 'Brand', 1, '2023-11-22 04:50:35', '2023-11-22 04:50:35'),
(9, 'Wifi', 'Wifi', 1, '2023-11-22 04:52:07', '2023-11-22 04:52:07'),
(10, 'Remote Access', 'Remote Access', 1, '2023-11-22 04:52:37', '2023-11-22 04:52:37'),
(12, 'cks', '', 1, '2023-11-22 07:04:52', '2023-11-22 07:04:52'),
(13, 'new attributes', '', 1, '2023-12-13 09:11:50', '2023-12-13 09:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `product_info_set_val`
--

CREATE TABLE `product_info_set_val` (
  `id` int(11) NOT NULL,
  `product_info_set_id` int(11) NOT NULL,
  `product_info_set_value` varchar(255) NOT NULL,
  `product_info_set_value_ar` varchar(255) NOT NULL,
  `colour_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_info_set_val`
--

INSERT INTO `product_info_set_val` (`id`, `product_info_set_id`, `product_info_set_value`, `product_info_set_value_ar`, `colour_code`) VALUES
(1, 1, 'Red', 'Red', '#e03c1f'),
(2, 1, 'Black', 'Black', '#000000'),
(3, 2, '13 Inch', '', NULL),
(4, 2, '15 Inch', '', NULL),
(5, 3, 'M', 'م', NULL),
(6, 3, 'XS', 'س س', NULL),
(7, 3, 'S', 'س', NULL),
(8, 3, 'L', 'إل', NULL),
(9, 3, 'XL', 'س ل', NULL),
(10, 3, 'XXL', 'س س ل', NULL),
(11, 1, 'Purple', 'Purple', '#df4eb8'),
(12, 4, '1024x768', '1024x768', NULL),
(13, 5, '4 GB', '4GB', NULL),
(14, 5, '8 GB', '8 GB', NULL),
(15, 6, 'Pixel', 'Pixel', NULL),
(16, 6, 'Color', 'Color', '#382929'),
(17, 6, 'Brand', 'Brand', NULL),
(18, 6, 'Internal Storage', 'Internal Storage', NULL),
(19, 6, 'Wifi', 'WIfi', NULL),
(20, 6, 'Remote Control', 'Remote Control', NULL),
(21, 7, '64 GB', '64 GB', NULL),
(22, 7, '128 GB', '128 GB', NULL),
(23, 7, '1 TB', '1 TB', NULL),
(24, 8, 'Sony', 'Sony', NULL),
(25, 8, 'Samsung', 'Samsung', NULL),
(26, 8, 'Nikon', 'Nikon', NULL),
(27, 9, 'Yes', 'Yes', NULL),
(28, 9, 'No', 'No', NULL),
(29, 10, 'Yes', 'Yes', NULL),
(30, 10, 'No', 'No', NULL),
(31, 13, 'att 1', 'attr 1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_meta`
--

CREATE TABLE `product_meta` (
  `meta_id` bigint(20) NOT NULL,
  `prod_id` varchar(100) NOT NULL,
  `meta_title` text NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` longtext NOT NULL,
  `prod_meta_ar` text NOT NULL,
  `prod_keyword_ar` text NOT NULL,
  `prod_meta_desc_ar` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_meta`
--

INSERT INTO `product_meta` (`meta_id`, `prod_id`, `meta_title`, `meta_key`, `meta_value`, `prod_meta_ar`, `prod_keyword_ar`, `prod_meta_desc_ar`) VALUES
(1, 'P3j0EAd5zx4', 'samsung camera 5x zoom', 'samsung 5x zoom camera with wifi,', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_return_policy`
--

CREATE TABLE `product_return_policy` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `policy_validity` int(11) NOT NULL,
  `policy_type_refund` int(11) NOT NULL,
  `policy_type_replace` int(11) NOT NULL,
  `policy_type_exchange` int(11) NOT NULL,
  `policy` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_return_policy`
--

INSERT INTO `product_return_policy` (`id`, `title`, `policy_validity`, `policy_type_refund`, `policy_type_replace`, `policy_type_exchange`, `policy`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(2, '07 Days Return & Exchange ', 2, 1, 1, 1, '&lt;ul&gt;\r\n&lt;li&gt;02 Days Refund against Return (For more details please go through our Return &amp; refund policy)&lt;/li&gt;\r\n&lt;li&gt;07 Days Exchange of Products ( For more details go through our Return Policy)&lt;/li&gt;\r\n&lt;li&gt;Missing items, damaged items: please inform us within 2 business days of the delivery date if there are any problems with your order.&lt;/li&gt;\r\n&lt;li&gt;We strongly Recommend that Make video of Product Unboxing for hassle free Return &amp; Exchange.&lt;/li&gt;\r\n&lt;/ul&gt;', 1, '2022-09-22 02:16:26', '2022-09-22 08:46:26', '1'),
(3, 'Exchange Policy ', 7, 1, 1, 1, '&lt;p&gt;&lt;strong&gt;New Policy&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: center;&quot;&gt;&lt;strong&gt;Exchange Policy:- exchange your existing products in duration of 07 days after delivery as per Return &amp; refund policy mentioned at our policy page&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: center;&quot;&gt;&lt;strong&gt;&nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: center;&quot;&gt;&lt;strong&gt;&nbsp;&lt;/strong&gt;&lt;/p&gt;', 1, '2023-05-15 05:50:54', '2023-05-15 12:20:54', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `review_id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `rating` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `comment` longtext NOT NULL,
  `review_image_1` varchar(255) DEFAULT NULL,
  `review_image_2` varchar(255) DEFAULT NULL,
  `review_image_3` varchar(255) DEFAULT NULL,
  `review_image_4` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`review_id`, `user_id`, `rating`, `title`, `comment`, `review_image_1`, `review_image_2`, `review_image_3`, `review_image_4`, `created_at`, `product_id`, `status`) VALUES
(2, 'UHflRpdEVKU', 4, 'good products\r\n', 'Get the latest item that make your day ful of smile.Get the latest item that make your day ful of smile\r\n', NULL, NULL, NULL, NULL, '2023-11-07 16:39:06', 'P3j0EAd5zx4', 1),
(3, 'U24a3IOsyvt', 2, 'nice', 'ghu', NULL, NULL, NULL, NULL, '2023-12-02 15:22:38', 'P3j0EAd5zx4', 1),
(4, 'U1W3ufw5Fah', 5, 'good product', 'nice product', NULL, NULL, NULL, NULL, '2023-12-08 12:45:01', 'P3j0EAd5zx4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(1, 'Simple'),
(2, 'Configurable'),
(3, 'Bundle'),
(4, 'Downloadable');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `country_id`, `name`, `name_ar`) VALUES
(1, 1, 'MUSCAT', 'مسقط'),
(2, 1, 'MUSANDAM', 'مسندم'),
(3, 1, 'DHOFAR', 'ظفار'),
(4, 1, 'A’SHARQIYAH SOUTH', 'الشرقية الجنوبية'),
(5, 1, 'A’SHARQIYAH NORTH', 'الشرقية الشمالية'),
(6, 1, 'A’DHAHIRAH', 'الظاهرة'),
(7, 1, 'A’DAKHILIYAH', 'الداخلية'),
(8, 1, 'AL WUSTA', 'الوسطى'),
(9, 1, 'AL BURAIMI', 'البريمي'),
(10, 1, 'AL BATINAH SOUTH', 'الباطنة الجنوبية'),
(11, 1, 'AL BATINAH NORTH', 'الباطنة الشمالية');

-- --------------------------------------------------------

--
-- Table structure for table `security_payment`
--

CREATE TABLE `security_payment` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `transection_id` varchar(50) NOT NULL,
  `invoice_proof` text NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `security_payment`
--

INSERT INTO `security_payment` (`id`, `order_id`, `user_id`, `amount`, `product_id`, `payment_status`, `transection_id`, `invoice_proof`, `create_date`, `update_date`) VALUES
(1, 'ODRSHDLLB020487', 'U1W3ufw5Fah', '22000', 'P3j0EAd5zx4', 'pending', '', '', '2023-12-02 06:39:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sellerlogin`
--

CREATE TABLE `sellerlogin` (
  `sellerid` int(11) NOT NULL,
  `seller_unique_id` varchar(100) NOT NULL,
  `business_type` enum('Individual','Company') NOT NULL,
  `vat_registered` tinyint(1) DEFAULT NULL,
  `vat_registratoion_no` varchar(255) DEFAULT NULL,
  `companyname` varchar(100) DEFAULT NULL,
  `fullname` varchar(80) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(20) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `region` int(11) NOT NULL,
  `governorate_id` int(11) DEFAULT NULL,
  `governorate` varchar(255) NOT NULL,
  `area_id` int(11) DEFAULT NULL,
  `area` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `logo` text NOT NULL,
  `websiteurl` text DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `tax_number` varchar(80) NOT NULL,
  `groupid` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `flagid` int(11) NOT NULL,
  `pan_card` text NOT NULL,
  `aadhar_card` text NOT NULL,
  `commercial_registration` text DEFAULT NULL,
  `vat_certificate` varchar(255) DEFAULT NULL,
  `gst_certificate` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `create_by` datetime NOT NULL,
  `update_by` datetime NOT NULL,
  `checksum` varchar(100) NOT NULL,
  `invoice_number` bigint(20) NOT NULL,
  `pan_number` varchar(200) NOT NULL,
  `cin_number` varchar(200) NOT NULL,
  `business_proof` varchar(500) NOT NULL,
  `seller_banner` text NOT NULL,
  `seller_badge` text NOT NULL,
  `seller_badge1` text NOT NULL,
  `seller_badge2` text NOT NULL,
  `firebase_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sellerlogin`
--

INSERT INTO `sellerlogin` (`sellerid`, `seller_unique_id`, `business_type`, `vat_registered`, `vat_registratoion_no`, `companyname`, `fullname`, `address`, `description`, `city_id`, `city`, `pincode`, `state_id`, `state`, `country_id`, `country`, `region_id`, `region`, `governorate_id`, `governorate`, `area_id`, `area`, `phone`, `email`, `logo`, `websiteurl`, `facebook_link`, `instagram_link`, `tax_number`, `groupid`, `password`, `status`, `flagid`, `pan_card`, `aadhar_card`, `commercial_registration`, `vat_certificate`, `gst_certificate`, `license`, `create_by`, `update_by`, `checksum`, `invoice_number`, `pan_number`, `cin_number`, `business_proof`, `seller_banner`, `seller_badge`, `seller_badge1`, `seller_badge2`, `firebase_token`) VALUES
(34, 'SVR6og303Vm', 'Individual', 0, NULL, 'Jony Electronics Mall', 'Jony Paul', 'surat', 'shop', NULL, '396', '395010', NULL, '12', 0, 1, NULL, 1, NULL, '', NULL, '', '919144040888', 'kamalbunkar07@gmail.com', '', '', NULL, NULL, 'GST12051', 1, 'QUVPSDZibW5xNFhKMG5haVIxbkQzUT09', 1, 0, '', '', '', NULL, NULL, NULL, '2023-02-11 18:14:36', '0000-00-00 00:00:00', '102310m9enPG12aI020416', 279, '559c6sscs', 'c9562s6s3', '', '', '{\"72-72\":\"2023-12-01/6569a5a0a62ba.webp\",\"200-200\":\"2023-12-01/6569a5a0a62ba.webp\",\"280-310\":\"2023-12-01/6569a5a0a62ba.webp\",\"400-200\":\"2023-12-01/6569a5a0a62ba.webp\",\"430-590\":\"2023-12-01/6569a5a0a62ba.webp\",\"600-810\":\"2023-12-01/6569a5a0a62ba.webp\"}', '{\"72-72\":\"2023-12-01/6569a5a0a66da.webp\",\"200-200\":\"2023-12-01/6569a5a0a66da.webp\",\"280-310\":\"2023-12-01/6569a5a0a66da.webp\",\"400-200\":\"2023-12-01/6569a5a0a66da.webp\",\"430-590\":\"2023-12-01/6569a5a0a66da.webp\",\"600-810\":\"2023-12-01/6569a5a0a66da.webp\"}', '{\"72-72\":\"2023-12-01/6569a5a0a83f8.webp\",\"200-200\":\"2023-12-01/6569a5a0a83f8.webp\",\"280-310\":\"2023-12-01/6569a5a0a83f8.webp\",\"400-200\":\"2023-12-01/6569a5a0a83f8.webp\",\"430-590\":\"2023-12-01/6569a5a0a83f8.webp\",\"600-810\":\"2023-12-01/6569a5a0a83f8.webp\"}', NULL),
(55, 'SRqrYdjMsuW', 'Individual', 0, NULL, 'Zahrat al sawsen ', 'Mohamad soufan', 'Al hail ', 'Garments shop', NULL, '2', '111', NULL, '1', 0, 1, NULL, 0, NULL, '', NULL, '', '97986666', 'Soufan1982@gmail.com', '', '', NULL, NULL, '1316258', 1, 'QUVPSDZibW5xNFhKMG5haVIxbkQzUT09', 1, 0, '', '', '', NULL, NULL, NULL, '2023-07-03 05:59:45', '2023-07-04 00:16:04', '', 0, '', '', '', '', '', '', '', NULL),
(58, 'S1lpztIfHJn', 'Individual', 1, NULL, 'kamalbunkar07@gmail.com', 'k', 'k', 'k', NULL, '1', '', NULL, '0', 0, 1, NULL, 0, NULL, '', NULL, '', '98746279', 'susantakunduinpl@gmail.com', '2023-08-10/1851630847women-top-6.jpg', '', '', '', '', 1, 'QUVPSDZibW5xNFhKMG5haVIxbkQzUT09', 0, 0, '', '2023-08-10/1318689914women-top-8.jpg', NULL, '2023-08-10/35948548women-top-11.jpg', NULL, NULL, '2023-08-10 23:55:48', '0000-00-00 00:00:00', '', 0, '', '', '', '', '', '', '', NULL),
(59, 'SdCeACa0Ylj', 'Individual', 0, NULL, 'ZAHRAT AL SAWSEN', 'ZAHRAT AL SAWSEN', 'AL KHOUD', 'AL KHOUD', NULL, '0', '', NULL, '0', 0, 1, NULL, 0, NULL, '', NULL, '', '77277106', 'ZAHRATALSAWSEN@workmail.com', '2023-08-21/9724370740b578cbb-e8df-4791-bd3c-8a14dc672300.jpg', '', '', '', '', 1, 'QUVPSDZibW5xNFhKMG5haVIxbkQzUT09', 0, 0, '', '2023-08-21/3650994990b578cbb-e8df-4791-bd3c-8a14dc672300.jpg', NULL, NULL, NULL, NULL, '2023-08-21 10:14:05', '0000-00-00 00:00:00', '', 0, '', '', '', '', '', '', '', NULL),
(60, 'SMwXDvp23uj', 'Individual', 0, '', 'paul.jony70@gmail.co', 'paul.jony70@gmail.co', 'paul.jony70@gmail.co', 'paul.jony70@gmail.co', NULL, '0', '', NULL, '0', 1, 0, 1, 0, 2, 'MUTRAH', 7, 'RUWI', '92123456', 'saabdik007@gmail.com', '2023-08-22/1101095613women-top-6.jpg', '', '', '', '', 1, 'QUVPSDZibW5xNFhKMG5haVIxbkQzUT09', 1, 0, '', '2023-08-22/29771759women-top-6.jpg', NULL, NULL, NULL, NULL, '2023-08-22 14:43:18', '0000-00-00 00:00:00', '', 0, '', '', '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_bankdetails`
--

CREATE TABLE `seller_bankdetails` (
  `id` int(11) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `acc_no` varchar(50) NOT NULL,
  `ifsccode` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `createby` datetime NOT NULL,
  `updateby` datetime NOT NULL,
  `verifed` int(11) NOT NULL,
  `verified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_commission`
--

CREATE TABLE `seller_commission` (
  `id` int(11) NOT NULL,
  `price_from` decimal(20,2) NOT NULL,
  `price_to` decimal(20,2) NOT NULL,
  `commission` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_commission`
--

INSERT INTO `seller_commission` (`id`, `price_from`, `price_to`, `commission`, `status`, `created_at`, `update_at`) VALUES
(1, '0.00', '499.00', '0.50', 1, '2023-04-07 02:24:56', '2023-12-13 12:15:38'),
(2, '500.00', '1000.00', '1.00', 1, '2023-04-07 02:25:17', '2023-12-13 12:15:44'),
(12, '1001.00', '5000.00', '1.00', 1, '2023-12-13 12:15:21', '2023-12-13 12:16:01'),
(13, '50001.00', '10000.00', '2.00', 1, '2023-12-13 12:16:11', '0000-00-00 00:00:00'),
(14, '10001.00', '25000.00', '2.00', 1, '2023-12-13 12:16:29', '0000-00-00 00:00:00'),
(15, '25000.00', '50000.00', '3.00', 1, '2023-12-13 12:16:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seller_flag_reason`
--

CREATE TABLE `seller_flag_reason` (
  `sno` int(11) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_flag_reason`
--

INSERT INTO `seller_flag_reason` (`sno`, `reason`, `type`) VALUES
(1, 'The documents provided by seller are not valid', 'seller'),
(2, 'Please attach address proof', 'deliveryboy'),
(3, 'This brand name is not valid', ''),
(4, 'This category name is not valid', ''),
(5, 'The product have incorrect details. Please correct the details and submit again.', ''),
(6, 'Product images are not fit as per our standard.', '');

-- --------------------------------------------------------

--
-- Table structure for table `seller_group`
--

CREATE TABLE `seller_group` (
  `sno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_group`
--

INSERT INTO `seller_group` (`sno`, `name`, `status`) VALUES
(1, 'General', 1),
(2, 'Retailer', 1),
(3, 'Whole Seller', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller_notification`
--

CREATE TABLE `seller_notification` (
  `id` int(11) NOT NULL,
  `seller_id` varchar(100) NOT NULL,
  `message` varchar(300) NOT NULL,
  `read_status` varchar(1) NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_notification`
--

INSERT INTO `seller_notification` (`id`, `seller_id`, `message`, `read_status`, `created_at`) VALUES
(10, 'SKLI2fYOPS3', 'Your Product rajputi poshak is verified.', 'N', '2023-04-28 14:33:38'),
(11, 'SKLI2fYOPS3', 'Your Product kurti is verified.', 'N', '2023-04-28 15:07:23'),
(12, 'SKLI2fYOPS3', 'Your Product Fast Colour Bikaneri Cotton Suits is verified.', 'N', '2023-04-29 05:43:53'),
(13, 'SKLI2fYOPS3', 'Your Product Fast Colour Bikaneri Cotton Suits is verified.', 'N', '2023-04-29 05:49:44'),
(14, 'SKLI2fYOPS3', 'Your Product Fast Colour Bikaneri Cotton Suits is verified.', 'N', '2023-04-29 10:06:40'),
(15, 'SKLI2fYOPS3', 'Your Product Test Product is rejected. The documents provided by seller are not valid', 'N', '2023-05-03 12:28:04'),
(16, 'SKLI2fYOPS3', 'Your Product Jony Paul is rejected. The documents provided by seller are not valid', 'N', '2023-05-03 12:28:14'),
(17, 'SKLI2fYOPS3', 'Your Category Jony Paul is rejected. The documents provided by seller are not valid', 'N', '2023-05-03 12:28:37'),
(18, 'SKLI2fYOPS3', 'Your Category aaa is rejected. The documents provided by seller are not valid', 'N', '2023-05-03 12:28:43'),
(19, 'SKLI2fYOPS3', 'Your Category New category is rejected. The documents provided by seller are not valid', 'N', '2023-05-03 12:28:49'),
(22, '1', 'Your Product vd vdvdvdvd dv is verified.', 'N', '2023-05-11 06:08:20'),
(27, 'SKLI2fYOPS3', 'Your Product New Kurti is verified.', 'N', '2023-05-15 08:32:41'),
(28, 'SKLI2fYOPS3', 'Your Product New Kurti is verified.', 'N', '2023-05-15 08:45:09'),
(29, 'SKLI2fYOPS3', 'Your Product Naya kurti is verified.', 'N', '2023-05-15 08:51:30'),
(30, 'SKLI2fYOPS3', 'Your Product new today is verified.', 'N', '2023-05-15 09:36:02'),
(31, 'SKLI2fYOPS3', 'Your Product Modi is verified.', 'N', '2023-05-16 09:02:38'),
(32, 'SKLI2fYOPS3', 'Your Brand New is rejected. Please attach address proof', 'N', '2023-05-17 12:04:33'),
(33, 'SKLI2fYOPS3', 'Your Product Mamata is rejected. The documents provided by seller are not valid', 'N', '2023-05-17 12:04:59'),
(34, 'SKLI2fYOPS3', 'Your Product Mamata is rejected. The documents provided by seller are not valid', 'N', '2023-05-17 12:05:17'),
(35, 'SKLI2fYOPS3', 'Your Product So So is rejected. The documents provided by seller are not valid', 'N', '2023-05-17 12:05:37'),
(36, 'SKLI2fYOPS3', 'Your Product So So is rejected. The documents provided by seller are not valid', 'N', '2023-05-17 12:05:48'),
(37, 'SKLI2fYOPS3', 'Your Product So So is rejected. The documents provided by seller are not valid', 'N', '2023-05-17 12:06:05'),
(38, 'SKLI2fYOPS3', 'Your Attribute Palajo is rejected. The documents provided by seller are not valid', 'N', '2023-05-17 12:07:04'),
(40, 'Sx1GrIySv6c', 'Your Product Cotton kurti 1 is verified.', 'N', '2023-05-30 19:56:21'),
(41, 'SaW2HCdGTaA', 'Your Product test kurta 2 is verified.', 'N', '2023-05-31 07:30:10'),
(42, 'SaW2HCdGTaA', 'Your Product test kurta 2 is verified.', 'N', '2023-05-31 07:31:00'),
(43, 'SaW2HCdGTaA', 'Your Product Rose Gold Bangles is verified.', 'N', '2023-06-01 14:06:27'),
(44, 'SaW2HCdGTaA', 'Your Attribute D.No is rejected. The documents provided by seller are not valid', 'N', '2023-06-04 03:16:28'),
(45, 'SaW2HCdGTaA', 'Your Attribute d.no 1 is rejected. The documents provided by seller are not valid', 'N', '2023-06-04 03:16:37'),
(46, 'SaW2HCdGTaA', 'Your Product Rose Gold Bangles is verified.', 'N', '2023-06-04 04:02:22'),
(47, 'SaW2HCdGTaA', 'Your Product aaaaa cccc is verified.', 'N', '2023-06-12 04:59:36'),
(49, 'SaW2HCdGTaA', 'Your Product aaa ddvdvd is verified.', 'N', '2023-06-12 09:36:46'),
(50, 'SaW2HCdGTaA', 'Your Product aaa test is verified.', 'N', '2023-06-12 10:42:04'),
(54, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is verified.', 'N', '2023-06-13 06:36:10'),
(57, 'SaW2HCdGTaA', 'Your Product test test20 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:54:01'),
(61, 'SaW2HCdGTaA', 'Your Product cscsc ssc41 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:54:59'),
(62, 'SaW2HCdGTaA', 'Your Product cscscs is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:55:11'),
(78, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:58:53'),
(79, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:59:05'),
(80, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:59:17'),
(81, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:59:28'),
(82, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:59:40'),
(83, 'SaW2HCdGTaA', 'Your Product csav dvdvdvd 5120 is rejected. The documents provided by seller are not valid', 'N', '2023-06-14 04:59:50'),
(84, 'SKLI2fYOPS3', 'Your Product Webp is verified.', 'N', '2023-06-14 05:34:04'),
(85, 'SKLI2fYOPS3', 'Your Product Chips is verified.', 'N', '2023-06-14 05:40:14'),
(86, 'SKLI2fYOPS3', 'Your Product Chips is verified.', 'N', '2023-06-14 05:53:37'),
(87, 'SKLI2fYOPS3', 'Your Product Chips 2 is verified.', 'N', '2023-06-14 06:05:49'),
(90, 'SaW2HCdGTaA', 'Your Product vdvd dvdv is verified.', 'N', '2023-06-14 08:47:17'),
(92, 'SKLI2fYOPS3', 'Your Product Chips 1 is rejected. The documents provided by seller are not valid', 'N', '2023-06-15 04:44:13'),
(94, 'SaW2HCdGTaA', 'Your Product New is verified.', 'N', '2023-06-15 05:54:45'),
(95, 'SaW2HCdGTaA', 'Your Product New is verified.', 'N', '2023-06-15 06:05:35'),
(96, 'SaW2HCdGTaA', 'Your Product New is verified.', 'N', '2023-06-15 06:05:55'),
(97, 'SaW2HCdGTaA', 'Your Product New is verified.', 'N', '2023-06-15 06:06:09'),
(98, 'SaW2HCdGTaA', 'Your Product New is verified.', 'N', '2023-06-15 06:06:25'),
(99, 'SaW2HCdGTaA', 'Your Product New 2 is verified.', 'N', '2023-06-15 06:17:49'),
(100, 'SaW2HCdGTaA', 'Your Product New 2 is verified.', 'N', '2023-06-15 06:18:00'),
(101, 'SaW2HCdGTaA', 'Your Product test is verified.', 'N', '2023-06-15 06:36:34'),
(146, 'SVR6og303Vm', 'Your Product Men Charcoal Melange Graphic Printed T-shirt is verified.', 'N', '2023-08-01 10:09:25'),
(147, 'SVR6og303Vm', 'Your Product JONY PAUL is verified.', 'N', '2023-08-07 21:06:13'),
(148, 'SMiS9ha1mzY', 'Your Product test 2 is rejected. Please attach address proof', 'N', '2023-08-25 14:21:27'),
(149, 'SVR6og303Vm', 'Your Product night dress is rejected. The documents provided by seller are not valid', 'N', '2023-08-25 14:22:10'),
(150, 'SVR6og303Vm', 'Your Product cks is verified.', 'N', '2023-11-03 06:13:54'),
(151, 'SVR6og303Vm', 'Your Brand cks is verified.', 'N', '2023-11-03 11:05:32'),
(152, 'SVR6og303Vm', 'Your Product new cams is verified.', 'N', '2023-11-22 10:16:58'),
(153, 'SVR6og303Vm', 'Your Product tshirt is verified.', 'N', '2023-12-12 11:50:37'),
(154, 'SVR6og303Vm', 'Your Category VR Headset is rejected. This category name is not valid', 'N', '2023-12-13 06:21:03'),
(155, 'SVR6og303Vm', 'Your Brand Sony is rejected. This brand name is not valid', 'N', '2023-12-13 06:21:35'),
(156, 'SVR6og303Vm', 'Your Product Samsung CC112 Camera is verified.', 'N', '2023-12-13 07:11:42'),
(157, 'SVR6og303Vm', 'Your Category VR headset  is verified.', 'N', '2023-12-13 09:09:38'),
(158, 'SVR6og303Vm', 'Your Product Samsung BA122 is verified.', 'N', '2023-12-13 09:25:19'),
(159, 'SVR6og303Vm', 'Your Brand cks is verified.', 'N', '2023-12-13 10:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `seller_payment`
--

CREATE TABLE `seller_payment` (
  `id` int(11) NOT NULL,
  `seller_id` varchar(200) NOT NULL,
  `payment_total` decimal(10,0) NOT NULL,
  `commission_fee` decimal(10,0) NOT NULL,
  `shipping_fee` decimal(20,2) NOT NULL,
  `payment_due` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_payment_history`
--

CREATE TABLE `seller_payment_history` (
  `id` int(11) NOT NULL,
  `seller_id` varchar(200) NOT NULL,
  `payment_total` decimal(20,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seometa`
--

CREATE TABLE `seometa` (
  `metaid` int(11) NOT NULL,
  `page_title` text NOT NULL,
  `page_heading` text NOT NULL,
  `meta_tags` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keys` text NOT NULL,
  `page_content` longtext NOT NULL,
  `caninocial_url` text NOT NULL,
  `page_slug` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seometa`
--

INSERT INTO `seometa` (`metaid`, `page_title`, `page_heading`, `meta_tags`, `meta_desc`, `meta_keys`, `page_content`, `caninocial_url`, `page_slug`) VALUES
(7, 'contact us', 'Contact us', 'scs', '', '', '', 'sjhjh', 'contact'),
(8, 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', '', 'https://www.ebuy.om/about', 'About Us'),
(9, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '&lt;h3&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;Privacy Policy&nbsp;&lt;/span&gt;&lt;/h3&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;This Privacy Policy is prepared by &lt;/span&gt;&lt;em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;[COMPANY NAME]&lt;/span&gt;&lt;/em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt; and whose registered address is &lt;/span&gt;&lt;em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;[COMPANY ADDRESS]&lt;/span&gt;&lt;/em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt; (&ldquo;We&rdquo;) are committed to protecting and preserving the privacy of our visitors when visiting our site or communicating electronically with us.&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;This policy sets out how we process any personal data we collect from you or that you provide to us through our website and social media sites. We confirm that we will keep your information secure and comply fully with all applicable &lt;/span&gt;&lt;em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;[ORIGIN COUNTRY]&lt;/span&gt;&lt;/em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt; Data Protection legislation and regulations. Please read the following carefully to understand what happens to personal data that you choose to provide to us, or that we collect from you when you visit our sites. By submitting information you are accepting and consenting to the practices described in this policy.&lt;/span&gt;&lt;/p&gt;\r\n&lt;h4&gt;&lt;strong&gt;Types of information we may collect from you&lt;/strong&gt;&lt;/h4&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;We may collect, store and use the following kinds of personal information about individuals who visit and use our website and social media sites:&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Information you supply to us.&lt;/strong&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt; You may supply us with information about you by filling in forms on our website or social media. This includes information you provide when you submit a contact/inquiry form. The information you give us may include but is not limited to, your name, address, e-mail address, and phone number.&lt;/span&gt;&lt;/p&gt;\r\n&lt;h4&gt;&lt;strong&gt;How we may use the information we collect&lt;/strong&gt;&lt;/h4&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;We use the information in the following ways:&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Information you supply to us. &lt;/strong&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;We will use this information:&lt;/span&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;font-weight: 400;&quot;&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;to provide you with information and/or services that you request from us;&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;font-weight: 400;&quot;&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;To contact you to provide the information requested.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h4&gt;&lt;strong&gt;Disclosure of your information&lt;/strong&gt;&lt;/h4&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;Any information you provide to us will either be emailed directly to us or may be stored on a secure server.&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;We do not rent, sell or share personal information about you with other people or non-affiliated companies.&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;We will use all reasonable efforts to ensure that your personal data is not disclosed to regional/national institutions and authorities unless required by law or other regulations.&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data transmitted to our site; any transmission is at your own risk. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorized access.&lt;/span&gt;&lt;/p&gt;\r\n&lt;h4&gt;&lt;strong&gt;Your rights &ndash; access to your personal data&lt;/strong&gt;&lt;/h4&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;You have the right to ensure that your personal data is being processed lawfully (&ldquo;Subject Access Right&rdquo;). Your subject access right can be exercised in accordance with data protection laws and regulations. Any subject access request must be made in writing to &lt;/span&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;[insert contact details]&lt;/span&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;. We will provide your personal data to you within the statutory time frames. To enable us to trace any of your personal data that we may be holding, we may need to request further information from you. If you complain about how we have used your information, you have the right to complain to the Information Commissioner&rsquo;s Office (ICO).&lt;/span&gt;&lt;/p&gt;\r\n&lt;h4&gt;&lt;strong&gt;Changes to our privacy policy&lt;/strong&gt;&lt;/h4&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail. Please check back frequently to see any updates or changes to our privacy policy.&lt;/span&gt;&lt;/p&gt;\r\n&lt;h4&gt;&lt;strong&gt;Contact&lt;/strong&gt;&lt;/h4&gt;\r\n&lt;p&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;Questions, comments, and requests regarding this privacy policy are welcomed and should be addressed to &lt;/span&gt;&lt;em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;[name and address or e-mail address]&lt;/span&gt;&lt;/em&gt;&lt;span style=&quot;font-weight: 400;&quot;&gt;.&lt;/span&gt;&lt;/p&gt;', '', 'privacy_policy'),
(10, 'Terms and Condition', 'Terms and Condition', 'dcs', 'cc ddv', 'dc  d', '', 'cdcd', 'terms-condition'),
(11, 'Returns Policy', 'Returns Policy', 'Returns Policy', 'Returns Policy', 'Returns Policy', '', '', 'returns-policy'),
(12, 'FAQ', 'FAQ', 'FAQ', 'FAQ', 'FAQ', '&lt;p&gt;FAQ&nbsp;Data&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', 'FAQ'),
(13, 'Feedback', 'Feedback', 'Feedback', 'Feedback', 'Feedback', '&lt;p&gt;Feedback Data&lt;/p&gt;\r\n&lt;div id=&quot;c2VycGVkX21vZGFsX2Jsa20&quot; class=&quot;bW9kYWw serped_plugin_div&quot;&gt;&nbsp;&lt;/div&gt;', '', 'feedback'),
(14, 'Help', 'Help', 'Help', 'Help', 'Help', '', '', 'help'),
(15, 'SHIPPING POLICY', 'SHIPPING POLICY', 'Shipping Policy', 'Shipping Policy', 'Shipping Policy', '', '', 'Shipping_Policy');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(2, 'active_sms_service', ''),
(3, 'twilio_account_sid', ''),
(4, 'twilio_auth_token', ''),
(5, 'twilio_sender_phone_number', ''),
(6, 'system_gst', ''),
(7, 'system_name', 'Rentzo'),
(8, 'system_title', 'as'),
(9, 'system_address', 'Address : '),
(10, 'system_phone', '+919144040888'),
(11, 'system_email', 'rentzoinfo@rentzo.co.in'),
(12, 'system_language', '2'),
(13, 'system_currency', '2'),
(14, 'system_logo', '{\"72-72\":\"2023-12-11/6576eb798e3a0.webp\",\"200-200\":\"2023-12-11/6576eb798e3a0.webp\",\"280-310\":\"2023-12-11/6576eb798e3a0.webp\",\"400-200\":\"2023-12-11/6576eb798e3a0.webp\",\"430-590\":\"2023-12-11/6576eb798e3a0.webp\",\"600-810\":\"2023-12-11/6576eb798e3a0.webp\"}'),
(15, 'system_loader', '{\"72-72\":\"2023-12-11/6576eb798f703.webp\",\"200-200\":\"2023-12-11/6576eb798f703.webp\",\"280-310\":\"2023-12-11/6576eb798f703.webp\",\"400-200\":\"2023-12-11/6576eb798f703.webp\",\"430-590\":\"2023-12-11/6576eb798f703.webp\",\"600-810\":\"2023-12-11/6576eb798f703.webp\"}'),
(16, 'smtp_protocol', 'protocol'),
(17, 'smtp_host', 'smtpout.secureserver.net'),
(18, 'smtp_port', '587'),
(19, 'smtp_user', 'rentzoinfo@rentzo.co.in'),
(20, 'smtp_password', 'krub@46cn@j43'),
(23, 'system_timezone', 'Asia/Kolkata'),
(24, 'system_other_email', 'rentzo.co.in@gmail.com'),
(25, 'system_other_phone', '8979866660'),
(26, 'system_currency_symbol', '₹'),
(27, 'ios_app_link', ''),
(28, 'android_app_link', ''),
(29, 'shipping_country', '4'),
(30, 'soft_url', 'http://sms.email-soft.com/sendurl.aspx/'),
(31, 'soft_sender', 'marurang'),
(32, 'soft_user', 'onezone'),
(33, 'soft_password', 'onezone2022000'),
(34, 'app_home_title', 'Best Material'),
(35, 'app_home_subtitle', 'Perfect Choice Edit'),
(36, 'offers', 'Get 15% cashback on your next order. '),
(37, 'app_login_image', ''),
(38, 'app_login_url', ''),
(39, 'reverse_shipping', '78'),
(40, 'coversion_rate', '82'),
(41, 'google_script', ''),
(42, 'facebook_pixel', ''),
(43, 'tag_manager', ''),
(44, 'footer_text', 'Rentzo is a premier e-commerce platform - one-stop destination for all your shopping needs!. we also offer the unique advantage of ordering items directly from Turkey, known for its rich heritage of exquisite craftsmanship and high-quality goods. High Quality products, Shipping Anywhere & Easy Return.'),
(45, 'facebook_link', ''),
(46, 'instagram_link', '#'),
(47, 'twitter_link', '#'),
(48, 'youtube_link', '#'),
(49, 'linkedin_link', '#'),
(50, 'category_banner', '{\"72-72\":\"2023-12-11/6576eb79902b6.webp\",\"200-200\":\"2023-12-11/6576eb79902b6.webp\",\"280-310\":\"2023-12-11/6576eb79902b6.webp\",\"400-200\":\"2023-12-11/6576eb79902b6.webp\",\"430-590\":\"2023-12-11/6576eb79902b6.webp\",\"600-810\":\"2023-12-11/6576eb79902b6.webp\"}'),
(51, 'login_banner', '{\"72-72\":\"2023-12-11/6576eb799aa5d.webp\",\"200-200\":\"2023-12-11/6576eb799aa5d.webp\",\"280-310\":\"2023-12-11/6576eb799aa5d.webp\",\"400-200\":\"2023-12-11/6576eb799aa5d.webp\",\"430-590\":\"2023-12-11/6576eb799aa5d.webp\",\"600-810\":\"2023-12-11/6576eb799aa5d.webp\"}');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_fees`
--

CREATE TABLE `shipping_fees` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `basic_fee` decimal(20,2) NOT NULL,
  `order_value` decimal(20,2) NOT NULL,
  `big_item_fee` decimal(20,2) NOT NULL,
  `estimated_delivery_time` varchar(200) NOT NULL,
  `prime_delivery_time` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_product`
--

CREATE TABLE `sponsor_product` (
  `sno` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sponsor_product`
--

INSERT INTO `sponsor_product` (`sno`, `cat_id`, `product_id`) VALUES
(5, 9, 'PSn2auXGEMd'),
(6, 9, 'PSn2auXGEMd'),
(11, 10, 'PY0UIPJAQFo'),
(12, 10, 'PT8Q7gy1Y0s'),
(13, 10, 'P019o4JXeBy'),
(14, 38, 'PhsyO48vCXo'),
(15, 38, 'P5FRic6ro4V'),
(16, 38, 'PG4MjiqJXnE'),
(17, 38, 'PHYOXmywg18'),
(18, 58, 'PhsyO48vCXo'),
(19, 58, 'P5FRic6ro4V'),
(20, 48, 'Prjn7G8NmPK'),
(21, 48, 'PtZRBD19y8u'),
(22, 5, 'PDptmPQx0Zk'),
(23, 34, 'PIxivLeB2hS');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `countryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `name`, `countryid`) VALUES
(1, 'Andaman & Nicobar Islands', 1),
(2, 'Andhra Pradesh', 1),
(3, 'Arunachal Pradesh', 1),
(4, 'Assam', 1),
(5, 'Bihar', 1),
(6, 'Chandigarh', 1),
(7, 'Chhattisgarh', 1),
(8, 'Dadra & Nagar Haveli', 1),
(9, 'Daman & Diu', 1),
(10, 'Delhi', 1),
(11, 'Goa', 1),
(12, 'Gujarat', 1),
(13, 'Haryana', 1),
(14, 'Himachal Pradesh', 1),
(15, 'Jammu & Kashmir', 1),
(16, 'Jharkhand', 1),
(17, 'Karnataka', 1),
(18, 'Kerala', 1),
(19, 'Lakshadweep', 1),
(20, 'Madhya Pradesh', 1),
(21, 'Maharashtra', 1),
(22, 'Manipur', 1),
(23, 'Meghalaya', 1),
(24, 'Mizoram', 1),
(25, 'Nagaland', 1),
(26, 'Odisha', 1),
(27, 'Puducherry', 1),
(28, 'Punjab', 1),
(29, 'Rajasthan', 1),
(30, 'Sikkim', 1),
(31, 'Tamil Nadu', 1),
(32, 'Telangana', 1),
(33, 'Tripura', 1),
(34, 'Uttar Pradesh', 1),
(35, 'Uttarakhand', 1),
(36, 'West Bengal', 1),
(37, 'Ladakh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `percent` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `name`, `percent`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, '5%', 5, 1, '2021-11-27 10:43:07', '2021-11-27 05:13:07', '1'),
(2, '18%', 18, 1, '2023-03-11 02:39:02', '2023-03-11 09:09:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_history`
--

CREATE TABLE `ticket_history` (
  `id` int(11) NOT NULL,
  `ticket_id` varchar(50) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ticket_history`
--

INSERT INTO `ticket_history` (`id`, `ticket_id`, `subject`, `content`, `type`, `create_at`) VALUES
(2, 'tkt91578914', 'test', 'tdv  vd vd vv', 'admin', '2023-12-15 04:30:36'),
(3, 'tkt91578914', 'cscs', 'cscs cs cs cv', 'admin', '2023-12-15 04:58:41'),
(4, 'tkt91578914', 'good', 'nice replay', 'User', '2023-12-15 17:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `top_offers`
--

CREATE TABLE `top_offers` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `heading_ar` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `description_ar` varchar(255) NOT NULL,
  `offer_page_title` varchar(255) NOT NULL,
  `offer_page_title_ar` varchar(255) NOT NULL,
  `offer_page_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `top_offers`
--

INSERT INTO `top_offers` (`id`, `heading`, `heading_ar`, `description`, `description_ar`, `offer_page_title`, `offer_page_title_ar`, `offer_page_link`) VALUES
(1, 'SIGN UP & GET 15% OFF', 'سجل واحصل على خصم 15٪', 'Members get more! Like a 15% discount voucher, early access to the sale and access to limited edition products. Sign up now!', 'يحصل الأعضاء على المزيد! مثل قسيمة خصم 15٪ ، يمكنك الوصول المبكر إلى البيع والوصول إلى المنتجات ذات الإصدار المحدود. أفتح حساب الأن!', 'SIGN UP & GET 15% OFF', 'سجل واحصل على خصم 15٪', '#'),
(2, 'FREE DELIVERY, FREE RETURNS', 'توصيل مجاني وإرجاع مجاني', 'Members get more! Like a 15% discount voucher, early access to the sale and access to limited edition products. Sign up now!', 'يحصل الأعضاء على المزيد! مثل قسيمة خصم 15٪ ، يمكنك الوصول المبكر إلى البيع والوصول إلى المنتجات ذات الإصدار المحدود. أفتح حساب الأن!', 'SIGN UP & GET 15% OFF', 'سجل واحصل على خصم 15٪', '#'),
(3, 'UPI & NET BANKING AVAILABLE', 'تتوفر خدمات مصرفية UPI & NET', 'Members get more! Like a 15% discount voucher, early access to the sale and access to limited edition products. Sign up now!', 'يحصل الأعضاء على المزيد! مثل قسيمة خصم 15٪ ، يمكنك الوصول المبكر إلى البيع والوصول إلى المنتجات ذات الإصدار المحدود. أفتح حساب الأن!', 'SIGN UP & GET 15% OFF', 'سجل واحصل على خصم 15٪', '#');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `premission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `title`, `premission`) VALUES
(9, 'Accountant', 'Coupon Code,Product,Homepage Settings,Product Review'),
(10, 'Sales', 'App User');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_admin_chat`
--

CREATE TABLE `vendor_admin_chat` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `message_by` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendor_admin_chat`
--

INSERT INTO `vendor_admin_chat` (`id`, `user_id`, `message_by`, `message`, `created_at`, `status`) VALUES
(1, 'SVR6og303Vm', 'VENDOR', 'Hello', '2023-08-09 02:45:36', 'Y'),
(2, 'SVR6og303Vm', 'VENDOR', 'hi', '2023-08-09 02:45:36', 'Y'),
(3, 'SVR6og303Vm', 'VENDOR', 'Hi', '2023-08-09 02:45:36', 'Y'),
(4, 'SVR6og303Vm', 'VENDOR', 'hello', '2023-08-09 02:45:36', 'Y'),
(5, 'SVR6og303Vm', 'VENDOR', 'y', '2023-08-09 02:45:36', 'Y'),
(6, 'SVR6og303Vm', 'VENDOR', 'hi', '2023-08-09 02:45:36', 'Y'),
(7, 'SVR6og303Vm', 'VENDOR', 'Hi , i want to add new category name as VR headset.', '2023-12-13 06:25:59', 'Y'),
(8, 'SVR6og303Vm', 'ADMIN', 'ok.. i will create a new category', '2023-12-13 06:27:59', 'Y'),
(9, 'SVR6og303Vm', 'VENDOR', 'ok thank you', '2023-12-13 06:28:14', 'Y'),
(10, 'SVR6og303Vm', 'VENDOR', 'HI,, new help', '2023-12-13 06:29:59', 'Y'),
(11, 'SVR6og303Vm', 'VENDOR', 'hi please add new', '2023-12-13 06:30:51', 'Y'),
(12, 'SVR6og303Vm', 'VENDOR', 'hi this is kamal bunkar', '2023-12-13 09:28:06', 'Y'),
(13, 'SVR6og303Vm', 'ADMIN', 'hi kamal', '2023-12-13 09:28:15', 'Y'),
(14, 'SVR6og303Vm', 'VENDOR', 'i have new product', '2023-12-13 09:28:24', 'Y'),
(15, 'SVR6og303Vm', 'VENDOR', 'hi', '2023-12-13 10:16:06', 'Y'),
(16, 'SVR6og303Vm', 'VENDOR', 'Hello', '2023-12-13 13:26:45', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_product`
--

CREATE TABLE `vendor_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `vendor_id` varchar(100) NOT NULL,
  `product_mrp` decimal(20,2) NOT NULL,
  `product_sale_price` decimal(20,2) NOT NULL,
  `product_tax_class` varchar(100) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `stock_status` varchar(100) NOT NULL,
  `product_purchase_limit` int(11) NOT NULL,
  `product_remark` varchar(200) NOT NULL,
  `product_related_prod` varchar(500) NOT NULL,
  `product_upsell_prod` varchar(500) NOT NULL,
  `offer_start_date` datetime DEFAULT NULL,
  `offer_end_date` datetime DEFAULT NULL,
  `offer_price` decimal(10,2) DEFAULT NULL,
  `enable_status` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `coupon_code` varchar(50) NOT NULL,
  `seller_price` varchar(100) NOT NULL,
  `is_usd_price` text NOT NULL,
  `wholesale_product` text NOT NULL,
  `affiliate_commission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendor_product`
--

INSERT INTO `vendor_product` (`id`, `product_id`, `vendor_id`, `product_mrp`, `product_sale_price`, `product_tax_class`, `product_stock`, `stock_status`, `product_purchase_limit`, `product_remark`, `product_related_prod`, `product_upsell_prod`, `offer_start_date`, `offer_end_date`, `offer_price`, `enable_status`, `created_at`, `updated_at`, `coupon_code`, `seller_price`, `is_usd_price`, `wholesale_product`, `affiliate_commission`) VALUES
(4, 'PIxivLeB2hS', 'SVR6og303Vm', '200.00', '105.00', '1', 100, 'In Stock', 1000, '', 'Pm9tEaeuYr3,P9WAS7UpdNL,PF4DLOX6AxZ,P5YPCG1W4Sj,PyEXPlSz70I,PSpjLQRcCX7', 'Pm9tEaeuYr3,P9WAS7UpdNL,PF4DLOX6AxZ,P5YPCG1W4Sj,PyEXPlSz70I,PSpjLQRcCX7', NULL, NULL, NULL, '1', '2023-07-04 13:36:08', '2023-07-04 08:06:08', '', '100', '0', '0', ''),
(5, 'PSpjLQRcCX7', 'SVR6og303Vm', '20.00', '10.50', '1', 1999996, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-07-05 11:36:47', '2023-07-05 06:06:47', '', '10', '0', '0', ''),
(6, 'P5YPCG1W4Sj', 'SVR6og303Vm', '18.12', '12.72', '1', 99994, 'In Stock', 1000, '', 'PIxivLeB2hS,PSpjLQRcCX7', '', NULL, NULL, NULL, '1', '2023-07-05 13:48:35', '2023-07-05 08:18:35', '', '12.11', '0', '0', ''),
(8, 'PyEXPlSz70I', 'SVR6og303Vm', '32.12', '24.32', '1', 2147483639, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-07-05 14:00:39', '2023-07-05 08:30:39', '', '23.16', '0', '0', ''),
(9, 'PF4DLOX6AxZ', 'SVR6og303Vm', '20.00', '10.50', '1', 10000, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-07-17 10:49:41', '2023-07-17 05:19:41', '', '10', '0', '0', ''),
(10, 'P9WAS7UpdNL', 'SVR6og303Vm', '40.00', '31.50', '1', 2147483647, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-07-17 10:51:28', '2023-07-17 05:21:28', '', '30', '0', '0', ''),
(11, 'PE26FIKxnrO', 'SVR6og303Vm', '100.00', '78.75', '1', 100000, 'In Stock', 100, '', 'PF4DLOX6AxZ,P5YPCG1W4Sj,PSpjLQRcCX7', 'PIxivLeB2hS', NULL, NULL, NULL, '1', '2023-08-01 13:31:06', '2023-08-01 09:31:06', '', '75', '0', '0', ''),
(12, 'PuL71pefTY9', 'SVR6og303Vm', '200.00', '105.00', '1', 49999, 'In Stock', 1000, '', 'PE26FIKxnrO', 'P9WAS7UpdNL,PE26FIKxnrO', NULL, NULL, NULL, '1', '2023-08-01 15:38:28', '2023-08-01 10:08:28', '', '100', '0', '0', ''),
(13, 'PqIZtmKj1bc', 'SVR6og303Vm', '150.00', '105.00', '2', 4999, 'In Stock', 1000, '', 'Pm9tEaeuYr3,PF4DLOX6AxZ', 'Pm9tEaeuYr3', NULL, NULL, NULL, '1', '2023-08-01 14:26:10', '2023-08-01 10:26:10', '', '100', '0', '0', ''),
(17, 'PlQaDBj6SCs', 'SVR6og303Vm', '100.00', '100.00', '1', 10000, 'In Stock', 10, '', '', '', NULL, NULL, NULL, '1', '2023-08-30 00:00:00', '2023-08-30 04:53:19', '', '', '0', '0', ''),
(18, 'PMOhg3ypAtr', 'SVR6og303Vm', '500.00', '166.95', '1', 100, 'In Stock', 5, '', 'PE26FIKxnrO,PuL71pefTY9,PlQaDBj6SCs,P5YPCG1W4Sj', 'Pm9tEaeuYr3,P9WAS7UpdNL,PlQaDBj6SCs,PqIZtmKj1bc,PSpjLQRcCX7', NULL, NULL, NULL, '1', '2023-09-11 10:29:22', '2023-09-11 06:29:22', '', '159', '0', '0', ''),
(19, 'PAJDpio1yhc', 'SVR6og303Vm', '200.00', '168.00', '1', 2, 'In Stock', 2, '200 items sold in last 3 hours', 'PIxivLeB2hS,Pm9tEaeuYr3', 'PuL71pefTY9,PlQaDBj6SCs,PqIZtmKj1bc,PMOhg3ypAtr', NULL, NULL, NULL, '1', '2023-10-08 16:20:33', '2023-10-08 12:20:33', '', '160', '0', '0', ''),
(20, 'PJYrUOcWS1o', 'SVR6og303Vm', '2000.00', '1284.00', '1', 200, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-11-02 11:38:05', '2023-11-02 07:38:05', '', '1200', '0', '0', ''),
(21, 'PnQCA34gWB1', 'SVR6og303Vm', '3000.00', '1284.00', '1', 200, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-11-02 13:35:02', '2023-11-02 09:35:02', '', '1200', '0', '0', '0'),
(22, 'Pz3lqeIkwQK', 'SVR6og303Vm', '400.00', '200.00', '1', 5, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-11-03 10:56:18', '2023-11-03 05:26:18', '', '120', '0', '0', '0'),
(23, 'PZPXMmjO7c2', '', '200.00', '157.50', '1', 200, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-11-03 15:50:55', '2023-11-03 11:50:55', '', '150', '0', '0', '0'),
(24, 'P58moSCI2e1', 'SVR6og303Vm', '2000.00', '1284.00', '1', 199, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-11-03 15:58:22', '2023-11-03 11:58:23', '', '1200', '0', '0', '0'),
(25, 'P3j0EAd5zx4', 'SVR6og303Vm', '1000.00', '756.00', '1', 186, 'In Stock', 1000, '', 'PIxivLeB2hS,P9WAS7UpdNL,PF4DLOX6AxZ,PuL71pefTY9,PlQaDBj6SCs,P5YPCG1W4Sj', 'PE26FIKxnrO,PF4DLOX6AxZ,P5YPCG1W4Sj,P58moSCI2e1,PyEXPlSz70I,PSpjLQRcCX7', NULL, NULL, NULL, '1', '2023-11-03 16:03:18', '2023-11-03 12:03:18', '', '700', '0', '0', '0'),
(26, 'PyfvpXVKR2t', 'SVR6og303Vm', '200.00', '189.00', '1', 199, 'In Stock', 1000, '', '', '', NULL, NULL, NULL, '1', '2023-11-03 16:10:02', '2023-11-03 12:10:02', '', '180', '0', '0', '0'),
(27, 'Pxuyhzd6rei', 'SVR6og303Vm', '200.00', '126.00', '1', 200, 'In Stock', 1000, '', 'P58moSCI2e1,PyfvpXVKR2t', 'PIxivLeB2hS,PE26FIKxnrO,PF4DLOX6AxZ', NULL, NULL, NULL, '1', '2023-11-21 10:45:26', '2023-11-21 06:45:26', '', '120', '0', '0', '0'),
(30, 'PWqFCZ0L5I7', 'SVR6og303Vm', '800.00', '594.00', '1', 199, 'In Stock', 1000, '', 'P3j0EAd5zx4,P9WAS7UpdNL,PE26FIKxnrO,PuL71pefTY9,PlQaDBj6SCs,PqIZtmKj1bc', 'PIxivLeB2hS,P3j0EAd5zx4,P9WAS7UpdNL,PlQaDBj6SCs,P5YPCG1W4Sj,PyfvpXVKR2t', NULL, NULL, NULL, '1', '2023-11-22 15:19:36', '2023-11-22 11:19:36', '', '550', '0', '0', '0'),
(31, 'PGCSU4EqDnJ', 'SVR6og303Vm', '1000.00', '1000.00', '1', 0, 'In Stock', 10, '', '', '', NULL, NULL, NULL, '1', '2023-12-12 00:00:00', '2023-12-12 11:21:25', '', '', '', '', ''),
(32, 'PxZ3aQ9BvRF', 'SVR6og303Vm', '45000.00', '44290.00', '1', 1, 'In Stock', 1, 'Best camera for wedding photography', 'P3j0EAd5zx4,PWqFCZ0L5I7', 'PIxivLeB2hS,PAJDpio1yhc,PnQCA34gWB1', NULL, NULL, NULL, '1', '2023-12-13 12:26:30', '2023-12-13 06:56:30', '', '43000', '0', '0', '0'),
(33, 'PvaNrJZT89y', 'SVR6og303Vm', '45000.00', '42230.00', '1', 2, 'In Stock', 1, 'best camera for wedding photo', 'P3j0EAd5zx4,PWqFCZ0L5I7,PxZ3aQ9BvRF', 'PIxivLeB2hS,Pz3lqeIkwQK,P3j0EAd5zx4,Pxuyhzd6rei,PuL71pefTY9', NULL, NULL, NULL, '1', '2023-12-13 14:54:03', '2023-12-13 09:24:03', '', '41000', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `video_recording`
--

CREATE TABLE `video_recording` (
  `id` int(11) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `video_link` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video_recording`
--

INSERT INTO `video_recording` (`id`, `order_id`, `product_id`, `duration`, `video_link`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'ODR6WLTNF035720', 'P3j0EAd5zx4', '10:00', 'https://www.rentzo.co.in/video?appid=2c35bc66b7364b47aefe72415b2f8cd3&channel=rentzo&token=', '2023-11-29 05:49:30', '2023-12-08 13:50:29', '1'),
(2, 'ODRSJ3AFM124568', 'P3j0EAd5zx4', '5:00', 'https://www.rentzo.co.in/video?appid=2c35bc66b7364b47aefe72415b2f8cd3&channel=rentzo&token=', '2023-12-08 07:49:30', '2023-12-08 13:50:29', '1');

-- --------------------------------------------------------

--
-- Table structure for table `visibility`
--

CREATE TABLE `visibility` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visibility`
--

INSERT INTO `visibility` (`id`, `name`, `status`) VALUES
(1, 'Catalog', 1),
(2, 'Search', 1),
(3, 'Catalog, Search', 1),
(4, 'Not visible individually', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_summery`
--

CREATE TABLE `wallet_summery` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `wallet_id` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wallet_summery`
--

INSERT INTO `wallet_summery` (`id`, `user_id`, `wallet_id`, `amount`, `created_at`) VALUES
(1, 'UWdvRe8buNT', 'WALLET202308110017469cd51f', '85', '2023-09-05 10:45:08'),
(2, 'UHfsEvjd4iG', 'WALLET202308111642598317f9', '3563.86', '2023-10-05 06:20:58'),
(3, 'UWhoNjAIrSk', 'WALLET20230811214451c89377', '40', '2023-08-20 08:58:07'),
(4, 'U6Hd4kUeJSR', 'WALLET202308120834031315c2', '0', '2023-08-12 08:34:02'),
(5, 'UPfM6WcVs3n', 'WALLET2023081209163097636a', '2680', '2023-08-17 06:12:32'),
(6, 'UJxdjAhqKTa', 'WALLET2023081212051621fbad', '0', '2023-08-12 12:05:15'),
(7, 'Uu9EIa7McYb', 'WALLET202308121430515e33eb', '0', '2023-08-12 14:30:50'),
(8, 'U5SpUdyLJtK', 'WALLET20230812184733373cbf', '10', '2023-08-14 09:50:13'),
(9, 'UV0cpGzEodR', 'WALLET20230813114712321f20', '415', '2023-08-13 09:24:13'),
(10, 'U4IfM5e8TbY', 'WALLET20230814102533f2a5f2', '5', '2023-09-19 05:07:11'),
(11, 'UwBEnxGM5vz', 'WALLET20230814142221032a95', '0', '2023-08-14 14:22:20'),
(12, 'UefSqmn4VtR', 'WALLET20230816090119148121', '0', '2023-08-16 09:01:18'),
(14, 'U2HQxFraJmD', 'WALLET20230907113113a555a5', '0', '2023-09-07 11:31:12'),
(15, 'UHflRpdEVKU', 'WALLET2023100916014583cc22', '0', '2023-10-09 16:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction_history`
--

CREATE TABLE `wallet_transaction_history` (
  `id` int(11) NOT NULL,
  `wallet_id` varchar(50) NOT NULL,
  `payment_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '0- affiliate commission / \r\n1 - add money / \r\n2 - check0ut_discount / \r\n3 - tranferred to bank',
  `transaction_id` varchar(50) NOT NULL,
  `transaction_type` enum('cr','dr') NOT NULL,
  `amount` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `remark` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wallet_transaction_history`
--

INSERT INTO `wallet_transaction_history` (`id`, `wallet_id`, `payment_type`, `transaction_id`, `transaction_type`, `amount`, `balance`, `product_id`, `order_id`, `user_id`, `remark`, `status`, `created_at`) VALUES
(1, 'WALLET202308110017469cd51f', '1', 'TX16917319214387', 'cr', '5', '5', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 05:32:01'),
(2, 'WALLET202308110017469cd51f', '1', 'TX16917500551221', 'cr', '5', '10', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 10:34:15'),
(3, 'WALLET202308111642598317f9', '1', 'TX16917577982756', 'cr', '10', '10', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 12:43:18'),
(4, 'WALLET202308111642598317f9', '1', 'TX16917578046277', 'cr', '10', '20', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 12:43:24'),
(5, 'WALLET202308111642598317f9', '1', 'TX16917578075044', 'cr', '20', '40', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 12:43:27'),
(6, 'WALLET202308111642598317f9', '1', 'TX16917578101316', 'cr', '100', '140', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 12:43:30'),
(7, 'WALLET202308111642598317f9', '1', 'TX16917588588346', 'cr', '50', '190', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:00:58'),
(8, 'WALLET202308111642598317f9', '1', 'TX16917588641454', 'cr', '10', '200', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:04'),
(9, 'WALLET202308111642598317f9', '1', 'TX16917588687238', 'cr', '20', '220', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:08'),
(10, 'WALLET202308111642598317f9', '1', 'TX16917588716325', 'cr', '20', '240', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:11'),
(11, 'WALLET202308111642598317f9', '1', 'TX16917588754269', 'cr', '5', '245', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:15'),
(12, 'WALLET202308111642598317f9', '1', 'TX16917588792452', 'cr', '10', '255', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:19'),
(13, 'WALLET202308111642598317f9', '1', 'TX16917588942965', 'cr', '10', '265', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:34'),
(14, 'WALLET202308111642598317f9', '1', 'TX16917588972193', 'cr', '20', '285', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:37'),
(15, 'WALLET202308111642598317f9', '1', 'TX16917589007856', 'cr', '10', '295', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:40'),
(16, 'WALLET202308111642598317f9', '1', 'TX16917589057908', 'cr', '20', '315', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:45'),
(17, 'WALLET202308111642598317f9', '1', 'TX16917589085346', 'cr', '20', '335', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:48'),
(18, 'WALLET202308111642598317f9', '1', 'TX16917589121054', 'cr', '150', '485', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-11 13:01:52'),
(19, 'WALLET202308110017469cd51f', '1', 'TX16918115741490', 'cr', '50', '60', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-12 03:39:34'),
(20, 'WALLET20230812184733373cbf', '1', 'TX16918516716522', 'cr', '5', '5', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-12 14:47:51'),
(21, 'WALLET20230813114712321f20', '1', 'TX16919128569866', 'cr', '5', '5', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:36'),
(22, 'WALLET20230813114712321f20', '1', 'TX16919128607084', 'cr', '10', '15', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:40'),
(23, 'WALLET20230813114712321f20', '1', 'TX16919128639834', 'cr', '20', '35', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:43'),
(24, 'WALLET20230813114712321f20', '1', 'TX16919128663946', 'cr', '100', '135', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:46'),
(25, 'WALLET20230813114712321f20', '1', 'TX16919128694907', 'cr', '5', '140', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:49'),
(26, 'WALLET20230813114712321f20', '1', 'TX16919128726063', 'cr', '10', '150', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:52'),
(27, 'WALLET20230813114712321f20', '1', 'TX16919128757187', 'cr', '20', '170', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:47:55'),
(28, 'WALLET20230813114712321f20', '1', 'TX16919128854030', 'cr', '100', '270', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:48:05'),
(29, 'WALLET20230813114712321f20', '1', 'TX16919128968114', 'cr', '30', '300', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 07:48:16'),
(30, 'WALLET20230813114712321f20', '1', 'TX16919186507148', 'cr', '35', '335', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 09:24:10'),
(31, 'WALLET20230813114712321f20', '1', 'TX16919186532862', 'cr', '80', '415', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-13 09:24:13'),
(32, 'WALLET202308111642598317f9', '1', 'TX16919946269482', 'cr', '12.34', '497.34', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 06:30:26'),
(33, 'WALLET2023081209163097636a', '1', 'TX16919963233675', 'cr', '105', '105', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 06:58:43'),
(34, 'WALLET2023081209163097636a', '1', 'TX16919963403693', 'cr', '385', '490', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 06:59:00'),
(35, 'WALLET202308111642598317f9', '1', 'TX16919989164618', 'cr', '12.34', '509.68', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 07:41:56'),
(36, 'WALLET202308111642598317f9', '1', 'TX16919992115737', 'cr', '500', '1009.68', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 07:46:51'),
(37, 'WALLET20230812184733373cbf', '1', 'TX16920066136271', 'cr', '5', '10', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 09:50:13'),
(38, 'WALLET202308111642598317f9', '1', 'TX16920180012104', 'cr', '10', '1019.68', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 13:00:01'),
(39, 'WALLET202308111642598317f9', '1', 'TX16920183072203', 'cr', '17.5', '1037.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 13:05:07'),
(40, 'WALLET202308111642598317f9', '1', 'TX16920184006165', 'cr', '1', '1038.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 13:06:40'),
(41, 'WALLET202308111642598317f9', '1', 'TX16920185719556', 'cr', '1', '1039.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-14 13:09:31'),
(42, 'WALLET202308110017469cd51f', '1', 'TX16920645082660', 'cr', '5', '65', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-15 01:55:08'),
(43, 'WALLET202308110017469cd51f', '1', 'TX16921893569306', 'cr', '5', '70', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-16 12:35:56'),
(44, 'WALLET2023081209163097636a', '1', 'TX16922520021316', 'cr', '100', '590', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-17 06:00:02'),
(45, 'WALLET2023081209163097636a', '1', 'TX16922520163372', 'cr', '2000', '2590', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-17 06:00:16'),
(46, 'WALLET2023081209163097636a', '1', 'TX16922527528996', 'cr', '90', '2680', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-17 06:12:32'),
(47, 'WALLET202308110017469cd51f', '1', 'TX16923015014998', 'cr', '5', '75', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-17 19:45:01'),
(48, 'WALLET202308110017469cd51f', '1', 'TX16923515857930', 'cr', '5', '80', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-18 09:39:45'),
(49, 'WALLET20230811214451c89377', '1', 'TX16925191667429', 'cr', '5', '5', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-20 08:12:46'),
(50, 'WALLET20230811214451c89377', '1', 'TX16925192098408', 'cr', '5', '10', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-20 08:13:29'),
(51, 'WALLET20230811214451c89377', '1', 'TX16925193102001', 'cr', '10', '20', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-20 08:15:10'),
(52, 'WALLET20230811214451c89377', '1', 'TX16925218875744', 'cr', '20', '40', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-20 08:58:07'),
(53, 'WALLET202308111642598317f9', '1', 'TX16926868928020', 'cr', '500', '1539.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-22 06:48:12'),
(54, 'WALLET202308111642598317f9', '1', 'TX16928566855772', 'cr', '1000', '2539.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-08-24 05:58:05'),
(55, 'WALLET202308111642598317f9', '1', 'TX16937140227050', 'cr', '500', '3039.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-09-03 04:07:02'),
(56, 'WALLET202308111642598317f9', '1', 'TX16937140298524', 'cr', '500', '3539.18', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-09-03 04:07:09'),
(57, 'WALLET202308110017469cd51f', '1', 'TX16939107084877', 'cr', '5', '85', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-09-05 10:45:08'),
(58, 'WALLET20230814102533f2a5f2', '1', 'TX16951000313335', 'cr', '5', '5', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-09-19 05:07:11'),
(59, 'WALLET202308111642598317f9', '1', 'TX16963203654486', 'cr', '12.34', '3551.52', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-10-03 08:06:05'),
(60, 'WALLET202308111642598317f9', '1', 'TX16964868588359', 'cr', '12.34', '3563.86', NULL, NULL, NULL, 'Money Added to wallet', 1, '2023-10-05 06:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `wishlistdetails`
--

CREATE TABLE `wishlistdetails` (
  `id` int(11) NOT NULL,
  `prod_id` varchar(200) NOT NULL,
  `attr_sku` varchar(200) NOT NULL,
  `vendor_id` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `refer_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wishlistdetails`
--

INSERT INTO `wishlistdetails` (`id`, `prod_id`, `attr_sku`, `vendor_id`, `user_id`, `qty`, `refer_id`) VALUES
(1, 'PeGgYVhznqM', 'abc', 'SKLI2fYOPS3', 'U0RHwgzhts6', 1, ''),
(3, 'Pnov7A3VDKi', 'Saree-3', 'SKLI2fYOPS3', 'UtT38fKN9hP', 1, ''),
(4, 'PWJLPfYdMV4', 'New-Dress-of-Silk', 'SKLI2fYOPS3', 'UMPedBuWYQg', 1, '0'),
(14, 'P1I2xYv0yFp', 'Red-Rajasthani-Bridal-Lehenga', 'SKLI2fYOPS3', 'UJSYx9MurIv', 1, '0'),
(15, 'PW45IqsZP09', 'Traditional-Saree-1', 'SKLI2fYOPS3', 'UJSYx9MurIv', 1, '0'),
(17, 'Pnov7A3VDKi', 'Saree-3', 'SKLI2fYOPS3', 'UJSYx9MurIv', 1, '0'),
(20, 'PIxivLeB2hS', 'APPLE-2020-Macbook-Air-M1', 'SVR6og303Vm', 'UnyZHGK0mLq', 1, ''),
(21, 'PSpjLQRcCX7', 'Women-Printed-Viscose-Rayon-Straight-Kurta', 'SVR6og303Vm', 'UnyZHGK0mLq', 1, ''),
(30, 'Pm9tEaeuYr3', 'Cream-Coloured-and-Red-Floral-Silk-Blend-Saree', 'SVR6og303Vm', 'UkSBJ0sVoqf', 1, ''),
(35, 'Pm9tEaeuYr3', 'Cream-Coloured-and-Red-Floral-Silk-Blend-Saree', 'SVR6og303Vm', 'ULkqMTGBxsN', 1, ''),
(38, 'PIxivLeB2hS', 'APPLE-2020-Macbook-Air-M1', 'SVR6og303Vm', 'UIlvArw6f73', 1, ''),
(39, 'PSpjLQRcCX7', 'Women-Printed-Viscose-Rayon-Straight-Kurta', 'SVR6og303Vm', 'UIlvArw6f73', 1, ''),
(40, 'PSpjLQRcCX7', 'Women-Printed-Viscose-Rayon-Straight-Kurta', 'SVR6og303Vm', 'Uzds94FTE3Q', 1, ''),
(41, 'PyEXPlSz70I', 'WEIRD-WOLF-3-Colour-Mode-LED-StudyDesk-Table-Lamp', 'SVR6og303Vm', 'Uzds94FTE3Q', 1, ''),
(43, 'PIxivLeB2hS', 'APPLE-2020-Macbook-Air-M1', 'SVR6og303Vm', 'UPfM6WcVs3n', 1, ''),
(48, 'Pm9tEaeuYr3', 'Cream-Coloured-and-Red-Floral-Silk-Blend-Saree', 'SVR6og303Vm', 'U4IfM5e8TbY', 1, ''),
(49, 'PIxivLeB2hS', 'APPLE-2020-Macbook-Air-M1', 'SVR6og303Vm', 'U4IfM5e8TbY', 1, ''),
(51, 'PyEXPlSz70I', 'WEIRD-WOLF-3-Colour-Mode-LED-StudyDesk-Table-Lamp', 'SVR6og303Vm', 'U4IfM5e8TbY', 1, '0'),
(52, 'PE26FIKxnrO', 'encore-by-INVICTUS', 'SVR6og303Vm', 'U4IfM5e8TbY', 1, ''),
(54, 'Pm9tEaeuYr3', 'Cream-Coloured-and-Red-Floral-Silk-Blend-Saree', 'SVR6og303Vm', 'UPfM6WcVs3n', 1, ''),
(57, 'P5YPCG1W4Sj', 'Men-White-and-Teal-Blue-Slim-Fit-Striped-Casual-Shirt', 'SVR6og303Vm', 'UkFJLO0ZU52', 1, ''),
(60, 'PSpjLQRcCX7', 'Women-Printed-Viscose-Rayon-Straight-Kurta', 'SVR6og303Vm', 'U24a3IOsyvt', 1, '0'),
(65, 'P5YPCG1W4Sj', 'Men-White-and-Teal-Blue-Slim-Fit-Striped-Casual-Shirt', 'SVR6og303Vm', 'UPfM6WcVs3n', 1, ''),
(69, 'PMOhg3ypAtr', 'Roadister-#ff4040-SleevesLess', 'SVR6og303Vm', 'UPfM6WcVs3n', 1, ''),
(70, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', 1, '0'),
(72, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'U1W3ufw5Fah', 1, '0'),
(77, 'P3j0EAd5zx4', 'Dpofirs-Digital-Camera-1080P', 'SVR6og303Vm', 'UJxdjAhqKTa', 1, '0'),
(78, 'PF4DLOX6AxZ', 'Floral-Embroidered-Art-Silk-Unstitched-Dress-Material', 'SVR6og303Vm', 'UV0cpGzEodR', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `appuser_login`
--
ALTER TABLE `appuser_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_unique_id` (`user_unique_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_set`
--
ALTER TABLE `attribute_set`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `attribute_set_product_info`
--
ALTER TABLE `attribute_set_product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `buy_from_another_country_requests`
--
ALTER TABLE `buy_from_another_country_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartdetails`
--
ALTER TABLE `cartdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `sku` (`attr_sku`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `qoute_id` (`qoute_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_slug` (`cat_slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupancode`
--
ALTER TABLE `coupancode`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `coupancode_vendor`
--
ALTER TABLE `coupancode_vendor`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days_price`
--
ALTER TABLE `days_price`
  ADD PRIMARY KEY (`days_id`);

--
-- Indexes for table `deliveryboy_bankdetails`
--
ALTER TABLE `deliveryboy_bankdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveryboy_id` (`deliveryboy_id`);

--
-- Indexes for table `deliveryboy_login`
--
ALTER TABLE `deliveryboy_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy_orders`
--
ALTER TABLE `delivery_boy_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_form`
--
ALTER TABLE `faq_form`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `firebase_notification`
--
ALTER TABLE `firebase_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_banner`
--
ALTER TABLE `homepage_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_banners`
--
ALTER TABLE `homepage_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_category`
--
ALTER TABLE `home_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_custom_banner`
--
ALTER TABLE `home_custom_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_product2_saw2hcdgtaa`
--
ALTER TABLE `import_product2_saw2hcdgtaa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_product2_sln82lwrpfg`
--
ALTER TABLE `import_product2_sln82lwrpfg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_product_saw2hcdgtaa`
--
ALTER TABLE `import_product_saw2hcdgtaa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_product_sln82lwrpfg`
--
ALTER TABLE `import_product_sln82lwrpfg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `language_phrase`
--
ALTER TABLE `language_phrase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `qoute_id` (`qoute_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_chat`
--
ALTER TABLE `order_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `prod_sku` (`prod_sku`);

--
-- Indexes for table `order_tracking_status`
--
ALTER TABLE `order_tracking_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_product`
--
ALTER TABLE `popular_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes_conf`
--
ALTER TABLE `product_attributes_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes_set`
--
ALTER TABLE `product_attributes_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_prod_id` (`vendor_prod_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_name` (`prod_name`),
  ADD KEY `product_unique_id` (`product_unique_id`),
  ADD KEY `status` (`status`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `product_sku` (`product_sku`);

--
-- Indexes for table `product_hsn_code`
--
ALTER TABLE `product_hsn_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info_set`
--
ALTER TABLE `product_info_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info_set_val`
--
ALTER TABLE `product_info_set_val`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_meta`
--
ALTER TABLE `product_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `product_return_policy`
--
ALTER TABLE `product_return_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_payment`
--
ALTER TABLE `security_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellerlogin`
--
ALTER TABLE `sellerlogin`
  ADD PRIMARY KEY (`sellerid`),
  ADD KEY `seller_unique_id` (`seller_unique_id`);

--
-- Indexes for table `seller_bankdetails`
--
ALTER TABLE `seller_bankdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `seller_commission`
--
ALTER TABLE `seller_commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_flag_reason`
--
ALTER TABLE `seller_flag_reason`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `seller_group`
--
ALTER TABLE `seller_group`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `seller_notification`
--
ALTER TABLE `seller_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `seller_payment`
--
ALTER TABLE `seller_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `seller_payment_history`
--
ALTER TABLE `seller_payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `seometa`
--
ALTER TABLE `seometa`
  ADD PRIMARY KEY (`metaid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `shipping_fees`
--
ALTER TABLE `shipping_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor_product`
--
ALTER TABLE `sponsor_product`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `ticket_history`
--
ALTER TABLE `ticket_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_offers`
--
ALTER TABLE `top_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_admin_chat`
--
ALTER TABLE `vendor_admin_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vendor_product`
--
ALTER TABLE `vendor_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `enable_status` (`enable_status`);

--
-- Indexes for table `video_recording`
--
ALTER TABLE `video_recording`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visibility`
--
ALTER TABLE `visibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_summery`
--
ALTER TABLE `wallet_summery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transaction_history`
--
ALTER TABLE `wallet_transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlistdetails`
--
ALTER TABLE `wishlistdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `attr_sku` (`attr_sku`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appuser_login`
--
ALTER TABLE `appuser_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1718;

--
-- AUTO_INCREMENT for table `attribute_set`
--
ALTER TABLE `attribute_set`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute_set_product_info`
--
ALTER TABLE `attribute_set_product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `buy_from_another_country_requests`
--
ALTER TABLE `buy_from_another_country_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cartdetails`
--
ALTER TABLE `cartdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1547;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupancode`
--
ALTER TABLE `coupancode`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupancode_vendor`
--
ALTER TABLE `coupancode_vendor`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `days_price`
--
ALTER TABLE `days_price`
  MODIFY `days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliveryboy_bankdetails`
--
ALTER TABLE `deliveryboy_bankdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryboy_login`
--
ALTER TABLE `deliveryboy_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_boy_orders`
--
ALTER TABLE `delivery_boy_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq_form`
--
ALTER TABLE `faq_form`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `firebase_notification`
--
ALTER TABLE `firebase_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `homepage_banner`
--
ALTER TABLE `homepage_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `homepage_banners`
--
ALTER TABLE `homepage_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `home_category`
--
ALTER TABLE `home_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_custom_banner`
--
ALTER TABLE `home_custom_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `import_product2_saw2hcdgtaa`
--
ALTER TABLE `import_product2_saw2hcdgtaa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_product2_sln82lwrpfg`
--
ALTER TABLE `import_product2_sln82lwrpfg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_product_saw2hcdgtaa`
--
ALTER TABLE `import_product_saw2hcdgtaa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `import_product_sln82lwrpfg`
--
ALTER TABLE `import_product_sln82lwrpfg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `language_phrase`
--
ALTER TABLE `language_phrase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_chat`
--
ALTER TABLE `order_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_tracking_status`
--
ALTER TABLE `order_tracking_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `popular_product`
--
ALTER TABLE `popular_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_attributes_conf`
--
ALTER TABLE `product_attributes_conf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `product_attributes_set`
--
ALTER TABLE `product_attributes_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_hsn_code`
--
ALTER TABLE `product_hsn_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `product_info_set`
--
ALTER TABLE `product_info_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_info_set_val`
--
ALTER TABLE `product_info_set_val`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_meta`
--
ALTER TABLE `product_meta`
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_return_policy`
--
ALTER TABLE `product_return_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `security_payment`
--
ALTER TABLE `security_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sellerlogin`
--
ALTER TABLE `sellerlogin`
  MODIFY `sellerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `seller_bankdetails`
--
ALTER TABLE `seller_bankdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_commission`
--
ALTER TABLE `seller_commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seller_flag_reason`
--
ALTER TABLE `seller_flag_reason`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seller_group`
--
ALTER TABLE `seller_group`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller_notification`
--
ALTER TABLE `seller_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `seller_payment`
--
ALTER TABLE `seller_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_payment_history`
--
ALTER TABLE `seller_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seometa`
--
ALTER TABLE `seometa`
  MODIFY `metaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `shipping_fees`
--
ALTER TABLE `shipping_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsor_product`
--
ALTER TABLE `sponsor_product`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_history`
--
ALTER TABLE `ticket_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `top_offers`
--
ALTER TABLE `top_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor_admin_chat`
--
ALTER TABLE `vendor_admin_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendor_product`
--
ALTER TABLE `vendor_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `video_recording`
--
ALTER TABLE `video_recording`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visibility`
--
ALTER TABLE `visibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet_summery`
--
ALTER TABLE `wallet_summery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wallet_transaction_history`
--
ALTER TABLE `wallet_transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `wishlistdetails`
--
ALTER TABLE `wishlistdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
