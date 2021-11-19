<?php
include 'authentication.php';
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    
    $id = (isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto') ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    
    $stmt = $pdo->prepare('INSERT INTO Categories VALUES (?, ?)');
    $stmt->execute([$id, $name,]);
   
    $msg = 'Created Successfully!';
}
    
?>

<?=template_header('Create Categories',$_SESSION['login'])?>

<div class="content update">
	<h2>Create User</h2>
    <form method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="clothes" id="name">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg){ ?>
    <p><?=$msg?></p>
    <?php } ?>
</div>

<?=template_footer()?>