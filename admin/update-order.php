<!-- filepath: c:\xampp\htdocs\food-order\admin\update-order.php -->
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper form-container">
        <h1 class="form-title">Update Order</h1>
        <br><br>

        <?php 
            // Kiểm tra xem ID có được truyền hay không
            if(isset($_GET['id']))
            {
                // Lấy chi tiết đơn hàng
                $id = $_GET['id'];

                // Truy vấn SQL để lấy thông tin đơn hàng
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    // Lấy dữ liệu đơn hàng
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    // Nếu không tìm thấy đơn hàng, chuyển hướng về trang quản lý đơn hàng
                    $_SESSION['no-order-found'] = "<div class='error'>Order Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                // Nếu không có ID, chuyển hướng về trang quản lý đơn hàng
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Tên Món Ăn:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Đơn Giá:</td>
                    <td><b><?php echo number_format($price, 0, ',', '.'); ?> đ</b></td>
                </tr>

                <tr>
                    <td>Số Lượng:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td>Trạng Thái:</td>
                    <td>
                        <select name="status" class="input-field">
                            <option <?php if($status == "Đã Đặt"){echo "selected";} ?> value="Đã Đặt">Đã Đặt</option>
                            <option <?php if($status == "Đang Giao"){echo "selected";} ?> value="Đang Giao">Đang Giao</option>
                            <option <?php if($status == "Đã Giao"){echo "selected";} ?> value="Đã Giao">Đã Giao</option>
                            <option <?php if($status == "Đã Hủy"){echo "selected";} ?> value="Đã Hủy">Đã Hủy</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Họ Và Tên:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td>Số Điện Thoại:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>" class="input-field" required>
                    </td>
                </tr>

                <tr>
                    <td>Địa Chỉ:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5" class="input-field" required><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                // Lấy dữ liệu từ form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                // Cập nhật dữ liệu
                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    // Cập nhật thành công
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    // Cập nhật thất bại
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>