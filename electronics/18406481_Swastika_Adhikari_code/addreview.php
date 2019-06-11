<!--This file shows about how can a user add review -->
<?php
    session_start();//it starts the session
	include'admin/databaselink.php';//database connection
	include'header.php';//include the header file
	include'footer.php';//include the footer file

	if (isset($_POST['submit'])) {//checks the variable submit
		$sql = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = :product_id");//it selects the id from product table
		$rev_criteria =['product_id'=>$_GET['eid']];//gets the product ud
		$sql->execute($rev_criteria);//executes the criteria
		$get = $sql->fetch();//fetch the data

		$rows = $pdo->prepare("INSERT INTO tbl_review(customer_id, product_id,review_text) VALUES(:customer_id,:product_id,:review_text)");//inserting the value
		//this code transfer the information using http header to the specified value entered in database
		$productCriteria =[
			'customer_id'=>$_SESSION['sessUId'],
			'product_id'=>$get['product_id'],
			'review_text'=> $_POST['review_text']
		];
		$rows->execute($productCriteria);	//executes the product criteria
	}
?>
<body>
	<main>
		<!--form for adding review-->
		 <form action="addreview.php?eid=<?php echo $_GET['eid'] ?>" method="POST">
	     	<label for="review">Your Review:</label>
            <textarea class="review_text" rows="3" name="review_text"></textarea>
	     	<input type="submit" name="submit" value="Add Review">
		</form>
</main>
</body>