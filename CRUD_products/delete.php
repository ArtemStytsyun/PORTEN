<?php
include 'authentication.php';
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
 
    $stmt = $pdo->prepare('SELECT * FROM Products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('product doesn\'t exist with that ID!');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $id = $_GET['id'];                                                                                                   
            $query = $pdo->prepare("DELETE FROM Products_Categories WHERE id_Products = '$id'");
            $query->execute();
            $query = $pdo->prepare("DELETE FROM Products WHERE id = '$id'");
            $query->execute();
            $msg = 'You have deleted the product!';
        } else {
           
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete',$_SESSION['login'])?>

<div class="content delete">
	<h2>Delete product #<?=$product['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete product #<?=$product['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$product['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$product['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>