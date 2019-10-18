<?php
ob_start();
$page_title = 'All Product';
require_once ('includes/load.php');
$product = find_by_product_id_mvp((int)$_GET['id']);
//$users = find_all('user_info');
//$user = find_by_userinfo_id((int)$_GET['id']);
//$user = find_by_product_id_mvp((int)$_GET['id']);

?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
     <div class="col-md-10">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
         	 <a href="add_userinfo.php" class="btn btn-primary">Add User</a>
				</div>
        </div>
        <div class="panel-body">
        <form method="get" action="viewproduct.php">
          <table class="table table-bordered w-auto">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
				<th class="text-center">Location</th>
				 <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($product as $prod):?>
              <tr>
                <td class="text-center">
                <?php echo count_id();?></td>
              <td><?php echo remove_junk($prod['first_name']); ?>
                <?php echo remove_junk($prod['last_name']); ?></td>
				<td><?php echo remove_junk($prod['location_name']); ?></td>
                 <td class="text-center">
                    <a href="delete_userinfo.php?id=<?php echo (int)$prod['user_id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
               <?php endforeach;
				?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
