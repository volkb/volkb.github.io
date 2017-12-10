<?php
    session_start();
    if(isset($_SESSION['name'])){
      $username = $_SESSION['name'];
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ardeu: Account Creation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="validate.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link href="login.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>

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
  // We'll need a database connection both for retrieving records and for
  // inserting them.  Let's get it up front and use it for both processes
  // to avoid opening the connection twice.  If we make a good connection,
  // we'll change the $dbOk flag.
  $dbOk = false;

  /* Create a new database connection object, passing in the host, username,
  password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'PHPbot', 'BigRedDog123!', 'iit');
  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true;
  }

  /* some very basic form processing */
  // variables to hold our form values:
  $firstName = '';
  $lastName = '';
  $email = '';
  $password = '';
  $psw_repeat = '';
  $userType = '';
  $investor = '';
  // hold any error messages
  $errors = '';

  // have we posted?
  $havePost = isset($_POST["save"]);

  if ($havePost) {
    // Get the input and clean it.
    // First, let's get the input one param at a time.
    // Could also output escape with htmlentities()
    $firstName = htmlspecialchars(trim($_POST["firstName"]));
    $lastName = htmlspecialchars(trim($_POST["lastName"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $psw_repeat = htmlspecialchars(trim($_POST["psw_repeat"]));

    // Let's do some basic validation
    $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array

    if ($firstName == '') {
      $errors .= '<li>First name may not be blank</li>';
      if ($focusId == '') $focusId = '#firstName';
    }
    if ($lastName == '') {
      $errors .= '<li>Last name may not be blank</li>';
      if ($focusId == '') $focusId = '#lastName';
    }
    if ($email == '') {
      $errors .= '<li>Email may not be blank</li>';
      if ($focusId == '') $focusId = '#Email';
    }
    if ($password == '') {
      $errors .= '<li>Password may not be blank</li>';
      if ($focusId == '') $focusId = '#password';
    }
    if ($psw_repeat == '' || $psw_repeat != $password) {
      $errors .= '<li>Password may not be blank or passwords do not match</li>';
      if ($focusId == '') $focusId = '#psw_repeat';
    }


    if ($errors != '') { ?>
      <div id="messages">
        <h4>Please correct the following errors:</h4>
        <ul>
          <?php echo $errors; ?>
        </ul>
        <script type="text/javascript">
          $(document).ready(function() {
            $("<?php echo $focusId ?>").focus();
          });
        </script>
      </div>
    <?php } else {
      if ($dbOk) {
        // Let's trim the input for inserting into mysql
        // Note that aside from trimming, we'll do no further escaping because we
        // use prepared statements to put these values in the database.
        $firstNameforDB = trim($_POST["firstName"]);
        $lastNameforDB = trim($_POST["lastName"]);
        $emailforDB  = trim($_POST["email"]);
        $passwordforDB  = trim($_POST["password"]);
        $psw_repeatforDB  = trim($_POST["psw_repeat"]);
        // Setup a prepared statement. Alternately, we could write an insert statement - but
        // *only* if we escape our data using addslashes() or (better) mysqli_real_escape_string().
        $insQuery = "INSERT INTO users (FirstName,LastName,Email,Password) values(?,?,?,?)";
        $statement = $db->prepare($insQuery);
          if(!$statement){
              echo "false!";
          }
        // bind our variables to the question marks
        $statement->bind_param("ssss",$firstNameforDB ,$lastNameforDB ,$emailforDB ,$passwordforDB);
        // make it so:
        $statement->execute();

        //Add data to Profile table


        // close the prepared statement obj
        $statement->close();
        // Finally, let's close the database
        $db->close();

       ?><script type="text/javascript">location.href = 'login.php';</script><?php
      }
    }
  }
?>

<?php
  // to include client-side validation to the form below,
  // add the following parameter:
  // onsubmit="return validate(this);"
?>



<div class="login">
<form id="addForm" name="addForm" action="signup.php" method="post">
  <fieldset>
    <div class="container">
      <h3>Welcome to Ardeu</h3>

      <label class="field" for="firstName">First Name</label>
      <div class="value"><input type="text" size="60" value="<?php echo $firstName; ?>" name="firstName" id="firstName"/></div>

      <label class="field" for="lastName">Last Name</label>
      <div class="value"><input type="text" size="60" value="<?php echo $lastName; ?>" name="lastName" id="lastName"/></div>

      <label class="field" for="email">Email</label>
      <div class="value"><input type="text" size="60" value="<?php echo $email; ?>" name="email" id="email"/></div>

      <label class="field" for="password">Password</label>
      <div class="value"><input type="password" size="60" value="<?php echo $password; ?>" name="password" id="password"/></div>

      <label class="field" for="psw_repeat">Repeat Password</label>
      <div class="value"><input type="password" size="60" value="<?php echo $psw_repeat; ?>" name="psw_repeat" id="psw_repeat"/></div>

      <input type="submit" value="submit" id="save" name="save"/>
    </div>
  </fieldset>
</form>
</div>

    </div>

    <footer>© Copyright 2017, RPI | Ardeu</footer>

  </body>
</html>
