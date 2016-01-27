-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 27 2016 г., 15:16
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `php2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`) VALUES
(1, 'Тузик укусил зайку', 'Зайка выбежал из леса, за ним выбежал Тузик и укусил зайку за лапку. Зайка заплакал, вызвал полицию. По горячим следам полиция не смогла найти Тузика.'),
(2, 'Женщина купила пирог.', 'У женщины был голодный муж и дети. Она пошла в магазин, а там была большая очередь. Она простояла в очереди пол дня и купила пирог. Дома все были счастливы, они поели порога.'),
(3, 'Маршрутка остановилась.', 'В час пик, переполненная маршрутка остановилась на проспекте Ленина, потому что кончился бензин.'),
(4, 'Снег выпал неожиданно', '27 января неожиданно выпал снег. Коммунальные службы не были готовы к такому повороту событий. Техника законсервированная, работки в отпусках, никогда раньше такого не случалось что бы в Австралии зимой выпал снег.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `name`) VALUES
(1, 'yandex@yandex.ru', 'Яндекс'),
(2, 'mail@mail.ru', 'Маил'),
(3, 'yandex2@yandex.ru', 'Вася'),
(4, 'mail2@mail.ru', 'Петя');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
