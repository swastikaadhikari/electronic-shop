<!--This page shows about login of the admin -->

<?php
  session_start();
  if (isset($_SESSION['sessUId'])) {//checks the id
      header('Location:index.php');
    }
  include'databaselink.php';
?>
<!--css file include-->
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../css/electronics.css" />
</head>

<?php
  if (isset($_POST['login'])) {//checks the variable login
    $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE email = :email");//selects the email of admin
    $criteria = [
    'email' => $_POST['email']
  ];
  $stmt->execute($criteria);//executes the passed criteria
    if($stmt->rowCount()>0){//return the row
      $row = $stmt->fetch();//fetch the data
      if (password_verify($_POST['password'], $row['password'])) {//verify the password
        $_SESSION['sessUId']= $row['admin_id'];//if the password is correct then sends to the required location
        header('Location:index.php');
    }
    else
       echo'<h5>Email or password wrong.Please try again</h5>';
  } 
  else 
    echo'<h5>Email or password wrong.Please try again</h5>';
}
?>

<body>
	<main>
      <form method="POST" action="login.php">
        <fieldset>
        <h3> Log in to your account</h3>
	      <label>Enter email: </label><input type="email" name="email"><br><br>
	      <label>Enter password:</label><input type="password" name="password"><br><br>
	      <input type="submit" name="login" value="Log in">
        </fieldset>
      </form>
    </main>
</body>
