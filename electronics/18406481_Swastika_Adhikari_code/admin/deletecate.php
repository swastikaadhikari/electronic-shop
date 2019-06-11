<!--This page shows about deleting the added category-->
<?php
	include'databaselink.php';//include the database link
	if(isset($_GET['did'])){//checks the variable did
		$stmt = $pdo->prepare("DELETE FROM tbl_category WHERE tbl_category.category_id = :category_id");//delete the category from the table
		$cat_criteria=[
	    'category_id'=> $_GET['did']//gets the category id
		];
		if ($stmt->execute($cat_criteria)) {
			header('Location:managecate.php?message=Category Deleted Successfully');//this section execute the passed criteria and locates the file to managecate.php file
		
		}
}
?>



