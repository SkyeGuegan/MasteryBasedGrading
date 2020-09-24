<?php SESSION_START();  //You're saving information with sessions
    if((isset($_SESSION['username']) )) {
        //allow user to see this page
    }
    else{
        header("location:login_page.php");//you're not authenticated BYE
    }
?>
