<!--admin view user ani review herxa-->
<?php
	session_start();//starts the session
	include 'form_header.php';//includes the header file
	include 'footer.php';//include the footer file
	include 'databaselink.php';//includes the db link

	$customer = $pdo->prepare("SELECT * FROM tbl_customer");//select the value from customer table
	$customer->execute();
?>
<body>
	<main>
		<h2>CUSTOMERS</h2>
		<ul class="users" style="list-style: none;">
			<?php
			foreach ($customer as $value) {//works as an array
				 echo '<li style="border: 1px solid #000;"><a href="review_view.php?cid=' . $value['customer_id'].'"><h2>' . $value['fullName'] . ' </h2> </a>';}//display the customer id and name who reviewed the product 
				 ?>
			
	</main>
</body>