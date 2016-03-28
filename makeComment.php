<?php
//book.php

require_once 'global.inc.php';

//initialize php variables used in the form

$status = "";
$start_date = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

    //retrieve the $_POST variables
    $text = $_POST['text'];
    $rating = $_POST['rating'];
    

    //initialize variables for form validation
    //$success = true;
    $CommentTools = new Commenttools();

        $data['text'] = $text;
        $data['rating'] = $rating;
        $data['property_id'] = $_SESSION['property_id'];
        $member = unserialize($_SESSION['member_id']);
        $data['commenting_member_id'] = $member->member_id;
        //create the new Comment object
        $newComment = new Comment($data);

        //save the new user to the database
        $newComment->save(true);

        //redirect them to a welcome page
        header("Location: propertyInfo.php");

    //}

}

if(isset($_POST['cancel-reg'])) { 
    header("Location: propertyInfo.php");
} 

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
<html>
<head>
    <title>Qbnb | Comment on Property</title>
</head>
<body>
    <h1>Make a comment</h1>
    <?php //echo ($error != "") ? $error : ""; ?>
    <form action="makeComment.php" method="post">
    Comment: <input type='text' name='text' id='text' /><br/>
    Rating: <select name="rating">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
    <br/>
    <input type="submit" value="Comment" name="submit-form" />
    <input type="submit" value="Cancel" name="cancel-reg" />
    </form>
</body>
</html>