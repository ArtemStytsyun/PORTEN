<?php 
   
    include 'authentication.php';
    include 'function.php';

    $pdo = pdo_connect_mysql();

    $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

    $records_per_page = 5;

    $stmt = $pdo->prepare('SELECT * FROM Products ORDER BY id LIMIT :current_page, :record_per_page');
    $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    
    



    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $num_products = $pdo->query('SELECT COUNT(*) FROM Products')->fetchColumn();
    
    template_header('Read', $_SESSION['login']);?>

<div class="content read">
	<h2>Read Products</h2>
	<a href="create.php" class="create-user">Create user</a>
 
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Material</td>
                <td>Color</td>
                <td>Season</td>
                <td>Year</td>
                <td>Created</td>
                <td>Categories</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product){ 
                $this_id_product = $product['id']?>
            <tr>
                <td><?php echo $product['id'];?></td>
                <td><?php echo $product['name'];?></td>
                <td><?php echo $product['material'];?></td>
                <td><?php echo $product['color'];?></td>
                <td><?php echo $product['season'];?></td>
                <td><?php echo $product['year'];?></td>
                <td><?php echo $product['created'];?></td>

                <td><?php
                    $query_1 = $pdo->prepare("SELECT id_Categories FROM Products_Categories WHERE id_Products = '$this_id_product'");   
                    $query_1->execute();
                    $query_1 = $query_1->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach($query_1 as $this_id_categories)
                    {
                        $this_id_categories = $this_id_categories['id_Categories'];
                        $query_2 = $pdo->prepare("SELECT name FROM Categories WHERE id = '$this_id_categories'");
                        $query_2->execute();
                        $query_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                        echo $query_2[0]['name'];
                    }
                    

                ?></td>




                <td class="actions">
                    <a href="update.php?id=<?=$product['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$product['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1){?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php }; ?>
		<?php if ($page*$records_per_page < $num_products){ ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php } ?>
	</div>
</div>

<?=template_footer()?>