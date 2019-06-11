
<?php
  session_start();//starts the session
  include'admin/databaselink.php';//database connection
  include'header.php';//includes the header file

  if (isset($_POST['sign_in'])) {//checks the variable sign in
    $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE email=:email" );//selects the email from customer table
    //this code transfer the information using http header to the specified value entered in database
    $criteria = [
    'email' => $_POST['email']
  ];
  
    $stmt->execute($criteria);//execute the criteria
      if($stmt->rowCount() >0){//returns the number of rows
      $row = $stmt->fetch();
      if (password_verify($_POST['password'], $row['password'])) {//verify the password
      $_SESSION['sessUId']= $row['customer_id'];
      header('Location:index.php');//sends the header location to index php file
    }
    else{
       echo '<h5>Email or password wrong.Please try again</h5>';
    }
  } 
  else{ 
    echo '<h5>Email or password wrong.Please try again</h5>';
  }
}
?>

<head>
     <meta charset="utf-8" />
     <link rel="stylesheet" href="electronics.css" />
 </head>

<body>
  <main>
    <fieldset>
      <form method="POST" action="signin.php">
      <!--form for login -->
    	<h3> Log in to your account:</h3>
    	<label>Enter email: </label>
      <input type="text" name="email" required=""><br><br>
    	<label>Enter password:</label>
      <input type="password" name="password" required=""><br><br>
    	<input type="Submit" name="sign_in" value="Sign in">
      </form>
    </fieldset>
  </main>
</body>