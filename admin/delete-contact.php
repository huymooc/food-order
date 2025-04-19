<!-- filepath: c:\xampp\htdocs\food-order\admin\delete-contact.php -->
<?php
    // Include constants.php để lấy thông tin kết nối cơ sở dữ liệu
    include('../config/constants.php');

    // Kiểm tra xem ID có được truyền qua URL hay không
    if (isset($_GET['id'])) {
        // Lấy ID từ URL
        $id = $_GET['id'];

        // Tạo câu lệnh SQL để xóa liên hệ
        $sql = "DELETE FROM tbl_contact WHERE id=$id";

        // Thực thi câu lệnh SQL
        $res = mysqli_query($conn, $sql);

        // Kiểm tra xem câu lệnh có thực thi thành công hay không
        if ($res == true) {
            // Xóa thành công
            $_SESSION['delete'] = "<div class='success'>Contact Deleted Successfully.</div>";
        } else {
            // Xóa thất bại
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Contact. Try Again Later.</div>";
        }

        // Chuyển hướng về trang quản lý liên hệ
        header('location:' . SITEURL . 'admin/manage-contact.php');
    } else {
        // Nếu không có ID, chuyển hướng về trang quản lý liên hệ
        $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:' . SITEURL . 'admin/manage-contact.php');
    }
?>