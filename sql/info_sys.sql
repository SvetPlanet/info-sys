-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 14 2018 г., 23:56
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `info_sys`
--

-- --------------------------------------------------------

--
-- Структура таблицы `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idAncestor` int(1) NOT NULL,
  `path` varchar(250) DEFAULT NULL,
  `creationDate` datetime NOT NULL,
  `idAuthor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `archive`
--

INSERT INTO `archive` (`id`, `name`, `idAncestor`, `path`, `creationDate`, `idAuthor`) VALUES
(1, 'Архив', 0, NULL, '2018-05-13 00:00:00', 1),
(2, 'Испытания', 1, NULL, '2018-05-13 00:00:00', 1),
(3, 'Методики', 1, NULL, '2018-05-13 00:00:00', 1),
(4, 'ЗАО «ПОЛИМЕТ»', 2, NULL, '2018-05-13 00:00:00', 1),
(5, 'ЗАО «РИЦ»', 2, NULL, '2018-05-13 00:00:00', 1),
(6, 'ООО ИЦ «Привод-Н»', 2, NULL, '2018-05-13 00:00:00', 1),
(7, 'Блок управления токоприемником', 6, NULL, '2018-05-13 00:00:00', 1),
(8, 'Вентиляционный агрегат', 6, NULL, '2018-05-13 00:00:00', 1),
(9, 'Вспомогательный генератор', 6, NULL, '2018-05-13 00:00:00', 1),
(10, 'Блок выпрямителя', 6, NULL, '2018-05-13 00:00:00', 1),
(11, 'Выпрямитель', 6, NULL, '2018-05-13 00:00:00', 1),
(12, 'Расчет стоимости испытаний хладостойкость', 11, NULL, '2018-05-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `busyness`
--

CREATE TABLE `busyness` (
  `id` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `worktimeId` int(11) NOT NULL,
  `workerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `busyness`
--

INSERT INTO `busyness` (`id`, `eventId`, `worktimeId`, `workerId`) VALUES
(1, 210, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `num` varchar(20) NOT NULL,
  `certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `num`, `certificate`) VALUES
(1, 'Климатическая камера WK3-1200/70/5/V', '226146600190', '№ 127/2017/М-2 от 18 мая 2017 г.');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `type`, `description`) VALUES
(160, 'Испытание калориферной сборки', '2018-05-15 00:00:00', '2018-05-17 00:00:00', 1, ''),
(176, 'Выходной день', '2018-05-12 00:00:00', '2018-05-14 00:00:00', 4, ''),
(177, 'Выходной день', '2018-05-05 00:00:00', '2018-05-07 00:00:00', 4, ''),
(178, 'Выходной день', '2018-05-19 00:00:00', '2018-05-21 00:00:00', 4, ''),
(179, 'Будний день', '2018-05-07 00:00:00', '2018-05-12 00:00:00', 3, ''),
(180, 'Будний день', '2018-04-30 00:00:00', '2018-05-05 00:00:00', 3, ''),
(181, 'Будний день', '2018-05-17 00:00:00', '2018-05-19 00:00:00', 3, ''),
(182, 'Будний день', '2018-05-14 00:00:00', '2018-05-15 00:00:00', 3, ''),
(183, 'Будний день', '2018-05-21 00:00:00', '2018-05-26 00:00:00', 3, ''),
(185, 'Технические работы', '2018-05-28 00:00:00', '2018-05-31 00:00:00', 2, ''),
(190, 'Выходной день', '2018-05-26 00:00:00', '2018-05-28 00:00:00', 4, ''),
(191, 'Будний день', '2018-06-01 00:00:00', '2018-06-02 00:00:00', 3, ''),
(195, 'Выходной день', '2018-06-02 00:00:00', '2018-06-04 00:00:00', 4, ''),
(196, 'Выходной день', '2018-06-16 00:00:00', '2018-06-18 00:00:00', 4, ''),
(197, 'Выходной день', '2018-06-23 00:00:00', '2018-06-25 00:00:00', 4, ''),
(198, 'Выходной день', '2018-06-30 00:00:00', '2018-07-02 00:00:00', 4, ''),
(199, 'Выходной день', '2018-06-12 00:00:00', '2018-06-13 00:00:00', 4, ''),
(200, 'Выходной день', '2018-06-20 00:00:00', '2018-06-22 00:00:00', 4, ''),
(203, 'Ремонтные работы', '2018-06-04 00:00:00', '2018-06-07 00:00:00', 2, ''),
(204, 'Будний день', '2018-06-13 00:00:00', '2018-06-16 00:00:00', 3, ''),
(205, 'Будний день', '2018-06-18 00:00:00', '2018-06-20 00:00:00', 3, ''),
(206, 'Будний день', '2018-06-22 00:00:00', '2018-06-23 00:00:00', 3, ''),
(207, 'Испытание калориферной сборки', '2018-06-25 00:00:00', '2018-06-26 00:00:00', 1, ''),
(210, 'Ремонтные работы', '2018-06-11 00:00:00', '2018-06-12 00:00:00', 2, 'Ремонтные работы климатической камеры типа WK27\'/60-85'),
(211, 'Будний день', '2018-06-26 00:00:00', '2018-06-30 00:00:00', 3, ''),
(212, 'Выходной день', '2018-06-09 00:00:00', '2018-06-11 00:00:00', 4, ''),
(213, 'Испытание калориферной сборки', '2018-06-07 00:00:00', '2018-06-09 00:00:00', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `eventTypes`
--

CREATE TABLE `eventTypes` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `eventTypes`
--

INSERT INTO `eventTypes` (`id`, `name`, `color`) VALUES
(1, 'Испытание', '#66CDAA'),
(2, 'Технические работы', '#917C78'),
(3, 'Будний день', '#D3D3D3'),
(4, 'Выходной день', '#ff0000');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `link` varchar(250) NOT NULL,
  `creationDate` datetime NOT NULL,
  `idAuthor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `methods_cats`
--

CREATE TABLE `methods_cats` (
  `id` int(11) NOT NULL,
  `cypher` varchar(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `standardId` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `methods_cats`
--

INSERT INTO `methods_cats` (`id`, `cypher`, `name`, `standardId`, `description`) VALUES
(1, '203-1', 'Испытание на воздействие нижнего значения температуры среды при эксплуатации. Испытание негреющихся изделий.', 1, ''),
(2, '206', 'Испытание на воздействие инея с последующим его оттаиванием.', 2, '');

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL,
  `okpd2_cypher` varchar(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `width` int(11) NOT NULL,
  `width1` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `okpd2_cypher`, `name`, `weight`, `width`, `width1`, `height`) VALUES
(1, '', 'Калориферная сборка КС-50-ЭС2Г', '152', 1185, 829, 615);

-- --------------------------------------------------------

--
-- Структура таблицы `Organizations`
--

CREATE TABLE `Organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Organizations`
--

INSERT INTO `Organizations` (`id`, `name`, `phone`, `email`) VALUES
(1, 'ООО «ИЦ Привод-Н»', NULL, NULL),
(2, 'ООО «Остров СКВ»', NULL, NULL),
(3, 'ЗАО «ПОЛИМЕТ»', '', ''),
(4, 'ЗАО «РИЦ»', '', ''),
(5, 'ООО  \"ИЦ Оптикэнерго\"', '', ''),
(6, 'Приборостроительный завод', '89270005500', '');

-- --------------------------------------------------------

--
-- Структура таблицы `price_variables`
--

CREATE TABLE `price_variables` (
  `id` int(11) NOT NULL,
  `name` varchar(5) NOT NULL,
  `subname` varchar(3) DEFAULT NULL,
  `description` text NOT NULL,
  `value` double DEFAULT NULL,
  `const` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `price_variables`
--

INSERT INTO `price_variables` (`id`, `name`, `subname`, `description`, `value`, `const`) VALUES
(1, 'L', NULL, 'Cредняя дневная ставка сотрудника ИЛ (руб.*чел./дн.)', 3500, 1),
(2, 'К', 'нз', 'Норматив начислений на з/п, установленный законодательством, %', 30.2, 1),
(3, 'К', 'нр', 'Коэффициент накладных расходов ИЛ, %', NULL, 0),
(4, 'Р', '', 'Уровень рентабельности, %', NULL, 0),
(5, 't', 'р', 'Трудоемкость рассмотрения документов и регистрации заявки на проведение испытаний, идентификации и проверки параметров ОИ, разработки и согласования\r\nпрограммы испытаний, адаптированной к конкретным условиям ЛКИ, а также\r\nобработки и документирования результатов испытаний (чел./дн.)', 1, 1),
(6, 't', 'п', 'Трудоемкость проектирования и изготовления специальных приспособлений и оснастки (чел./дн.)', NULL, 0),
(7, 't', 'ап', 'Трудоемкость проектирования и изготовления специальных приспособлений и оснастки (чел./дн.)', 1.2, 1),
(8, 't', 'пз', 'Трудоемкость проектирования изготовления специальных приспособлений и оснастки (чел./дн.)', NULL, 0),
(9, 't', 'ио', 'Время занятости ИО при испытаниях ОИ (чел./дн.)', NULL, 0),
(10, 'К', 'ио', 'Нормативный коэффициент затрат времени на ТО, ремонт и период, аттестацию\r\nИО, поверку СИ и КО', 0.16, 1),
(11, 't', 'm', 'Cредняя трудоемкость проверки одной характеристики или измерения одного\r\nпараметра ОИ при испытаниях (чел./дн)', 0.02, 1),
(12, 'm', NULL, 'Общее количество проверяемых характеристик и измеряемых параметров ОИ', 1, 1),
(13, 'K', 'м', 'Нормативный коэффициент затрат времени на техническое обслуживание и периодическую проверку и проверку используемых СИ, КО', 0.1, 1),
(14, 'K', 'л', 'Коэффициент лояльности', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `standards`
--

CREATE TABLE `standards` (
  `id` int(11) NOT NULL,
  `cypher` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('действует','устарел','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `standards`
--

INSERT INTO `standards` (`id`, `cypher`, `name`, `status`) VALUES
(1, 'ГОСТ 30630.2.1-2013', 'Методы испытаний на стойкость к климатическим внешним воздействующим факторам машин, приборов и других технических изделий. Испытания на устойчивость к воздействию температуры.', 'действует'),
(2, 'ГОСТ Р 51369-99', 'Методы испытаний на стойкость к климатическим внешним воздействующим факторам машин, приборов и других технических изделий. Испытания на воздействие влажности.', 'действует');

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `eventId` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `status` enum('в процессе','завершено','','') NOT NULL,
  `idOrganization` int(11) NOT NULL,
  `idObject` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `authorId` int(11) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `name`, `eventId`, `duration`, `status`, `idOrganization`, `idObject`, `price`, `authorId`, `description`) VALUES
(1, 'Испытание калориферной сборки', 1, 240, 'завершено', 2, 1, '0', 1, 'Комбинированное испытание калориферной сборки КС-50-ЭС2Г на стойкость к воздействию нижнего значения температуры и инея с последующим оттаиванием проводят на основе методов 203-1 (п.6.12 ГОСТ 30630.2.1-2013) 206 (п. 7 ГОСТ Р 51369-99 п.7). Калориферная сборка КС-50-ЭС2Г помещается в климатическую камеру, в которой задается температура -50°С, после чего изделие выдерживается при заданной температуре 10 часов. Затем температура повышается до -10°С, после чего изделие выдерживается при заданной температуре 5 минут и извлекается в нормальные климатические условия, в следствии чего образуется иней. После полного оттаивания проводится проверка внешнего вида изделия. Изделие считают выдержавшим испытание, если не было обнаружено коррозии деталей или нарушения лакокрасочных покрытий.');

-- --------------------------------------------------------

--
-- Структура таблицы `tests_equipments`
--

CREATE TABLE `tests_equipments` (
  `id` int(11) NOT NULL,
  `idTest` int(11) NOT NULL,
  `idEquipment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests_equipments`
--

INSERT INTO `tests_equipments` (`id`, `idTest`, `idEquipment`) VALUES
(1, 1, 1),
(3, 3, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tests_methods`
--

CREATE TABLE `tests_methods` (
  `id` int(11) NOT NULL,
  `testId` int(11) NOT NULL,
  `methodId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests_methods`
--

INSERT INTO `tests_methods` (`id`, `testId`, `methodId`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 3, 2),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tests_standards`
--

CREATE TABLE `tests_standards` (
  `id` int(11) NOT NULL,
  `idTest` int(11) NOT NULL,
  `idStandard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests_standards`
--

INSERT INTO `tests_standards` (`id`, `idTest`, `idStandard`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(24) NOT NULL,
  `password` varchar(250) NOT NULL,
  `workerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `workerId`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `name`, `position`, `phone`) VALUES
(1, 'Русейкин Николай', 'Инженер по оборудованию ЦПИ', '89176908765'),
(2, 'Зароченцев Н.', 'Инженер-испытатель ЦПИ', ''),
(3, 'РаботникНейм', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `worktime`
--

CREATE TABLE `worktime` (
  `id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `worktime`
--

INSERT INTO `worktime` (`id`, `start`, `end`) VALUES
(1, '09:00:00', '18:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `busyness`
--
ALTER TABLE `busyness`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `num` (`num`),
  ADD UNIQUE KEY `certificate` (`certificate`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `eventTypes`
--
ALTER TABLE `eventTypes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `methods_cats`
--
ALTER TABLE `methods_cats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Organizations`
--
ALTER TABLE `Organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `price_variables`
--
ALTER TABLE `price_variables`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cypher` (`cypher`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests_equipments`
--
ALTER TABLE `tests_equipments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests_methods`
--
ALTER TABLE `tests_methods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests_standards`
--
ALTER TABLE `tests_standards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `workerId` (`workerId`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `worktime`
--
ALTER TABLE `worktime`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `busyness`
--
ALTER TABLE `busyness`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;
--
-- AUTO_INCREMENT для таблицы `eventTypes`
--
ALTER TABLE `eventTypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `methods_cats`
--
ALTER TABLE `methods_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `Organizations`
--
ALTER TABLE `Organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `price_variables`
--
ALTER TABLE `price_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `standards`
--
ALTER TABLE `standards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `tests_equipments`
--
ALTER TABLE `tests_equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `tests_methods`
--
ALTER TABLE `tests_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `tests_standards`
--
ALTER TABLE `tests_standards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `worktime`
--
ALTER TABLE `worktime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
