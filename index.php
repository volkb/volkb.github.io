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

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="resources/style.css" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  </head>

  <header>

    <img src="https://i.imgur.com/0ljNrTE.jpg" id="logo">
    <img src="resources/images.png" id="banner">
    <ul id="homebar">
      <li><a href="#"> Home </a></li>
      <li><a href="projsearch/projectsearch.php"> Project Search </a></li>
      <li><a href="project/project.php"> Project Page </a></li>
      <li><a href="contact/contact.php"> Contact Us </a></li>

      <?php
        if(isset($_SESSION['name'])){
          print_r("<li id='profilebutton'><a href='profile/profile.php'>" . $username . "</a>");
          print_r("<li><a href='resources/logout.php'>Log out</a>");
        }
        else{
          print_r("<li id='loginbutton'><a href='resources/login.php'>Login</a></li><li id='signupbutton'><a href='resources/signup.php'>Sign Up</a></li>");
        }?>
      </ul>
  </header>

  <body>

      <div id="leftsidebar">
        <h2 id='sidebaritem'>Recent Articles</h2>
        <p id='sidebaritem'>Business</p>
        <p id='sidebaritem'>Finance</p>
        <p id='sidebaritem'>Entrepreneurship</p>
        <p id='sidebaritem'>Technology</p>
        <p id='sidebaritem'>Politics</p>
        <p id='sidebaritem'>Economics</p>
        <p id='sidebaritem'>Legal</p>
        <p id='sidebaritem'>Entertainment</p>
      </div>

      <div><iframe id='video' src="https://www.youtube.com/embed/bNpx7gpSqbY?ecver=2" allowfullscreen ></iframe></div>

      <div id="rightsidebar">
        <h2 id='sidebaritem'>Recent Videos</h2>
        <p id='sidebaritem'>Business</p>
        <p id='sidebaritem'>Finance</p>
        <p id='sidebaritem'>Entrepreneurship</p>
        <p id='sidebaritem'>Technology</p>
        <p id='sidebaritem'>Politics</p>
        <p id='sidebaritem'>Economics</p>
        <p id='sidebaritem'>Legal</p>
        <p id='sidebaritem'>Entertainment</p>
      </div>

      <footer>© Copyright 2017, RPI | Ardeu</footer>


  </body>



</html>
