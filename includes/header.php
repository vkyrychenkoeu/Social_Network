<?php 
require 'config.php';

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query );
}else{
    header("Location: register.php");
}

?>

<html>
<head>
    <title>MySocial Network</title>

    <script src="https://kit.fontawesome.com/e0a3814b58.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
      
    <link rel="stelesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">   
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    

</head>
<body>


  <div class="top_bar">
      <div class="logo">
        <a href="index.php">MySocial</a>
      </div>

    <nav>
      <a href="<?php echo $userLoggedIn; ?>">
        <?php 
        echo $user['first_name'];
        ?>
      </a>
      <a href="index.php" title="Home page"> <i class="fas fa-house-user"></i></a>
      <a href="#" title="Message"> <i class="fas fa-envelope"></i>  </a>
      <a href="#" title="Notifications"> <i class="fas fa-bell"></i>  </a>
      <a href="#" title="Friends"> <i class="fas fa-user-friends"></i></a> 
      <a href="#" title="Settings"> <i class="fas fa-cog"></i>   </a>
      
      
    </nav>

  </div>


  <div class="wrapper">