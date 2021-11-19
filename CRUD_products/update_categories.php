<?php
include 'authentication.php';
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
     
        $stmt = $pdo->prepare('UPDATE Categories SET id = ?, name = ? WHERE id = ?');
        $stmt->execute([$id, $name, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
   
    $stmt = $pdo->prepare('SELECT * FROM Categories WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $categories = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categories) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Udate',$_SESSION['login'])?>

<div class="content update">
	<h2>Update Contact #<?=$categories['id']?></h2>
    <form action="update_categories.php?id=<?=$categories['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$categories['id']?>" id="id">
        <input type="text" name="name" placeholder="clothes" value="<?=$categories['name']?>" id="name">
  
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>