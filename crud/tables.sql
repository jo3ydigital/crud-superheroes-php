-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: irbsvr83
-- Generation Time: Jul 01, 2015 at 02:06 PM
-- Server version: 10.0.11-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jd_dev_webservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `kfire_users`
--

CREATE TABLE IF NOT EXISTS `kfire_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `realname` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

--
-- Dumping data for table `kfire_users`
--

INSERT INTO `kfire_users` (`id`, `username`, `realname`, `password`, `email`) VALUES
(1, 'john', 'John Doe', 'Saltro45', 'john.doe@mail.com'),
(2, 'saldo', 'Saldo Rush', 'hro8052w', 'saldo.rush@mail.com'),
(3, 'berta', 'Berta Crush', 'Tre4gh0M', 'berta.crush@mail.com'),
(4, 'simon', 'Simon Greath', 'qbmu76rb', 'simon.greath@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `superheroes`
--

CREATE TABLE IF NOT EXISTS `superheroes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `realname` varchar(100) NOT NULL DEFAULT '',
  `actor` varchar(100) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `contactform_users`
--

INSERT INTO `superheroes` (`id`, `name`, `realname`, `actor`, `image`) VALUES
(1, 'Professor Xavier', 'Charles Xavier', 'Patrick Stewart', 'http://static1.comicvine.com/uploads/scale_super/0/229/85452-165133-professor-x.jpg'),
(2, 'Storm', 'Ororo Munroe', 'Halle Berry', 'http://static.comicvine.com/uploads/original/10/107222/2112341-tumblr_lvo07qdoux1qapfkto1_500.jpg'),
(3, 'Wolverine', 'James Logan Howlett', 'Hugh Jackman', 'http://images1.wikia.nocookie.net/__cb20091209190556/marveldatabase/images/3/38/Wolverine_what_he_does.jpg'),
(4, 'Cyclops', 'Scott Summers', 'James Marsden', 'http://vignette1.wikia.nocookie.net/marvel-contestofchampions/images/a/a0/Cyclops_(Blue_Team)_portrait.png/revision/latest?cb=20160122010538'),
(5, 'Gambit', 'Remy Etienne LeBeau', 'Taylor Kitsch', 'http://orig12.deviantart.net/ed36/f/2009/106/3/3/x_men_gambit_colors_by_safari_sunset.jpg'),
(6, 'Beast', 'Henry Philip McCoy', 'Kelsey Grammar', 'http://vignette3.wikia.nocookie.net/xmenevo/images/8/89/X-Men_Ledgens_-_beast.png/revision/latest?cb=20120722055818'),
(7, 'Colossus', 'Piotr Nikolaievitch Rasputin', 'Stefan Kapicic', 'https://marvelupdates1.files.wordpress.com/2015/11/colossus.jpg'),
(8, 'Nightcrawler', 'Kurt Wagner', 'Alan Cumming', 'http://static.tumblr.com/4b46636b30b8949f556f423299d0dfbb/4vsga9z/qVJmz7wh1/tumblr_static_nightcrawler_by_dlxcsccomicartist-d4l4zeq.png'),
(9, 'Jean Gray', 'Jean Elaine Grey', 'Famke Janseen', 'http://img11.deviantart.net/932a/i/2010/156/7/d/jean_grey_by_ed_benes_color_by_tony058.jpg')
