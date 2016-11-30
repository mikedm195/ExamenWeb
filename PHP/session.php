<?php
    include_once('DBConnection.php');
    $db = new DBConnection();
    $dbc = $db->Connect();
    session_start();

    //print("Se está corriendo<br/>");

    if(!isset($_SESSION['login_user'])){
        header("location: ../HTML/login.html");
    }

    $user_id = $_SESSION['login_user'];

    $sql = mysqli_query($dbc,"SELECT name from Users WHERE id = '$user_id' ");

    $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);

    $name_logged = $row['name'];


?>
