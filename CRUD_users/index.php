<?php include 'function.php';
session_start();

$dbconnect = mysqli_connect('localhost','browser','Browser_Password123321','portendb');

if(isset($_POST['submit']))
{
    $login = mysqli_real_escape_string($dbconnect, trim($_POST['login']));
    $password = mysqli_real_escape_string($dbconnect, trim($_POST['password']));

    if(!empty($_POST['login']) && !empty($_POST['password']))
    {
        $query = "SELECT `password` FROM `CRUD_users` WHERE `login` = '$login'";
        $data = mysqli_query($dbconnect, $query);

        if(mysqli_num_rows($data) == 1 && password_verify($password, mysqli_fetch_assoc($data)['password']))
        {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $url = 'http://' . "localhost/CRUD/read.php";
			header('location: ' . $url);
        }
        else{
            echo "@";
        } 
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<div class="content">
        <form  method ="POST" action>
            <label for="name">login</label><input type="text" name = "login" require>
            <label for="password">Passord</label><input type="password" name="password" require>
            <button type="submit" name="submit">login</button>
        </form>
    </div>
</body>
</html>