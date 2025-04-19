<?php include('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">LIÊN HỆ MEOWBEE</h1>
        <br><br>
        <div class="container">
            <form action="" method="POST" class="form">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tên *" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Số điện thoại *" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail *" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="message" name="message" placeholder="Tin nhắn *" required></textarea>
                    </div>
                </div>
                <div class="form-row text-center">
                    <button type="submit" class="btn btn-submit" name="submit">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if (isset($_POST['submit'])) 
    {
        // Lấy giá trị từ form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $message = $_POST['message'];

        // Tạo câu lệnh SQL để thêm dữ liệu vào bảng liên hệ
        $sql = "INSERT INTO tbl_contact SET
        name = '$name',
        email = '$email',
        sdt = '$sdt',
        message = '$message'
        ";

        // Thực thi câu lệnh SQL
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Kiểm tra kết quả
        if ($res == true) {
            // Hiển thị thông báo thành công
            echo "<div class='success text-center'>Tin nhắn của bạn đã được gửi thành công!</div>";
        } else {
            // Hiển thị thông báo lỗi
            echo "<div class='error text-center'>Đã xảy ra lỗi. Vui lòng thử lại sau.</div>";
        }
    }
?>

<?php include('partials-front/footer.php'); ?>