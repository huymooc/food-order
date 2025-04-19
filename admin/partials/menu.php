<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <title>Meowbee Food - Home Page</title>
        <link rel="icon" href="../images/meowbee.png" type="image/gif" sizes="16x16">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                <ul>
                    <li>
                        <a href="index.php">
                            <img src="../images/meowbee.png" alt="Meowbee Logo" class="menu-logo">
                        </a>
                    </li>
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="manage-user.php">Admin</a></li>
                    <li><a href="manage-category.php">Danh Mục</a></li>
                    <li><a href="manage-food.php">Món Ăn</a></li>
                    <li><a href="manage-order.php">Đơn Hàng</a></li>    
                    <li><a href="manage-contact.php">Liên Hệ</a></li>
                    <li><a href="logout.php">Đăng Xuất</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->