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
  `status` enum('pending','approved','declined','cancelled','completed','arrived','on-going','confirmed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `appointments_ibfk_1` (`registration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`registration_id`,`appointment_date`,`appointment_time`,`doctor`,`email_account`,`notes`,`approved`,`created_at`,`updated_at`,`custom_id`,`user_id`,`status`) values 
(1,1,'2024-10-07','13:16:00','Dra. Chona Mendoza','testwalkin@email.com','asasasas',0,'2024-10-07 12:15:39','2024-10-07 12:15:46',NULL,0,'approved'),
(2,1,'2024-10-07','14:23:00','Dra. Chona Mendoza',NULL,'',0,'2024-10-07 12:21:16','2024-10-07 12:21:18',NULL,0,'approved'),
(3,5,'2024-10-08','16:40:00','Dra. Chona Mendoza',NULL,'update check up',0,'2024-10-08 16:41:37','2024-10-08 16:41:37',NULL,0,'on-going'),
(4,5,'2024-10-13','16:45:00','Dra. Chona Mendoza',NULL,'hoy',0,'2024-10-08 16:45:54','2024-10-11 14:33:48',NULL,0,'completed'),
(5,5,'2024-10-09','09:00:00','Dra. Chona Mendoza',NULL,'hello hello',0,'2024-10-09 08:59:38','2024-10-09 08:59:38',NULL,0,'confirmed'),
(6,8,'2024-10-11','14:20:00','Dra. Chona Mendoza',NULL,'first time here',0,'2024-10-11 14:27:30','2024-10-11 14:33:51',NULL,0,'completed'),
(7,8,'2024-10-14','15:00:00','Dra. Chona Mendoza',NULL,'follow up',0,'2024-10-11 14:30:29','2024-10-11 14:30:29',NULL,0,'confirmed');

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
  PRIMARY KEY (`id`),
  KEY `check_up_ibfk_1` (`registration_id`),
  CONSTRAINT `check_up_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `check_up` */

insert  into `check_up`(`id`,`registration_id`,`blood_pressure`,`pulse_rate`,`respiration_rate`,`temperature`,`oxygen_saturation`,`height`,`weight`,`checkup_date`,`ultrasound`,`created_at`,`doctor_comment`,`next_checkup_date`) values 
(1,1,'100','60','60',30.0,'23',0.00,0.00,'2024-10-07 15:18:50','healthy','2024-10-08 11:25:39',NULL,NULL),
(2,5,'120/80','72','16',37.0,'98',170.00,70.00,'2024-10-11 08:25:24','No abnormalities detected','2024-10-11 08:25:24','Patient in good health. Continue current medication.','2024-11-15 00:00:00'),
(3,8,'120/70','72','16',37.0,'98',157.00,35.00,'2024-10-11 14:25:47',NULL,'2024-10-11 14:25:47','the patient needs to monitor','2024-10-18 00:00:00');

/*Table structure for table `diagnosis` */

DROP TABLE IF EXISTS `diagnosis`;

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `diagnosis_type_id` int(11) unsigned NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prescriptions` text DEFAULT NULL,
  `date_released` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  KEY `diagnosis_type_id` (`diagnosis_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `diagnosis` */

insert  into `diagnosis`(`id`,`registration_id`,`diagnosis_type_id`,`recommendation`,`created_at`,`prescriptions`,`date_released`) values 
(1,2,5,'hello world','2024-10-09 09:28:59','eat','2024-10-09');

/*Table structure for table `diagnosis_types` */

DROP TABLE IF EXISTS `diagnosis_types`;

CREATE TABLE `diagnosis_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `diagnosis_types` */

insert  into `diagnosis_types`(`id`,`type`) values 
(1,'Pre-mature'),
(2,'Placenta Previa'),
(3,'Abruptio Placenta'),
(4,'Cesarian Section'),
(5,'Normal Delivery');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `doctors_appointments` */

insert  into `doctors_appointments`(`appointment_id`,`appointment_date`,`appointment_time`,`appointment_reason`,`appointment_status`,`created_at`,`updated_at`,`doctor_name`) values 
(1,'2024-09-19','02:40:00','HINDI AKO AVAILABLE','Scheduled','2024-09-19 02:38:24','2024-09-19 02:38:24','Dra. Chona Mendoza'),
(2,'2024-09-20','12:59:00','vl','Scheduled','2024-09-19 22:51:47','2024-09-19 22:51:47','Dra. Chona Mendoza'),
(3,'2024-03-22','10:00:00','nutrition month','Scheduled','2024-09-23 08:24:14','2024-09-23 08:24:14','Dra. Chona Mendoza');

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
  PRIMARY KEY (`id`),
  KEY `medical_ibfk_1` (`registration_id`),
  CONSTRAINT `medical_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `medical` */

insert  into `medical`(`id`,`registration_id`,`ear_nose_throat_disorders`,`heart_conditions_high_blood_pressure`,`respiratory_tuberculosis_asthma`,`neurologic_migraines_frequent_headaches`,`gonorrhea_chlamydia_syphilis`,`last_update`) values 
(1,1,1,1,1,1,1,'2024-10-08 08:21:17'),
(2,1,2,2,2,2,2,'2024-10-08 08:21:17'),
(3,2,2,2,2,2,2,'2024-10-08 08:21:17'),
(4,2,1,1,1,1,1,'2024-10-08 09:12:17'),
(5,8,2,1,1,1,1,'2024-10-11 14:26:05'),
(6,8,2,2,2,2,2,'2024-10-11 14:26:19');

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
  `status` enum('pending','approved','declined','completed','arrived','confirmed','booked','attended','did not attend','waiting list') NOT NULL DEFAULT 'pending',
  `last_booking_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `online_appointments` */

insert  into `online_appointments`(`id`,`email`,`firstname`,`lastname`,`contact_number`,`appointment_date`,`appointment_time`,`created_at`,`updated_at`,`status`,`last_booking_time`) values 
(1,'sampledata@email.com','sample','data','132165478','2024-10-09','08:00:00','2024-10-09 09:35:58','2024-10-09 10:02:34','booked',NULL),
(2,'sample1@sample.co','sam','ple','650854754','2024-10-17','11:00:00','2024-10-09 10:08:39','2024-10-09 10:13:13','attended','2024-10-09 10:08:39'),
(3,'sample2@sample.co','sample','2','0094561341','2024-10-25','09:00:00','2024-10-09 10:59:33','2024-10-09 10:59:33','pending','2024-10-09 10:59:33');

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
  `no_of_pregnancy` int(11) DEFAULT NULL,
  `last_menstrual` date DEFAULT NULL,
  `age_gestation` int(11) DEFAULT NULL,
  `expected_date_confinement` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `custom_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_custom_id` (`custom_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `registration` */

insert  into `registration`(`id`,`patient_id`,`philhealth_id`,`name`,`mname`,`lname`,`marital_status`,`husband_phone`,`patient_contact_no`,`birthday`,`address`,`age`,`husband`,`occupation`,`no_of_pregnancy`,`last_menstrual`,`age_gestation`,`expected_date_confinement`,`is_deleted`,`custom_id`,`created_at`,`last_update`) values 
(1,0,'123135848784','josefa alonzo','mercado','rizal','divorced','097564612','0976462124','2000-10-07','pampanga',24,'jose rizal','siblings',1,'2024-10-13',1,'2024-10-20',0,NULL,'2024-10-07 10:24:13','2024-10-10 09:22:41'),
(2,0,'453453453','sdasd','asdasd','sadad','divorced','09454658','5465643','2001-04-28','asdsadd',23,'mr. bean','husband',1,'2024-10-07',4,'2025-10-06',0,NULL,'2024-10-07 13:08:35','2024-10-07 13:08:35'),
(3,0,'1231121584','space','ship','mouse','single','N/A','121316541564','2000-05-07','1234 Elm Street, Springfield, IL 62701',24,'JEON JUNGKOOK','husband',1,'2023-10-06',1,'2025-10-06',0,NULL,'2024-10-07 13:11:13','2024-10-07 13:39:51'),
(4,0,'121321','santa','tell','me','single','465465','13411321','2000-01-01','tondo',24,'jayson','siblings',1,'2023-10-07',1,'2025-10-01',0,NULL,'2024-10-07 13:58:20','2024-10-07 13:58:20'),
(5,0,'132646464564','KAE-ANN VENICE','dela torre','BISNAN','married','09454658','98765432100','2003-10-07','poblacion, santa maria, bulacan',21,'hello','n/a',1,'2024-10-21',1,'2025-10-20',0,NULL,'2024-10-07 14:14:15','2024-10-07 14:14:15'),
(6,0,'1234567890','Emma','Louise','Johnson','single','n/a','(555) 123-4567','1990-03-15','123 Maple Street, Springfield, IL',34,'n/a','n/a',1,'2024-08-01',10,'2025-05-08',0,NULL,'2024-10-11 14:22:02','2024-10-11 14:22:02'),
(7,0,'0987654321','Sophia','Marie','Smith','married','n/a','(555) 987-6543','1988-06-25','456 Oak Avenue, Metropolis, NY',36,'n/a','n/a',2,'2024-09-10',5,'2025-05-16',0,NULL,'2024-10-11 14:23:08','2024-10-11 14:23:08'),
(8,0,'1122334455','Ava','Grace','Thompson','single','n/a','(555) 555-1212','1992-11-05','789 Pine Road, Smalltown, TX',31,'n/a','n/a',0,'2024-09-20',0,'0000-00-00',0,NULL,'2024-10-11 14:24:32','2024-10-11 14:24:32');

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
  `user_level` enum('admin','user') NOT NULL DEFAULT 'user',
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`firstname`,`lastname`,`birthday`,`mobile`,`password`,`created_at`,`user_level`,`username`) values 
(1,'admin@admin.com','christina','sagad','2024-09-10','09750019708','$2y$10$yr0XKt6d0fPzAa/.04b0Nu3Tej9DjBbdRbmxEYG5Ku/KORgsGNJXO','2024-08-03 13:18:27','admin',''),
(2,'sagad@gmail.com','christina','sagad','2000-06-16','091048487454','$2y$10$CldfyL8onBJYvzomClLkHu7yr08sSr/q54uFcMjdSJK75n1/yeR52','2024-08-17 13:26:04','user','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
