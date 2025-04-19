<?php 
include('config/constants.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';
?>

<html>
    <head>
        <title>Quên Mật Khẩu - Meowbee Food</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
    <div class="login-container">
        <div class="login">
            <h1 class="text-center">Quên Mật Khẩu</h1>
            <a href="login-user.php"><img src="images/meowbee.png" alt="Logo" class="login-logo"></a>
            <br><br>

            <?php 
                if(isset($_SESSION['reset-message'])) {
                    echo $_SESSION['reset-message'];
                    unset($_SESSION['reset-message']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
                Tên Đăng Nhập: <br>
                <input type="text" name="username" placeholder="Nhập tên đăng nhập" required><br><br>

                Email: <br>
                <input type="email" name="email" placeholder="Nhập email của bạn" required><br><br>

                <input type="submit" name="submit" value="Gửi mật khẩu mới" class="btn-primary">
                <br><br>
            </form>
        </div>
    </div>
    </body>
</html>

<?php 
if(isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Kiểm tra tên đăng nhập và email có tồn tại trong cơ sở dữ liệu không
    $sql = "SELECT * FROM tbl_users WHERE username='$username' AND email='$email'";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1) {
        // Tạo mật khẩu mới ngẫu nhiên
        $new_password = substr(md5(time()), 0, 8);
        $hashed_password = md5($new_password);

        // Cập nhật mật khẩu trong cơ sở dữ liệu
        $sql2 = "UPDATE tbl_users SET password='$hashed_password' WHERE username='$username' AND email='$email'";
        $res2 = mysqli_query($conn, $sql2);

        if($res2 == true) {
            // Gửi mật khẩu mới qua email bằng PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'anhhuy482003@gmail.com'; // Thay bằng email của bạn
                $mail->Password = 'ovzgxpbosdztrkoi'; // Thay bằng mật khẩu ứng dụng Gmail
                $mail->SMTPSecure = 'tls'; // Mã hóa TLS
                $mail->Port = 587; // Cổng SMTP

                // Cấu hình email
                $mail->setFrom('anhhuy482003@gmail.com', 'Meowbee Food');
                $mail->addAddress($email); // Email người nhận
                $mail->Subject = 'Reset Password - Meowbee Food Website';
                $mail->Body = "Mật khẩu mới của bạn là: $new_password\nVui lòng đổi mật khẩu sau khi đăng nhập.";

                // Gửi email
                $mail->send();
                $_SESSION['reset-message'] = "<div class='success'>Mật khẩu mới đã được gửi đến email của bạn.</div>";
            } catch (Exception $e) {
                $_SESSION['reset-message'] = "<div class='error'>Không thể gửi email. Lỗi: {$mail->ErrorInfo}</div>";
            }
        } else {
            $_SESSION['reset-message'] = "<div class='error'>Không thể đặt lại mật khẩu. Vui lòng thử lại.</div>";
        }
    } else {
        $_SESSION['reset-message'] = "<div class='error'>Tên đăng nhập hoặc email không đúng.</div>";
    }

    // Chuyển hướng về trang quên mật khẩu
    header('location:'.SITEURL.'quenmk-user.php');
}
?>