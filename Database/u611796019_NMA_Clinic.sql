/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u611796019_NMA_Clinic
-- ------------------------------------------------------
-- Server version	10.11.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ALLERGY`
--

DROP TABLE IF EXISTS `ALLERGY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ALLERGY` (
  `Allergy_Code` varchar(10) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Allergy_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ALLERGY`
--

/*!40000 ALTER TABLE `ALLERGY` DISABLE KEYS */;
INSERT INTO `ALLERGY` VALUES
('ALG0001','Milk'),
('ALG0002','Eggs'),
('ALG0003','Peanuts'),
('ALG0004','Tree Nuts (General)'),
('ALG0005','Almonds'),
('ALG0006','Walnuts'),
('ALG0007','Cashews'),
('ALG0008','Pecans'),
('ALG0009','Soybeans'),
('ALG0010','Wheat'),
('ALG0011','Fish (General)'),
('ALG0012','Shellfish (General)'),
('ALG0013','Shrimp'),
('ALG0014','Crab'),
('ALG0015','Lobster'),
('ALG0016','Sesame'),
('ALG0017','Mustard'),
('ALG0018','Celery'),
('ALG0019','Lupin'),
('ALG0020','Molluscs'),
('ALG0021','Sulphites'),
('ALG0022','Gluten'),
('ALG0023','Corn'),
('ALG0024','Beef'),
('ALG0025','Pork'),
('ALG0026','Chicken'),
('ALG0027','Turkey'),
('ALG0028','Alpha-gal (Mammal Meat)'),
('ALG0029','Tree Pollen (General)'),
('ALG0030','Oak Pollen'),
('ALG0031','Birch Pollen'),
('ALG0032','Grass Pollen (General)'),
('ALG0033','Timothy Grass Pollen'),
('ALG0034','Rye Grass Pollen'),
('ALG0035','Weed Pollen (General)'),
('ALG0036','Ragweed Pollen'),
('ALG0037','Mugwort Pollen'),
('ALG0038','House Dust Mites'),
('ALG0039','Mold Spores (General)'),
('ALG0040','Alternaria Alternata (Mold)'),
('ALG0041','Cladosporium (Mold)'),
('ALG0042','Aspergillus (Mold)'),
('ALG0043','Penicillium (Mold)'),
('ALG0044','Cat Dander'),
('ALG0045','Dog Dander'),
('ALG0046','Horse Dander'),
('ALG0047','Cockroach'),
('ALG0048','Penicillin'),
('ALG0049','Amoxicillin'),
('ALG0050','Sulfa Drugs (Sulfonamides)'),
('ALG0051','Aspirin'),
('ALG0052','Ibuprofen (NSAID)'),
('ALG0053','Naproxen (NSAID)'),
('ALG0054','Tetracycline'),
('ALG0055','Cephalosporins'),
('ALG0056','Anticonvulsants (Seizure Meds)'),
('ALG0057','Chemotherapy Drugs'),
('ALG0058','Insulin'),
('ALG0059','Iodinated Contrast Dye'),
('ALG0060','Local Anesthetics'),
('ALG0061','Opiates'),
('ALG0062','Muscle Relaxants'),
('ALG0063','Honeybee Sting Venom'),
('ALG0064','Wasp Sting Venom'),
('ALG0065','Yellow Jacket Sting Venom'),
('ALG0066','Hornet Sting Venom'),
('ALG0067','Fire Ant Sting Venom'),
('ALG0068','Mosquito Bite Saliva'),
('ALG0069','Flea Bite Saliva'),
('ALG0070','Bed Bug Bite Saliva'),
('ALG0071','Tick Bite Saliva'),
('ALG0072','Latex (Natural Rubber)'),
('ALG0073','Nickel'),
('ALG0074','Cobalt'),
('ALG0075','Chromium'),
('ALG0076','Gold'),
('ALG0077','Fragrances (General)'),
('ALG0078','Balsam of Peru'),
('ALG0079','Fragrance Mix I'),
('ALG0080','Fragrance Mix II'),
('ALG0081','Formaldehyde'),
('ALG0082','Parabens (Preservative)'),
('ALG0083','Methylisothiazolinone (Preservative)'),
('ALG0084','Quaternium-15 (Preservative)'),
('ALG0085','Thimerosal (Preservative)'),
('ALG0086','Neomycin (Topical Antibiotic)'),
('ALG0087','Bacitracin (Topical Antibiotic)'),
('ALG0088','Topical Corticosteroids'),
('ALG0089','Hair Dye (PPD - Paraphenylenediamine)'),
('ALG0090','Poison Ivy (Urushiol)'),
('ALG0091','Poison Oak (Urushiol)'),
('ALG0092','Poison Sumac (Urushiol)'),
('ALG0093','Mango Skin (Urushiol related)'),
('ALG0094','Lanolin (Wool Alcohol)'),
('ALG0095','Rosin (Colophony)'),
('ALG0096','Epoxy Resin'),
('ALG0097','Acrylates'),
('ALG0098','Rubber Accelerators'),
('ALG0099','Textile Dyes'),
('ALG0100','Sunscreen Chemicals (e.g., Oxybenzone)');
/*!40000 ALTER TABLE `ALLERGY` ENABLE KEYS */;

--
-- Table structure for table `CORPORATION`
--

DROP TABLE IF EXISTS `CORPORATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CORPORATION` (
  `Corporation_Name` varchar(100) NOT NULL,
  `Headquarters` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Corporation_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CORPORATION`
--

/*!40000 ALTER TABLE `CORPORATION` DISABLE KEYS */;
/*!40000 ALTER TABLE `CORPORATION` ENABLE KEYS */;

--
-- Table structure for table `Clinic_Ownership`
--

DROP TABLE IF EXISTS `Clinic_Ownership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clinic_Ownership` (
  `Physician_ID` int(11) NOT NULL,
  `Corporation_Name` varchar(100) NOT NULL,
  `Percentage_Owned` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`Physician_ID`,`Corporation_Name`),
  KEY `Corporation_Name` (`Corporation_Name`),
  CONSTRAINT `Clinic_Ownership_ibfk_1` FOREIGN KEY (`Physician_ID`) REFERENCES `PHYSICIAN` (`Employment_No`),
  CONSTRAINT `Clinic_Ownership_ibfk_2` FOREIGN KEY (`Corporation_Name`) REFERENCES `CORPORATION` (`Corporation_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clinic_Ownership`
--

/*!40000 ALTER TABLE `Clinic_Ownership` DISABLE KEYS */;
/*!40000 ALTER TABLE `Clinic_Ownership` ENABLE KEYS */;

--
-- Table structure for table `Consultation`
--

DROP TABLE IF EXISTS `Consultation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Consultation` (
  `Patient_No` int(11) NOT NULL,
  `Physician_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Observation` text DEFAULT NULL,
  PRIMARY KEY (`Patient_No`,`Physician_ID`,`Date`,`Time`),
  KEY `Physician_ID` (`Physician_ID`),
  CONSTRAINT `Consultation_ibfk_1` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `Consultation_ibfk_2` FOREIGN KEY (`Physician_ID`) REFERENCES `PHYSICIAN` (`Employment_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Consultation`
--

/*!40000 ALTER TABLE `Consultation` DISABLE KEYS */;
INSERT INTO `Consultation` VALUES
(19,2,'2025-05-09','11:00:00',''),
(20,2,'2025-05-11','19:04:00',''),
(22,2,'2025-05-07','12:07:00',''),
(22,63,'2025-05-07','11:00:00',''),
(23,64,'2025-05-09','11:02:00',''),
(24,65,'2025-05-08','09:03:00','');
/*!40000 ALTER TABLE `Consultation` ENABLE KEYS */;

--
-- Table structure for table `Consultation_Allergy`
--

DROP TABLE IF EXISTS `Consultation_Allergy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Consultation_Allergy` (
  `Patient_No` int(11) NOT NULL,
  `Physician_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Allergy_Code` varchar(10) NOT NULL,
  `Reaction_Notes` text DEFAULT NULL,
  PRIMARY KEY (`Patient_No`,`Physician_ID`,`Date`,`Time`,`Allergy_Code`),
  KEY `Allergy_Code` (`Allergy_Code`),
  CONSTRAINT `Consultation_Allergy_ibfk_1` FOREIGN KEY (`Patient_No`, `Physician_ID`, `Date`, `Time`) REFERENCES `Consultation` (`Patient_No`, `Physician_ID`, `Date`, `Time`) ON DELETE CASCADE,
  CONSTRAINT `Consultation_Allergy_ibfk_2` FOREIGN KEY (`Allergy_Code`) REFERENCES `ALLERGY` (`Allergy_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Consultation_Allergy`
--

/*!40000 ALTER TABLE `Consultation_Allergy` DISABLE KEYS */;
INSERT INTO `Consultation_Allergy` VALUES
(19,2,'2025-05-09','11:00:00','ALG0024',''),
(20,2,'2025-05-11','19:04:00','ALG0001',''),
(22,2,'2025-05-07','12:07:00','ALG0003',''),
(22,63,'2025-05-07','11:00:00','ALG0009',''),
(23,64,'2025-05-09','11:02:00','ALG0013',''),
(24,65,'2025-05-08','09:03:00','ALG0016','');
/*!40000 ALTER TABLE `Consultation_Allergy` ENABLE KEYS */;

--
-- Table structure for table `Consultation_Illness`
--

DROP TABLE IF EXISTS `Consultation_Illness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Consultation_Illness` (
  `Patient_No` int(11) NOT NULL,
  `Physician_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Illness_Code` varchar(10) NOT NULL,
  `Diagnosis_Notes` text DEFAULT NULL,
  PRIMARY KEY (`Patient_No`,`Physician_ID`,`Date`,`Time`,`Illness_Code`),
  KEY `Illness_Code` (`Illness_Code`),
  CONSTRAINT `Consultation_Illness_ibfk_1` FOREIGN KEY (`Patient_No`, `Physician_ID`, `Date`, `Time`) REFERENCES `Consultation` (`Patient_No`, `Physician_ID`, `Date`, `Time`) ON DELETE CASCADE,
  CONSTRAINT `Consultation_Illness_ibfk_2` FOREIGN KEY (`Illness_Code`) REFERENCES `ILLNESS` (`Illness_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Consultation_Illness`
--

/*!40000 ALTER TABLE `Consultation_Illness` DISABLE KEYS */;
INSERT INTO `Consultation_Illness` VALUES
(19,2,'2025-05-09','11:00:00','ILL0021',''),
(20,2,'2025-05-11','19:04:00','ILL0003',''),
(22,2,'2025-05-07','12:07:00','ILL0015',''),
(23,64,'2025-05-09','11:02:00','ILL0010',''),
(24,65,'2025-05-08','09:03:00','ILL0017','');
/*!40000 ALTER TABLE `Consultation_Illness` ENABLE KEYS */;

--
-- Table structure for table `Drug_Interaction`
--

DROP TABLE IF EXISTS `Drug_Interaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Drug_Interaction` (
  `Medication_Code_1` varchar(10) NOT NULL,
  `Medication_Code_2` varchar(10) NOT NULL,
  `Severity` enum('S','M','L','N') DEFAULT NULL,
  PRIMARY KEY (`Medication_Code_1`,`Medication_Code_2`),
  KEY `Medication_Code_2` (`Medication_Code_2`),
  CONSTRAINT `Drug_Interaction_ibfk_1` FOREIGN KEY (`Medication_Code_1`) REFERENCES `MEDICATION` (`Medication_Code`),
  CONSTRAINT `Drug_Interaction_ibfk_2` FOREIGN KEY (`Medication_Code_2`) REFERENCES `MEDICATION` (`Medication_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Drug_Interaction`
--

/*!40000 ALTER TABLE `Drug_Interaction` DISABLE KEYS */;
INSERT INTO `Drug_Interaction` VALUES
('MED001','MED003','N'),
('MED002','MED009','M'),
('MED002','MED015','M'),
('MED002','MED016','S'),
('MED002','MED021','M'),
('MED002','MED025','M'),
('MED003','MED002','L'),
('MED003','MED004','N'),
('MED003','MED009','L'),
('MED003','MED014','M'),
('MED003','MED021','M'),
('MED003','MED031','L'),
('MED004','MED005','N'),
('MED004','MED008','N'),
('MED005','MED004','L'),
('MED005','MED006','M'),
('MED005','MED010','L'),
('MED006','MED005','M'),
('MED006','MED013','M'),
('MED006','MED045','M'),
('MED007','MED055','N'),
('MED007','MED056','N'),
('MED007','MED057','N'),
('MED008','MED018','N'),
('MED008','MED028','M'),
('MED008','MED059','L'),
('MED009','MED002','M'),
('MED009','MED003','N'),
('MED009','MED012','L'),
('MED009','MED021','L'),
('MED009','MED031','M'),
('MED010','MED011','L'),
('MED010','MED015','M'),
('MED010','MED027','L'),
('MED010','MED036','N'),
('MED010','MED037','N'),
('MED010','MED093','N'),
('MED011','MED010','L'),
('MED011','MED036','L'),
('MED011','MED037','L'),
('MED011','MED093','L'),
('MED011','MED094','M'),
('MED011','MED095','L'),
('MED013','MED004','M'),
('MED013','MED006','M'),
('MED013','MED010','L'),
('MED014','MED003','M'),
('MED014','MED016','M'),
('MED014','MED022','M'),
('MED014','MED046','M'),
('MED014','MED047','M'),
('MED014','MED048','M'),
('MED014','MED049','M'),
('MED015','MED002','M'),
('MED015','MED010','M'),
('MED015','MED016','S'),
('MED015','MED031','M'),
('MED015','MED036','L'),
('MED015','MED037','M'),
('MED015','MED093','L'),
('MED016','MED001','M'),
('MED016','MED002','S'),
('MED016','MED005','L'),
('MED016','MED006','M'),
('MED016','MED020','M'),
('MED016','MED027','M'),
('MED016','MED030','L'),
('MED016','MED031','S'),
('MED016','MED032','M'),
('MED016','MED071','M'),
('MED016','MED072','S'),
('MED016','MED073','S'),
('MED016','MED074','S'),
('MED016','MED075','S'),
('MED016','MED077','M'),
('MED016','MED078','M'),
('MED017','MED005','N'),
('MED017','MED007','L'),
('MED017','MED050','L'),
('MED017','MED052','L'),
('MED017','MED053','L'),
('MED018','MED008','N'),
('MED019','MED002','M'),
('MED019','MED031','M'),
('MED019','MED041','M'),
('MED019','MED042','M'),
('MED019','MED043','M'),
('MED019','MED044','M'),
('MED019','MED078','S'),
('MED019','MED089','M'),
('MED020','MED045','M'),
('MED020','MED055','S'),
('MED022','MED014','M'),
('MED023','MED031','M'),
('MED023','MED041','M'),
('MED023','MED042','M'),
('MED023','MED043','M'),
('MED023','MED044','M'),
('MED023','MED078','S'),
('MED024','MED028','M'),
('MED024','MED034','M'),
('MED024','MED058','M'),
('MED024','MED070','L'),
('MED025','MED002','M'),
('MED025','MED005','N'),
('MED025','MED012','L'),
('MED025','MED021','L'),
('MED025','MED031','M'),
('MED027','MED010','L'),
('MED027','MED011','L'),
('MED027','MED016','M'),
('MED028','MED024','M'),
('MED028','MED034','M'),
('MED028','MED058','M'),
('MED028','MED060','M'),
('MED028','MED061','M'),
('MED028','MED062','M'),
('MED028','MED063','M'),
('MED030','MED008','N'),
('MED030','MED016','L'),
('MED030','MED059','N'),
('MED031','MED009','M'),
('MED031','MED015','M'),
('MED031','MED016','S'),
('MED031','MED021','M'),
('MED031','MED025','M'),
('MED032','MED016','M'),
('MED033','MED001','L'),
('MED033','MED006','L'),
('MED033','MED016','L'),
('MED034','MED028','M'),
('MED034','MED058','S'),
('MED034','MED060','S'),
('MED034','MED061','S'),
('MED034','MED062','S'),
('MED034','MED063','S'),
('MED034','MED076','S'),
('MED034','MED077','S'),
('MED034','MED078','S'),
('MED034','MED079','S'),
('MED034','MED080','S'),
('MED035','MED007','L'),
('MED035','MED050','L'),
('MED035','MED052','L'),
('MED035','MED053','L'),
('MED036','MED093','N'),
('MED037','MED011','L'),
('MED037','MED015','M'),
('MED037','MED036','N'),
('MED037','MED093','N'),
('MED041','MED078','S'),
('MED042','MED078','S'),
('MED044','MED019','M'),
('MED044','MED023','M'),
('MED044','MED041','M'),
('MED044','MED042','M'),
('MED045','MED006','M'),
('MED045','MED010','L'),
('MED045','MED020','M'),
('MED046','MED014','M'),
('MED047','MED014','M'),
('MED048','MED014','M'),
('MED049','MED014','M'),
('MED050','MED007','N'),
('MED050','MED056','N'),
('MED050','MED057','N'),
('MED051','MED007','N'),
('MED051','MED008','N'),
('MED051','MED059','N'),
('MED052','MED007','N'),
('MED053','MED007','N'),
('MED053','MED056','N'),
('MED053','MED057','N'),
('MED054','MED056','N'),
('MED055','MED006','M'),
('MED055','MED020','S'),
('MED058','MED028','M'),
('MED058','MED034','S'),
('MED058','MED060','M'),
('MED058','MED061','M'),
('MED058','MED062','M'),
('MED058','MED063','M'),
('MED059','MED018','N'),
('MED059','MED028','M'),
('MED060','MED028','M'),
('MED060','MED034','S'),
('MED060','MED064','M'),
('MED061','MED028','M'),
('MED061','MED034','S'),
('MED061','MED064','M'),
('MED062','MED028','M'),
('MED062','MED034','S'),
('MED062','MED064','M'),
('MED063','MED028','M'),
('MED063','MED034','S'),
('MED063','MED064','M'),
('MED064','MED002','M'),
('MED064','MED009','M'),
('MED064','MED012','M'),
('MED064','MED014','M'),
('MED064','MED021','M'),
('MED064','MED025','M'),
('MED064','MED031','M'),
('MED064','MED060','M'),
('MED064','MED061','M'),
('MED064','MED062','M'),
('MED064','MED063','M'),
('MED065','MED066','M'),
('MED065','MED067','M'),
('MED065','MED068','M'),
('MED065','MED069','L'),
('MED065','MED070','L'),
('MED066','MED005','M'),
('MED066','MED013','M'),
('MED066','MED034','M'),
('MED066','MED045','M'),
('MED066','MED058','M'),
('MED066','MED067','M'),
('MED066','MED068','M'),
('MED066','MED069','L'),
('MED066','MED070','N'),
('MED068','MED069','N'),
('MED068','MED070','N'),
('MED069','MED070','N'),
('MED070','MED028','M'),
('MED070','MED034','M'),
('MED070','MED058','M'),
('MED071','MED009','M'),
('MED071','MED015','M'),
('MED071','MED016','M'),
('MED071','MED025','M'),
('MED072','MED009','M'),
('MED072','MED015','M'),
('MED072','MED016','S'),
('MED072','MED021','M'),
('MED072','MED025','M'),
('MED073','MED009','M'),
('MED073','MED015','M'),
('MED073','MED016','S'),
('MED073','MED021','M'),
('MED073','MED025','M'),
('MED074','MED009','M'),
('MED074','MED015','M'),
('MED074','MED016','S'),
('MED074','MED021','M'),
('MED074','MED025','M'),
('MED075','MED009','M'),
('MED075','MED015','M'),
('MED075','MED016','S'),
('MED075','MED021','M'),
('MED075','MED025','M'),
('MED076','MED019','M'),
('MED076','MED023','M'),
('MED076','MED034','S'),
('MED077','MED019','M'),
('MED077','MED023','M'),
('MED077','MED034','S'),
('MED078','MED019','S'),
('MED078','MED023','S'),
('MED078','MED041','S'),
('MED078','MED042','S'),
('MED079','MED034','S'),
('MED079','MED062','S'),
('MED080','MED034','S'),
('MED080','MED062','S'),
('MED081','MED028','M'),
('MED081','MED034','M'),
('MED081','MED058','M'),
('MED082','MED034','M'),
('MED082','MED058','M'),
('MED083','MED034','M'),
('MED084','MED034','M'),
('MED085','MED034','M'),
('MED087','MED028','M'),
('MED088','MED028','M'),
('MED088','MED034','M'),
('MED088','MED058','M'),
('MED089','MED019','M'),
('MED089','MED023','M'),
('MED089','MED041','M'),
('MED089','MED042','M'),
('MED090','MED028','M'),
('MED091','MED092','N'),
('MED094','MED001','L'),
('MED094','MED011','M'),
('MED094','MED020','L'),
('MED094','MED027','L'),
('MED096','MED099','L'),
('MED097','MED022','N'),
('MED097','MED098','N'),
('MED097','MED099','L'),
('MED098','MED099','L');
/*!40000 ALTER TABLE `Drug_Interaction` ENABLE KEYS */;

--
-- Table structure for table `ILLNESS`
--

DROP TABLE IF EXISTS `ILLNESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ILLNESS` (
  `Illness_Code` varchar(10) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Illness_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ILLNESS`
--

/*!40000 ALTER TABLE `ILLNESS` DISABLE KEYS */;
INSERT INTO `ILLNESS` VALUES
('ILL0001','Abdominal Aortic Aneurysm'),
('ILL0002','Achilles Tendinopathy'),
('ILL0003','Acne'),
('ILL0004','Acute Cholecystitis'),
('ILL0005','Acute Lymphoblastic Leukaemia'),
('ILL0006','Acute Myeloid Leukaemia'),
('ILL0007','Acute Pancreatitis'),
('ILL0008','Acute Respiratory Distress Syndrome'),
('ILL0009','Addison\'s Disease'),
('ILL0010','Adenomyosis'),
('ILL0011','ADHD in Adults'),
('ILL0012','ADHD in Children and Young People'),
('ILL0013','Age-related Macular Degeneration'),
('ILL0014','Agoraphobia'),
('ILL0015','Albinism'),
('ILL0016','Alcohol Misuse'),
('ILL0017','Alcohol Poisoning'),
('ILL0018','Alcohol-related Liver Disease'),
('ILL0019','Alkaptonuria'),
('ILL0020','Allergic Rhinitis'),
('ILL0021','Allergies'),
('ILL0022','Altitude Sickness'),
('ILL0023','Alzheimer\'s Disease'),
('ILL0024','Anaemia'),
('ILL0025','Anaphylaxis'),
('ILL0026','Angina'),
('ILL0027','Ankylosing Spondylitis'),
('ILL0028','Anorexia Nervosa'),
('ILL0029','Anxiety'),
('ILL0030','Arrhythmia'),
('ILL0031','Arthritis'),
('ILL0032','Asthma'),
('ILL0033','Atrial Fibrillation'),
('ILL0034','Autism'),
('ILL0035','Bacterial Vaginosis'),
('ILL0036','Barmah Forest Virus'),
('ILL0037','Bipolar Disorder'),
('ILL0038','Bleeding or Pain in Early Pregnancy'),
('ILL0039','Blocked Milk Ducts'),
('ILL0040','Blood-borne Viruses'),
('ILL0041','Botulism'),
('ILL0042','Bowel Cancer'),
('ILL0043','Breast Cancer'),
('ILL0044','Bronchiolitis'),
('ILL0045','Bulimia'),
('ILL0046','Campylobacter Infection'),
('ILL0047','Cancer'),
('ILL0048','Cardiovascular Disease'),
('ILL0049','Celiac Disease'),
('ILL0050','Cerebrovascular Disease'),
('ILL0051','Chickenpox'),
('ILL0052','Chlamydia'),
('ILL0053','Cholesterol (High)'),
('ILL0054','Chronic Kidney Disease'),
('ILL0055','Chronic Obstructive Pulmonary Disease'),
('ILL0056','Coeliac Disease'),
('ILL0057','Constipation'),
('ILL0058','COVID-19'),
('ILL0059','Crohn\'s Disease'),
('ILL0060','Dehydration'),
('ILL0061','Dental Abscess'),
('ILL0062','Depression in Adults'),
('ILL0063','Developmental Coordination Disorder'),
('ILL0064','Diabetes (Type 1)'),
('ILL0065','Diabetes (Type 2)'),
('ILL0066','Diverticular Disease'),
('ILL0067','DVT (Deep Vein Thrombosis)'),
('ILL0068','Dyslexia'),
('ILL0069','Dyspraxia in Adults'),
('ILL0070','Ear Infections'),
('ILL0071','Earwax Build-up'),
('ILL0072','Eating Disorders'),
('ILL0073','Ectopic Pregnancy'),
('ILL0074','Eczema (Atopic)'),
('ILL0075','Ehlers-Danlos Syndromes'),
('ILL0076','Encephalitis'),
('ILL0077','Endometriosis'),
('ILL0078','Epilepsy'),
('ILL0079','Excessive Sweating'),
('ILL0080','Febrile Seizures'),
('ILL0081','Fibroids'),
('ILL0082','Fibromyalgia'),
('ILL0083','Flu'),
('ILL0084','Food Allergy'),
('ILL0085','Food Intolerance'),
('ILL0086','Food Poisoning'),
('ILL0087','Frontotemporal Dementia'),
('ILL0088','Frozen Shoulder'),
('ILL0089','Fungal Nail Infection'),
('ILL0090','Gallstones'),
('ILL0091','Gastritis'),
('ILL0092','Generalised Anxiety Disorder'),
('ILL0093','Genital Herpes'),
('ILL0094','Gestational Diabetes'),
('ILL0095','Giardiasis'),
('ILL0096','Glandular Fever'),
('ILL0097','Gonorrhoea'),
('ILL0098','Gout'),
('ILL0099','Guillain-Barré Syndrome'),
('ILL0100','Haemorrhoids'),
('ILL0101','Hand, Foot and Mouth Disease'),
('ILL0102','Hay Fever'),
('ILL0103','Head and Neck Cancer'),
('ILL0104','Head Lice and Nits'),
('ILL0105','Headaches'),
('ILL0106','Hearing Loss'),
('ILL0107','Heart Attack'),
('ILL0108','Heart Block'),
('ILL0109','Heart Disease'),
('ILL0110','Heart Failure'),
('ILL0111','Heart Palpitations'),
('ILL0112','Hepatitis A'),
('ILL0113','Hepatitis B'),
('ILL0114','Hepatitis C'),
('ILL0115','Hiatus Hernia'),
('ILL0116','High Blood Pressure (Hypertension)'),
('ILL0117','High Cholesterol'),
('ILL0118','HIV'),
('ILL0119','Hives'),
('ILL0120','Hodgkin Lymphoma'),
('ILL0121','Huntington\'s Disease'),
('ILL0122','Hydrocephalus'),
('ILL0123','Hyperglycaemia (High Blood Sugar)'),
('ILL0124','Hyperhidrosis'),
('ILL0125','Hypoglycaemia (Low Blood Sugar)'),
('ILL0126','Impetigo'),
('ILL0127','Incontinence'),
('ILL0128','Indigestion'),
('ILL0129','Infectious Diseases'),
('ILL0130','Infertility'),
('ILL0131','Inflammatory Bowel Disease (IBD)'),
('ILL0132','Influenza'),
('ILL0133','Insomnia'),
('ILL0134','Interstitial Cystitis'),
('ILL0135','Iron Deficiency Anaemia'),
('ILL0136','Irritable Bowel Syndrome (IBS)'),
('ILL0137','Itching'),
('ILL0138','Jaundice'),
('ILL0139','Joint Hypermobility Syndrome'),
('ILL0140','Kaposi\'s Sarcoma'),
('ILL0141','Kawasaki Disease'),
('ILL0142','Keloid Scars'),
('ILL0143','Keratoconus'),
('ILL0144','Kidney Cancer'),
('ILL0145','Kidney Infection'),
('ILL0146','Kidney Stones'),
('ILL0147','Klinefelter Syndrome'),
('ILL0148','Knee Pain'),
('ILL0149','Kyphosis'),
('ILL0150','Labyrinthitis'),
('ILL0151','Lactose Intolerance'),
('ILL0152','Laryngeal Cancer'),
('ILL0153','Laryngitis'),
('ILL0154','Lazy Eye (Amblyopia)'),
('ILL0155','Lead Poisoning'),
('ILL0156','Leg Cramps'),
('ILL0157','Legionnaires\' Disease'),
('ILL0158','Leprosy'),
('ILL0159','Leukaemia (General)'),
('ILL0160','Lichen Planus'),
('ILL0161','Lipoedema'),
('ILL0162','Lipoma'),
('ILL0163','Listeria'),
('ILL0164','Liver Cancer'),
('ILL0165','Liver Disease'),
('ILL0166','Loss of Libido'),
('ILL0167','Low Blood Pressure (Hypotension)'),
('ILL0168','Low Sperm Count'),
('ILL0169','Lung Cancer'),
('ILL0170','Lupus'),
('ILL0171','Lyme Disease'),
('ILL0172','Lymphoedema'),
('ILL0173','Lymphoma (General)'),
('ILL0174','Macular Degeneration'),
('ILL0175','Malaria'),
('ILL0176','Malignant Brain Tumour'),
('ILL0177','Malnutrition'),
('ILL0178','Marfan Syndrome'),
('ILL0179','Mastitis'),
('ILL0180','Measles'),
('ILL0181','Melanoma'),
('ILL0182','Meniere\'s Disease'),
('ILL0183','Meningitis'),
('ILL0184','Menopause'),
('ILL0185','Menorrhagia (Heavy Periods)'),
('ILL0186','Mental Health Conditions'),
('ILL0187','Mesothelioma'),
('ILL0188','Metabolic Syndrome'),
('ILL0189','Middle Ear Infection (Otitis Media)'),
('ILL0190','Migraine'),
('ILL0191','Miscarriage'),
('ILL0192','Mitral Valve Prolapse'),
('ILL0193','Molar Pregnancy'),
('ILL0194','Moles'),
('ILL0195','Molluscum Contagiosum'),
('ILL0196','Mononucleosis (Glandular Fever)'),
('ILL0197','Mood Disorders'),
('ILL0198','Motor Neurone Disease (MND)'),
('ILL0199','Mouth Cancer'),
('ILL0200','Mouth Ulcer'),
('ILL0201','MRSA Infection'),
('ILL0202','Multiple Myeloma'),
('ILL0203','Multiple Sclerosis (MS)'),
('ILL0204','Multiple System Atrophy (MSA)'),
('ILL0205','Mumps'),
('ILL0206','Munchausen\'s Syndrome'),
('ILL0207','Muscular Dystrophy'),
('ILL0208','Myasthenia Gravis'),
('ILL0209','Myelodysplastic Syndromes (MDS)'),
('ILL0210','Nail Patella Syndrome'),
('ILL0211','Narcolepsy'),
('ILL0212','Nasal and Sinus Cancer'),
('ILL0213','Nasal Polyps'),
('ILL0214','Neck Pain'),
('ILL0215','Neonatal Abstinence Syndrome'),
('ILL0216','Nephrotic Syndrome'),
('ILL0217','Neuroblastoma'),
('ILL0218','Neuroendocrine Tumours'),
('ILL0219','Neurofibromatosis'),
('ILL0220','Neurological Disorders'),
('ILL0221','Neuropathic Pain'),
('ILL0222','Nocturia'),
('ILL0223','Non-Alcoholic Fatty Liver Disease (NAFLD)'),
('ILL0224','Non-Hodgkin Lymphoma'),
('ILL0225','Norovirus'),
('ILL0226','Nosebleed'),
('ILL0227','Obesity'),
('ILL0228','Obsessive Compulsive Disorder (OCD)'),
('ILL0229','Obstructive Sleep Apnoea'),
('ILL0230','Oesophageal Cancer'),
('ILL0231','Oral Thrush'),
('ILL0232','Orchitis'),
('ILL0233','Osteoarthritis'),
('ILL0234','Osteomyelitis'),
('ILL0235','Osteoporosis'),
('ILL0236','Osteosarcoma'),
('ILL0237','Otitis Externa'),
('ILL0238','Ovarian Cancer'),
('ILL0239','Ovarian Cysts'),
('ILL0240','Overactive Thyroid (Hyperthyroidism)'),
('ILL0241','Paget\'s Disease of Bone'),
('ILL0242','Paget\'s Disease of the Nipple'),
('ILL0243','Pain'),
('ILL0244','Pancreatic Cancer'),
('ILL0245','Pancreatitis'),
('ILL0246','Panic Disorder'),
('ILL0247','Parkinson\'s Disease'),
('ILL0248','Patellofemoral Pain Syndrome'),
('ILL0249','Pelvic Inflammatory Disease (PID)'),
('ILL0250','Pelvic Organ Prolapse'),
('ILL0251','Pemphigus Vulgaris'),
('ILL0252','Penile Cancer'),
('ILL0253','Peptic Ulcer Disease'),
('ILL0254','Pericarditis'),
('ILL0255','Peripheral Neuropathy'),
('ILL0256','Peritonitis'),
('ILL0257','Pernicious Anaemia'),
('ILL0258','Personality Disorder'),
('ILL0259','Pertussis (Whooping Cough)'),
('ILL0260','Peyronie\'s Disease'),
('ILL0261','Phenylketonuria (PKU)'),
('ILL0262','Phimosis (Tight Foreskin)'),
('ILL0263','Phobias'),
('ILL0264','Piles (Haemorrhoids)'),
('ILL0265','Pilonidal Sinus'),
('ILL0266','Pineal Tumour'),
('ILL0267','Pink Eye (Conjunctivitis)'),
('ILL0268','Pinworms (Threadworms)'),
('ILL0269','Pityriasis Rosea'),
('ILL0270','Pityriasis Versicolor'),
('ILL0271','Plague'),
('ILL0272','Plantar Fasciitis'),
('ILL0273','Pleurisy'),
('ILL0274','Pneumonia'),
('ILL0275','Pneumothorax'),
('ILL0276','Poisoning'),
('ILL0277','Polio'),
('ILL0278','Polycystic Kidney Disease'),
('ILL0279','Polycystic Ovary Syndrome (PCOS)'),
('ILL0280','Polymyalgia Rheumatica'),
('ILL0281','Polyps (Bowel)'),
('ILL0282','Post-Polio Syndrome'),
('ILL0283','Post-traumatic Stress Disorder (PTSD)'),
('ILL0284','Postconcussion Syndrome'),
('ILL0285','Postherpetic Neuralgia'),
('ILL0286','Postnatal Depression'),
('ILL0287','Postpartum Thyroiditis'),
('ILL0288','POTS (Postural Tachycardia Syndrome)'),
('ILL0289','Prader-Willi Syndrome'),
('ILL0290','Pre-eclampsia'),
('ILL0291','Pregnancy (General Health)'),
('ILL0292','Premature Ejaculation'),
('ILL0293','Premenstrual Syndrome (PMS)'),
('ILL0294','Pressure Sores'),
('ILL0295','Priapism'),
('ILL0296','Primary Biliary Cholangitis (PBC)'),
('ILL0297','Primary Hyperparathyroidism'),
('ILL0298','Prostate Cancer'),
('ILL0299','Prostatitis'),
('ILL0300','Protozoal Infections'),
('ILL0301','Pruritus'),
('ILL0302','Pseudogout'),
('ILL0303','Psoriasis'),
('ILL0304','Psoriatic Arthritis'),
('ILL0305','Psychosis'),
('ILL0306','Puberty (Early or Delayed)'),
('ILL0307','Pubic Lice'),
('ILL0308','Pulmonary Embolism'),
('ILL0309','Pulmonary Fibrosis'),
('ILL0310','Pulmonary Hypertension'),
('ILL0311','Pulpitis'),
('ILL0312','Pyelonephritis (Kidney Infection)'),
('ILL0313','Q Fever'),
('ILL0314','Rabies'),
('ILL0315','Radiation Sickness'),
('ILL0316','Raynaud\'s Phenomenon'),
('ILL0317','Reactive Arthritis'),
('ILL0318','Rectal Cancer'),
('ILL0319','Rectal Prolapse'),
('ILL0320','Recurrent Miscarriage'),
('ILL0321','Reflux in Babies'),
('ILL0322','Repetitive Strain Injury (RSI)'),
('ILL0323','Respiratory Syncytial Virus (RSV)'),
('ILL0324','Restless Legs Syndrome'),
('ILL0325','Retinal Detachment'),
('ILL0326','Retinoblastoma'),
('ILL0327','Reye\'s Syndrome'),
('ILL0328','Rhabdomyolysis'),
('ILL0329','Rheumatic Fever'),
('ILL0330','Rheumatoid Arthritis'),
('ILL0331','Rickets'),
('ILL0332','Ringworm'),
('ILL0333','Rosacea'),
('ILL0334','Roseola'),
('ILL0335','Rotavirus'),
('ILL0336','Rubella (German Measles)'),
('ILL0337','Salivary Gland Cancer'),
('ILL0338','Salivary Gland Stones'),
('ILL0339','Salmonella'),
('ILL0340','Sarcoidosis'),
('ILL0341','Sarcoma (Soft Tissue)'),
('ILL0342','Scabies'),
('ILL0343','Scarlet Fever'),
('ILL0344','Schistosomiasis (Bilharzia)'),
('ILL0345','Schizophrenia'),
('ILL0346','Sciatica'),
('ILL0347','Scleroderma'),
('ILL0348','Scoliosis'),
('ILL0349','Scrotal Swelling'),
('ILL0350','Scurvy'),
('ILL0351','Seasonal Affective Disorder (SAD)'),
('ILL0352','Seborrhoeic Dermatitis'),
('ILL0353','Secondary Breast Cancer'),
('ILL0354','Secondary Liver Cancer'),
('ILL0355','Seizures'),
('ILL0356','Self-harm'),
('ILL0357','Sepsis'),
('ILL0358','Septic Arthritis'),
('ILL0359','Severe Combined Immunodeficiency (SCID)'),
('ILL0360','Sexual Health'),
('ILL0361','Sexually Transmitted Infections (STIs)'),
('ILL0362','Shigella'),
('ILL0363','Shingles'),
('ILL0364','Short Bowel Syndrome'),
('ILL0365','Shortness of Breath'),
('ILL0366','Shoulder Impingement Syndrome'),
('ILL0367','Shoulder Pain'),
('ILL0368','SIBO (Small Intestinal Bacterial Overgrowth)'),
('ILL0369','Sick Sinus Syndrome'),
('ILL0370','Sickle Cell Disease'),
('ILL0371','Silicosis'),
('ILL0372','Sinusitis'),
('ILL0373','Sjogren\'s Syndrome'),
('ILL0374','Skin Abscess'),
('ILL0375','Skin Cancer (Melanoma)'),
('ILL0376','Skin Cancer (Non-Melanoma)'),
('ILL0377','Skin Tags'),
('ILL0378','Slapped Cheek Syndrome'),
('ILL0379','Sleep Apnoea'),
('ILL0380','Sleep Paralysis'),
('ILL0381','Sleeping Sickness'),
('ILL0382','Slipped Disc'),
('ILL0383','Smallpox'),
('ILL0384','Snoring'),
('ILL0385','Social Anxiety Disorder'),
('ILL0386','Soft Tissue Sarcomas'),
('ILL0387','Sore Throat'),
('ILL0388','Sotos Syndrome'),
('ILL0389','Spina Bifida'),
('ILL0390','Spinal Cord Injury'),
('ILL0391','Spinal Muscular Atrophy (SMA)'),
('ILL0392','Spinal Stenosis'),
('ILL0393','Spleen Problems and Spleen Removal'),
('ILL0394','Spondylolisthesis'),
('ILL0395','Sports Injuries'),
('ILL0396','Sprains and Strains'),
('ILL0397','Squamous Cell Carcinoma'),
('ILL0398','Squint (Strabismus)'),
('ILL0399','Stammering'),
('ILL0400','Staphylococcal Infections'),
('ILL0401','Stevens-Johnson Syndrome'),
('ILL0402','Stillbirth'),
('ILL0403','Stomach Ache and Abdominal Pain'),
('ILL0404','Stomach Cancer'),
('ILL0405','Stomach Ulcer'),
('ILL0406','Stomatitis'),
('ILL0407','Streptococcus A (Strep A)'),
('ILL0408','Strep Throat'),
('ILL0409','Stress'),
('ILL0410','Stroke'),
('ILL0411','Stuttering'),
('ILL0412','Stye'),
('ILL0413','Subarachnoid Haemorrhage'),
('ILL0414','Subconjunctival Haemorrhage'),
('ILL0415','Substance Use Disorder'),
('ILL0416','Sudden Infant Death Syndrome (SIDS)'),
('ILL0417','Suicide'),
('ILL0418','Sunburn'),
('ILL0419','Superior Vena Cava Obstruction'),
('ILL0420','Supraglottitis (Epiglottitis)'),
('ILL0421','Supraventricular Tachycardia'),
('ILL0422','Swallowing Problems (Dysphagia)'),
('ILL0423','Sweating (Excessive)'),
('ILL0424','Swimmer\'s Ear'),
('ILL0425','Swollen Glands'),
('ILL0426','Syphilis'),
('ILL0427','Syringomyelia'),
('ILL0428','Systemic Lupus Erythematosus (SLE)'),
('ILL0429','Tapeworm Infection'),
('ILL0430','Tardive Dyskinesia'),
('ILL0431','Tay-Sachs Disease'),
('ILL0432','Temporomandibular Joint (TMJ) Disorder'),
('ILL0433','Tendinitis'),
('ILL0434','Tennis Elbow'),
('ILL0435','Testicular Cancer'),
('ILL0436','Testicular Lumps and Swellings'),
('ILL0437','Tetanus'),
('ILL0438','Thalassaemia'),
('ILL0439','Thoracic Outlet Syndrome'),
('ILL0440','Threadworms'),
('ILL0441','Thrombocytopenia'),
('ILL0442','Thrombocytosis'),
('ILL0443','Thrush'),
('ILL0444','Thumb Pain'),
('ILL0445','Thyroid Cancer'),
('ILL0446','Thyroid Eye Disease'),
('ILL0447','Thyroid Nodules'),
('ILL0448','Thyroiditis'),
('ILL0449','Tic Disorders'),
('ILL0450','Tick Bites'),
('ILL0451','Tinea Versicolor'),
('ILL0452','Tinnitus'),
('ILL0453','Toe Pain'),
('ILL0454','Tongue-tie'),
('ILL0455','Tonsillitis'),
('ILL0456','Tooth Abscess'),
('ILL0457','Tooth Decay'),
('ILL0458','Toothache'),
('ILL0459','Torticollis'),
('ILL0460','Tourette\'s Syndrome'),
('ILL0461','Toxic Shock Syndrome'),
('ILL0462','Toxocariasis'),
('ILL0463','Toxoplasmosis'),
('ILL0464','Trachoma'),
('ILL0465','Transient Ischaemic Attack (TIA)'),
('ILL0466','Transverse Myelitis'),
('ILL0467','Traumatic Brain Injury'),
('ILL0468','Tremor'),
('ILL0469','Trichinosis'),
('ILL0470','Trichomoniasis'),
('ILL0471','Trichotillomania'),
('ILL0472','Trigeminal Neuralgia'),
('ILL0473','Trigger Finger'),
('ILL0474','Triple X Syndrome'),
('ILL0475','Tropical Diseases'),
('ILL0476','Trypanosomiasis (Sleeping Sickness)'),
('ILL0477','Tuberculosis (TB)'),
('ILL0478','Tuberous Sclerosis'),
('ILL0479','Tularaemia'),
('ILL0480','Turner Syndrome'),
('ILL0481','Typhoid Fever'),
('ILL0482','Ulcerative Colitis'),
('ILL0483','Umbilical Hernia'),
('ILL0484','Underactive Thyroid (Hypothyroidism)'),
('ILL0485','Undescended Testicles'),
('ILL0486','Upper Respiratory Infection'),
('ILL0487','Urethral Cancer'),
('ILL0488','Urethral Stricture'),
('ILL0489','Urethritis'),
('ILL0490','Urinary Incontinence'),
('ILL0491','Urinary Tract Infection (UTI)'),
('ILL0492','Urticaria (Hives)'),
('ILL0493','Uterine Cancer (Womb Cancer)'),
('ILL0494','Uterine Fibroids'),
('ILL0495','Uveitis'),
('ILL0496','Vaginal Cancer'),
('ILL0497','Vaginal Dryness'),
('ILL0498','Vaginismus'),
('ILL0499','Varicella (Chickenpox)'),
('ILL0500','Varicose Veins');
/*!40000 ALTER TABLE `ILLNESS` ENABLE KEYS */;

--
-- Table structure for table `IN_PATIENT`
--

DROP TABLE IF EXISTS `IN_PATIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IN_PATIENT` (
  `Patient_No` int(11) NOT NULL,
  `Nursing_Unit` int(11) NOT NULL,
  `Room_No` int(11) NOT NULL,
  `Bed_No` char(1) NOT NULL,
  `Admission_Date` date DEFAULT NULL,
  PRIMARY KEY (`Patient_No`,`Nursing_Unit`,`Room_No`,`Bed_No`),
  KEY `Nursing_Unit` (`Nursing_Unit`,`Room_No`,`Bed_No`),
  CONSTRAINT `IN_PATIENT_ibfk_1` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `IN_PATIENT_ibfk_2` FOREIGN KEY (`Nursing_Unit`, `Room_No`, `Bed_No`) REFERENCES `ROOM` (`Nursing_Unit`, `Room_No`, `Bed_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IN_PATIENT`
--

/*!40000 ALTER TABLE `IN_PATIENT` DISABLE KEYS */;
INSERT INTO `IN_PATIENT` VALUES
(19,1,101,'A','2025-05-10');
/*!40000 ALTER TABLE `IN_PATIENT` ENABLE KEYS */;

--
-- Table structure for table `MEDICATION`
--

DROP TABLE IF EXISTS `MEDICATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MEDICATION` (
  `Medication_Code` varchar(10) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Quantity_On_Hand` int(11) DEFAULT NULL,
  `Quantity_On_Order` int(11) DEFAULT NULL,
  `Unit_Cost` decimal(10,2) DEFAULT NULL,
  `YTD_Usage` int(11) DEFAULT NULL,
  PRIMARY KEY (`Medication_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MEDICATION`
--

/*!40000 ALTER TABLE `MEDICATION` DISABLE KEYS */;
INSERT INTO `MEDICATION` VALUES
('MED001','Amoxicillin 500mg',300,150,0.25,1200),
('MED002','Ibuprofen 200mg',500,300,0.10,2200),
('MED003','Metformin 1000mg',250,100,0.30,900),
('MED004','Amlodipine 5mg',200,100,0.18,750),
('MED005','Atorvastatin 20mg',320,200,0.22,1100),
('MED006','Azithromycin 250mg',180,120,0.45,600),
('MED007','Albuterol Inhaler',120,60,3.25,400),
('MED008','Cetirizine 10mg',300,200,0.08,1600),
('MED009','Lisinopril 10mg',210,110,0.15,875),
('MED010','Omeprazole 20mg',280,100,0.20,1350),
('MED011','Levothyroxine 50mcg',240,120,0.12,1050),
('MED012','Hydrochlorothiazide 25mg',180,80,0.14,710),
('MED013','Simvastatin 10mg',260,130,0.19,970),
('MED014','Prednisone 10mg',170,90,0.23,580),
('MED015','Clopidogrel 75mg',190,100,0.40,830),
('MED016','Warfarin 5mg',150,60,0.50,420),
('MED017','Metoprolol 50mg',275,140,0.20,1120),
('MED018','Montelukast 10mg',220,110,0.17,900),
('MED019','Sertraline 50mg',200,100,0.30,810),
('MED020','Ciprofloxacin 500mg',140,70,0.60,370),
('MED021','Furosemide 40mg',160,80,0.22,540),
('MED022','Insulin Glargine',130,65,2.75,420),
('MED023','Fluoxetine 20mg',200,90,0.35,790),
('MED024','Gabapentin 300mg',180,100,0.25,620),
('MED025','Losartan 50mg',210,120,0.18,860),
('MED026','Tamsulosin 0.4mg',150,75,0.40,520),
('MED027','Doxycycline 100mg',170,85,0.55,480),
('MED028','Diphenhydramine 25mg',300,150,0.09,1340),
('MED029','Meloxicam 15mg',160,70,0.33,600),
('MED030','Acetaminophen 500mg',400,250,0.11,2400),
('MED031','Naproxen 250mg',220,100,0.20,950),
('MED032','Clindamycin 300mg',130,60,0.58,410),
('MED033','Allopurinol 100mg',140,70,0.32,500),
('MED034','Lorazepam 1mg',120,60,0.45,390),
('MED035','Propranolol 40mg',160,90,0.25,570),
('MED036','Ranitidine 150mg',180,100,0.18,620),
('MED037','Esomeprazole 40mg',150,70,0.27,480),
('MED038','Hydroxyzine 25mg',200,110,0.22,710),
('MED039','Buspirone 10mg',130,60,0.28,390),
('MED040','Triamcinolone Cream',140,80,1.10,420),
('MED041','Citalopram 20mg',150,75,0.30,530),
('MED042','Venlafaxine 75mg',180,90,0.40,610),
('MED043','Trazodone 50mg',160,70,0.33,500),
('MED044','Bupropion 100mg',170,85,0.50,580),
('MED045','Rosuvastatin 10mg',210,110,0.35,820),
('MED046','Insulin Aspart',100,50,2.80,330),
('MED047','Insulin Lispro',100,55,2.85,350),
('MED048','Insulin Regular',120,60,2.60,390),
('MED049','Insulin NPH',110,50,2.50,360),
('MED050','Beclomethasone Inhaler',100,50,3.40,310),
('MED051','Fluticasone Nasal Spray',200,100,2.10,750),
('MED052','Mometasone Inhaler',150,75,3.50,400),
('MED053','Budesonide Inhaler',140,65,3.30,390),
('MED054','Salbutamol 2mg Tab',180,90,0.20,700),
('MED055','Theophylline 200mg',160,80,0.32,540),
('MED056','Tiotropium Inhaler',120,60,3.75,350),
('MED057','Ipratropium Inhaler',130,65,3.20,360),
('MED058','Zolpidem 5mg',140,70,0.65,490),
('MED059','Loratadine 10mg',300,150,0.10,1650),
('MED060','Risperidone 1mg',120,60,0.58,410),
('MED061','Olanzapine 5mg',110,55,0.75,390),
('MED062','Quetiapine 25mg',130,65,0.70,420),
('MED063','Haloperidol 1mg',100,50,0.65,340),
('MED064','Lithium Carbonate 300mg',140,70,0.50,450),
('MED065','Valproate 250mg',150,75,0.55,470),
('MED066','Carbamazepine 200mg',160,80,0.48,500),
('MED067','Topiramate 25mg',130,65,0.60,420),
('MED068','Lamotrigine 25mg',140,70,0.58,430),
('MED069','Levetiracetam 250mg',120,60,0.62,400),
('MED070','Pregabalin 75mg',100,50,0.66,390),
('MED071','Celecoxib 100mg',150,75,0.45,510),
('MED072','Diclofenac 50mg',160,80,0.35,540),
('MED073','Ketorolac 10mg',140,70,0.40,490),
('MED074','Indomethacin 25mg',130,65,0.38,460),
('MED075','Etodolac 200mg',120,60,0.42,450),
('MED076','Hydrocodone/Acetaminophen',110,55,0.70,430),
('MED077','Codeine 30mg',100,50,0.68,420),
('MED078','Tramadol 50mg',140,70,0.60,470),
('MED079','Morphine 15mg',90,45,0.85,350),
('MED080','Fentanyl Patch 25mcg/hr',80,40,1.20,310),
('MED081','Cyclobenzaprine 10mg',100,50,0.50,400),
('MED082','Baclofen 10mg',110,55,0.48,390),
('MED083','Methocarbamol 500mg',120,60,0.46,410),
('MED084','Tizanidine 2mg',130,65,0.52,420),
('MED085','Carisoprodol 250mg',100,50,0.58,380),
('MED086','Chlorpheniramine 4mg',300,150,0.07,1500),
('MED087','Meclizine 25mg',140,70,0.35,460),
('MED088','Promethazine 25mg',160,80,0.38,510),
('MED089','Ondansetron 4mg',130,65,0.44,490),
('MED090','Scopolamine Patch',100,50,0.95,320),
('MED091','Loperamide 2mg',150,75,0.18,640),
('MED092','Bismuth Subsalicylate',200,100,0.15,720),
('MED093','Famotidine 20mg',180,90,0.20,610),
('MED094','Sucralfate 1g',160,80,0.30,580),
('MED095','Misoprostol 200mcg',120,60,0.70,390),
('MED096','Lactulose Syrup',130,65,0.25,470),
('MED097','Docusate Sodium 100mg',200,100,0.10,810),
('MED098','Senna 8.6mg',180,90,0.12,730),
('MED099','Polyethylene Glycol',150,75,0.18,690),
('MED100','Magnesium Citrate',170,85,0.16,710);
/*!40000 ALTER TABLE `MEDICATION` ENABLE KEYS */;

--
-- Table structure for table `Medication_Order`
--

DROP TABLE IF EXISTS `Medication_Order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Medication_Order` (
  `Physician_ID` int(11) NOT NULL,
  `Patient_No` int(11) NOT NULL,
  `Medication_Code` varchar(10) NOT NULL,
  `Dosage` varchar(50) DEFAULT NULL,
  `Frequency` varchar(50) DEFAULT NULL,
  `Prescription_Date` date DEFAULT NULL,
  PRIMARY KEY (`Physician_ID`,`Patient_No`,`Medication_Code`),
  KEY `Patient_No` (`Patient_No`),
  KEY `Medication_Code` (`Medication_Code`),
  CONSTRAINT `Medication_Order_ibfk_1` FOREIGN KEY (`Physician_ID`) REFERENCES `PHYSICIAN` (`Employment_No`),
  CONSTRAINT `Medication_Order_ibfk_2` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `Medication_Order_ibfk_3` FOREIGN KEY (`Medication_Code`) REFERENCES `MEDICATION` (`Medication_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Medication_Order`
--

/*!40000 ALTER TABLE `Medication_Order` DISABLE KEYS */;
INSERT INTO `Medication_Order` VALUES
(2,19,'MED001','1 tablet','Once daily','2025-05-12'),
(2,19,'MED002','2 tablets','Twice daily','2025-05-10'),
(2,20,'MED001','2 tablets','Every 4 hours','2025-05-11');
/*!40000 ALTER TABLE `Medication_Order` ENABLE KEYS */;

--
-- Table structure for table `NURSE`
--

DROP TABLE IF EXISTS `NURSE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NURSE` (
  `Employment_No` int(11) NOT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Grade` varchar(10) DEFAULT NULL,
  `Experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`Employment_No`),
  CONSTRAINT `NURSE_ibfk_1` FOREIGN KEY (`Employment_No`) REFERENCES `STAFF` (`Employment_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NURSE`
--

/*!40000 ALTER TABLE `NURSE` DISABLE KEYS */;
INSERT INTO `NURSE` VALUES
(18,64000.00,'RN',3),
(19,68000.00,'LPN',4),
(20,62000.00,'RN',2),
(21,71000.00,'BSN',5),
(22,66000.00,'RN',3),
(23,70000.00,'LPN',6),
(24,65000.00,'RN',2),
(25,72000.00,'BSN',7),
(26,63000.00,'RN',1),
(27,69000.00,'LPN',4),
(28,60000.00,'RN',2),
(29,73000.00,'BSN',6),
(30,61000.00,'RN',3),
(31,67500.00,'LPN',5),
(32,65500.00,'RN',4),
(83,64000.00,'RN',3),
(84,68000.00,'LPN',4),
(85,62000.00,'RN',2),
(86,71000.00,'BSN',5),
(87,66000.00,'RN',3),
(88,70000.00,'LPN',6),
(89,65000.00,'RN',2),
(90,72000.00,'BSN',7),
(91,63000.00,'RN',1),
(92,69000.00,'LPN',4),
(93,60000.00,'RN',2),
(94,73000.00,'BSN',6),
(95,61000.00,'RN',3),
(96,67500.00,'LPN',5),
(97,65500.00,'RN',4),
(98,70500.00,'BSN',5),
(99,59000.00,'RN',1),
(100,68000.00,'LPN',4),
(101,73000.00,'BSN',6),
(102,61500.00,'RN',2),
(103,65500.00,'LPN',3),
(104,72000.00,'BSN',6),
(105,63000.00,'RN',3),
(106,60000.00,'LPN',2),
(107,71000.00,'BSN',5),
(108,64500.00,'RN',2),
(109,68500.00,'LPN',4),
(110,73500.00,'BSN',7),
(111,61000.00,'RN',2),
(112,67000.00,'LPN',3),
(113,70500.00,'BSN',5),
(114,62000.00,'RN',2),
(115,69000.00,'LPN',4),
(116,74000.00,'BSN',7),
(117,60500.00,'RN',2),
(118,66000.00,'LPN',3),
(119,72000.00,'BSN',6),
(120,64000.00,'RN',3),
(121,67000.00,'LPN',4),
(122,70000.00,'BSN',5),
(123,63000.00,'RN',2),
(124,66000.00,'LPN',3),
(125,72500.00,'BSN',6),
(126,63500.00,'RN',2),
(127,66500.00,'LPN',3),
(128,71000.00,'BSN',5),
(129,62000.00,'RN',2),
(130,69000.00,'LPN',4),
(131,74500.00,'BSN',7),
(132,60500.00,'RN',2),
(133,67500.00,'LPN',3),
(134,71500.00,'BSN',6),
(135,64000.00,'RN',2),
(136,67000.00,'LPN',4),
(137,69500.00,'BSN',5),
(138,63000.00,'RN',1),
(139,68500.00,'LPN',4),
(140,74000.00,'BSN',6),
(141,61500.00,'RN',2),
(142,64500.00,'LPN',3),
(143,70500.00,'BSN',5),
(144,62500.00,'RN',2),
(145,66500.00,'LPN',3),
(146,71500.00,'BSN',6),
(147,63500.00,'RN',3),
(148,67000.00,'LPN',3),
(149,73000.00,'BSN',6),
(150,64500.00,'RN',2),
(151,67500.00,'LPN',3),
(152,72000.00,'BSN',5),
(153,62000.00,'RN',2),
(154,66000.00,'LPN',3),
(155,70000.00,'BSN',5),
(156,61000.00,'RN',1),
(157,68000.00,'LPN',4),
(158,73500.00,'BSN',6),
(159,60500.00,'RN',2),
(160,66500.00,'LPN',3),
(161,71500.00,'BSN',6),
(162,63500.00,'RN',3),
(163,67000.00,'LPN',3),
(164,73000.00,'BSN',6),
(165,64500.00,'RN',2),
(166,67500.00,'LPN',3),
(167,72000.00,'BSN',5);
/*!40000 ALTER TABLE `NURSE` ENABLE KEYS */;

--
-- Table structure for table `PATIENT`
--

DROP TABLE IF EXISTS `PATIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PATIENT` (
  `Patient_No` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Street` varchar(100) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` char(2) DEFAULT NULL,
  `Zip` char(10) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `SSN` char(9) DEFAULT NULL,
  `Blood_Type` varchar(3) DEFAULT NULL,
  `HDL` int(11) DEFAULT NULL,
  `LDL` int(11) DEFAULT NULL,
  `Triglyceride` int(11) DEFAULT NULL,
  `Cholesterol_Risk` char(1) DEFAULT NULL,
  PRIMARY KEY (`Patient_No`),
  UNIQUE KEY `SSN` (`SSN`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PATIENT`
--

/*!40000 ALTER TABLE `PATIENT` DISABLE KEYS */;
INSERT INTO `PATIENT` VALUES
(19,'Bob Smith','M','1990-07-21','456 Pine Ave','Newark','NJ','07102','555-5678','222334444','A+',55,100,135,'L'),
(20,'Charlie Brown','M','1982-11-02','789 Maple Blvd','Newark','NJ','07103','555-9101','333445555','B+',38,160,200,'H'),
(21,'Dana White','F','1979-09-14','321 Elm Dr','Newark','NJ','07104','555-1122','444556666','AB-',50,130,160,'M'),
(22,'Eli Turner','M','2000-12-25','654 Birch Ln','Newark','NJ','07105','555-3344','555667777','O-',60,90,100,'L'),
(23,'Faith Hill','F','1993-06-17','987 Walnut St','Newark','NJ','07106','555-5566','666778888','A-',35,170,210,'H'),
(24,'George Lane','M','1988-04-08','159 Cedar Ct','Newark','NJ','07107','555-7788','777889999','B-',47,125,155,'M'),
(25,'Hannah Lee','F','1995-02-22','753 Spruce St','Newark','NJ','07108','555-9900','888990000','AB+',52,95,110,'L'),
(26,'Ian Brooks','M','1984-10-11','951 Aspen Rd','Newark','NJ','07109','555-0011','999001111','O+',40,180,220,'H'),
(27,'Julia Adams','F','1997-01-19','369 Poplar Way','Newark','NJ','07110','555-2233','000112222','A+',46,115,140,'M'),
(28,'Kevin Nash','M','1986-05-30','10 Willow Rd','Newark','NJ','07111','555-8899','123450001','B+',58,85,95,'L'),
(29,'Luna Greene','F','1992-08-16','22 Hemlock Ln','Newark','NJ','07112','555-6677','123450002','O-',36,175,205,'H'),
(30,'Mason Perry','M','1980-03-27','34 Cherry St','Newark','NJ','07113','555-4455','123450003','AB+',48,110,145,'M'),
(31,'Nina Ray','F','1994-09-10','56 Peach Blvd','Newark','NJ','07114','555-2234','123450004','A-',53,100,120,'L'),
(32,'Oscar Wells','M','1991-11-18','78 Olive Dr','Newark','NJ','07115','555-9988','123450005','B-',42,165,190,'H'),
(33,'Paula Knox','F','1983-07-03','90 Fig Ct','Newark','NJ','07116','555-7766','123450006','AB-',49,105,130,'M'),
(34,'Quinn Frost','M','1998-12-12','102 Mango St','Newark','NJ','07117','555-5544','123450007','O+',57,92,105,'L'),
(35,'Rita Doyle','F','1996-04-26','114 Palm Ln','Newark','NJ','07118','555-3322','123450008','A+',39,155,180,'H'),
(36,'Sam Vega','M','1987-06-09','126 Nectarine Blvd','Newark','NJ','07119','555-1100','123450009','B+',51,122,150,'M'),
(37,'Tina Holt','F','1999-02-05','138 Lemon Way','Newark','NJ','07120','555-7789','123450010','AB+',54,98,115,'L'),
(38,'Mary williams','F','2025-05-04','24 john avenue','newark','nj','07102','(732) 105-6060','474-72-93','A+',60,120,100,'N'),
(40,'john denver','M','1980-01-11','22 richmond','Newark','NJ','07102','(282) 838-2983','173-83-73','B+',70,110,160,'N');
/*!40000 ALTER TABLE `PATIENT` ENABLE KEYS */;

--
-- Table structure for table `PHYSICIAN`
--

DROP TABLE IF EXISTS `PHYSICIAN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PHYSICIAN` (
  `Employment_No` int(11) NOT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Specialty` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Employment_No`),
  CONSTRAINT `PHYSICIAN_ibfk_1` FOREIGN KEY (`Employment_No`) REFERENCES `STAFF` (`Employment_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PHYSICIAN`
--

/*!40000 ALTER TABLE `PHYSICIAN` DISABLE KEYS */;
INSERT INTO `PHYSICIAN` VALUES
(0,300000.00,'Pediatrician'),
(2,300000.00,'Pediatrician'),
(63,185000.00,'Internal Medicine'),
(64,178500.00,'Pediatrics'),
(65,172000.00,'Family Medicine'),
(66,190000.00,'Endocrinology'),
(67,210000.00,'Neurology'),
(68,225000.00,'Cardiology'),
(69,200000.00,'Gastroenterology'),
(70,182000.00,'Infectious Disease'),
(71,174000.00,'Rheumatology'),
(72,240000.00,'Oncology'),
(73,176000.00,'Allergy and Immunology'),
(74,198000.00,'Pulmonology'),
(75,179000.00,'Nephrology'),
(76,165000.00,'Geriatrics'),
(77,230000.00,'Dermatology'),
(78,215000.00,'Hematology'),
(79,195000.00,'Urology'),
(80,169000.00,'Psychiatry'),
(81,185000.00,'Obstetrics and Gynecology'),
(82,187000.00,'Ophthalmology');
/*!40000 ALTER TABLE `PHYSICIAN` ENABLE KEYS */;

--
-- Table structure for table `Patient_Allergy`
--

DROP TABLE IF EXISTS `Patient_Allergy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Patient_Allergy` (
  `Patient_No` int(11) NOT NULL,
  `Allergy_Code` varchar(10) NOT NULL,
  PRIMARY KEY (`Patient_No`,`Allergy_Code`),
  KEY `Allergy_Code` (`Allergy_Code`),
  CONSTRAINT `Patient_Allergy_ibfk_1` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `Patient_Allergy_ibfk_2` FOREIGN KEY (`Allergy_Code`) REFERENCES `ALLERGY` (`Allergy_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Patient_Allergy`
--

/*!40000 ALTER TABLE `Patient_Allergy` DISABLE KEYS */;
/*!40000 ALTER TABLE `Patient_Allergy` ENABLE KEYS */;

--
-- Table structure for table `Patient_Care`
--

DROP TABLE IF EXISTS `Patient_Care`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Patient_Care` (
  `Nurse_ID` int(11) NOT NULL,
  `Patient_No` int(11) NOT NULL,
  PRIMARY KEY (`Nurse_ID`,`Patient_No`),
  KEY `Patient_No` (`Patient_No`),
  CONSTRAINT `Patient_Care_ibfk_1` FOREIGN KEY (`Nurse_ID`) REFERENCES `NURSE` (`Employment_No`),
  CONSTRAINT `Patient_Care_ibfk_2` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Patient_Care`
--

/*!40000 ALTER TABLE `Patient_Care` DISABLE KEYS */;
INSERT INTO `Patient_Care` VALUES
(18,19);
/*!40000 ALTER TABLE `Patient_Care` ENABLE KEYS */;

--
-- Table structure for table `Patient_Illness`
--

DROP TABLE IF EXISTS `Patient_Illness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Patient_Illness` (
  `Patient_No` int(11) NOT NULL,
  `Illness_Code` varchar(10) NOT NULL,
  PRIMARY KEY (`Patient_No`,`Illness_Code`),
  KEY `Illness_Code` (`Illness_Code`),
  CONSTRAINT `Patient_Illness_ibfk_1` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `Patient_Illness_ibfk_2` FOREIGN KEY (`Illness_Code`) REFERENCES `ILLNESS` (`Illness_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Patient_Illness`
--

/*!40000 ALTER TABLE `Patient_Illness` DISABLE KEYS */;
INSERT INTO `Patient_Illness` VALUES
(38,'ILL0003'),
(40,'ILL0003');
/*!40000 ALTER TABLE `Patient_Illness` ENABLE KEYS */;

--
-- Table structure for table `Primary_Care`
--

DROP TABLE IF EXISTS `Primary_Care`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Primary_Care` (
  `Patient_No` int(11) NOT NULL,
  `Physician_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Patient_No`),
  KEY `Physician_ID` (`Physician_ID`),
  CONSTRAINT `Primary_Care_ibfk_1` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `Primary_Care_ibfk_2` FOREIGN KEY (`Physician_ID`) REFERENCES `PHYSICIAN` (`Employment_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Primary_Care`
--

/*!40000 ALTER TABLE `Primary_Care` DISABLE KEYS */;
INSERT INTO `Primary_Care` VALUES
(38,65),
(40,73);
/*!40000 ALTER TABLE `Primary_Care` ENABLE KEYS */;

--
-- Table structure for table `ROOM`
--

DROP TABLE IF EXISTS `ROOM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROOM` (
  `Nursing_Unit` int(11) NOT NULL,
  `Room_No` int(11) NOT NULL,
  `Bed_No` char(1) NOT NULL,
  `Wing` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Nursing_Unit`,`Room_No`,`Bed_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ROOM`
--

/*!40000 ALTER TABLE `ROOM` DISABLE KEYS */;
INSERT INTO `ROOM` VALUES
(1,101,'A','Blue'),
(1,101,'B','Blue'),
(1,102,'A','Green'),
(1,102,'B','Green'),
(1,103,'A','Blue'),
(1,103,'B','Blue'),
(1,104,'A','Green'),
(1,104,'B','Green'),
(1,105,'A','Blue'),
(1,105,'B','Blue'),
(1,106,'A','Green'),
(1,106,'B','Green'),
(1,107,'A','Blue'),
(1,107,'B','Blue'),
(2,201,'A','Green'),
(2,201,'B','Green'),
(2,202,'A','Blue'),
(2,202,'B','Blue'),
(2,203,'A','Green'),
(2,203,'B','Green'),
(2,204,'A','Blue'),
(2,204,'B','Blue'),
(2,205,'A','Green'),
(2,205,'B','Green'),
(2,206,'A','Blue'),
(2,206,'B','Blue'),
(2,207,'A','Green'),
(2,207,'B','Green'),
(3,301,'A','Blue'),
(3,301,'B','Blue'),
(3,302,'A','Green'),
(3,302,'B','Green'),
(3,303,'A','Blue'),
(3,303,'B','Blue'),
(3,304,'A','Green'),
(3,304,'B','Green'),
(3,305,'A','Blue'),
(3,305,'B','Blue'),
(3,306,'A','Green'),
(3,306,'B','Green'),
(3,307,'A','Blue'),
(3,307,'B','Blue'),
(4,401,'A','Green'),
(4,401,'B','Green'),
(4,402,'A','Blue'),
(4,402,'B','Blue'),
(4,403,'A','Green'),
(4,403,'B','Green'),
(4,404,'A','Blue'),
(4,404,'B','Blue'),
(4,405,'A','Green'),
(4,405,'B','Green'),
(4,406,'A','Blue'),
(4,406,'B','Blue'),
(4,407,'A','Green'),
(4,407,'B','Green'),
(5,501,'A','Blue'),
(5,501,'B','Blue'),
(5,502,'A','Green'),
(5,502,'B','Green'),
(5,503,'A','Blue'),
(5,503,'B','Blue'),
(5,504,'A','Green'),
(5,504,'B','Green'),
(5,505,'A','Blue'),
(5,505,'B','Blue'),
(5,506,'A','Green'),
(5,506,'B','Green'),
(5,507,'A','Blue'),
(5,507,'B','Blue'),
(6,601,'A','Green'),
(6,601,'B','Green'),
(6,602,'A','Blue'),
(6,602,'B','Blue'),
(6,603,'A','Green'),
(6,603,'B','Green'),
(6,604,'A','Blue'),
(6,604,'B','Blue'),
(6,605,'A','Green'),
(6,605,'B','Green'),
(6,606,'A','Blue'),
(6,606,'B','Blue'),
(6,607,'A','Green'),
(6,607,'B','Green'),
(7,701,'A','Blue'),
(7,701,'B','Blue'),
(7,702,'A','Green'),
(7,702,'B','Green'),
(7,703,'A','Blue'),
(7,703,'B','Blue'),
(7,704,'A','Green'),
(7,704,'B','Green'),
(7,705,'A','Blue'),
(7,705,'B','Blue'),
(7,706,'A','Green'),
(7,706,'B','Green'),
(7,707,'A','Blue'),
(7,707,'B','Blue'),
(7,708,'A','Green'),
(7,708,'B','Green');
/*!40000 ALTER TABLE `ROOM` ENABLE KEYS */;

--
-- Table structure for table `SHIFT_SCHEDULE`
--

DROP TABLE IF EXISTS `SHIFT_SCHEDULE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SHIFT_SCHEDULE` (
  `Shift_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_ID` int(11) DEFAULT NULL,
  `Shift_Date` date DEFAULT NULL,
  `Start_Time` time DEFAULT NULL,
  `End_Time` time DEFAULT NULL,
  `Shift_Type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Shift_ID`),
  KEY `Staff_ID` (`Staff_ID`),
  CONSTRAINT `SHIFT_SCHEDULE_ibfk_1` FOREIGN KEY (`Staff_ID`) REFERENCES `STAFF` (`Employment_No`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SHIFT_SCHEDULE`
--

/*!40000 ALTER TABLE `SHIFT_SCHEDULE` DISABLE KEYS */;
INSERT INTO `SHIFT_SCHEDULE` VALUES
(1,63,'2025-05-06','08:00:00','16:00:00','Morning'),
(2,33,'2025-05-12','09:00:00','17:41:00','Afternoon'),
(3,148,'2025-05-13','15:00:00','23:00:00','Evening');
/*!40000 ALTER TABLE `SHIFT_SCHEDULE` ENABLE KEYS */;

--
-- Table structure for table `STAFF`
--

DROP TABLE IF EXISTS `STAFF`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STAFF` (
  `Employment_No` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Street` varchar(100) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` char(2) DEFAULT NULL,
  `Zip` char(10) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `SSN` char(9) DEFAULT NULL,
  PRIMARY KEY (`Employment_No`),
  UNIQUE KEY `SSN` (`SSN`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STAFF`
--

/*!40000 ALTER TABLE `STAFF` DISABLE KEYS */;
INSERT INTO `STAFF` VALUES
(2,'Robert JeanN Pierre','M','400 Wood st','New Brunswick','NJ','08901','7326044867','123456789'),
(18,'Alice Thompson','F','123 Elm St','Newark','NJ','07101','973-555-1001','223456789'),
(19,'Brian Carter','M','45 Oak Rd','Jersey City','NJ','07302','201-555-1002','234567891'),
(20,'Carla Bennett','F','678 Maple Ave','Paterson','NJ','07501','862-555-1003','345678912'),
(21,'David Wright','M','22 Pine Ln','Elizabeth','NJ','07201','908-555-1004','456789123'),
(22,'Emma Lopez','F','510 Cedar Blvd','Trenton','NJ','08601','609-555-1005','567891234'),
(23,'Franklin Ross','M','911 Birch Dr','Camden','NJ','08101','856-555-1006','678912345'),
(24,'Grace Lin','F','33 Spruce St','Clifton','NJ','07011','973-555-1007','789123456'),
(25,'Henry Kim','M','77 Cherry Ct','Passaic','NJ','07055','973-555-1008','891234567'),
(26,'Isabelle Ford','F','90 Walnut Way','Hackensack','NJ','07601','201-555-1009','912345678'),
(27,'Jake Martin','M','120 Poplar Pl','Bayonne','NJ','07002','201-555-1010','987654321'),
(28,'Kara Singh','F','11 Hemlock Dr','East Orange','NJ','07017','862-555-1011','876543219'),
(29,'Leo Rivera','M','88 Redwood Ave','Union City','NJ','07087','201-555-1012','765432198'),
(30,'Maria Silva','F','14 Chestnut Cir','Vineland','NJ','08360','856-555-1013','654321987'),
(31,'Nathan Wu','M','55 Willow Ln','Plainfield','NJ','07060','908-555-1014','543219876'),
(32,'Olivia Patel','F','200 Cypress Dr','Rahway','NJ','07065','732-555-1015','432198765'),
(33,'Aaron Grant','M','88 Highland Ave','Newark','NJ','07102','973-555-2001','123451111'),
(34,'Bianca Yu','F','45 Beacon St','Jersey City','NJ','07305','201-555-2002','123452222'),
(35,'Caleb Morris','M','17 Fairview Rd','Paterson','NJ','07505','862-555-2003','123453333'),
(36,'Diana Scott','F','321 Grove St','Elizabeth','NJ','07206','908-555-2004','123454444'),
(37,'Edward Khan','M','900 Ridge Blvd','Trenton','NJ','08618','609-555-2005','123455555'),
(38,'Fiona Zhang','F','11 Meadow Ct','Camden','NJ','08104','856-555-2006','123456666'),
(39,'George Blake','M','678 Oak Hill Dr','Clifton','NJ','07013','973-555-2007','123457777'),
(40,'Helen Ortiz','F','55 Ivy Pl','Hackensack','NJ','07606','201-555-2008','123458888'),
(41,'Isaac Mehta','M','222 River Rd','Passaic','NJ','07055','973-555-2009','123459999'),
(42,'Jasmine Patel','F','100 Lakeview Blvd','Bayonne','NJ','07002','201-555-2010','123450000'),
(63,'Aaron Blake','M','501 Elm St','Newark','NJ','07101','973-555-1101','331122334'),
(64,'Brenda Moore','F','88 Oak Ave','Jersey City','NJ','07302','201-555-1102','441122335'),
(65,'Charles Yang','M','78 Birch Rd','Paterson','NJ','07501','862-555-1103','551122336'),
(66,'Diana Cruz','F','90 Maple Blvd','Elizabeth','NJ','07201','908-555-1104','661122337'),
(67,'Ethan Wells','M','33 Pine St','Trenton','NJ','08601','609-555-1105','771122338'),
(68,'Farah Singh','F','22 Cedar Ln','Camden','NJ','08101','856-555-1106','881122339'),
(69,'George Patel','M','45 Chestnut Dr','Clifton','NJ','07011','973-555-1107','991122340'),
(70,'Hannah Kim','F','12 Walnut Ct','Passaic','NJ','07055','973-555-1108','111223341'),
(71,'Ian Ross','M','77 Spruce Cir','Hackensack','NJ','07601','201-555-1109','222334452'),
(72,'Julia Li','F','89 Poplar Way','Bayonne','NJ','07002','201-555-1110','333445563'),
(73,'Kevin Zhao','M','14 Redwood Pl','East Orange','NJ','07017','862-555-1111','444556674'),
(74,'Leah Adams','F','23 Cypress Ave','Union City','NJ','07087','201-555-1112','555667785'),
(75,'Marcus Grant','M','67 Willow Dr','Vineland','NJ','08360','856-555-1113','666778896'),
(76,'Nina Flores','F','18 Hemlock St','Plainfield','NJ','07060','908-555-1114','777889907'),
(77,'Oscar Diaz','M','9 Cherry Ln','Rahway','NJ','07065','732-555-1115','888990018'),
(78,'Priya Mehta','F','38 Palm Blvd','Newark','NJ','07101','973-555-1116','999001129'),
(79,'Quincy Allen','M','100 Magnolia St','Jersey City','NJ','07302','201-555-1117','101112230'),
(80,'Rachel Stein','F','56 Fir Ct','Paterson','NJ','07501','862-555-1118','112223341'),
(81,'Samuel Brooks','M','73 Alder Rd','Elizabeth','NJ','07201','908-555-1119','121334452'),
(82,'Tina Nguyen','F','30 Hickory Ave','Trenton','NJ','08601','609-555-1120','131445563'),
(83,'Ava Johnson','F','101 Elm St','Newark','NJ','07101','555-1001','910000083'),
(84,'Liam Smith','M','102 Maple Ave','East Orange','NJ','07017','555-1002','910000084'),
(85,'Sophia Brown','F','103 Pine Rd','Jersey City','NJ','07302','555-1003','910000085'),
(86,'Noah Garcia','M','104 Oak Ln','Newark','NJ','07103','555-1004','910000086'),
(87,'Isabella Martinez','F','105 Birch Blvd','Bloomfield','NJ','07003','555-1005','910000087'),
(88,'James Davis','M','106 Cedar Ct','Paterson','NJ','07501','555-1006','910000088'),
(89,'Mia Wilson','F','107 Ash Dr','Union City','NJ','07087','555-1007','910000089'),
(90,'Benjamin Moore','M','108 Walnut St','Newark','NJ','07104','555-1008','910000090'),
(91,'Charlotte Taylor','F','109 Hickory Way','Elizabeth','NJ','07201','555-1009','910000091'),
(92,'Elijah Thomas','M','110 Poplar Ave','Hackensack','NJ','07601','555-1010','910000092'),
(93,'Amelia White','F','111 Magnolia Blvd','New Brunswick','NJ','08901','555-1011','910000093'),
(94,'Lucas Harris','M','112 Willow Ct','Plainfield','NJ','07060','555-1012','910000094'),
(95,'Harper Martin','F','113 Redwood St','Hoboken','NJ','07030','555-1013','910000095'),
(96,'Logan Thompson','M','114 Sequoia Dr','Newark','NJ','07105','555-1014','910000096'),
(97,'Evelyn Garcia','F','115 Cherry St','West Orange','NJ','07052','555-1015','910000097'),
(98,'Jackson Clark','M','116 Cottonwood Ln','Kearny','NJ','07032','555-1016','910000098'),
(99,'Abigail Lewis','F','117 Spruce Ave','Newark','NJ','07106','555-1017','910000099'),
(100,'Aiden Walker','M','118 Aspen Rd','Orange','NJ','07050','555-1018','910000100'),
(101,'Emily Hall','F','119 Beech Dr','Bayonne','NJ','07002','555-1019','910000101'),
(102,'Carter Allen','M','120 Linden St','Perth Amboy','NJ','08861','555-1020','910000102'),
(103,'Elizabeth Young','F','121 Palm Ave','Newark','NJ','07107','555-1021','910000103'),
(104,'Sebastian Hernandez','M','122 Fir Blvd','Rahway','NJ','07065','555-1022','910000104'),
(105,'Victoria King','F','123 Laurel Rd','Linden','NJ','07036','555-1023','910000105'),
(106,'Daniel Wright','M','124 Mulberry St','Newark','NJ','07102','555-1024','910000106'),
(107,'Grace Lopez','F','125 Dogwood Ct','Irvington','NJ','07111','555-1025','910000107'),
(108,'Henry Scott','M','126 Elderberry Ln','Passaic','NJ','07055','555-1026','910000108'),
(109,'Ella Green','F','127 Juniper Dr','Newark','NJ','07108','555-1027','910000109'),
(110,'Matthew Adams','M','128 Palm Ct','Teaneck','NJ','07666','555-1028','910000110'),
(111,'Scarlett Nelson','F','129 Teak Rd','Roselle','NJ','07203','555-1029','910000111'),
(112,'Joseph Baker','M','130 Hickory St','Newark','NJ','07112','555-1030','910000112'),
(113,'Avery Ramirez','F','131 Alder Way','Clifton','NJ','07011','555-1031','910000113'),
(114,'David Campbell','M','132 Oak Grove Blvd','Newark','NJ','07114','555-1032','910000114'),
(115,'Aria Mitchell','F','133 Sycamore Dr','East Newark','NJ','07029','555-1033','910000115'),
(116,'Samuel Perez','M','134 Larch Ln','Harrison','NJ','07029','555-1034','910000116'),
(117,'Luna Roberts','F','135 Hawthorn Ct','Maplewood','NJ','07040','555-1035','910000117'),
(118,'Owen Phillips','M','136 Willow Creek Rd','South Orange','NJ','07079','555-1036','910000118'),
(119,'Chloe Evans','F','137 Cedar Grove Ave','Belleville','NJ','07109','555-1037','910000119'),
(120,'Gabriel Turner','M','138 Pine Cone Path','Nutley','NJ','07110','555-1038','910000120'),
(121,'Zoey Collins','F','139 Maple Leaf Dr','Montclair','NJ','07042','555-1039','910000121'),
(122,'Anthony Edwards','M','140 Birchwood Ln','Hillside','NJ','07205','555-1040','910000122'),
(123,'Penelope Stewart','F','141 Oakwood Terrace','Union','NJ','07083','555-1041','910000123'),
(124,'Christopher Morris','M','142 Ash St','Westfield','NJ','07090','555-1042','910000124'),
(125,'Riley Flores','F','143 Walnut Creek Rd','Cranford','NJ','07016','555-1043','910000125'),
(126,'Joshua Cook','M','144 Hickory Grove','Summit','NJ','07901','555-1044','910000126'),
(127,'Nora Morgan','F','145 Poplar St','Millburn','NJ','07041','555-1045','910000127'),
(128,'Andrew Bell','M','146 Magnolia Ave','Livingston','NJ','07039','555-1046','910000128'),
(129,'Layla Murphy','F','147 Willow Ave','Verona','NJ','07044','555-1047','910000129'),
(130,'Ryan Bailey','M','148 Redwood Dr','Cedar Grove','NJ','07009','555-1048','910000130'),
(131,'Eleanor Rivera','F','149 Sequoia Ln','Little Falls','NJ','07424','555-1049','910000131'),
(132,'John Cooper','M','150 Cherry Blossom Way','Wayne','NJ','07470','555-1050','910000132'),
(133,'Hannah Howard','F','151 Cottonwood Dr','Totowa','NJ','07512','555-1051','910000133'),
(134,'Isaac Ward','M','152 Spruce Ct','Woodland Park','NJ','07424','555-1052','910000134'),
(135,'Stella Cox','F','153 Aspen Circle','Clifton','NJ','07013','555-1053','910000135'),
(136,'Caleb Richardson','M','154 Beechwood Pl','Passaic','NJ','07055','555-1054','910000136'),
(137,'Violet Gray','F','155 Linden Ave','Garfield','NJ','07026','555-1055','910000137'),
(138,'Christian Price','M','156 Palm St','Lodi','NJ','07644','555-1056','910000138'),
(139,'Aurora Bennett','F','157 Fir Tree Ln','Elmwood Park','NJ','07407','555-1057','910000139'),
(140,'Hunter Wood','M','158 Laurel Dr','Saddle Brook','NJ','07663','555-1058','910000140'),
(141,'Savannah Barnes','F','159 Mulberry Ct','Fair Lawn','NJ','07410','555-1059','910000141'),
(142,'Isaiah Ross','M','160 Dogwood St','Paramus','NJ','07652','555-1060','910000142'),
(143,'Brooklyn Henderson','F','161 Elderberry Rd','Ridgewood','NJ','07450','555-1061','910000143'),
(144,'Charles Coleman','M','162 Juniper Ave','Glen Rock','NJ','07452','555-1062','910000144'),
(145,'Skylar Jenkins','F','163 Palm Tree Blvd','Wyckoff','NJ','07481','555-1063','910000145'),
(146,'Thomas Perry','M','164 Teak Wood Dr','Franklin Lakes','NJ','07417','555-1064','910000146'),
(147,'Claire Powell','F','165 Hickory Nut Ln','Oakland','NJ','07436','555-1065','910000147'),
(148,'Aaron Long','M','166 Alder Creek Rd','Mahwah','NJ','07430','555-1066','910000148'),
(149,'Paisley Patterson','F','167 Oak Leaf Ct','Ramsey','NJ','07446','555-1067','910000149'),
(150,'Kevin Hughes','M','168 Sycamore Ln','Upper Saddle River','NJ','07458','555-1068','910000150'),
(151,'Maya Flores','F','169 Larch St','Montvale','NJ','07645','555-1069','910000151'),
(152,'Brian Washington','M','170 Hawthorn Rd','Park Ridge','NJ','07656','555-1070','910000152'),
(153,'Anna Simmons','F','171 Willow Brook Dr','Woodcliff Lake','NJ','07677','555-1071','910000153'),
(154,'Jason Butler','M','172 Cedar Ridge Ave','Hillsdale','NJ','07642','555-1072','910000154'),
(155,'Madelyn Foster','F','173 Pine Valley Rd','Westwood','NJ','07675','555-1073','910000155'),
(156,'Brandon Gonzales','M','174 Maple Shade Ln','Emerson','NJ','07630','555-1074','910000156'),
(157,'Katherine Bryant','F','175 Birch Hill Ct','Oradell','NJ','07649','555-1075','910000157'),
(158,'Tyler Alexander','M','176 Oak Knoll Dr','River Edge','NJ','07661','555-1076','910000158'),
(159,'Genesis Russell','F','177 Ashwood Pl','New Milford','NJ','07646','555-1077','910000159'),
(160,'Justin Griffin','M','178 Walnut Grove Rd','Dumont','NJ','07628','555-1078','910000160'),
(161,'Allison Diaz','F','179 Hickory Hills Dr','Bergenfield','NJ','07621','555-1079','910000161'),
(162,'Adam Hayes','M','180 Poplar Creek Ave','Tenafly','NJ','07670','555-1080','910000162'),
(163,'Naomi Myers','F','181 Magnolia Gardens','Englewood','NJ','07631','555-1081','910000163'),
(164,'Jordan Graham','M','182 Willow Springs Rd','Leonia','NJ','07605','555-1082','910000164'),
(165,'Aubrey Sullivan','F','183 Redwood Forest Ln','Fort Lee','NJ','07024','555-1083','910000165'),
(166,'Jose Wallace','M','184 Sequoia Grove Ct','Palisades Park','NJ','07650','555-1084','910000166'),
(167,'Addison Woods','F','185 Cherry Tree Dr','Cliffside Park','NJ','07010','555-1085','910000167');
/*!40000 ALTER TABLE `STAFF` ENABLE KEYS */;

--
-- Table structure for table `SURGEON`
--

DROP TABLE IF EXISTS `SURGEON`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURGEON` (
  `Employment_No` int(11) NOT NULL,
  `Specialty` varchar(100) DEFAULT NULL,
  `Contract_Type` varchar(50) DEFAULT NULL,
  `Contract_Length` int(11) DEFAULT NULL,
  PRIMARY KEY (`Employment_No`),
  CONSTRAINT `SURGEON_ibfk_1` FOREIGN KEY (`Employment_No`) REFERENCES `STAFF` (`Employment_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SURGEON`
--

/*!40000 ALTER TABLE `SURGEON` DISABLE KEYS */;
INSERT INTO `SURGEON` VALUES
(33,'Cardiothoracic Surgery','Full-Time',36),
(34,'Neurosurgery','Full-Time',48),
(35,'Orthopedic Surgery','Part-Time',24),
(36,'Plastic Surgery','Contract',12),
(37,'General Surgery','Full-Time',60),
(38,'Pediatric Surgery','Contract',18),
(39,'Vascular Surgery','Full-Time',36),
(40,'ENT (Otolaryngology)','Part-Time',30),
(41,'Urology','Full-Time',48),
(42,'Trauma Surgery','Full-Time',60);
/*!40000 ALTER TABLE `SURGEON` ENABLE KEYS */;

--
-- Table structure for table `SURGERY_SKILL`
--

DROP TABLE IF EXISTS `SURGERY_SKILL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURGERY_SKILL` (
  `Skill_Code` varchar(10) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`Skill_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SURGERY_SKILL`
--

/*!40000 ALTER TABLE `SURGERY_SKILL` DISABLE KEYS */;
INSERT INTO `SURGERY_SKILL` VALUES
('SS001','Sterile Field Preparation'),
('SS002','Surgical Instrument Handling'),
('SS003','Pre-op Patient Positioning'),
('SS004','Operating Room Disinfection'),
('SS005','Suturing Assistance'),
('SS006','Vital Sign Monitoring'),
('SS007','Handling Surgical Sponges'),
('SS008','Catheter Insertion Support'),
('SS009','Anesthesia Monitoring Support'),
('SS010','Scrubbing and Gowning Procedure'),
('SS011','Specimen Labeling and Handling'),
('SS012','Electrocautery Assistance'),
('SS013','Suction Setup and Management'),
('SS014','Endoscope Equipment Handling'),
('SS015','Bone Drill Sterility Maintenance'),
('SS016','Orthopedic Implant Handling'),
('SS017','Neuro Monitoring Equipment Prep'),
('SS018','Microscope Setup (ENT/Ophthalmic)'),
('SS019','Shunt Kit Preparation'),
('SS020','Laser Device Setup'),
('SS021','Cardiopulmonary Bypass Prep'),
('SS022','Wound Dressing Application'),
('SS023','Drain and Tube Management'),
('SS024','Stent Preparation'),
('SS025','Fluoroscopy Assistance'),
('SS026','Tourniquet Application and Timing'),
('SS027','Splint and Brace Application'),
('SS028','Instrument Count Verification'),
('SS029','Sterile Irrigation Setup'),
('SS030','Eye Protection and Shielding');
/*!40000 ALTER TABLE `SURGERY_SKILL` ENABLE KEYS */;

--
-- Table structure for table `SURGERY_TYPE`
--

DROP TABLE IF EXISTS `SURGERY_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURGERY_TYPE` (
  `Surgery_Code` varchar(10) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Anatomical_Location` varchar(100) DEFAULT NULL,
  `Special_Needs` text DEFAULT NULL,
  PRIMARY KEY (`Surgery_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SURGERY_TYPE`
--

/*!40000 ALTER TABLE `SURGERY_TYPE` DISABLE KEYS */;
INSERT INTO `SURGERY_TYPE` VALUES
('CS011','Coronary Artery Bypass','Cardiac','Heart','Cardiopulmonary bypass'),
('CS012','Heart Valve Replacement','Cardiac','Heart','ICU stay, anticoagulation'),
('CS013','Pacemaker Insertion','Cardiac','Chest','Cardiac clearance, sterile technique'),
('CS014','Aneurysm Repair','Cardiac','Aorta','Blood products, ICU'),
('CS015','Angioplasty','Cardiac','Arteries','Contrast dye, cardiac monitoring'),
('DS036','Skin Graft','Dermatology/Plastic','Skin','Donor site prep'),
('DS037','Lipoma Removal','Dermatology/Plastic','Subcutaneous tissue','Minor OR setup'),
('DS038','Rhinoplasty','Dermatology/Plastic','Nose','Cosmetic considerations'),
('DS039','Burn Debridement','Dermatology/Plastic','Skin','Sterile field, wound care'),
('DS040','Blepharoplasty','Dermatology/Plastic','Eyelid','Eye shields'),
('ES016','Tonsillectomy','ENT/Ophthalmic','Throat','NPO status, post-op bleeding'),
('ES017','Sinus Surgery','ENT/Ophthalmic','Nasal Sinuses','Head elevation, suction setup'),
('ES018','Cochlear Implant','ENT/Ophthalmic','Ear','Audiologist support'),
('ES019','Cataract Removal','ENT/Ophthalmic','Eye','Ophthalmic tools, sedation'),
('ES020','Myringotomy with Tubes','ENT/Ophthalmic','Ear','Microscope setup'),
('GS001','Appendectomy','General','Abdomen','NPO before surgery, antibiotics'),
('GS002','Cholecystectomy','General','Gallbladder','Laparoscopic instruments'),
('GS003','Hernia Repair','General','Abdomen/Groin','Mesh may be required'),
('GS004','Mastectomy','General','Breast','Drain placement, oncology consult'),
('GS005','Hemorrhoidectomy','General','Rectum','Pain control, sitz bath'),
('GS041','Colostomy Creation','General','Colon','Stoma care equipment'),
('GS042','Hemicolectomy','General','Colon','Anastomosis tools, antibiotics'),
('GS043','Gastrectomy','General','Stomach','NG tube, fluid replacement'),
('GS044','Laparoscopic Adhesiolysis','General','Abdomen','Camera tower'),
('GS045','Splenectomy','General','Spleen','Vaccine counseling'),
('NS021','Craniotomy','Neuro','Skull/Brain','Neuro ICU, seizure precautions'),
('NS022','Laminectomy','Neuro','Spine','Neuro check, pain control'),
('NS023','Ventriculoperitoneal Shunt','Neuro','Brain/Ventricles','Sterile handling, shunt kit'),
('NS024','Deep Brain Stimulation','Neuro','Brain','Electrode placement'),
('NS025','Tumor Resection','Neuro','Brain/Spinal Cord','Biopsy tools, frozen section'),
('OS006','Knee Replacement','Orthopedic','Knee Joint','Physical therapy, walker'),
('OS007','Hip Replacement','Orthopedic','Hip Joint','Physical therapy, DVT prophylaxis'),
('OS008','Arthroscopy','Orthopedic','Joint (Various)','Minimally invasive tools'),
('OS009','Spinal Fusion','Orthopedic','Spine','Long OR time, neuro monitoring'),
('OS010','Carpal Tunnel Release','Orthopedic','Wrist','Splint post-op'),
('OS046','ACL Reconstruction','Orthopedic','Knee','Brace, crutches'),
('OS047','Rotator Cuff Repair','Orthopedic','Shoulder','Sling, ice packs'),
('OS048','Bunionectomy','Orthopedic','Foot','Post-op shoe'),
('OS049','Tendon Repair','Orthopedic','Arm/Leg','Splint, wound care'),
('OS050','Joint Replacement Revision','Orthopedic','Various Joints','Blood type crossmatch'),
('PS031','Lung Biopsy','Pulmonary','Lungs','Chest tube, monitor oxygen'),
('PS032','Thoracotomy','Pulmonary','Thorax','Respiratory therapy, epidural'),
('PS033','Bronchoscopy','Pulmonary','Airways','Conscious sedation, suction'),
('PS034','Lobectomy','Pulmonary','Lung','ICU, pain control, O2 sat monitor'),
('PS035','Pleurodesis','Pulmonary','Pleural Cavity','Talc, chest tube management'),
('US026','Prostatectomy','Urology','Prostate','Catheter care, blood loss risk'),
('US027','Kidney Stone Removal','Urology','Kidney/Ureter','Ureteroscope, stent'),
('US028','Cystoscopy','Urology','Bladder/Urethra','Scope setup, saline irrigation'),
('US029','Vasectomy','Urology','Scrotum','Sterile technique, ice packs'),
('US030','Nephrectomy','Urology','Kidney','Drain placement, monitor output');
/*!40000 ALTER TABLE `SURGERY_TYPE` ENABLE KEYS */;

--
-- Table structure for table `Skill_Certified`
--

DROP TABLE IF EXISTS `Skill_Certified`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Skill_Certified` (
  `Nurse_ID` int(11) NOT NULL,
  `Skill_Code` varchar(10) NOT NULL,
  PRIMARY KEY (`Nurse_ID`,`Skill_Code`),
  KEY `Skill_Code` (`Skill_Code`),
  CONSTRAINT `Skill_Certified_ibfk_1` FOREIGN KEY (`Nurse_ID`) REFERENCES `NURSE` (`Employment_No`),
  CONSTRAINT `Skill_Certified_ibfk_2` FOREIGN KEY (`Skill_Code`) REFERENCES `SURGERY_SKILL` (`Skill_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Skill_Certified`
--

/*!40000 ALTER TABLE `Skill_Certified` DISABLE KEYS */;
INSERT INTO `Skill_Certified` VALUES
(18,'SS001'),
(18,'SS026'),
(19,'SS005'),
(19,'SS008'),
(19,'SS026'),
(20,'SS024'),
(20,'SS026'),
(21,'SS014'),
(21,'SS020'),
(22,'SS001'),
(22,'SS003'),
(23,'SS008'),
(23,'SS017'),
(24,'SS007'),
(24,'SS018'),
(25,'SS008'),
(25,'SS015'),
(25,'SS020'),
(26,'SS001'),
(26,'SS028'),
(26,'SS030'),
(27,'SS014'),
(27,'SS025'),
(28,'SS005'),
(28,'SS007'),
(28,'SS009'),
(29,'SS003'),
(29,'SS004'),
(29,'SS013'),
(30,'SS012'),
(30,'SS030'),
(31,'SS009'),
(31,'SS022'),
(31,'SS028'),
(32,'SS015'),
(32,'SS026'),
(83,'SS003'),
(83,'SS013'),
(84,'SS022'),
(84,'SS023'),
(84,'SS029'),
(85,'SS007'),
(85,'SS020'),
(85,'SS025'),
(86,'SS002'),
(86,'SS024'),
(87,'SS010'),
(87,'SS027'),
(88,'SS008'),
(88,'SS030'),
(89,'SS009'),
(89,'SS013'),
(90,'SS012'),
(90,'SS023'),
(90,'SS029'),
(91,'SS007'),
(91,'SS012'),
(92,'SS023'),
(92,'SS024'),
(92,'SS025'),
(93,'SS022'),
(93,'SS023'),
(94,'SS018'),
(94,'SS026'),
(95,'SS006'),
(95,'SS015'),
(96,'SS009'),
(96,'SS023'),
(96,'SS025'),
(97,'SS011'),
(97,'SS024'),
(98,'SS008'),
(98,'SS029'),
(99,'SS011'),
(99,'SS028'),
(100,'SS003'),
(100,'SS007'),
(100,'SS009'),
(101,'SS007'),
(101,'SS016'),
(101,'SS023'),
(102,'SS005'),
(102,'SS015'),
(102,'SS023'),
(103,'SS005'),
(103,'SS008'),
(103,'SS026'),
(104,'SS014'),
(104,'SS020'),
(104,'SS026'),
(105,'SS005'),
(105,'SS008'),
(105,'SS012'),
(106,'SS002'),
(106,'SS003'),
(106,'SS027'),
(107,'SS005'),
(107,'SS023'),
(108,'SS024'),
(108,'SS028'),
(109,'SS003'),
(109,'SS013'),
(109,'SS022'),
(110,'SS015'),
(110,'SS017'),
(110,'SS022'),
(111,'SS001'),
(111,'SS018'),
(111,'SS030'),
(112,'SS018'),
(112,'SS024'),
(113,'SS011'),
(113,'SS023'),
(113,'SS027'),
(114,'SS010'),
(114,'SS014'),
(115,'SS001'),
(115,'SS015'),
(116,'SS006'),
(116,'SS017'),
(116,'SS027'),
(117,'SS023'),
(117,'SS030');
/*!40000 ALTER TABLE `Skill_Certified` ENABLE KEYS */;

--
-- Table structure for table `Skill_Requirement`
--

DROP TABLE IF EXISTS `Skill_Requirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Skill_Requirement` (
  `Surgery_Code` varchar(10) NOT NULL,
  `Skill_Code` varchar(10) NOT NULL,
  PRIMARY KEY (`Surgery_Code`,`Skill_Code`),
  KEY `Skill_Code` (`Skill_Code`),
  CONSTRAINT `Skill_Requirement_ibfk_1` FOREIGN KEY (`Surgery_Code`) REFERENCES `SURGERY_TYPE` (`Surgery_Code`),
  CONSTRAINT `Skill_Requirement_ibfk_2` FOREIGN KEY (`Skill_Code`) REFERENCES `SURGERY_SKILL` (`Skill_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Skill_Requirement`
--

/*!40000 ALTER TABLE `Skill_Requirement` DISABLE KEYS */;
INSERT INTO `Skill_Requirement` VALUES
('CS011','SS006'),
('CS011','SS009'),
('CS011','SS021'),
('CS012','SS010'),
('CS012','SS021'),
('CS012','SS022'),
('CS013','SS009'),
('CS013','SS010'),
('CS013','SS023'),
('CS014','SS006'),
('CS014','SS021'),
('CS014','SS025'),
('CS015','SS006'),
('CS015','SS009'),
('CS015','SS024'),
('DS036','SS005'),
('DS036','SS010'),
('DS036','SS022'),
('DS037','SS005'),
('DS037','SS022'),
('DS037','SS029'),
('DS038','SS005'),
('DS038','SS010'),
('DS038','SS018'),
('DS039','SS005'),
('DS039','SS010'),
('DS039','SS022'),
('DS040','SS005'),
('DS040','SS010'),
('DS040','SS030'),
('ES016','SS003'),
('ES016','SS018'),
('ES016','SS022'),
('ES017','SS014'),
('ES017','SS018'),
('ES017','SS029'),
('ES018','SS009'),
('ES018','SS010'),
('ES018','SS018'),
('ES019','SS018'),
('ES019','SS022'),
('ES019','SS030'),
('ES020','SS005'),
('ES020','SS018'),
('ES020','SS029'),
('GS001','SS005'),
('GS001','SS006'),
('GS001','SS020'),
('GS001','SS024'),
('GS002','SS001'),
('GS002','SS005'),
('GS002','SS012'),
('GS003','SS005'),
('GS003','SS024'),
('GS003','SS026'),
('GS004','SS005'),
('GS004','SS010'),
('GS004','SS011'),
('GS005','SS005'),
('GS005','SS022'),
('GS005','SS023'),
('NS021','SS006'),
('NS021','SS017'),
('NS021','SS019'),
('NS022','SS005'),
('NS022','SS017'),
('NS022','SS023'),
('NS023','SS010'),
('NS023','SS019'),
('NS023','SS024'),
('NS024','SS010'),
('NS024','SS017'),
('NS024','SS019'),
('NS025','SS010'),
('NS025','SS011'),
('NS025','SS017'),
('OS006','SS006'),
('OS006','SS016'),
('OS006','SS025'),
('OS007','SS006'),
('OS007','SS016'),
('OS007','SS023'),
('OS008','SS012'),
('OS008','SS014'),
('OS008','SS025'),
('OS009','SS016'),
('OS009','SS017'),
('OS009','SS023'),
('OS010','SS005'),
('OS010','SS014'),
('OS010','SS026'),
('PS031','SS006'),
('PS031','SS022'),
('PS031','SS023'),
('PS032','SS006'),
('PS032','SS010'),
('PS032','SS023'),
('PS033','SS006'),
('PS033','SS009'),
('PS033','SS014'),
('PS034','SS006'),
('PS034','SS010'),
('PS034','SS023'),
('PS035','SS005'),
('PS035','SS023'),
('PS035','SS025'),
('US026','SS008'),
('US026','SS022'),
('US026','SS023'),
('US027','SS005'),
('US027','SS024'),
('US027','SS025'),
('US028','SS014'),
('US028','SS022'),
('US028','SS029'),
('US029','SS008'),
('US029','SS010'),
('US029','SS022'),
('US030','SS005'),
('US030','SS006'),
('US030','SS023');
/*!40000 ALTER TABLE `Skill_Requirement` ENABLE KEYS */;

--
-- Table structure for table `Surgery_Assign`
--

DROP TABLE IF EXISTS `Surgery_Assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Surgery_Assign` (
  `Nurse_ID` int(11) NOT NULL,
  `Surgery_Code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Nurse_ID`),
  KEY `Surgery_Code` (`Surgery_Code`),
  CONSTRAINT `Surgery_Assign_ibfk_1` FOREIGN KEY (`Nurse_ID`) REFERENCES `NURSE` (`Employment_No`),
  CONSTRAINT `Surgery_Assign_ibfk_2` FOREIGN KEY (`Surgery_Code`) REFERENCES `SURGERY_TYPE` (`Surgery_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Surgery_Assign`
--

/*!40000 ALTER TABLE `Surgery_Assign` DISABLE KEYS */;
INSERT INTO `Surgery_Assign` VALUES
(88,'CS011'),
(89,'CS011'),
(90,'CS012'),
(91,'CS012'),
(92,'CS013'),
(93,'CS013'),
(94,'CS014'),
(95,'CS014'),
(96,'CS015'),
(97,'CS015'),
(138,'DS036'),
(139,'DS036'),
(140,'DS037'),
(141,'DS037'),
(142,'DS038'),
(143,'DS038'),
(144,'DS039'),
(145,'DS039'),
(146,'DS040'),
(147,'DS040'),
(98,'ES016'),
(99,'ES016'),
(100,'ES017'),
(101,'ES017'),
(102,'ES018'),
(103,'ES018'),
(104,'ES019'),
(105,'ES019'),
(106,'ES020'),
(107,'ES020'),
(18,'GS001'),
(19,'GS001'),
(20,'GS002'),
(21,'GS002'),
(22,'GS003'),
(23,'GS003'),
(24,'GS004'),
(25,'GS004'),
(26,'GS005'),
(27,'GS005'),
(148,'GS041'),
(149,'GS041'),
(150,'GS042'),
(151,'GS042'),
(152,'GS043'),
(153,'GS043'),
(154,'GS044'),
(155,'GS044'),
(156,'GS045'),
(157,'GS045'),
(108,'NS021'),
(109,'NS021'),
(110,'NS022'),
(111,'NS022'),
(112,'NS023'),
(113,'NS023'),
(114,'NS024'),
(115,'NS024'),
(116,'NS025'),
(117,'NS025'),
(28,'OS006'),
(29,'OS006'),
(30,'OS007'),
(31,'OS007'),
(32,'OS008'),
(83,'OS008'),
(84,'OS009'),
(85,'OS009'),
(86,'OS010'),
(87,'OS010'),
(158,'OS046'),
(159,'OS046'),
(160,'OS047'),
(161,'OS047'),
(162,'OS048'),
(163,'OS048'),
(164,'OS049'),
(165,'OS049'),
(166,'OS050'),
(167,'OS050'),
(128,'PS031'),
(129,'PS031'),
(130,'PS032'),
(131,'PS032'),
(132,'PS033'),
(133,'PS033'),
(134,'PS034'),
(135,'PS034'),
(136,'PS035'),
(137,'PS035'),
(118,'US026'),
(119,'US026'),
(120,'US027'),
(121,'US027'),
(122,'US028'),
(123,'US028'),
(124,'US029'),
(125,'US029'),
(126,'US030'),
(127,'US030');
/*!40000 ALTER TABLE `Surgery_Assign` ENABLE KEYS */;

--
-- Table structure for table `Surgery_Record`
--

DROP TABLE IF EXISTS `Surgery_Record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Surgery_Record` (
  `Patient_No` int(11) NOT NULL,
  `Surgery_Code` varchar(10) NOT NULL,
  `Surgery_Date` date NOT NULL,
  `Start_Time` time DEFAULT NULL,
  `End_Time` time DEFAULT NULL,
  `Nursing_Unit` int(11) DEFAULT NULL,
  `Room_No` int(11) DEFAULT NULL,
  `Bed_No` char(1) DEFAULT NULL,
  `Surgeon_ID` int(11) DEFAULT NULL,
  `Outcome` text DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `Status` enum('Scheduled','Performed','Canceled') DEFAULT 'Scheduled',
  PRIMARY KEY (`Patient_No`,`Surgery_Code`,`Surgery_Date`),
  KEY `Surgery_Code` (`Surgery_Code`),
  KEY `Surgeon_ID` (`Surgeon_ID`),
  KEY `fk_surgery_room` (`Nursing_Unit`,`Room_No`,`Bed_No`),
  CONSTRAINT `Surgery_Record_ibfk_1` FOREIGN KEY (`Patient_No`) REFERENCES `PATIENT` (`Patient_No`),
  CONSTRAINT `Surgery_Record_ibfk_2` FOREIGN KEY (`Surgery_Code`) REFERENCES `SURGERY_TYPE` (`Surgery_Code`),
  CONSTRAINT `Surgery_Record_ibfk_3` FOREIGN KEY (`Surgeon_ID`) REFERENCES `SURGEON` (`Employment_No`),
  CONSTRAINT `fk_surgery_room` FOREIGN KEY (`Nursing_Unit`, `Room_No`, `Bed_No`) REFERENCES `ROOM` (`Nursing_Unit`, `Room_No`, `Bed_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Surgery_Record`
--

/*!40000 ALTER TABLE `Surgery_Record` DISABLE KEYS */;
INSERT INTO `Surgery_Record` VALUES
(19,'DS036','2025-05-10',NULL,NULL,NULL,NULL,NULL,33,'Successful no complications','','Performed'),
(20,'CS011','2025-05-11',NULL,NULL,1,101,'B',33,'Surgery canceled','','Canceled'),
(22,'OS046','2025-05-11','09:31:00','11:31:00',1,102,'A',35,NULL,'','Scheduled'),
(23,'OS008','2025-05-11','16:05:00','18:05:00',1,103,'B',36,NULL,'Emergency','Scheduled'),
(24,'CS014','2025-05-10','21:53:00','23:53:00',1,103,'B',35,'The patient is in recovery','testing occupied','Performed'),
(24,'PS033','2025-05-11','22:56:00','23:56:00',1,103,'A',34,'everything went well','emergency surgery','Performed');
/*!40000 ALTER TABLE `Surgery_Record` ENABLE KEYS */;

--
-- Table structure for table `USERS`
--

DROP TABLE IF EXISTS `USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USERS` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password_Hash` varchar(255) NOT NULL,
  `Role` enum('admin','physician','surgeon','nurse','receptionist') NOT NULL,
  `Employment_No` int(11) DEFAULT NULL,
  `Created_At` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USERS`
--

/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` VALUES
(6,'admin','$2y$10$wXyuwE3yCWbRdkw89UUov.42g5378V/6NenWvvnuDs3MX59BfsQxe','admin',NULL,'2025-05-05 17:36:05');
/*!40000 ALTER TABLE `USERS` ENABLE KEYS */;

--
-- Dumping routines for database 'u611796019_NMA_Clinic'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-13  4:20:14
