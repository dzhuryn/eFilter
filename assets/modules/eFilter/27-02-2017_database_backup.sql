#
# Отель Database Dump
# MODX Version:1.2.1-d9.1.0
# 
# Host: 
# Generation Time: 27-02-2017 20:40:27
# Server version: 5.5.5-10.0.25-MariaDB-0+deb8u1
# PHP Version: 5.6.22-0+deb8u1
# Database: `anandaspa_ru`
# Description: 
#

# --------------------------------------------------------

#
# Table structure for table `modx_survey_variants`
#

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `modx_survey_variants`;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

CREATE TABLE `modx_survey_variants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formid` text NOT NULL,
  `content` text NOT NULL,
  `createdon` datetime NOT NULL,
  `res` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

#
# Dumping data for table `modx_survey_variants`
#

INSERT INTO `modx_survey_variants` VALUES ('39','sotrForm','{\"special\":\"\",\"call\":\"Сотрудничество\",\"call-link\":\"http://anandaspa.ru/o-kurorte-ananda-spa/sotrudnichestvo.html\",\"agent\":\"tes\",\"name\":\"tes\",\"email\":\"tes@tes.com\",\"phone\":\"54543\",\"formid\":\"sotrForm\",\"comments\":\"fdfs fvc\",\"postdate\":\"23-Feb-2017 09:38:49\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-23 09:38:52','1');

INSERT INTO `modx_survey_variants` VALUES ('27','homeForm','{\"zaezd\":false,\"viezd\":false,\"special\":\"\",\"call\":\"???????\",\"call-link\":\"http://anandaspa.ru//\",\"name\":\"Larrygem\",\"email\":\"larry49@mail.ru\",\"phone\":\"89415826158\",\"adult\":\"\",\"child\":\"\",\"formid\":\"homeForm\",\"comments\":\"You can download 160000 Tracks, high Quality 320kbbs. \nBeatport, Traxsource and FLAC 14TB. Private FTP \nAll Genre House, Club, Dance, Minimal, Psy-Trance, Dubstep.... \nhttp://0daymusic.org/premium.php\",\"submit\":\"?????????\",\"postdate\":\"17-Feb-2017 18:56:18\"}','2017-02-17 18:56:18','1');

INSERT INTO `modx_survey_variants` VALUES ('26','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"ewgt45t\",\"email\":\"test@test.ru\",\"phone\":\"2345234523\",\"formid\":\"contactForm\",\"comments\":\"3245234 3 45342 5243 52345 2345\",\"postdate\":\"10-Feb-2017 17:18:24\"}','2017-02-10 17:18:24','2');

INSERT INTO `modx_survey_variants` VALUES ('28','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"43432432\",\"formid\":\"contactForm\",\"comments\":\"ffsdfd dfsdfsd fsdd\",\"postdate\":\"17-Feb-2017 22:39:29\"}','2017-02-17 22:39:29','2');

INSERT INTO `modx_survey_variants` VALUES ('29','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"123456\",\"formid\":\"contactForm\",\"comments\":\"Это тестовое сообщение\",\"postdate\":\"20-Feb-2017 23:20:27\"}','2017-02-20 23:20:27','1');

INSERT INTO `modx_survey_variants` VALUES ('30','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"123456\",\"formid\":\"contactForm\",\"comments\":\"tests\",\"postdate\":\"22-Feb-2017 11:49:12\"}','2017-02-22 11:49:12','1');

INSERT INTO `modx_survey_variants` VALUES ('31','homeForm','{\"zaezd\":\"23/02/2017\",\"viezd\":\"24/02/2017\",\"special\":\"\",\"call\":\"Главная\",\"call-link\":\"http://anandaspa.ru//\",\"name\":\"test3\",\"email\":\"test3@test3.com\",\"phone\":\"3424234\",\"adult\":\"2\",\"child\":\"4\",\"formid\":\"homeForm\",\"comments\":\"test3 \",\"postdate\":\"22-Feb-2017 11:55:07\"}','2017-02-22 11:55:07','1');

INSERT INTO `modx_survey_variants` VALUES ('32','sotrForm','{\"special\":\"\",\"call\":\"Сотрудничество\",\"call-link\":\"http://anandaspa.ru/o-kurorte-ananda-spa/sotrudnichestvo.html\",\"agent\":\"test7\",\"name\":\"test7\",\"email\":\"test7@test7.com\",\"phone\":\"543435435\",\"formid\":\"sotrForm\",\"comments\":\"sfdsfsfs\",\"postdate\":\"22-Feb-2017 12:11:49\"}','2017-02-22 12:11:49','1');

INSERT INTO `modx_survey_variants` VALUES ('33','testimForm','{\"special\":\"\",\"name\":\"tes1\",\"email\":\"tes1@tes1.com\",\"phone\":\"32432432\",\"dates\":\"tes1\",\"inptitle\":\"tes1\",\"formid\":\"testimForm\",\"comments\":\"tes1\",\"postdate\":\"22-Feb-2017 12:56:28\"}','2017-02-22 12:56:28','1');

INSERT INTO `modx_survey_variants` VALUES ('34','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"545435\",\"formid\":\"contactForm\",\"comments\":\"ffsdsd\",\"postdate\":\"22-Feb-2017 15:52:03\"}','2017-02-22 15:52:03','1');

INSERT INTO `modx_survey_variants` VALUES ('35','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@test.rrt\",\"phone\":\"34534252\",\"formid\":\"contactForm\",\"comments\":\"32452345 345 345 2345 23445 \",\"postdate\":\"22-Feb-2017 20:30:12\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-22 20:30:15','1');

INSERT INTO `modx_survey_variants` VALUES ('36','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"43432432\",\"formid\":\"contactForm\",\"comments\":\"fsfsddsf\",\"postdate\":\"23-Feb-2017 09:04:37\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-23 09:04:41','1');

INSERT INTO `modx_survey_variants` VALUES ('37','roomForm','{\"special\":\"\",\"call\":\"Ананда: Блаженство в Гималаях\",\"call-link\":\"http://anandaspa.ru/ayurvedicheskie-programmy/ananda-blazhenstvo-v-gimalayah.html\",\"name\":\"test11\",\"email\":\"test11@test11.com\",\"phone\":\"432432423\",\"formid\":\"roomForm\",\"comments\":\"test11\",\"zaezd\":\"24/02/2017\",\"viezd\":\"24/02/2017\",\"prog\":\"Viceregal Suite\",\"count\":\"7\",\"postdate\":\"23-Feb-2017 09:10:20\"}','2017-02-23 09:10:20','1');

INSERT INTO `modx_survey_variants` VALUES ('38','roomForm','{\"special\":\"\",\"call\":\"Garden View\",\"call-link\":\"http://anandaspa.ru/nomera-v-ananda-spa/garden-view-rooms.html\",\"name\":\"test12\",\"email\":\"test12@test12.com\",\"phone\":\"3456\",\"formid\":\"roomForm\",\"comments\":\"test12 test12\",\"zaezd\":\"25/02/2017\",\"viezd\":\"28/02/2017\",\"prog\":\"Ананда: Омоложение\",\"count\":\"4\",\"postdate\":\"23-Feb-2017 09:15:33\"}','2017-02-23 09:15:33','1');

INSERT INTO `modx_survey_variants` VALUES ('40','checkoutForm','{\"special\":\"\",\"call\":\"Оформление заказа\",\"call-link\":\"http://anandaspa.ru/oformlenie-zakaza.html\",\"room\":\"Garden View \",\"progtitle\":\"Ананда: Для него и для неё\",\"period\":\"1\",\"days\":\"14\",\"count\":\"2\",\"price\":\"13860 $\",\"name\":\"testes\",\"email\":\"testes@testes.com\",\"phone\":\"5445243224\",\"formid\":\"checkoutForm\",\"comments\":\"testes v\",\"postdate\":\"23-Feb-2017 09:42:38\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-23 09:42:40','1');

INSERT INTO `modx_survey_variants` VALUES ('41','testimForm','{\"special\":\"\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"32432\",\"dates\":\"test\",\"inptitle\":\"test\",\"formid\":\"testimForm\",\"comments\":\"test\",\"postdate\":\"23-Feb-2017 09:47:15\"}','2017-02-23 09:47:15','1');

INSERT INTO `modx_survey_variants` VALUES ('42','roomForm','{\"special\":\"\",\"call\":\"Ананда: Блаженство в Гималаях\",\"call-link\":\"http://anandaspa.ru/ayurvedicheskie-programmy/ananda-blazhenstvo-v-gimalayah.html\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"554543543\",\"formid\":\"roomForm\",\"comments\":\"&eFormOnMailSen\",\"zaezd\":\"25/02/2017\",\"viezd\":\"28/02/2017\",\"prog\":\"Viceregal Suite\",\"count\":\"3\",\"postdate\":\"23-Feb-2017 09:48:46\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-23 09:48:48','1');

INSERT INTO `modx_survey_variants` VALUES ('43','reservForm','{\"special\":\"\",\"call\":\"Прайс\",\"call-link\":\"http://anandaspa.ru/prajs.html\",\"zaezd\":\"24/02/2017\",\"viezd\":\"25/02/2017\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"54543543\",\"formid\":\"reservForm\",\"count\":\"3\",\"adult+ parseInt(i+1) +\":\"\",\"child+ parseInt(i+1) +\":\"\",\"comments\":\"test test test\",\"adult1\":\"1\",\"child1\":\"0\",\"adult2\":\"0\",\"child2\":\"2\",\"adult3\":\"2\",\"child3\":\"0\",\"postdate\":\"23-Feb-2017 09:54:37\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-23 09:54:40','1');

INSERT INTO `modx_survey_variants` VALUES ('44','procedForm','{\"special\":\"\",\"call\":\"Гататмак Йога\",\"call-link\":\"http://anandaspa.ru/ayurvedicheskie-procedury/joga/gatatmak-joga.html\",\"zaezd\":\"24/02/2017\",\"viezd\":\"26/02/2017\",\"name\":\"test\",\"email\":\"test@test.com\",\"phone\":\"5434534543545\",\"formid\":\"procedForm\",\"count\":\"4\",\"comments\":\"test-test-test\",\"postdate\":\"23-Feb-2017 10:01:43\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-23 10:01:46','1');

INSERT INTO `modx_survey_variants` VALUES ('45','homeForm','{\"zaezd\":false,\"viezd\":false,\"special\":\"\",\"call\":\"???????\",\"call-link\":\"http://anandaspa.ru//\",\"name\":\"Johnniecam\",\"email\":\"johnnie53@mail.ru\",\"phone\":\"84962927318\",\"adult\":\"\",\"child\":\"\",\"formid\":\"homeForm\",\"comments\":\"You can download 7000000 Tracks, high Quality 320kbbs. \nBeatport, Traxsource and FLAC 14TB. Private FTP \nAll Genre House, Club, Dance, Minimal, Psy-Trance, Dubstep.... \nhttp://0daymusic.org/premium.php\",\"submit\":\"?????????\",\"postdate\":\"26-Feb-2017 13:45:45\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-26 13:45:47','1');

INSERT INTO `modx_survey_variants` VALUES ('46','contactForm','{\"special\":\"\",\"call\":\"Контакты\",\"call-link\":\"http://anandaspa.ru/kontakty.html\",\"name\":\"test\",\"email\":\"test@tes.tu\",\"phone\":\"2345\",\"formid\":\"contactForm\",\"comments\":\"32452345t trst \",\"postdate\":\"27-Feb-2017 20:11:31\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-27 20:11:34','1');

INSERT INTO `modx_survey_variants` VALUES ('47','contactForm','{\"special\":\"\",\"call\":\"Москва\",\"call-link\":\"http://anandaspa.ru/kontakty/kontakty-msk.html\",\"name\":\"test\",\"email\":\"test@tewt.er\",\"phone\":\"23453425\",\"formid\":\"contactForm\",\"comments\":\"ewrterwt\",\"postdate\":\"27-Feb-2017 20:20:12\",\"disclaimer\":\"\",\"subject\":\"Сообщение с сайта Отель\"}','2017-02-27 20:20:14','1');
