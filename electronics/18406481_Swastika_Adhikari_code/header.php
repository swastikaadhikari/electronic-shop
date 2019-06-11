<?php
	error_reporting(E_ERROR | E_PARSE); //to set the directive
	session_start();//starts the session
	include'admin/databaselink.php';//includes the database file
?>
<!doctype html>
<html>
	<body>
		<header>
			<h1>Ed's Electronics</h1>
            <head>
              <meta charset="utf-8" />
		      <link rel="stylesheet" href="electronics.css" />
            </head>
			<ul>
				<li><a href="index.php">Home</a></li><!--link to index page-->
				<li>Products
					<ul>
						<?php
						$addproduct= $pdo->prepare("SELECT * FROM tbl_category");//selects the value from category table
						$addproduct->execute();//it execute the value
						foreach ($addproduct as $value) {
							echo '<li><a href="categoryview.php?category_id='. $value['category_id'].'">'. $value['category_name'].'</a></li>' ;//gets the value from categoryview.php file
						}
						?>
					</ul>
				</li>
		<li>
    	<a href="<?php
    		if (isset($_SESSION['sessUId'])) echo 'signout.php'; else echo 'signin.php';?>"><!--sets the session id for logging in-->
     		<?php 
     		if(isset($_SESSION['sessUId'])) echo 'Sign Out';//<!--sets the id for logging out--> 
     		else echo 'Sign In';?>
    	</a>
    	</li>
     		<li><a href="<?php if (isset($_SESSION['sessUId'])) echo 'cart.php'; else echo 'register.php';?>"> <?php if(isset($_SESSION['sessUId'])) echo 'Check Out'; else echo 'Register';?></a></li><!--sets the session id for register and checkout-->
			</ul>

			<address>
				<p>We are open 9-5, 7 days a week. Call us on
					<strong>01604 11111</strong>
				</p>
			</address>

	
		</header>
	</body>
	</html>