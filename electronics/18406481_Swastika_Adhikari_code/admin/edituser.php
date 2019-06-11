<!--This page shows about editing  the existing admin-->
<?php
	session_start();//starts the session
	include'databaselink.php';//includes database link
 	include 'form_header.php';//includes header file
 	$users = $pdo->prepare("SELECT * FROM tbl_add_admin WHERE admin_id= :eid");//selects the id of the admin table
	$users->execute($_GET);//execute the passed values
	$user = $users->fetch();//fetch the data

 	if (isset($_POST['update'])) {//checks the variable update
 	$users = $pdo->prepare("UPDATE tbl_add_admin
 		                    SET
 		                       firstName = :firstName,
 		                        lastName = :lastName,
 		                       email = :email,
 		                       username = :username
 		                        WHERE admin_id= :admin_id");//update the table admin
 	unset($_POST['update']);//unset the variable update
 	if ($users->execute($_POST)) {//imports variable update
 		header('Location:manageuser.php?msg = Admin Updated successfully');
 	}
 }

?>
<body>
	<main>
		<!--sets the label for different fields in the user form-->
		<form action="edituser.php" method="POST">
			<fieldset>
			<input type="hidden" name="admin_id" value="<?php echo $_GET['eid'];?>"><!-- gets the id-->
			<h3> Enter the information to edit admin:</h3>
			<label>Enter First Name: </label>
			<input type="text" name="firstName" value="<?php echo $user['firstName'];?>"><br><br>
			<label>Enter Last Name: </label>
			<input type="text" name="lastName" value="<?php echo $user['lastName'];?>"><br><br>
			<label>Enter Email: </label>
			<input type="text" name="email"  value="<?php echo $user['email'];?>"><br><br>
			<label>Enter User Name:</label>
			<input type="text" name="username" value="<?php echo $user['username'];?>"><br><br>
			<input type="submit" name="update" value="UPDATE">
    		</fieldset>
  		</form>
	</main>
</body>