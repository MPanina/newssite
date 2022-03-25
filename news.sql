-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 26 2022 г., 02:17
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `news`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'nikita', '123'),
(2, 'Dima', '$2y$10$LGqvKc2NmsTjUrnaS8OKrOQSRG48e0/rS63upMRCPOc9u.aFqm3VC'),
(3, 'Dima', '$2y$10$QZL4fZ/LH84JiUbmfDtYr.2/AZ8ba8Yul9J42ntMljD0iyI8HG5hu');

-- --------------------------------------------------------

--
-- Структура таблицы `header`
--

CREATE TABLE `header` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `header`
--

INSERT INTO `header` (`id`, `title`) VALUES
(1, 'Главная'),
(2, 'Наука'),
(3, 'Экономика'),
(4, 'Политика'),
(7, 'Общество ');

-- --------------------------------------------------------

--
-- Структура таблицы `headeradmin`
--

CREATE TABLE `headeradmin` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `headeradmin`
--

INSERT INTO `headeradmin` (`id`, `title`) VALUES
(1, 'Добавление статьи'),
(2, 'Удаление статьи'),
(3, 'Редактирование статьи'),
(4, 'Добавление админа');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `longdesc` text NOT NULL,
  `date` date NOT NULL,
  `autor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `longdesc`, `date`, `autor`, `type`) VALUES
(1, 'В Варшаве переименуют площадь Джохара \r\nДудаева из-за ассоциаций с Россией\r\n', 'news2.jpg', 'Сеймик польской столицы принял решение о переименовании расположенной на пересечении Иерусалимских аллей и улицы Популярная площади Джохара Дудаева из-за участия чеченских подразделений на стороне РФ в спецоперации на Украине. Площадь будет переименована в честь украинского писателя Николая Гоголя.\r\n', '2022-03-22', 'Admin', 'Политика'),
(2, 'Эрдоган пригрозил России санкциями, если Чубайс останется в Турции', 'news.jpg', 'Президент Турции Реджеп Тайип Эрдоган обратился к российскому послу с требованием немедленно обеспечить отъезд за пределы Турецкой Республики экс-главы “Роснано” Анатолия Чубайса. В противном случае турецкий лидер пригрозил присоединиться к западным санкциями и закрыть проливы для российских судов.', '2022-03-24', 'Admin', 'Политика'),
(3, 'товары', '103859d3fc90.jpg', 'товары', '2022-03-26', '', 'Экономика'),
(5, 'Первая целиком отечественная видеокарта «ЭлМИ-1» оказалась китайской подделкой под GeForce 1050Ti', 'news4.png', 'Специалисты заявили, что первая полностью российская видеокарта «ЭлМИ-1» («электронный модуль изображения, модель №1») оказалась не вполне отечественной разработкой – тестовый образец, который был предоставлен компьютерным СМИ для изучения, представляет собой китайскую подделку под видеокарту GeForce 1050Ti.', '2022-03-16', 'Admin', 'Наука'),
(7, 'Институт русского языка им. В. В. Виноградова не смог найти синоним слова «импортозамещение»', '103859d3fc90.jpg', 'Институт русского языка им. В. В. Виноградова при РАН столкнулся с трудностями при выполнении государственного технического задания по замене англицизмов на исконно русские слова. Специалистам не удалось найти в родном языке подходящую замену слову «импортозамещение».', '2022-03-26', 'Admin', 'Общество');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `headeradmin`
--
ALTER TABLE `headeradmin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `header`
--
ALTER TABLE `header`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `headeradmin`
--
ALTER TABLE `headeradmin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
