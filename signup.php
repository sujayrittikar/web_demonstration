<?php

    if(isset($_POST['email']))
    {
        require 'db.php';

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

     
        if (strlen($_POST["password"]) <= 4) {
            echo '<script>alert("Your Password Must Contain At Least 4 Characters!");</script>';
            echo file_get_contents("signup.html");
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            echo '<script>alert("Your Password Must Contain At Least 1 Number!");</script>';
            echo file_get_contents("signup.html");
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            echo '<script>alert("Your Password Must Contain At Least 1 Capital Letter!");</script>';
            echo file_get_contents("signup.html");
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            echo '<script>alert("Your Password Must Contain At Least 1 Lowercase Letter!");</script>';
            echo file_get_contents("signup.html");
        }

        elseif(strlen($password)>20)
        { 
          echo '<script>
          alert("The password length is more than 11!");
          </script>';  
          echo file_get_contents('signup.html');
        }

        else
        {
          $sqltest = "SELECT `email` FROM `wt`.`users` WHERE email='$email'";
          if($con->query($sqltest)==true)
          {
            $resulttest = $con->query($sqltest);
            if ($resulttest->num_rows>0)
            {
                echo '<script>alert("The username already exists, login maybe?");</script>';
                echo file_get_contents("signup.html");
            }
            else
            {
            
              $sql = "INSERT INTO `wt`.`users` (`fname`, `lname`, `email`, `password`, `phone`, `address`, `time`) 
              VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$address', current_timestamp());";
              
              if ($con->query($sql)==true)
              { 
                  echo '<script>alert("Your account has been created, login to access.");</script>';
                  echo file_get_contents("login.html");
              }
              else
              {
                  echo '<script">alert("Some problems in executing your request :(! Try again maybe? :)");</script>';
                  echo file_get_contents("signup.html");
              }
            }
          }
          else
          {
            echo '<script>alert("Some problems in executing your request :(! Try again maybe? :)");</script>';
            echo file_get_contents("signup.html");
          }
          
        }

    }
?>