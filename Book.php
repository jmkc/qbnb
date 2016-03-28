<?php
//book.php

require_once 'global.inc.php';

//initialize php variables used in the form

$status = "";
$start_date = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 
    
    //retrieve the $_POST variables
    $start_date = $_POST['start_date'];
    // if ($start_date = )
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
}

if(isset($_POST['cancel-reg'])) { 
    header("Location: propertyInfo.php");
} 

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
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