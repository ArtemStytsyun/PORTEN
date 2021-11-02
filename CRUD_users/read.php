<?php 
   
    include 'authentication.php';
    include 'function.php';

    $pdo = pdo_connect_mysql();

    $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

    $records_per_page = 5;

    $stmt = $pdo->prepare('SELECT * FROM users ORDER BY id LIMIT :current_page, :record_per_page');
    $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
 
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $num_users = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    
    template_header('Read');?>

<div class="content read">
	<h2>Read users</h2>
	<a href="create.php" class="create-user">Create user</a>
 
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Created</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user){ ?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['name'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['phone'];?></td>
                <td><?php echo $user['created'];?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$user['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$user['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1){?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php }; ?>
		<?php if ($page*$records_per_page < $num_users){ ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php } ?>
	</div>
</div>

<?=template_footer()?>