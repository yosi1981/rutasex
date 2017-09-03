-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: contactos
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncios` (
  `idanuncio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafinal` date NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idlocalidad` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ult_muestra` date DEFAULT NULL,
  `horainicial` time DEFAULT NULL,
  `horafinal` time DEFAULT NULL,
  `reservaactiva` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idanuncio`),
  KEY `anuncios_idusuario_foreign` (`idusuario`),
  CONSTRAINT `anuncios_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` VALUES (3,'ane','lakdsjf','2017-07-03','2017-07-06',0,5,2,NULL,NULL,NULL,NULL,NULL,1),(4,'prueba','prueba','2017-06-20','2017-06-27',0,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(5,'1c','1c','2017-06-19','2018-05-20',1,6,2,NULL,NULL,'2017-07-01',NULL,NULL,NULL),(7,'adlfkjas','l jasld fj','2017-07-23','2017-07-25',1,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(8,'lakdsjf','akjsdhf','2015-02-22','2015-02-22',1,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(9,'alkdjf','kajds f','2015-02-22','2015-02-22',1,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(10,'lkf','lkasdf','2015-02-22','2015-02-22',1,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(11,'asdf','asdf','2015-02-22','2015-02-22',1,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(12,'lksajd','lkjads','2015-02-22','2015-02-22',1,5,2,NULL,NULL,NULL,NULL,NULL,NULL),(13,'valeska sex','Sexy Valeska','2017-08-23','2017-08-29',1,5,74,NULL,NULL,NULL,NULL,NULL,NULL),(14,'valeska sex prueba','sexy valeska prueba','2017-08-23','2017-08-29',1,8,74,NULL,NULL,'2017-08-23',NULL,NULL,NULL),(15,'mas y otro','mas y otro','2017-08-23','2017-08-29',1,8,74,NULL,NULL,'2017-08-23',NULL,NULL,NULL);
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anunciosDia`
--

DROP TABLE IF EXISTS `anunciosDia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anunciosDia` (
  `idanuncioDia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `idanuncio` int(10) unsigned NOT NULL,
  `idlocalidad` int(10) unsigned NOT NULL,
  `idadminPro` int(10) unsigned NOT NULL,
  `iddelegado` int(10) unsigned NOT NULL,
  `numvisitas` double NOT NULL,
  `idpartner` int(11) unsigned NOT NULL,
  `idprovincia` int(11) unsigned NOT NULL,
  `idanunciante` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idanuncioDia`),
  KEY `anunciosdia_idanuncio_foreign` (`idanuncio`),
  KEY `anunciosdia_idlocalidad_foreign` (`idlocalidad`),
  KEY `anunciosdia_idrespprov_foreign` (`idadminPro`),
  KEY `anunciosdia_idrespprovorigen_foreign` (`iddelegado`),
  CONSTRAINT `anunciosdia_idanuncio_foreign` FOREIGN KEY (`idanuncio`) REFERENCES `anuncios` (`idanuncio`),
  CONSTRAINT `anunciosdia_idlocalidad_foreign` FOREIGN KEY (`idlocalidad`) REFERENCES `localidades` (`idlocalidad`),
  CONSTRAINT `anunciosdia_idrespprov_foreign` FOREIGN KEY (`idadminPro`) REFERENCES `users` (`id`),
  CONSTRAINT `anunciosdia_idrespprovorigen_foreign` FOREIGN KEY (`iddelegado`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anunciosDia`
--

LOCK TABLES `anunciosDia` WRITE;
/*!40000 ALTER TABLE `anunciosDia` DISABLE KEYS */;
INSERT INTO `anunciosDia` VALUES (1,'2017-06-03',3,5,25,35,3,2,6,48),(2,'2017-05-19',4,5,25,35,3,2,6,48),(3,'2017-05-19',5,5,25,35,2,2,6,34),(4,'2017-05-21',3,5,25,35,2,2,6,48),(5,'2017-06-05',3,5,25,35,8,2,6,48),(6,'2017-06-14',3,5,25,35,1,2,6,48),(8,'2017-06-17',3,5,25,35,1,2,6,48),(9,'2017-06-19',5,5,25,35,4,2,6,45),(10,'2017-06-19',5,6,25,35,2,2,7,45),(12,'2017-06-25',5,6,25,35,1,35,7,45),(14,'2017-07-01',5,6,25,35,4,2,7,34),(15,'2017-08-23',14,8,25,35,2,2,28,74),(16,'2017-08-23',15,8,25,35,1,2,28,74);
/*!40000 ALTER TABLE `anunciosDia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `idcita` int(11) NOT NULL,
  `idanuncio` varchar(45) DEFAULT NULL,
  `idusuario` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horaini` time DEFAULT NULL,
  `horafin` time DEFAULT NULL,
  `contador` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'3','3','2017-08-28','07:00:00','08:30:00',8),(2,'3','1','2017-08-28','08:45:00','09:00:00',3),(3,'3','2','2017-08-28','10:30:00','18:30:00',3);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes` (
  `idimagen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ficheroimagen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idimagen`),
  KEY `imagenes_idusuario_foreign` (`idusuario`),
  CONSTRAINT `imagenes_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes`
--

LOCK TABLES `imagenes` WRITE;
/*!40000 ALTER TABLE `imagenes` DISABLE KEYS */;
INSERT INTO `imagenes` VALUES (6,'gift4.gif','gift4.gif',34,NULL,NULL),(7,'images.jpg','images.jpg',34,NULL,NULL),(8,'left_menu_bullet.gif','left_menu_bullet.gif',34,NULL,NULL),(12,'descarga.jpg','descarga.jpg',45,NULL,NULL),(14,'images (6).jpg','images (6).jpg',45,NULL,NULL),(15,'images (5).jpg','images (5).jpg',45,NULL,NULL),(16,'images (4).jpg','images (4).jpg',45,NULL,NULL),(17,'images (3).jpg','images (3).jpg',45,NULL,NULL),(18,'images (2).jpg','images (2).jpg',45,NULL,NULL),(20,'images.jpg','images.jpg',45,NULL,NULL),(22,'images (6).jpg','images (6).jpg',48,NULL,NULL),(23,'images (6).jpg','images (6).jpg',2,NULL,NULL),(24,'images (5).jpg','images (5).jpg',2,NULL,NULL);
/*!40000 ALTER TABLE `imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes_anuncios`
--

DROP TABLE IF EXISTS `imagenes_anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes_anuncios` (
  `idanuncioimagen` int(11) NOT NULL AUTO_INCREMENT,
  `idanuncio` varchar(45) NOT NULL,
  `idimagen` varchar(45) NOT NULL,
  PRIMARY KEY (`idanuncioimagen`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_anuncios`
--

LOCK TABLES `imagenes_anuncios` WRITE;
/*!40000 ALTER TABLE `imagenes_anuncios` DISABLE KEYS */;
INSERT INTO `imagenes_anuncios` VALUES (17,'4','5'),(18,'3','5'),(21,'3','22');
/*!40000 ALTER TABLE `imagenes_anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localidades`
--

DROP TABLE IF EXISTS `localidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localidades` (
  `idlocalidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idprovincia` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idlocalidad`),
  KEY `localidades_idprovincia_foreign` (`idprovincia`),
  CONSTRAINT `localidades_idprovincia_foreign` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidades`
--

LOCK TABLES `localidades` WRITE;
/*!40000 ALTER TABLE `localidades` DISABLE KEYS */;
INSERT INTO `localidades` VALUES (5,'pamplona',6,NULL,NULL),(6,'MADRID',7,NULL,NULL),(7,'kjhlhj',9,NULL,NULL),(8,'prueba localidad',28,NULL,NULL);
/*!40000 ALTER TABLE `localidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payerID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentID` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `fecha_pago` date NOT NULL,
  `dias` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,'2ZU2PGVBQSZR8','PAY-8LP96757YX748422HLE3PZ7I',45,'2017-06-03',5,5,25),(2,'2ZU2PGVBQSZR8','PAY-8AP632415M8839130LE3QATY',45,'2017-06-03',7,5,35),(3,'2ZU2PGVBQSZR8','PAY-2T109563WF569802NLE3QJOY',45,'2017-06-06',6,5,30),(4,'2ZU2PGVBQSZR8','PAY-9YY26966VS463364RLFCWSIA',45,'2017-06-17',50,5,250),(5,'2ZU2PGVBQSZR8','PAY-7TU86751P5066421MLFCWTFA',45,'2017-06-17',50,5,250),(6,'2ZU2PGVBQSZR8','PAY-49V79260LA238423ULFCWUUA',48,'2017-06-17',50,5,250),(7,'2ZU2PGVBQSZR8','PAY-1XB79131MM891084KLF6N6EA',45,'2017-07-29',25,5,125),(8,'2ZU2PGVBQSZR8','PAY-3AP03826XJ4720941LGO5TVY',74,'2017-08-23',10,5,50);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `idprovincia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idresponsable` int(10) unsigned NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iddelegado` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idprovincia`),
  KEY `provincias_idresponsable_foreign` (`idresponsable`),
  CONSTRAINT `provincias_idresponsable_foreign` FOREIGN KEY (`idresponsable`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (6,'NAVARRA',25,1,NULL,NULL,'35'),(7,'MADRID',25,1,NULL,NULL,'35'),(8,'MADRID',25,1,NULL,NULL,'35'),(9,'asdfadsfasdf',44,1,NULL,NULL,'47'),(10,'asdjfa lsdfj',25,1,NULL,NULL,'35'),(11,'iouhouih',25,1,NULL,NULL,'35'),(12,'kjh apostua',25,1,NULL,NULL,'35'),(13,'pruebaprueba',25,1,NULL,NULL,'35'),(14,'otra',25,1,NULL,NULL,'35'),(15,'1a1a',25,1,NULL,NULL,'35'),(16,'1a1a',25,1,NULL,NULL,'35'),(17,'1b2c3d',25,1,NULL,NULL,'35'),(18,'aklfj aklds fjalk djfalkdj',25,1,NULL,NULL,'35'),(19,'j l jlk jlk jlk j',25,1,NULL,NULL,'35'),(20,'j l jlk jlk jlk j lo joij',25,1,NULL,NULL,'35'),(21,'uyui',25,1,NULL,NULL,'35'),(22,'NAVARRA',25,1,NULL,NULL,'35'),(23,'bn n n m',25,1,NULL,NULL,'35'),(24,'bn n n m',25,1,NULL,NULL,'35'),(25,'bn n n m',25,1,NULL,NULL,'35'),(26,'iuyb iuy iuy',25,1,NULL,NULL,'35'),(27,'iuyb iuy iuy',25,1,NULL,NULL,'35'),(28,'pruebaprovincia',25,1,NULL,NULL,'35');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_usuario`
--

LOCK TABLES `tipos_usuario` WRITE;
/*!40000 ALTER TABLE `tipos_usuario` DISABLE KEYS */;
INSERT INTO `tipos_usuario` VALUES (1,'anunciante',NULL,NULL,'ANUNCIANTE'),(2,'adminProvincia',NULL,NULL,'ADMIN PROVINCIA'),(3,'delegado',NULL,NULL,'DELEGADO'),(4,'admin',NULL,NULL,'ADMIN'),(5,'colaborador',NULL,NULL,'COLABORADOR');
/*!40000 ALTER TABLE `tipos_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tipo_usuario` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,NULL,NULL,'joseba','japostua2@gmail.com','$2y$10$F6hXWtdv4R6KZorp90YJmOgtDgEttFITrWgPLJsB2DIhCkkUWwAFa','4',1,'e3zszD0ChoxKzMUvtIFh3QA4mGtS2z5FsEP30C70N1munWPzXDw0nzUysc8A','2017-04-06 16:36:37','2017-04-06 16:36:37',NULL),(24,NULL,NULL,'pedro','pedro@gmail.com','$2y$10$7N51QA/vCmeywVh4tLeMnO8wHbkuJsza1PNxIbD2dM4B2OBJxoz6u','5',1,NULL,NULL,NULL,NULL),(25,NULL,NULL,'aldkfj','d@alsdfj.es','$2y$10$bBavqngq87Yzrj43I8auie6nQywnxMNXh4nUnzFtREp5wxZRCFRPa','2',1,'6fjr3sI7PndThPntJ6PUasDpsfEjJz2NuSmnvjPyDj4AKE2WADky9DIaokLk',NULL,NULL,NULL),(27,NULL,NULL,'j','d@lkajdf.es','$2y$10$u.q0x1SqaVYTddSy3UmcjudifwoCFXL/jLM7xqxQS9nvmvCaKncSa','4',1,NULL,NULL,NULL,NULL),(28,NULL,NULL,'aalkfjaldksf alsd jflakjsd f','j@lm.es','$2y$10$dsXUCpqwSB1wm5.T.j4n6.MDq2gf0MD2U4zpExMAERMf37Qy9S3KW','4',1,NULL,NULL,NULL,NULL),(29,NULL,NULL,'lkjj n','k@kasdf.es','$2y$10$VyUAIUfdl5cpVxwAsp5Sbul3Aqfc2IcOyw5n2iWTeRd5OmUJdhsDC','4',1,NULL,NULL,NULL,NULL),(31,NULL,NULL,'klj','cn@asdf.es','$2y$10$RubMJqhbaDgniqz1GWEzAeq0RVQytx2Mp5ZEyaiMCGE8zEJ9UYRAa','4',1,NULL,NULL,NULL,NULL),(32,NULL,NULL,'a','b@e.se','$2y$10$1rUrEgSJc0Qnvb1W0XK7FuOyjFu4PMkjPGdRVV2DJmCf9RrGnE3lq','4',1,'5vr3b9t3bVrtI1aUPKRKUg94qU1TF1rU8ETQOh5P6BZxxD6HP7hNWeDEtVOa',NULL,NULL,NULL),(33,NULL,NULL,'jk','df@asdf.es','$2y$10$eN3Duu0ev80iJlHj/zC3.OSkAXF8ScTIlgAcfZohvCpGNGTrGRyV6','4',1,NULL,NULL,NULL,NULL),(34,NULL,NULL,'PEPE','10@diez.es','$2y$10$.ogpgepofeqUIEo4olCzY.Q/t5eHByOtL0a5ol.ZFocci5GnYyhDy','1',1,NULL,NULL,NULL,NULL),(35,NULL,NULL,'luis','luis@gmail.com','$2y$10$rbXALbmNpajbKQXfxSh6wuInj7dlsLzkDrXYnPe.hmFhE4dLVfpUC','3',1,'M1xIx2fAaDxLOETRWEDIlU09EuBuxcbEc03Eid9kNiqtSPn6GYjzQpeaFuDv',NULL,NULL,NULL),(36,NULL,NULL,'x','x@x.es','$2y$10$ycwIQ.g7ymEn9Vys1CGit.xhBixQAyUxLYz.1/lTj9KTYRP1ztmDm','2',1,NULL,NULL,NULL,NULL),(37,NULL,NULL,'lakdf alkdfj','abc@gmail.com','$2y$10$KpwTgkNURSHFzdJlm7SXQuGR7E/iyv0K8F3Ll88KchDeoR7FifevC','1',1,'k0HZX5WBduNoFL8dLOmipWmRuWa4cn569E4BU3uYmNL3dHjcTW5tjAd5rM6H',NULL,NULL,NULL),(43,NULL,NULL,'pedro luis','1a@gmail.com','$2y$10$gCNIxEVxfPylPNZS49chAOu8k8JYgE1fY2DvHYmFLZfoBm4H0YpQq','4',1,NULL,NULL,NULL,NULL),(44,NULL,NULL,'1b','1b@gmail.com','$2y$10$3/EOH/YyjFR6/gd4JaEQHeffWTXKe3v33AafcDdKi4Ym5ZNMA7zNW','2',1,'vqtFac5Tl10D8OX2ambsF3Sm5SfdDcvTEl0qLGawfLqBm9s8dUFUsOMBRlzj',NULL,NULL,NULL),(45,NULL,NULL,'1c','1c@gmail.com','$2y$10$NnDXHEPfvzfCaaIl.9.T9.uiQXBKmxZdE0ugZm29D9BWd7kyEN0Z2','1',1,'dXHXYkzyHpzK8vj9PfkdFWkGnfkU7NyZbTCkEqmFR7putAkJL3OjAH0WKI32',NULL,NULL,NULL),(46,NULL,NULL,'1d','1d@gmail.com','$2y$10$Z8gLw6Lw4BdaQwj86p0eLer02hbYTsi0LtRgzzzINHa0Ay8RyOb26','5',1,NULL,NULL,NULL,NULL),(48,NULL,NULL,'a1','a1@gmail.com','$2y$10$C1pX8XOqhW0U43rdA27lQOKnYbd5tpCTTHe7MJ/764BSPY/f1bdJm','1',1,'iP9jZsTAtd9P5pLW5Y5No3niksQFh0KTFNQadGkatoNQ3lvO0Z8wHqFYtg6I',NULL,NULL,NULL),(69,NULL,NULL,'joseba apostua','uoyrofxxxsoediv@gmail.com','$2y$10$UR9BcS7CetqwRA5NtUp21OkDyfqeJqN7eDIBU58scRJWXgboCQ6lu','4',1,NULL,NULL,NULL,NULL),(70,NULL,NULL,'1268akosjdfkladsj glañksj dglkj','kjalksfj@gaskdjfas.es','$2y$10$v.0cEO0qBhSJUoHilu5eueoUEFwcwnX5wBMImIJJlj7ejYmrcqz2q','1',0,NULL,NULL,NULL,'XgAPmLdVtyikC2G7mOL6IyveUkdw6Wsua01O69it'),(71,NULL,NULL,'otra prueba mas de correo y delegado','japostua1@gmail.com','$2y$10$kPud4qu9UHk1fzREJntkze9StSX4TiE9wLdLurvDc.2qm2STF9QKa','1',1,NULL,NULL,NULL,NULL),(72,NULL,NULL,'jl','probando@probando.es','$2y$10$SmLswUQfPmJqjLxyDmlWoONXHP467QsDn4.APIYpHmj4YCLyGbHpW','5',0,NULL,NULL,NULL,'T5yejUPGX3w0TvKtK4b55wRRoInDnw3yqvOikbHb'),(73,NULL,NULL,'ababba','a@a.a','$2y$10$.TW7wU9Gek.QsT9QXztmj.waRop8zrPXM6E10KYS4V3C1BM2GlxDi','1',0,NULL,NULL,NULL,'jx5b0yNeuI2KqH3cSUwrfx8jj9IQU76ncJz0SxyK'),(74,NULL,NULL,'joseba apostua martin','japostua@gmail.com','$2y$10$7RP7yzD33gegrOdJNXUBmeqfkln1cTuT03utTUfrf7AkTorYdYfyW','1',1,'0MASQwRsweGbbmSpVHH7SYRadm8KbKS0YJxVambBR3Y3W0sd6mxm2Rpyzk3d',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersAdmin`
--

DROP TABLE IF EXISTS `usersAdmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersAdmin` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersAdmin`
--

LOCK TABLES `usersAdmin` WRITE;
/*!40000 ALTER TABLE `usersAdmin` DISABLE KEYS */;
INSERT INTO `usersAdmin` VALUES (43,'pedro luis'),(69,NULL);
/*!40000 ALTER TABLE `usersAdmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersAdminProvincia`
--

DROP TABLE IF EXISTS `usersAdminProvincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersAdminProvincia` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersAdminProvincia`
--

LOCK TABLES `usersAdminProvincia` WRITE;
/*!40000 ALTER TABLE `usersAdminProvincia` DISABLE KEYS */;
INSERT INTO `usersAdminProvincia` VALUES (25),(44);
/*!40000 ALTER TABLE `usersAdminProvincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersAnunciante`
--

DROP TABLE IF EXISTS `usersAnunciante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersAnunciante` (
  `id` int(11) NOT NULL,
  `idpartner` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `dias_disponibles` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersAnunciante`
--

LOCK TABLES `usersAnunciante` WRITE;
/*!40000 ALTER TABLE `usersAnunciante` DISABLE KEYS */;
INSERT INTO `usersAnunciante` VALUES (34,2,'pep',0),(45,35,NULL,71),(48,2,NULL,1),(70,35,NULL,NULL),(71,35,NULL,NULL),(73,35,NULL,NULL),(74,2,NULL,8);
/*!40000 ALTER TABLE `usersAnunciante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersColaborador`
--

DROP TABLE IF EXISTS `usersColaborador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersColaborador` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersColaborador`
--

LOCK TABLES `usersColaborador` WRITE;
/*!40000 ALTER TABLE `usersColaborador` DISABLE KEYS */;
INSERT INTO `usersColaborador` VALUES (46),(72);
/*!40000 ALTER TABLE `usersColaborador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersDelegado`
--

DROP TABLE IF EXISTS `usersDelegado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersDelegado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersDelegado`
--

LOCK TABLES `usersDelegado` WRITE;
/*!40000 ALTER TABLE `usersDelegado` DISABLE KEYS */;
INSERT INTO `usersDelegado` VALUES (35,NULL),(47,NULL);
/*!40000 ALTER TABLE `usersDelegado` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-02 23:43:52
