<!--This page manages the regisetered user-->
<?php
	session_start();//starts the session
	include'databaselink.php';//connect to database
	include 'form_header.php';
	$users = $pdo->prepare("SELECT * FROM tbl_customer");//select the value from customer table
	$users->execute();//execute the passed value
?>
<?php
	if (isset($_GET['message'])) echo $_GET['message'];
?>
<table border="2">
	<tr>
		<th>SN</th>
		<th>Full Name</th>
		<th>Email</th>
        <th>Last Name</th>
		<th>Action</th>
	</tr>
	
<?php
$sn=1;
foreach ($users as $user) {
       echo '<tr>';
	   echo '<td>'. $sn++ . '</td>';
	   echo '<td>'. $user['fullName'] . '</td>';//display the customer full name
	   echo '<td>'. $user['email'] . '</td>';//display the customer email
	   echo '<td>'. $user['contact_no'] .'</td>';//display the customer contact number
	   echo '<td><a href="deleteuser.php?did='. $user['customer_id'].'">Delete</a></td>';//gives the admin a option to delete the user
	   echo'</tr>';
		}
	?>
</table>




