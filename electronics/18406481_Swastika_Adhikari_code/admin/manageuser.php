<!--This page manages the admin-->
<?php
	session_start();//starts the session
	include'databaselink.php';//connect to database
	include 'form_header.php';
	$users = $pdo->prepare("SELECT * FROM tbl_add_admin");//select the value from table add admin
	$users->execute();//execute the passed value
?>
<?php
	if (isset($_GET['message'])) 
   echo $_GET['message'];
?>
<a href="adduser.php">Add Admin</a>
<table border="2">
	<tr>
		<th>SN</th>
		<th>First Name</th>
        <th>Last Name</th>
		<th>Email</th>
		<th>User Name</th>
		<th>Action</th>
	</tr>
	
<?php
$sn=1;
foreach ($users as $user) {
       echo '<tr>';
	   echo '<td>'. $sn++ . '</td>';
	   echo '<td>'. $user['firstName'] . '</td>';//display the firstName
	   echo '<td>'. $user['lastName'] . '</td>';//display the lastName 
	   echo '<td>'. $user['email'] .'</td>';//display the email 
	   echo '<td>'.$user['username'] . '</td>';//display the username
	   echo '<td><a href="edituser.php?eid='. $user['admin_id'].'">Edit</a> | <a href="deleteadmin.php?did='. $user['admin_id'].'">Delete</a></td>' ;//gives the admin authority to delete or edit the added admin
	   echo'</tr>';
		}
	?>
</table>



