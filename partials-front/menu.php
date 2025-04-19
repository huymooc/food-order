<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meowbee Food</title>
    <link rel="icon" href="<?php echo SITEURL; ?>images/meowbee.png" type="image/gif" sizes="16x16">
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/meowbee.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>  

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">TRANG CHỦ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">DANH MỤC</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">MENU MÓN</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">LIÊN HỆ</a>
                    </li>

                    <?php 
                    if(isset($_SESSION['user'])) {
                        // Hiển thị dropdown menu cho người dùng đã đăng nhập
                        echo '<li class="user-dropdown">';
                        echo '<span class="username">' . $_SESSION['user'] . '</span>';
                        echo '<div class="user-dropdown-content">';
                        echo '<a href="' . SITEURL . 'my-orders.php">Đơn hàng</a>';
                        echo '<a href="' . SITEURL . 'logout-user.php">Đăng xuất</a>';
                        echo '</div>';
                        echo '</li>';
                    } else {
                        // Hiển thị liên kết đăng nhập cho người dùng chưa đăng nhập
                        echo '<li><a href="' . SITEURL . 'login-user.php">ĐĂNG NHẬP</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->