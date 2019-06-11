<!--This page shows about editing  the existing product-->
<?php
    session_start();//starts the session
    include'databaselink.php';//includes the database link
    include 'form_header.php';//includes the header link
    $users = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = :eid");//select the id
    $users->execute($_GET);//execute the passed value
    $user = $users->fetch();//fetch the value

    if (isset($_POST['product_update']))//check the variable product_update
     {
        extract($_POST);//imports variable product_update
        $users = $pdo->prepare("UPDATE tbl_product
                            SET
                             category_id = :category_id,
                             product_name = :product_name,
                             brand = :brand,
                             price = :price,
                             product_detail = :product_detail,
                             feature_product =:feature_product,
                             img_upload = :img_upload
                             WHERE product_id= :product_id ");//update the data in table product

        unset($_POST['product_update']);//unset the varible product_update
        if ($users->execute($_POST)) {//execute the value
            header('Location:manageproduct.php?user= Product Updated Successfully');
    }
}
?>

<body>
	<main>
        <!--sets the label for different fields in the product form-->
<form action="editproduct.php" method="POST" >
	<input type="hidden" name="product_id" value="<?php echo $_GET['eid'];?>"><!--get the id passed -->
	<fieldset>
	<h3>Edit Product:</h3>
            <label for = "product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?php echo $user['product_name'];?>"><br><br>
            <label for="brand">Brand:</label>
            <input type="text" name="brand" value="<?php echo $user['brand'];?>">
            <label>Edit Image</label>
            <input type="file" name="img_upload" value="<?php echo $user['img_upload']; ?>">
            <label for="price">Price:</label>
            <input type="text" name="price" value="<?php echo $user['price'];?>">
            <label for="product_detail">Product Detail:</label>
            <textarea name="product_detail" id="product_detail" cols="5" rows="3"><?php echo $user['product_detail'];?></textarea>
            <label for="feature_product">Featured Product</label>
            <input type="radio" name="feature_product" value="YES"> <label style="margin-top: 0; width:  20%;">YES</label>
            <input type="radio" name="feature_product" value="NO"> <label style="margin-top: 0; width:  20%;">NO</label>
            <label for="category">Category:</label>
            <select name="category_id" style="width: 50%;">
                <?php
                $table_user = $pdo->prepare("SELECT * FROM tbl_category");//select the id from category table
                $table_user->execute();
                foreach ($table_user as $resu) {
                    echo '<option value="'.$resu['category_id'].'"';//gets the id
                    if ($user['category_id']==$resu['category_id']) {echo 'selected';}//check the value
                    echo'>';
                    echo $resu['category_name'];
                    echo '</option>';
                }
                ?>
            </select>
            <input type="submit" name="product_update" value="UPDATE">
            </fieldset>
        </form>
    </main>
</body>
