<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper form-container">
        <h1 class="form-title">Đổi Mật Khẩu</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST" class="form-style">
            <div class="form-group">
                <label for="current_password">Mật Khẩu Cũ:</label>
                <input type="password" name="current_password" id="current_password" placeholder="Nhập mật khẩu cũ" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="new_password">Mật Khẩu Mới:</label>
                <input type="password" name="new_password" id="new_password" placeholder="Nhập mật khẩu mới" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Xác Nhận Mật Khẩu:</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Xác nhận mật khẩu mới" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Đổi Mật Khẩu" class="btn-primary">
            </div>
        </form>

    </div>
</div>

<?php 

// Kiểm tra xem nút Submit có được nhấn hay không
if(isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $current_password = $_POST['current_password']; // Không mã hóa
    $new_password = $_POST['new_password']; // Không mã hóa
    $confirm_password = $_POST['confirm_password']; // Không mã hóa

    // Kiểm tra xem người dùng với ID và mật khẩu hiện tại có tồn tại không
    $sql = "SELECT * FROM tbl_users WHERE id=$id AND password='$current_password'";

    // Thực thi truy vấn
    $res = mysqli_query($conn, $sql);

    if($res == true) {
        // Kiểm tra xem dữ liệu có tồn tại hay không
        $count = mysqli_num_rows($res);

        if($count == 1) {
            // Người dùng tồn tại và có thể thay đổi mật khẩu

            // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu có khớp không
            if($new_password == $confirm_password) {
                // Cập nhật mật khẩu
                $sql2 = "UPDATE tbl_users SET 
                    password='$new_password' 
                    WHERE id=$id";

                // Thực thi truy vấn
                $res2 = mysqli_query($conn, $sql2);

                // Kiểm tra xem truy vấn có thành công hay không
                if($res2 == true) {
                    // Hiển thị thông báo thành công
                    $_SESSION['change-pwd'] = "<div class='success'>Đổi mật khẩu thành công.</div>";
                    // Chuyển hướng người dùng
                    header('location:'.SITEURL.'admin/manage-user.php');
                } else {
                    // Hiển thị thông báo lỗi
                    $_SESSION['change-pwd'] = "<div class='error'>Đổi mật khẩu thất bại.</div>";
                    // Chuyển hướng người dùng
                    header('location:'.SITEURL.'admin/manage-user.php');
                }
            } else {
                // Mật khẩu mới và xác nhận mật khẩu không khớp
                $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu mới và xác nhận mật khẩu không khớp.</div>";
                header('location:'.SITEURL.'admin/manage-user.php');
            }
        } else {
            // Người dùng không tồn tại
            $_SESSION['user-not-found'] = "<div class='error'>Không tìm thấy người dùng.</div>";
            header('location:'.SITEURL.'admin/manage-user.php');
        }
    }
}

?>

<?php include('partials/footer.php'); ?>