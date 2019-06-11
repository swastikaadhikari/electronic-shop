<?php
  session_start();//starts the session
  if (!isset($_SESSION['sessUId'])) {//checks the id and send to the specified location if the requiremnet isnot fulfilled
       header('Location:login.php');
   }
  include'databaselink.php';
  include 'form_header.php';
  include 'footer.php';
?>
<!--link of different php file in admin index page-->
<body class="adminPage">
  <nav>
    <ul id="adminSection">
      <li><a href="./manageuser.php"><h2>Manage Admin</h2></a></li>
      <li><a href="./managecate.php"><h2>Manage Category<h2></a></li>
      <li><a href="./manageproduct.php"><h2>Manage Product<h2></a></li>
      <li><a href="./manageregisteruser.php"><h2>Manage User <h2></a></li>  
      <li><a href="./approveReview.php"><h2>Approve Reviews<h2></a></li>
      <li><a href="./review_user.php"><h2>User</h2> </a></li>
      <li><a href="./shippingDetail.php"><h2>Shipping</h2>
      </a>
    </ul>
  </nav>

<main>
  <h1 id="welcome">Hello,Swastika</h1> 
</main>

</body>