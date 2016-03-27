<?php
//register.php

require_once 'global.inc.php';

//initialize php variables used in the form

$password = "";
$password_confirm = "";
$email = "";
$error = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

    //retrieve the $_POST variables
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $year = $_POST['year'];
    $faculty = $_POST['faculty'];
    $degree = $_POST['degree'];
    $lastName = $_POST['lastName'];
    $password_confirm = $_POST['password-confirm'];

    //initialize variables for form validation
    $success = true;
    $userTools = new UserTools();

    //validate that the form was filled out correctly
    //check to see if user name already exists

    //check to see if passwords match
    if($password != $password_confirm) {
        $error .= "Passwords do not match.<br/> \n\r";
        $success = false;
    }

    if($success)
    {
        //prep the data for saving in a new user object
        $data['email'] = $email;
        $data['firstName'] = $firstName;
        $data['lastName'] = $lastName;
        $data['year'] = $year;
        $data['faculty'] = $faculty;
        $data['degree'] = $degree;
        $data['lastName'] = $lastName;
        $data['password'] = md5($password); //encrypt the password for storage

        //create the new user object
        $newUser = new User($data);

        //save the new user to the database
        $newUser->save(true);

        //log them in
        $userTools->login($email, $password);

        //redirect them to a welcome page
        header("Location: profile.php");

    }

}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <?php echo ($error != "") ? $error : ""; ?>
    <form action="register.php" method="post">
    E-Mail: <input type="text" value="<?php echo $email; ?>" name="email" /><br/>
    First Name: <input type='text' name='firstName' id='firstName'  value="<?php echo $firstName; ?>" /><br/>
    Last Name: <input type='text' name='lastName' id='lastName'  value="<?php echo $lastName; ?>"/><br/>
    Year: <input type='text' name='year' id='year'  value="<?php echo $year; ?>"/><br/>
    Faculty: <input type='text' name='faculty' id='faculty'  value="<?php echo $faculty; ?>"/><br/>
    Degree: <input type='text' name='degree' id='degree'  value"<?php echo $email; ?>" /><br/>
    Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>
    Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>
    <input type="submit" value="Register" name="submit-form" />
    </form>
</body>
</html>