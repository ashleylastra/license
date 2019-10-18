<?php
ob_start();
$page_title = 'Add User Info';
require_once('includes/load.php');
//$product = find_by_product_id_mvp((int)$_GET['id']);
$prod = find_all('product');
$user = find_all('user_info');
//$products = "SELECT * FROM user_info WHERE product_id='{$db->escape($id)}'";
?>
<?php 
if(isset($_POST['add_userinfo'])){
   // $req_fields = array('first_name','last_name', 'location_name');
  //  validate_fields($req_fields);
    if(empty($errors)){
        $p_fname  = remove_junk($db->escape($_POST['first_name']));
        $p_lname  = remove_junk($db->escape($_POST['last_name']));
        $p_loc  = remove_junk($db->escape($_POST['location_name']));
        $p_name = remove_junk($db->escape($_POST['product_name']));
        
        $query  = "INSERT INTO user_info (";
        $query .="first_name, last_name, location_name, product_id";
        $query .=") VALUES (";
        $query .="'{$p_fname}', '{$p_lname}', '{$p_loc}', '{$p_name}'";
        $query .=");";
        
        if($db->query($query)){
            $session->msg('s',"User added ");
            redirect('product.php', false);
        } else {
            $session->msg('d',' Sorry failed to added!');
            redirect('viewproduct.php', false);
        }
        
    } else{
        $session->msg("d", $errors);
        redirect('viewproduct.php',false);
    }
    
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Adding New User</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
         <form method="post" action="add_userinfo.php" class="clearfix">
           <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="location_name" placeholder="Location Name">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product_name">
                      <option value="">Select Product</option>
                    <?php  foreach ($prod as $p): ?>
                      <option value="<?php echo (int)$p['product_id'] ?>">
                        <?php echo $p['product_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              </div>
          <button type="submit" name="add_userinfo" class="btn btn-danger">Add User</button>
          </div>
          
         </div>
        </div>
      </div>
      </form>
<?php include_once('layouts/footer.php'); ?>
