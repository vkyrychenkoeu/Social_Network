<?php

$fname = ""; //First NAME
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email2
$password = ""; //password
$password2 = ""; //password2
$date = ""; // Siqn up date
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){
    //Registretion form values

    //First Name
    $fname = strip_tags($_POST['reg_fname']); //usuwa tags html z formy
    $fname = str_replace(' ', '', $fname); // usuwa spacje z formy
    $fname = ucfirst(strtolower($fname)); // Uppercase first letter
    $_SESSION['reg_fname'] = $fname; // Stores first name into session 
    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //usuwa tags html z formy
    $lname = str_replace(' ', '', $lname); // usuwa spacje z formy
    $lname = ucfirst(strtolower($lname)); // Uppercase first letter
    $_SESSION['reg_lname'] = $lname; // Stores last name into session 
    //Email
    $em = strip_tags($_POST['reg_email']); //usuwa tags html z formy
    $em = str_replace(' ', '', $em); // usuwa spacje z formy 
    $_SESSION['reg_email'] = $em; // Stores password into session 
    //Email2
    $em2 = strip_tags($_POST['reg_email2']); //usuwa tags html z formy
    $em2 = str_replace(' ', '', $em2); // usuwa spacje z formy
    $_SESSION['reg_email2'] = $em2; //stores email2
    //Password
    $password = strip_tags($_POST['reg_password']); //usuwa tags html z formy 

    //Password2
    $password2 = strip_tags($_POST['reg_password2']); //usuwa tags html z formy
    
    $date = date("Y-m-d"); //Dzisiejsza data

    if($em == $em2){
        //Check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){

            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //Check if email already exist

            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

            //Count the number of rows returned 
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
                array_push($error_array, "Email already exist<br>");
            }
        
        } else{
            array_push($error_array, "Invalid format<br>");
        }

    } else{
        array_push($error_array, "Emails don't match, please try again!!<br>");
    }


    if(strlen($fname) > 30 || strlen($fname) < 2){
        array_push($error_array, "Your first name must be between 2 and 30 character<br>");
    }
    
    if(strlen($lname) > 30 || strlen($lname) < 2){
        array_push($error_array, "Your last name must be between 2 and 30 characters<br>");
    }

    if($password != $password2){
        array_push($error_array, "Your passwords do not match<br>");
    } else{
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($error_array, "Your password can only contain english characters<br>");
        }
    }

    if(strlen($password > 30 || strlen($password) < 5)){
        array_push($error_array, "Your password must be between 5 and 30 characters!<br>");
    }


    if(empty($error_array)){
        $password = md5($password); // Encrypt password befor sendong to datbase
        
        $username = strtolower($fname . "_" .$lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='username'");

        $i = 0;
        // if username exist add namber to username

        while(mysqli_num_rows($check_username_query) != 0){
            $i++; //add 1 to i
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='username'");

        }


        // Profile Picture assigment 

        $rand = rand(1, 2); 

        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/default/head_deep_blue.png";
        else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/default/head_red.png";
        
    

        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date',  '$profile_pic', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #14C800;'> You're all set! Go ahead and login!</span><br>");


        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
     
    

    }

}
?>