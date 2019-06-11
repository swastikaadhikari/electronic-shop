<!--This page shows about deleting the added admin-->
<?php
    include'databaselink.php';//includes header file
   
  if(isset($_GET['did'])){//gets the id called did
	$stmt = $pdo->prepare("DELETE FROM tbl_add_admin WHERE tbl_add_admin.admin_id = :admin_id");//delete the admin form the table and database as well
	      $delete_criteria=[
          'admin_id'=>$_GET['did']//gets the admin id
	      ];
	if ($stmt->execute($delete_criteria)) {//execute the criteria
		header('Location:manageuser.php?message=Admin Deleted Successfully');//this section execute the passed criteria and locates the file to manageuser.php file
	}
}
?>