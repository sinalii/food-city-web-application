CREATE DATABASE  IF NOT EXISTS `food_city` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `food_city`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: food_city
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:1;',1794222465),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1794222465;',1794222465);
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
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'CAT001','Rice & Grocery Essentials',NULL,1,'2026-11-09 01:23:30','2026-11-09 01:23:30',NULL,1),(2,'CAT002','Dairy & Chilled Products',NULL,2,'2026-11-09 01:23:30','2026-11-09 01:23:30',NULL,1),(3,'CAT003','Biscuits, Snacks & Confectionery',NULL,3,'2026-11-09 01:23:30','2026-11-09 01:23:30',NULL,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
  `attempts` smallint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_11_09_000000_create_categories_table',2),(5,'2026_11_09_000001_create_products_table',2),(6,'2026_11_09_000002_add_dietary_tags_to_products_table',3),(7,'2026_11_09_000003_add_store_admin_and_wishlist_features',4),(8,'2026_11_09_000004_create_product_reviews_table',5);
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
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_reviews_product_id_user_id_unique` (`product_id`,`user_id`),
  KEY `product_reviews_user_id_foreign` (`user_id`),
  KEY `product_reviews_product_id_created_at_index` (`product_id`,`created_at`),
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
INSERT INTO `product_reviews` VALUES (2,70,7,4,'great','2026-11-09 04:40:32','2026-11-09 04:40:32');
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pack_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_lkr` int unsigned NOT NULL,
  `dietary_tags` json DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost_price` int unsigned NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'each',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `stock_quantity` int unsigned NOT NULL DEFAULT '0',
  `minimum_stock` int unsigned NOT NULL DEFAULT '5',
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  UNIQUE KEY `products_barcode_unique` (`barcode`),
  KEY `products_category_id_name_index` (`category_id`,`name`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (61,1,'Premium Nadu Rice','Araliya','5 kg',1150,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]','products/DVeKu4sIUV6zM0M3fAe1cGNpCi5rcK23zZRn9b2I.webp',0,'2026-11-09 02:18:35','2026-11-09 05:50:12',NULL,0,NULL,NULL,'each',1,0,5,NULL),(62,1,'White Raw Rice','Nipuna','5 kg',1149,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]','products/nPakcwl0zJpkKFFxpZQNiRFvaNyvoT7DIO6GyyNo.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:51:06',NULL,0,NULL,NULL,'each',1,0,5,NULL),(63,1,'Red Dhal','Harischandra','1 kg',320,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]','products/i1waKBYQKgoL7XCk63F0DxjCUat7xEkRaa2o29Xq.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:52:02',NULL,0,NULL,NULL,'each',1,0,5,NULL),(64,1,'Wheat Flour','Prima','1 kg',320,'[\"Vegetarian\", \"Vegan\"]','products/Ujb2V9LMUFxThGCA7PCeri96rKoBPLdsrhLNd4Tz.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:56:10',NULL,0,NULL,NULL,'each',1,0,5,NULL),(65,1,'White Sugar','Kist','1 kg',250,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(66,1,'Basmati Rice','Daawat','1 kg',1820,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(67,1,'Coconut Oil','Marina','1 L',1660,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]','products/HsTDigHgmR1CQY5WFJsYbthNZ2O4SP3q7pWnuEVf.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:41:14',NULL,0,NULL,NULL,'each',1,0,5,NULL),(68,1,'Chickpeas','Orient','500 g',380,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]','products/MUOvgcWNh4h5I4eswQFWLjf4lMzG75mdCBagnMv5.webp',0,'2026-11-09 02:18:35','2026-11-09 05:42:04',NULL,0,NULL,NULL,'each',1,0,5,NULL),(69,1,'Table Salt','Catch','400 g',130,'[\"Vegetarian\", \"Vegan\", \"Gluten-free\"]','products/ftM9OxM3FCIBGuRYXcMnKgvvkK9a4wXcaJN30u3o.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:42:49',NULL,0,NULL,NULL,'each',1,0,5,NULL),(70,1,'Atta Flour','Wijaya','1 kg',449,'[\"Vegetarian\", \"Vegan\"]','products/plgUBhU7ozFUVT91q2PfAasnOyXmxo4mhtW1alOl.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:43:26',NULL,0,NULL,NULL,'each',1,0,5,NULL),(71,2,'Full Cream Milk Powder','Anchor','400 g',1300,'[\"Vegetarian\", \"Contains dairy\"]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(72,2,'Full Cream Milk Powder','Anchor','1 kg',3250,'[\"Vegetarian\", \"Contains dairy\"]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(73,2,'Fresh Milk','Ambewela','1 L',500,'[\"Contains dairy\"]','products/X00xYIvjRNUqS9cUPXedTv1mvDO2vy9hI9UUVLcS.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:39:01',NULL,0,NULL,NULL,'each',1,0,5,NULL),(74,2,'Vanilla Set Yoghurt','Newdale','80 g',80,'[\"Vegetarian\", \"Contains dairy\"]','products/Be1tcR79MFNtbAhjg1uwKkaFffQeA08aRuNPOC6S.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:40:17',NULL,0,NULL,NULL,'each',1,0,5,NULL),(75,2,'Drinking Yoghurt','Kotmale','180 ml',150,'[\"Vegetarian\", \"Contains dairy\"]','products/FyQOnl1HhX2kEDuKrt1Pd7BRv2Rim2z41Yq99dph.png',0,'2026-11-09 02:18:35','2026-11-09 05:38:34',NULL,0,NULL,NULL,'each',1,0,5,NULL),(76,2,'Cheese Slices','Kraft','200 g',1150,'[\"Vegetarian\", \"Contains dairy\"]','products/VNyAXzplpWWks9l8wtX6cLzmWfdc2mlXDayPTFgv.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:38:13',NULL,0,NULL,NULL,'each',1,0,5,NULL),(77,2,'Salted Butter','Anchor','200 g',950,'[\"Vegetarian\", \"Contains dairy\"]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(78,2,'UHT Milk','Highland','1 L',450,'[\"Vegetarian\", \"Contains dairy\"]','products/6kJ2SPB3k4ceHcZUGSA3bZhHAvxNg1vzJ0p4gnbF.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:37:39',NULL,0,NULL,NULL,'each',1,0,5,NULL),(79,2,'Chocolate Milk','Kotmale','180 ml',180,'[\"Vegetarian\", \"Contains dairy\"]','products/Ij2Wcto9ACPosZ90Czg4yetc1nbwJXodEJybTJsr.jpg',0,'2026-11-09 02:18:35','2026-11-09 05:37:11',NULL,0,NULL,NULL,'each',1,0,5,NULL),(80,2,'Vanilla Ice Cream','Elephant House','1 L',1200,'[\"Vegetarian\", \"Contains dairy\"]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(81,3,'Chocolate Cream Biscuits','Munchee','200 g',180,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(82,3,'Lemon Puff Biscuits','Maliban','200 g',220,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(83,3,'Milk Shortcake','Munchee','200 g',190,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(84,3,'Nice Biscuits','Maliban','200 g',180,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(85,3,'Chocolate Wafers','Ritzbury','100 g',250,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(86,3,'Chocolate Cream Biscuits','Oreo','133 g',350,'[]','products/vTuPiwoAzUm7kwRfp82xsyZ8FxQJAvxK1WSHcKhv.jpg',0,'2026-11-09 02:18:35','2026-11-09 03:55:36',NULL,0,NULL,NULL,'each',1,0,5,NULL),(87,3,'Chocolate Fingers','Munchee','100 g',180,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(88,3,'Stix Chocolate','Munchee','20 g',29,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(89,3,'O-kay Chocolate','Tiara','18 g',29,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(90,3,'Strawberry Cake','Little Lion','200 g',390,'[]',NULL,0,'2026-11-09 02:18:35','2026-11-09 02:18:35',NULL,0,NULL,NULL,'each',1,0,5,NULL),(91,3,'oreo','Mondelez International','100g',650,'[\"Contains dairy\"]','products/vTuPiwoAzUm7kwRfp82xsyZ8FxQJAvxK1WSHcKhv.jpg',1,'2026-11-09 03:36:16','2026-11-09 03:36:17','100g.',600,NULL,NULL,'each',1,20,100,'2028-02-08');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_items`
--

DROP TABLE IF EXISTS `sale_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int unsigned NOT NULL,
  `unit_price_lkr` int unsigned NOT NULL,
  `cost_price_lkr` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_items_sale_id_foreign` (`sale_id`),
  KEY `sale_items_product_id_foreign` (`product_id`),
  CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_items`
--

LOCK TABLES `sale_items` WRITE;
/*!40000 ALTER TABLE `sale_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `total_lkr` int unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_reference_unique` (`reference`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_status_created_at_index` (`status`,`created_at`),
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('AWUDAaHGXJpoqm5gsxHH0D6sBnhEqzgu1vaqhgh3',4,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9818','eyJfdG9rZW4iOiJhdzA1RmxlMkM4Q09WMmxVR1EzMTRYSjRmNlQ4TjlpQlU4QU51RnN1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4NzY5XC9hZG1pblwvaW52ZW50b3J5Iiwicm91dGUiOiJhZG1pbi5pbnZlbnRvcnkuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NCwicGFzc3dvcmRfaGFzaF93ZWIiOiI0ZGU2YzFjY2I5YjdiM2RkMzUxMzFkYzAwYWM5ZTQzYmRjYTdlYzRmYThmNGIxMjgzYWUyYWRmMDM2ZDAzN2M4In0=',1794215280),('Be4VIYZKoeV4Rrb6d136P6ApenhRh4YFnIchxSB1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9818','eyJfdG9rZW4iOiJxa0pzRm8ycVFQOXRVNDZkcmoxblVhZnFjcVcxaWFiTUtwTEhyTXVNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4NzcwXC8/Y2F0ZWdvcnk9Q0FUMDAzIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794216392),('BYBtpPtIh9u8RUGnRWyC19MUp3O18G28xART06gZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9818','eyJfdG9rZW4iOiJZUFA2SENyRGpyWGViT0cwcUpFT3JiZ1RaN2tKWnFnRUQxU2RxeDlBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4NzcwXC8/Y2F0ZWdvcnk9Q0FUMDAzIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794216310),('EyU6Htsj27vppCLYNUnQtnK7NUKBk3aHQvAKg0wG',5,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9818','eyJfdG9rZW4iOiJjUklyV1pXN2lhRlpuTVFZWjQxeUVrVlJGa29GUDY1N2hUUUZzUlVqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4NzcyXC8/Y2F0ZWdvcnk9Q0FUMDAzIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjUsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTQwNTZmZDJhNjQ1ZTcxNmFkOWZmMzA2ZjBlYmFlZjBmZjJiODU4MGI4YTJmN2EyNTZjMzhiMjM5OTYxMmNlNiJ9',1794217382),('ktCRtbLS5m7hG9ZsWuaaPW1t6bxvbt54fOoBtnjl',6,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9818','eyJfdG9rZW4iOiJjd2x2MHk5d2duRTNHM0VoMGI3TUdoVDR2U2JlMjUyMkFRTlhGNXZ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4NzcyXC8/Y2F0ZWdvcnk9Q0FUMDAzIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjYsInBhc3N3b3JkX2hhc2hfd2ViIjoiNTE0MWEyN2IwNWNhNzAxOTQ2NzYwMDhjNWYyNzhjMmRiYmJmNTM4ZDEyZmY2MGJiODgxNzNkMDRhMDkyNjk5ZCJ9',1794217408),('QKiUvowYtvN4zlRC9BML0rWaXY8hiVnNA33BKDo8',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9818','eyJfdG9rZW4iOiJNUnJyOTZpNlhwY0JXeUtHbEY1aHZTUWFnN2tSd2ZGb2twMWFoZ1VGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4NzcxIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794216614),('uDXcM9KyAEJ4ovshKa3ndT4St2VgGKjnJwmO45r1',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJiUVVHbkdBcW1abEs5emU2ZWlSV3RubWdzWVFiOVlIYng0eEdPODZMIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9wcm9kdWN0cyIsInJvdXRlIjoiYWRtaW4ucHJvZHVjdHMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjQsInBhc3N3b3JkX2hhc2hfd2ViIjoiNGRlNmMxY2NiOWI3YjNkZDM1MTMxZGMwMGFjOWU0M2JkY2E3ZWM0ZmE4ZjRiMTI4M2FlMmFkZjAzNmQwMzdjOCJ9',1794223570);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_movements`
--

DROP TABLE IF EXISTS `stock_movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_movements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `quantity_change` int NOT NULL,
  `stock_after` int unsigned NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_movements_user_id_foreign` (`user_id`),
  KEY `stock_movements_product_id_created_at_index` (`product_id`,`created_at`),
  CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movements`
--

LOCK TABLES `stock_movements` WRITE;
/*!40000 ALTER TABLE `stock_movements` DISABLE KEYS */;
INSERT INTO `stock_movements` VALUES (1,91,4,20,20,'opening_stock',NULL,NULL,'2026-11-09 03:36:17','2026-11-09 03:36:17');
/*!40000 ALTER TABLE `stock_movements` ENABLE KEYS */;
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
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'FoodCity Admin','admin@foodcity.com',NULL,'$2y$12$Tyu/5pz3O4PoF0jIPfmlHOv.VI99FCl18mhii8v.O3TG2.0LV.2Hm','9SmppJ63XZrXcTK4Ua72hkrkMsAWmqrY0v50XFw54ZXTwp1Wu4TRuzOQ688z','2026-11-09 03:23:11','2026-11-09 03:23:11','admin'),(7,'sinali','Sinali1234*@gmail.com',NULL,'$2y$12$.LRE2x0jqnYqjr.AVuH7UubO1o.UsxSvyMmmvDTkrpsdMk51DcahK',NULL,'2026-11-09 04:40:02','2026-11-09 04:40:02','customer');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
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

-- Dump completed on 2026-11-11  9:43:23
