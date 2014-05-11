DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `feeds`;
CREATE TABLE `feeds` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_name` varchar(255) NOT NULL,
  `rss_link` varchar(255) NOT NULL,
  `update_frequency` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`entity_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO  `rss`.`feeds` (`entity_id` , `feed_name`, `rss_link`)
VALUES (
NULL , 'Reporter UA', 'http://reporter-ua.com/xml_export/yandex'
), (
NULL , 'В Городе','http://zp.vgorode.ua/rss2.xml?city_id=35'
), (
NULL , '061.ua', 'http://www.061.ua/rss'
), (
NULL , 'Голос Запорожья', 'http://golos.zp.ua/novosti?format=feed&type=rss'
), (
NULL , 'Запорожье.comments.ua', 'http://zp.comments.ua/export/rss_zp_ru.xml'
);

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_link` varchar(255) NOT NULL,
  `news_date` varchar(255) NOT NULL,
  `news_text` text,
  `news_stat` varchar(255) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `unite_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  PRIMARY KEY (`entity_id`),
  KEY `feed_id` (`feed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `feeds`
  ADD CONSTRAINT `feeds_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;