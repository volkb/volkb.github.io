<?php
    session_start();
    if(isset($_SESSION['name'])){
      $username = $_SESSION['name'];
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ardeu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <script type="text/javascript" src="../resources/validate.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="../resources/style.css" type="text/css" />
    <link rel="stylesheet" href="resources/project.css" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  </head>

<!--  Import HTML Code for header using PHP-->
<header>
  <?php include ('../resources/menubar.php');
    if(isset($_SESSION['name'])){
      print_r("<li id='profilebutton'><a href='../profile/profile.php'>" . $username . "</a>");
      print_r("<li><a href='../resources/logout.php'>Log out</a>");
    }
    else{
      print_r("<li id='loginbutton'><a href='../resources/login.php'>Login</a></li><li id='signupbutton'><a href='../resources/signup.php'>Sign Up</a></li></ul>");
    }?>
</header>


  <body>

  <br>
  <center><h2>Project Search will be coming soon!</h2></center>

  <footer>© Copyright 2017, RPI | Ardeu</footer>

  </div>
  </body>


</html>
