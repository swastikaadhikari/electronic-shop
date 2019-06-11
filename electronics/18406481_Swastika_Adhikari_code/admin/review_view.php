<?php
	session_start();//it starts the session
	include 'databaselink.php';//include the database file
	include 'form_header.php';//include the header file
	include 'footer.php';//include the footer file
	//selects the value from review table where customer id is set as foreign key
	$show_review = $pdo->prepare("SELECT * FROM tbl_review WHERE customer_id =:rev_id");//variable ko naam
	$cri_rev = ['rev_id' =>$_GET['cid']];
	$show_review->execute($cri_rev);//executes the value
?>
<body>
	<main>
		<?php
			foreach ($show_review as $key ) {//is used to loop the value
				$value_rev = $pdo ->prepare("SELECT * FROM tbl_product WHERE product_id =:rev_p_id");//selects the product id from product table
				$show_cri =['rev_p_id'=>$key['product_id']];
				$value_rev ->execute($show_cri);//execute the show_cri
				$show_name=$value_rev->fetch();//fetch the data
				echo '<ul style ="list-style:none;">';//css
				echo '<li style="border: 1px solid #000;">' .'<h4>'.$show_name['product_name']. '</h4>'.$key['review_text'] .'</li>';}//shows the product name and review to the admin
        		echo '</ul>';
		?>
	</main>
</body>