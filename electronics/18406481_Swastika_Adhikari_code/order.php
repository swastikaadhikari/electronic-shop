<?php
	session_start();//it starts the session
	include 'admin/databaselink.php';//database link
	include 'header.php';//includes the header file
	include 'asidecategory.php';//includes the asidecategory file
	include 'footer.php';//includes the footer file

	$amount =[];//declaring an array
	//query the items in the cart
	$cart_item = $pdo-> prepare ("SELECT * FROM tbl_cart WHERE customer_id = :cus_id");
	$criteria_cart =['cus_id'=>$_SESSION['sessUId']];
	$cart_item->execute($criteria_cart);

	//checks if every field in the form is filled or not
	if (isset($_POST['orders'])) {
		extract($_POST);
		$showerror ='';
		if ($cus_name == '' || $phone_no == '' || $city == '' || $street == '' || $country == '') $showerror = $showerror. '<p> Please fill out the fields.</p>';
		foreach ($cart_item as $list_order) {
			$order_confirmation = $pdo->prepare("INSERT INTO tbl_order(cart_id,cus_name,phone_no,city,street,country)VALUES (:cart_id,:cus_name,:phone_no,:city,:street,:country)");
			//this code transfer the information using http header to the specified value entered in database
			$criteria_order = [
				'cart_id' => $list_order['cart_id'],
				'cus_name'=>$_POST['cus_name'],
				'phone_no' =>$_POST['phone_no'],
				'city' =>$_POST['city'],
				'street'=>$_POST['street'],
				'country'=>$_POST['country']
			];
			$order_confirmation->execute($criteria_order);
		}
	}
?>
<body>
	<main>
	<form action="order.php" method="POST">
		<!--form for the order table-->
		<div class="delivery_information" style="height: 65vh;">
			<h2>Information about delivery:</h2>
			<label for="cus_name">Enter name</label>
			<input type="text" name="cus_name">
			<label for="phone_no">Contact Number:</label>
			<input type="text" name="phone_no">
			<h5 style="width: 50%;">Shipping Information:</h5>
			<label for="street">Street:</label>
			<input type="text" name="street">
			<label for="city">City:</label>
			<input type="text" name="city">
			<label for="country">Country:</label>
			<input type="text" name="country">
		</div>
		<!--to calculate total amount of the product-->
		<div class="total_amount">
			<h1 style="margin-top: 10%;">Products</h1>
			<?php
			//to display the item
			foreach ($cart_item as $display_item) {
				$_SESSION['sessCID']=$display_item['cart_id'];
				$value=$display_item['Quantity'];
			echo'<ul>';
				$display_cart = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id =:id_p");
				$criteria_pro = ['id_p' =>$display_item['product_id']];
				$display_cart->execute($criteria_pro);
				foreach ($display_cart as $select_pro) {
					$amount[] = $select_pro['price'];

					echo '<li><a href="showproduct.php?eid=' .$select_pro['product_id'] .'"><h2>' .$select_pro['product_name']. '</h2></a>' . '$' . $select_pro['price'].'<p> Quantity:'.$value.'</p>';//displays the item and is linked to showproduct file as well
				}
			echo'</ul>';}?>
			<!--calculating the amount of the product-->
			<article> Total Amount:</article>
			<p><input type="text" disabled="" value="<?php $sum=0;
			for($a=0; $a<count($amount); $a++){
				$sum = doubleval($sum) + doubleval($amount[$a])*intval($value);
				}
				echo'$ ' .$sum?>"></p>
		</div>
		<input type="submit" name="orders" value="Your order" id="order_btn">
		</form>
	</main>
</body>