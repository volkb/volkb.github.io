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

    <script type="text/javascript" src="validate.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="../resources/style.css" type="text/css" />
    <link rel="stylesheet" href="resources/profile.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">

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


    <?php
      @ $db = new mysqli('localhost', 'PHPbot', 'BigRedDog123!', 'iit');

      if ($db->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
      }

      //Check if the user is logged in
      if(isset($_SESSION['name'])){

        //find the UUID of the user
        $uuid = $_SESSION["uuid"];

        //Query the database for projects with matching ID
        $query = "select * from profiles where page_id = " . $uuid;
        $line = $db->query($query);
        $result = $line->fetch_assoc();

        #If the user has a profile, output HTML with their information
        if( $result['name'] != ""){

          echo'<div id="info_block"><div id="pic">';
          echo'<img src="' . $result['pic'] . '" alt="profile_picture" </img>';
          echo'<br><br><div id="resume"><a href="' . $result['resume'] . '">' . $result['name'] . '</a></div></div>';

          echo'<div id="general_info"><p><h3>Bio</h3>' . $result['bio'] . '</p></div>';

          echo'<div id="interets"><p><h3>Education</h3>' . $result['education'] . '</p><br>';
          echo'<p><h3>Current Project</h3>' . $result['current'] . '</p><br>';
          echo'<p><h3>Past Projects</h3>' . $result['past1'] . '<br>' . $result['past2'] . '</p>';

          echo'</div></div>';

        }

        #If the user has no PID, output message
        else{
            echo'<br><br><h2 id="errormessage">You do not currently have a profile set up.</h2>';
        }
      }

      #If user is not logged in, output message
      else{
        echo'<br><br><h2 id="errormessage">You must log in to see your profile!</h2>';
      }

?>






    <footer>© Copyright 2017, RPI | Ardeu</footer>

  </body>


</html>
