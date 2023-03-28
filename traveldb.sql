-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2023 at 10:31 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `authusers`
--

DROP TABLE IF EXISTS `authusers`;
CREATE TABLE IF NOT EXISTS `authusers` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL DEFAULT 'creator',
  `description` text,
  `status` varchar(25) NOT NULL DEFAULT 'active',
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` varchar(255) NOT NULL DEFAULT ' http://localhost/travelblog/img/avatar.jpg',
  `facebook` varchar(255) DEFAULT ' ',
  `instagram` varchar(255) DEFAULT ' ',
  `twitter` varchar(255) DEFAULT ' ',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `password` (`password`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authusers`
--

INSERT INTO `authusers` (`firstname`, `lastname`, `email`, `password`, `role`, `description`, `status`, `userid`, `created`, `picture`, `facebook`, `instagram`, `twitter`) VALUES
('okeowo', 'micheal', 'info@fileac.com', '$2y$10$ZtMT.9MGvOi9.ezc/C7hguJsuExtF1Yk5JGtIxDKMzUhn0/1AE7xe', 'creator', 'info@fileac.cominfo@fileac.cominfo@fileac.cominfo@fileac.com', 'active', 1, '2023-03-15 19:47:21', 'http://localhost/travelblog/profile/64143a4aab5ce_11.png', ' www.facebook.com', '  www.instagram.com', ' '),
('okeowo', 'micheal', 'okeowo1014@gmail.com', '$2y$10$ngvdv9GQRxEXWGyz3cdNduOu948ynJmon.Bu40Bte.Hozggfg.pn2', 'administrator', '', 'active', 2, '2023-03-17 14:17:47', 'http://localhost/travelblog/profile/64148765ede41_12.png', ' www.facebook.com', '  www.instagram.com', ' '),
('okeowo', 'clinton', 'ezunsonayon507@gmail.com', '$2y$10$hR7seL2hKZwA2gCb9rg6ZeLqS17iIHI9SMRfLaW0RuoLK1IUACElW', 'creator', NULL, 'active', 5, '2023-03-17 20:07:09', ' http://localhost/travelblog/img/avatar.jpg', ' ', ' ', ' '),
('okeowo', 'clinton', 'moyus@me.com', '$2y$10$yC0bdQiKUgRVzboKSDXMkOkQkwSWQ6qY.ot.w9jg19zb5Zna2UaxC', 'creator', 'thanks for your post', 'active', 6, '2023-03-17 20:10:26', 'http://localhost/travelblog/profile/6414ca6b9d5bc_author.png', ' www.facebook.com', '  www.instagram.com', ' www.twitter'),
('okeowo', 'micheal', 'moyusadmin@me.com', '$2y$10$8RgIZ7F8o6AFXKZ5XNlRSej0WyWYPN3vS/Epse37AZfEnjjA5Znz2', 'administrator', '', 'active', 7, '2023-03-17 20:17:51', 'http://localhost/travelblog/profile/6414cb507262a_author.png', ' www.facebook.com', '  www.instagram.com', ' www.twitter');

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

DROP TABLE IF EXISTS `blogpost`;
CREATE TABLE IF NOT EXISTS `blogpost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'lagos',
  `views` int(11) NOT NULL DEFAULT '0',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogpost`
--

INSERT INTO `blogpost` (`id`, `creator`, `title`, `main_image`, `content`, `category`, `location`, `views`, `blocked`, `created`) VALUES
(1, 1, 'title 2', 'http://localhost/travelblog/mainimages/6411732d3980c_LG23002522.jpg', '<p>thnaks</p><p>so much</p>', 'cities', 'lagos', 3, 0, '2023-03-15 07:31:28'),
(6, 1, 'title', 'http://localhost/travelblog/mainimages/64117e766bfa3_LG23003162.jpg', '<p>hello</p><p>how are you dear</p>', 'beaches', 'lagos', 1, 0, '2023-03-15 08:14:46'),
(8, 1, 'addes', 'http://localhost/travelblog/mainimages/6414bdfd576f5_post_2.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra tempor rhoncus. Integer iaculis augue metus, eget luctus ex tristique sed. Suspendisse egestas lacinia magna et rutrum. Nunc vel est vel augue mollis gravida. Aenean hendrerit felis a suscipit accumsan. Pellentesque mi metus, condimentum quis maximus eu, ornare dapibus elit. Sed sit amet tellus in lacus euismod efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra tempor rhoncus.</p><p><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra tempor rhoncus. Integer iaculis augue metus, eget luctus ex tristique sed. Suspendisse egestas lacinia magna et rutrum. Nunc vel est vel augue mollis gravida. Aenean hendrerit felis a suscipit accumsan. Pellentesque mi metus, condimentum quis maximus eu, ornare dapibus elit. Sed sit amet tellus in lacus euismod efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra tempor rhoncus.</p><p><br>&nbsp;</p>', 'mountains', 'lagos', 3, 1, '2023-03-15 15:05:14'),
(11, 6, 'temidire', 'http://localhost/travelblog/mainimages/6414ca926d952_single_blog_1.png', '<h2>i thank god</h2>', 'cities', 'new york', 1, 0, '2023-03-17 20:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postid`, `comment`, `name`, `email`, `created`) VALUES
(1, 1, 'hhhwhhwheheheehehehe', 'wjwjwjwjw wjwjwjwjwjwjwjw', 'moyus@me.com', '2023-03-16 21:29:16'),
(2, 1, 'kfkfkgkgkgkgkgk', 'okeowo', 'moyus@me.com', '2023-03-16 21:30:20'),
(3, 8, 'is good', 'ibadan', 'moyus@me.com', '2023-03-17 20:05:30'),
(4, 11, 'thanks for the post', 'okeowo', 'moyus@me.com', '2023-03-18 11:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `subject`, `message`, `name`, `email`, `created`) VALUES
(1, 'so much', 'kfkkkff\r\n', 'eeekekeke', 'clinton@gmail.com', '2023-03-16 22:07:32'),
(2, 'so much', 'i neee help', 'okeowo', 'clinton@gmail.com', '2023-03-17 20:04:36'),
(3, 'so much', 'rrrbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbw', 'okeowo', 'info@fileac.com', '2023-03-18 12:55:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
