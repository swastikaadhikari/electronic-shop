<?php
	include 'admin/databaselink.php';//database connection
	include 'header.php';//includes header file
	include 'asidecategory.php';//includes the asidecategory file
//storing the user entered 'keyword' into the variable $key sent through the asidecategpry.php
    $keyword = $_GET['key'];
    $result = $pdo->query("SELECT * FROM tbl_product WHERE product_name LIKE '%$keyword%' or brand LIKE '%keyword%' ");
?>
<main>
    <h2>Products Found</h2>
    <ul class="product" style="list-style: none;">
<?php
    $search_product = $pdo->prepare("SELECT * FROM tbl_product WHERE product_name LIKE '%$keyword%' or brand LIKE '%keyword%'");//selects the product name and brand from product table to search
    $search_product->execute();//executes the value
        foreach ($search_product as$select_product ){//works as loop
            //selects the product id, product name and product details to display
            echo '<li style="list-style:none;"><a href="showproduct.php?eid=' . $select_product['product_id'] . '"><h2>' . $select_product['product_name'] . ' </h2> </a>' .
            '<h5>Product Details:</h5><p>'.$select_product['product_detail'].'</p>' . '$' . $select_product['price'] . ' 
    <li>
    <p></p>
    </li>
    </ul>';  
    }    
 ?>
    </ul>
    </main>
    <?php
include 'footer.php';?>
