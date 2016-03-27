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
 $database = "QBnB";

 $cxn = mysqli_connect($host,$user,$password, $database);
 if (mysqli_connect_error())
  {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Drop the tables
    mysqli_query($cxn, "DROP table Comment;");
    mysqli_query($cxn, "DROP table Booking;");
    mysqli_query($cxn, "DROP table Property;");
    mysqli_query($cxn, "DROP table District;");
    mysqli_query($cxn, "DROP table Phone_Number;");
    mysqli_query($cxn, "DROP table Points_Of_Interest;");
    mysqli_query($cxn, "DROP table Feature;");
    mysqli_query($cxn, "DROP table Member;");
echo "Tables Dropped.<br />";

// Create the Member table
mysqli_query($cxn, "CREATE Table Member (
  `email` VARCHAR(45) NOT NULL,
  `FName` CHAR(20) NOT NULL,
  `LName` CHAR(20) NOT NULL,
  `year` INT NOT NULL,
  `faculty` VARCHAR(45) NOT NULL,
  `degree` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`email`));");
echo "Members created.<br />";

// Create the District table
mysqli_query($cxn, "CREATE Table District (
  `district_name` VARCHAR(45) NOT NULL,
  `Street_1` VARCHAR(45) NOT NULL,
  `Street_2` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`district_name`));");
echo "District created.<br />";

// Create the Property table
mysqli_query($cxn, "CREATE Table Property (
  `property_id` INT NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `price` INT NOT NULL,
  `Member_email` VARCHAR(45) NULL,
  `District_district_name` VARCHAR(45) NULL,
  PRIMARY KEY (`property_id`),
  INDEX `fk_Property_Member1_idx` (`Member_email` ASC),
  INDEX `fk_Property_District1_idx` (`District_district_name` ASC),
  CONSTRAINT `fk_Property_Member1`
    FOREIGN KEY (`Member_email`)
    REFERENCES `Member` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Property_District1`
    FOREIGN KEY (`District_district_name`)
    REFERENCES `District` (`district_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);");
echo "Property created.<br />";

// Create the Booking table
mysqli_query($cxn, "CREATE Table Booking (
  `booking_id` INT NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `date` DATE NOT NULL,
  `Member_email` VARCHAR(45) NULL,
  `Property_property_id` INT NULL,
  PRIMARY KEY (`booking_id`),
  INDEX `fk_Booking_Member1_idx` (`Member_email` ASC),
  INDEX `fk_Booking_Property1_idx` (`Property_property_id` ASC),
  CONSTRAINT `fk_Booking_Member1`
    FOREIGN KEY (`Member_email`)
    REFERENCES `Member` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Booking_Property1`
    FOREIGN KEY (`Property_property_id`)
    REFERENCES `Property` (`property_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);");
echo "Booking created.<br />";

// Create the Comment table
mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `Comment` (
  `rating` INT NOT NULL,
  `text` VARCHAR(145) NOT NULL,
  `date` DATE NOT NULL,
  `reply_text` VARCHAR(145) NULL,
  `reply_date` DATE NULL,
  `Booking_booking_id` INT NOT NULL,
  PRIMARY KEY (`Booking_booking_id`),
  CONSTRAINT `fk_Comment_Booking1`
    FOREIGN KEY (`Booking_booking_id`)
    REFERENCES `Booking` (`booking_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);");
echo "Comment created.<br />";

// Create the Phone_Number table
mysqli_query($cxn, "CREATE Table Phone_Number (
  `phone_number` CHAR(10) NOT NULL,
  `Member_email` VARCHAR(45) NOT NULL,
  INDEX `fk_Phone Number_Member1_idx` (`Member_email` ASC),
  PRIMARY KEY (`phone_number`),
  CONSTRAINT `fk_Phone Number_Member1`
    FOREIGN KEY (`Member_email`)
    REFERENCES `Member` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);");
echo "Phone_Number created.<br />";

// Create the Points_Of_Interest table
mysqli_query($cxn, "CREATE Table Points_Of_Interest (
  `Points of Interest` VARCHAR(45) NOT NULL,
  `District_district_name` VARCHAR(45) NOT NULL,
  INDEX `fk_Points of Interest_District1_idx` (`District_district_name` ASC),
  PRIMARY KEY (`District_district_name`),
  CONSTRAINT `fk_Points of Interest_District1`
    FOREIGN KEY (`District_district_name`)
    REFERENCES `District` (`district_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);");
echo "Points_Of_Interest created.<br />";

// Create the Feature table
mysqli_query($cxn, "CREATE TABLE IF NOT EXISTS `Feature` (
  `feature_ID` VARCHAR(45) NOT NULL,
  `feature` VARCHAR(45) NOT NULL,
  `Property_property_id` INT NOT NULL,
  INDEX `fk_Feature_Property1_idx` (`Property_property_id` ASC),
  PRIMARY KEY (`feature_ID`),
  CONSTRAINT `fk_Feature_Property1`
    FOREIGN KEY (`Property_property_id`)
    REFERENCES `Property` (`property_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);");
echo "Feature created.<br />";

// Insert into tables
mysqli_query($cxn, "INSERT INTO Member VALUES
('jc@queensu.ca','Jacqueline','Craig','2016','Engineering and Applied Science','BSc(Eng)'), 
('eh@queensu.ca','Emily','Halprin','2018','Arts & Science','BA'), 
('js@queensu.ca','Justin','Shimkovitz','1985','Commerce','BComm'), 
('jw@queensu.ca','Julian','Wilson','1967','Compsci','BCMP');");                   
echo "Members loaded.<br />";

mysqli_query($cxn, "INSERT INTO District VALUES
('Kensington','Spadina','College'),
('Rosedale','Mt Pleasant','St Clair'),
('Annex','Front','King');");
echo "District loaded.<br />";

mysqli_query($cxn, "INSERT INTO Property VALUES
('3452','45 Union St','3 Bedrooms','100','js@queensu.ca','Annex'),
('1422','200 Johnson St','Bachelor','200','jc@queensu.ca','Rosedale'),
('8263','10 Brock St','5 Bedrooms','250','jc@queensu.ca','Kensington');");                   
echo "Property loaded.<br />";

mysqli_query($cxn, "INSERT INTO Booking VALUES 
('1001','Rejected','2015-03-08','jw@queensu.ca','1422'), 
('2335','Confirmed','2015-03-01','jw@queensu.ca','3452'),  
('7345','Requested','2015-03-01','eh@queensu.ca','8263');");               
echo "Booking loaded.<br />";

mysqli_query($cxn, "INSERT INTO Comment VALUES
('3','A++, would rent again!','2015-03-07','You rock','2015-04-08','1001'),
('2','The room was very clean, but the noise outside was terrible.','2015-04-15',NULL,NULL,'2335'),  
('5','Thank you for having me','2015-04-22','Wonderful','2015-04-23','7345');");
echo "Comment loaded.<br />";

mysqli_query($cxn, "INSERT INTO Phone_Number VALUES
('4161234567','jw@queensu.ca'),
('4169872457','jc@queensu.ca'),
('4161222438','js@queensu.ca'),
('6132332457','js@queensu.ca');");
echo "Phone_Number loaded.<br />";

mysqli_query($cxn, "INSERT INTO Points_Of_Interest VALUES
('CN Tower','Annex'),
('Seven Lives','Kensington'),
('Casa Loma','Rosedale');");
echo "Points_Of_Interest loaded.<br />";

mysqli_query($cxn, "INSERT INTO Feature VALUES
('234','Elevator','3452'),
('628','Pool','1422'),
('426','Pool','8263'),
('332','Full Kitchen','1422');");
echo "Feature loaded.<br />";

// done
// $table = mysqli_query($cxn, "SELECT * FROM Department;");
// echo "<br />The Department table:<br />";
// while($row = mysqli_fetch_assoc($table))
//     {
//         extract($row);
//         echo "$DName, $DNo $MGRSSN, $MgrStartDate<br />";
//     }

 mysqli_close($cxn); 

?>
</body></html>
