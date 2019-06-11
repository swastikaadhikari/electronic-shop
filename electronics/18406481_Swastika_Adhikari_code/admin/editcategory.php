<!--This page shows about editing  the existing category-->
<?php
	session_start();//start the session
	include'databaselink.php';//includes database
	include 'form_header.php';//includes header file
	$ecat = $pdo->prepare("SELECT * FROM tbl_category WHERE category_id= :eid");//selects the category id from category table
	$ecat->execute($_GET);//get the value to execute
	$user = $ecat->fetch();//fetch the value

	if (isset($_POST['update_category'])) {//check the variable
		$ecat = $pdo->prepare("UPDATE tbl_category
		                     SET
		                        category_name = :category_name
		                        WHERE category_id=:id");//update the table
	unset($_POST['update_category']);//unset the variable update_category
	if ($ecat->execute($_POST)) {//execute the value
		header('Location:managecate.php?msg=Updated Successfully') ;
	    }
	}

?>
<!--This part explains about the form of editing the category-->
<body>
	<main>
		<form action="editcategory.php" method="POST">
			<fieldset>
			<input type="hidden" name="id" value="<?php echo $_GET['eid'];?>">
			<legend>Edit Category</legend>
			<label for="category_name" >Category Name:</label>
			<input type="text" name="category_name" value="<?php echo $user['category_name']; ?>"><br><br>
            <input type="submit" name="update_category" value="UPDATE">
			</fieldset>
		</form>
	</main>
</body>