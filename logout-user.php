<?php 
include('config/constants.php');

// Chỉ xóa session của user
unset($_SESSION['user']);

// Chuyển hướng về trang chủ
header('location:'.SITEURL.'index.php');
?>