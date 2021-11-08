<?php if(!isset($_COOKIE['id']))
{
	
	$dbconnect = mysqli_connect('localhost','admin','Admin_Password123321','portendb');
	if(isset($_POST['submit__login']))
	{
        
		$login = mysqli_real_escape_string($dbconnect, trim($_POST['login__login']));
		$password = mysqli_real_escape_string($dbconnect, trim($_POST['password__login']));
		$password = password_hash($password, PASSWORD_DEFAULT);

		if(!empty($login) && !empty($password))
		{	
			
			$query = "SELECT 'id', 'login' FROM  `users` WHERE login = '$login' AND password = '$password'";
			$data = mysqli_query($dbconnect, $query);
			if(mysqli_num_rows($data) == 1)
			{
				$row = mysqli_fetch_assoc($data);
				setcookie('id', $row['id'], time() + (60 * 60 * 24 * 30));
				setcookie('login', $row['login'], time() + (60 * 60 * 24 * 30));
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . "/PORTEN";
				header('location: ' . $home_url);
			}
			else
			{
				$url = 'http://localhost/PORTEN/Registration.php?pa=1';
				header('location: ' . $url);
			}
		}
	}
	else echo 1;
} ?>