<?php 
    include("functions.php");

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

    porten_header('<link rel="stylesheet" href="categoriesStyle.css">');
?>




<main class="categories">
    <div class="container">
        <div class="categories__list">
            <?php
            show_products_with_category($_GET['name']);
            ?>
        </div>
    </div>
</main>    



<?php
    porten_footer($exist_categories, $categories);
?>