<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper form-container">
        <h1>Thêm Tài Khoản Người Dùng</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Họ Và Tên: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Nhập tên của bạn" class="input-field" required>
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" placeholder="Nhập email của bạn" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td>Tên Đăng Nhập: </td>
                    <td>
                        <input type="text" name="username" placeholder="Tên đăng nhập của bạn" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td>Mật Khẩu: </td>
                    <td>
                        <input type="password" name="password" placeholder="Mật khẩu của bạn" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm Người Dùng" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    // Xử lý giá trị từ form và lưu vào cơ sở dữ liệu

    // Kiểm tra xem nút submit có được nhấn hay không
    if (isset($_POST['submit'])) {
        // Lấy dữ liệu từ form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); // Không mã hóa mật khẩu
        $email = mysqli_real_escape_string($conn, $_POST['email']); // Lấy email từ form

        // Câu lệnh SQL để lưu dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO tbl_users SET 
            full_name='$full_name',
            username='$username',
            password='$password',
            email='$email'"; // Thêm email vào câu lệnh SQL

        // Thực thi truy vấn
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Kiểm tra xem dữ liệu có được thêm thành công hay không
        if ($res == TRUE) {
            $_SESSION['add'] = "<div class='success'>Người dùng đã được thêm thành công.</div>";
            header("location:" . SITEURL . 'admin/manage-user.php');
        } else {
            $_SESSION['add'] = "<div class='error'>Thêm người dùng thất bại.</div>";
            header("location:" . SITEURL . 'admin/add-user.php');
        }
    }
?>