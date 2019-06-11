<?php
	session_start();//it starts the session
	include 'admin/databaselink.php';//links the database
	include 'header.php';//include header file
	include 'footer.php';//include footer file
	include 'asidecategory.php';//include asidecategory file
	if (isset($_GET['delid'])) {//checks the variable name delid
		$cart_delete = $pdo->prepare("DELETE FROM tbl_cart WHERE cart_id =:c_id");//delete the value from cart table
		$criteria_delete =['c_id' =>$_GET['delid']];//gets the id passed
		$cart_delete->execute($criteria_delete);//executes the value
	}

	$cart_product = $pdo ->prepare("SELECT * FROM tbl_cart WHERE customer_id =:customer_id");
	//selects the customer id from cart table which is stored as foreign keu
	$criteria_cart =['customer_id'=> $_SESSION['sessUId']];//passes the id of the session starts
	$cart_product ->execute($criteria_cart);//executes the passed session
?>
<body>
	<main>
			<h2>Shopping Cart:</h2>
			<?php
			foreach ($cart_product as $product) {//runs as loop
				$get_item = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = :product_id");//select the product id from product table
				$criteria =['product_id'=>$product['product_id']];
				$get_item->execute($criteria);
				$sql = $get_item->fetch();//fetch the data
			?>
				<!--selects the product name and quantity to delete from cart table -->
				<?php echo '<h3>' . $sql['product_name'].'</h3>';
				echo '<span> Quantity:'.$product['Quantity'].'</span>';?>
			<a href="#" onclick="javascript:if(confirm('Are you sure?')){
                document.location='cart.php?delid=<?php echo $product['cart_id']?>';
                }"><button>Remove from cart</button> </a>

   			<?php } ?>
  			 <form action="cart.php" method="POST">
				<span>
					<input type="submit" name="approve" value="Checked">
				</span>
		</form>
	</main>
</body>
<!--confirm the order-->
<?php
	if (isset($_POST['approve'])) {
		header('Location:order.php');
	}

?>
?>