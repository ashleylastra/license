<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
?>
<?php
$product = find_by_product_id('product',(int)$_GET['id']);
$user = find_by_userprod_id('user_info', (int)$_GET['id']);
//$prod = find_all('product_location');
//$prod_loc = find_by_prodloc_id('product_location',(int)$_GET['id']);
 /* if(!$product){
    $session->msg("d","Missing Product id.");
    redirect('product.php');
  }*/
?>
<?php
$query = "SELECT * FROM user_info, product WHERE product.product_id = user_info.product_id AND product.product_id ='{$product['product_id']}'";
$result=$db->query($query);
//mysqli_query($con, $query);
$row = mysqli_num_rows($result);

if ($row==0) {
    $sql = "DELETE FROM product WHERE product_id = '{$product['product_id']}'";
    $result = $db->query($sql);
    
} else {
    $query = "DELETE user_info, product FROM user_info STRAIGHT_JOIN product on product.product_id = user_info.product_id WHERE user_info.product_id = '{$product['product_id']}'";
    $result = $db->query($sql);
}

//$query   = "DELETE product, product_location";
//$query  .=" FROM product INNER JOIN product_location on product_location.product_id = product.product_id WHERE product.product_id = '{$product['product_id']}'";

if($db->query($query)){
    $session->msg("s","Product deleted.");
    redirect('product.php');
} else {
    $session->msg("d","Product deletion failed.");
    redirect('product.php');
}
?>
