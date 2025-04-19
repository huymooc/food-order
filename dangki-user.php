<?php 
include('config/constants.php');

if(isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Không mã hóa mật khẩu

    // Kiểm tra xem username hoặc email đã tồn tại chưa
    $check_user = "SELECT * FROM tbl_users WHERE username='$username' OR email='$email'";
    $res = mysqli_query($conn, $check_user);

    if(mysqli_num_rows($res) > 0) {
        $_SESSION['register'] = "<div class='error'>Tên đăng nhập hoặc email đã tồn tại.</div>";
    } else {
        // Thêm người dùng mới
        $sql = "INSERT INTO tbl_users (full_name, username, email, password) VALUES ('$full_name', '$username', '$email', '$password')";
        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $_SESSION['register'] = "<div class='success'>Đăng ký thành công. Vui lòng đăng nhập.</div>";
            header('location: login-user.php');
        } else {
            $_SESSION['register'] = "<div class='error'>Đăng ký thất bại. Vui lòng thử lại.</div>";
        }
    }
}
?>

<html>
<head>
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login">
            <h1 class="text-center">Đăng Ký</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['register'])) {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
                Họ và Tên: <br>
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