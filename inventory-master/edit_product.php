<?php ob_start();
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
?>
<?php
$product = find_by_product_id('product',(int)$_GET['id']);
//$all_categories = find_all('product_type');
//$all_location = find_all('locations');
//$prod_loc = find_by_prodloc_id('product_location', (int)$_GET['id']);
//$loca = find_all('product_location');
//$prod_loc = find_all('product_location');
//$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('edit_product.php');
}
?>
<?php
 if(isset($_POST['product'])){
 //array of the fields/columns that are required to edit table
   // $req_fields = array('product_name','quantity');
    //validate_fields($req_fields);
//checks if errors array is empty
    $p_man  = remove_junk($db->escape($_POST['manufacturer']));
    $p_num  = remove_junk($db->escape($_POST['part_number']));
       $p_name  = remove_junk($db->escape($_POST['product_name']));
       $p_price   = remove_junk($db->escape($_POST['price']));
       $p_date   = remove_junk($db->escape($_POST['exp_date']));
       $p_qty   = remove_junk($db->escape($_POST['quantity']));
       $p_desc   = remove_junk($db->escape($_POST['description']));
      // $p_type   = remove_junk($db->escape($_POST['type_name'].value));
      // $p_loc  = remove_junk($db->escape($_POST['location_name'].value));
  
	   if(empty($errors)){
	   //updating products table
	   $query = "UPDATE product";
	   $query .= " SET manufacturer ='{$p_man}', part_number ='{$p_num}',";
	   $query .= " product_name ='{$p_name}', price ='{$p_price}',";
	   $query .= " exp_date ='{$p_date}', quantity ='{$p_qty}',";
	   $query .= " description ='{$p_desc}'";
	   $query .=" WHERE product_id ='{$product['product_id']}'"; 
       //$query   ="UPDATE product";
       //$query  .=" INNER JOIN product_location ON product.product_id = product_location.product_id";
       //$query  .=" SET product.product_name ='{$p_name}', product.quantity ='{$p_qty}',";
       //$query  .=" product.type_id ='{$p_type}', product_location.location_id = '{$p_loc}'";
       //$query  .=" WHERE product.product_id ='{$product['product_id']}'";    
       $result = $db->query($query);
       
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_product.php?id='.$product['product_id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['product_id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Updating Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['product_id']; ?>">
              <div class="form-group">
              <label for="manufacturer">Manufacturer</label>
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  
                  <input type="text" class="form-control" name="manufacturer" value="<?php echo remove_junk($product['manufacturer']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="part_number">Part Number</label>
                    <input type="text" class="form-control" name="part_number" value="<?php echo remove_junk($product['part_number']);?>">
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="product_name">Product Name</label>
                     <input type="text" class="form-control" name="product_name" value="<?php echo remove_junk($product['product_name']);?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 
                 <div class="col-md-4">
                  <div class="form-group">
                  <label for="price">Price per Unit</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                      </span>
                 <input type="number" class="form-control" name="price" value="<?php echo remove_junk($product['price']); ?>">
                 </div>
                 </div>
               </div>
               
               <div class="col-md-4">
                  <div class="form-group">
                  <label for="exp_date">Expiration Date</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                      </span>
                 <input type="date" class="form-control" name="exp_date" value="<?php echo remove_junk($product['exp_date']); ?>">
                 </div>
                 </div>
               </div>
               
               <div class="col-md-4">
                  <div class="form-group">
                  <label for="description">Description</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                      </span>
                 <input type="text" class="form-control" name="description" value="<?php echo remove_junk($product['description']); ?>">
                 </div>
                 </div>
               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
