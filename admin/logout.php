<?php 
    //Include constants.php for SITEURL
    include('../config/constants.php');

    //1. Unset Admin Session
    unset($_SESSION['admin']); //Only remove admin session
    unset($_SESSION['login']); //Remove login message if any

    //2. Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');

?>