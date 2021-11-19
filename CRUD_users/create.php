<?php
include 'authentication.php';
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    
    $id = (isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto') ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $password = isset($_POST['password']) && $password == $repassword ? password_hash($_POST['password'],PASSWORD_DEFAULT) : ''; 
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : NULL;
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    
    $stmt = $pdo->prepare('INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $password, $email, $phone, $title, $created]);
   
    $msg = 'Created Successfully!';
}
    
?>

<?=template_header('Create')?>

<div class="Content update">
	<h2>Create User</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@mail.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="created">Created</label>
        <label for="password"></label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="password" name="password" placeholder="password" id="password">
        <label for="repassword">Return Password</label>
        <input type="password" name="repassword" placeholder="return your password">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg){ ?>
    <p><?=$msg?></p>
    <?php } ?>
</div>

<?=template_footer()?>