<html>
<head><title>Part 1 Sample Data</title>
Load Data
<br>Jacqueline Craig, 10043961</br>
<br>Justin Shimkovitz, 10048941</br>
<br>Julian Wilson, 10053506</br>
</head>
<body>

<?php

 $host = "localhost";
 $user = "Assignment1";
 $password = "cmpe332!";
 $database = "qbnb";

 $cxn = mysqli_connect($host,$user,$password, $database);
 if (mysqli_connect_error())
  {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create the Member table
mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Member` (
  `member_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `FName` CHAR(20) NOT NULL,
  `LName` CHAR(20) NOT NULL,
  `year` INT NOT NULL,
  `faculty` VARCHAR(45) NOT NULL,
  `degree` VARCHAR(15) NOT NULL,
  `is_admin` TINYINT(1) NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`member_id`));");

mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`District` (
  `district_id` INT NOT NULL AUTO_INCREMENT,
  `district_name` VARCHAR(45) NOT NULL,
  `Street_1` VARCHAR(45) NOT NULL,
  `Street_2` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `district_name_UNIQUE` (`district_name` ASC),
  PRIMARY KEY (`district_id`))");



mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Property` (
  `property_id` INT NOT NULL AUTO_INCREMENT,
  `address` VARCHAR(45) NOT NULL,
  `number_of_rooms` INT NOT NULL,
  `room_type` VARCHAR(45) NOT NULL,
  `price` INT NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  `owner_id` INT NOT NULL,
  `district_id` INT NOT NULL,
  PRIMARY KEY (`property_id`),
  INDEX `fk_Property_Member1_idx` (`owner_id` ASC),
  INDEX `fk_Property_District1_idx` (`district_id` ASC),
  CONSTRAINT `fk_Property_Member1`
    FOREIGN KEY (`owner_id`)
    REFERENCES `qbnb`.`Member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Property_District1`
    FOREIGN KEY (`district_id`)
    REFERENCES `qbnb`.`District` (`district_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Booking` (
  `booking_id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  `start_date` DATE NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  `booking_member_id` INT NOT NULL,
  `property_id` INT NOT NULL,
  PRIMARY KEY (`booking_id`),
  INDEX `fk_Booking_Member1_idx` (`booking_member_id` ASC),
  INDEX `fk_Booking_Property1_idx` (`property_id` ASC),
  CONSTRAINT `fk_Booking_Member1`
    FOREIGN KEY (`booking_member_id`)
    REFERENCES `qbnb`.`Member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Booking_Property1`
    FOREIGN KEY (`property_id`)
    REFERENCES `qbnb`.`Property` (`property_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Comment` (
  `comment_id` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(140) NOT NULL,
  `Rating` INT NULL,
  `Date` DATE NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  `commenting_member_id` INT NOT NULL,
  `property_id` INT NOT NULL,
  PRIMARY KEY (`comment_id`),
  INDEX `fk_Comment_Member1_idx` (`commenting_member_id` ASC),
  INDEX `fk_Comment_Property1_idx` (`property_id` ASC),
  CONSTRAINT `fk_Comment_Member1`
    FOREIGN KEY (`commenting_member_id`)
    REFERENCES `qbnb`.`Member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_Property1`
    FOREIGN KEY (`property_id`)
    REFERENCES `qbnb`.`Property` (`property_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Phone_Number` (
  `phone_number` CHAR(13) NOT NULL,
  `member_id` INT NOT NULL,
  PRIMARY KEY (`phone_number`),
  INDEX `fk_Phone_Number_Member1_idx` (`member_id` ASC),
  CONSTRAINT `fk_Phone_Number_Member1`
    FOREIGN KEY (`member_id`)
    REFERENCES `qbnb`.`Member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Points_Of_Interest` (
  `points_of_interest` VARCHAR(45) NOT NULL,
  `district_id` INT NOT NULL,
  INDEX `fk_Points_Of_Interest_District1_idx` (`district_id` ASC),
  CONSTRAINT `fk_Points_Of_Interest_District1`
    FOREIGN KEY (`district_id`)
    REFERENCES `qbnb`.`District` (`district_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `qbnb`.`Feature` (
  `feature_id` INT NOT NULL AUTO_INCREMENT,
  `feature` VARCHAR(45) NOT NULL,
  `property_id` INT NOT NULL,
  PRIMARY KEY (`feature_id`),
  INDEX `fk_Feature_Property1_idx` (`property_id` ASC),
  CONSTRAINT `fk_Feature_Property1`
    FOREIGN KEY (`property_id`)
    REFERENCES `qbnb`.`Property` (`property_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

 mysqli_close($cxn); 

?>
</body></html>
