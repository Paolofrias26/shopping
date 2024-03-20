-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 11:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(26, 'Paolo', '71c5da4b0d83456b94f6841561eb613b', '2023-09-08 02:23:49', '08-09-2023 08:07:08 AM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(8, 'Kids', 'Men & Women', '2023-09-11 13:12:03', NULL),
(9, 'Appliances', 'House & Buildings', '2023-09-12 01:52:01', NULL),
(10, 'Cosmetics', 'Discover beauty at its best with our curated collection of cosmetics. Elevate your look with high-quality makeup, skincare, and fragrances. Explore our range and enhance your natural charm today!', '2023-09-17 13:35:30', NULL),
(11, 'Kitchen', 'Discover beauty at its best with our curated collection of cosmetics. Elevate your look with high-quality makeup, skincare, and fragrances. ', '2023-09-17 13:36:25', NULL),
(12, 'Clothing', 'Elevate your style with our curated collection of clothing. From timeless classics to the latest fashion trends, we offer a wide range of apparel for every occasion.', '2023-09-17 13:38:20', NULL),
(13, 'Decoration', 'Transform your space into a haven of elegance and charm with our exquisite decorations. Explore a curated selection of decor items that inspire and elevate your surroundings.', '2023-09-17 13:39:08', NULL),
(14, 'School Supplies', 'Equip for excellence with our school supplies. Shop now!', '2023-09-17 13:43:34', NULL),
(15, 'Hardware Tools', 'Unlock your DIY potential with our hardware tools. From wrenches to power drills, we have the gear you need to tackle any project.', '2023-09-17 13:44:07', '17-09-2023 07:41:12 PM'),
(16, 'Daily Needs', '', '2023-09-17 13:46:59', NULL),
(18, 'Furnitures', 'Furniture comprises movable objects designed for human use and includes items like chairs, tables, beds, and storage units. ', '2023-10-12 09:30:21', NULL),
(19, 'Containers', '', '2023-10-12 09:54:15', NULL),
(20, 'Personal Care', '', '2023-10-12 09:57:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`, `productName`) VALUES
(28, 30, '42', 1, '2023-10-13 10:01:56', 'COD', 'Delivered', 'Marrs Green Baby Wipes'),
(29, 30, '38', 1, '2023-10-16 14:47:20', 'COD', 'Delivered', 'Monobloc Chair, White'),
(30, 30, '41', 1, '2023-11-09 15:52:39', 'COD', 'Delivered', 'Astron Electric Dry Iron'),
(31, 30, '47', 1, '2023-11-09 15:52:39', 'COD', 'Delivered', 'Bengar PlasticWare'),
(32, 30, '41', 1, '2023-11-09 15:52:52', 'COD', 'Delivered', 'Astron Electric Dry Iron'),
(33, 30, '47', 1, '2023-11-09 15:52:52', 'COD', 'Delivered', 'Bengar PlasticWare'),
(34, 30, '41', 1, '2023-11-09 15:53:46', 'COD', 'Delivered', 'Astron Electric Dry Iron'),
(35, 30, '47', 1, '2023-11-09 15:53:46', 'COD', 'Delivered', 'Bengar PlasticWare'),
(36, 30, '47', 1, '2023-11-09 16:21:01', 'COD', 'Delivered', 'Bengar PlasticWare'),
(37, 26, '49', 4, '2023-11-11 13:33:01', 'COD', 'Delivered', 'Jose Lock Security Padlock 50mm'),
(38, 26, '41', 1, '2023-11-11 13:37:21', 'COD', 'Delivered', 'Astron Electric Dry Iron'),
(39, 26, '39', 1, '2023-11-11 13:49:43', 'COD', 'Delivered', 'Pail/Timba with Metal Handle'),
(40, 26, '43', 1, '2023-11-11 13:49:43', 'COD', 'Delivered', 'Mianpinyihao Alcohol Wet Wipes'),
(41, 26, '51', 1, '2023-11-11 13:49:43', 'COD', 'Delivered', 'Astron Super Washing Machine');

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(8, 16, 'Delivered', 'bahay mo na lods', '2023-09-20 16:32:28'),
(9, 20, 'Delivered', 'Done', '2023-10-07 11:44:25'),
(10, 17, 'Delivered', 'Done\r\n', '2023-10-08 16:46:35'),
(11, 27, 'Delivered', 'Done', '2023-10-12 10:42:53'),
(12, 30, 'in Process', 'malapit na', '2023-11-09 16:22:23'),
(13, 28, 'Delivered', 'Done\r\n', '2023-11-11 13:33:24'),
(14, 29, 'Delivered', 'Done', '2023-11-11 13:33:33'),
(15, 30, 'Delivered', 'Done', '2023-11-11 13:33:59'),
(16, 34, 'Delivered', 'Done', '2023-11-11 13:34:08'),
(17, 31, 'Delivered', 'fdf', '2023-11-11 13:35:56'),
(18, 37, 'Delivered', '22', '2023-11-11 13:36:07'),
(19, 35, 'Delivered', 'f', '2023-11-11 13:36:52'),
(20, 38, 'Delivered', 'asdasd', '2023-11-11 13:37:49'),
(21, 32, 'Delivered', 'kjjk', '2023-11-11 13:39:05'),
(22, 33, 'Delivered', 'qweqwe', '2023-11-11 13:50:01'),
(23, 36, 'Delivered', 'asdasd', '2023-11-11 13:50:10'),
(24, 39, 'Delivered', 'asd', '2023-11-11 13:50:27'),
(25, 41, 'Delivered', 'ww', '2023-11-11 13:50:41'),
(26, 40, 'Delivered', 'awe', '2023-11-11 13:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(5, 33, 4, 4, 4, 'Paolo', 'asd', 'asd', '2023-09-23 15:07:55'),
(6, 33, 4, 5, 5, 'asdas', 'asdas', 'asd', '2023-09-23 15:08:13'),
(7, 32, 5, 5, 5, 'sd', 'sdsd', 'ds', '2023-09-23 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`, `quantity`) VALUES
(37, 18, 18, 'Monobloc Chair', 'Sampaguita Ware', 279, 300, '<div class=\"dR8kXc\" style=\"display: flex; margin-bottom: 1.125rem; font-size: 14px;\"><font color=\"#555555\" style=\"background-color: initial; cursor: pointer;\"><span style=\"color: rgba(0, 0, 0, 0.4); font-family: &quot;Open Sans&quot;, Tahoma, Arial, sans-serif; font-size: 0.875rem; text-wrap: nowrap;\">Warranty Duration&nbsp; &nbsp;&nbsp;</span><span style=\"color: rgba(0, 0, 0, 0.8);\">No Warranty</span></font></div><div class=\"dR8kXc\" style=\"display: flex; margin-bottom: 1.125rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px;\"><label class=\"zquA4o eqeCX7\" style=\"color: rgba(0, 0, 0, 0.4); font-size: 0.875rem; box-sizing: border-box; width: 8.75rem; padding-right: 0.75rem; text-overflow: ellipsis; overflow: hidden; text-wrap: nowrap;\">Warranty Type</label><div>No Warranty</div></div><div class=\"dR8kXc\" style=\"display: flex; margin-bottom: 1.125rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px;\"><label class=\"zquA4o eqeCX7\" style=\"color: rgba(0, 0, 0, 0.4); font-size: 0.875rem; box-sizing: border-box; width: 8.75rem; padding-right: 0.75rem; text-overflow: ellipsis; overflow: hidden; text-wrap: nowrap;\">Assembly</label><div>Fully Assembled</div></div><div class=\"dR8kXc\" style=\"display: flex; margin-bottom: 1.125rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px;\"><label class=\"zquA4o eqeCX7\" style=\"color: rgba(0, 0, 0, 0.4); font-size: 0.875rem; box-sizing: border-box; width: 8.75rem; padding-right: 0.75rem; text-overflow: ellipsis; overflow: hidden; text-wrap: nowrap;\">Antique Collection</label><div>No</div></div><div class=\"dR8kXc\" style=\"display: flex; margin-bottom: 1.125rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px;\"><label class=\"zquA4o eqeCX7\" style=\"color: rgba(0, 0, 0, 0.4); font-size: 0.875rem; box-sizing: border-box; width: 8.75rem; padding-right: 0.75rem; text-overflow: ellipsis; overflow: hidden; text-wrap: nowrap;\">Material</label><div>Plastic</div></div>', 'monobloc1.jpg', 'monobloc2.jpg', 'monobloc3.jpg', 25, 'In Stock', '2023-10-12 09:38:30', NULL, 120),
(38, 18, 18, 'Monobloc Chair, White', 'Imara', 250, 350, '<span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">ORDERS:\r\nMINIMUM:  1 PIECE\r\nMAXIMUM:  3PCS ONLY\r\n\r\n ?? ITEMS MORE THAN 2 PCS CANNOT BE ACCEPTED FOR THE SECURITY OF ITEM ??\r\n?? YOU CAN PLACE ANOTHER ORDER FOR ANOTHER QUANTITY</span><br>', 'whitechair1.jpg', 'whitechair2.jpg', 'whitechair3.jpg', 25, 'In Stock', '2023-10-12 09:48:21', NULL, 649),
(39, 19, 19, 'Pail/Timba with Metal Handle', 'Amigo', 220, 220, '<br>', 'blue timba1.jpg', 'blue timba2.jpg', 'blue timba3.jpg', 20, 'In Stock', '2023-10-12 09:56:47', NULL, 101),
(40, 20, 20, '400ML, Extra Firming Body Lotion', 'NIVEA', 130, 135, '<span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Niv-ea body extra whitening , a daily moisturiser that gives you naturally fairer skin and a more even tone. The formula is especially developed to written skin and prevent dullness caused by frequent sun exposure .\r\nEffectively whitens and repairs skin , leaving it smooth and naturally fairer.\r\nReduced discoloration and blemishes for a more even skin tone \r\nProtects skin darkening caused by UVA/UVB rays .</span><br>', 'Picture9.jpg', 'Picture10.jpg', 'Picture11.jpg', 10, 'In Stock', '2023-10-12 10:00:38', NULL, 50),
(41, 9, 21, 'Astron Electric Dry Iron', 'Astron', 499, 499, '<p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">-Electric flat iron (PFI-1324P)</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">-Fast heating (1200W | 230V AC | 60Hz)</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">-Variable temperature settings: nylon | silk | wool | cotton | linen</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">-Non-stick soleplate</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">-Iron dimensions: 9.4 x 4.9&nbsp;inches | soleplate: 3.9 inches</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">-Plansta</p>', 'Picture14.jpg', 'Picture13.jpg', 'Picture12.jpg', 15, 'In Stock', '2023-10-12 10:04:45', NULL, 46),
(42, 20, 22, 'Marrs Green Baby Wipes', 'Marrs Green', 45, 45, '<p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">• Made of cottony soft and thick material.</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">\r\n</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">• Specially formulated to be mild and gentle on your baby’s delicate skin.</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">\r\n</p><p class=\"irIKAp\" style=\"margin-bottom: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, ?????, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;?? Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, ?????, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">• For babies: Keep baby fresh and clean. Use at changing time, playtime, at home or on the go.</p>', 'Picture15.jpg', 'Picture16.jpg', 'Picture17.jpg', 5, 'In Stock', '2023-10-12 10:08:21', NULL, 154),
(43, 20, 22, 'Mianpinyihao Alcohol Wet Wipes', 'Mianpinyihao', 15, 15, '<br>', 'Picture18.jpg', 'Picture19.jpg', 'Picture20.jpg', 5, 'In Stock', '2023-10-12 10:19:10', NULL, 54),
(44, 20, 22, 'Masaya Wet Wipes', 'Masaya', 12, 15, '<p class=\"MsoNormal\"><b><span lang=\"EN-US\" style=\"font-size:16.0pt;line-height:107%\">100% Pure Water Wet Wipes<o:p></o:p></span></b></p>', 'Picture21.jpg', 'Picture22.jpg', 'Picture23.jpg', 5, 'In Stock', '2023-10-12 10:21:18', NULL, 66),
(45, 20, 23, 'Masaya: Cotton Swab/Buds', 'Masaya', 39, 40, 'Masata Sample', 'Picture24.jpg', 'Picture25.jpg', 'Picture26.jpg', 5, 'In Stock', '2023-10-12 11:04:38', NULL, 210),
(46, 19, 24, 'Aqua Water Pitcher Lightgreen', 'Aqua', 55, 60, '<br>', '368755636_3598643093746962_1837036531475853224_n.jpg', '387563145_1350874722184922_4398656950329251510_n.jpg', '368555838_543962541248136_5041723370159229086_n.jpg', 10, 'In Stock', '2023-10-12 11:25:48', NULL, 53),
(47, 16, 25, 'Bengar PlasticWare', 'Bengar', 45, 50, '<br>', '368581732_6674708712584437_5635437163981268846_n.jpg', '387499713_157096324140905_2740647824909054905_n.jpg', '368154258_758297629392042_558987756845955685_n.jpg', 5, 'In Stock', '2023-10-12 11:27:45', NULL, 128),
(48, 19, 24, 'Bio Drink 12 Liter - Water Jug | Insulated Product', 'Bio Drink', 320, 330, '<br>', '387589604_1043446610173719_964795653490198652_n.jpg', '387543633_711827447457135_7965252628799184561_n.jpg', '387448147_1318821205425425_1796948236195639728_n.jpg', 10, 'In Stock', '2023-10-12 11:30:27', NULL, 40),
(49, 15, 26, 'Jose Lock Security Padlock 50mm', 'Jose Lock', 73, 75, '<br>', '387493907_3200076726962273_6181049586837102771_n.jpg', '387471020_264974349330679_7286048978011922452_n.jpg', '387506759_704694808360338_7183619388951216629_n.jpg', 5, 'In Stock', '2023-10-12 11:33:11', NULL, 76),
(51, 9, 21, 'Astron Super Washing Machine', 'Astron', 3699, 4000, '<br>', '387554944_1331305307757967_7793769949777010181_n.jpg', '387610590_1489517798499230_5186930654559847379_n.jpg', '387588540_318261160810084_2774487019940469885_n.jpg', 40, 'In Stock', '2023-10-13 09:58:37', NULL, 19),
(59, 14, 17, 'Monggol Pencil 2', 'Monggol', 7, 9, 'Monggol Pencil', 'monggol.jpg', 'monggol3.jpg', 'monggole2.jpg', 5, 'In Stock', '2023-11-13 09:15:08', NULL, 99),
(60, 15, 27, 'King Ever Extra Duty Battery', 'King Ever', 35, 40, 'Battery Long Lasting', '387463545_7301181776561890_1481318703344926524_n.jpg', '387477743_346248377872088_300870102348897745_n.jpg', '387532590_1532064547618590_4342740103634774816_n.jpg', 5, 'In Stock', '2023-11-13 09:52:21', NULL, 20);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(14, 8, 'Shoes', '2023-09-11 13:12:14', NULL),
(15, 8, 'Clothes', '2023-09-11 13:12:23', NULL),
(16, 9, 'Kitchen', '2023-09-12 01:52:08', NULL),
(17, 14, 'Pens', '2023-09-30 12:25:31', NULL),
(18, 18, 'Chairs', '2023-10-12 09:30:57', NULL),
(19, 19, 'Buckets', '2023-10-12 09:54:24', NULL),
(20, 20, 'Skin Care Products', '2023-10-12 09:57:59', NULL),
(21, 9, 'Household Appliances', '2023-10-12 10:02:24', NULL),
(22, 20, 'Wipes', '2023-10-12 10:05:12', NULL),
(23, 20, 'Hygiene Tools', '2023-10-12 10:24:45', NULL),
(24, 19, 'Water Pitcher and Jug', '2023-10-12 11:24:48', NULL),
(25, 16, 'PlasticWare', '2023-10-12 11:26:36', NULL),
(26, 15, 'Padlocks', '2023-10-12 11:31:10', NULL),
(27, 15, 'Battery', '2023-11-13 09:50:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(25, 'papa@pao.com', 0x3a3a3100000000000000000000000000, '2023-09-08 03:17:46', '08-09-2023 08:48:22 AM', 1),
(74, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-07 11:30:47', '07-10-2023 05:00:49 PM', 1),
(75, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-07 11:31:18', '07-10-2023 05:01:22 PM', 1),
(76, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-07 11:31:41', '07-10-2023 05:01:44 PM', 1),
(77, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-07 11:38:03', '07-10-2023 05:09:21 PM', 1),
(78, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-07 11:49:43', '07-10-2023 05:23:30 PM', 1),
(81, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-08 16:53:03', NULL, 1),
(82, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-09 04:51:20', '09-10-2023 10:29:25 AM', 1),
(83, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-09 05:05:17', NULL, 1),
(84, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-09 15:47:50', '09-10-2023 10:14:20 PM', 1),
(85, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-09 16:49:36', '09-10-2023 10:20:43 PM', 1),
(86, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-09 16:51:12', '09-10-2023 10:21:50 PM', 1),
(87, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-12 10:35:43', '12-10-2023 04:05:59 PM', 1),
(88, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-12 10:36:08', '12-10-2023 04:06:53 PM', 1),
(89, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-12 10:37:03', '12-10-2023 04:07:48 PM', 1),
(90, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-12 10:37:54', '12-10-2023 04:32:23 PM', 1),
(91, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-13 10:01:40', '13-10-2023 03:34:07 PM', 1),
(92, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-13 10:05:04', NULL, 1),
(93, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-16 14:46:08', '16-10-2023 08:33:47 PM', 1),
(94, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-10-16 15:12:55', NULL, 1),
(95, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 13:55:04', '08-11-2023 07:25:58 PM', 1),
(96, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 13:56:04', '08-11-2023 07:53:01 PM', 1),
(97, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 14:23:05', '08-11-2023 08:23:42 PM', 1),
(98, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 14:53:47', NULL, 0),
(99, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 14:53:57', '08-11-2023 08:42:14 PM', 1),
(100, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 15:12:20', '08-11-2023 08:51:43 PM', 1),
(101, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 15:21:51', '08-11-2023 08:54:17 PM', 1),
(102, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-08 15:24:24', NULL, 1),
(103, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-09 14:00:11', NULL, 0),
(104, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-09 14:00:26', NULL, 1),
(105, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-09 15:52:02', NULL, 0),
(106, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-09 15:52:09', NULL, 0),
(107, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-09 15:52:15', NULL, 0),
(108, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-09 15:52:23', NULL, 1),
(109, 'paolocutie@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-11 13:03:13', '11-11-2023 07:49:43 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`, `user_id`) VALUES
(-996, 'Test3@gmail.com', 'Test3@gmail.com', 639128739450, '$2y$10$ZxznFdZX8rHBUoM8ZDWOJOs0CFOfHPK4TyLhwUTcZsBXm7UGHRc2C', NULL, NULL, NULL, NULL, '155 sinco de septembre st.  Navatat', 'Navatat', 'Basista', 2422, '2023-10-07 12:06:30', NULL, '23-988--996'),
(0, 'Sample Id', 'test@gmail.com', 639128739450, '$2y$10$tYdW6AbMbM5dnzm2kXct6O0VYsMzraFr/aw/FBiT8H4ZIBOQSynLS', NULL, NULL, NULL, NULL, '155 sinco de septembre st.  Navatat', 'Navatat', 'Basista', 2422, '2023-10-07 11:49:32', NULL, '23-988-0'),
(23, 'Test2', 'Test2@gmail.com', 639128739450, '$2y$10$QBoSdghFciJnGc3r3bLpROvDi8iFL0AT20R9QJSGnwLJsljmbmQca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-07 11:55:50', NULL, '23-988-23'),
(26, 'papapogs010', 'papa@gmail.com', 639128739450, '8eb632839d061b4d886e705ee0424e3f', '155 sinco de septembre st.  Navatat\r\nOsmena', 'Navatat', 'Basista', 2422, '155 sinco de septembre st.  Navatat\r\nOsmena', 'Pangasinan', 'Basista', 2422, '2023-09-26 13:16:50', NULL, '23-988-26'),
(28, 'Vlaudemer Sarmiento', 'svlaudemer@gmail.com', 639128739450, 'ab7bbcd3e11f5d2e653979e2ca4b66db', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-26 13:43:57', NULL, '23-988-28'),
(29, 'John Paolo F Badiang', 'paolofrias62@gmail.com', 639128739450, 'ab7bbcd3e11f5d2e653979e2ca4b66db', NULL, NULL, NULL, NULL, '155 sinco de septembre st.  Navatat', 'Navatat', 'Basista', 2422, '2023-09-30 12:38:21', NULL, '23-988-29'),
(30, 'John Paolo Frias', 'paolocutie@gmail.com', 639128739450, '$2y$10$eC/pf.MyitPNnMB8b8.dGO2f52u2U.m.4vfjQr0T.D.KA41Sc6qCq', NULL, NULL, NULL, NULL, '155 sinco de septembre st.  Navatat\r\n', 'Navatat', 'Basista', 2422, '2023-10-07 11:14:07', '08-11-2023 08:54:12 PM', '23-988-30'),
(32, 'Test4', 'Test4@gmail.com', 639128739450, '$2y$10$U7EgKXPMCELb0gYxB6Y3u.wqVWKrVS2Zn7FfQjIaJ6G8DlnWujI9q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-07 12:14:36', NULL, '23-988-32');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(1, 1, 0, '2017-02-27 18:53:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
