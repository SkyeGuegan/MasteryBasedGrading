<?php
SESSION_START();
$_SESSION = array(); //Set that session to a new empty array
session_destroy();	//Clean up that session.
//Do a little more to clean up session, cookies etc.? 
header("location:login_page.php");
?>