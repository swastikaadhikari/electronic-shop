<!--This page shows about adding the product-->
<?php 
    session_start();// it start the session 
    include'databaselink.php';//includes the php file
    include 'form_header.php';//includes php file so that amount of code is reduced
   
    if (isset($_POST['product_add'])) {//to check if the variable is set or not
	//it prepare to insert the value
        extract($_POST);
        //this code is used to upload the images
        $file_upload = "../p_img/";
        $upload = $_FILES['p_img']['tmp_name'];
        $sent_file = $file_upload.basename($_FILES['p_img']['name']);
        //image upload
        //inserting the value of product in the product
	$stmt = $pdo->prepare("INSERT INTO tbl_product(category_id,product_name, brand,product_detail,price,feature_product,img_upload)VALUES(:category_id,:product_name,:brand,:product_detail,:price,:feature_product,:img_upload)");
    //this code transfer the information using http header to the specified value entered in database
	$add_criteria=[
        'category_id'=>$_POST['category_id'],
		'product_name'=>$_POST['product_name'],
		'brand'=>$_POST['brand'],
		'product_detail'=>$_POST['product_detail'],
        'price'=>$_POST['price'],
        'feature_product'=> $_POST['feature_product'],
        'img_upload'=>$_FILES['p_img']['name']
	];
    move_uploaded_file($upload, $sent_file);//upload the file

    if ($stmt->execute($add_criteria)) {//execute the criteria

		// header('Location:manageproduct.php?msg=Added  Successfully') ;

        // sending mail to users about product updates
        $user_email = $pdo-> prepare("SELECT * FROM tbl_customer WHERE email_notify = 1");
        $user_email-> execute();
            foreach ($user_email as $notify_email) {//it is work as an array and check the function
            $for = $notify_email['email'];
            $subject = "Product added ";
            $text = "Dear customer, \n We notify you that a new product has been added.";
            $sender = "From : admin@gmail.com" . "\r \n".
             "CC:someone@ex.com";
            mail($for,$subject,$text,$sender);
            }
        }
    else
        echo 'NO';
    } 
 ?>
<body>
<main>
	<form action="addproduct.php" method="POST" enctype = "multipart/form-data"> 
        <!--to make the form-->
		<fieldset>
            <!--label used for different fields in the table-->
		<h3>Add Product</h3>
            <label for = "product_name">Product Name:</label>
            <input type="text" name="product_name" >
            <label for="brand">Brand:</label>
            <input type="text" name="brand">
            <!--for uploading image-->
            <label for="p_img">Upload Image:</label>
            <input type="file" name="p_img">
            <label for="price">Price:</label>
            <input type="text" name="price">
            <label for="product_detail">Product Detail:</label>
            <textarea name="product_detail" id="product_detail" cols="5" rows="3"></textarea>
            <label for="feature_product">Featured Product</label>
            <input type="radio" name="feature_product" value="YES" > <label style="margin-top: 0; width:  20%;">YES</label>
            <input type="radio" name="feature_product" value="NO"> <label style="margin-top: 0; width:  20%;">NO</label>
            <label for="category">Category:</label><!--label for category-->
            <!--it select the foreign key and passes the value-->
            <select name="category_id" style="width: 50%;">
            	<?php
            	$user = $pdo->prepare("SELECT * FROM tbl_category");//selects the alue from category table
                $user->execute();//it execute the passed value
            	foreach ($user as $resu) {//works as an array
            		echo '<option value="'.$resu['category_id'].'">';
            		echo $resu['category_name'];//selects the category name
            		echo '</option>';
            	}
            	?>
            </select>
            <input type="submit" name="product_add" value="ADD">
		</fieldset>
	</form>

</main>
</body>