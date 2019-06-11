<?php
	session_start();
	$link = $_SERVER['SCRIPT_NAME'];// retrieve the current link
	include 'admin/databaselink.php';//database connection
	include 'header.php';//includes the header file
	include 'footer.php';//includes the footer file
	include 'asidecategory.php';//includes the aside category
	
	$select_product = $pdo-> prepare("SELECT * FROM tbl_product WHERE product_id = :product_id");//selects the product id from product table
	$product =['product_id' => $_GET['eid']];//gets the id
	$select_product->execute($product);//execute the data
	$list_item = $select_product->fetch();//fetch the data
?>
<!--adding item in cart-->
<?php
	if (isset($_POST['order'])) {//checks the variable name order
		if (isset($_SESSION['sessUId'])) {//checks the session id
			//insert the value in cart table
			$cart_item = $pdo->prepare("INSERT INTO tbl_cart(customer_id, product_id,Quantity) VALUES(:customer_id,:product_id,:Quantity)");
			//this code transfer the information using http header to the specified value entered in database
			$criteria_cart = [
				'customer_id' => $_SESSION['sessUId'],
				'product_id' =>$list_item['product_id'],
				'Quantity' => $_POST['Quantity']
			];
			$cart_item ->execute($criteria_cart);
		}
		else
		{
			header('Location:signin.php');
		}
	}


?>
<body>
	<main>
		<!--diplays the product name, product detail and price-->
		<h2><?php echo $list_item['product_name'];?></h2>
		<p><?php echo $list_item['product_detail'];?></p>
		<!--image upload-->
		<p><?php echo '<img src ="p_img/'.$list_item['img_upload'].'">';?></p>	
		<span><p><?php echo '$'.$list_item['price'];?></p></span>

		<!--shows the review in the index page-->
		<div class="review" style="list-style: none;">
		<h4>Reviews</h4>
		 <?php
                $give_review=$pdo->prepare("SELECT * FROM tbl_review WHERE product_id = :produ_id ");//selects the product id from review table 
                $rev_criteria=['produ_id'=>$list_item['product_id']];
                $give_review->execute($rev_criteria);
                foreach ($give_review as $show_rev) 
                {
                	//to view the reviewer name and review text
                    echo '<li><p>'.$show_rev['review_text'].'</p>';//displays the review text
                    $name_of_reviewer=$pdo->prepare("SELECT * FROM tbl_customer WHERE customer_id= :id_review");//selects the customer id from customer table 
                    $display_rev=['id_review'=>$show_rev['customer_id']];
                    $name_of_reviewer->execute($display_rev);
                    $show=$name_of_reviewer->fetch();//fetch the data
                    echo '<div class="details"><span>'. 'Reviewed by: '.$show['email'].'</span>'.'Date:'.$show_rev['review_date'].'</span>'.'</div></li>';//displays the reviewer email and date
                }
                ?>
            
	<!--social media link-->
			<!--Facebook for Developers. 2019. Share Button - Social Plugins - Documentation - Facebook for Developers. [ONLINE] Available at: https://developers.facebook.com/docs/plugins/share-button/. [Accessed 12 January 2019].-->
		<iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Flocalhost%2Fassignment%2Fshowproduct.php%3Feid%3D21&layout=button_count&size=small&mobile_iframe=true&width=69&height=20&appId" width="73" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
		<a href="http://www.facebook.com/sharer/sharer.php?u=https://localhost<?php echo $url;?>">Share </a>
		</div>
		<!--to sign in before adding review and adding product to cart-->
		<div>
			<a href="<?php
			if(isset($_SESSION['sessUId']))//checks the session id
				echo 'addreview.php?eid='.$list_item['product_id'];
			else 
				echo'signin.php';?>"> Add Review</a></div>
			<?php echo '<form action = "showproduct.php?eid='.$list_item['product_id'].'" method="POST">';?>
			<label for="Quantity">Enter the required quantity:</label>
			<input type="number" name="Quantity" value="1">
			<input type="submit" name="order" value="Add To Cart">
			
			<!--payment through PayPal-->
		<!-- From: https://developer.paypal.com/docs/checkout/quick-start/-->
		<div id="paypal-button-container"></div>
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>
		<script>
			// provides the PayPal button in the page
            paypal.Button.render({
// Set the  environment our system
                env: 'sandbox', // sandbox | production

// Specify the style of the button
                style: {
                    layout: 'vertical',  // horizontal | vertical
                    size:   'medium',    // medium | large | responsive
                    shape:  'rect',      // pill | rect
                    color:  'gold'       // gold | blue | silver | white | black
                },
// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
                funding: {
                    allowed: [
                        paypal.FUNDING.CARD,
                        paypal.FUNDING.CREDIT
                    ],
                    disallowed: []
                },

// Enable Pay Now checkout flow (optional)
                commit: true,

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
                client: {
                    sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: '<insert production client id>'
                },

                payment: function (data, actions) {//set up the payment option
                    return actions.payment.create({//creates the payment method
                        payment: {
                            transactions: [//payment method
                                {
                                    amount: {//specify the amount
                                        total: '0.01',
                                        currency: 'USD'
                                    }
                                },

                            ]
                        }
                    });
                },

                onAuthorize: function (data, actions) {//execute the payment function
                    return actions.payment.execute()//executes the payment method
                        .then(function () {
                            window.alert('Payment Complete!');//alert message
                        });
                }
            }, '#paypal-button-container');//button for paypal
        </script>
		</script>
	</main>
</body>