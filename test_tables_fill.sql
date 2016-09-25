
INSERT INTO `rubrics` (`name`) VALUES ('test1');
INSERT INTO `rubrics` (`name`) VALUES ('test2');
INSERT INTO `rubrics` (`name`) VALUES ('test3');
INSERT INTO `rubrics` (`name`) VALUES ('test11');
INSERT INTO `rubrics` (`name`) VALUES ('test21');
INSERT INTO `rubrics` (`name`) VALUES ('test12');
INSERT INTO `rubrics` (`name`) VALUES ('test121');

INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (1, '1', TRUE);
INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (2, '2', TRUE);
INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (3, '3', FALSE);
INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (4, '1#4', FALSE);
INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (5, '1#5', TRUE);
INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (6, '2#6', FALSE);
INSERT INTO `rubric_relations` (`rubric_id`, `rubric_parents`, `has_child`) VALUES (7, '1#5#7', FALSE);

INSERT INTO `news` (`title`, `annotation`, `text`, `news_date`, `public_date`, `unpublic_date`, `important`) VALUES ('Неважная новость 1', 'неважная аннотация 1', 'неважный текст 1', '2016-09-10 00:00:00', '2016-09-10 00:00:00', '2016-09-30 00:00:00', FALSE);
INSERT INTO `news` (`title`, `annotation`, `text`, `news_date`, `public_date`, `unpublic_date`, `important`) VALUES ('Важная новость 1', 'важная аннотация 1', 'важный текст 1', '2016-09-09 00:00:00', '2016-09-07 00:00:00', '2016-09-30 00:00:00', TRUE);
INSERT INTO `news` (`title`, `annotation`, `text`, `news_date`, `public_date`, `unpublic_date`, `important`) VALUES ('Важная новость 2', 'важная аннотация 2', 'важный текст 2', '2016-09-09 00:00:00', '2016-09-15 00:00:00', '2016-09-30 00:00:00', TRUE);
INSERT INTO `news` (`title`, `annotation`, `text`, `news_date`, `public_date`, `unpublic_date`, `important`) VALUES ('Неважная новость 2', 'неважная аннотация 2', 'неважный текст 2', '2016-09-08 00:00:00', '2016-09-15 00:00:00', '2016-09-30 00:00:00', FALSE);
INSERT INTO `news` (`title`, `annotation`, `text`, `news_date`, `public_date`, `unpublic_date`, `important`) VALUES ('Важная новость 3', 'важная аннотация 3', 'важный текст 3', '2016-09-10 00:00:00', '2016-09-10 00:00:00', '2016-09-30 00:00:00', TRUE);
INSERT INTO `news` (`title`, `annotation`, `text`, `news_date`, `public_date`, `unpublic_date`, `important`) VALUES ('Неважная новость 3', 'неважная аннотация 3', 'неважный текст 3', '2016-09-07 00:00:00', '2016-09-07 00:00:00', '2016-09-30 00:00:00', FALSE);

INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good1', 10, 'товар good1 очень хорош', 10.5 ,TRUE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');
INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good2', 20, 'товар good2 очень хорош', 111.5 ,FALSE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');
INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good33', 30, 'товар good33 очень хорош', 100.2 ,TRUE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');
INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good111', 1, 'товар good111 очень хорош', 90.5 ,FALSE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');
INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good231', 1, 'товар good231 очень хорош', 5 ,TRUE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');
INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good143', 2, 'товар good143 очень хорош', 50.1 ,FALSE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');
INSERT INTO `goods`(`name`, `count`, `description`, `price`, `new`, `created_at`, `updated_at`) VALUES ('good333', 5, 'товар good333 очень хорош', 100.5 ,TRUE, '2016-09-10 00:00:00', '2016-09-10 00:00:00');