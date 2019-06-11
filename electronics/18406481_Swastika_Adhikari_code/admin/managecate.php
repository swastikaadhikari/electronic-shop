<!--This page manages the category-->
<?php
	session_start();//starts the session
	include'databaselink.php';
	include 'form_header.php';
	$users = $pdo->prepare("SELECT * FROM tbl_category");//select the data from table category
	$users->execute();//executes the passed variable 
	?>
	<?php if (isset($_GET['message'])) echo $_GET['message']; ?><!--Passes the message-->
	<a href="addcategory.php">Add Category</a>
	<table border="2"><!--generate the table-->
		<tr>
			<th>Category_id</th>
			<th>Category Name</th>
			<th>Action</th>
		</tr>
	
<?php
	$sn = 1;
	foreach ($users as $user) {
		echo '<tr>';
		echo '<td>' . $sn++ . '</td>';
		echo '<td>' . $user['category_name'] . '</td>';//display the category name
		echo '<td><a href="editcategory.php?eid='. $user['category_id'].'">Edit</a> | <a href="deletecate.php?did='. $user['category_id'].'">Delete</a></td>' ;//gives the admin option either to edit or delete category
		echo '</tr>';//
	}
?>
</table>
