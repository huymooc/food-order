<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Register - Meowbee Food Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <div class="login-container">
        <div class="login">
            <h1 class="text-center">Đăng Ký</h1>
            <img src="../images/meowbee.png" alt="Logo" class="login-logo">
            <br><br>

            <?php 
                if(isset($_SESSION['register']))
                {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center" autocomplete="off">
                Họ Và Tên: <br>
                <input type="text" name="full_name" placeholder="Nhập họ và tên" required><br><br>

                Tên Đăng Nhập: <br>
                <input type="text" name="username" placeholder="Nhập tên đăng nhập" required><br><br>

                Email: <br>
                <input type="email" name="email" placeholder="Nhập email" required><br><br>

                Mật Khẩu: <br>
                <input type="password" name="password" placeholder="Nhập mật khẩu" required><br><br>

                <input type="submit" name="submit" value="Đăng Ký" class="btn-primary">
                <br><br>
            </form>
        </div>
    </div>
    </body>
</html>

<?php 
if(isset($_POST['submit']))
{
    // Lấy dữ liệu từ form
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // Không mã hóa mật khẩu

    // Kiểm tra xem tất cả các trường đã được nhập hay chưa
    if(empty($full_name) || empty($username) || empty($email) || empty($password)) {
        $_SESSION['register'] = "<div class='error'>Vui lòng nhập đầy đủ thông tin.</div>";
        header('location:'.SITEURL.'admin/dangki-admin.php');
        exit();
    }

    // Kiểm tra xem tên đăng nhập hoặc email đã tồn tại chưa
    $check_sql = "SELECT * FROM tbl_admin WHERE username='$username' OR email='$email'";
    $check_res = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_res) > 0) {
        $_SESSION['register'] = "<div class='error'>Tên đăng nhập hoặc email đã tồn tại.</div>";
        header('location:'.SITEURL.'admin/dangki-admin.php');
    } else {
        // Thêm tài khoản admin vào cơ sở dữ liệu
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            email='$email',
            password='$password'"; // Lưu mật khẩu không mã hóa

        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $_SESSION['register'] = "<div class='success'>Đăng ký thành công. Bạn có thể đăng nhập.</div>";
            header('location:'.SITEURL.'admin/login.php');
        } else {
            $_SESSION['register'] = "<div class='error'>Đăng ký thất bại. Vui lòng thử lại.</div>";
            header('location:'.SITEURL.'admin/dangki-admin.php');
        }
    }
}
?>