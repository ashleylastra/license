<?php
ob_start();
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
  //$all_categories = find_all('product_type');
  //$all_location = find_all('locations');
?>
<?php
 if(isset($_POST['add_product'])){
   //$req_fields = array('manufacturer','part_number', 'product_name', 'description', 'price', 'exp_date', 'quantity');
   //validate_fields($req_fields);
   if(empty($errors)){
     $p_man  = remove_junk($db->escape($_POST['manufacturer']));
     $p_num  = remove_junk($db->escape($_POST['part_number']));
     $p_name  = remove_junk($db->escape($_POST['product_name']));
     $p_desc   = remove_junk($db->escape($_POST['description']));
     $p_price   = remove_junk($db->escape($_POST['price']));
     $p_date   = remove_junk($db->escape($_POST['exp_date']));
     $p_qty   = remove_junk($db->escape($_POST['quantity']));
     //$p_fname   = remove_junk($db->escape($_POST['first_name']));
     //$p_lname   = remove_junk($db->escape($_POST['last_name']));
     //$p_loc   = remove_junk($db->escape($_POST['location_name']));
	 //$p_type   = remove_junk($db->escape($_POST['type_name'].value));
	 //$p_loc    = remove_junk($db->escape($_POST['location_name'].value));
     $query  = "INSERT INTO product (";
     $query .="manufacturer, part_number, product_name, description, price, exp_date, quantity";
     $query .=") VALUES (";
     $query .="'{$p_man}', '{$p_num}', '{$p_name}', '{$p_desc}', '{$p_price}', '{$p_date}', '{$p_qty}'";
     $query .=")";
     
     /*if($db->query($query)){
     $sql = "INSERT into product_location(";
     $sql .="product_id, location_id";
     $sql .=") VALUES (";
     $sql .= "'{$db->insert_id()}', '{$p_loc}'";
     $sql .= ")";*/
     
     /*if($db->query($query)) {
         $sql = "INSERT INTO user_info (";
         $sql .= "product_id";
         $sql .= ") VALUES (";
         $sql .= "'{$db->insert_id()}'";
         $sql .= ")";
   } else {
         $db->rollback();
         $session->msg('d', 'Failed');
     }*/
     
     if($db->query($query)){
         $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
            <span>Adding New License</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="manufacturer" placeholder="Manufacturer">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="part_number" placeholder="Part Number">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="price" placeholder="Price per Unit">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                 </div>
                 </div>
                 <div class="form-group">
               <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                      </span>
                      <input type="date" class="form-control" name="exp_date" placeholder="Expiration Date">
                   </div>
                  </div>
               </div>
              </div>
              <textarea name="description" rows="5" cols="40" placeholder="Product Description"></textarea>
              </div>
          <button type="submit" name="add_product" class="btn btn-danger">Add License</button>
          </form>
         
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
