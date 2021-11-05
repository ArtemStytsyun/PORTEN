<?php
include 'authentication.php';
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    
    $id = (isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto') ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $material = isset($_POST['material']) ? $_POST['material'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : NULL;
    $season = isset($_POST['season']) ? $_POST['season'] : NULL;
    $year = isset($_POST['year']) ? $_POST['year'] : NULL;
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    $categories = isset($_POST['categories']) ? $_POST['categories'] : NULL;
    $stmt = $pdo->prepare('INSERT INTO Products VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $material, $color, $season, $year, $created]);
    
    foreach($categories as $categori)
    {
        echo $categori;
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

    $msg = 'Created Successfully!';
}
    
?>


<?=template_header('Create',$_SESSION['login'])?>

<div class="content update">
	<h2>Create User</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="material">Material</label>
        <label for="color">Color</label>
        <input type="text" name="material" placeholder="material" id="material">
        <input type="text" name="color" placeholder="red" id="color">
        <label for="created">Created</label>
        <label for="season">Season</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="text" name="season" id="season">     
        <label for="year">Year</label>
        <label for="categories">Categorise</label>
        <input type="text" name="year" id="year"> 

        <?php 
         $query = $pdo->prepare("SELECT name FROM Categories");
         $query->execute();
         $query = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="categories">
        <?php foreach($query as $category)
            {
                $this_name_category = $category['name'];
                echo <<<EOT
                
                    <label class="categories_label">
                        <input type="checkbox" name="categories[]" class="categories_checkbox" value="$this_name_category">$this_name_category
                    </label>

                EOT;
            } ?>
        </label>
        <input type="submit" value="Create">
       


    </form>
    <?php if ($msg){ ?>
    <p><?=$msg?></p>
    <?php } ?>
</div>

<?=template_footer()?>