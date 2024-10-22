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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`registration_id`,`appointment_date`,`appointment_time`,`doctor`,`email_account`,`notes`,`approved`,`created_at`,`updated_at`,`custom_id`,`user_id`,`status`) values 
(1,18,'2024-10-21','16:30:00','Dr. Chona Mendoza',NULL,'check up',0,'2024-10-22 14:48:40','2024-10-22 16:34:03',NULL,0,'booked'),
(2,5,'2024-10-22','17:00:00','Dr. Chona Mendoza',NULL,'hello',0,'2024-10-22 16:39:54','2024-10-22 16:42:00',NULL,0,'in_session');

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
  `diagnosis_type_id` int(11) unsigned NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prescriptions` text DEFAULT NULL,
  `date_released` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  KEY `diagnosis_type_id` (`diagnosis_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `diagnosis` */

insert  into `diagnosis`(`id`,`registration_id`,`diagnosis_type_id`,`recommendation`,`created_at`,`prescriptions`,`date_released`) values 
(1,17,6,'good health','2024-10-22 10:12:11','health','2024-10-22'),
(2,18,6,'Follow-up Ultrasound: Schedule a follow-up ultrasound in 4 weeks to monitor fetal development.\r\nPrenatal Vitamins: Start taking prenatal vitamins with folic acid to support the pregnancy.\r\nHydration and Nutrition: Maintain a balanced diet and adequate hydration.','2024-10-22 14:49:52','Medication: Prenatal Vitamins (e.g., Nature Made Prenatal Multi + DHA)\r\nDosage: 1 tablet daily with food\r\nDuration: Until the end of the pregnancy','2024-10-22'),
(3,19,6,'Follow-up consultation in 2 weeks; monitor symptoms.','2024-10-22 15:50:35','Iron Supplements - 1 tablet daily\r\nFolic Acid - 1 tablet daily','2024-10-22');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `doctors_appointments` */

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `findings` */

insert  into `findings`(`id`,`registration_id`,`findings`,`recommendations`,`created_at`) values 
(1,18,'No additional findings noted during the assessment.','Schedule follow-up ultrasound in 4 weeks.\r\nBegin taking prenatal vitamins.\r\nMaintain a healthy diet and hydration.','2024-10-22 14:53:26'),
(2,19,'The patient exhibits slight edema in the lower extremities, and there are no signs of jaundice. Heart sounds are normal, with no murmurs detected. The abdominal exam reveals mild tenderness in the suprapubic area but no palpable masses.','Recommend follow-up ultrasound in two weeks to assess any changes in the abdominal tenderness. Advise the patient to maintain a balanced diet and increase fluid intake. A follow-up appointment should be scheduled in one month to monitor progress and address any concerns.','2024-10-22 15:55:22');

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
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  CONSTRAINT `laboratory_tests_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `laboratory_tests` */

insert  into `laboratory_tests`(`id`,`registration_id`,`ultrasound`,`pregnancy_test`,`urinalysis`,`test_date`,`results`,`created_at`,`last_update`) values 
(4,17,'Normal fetal development observed','positive ','','2024-10-22','results di ko alam ilalagay ko pa','2024-10-22 10:11:08','2024-10-22 10:11:08'),
(5,15,'Normal','Positive','Clear','2024-09-20','Normal findings, pregnancy confirmed.','2024-10-22 10:25:01','2024-10-22 10:25:01'),
(6,16,'Not performed','Negative','Clear','2024-10-01','No pregnancy detected.','2024-10-22 10:25:01','2024-10-22 10:25:01'),
(7,18,'Normal findings indicating a healthy early pregnancy','Positive, confirming pregnancy status.','','2024-10-15','Confirmed intrauterine pregnancy. No abnormalities noted.','2024-10-22 14:47:59','2024-10-22 14:47:59'),
(8,19,'Normal findings','Positive','Normal','2024-10-22','No abnormalities detected; follow up in two weeks.','2024-10-22 15:48:58','2024-10-22 15:48:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `medical` */

insert  into `medical`(`id`,`registration_id`,`ear_nose_throat_disorders`,`heart_conditions_high_blood_pressure`,`respiratory_tuberculosis_asthma`,`neurologic_migraines_frequent_headaches`,`gonorrhea_chlamydia_syphilis`,`last_update`,`no_of_pregnancy`,`last_menstrual`,`age_gestation`,`expected_date_confinement`) values 
(1,17,2,2,2,2,2,'2024-10-22 10:09:00',1,'2024-09-22',21,'2025-09-22'),
(2,15,0,1,0,0,0,'2024-10-22 10:24:39',2,'2024-09-15',12,'2025-06-15'),
(3,16,1,0,1,1,0,'2024-10-22 10:24:39',NULL,NULL,NULL,NULL),
(4,18,1,1,2,2,2,'2024-10-22 14:46:21',2,'2024-09-15',8,'2025-06-10'),
(5,19,1,1,1,1,1,'2024-10-22 15:40:01',1,'2024-10-16',3,'2025-07-11');

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
(1,'chelseayetang@email.com','Chelsea Yvonne','Etang','0946546541','2024-10-22','16:30:00','2024-10-22 15:16:36','2024-10-22 16:27:53','booked','2024-10-22 15:16:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `registration` */

insert  into `registration`(`id`,`patient_id`,`philhealth_id`,`name`,`mname`,`lname`,`marital_status`,`husband_phone`,`patient_contact_no`,`birthday`,`address`,`age`,`husband`,`occupation`,`is_deleted`,`custom_id`,`created_at`,`last_update`) values 
(1,0,'123135848784','josefa alonzo','mercado','rizal','divorced','097564612','0976462124','2000-10-07','pampanga',24,'jose rizal','siblings',0,NULL,'2024-10-07 10:24:13','2024-10-10 09:22:41'),
(5,0,'132646464564','KAE-ANN VENICE','dela torre','BISNAN','married','09454658','98765432100','2003-10-07','poblacion, santa maria, bulacan',21,'hello','n/a',0,NULL,'2024-10-07 14:14:15','2024-10-07 14:14:15'),
(14,0,'10','eshley','camota','balaguer','single','n/a','0978545612','1998-10-18','sapang palay',26,'n/a','n/a',0,'PAT-0003','2024-10-18 11:08:07','2024-10-18 11:08:22'),
(15,0,'0000000','anna','n/a','jacinto','married','n/a','09564345','2000-10-18','sta. clara`',24,'n/a','n/a',0,'PAT-0004','2024-10-18 16:29:58','2024-10-18 16:29:58'),
(16,0,'1111','clarice','manuel','santos','single','46465464','054487464','2000-06-16','catmon bulacan',24,'romeo santos','father',0,'PAT-0005','2024-10-21 11:31:42','2024-10-21 11:31:42'),
(17,0,'1234578496100','Hannah','Garingo','ALARILLA','married','09452487515','0975468746','1994-12-31','pulong buhangin santa maria bulacan',29,'christian alarilla','husband',0,'PAT-0006','2024-10-22 08:39:10','2024-10-22 14:25:07'),
(18,0,'2024336910312008','mishka','cisneros','catahan','single','094646548765','097512345748','2000-10-31','sebastian st. catmon santa maria bulacan',23,'wilfredo catahan','parent',0,'PAT-0007','2024-10-22 14:43:58','2024-10-22 14:43:58'),
(19,0,'2024370412162007','CHELSEA YVONNE','CASIMIRO','ETANG','married','094658971465','09478541231','1992-12-16','1234 Elm Street, Springfield, IL 62701',31,'PRINCE DAVE ETANG','HUSBAND',0,'PAT-0008','2024-10-22 15:36:59','2024-10-22 15:36:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

/*Data for the table `vital_signs` */

insert  into `vital_signs`(`id`,`registration_id`,`blood_pressure_systolic`,`blood_pressure_diastolic`,`pulse_rate`,`respiration_rate`,`temperature`,`oxygen_saturation`,`height`,`weight`,`bmi`,`checkup_date`,`created_at`) values 
(1,17,120,80,72,16,35.2,23,178.00,77.00,24.20,'2024-10-22 10:08:23','2024-10-22 00:00:00'),
(2,15,120,80,75,16,36.5,98,1.75,70.00,22.90,'2024-10-01 10:00:00','2024-10-22 10:23:41'),
(3,16,130,85,78,18,37.0,97,1.68,80.00,28.30,'2024-10-02 11:30:00','2024-10-22 10:23:41'),
(4,18,120,80,75,16,37.0,98,170.00,70.00,24.20,'2024-10-22 14:45:12','2024-10-22 00:00:00'),
(5,19,120,80,75,16,37.0,98,165.00,60.00,22.00,'2024-10-22 15:38:39','2024-10-22 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
