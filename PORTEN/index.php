<?php
include('functions.php');
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





















		<!-- INTRO -->
		<section class="intro">
			<div class="container">
				<div class="intro__inner">

					<div class="block">

						<div class="block__title">
							porten
						</div>

						<div class="block__subtitle">
							санкт-петербург
						</div>

					</div>

					<div class="intro__title">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus interdum purus, est tortor pulvinar ut in. Fringilla a diam enim sed justo, sed iaculis sagittis. Tortor id eu interdum nec ut iaculis. Penatibus ullamcorper ultricies morbi ipsum sem metus pharetra, mi. Tortor nibh magna feugiat id nunc, dui nisl viverra.
					</div>	

				</div>
			</div>
		</section>



		<!-- COLLECTIONS -->
		<section class="collections">

				<div class="collections__2021">
					<div class="collections__block">
						<div class="title">
							СЕЗОН 2020/21
						</div>

						<div class="line"></div>

						<div class="collections__cards">
							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

						</div>


					</div>

					<div class="collections__img_1">

						<p class="title">
							Новая коллекция
						</p>

						<div class="line"></div>

						<button class="button">
							<p class="button__text">
								КАТАЛОГ
							</p>
						</button>

					</div>
				</div>



				<div class="collections__2018">
					<div class="collections__img_2">
						
					</div>

					<div class="collections__block">
						<p class="title">коллекция 2018</p>
						<div class="line"></div>
						<p class="collections__subtitle">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non rutrum ornare ut mattis habitant dui arcu. Sagittis amet nunc ut neque quis nibh arcu. Vivamus vestibulum nisi et venenatis sed scelerisque magna consectetur. Amet convallis quis gravida facilisis vulputate. Faucibus facilisi habitasse ipsum interdum dictum aliquet. Velit quis ullamcorper pulvinar nulla malesuada integer. Aenean praesent viverra nulla nullam natoque volutpat curabitur auctor. Viverra viverra ullamcorper scelerisque risus dignissim egestas. Id aliquam a aliquam egestas leo orci pharetra sed diam. 
						</p>
						<button class="button">
							<p class="button__text">
								посмотреть коллекцию
							</p>
						</button>
					</div>
				</div>
		</section>

		


	<!-- NEWARRIVALS -->
	<section class="newArrivals">
		<div class="container">
			<div class="newArrivals__inner">
				<p class="title">
					новые поступления
				</p>

				<div class="line">
					
				</div>
				<div class="newArrivals__products">
						<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

							<a href="#">
								<div class="card">
									<div class="card__block">
										<img src="img/cards/Louis XVI ATHOS.png" alt="" class="card__product">
									</div>

									<p class="card__title">Louis XVI ATHOS</p>
									<p class="card__subtitle">
										165 000 руб.  
									</p>
								</div>
							</a>

				</div>
			</div>
		</div>
	</section>



	<!-- BRENDS -->
		<section class="brends">
			<div class="container">
				<div class="brends__inner">
					<p class="title">наши бренды</p>
					<div class="line"></div>
				
					<div class="brends__items">
						<div class="brends__item">
							<img src="img/brands/brand_1.png" alt="">
						</div>

						<div class="brends__item">
							<img src="img/brands/brand_1.png" alt="">
						</div>

						<div class="brends__item">
							<img src="img/brands/brand_1.png" alt="">
						</div>

						<div class="brends__item">
							<img src="img/brands/brand_1.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>



		<?php 
		
		porten_footer($exist_categories, $categories);
		
		?>