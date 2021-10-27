<?php 
$flag = true;

function display_1()
{
	if($_GET["pa"] == 2){
		echo "display: flex";
	}
	else{
		echo "display: none";
	}
}

function display_2()
{
	if($_GET["pa"] == 1){
		echo "display: flex";
	}
	else{
		echo "display: none";
	}
}







// Writing to DB
$dbconnect = mysqli_connect('localhost','browser','123456789','practice');
if(isset($_POST['submit__registration']))
{
	$username = mysqli_real_escape_string($dbconnect, trim($_POST['username__registration']));
	$email = mysqli_real_escape_string($dbconnect, trim($_POST['email__registration']));
	$password = mysqli_real_escape_string($dbconnect, trim($_POST['password__registration']));
	$repassword = mysqli_real_escape_string($dbconnect, trim($_POST['repassword__registration']));

	if(!empty($username) && (!empty($email)) && (!empty($password)) && (!empty($repassword)) && ($repassword == $password))
	{
		$query = "SELECT * FROM `users` WHERE username = '$username'"; 
		$data = mysqli_query($dbconnect, $query);

		if(mysqli_num_rows($data) == 0)
		{
			$query = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', SHA('$password'))";
			mysqli_query($dbconnect,$query);
			mysqli_close($dbconnect);
			$url = 'http://' . "porten/Registration.php?pa=1";
			header('location: ' . $url);
		}
		else
		{
			exit();
		}
	}
	else
	{
		exit();
	}
}


if(!isset($_COOKIE['id']))
{
	
	if(isset($_POST['submit__login']))
	{
		$username = mysqli_real_escape_string($dbconnect, trim($_POST['username__login']));
		$password = mysqli_real_escape_string($dbconnect, trim($_POST['password__login']));

		if(!empty($username) && !empty($password))
		{
			$query = "SELECT 'id', 'username' FROM  `users` WHERE username = '$username' AND password = SHA('$password') ";
			$data = mysqli_query($dbconnect, $query);
			if(mysqli_num_rows($data) == 1)
			{
				
				$row = mysqli_fetch_assoc($data);
				setcookie('id', $row['id'], time() + (60 * 60 * 24 * 30));
				setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));
				$home_url = 'http://' . $_SERVER['HTTP_HOST'];
				header('location: ' . $home_url);
			}
			else
			{
				$url = 'http://' . "porten/Registration.php?pa=1";
				header('location: ' . $url);
			}
		}
	}
}

?>








<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styleRegistration.css">

	<!-- FONTS -->
	<link rel = "preconnect" href = "https://fonts.googleapis.com">
	<link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
	<link href = "https: //fonts.googleapis.com/css2? family = PT + Sans + Caption & display = swap "rel =" stylesheet ">

	<link href="http://fonts.cdnfonts.com/css/post-no-bills-jaffna" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


</head>
<body>
	<div class="wrapper">
		<div class="container">

			<section class="block">
				<div class="block__change">
					<span class="block__button <?php if($_GET['pa'] == 2){echo "button__active";} ?>" id="registration">Регистрация</span>
					<span class="block__button <?php if($_GET['pa'] == 1){echo "button__active";}?>" id="login">Войти</span>
				</div>
				<h1><?php if($_GET['pa'] == 1){echo "Войти";}else{echo "Регистрация";} ?></h1>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form" id="form__registration" method="POST" style="<?php display_1() ?>">
					
						<div class="form__input"><input type="text" name="username__registration"placeholder="Имя пользователя" ></div>
						<div class="form__input"><input type="email" name="email__registration" placeholder="Электронная почта" required></div>
						<div class="form__input"><input type="password" name="password__registration" placeholder="Пароль"></div>
						<div class="form__input"><input type="password" name="repassword__registration" placeholder="Повторите пароль"></div>
						<div><button type="submit" name ="submit__registration"class="button"><p class="button__text">Зарегистрироваться</p></button></div>

				</form>

				<form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form" id="form__login" id="login" method="POST" style="<?php display_2() ?>">

						<div class="form__input"><input type="text" name="username__login"placeholder="Имя пользователя" ></div>
						<div class="form__input"><input type="password" name="password__login" placeholder="Пароль"></div>
						<div><button type="submit" class="button" name ="submit__login"><p class="button__text">Войти</p></button></div>

				</form>

			</section>

		</div>
	</div>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="javaScriptReg.js"></script>

</body>
</html>