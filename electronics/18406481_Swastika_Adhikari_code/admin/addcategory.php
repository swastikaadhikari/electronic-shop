<!-- This page add the category.-->
<?php
	session_start();// it start the session 
	include 'form_header.php';//includes header file
	include'databaselink.php';//includes database link
	if (isset($_POST['add_category'])) {//checks the variable add_category
	$stmt = $pdo->prepare("INSERT INTO tbl_category(category_name)VALUES(:category_name)");//inserting the value
	$criteria =[
		'category_name' =>$_POST['category_name']//post the value
	];
	if ($stmt ->execute($criteria)) {//it executes the criteria
		header('Location:managecate.php?msg=Category Added Successfully');}//it locates the path
		else{
			echo 'No';
		}
	
}
?>

<!--This is the form for adding category-->
<body>
	<main>
		<form action="addcategory.php" method="POST">
			<fieldset>
			<legend>Add Category</legend>
			<!--adding the field name category name in the form-->
			<label class="category_name">Category Name:</label>
			<input type="text"  name="category_name">
   			<input type="submit" name="add_category" value="SUBMIT">
			</fieldset>
	</main>
</body>