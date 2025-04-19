<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper form-container">
        <h1 class="form-title">Cập Nhật Tài Khoản Người Dùng</h1>

        <br><br>

        <?php 
            // 1. Lấy ID của người dùng được chọn
            $id = $_GET['id'];

            // 2. Tạo truy vấn SQL để lấy thông tin chi tiết
            $sql = "SELECT * FROM tbl_users WHERE id=$id";

            // Thực thi truy vấn
            $res = mysqli_query($conn, $sql);

            // Kiểm tra xem truy vấn có được thực thi hay không
            if($res == true) {
                // Kiểm tra xem dữ liệu có tồn tại hay không
                $count = mysqli_num_rows($res);
                if($count == 1) {
                    // Lấy thông tin chi tiết người dùng
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $password = $row['password']; // Lấy mật khẩu hiện tại (không mã hóa)
                } else {
                    // Nếu không tìm thấy người dùng, chuyển hướng về trang quản lý người dùng
                    header('location:'.SITEURL.'admin/manage-user.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Họ Và Tên: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" class="input-field" required>
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email; ?>" class="input-field" required>
                    </td>
                </tr>
                <tr>
                    <td>Tên Đăng Nhập: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="input-field" required>
                    </td>
                </tr>
                <tr>
                    <td>Mật Khẩu:</td>
                    <td>
                        <input type="text" name="password" value="<?php echo $password; ?>" class="input-field">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Cập Nhật Người Dùng" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    // Kiểm tra xem nút Submit có được nhấn hay không
    if(isset($_POST['submit'])) {
        // Lấy tất cả các giá trị từ form để cập nhật
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; // Lấy mật khẩu từ form (không mã hóa)

        // Tạo truy vấn SQL để cập nhật người dùng
        $sql = "UPDATE tbl_users SET
            full_name = '$full_name',
            username = '$username',
            email = '$email',
            password = '$password'
            WHERE id='$id'";

        // Thực thi truy vấn
        $res = mysqli_query($conn, $sql);

        // Kiểm tra xem truy vấn có thành công hay không
        if($res == true) {
            // Cập nhật thành công
            $_SESSION['update'] = "<div class='success'>Người dùng đã được cập nhật thành công.</div>";
            header('location:'.SITEURL.'admin/manage-user.php');
        } else {
            // Cập nhật thất bại
            $_SESSION['update'] = "<div class='error'>Cập nhật người dùng thất bại.</div>";
            header('location:'.SITEURL.'admin/manage-user.php');
        }
    }

?>
<?php include('partials/footer.php'); ?>