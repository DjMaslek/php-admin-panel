-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 20 2021 г., 09:58
-- Версия сервера: 5.7.29-log
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test-task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `gender`, `birthday`, `role`) VALUES
(3, 'Admin', '$2y$10$uwqFj.dYh9JQ.b.0ab6jZ.hT3/czyt7AzBc60bwhRn4FFgi6WIvhW', 'Administrator', 'Administrator', 'M', '2000-01-01', 'admin'),
(17, 'user1', '$2y$10$hwz7Cx8y3uuUT6uS/rqLzOaxqANyzMLJjWmSnrAq7lN6taLtkq0CW', 'user1', 'user1', 'M', '2021-09-01', 'user'),
(18, 'user2', '$2y$10$iCy70GGypQ8q7PcQ3RRVAOYFgkfIbw66kHseq.0Svf2gmfuQhF7ke', 'user2', 'user2', 'F', '2021-09-02', 'user'),
(19, 'user3', '$2y$10$O944GoLxiyYNVOnJ3QwZfefqEtmvCiUOAkfUEG34igGWGCGol8W6u', 'user3', 'user3', 'M', '2021-09-03', 'user'),
(20, 'user4', '$2y$10$ms39/wTAleBNXJZCNWlKEeRK7V5A7eY5gNax/KyFpC8.t.Kflk28a', 'user4', 'user4', 'F', '2021-09-04', 'user'),
(21, 'user5', '$2y$10$fUSOCr8.VpummIxJxtDoluRiVCq2z0A3yCCJ/LglbnxdWY1/t5cb6', 'user5', 'user5', 'M', '2021-09-05', 'user'),
(22, 'user6', '$2y$10$dBdL.XGGfUFglSSYyYVEIOL81JossLt6VzCHZtRk0/cUKOJg9pjkm', 'user6', 'user6', 'F', '2021-09-06', 'user'),
(23, 'user7', '$2y$10$WblNnwKGzeq0QjZprkR48OJAa5r1j/VHrec1shz5SOo7IEJR/2xYy', 'user7', 'user7', 'F', '2021-09-07', 'user'),
(24, 'user8', '$2y$10$1vsY6e/Rf63Q9jNY.l9EeOgqttbd3gX/YPaZRkj4Q51hCQUX1oqhe', 'user8', 'user8', 'M', '2021-09-08', 'user'),
(25, 'user9', '$2y$10$pzB61Wp6bMx9bvQqWLKvXeLa5RO0BOvy3aExGPfPsBFv8dDkxuG1u', 'user9', 'user9', 'F', '2021-09-09', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
