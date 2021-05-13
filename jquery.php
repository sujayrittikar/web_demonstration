<?php

    if(isset($_POST['jquery']))
    {
        session_start();
        echo file_get_contents("jquery.html");
    }

    if(isset($_POST['logout']))
    {
        header("Location: login.html");
        session_destroy();
        exit();
    }
    if(isset($_POST['back']))
    {
        echo file_get_contents("main.html");
    }
?>