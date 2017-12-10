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
  <div id="bodyBlock">

    <?php
      @ $db = new mysqli('localhost', 'PHPbot', 'BigRedDog123!', 'iit');

      if ($db->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
      }


      //Check if the user is logged in
      if(isset($_SESSION['name'])){

        //find the UUID of the user, and get their PID
        $uuid = $_SESSION["uuid"];
        $command = "select pid from users where UUID = " . $uuid;
        $output = $db->query($command);
        $final = $output->fetch_assoc();
        $pid = $final['pid'];

        //Query the database for projects with matching PID
        $query = "select * from projects where pid = " . $pid;
        $line = $db->query($query);



        #If the user has a PID, output HTML with their information
        if( gettype($line) == "object"){
          $result = $line->fetch_assoc();
          echo'<h1>' . $result['name'] . '</h1>';
          echo '<img id="companyLogo" src="' . $result['logo'] . '"/><br>';
          echo '<br><div id="description"><h3>Project Description</h3>';
          echo'<p>' . $result['bio'] . '</p></div>';

          echo'<div id="info"><p>Team Information</p>';
          echo'<p>CEO: ' . $result['ceo'] . '</p>';
          echo'<p>CFO: ' . $result['cfo'] . '</p>';
          echo'<p>CTO: ' . $result['cto'] . '</p>';
          echo'<p>COO: ' . $result['coo'] . '</p></div>';
        }

        #If the user has no PID, output message
        else{
            echo'<br><br><h2 id="errormessage">You have no current projects.</h2>';
        }
      }

      #If user is not logged in, output message
      else{
        echo'<br><br><h2 id="errormessage">You must log in to see your current project!</h2>';
      }




?>

  <footer>© Copyright 2017, RPI | Ardeu</footer>

  </div>
  </body>


</html>
