/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 11.5.2-MariaDB : Database - clinic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`clinic` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `clinic`;

/*Table structure for table `appointments` */

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `email_account` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `custom_id` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','booked','arrived','reschedule','follow_up','cancelled','in_session','completed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `appointments_ibfk_1` (`registration_id`),
  CONSTRAINT `fk_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`registration_id`,`appointment_date`,`appointment_time`,`doctor`,`email_account`,`notes`,`approved`,`created_at`,`updated_at`,`custom_id`,`user_id`,`status`) values 
(1,1,'2024-11-21','14:30:00','Dra. Chona Mendoza',NULL,'A',0,'2024-11-21 14:55:59','2024-11-21 14:55:59',NULL,0,'booked');

/*Table structure for table `check_up` */

DROP TABLE IF EXISTS `check_up`;

CREATE TABLE `check_up` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `blood_pressure` varchar(7) NOT NULL,
  `pulse_rate` varchar(10) NOT NULL,
  `respiration_rate` varchar(10) NOT NULL,
  `temperature` decimal(4,1) NOT NULL,
  `oxygen_saturation` varchar(10) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `checkup_date` datetime DEFAULT current_timestamp(),
  `ultrasound` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `doctor_comment` text DEFAULT NULL,
  `next_checkup_date` datetime DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  `pregnancy_test` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `check_up_ibfk_1` (`registration_id`),
  CONSTRAINT `check_up_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `check_up` */

/*Table structure for table `diagnosis` */

DROP TABLE IF EXISTS `diagnosis`;

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prescriptions` text DEFAULT NULL,
  `date_released` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `diagnosis` */

insert  into `diagnosis`(`id`,`registration_id`,`recommendation`,`created_at`,`prescriptions`,`date_released`) values 
(1,1,'','2024-11-21 14:54:56','aaa','2024-11-21');

/*Table structure for table `diagnosis_types` */

DROP TABLE IF EXISTS `diagnosis_types`;

CREATE TABLE `diagnosis_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `diagnosis_types` */

insert  into `diagnosis_types`(`id`,`type`) values 
(1,'Pre-mature'),
(2,'Placenta Previa'),
(3,'Abruptio Placenta'),
(4,'Cesarian Section'),
(5,'Normal Delivery'),
(6,'Check Up');

/*Table structure for table `doctors_appointments` */

DROP TABLE IF EXISTS `doctors_appointments`;

CREATE TABLE `doctors_appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_reason` varchar(255) DEFAULT NULL,
  `appointment_status` enum('Scheduled','Completed','Cancelled') DEFAULT 'Scheduled',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `doctor_name` varchar(255) DEFAULT 'Dra. Chona Mendoza',
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `doctors_appointments` */

insert  into `doctors_appointments`(`appointment_id`,`appointment_date`,`appointment_time`,`appointment_reason`,`appointment_status`,`created_at`,`updated_at`,`doctor_name`) values 
(1,'2024-11-15','11:30:00','for the bini','Scheduled','2024-11-14 13:55:57','2024-11-14 13:55:57','Dra. Chona Mendoza');

/*Table structure for table `files` */

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `files` */

/*Table structure for table `findings` */

DROP TABLE IF EXISTS `findings`;

CREATE TABLE `findings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `findings` text NOT NULL,
  `recommendations` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  CONSTRAINT `findings_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `findings` */

insert  into `findings`(`id`,`registration_id`,`findings`,`recommendations`,`created_at`) values 
(1,1,'aa','aa','2024-11-21 15:33:48');

/*Table structure for table `laboratory_tests` */

DROP TABLE IF EXISTS `laboratory_tests`;

CREATE TABLE `laboratory_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `ultrasound` varchar(255) NOT NULL,
  `pregnancy_test` varchar(255) NOT NULL,
  `urinalysis` varchar(255) NOT NULL,
  `test_date` date NOT NULL,
  `results` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diagnosis_type_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  CONSTRAINT `laboratory_tests_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `laboratory_tests` */

insert  into `laboratory_tests`(`id`,`registration_id`,`ultrasound`,`pregnancy_test`,`urinalysis`,`test_date`,`results`,`created_at`,`last_update`,`diagnosis_type_id`) values 
(1,1,'a','123','124','2024-11-21','a','2024-11-21 14:53:57','2024-11-21 14:53:57',0);

/*Table structure for table `medical` */

DROP TABLE IF EXISTS `medical`;

CREATE TABLE `medical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `ear_nose_throat_disorders` tinyint(1) DEFAULT NULL,
  `heart_conditions_high_blood_pressure` tinyint(1) DEFAULT NULL,
  `respiratory_tuberculosis_asthma` tinyint(1) DEFAULT NULL,
  `neurologic_migraines_frequent_headaches` tinyint(1) DEFAULT NULL,
  `gonorrhea_chlamydia_syphilis` tinyint(1) DEFAULT NULL,
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `no_of_pregnancy` int(11) DEFAULT NULL,
  `last_menstrual` date DEFAULT NULL,
  `age_gestation` int(11) DEFAULT NULL,
  `expected_date_confinement` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_ibfk_1` (`registration_id`),
  CONSTRAINT `medical_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `medical` */

insert  into `medical`(`id`,`registration_id`,`ear_nose_throat_disorders`,`heart_conditions_high_blood_pressure`,`respiratory_tuberculosis_asthma`,`neurologic_migraines_frequent_headaches`,`gonorrhea_chlamydia_syphilis`,`last_update`,`no_of_pregnancy`,`last_menstrual`,`age_gestation`,`expected_date_confinement`) values 
(1,1,2,2,2,1,2,'2024-11-21 14:52:51',1,'2024-11-04',7,'2025-07-23');

/*Table structure for table `online_appointments` */

DROP TABLE IF EXISTS `online_appointments`;

CREATE TABLE `online_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` enum('pending','booked','arrived','reschedule','follow_up','cancelled','in_session','completed') NOT NULL DEFAULT 'pending',
  `last_booking_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `online_appointments` */

insert  into `online_appointments`(`id`,`email`,`firstname`,`lastname`,`contact_number`,`appointment_date`,`appointment_time`,`created_at`,`updated_at`,`STATUS`,`last_booking_time`) values 
(1,'kristine@email.com','kendell','de guzman','0946546548','2024-11-25','10:00:00','2024-11-21 15:02:41','2024-11-21 15:04:38','booked','2024-11-21 15:02:41');

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `philhealth_id` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed') DEFAULT NULL,
  `husband_phone` varchar(50) DEFAULT NULL,
  `patient_contact_no` varchar(50) DEFAULT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `husband` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `custom_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_custom_id` (`custom_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `registration` */

insert  into `registration`(`id`,`patient_id`,`philhealth_id`,`name`,`mname`,`lname`,`marital_status`,`husband_phone`,`patient_contact_no`,`birthday`,`address`,`age`,`husband`,`occupation`,`is_deleted`,`custom_id`,`created_at`,`last_update`) values 
(1,0,'123135848784','josefa alonzo','mercado','rizal','divorced','097564612','0976462124','2000-10-07','pampanga',24,'jose rizal','siblings',0,NULL,'2024-10-07 10:24:13','2024-10-10 09:22:41'),
(5,0,'132646464564','KAE-ANN VENICE','dela torre','BISNAN','married','09454658','98765432100','2003-10-07','poblacion, santa maria, bulacan',21,'hello','n/a',0,NULL,'2024-10-07 14:14:15','2024-10-07 14:14:15'),
(14,0,'10','eshley','camota','balaguer','single','n/a','0978545612','1998-10-18','sapang palay',26,'n/a','n/a',0,'PAT-0003','2024-10-18 11:08:07','2024-10-18 11:08:22'),
(15,0,'0000000','anna','n/a','jacinto','married','n/a','09564345','2000-10-18','sta. clara`',24,'n/a','n/a',0,'PAT-0004','2024-10-18 16:29:58','2024-10-18 16:29:58'),
(16,0,'1111','clarice','manuel','santos','single','46465464','054487464','2000-06-16','catmon bulacan',24,'romeo santos','father',0,'PAT-0005','2024-10-21 11:31:42','2024-10-21 11:31:42'),
(17,0,'1234578496100','Hannah','Garingo','ALARILLA','married','09452487515','0975468746','1994-12-31','pulong buhangin santa maria bulacan',29,'christian alarilla','husband',0,'PAT-0006','2024-10-22 08:39:10','2024-10-22 14:25:07'),
(18,0,'2024336910312008','mishka','cisneros','catahan','single','094646548765','097512345748','2000-10-31','sebastian st. catmon santa maria bulacan',23,'wilfredo catahan','parent',0,'PAT-0007','2024-10-22 14:43:58','2024-10-22 14:43:58'),
(19,0,'2024370412162007','CHELSEA YVONNE','CASIMIRO','ETANG','married','094658971465','09478541231','1992-12-16','1234 Elm Street, Springfield, IL 62701',31,'PRINCE DAVE ETANG','HUSBAND',0,'PAT-0008','2024-10-22 15:36:59','2024-10-22 15:36:59'),
(20,0,'121546679894412','Princess Diana','Valentina','Solano','single','09746461315','097456432','2006-10-30','santa cruz',17,'patrick solano','husband',0,'PAT-0009','2024-10-28 16:06:14','2024-10-28 16:06:14'),
(21,0,'0489765489','NICOLE','TUAZON','TABON','single','N/A','0975464546','2000-11-15','MAKATI',23,'N/A','N/A',0,'0010','2024-10-28 16:10:11','2024-10-28 16:10:11'),
(22,0,'PH001234567','Maria','Clara','Santos','married','0917-123-4567','0917-123-4567','1982-03-15','123 Ayala Ave',42,'Juan Santos','Businesswoman',0,'CUST010','2024-10-30 09:09:53','2024-10-30 09:19:22'),
(23,0,'PH001234568','Ana','Maria','Dela Cruz','single','0917-234-5678','0917-234-5678','1995-05-20','456 Rizal St',29,NULL,'Teacher',0,'0011','2024-10-30 09:09:53','2024-11-21 08:18:57'),
(24,0,'PH001234569','Luz','n/a','Gonzales','widowed','0917-345-6789','0917-345-6789','1960-07-30','789 Quezon Ave',64,NULL,'Retired',0,'0012','2024-10-30 09:09:53','2024-11-21 08:19:03'),
(25,0,'PH001234570','Rosa','Lina','Mendoza','divorced','0917-456-7890','0917-456-7890','1975-09-25','321 Bonifacio St',48,NULL,'Nurse',0,'0013','2024-10-30 09:09:53','2024-11-21 08:19:07'),
(26,0,'PH001234571','Carmen','n/a','Lopez','married','0917-567-8901','0917-567-8901','1988-11-11','654 Palma St',35,'Carlos Lopez','Engineer',0,'0014','2024-10-30 09:09:53','2024-11-21 08:19:10'),
(27,0,'','Sofia','Mira','Reyes','single','0917-678-9012','0917-678-9012','1992-12-12','987 Santiago St',31,'john gomez','Graphic Designer',0,'0015','2024-10-30 09:09:53','2024-11-21 08:19:13'),
(28,0,'PH001234573','Nina','Joy','Ramirez','married','0917-789-0123','0917-789-0123','1980-02-14','543 De La Cruz St',44,'Miguel Ramirez','Chef',0,'0016','2024-10-30 09:09:53','2024-11-21 08:19:17'),
(29,0,'PH001234574','Liza','May','Alvarez','widowed','0917-890-1234','0917-890-1234','1955-06-06','678 Sariwa St',69,NULL,'Housewife',0,'0017','2024-10-30 09:09:53','2024-11-21 08:19:20'),
(30,0,'PH001234575','Patricia','n/a','Fernandez','single','0917-901-2345','0917-901-2345','1990-08-08','345 Araw St',34,NULL,'Marketing Specialist',0,'0018','2024-10-30 09:09:53','2024-11-21 08:19:23'),
(31,0,'PH001234576','Joy','Rhea','Cruz','married','0917-012-3456','0917-012-3456','1985-10-10','432 Bayani St',39,'Peter Cruz','Accountant',0,'0019','2024-10-30 09:09:53','2024-11-21 08:19:29'),
(32,0,'132456456875465489','andrea','n/a','roxas','single','098745654','09764654212','2006-10-24','manila',18,'mark pacurib','father ',0,'0021','2024-11-14 12:54:17','2024-11-14 12:54:17'),
(33,0,'5987587694596760','rose marie','garman','gomez','married','906796979087','0809070982','1997-10-20','catmon santa maria bulacan',27,'john gomez','husband',0,'0022','2024-11-19 13:31:07','2024-11-19 13:31:07');

/*Table structure for table `scheduling_settings` */

DROP TABLE IF EXISTS `scheduling_settings`;

CREATE TABLE `scheduling_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(10) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `scheduling_settings` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `open_days` varchar(255) NOT NULL,
  `open_hours` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`open_days`,`open_hours`) values 
(1,'Monday,Tuesday,Wednesday,Thursday,Friday','09:00-17:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_level` enum('admin','user','secretary') NOT NULL DEFAULT 'user',
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`firstname`,`lastname`,`birthday`,`mobile`,`password`,`created_at`,`user_level`,`username`) values 
(1,'admin@admin.com','christina','sagad','2024-09-10','09750019708','$2y$10$yr0XKt6d0fPzAa/.04b0Nu3Tej9DjBbdRbmxEYG5Ku/KORgsGNJXO','2024-08-03 13:18:27','admin','admin'),
(2,'user@user.com','christina','sagad','2000-06-16','091048487454','$2y$10$CldfyL8onBJYvzomClLkHu7yr08sSr/q54uFcMjdSJK75n1/yeR52','2024-08-17 13:26:04','secretary','user');

/*Table structure for table `vital_signs` */

DROP TABLE IF EXISTS `vital_signs`;

CREATE TABLE `vital_signs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `blood_pressure_systolic` int(3) NOT NULL,
  `blood_pressure_diastolic` int(3) NOT NULL,
  `pulse_rate` int(3) NOT NULL,
  `respiration_rate` int(3) NOT NULL,
  `temperature` decimal(4,1) NOT NULL,
  `oxygen_saturation` int(3) DEFAULT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `bmi` decimal(5,2) DEFAULT NULL,
  `checkup_date` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `vital_signs_ibfk_1` (`registration_id`),
  CONSTRAINT `vital_signs_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `vital_signs` */

insert  into `vital_signs`(`id`,`registration_id`,`blood_pressure_systolic`,`blood_pressure_diastolic`,`pulse_rate`,`respiration_rate`,`temperature`,`oxygen_saturation`,`height`,`weight`,`bmi`,`checkup_date`,`created_at`) values 
(1,1,10,0,21,31,12.0,1,12.00,12.00,121.00,'2024-11-21 14:52:15','2024-11-21 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
