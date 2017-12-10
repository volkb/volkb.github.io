<?php
    header('Content-Type: application/json');
    $funct_name = $_POST['action'];
    if($funct_name == 'register') {
        //Set variables for mySQL Server ($host $usr $pw $dbname)
        $host = "localhost";
        $user = "root";
        $pw = "BigRedDog123!";
        $dbname = "iit";
        date_default_timezone_set("America/New_York");

        //Set variables that represent values from form fields using $_POST['fieldname'];
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];    
        $email_ = $_POST['email'];
        $password_ = $_POST['password'];
        $userType = $_POST['type'];
        $uuid_ = $_POST['uuid_'];

        //Create a variable [$conn] that connects to MySQL server using [mysqli_connect]
        //Confirm your are connected to server 'Connected to server/host' or not (not the db)
        // Create connection
        $conn = mysqli_connect($host, $user, $pw);
        // Check connection
        if ($conn) {
            echo "Connected successfully to: ". $host ." on ".date('m/d/Y')." at ".date('h:i.sa'). ".<br>";
        } else {
            echo "Not Connected to Server.";
        }

        //Create variable [$selectdb] that connects & Selects the db name using [mysqli_select_db]
        //Confirm you are connected to correct database
        $selectdb = mysqli_select_db($conn,$dbname);
        if ($selectdb) {
            echo "Connected successfully to the ". $dbname ." database at ".date('h:i.sa'). ".<br><br>";
        } else {
            echo "Not Connected to Database.";
        }
        $insert_sql = "INSERT INTO users (FirstName, LastName, Email, Password, Type, UUID)
        VALUES('$f_name', '$l_name', '$email_', '$password_', '$userType')";

        //connects & runs the insert query [msqli_query] and the or die...
        //mysqli_query($conn, $insert_sql) or die('Error querying database.');
        mysqli_query($conn,$insert_sql) or die('Query Error');
        mysqli_close($conn);
    } else {
        echo "No Function Name.";
    }
    
?>