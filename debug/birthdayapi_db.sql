-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2014 年 8 月 07 日 00:48
-- サーバのバージョン: 5.1.70-cll
-- PHP のバージョン: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `arzzup_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ba_charactors`
--

CREATE TABLE IF NOT EXISTS `ba_charactors` (
  `charactor_id` int(11) NOT NULL AUTO_INCREMENT,
  `charactor_name` varchar(50) DEFAULT NULL,
  `birthday_m` smallint(6) DEFAULT NULL,
  `birthday_d` smallint(6) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`charactor_id`),
  KEY `title_id` (`title_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35449 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- テーブルの構造 `ba_titles`
--

CREATE TABLE IF NOT EXISTS `ba_titles` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`title_id`),
  KEY `title_id` (`title_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5470 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- テーブルの構造 `ba_users`
--

CREATE TABLE IF NOT EXISTS `ba_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- テーブルのデータのダンプ `ba_users`
--

INSERT INTO `ba_users` (`user_id`, `user_name`) VALUES
(1, 'elzup');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- テーブルの構造 `ba_watchs`
--

CREATE TABLE IF NOT EXISTS `ba_watchs` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`title_id`),
  UNIQUE KEY `title_id_2` (`title_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ba_watchs`
--

INSERT INTO `ba_watchs` (`user_id`, `title_id`) VALUES
(1, 3485),
(1, 3519),
(1, 3606),
(1, 3625),
(1, 3716),
(1, 3728),
(1, 3746),
(1, 3765),
(1, 3817),
(1, 3909),
(1, 4016),
(1, 4078),
(1, 4138),
(1, 4214),
(1, 4490),
(1, 4720),
(1, 4898),
(1, 4919),
(1, 5057),
(1, 5094),
(1, 5151),
(1, 5179),
(1, 5203),
(1, 5204),
(1, 5334),
(1, 5360),
(1, 5367),
(1, 5379),
(1, 5392),
(1, 5450),
(1, 5453),
(1, 5468);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
