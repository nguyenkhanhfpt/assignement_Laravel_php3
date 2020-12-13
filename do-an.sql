-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: do-an-2
-- ------------------------------------------------------
-- Server version	5.7.31-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) unsigned NOT NULL,
  `date_buy` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code_id` bigint(20) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bills_member_id_foreign` (`member_id`),
  CONSTRAINT `bills_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,1,'2020-12-12 13:28:48',3,2),(2,1,'2020-12-12 14:06:16',NULL,0),(3,2,'2020-12-09 14:25:11',NULL,3),(8,1,'2020-12-13 07:21:36',NULL,0),(9,1,'2020-12-13 07:37:40',NULL,0),(10,1,'2020-12-13 07:38:12',NULL,0),(11,1,'2020-12-13 07:39:24',NULL,0),(12,1,'2020-12-13 08:00:59',NULL,0),(13,1,'2020-12-13 13:57:10',NULL,0),(14,1,'2020-12-13 14:01:04',NULL,0);
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Áo'),(2,'Quần'),(3,'Giày'),(4,'Mũ');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` VALUES (1,'Nguyen Khanh',59500.00,'2020-12-08 17:18:00','2020-12-25 17:18:00','2020-12-08 10:18:43','2020-12-08 10:18:43'),(2,'dsd',59500.00,'2020-12-10 17:18:00','2020-12-12 17:18:00','2020-12-08 10:19:01','2020-12-08 10:19:01'),(3,'helo',10000.00,'2020-12-12 20:25:00','2020-12-26 20:25:00','2020-12-12 13:25:49','2020-12-12 13:25:49');
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'Xanh','2020-12-08 07:22:26','2020-12-08 07:22:26'),(2,'Đen','2020-12-13 13:44:05','2020-12-13 13:44:05'),(3,'Trắng','2020-12-13 13:44:13','2020-12-13 13:44:13');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comments_member_id_foreign` (`member_id`),
  KEY `comments_product_id_foreign` (`product_id`),
  CONSTRAINT `comments_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'ahihi',1,'2020-12-12 13:16:14'),(2,1,'hay quas',1,'2020-12-12 13:16:30'),(3,1,'ahihi',1,'2020-12-12 13:16:37'),(4,1,'ahih',1,'2020-12-12 13:18:46'),(5,1,'hehe',9,'2020-12-12 13:38:43'),(6,1,'ok',9,'2020-12-12 13:39:28'),(8,1,'haha',9,'2020-12-12 13:39:46'),(9,1,'ha',9,'2020-12-12 13:40:16');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_bills`
--

DROP TABLE IF EXISTS `detail_bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_bills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `color_id` bigint(20) unsigned DEFAULT NULL,
  `size_id` bigint(20) unsigned DEFAULT NULL,
  `quantity_buy` int(11) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_bills_bill_id_foreign` (`bill_id`),
  KEY `detail_bills_product_id_foreign` (`product_id`),
  CONSTRAINT `detail_bills_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_bills_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_bills`
--

LOCK TABLES `detail_bills` WRITE;
/*!40000 ALTER TABLE `detail_bills` DISABLE KEYS */;
INSERT INTO `detail_bills` VALUES (1,1,1,NULL,NULL,1,20000),(2,2,3,NULL,NULL,1,20000),(3,2,9,NULL,NULL,1,20000),(4,3,3,NULL,NULL,1,20000),(9,8,2,NULL,NULL,1,20000),(10,8,1,NULL,NULL,1,20000),(11,9,1,NULL,NULL,1,20000),(12,9,4,NULL,NULL,1,20000),(13,10,1,NULL,NULL,1,20000),(14,11,4,NULL,NULL,1,20000),(15,12,1,NULL,NULL,1,20000),(16,12,2,NULL,NULL,1,20000),(17,13,2,NULL,NULL,1,20000),(18,13,19,NULL,NULL,2,40000),(19,13,21,2,1,2,361000),(20,14,2,NULL,NULL,1,20000);
/*!40000 ALTER TABLE `detail_bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libraries`
--

DROP TABLE IF EXISTS `libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libraries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libraries`
--

LOCK TABLES `libraries` WRITE;
/*!40000 ALTER TABLE `libraries` DISABLE KEYS */;
INSERT INTO `libraries` VALUES (7,'1607867235careshare_ao_polo_375x425.jpg','2020-12-13 13:47:15','2020-12-13 13:47:15'),(8,'1607867238BOO06080_550x623.jpg','2020-12-13 13:47:18','2020-12-13 13:47:18'),(9,'16078672482L6A3114_550x623.jpg','2020-12-13 13:47:28','2020-12-13 13:47:28');
/*!40000 ALTER TABLE `libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status_member` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Admin','admin@gmail.com','0868003429','54/82 Nguyễn Lương Bằng','$2y$10$I58U4gGstAit3GJsEkySne48hMAKX6UfHPcLa3FpKwearp1JyuNvK',NULL,'user.jpg',1,1,NULL,NULL,NULL),(2,'Nguyen Khanh (FPL DN)','khanhnpd02983@fpt.edu.vn','0847387323','Nguyen Luong Bằng','$2y$10$VF0qE0bLUUPm2Me/Sl/OqerVIOOdEPHnG6NPkzV61sd34XboXmoLS',NULL,'user.jpg',0,1,NULL,'google','113588781386063080690'),(3,'Khánh Nguyễn','khanh26122000@gmail.com',NULL,NULL,'$2y$10$4cBfT7821RZXSJKVeBbLMe0XdWq8aC61UK5aX8STr2vC4NawvQ3vq',NULL,'user.jpg',0,1,NULL,'google','111012663103581829414');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=585 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (554,'2014_10_12_100000_create_password_resets_table',1),(555,'2019_08_19_000000_create_failed_jobs_table',1),(556,'2020_06_11_142243_create_categories_table',1),(557,'2020_06_11_143026_create_products_table',1),(558,'2020_06_11_145424_create_members_table',1),(559,'2020_06_11_150551_create_comments_table',1),(560,'2020_06_11_150929_create_bills_table',1),(561,'2020_06_11_151327_create_detail_bills_table',1),(562,'2020_06_11_153126_add_foreign_product',1),(563,'2020_06_11_153720_add_foreign_comments',1),(564,'2020_06_11_154138_add_foreign_bills',1),(565,'2020_06_11_154444_add_foreign_detail_bills',1),(566,'2020_06_12_071730_add_nominations_product',1),(567,'2020_06_18_140202_add_remember_token',1),(568,'2020_11_07_082256_create_colors_table',1),(569,'2020_11_07_082535_create_sizes_table',1),(570,'2020_11_07_084750_create_product_sizes_table',1),(571,'2020_11_07_085151_create_product_colors_table',1),(572,'2020_11_07_140455_create_product_image',1),(573,'2020_11_07_141702_add_fk_product_image',1),(574,'2020_11_07_143714_create_news_table',1),(575,'2020_11_07_144115_create_wishlists_table',1),(576,'2020_11_09_133252_create_codes_table',1),(577,'2020_11_13_162239_create_jobs_table',1),(578,'2020_11_14_010400_create_libraries_table',1),(579,'2020_11_14_010544_create_notifications_table',1),(580,'2020_11_28_005644_add_start_and_end_code',1),(581,'2020_11_28_010228_delete_img_cate',1),(582,'2020_12_06_151144_change_desc_to_slug',1),(584,'2020_12_13_230419_change_email',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Ms. Frieda Lockman','Eos alias adipisci nostrum autem et ab. Nobis aut facilis exercitationem dolorum minima est. Autem enim labore possimus nobis. Quam id perferendis dolor nihil.','ms-frieda-lockman','<p>Molestiae modi quis magni distinctio. Consequatur dolorum hic ad quis consectetur odio. Ea atque et voluptatibus placeat dolor molestias cum. Suscipit perferendis dolores voluptas quod occaecati tempore sed.</p>','forget_img.jpg','2020-12-08 07:05:18','2020-12-08 07:24:14'),(2,'Saul Homenick','Earum earum quos numquam natus neque voluptas asperiores eius. Accusamus veritatis fuga pariatur illum autem debitis. Hic in et rem mollitia voluptatem. Praesentium aspernatur dolorum aut praesentium voluptas.','saul-homenick','<p>Placeat repellendus necessitatibus voluptas quis qui. Quia quisquam voluptatem est voluptatem unde vel quisquam. Vel quo sequi veritatis nesciunt dolorem et porro. Dolor error sed consequatur quo vel quo sequi.</p>','update_img.jpg','2020-12-08 07:05:18','2020-12-08 07:24:29'),(3,'Romaine Moore','Consequuntur neque deserunt occaecati inventore sint aut. Quisquam tempora ut veniam hic voluptas ratione voluptas quia. Unde delectus aut velit ea eligendi eveniet.','romaine-moore','<p>Quam perspiciatis nisi illo natus. Omnis dolorem deserunt perspiciatis cum.</p>','login_img.jpg','2020-12-08 07:05:18','2020-12-08 07:24:42'),(4,'Hãng smartphone Trung Quốc chủ động cài mã độc lên 20 triệu máy, chủ mưu đi tù chỉ 3,5 năm','Consequatur corporis qui sint et tempora consectetur. Placeat eum eos cupiditate excepturi. Commodi in quis recusandae architecto. In sint sed ad quisquam iste.','hang-smartphone-trung-quoc-chu-dong-cai-ma-doc-len-20-trieu-may-chu-muu-di-tu-chi-35-nam','<h2 style=\"font-style:italic\"><span class=\"marker\"><strong>Explicabo laborum suscipit praesentium et officiis. Sed maxime facilis earum est atque quia quia. Eveniet et et labore. Omnis consequatur nemo corrupti qui ut nulla voluptates.</strong></span></h2>\r\n\r\n<p><img alt=\"Image girl\" src=\"https://nld.mediacdn.vn/thumb_w/540/2019/8/3/photo-1-15648212499661517922266.jpg\" style=\"height:500px; width:100%\" /></p>\r\n\r\n<p>If you&#39;re creating a Page post with a link, bear in mind that you can only add the link, text and call to action for the post. If you want to create mockups for Page posts with links and share them with colleagues or clients,&nbsp;<a href=\"https://www.facebook.com/ads/creativehub/\">use Creative Hub instead</a>. You can use Creative Hub to mock up a Page post with a link, but note you cannot publish or schedule it as a Page post.&nbsp;Gionee, một thương hiệu điện thoại từng c&oacute; tiếng tại Trung Quốc mới đ&acirc;y đ&atilde; vướng phải một vụ &aacute;n nghi&ecirc;m trọng khi một c&ocirc;ng ty con của thương hiệu n&agrave;y bị t&ograve;a &aacute;n Trung Quốc kết tội trục lợi người d&ugrave;ng nhờ quảng c&aacute;o th&ocirc;ng qua việc c&agrave;i cắm sẵn trojan b&ecirc;n trong hơn 20 triệu chiếc smartphone do h&atilde;ng n&agrave;y sản xuất.</p>\r\n\r\n<p>&nbsp;</p>','header.jpeg','2020-12-08 07:05:18','2020-12-08 14:37:03'),(5,'Korbin Waters','Quam ut temporibus voluptas aut minus. Labore dolore consequatur nihil voluptas sit. Voluptatem incidunt distinctio quo dolor facere velit. Magni omnis dolorem voluptates aut impedit est quam. Itaque consequatur est voluptas et eum.','dr-katlyn-yost','Doloribus omnis in dolores dolorem atque sed iusto. Totam neque maxime vero nam velit. Eaque aut eius et reiciendis qui suscipit ipsam. Hic unde sit excepturi veniam aut culpa eligendi. Quidem sit voluptatem harum atque.','default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(6,'Dr. Roscoe Schmitt','Ut repellendus et cum id quasi facilis. Aut quibusdam quos nam eligendi velit. Incidunt quis exercitationem suscipit soluta voluptates.','ada-gerhold','Sint illo veritatis vel aut molestias accusantium. Et corporis dicta autem. Qui quae excepturi laboriosam. Iure vero dolorem sapiente error et est.','default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(7,'Kayleigh Kunde','Quia itaque magnam maxime voluptate culpa magnam. Voluptatem voluptate aspernatur aut deserunt non a sed. Nostrum aliquam nobis sit et.','dr-allan-connelly-ii','Sequi aut cum et quae. Assumenda eum et nemo. Aliquam voluptates rerum qui illo omnis beatae dolorem.','default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(8,'Mr. Emerald Kris','Aut et qui delectus voluptate adipisci. Nulla enim et occaecati dolores dolores. Recusandae nemo esse mollitia tempore mollitia aperiam est.','rosanna-anderson','Dolore sit ut sed consequatur voluptatem eum sed et. Itaque in enim laborum. Unde et ad qui corporis. Incidunt aspernatur consequatur suscipit maxime eveniet doloribus.','default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(9,'Creola Gleichner','Aut voluptatum ut error veritatis. Impedit sit voluptas eos omnis. Debitis aut sunt provident natus dolores amet. Hic odit qui est illum omnis itaque autem.','prof-creola-turcotte','Odit voluptates dolor eum architecto sequi. Optio sed odit nihil pariatur nostrum illum. Ea rem non eum delectus numquam.','default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(10,'Irwin Reinger','Quas sed ab dolores nesciunt eligendi eaque. Dignissimos perferendis voluptatem enim accusantium nostrum eaque rerum culpa. Accusamus odit sed omnis illo ex in in.','prof-kristy-trantow','Incidunt quam qui dolorum dicta minus. Rerum quia et quo ipsum quia et accusamus id. Libero iusto esse odio in quo qui est numquam.','default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('0585c759-6229-4702-b88a-cc34c3e8680f','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"1\"}','2020-12-12 13:24:23','2020-12-12 13:16:37','2020-12-12 13:24:23'),('06f6cafc-1dad-442d-9cc1-22c15656cc0d','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:20:26','2020-12-13 07:19:36','2020-12-13 07:20:26'),('0cd933c9-57f1-46e5-a1b6-0d0427bb14b9','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 15:35:28','2020-12-13 14:01:04','2020-12-13 15:35:28'),('1c87f6b6-68c6-4692-851b-b34a14d436b2','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 15:35:28','2020-12-13 13:57:11','2020-12-13 15:35:28'),('230c7bec-1f14-460c-8fe0-8a990afc772b','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"1\"}','2020-12-12 13:24:23','2020-12-12 13:16:30','2020-12-12 13:24:23'),('282c1d48-14a3-492b-a900-967b36cd72da','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-12 13:51:12','2020-12-12 13:26:15','2020-12-12 13:51:12'),('29ccf141-2fbc-46b9-ba5c-55c9c29b135b','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 08:08:27','2020-12-13 08:00:59','2020-12-13 08:08:27'),('2dc3eb51-2278-4600-a833-8666e35ad2dd','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"9\"}','2020-12-12 13:51:12','2020-12-12 13:40:16','2020-12-12 13:51:12'),('2fd0efa8-4069-402d-b9d4-e5410ea18f32','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"9\"}','2020-12-12 13:51:12','2020-12-12 13:39:28','2020-12-12 13:51:12'),('3bd07af2-d1c1-40cb-8f7b-0651bc102168','App\\Notifications\\ChangeOrderNotify','App\\User',1,'{\"member_id\":1,\"bill_id\":1,\"type\":\"2\"}','2020-12-12 13:51:12','2020-12-12 13:28:48','2020-12-12 13:51:12'),('4d3ffa29-87ee-456f-ba18-e528b2fe729f','App\\Notifications\\ChangeOrderNotify','App\\User',2,'{\"member_id\":1,\"bill_id\":3,\"type\":\"1\"}',NULL,'2020-12-12 14:24:39','2020-12-12 14:24:39'),('582bca42-76e0-4b24-9edd-fcb845dfbb5d','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:39:09','2020-12-13 07:38:12','2020-12-13 07:39:09'),('5931abbe-b20d-497a-87b4-cc5b428db1eb','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:20:26','2020-12-13 07:13:58','2020-12-13 07:20:26'),('5e557b18-c277-4098-95ef-555ee59f3afc','App\\Notifications\\ChangeOrderNotify','App\\User',1,'{\"member_id\":1,\"bill_id\":1,\"type\":\"3\"}','2020-12-12 13:51:12','2020-12-12 13:28:34','2020-12-12 13:51:12'),('5efd49a9-6b22-4523-8dc3-170e34e4e856','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 08:00:54','2020-12-13 07:39:24','2020-12-13 08:00:54'),('68980e7d-2e6c-4dba-a7b3-9f21ec4e8d7e','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"1\"}','2020-12-12 13:24:23','2020-12-12 13:16:14','2020-12-12 13:24:23'),('7627e23e-22d9-4a93-bd7c-a306cecabd9c','App\\Notifications\\ChangeOrderNotify','App\\User',1,'{\"member_id\":1,\"bill_id\":1,\"type\":\"1\"}','2020-12-12 13:51:12','2020-12-12 13:28:19','2020-12-12 13:51:12'),('80c7c65c-3c3c-41fc-a717-feff6f3ef10d','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"1\"}','2020-12-12 13:24:23','2020-12-12 13:18:46','2020-12-12 13:24:23'),('8468bacd-ad5b-4509-a1f2-c1cfde36244b','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"9\"}','2020-12-12 13:51:12','2020-12-12 13:38:43','2020-12-12 13:51:12'),('8ea7dd3f-056e-420d-9f50-03a38d587ae5','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:20:26','2020-12-12 14:06:16','2020-12-13 07:20:26'),('915d2e76-08e9-44b3-9b45-a327ec621a3c','App\\Notifications\\ChangeOrderNotify','App\\User',2,'{\"member_id\":1,\"bill_id\":3,\"type\":\"3\"}',NULL,'2020-12-12 14:25:11','2020-12-12 14:25:11'),('a0b4fc89-5ab5-4b5d-a313-cd74e78d4c95','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"9\"}','2020-12-12 13:51:12','2020-12-12 13:39:45','2020-12-12 13:51:12'),('a2272237-4847-4a43-a93e-30a7cb6e76d3','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:36:53','2020-12-13 07:21:36','2020-12-13 07:36:53'),('a6d9a55d-dcc6-446d-8d59-c8a6d431062d','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:37:51','2020-12-13 07:37:40','2020-12-13 07:37:51'),('bbd4acf6-807c-4f0b-96ab-d96216d542d2','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":2}','2020-12-13 07:20:26','2020-12-12 14:24:02','2020-12-13 07:20:26'),('c51b7dae-2650-4f0b-9c2c-fb4b3fbab3e6','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:20:26','2020-12-13 07:15:32','2020-12-13 07:20:26'),('d8ac3ee7-c5f5-453f-8f18-1ff862fc7828','App\\Notifications\\CommentNotification','App\\User',1,'{\"member_id\":1,\"product_id\":\"9\"}','2020-12-12 13:51:12','2020-12-12 13:39:46','2020-12-12 13:51:12'),('e32b8f13-7c92-43be-b246-820143a1da4e','App\\Notifications\\BuyProduct','App\\User',1,'{\"member_id\":1}','2020-12-13 07:21:13','2020-12-13 07:20:33','2020-12-13 07:21:13');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('khanh26122000@gmail.com','$2y$10$0d5LIKHViHFy7S/2MeVWMua8S4vmVmPrJvmf3APJHghGvavdomdZm','2020-12-13 15:21:16');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_colors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `color_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colors`
--

LOCK TABLES `product_colors` WRITE;
/*!40000 ALTER TABLE `product_colors` DISABLE KEYS */;
INSERT INTO `product_colors` VALUES (2,21,2,NULL,NULL);
/*!40000 ALTER TABLE `product_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_image` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_image_product_id_foreign` (`product_id`),
  CONSTRAINT `product_image_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_image`
--

LOCK TABLES `product_image` WRITE;
/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;
INSERT INTO `product_image` VALUES (1,1,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(2,1,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(3,1,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(4,2,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(5,2,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(6,2,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(7,3,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(8,3,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(9,3,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(10,4,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(11,4,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(12,4,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(13,5,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(14,5,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(15,5,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(16,6,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(17,6,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(18,6,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(19,7,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(20,7,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(21,7,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(22,8,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(23,8,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(24,8,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(25,9,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(26,9,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(27,9,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(28,10,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(29,10,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(30,10,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(31,11,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(32,11,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(33,11,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(34,12,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(35,12,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(36,12,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(37,13,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(38,13,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(39,13,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(40,14,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(41,14,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(42,14,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(43,15,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(44,15,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(45,15,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(46,16,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(47,16,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(48,16,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(49,17,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(50,17,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(51,17,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(52,18,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(53,18,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(54,18,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(55,19,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(56,19,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(57,19,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(58,20,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(59,20,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(60,20,'default_pr.jpg','2020-12-08 07:05:18','2020-12-08 07:05:18'),(64,21,'1607867235careshare_ao_polo_375x425.jpg','2020-12-13 13:50:34','2020-12-13 13:50:34'),(65,21,'16078672482L6A3114_550x623.jpg','2020-12-13 13:50:34','2020-12-13 13:50:34'),(66,21,'1607867238BOO06080_550x623.jpg','2020-12-13 13:50:34','2020-12-13 13:50:34');
/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_sizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `size_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sizes`
--

LOCK TABLES `product_sizes` WRITE;
/*!40000 ALTER TABLE `product_sizes` DISABLE KEYS */;
INSERT INTO `product_sizes` VALUES (5,21,1,NULL,NULL),(6,21,3,NULL,NULL),(7,21,4,NULL,NULL),(8,21,6,NULL,NULL);
/*!40000 ALTER TABLE `product_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `name_product` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_product` double NOT NULL,
  `sale` double(4,1) NOT NULL,
  `quantity_product` int(11) NOT NULL,
  `decscription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `nomination` tinyint(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'emerald-dickinson',3,'Darby Grant',20000,0.0,20,'Janessa Ledner',2,0,'2020-12-12 13:28:34'),(2,'harmony-halvorson',2,'Miss Bert Cronin',20000,0.0,20,'Eleanore Goyette I',0,1,'2020-12-08 07:05:17'),(3,'lori-koepp',1,'Prof. Buster Hessel DDS',20000,0.0,20,'Connie Daniel',2,1,'2020-12-12 14:25:11'),(4,'ms-cortney-eichmann',4,'Chloe Hoppe',20000,0.0,20,'Dr. Frances Frami',0,0,'2020-12-08 07:05:17'),(5,'jaquan-morar',1,'Darrin Quigley',20000,0.0,20,'Mrs. Kathleen Sanford Jr.',0,0,'2020-12-08 07:05:17'),(6,'katelin-willms-iv',2,'Prof. Evan Kilback III',20000,0.0,20,'Miss Marilie Runte',0,0,'2020-12-08 07:05:17'),(7,'rebecca-marquardt',3,'Dr. Maximilian Kessler',20000,0.0,20,'Korbin Bins',0,1,'2020-12-08 07:05:17'),(8,'niko-king',3,'Ayla Rodriguez',20000,0.0,20,'Hal Leffler',0,0,'2020-12-08 07:05:17'),(9,'casey-bartell-dvm',1,'Prof. Bill Beier PhD',20000,0.0,20,'Catalina Kulas',2,0,'2020-12-12 13:40:10'),(10,'jordon-pfannerstill',1,'Bette Wuckert',20000,0.0,20,'Zula Lowe',0,1,'2020-12-08 07:05:17'),(11,'prof-murl-schiller-phd',3,'Hallie Torp',20000,0.0,20,'Miss Destinee Rippin I',0,0,'2020-12-08 07:05:17'),(12,'everette-ratke',1,'Conrad Kuhic',20000,0.0,20,'Dr. Blaze Robel',0,1,'2020-12-08 07:05:17'),(13,'esperanza-gottlieb',1,'Juwan Dietrich',20000,0.0,20,'Darius Gorczany',0,1,'2020-12-08 07:05:17'),(14,'prof-eleazar-von',2,'Alana Stokes',20000,0.0,20,'Ms. Leora Rowe',0,1,'2020-12-08 07:05:17'),(15,'shaylee-rohan',2,'Hobart Schmeler Jr.',20000,0.0,20,'Gwendolyn Gerlach I',0,1,'2020-12-08 07:05:17'),(16,'prof-candido-jacobi-iii',1,'Mr. Gregorio Lang',20000,0.0,20,'Ms. Jazmin Bartell I',0,0,'2020-12-08 07:05:17'),(17,'wade-turner',2,'Lorenz Skiles',20000,0.0,20,'Brisa Towne',0,0,'2020-12-08 07:05:17'),(18,'mr-chaz-romaguera',1,'Velda DuBuque',20000,0.0,20,'Nico Trantow',0,0,'2020-12-08 07:05:17'),(19,'odie-ondricka',2,'Ms. Darby Streich',20000,0.0,20,'Jonatan Rippin',0,1,'2020-12-08 07:05:17'),(20,'idella-blick',1,'Kale Gleichner',20000,0.0,20,'Chadrick Johnson',0,0,'2020-12-08 07:05:17'),(21,'ao-polo-coolmate-theu-careshare-mau-den5',1,'Áo Polo Coolmate thêu Care&Share màu đen5',190000,5.0,20,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1,1,'2020-12-13 13:59:03');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'X','2020-12-13 13:44:46','2020-12-13 13:44:46'),(2,'XL','2020-12-13 13:44:52','2020-12-13 13:44:52'),(3,'L','2020-12-13 13:44:57','2020-12-13 13:44:57'),(4,'M','2020-12-13 13:45:03','2020-12-13 13:45:03'),(5,'XXL','2020-12-13 13:45:09','2020-12-13 13:45:09'),(6,'S','2020-12-13 13:45:14','2020-12-13 13:45:14');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_member_id_foreign` (`member_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (1,1,2,'2020-12-11 15:55:45','2020-12-11 15:55:45');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-13 23:07:34
