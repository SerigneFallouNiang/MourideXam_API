-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: mouridEdu_test_test2
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_one` tinyint(1) NOT NULL DEFAULT '0',
  `question_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `translations` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (95,'a) Se monter au grand jour',0,1,'2024-11-11 20:01:38','2024-11-11 20:01:38','{\"ar\": {\"text\": \"(أ) الوصول إلى المنفتح\"}, \"en\": {\"text\": \"(a) Getting to the open\"}, \"wo\": {\"text\": \"a) Se monter au grand jour\"}}'),(96,'b) Se cacher et être déterminé',1,1,'2024-11-11 20:01:39','2024-11-11 20:01:39','{\"ar\": {\"text\": \"(ب) الاختباء وتحديده\"}, \"en\": {\"text\": \"(b) Hide and be determined\"}, \"wo\": {\"text\": \"b) Se cacher et être déterminé\"}}'),(97,'c) Se plaine des difficultés',0,1,'2024-11-11 20:01:39','2024-11-11 20:01:39','{\"ar\": {\"text\": \"(ج) حالة الصعوبات\"}, \"en\": {\"text\": \"(c) Plain of difficulties\"}, \"wo\": {\"text\": \"c) Se plaine des difficultés\"}}'),(98,'a) Se simple constamment',0,2,'2024-11-11 20:02:05','2024-11-11 20:02:05','{\"ar\": {\"text\": \"(أ) بسيطة باستمرار\"}, \"en\": {\"text\": \"(a) Simple constantly\"}, \"wo\": {\"text\": \"a) Se simple constamment\"}}'),(99,'b) Les affronteurs de courage',1,2,'2024-11-11 20:02:05','2024-11-11 20:02:05','{\"ar\": {\"text\": \"(ب) المشجعة\"}, \"en\": {\"text\": \"(b) Courage affronters\"}, \"wo\": {\"text\": \"b) Les affronteurs de courage\"}}'),(100,'c) Abandonner face aux difficultés',0,2,'2024-11-11 20:02:05','2024-11-11 20:02:05','{\"ar\": {\"text\": \"(ج) التخلي عن الصعوبات\"}, \"en\": {\"text\": \"(c) Abandonment of difficulties\"}, \"wo\": {\"text\": \"c) Abandonner face aux difficultés\"}}'),(101,'a) Parce que la science est donnée à ceux qui se plaignent',0,3,'2024-11-11 20:03:37','2024-11-11 20:03:37','{\"ar\": {\"text\": \"(أ) لأن العلم يمنح لمن يشتكي\"}, \"en\": {\"text\": \"(a) Because science is given to those who complain\"}, \"wo\": {\"text\": \"a) Parce que la science est donnée à ceux qui se plaignent\"}}'),(102,'b) Parce que Dieu élève son serviteur patient',1,3,'2024-11-11 20:03:37','2024-11-11 20:03:37','{\"ar\": {\"text\": \"(ب) لأن الله يربي مريضه\"}, \"en\": {\"text\": \"(b) Because God Raises His Patient Servant\"}, \"wo\": {\"text\": \"b) Parce que Dieu élève son serviteur patient\"}}'),(103,'c) Parce que la faim est plus importante que la science',0,3,'2024-11-11 20:03:37','2024-11-11 20:03:37','{\"ar\": {\"text\": \"(ج) لأن الجوع أهم من العلم\"}, \"en\": {\"text\": \"(c) Because hunger is more important than science\"}, \"wo\": {\"text\": \"c) Parce que la faim est plus importante que la science\"}}'),(104,'a) Réviser régulièrement et constamment',1,4,'2024-11-11 20:04:32','2024-11-11 20:04:32','{\"ar\": {\"text\": \"(أ) الاستعراض المنتظم والمستمر\"}, \"en\": {\"text\": \"(a) Review regularly and constantly\"}, \"wo\": {\"text\": \"a) Réviser régulièrement et constamment\"}}'),(105,'b) Se contenter d\'apprendre une fois',0,4,'2024-11-11 20:04:33','2024-11-11 20:04:33','{\"ar\": {\"text\": \"(ب) تتعلم مرة\"}, \"en\": {\"text\": \"(b) Just learn once\"}, \"wo\": {\"text\": \"b) Se contenter d\'apprendre une fois\"}}'),(106,'c) Ne jamais réviser',0,4,'2024-11-11 20:04:33','2024-11-11 20:04:33','{\"ar\": {\"text\": \"(ج) عدم إجراء استعراض\"}, \"en\": {\"text\": \"(c) Never review\"}, \"wo\": {\"text\": \"c) Ne jamais réviser\"}}'),(107,'a) Chercher l\'argent en même temps',1,5,'2024-11-11 20:05:37','2024-11-11 20:05:37','{\"ar\": {\"text\": \"(أ) البحث عن المال في الوقت نفسه\"}, \"en\": {\"text\": \"(a) Look for money at the same time\"}, \"wo\": {\"text\": \"a) Chercher l\'argent en même temps\"}}'),(108,'b) Se concentrer uniquement sur l\'argent',0,5,'2024-11-11 20:05:37','2024-11-11 20:05:37','{\"ar\": {\"text\": \"(ب) التركيز فقط على المال\"}, \"en\": {\"text\": \"(b) Focusing only on money\"}, \"wo\": {\"text\": \"b) Se concentrer uniquement sur l\'argent\"}}'),(109,'c) Éviter de demander de l\'aide',0,5,'2024-11-11 20:05:37','2024-11-11 20:05:37','{\"ar\": {\"text\": \"(ج) تجنب التماس المساعدة\"}, \"en\": {\"text\": \"(c) Avoid seeking assistance\"}, \"wo\": {\"text\": \"c) Éviter de demander de l\'aide\"}}'),(110,'a) Le jugement des autres',0,6,'2024-11-11 20:05:53','2024-11-11 20:05:53','{\"ar\": {\"text\": \"(أ) حكم الآخرين\"}, \"en\": {\"text\": \"(a) The judgment of others\"}, \"wo\": {\"text\": \"a) Le jugement des autres\"}}'),(111,'b) Dieu et sa religion, l\'Islam',1,6,'2024-11-11 20:05:53','2024-11-11 20:05:53','{\"ar\": {\"text\": \"(ب) الله وديانته، الإسلام\"}, \"en\": {\"text\": \"(b) God and His Religion, Islam\"}, \"wo\": {\"text\": \"b) Dieu et sa religion, l\'Islam\"}}'),(112,'c) La faim',0,6,'2024-11-11 20:05:54','2024-11-11 20:05:54','{\"ar\": {\"text\": \"(ج) الجوع\"}, \"en\": {\"text\": \"(c) Hunger\"}, \"wo\": {\"text\": \"c) La faim\"}}'),(113,'a) Se rapprocher des jeunes filles mariées ou en âge de se marier',1,7,'2024-11-11 20:06:04','2024-11-11 20:06:04','{\"ar\": {\"text\": \"(أ) الاقتراب من الفتيات المتزوجات أو المتزوجات\"}, \"en\": {\"text\": \"(a) Getting closer to married or married girls\"}, \"wo\": {\"text\": \"a) Se rapprocher des jeunes filles mariées ou en âge de se marier\"}}'),(114,'b) Avoir des amis proches',0,7,'2024-11-11 20:06:04','2024-11-11 20:06:04','{\"ar\": {\"text\": \"(ب) وجود أصدقاء مقربين\"}, \"en\": {\"text\": \"(b) Having close friends\"}, \"wo\": {\"text\": \"b) Avoir des amis proches\"}}'),(115,'c) Voyager loin',0,7,'2024-11-11 20:06:05','2024-11-11 20:06:05','{\"ar\": {\"text\": \")ج( السفر بعيدا\"}, \"en\": {\"text\": \"(c) Traveling far\"}, \"wo\": {\"text\": \"c) Voyager loin\"}}'),(116,'a) Sacrifier l\'au-delà pour ce monde',0,8,'2024-11-11 20:06:15','2024-11-11 20:06:15','{\"ar\": {\"text\": \"(أ) التضحية بالعالم التالي\"}, \"en\": {\"text\": \"(a) Sacrificing the Hereafter for this World\"}, \"wo\": {\"text\": \"a) Sacrifier l\'au-delà pour ce monde\"}}'),(117,'b) Échanger la lumière pour l\'obscurité',0,8,'2024-11-11 20:06:16','2024-11-11 20:06:16','{\"ar\": {\"text\": \"(b) Exchange Light for Darkness\"}, \"en\": {\"text\": \"(b) Exchange Light for Darkness\"}, \"wo\": {\"text\": \"b) Échanger la lumière pour l\'obscurité\"}}'),(118,'c) Ne pas sacrifier l\'au-delà pour ce monde',1,8,'2024-11-11 20:06:16','2024-11-11 20:06:16','{\"ar\": {\"text\": \"(ج) لا تضحي بالعالم التالي:\"}, \"en\": {\"text\": \"(c) Do not sacrifice the Hereafter for this world\"}, \"wo\": {\"text\": \"c) Ne pas sacrifier l\'au-delà pour ce monde\"}}');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `translations` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_category_id_foreign` (`category_id`),
  CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'partie 30','livres/CV0tBbWaxImgiUVYwO7qKEDiNb7HoIeTSOyZkYfO.png','30e - partie',5,'2024-10-21 10:26:16','2024-10-21 10:26:16','{\"ar\": {\"title\": \"الجزء 30\", \"description\": \"الجزء ٣٠\"}, \"en\": {\"title\": \"part 30\", \"description\": \"30th part\"}, \"wo\": {\"title\": \"partie 30\", \"description\": \"30e - partie\"}}'),(2,'partie 29','livres/GkY1SoxMJFMpqVyGZsTOwUi1xXfzv6P56jxzU6L9.png','29e - partie',5,'2024-10-21 10:26:55','2024-10-21 10:26:55','{\"ar\": {\"title\": \"الجزء 29\", \"description\": \"الجزء التاسع والعشرون\"}, \"en\": {\"title\": \"part 29\", \"description\": \"29th part\"}, \"wo\": {\"title\": \"partie 29\", \"description\": \"29e - partie\"}}'),(3,'partie 28','livres/2y1wMVnYiZY9HtWoaE0dG0lZExSZYYDtTLzmxW3l.png','28e - partie',5,'2024-10-21 10:27:35','2024-10-21 10:27:35','{\"ar\": {\"title\": \"الباب 28\", \"description\": \"الجزء 28\"}, \"en\": {\"title\": \"part 28\", \"description\": \"28th part\"}, \"wo\": {\"title\": \"partie 28\", \"description\": \"28e - partie\"}}'),(4,'partie 27','livres/AO3KuKcg8s9U8VWUSfjIBjQpUwrd1hMKTbmn05Lc.png','27e - partie',5,'2024-10-21 10:28:07','2024-10-21 10:28:07','{\"ar\": {\"title\": \"الباب 27\", \"description\": \"الجزء السابع والعشرون\"}, \"en\": {\"title\": \"part 27\", \"description\": \"27th part\"}, \"wo\": {\"title\": \"partie 27\", \"description\": \"27e - partie\"}}'),(5,'partie 26','livres/kQYUk3zhuEJs59zFgUpXNTY0OeGs3OtFQAYpCtaV.png','26e -partie',5,'2024-10-21 10:28:37','2024-10-21 10:28:37','{\"ar\": {\"title\": \"الجزء 26\", \"description\": \"الجزء السادس والعشرون\"}, \"en\": {\"title\": \"part 26\", \"description\": \"26th part\"}, \"wo\": {\"title\": \"partie 26\", \"description\": \"26e -partie\"}}'),(6,'partie 25','livres/zCC624w2HM5DAywHbcFTpOx6HG5LNwqQKR8DxSfX.png','25e - partie',5,'2024-10-21 10:29:08','2024-10-21 10:29:08','{\"ar\": {\"title\": \"الجزء 25\", \"description\": \"الجزء الخامس والعشرون\"}, \"en\": {\"title\": \"part 25\", \"description\": \"25th part\"}, \"wo\": {\"title\": \"partie 25\", \"description\": \"25e - partie\"}}'),(8,'partie 24','livres/WVZY4RZPkIVTZtJeN62rGMF1cwNFnVekQiWuHwEQ.png','24e - partie',5,'2024-10-21 10:31:17','2024-10-21 10:31:17','{\"ar\": {\"title\": \"الجزء 24\", \"description\": \"الجزء 24\"}, \"en\": {\"title\": \"part 24\", \"description\": \"24th part\"}, \"wo\": {\"title\": \"partie 24\", \"description\": \"24e - partie\"}}'),(9,'partie 23','livres/Js15CS8kNyL0W1aVYzv7zoS2DkaokYF4e4TuBo0c.png','23e - partie',5,'2024-10-21 10:31:51','2024-10-21 10:31:51','{\"ar\": {\"title\": \"الجزء 23\", \"description\": \"الجزء الثالث والعشرون\"}, \"en\": {\"title\": \"part 23\", \"description\": \"23rd part\"}, \"wo\": {\"title\": \"partie 23\", \"description\": \"23e - partie\"}}'),(10,'partie 22','livres/ev4nc4EebZrs4EGbB2Q4njaKt9y6A7AyiaR1prb4.png','22e - partie',5,'2024-10-21 10:32:22','2024-10-21 10:32:22','{\"ar\": {\"title\": \"الجزء 22\", \"description\": \"الجزء 22\"}, \"en\": {\"title\": \"part 22\", \"description\": \"part 22\"}, \"wo\": {\"title\": \"partie 22\", \"description\": \"22e - partie\"}}'),(11,'partie 21','livres/faQaSoUehhlzKX2ylClOGZMxTJeSc8Ba42gyhj6X.png','21e - partie',5,'2024-10-21 10:33:05','2024-10-21 10:33:05','{\"ar\": {\"title\": \"الجزء 21\", \"description\": \"الجزء الحادي والعشرون\"}, \"en\": {\"title\": \"part 21\", \"description\": \"21st part\"}, \"wo\": {\"title\": \"partie 21\", \"description\": \"21e - partie\"}}'),(12,'partie 20','livres/1DCRjUyQRbU3PlS1HD4LUjivXmzBm4ybGsPHzWR7.png','20e - partie',5,'2024-10-21 10:33:38','2024-10-21 10:33:38','{\"ar\": {\"title\": \"الجزء 20\", \"description\": \"الجزء العشرين\"}, \"en\": {\"title\": \"part 20\", \"description\": \"20th part\"}, \"wo\": {\"title\": \"partie 20\", \"description\": \"20e - partie\"}}'),(13,'partie 19','livres/jOSP4R1ucdzAEp3Y2EDYlwnAczdWn0XC7sVDxUk9.png','19e - partie',5,'2024-10-21 10:34:27','2024-10-21 10:34:27','{\"ar\": {\"title\": \"الجزء 19\", \"description\": \"الجزء التاسع عشر\"}, \"en\": {\"title\": \"part 19\", \"description\": \"19th part\"}, \"wo\": {\"title\": \"partie 19\", \"description\": \"19e - partie\"}}'),(14,'partie 18','livres/azqpb636YnITlCrs0eFm5whKpNQDV8gRwKBMRhbw.png','18e - partie',5,'2024-10-21 10:35:03','2024-10-21 10:35:03','{\"ar\": {\"title\": \"الجزء 18\", \"description\": \"الجزء 18\"}, \"en\": {\"title\": \"part 18\", \"description\": \"part 18\"}, \"wo\": {\"title\": \"partie 18\", \"description\": \"18e - partie\"}}'),(15,'partie 17','livres/APvsuktsoK8R788Y3I9qfW3etvJ4jeFodIRG4in8.png','17e - partie',5,'2024-10-21 10:35:33','2024-10-21 10:35:33','{\"ar\": {\"title\": \"الجزء 17\", \"description\": \"الجزء السابع عشر\"}, \"en\": {\"title\": \"part 17\", \"description\": \"17th part\"}, \"wo\": {\"title\": \"partie 17\", \"description\": \"17e - partie\"}}'),(16,'partie 16','livres/lTpLkcQ5AdYqa9GVAhgRQm6MQTusJlMA5uKQjzmw.png','16e - partie',5,'2024-10-21 10:36:02','2024-10-21 10:36:02','{\"ar\": {\"title\": \"الجزء 16\", \"description\": \"الجزء السادس عشر\"}, \"en\": {\"title\": \"part 16\", \"description\": \"16th part\"}, \"wo\": {\"title\": \"partie 16\", \"description\": \"16e - partie\"}}'),(17,'partie 15','livres/3MeLuoVDEiOEZ5DyqEHbfjm7BOhCzajft3xsoiQQ.png','15e - partie',5,'2024-10-21 10:36:28','2024-10-21 10:36:28','{\"ar\": {\"title\": \"الجزء 15\", \"description\": \"الجزء الخامس عشر\"}, \"en\": {\"title\": \"part 15\", \"description\": \"15th part\"}, \"wo\": {\"title\": \"partie 15\", \"description\": \"15e - partie\"}}'),(18,'partie 14','livres/2AkIE4bdTxQGoL2RhQImzAnzcqQKlGVPttyO6zar.png','14e - partie',5,'2024-10-21 10:37:07','2024-10-21 10:37:07','{\"ar\": {\"title\": \"الجزء 14\", \"description\": \"الجزء الرابع عشر\"}, \"en\": {\"title\": \"part 14\", \"description\": \"14th part\"}, \"wo\": {\"title\": \"partie 14\", \"description\": \"14e - partie\"}}'),(19,'partie 13','livres/VyvHJeJrrXrGv1EPMc2CxsucXPcOUuTlavPNWZUd.png','13e - partie',5,'2024-10-21 10:37:45','2024-10-21 10:37:45','{\"ar\": {\"title\": \"الجزء 13\", \"description\": \"الجزء الثالث عشر\"}, \"en\": {\"title\": \"part 13\", \"description\": \"13th part\"}, \"wo\": {\"title\": \"partie 13\", \"description\": \"13e - partie\"}}'),(20,'partie 12','livres/9gAYw4gV9MBjoaFcK9CrfluvtpWKPUHLOVmIBiWT.png','12e -partie',5,'2024-10-21 10:38:12','2024-10-21 10:38:12','{\"ar\": {\"title\": \"الجزء 12\", \"description\": \"الجزء 12\"}, \"en\": {\"title\": \"part 12\", \"description\": \"part 12\"}, \"wo\": {\"title\": \"partie 12\", \"description\": \"12e -partie\"}}'),(21,'partie 11','livres/pYnhqWiQtClTZvZZ5ajTYHCmaO81uT7TGwd4jBZr.png','11e - partie',5,'2024-10-21 10:38:39','2024-10-21 10:38:39','{\"ar\": {\"title\": \"الجزء 11\", \"description\": \"الجزء الحادي عشر\"}, \"en\": {\"title\": \"part 11\", \"description\": \"11th part\"}, \"wo\": {\"title\": \"partie 11\", \"description\": \"11e - partie\"}}'),(22,'partie 10','livres/Y2Uv3F73j43vcVMoSdUShymK5MeJ0XciS52DbjPp.png','10e - partie',5,'2024-10-21 10:39:12','2024-10-21 10:39:12','{\"ar\": {\"title\": \"الجزء 10\", \"description\": \"الجزء العاشر\"}, \"en\": {\"title\": \"part 10\", \"description\": \"10th part\"}, \"wo\": {\"title\": \"partie 10\", \"description\": \"10e - partie\"}}'),(23,'partie 9','livres/WJEq3VrTNjNTnXr178YypHSQpMDC0kYPZIMKePQv.png','9e - partie',5,'2024-10-21 10:39:46','2024-10-21 10:39:46','{\"ar\": {\"title\": \"الجزء 9\", \"description\": \"الجزء 9\"}, \"en\": {\"title\": \"part 9\", \"description\": \"part 9\"}, \"wo\": {\"title\": \"partie 9\", \"description\": \"9e - partie\"}}'),(24,'partie 8','livres/6OYFKzZQEdVBlXXcLpFK2FXHjKYsiYbJPT33khzc.png','8e - partie',5,'2024-10-21 10:40:16','2024-10-21 10:40:16','{\"ar\": {\"title\": \"الجزء 8\", \"description\": \"الجزء 8\"}, \"en\": {\"title\": \"part 8\", \"description\": \"part 8\"}, \"wo\": {\"title\": \"partie 8\", \"description\": \"8e - partie\"}}'),(25,'partie 7','livres/4pJQXApv4rnH89yML5jKgq8TIRg9ntOYftXhl2K2.png','7e - partie',5,'2024-10-21 10:40:55','2024-10-21 10:40:55','{\"ar\": {\"title\": \"الجزء 7\", \"description\": \"الجزء السابع\"}, \"en\": {\"title\": \"part 7\", \"description\": \"7th part\"}, \"wo\": {\"title\": \"partie 7\", \"description\": \"7e - partie\"}}'),(26,'partie 6','livres/PeVb4ge6OsHTD1EZaGq5eKS2oxTOZ94FF6bqa0kW.png','6e - partie',5,'2024-10-21 10:41:23','2024-10-21 10:41:23','{\"ar\": {\"title\": \"الجزء السادس\", \"description\": \"الجزء السادس\"}, \"en\": {\"title\": \"part 6\", \"description\": \"part 6\"}, \"wo\": {\"title\": \"partie 6\", \"description\": \"6e - partie\"}}'),(27,'partie 5','livres/KMGIX3WMx6XG44kK3NWoC1gcpO97MWwVYTX23PAO.png','5e - partie',5,'2024-10-21 10:41:51','2024-10-21 10:41:51','{\"ar\": {\"title\": \"الجزء 5\", \"description\": \"الجزء الخامس\"}, \"en\": {\"title\": \"part 5\", \"description\": \"5th part\"}, \"wo\": {\"title\": \"partie 5\", \"description\": \"5e - partie\"}}'),(28,'partie 4','livres/i91LPTWqd2Pz9RnXDtgt8gQxogyDe5TWAF4hf7UP.png','4e - partie',5,'2024-10-21 10:42:25','2024-10-21 10:42:25','{\"ar\": {\"title\": \"الجزء 4\", \"description\": \"الجزء الرابع\"}, \"en\": {\"title\": \"part 4\", \"description\": \"4th part\"}, \"wo\": {\"title\": \"partie 4\", \"description\": \"4e - partie\"}}'),(29,'partie 3','livres/zig2K0VakpIz6Tp0jxXNoP6mXCVN5eIbJ6Wuvktd.png','3e - partie',5,'2024-10-21 10:42:52','2024-10-21 10:42:52','{\"ar\": {\"title\": \"الجزء 3\", \"description\": \"الجزء الثالث\"}, \"en\": {\"title\": \"part 3\", \"description\": \"3rd part\"}, \"wo\": {\"title\": \"partie 3\", \"description\": \"3e - partie\"}}'),(30,'partie 2','livres/P2iaNm9bL9gfB2aUfqUaM8DL9Pnz0z7PT5dqr8KI.png','2e - partie',5,'2024-10-21 10:43:21','2024-10-21 10:43:21','{\"ar\": {\"title\": \"الجزء الثاني\", \"description\": \"الجزء الثاني\"}, \"en\": {\"title\": \"part 2\", \"description\": \"part 2\"}, \"wo\": {\"title\": \"partie 2\", \"description\": \"2e - partie\"}}'),(31,'partie 1','livres/NVkDwWK0gi7WJCFaHjMYq5rkbx5Tz66n6Kw6oqwP.png','1e - partie',5,'2024-10-21 10:43:51','2024-10-21 10:43:51','{\"ar\": {\"title\": \"الجزء الأول\", \"description\": \"الجزء الأول\"}, \"en\": {\"title\": \"part 1\", \"description\": \"part 1\"}, \"wo\": {\"title\": \"partie 1\", \"description\": \"1e - partie\"}}'),(32,'Koun kaatiman','livres/DSG6OTev8t2IglIaHV9N88S5tRnwPI9akqcO2MXY.png','à tous ceux qui veulent acquérir dusavoir',7,'2024-10-21 10:44:26','2024-10-21 10:44:26','{\"ar\": {\"title\": \"كون كاتيمان\", \"description\": \"إلى كل من يريد اكتساب المعرفة\"}, \"en\": {\"title\": \"Koun kaatiman\", \"description\": \"to all those who want to acquire knowledge\"}, \"wo\": {\"title\": \"Koun kaatiman\", \"description\": \"à tous ceux qui veulent acquérir dusavoir\"}}');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `translations` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'la vie de Cheikh Ahmadou Bamba','2024-10-21 08:37:28','2024-10-21 09:03:02','Certains Khassidas retracent les expériences et la vie du Cheikh, notamment ses épreuves, son exil, et sa dévotion sans faille à Dieu.','livres/LkUT9Sk6uztuaIPujlHJqKNvWyXGDXRuwxix4rcV.jpg','{\"ar\": {\"name\": \"حياة الشيخ أحمدو بامبا\", \"description\": \"بعض القدّاس راجعوا تجربة وحياة الشيخ بما في ذلك محاكماته، ونفيه، وتفانيه المطلق للرب.\"}, \"en\": {\"name\": \"the life of Sheikh Ahmadou Bamba\", \"description\": \"Some Khasidas recount the experience and life of the Sheikh, including his trials, his exile, and his unwavering devotion to God.\"}, \"wo\": {\"name\": \"la vie de Cheikh Ahmadou Bamba\", \"description\": \"Certains Khassidas retracent les expériences et la vie du Cheikh, notamment ses épreuves, son exil, et sa dévotion sans faille à Dieu.\"}}'),(5,'le Coran (Quran)','2024-10-21 08:38:18','2024-10-21 10:24:13','Le Coran est le livre sacré de l\'islam, révélé par Dieu au Prophète Mouhamed(psl). Composé de 114 chapitres, il traite de la foi, de la loi, de la morale et de la guidance spirituelle, offrant aux musulmans un guide essentiel dans leur vie et leur relation avec Dieu.','livres/ZRBAEsVEEwsvzW6xmDhr8o17DH4DFDM1g83mSFr7.jpg','{\"ar\": {\"name\": \")القرآن(\", \"description\": \"القرآن هو كتاب الإسلام المقدس الذي كشفه الله للنبي محمد وهي، التي تتألف من ١١٤ فصلا، تتناول الإيمان والقانون والأخلاق والتوجيه الروحي، وتقدم للمسلمين دليلا أساسيا في حياتهم وعلاقتهم بالرب.\"}, \"en\": {\"name\": \"the Quran (Quran)\", \"description\": \"The Qur\'an is the sacred book of Islam, revealed by God to the Prophet Muhamed. Composed of 114 chapters, it deals with faith, law, morals and spiritual guidance, offering Muslims an essential guide in their life and relationship with God.\"}, \"wo\": {\"name\": \"le Coran (Quran)\", \"description\": \"Le Coran est le livre sacré de l\'islam, révélé par Dieu au Prophète Mouhamed(psl). Composé de 114 chapitres, il traite de la foi, de la loi, de la morale et de la guidance spirituelle, offrant aux musulmans un guide essentiel dans leur vie et leur relation avec Dieu.\"}}'),(6,'Poèmes de louanges (Khassidas)','2024-10-21 08:39:44','2024-10-21 08:39:44','Ces Khassidas sont dédiés à la glorification de Dieu et à l\'éloge du Prophète Mahomet. Ils expriment une dévotion profonde et une admiration envers la grandeur divine.','livres/qMlyH0pFsnWNVT3f7GbXeKwXCy6v7I3tgu9Obvic.jpg','{\"ar\": {\"name\": \"قصائد برايس (كسيداس)\", \"description\": \"هؤلاء القدّاس مُكرّسون لتمجيد الله والثناء على النبي محمد إنهم يعبرون عن تفانيهم وإعجابهم بعظمة الرب.\"}, \"en\": {\"name\": \"Praise poems (Khassidas)\", \"description\": \"These Khasidas are dedicated to the glorification of God and praise of the Prophet Muhammad. They express deep devotion and admiration for God\'s greatness.\"}, \"wo\": {\"name\": \"Poèmes de louanges (Khassidas)\", \"description\": \"Ces Khassidas sont dédiés à la glorification de Dieu et à l\'éloge du Prophète Mahomet. Ils expriment une dévotion profonde et une admiration envers la grandeur divine.\"}}'),(7,'Enseignement Islamique','2024-10-21 08:53:17','2024-10-21 08:56:41','Ces poèmes (Khassidas) se concentrent sur la transmission des enseignements fondamentaux de l\'islam, tels que la foi, les pratiques religieuses, et les principes moraux.','livres/VOabdmats518id5etZfH5rE2obNImALo6cvQ437X.png','{\"ar\": {\"name\": \"التعليم الإسلامي\", \"description\": \"وتركز هذه القصائد على نقل تعاليم الإسلام الأساسية، مثل العقيدة، والممارسات الدينية، والمبادئ الأخلاقية.\"}, \"en\": {\"name\": \"Islamic education\", \"description\": \"These poems (Khasidas) focus on the transmission of fundamental teachings of Islam, such as faith, religious practices, and moral principles.\"}, \"wo\": {\"name\": \"Enseignement Islamique\", \"description\": \"Ces poèmes (Khassidas) se concentrent sur la transmission des enseignements fondamentaux de l\'islam, tels que la foi, les pratiques religieuses, et les principes moraux.\"}}');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chapters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_id` bigint unsigned NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `terminer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `translations` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chapters_book_id_foreign` (`book_id`),
  CONSTRAINT `chapters_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapters`
--

LOCK TABLES `chapters` WRITE;
/*!40000 ALTER TABLE `chapters` DISABLE KEYS */;
INSERT INTO `chapters` VALUES (1,'partie 30',NULL,'30e - partie',1,'pdf/pJJaIzSZmn6bD32GKzNfLfNIB0JZcW59DVfVqpXd.pdf','2024-10-21 11:18:16','2024-10-21 11:18:18',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 30\", \"description\": \"الجزء ٣٠\"}, \"en\": {\"title\": \"part 30\", \"description\": \"30th part\"}, \"wo\": {\"title\": \"partie 30\", \"description\": \"30e - partie\"}}'),(2,'partie 29',NULL,'29e - partie',2,'pdf/1WFSqrmYcFD1zaQ0jxSRdpiuJrnGy0Wz49jaFsYx.pdf','2024-10-21 11:18:50','2024-10-21 11:18:52',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 29\", \"description\": \"الجزء التاسع والعشرون\"}, \"en\": {\"title\": \"part 29\", \"description\": \"29th part\"}, \"wo\": {\"title\": \"partie 29\", \"description\": \"29e - partie\"}}'),(3,'partie 28',NULL,'28e - partie',3,'pdf/j5rN8Zw0pRMmrkU71LctmgycZAU6UAPQFLi30Zk4.pdf','2024-10-21 11:19:17','2024-10-21 11:19:18',NULL,0,'0','{\"ar\": {\"title\": \"الباب 28\", \"description\": \"الجزء 28\"}, \"en\": {\"title\": \"part 28\", \"description\": \"28th part\"}, \"wo\": {\"title\": \"partie 28\", \"description\": \"28e - partie\"}}'),(4,'partie 27',NULL,'27e - partie',4,'pdf/PbplOFIGP6YCxUoaaXp0k1QlGvJ876YSHD3Q7ukP.pdf','2024-10-21 11:19:46','2024-10-21 11:19:47',NULL,0,'0','{\"ar\": {\"title\": \"الباب 27\", \"description\": \"الجزء السابع والعشرون\"}, \"en\": {\"title\": \"part 27\", \"description\": \"27th part\"}, \"wo\": {\"title\": \"partie 27\", \"description\": \"27e - partie\"}}'),(5,'partie 26',NULL,'26e -partie',5,'pdf/Fcsj2OzcaFCasuQrFX7W2MwkN6qeIegmi7c18vQT.pdf','2024-10-21 11:20:20','2024-10-21 11:20:21',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 26\", \"description\": \"الجزء السادس والعشرون\"}, \"en\": {\"title\": \"part 26\", \"description\": \"26th part\"}, \"wo\": {\"title\": \"partie 26\", \"description\": \"26e -partie\"}}'),(6,'partie 25',NULL,'25e - partie',6,'pdf/soQwy3uo7HAoZQAylNlGcVH2qwWYuxQS6obVSCDn.pdf','2024-10-21 11:21:00','2024-10-21 11:21:01',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 25\", \"description\": \"الجزء الخامس والعشرون\"}, \"en\": {\"title\": \"part 25\", \"description\": \"25th part\"}, \"wo\": {\"title\": \"partie 25\", \"description\": \"25e - partie\"}}'),(7,'partie 24',NULL,'24e - partie',8,'pdf/ijwaRcSVVFdfcS1cydg8xD2IUv4VwU1HdI0uTqSf.pdf','2024-10-21 11:21:27','2024-10-21 11:21:28',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 24\", \"description\": \"الجزء 24\"}, \"en\": {\"title\": \"part 24\", \"description\": \"24th part\"}, \"wo\": {\"title\": \"partie 24\", \"description\": \"24e - partie\"}}'),(8,'partie 23',NULL,'23e - partie',9,'pdf/GoOqtw2M3JqVmZFTf1dtHg3vFfLhICrlQiRzKifp.pdf','2024-10-21 11:21:53','2024-10-21 11:21:54',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 23\", \"description\": \"الجزء الثالث والعشرون\"}, \"en\": {\"title\": \"part 23\", \"description\": \"23rd part\"}, \"wo\": {\"title\": \"partie 23\", \"description\": \"23e - partie\"}}'),(9,'partie 22',NULL,'22e - partie',10,'pdf/dxcmL6wX78cWUE484Jyv3k5NQk9FLp3CWpz3Tbu3.pdf','2024-10-21 11:22:31','2024-10-21 11:22:33',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 22\", \"description\": \"الجزء 22\"}, \"en\": {\"title\": \"part 22\", \"description\": \"part 22\"}, \"wo\": {\"title\": \"partie 22\", \"description\": \"22e - partie\"}}'),(10,'partie 21',NULL,'21e - partie',11,'pdf/j62J52eAHjQUlwey4G7Lu3OtBehwnzmjuMY1RjiZ.pdf','2024-10-21 11:23:01','2024-10-21 11:23:02',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 21\", \"description\": \"الجزء الحادي والعشرون\"}, \"en\": {\"title\": \"part 21\", \"description\": \"21st part\"}, \"wo\": {\"title\": \"partie 21\", \"description\": \"21e - partie\"}}'),(11,'partie 20',NULL,'20e - partie',12,'pdf/NThzRQrA1Qpng33xahVKowyZKMc8LbK78dmkYgkV.pdf','2024-10-21 11:23:34','2024-10-21 11:23:35',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 20\", \"description\": \"الجزء العشرين\"}, \"en\": {\"title\": \"part 20\", \"description\": \"20th part\"}, \"wo\": {\"title\": \"partie 20\", \"description\": \"20e - partie\"}}'),(12,'partie 19',NULL,'19e - partie',13,'pdf/Ip1MUdalEloz5ggljZ9301LGWdgvrgaGiT4avIEq.pdf','2024-10-21 11:24:02','2024-10-21 11:24:03',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 19\", \"description\": \"الجزء التاسع عشر\"}, \"en\": {\"title\": \"part 19\", \"description\": \"19th part\"}, \"wo\": {\"title\": \"partie 19\", \"description\": \"19e - partie\"}}'),(13,'parie 18',NULL,'18e - partie',14,'pdf/S27XZbU1y4dTY0RvKue7HqUBP8PENhZTxKDzqofd.pdf','2024-10-21 11:24:29','2024-10-21 11:24:30',NULL,0,'0','{\"ar\": {\"title\": \"الرهان 18\", \"description\": \"الجزء 18\"}, \"en\": {\"title\": \"bet 18\", \"description\": \"part 18\"}, \"wo\": {\"title\": \"parie 18\", \"description\": \"18e - partie\"}}'),(14,'partie 17',NULL,'17e - partie',15,'pdf/6wxjVQjl3DmKHvYy9A4DfdkmdLBSx0rM4gXlccmw.pdf','2024-10-21 11:24:56','2024-10-21 11:24:57',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 17\", \"description\": \"الجزء السابع عشر\"}, \"en\": {\"title\": \"part 17\", \"description\": \"17th part\"}, \"wo\": {\"title\": \"partie 17\", \"description\": \"17e - partie\"}}'),(15,'partie 16',NULL,'16e - partie',16,'pdf/O6LGVu49fj5Uknv4pDmsNmkfn8UjJrX4KFGnpeVl.pdf','2024-10-21 11:25:38','2024-10-21 11:25:39',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 16\", \"description\": \"الجزء السادس عشر\"}, \"en\": {\"title\": \"part 16\", \"description\": \"16th part\"}, \"wo\": {\"title\": \"partie 16\", \"description\": \"16e - partie\"}}'),(16,'partie 15',NULL,'15e - partie',17,'pdf/Rv8nhH5AvN8OstdF8IPoBnl4YyOTixRBWzxriGjm.pdf','2024-10-21 11:26:04','2024-10-21 11:26:06',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 15\", \"description\": \"الجزء الخامس عشر\"}, \"en\": {\"title\": \"part 15\", \"description\": \"15th part\"}, \"wo\": {\"title\": \"partie 15\", \"description\": \"15e - partie\"}}'),(17,'partie 14',NULL,'14e - partie',18,'pdf/6CXtnVcOplk1sOK1YGm5VnFqrWXPFMtI4918MHJV.pdf','2024-10-21 11:26:43','2024-10-21 11:26:45',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 14\", \"description\": \"الجزء الرابع عشر\"}, \"en\": {\"title\": \"part 14\", \"description\": \"14th part\"}, \"wo\": {\"title\": \"partie 14\", \"description\": \"14e - partie\"}}'),(18,'partie 13',NULL,'13e - partie',19,'pdf/ZqWuoOiTH4cV5YUjaYSSrKKNcIXT2sIo6RDDzuS0.pdf','2024-10-21 11:27:29','2024-10-21 11:27:31',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 13\", \"description\": \"الجزء الثالث عشر\"}, \"en\": {\"title\": \"part 13\", \"description\": \"13th part\"}, \"wo\": {\"title\": \"partie 13\", \"description\": \"13e - partie\"}}'),(19,'partie 12',NULL,'12e - partie',20,'pdf/SCPIkaXdg7dNxSAsCw8ZOR8tSdc4DLgYH725rIbs.pdf','2024-10-21 11:28:04','2024-10-21 11:28:05',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 12\", \"description\": \"الجزء 12\"}, \"en\": {\"title\": \"part 12\", \"description\": \"part 12\"}, \"wo\": {\"title\": \"partie 12\", \"description\": \"12e - partie\"}}'),(20,'partie 11',NULL,'11e - partie',21,'pdf/x8VBD06sFKipF5T6SJAzry9j78tjndR6lAfv1Qkj.pdf','2024-10-21 11:28:29','2024-10-21 11:28:30',NULL,0,'0','{\"ar\": {\"title\": \"الجزء 11\", \"description\": \"الجزء الحادي عشر\"}, \"en\": {\"title\": \"part 11\", \"description\": \"11th part\"}, \"wo\": {\"title\": \"partie 11\", \"description\": \"11e - partie\"}}'),(21,'Koun kaatiman',NULL,'!!! ALLAH ! Nulle Divinité autre que Dieu !!!Au nom de Dieu le Clément le MiséricordieuxQue la paix et le salut soient sur le Prophète MouhammadCette oeuvre de Cheikh Ahmadou Bamba M\'Backé s\'adresse à tous ceux qui veulent acquérir lesavoir et atteindre un objectif dans cette vie terrestre. C\'est un poème qui renferme beaucoupde choses utiles pour l\'éveil des consciences. Car du premier au dernier vers, il résume tout ce àquoi on peut être confronté dans cette vie. Il invite à l\'humilité, à l\'habitude de passer inaperçupour échapper aux malheurs. Il empêche de faire du mal, de nuire à son prochain. Pour cefaire, il faut avec détermination bien discerner son objectif et toute chose pouvant favoriser saréussite ou précipiter sa perte sa perte. La vie est un bref passage sur terre et n\'est donc pasun séjour éternel. Kun Kaatiman est un poème de huit vers que chaque Mouride (aspirant) doittenir en compte, le prendre au sérieux pour sa marche vers DIEU.1 “Essaies toujours de te cacher toi qui es à la quête du savoir. Ainsi tu t\'épargneras lesépreuves et les peines. Aies dela détermination, ainsi tu dépasseras ta génération”.2 “Ne te plains pas tout le temps des épreuves qui t\'accablent. Sois courageux et agis de tellesorte que les gens croientque tu ne manques de rien”.3 “Car la science n\'est jamais octroyée à quelqu\'un qui craint la faim, Saches que DIEU élèveson serviteur qui fait preuvede patience”.4 “Toi qui veux acquérir le savoir, révises à chaque fois, à chaque instant. Je plains celui qui...”5 “ Toi qui cherches le savoir, ne cherches pas en même temps l\'argent. Car le créateurpourvoit au besoin de celui qui esten quête de connaissance”.6 “ Crains DIEU et suis sa religion qui est l\'ISLAM. Car celui qui désobéit à DIEU et celui qui faitdu mal à autrui ne détiendrontjamais la connaissance”.7 “ Eloignes toi des jeunes filles en âge de se marier et celles qui se sont déjà mariées.S\'approcher d\'elles conduit aumépris, à la désobéissance et à la perdition”.8 “Ne sacrifies pas l\'au-delà pour ce monde, ô ! Fils d\'Adam. Donc il est clair que quiconqueéchange la lumière pour l\'obscuritéle regrettera”.Gloire à Toi Seigneur de la Toute Puissance, bien au dessus de ce qu\'ils peuvent inventer. Paixaux messagers du Seigneur. Louange à Dieu, Maître Souverain des mondes.',32,'pdf/08UGSl66fwSKwHf91zZthT8YrfMb17px99v7jMkH.pdf','2024-10-21 11:29:10','2024-10-21 11:50:56','videos/nuE1gkMx9Nd05bfjkXab3KCBYjP4ma7OEJK3tz6C.mp4',0,'0','{\"ar\": {\"title\": \"كون كاتيمان\", \"description\": \"! ! ! باسم الله، السلام والخلاص الأكثر رحمة على النبي محمد إنها قصيدة تحتوي على العديد من الأشياء المفيدة لإذكاء الوعي من الأول إلى الأخير يلخص كل ما يمكن أن يواجهه المرء في هذه الحياة إنه يدعو للتواضع، وعادة الذهاب دون ملاحظة للهروب من الأخطاء ويمنع الضرر ويلحق الضرر بالآخرين. وللقيام بذلك، من الضروري التصميم على تحديد هدفه بوضوح وأي شيء يمكن أن يعزز نجاحه أو يعجل بفقدانه. فالحياة ممر قصير على الأرض، وبالتالي فهي ليست إقامة أبدية. كون كاتيمان هو قصيدة من ثمانية أشعار يجب أن يأخذها كل موردي (المتآمر) في الحسبان، ويأخذها على محمل الجد لرحلته إلى غود. 1 دائماً تحاول إخفاء نفسك عن البحث عن المعرفة لذا سوف تنقذ نفسك من التجارب والألم تحلّي بالتصميم، لذا ستجتازين جيلك. 2 لا تشتكي طوال الوقت من التجارب التي تصيبك كن شجاعاً وتصرف بطريقة تجعل الناس يظنون أنك لست قاصراً عن أي شيء 3 للمعرفة لا تعطى لأي شخص يخاف من الجوع والرب يرفع خادمه الذي يظهر الصبر 4 أنت الذي تريد الحصول على المعرفة، مراجعة كل مرة، كل لحظة. أنا آسف على الشخص الذي... وبالنسبة للمبتكر ينص على ضرورة الشخص الذي يبحث عن المعرفة. \\\"ستة \\\"كرينس غود و اتبع دينه الذي هو \\\"إسلام بالنسبة له الذي يعصي \\\"الجوود\\\" و الذي يؤذي الآخرين لن يكون لديه معرفة 7 الابتعاد عن الفتيات في سن الزواج وأولئك الذين تزوجوا بالفعل. الاقتراب منها يؤدي الى الازدراء والعصيان والشروط 8 لا تضحي بالعالم التالي ابن آدم لذا من الواضح أن من يتبادل الضوء للظلام سيندم عليه المجد لك، لورد كل السلطة، أكثر بكثير مما يمكن أن تخترع. سلام لرسل الرب الحمد لله يا سيد العوالم.\"}, \"en\": {\"title\": \"Koun kaatiman\", \"description\": \"!!! ALLAH! No Divinity other than God!!! In the name of God the Most Merciful May peace and salvation be upon the Prophet Muhammad This work by Sheikh Ahmadou Bamba M\'Backé is addressed to all those who want to acquire knowledge and achieve a goal in this earthly life. It is a poem that contains many things useful for awakening consciousness. For from the first to the last verse, he sums up all that one can face in this life. He invites humility, the habit of going unnoticed to escape misfortunes. It prevents harm, harms others. To do so, it is necessary to be determined to clearly discern its objective and anything that can promote its success or precipitate its loss. Life is a short passage on earth and is therefore not an eternal stay. Kun Kaatiman is a poem of eight verses that each Mouride (aspirant) must take into account, take it seriously for his journey to GOD. 1 Always try to hide yourself from the quest for knowledge. So you will spare yourself the trials and pains. Have determination, so you will pass your generation. 2 Do not complain all the time about the trials that plague you. Be brave and act in such a way that people think you\'re not short of anything. 3 For knowledge is never given to anyone who fears hunger, and God lifts up his servant who shows patience. 4 You who want to acquire knowledge, reviewed every time, every moment. I\'m sorry to the one who-- 5-- You who seek knowledge, don\'t seek money at the same time. For the creator provides for the need of the one who is seeking knowledge. 6 \\\"Crains GOD and follow his religion which is ISLAM. For he who disobeys GOD and he who harms others will never have knowledge. 7 Get away from girls of marriageable age and those who have already married. Approaching them leads to contempt, disobedience and perdition. 8 Do not sacrifice the Hereafter for this world, O Lord! Son of Adam. So it is clear that whoever exchanges light for darkness will regret it. Glory be to You, Lord of All Power, far above what they can invent. Peace to the messengers of the Lord. Praise to God, Sovereign Master of the worlds.\"}, \"wo\": {\"title\": \"Koun kaatiman\", \"description\": \"!!! ALLAH ! Nulle Divinité autre que Dieu !!!Au nom de Dieu le Clément le MiséricordieuxQue la paix et le salut soient sur le Prophète MouhammadCette oeuvre de Cheikh Ahmadou Bamba M\'Backé s\'adresse à tous ceux qui veulent acquérir lesavoir et atteindre un objectif dans cette vie terrestre. C\'est un poème qui renferme beaucoupde choses utiles pour l\'éveil des consciences. Car du premier au dernier vers, il résume tout ce àquoi on peut être confronté dans cette vie. Il invite à l\'humilité, à l\'habitude de passer inaperçupour échapper aux malheurs. Il empêche de faire du mal, de nuire à son prochain. Pour cefaire, il faut avec détermination bien discerner son objectif et toute chose pouvant favoriser saréussite ou précipiter sa perte sa perte. La vie est un bref passage sur terre et n\'est donc pasun séjour éternel. Kun Kaatiman est un poème de huit vers que chaque Mouride (aspirant) doittenir en compte, le prendre au sérieux pour sa marche vers DIEU.1 “Essaies toujours de te cacher toi qui es à la quête du savoir. Ainsi tu t\'épargneras lesépreuves et les peines. Aies dela détermination, ainsi tu dépasseras ta génération”.2 “Ne te plains pas tout le temps des épreuves qui t\'accablent. Sois courageux et agis de tellesorte que les gens croientque tu ne manques de rien”.3 “Car la science n\'est jamais octroyée à quelqu\'un qui craint la faim, Saches que DIEU élèveson serviteur qui fait preuvede patience”.4 “Toi qui veux acquérir le savoir, révises à chaque fois, à chaque instant. Je plains celui qui...”5 “ Toi qui cherches le savoir, ne cherches pas en même temps l\'argent. Car le créateurpourvoit au besoin de celui qui esten quête de connaissance”.6 “ Crains DIEU et suis sa religion qui est l\'ISLAM. Car celui qui désobéit à DIEU et celui qui faitdu mal à autrui ne détiendrontjamais la connaissance”.7 “ Eloignes toi des jeunes filles en âge de se marier et celles qui se sont déjà mariées.S\'approcher d\'elles conduit aumépris, à la désobéissance et à la perdition”.8 “Ne sacrifies pas l\'au-delà pour ce monde, ô ! Fils d\'Adam. Donc il est clair que quiconqueéchange la lumière pour l\'obscuritéle regrettera”.Gloire à Toi Seigneur de la Toute Puissance, bien au dessus de ce qu\'ils peuvent inventer. Paixaux messagers du Seigneur. Louange à Dieu, Maître Souverain des mondes.\"}}');
/*!40000 ALTER TABLE `chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_09_03_163253_create_personal_access_tokens_table',1),(5,'2024_09_04_123917_create_media_table',1),(6,'2024_09_04_223400_create_permission_tables',1),(7,'2024_09_04_224856_create_categories_table',1),(8,'2024_09_05_152715_create_books_table',1),(9,'2024_09_05_152716_create_chapters_table',1),(10,'2024_09_05_153001_create_quizzes_table',1),(11,'2024_09_05_153351_create_questions_table',1),(12,'2024_09_05_153511_create_answers_table',1),(13,'2024_09_05_153740_create_user_progres_table',1),(14,'2024_09_13_095212_create_quizze_question_table',1),(15,'2024_09_17_125550_add_score_and_is_passed_to_quizzes_table',1),(16,'2024_09_17_152315_add_description_to_categories_table',1),(17,'2024_09_19_152219_add_image_to_categories_table',1),(18,'2024_09_27_123852_add_video_path_to_chapters_table',1),(19,'2024_09_30_110147_add_lu_and_terminer_to_chapters_table',1),(20,'2024_10_01_152624_add_is_read_to_user_progress_table',1),(21,'2024_10_02_105410_add_locale_to_users_table',1),(22,'2024_10_02_123751_add_translations_to_categories_table',1),(23,'2024_10_02_135105_add_translations_to_books_table',1),(24,'2024_10_02_153629_add_translations_to_chapters_table',1),(25,'2024_10_02_164415_add_translations_to_quizzes_table',1),(26,'2024_10_02_170304_add_translations_to_questions_table',1),(27,'2024_10_02_180441_add_translations_to_answers_table',1),(28,'2024_10_15_133145_create_quizz_user_table',1),(29,'2024_10_15_194344_create_quiz_results_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',1),(1,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(2,'role-create','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(3,'role-edit','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(4,'role-delete','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(5,'category-list','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(6,'category-create','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(7,'category-edit','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(8,'category-delete','api','2024-10-20 13:00:46','2024-10-20 13:00:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `translations` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'D\'après le premier vers, que faut-il faire pour s\'épargner des épreuves et des peines ?','2024-10-21 12:04:19','2024-11-11 20:01:38','{\"ar\": {\"text\": \"وفقا للقطعة الأولى، ما الذي يجب القيام به لتجنب المشقة والعقاب؟?\"}, \"en\": {\"text\": \"According to the first verse, what must be done to avoid hardship and punishment?\"}, \"wo\": {\"text\": \"D\'après le premier vers, que faut-il faire pour s\'épargner des épreuves et des peines ?\"}}'),(2,'Que recommande le deuxième vers concernant les épreuves ?','2024-10-21 12:05:10','2024-11-11 20:02:04','{\"ar\": {\"text\": \"ماذا يوصى الكون الثاني بالاختبار؟?\"}, \"en\": {\"text\": \"What does the second verse recommend about testing?\"}, \"wo\": {\"text\": \"Que recommande le deuxième vers concernant les épreuves ?\"}}'),(3,'Selon le troisième vers, pourquoi est-il important de faire preuve de patience ?','2024-10-21 12:06:04','2024-11-11 20:03:36','{\"ar\": {\"text\": \"وفقا للعكس الثالث، لماذا الصبر مهم؟?\"}, \"en\": {\"text\": \"According to the third verse, why is patience important?\"}, \"wo\": {\"text\": \"Selon le troisième vers, pourquoi est-il important de faire preuve de patience ?\"}}'),(4,'D\'après le quatrième vers, que doit faire celui qui veut acquérir le savoir ?','2024-10-21 12:13:19','2024-11-11 20:04:32','{\"ar\": {\"text\": \"وفقاً للقطعة الرابعة، ماذا يجب على أي شخص يريد الحصول على المعرفة أن يفعل؟?\"}, \"en\": {\"text\": \"According to the fourth verse, what should anyone who wants to acquire knowledge do?\"}, \"wo\": {\"text\": \"D\'après le quatrième vers, que doit faire celui qui veut acquérir le savoir ?\"}}'),(5,'Que déconseille le cinquième vers à celui qui cherche la connaissance ?','2024-10-21 12:14:32','2024-11-11 20:05:37','{\"ar\": {\"text\": \"ما الذي لا يوصي به المقطع الخامس لمن يلتمس المعرفة؟?\"}, \"en\": {\"text\": \"What does the fifth verse not recommend to the one seeking knowledge?\"}, \"wo\": {\"text\": \"Que déconseille le cinquième vers à celui qui cherche la connaissance ?\"}}'),(6,'Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixième vers ?','2024-10-21 12:15:25','2024-11-11 20:05:53','{\"ar\": {\"text\": \"ما الذي يجب أن يخشاه المرء إذا أراد أن يتبع طريق المعرفة وفقاً للعكس السادس؟?\"}, \"en\": {\"text\": \"What must one fear if he wants to follow the path of knowledge according to the sixth verse?\"}, \"wo\": {\"text\": \"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixième vers ?\"}}'),(7,'À quoi faut-il se méfier d\'après le septième vers ?','2024-10-21 12:16:26','2024-11-11 20:06:04','{\"ar\": {\"text\": \"ماذا يجب أن نكون حذرين من الجانب السابع؟?\"}, \"en\": {\"text\": \"What should we be wary of from the seventh verse?\"}, \"wo\": {\"text\": \"À quoi faut-il se méfier d\'après le septième vers ?\"}}'),(8,'Que recommande le huitième vers en ce qui concerne ce monde et l\'au-delà ?','2024-10-21 12:17:18','2024-11-11 20:06:15','{\"ar\": {\"text\": \"ما الذي يوصي به الكون الثامن فيما يتعلق بهذا العالم وما بعده؟?\"}, \"en\": {\"text\": \"What does the eighth verse recommend with regard to this world and beyond?\"}, \"wo\": {\"text\": \"Que recommande le huitième vers en ce qui concerne ce monde et l\'au-delà ?\"}}');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_results`
--

DROP TABLE IF EXISTS `quiz_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quiz_id` bigint unsigned NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `terminer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `score` int DEFAULT NULL,
  `is_passed` tinyint(1) NOT NULL DEFAULT '0',
  `answers` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_results_user_id_foreign` (`user_id`),
  KEY `quiz_results_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `quiz_results_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_results`
--

LOCK TABLES `quiz_results` WRITE;
/*!40000 ALTER TABLE `quiz_results` DISABLE KEYS */;
INSERT INTO `quiz_results` VALUES (1,2,1,0,'2',38,0,'\"[{\\\"question\\\":{\\\"id\\\":6,\\\"text\\\":\\\"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":16,\\\"text\\\":\\\"a) Le jugement des autres\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":17,\\\"text\\\":\\\"b) Dieu et sa religion, l\'Islam\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":18,\\\"text\\\":\\\"c) La faim\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":1,\\\"text\\\":\\\"D\'apr\\\\u00e8s le premier vers, que faut-il faire pour s\'\\\\u00e9pargner des \\\\u00e9preuves et des peines ?\\\"},\\\"answers\\\":[{\\\"id\\\":1,\\\"text\\\":\\\"a) Se montrer au grand jour\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":2,\\\"text\\\":\\\"b) Se cacher et \\\\u00eatre d\\\\u00e9termin\\\\u00e9\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":3,\\\"text\\\":\\\"c) Se plaindre des difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":2,\\\"text\\\":\\\"Que recommande le deuxi\\\\u00e8me vers concernant les \\\\u00e9preuves ?\\\"},\\\"answers\\\":[{\\\"id\\\":4,\\\"text\\\":\\\"a) Se plaindre constamment\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":5,\\\"text\\\":\\\"b) Les affronter courageusement\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":6,\\\"text\\\":\\\"c) Abandonner face aux difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":4,\\\"text\\\":\\\"D\'apr\\\\u00e8s le quatri\\\\u00e8me vers, que doit faire celui qui veut acqu\\\\u00e9rir le savoir ?\\\"},\\\"answers\\\":[{\\\"id\\\":10,\\\"text\\\":\\\"a) R\\\\u00e9viser r\\\\u00e9guli\\\\u00e8rement et constamment\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":11,\\\"text\\\":\\\"b) Se contenter d\'apprendre une fois\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":12,\\\"text\\\":\\\"c) Ne jamais r\\\\u00e9viser\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":3,\\\"text\\\":\\\"Selon le troisi\\\\u00e8me vers, pourquoi est-il important de faire preuve de patience ?\\\"},\\\"answers\\\":[{\\\"id\\\":7,\\\"text\\\":\\\"a) Parce que la science est donn\\\\u00e9e \\\\u00e0 ceux qui se plaignent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":8,\\\"text\\\":\\\"b) Parce que Dieu \\\\u00e9l\\\\u00e8ve son serviteur patient\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":9,\\\"text\\\":\\\"c) Parce que la faim est plus importante que la science\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":7,\\\"text\\\":\\\"\\\\u00c0 quoi faut-il se m\\\\u00e9fier d\'apr\\\\u00e8s le septi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":19,\\\"text\\\":\\\"a) Se rapprocher des jeunes filles mari\\\\u00e9es ou en \\\\u00e2ge de se marier\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":20,\\\"text\\\":\\\"b) Avoir des amis proches\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":21,\\\"text\\\":\\\"c) Voyager loin\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":8,\\\"text\\\":\\\"Que recommande le huiti\\\\u00e8me vers en ce qui concerne ce monde et l\'au-del\\\\u00e0 ?\\\"},\\\"answers\\\":[{\\\"id\\\":22,\\\"text\\\":\\\"a) Sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":23,\\\"text\\\":\\\"b) \\\\u00c9changer la lumi\\\\u00e8re pour l\'obscurit\\\\u00e9\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":24,\\\"text\\\":\\\"c) Ne pas sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":5,\\\"text\\\":\\\"Que d\\\\u00e9conseille le cinqui\\\\u00e8me vers \\\\u00e0 celui qui cherche la connaissance ?\\\"},\\\"answers\\\":[{\\\"id\\\":13,\\\"text\\\":\\\"a) Chercher l\'argent en m\\\\u00eame temps\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":14,\\\"text\\\":\\\"b) Se concentrer uniquement sur l\'argent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":15,\\\"text\\\":\\\"c) \\\\u00c9viter de demander de l\'aide\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false}]\"','2024-10-22 15:01:44','2024-10-22 15:01:44'),(2,1,1,0,'2',63,0,'\"[{\\\"question\\\":{\\\"id\\\":6,\\\"text\\\":\\\"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":16,\\\"text\\\":\\\"a) Le jugement des autres\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":17,\\\"text\\\":\\\"b) Dieu et sa religion, l\'Islam\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":18,\\\"text\\\":\\\"c) La faim\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":2,\\\"text\\\":\\\"Que recommande le deuxi\\\\u00e8me vers concernant les \\\\u00e9preuves ?\\\"},\\\"answers\\\":[{\\\"id\\\":4,\\\"text\\\":\\\"a) Se plaindre constamment\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":5,\\\"text\\\":\\\"b) Les affronter courageusement\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":6,\\\"text\\\":\\\"c) Abandonner face aux difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":5,\\\"text\\\":\\\"Que d\\\\u00e9conseille le cinqui\\\\u00e8me vers \\\\u00e0 celui qui cherche la connaissance ?\\\"},\\\"answers\\\":[{\\\"id\\\":13,\\\"text\\\":\\\"a) Chercher l\'argent en m\\\\u00eame temps\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":14,\\\"text\\\":\\\"b) Se concentrer uniquement sur l\'argent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":15,\\\"text\\\":\\\"c) \\\\u00c9viter de demander de l\'aide\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":8,\\\"text\\\":\\\"Que recommande le huiti\\\\u00e8me vers en ce qui concerne ce monde et l\'au-del\\\\u00e0 ?\\\"},\\\"answers\\\":[{\\\"id\\\":22,\\\"text\\\":\\\"a) Sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":23,\\\"text\\\":\\\"b) \\\\u00c9changer la lumi\\\\u00e8re pour l\'obscurit\\\\u00e9\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":24,\\\"text\\\":\\\"c) Ne pas sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":1,\\\"text\\\":\\\"D\'apr\\\\u00e8s le premier vers, que faut-il faire pour s\'\\\\u00e9pargner des \\\\u00e9preuves et des peines ?\\\"},\\\"answers\\\":[{\\\"id\\\":1,\\\"text\\\":\\\"a) Se montrer au grand jour\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":2,\\\"text\\\":\\\"b) Se cacher et \\\\u00eatre d\\\\u00e9termin\\\\u00e9\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":3,\\\"text\\\":\\\"c) Se plaindre des difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":3,\\\"text\\\":\\\"Selon le troisi\\\\u00e8me vers, pourquoi est-il important de faire preuve de patience ?\\\"},\\\"answers\\\":[{\\\"id\\\":7,\\\"text\\\":\\\"a) Parce que la science est donn\\\\u00e9e \\\\u00e0 ceux qui se plaignent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":8,\\\"text\\\":\\\"b) Parce que Dieu \\\\u00e9l\\\\u00e8ve son serviteur patient\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":9,\\\"text\\\":\\\"c) Parce que la faim est plus importante que la science\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":4,\\\"text\\\":\\\"D\'apr\\\\u00e8s le quatri\\\\u00e8me vers, que doit faire celui qui veut acqu\\\\u00e9rir le savoir ?\\\"},\\\"answers\\\":[{\\\"id\\\":10,\\\"text\\\":\\\"a) R\\\\u00e9viser r\\\\u00e9guli\\\\u00e8rement et constamment\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":11,\\\"text\\\":\\\"b) Se contenter d\'apprendre une fois\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":12,\\\"text\\\":\\\"c) Ne jamais r\\\\u00e9viser\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":7,\\\"text\\\":\\\"\\\\u00c0 quoi faut-il se m\\\\u00e9fier d\'apr\\\\u00e8s le septi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":19,\\\"text\\\":\\\"a) Se rapprocher des jeunes filles mari\\\\u00e9es ou en \\\\u00e2ge de se marier\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":20,\\\"text\\\":\\\"b) Avoir des amis proches\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":21,\\\"text\\\":\\\"c) Voyager loin\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true}]\"','2024-10-28 13:33:39','2024-10-28 13:33:39'),(3,1,1,0,'2',50,0,'\"[{\\\"question\\\":{\\\"id\\\":6,\\\"text\\\":\\\"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":16,\\\"text\\\":\\\"a) Le jugement des autres\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":17,\\\"text\\\":\\\"b) Dieu et sa religion, l\'Islam\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":18,\\\"text\\\":\\\"c) La faim\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":5,\\\"text\\\":\\\"Que d\\\\u00e9conseille le cinqui\\\\u00e8me vers \\\\u00e0 celui qui cherche la connaissance ?\\\"},\\\"answers\\\":[{\\\"id\\\":13,\\\"text\\\":\\\"a) Chercher l\'argent en m\\\\u00eame temps\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":14,\\\"text\\\":\\\"b) Se concentrer uniquement sur l\'argent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":15,\\\"text\\\":\\\"c) \\\\u00c9viter de demander de l\'aide\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":3,\\\"text\\\":\\\"Selon le troisi\\\\u00e8me vers, pourquoi est-il important de faire preuve de patience ?\\\"},\\\"answers\\\":[{\\\"id\\\":7,\\\"text\\\":\\\"a) Parce que la science est donn\\\\u00e9e \\\\u00e0 ceux qui se plaignent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":8,\\\"text\\\":\\\"b) Parce que Dieu \\\\u00e9l\\\\u00e8ve son serviteur patient\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":9,\\\"text\\\":\\\"c) Parce que la faim est plus importante que la science\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":4,\\\"text\\\":\\\"D\'apr\\\\u00e8s le quatri\\\\u00e8me vers, que doit faire celui qui veut acqu\\\\u00e9rir le savoir ?\\\"},\\\"answers\\\":[{\\\"id\\\":10,\\\"text\\\":\\\"a) R\\\\u00e9viser r\\\\u00e9guli\\\\u00e8rement et constamment\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":11,\\\"text\\\":\\\"b) Se contenter d\'apprendre une fois\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":12,\\\"text\\\":\\\"c) Ne jamais r\\\\u00e9viser\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":8,\\\"text\\\":\\\"Que recommande le huiti\\\\u00e8me vers en ce qui concerne ce monde et l\'au-del\\\\u00e0 ?\\\"},\\\"answers\\\":[{\\\"id\\\":22,\\\"text\\\":\\\"a) Sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":23,\\\"text\\\":\\\"b) \\\\u00c9changer la lumi\\\\u00e8re pour l\'obscurit\\\\u00e9\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":24,\\\"text\\\":\\\"c) Ne pas sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":1,\\\"text\\\":\\\"D\'apr\\\\u00e8s le premier vers, que faut-il faire pour s\'\\\\u00e9pargner des \\\\u00e9preuves et des peines ?\\\"},\\\"answers\\\":[{\\\"id\\\":1,\\\"text\\\":\\\"a) Se montrer au grand jour\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":2,\\\"text\\\":\\\"b) Se cacher et \\\\u00eatre d\\\\u00e9termin\\\\u00e9\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":3,\\\"text\\\":\\\"c) Se plaindre des difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":7,\\\"text\\\":\\\"\\\\u00c0 quoi faut-il se m\\\\u00e9fier d\'apr\\\\u00e8s le septi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":19,\\\"text\\\":\\\"a) Se rapprocher des jeunes filles mari\\\\u00e9es ou en \\\\u00e2ge de se marier\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":20,\\\"text\\\":\\\"b) Avoir des amis proches\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":21,\\\"text\\\":\\\"c) Voyager loin\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":2,\\\"text\\\":\\\"Que recommande le deuxi\\\\u00e8me vers concernant les \\\\u00e9preuves ?\\\"},\\\"answers\\\":[{\\\"id\\\":4,\\\"text\\\":\\\"a) Se plaindre constamment\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":5,\\\"text\\\":\\\"b) Les affronter courageusement\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":6,\\\"text\\\":\\\"c) Abandonner face aux difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true}]\"','2024-11-02 08:21:36','2024-11-02 08:21:36'),(4,2,1,0,'2',63,0,'\"[{\\\"question\\\":{\\\"id\\\":5,\\\"text\\\":\\\"Que d\\\\u00e9conseille le cinqui\\\\u00e8me vers \\\\u00e0 celui qui cherche la connaissance ?\\\"},\\\"answers\\\":[{\\\"id\\\":13,\\\"text\\\":\\\"a) Chercher l\'argent en m\\\\u00eame temps\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":14,\\\"text\\\":\\\"b) Se concentrer uniquement sur l\'argent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":15,\\\"text\\\":\\\"c) \\\\u00c9viter de demander de l\'aide\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":6,\\\"text\\\":\\\"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":16,\\\"text\\\":\\\"a) Le jugement des autres\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":17,\\\"text\\\":\\\"b) Dieu et sa religion, l\'Islam\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":18,\\\"text\\\":\\\"c) La faim\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":7,\\\"text\\\":\\\"\\\\u00c0 quoi faut-il se m\\\\u00e9fier d\'apr\\\\u00e8s le septi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":19,\\\"text\\\":\\\"a) Se rapprocher des jeunes filles mari\\\\u00e9es ou en \\\\u00e2ge de se marier\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":20,\\\"text\\\":\\\"b) Avoir des amis proches\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":21,\\\"text\\\":\\\"c) Voyager loin\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":8,\\\"text\\\":\\\"Que recommande le huiti\\\\u00e8me vers en ce qui concerne ce monde et l\'au-del\\\\u00e0 ?\\\"},\\\"answers\\\":[{\\\"id\\\":22,\\\"text\\\":\\\"a) Sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":23,\\\"text\\\":\\\"b) \\\\u00c9changer la lumi\\\\u00e8re pour l\'obscurit\\\\u00e9\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":24,\\\"text\\\":\\\"c) Ne pas sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":2,\\\"text\\\":\\\"Que recommande le deuxi\\\\u00e8me vers concernant les \\\\u00e9preuves ?\\\"},\\\"answers\\\":[{\\\"id\\\":4,\\\"text\\\":\\\"a) Se plaindre constamment\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":5,\\\"text\\\":\\\"b) Les affronter courageusement\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":6,\\\"text\\\":\\\"c) Abandonner face aux difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":4,\\\"text\\\":\\\"D\'apr\\\\u00e8s le quatri\\\\u00e8me vers, que doit faire celui qui veut acqu\\\\u00e9rir le savoir ?\\\"},\\\"answers\\\":[{\\\"id\\\":10,\\\"text\\\":\\\"a) R\\\\u00e9viser r\\\\u00e9guli\\\\u00e8rement et constamment\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":11,\\\"text\\\":\\\"b) Se contenter d\'apprendre une fois\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":12,\\\"text\\\":\\\"c) Ne jamais r\\\\u00e9viser\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":3,\\\"text\\\":\\\"Selon le troisi\\\\u00e8me vers, pourquoi est-il important de faire preuve de patience ?\\\"},\\\"answers\\\":[{\\\"id\\\":7,\\\"text\\\":\\\"a) Parce que la science est donn\\\\u00e9e \\\\u00e0 ceux qui se plaignent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":8,\\\"text\\\":\\\"b) Parce que Dieu \\\\u00e9l\\\\u00e8ve son serviteur patient\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":9,\\\"text\\\":\\\"c) Parce que la faim est plus importante que la science\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":1,\\\"text\\\":\\\"D\'apr\\\\u00e8s le premier vers, que faut-il faire pour s\'\\\\u00e9pargner des \\\\u00e9preuves et des peines ?\\\"},\\\"answers\\\":[{\\\"id\\\":1,\\\"text\\\":\\\"a) Se montrer au grand jour\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":2,\\\"text\\\":\\\"b) Se cacher et \\\\u00eatre d\\\\u00e9termin\\\\u00e9\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":3,\\\"text\\\":\\\"c) Se plaindre des difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false}]\"','2024-11-02 08:46:34','2024-11-02 08:46:34'),(5,1,1,0,'2',13,0,'\"[{\\\"question\\\":{\\\"id\\\":8,\\\"text\\\":\\\"Que recommande le huiti\\\\u00e8me vers en ce qui concerne ce monde et l\'au-del\\\\u00e0 ?\\\"},\\\"answers\\\":[{\\\"id\\\":22,\\\"text\\\":\\\"a) Sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":23,\\\"text\\\":\\\"b) \\\\u00c9changer la lumi\\\\u00e8re pour l\'obscurit\\\\u00e9\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":24,\\\"text\\\":\\\"c) Ne pas sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":1,\\\"text\\\":\\\"D\'apr\\\\u00e8s le premier vers, que faut-il faire pour s\'\\\\u00e9pargner des \\\\u00e9preuves et des peines ?\\\"},\\\"answers\\\":[{\\\"id\\\":1,\\\"text\\\":\\\"a) Se montrer au grand jour\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":2,\\\"text\\\":\\\"b) Se cacher et \\\\u00eatre d\\\\u00e9termin\\\\u00e9\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":3,\\\"text\\\":\\\"c) Se plaindre des difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":2,\\\"text\\\":\\\"Que recommande le deuxi\\\\u00e8me vers concernant les \\\\u00e9preuves ?\\\"},\\\"answers\\\":[{\\\"id\\\":4,\\\"text\\\":\\\"a) Se plaindre constamment\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":5,\\\"text\\\":\\\"b) Les affronter courageusement\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":6,\\\"text\\\":\\\"c) Abandonner face aux difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":7,\\\"text\\\":\\\"\\\\u00c0 quoi faut-il se m\\\\u00e9fier d\'apr\\\\u00e8s le septi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":19,\\\"text\\\":\\\"a) Se rapprocher des jeunes filles mari\\\\u00e9es ou en \\\\u00e2ge de se marier\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":20,\\\"text\\\":\\\"b) Avoir des amis proches\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":21,\\\"text\\\":\\\"c) Voyager loin\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":6,\\\"text\\\":\\\"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":16,\\\"text\\\":\\\"a) Le jugement des autres\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":17,\\\"text\\\":\\\"b) Dieu et sa religion, l\'Islam\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":18,\\\"text\\\":\\\"c) La faim\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":3,\\\"text\\\":\\\"Selon le troisi\\\\u00e8me vers, pourquoi est-il important de faire preuve de patience ?\\\"},\\\"answers\\\":[{\\\"id\\\":7,\\\"text\\\":\\\"a) Parce que la science est donn\\\\u00e9e \\\\u00e0 ceux qui se plaignent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":8,\\\"text\\\":\\\"b) Parce que Dieu \\\\u00e9l\\\\u00e8ve son serviteur patient\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":9,\\\"text\\\":\\\"c) Parce que la faim est plus importante que la science\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":4,\\\"text\\\":\\\"D\'apr\\\\u00e8s le quatri\\\\u00e8me vers, que doit faire celui qui veut acqu\\\\u00e9rir le savoir ?\\\"},\\\"answers\\\":[{\\\"id\\\":10,\\\"text\\\":\\\"a) R\\\\u00e9viser r\\\\u00e9guli\\\\u00e8rement et constamment\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":11,\\\"text\\\":\\\"b) Se contenter d\'apprendre une fois\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":12,\\\"text\\\":\\\"c) Ne jamais r\\\\u00e9viser\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":5,\\\"text\\\":\\\"Que d\\\\u00e9conseille le cinqui\\\\u00e8me vers \\\\u00e0 celui qui cherche la connaissance ?\\\"},\\\"answers\\\":[{\\\"id\\\":13,\\\"text\\\":\\\"a) Chercher l\'argent en m\\\\u00eame temps\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":14,\\\"text\\\":\\\"b) Se concentrer uniquement sur l\'argent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":15,\\\"text\\\":\\\"c) \\\\u00c9viter de demander de l\'aide\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true}],\\\"is_correct\\\":false}]\"','2024-11-05 12:34:41','2024-11-05 12:34:41'),(6,2,1,0,'2',50,0,'\"[{\\\"question\\\":{\\\"id\\\":6,\\\"text\\\":\\\"Que doit craindre celui qui veut suivre le chemin de la connaissance selon le sixi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":16,\\\"text\\\":\\\"a) Le jugement des autres\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":17,\\\"text\\\":\\\"b) Dieu et sa religion, l\'Islam\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":18,\\\"text\\\":\\\"c) La faim\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":4,\\\"text\\\":\\\"D\'apr\\\\u00e8s le quatri\\\\u00e8me vers, que doit faire celui qui veut acqu\\\\u00e9rir le savoir ?\\\"},\\\"answers\\\":[{\\\"id\\\":10,\\\"text\\\":\\\"a) R\\\\u00e9viser r\\\\u00e9guli\\\\u00e8rement et constamment\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":11,\\\"text\\\":\\\"b) Se contenter d\'apprendre une fois\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":12,\\\"text\\\":\\\"c) Ne jamais r\\\\u00e9viser\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":2,\\\"text\\\":\\\"Que recommande le deuxi\\\\u00e8me vers concernant les \\\\u00e9preuves ?\\\"},\\\"answers\\\":[{\\\"id\\\":4,\\\"text\\\":\\\"a) Se plaindre constamment\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":5,\\\"text\\\":\\\"b) Les affronter courageusement\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":6,\\\"text\\\":\\\"c) Abandonner face aux difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":8,\\\"text\\\":\\\"Que recommande le huiti\\\\u00e8me vers en ce qui concerne ce monde et l\'au-del\\\\u00e0 ?\\\"},\\\"answers\\\":[{\\\"id\\\":22,\\\"text\\\":\\\"a) Sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":23,\\\"text\\\":\\\"b) \\\\u00c9changer la lumi\\\\u00e8re pour l\'obscurit\\\\u00e9\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":24,\\\"text\\\":\\\"c) Ne pas sacrifier l\'au-del\\\\u00e0 pour ce monde\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":3,\\\"text\\\":\\\"Selon le troisi\\\\u00e8me vers, pourquoi est-il important de faire preuve de patience ?\\\"},\\\"answers\\\":[{\\\"id\\\":7,\\\"text\\\":\\\"a) Parce que la science est donn\\\\u00e9e \\\\u00e0 ceux qui se plaignent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":8,\\\"text\\\":\\\"b) Parce que Dieu \\\\u00e9l\\\\u00e8ve son serviteur patient\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":9,\\\"text\\\":\\\"c) Parce que la faim est plus importante que la science\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":7,\\\"text\\\":\\\"\\\\u00c0 quoi faut-il se m\\\\u00e9fier d\'apr\\\\u00e8s le septi\\\\u00e8me vers ?\\\"},\\\"answers\\\":[{\\\"id\\\":19,\\\"text\\\":\\\"a) Se rapprocher des jeunes filles mari\\\\u00e9es ou en \\\\u00e2ge de se marier\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":20,\\\"text\\\":\\\"b) Avoir des amis proches\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":21,\\\"text\\\":\\\"c) Voyager loin\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false},{\\\"question\\\":{\\\"id\\\":1,\\\"text\\\":\\\"D\'apr\\\\u00e8s le premier vers, que faut-il faire pour s\'\\\\u00e9pargner des \\\\u00e9preuves et des peines ?\\\"},\\\"answers\\\":[{\\\"id\\\":1,\\\"text\\\":\\\"a) Se montrer au grand jour\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false},{\\\"id\\\":2,\\\"text\\\":\\\"b) Se cacher et \\\\u00eatre d\\\\u00e9termin\\\\u00e9\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":true},{\\\"id\\\":3,\\\"text\\\":\\\"c) Se plaindre des difficult\\\\u00e9s\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":true},{\\\"question\\\":{\\\"id\\\":5,\\\"text\\\":\\\"Que d\\\\u00e9conseille le cinqui\\\\u00e8me vers \\\\u00e0 celui qui cherche la connaissance ?\\\"},\\\"answers\\\":[{\\\"id\\\":13,\\\"text\\\":\\\"a) Chercher l\'argent en m\\\\u00eame temps\\\",\\\"is_correct\\\":true,\\\"user_selected\\\":false},{\\\"id\\\":14,\\\"text\\\":\\\"b) Se concentrer uniquement sur l\'argent\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":true},{\\\"id\\\":15,\\\"text\\\":\\\"c) \\\\u00c9viter de demander de l\'aide\\\",\\\"is_correct\\\":false,\\\"user_selected\\\":false}],\\\"is_correct\\\":false}]\"','2024-11-11 08:56:06','2024-11-11 08:56:06');
/*!40000 ALTER TABLE `quiz_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizz_user`
--

DROP TABLE IF EXISTS `quizz_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizz_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quizze_id` bigint unsigned NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `terminer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `score` double NOT NULL DEFAULT '0',
  `is_passed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizz_user_user_id_foreign` (`user_id`),
  KEY `quizz_user_quizze_id_foreign` (`quizze_id`),
  CONSTRAINT `quizz_user_quizze_id_foreign` FOREIGN KEY (`quizze_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quizz_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizz_user`
--

LOCK TABLES `quizz_user` WRITE;
/*!40000 ALTER TABLE `quizz_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizz_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizze_question`
--

DROP TABLE IF EXISTS `quizze_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizze_question` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quizze_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizze_question_quizze_id_foreign` (`quizze_id`),
  KEY `quizze_question_question_id_foreign` (`question_id`),
  CONSTRAINT `quizze_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quizze_question_quizze_id_foreign` FOREIGN KEY (`quizze_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizze_question`
--

LOCK TABLES `quizze_question` WRITE;
/*!40000 ALTER TABLE `quizze_question` DISABLE KEYS */;
INSERT INTO `quizze_question` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,1,4,NULL,NULL),(5,1,6,NULL,NULL),(6,1,7,NULL,NULL),(7,1,8,NULL,NULL),(8,1,5,NULL,NULL);
/*!40000 ALTER TABLE `quizze_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_id` bigint unsigned NOT NULL,
  `score` double NOT NULL DEFAULT '0',
  `is_passed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `translations` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizzes_chapter_id_foreign` (`chapter_id`),
  CONSTRAINT `quizzes_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (1,'Koun Kaatiman',21,0,0,'2024-10-21 12:20:17','2024-11-11 18:27:32','{\"ar\": {\"title\": \"كون كاتيمان\"}, \"en\": {\"title\": \"Koun Kaatiman\"}, \"wo\": {\"title\": \"Koun Kaatiman\"}}');
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(2,'apprenant','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(3,'visiteur','api','2024-10-20 13:00:46','2024-10-20 13:00:46'),(4,'superadmin','api','2024-10-20 13:00:46','2024-10-20 13:00:46');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('OvvDSs1DiBJA1aFmxWCJNKihxTqgDaY3GHsCZmVe',NULL,'127.0.0.1','insomnia/10.1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDl2c09lUFJxN1hneFdLZE9KQ0xYcldUVmN3TTZ1cmsxczZ2UE9HWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1730813006);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_progres`
--

DROP TABLE IF EXISTS `user_progres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_progres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `chapter_id` bigint unsigned NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `terminer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_progres_user_id_foreign` (`user_id`),
  KEY `user_progres_chapter_id_foreign` (`chapter_id`),
  CONSTRAINT `user_progres_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_progres_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_progres`
--

LOCK TABLES `user_progres` WRITE;
/*!40000 ALTER TABLE `user_progres` DISABLE KEYS */;
INSERT INTO `user_progres` VALUES (1,1,11,0,'2024-10-21 11:46:22','2024-10-21 11:46:22',1,'0'),(2,1,1,0,'2024-10-21 11:47:07','2024-10-21 11:47:07',1,'0'),(3,1,21,0,'2024-10-21 11:48:11','2024-10-21 11:48:11',1,'0'),(4,2,21,0,'2024-10-21 12:10:31','2024-10-21 12:10:31',1,'0'),(5,2,3,0,'2024-11-07 09:40:51','2024-11-07 09:40:51',1,'0');
/*!40000 ALTER TABLE `user_progres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress` int NOT NULL DEFAULT '0',
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fr',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_telephone_unique` (`telephone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Serigne Fallou Niang','fallouniang776@gmail.com',NULL,0,'766149938',NULL,'$2y$12$vUZWxSEYGyRRA0yJz1Lg3OReptAcM0f0IccNKzpfeCBwiPND7bvWi',NULL,'2024-10-20 13:07:01','2024-11-11 20:08:29','fr'),(2,'Mouhamed  Niang','niang.serignefallou@unchk.edu.sn',NULL,0,'786890681',NULL,'$2y$12$4bPRJUW7f98QEQdwUaV64.hzbTDLIiiXI5ihBmE7lo/F2TkCgw/d.',NULL,'2024-10-20 13:10:16','2024-11-11 18:08:14','fr');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-12  6:47:04
