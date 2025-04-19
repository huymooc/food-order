<?php 

    //Authorization - Access Control
    //Check whether the admin is logged in or not
    if(!isset($_SESSION['admin'])) //If admin session is not set
    {
        //Admin is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        //Redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }

?>