CREATE DATABASE inpulse_test;
 
USE inpulse_test;
 
CREATE TABLE IF NOT EXISTS `people` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_name` varchar(50) DEFAULT NULL,
  `person_email` varchar(40) NOT NULL,
  `person_telephone` varchar(40) NOT NULL,
  `person_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`person_id`)
);