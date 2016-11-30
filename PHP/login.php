<?php
   include_once("DBConnection.php");
   $db = new DBConnection();
   $dbc = $db->Connect();
   session_start();

   $valid = false;

   print("entro<br/>");

   if (isset($_POST['username']) && isset($_POST['password'])){
     $valid = true;
     print("valid<br/>");
   }
   else{
     print ("Please insert your username and password.<br/>");
   }

   $myusername = mysqli_real_escape_string($dbc,$_POST['username']);
   $mypassword = mysqli_real_escape_string($dbc,$_POST['password']);
   $sql = "SELECT * FROM Users WHERE email = '$myusername' and password = '$mypassword'";
   print("<br/>".$sql . "<br/>");
   $result = $dbc->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $user = $result->fetch_assoc();
    $_SESSION['login_user'] = $user["id"];
    header("location: home.php");
} else {
    print ("Invalid username or password<br/>");
    header("location: ../HTML/login.html");
}
?>
