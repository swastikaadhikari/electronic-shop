<?php
    include'admin/databaselink.php';//includes the database file
    include 'header.php';//includes the header file
    include 'footer.php';//includes the footer file
    include 'asidecategory.php';//includes the asidecategory file
?>
<!doctype html>
    <head>
        <title>Ed's Electronics</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="electronics.css" />
    </head>
    <body>
        <section></section>
		<main>
			<h1>Welcome to Ed's Electronics</h1>

			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
        <h2>Product list</h2>
        
        <!--displays the product in the index page-->
       <ul class="products">
        	<?php 
            $productsdisplay = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 15");//limits the product to diplay and diplay the newest product
            $productsdisplay->execute();//it executes the value
        		foreach ($productsdisplay as $user) {//works as an array
                    $product = $pdo-> prepare("SELECT * FROM tbl_product");//select the value from product table
                    $product->execute();//executes the passed value
                    $select_product = $product->fetch();//fetch the data
                    //it includes the showproduct file and shows the product name, product details and image in the index page
        			echo '<li><a href="showproduct.php?eid=' . $user['product_id'] . '"><h2>' . $user['product_name'] . ' </h2> </a>' .
                        '<h5>Product Details:</h5><p>'.$user['product_detail'].'</p><p><img src ="p_img/'.$user['img_upload'].'">'.'</p>' . '$' . $user['price'] ;}?>
        </ul>

			<hr />
        </main>   
    </body>
</html>