<?php ob_start();
$page_title = 'Edit user_info';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
//page_require_level(2);
?>
<?php
$user = find_by_userinfo_id('user_info',(int)$_GET['id']);

if(!$user){
  $session->msg("d","Missing user id.");
  redirect('edit_userinfo.php');
}
?>
<?php
 if(isset($_POST['user_info'])){
    $p_fname  = remove_junk($db->escape($_POST['first_name']));
    $p_lname  = remove_junk($db->escape($_POST['last_name']));
    $p_loc  = remove_junk($db->escape($_POST['location_name']));
    
  
	   if(empty($errors)){
	   $query = "UPDATE user_info";
	   $query .= " SET first_name ='{$p_fname}', last_name ='{$p_lname}',";
	   $query .= " location_name ='{$p_loc}'";
	   $query .=" WHERE user_id ='{$user['user_id']}'";     
       $result = $db->query($query);
       
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"User updated ");
                 redirect('viewproduct.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_userinfo.php?id='.$user['user_id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_userinfo.php?id='.$user['user_id'], false);
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
            <span>Updating User</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_userinfo.php?id=<?php echo (int)$user['user_id']; ?>">
              <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
              <label for="first_name">First Name</label>
                  <input type="text" class="form-control" name="first_name" value="<?php echo remove_junk($user['first_name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo remove_junk($user['last_name']);?>">
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="location_name">Location Name</label>
                     <input type="text" class="form-control" name="location_name" value="<?php echo remove_junk($user['location_name']);?>">
                  </div>
                </div>
              </div>
              <button type="submit" name="user_info" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
