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
    <link rel="stylesheet" href="resources/contact.css" type="text/css" />
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


    <div class="feedbackPage">
      <p id="noName">Contact us!</p>
      <form id="feedback" name="feedbackForm" action="contact.php" method="post">
          <fieldset>
            <div class="feedbackFormData">
              <label class="field" for="first Name" ></label>
              <div class="value"><input type="text" size="60" placeholder="First Name" name="Name" id="feedbackFirstName"/></div>

              <label class="field" for="last Name" ></label>
              <div class="value"><input type="text" size="60" placeholder="Last Name" name="Name" id="feedbackLastName"/></div>

              <label class="field" for="Email"></label>
              <div class="value"><input type="text" size="60" placeholder="Your Email" name="Email" id="feedbackEmail"/></div>

              <label class="field" for="feedback"></label>
              <div class="value"><input type="text" size="60" placeholder="Your Message" name="feedback" id="feedbackContent"/></div>

              <input id="save"type="submit" value="Submit" id="submitFeedback" name="Submit"/>

            </div>
          </fieldset>
        </form>
      </div>

    <footer>© Copyright 2017, RPI | Ardeu</footer>

  </body>


</html>
