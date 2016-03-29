<?php
//book.php

require_once 'global.inc.php';

//initialize php variables used in the form

$status = "";
$start_date = "";
$message = "";
//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 
    
    //retrieve the $_POST variables
    $start_date = $_POST['start_date'];
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$start_date)){
        //initialize variables for form validation
        $bookingTools = new Bookingtools();
        //prep the data for saving in a new user object
        $data['start_date'] = $start_date;
        $data['property_id'] = $_SESSION['property_id'];
        $member = unserialize($_SESSION['member_id']);
        $data['booking_member_id'] = $member->member_id;
        //create the new booking object
        $newBooking = new Booking($data);

        //save the new user to the database
        $newBooking->save(true);

        //redirect them to a welcome page
        header("Location: propertyInfo.php");
    } else {
        $message = "Invalid date!";
    }
   
}

if(isset($_POST['cancel-reg'])) { 
    header("Location: propertyInfo.php");
} 

?>
<html>
<head>
    <title>Qbnb | Book Property</title>
</head>
<body>
    <?php echo $message; ?>
    <h1>Book a Property</h1>
    <form action="Book.php" method="post">
    Start Date (YYYY-MM-DD): <input type='date' name='start_date' id='start_date' /><br/>
    <input type="submit" value="Book" name="submit-form" />
    <input type="submit" value="Cancel" name="cancel-reg" />
    </form>
</body>
</html>