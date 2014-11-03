-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2014 at 12:55 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `9gag`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `adminuser` varchar(500) NOT NULL,
  `adminpassword` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminuser`, `adminpassword`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(500) CHARACTER SET utf8 NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cname`, `description`) VALUES
(1, 'Cute', ''),
(2, 'Geeky', ''),
(3, 'MeMe', ''),
(4, 'Food', ''),
(5, 'WTF', ''),
(6, 'Comic', ''),
(7, 'Cool', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `comment` varchar(999) NOT NULL,
  `date` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(999) NOT NULL,
  `image` varchar(999) NOT NULL,
  `thumb` varchar(999) NOT NULL,
  `video_type` varchar(250) NOT NULL,
  `vine_mp4` varchar(999) NOT NULL,
  `video_url` varchar(999) NOT NULL,
  `video_embed` varchar(999) NOT NULL,
  `type` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `views` int(250) NOT NULL,
  `cmts` int(11) NOT NULL,
  `date` varchar(500) NOT NULL,
  `active` int(11) NOT NULL,
  `feat` int(11) NOT NULL,
  `time_viewed` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title`, `image`, `thumb`, `video_type`, `vine_mp4`, `video_url`, `video_embed`, `type`, `catid`, `uid`, `votes`, `views`, `cmts`, `date`, `active`, `feat`, `time_viewed`) VALUES
(1, 'Let me see how I look', 'let_me_see_how_i_look_576238582.jpg', '', '', '', '', '', 1, 1, 1, 0, 0, 0, '2014-06-06T12:50:01+02:00', 1, 0, ''),
(2, 'Goku vs Superman', 'http://i.ytimg.com/vi/0MW9Nrg_kZU/hqdefault.jpg', 'http://i.ytimg.com/vi/0MW9Nrg_kZU/hqdefault.jpg', 'youtube.com', '', 'http://www.youtube.com/watch?v=0MW9Nrg_kZU', '<iframe width="630" height="352" src="http://www.youtube.com/embed/0MW9Nrg_kZU" frameborder="0" allowfullscreen></iframe>', 3, 7, 1, 0, 0, 0, '2014-06-06T12:51:07+02:00', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `page` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor\r\n lobortis tortor sit amet auctor. Praesent pretium, leo eget luctus \r\ntempor, lectus erat vulputate libero, in viverra dolor velit quis ante. \r\nVivamus viverra pulvinar sollicitudin. Vivamus dictum orci sed lorem \r\nvenenatis quis rutrum risus dictum. Ut non enim elit. In consectetur, \r\nnibh sed iaculis pellentesque, nisi ligula egestas enim, sagittis \r\nfermentum nulla nisl sit amet velit. Aliquam erat volutpat. Suspendisse \r\nac mi tortor, at vestibulum augue. Suspendisse ut nisl quam, euismod \r\nscelerisque urna. Donec non leo et nisi tempus fermentum. Cum sociis \r\nnatoque penatibus et magnis dis parturient montes, nascetur ridiculus \r\nmus. Donec gravida sodales est vitae tincidunt.<br><br>Curabitur neque \r\ndui, adipiscing a dignissim sed, congue ut sem. Vivamus eget tellus \r\nlectus. Nullam ut tempus purus. Vestibulum pellentesque lorem nec velit \r\nhendrerit porta. Cras sit amet mauris odio. Sed sit amet libero nec \r\nipsum venenatis interdum. Class aptent taciti sociosqu ad litora \r\ntorquent per conubia nostra, per inceptos himenaeos. Sed at ligula eu \r\nenim congue molestie. Lorem ipsum dolor sit amet, consectetur adipiscing\r\n elit. Praesent tincidunt diam at metus facilisis aliquam. Vivamus a \r\norci nunc, molestie consectetur purus. Vivamus aliquam, diam eu rhoncus \r\nmollis, est lorem aliquam neque, elementum molestie sapien velit id \r\nsapien. Maecenas quis dolor nisl.<br><br>Morbi nisi quam, suscipit eu \r\naccumsan a, porttitor sed risus. Donec laoreet, dolor semper eleifend \r\nsodales, erat lacus pretium velit, vitae dignissim felis risus non \r\nmagna. Suspendisse potenti. Proin at nulla massa, et dictum magna. Lorem\r\n ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra, \r\npurus vel egestas egestas, orci lectus vehicula quam, non placerat massa\r\n lacus id justo. Integer posuere laoreet porttitor.<br><br>Nam nulla \r\nmetus, rutrum in suscipit ac, hendrerit eget nunc. In hac habitasse \r\nplatea dictumst. Mauris at justo magna. Class aptent taciti sociosqu ad \r\nlitora torquent per conubia nostra, per inceptos himenaeos. Duis \r\nmalesuada ultricies hendrerit. Vivamus ullamcorper consectetur \r\ndignissim. Praesent nunc lorem, elementum vitae scelerisque vitae, \r\npellentesque quis ipsum. Cras volutpat, erat eu mollis pulvinar, justo \r\nlibero dictum leo, ac accumsan tellus ipsum eget magna. Suspendisse \r\ntristique mauris nec odio fringilla sagittis. Donec rhoncus euismod \r\ntortor, nec commodo magna cursus at. Nunc ut euismod dui. Suspendisse \r\nsollicitudin, magna eget auctor euismod, dolor mi aliquet tellus, et \r\nsuscipit dui est nec odio. Aliquam rutrum tellus in nisi ultricies sed \r\nelementum nisi molestie. Praesent sit amet ligula id lorem ultrices \r\ntristique.<br><br>Suspendisse potenti. Sed urna est, fringilla a \r\ncondimentum eu, dapibus et erat. Cras ac aliquet erat. Integer eget \r\nrisus magna, non egestas nulla. Maecenas ut ante tortor. Pellentesque \r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis \r\negestas. Morbi vel eros nec quam cursus porttitor et nec orci. Nulla vel\r\n odio sit amet nisi feugiat dignissim. Mauris tincidunt enim quam, non \r\npharetra risus. Sed sed mi nulla, sit amet aliquam ipsum. Ut faucibus \r\nvestibulum feugiat. Nulla ut dui eget massa pellentesque scelerisque. \r\nAenean ut ipsum at orci lacinia mollis id nec urna. Proin eros dui, \r\nfeugiat vitae adipiscing ut, rutrum vitae quam. Nam et convallis augue. \r\nQuisque ut odio eu ante consequat elementum. <br>'),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor\r\n lobortis tortor sit amet auctor. Praesent pretium, leo eget luctus \r\ntempor, lectus erat vulputate libero, in viverra dolor velit quis ante. \r\nVivamus viverra pulvinar sollicitudin. Vivamus dictum orci sed lorem \r\nvenenatis quis rutrum risus dictum. Ut non enim elit. In consectetur, \r\nnibh sed iaculis pellentesque, nisi ligula egestas enim, sagittis \r\nfermentum nulla nisl sit amet velit. Aliquam erat volutpat. Suspendisse \r\nac mi tortor, at vestibulum augue. Suspendisse ut nisl quam, euismod \r\nscelerisque urna. Donec non leo et nisi tempus fermentum. Cum sociis \r\nnatoque penatibus et magnis dis parturient montes, nascetur ridiculus \r\nmus. Donec gravida sodales est vitae tincidunt.<br><br>Curabitur neque \r\ndui, adipiscing a dignissim sed, congue ut sem. Vivamus eget tellus \r\nlectus. Nullam ut tempus purus. Vestibulum pellentesque lorem nec velit \r\nhendrerit porta. Cras sit amet mauris odio. Sed sit amet libero nec \r\nipsum venenatis interdum. Class aptent taciti sociosqu ad litora \r\ntorquent per conubia nostra, per inceptos himenaeos. Sed at ligula eu \r\nenim congue molestie. Lorem ipsum dolor sit amet, consectetur adipiscing\r\n elit. Praesent tincidunt diam at metus facilisis aliquam. Vivamus a \r\norci nunc, molestie consectetur purus. Vivamus aliquam, diam eu rhoncus \r\nmollis, est lorem aliquam neque, elementum molestie sapien velit id \r\nsapien. Maecenas quis dolor nisl.<br><br>Morbi nisi quam, suscipit eu \r\naccumsan a, porttitor sed risus. Donec laoreet, dolor semper eleifend \r\nsodales, erat lacus pretium velit, vitae dignissim felis risus non \r\nmagna. Suspendisse potenti. Proin at nulla massa, et dictum magna. Lorem\r\n ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra, \r\npurus vel egestas egestas, orci lectus vehicula quam, non placerat massa\r\n lacus id justo. Integer posuere laoreet porttitor.<br><br>Nam nulla \r\nmetus, rutrum in suscipit ac, hendrerit eget nunc. In hac habitasse \r\nplatea dictumst. Mauris at justo magna. Class aptent taciti sociosqu ad \r\nlitora torquent per conubia nostra, per inceptos himenaeos. Duis \r\nmalesuada ultricies hendrerit. Vivamus ullamcorper consectetur \r\ndignissim. Praesent nunc lorem, elementum vitae scelerisque vitae, \r\npellentesque quis ipsum. Cras volutpat, erat eu mollis pulvinar, justo \r\nlibero dictum leo, ac accumsan tellus ipsum eget magna. Suspendisse \r\ntristique mauris nec odio fringilla sagittis. Donec rhoncus euismod \r\ntortor, nec commodo magna cursus at. Nunc ut euismod dui. Suspendisse \r\nsollicitudin, magna eget auctor euismod, dolor mi aliquet tellus, et \r\nsuscipit dui est nec odio. Aliquam rutrum tellus in nisi ultricies sed \r\nelementum nisi molestie. Praesent sit amet ligula id lorem ultrices \r\ntristique.<br><br>Suspendisse potenti. Sed urna est, fringilla a \r\ncondimentum eu, dapibus et erat. Cras ac aliquet erat. Integer eget \r\nrisus magna, non egestas nulla. Maecenas ut ante tortor. Pellentesque \r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis \r\negestas. Morbi vel eros nec quam cursus porttitor et nec orci. Nulla vel\r\n odio sit amet nisi feugiat dignissim. Mauris tincidunt enim quam, non \r\npharetra risus. Sed sed mi nulla, sit amet aliquam ipsum. Ut faucibus \r\nvestibulum feugiat. Nulla ut dui eget massa pellentesque scelerisque. \r\nAenean ut ipsum at orci lacinia mollis id nec urna. Proin eros dui, \r\nfeugiat vitae adipiscing ut, rutrum vitae quam. Nam et convallis augue. \r\nQuisque ut odio eu ante consequat elementum. <br>'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor lobortis tortor sit amet auctor. Praesent pretium, leo eget luctus tempor, lectus erat vulputate libero, in viverra dolor velit quis ante. Vivamus viverra pulvinar sollicitudin. Vivamus dictum orci sed lorem venenatis quis rutrum risus dictum. Ut non enim elit. In consectetur, nibh sed iaculis pellentesque, nisi ligula egestas enim, sagittis fermentum nulla nisl sit amet velit. Aliquam erat volutpat. Suspendisse ac mi tortor, at vestibulum augue. Suspendisse ut nisl quam, euismod scelerisque urna. Donec non leo et nisi tempus fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec gravida sodales est vitae tincidunt.<br><br>Curabitur neque dui, adipiscing a dignissim sed, congue ut sem. Vivamus eget tellus lectus. Nullam ut tempus purus. Vestibulum pellentesque lorem nec velit hendrerit porta. Cras sit amet mauris odio. Sed sit amet libero nec ipsum venenatis interdum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed at ligula eu enim congue molestie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tincidunt diam at metus facilisis aliquam. Vivamus a orci nunc, molestie consectetur purus. Vivamus aliquam, diam eu rhoncus mollis, est lorem aliquam neque, elementum molestie sapien velit id sapien. Maecenas quis dolor nisl.<br><br>Morbi nisi quam, suscipit eu accumsan a, porttitor sed risus. Donec laoreet, dolor semper eleifend sodales, erat lacus pretium velit, vitae dignissim felis risus non magna. Suspendisse potenti. Proin at nulla massa, et dictum magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra, purus vel egestas egestas, orci lectus vehicula quam, non placerat massa lacus id justo. Integer posuere laoreet porttitor.<br><br>Nam nulla metus, rutrum in suscipit ac, hendrerit eget nunc. In hac habitasse platea dictumst. Mauris at justo magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis malesuada ultricies hendrerit. Vivamus ullamcorper consectetur dignissim. Praesent nunc lorem, elementum vitae scelerisque vitae, pellentesque quis ipsum. Cras volutpat, erat eu mollis pulvinar, justo libero dictum leo, ac accumsan tellus ipsum eget magna. Suspendisse tristique mauris nec odio fringilla sagittis. Donec rhoncus euismod tortor, nec commodo magna cursus at. Nunc ut euismod dui. Suspendisse sollicitudin, magna eget auctor euismod, dolor mi aliquet tellus, et suscipit dui est nec odio. Aliquam rutrum tellus in nisi ultricies sed elementum nisi molestie. Praesent sit amet ligula id lorem ultrices tristique.<br><br>Suspendisse potenti. Sed urna est, fringilla a condimentum eu, dapibus et erat. Cras ac aliquet erat. Integer eget risus magna, non egestas nulla. Maecenas ut ante tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi vel eros nec quam cursus porttitor et nec orci. Nulla vel odio sit amet nisi feugiat dignissim. Mauris tincidunt enim quam, non pharetra risus. Sed sed mi nulla, sit amet aliquam ipsum. Ut faucibus vestibulum feugiat. Nulla ut dui eget massa pellentesque scelerisque. Aenean ut ipsum at orci lacinia mollis id nec urna. Proin eros dui, feugiat vitae adipiscing ut, rutrum vitae quam. Nam et convallis augue. Quisque ut odio eu ante consequat elementum. <br>'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor\r\n lobortis tortor sit amet auctor. Praesent pretium, leo eget luctus \r\ntempor, lectus erat vulputate libero, in viverra dolor velit quis ante. \r\nVivamus viverra pulvinar sollicitudin. Vivamus dictum orci sed lorem \r\nvenenatis quis rutrum risus dictum. Ut non enim elit. In consectetur, \r\nnibh sed iaculis pellentesque, nisi ligula egestas enim, sagittis \r\nfermentum nulla nisl sit amet velit. Aliquam erat volutpat. Suspendisse \r\nac mi tortor, at vestibulum augue. Suspendisse ut nisl quam, euismod \r\nscelerisque urna. Donec non leo et nisi tempus fermentum. Cum sociis \r\nnatoque penatibus et magnis dis parturient montes, nascetur ridiculus \r\nmus. Donec gravida sodales est vitae tincidunt.<br><br>Curabitur neque \r\ndui, adipiscing a dignissim sed, congue ut sem. Vivamus eget tellus \r\nlectus. Nullam ut tempus purus. Vestibulum pellentesque lorem nec velit \r\nhendrerit porta. Cras sit amet mauris odio. Sed sit amet libero nec \r\nipsum venenatis interdum. Class aptent taciti sociosqu ad litora \r\ntorquent per conubia nostra, per inceptos himenaeos. Sed at ligula eu \r\nenim congue molestie. Lorem ipsum dolor sit amet, consectetur adipiscing\r\n elit. Praesent tincidunt diam at metus facilisis aliquam. Vivamus a \r\norci nunc, molestie consectetur purus. Vivamus aliquam, diam eu rhoncus \r\nmollis, est lorem aliquam neque, elementum molestie sapien velit id \r\nsapien. Maecenas quis dolor nisl.<br><br>Morbi nisi quam, suscipit eu \r\naccumsan a, porttitor sed risus. Donec laoreet, dolor semper eleifend \r\nsodales, erat lacus pretium velit, vitae dignissim felis risus non \r\nmagna. Suspendisse potenti. Proin at nulla massa, et dictum magna. Lorem\r\n ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra, \r\npurus vel egestas egestas, orci lectus vehicula quam, non placerat massa\r\n lacus id justo. Integer posuere laoreet porttitor.<br><br>Nam nulla \r\nmetus, rutrum in suscipit ac, hendrerit eget nunc. In hac habitasse \r\nplatea dictumst. Mauris at justo magna. Class aptent taciti sociosqu ad \r\nlitora torquent per conubia nostra, per inceptos himenaeos. Duis \r\nmalesuada ultricies hendrerit. Vivamus ullamcorper consectetur \r\ndignissim. Praesent nunc lorem, elementum vitae scelerisque vitae, \r\npellentesque quis ipsum. Cras volutpat, erat eu mollis pulvinar, justo \r\nlibero dictum leo, ac accumsan tellus ipsum eget magna. Suspendisse \r\ntristique mauris nec odio fringilla sagittis. Donec rhoncus euismod \r\ntortor, nec commodo magna cursus at. Nunc ut euismod dui. Suspendisse \r\nsollicitudin, magna eget auctor euismod, dolor mi aliquet tellus, et \r\nsuscipit dui est nec odio. Aliquam rutrum tellus in nisi ultricies sed \r\nelementum nisi molestie. Praesent sit amet ligula id lorem ultrices \r\ntristique.<br><br>Suspendisse potenti. Sed urna est, fringilla a \r\ncondimentum eu, dapibus et erat. Cras ac aliquet erat. Integer eget \r\nrisus magna, non egestas nulla. Maecenas ut ante tortor. Pellentesque \r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis \r\negestas. Morbi vel eros nec quam cursus porttitor et nec orci. Nulla vel\r\n odio sit amet nisi feugiat dignissim. Mauris tincidunt enim quam, non \r\npharetra risus. Sed sed mi nulla, sit amet aliquam ipsum. Ut faucibus \r\nvestibulum feugiat. Nulla ut dui eget massa pellentesque scelerisque. \r\nAenean ut ipsum at orci lacinia mollis id nec urna. Proin eros dui, \r\nfeugiat vitae adipiscing ut, rutrum vitae quam. Nam et convallis augue. \r\nQuisque ut odio eu ante consequat elementum. <br>');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `siteurl` varchar(500) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `descrp` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fbapp` varchar(500) NOT NULL,
  `active` int(11) NOT NULL,
  `open_posts` int(11) NOT NULL,
  `fbpage` varchar(900) NOT NULL,
  `twitter` varchar(500) NOT NULL,
  `gplus` varchar(500) NOT NULL,
  `template` varchar(255) NOT NULL,
  `site_hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `siteurl`, `keywords`, `descrp`, `email`, `fbapp`, `active`, `open_posts`, `fbpage`, `twitter`, `gplus`, `template`, `site_hits`) VALUES
(1, 'Your-Site-Name', 'Your-Site.Ext', 'Add Your Meta Keywords Here', 'Add Your Meta Description Here', 'You@Your-Site.Ext', 'Facebook App Id', 1, 1, 'Facebook Fan Page URL', 'Twitter URL', 'Google + URL', 'default', 2867);

-- --------------------------------------------------------

--
-- Table structure for table `siteads`
--

CREATE TABLE IF NOT EXISTS `siteads` (
  `id` int(11) NOT NULL,
  `ad1` varchar(500) NOT NULL,
  `ad2` varchar(500) NOT NULL,
  `ad3` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siteads`
--

INSERT INTO `siteads` (`id`, `ad1`, `ad2`, `ad3`) VALUES
(1, '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9634676781117222";\r\n/* 300x250, created 9/4/10 */\r\ngoogle_ad_slot = "2205194959";\r\ngoogle_ad_width = 300;\r\ngoogle_ad_height = 250;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="//pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9634676781117222";\r\n/* 300x250, created 9/4/10 */\r\ngoogle_ad_slot = "2205194959";\r\ngoogle_ad_width = 300;\r\ngoogle_ad_height = 250;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="//pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9634676781117222";\r\n/* answers */\r\ngoogle_ad_slot = "7102746441";\r\ngoogle_ad_width = 728;\r\ngoogle_ad_height = 90;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="//pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(500) CHARACTER SET utf8 NOT NULL,
  `country` varchar(500) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(500) CHARACTER SET utf8 NOT NULL,
  `birthday` varchar(500) CHARACTER SET utf8 NOT NULL,
  `password` varchar(999) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(500) CHARACTER SET utf8 NOT NULL,
  `about` varchar(999) CHARACTER SET utf8 NOT NULL,
  `reg_date` varchar(500) CHARACTER SET utf8 NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `country`, `gender`, `birthday`, `password`, `avatar`, `about`, `reg_date`, `points`) VALUES
(1, 'Max', 'info@flippyscripts.com', 'Sri Lanka', '', '', 'a9575efd6da5a277322853c68081ab88', '14020407841.jpg', 'My Funny Collection	', 'June 5, 2014', 0),
(2, 'Flippy', 'sales@flippyscripts.com', 'Sri Lanka', '', '', 'a9575efd6da5a277322853c68081ab88', '', 'My Funny Collection	', 'June 6, 2014', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votecmt`
--

CREATE TABLE IF NOT EXISTS `votecmt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `cmt_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voteip`
--

CREATE TABLE IF NOT EXISTS `voteip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(500) CHARACTER SET utf8 NOT NULL,
  `media_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
