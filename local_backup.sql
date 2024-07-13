-- MySQL dump 10.13  Distrib 8.0.32, for Linux (aarch64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agents_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES (1,'株式会社エージェントテスト','船長','テスtルフィ','r.ohmine@freddy.co.jp','00033334444',NULL,'$2y$12$CuE7ShzMxUQx6q5m8HlT9unDInuKaPymijw4nJHMdsV7x71nbBKJe',NULL,'2024-06-13 06:41:32','2024-07-02 16:42:21','http://localhost/agent/profile/edit','logos/APKLRlO2JWeSuzAbNCXDDMpcJAEhVqI3v6xGXcgo.png'),(2,'エージェントエージェント株式会社','CEO','野原しんのすけ','ohmnron15@gmail.com',NULL,NULL,'$2y$12$Jg3esPCqNsW5mokANH.AaOBlabW4G7XOkPTtWUMD.SON.GaMHoze6',NULL,'2024-06-14 06:27:27','2024-06-14 06:27:27',NULL,NULL),(3,NULL,NULL,NULL,'test@test.jp',NULL,NULL,'$2y$12$RGkRed7xA4EA5qkzWUDHIunteQJri3kTMCar3roC0Vjjuod2pITNS',NULL,'2024-06-14 07:02:33','2024-06-14 07:02:33',NULL,NULL),(4,NULL,NULL,NULL,'ohmnron15b@gmail.com',NULL,NULL,'$2y$12$cNjxcqEHZWb5p3IaEGn6kuqtPk3/TfTWB.ZK9Yjsd/C9AlvyHpOkG',NULL,'2024-07-09 12:26:54','2024-07-09 12:26:54',NULL,NULL);
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
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
-- Table structure for table `customer_users`
--

DROP TABLE IF EXISTS `customer_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catch_copy` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `career_description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommendation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `desired_salary_min` int DEFAULT NULL,
  `desired_salary_max` int DEFAULT NULL,
  `skill_distribution_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_comment_1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_distribution_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_comment_2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_distribution_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_comment_3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_companies_worked` int DEFAULT NULL,
  `work_preference` json DEFAULT NULL,
  `notable_achievements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `matching` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_users_agent_id_foreign` (`agent_id`),
  CONSTRAINT `customer_users_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_users`
--

LOCK TABLES `customer_users` WRITE;
/*!40000 ALTER TABLE `customer_users` DISABLE KEYS */;
INSERT INTO `customer_users` VALUES (1,2,'てすと1','TT','1990-10-01','男性','あああ','さいこうだぜ！！','なんでもできちゃうわよ','内閣',300,400,'AAA',NULL,'AAA',NULL,'AAA',NULL,8,'\"[]\"','あああ','pending',1,'2024-06-01 22:32:00','2024-06-29 13:02:33'),(2,2,'Christina Bersh','TS','1992-04-24','女性','Director','空前絶後の、超絶怒涛のピン芸人！','お笑い芸人一本だぜ。どんな現場でも爆笑の嵐にさせちゃうぜ','みんながげっそりしていて笑いがない',400,800,'CCC','イェーーーーイ','DDD','のど飴なめる','EEE','大きな声',1,'\"[]\"','R1優勝','pending',3,'2024-06-28 22:34:00','2024-07-09 07:16:00'),(3,1,'David Harrison','DH','1880-03-20','男性','aaa','スポンジのような吸収力','雨の日の次の日のグラウンドで役に立ちます','学校',700,1000,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'500tの水分','inactive',4,'2024-06-27 22:34:00','2024-06-20 13:23:18'),(4,1,'東急次郎','T.J','1990-02-10','男性','マーケター','事業開発、戦略策定など上流経験豊富ながら、CRM/AD領域は実務対応も可能なジェネラリスト','東急株式会社入社。OOH やイベント、流通対策等のオフラインを活用したプロモーションの企画、営業を担当。その後、ホテル・リゾートの事業部で会員制リゾートのブランド戦略、広告宣伝業務とリゾート開発の事業企画に従事。開発では、主にタイムシェア、分譲ホテルコンド等の新規事業を担当。その後社内起業家育成制度を活用して屋外広告事業の社内ベンチャーを立ち上げ、事業責任者を務める。2022年に起業。2Bの特にリードナーチャリングやMA,SFA導入支援、Bigqueryなどを活用したデータ統合・可視化、分析など','・新規事業立ち上げを検討している\r\n・オフラインのマーケティングも必要としている\r\n・CRMやSFAなどの業務改善ツール導入を検討している/導入しているが上手く使いこなせていない',900,1500,'CCC','設計から運用まで一貫して対応可能。既存顧客の売上を200%UPに貢献','BBB','戦略だけでなく、自身で運用も可能','DDD','複数事業立ち上げ＆黒字化経験あり。',5,'\"[\\\"\\\\u30d5\\\\u30ec\\\\u30c3\\\\u30af\\\\u30b9\\\\u30bf\\\\u30a4\\\\u30e0\\\",\\\"\\\\u9031\\\\u4f11\\\\u4e09\\\\u65e5\\\\u5236\\\"]\"','・東急不動産での事業責任者としてプロジェクトを立ち上げ、月次売上2000万へと成長させる\r\n・CRM、MAを用いた事業効率化に貢献しており、業務委託・兼業メンバー6名（セールスは1名のみ）で上記プロジェクト運営させるなど体制づくりも得意とする','pending',1,'2024-06-07 20:05:00','2024-06-29 15:23:26'),(5,1,'田中太郎','TT','1790-05-26','男性','マーケター','ソフトバンク社で活躍。デジマ全般対応可能なマーケター。誠実な人柄で顧客からの信頼も厚い','ソフトバンク（営業→新規事業立ち上げ）を経験の後デジマ支援会社へ転職→独立といった経歴。デジマ全般の戦略（事業企画からマーケティング戦略立案・実行・マネジメント）、SEO、CV改善、MA/SFA等のナーチャリング施策（リクルートの支援経験）などが得意領域。セールスやマネジメントも経験。大手企業のデジマ支援でも成果を出しており、デジマ全般の知見は豊富。自身のできる領域を理解しており、あまり貢献できない領域は正直に伝えてくれる。制作ディレクションなども可能。','・社内の若手を育てていきたい企業\r\n・初めてマーケティングに力を入れていきたいと考えている企業\r\n・営業とマーケの連携を強化したい企業',800,1200,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,'・ソフトバンク時代には複数年トップセールスを経験したのち、新規事業部へ配属\r\n・デジマ全般を網羅しており、SEOにおいては年間セッション350万→500万、ADにおいてはCPA5.5万円→2万円代への改善等、実績も豊富。\r\n・Marketo、hubspotを用いたナーチャリング施策も対応可','active',2,'2024-06-11 14:52:00','2024-06-23 01:14:24'),(6,1,'大谷さん','OT','1999-10-01',NULL,'CTO','こんにちは','あああああ','ああああ',800,5000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ああああああああああ','active',1,'2024-06-27 20:07:00','2024-06-23 11:07:58'),(7,1,'aaa',NULL,NULL,'男性','代表取締役',NULL,NULL,NULL,300,300,NULL,NULL,NULL,NULL,NULL,NULL,1,'\"[]\"',NULL,'pending',NULL,'2024-06-29 08:13:00','2024-06-29 08:13:00'),(8,1,'aaaaa',NULL,NULL,'男性','aaaaaaaaa',NULL,NULL,NULL,300,300,'AAA','aaaaa','DDD','aaaaaa','CCC','aaaaaa',1,'\"[]\"',NULL,'pending',NULL,'2024-06-29 08:25:13','2024-06-29 08:25:13'),(9,1,'てすと',NULL,NULL,'男性','あああ',NULL,'すごいすごい','イエス',300,300,'AAA',NULL,'BBB',NULL,'AAA',NULL,1,'\"[]\"',NULL,'pending',NULL,'2024-07-11 14:17:51','2024-07-12 05:16:41');
/*!40000 ALTER TABLE `customer_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employer_users`
--

DROP TABLE IF EXISTS `employer_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employer_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employer_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employer_users`
--

LOCK TABLES `employer_users` WRITE;
/*!40000 ALTER TABLE `employer_users` DISABLE KEYS */;
INSERT INTO `employer_users` VALUES (1,'株式会社Freddy2','代表取締役','大嶺 怜音奈','r.ohmine@freddy.co.jp','00000000000','http://localhost/employer/profile/edit','logos/6FpKES7VSEnQDGmzuUBf80Kcib3Qm4ifBgTn7yAN.png',NULL,'$2y$12$KMTvOxavHqRegj0mDh4BKuYWDM7w45vmswvCO2Wyd089xisYfBnuG',NULL,'2024-06-14 06:47:08','2024-07-02 16:14:15'),(2,'株式会社テスト','課長','テスト太郎','test1@test.jp','00011112222','http://localhost/employer/profile/edit','logos/RuiZV4J9tUXCDJOJ90Tcb3sQuF08rhI0Z5fHw6T9.png',NULL,'$2y$12$M9jfaOJpbVBiQZN4ZKIhpeIXXseJwIM4ilC.1BaGsw6xbiT0qK.1e',NULL,'2024-06-14 07:26:59','2024-07-02 16:30:04'),(3,NULL,NULL,NULL,'test2@test.jp',NULL,NULL,NULL,NULL,'$2y$12$jmZ3ll/hE8oLnhQl4U/0VOuyL/VXuyHYAbMUt83DMLeTQVDd0EDfC',NULL,'2024-06-14 07:33:17','2024-06-14 07:33:17'),(4,NULL,NULL,NULL,'ohmnron15b@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$IptjOk7CjoGWUnIRTJU3z.uEMrIHoX0aHe1xLou7.8KgCOAQp2cba',NULL,'2024-07-09 12:34:55','2024-07-09 12:34:55');
/*!40000 ALTER TABLE `employer_users` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"36f125c8-282d-4e8f-a225-c5dcef5d2e12\",\"displayName\":\"App\\\\Events\\\\ExampleEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:23:\\\"App\\\\Events\\\\ExampleEvent\\\":1:{s:7:\\\"message\\\";s:13:\\\"Hello Pusher!\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"}}',0,NULL,1720150990,1720150990),(2,'default','{\"uuid\":\"4e2eb2bd-ad81-4795-b029-45dd8a13c86f\",\"displayName\":\"App\\\\Events\\\\ExampleEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:23:\\\"App\\\\Events\\\\ExampleEvent\\\":1:{s:7:\\\"message\\\";s:13:\\\"Hello Pusher!\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"}}',0,NULL,1720151138,1720151138);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `employer_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,2,'こんにちは','2024-07-05 06:05:19','2024-07-05 06:05:19','App\\Models\\Agent','App\\Models\\EmployerUser'),(2,1,1,'こんにちは２','2024-07-05 06:10:01','2024-07-05 06:10:01','App\\Models\\EmployerUser','App\\Models\\Agent'),(3,1,1,'こんにちは私はエージェントです。','2024-07-05 06:23:45','2024-07-05 06:23:45','App\\Models\\Agent','App\\Models\\EmployerUser'),(4,1,1,'こんにちは私は株式会社Freddyです。','2024-07-05 06:29:14','2024-07-05 06:29:14','App\\Models\\EmployerUser','App\\Models\\Agent'),(5,1,1,'こんにちは、エージェントです。','2024-07-05 06:32:24','2024-07-05 06:32:24','App\\Models\\Agent','App\\Models\\EmployerUser'),(6,1,2,'こんにちは','2024-07-05 06:32:31','2024-07-05 06:32:31','App\\Models\\Agent','App\\Models\\EmployerUser'),(7,1,1,'こんにちは、私は利用企業です。','2024-07-05 15:11:06','2024-07-05 15:11:06','App\\Models\\EmployerUser','App\\Models\\Agent'),(8,1,2,'この人を紹介してください','2024-07-05 15:21:03','2024-07-05 15:21:03','App\\Models\\EmployerUser','App\\Models\\Agent'),(9,1,1,'Aさん紹介してください','2024-07-07 01:40:30','2024-07-07 01:40:30','App\\Models\\EmployerUser','App\\Models\\Agent'),(10,1,1,'◯◯さん紹介してくれや','2024-07-07 02:43:36','2024-07-07 02:43:36','App\\Models\\EmployerUser','App\\Models\\Agent'),(11,1,1,'よろしくね','2024-07-07 11:07:34','2024-07-07 11:07:34','App\\Models\\EmployerUser','App\\Models\\Agent'),(12,1,1,'こんにちは','2024-07-12 05:07:39','2024-07-12 05:07:39','App\\Models\\EmployerUser','App\\Models\\Agent'),(13,1,1,'こんにちは','2024-07-13 08:30:02','2024-07-13 08:30:02','App\\Models\\Agent','App\\Models\\EmployerUser'),(14,1,1,'こんにちは','2024-07-13 12:58:25','2024-07-13 12:58:25','App\\Models\\EmployerUser','App\\Models\\Agent');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_06_13_053927_create_agents_table',2),(5,'2024_06_13_130754_create_customer_users_table',3),(7,'2024_06_14_040305_create_employer_users_table',4),(8,'2024_06_14_073859_create_messages_table',5),(9,'2024_06_20_055945_add_fields_to_customer_users_table',6),(10,'2024_06_20_062049_add_recommendation_to_customer_users_table',7),(11,'2024_06_20_131631_add_initial_to_customer_users_table',8),(12,'2024_06_29_022806_add_birthday_to_customer_users_table',9),(13,'2024_06_29_023720_add_gender_column_to_customer_users_table',9),(14,'2024_06_29_031243_remove_age_from_customer_users_table',10),(15,'2024_06_29_053305_add_new_columns_to_customer_users_table_2',11),(16,'2024_06_29_080830_add_default_value_to_status_in_customer_users_table',12),(17,'2024_06_29_082006_remove_skill_distribution_from_customer_users_table',13),(18,'2024_06_30_041756_add_hp_url_and_logo_image_to_agents_table',14),(19,'2024_07_02_124932_add_hp_url_and_logo_image_to_employer_users_table',15),(20,'2024_07_05_024906_drop_messages_table',16),(21,'2024_07_05_025437_create_messages_table2',17),(22,'2024_07_05_054658_modify_messages_table_for_polymorphic',18),(23,'2024_07_05_123215_add_agent_id_to_customer_users_table',19),(24,'2024_07_11_141401_update_agent_id_in_customer_users_table',20),(25,'2024_07_13_013740_modify_messages_table_for_polymorphic_fix',21),(26,'2024_07_13_082328_drop_foreign_keys_from_messages_table',22),(27,'2024_07_13_082354_add_foreign_keys_to_messages_table',22);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('4ErQD238xedizzHH23Dmmz1fNLHjkGwBsrm1zOqg',1,'192.168.65.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQWI0RWxFM2xVcHdMYWVMdkgxM3ZFTk5VNU9Od002QjMzYzhaaXY4RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvYWdlbnQvbWVzc2FnZXM/cmVjZWl2ZXJfaWQ9MiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2VtcGxveWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjUyOiJsb2dpbl9hZ2VudF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1720875537);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2024-07-13 14:40:01
