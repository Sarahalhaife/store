-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 أكتوبر 2020 الساعة 17:45
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `prodect`
--

CREATE TABLE IF NOT EXISTS `prodect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(150) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=22 ;

--
-- إرجاع أو استيراد بيانات الجدول `prodect`
--

INSERT INTO `prodect` (`id`, `price`, `img`, `date`, `name`, `active`, `user_id`) VALUES
(15, 60, '69_item-3.jpg', '2020-09-23 07:32:17', 'Boot		\r\n			', 1, 60),
(16, 180, '19_item-9.jpg', '2020-09-23 07:32:48', 'Cuot			\r\n			', 1, 62),
(17, 45, '7628_creaslim-0QDEj5dnUMk-unsplash.jpg', '2020-09-23 18:32:22', 'Black Jeans				', 1, 61),
(18, 20, '3778_item-6.jpg', '2020-09-23 18:43:51', 'T-shirt White		\r\n			', 1, 61),
(19, 75, '7822_item-5.jpg', '2020-09-23 18:55:10', 'T-shirt and Skirt', 1, 61),
(20, 34, '9845_blog-1.jpg', '2020-09-23 18:57:55', 'Cardigan', 1, 61),
(21, 90, '9537_person2.jpg', '2020-09-23 18:59:09', 'Leather Jacket', 1, 61);

-- --------------------------------------------------------

--
-- بنية الجدول `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `permission` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=72 ;

--
-- إرجاع أو استيراد بيانات الجدول `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `mobile`, `address`, `email`, `permission`, `active`) VALUES
(60, 'ahed', '$2y$10$YOpjALvizUPyJt4VnuQwJOED6CXkizCVSZmF84We4nmyFiepdEfIm', 773041758, 'sanaa', 'ahed@gamil.com', 1, 1),
(61, 'ali', '$2y$10$G78yh7kFkt6mW2Pmf162.eL5l/DVvJb1qPFFrt7MD8FCx41MTIWF2', 775001525, 'sanaa', 'ali@gamil.com', 1, 1),
(62, 'mohammad', '$2y$10$zjeLgPFZNS2H.y8wt.4kGOXr.b.XM24jsDVQMWncd2LEWTnRSIX6u', 774865449, 'sanaa', 'mohammad@gamil.com', 1, 1),
(63, 'Diaa', '$2y$10$eD52/I5NsEB9fJl.3xsJNuh9SvpUb4CUFOu/wdrglj8mFaqW/S7XW', 2147483647, 'sanaa', 'Diaa@gamil.com', 0, 1),
(68, 'Ahmed', '$2y$10$FlYLbeKIz2BkN50eSO8uMeAhSA4RqtnBDllWlSXKWtjSGe80vMG5e', 7777777, '60sth', 'ahmed@gamil.com', 0, 1),
(69, 'Ali2', '$2y$10$aJM2qSO/NzVdEuSEcE8zhe.oY2SKauGRGkfFTL9YtmCph7PzO79nq', NULL, '', 'ali2@email', 0, 1),
(71, 'dd', '$2y$10$HCcmkAt6R.a5jz6blRgMvu2f9x8v8qZgoSIVwX9mhf3HChXKe74cG', NULL, '', '', 0, 1);

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `prodect`
--
ALTER TABLE `prodect`
  ADD CONSTRAINT `prodect_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
