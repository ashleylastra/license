<?php 
ob_start();
require_once('includes/load.php');
// Checkin What level user has permission to view this page
//page_require_level(2);
?>
<?php
$user = find_by_userinfo_id('user_info', (int)$_GET['id']);
//$prod = find_all('product_location');
//$prod_loc = find_by_prodloc_id('product_location',(int)$_GET['id']);
  if(!$user){
    $session->msg("d","Missing user id.");
    redirect('viewproduct.php');
  }
?>
<?php
//$query = "DELETE FROM user_info WHERE user_id = '{$user['id']}'";
//$query   = "DELETE product, product_location";
//$query  .=" FROM product INNER JOIN product_location on product_location.product_id = product.product_id WHERE product.product_id = '{$product['product_id']}'";
//$result = $db->query($query);
$delete_id = delete_by_userinfo_id('user_info', (int)$_GET['id']);

if($delete_id){
    $session->msg("s","User deleted.");
    redirect('viewproduct.php');
} else {
    $session->msg("d","User deletion failed.");
    redirect('viewproduct.php');
}
?>
