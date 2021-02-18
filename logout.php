<?php
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("location:login.php?response='Logged Out Successfully'&res_type=success"); //to redirect back to "index.php" after logging out
exit();
?>
