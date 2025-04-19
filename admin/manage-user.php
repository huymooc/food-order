<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Quản Lý Tài Khoản Người Dùng</h1>

        <br />

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // Hiển thị thông báo thêm tài khoản
                unset($_SESSION['add']); // Xóa thông báo
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete']; // Hiển thị thông báo xóa tài khoản
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update']; // Hiển thị thông báo cập nhật tài khoản
                unset($_SESSION['update']);
            }
        ?>
        <br><br><br>

        <!-- Nút thêm tài khoản người dùng -->
        <a href="add-user.php" class="btn-primary">Thêm Tài Khoản Người Dùng</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Họ Và Tên</th>
                <th>Tên Đăng Nhập</th>
                <th>Email</th>
                <th>Thao Tác</th>
            </tr>

            <?php 
                // Truy vấn để lấy tất cả tài khoản người dùng
                $sql = "SELECT * FROM tbl_users";
                // Thực thi truy vấn
                $res = mysqli_query($conn, $sql);

                // Kiểm tra xem truy vấn có được thực thi hay không
                if($res == TRUE)
                {
                    // Đếm số hàng để kiểm tra xem có dữ liệu trong cơ sở dữ liệu hay không
                    $count = mysqli_num_rows($res);

                    $sn = 1; // Tạo biến số thứ tự

                    // Kiểm tra số lượng hàng
                    if($count > 0)
                    {
                        // Có dữ liệu trong cơ sở dữ liệu
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            // Lấy dữ liệu từng dòng
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $email = $rows['email'];

                            // Hiển thị dữ liệu trong bảng
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-user.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        // Không có dữ liệu trong cơ sở dữ liệu
                        echo "<tr><td colspan='5' class='error'>Không có tài khoản người dùng nào.</td></tr>";
                    }
                }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>