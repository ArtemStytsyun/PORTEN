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
        $categories = isset($_POST['categories']) ? explode(" ",$_POST['categories']) : NULL;
     
        $stmt = $pdo->prepare('UPDATE Products SET id = ?, name = ?, material = ?, color = ?, season = ?, year = ?, created = ? WHERE id = ?');
        $stmt->execute([$_GET['id'], $name, $material, $color, $season, $year, $created, $_GET['id']]);

        $id = $_GET['id'];

        echo $_GET['id'];
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

    if (!$product) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Update')?>

<div class="content update">
	<h2>Update Products #<?=$product['id']?></h2>
    <form action="update.php?id=<?=$product['id']?>" method="post">

        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="material">Material</label>
        <label for="color">Color</label>
        <input type="text" name="material" placeholder="johndoe@example.com" id="material">
        <input type="text" name="color" placeholder="red" id="color">
        <label for="created">Created</label>
        <label for="season">Season</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($product['created']))?>" id="created">
        <input type="text" name="season" id="season">     
        <label for="year">Year</label>
        <label for="categories">Categorise</label>
        <input type="text" name="year" id="year"> 
        <input type="text" name="categories" id="categories"> 
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>