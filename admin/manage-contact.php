<!-- filepath: c:\xampp\htdocs\food-order\admin\manage-contact.php -->
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Quản Lý Đối Tác Liên Hệ</h1>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>Họ Tên</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Nội Dung</th>
                <th>Hành Động</th>
            </tr>

            <?php
                // Lấy dữ liệu từ bảng tbl_contact
                $sql = "SELECT * FROM tbl_contact";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $sdt = $row['sdt'];
                            $email = $row['email'];
                            $message = $row['message'];
                            ?>

                            <tr>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $sdt; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $message; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/delete-contact.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        // Không có dữ liệu
                        echo "<tr><td colspan='5' class='error'>Không có liên hệ nào được tìm thấy.</td></tr>";
                    }
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>