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
    mysqli_query($cxn, "DROP table Comment;");
    mysqli_query($cxn, "DROP table Booking;");
    mysqli_query($cxn, "DROP table Phone_Number;");
    mysqli_query($cxn, "DROP table Points_Of_Interest;");
    mysqli_query($cxn, "DROP table Features;");
    mysqli_query($cxn, "DROP table District;");
    mysqli_query($cxn, "DROP table Property;");
    mysqli_query($cxn, "DROP table Member;");

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


mysqli_query($cxn,"INSERT INTO `qbnb`.`Member` 
  (`member_id`, `email`, `password`, `FName`, `LName`, `year`, `faculty`, `degree`, `is_admin`, `is_deleted`) VALUES 
  ('jshimz@hotmail.com', 'itsjustshim', 'Justin', 'Shimkovitz', 2016, 'Law', 'Criminal Law', 1, DEFAULT),
  ('coolboyjulez@queensu.ca', 'jwill', 'Julian', 'Wilson', 2016, 'Commerce', 'Finance', 1, 0),
  ('jcisgod@gmail.com', 'jacjacjac', 'Jacqueline', 'Craig', 2016, 'Engineering', 'Applied Math', 1, 0),
  ('fakeemail@hotmail.com', 'animals', 'John', 'Stewart', 2018, 'Science', 'Biology', 0, 0),
  ('potus@gmail.com', 'password', 'Barack', 'Obama', 2019, 'Arts', 'English', 0, 0)
  ('potus2@gmail.com', 'password2', 'Barack2', 'Obama2', 2017, 'Arts', 'English', 0, 0),
  ('potus3@gmail.com', 'password3', 'Barack3', 'Obama3', 2016, 'Arts', 'English', 0, 0),
  ('potus4@gmail.com', 'password4', 'Barack4', 'Obama4', 2015, 'Arts', 'English', 0, 0)
  ");

mysqli_query($cxn,"INSERT INTO `qbnb`.`District` (`district_name`, `Street_1`, `Street_2`) VALUES
  ('Uptown', 'Bathurst', 'Steeles'),
  ('Waterfront', 'Front', 'Spadina'),
  ('Rosedale', 'St. Clair', 'Oak'),
  ('Chinatown', 'Spadina', 'Queen'),
  ('Midtown', 'Bathurst', 'Eglinton')
 ");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Property` 
  (`address`, `number_of_rooms`, `room_type`, `price`, `is_deleted`, `owner_id`, `district_id`) VALUES 
  ('123 Maple Street', 4, 'House', 600, 0, 1, 1),
  ('136 Oak Drive', 3, 'House', 200, 0, 1, 4),
  ('1 Front Street', 1, 'Apartment', 1000, 0, 2, 2),
  ('12 Wall Avenue', 2, 'Condo', 750, 0, 5, 2),
  ('10 Martin Lane', 2, 'Apartment', 500, 0, 3, 4),
  ('102 Martin Lane', 3, 'Apartment', 300, 0, 6, 4),
  ('103 Martin Lane', 4, 'Condo', 200, 0, 7, 4),
  ('104 Martin Lane', 5, 'Apartment', 300, 0, 2, 4),
  ('105 Martin Lane', 2, 'House', 100, 0, 5, 4),
  ('14 Martin Lane', 3, 'Apartment', 200, 0, 8, 4),
  ('12 Martin Lane', 2, 'Apartment', 300, 0, 6, 4)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Booking` 
(`status`, `start_date`, `is_deleted`, `booking_member_id`, `property_id`) VALUES 
('Confirmed', '2015-05-06', 0, 2, 1),
('Deleted', '2015-05-06', 0, 2, 2),
('Denied', '2015-05-08', 0, 3, 1),
('Unconfirmed', '2015-05-09', 0, 4, 2),
('Confirmed', '2015-08-04', 0, 1, 3),
('Unconfirmed','2014-11-01', 0, 1, 2),
('Denied','2014-11-18', 0, 1, 6),
('Confirmed','2014-12-01', 0, 4, 7),
('Unconfirmed','2014-12-23', 0, 2, 3),
('Confirmed','2015-08-27', 0, 4, 8),
('Confirmed','2015-12-23', 0, 7, 9),
('Unconfirmed','2016-02-25', 0, 7, 10),
('Confirmed','2016-02-28', 0, 3, 11),
('Unconfirmed','2016-05-19', 0, 4, 1),
('Unconfirmed','2016-09-06', 0, 3, 2),
('Denied','2016-09-23', 0, 3,3),
('Confirmed','2016-11-02', 0, 3, 5),
('Confirmed','2016-11-07', 0, 4, 7),
('Denied','2017-05-24', 0, 2, 9),
('Unconfirmed','2017-06-29', 0, 8, 11),
('Confirmed','2017-07-06', 0, 4, 2),
('Unconfirmed','2017-08-21', 0, 4, 5),
('Denied','2017-11-07', 0, 5, 4),
('Confirmed','2018-01-10', 0, 2, 6),
('Denied','2018-04-20', 0, 7, 8),
('Confirmed','2018-05-12', 0, 4, 10),
('Denied','2018-06-07', 0, 2, 7),
('Unconfirmed','2018-08-12', 0, 1, 2),
('Denied','2018-09-14', 0, 1, 7),
('Unconfirmed','2018-11-09', 0, 1, 2)");


mysqli_query($cxn,"INSERT INTO `qbnb`.`Phone_Number` 
  (`phone_number`, `member_id`) VALUES 
  ('905-881-4432', 1),
  ('416-543-1234', 1),
  ('416-543-1233', 6),
  ('789-087-5432', 2),
  ('818-987-4324', 3),
  ('123-456-7867', 3),
  ('453-235-4433', 4),
  ('323-655-6666', 5),
  ('323-655-1236', 7),
  ('323-655-6666', 7),
  ('323-655-6667', 8),
  ('313-655-6667', 3),
  ('323-633-6667', 6),
  ('323-633-6167', 8)
  ");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Points_Of_Interest` (`points_of_interest`, `district_id`) 
  VALUES ('C.N. Tower', 2),
  ('Beach', 2),
  ('R.O.M.', 3),
  ('Concert Hall', 1),
  ('Bell Movie Theatre', 4),
  ('Honest Eds', 5)
  ");



mysqli_query($cxn,"INSERT INTO `qbnb`.`Feature` (`feature`, `property_id`) VALUES 
('2 Bathrooms', 1),
('1 Bathroom', 2),
('Pool', 2),
('Backyard', 3),
('Pool', 4),
('Gym', 5),
('2 Bathrooms', 6),
('1 Bathroom', 7),
('Pool', 7),
('Backyard', 9),
('Pool', 9),
('Gym', 10),
('Queen Beds', 10),
('Queen Beds', 11),
('Queen Beds', 1)");

mysqli_query($cxn,"INSERT INTO `qbnb`.`Comment` (`text`, `Rating`, `Date`, `is_deleted`, `commenting_member_id`, `property_id`) VALUES 
  ('Great place! Slightly dirty, but nothing unmanageable', 4, '2015-05-05', 0, 5, 1),
  ('Thanks for your feedback! Ill make sure to get that fixed', NULL, '2015-05-06', 0, 1, 1),
  ('Terrible. Really terrifying area of town and nothing near it worth seeing. Would not recommend.', 1, '2016-01-03', 0, 4, 3)
  ('Awesome Job, I would definietly stay here again!',4,'2016-06-07',0 , 1, 1),
  ('This was alright, not going to be here again',2,'2013-10-23', 0, 2, 2),
  ('Really liked the light in this place!',4,'2013-10-26', 0, 2, 3),
  ('Awesome Job, I would definietly stay here again!',4,'2014-01-28',0 , 3, 4),
  ('So many points of interest around here!',4,'2014-02-23', 0, 4, 4),
  ('I love the Qbnb app',5,'2014-04-10', 0, 6, 5),
  ('Awesome Job, I would definietly stay here again!',4,'2014-05-13',0 , 3, 6),
  ('Had a great time!',5,'2014-08-17', 0, 5, 6),
  ('Shouldnt have gone here',3,'2014-09-12', 0, 7, 7),
  ('I love the Qbnb app',5,'2014-10-17', 0, 6, 7),
  ('This was alright, not going to be here again',2,'2014-11-23', 0, 5, 7),
  ('Awesome Job, I would definietly stay here again!',4,'2015-02-24',0 , 3, 9),
  ('So many points of interest around here!',4,'2015-06-17', 0, 5, 8),
  ('Really liked the light in this place!',4,'2015-08-03', 0, 4, 8),
  ('Had a great time!',5,'2015-08-05', 0, 7, 1),
  ('Shouldnt have gone here',3,'2015-08-09', 0, 1, 3),
  ('So many points of interest around here!',4,'2015-08-31', 0, 6, 5),
  ('Awesome Job, I would definietly stay here again!',4,'2015-10-03',0 , 6, 11),
  ('Really liked the light in this place!',4,'2015-10-26', 0, 9, 2),
  ('So many points of interest around here!',4,'2015-12-20', 0, 4, 4),
  ('This was alright, not going to be here again',2,'2016-03-20', 0, 6, 8),
  ('Awesome Job, I would definietly stay here again!',4,'2016-05-18', 0, 7, 10),
  ('Had a great time!',5,'2016-05-21', 0, 8, 4),
  ('Shouldnt have gone here',3,'2016-07-30', 0, 2, 7),
  ('Awesome Job, I would definietly stay here again!',4,'2016-08-02', 0, 8, 9),
  ('This was alright, not going to be here again',2,'2016-10-20', 0, 3, 5)

  ");
  
mysqli_close($cxn); 

?>
</body></html>
