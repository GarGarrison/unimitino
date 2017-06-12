INSERT INTO `rubrics_goods` (`id`, `rid`, `gid`) VALUES
(1,2,61818),
(2,2,72798),
(3,2,72223),
(4,2,61940),
(5,2,74480),
(6,2,76145),
(7,2,76093),
(8,34,63346),
(9,34,62370),
(10,34,62444),
(11,34,62995),
(12,34,62322),
(13,34,62761),
(14,34,62647),
(15,34,62778),
(16,38,64829),1500Вт • 100В
(17,38,64830),1500Вт • 100В
(18,38,64838),1500Вт • 200В
(19,38,64846),1500Вт • 27В
(20,38,64849);1500Вт • 30В

INSERT INTO `news` (`id`, `title`, `annotation`, `text`, `important`, `news_date`, `public_date`, `unpublic_date`) VALUES
(1, 'Неважная новость 1', 'неважная аннотация 1', 'неважный текст 1', 0, '2016-09-10 00:00:00', '2016-09-10 00:00:00', '2016-09-30 00:00:00'),
(2, 'Важная новость 1', 'важная аннотация 1', 'важный текст 1', 1, '2016-09-09 00:00:00', '2016-09-07 00:00:00', '2016-09-30 00:00:00'),
(3, 'Важная новость 2', 'важная аннотация 2', 'важный текст 2', 1, '2016-09-09 00:00:00', '2016-09-15 00:00:00', '2016-09-30 00:00:00'),
(4, 'Неважная новость 2', 'неважная аннотация 2', 'неважный текст 2', 0, '2016-09-08 00:00:00', '2016-09-15 00:00:00', '2016-09-30 00:00:00'),
(5, 'Важная новость 3', 'важная аннотация 3', 'важный текст 3', 1, '2016-09-10 00:00:00', '2016-09-10 00:00:00', '2016-09-30 00:00:00'),
(6, 'Неважная новость 3', 'неважная аннотация 3', 'неважный текст 3', 0, '2016-09-07 00:00:00', '2016-09-07 00:00:00', '2016-09-30 00:00:00');

INSERT INTO `rubrics` (`id`, `name`, `url`, `rubric_parents`, `has_child`) VALUES
(1, 'Активные компоненты', 'aktivnie_komponenti', '1', 1),
(2, 'Интегральные компоненты', 'integralnie_komponenti', '1#2', 0),
(3, 'Дискретные компоненты', 'diskretnie_komponenti', '1#3', 1),
(4, 'Пассивные компоненты', 'passivnie_komponenti', '4', 1),
(5, 'Конденсаторы', 'kondensatori', '4#5', 0),
(6, 'Резисторы', 'rezistori', '4#6', 0),
(7, 'Трансформаторы', 'transformatori', '4#7', 0),
(8, 'Материалы и химия', 'materiali_i_himija', '8', 1),
(9, 'Аэрозоли Cramolin', 'aerozoli_cramolin', '8#9', 1),
(10, 'Лаки и покрытия', 'laki_i_pokritija', '8#9#10', 0),
(11, 'Чистящие средства', 'chistjashcie_sredstva', '8#9#11', 0),
(12, 'Смазочные средства', 'smazochnie_sredstva', '8#9#12', 0),
(13, 'Специальные средства', 'specialnie_sredstva', '8#9#13', 0),
(14, 'Материалы для пайки', 'materiali_dlja_pajki', '8#14', 0),
(15, 'Термоусадочная трубка', 'termousadochnaja_trubka', '8#15', 0),
(16, 'По предназначению', 'po_prednaznacheniju', '16', 1),
(17, 'Комплектующие для автомагнитол', 'komplektujushcie_dlja_avtomagnitol', '16#17', 0),
(18, 'Комплектующие для аудио-/видео аппаратуры', 'komplektujushcie_dlja_audio_video', '16#18', 0),
(19, 'Комплектующие для СВЧ-печей', 'komplektujushcie_dlja_svch-pechej', '16#19', 0),
(20, 'Комплектующие для ТВ', 'komplektujushcie_dlja_tv', '16#20', 0),
(21, 'Прочее', 'prochee', '21', 1),
(22, 'Блоки питания', 'bloki_pitanija', '21#22', 0),
(23, 'Инструмент и приборы', 'instrument_i_pribori', '21#23', 0),
(24, 'Предохранители', 'predohraniteli', '21#24', 0),
(25, 'Шлейфы', 'shlejfi', '21#25', 0),
(26, 'ADSL-сплиттеры', 'adsl-splitteri', '21#26', 0),
(27, 'Кварцы и керамические резонаторы', 'kvarci_i_keramicheskie_rezonatori', '21#27', 0),
(28, 'Панельки для микросхем', 'panelki_dlja_mikroshem', '21#28', 0),
(29, 'Разное', 'raznoe', '21#29', 0),
(30, 'Кнопки, переключатели, энкодеры', 'knopki_perekljuchateli_enkoderi', '21#30', 0),
(31, 'Вентиляторы', 'ventiljatori', '21#31', 0),
(32, 'Светодиодные лампы и ленты', 'svetodiodnie_lampi_i_lenti', '21#32', 0),
(33, 'ТЭНы', 'teni', '21#33', 0),
(34, 'Биполярные транзисторы', 'bipolarnie_tranzistori', '1#3#34', 0),
(35, 'Биполярные транзисторы с изолированным затвором', 'bipolarnie_tranzistori_s_izolirovannim_zatvorom', '1#3#35', 0),
(36, 'Полевые транзисторы', 'polevie_tranzistori', '1#3#36', 0),
(37, 'Тиристоры', 'tiristori', '1#3#37', 0),
(38, 'Диоды', 'diodi', '1#3#38', 0),
(39, 'Стабилитроны', 'stabilitron', '1#3#39', 0),
(40, 'Варисторы', 'varistori', '1#3#40', 0),
(41, 'Оптопары', 'optopari', '1#3#41', 0),
(42, 'Диоды для СВЧ-печей', 'diodi_dlja_svch_pechej', '1#3#42', 0),
(43, 'Твердотельные реле', 'tverdotelnie_rele', '1#3#43', 0),
(44, 'Фототранзисторы', 'fototranzistori', '1#3#44', 0),
(45, 'Варикапы', 'varikapi', '1#3#45', 0),
(46, 'Полупроводниковые модули', 'poluprovodnikovie_moduli', '1#3#46', 0);

INSERT INTO `users` (`id`, `name`, `city`, `company`, `post_index`, `address`, `phone`, `bank_name`, `bank_account`, `inn`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'city', 'company1', '123456', 'address1', '123456', 'bank', '123456', '123456', 'q@q.ru', '$2y$10$SLEy0rwyeDFOgW.n83lQxOI9WbHm/6cRvDRTbBEEQmo.OPOxGezL.', 'user', 'ZV3vGpR3CBS6LcyEoggBS14UnQTc1cc5pOWPdme2ktBP1J1Y561KpjPmqhK7', '2016-09-25 18:22:23', '2016-10-24 20:50:25'),
(2, 'Admin', '', '', '', '', '', '', '', '', 'admin@uni.ru', '$2y$10$pNRxF54aWL0A.44fnFT7yuV0yTNs0k4VV2O3CSJfu9F99AF.z1a9.', 'admin', 'dx9HSLLuJW42KL4JZOjlBv3hCokA0px62f8u4SIOLsRGwdcou82ky4rIUCYr', '2016-10-24 19:49:23', '2016-10-25 12:35:42'),
(3, 'Storage', '', '', '', '', '', '', '', '', 'storage@uni.ru', '$2y$10$RboE/J3woSh2GfWEQZXoYOgZjGTu9DEgkh1dZUICUkmzKSGFINKYa', 'storage', 'gMa06jargI75Vq0RABp0O4yUsdl9n64gjX4axShGGY4tY7wr5l7xGNl4RlhN', '2016-10-24 20:22:52', '2016-10-24 20:51:30');


INSERT INTO `params` (`id`, `name`, `column_name`, `type`) VALUES
(1, 'Высота, мм', 'height', 'integer'),
(2, 'Ширина, мм', 'width', 'integer'),
(3, 'Длина вала, мм', 'length_val', 'integer'),
(4, 'Диаметр, мм', 'd', 'integer'),
(5, 'Ток, А', 'i', 'integer'),
(6, 'Напряжение, В', 'u', 'integer'),
(7, 'Номинал, КОм', 'r', 'integer'),
(8, 'Мощность, Вт', 'n', 'integer'),
(9, 'Ёмкость, мкф', 'c', 'integer'),
(10, 'Время срабатывания, нс', 'time', 'integer'),
(11, 'Число каналов (1/2)', 'channel', 'integer'),
(12, 'Зависимость (A/B/C/...)', 'dependence', 'varchar'),
(13, 'Тип корпуса', 'type', 'varchar'),
(14, 'Описание', 'description', 'varchar');

INSERT INTO `rubrics_params` (`id`, `rid`, `pid`) VALUES
(1,38,5),
(2,38,6),
(3,38,8),
(4,38,10),
(5,38,13),
(6,38,14);

INSERT INTO `goods_params` (`id`,`rid`, `gid`, `n`, `u`) VALUES
(1,38,64829,1500,100),
(2,38,64830,1500,100),
(3,38,64838,1500,200),
(4,38,64846,1500,27),
(6,38,64849,1500,30);