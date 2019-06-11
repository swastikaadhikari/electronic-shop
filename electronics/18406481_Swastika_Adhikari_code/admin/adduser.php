<!--This page shows how a new admin can be added-->

<?php
	session_start();// it start the session 
	include'databaselink.php';//includes the database link
	include 'form_header.php';//includes the form_header link
	if (isset($_POST['admin_add'])) {//check if the variable admin_add is set or not
		$stmt = $pdo->prepare("INSERT INTO tbl_add_admin(firstName, lastName, email, username, password)VALUES (:firstName, :lastName, :email, :username, :password)");//inserting the value in table
		//this code transfer the information using http header to the specified value entered in database
		$user_criteria = [
		'firstName' => $_POST['firstName'],
		'lastName' =>$_POST['lastName'],
		'email'=>$_POST['email'],
		'username'=>$_POST['username'],
		'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT)//sets the hash password
	];
	if ($stmt->execute($user_criteria)) 
		header('location:manageuser.php?msg=Admin added successfully');//sends the header file
	else
		echo 'No';
}
?>

<!--This sets the form for adding a new admin-->
<body>
	<main>
		<form action="adduser.php" method="POST">
			<fieldset>
				 <!--label used for different fields in the table-->
				<legend>Add Admin</legend>
					<label for="firstName">First Name:</label>
					<input type="text" name="firstName" required="">
					<label for="lastName">Last Name:</label>
					<input type="text" name="lastName" required="">
                	<label for="email">Email:</label>
               	    <input type="email" name="email" required="">
                	<label for="username">Username:</label>
                	<input type="text" name="username" required="">
               	    <label for="password">Password</label>
                	<input type="password" name="password" required="">
                	<input type="submit" name="admin_add" value="SUBMIT">
			</fieldset>
		</form>
	</main>
</body>