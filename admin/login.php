<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Meowbee Food Admin</title>
        <link rel="icon" href="../images/meowbee.png" type="image/gif" sizes="16x16">
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <div class="login-container">
        <div class="login">
            <h1 class="text-center">Đăng nhập</h1>
            <img src="../images/meowbee.png" alt="Logo" class="login-logo">
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                if(isset($_SESSION['register']))
                {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }

            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center" autocomplete="off">
                Tên Đăng Nhập: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Mật Khẩu: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <p class="text-right">
                    <a href="forgot-password.php">Quên mật khẩu?</a>
                </p>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <p class="text-center">
                Nếu bạn chưa có tài khoản, <a href="dangki-admin.php">đăng ký </a> tại đây.
            </p>
            <!-- Login Form Ends Here -->

            <p class="text-center">Created By - <a href="https://www.facebook.com/anhhuy.le.71465/">Le Anh Huy</a></p>
        </div>
    </div>
</body>
</html>

<?php 

    // Kiểm tra xem nút Submit có được nhấn hay không
    if(isset($_POST['submit']))
    {
        // Xử lý đăng nhập
        // 1. Lấy dữ liệu từ form đăng nhập
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); // Không mã hóa mật khẩu

        // 2. SQL để kiểm tra xem người dùng với username và password có tồn tại không
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Thực thi truy vấn
        $res = mysqli_query($conn, $sql);

        // 4. Đếm số hàng để kiểm tra xem người dùng có tồn tại không
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // Người dùng tồn tại và đăng nhập thành công
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['admin'] = $username; // Đổi từ 'user' thành 'admin' để tách biệt với session của user

            // Chuyển hướng đến trang chủ/Dashboard
            header('location:'.SITEURL.'admin/index.php');
        }
        else
        {
            // Người dùng không tồn tại và đăng nhập thất bại
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            // Chuyển hướng về trang đăng nhập
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>