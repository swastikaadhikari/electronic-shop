<?php
  session_start();//starts the session
  include 'admin/databaselink.php';//link the database
  include'header.php';//link the header file
  if (isset($_POST['register'])) {
    extract($_POST);
    $email_check = $_POST['email_noti'];//for email notification
   //to check if every field in the form is filled
    $showError = '';
      if($fullName == ''||  $email == ''|| $contact_no == ''||  $password == '') $showError = $showError .'<p>Please fill out all the fields.</p>';
      if(empty($showError)){
        //inserting the value in customer table
      $stmt = $pdo->prepare("INSERT INTO tbl_customer(fullName,email,contact_no,password,email_notify)
    	 VALUES(:fullName, :email, :contact_no, :password,:email_check)");
      //this code transfer the information using http header to the specified value entered in database
      $criteria =[
       'fullName'=>$_POST['fullName'],
       'email'=>$_POST['email'],
       'contact_no'=>$_POST['contact_no'],
      'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),//sets the hash password
      'email_check' => $email_check
      ];
      if($stmt->execute($criteria))
         header('location:index.php?msg=User Registered Successfully');
    else
      echo 'No'; 
    }
    else{
      echo $showError;
    }
  }
?>
  <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="electronics.css" />
  </head>
<body>
  <main>
    <form method="POST" action="register.php">
      <!--form for registration-->
      <fieldset>
  	   <h3> Enter the information to register:</h3>
  	   <label>Enter Full Name: </label>
       <input type="text" name="fullName" required=""><br><br>
  	   <label>Enter email: </label>
       <input type="email" name="email" required=""><br><br>
  	   <label>Enter Contact No:</label>
       <input type="text" name="contact_no" required=""><br><br>
  	   <label>Enter password:</label>
       <input type="password" name="password" required=""><br><br>
       <label for = "Email">Wanna get notified through email:</label>  <input type="checkbox" value ="1" name="email_noti"
        style=" float: left; width: 10%;">
       <input type="submit" name="register" value="Register">
    </fieldset>
   </form>
  </main>
</body>