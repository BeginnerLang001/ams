/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.3.17-MariaDB : Database - clinic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`clinic` /*!40100 DEFAULT CHARACTER SET utf8 */;

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
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `appointments_ibfk_1` (`registration_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`registration_id`,`appointment_date`,`appointment_time`,`doctor`,`email_account`,`notes`,`approved`,`created_at`,`updated_at`,`custom_id`,`user_id`,`status`) values 
(5,2,'2024-08-17','15:00:00','Dra. Chona Mendoza',NULL,'hello papa check up po ako',0,'2024-08-17 14:50:52','2024-09-09 12:54:07',NULL,0,'approved'),
(6,2,'2024-08-20','10:00:00','Dra. Chona Mendoza',NULL,'check code',0,'2024-08-17 15:09:05','2024-08-17 15:09:05',NULL,0,'pending'),
(7,1,'2024-08-21','16:00:00','Dra. Chona Mendoza',NULL,'last na to',0,'2024-08-17 15:23:01','2024-08-17 15:23:01',NULL,0,'pending'),
(8,1,'2024-08-22','16:00:00','Dra. Chona Mendoza',NULL,'last na to',0,'2024-08-17 15:25:50','2024-08-17 15:25:50',NULL,0,'pending'),
(9,1,'2024-08-23','10:00:00','Dra. Chona Mendoza',NULL,'hello god help me',0,'2024-08-17 15:36:43','2024-08-17 15:36:43',NULL,0,'pending'),
(10,1,'2024-08-24','10:00:00','Dra. Chona Mendoza',NULL,'hello god help me',0,'2024-08-17 15:41:41','2024-08-17 15:41:41',NULL,0,'pending'),
(11,3,'2024-08-22','13:00:00','Dra. Chona Mendoza',NULL,'for ',0,'2024-08-22 11:52:11','2024-08-22 11:58:27',NULL,0,'approved'),
(12,2,'2024-09-09','13:10:00','Dra. Chona Mendoza','tinasagad0@gmail.com','update now',0,'2024-09-09 13:23:52','2024-09-09 13:46:59',NULL,0,'approved'),
(17,2,'2024-09-09','15:00:00','Dra. Chona Mendoza','tinasagad0@gmail.com','hi po',0,'2024-09-09 14:08:33','2024-09-09 14:08:57',NULL,0,'approved');

/*Table structure for table `files` */

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  CONSTRAINT `files_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `files` */

/*Table structure for table `medical` */

DROP TABLE IF EXISTS `medical`;

CREATE TABLE `medical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `ear_nose_throat_disorders` tinyint(1) DEFAULT NULL,
  `heart_conditions_high_blood_pressure` tinyint(1) DEFAULT NULL,
  `cardiologist` varchar(255) DEFAULT NULL,
  `respiratory_tuberculosis_asthma` tinyint(1) DEFAULT NULL,
  `last_date_to_use_inhaler` date DEFAULT NULL,
  `digestive_stomach` tinyint(1) DEFAULT NULL,
  `hepatitis_liver_disease` tinyint(1) DEFAULT NULL,
  `urinary_kidney_utis_kidney_stones_renal_disorders` tinyint(1) DEFAULT NULL,
  `breasts_implants_fibrocystic_disease_lumpectomy_etc` varchar(255) DEFAULT NULL,
  `muscle_or_bone_problems` tinyint(1) DEFAULT NULL,
  `neurologic_migraines_frequent_headaches` tinyint(1) DEFAULT NULL,
  `psychiatric_depression_anxiety_mood_disorder` tinyint(1) DEFAULT NULL,
  `diabetes` tinyint(1) DEFAULT NULL,
  `on_insulin_or_oral_medication` tinyint(1) DEFAULT NULL,
  `thyroid` tinyint(1) DEFAULT NULL,
  `have_you_ever_had_a_blood_transfusion` tinyint(1) DEFAULT NULL,
  `would_you_accept_a_blood_transfusion` tinyint(1) DEFAULT NULL,
  `anemia` tinyint(1) DEFAULT NULL,
  `bleeding_disorder_blood_clots_varicose_veins` tinyint(1) DEFAULT NULL,
  `skin_disorders` tinyint(1) DEFAULT NULL,
  `did_you_have_chicken_pox_as_a_child` tinyint(1) DEFAULT NULL,
  `did_you_have_chicken_pox_as_an_adult` tinyint(1) DEFAULT NULL,
  `did_you_have_the_chicken_pox_vaccine` tinyint(1) DEFAULT NULL,
  `genital_herpes` tinyint(1) DEFAULT NULL,
  `genital_herpes_self_partner` varchar(255) DEFAULT NULL,
  `genital_herpes_last_outbreak` date DEFAULT NULL,
  `gonorrhea_chlamydia_syphilis` tinyint(1) DEFAULT NULL,
  `gonorrhea_chlamydia_syphilis_date_treated` date DEFAULT NULL,
  `partner_treated` varchar(255) DEFAULT NULL,
  `hpv_genital_warts` tinyint(1) DEFAULT NULL,
  `other_stds_hiv` tinyint(1) DEFAULT NULL,
  `gyn_disorders_endometriosis_polycystic_ovarian_syndrome_etc` varchar(255) DEFAULT NULL,
  `ever_had_an_abnormal_pap_smear` tinyint(1) DEFAULT NULL,
  `last_pap_smear` date DEFAULT NULL,
  `normal_abnormal` varchar(255) DEFAULT NULL,
  `ever_had_cryo_leep_conization_of_cervix` tinyint(1) DEFAULT NULL,
  `infertility_clomid_in_vitro_fertilization` tinyint(1) DEFAULT NULL,
  `this_pregnancy_previous_pregnancy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `medical` */

insert  into `medical`(`id`,`patient_id`,`ear_nose_throat_disorders`,`heart_conditions_high_blood_pressure`,`cardiologist`,`respiratory_tuberculosis_asthma`,`last_date_to_use_inhaler`,`digestive_stomach`,`hepatitis_liver_disease`,`urinary_kidney_utis_kidney_stones_renal_disorders`,`breasts_implants_fibrocystic_disease_lumpectomy_etc`,`muscle_or_bone_problems`,`neurologic_migraines_frequent_headaches`,`psychiatric_depression_anxiety_mood_disorder`,`diabetes`,`on_insulin_or_oral_medication`,`thyroid`,`have_you_ever_had_a_blood_transfusion`,`would_you_accept_a_blood_transfusion`,`anemia`,`bleeding_disorder_blood_clots_varicose_veins`,`skin_disorders`,`did_you_have_chicken_pox_as_a_child`,`did_you_have_chicken_pox_as_an_adult`,`did_you_have_the_chicken_pox_vaccine`,`genital_herpes`,`genital_herpes_self_partner`,`genital_herpes_last_outbreak`,`gonorrhea_chlamydia_syphilis`,`gonorrhea_chlamydia_syphilis_date_treated`,`partner_treated`,`hpv_genital_warts`,`other_stds_hiv`,`gyn_disorders_endometriosis_polycystic_ovarian_syndrome_etc`,`ever_had_an_abnormal_pap_smear`,`last_pap_smear`,`normal_abnormal`,`ever_had_cryo_leep_conization_of_cervix`,`infertility_clomid_in_vitro_fertilization`,`this_pregnancy_previous_pregnancy`) values 
(1,NULL,0,0,'09',0,'2024-10-09',0,0,0,'0',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'094545','2024-10-09',0,'2024-10-09','0',0,0,'0',0,'2024-10-09','NORMAL',0,9,'09'),
(2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,NULL,0,0,'hello',0,'2025-09-10',0,0,0,'0',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'HELLO','2024-10-21',0,'2024-09-10','0',0,0,'0',0,'2024-06-09','abnormal',0,0,'kahapon lng');

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
  PRIMARY KEY (`id`),
  KEY `fk_custom_id` (`custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `registration` */

insert  into `registration`(`id`,`patient_id`,`philhealth_id`,`name`,`mname`,`lname`,`marital_status`,`husband_phone`,`patient_contact_no`,`birthday`,`address`,`age`,`husband`,`occupation`,`no_of_pregnancy`,`last_menstrual`,`age_gestation`,`expected_date_confinement`,`is_deleted`,`custom_id`) values 
(1,0,'8654654658','christina','hito','sagad','single','N/A','4845655646','2000-08-03','calle malabo',24,'N/A','N/A',4,'2020-10-09',2,'2004-09-05',0,'MCH63017528'),
(2,0,'04458746465','CHRISTINA','HITO','SAGAD','single','N/A','09745412646','2000-09-10','TANDANG SORA QUEZON CITY',23,'N/A','N/A',1,'2024-10-09',23,'2025-10-09',0,'MCH09176423'),
(3,0,'545648978','nicole','gan','de guzman','married','N/A','98765432100','2001-08-18','DYAN LANG',23,'mr. bean','N/A',24,'2024-08-20',37,'2027-08-22',0,'MCH87329164');

/*Table structure for table `scheduling_settings` */

DROP TABLE IF EXISTS `scheduling_settings`;

CREATE TABLE `scheduling_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(10) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `scheduling_settings` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `open_days` varchar(255) NOT NULL,
  `open_hours` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`firstname`,`lastname`,`birthday`,`mobile`,`password`,`created_at`,`user_level`,`username`) values 
(1,'admin@admin.com','christina','sagad','2024-09-10','09750019708','$2y$10$yr0XKt6d0fPzAa/.04b0Nu3Tej9DjBbdRbmxEYG5Ku/KORgsGNJXO','2024-08-03 13:18:27','admin',''),
(2,'sagad@gmail.com','christina','sagad','2000-06-16','091048487454','$2y$10$CldfyL8onBJYvzomClLkHu7yr08sSr/q54uFcMjdSJK75n1/yeR52','2024-08-17 13:26:04','user','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
