<!--This page is to sign out the logged in admin-->
<?php
session_start();//it starts the session
session_unset();//it unset the started session
session_destroy();//it destroy the session
header('Location: login.php');
?>