<?php
    include("functions.php");

    //connectin to the products DATABASE
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=portendb;charset=utf8','admin','Admin_Password123321');
	}catch(PDOException $exception){
		exit("Failed connnecting to the database");
	}
	
	$query = $pdo->prepare('SELECT DISTINCT id_Categories FROM Products_Categories');
	$query->execute();
	$exist_categories = $query->fetchAll(PDO::FETCH_ASSOC);
	
	$query = $pdo->prepare('SELECT * FROM Categories');
	$query->execute();
	$categories = $query->fetchAll(PDO::FETCH_ASSOC);

	//show main header from functions.php
    porten_header();

?>

<main class="product">

	<section class="product__section">

		<img src="" alt="" class="product__img">

	</section>
	<section class="product__section">

		<div class="product__brand"><p></p></div>
		<div class="product__color"></div>
		<div class="product__information">
		</div>
		<div class="product__price"></div>
		<button class="addToBasketButton"></button>

	</section>

</main>

<?php

    porten_footer($exist_categories, $categories);

?>