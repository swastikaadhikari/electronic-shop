<!--This page is for admin who can view the review-->
<?php
	session_start();//it starts the session
	include 'databaselink.php';//includes the database file
	include 'form_header.php';//includes the form_header file
	include 'footer.php';//includes the footer file
	$users = $pdo->prepare("SELECT * FROM tbl_review");//it select the value 
	$users->execute();//execute the selected value
	if (isset($_POST['save'])) {//check the varaiable save
		header('Location:approveReview.php');
	}
?>
<body>
	<main>
	<h2>REVIEW</h2>
	<table border="2"><!--to generate a table-->
	<tr>
		<th>SN</th>
		<th>Product Name</th>
		<th>Customer Name</th>
		<th>Review Date</th>
		<th>Review Text</th>
		<th>Approve</th>
	</tr>

<?php
	$sn = 1;
	foreach ($users as $app) {//works as an array
		echo '<tr>';
		echo '<td>'. $sn++ . '</td>';
		//viewing product name
		echo '<td>';
		$row = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id =:product_id");//it selects the value
		$row_pro=['product_id'=>$app['product_id']];//passes the id of the product table
		$row->execute($row_pro);//execute the passed id
		$row_product=$row->fetch();//fetch the data
		echo $row_product['product_name'];//display the product name
		echo '</td>';
		echo'<td>';
		//user who give review
		$post = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_id = :customer_id");//selects the customer id from customer table
		$row_pro=['customer_id'=>$app['customer_id']];//passes the id of customer table
		$post->execute($row_pro);//execute the passed product id
		$user_review=$post->fetch();//fetch the executed data
		echo $user_review['fullName'];//display the customer name
		echo '</td>';
		echo '<td>'.$app['review_date'] . '</td>';//display the review date
		echo '<td>' .$app['review_text'] . '</td>';//display the review text
		echo '<td>';
		if ($app['approved']==1) //checking for confirmation
			$check = 'confirm = "confirm"';
			else 
				$check ='';
			echo'<form action = "approveReview.php? method = "POST">';
			$check_id = $app['review_id'];//check the review id from review table
		echo '
		<input type = "checkbox" name = "check" ['.$app['review_id'].']" value = "1" '.$check.'></form>';//for checkbox of approval of review
		if (isset($_POST['check['.$check_id.']'])) {
			 	$approve = $pdo -> prepare("UPDATE tbl_review SET view =  '1' WHERE product_id = :product_id");//update the table review where value is set to 1
			 	$row_pro=['product_id'=>$app['product_id']];//passes the id
			 	$approve ->execute($row_pro);
		 	}
		else{
			$approve = $pdo-> prepare("UPDATE tbl_review SET view = '0' WHERE product_id = :product_id");//update the table review where value is set to 0
			$row_pro=['product_id'=>$app['product_id']];
			$approve->execute($row_pro);
		}

		echo '</td>';
	echo'</tr>';
}		
?>
</table>
		<form action="approveReview.php" method="POST">
		<input type="submit" name="save" value="save">
		</form>
	</main>
</body>