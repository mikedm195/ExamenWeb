<?php
include_once('config.php');
class DBConnection{
  public function Connect(){
    $connection = mysqli_connect(HostDB, UserDB, PasswordDB, NameDB);
    if(mysqli_connect_errno($connection)){
      echo "Error in DataBase connection. Please contact Administrat\n" . mysqli_connect_error();
    }
    return $connection;
  }
}
 ?>
