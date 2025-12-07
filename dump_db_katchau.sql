CREATE DATABASE  IF NOT EXISTS `db_katchau` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_katchau`;
-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: db_katchau
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `acessorio`
--

DROP TABLE IF EXISTS `acessorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acessorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acessorio`
--

LOCK TABLES `acessorio` WRITE;
/*!40000 ALTER TABLE `acessorio` DISABLE KEYS */;
INSERT INTO `acessorio` VALUES (1,'Ar Condicionado'),(4,'Câmera de Ré'),(9,'Engate Reboque'),(10,'Kit Farol de Milha'),(6,'Multimídia'),(7,'Película / Insulfilm'),(8,'Rodas de Liga Leve'),(3,'Sensor de Ré'),(5,'Teto Solar'),(2,'Vidro Elétrico');
/*!40000 ALTER TABLE `acessorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carroceria`
--

DROP TABLE IF EXISTS `carroceria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carroceria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carroceria`
--

LOCK TABLES `carroceria` WRITE;
/*!40000 ALTER TABLE `carroceria` DISABLE KEYS */;
INSERT INTO `carroceria` VALUES (6,'Coupé'),(10,'Crossover'),(1,'Hatchback'),(8,'Jipe'),(7,'Minivan'),(5,'Perua/SW'),(4,'Picape'),(2,'Sedã'),(3,'SUV'),(9,'Van');
/*!40000 ALTER TABLE `carroceria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES (1,'Santos'),(2,'São Vicente'),(3,'São Paulo'),(4,'Praia Grande'),(5,'Guarujá'),(6,'Cubatão'),(7,'Campinas'),(8,'Ribeirão Preto'),(9,'Osasco'),(10,'Sorocaba');
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `combustivel`
--

DROP TABLE IF EXISTS `combustivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combustivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combustivel`
--

LOCK TABLES `combustivel` WRITE;
/*!40000 ALTER TABLE `combustivel` DISABLE KEYS */;
INSERT INTO `combustivel` VALUES (8,'Biocombustível'),(3,'Diesel'),(4,'Elétrico'),(10,'Elétrico-Híbrido'),(6,'Etanol'),(2,'Flex'),(1,'Gasolina'),(7,'GNV'),(5,'Híbrido'),(9,'Hidrogênio');
/*!40000 ALTER TABLE `combustivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cor`
--

DROP TABLE IF EXISTS `cor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cor`
--

LOCK TABLES `cor` WRITE;
/*!40000 ALTER TABLE `cor` DISABLE KEYS */;
INSERT INTO `cor` VALUES (7,'Amarelo'),(6,'Azul'),(2,'Branco'),(5,'Cinza'),(10,'Laranja'),(8,'Marrom'),(3,'Prata'),(1,'Preto'),(9,'Verde'),(4,'Vermelho');
/*!40000 ALTER TABLE `cor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'✅ Disponível'),(2,'❌ Vendido');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabricante`
--

DROP TABLE IF EXISTS `fabricante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fabricante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabricante`
--

LOCK TABLES `fabricante` WRITE;
/*!40000 ALTER TABLE `fabricante` DISABLE KEYS */;
INSERT INTO `fabricante` VALUES (2,'Chevrolet'),(3,'Fiat'),(4,'Ford'),(6,'Honda'),(7,'Hyundai'),(9,'Jeep'),(10,'Nissan'),(8,'Renault'),(5,'Toyota'),(1,'Volkswagen');
/*!40000 ALTER TABLE `fabricante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelo`
--

DROP TABLE IF EXISTS `modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `fabricante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fabricante_id` (`fabricante_id`),
  CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`fabricante_id`) REFERENCES `fabricante` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelo`
--

LOCK TABLES `modelo` WRITE;
/*!40000 ALTER TABLE `modelo` DISABLE KEYS */;
INSERT INTO `modelo` VALUES (1,'Gol',1),(2,'Virtus',1),(3,'Onix',2),(4,'Cruze',2),(5,'Argo',3),(6,'Cronos',3),(7,'Corolla',5),(8,'HR-V',6),(9,'HB20',7),(10,'Duster',8);
/*!40000 ALTER TABLE `modelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario`
--

DROP TABLE IF EXISTS `proprietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proprietario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario`
--

LOCK TABLES `proprietario` WRITE;
/*!40000 ALTER TABLE `proprietario` DISABLE KEYS */;
INSERT INTO `proprietario` VALUES (1,'João Silva','11122233344','13999998888','joao.s@email.com','1985-05-15'),(2,'Maria Santos','55566677788','11977776666','maria.s@email.com','1992-10-20'),(3,'Carlos Oliveira','99900011122','21988887777','carlos.o@email.com','1970-01-01'),(4,'Ana Paula Souza','00100200304','13987654321','ana.paula@email.com','1995-11-01'),(5,'Pedro Henrique','12345678901','11543219876','pedro.h@email.com','1988-02-29'),(6,'Juliana Lima','98765432109','21678901234','juliana.l@email.com','1975-07-25'),(7,'Ricardo Almeida','23456789012','13333344444','ricardo.a@email.com','1980-12-10'),(8,'Fernanda Costa','34567890123','11876543210','fernanda.c@email.com','1998-04-18'),(9,'Guilherme Rocha','45678901234','21222211111','gui.r@email.com','1990-09-05'),(10,'Larissa Mendes','56789012345','13666677777','larissa.m@email.com','1983-06-30');
/*!40000 ALTER TABLE `proprietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo_id` int(11) DEFAULT NULL,
  `cor_id` int(11) DEFAULT NULL,
  `combustivel_id` int(11) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `quilometragem` int(11) DEFAULT NULL,
  `portas` int(11) DEFAULT NULL,
  `cidade_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `carroceria_id` int(11) DEFAULT NULL,
  `proprietario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `placa` (`placa`),
  KEY `modelo_id` (`modelo_id`),
  KEY `cor_id` (`cor_id`),
  KEY `combustivel_id` (`combustivel_id`),
  KEY `cidade_id` (`cidade_id`),
  KEY `estado_id` (`estado_id`),
  KEY `carroceria_id` (`carroceria_id`),
  KEY `proprietario_id` (`proprietario_id`),
  CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `veiculo_ibfk_2` FOREIGN KEY (`cor_id`) REFERENCES `cor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `veiculo_ibfk_3` FOREIGN KEY (`combustivel_id`) REFERENCES `combustivel` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `veiculo_ibfk_4` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `veiculo_ibfk_5` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `veiculo_ibfk_6` FOREIGN KEY (`carroceria_id`) REFERENCES `carroceria` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `veiculo_ibfk_7` FOREIGN KEY (`proprietario_id`) REFERENCES `proprietario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculo`
--

LOCK TABLES `veiculo` WRITE;
/*!40000 ALTER TABLE `veiculo` DISABLE KEYS */;
INSERT INTO `veiculo` VALUES (1,1,1,2,'2019','GOL1A19',35000.00,45000,4,3,1,1,1),(2,2,3,1,'2020','VRT2B20',45000.00,32000,4,3,1,2,2),(3,3,4,2,'2018','ONX3C18',42000.00,60000,4,6,1,1,3),(4,4,6,1,'2017','CRZ4D17',37000.00,78000,4,9,2,2,4),(5,5,2,7,'2021','ARG5E21',38000.00,15000,4,1,1,1,5),(6,6,5,1,'2016','CRN6F16',33000.00,120000,4,7,2,2,6),(7,7,3,1,'2022','CRL7G22',89000.00,8000,4,3,1,2,7),(8,8,8,2,'2015','HRV8H15',54000.00,95000,4,10,2,3,8),(9,9,9,4,'2023','HB209I23',56000.00,500,4,5,1,3,9),(10,10,7,3,'2014','DST10J14',27000.00,140000,2,2,1,4,10);
/*!40000 ALTER TABLE `veiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculo_acessorio`
--

DROP TABLE IF EXISTS `veiculo_acessorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veiculo_acessorio` (
  `veiculo_id` int(11) NOT NULL,
  `acessorio_id` int(11) NOT NULL,
  PRIMARY KEY (`veiculo_id`,`acessorio_id`),
  KEY `acessorio_id` (`acessorio_id`),
  CONSTRAINT `veiculo_acessorio_ibfk_1` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `veiculo_acessorio_ibfk_2` FOREIGN KEY (`acessorio_id`) REFERENCES `acessorio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculo_acessorio`
--

LOCK TABLES `veiculo_acessorio` WRITE;
/*!40000 ALTER TABLE `veiculo_acessorio` DISABLE KEYS */;
INSERT INTO `veiculo_acessorio` VALUES (1,1),(1,2),(2,3),(2,6),(3,4),(4,5),(7,8),(8,9);
/*!40000 ALTER TABLE `veiculo_acessorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_veiculos_detalhes`
--

DROP TABLE IF EXISTS `vw_veiculos_detalhes`;
/*!50001 DROP VIEW IF EXISTS `vw_veiculos_detalhes`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_veiculos_detalhes` AS SELECT 
 1 AS `veiculo_id`,
 1 AS `estado_id`,
 1 AS `ano`,
 1 AS `placa`,
 1 AS `valor`,
 1 AS `quilometragem`,
 1 AS `nome_modelo`,
 1 AS `nome_cor`,
 1 AS `nome_fabricante`,
 1 AS `nome_proprietario`,
 1 AS `estado_nome`,
 1 AS `acessorios`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'db_katchau'
--

--
-- Dumping routines for database 'db_katchau'
--

--
-- Final view structure for view `vw_veiculos_detalhes`
--

/*!50001 DROP VIEW IF EXISTS `vw_veiculos_detalhes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_veiculos_detalhes` AS select `v`.`id` AS `veiculo_id`,`v`.`estado_id` AS `estado_id`,`v`.`ano` AS `ano`,`v`.`placa` AS `placa`,`v`.`valor` AS `valor`,`v`.`quilometragem` AS `quilometragem`,`m`.`nome` AS `nome_modelo`,`c`.`nome` AS `nome_cor`,`f`.`nome` AS `nome_fabricante`,`p`.`nome` AS `nome_proprietario`,`e`.`nome` AS `estado_nome`,group_concat(`ac`.`nome` separator ', ') AS `acessorios` from (((((((`veiculo` `v` join `modelo` `m` on(`v`.`modelo_id` = `m`.`id`)) join `cor` `c` on(`v`.`cor_id` = `c`.`id`)) left join `fabricante` `f` on(`m`.`fabricante_id` = `f`.`id`)) left join `proprietario` `p` on(`v`.`proprietario_id` = `p`.`id`)) left join `estado` `e` on(`v`.`estado_id` = `e`.`id`)) left join `veiculo_acessorio` `va` on(`va`.`veiculo_id` = `v`.`id`)) left join `acessorio` `ac` on(`ac`.`id` = `va`.`acessorio_id`)) group by `v`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-04  0:59:26
