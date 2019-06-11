<!--This file shows about aside category -->
<?php
    include 'admin/databaselink.php'; 
    if(isset($_POST['search'])){//checks the variable search
        $var= $_POST['search_product'];
        header("Location:searchproduct.php?key=$var");//sends the file location to searchproduct php file
}
?>
<aside>

    <form method="POST" action="asidecategory.php">
        <!--search button-->
        <input type="text" name="search_product" placeholder="Search products">
        <input type="submit" name="search" value="Search">
    </form>
 	        <h1>Featured Product</h1>
 	        <?php
 	        $FeaturedProduct = $pdo->prepare("SELECT * FROM tbl_product");//selects the product from product table to show as featured product
 	        $FeaturedProduct->execute();//executes the product
 	          foreach ($FeaturedProduct as $product) {//checks the array
                if ($product['feature_product']==='YES') {//checks whether product is marked as featured or not
                         echo '<li style="list-style:none;"><a  href="showproduct.php?eid=' . $product['product_id'] . '"><h4>' . $product['product_name'] . ' </h4> </a>' .
                  '$' . $product['price'].'</li>';//displays the product name, product id and price
            }
                echo'</ul>';
         
                }
            ?>
		</aside>     
	