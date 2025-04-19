<?php 
include('config/constants.php');

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Không mã hóa mật khẩu

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $row['username']; // Đổi từ 'username' thành 'user' để đồng bộ với các file khác
        header('location: index.php'); // Chuyển hướng về trang chủ
    } else {
        $_SESSION['login'] = "<div class='error'>Tên đăng nhập hoặc mật khẩu không đúng.</div>";
    }
}
?>

<html>
<head>
    <title>Đăng Nhập Người Dùng</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login">
            <h1 class="text-center">Đăng Nhập</h1>
            <a href="index.php"><img src="images/meowbee.png" alt="Logo" class="login-logo"></a>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
                Tên Đăng Nhập: <br>
                <input type="text" name="username" placeholder="Nhập tên đăng nhập" required><br><br>

                Mật Khẩu: <br>
                <input type="password" name="password" placeholder="Nhập mật khẩu" required><br><br>

                <p class="text-right">
                    <a href="quenmk-user.php" style="color: #ff4081;">Quên mật khẩu?</a>
                </p>

                <input type="submit" name="submit" value="Đăng Nhập" class="btn-primary">
                <br><br>
            </form>

            <p class="text-center">
                Nếu bạn chưa có tài khoản, <a href="dangki-user.php" style="color: #ff4081;">đăng ký</a> tại đây.
            </p>
        </div>
    </div>
</body>
</html>