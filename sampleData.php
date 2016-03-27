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


mysqli_query($cxn,"INSERT INTO `qbnb`.`Member` (`member_id`, `email`, `password`, `FName`, `LName`, `year`, `faculty`, `degree`, `is_admin`, `is_deleted`) VALUES (1, 'jshimz@hotmail.com', 'itsjustshim', 'Justin', 'Shimkovitz', 2016, 'Law', 'Criminal Law', 1, DEFAULT)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Member` (`member_id`, `email`, `password`, `FName`, `LName`, `year`, `faculty`, `degree`, `is_admin`, `is_deleted`) VALUES (2, 'coolboyjulez@queensu.ca', 'jwill', 'Julian', 'Wilson', 2016, 'Commerce', 'Finance', 1, 0)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Member` (`member_id`, `email`, `password`, `FName`, `LName`, `year`, `faculty`, `degree`, `is_admin`, `is_deleted`) VALUES (3, 'jcisgod@gmail.com', 'jacjacjac', 'Jacqueline', 'Craig', 2016, 'Engineering', 'Applied Math', 1, 0)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Member` (`member_id`, `email`, `password`, `FName`, `LName`, `year`, `faculty`, `degree`, `is_admin`, `is_deleted`) VALUES (4, 'fakeemail@hotmail.com', 'animals', 'John', 'Stewart', 2018, 'Science', 'Biology', 0, 0)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Member` (`member_id`, `email`, `password`, `FName`, `LName`, `year`, `faculty`, `degree`, `is_admin`, `is_deleted`) VALUES (5, 'potus@gmail.com', 'password', 'Barack', 'Obama', 2019, 'Arts', 'English', 0, 0)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`District` (`district_id`, `district_name`, `Street_1`, `Street_2`) VALUES (1, 'Uptown', 'Bathurst', 'Steeles')");
mysqli_query($cxn,"INSERT INTO `qbnb`.`District` (`district_id`, `district_name`, `Street_1`, `Street_2`) VALUES (2, 'Waterfront', 'Front', 'Spadina')");
mysqli_query($cxn,"INSERT INTO `qbnb`.`District` (`district_id`, `district_name`, `Street_1`, `Street_2`) VALUES (3, 'Rosedale', 'St. Clair', 'Oak')");
mysqli_query($cxn,"INSERT INTO `qbnb`.`District` (`district_id`, `district_name`, `Street_1`, `Street_2`) VALUES (4, 'Chinatown', 'Spadina', 'Queen')");
mysqli_query($cxn,"INSERT INTO `qbnb`.`District` (`district_id`, `district_name`, `Street_1`, `Street_2`) VALUES (5, 'Midtown', 'Bathurst', 'Eglinton')");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Property` (`property_id`, `address`, `number_of_rooms`, `room_type`, `price`, `is_deleted`, `owner_id`, `district_id`) VALUES (1, '123 Maple Street', 4, 'House', 600, 0, 1, 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Property` (`property_id`, `address`, `number_of_rooms`, `room_type`, `price`, `is_deleted`, `owner_id`, `district_id`) VALUES (2, '136 Oak Drive', 3, 'House', 200, 0, 1, 4)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Property` (`property_id`, `address`, `number_of_rooms`, `room_type`, `price`, `is_deleted`, `owner_id`, `district_id`) VALUES (3, '1 Front Street', 1, 'Apartment', 1000, 0, 2, 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Property` (`property_id`, `address`, `number_of_rooms`, `room_type`, `price`, `is_deleted`, `owner_id`, `district_id`) VALUES (4, '12 Wall Avenue', 2, 'Condo', 750, 0, 5, 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Property` (`property_id`, `address`, `number_of_rooms`, `room_type`, `price`, `is_deleted`, `owner_id`, `district_id`) VALUES (5, '10 Martin Lane', 2, 'Apartment', 500, 0, 3, 4)");


mysqli_query($cxn,"INSERT INTO `qbnb`.`Booking` (`booking_id`, `status`, `start_date`, `is_deleted`, `booking_member_id`, `property_id`) VALUES (1, 'Confirmed', '2015-05-06', 0, 2, 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Booking` (`booking_id`, `status`, `start_date`, `is_deleted`, `booking_member_id`, `property_id`) VALUES (2, 'Deleted', '2015-05-06', 0, 2, 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Booking` (`booking_id`, `status`, `start_date`, `is_deleted`, `booking_member_id`, `property_id`) VALUES (3, 'Denied', '2015-05-08', 0, 3, 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Booking` (`booking_id`, `status`, `start_date`, `is_deleted`, `booking_member_id`, `property_id`) VALUES (4, 'Unconfirmed', '2015-05-09', 0, 4, 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Booking` (`booking_id`, `status`, `start_date`, `is_deleted`, `booking_member_id`, `property_id`) VALUES (5, 'Confirmed', '2015-08-04', 0, 1, 3)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('905-881-4432', 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('416-543-1234', 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('416-543-1233', 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('789-087-5432', 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('818-987-4324', 3)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('123-456-7867', 3)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('453-235-4433', 4)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` (`phone_number`, `member_id`) VALUES ('323-655-6666', 5)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Points_Of_Interest` (`points_of_interest`, `district_id`) VALUES ('C.N. Tower', 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Points_Of_Interest` (`points_of_interest`, `district_id`) VALUES ('Beach', 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Points_Of_Interest` (`points_of_interest`, `district_id`) VALUES ('R.O.M.', 3)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Points_Of_Interest` (`points_of_interest`, `district_id`) VALUES ('Concert Hall', 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Points_Of_Interest` (`points_of_interest`, `district_id`) VALUES ('Bell Movie Theatre', 4)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Feature` (`feature_id`, `feature`, `property_id`) VALUES (1, '2 Bathrooms', 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Feature` (`feature_id`, `feature`, `property_id`) VALUES (2, 'Big Backyard', 3)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Feature` (`feature_id`, `feature`, `property_id`) VALUES (3, 'Pool', 4)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Feature` (`feature_id`, `feature`, `property_id`) VALUES (4, 'Pool', 2)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Feature` (`feature_id`, `feature`, `property_id`) VALUES (5, 'Queen Beds', 1)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Comment` (`comment_id`, `text`, `Rating`, `Date`, `is_deleted`, `commenting_member_id`, `property_id`) VALUES (1, 'Great place! Slightly dirty, but nothing unmanageable', 4, '2015-05-05', 0, 5, 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Comment` (`comment_id`, `text`, `Rating`, `Date`, `is_deleted`, `commenting_member_id`, `property_id`) VALUES (2, 'Thanks for your feedback! I\'ll make sure to get that fixed', NULL, '2015-05-06', 0, 1, 1)");
mysqli_query($cxn,"INSERT INTO `qbnb`.`Comment` (`comment_id`, `text`, `Rating`, `Date`, `is_deleted`, `commenting_member_id`, `property_id`) VALUES (3, 'Terrible. Really terrifying area of town and nothing near it worth seeing. Would not recommend.', 1, '2016-01-03', 0, 4, 3)");

 mysqli_close($cxn); 

?>
</body></html>
