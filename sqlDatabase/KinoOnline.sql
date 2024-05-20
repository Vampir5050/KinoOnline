-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2024 г., 13:27
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `KinoOnline`
--

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `film_id` int DEFAULT NULL,
  `serial_id` int DEFAULT NULL,
  `added_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `film_id`, `serial_id`, `added_date`) VALUES
(1, 1, 2, NULL, '2024-05-20 09:22:07'),
(2, 1, 1, NULL, '2024-05-20 09:22:24'),
(3, 1, NULL, 1, '2024-05-20 09:32:13');

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int NOT NULL,
  `name_film` varchar(255) NOT NULL,
  `ganre` varchar(255) NOT NULL,
  `year_release` year NOT NULL,
  `country` varchar(255) NOT NULL,
  `poster_film` varchar(255) NOT NULL,
  `link_film` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `name_film`, `ganre`, `year_release`, `country`, `poster_film`, `link_film`) VALUES
(1, 'Тихая ночь', 'драма, комедия, фантастика', 2020, 'Великобритания', '/img/Silent Night.webp', 'https://www.youtube.com/embed/bZmaNLF5OaA?si=4OC1_Nesg2A7XZdu'),
(2, 'Проклятие монахини Роуз', 'ужасы', 2019, 'США', '/img/The Dawn.webp', 'https://www.youtube.com/embed/YwaIXWUWyN4?si=pJ7ze_1EXvUqLKpS'),
(3, 'Крылья урагана', 'боевик, драма, военный', 2018, 'Великобритания, Польша', '/img/Hurricane.webp', 'https://www.youtube.com/embed/3KvMylr3aGI?si=yO2XlI5DyWPYvt9N');

-- --------------------------------------------------------

--
-- Структура таблицы `serials`
--

CREATE TABLE `serials` (
  `id` int NOT NULL,
  `name_serial` varchar(255) NOT NULL,
  `ganre` varchar(255) NOT NULL,
  `year_release` year NOT NULL,
  `country` varchar(255) NOT NULL,
  `poster_serial` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `serials`
--

INSERT INTO `serials` (`id`, `name_serial`, `ganre`, `year_release`, `country`, `poster_serial`) VALUES
(1, 'Во все тяжкие', 'криминал, драма, триллер', 2008, 'США', '/img/Breaking Bad.webp'),
(2, 'Тед Лассо', 'комедия, спорт', 2020, 'США, Великобритания', '/img/Ted Lasso.webp'),
(3, 'Формула преступления', 'детектив, криминал', 2019, 'Россия', '/img/Formula Crime.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_at`, `update_at`, `avatar`) VALUES
(1, 'sanya', 'sad@da.com', '$2y$10$2xhvUijyUopEkQqXSuRyxeRalt6axfPoq7RDcqAHEuLYn9180eDra', '2024-05-20 09:12:44', '2024-05-20 09:12:44', '/img/noavatar.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `serial_id` (`serial_id`);

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `serials`
--
ALTER TABLE `serials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `serials`
--
ALTER TABLE `serials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`serial_id`) REFERENCES `serials` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
