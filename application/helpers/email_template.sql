-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2022 at 02:57 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleekmart_maindb`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `email_title`, `email_subject`, `email_body`, `created_at`) VALUES
(2, 'Cancel Order Email', 'Your Booking has been cancelled', '<table style=\"width: 100%!important;\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px!important; text-align: center; margin: 0 auto; background-color: #0a0909;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%; text-align: left; padding-top: 5px;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"site_url\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none;\" src=\"site_logo\" alt=\"\" border=\"0\" /> </a></td>\r\n<td style=\"width: 60%; text-align: right; padding-top: 5px;\">\r\n<p style=\"color: #ffffff; font-family: Arial; font-size: 16px; text-align: right; font-style: normal; font-stretch: normal;\">Order:&nbsp;<span style=\"font-weight: bold;\">Cancelled</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\">\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px; background-color: #fff; padding-top: 20px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" align=\"left\">\r\n<table border=\"0\" width=\"350\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 12px; font-weight: normal; font-style: normal; font-stretch: normal; margin-top: 0px; line-height: 14px; padding-top: 0px; margin-bottom: 7px;\">Hi <span style=\"font-weight: bold; color: #191919;\"> {USER_NAME},</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; color: #878787; line-height: 14px; padding-top: 0px; margin-top: 0px; margin-bottom: 7px;\">Your Order has been Cancelled.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\" width=\"250\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 11px; font-weight: normal; text-align: right; font-style: normal; line-height: 14px; font-stretch: normal; margin-top: 0px; padding-top: 0px; margin-bottom: 7px;\">Order placed on <span style=\"font-weight: bold; color: #000;\">{ORDER_DATE}</span></p>\r\n<p style=\"font-family: Arial; font-size: 11px; color: #878787; line-height: 14px; text-align: right; padding-top: 0px; margin-top: 0; margin-bottom: 7px;\">Order ID <span style=\"font-weight: bold; color: #000;\">{ORDER_ID}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" style=\"background-color: rgba(245,245,245,0.5); background: rgba(245,245,245,0.5); border: .08em solid #6ed49e; border-radius: 2px; padding-top: 20px; padding-bottom: 20px;\" align=\"left\">\r\n<table style=\"margin-bottom: 20px; padding-left: 15px;\" border=\"0\" width=\"360\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-bottom: 20px; margin-top: 0px;\"><span style=\"display: inline-block; width: 125px; min-width: 125px; max-width: 125px;\">Amount</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{AMOUNT_PAID} </span></p>\r\n<p style=\"margin-bottom: 0px; margin-top: 0;\"><a style=\"background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;\" href=\"{MANAGE_ORDER}\" target=\"_blank\" rel=\"noopener noreferrer\">Manage Your Order</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin-bottom: 30px; padding-right: 15px;\" border=\"0\" width=\"225\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<div style=\"max-width: 220px; padding-top: 0px; margin-bottom: 20px;\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 20px; color: #212121; margin-top: 0px; margin-bottom: 4px;\">Order Details</p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\">{USER_NAME} <br /> <span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\"> {USER_EMAIL} </span></p>\r\n</div>\r\n<p style=\"line-height: 1.56; margin-top: 0; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 14px; font-weight: bold; text-align: left; color: #212121; display: block; line-height: 20px; margin-bottom: 4px;\">SMS updates sent to</span> <span style=\"font-family: Arial; font-size: 12px; color: #212121;\">{USER_PHONE}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"padding-left: 15px; padding-right: 15px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; text-align: left; color: #212121; padding-top: 0px; padding-bottom: 0px; line-height: 19px; margin-top: 0; margin-bottom: 0;\">You will receive the next update when the item in your order is packed/shipped by the seller.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin-top: 0px;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #f0f0f0; font-size: 0px; line-height: 0px;\" bgcolor=\"#f0f0f0\" height=\"1\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"background-color: #fff; width: 642px; max-width: 642px; padding: 0px 20px 0px 20px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>{PRODUCTS_DETAILS}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 642px; max-width: 642px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin: 0; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"color: #212121; display: block; margin: 0 auto; clear: both;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; display: block;\" align=\"left\" valign=\"top\">\r\n<table style=\"margin-bottom: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"40%\">&nbsp;</td>\r\n<td align=\"right\" width=\"34%\">\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; line-height: 14px; padding-top: 0px; margin-bottom: 0;\"><span style=\"color: #212121; text-align: right; font-weight: bold;\">Amount</span></p>\r\n</td>\r\n<td>\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; padding-top: 0px; margin-bottom: 0;\"><span style=\"padding-right: 0px; font-weight: bold;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 640px; max-width: 640px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr class=\"m_-4345841705994091849col\" style=\"color: #212121;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; border-bottom: 1px solid #f0f0f0;\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 1.86; color: #212121;\">Thank you for Order with {STORE_NAME}!</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; margin-top: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 60%; text-align: left;\">&nbsp;</td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{APP_LINK}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{AND_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{IOS_APP}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{IOS_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"margin: 0 auto; width: 600px; max-width: 600px; margin-top: 4px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style=\"font-family: Arial; font-size: 10px; color: #878787;\">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2022-06-27 14:56:55'),
(3, 'Place order Email Template', 'Your Order has been successfully placed', '<table style=\"width: 100%!important;\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px!important; text-align: center; margin: 0 auto; background-color: #0a0909;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%; text-align: left; padding-top: 5px;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"site_url\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none;\" src=\"site_logo\" alt=\"\" border=\"0\" /> </a></td>\r\n<td style=\"width: 60%; text-align: right; padding-top: 5px;\">\r\n<p style=\"color: #ffffff; font-family: Arial; font-size: 16px; text-align: right; font-style: normal; font-stretch: normal;\">Order:&nbsp;<span style=\"font-weight: bold;\">Placed</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\">\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px; background-color: #fff; padding-top: 20px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" align=\"left\">\r\n<table border=\"0\" width=\"350\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 12px; font-weight: normal; font-style: normal; font-stretch: normal; margin-top: 0px; line-height: 14px; padding-top: 0px; margin-bottom: 7px;\">Hi <span style=\"font-weight: bold; color: #191919;\"> {USER_NAME},</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; color: #878787; line-height: 14px; padding-top: 0px; margin-top: 0px; margin-bottom: 7px;\">Your Order has been successfully placed.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\" width=\"250\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 11px; font-weight: normal; text-align: right; font-style: normal; line-height: 14px; font-stretch: normal; margin-top: 0px; padding-top: 0px; margin-bottom: 7px;\">Order placed on <span style=\"font-weight: bold; color: #000;\">{ORDER_DATE}</span></p>\r\n<p style=\"font-family: Arial; font-size: 11px; color: #878787; line-height: 14px; text-align: right; padding-top: 0px; margin-top: 0; margin-bottom: 7px;\">Order ID <span style=\"font-weight: bold; color: #000;\">{ORDER_ID}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" style=\"background-color: rgba(245,245,245,0.5); background: rgba(245,245,245,0.5); border: .08em solid #6ed49e; border-radius: 2px; padding-top: 20px; padding-bottom: 20px;\" align=\"left\">\r\n<table style=\"margin-bottom: 20px; padding-left: 15px;\" border=\"0\" width=\"360\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-bottom: 20px; margin-top: 0px;\"><span style=\"display: inline-block; width: 125px; min-width: 125px; max-width: 125px;\">Amount</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{AMOUNT_PAID} </span></p>\r\n<p style=\"margin-bottom: 0px; margin-top: 0;\"><a style=\"background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;\" href=\"{MANAGE_ORDER}\" target=\"_blank\" rel=\"noopener noreferrer\">Manage Your Order</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin-bottom: 30px; padding-right: 15px;\" border=\"0\" width=\"225\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<div style=\"max-width: 220px; padding-top: 0px; margin-bottom: 20px;\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 20px; color: #212121; margin-top: 0px; margin-bottom: 4px;\">Order Details</p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\">{USER_NAME} <br /> <span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\"> {USER_EMAIL} </span></p>\r\n</div>\r\n<p style=\"line-height: 1.56; margin-top: 0; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 14px; font-weight: bold; text-align: left; color: #212121; display: block; line-height: 20px; margin-bottom: 4px;\">SMS updates sent to</span> <span style=\"font-family: Arial; font-size: 12px; color: #212121;\">{USER_PHONE}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"padding-left: 15px; padding-right: 15px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; text-align: left; color: #212121; padding-top: 0px; padding-bottom: 0px; line-height: 19px; margin-top: 0; margin-bottom: 0;\">Thank you for your Order. We will send a confirmation when your order status update by our partners.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin-top: 0px;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #f0f0f0; font-size: 0px; line-height: 0px;\" bgcolor=\"#f0f0f0\" height=\"1\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"background-color: #fff; width: 642px; max-width: 642px; padding: 0px 20px 0px 20px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>{PRODUCTS_DETAILS}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 642px; max-width: 642px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin: 0; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"color: #212121; display: block; margin: 0 auto; clear: both;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; display: block;\" align=\"left\" valign=\"top\">\r\n<table style=\"margin-bottom: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"40%\">&nbsp;</td>\r\n<td align=\"right\" width=\"34%\">\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; line-height: 14px; padding-top: 0px; margin-bottom: 0;\"><span style=\"color: #212121; text-align: right; font-weight: bold;\">Amount</span></p>\r\n</td>\r\n<td>\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; padding-top: 0px; margin-bottom: 0;\"><span style=\"padding-right: 0px; font-weight: bold;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 640px; max-width: 640px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr class=\"m_-4345841705994091849col\" style=\"color: #212121;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; border-bottom: 1px solid #f0f0f0;\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 1.86; color: #212121;\">Thank you for Order with {STORE_NAME}!</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; margin-top: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 60%; text-align: left;\">&nbsp;</td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{APP_LINK}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{AND_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{IOS_APP}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{IOS_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"margin: 0 auto; width: 600px; max-width: 600px; margin-top: 4px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style=\"font-family: Arial; font-size: 10px; color: #878787;\">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2022-06-27 14:44:37'),
(4, 'Return Order Email ', 'Return Order Email ', '<p>&nbsp;Return Order Email&nbsp;</p>', '2021-03-14 07:55:07'),
(5, 'Order Delivered', 'Your order has been delivered', '<table style=\"width: 100%!important;\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px!important; text-align: center; margin: 0 auto; background-color: #0a0909;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%; text-align: left; padding-top: 5px;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"site_url\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none;\" src=\"site_logo\" alt=\"\" border=\"0\" /> </a></td>\r\n<td style=\"width: 60%; text-align: right; padding-top: 5px;\">\r\n<p style=\"color: #ffffff; font-family: Arial; font-size: 16px; text-align: right; font-style: normal; font-stretch: normal;\">Order:&nbsp;<span style=\"font-weight: bold;\">Delivered</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#f5f5f5\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\">\r\n<table style=\"width: 640px; max-width: 640px; padding-right: 20px; padding-left: 20px; background-color: #fff; padding-top: 20px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" align=\"left\">\r\n<table border=\"0\" width=\"350\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 12px; font-weight: normal; font-style: normal; font-stretch: normal; margin-top: 0px; line-height: 14px; padding-top: 0px; margin-bottom: 7px;\">Hi <span style=\"font-weight: bold; color: #191919;\"> {USER_NAME},</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; color: #878787; line-height: 14px; padding-top: 0px; margin-top: 0px; margin-bottom: 7px;\">Your Order has been successfully delivered.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\" width=\"250\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; color: #878787; font-size: 11px; font-weight: normal; text-align: right; font-style: normal; line-height: 14px; font-stretch: normal; margin-top: 0px; padding-top: 0px; margin-bottom: 7px;\">Order ID {<strong>ORDER_ID</strong>}</p>\r\n<p style=\"font-family: Arial; font-size: 11px; color: #878787; line-height: 14px; text-align: right; padding-top: 0px; margin-top: 0; margin-bottom: 7px;\">&nbsp;</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"m_-4345841705994091849content\" style=\"background-color: rgba(245,245,245,0.5); background: rgba(245,245,245,0.5); border: .08em solid #6ed49e; border-radius: 2px; padding-top: 20px; padding-bottom: 20px;\" align=\"left\">\r\n<table style=\"margin-bottom: 20px; padding-left: 15px;\" border=\"0\" width=\"360\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 20px;\"><span style=\"display: inline-block; width: 125px; vertical-align: top;\">Order placed on</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{ORDER_DATE}</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-bottom: 20px; margin-top: 0px;\"><span style=\"display: inline-block; width: 125px; min-width: 125px; max-width: 125px;\">Amount</span><span style=\"font-family: Arial; font-size: 12px; font-weight: bold; line-height: 1.42; color: #139b3b; display: inline-block; width: 220px;\">{AMOUNT_PAID} </span></p>\r\n<p style=\"margin-bottom: 0px; margin-top: 0;\"><a style=\"background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;\" href=\"{MANAGE_ORDER}\" target=\"_blank\" rel=\"noopener noreferrer\">Manage Your Order</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin-bottom: 30px; padding-right: 15px;\" border=\"0\" width=\"225\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<div style=\"max-width: 220px; padding-top: 0px; margin-bottom: 20px;\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 20px; color: #212121; margin-top: 0px; margin-bottom: 4px;\">Order Details</p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\">{USER_NAME} <br /> <span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\"> {USER_EMAIL}</span></p>\r\n<p style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121; margin-top: 0px; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 12px; line-height: 1.42; color: #212121;\">{USER_ADDRESS}</span></p>\r\n</div>\r\n<p style=\"line-height: 1.56; margin-top: 0; margin-bottom: 0;\"><span style=\"font-family: Arial; font-size: 14px; font-weight: bold; text-align: left; color: #212121; display: block; line-height: 20px; margin-bottom: 4px;\">SMS updates sent to</span> <span style=\"font-family: Arial; font-size: 12px; color: #212121;\">{USER_PHONE}</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"padding-left: 15px; padding-right: 15px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849col\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 12px; text-align: left; color: #212121; padding-top: 0px; padding-bottom: 0px; line-height: 19px; margin-top: 0; margin-bottom: 0;\">Thank you for your Order. We will send a confirmation when your Order status update by our partners.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin-top: 0px;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #f0f0f0; font-size: 0px; line-height: 0px;\" bgcolor=\"#f0f0f0\" height=\"1\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"background-color: #fff; width: 642px; max-width: 642px; padding: 0px 20px 0px 20px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>{PRODUCTS_DETAILS}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 642px; max-width: 642px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<table style=\"margin: 0; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"color: #212121; display: block; margin: 0 auto; clear: both;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; display: block;\" align=\"left\" valign=\"top\">\r\n<table style=\"margin-bottom: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"40%\">&nbsp;</td>\r\n<td align=\"right\" width=\"34%\">\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; line-height: 14px; padding-top: 0px; margin-bottom: 0;\"><span style=\"color: #212121; text-align: right; font-weight: bold;\">Amount</span></p>\r\n</td>\r\n<td>\r\n<p style=\"margin-top: 0px; font-family: Arial; font-size: 14px; text-align: right; color: #3f3f3f; padding-top: 0px; margin-bottom: 0;\"><span style=\"padding-right: 0px; font-weight: bold;\">{AMOUNT_PAID} </span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"m_-4345841705994091849container\" style=\"padding-right: 20px; padding-left: 20px; background-color: #fff; width: 640px; max-width: 640px;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; background: #ffffff;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr class=\"m_-4345841705994091849col\" style=\"color: #212121;\">\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #212121; border-bottom: 1px solid #f0f0f0;\" align=\"left\" valign=\"top\">\r\n<p style=\"font-family: Arial; font-size: 14px; font-weight: bold; line-height: 1.86; color: #212121;\">Thank you for Order with {STORE_NAME}!</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 600px; max-width: 600px; margin-top: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 60%; text-align: left;\">&nbsp;</td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{APP_LINK}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{AND_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n<td style=\"width: 10%; text-align: right;\"><a style=\"text-decoration: none; outline: none; color: #ffffff; font-size: 13px;\" href=\"{IOS_APP}\" target=\"_blank\" rel=\"noopener noreferrer\"> <img class=\"CToWUd\" style=\"border: none; margin-top: 10px;\" src=\"{IOS_LINK_IMG}\" alt=\"\" height=\"24\" border=\"0\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"margin: 0 auto; width: 600px; max-width: 600px; margin-top: 4px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"m_-4345841705994091849container\" style=\"color: #2c2c2c; line-height: 20px; font-weight: 300; background-color: transparent;\" align=\"left\" valign=\"top\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style=\"font-family: Arial; font-size: 10px; color: #878787;\">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2022-06-27 14:55:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
