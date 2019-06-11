<!--This page manages the product-->
<?php
   session_start();//starts the session
   include'databaselink.php';//connect to database
   include 'form_header.php';
   $users = $pdo->prepare("SELECT * FROM tbl_product");//select the value from product table
   $users->execute();//executes the passed value
   ?>
<?php
    if (isset($_GET['message'])) echo $_GET['message'];
?>
<a href="addproduct.php">Add Product</a>
<table border="2"><!--generate the table-->
	<tr>
		<th>Product_id</th>
		<th>Category_id</th>
		<th>Product Name</th>
		<th>Brand</th>
		<th>Price</th>
		<th>Product Detail</th>
		<th>Featured Product</th>
		<th>Action</th>
	</tr>
	<?php
	$sn = 1;
	foreach ($users as $user) {
		    echo '<tr>';
		    echo '<td>' . $sn++. '</td>';
		    echo '<td>' . $user['category_id'] . '</td>';//display the category id
		    echo '<td>' . $user['product_name'] . '</td>';//display the product name
		    echo '<td>' . $user['brand'] . '</td>';//display the brand
		    echo '<td>' . $user['price'] . '</td>';//display the price
		    echo '<td>' . $user['product_detail'] . '</td>';//display the product detail
		    echo '<td>' . $user['feature_product'] . '</td>';//display the feature product
			echo'<td> <a href="editproduct.php?eid='. $user['product_id'].'">Edit </a> |
				<a href="deleteproduct.php?did='.$user ['product_id'].'">Delete</a></td>';//gives the admin option either to edit or delete category
			echo '</tr>';
		}
	?>
</table>