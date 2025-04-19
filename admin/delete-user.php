<?php 

    //Include constants.php file here
    include('../config/constants.php');

    // 1. Lấy ID của người dùng cần xóa
    $id = $_GET['id'];

    // 2. Tạo câu lệnh SQL để xóa người dùng
    $sql = "DELETE FROM tbl_users WHERE id=$id";

    // Thực thi truy vấn
    $res = mysqli_query($conn, $sql);

    // Kiểm tra xem truy vấn có được thực thi thành công hay không
    if($res == true)
    {
        // Xóa thành công
        $_SESSION['delete'] = "<div class='success'>Người dùng đã được xóa thành công.</div>";
        // Chuyển hướng về trang quản lý người dùng
        header('location:'.SITEURL.'admin/manage-user.php');
    }
    else
    {
        // Xóa thất bại
        $_SESSION['delete'] = "<div class='error'>Xóa người dùng thất bại. Vui lòng thử lại sau.</div>";
        // Chuyển hướng về trang quản lý người dùng
        header('location:'.SITEURL.'admin/manage-user.php');
    }

?>