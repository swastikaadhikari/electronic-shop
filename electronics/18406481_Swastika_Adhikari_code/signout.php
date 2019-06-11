<?php
session_start();//start the session
session_unset();//unset the sesion
session_destroy();//destroy the session
header('Location: signin.php')//sends the file to sign in page
?>