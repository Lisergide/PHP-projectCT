-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 19 2018 г., 10:18
-- Версия сервера: 5.7.23
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery2`
--

CREATE TABLE `gallery2` (
  `id` int(3) NOT NULL,
  `url` varchar(75) NOT NULL,
  `size` varchar(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `views` int(4) NOT NULL,
  `price` int(4) NOT NULL,
  `count` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery2`
--

INSERT INTO `gallery2` (`id`, `url`, `size`, `name`, `views`, `price`, `count`) VALUES
(1, 'img1.jpg', '500x500', 'Adidas Top Sala 15.1', 31, 50, 1),
(2, 'img2.jpg', '500x500', 'Munich X Gresca', 49, 45, 0),
(3, 'img3.jpg', '500x500', 'Футболка тренировочная Joma', 33, 55, 0),
(4, 'img4.jpg', '500x500', 'Мяч Kelme Olimpo', 558, 65, 0),
(5, 'img5.jpg', '500x500', 'Носки футбольные black', 137, 60, 0),
(6, 'img7.jpg', '500x500', 'Футзалки Joma', 47, 70, 0),
(7, 'img8.jpg', '500x500', 'Форма Errea', 312, 80, 0),
(8, 'img9.jpg', '500x500', 'Мяч Mikasa', 119, 30, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery2`
--
ALTER TABLE `gallery2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery2`
--
ALTER TABLE `gallery2`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
