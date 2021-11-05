<?php
include 'authentication.php';
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = (isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto') ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $material = isset($_POST['material']) ? $_POST['material'] : '';
        $color = isset($_POST['color']) ? $_POST['color'] : NULL;
        $season = isset($_POST['season']) ? $_POST['season'] : NULL;
        $year = isset($_POST['year']) ? $_POST['year'] : NULL;
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        $categories = isset($_POST['categories']) ? $_POST['categories'] : NULL;
     
        $stmt = $pdo->prepare('UPDATE Products SET id = ?, name = ?, material = ?, color = ?, season = ?, year = ?, created = ? WHERE id = ?');
        $stmt->execute([$_GET['id'], $name, $material, $color, $season, $year, $created, $_GET['id']]);

        $id = $_GET['id'];

        $query = $pdo->prepare("DELETE FROM Products_Categories WHERE id_Products = '$id'");
        $query->execute();
        
        foreach($categories as $categori)
        {
            $query = $pdo->prepare("SELECT id FROM Categories WHERE name = '$categori'");
            $query->execute();
            $query = $query->fetchAll(PDO::FETCH_ASSOC);
            $id_Categories = (int)$query[0]['id'];
            
            $query = $pdo->prepare("SELECT id FROM Products WHERE created = '$created'");
            $query->execute();
            $query = $query->fetchAll(PDO::FETCH_ASSOC);
            $id_Products = (int)$query[0]['id'];
            
            $stmt = $pdo->prepare('INSERT INTO Products_Categories VALUES (?, ?)');
            $stmt->execute([$id_Products, $id_Categories]);
        }

        $msg = 'Updated Successfully!';
        
    }





    $stmt = $pdo->prepare('SELECT * FROM Products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($product['id']);
    if (!$product) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Update',$_SESSION['login'])?>

<div class="content update">
	<h2>Update Products #<?=$product['id']?></h2>
    <form action="update.php?id=<?=$product['id']?>" method="post">

        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="" value="<?php echo $product['id']?>" id="id">
        <input type="text" name="name" placeholder="Name of products" id="name" value="<?php echo $product['name']?>">
        <label for="material">Material</label>
        <label for="color">Color</label>
        <input type="text" name="material" placeholder="material" id="material" value="<?php echo $product['material']?>">
        <input type="text" name="color" placeholder="red" id="color" value="<?php echo $product['color']?>">
        <label for="created">Created</label>
        <label for="season">Season</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($product['created']))?>" id="created">
        <input type="text" name="season" id="season" value="<?php echo $product['season']?>">     
        <label for="year">Year</label>
        <label for="categories">Categorise</label>
        <input type="text" name="year" id="year" value="<?php echo $product['year']?>"> 
        <?php 
        //Get all categories
         $query = $pdo->prepare("SELECT * FROM Categories");
         $query->execute();
         $query = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="categories">
        <?php 
            
            $this_id_product = $_GET['id'];
            
            $query_1 = $pdo->prepare("SELECT id_Categories FROM Products_Categories WHERE id_Products = '$this_id_product'");   
            $query_1->execute();
            $query_1 = $query_1->fetchAll(PDO::FETCH_ASSOC);
                    
            $i = 0;
            foreach($query as $category)
            {
                $checked;
                $this_name_category = $category['name'];
                if($category['id'] == $query_1[$i]['id_Categories'])
                {
                    $checked = 'checked';
                    $i++;
                }
                else{
                    $checked = '';
                }
                
                echo <<<EOT
                
                    <label class="categories_label">
                        <input type="checkbox" name="categories[]" class="categories_checkbox" value="$this_name_category" $checked>$this_name_category
                    </label>

                EOT;
            } ?>
        </label>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>