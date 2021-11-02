<?php 
    session_start();
    $dbconnect = mysqli_connect('localhost','browser','Browser_Password123321','portendb');
    if(isset($_SESSION['login']) && isset($_SESSION['password']))
    {
        $login = mysqli_real_escape_string($dbconnect, trim($_SESSION['login']));
        $password = mysqli_real_escape_string($dbconnect, trim($_SESSION['password']));
        $query = "SELECT * FROM `CRUD_users` WHERE `login` = '$login'";
        $data = mysqli_query($dbconnect, $query);

        if(mysqli_num_rows($data) == 1 && password_verify($password, mysqli_fetch_assoc($data)['password'])) 
        {
            echo $_SESSION['login'];
        }
        else{
            
            exit();
        }
    }
    else{
        ?> <div style="display: flex; margin: 0 auto; align-item: center; height: 100px; width: 200px; background: red; text-align:center;">No access right</div> <?php
        exit();
    }
    mysqli_close($dbconnect);
?>