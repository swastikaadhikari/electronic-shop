<!--This page shows about deleting the added product-->

<?php
	include'databaselink.php';//include the php file

if (isset($_GET['did'])) {//set the id
	$stmt = $pdo->prepare("DELETE FROM tbl_product WHERE tbl_product.product_id = :product_id");//delete the product form the table
	$pro_criteria=[
		'product_id'=> $_GET['did']//get the id from the required the table
	];
	if ($stmt->execute($pro_criteria)) {
		header('Location:manageproduct.php?message=Product Deleted Successfully' );//this section execute the passed criteria and locates the file to manageproduct.php file
	}
}

?>