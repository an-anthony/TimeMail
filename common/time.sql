-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.26 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 time_mail 的数据库结构
DROP DATABASE IF EXISTS `time_mail`;
CREATE DATABASE IF NOT EXISTS `time_mail` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `time_mail`;

-- 导出  表 time_mail.check 结构
DROP TABLE IF EXISTS `check`;
CREATE TABLE IF NOT EXISTS `check` (
  `uid` mediumtext NOT NULL,
  `code` mediumtext NOT NULL,
  `time` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  time_mail.check 的数据：~0 rows (大约)
DELETE FROM `check`;
/*!40000 ALTER TABLE `check` DISABLE KEYS */;
/*!40000 ALTER TABLE `check` ENABLE KEYS */;

-- 导出  表 time_mail.checking 结构
DROP TABLE IF EXISTS `checking`;
CREATE TABLE IF NOT EXISTS `checking` (
  `uid` mediumtext NOT NULL,
  `topic` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `from` mediumtext NOT NULL,
  `to` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  time_mail.checking 的数据：~0 rows (大约)
DELETE FROM `checking`;
/*!40000 ALTER TABLE `checking` DISABLE KEYS */;
/*!40000 ALTER TABLE `checking` ENABLE KEYS */;

-- 导出  表 time_mail.sent 结构
DROP TABLE IF EXISTS `sent`;
CREATE TABLE IF NOT EXISTS `sent` (
  `uid` mediumtext NOT NULL,
  `topic` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `from` mediumtext NOT NULL,
  `to` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `confirm_time` datetime NOT NULL,
  `sent_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  time_mail.sent 的数据：~1 rows (大约)
DELETE FROM `sent`;
/*!40000 ALTER TABLE `sent` DISABLE KEYS */;

/*!40000 ALTER TABLE `sent` ENABLE KEYS */;

-- 导出  表 time_mail.waiting 结构
DROP TABLE IF EXISTS `waiting`;
CREATE TABLE IF NOT EXISTS `waiting` (
  `uid` mediumtext NOT NULL,
  `topic` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `from` mediumtext NOT NULL,
  `to` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `confirm_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  time_mail.waiting 的数据：~0 rows (大约)
DELETE FROM `waiting`;
/*!40000 ALTER TABLE `waiting` DISABLE KEYS */;
/*!40000 ALTER TABLE `waiting` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
