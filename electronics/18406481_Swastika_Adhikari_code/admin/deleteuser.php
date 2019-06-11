<!--This page shows about deleting the existing customer-->
<?php
	include'databaselink.php';//includes header file

	if(isset($_GET['did'])){//checks the variable did and displays in the server
		$stmt = $pdo->prepare("DELETE FROM tbl_customer WHERE tbl_customer.customer_id = :customer_id");//delete the customer from the customer table
		$cus_criteria=[
	    'customer_id'=> $_GET['did']//gets the customer id
		];
		if ($stmt->execute($cus_criteria)) {
			header('Location:manageregisteruser.php?message=User Deleted Successfully');//this section execute the passed criteria and locates the file to managregistereduser.php file
		}
		
	}
?>
