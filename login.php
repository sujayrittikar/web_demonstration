<?php
    if(isset($_POST['username'])||isset($_POST['logout']))
    {
        if(isset($_POST['logout']))
        {
            header("Location: login.html");
            session_destroy();
            exit();
        }

        if(isset($_POST['username']))
        {        
            session_start();
            require 'db.php';

            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM `wt`.`users` WHERE email='$username';";

            if($con->query($sql)==true)
            {
                $result = $con->query($sql);
                $row = $result->fetch_assoc();
                $entered_pass = $row["password"];
                if (strcmp($entered_pass, $password)==0)
                {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    echo '<script>alert("Your details are: \n Firstname: '.$row['fname'].'\nLastname: '.$row['lname'].'\nEmail: '.$row['email'].'");</script>';
                    echo file_get_contents("main.html"); 
                }
                else
                {
                    if ($result->num_rows==0)
                    {
                        echo '<script>alert("User ID does not exist, Sign Up?");</script>';
                        echo file_get_contents("signup.html");
                    }
                    else
                    {
                        echo '<script>alert("Password is wrong try again? :(");</script>';
                        echo file_get_contents("login.html");
                    }
                }
            }
            $con->close();
        }
    }
?>