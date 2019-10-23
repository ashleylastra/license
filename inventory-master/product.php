<?php
ob_start();
//$page_title = 'All Product';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
// page_require_level(2);
// $products = join_product_table();
//$products = find_all('product');
//$user = find_all('user_info');
?>
<style>
<?php 
include 'libs/css/main.css';
?>
</style>
<?php 
				if(isset($_POST['search'])) {
				    $valueToSearch = $_POST['valueToSearch'];
				    $query = "SELECT * FROM  `product` WHERE CONCAT(`manufacturer`) LIKE '%".$valueToSearch."%'";
				    $search_result = $db->query($query);
				else {
				   $query = "SELECT * FROM `product`";
				   $search_result = $db->query($query);
				}
				
				?>
				
<?php include_once('layouts/header.php'); ?>
	<div class="col-md-18">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<div class="pull-left">
					<a href="add_product.php" class="btn btn-primary">Add License</a>
				</div>
			</div>
			<div class="panel-body">
			<form action="product.php" method="post">
			<div class = "pull-right">
				<input type="text" name="valueToSearch" placeholder="Filter"/>
				<input type="submit" name="search" value="Filter">
			</div>
			</form>
			</div>
			<div class="table-responsive"> 
				<table class="table table-hover table-bordered w-auto">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Manufacturer</th>
							<th scope="col">Part Number</th>
							<th scope="col">Product Name</th>
							<th scope="col">Description</th>
							<th scope="col">Price per Unit</th>
							<th scope="col">Expiration Date</th>
							<th scope="col">Quantity</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
                           <?php while($product = mysqli_fetch_array($search_result)):?>
                            <tr onClick="document.location.href='viewproduct.php?id=<?php echo (int)$product['product_id'];?>'">
							<td><?php echo count_id();?></td>
							<td><?php echo remove_junk($product['manufacturer']); ?></td>
							<td class="text-center"> <?php echo remove_junk($product['part_number']); ?></td>
							<td class="text-center"> <?php echo remove_junk($product['product_name']); ?></td>
                            <td class="text-center"><?php echo remove_junk($product['description']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['price']); ?></td>
							<td class="text-center"> <?php echo remove_junk($product['exp_date']); ?></td>
							<td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
							


							<td class="text-center">
								<div class="btn-group">
									<a
										href="edit_product.php?id=<?php echo (int)$product['product_id'];?>"
										class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a> <a
										href="delete_product.php?id=<?php echo (int)$product['product_id'];?>"
										class="btn btn-danger btn-xs" title="Delete"
										data-toggle="tooltip"> <span class="glyphicon glyphicon-trash"></span>
									</a>
									
								</div>
							</td>
						</tr>
             <?php endwhile;?>
            </tbody>
				</table>
			</div>
		</div>
	</div>
<?php include_once('layouts/footer.php'); ?>
