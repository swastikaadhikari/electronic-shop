<!--This file shows about drop down category -->
<?php 
	session_start();// it start the session 
	include 'header.php';//include the header file
	include 'footer.php';//include the footer file
	include 'asidecategory.php';//include the asidecategory file
	include 'admin/databaselink.php';//database connection
	$productClick = $pdo->prepare("SELECT * FROM tbl_product WHERE category_id = :category_id");//selects the categpry id which is set as foriegn key in product table
	$array = ['category_id' =>$_GET['category_id']];//gets the category_id
	$productClick->execute($array);//executes the passed id
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Ed's Electronics</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="electronics.css" />
</head>
<body>
	<main>
		<h2>Product List</h2>
		<ul class="product" style="list-style: none;">
			<?php foreach ($productClick as $displayproduct) { //works as an array
				$list_product = $pdo-> prepare("SELECT * FROM tbl_product");//select the value from product table
				$list_product ->execute();//execute the passed value
				$select_product = $list_product->fetch();//fetch the data
				
				//shows the product in drop down menu
			 	 echo '<li style= "list-style:none;"> <a href="showproduct.php?eid=' . $displayproduct['product_id'] . '"><h2>' . $displayproduct['product_name'] . ' </h2> </a>' .
                '<h5>Product Detail:</h5><p>'.$displayproduct['product_detail'].'</p>' . '$' . $displayproduct['price'] . '
    <li>
        <p></p>
    </li>
</ul>';        }?>

		</ul>	
		</main>
	</body>
</html>