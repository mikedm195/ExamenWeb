<?php
include('session.php');
include_once('DBConnection.php');
$db = new DBConnection();
$dbc = $db->Connect();

$user_id = $_SESSION['login_user'];
$sql = "SELECT name, lastname, email, profilepic FROM Users WHERE id = $user_id";
$result = $dbc->query($sql);

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">

</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="../HTML/CommingSoon/temp.html">Transfer</a></li>
                    <li><a href="../HTML/temp.html">About</a></li>
                    <li><a href="../HTML/temp.html">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <?php
                print ("<img class='img-circle' src='../RES/PP/".$row["profilepic"]."' height='50%' width='100%' />");
                ?>
            </div>
            <div class="col-sm-8 text-left">
                <h1>Welcome</h1>
                <?php

                print ("<div class='well'>");
                print ("<p>" . $row["name"] . " " . $row["lastname"] . " </p>");
                print ("</div>");
                print ("<div class='well'>");
                print ("<p>" . $row["email"] . " </p>");
                print ("</div>");

                ?>
            </div>
            <div class="col-sm-2 sidenav">
                <div class="well">
                    <p><b>Saldo</b></p>
                    <p>$100,000</p>
                </div>
                <div class="well">
                    <button type="button" class="btn btn-primary">Transferir</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p class="copyright text-muted small">Copyright &copy; EZMoney 2016. All Rights Reserved</p>
    </footer>

</body>
</html>
