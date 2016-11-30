<?php
    session_start();

    if(session_destroy()){
        header("Location: ../HTML/login.html");
    }
?>
