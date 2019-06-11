<!--This page view the shipping details for admin-->
<?php
	session_start();//starts the session
	include 'databaselink.php';//includes the database file
	include 'form_header.php';//includes the header file

	$admin_view = $pdo->prepare("SELECT * FROM tbl_order");//selects the value from order table
	$admin_view->execute();//execute the statement

	if (isset($_POST['deliver'])) {//checks the defined variable deliver
		foreach ($admin_view as $send_order) {//is used to loop the value
			$shipped_item = $pdo->prepare("UPDATE tbl_order SET shipped =:shipped WHERE order_id=:id_order");//update the table order where value is set to shipped
			$check_ship =['shipped' =>$_POST['deliver_item'],//check the value
			'id_order'=>$send_order['order_id']];//the id given to the order table
			$shipped_item->execute($check_ship);//execute the statement
		}
	}
?>
<body>
	<main >
		<!--form for the shipping details table-->
		<form action="shippingDetail.php" method="POST">
		<table border="2">
			<h2>Order Information</h2>
			<tr>
				<th>SN</th>
				<th>Buyer Name</th>
				<th>Email</th>
				<th>Product</th>
				<th>Amount</th>
				<th>Order Date</th>
				<th>Shipped</th>
			</tr>
		<?php
		$sn=1;

		foreach ($admin_view as $send_order) {
			$shipping_cart=$pdo->prepare("SELECT * FROM tbl_cart WHERE cart_id = :cart_id");//selects the id from card table
			$criteria_detail =['cart_id' => $send_order['cart_id']];//sets the variable name
			$shipping_cart->execute($criteria_detail);//execute the statement
			$row = $shipping_cart->fetch();//fetch the data
			echo'<tr>';
			echo '<td>'. $sn. '</td>';
				$sn++;
			echo '<td>';
			echo $send_order['cus_name'];//displaye the customer name
			echo '</td>';

			echo'<td>';
			$user_email = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_id =:customer_id");//selects the customer id from customer table
			$condition=['customer_id'=>$row['customer_id']];//defines a variable name
			$user_email->execute($condition);//executes the given data
			$show_row =$user_email->fetch();//fetch the data
			echo $show_row['email'];//displays email of the customer
			echo '</td>';
			echo '<td>';
			$order_item = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = :product_id");//selects the product id from product table
			$condition=['product_id'=>$row['product_id']];
			$order_item->execute($condition);
			foreach ($order_item as $item ) 
				echo $item ['product_name'];//displays the prdouct name
				echo '</td>';
				echo '<td>'.$row['Quantity'].'</td>';//displays the quantity
				echo '<td>'.$send_order['date'].'</td>';//displays the date
				echo '<td><select name="deliver_item">';
				$aa;
				if ($send_order['shipped']==1)$aa='selected';//check the shipped status
					else $aa='';
					echo'<option value="0">Pending</option><option value="1"'; echo $aa.'>Shipped</option> </select></td>';//if the value is 1 it is shipped
           			 echo '</tr>';
			}
		?>
			</table>
			<input type="submit" name="deliver" value="DELIVER">
		</form>
	</main>
</body>