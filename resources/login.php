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
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="login.css" type="text/css" />
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

      <?php
        // We'll need a database connection both for retrieving records and for
        // inserting them.  Let's get it up front and use it for both processes
        // to avoid opening the connection twice.  If we make a good connection,
        // we'll change the $dbOk flag.
        $dbOk = false;

        /* Create a new database connection object, passing in the host, username,
           password, and database to use. The "@" suppresses errors. */

         @ $db = new mysqli('localhost', 'PHPbot', 'BigRedDog123!', 'iit');
        //@ $db = new mysqli('localhost', 'root', 'SQLAccount', 'iitproject');

        if ($db->connect_error) {
          echo '<div class="messages">Could not connect to the database. Error: ';
          echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
        } else {
          $dbOk = true;
        }

        // Now let's process our form:
        // Have we posted?
        $havePost = isset($_POST["save"]);

        // Let's do some basic validation
        $errors = '';
        if ($havePost) {

          // Get the output and clean it for output on-screen.
          // First, let's get the output one param at a time.
          // Could also output escape with htmlentities()
          $Username = htmlspecialchars(trim($_POST["Username"]));
          $Password = htmlspecialchars(trim($_POST["Password"]));

          $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array

          if ($Username == '') {
            $errors .= '<li>Username may not be blank</li>';
            if ($focusId == '') $focusId = '#Username';
          }
          if ($Password == '') {
            $errors .= '<li>Password may not be blank</li>';
            if ($focusId == '') $focusId = '#Password';
          }

          if ($errors != '') {
            echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
            echo $errors;
            echo '</ul></div>';
            echo '<script type="text/javascript">';
            echo '  $(document).ready(function() {';
            echo '    $("' . $focusId . '").focus();';
            echo '  });';
            echo '</script>';
          } else {
            if ($dbOk) {
              // Let's trim the input for inserting into mysql
              // Note that aside from trimming, we'll do no further escaping because we
              // use prepared statements to put these values in the database.
              $UsernameForDb = mysqli_real_escape_string($db,$_POST["Username"]);
              $PasswordForDb = mysqli_real_escape_string($db,$_POST["Password"]);
              //because we escaped out the username and passwrod, we can directly query the DB
              //this should return a single result "count", if it does not, give the user feedback
              //otherwise take us to our personal homepage
              $sql = "SELECT uuid, FirstName FROM users WHERE email = '$UsernameForDb' and password = '$PasswordForDb'";
              $result = mysqli_query($db,$sql);
              if (!$result) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
              }
              $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              $count = mysqli_num_rows($result);
              if ($count != 1){
                  $errors .= '<li>Username or Password are incorrect</li>';
              }

              if ($errors != '') {
                  echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
                  echo $errors;
                  echo '</ul></div>';
                  echo '<script type="text/javascript">';
                  echo '  $(document).ready(function() {';
                  echo '    $("' . $focusId . '").focus();';
                  echo '  });';
                  echo '</script>';
              }else{
                  // close the prepared statement obj and connection then redirect to logged in home page
                  //$result->free();
                  //$db->close();
                  //exit;
                  // Begin the session_start
                  session_start();
                  $_SESSION['uuid'] = $row['uuid'];
                  $_SESSION['name'] = $row['FirstName'];

                 ?><script type="text/javascript">location.href = '../index.php';</script><?php
              }
            }
          }
        }
      ?>

    <div class="login">
      <h2>Login</h2>
      <form id="addForm" name="addForm" action="login.php" method="post">
        <fieldset>
          <div class="formData">

            <label class="field" for="Username" ></label>
            <div class="value"><input type="text" size="60" placeholder="Username" value="<?php if($havePost && $errors != '') { echo $Username; } ?>" name="Username" id="Username"/></div>

            <label class="field" for="Password"></label>
            <div class="value"><input type="password" size="60" placeholder="Password" value="<?php if($havePost && $errors != '') { echo $Password; } ?>" name="Password" id="Password"/></div>

            <input type="submit" value="Login" id="save" name="save"/>
          </div>
        </fieldset>
      </form>
    </div>

    <footer>© Copyright 2017, RPI | Ardeu</footer>

  </body>


</html>
