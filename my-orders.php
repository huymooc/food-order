<?php include('partials-front/menu.php'); ?>

<?php
    // Check if user is logged in
    if(!isset($_SESSION['user'])) {
        $_SESSION['no-login-message'] = "<div class='notification error'>Vui lòng đăng nhập để xem đơn hàng.</div>";
        header('location:'.SITEURL.'login.php');
        exit();
    }

    // Get username from session
    $username = $_SESSION['user'];

    // Handle order confirmation
    if(isset($_POST['confirm_order'])) {
        $id = $_POST['id'];
        
        // Check if order exists and belongs to user
        $check_sql = "SELECT * FROM tbl_order WHERE id=$id AND username='$username' AND status='Đã Giao'";
        $check_res = mysqli_query($conn, $check_sql);
        
        if($check_res && mysqli_num_rows($check_res) > 0) {
            // Thêm đơn hàng đã xác nhận vào session
            if(!isset($_SESSION['confirmed_orders'])) {
                $_SESSION['confirmed_orders'] = array();
            }
            $_SESSION['confirmed_orders'][] = $id;
            
            $_SESSION['order'] = "<div class='notification success'>Xác nhận đơn hàng thành công.</div>";
        } else {
            $_SESSION['order'] = "<div class='notification error'>Không thể xác nhận đơn hàng này.</div>";
        }
        header('location:'.SITEURL.'my-orders.php');
        exit();
    }

    // Handle order cancellation
    if(isset($_POST['cancel_order'])) {
        $id = $_POST['id'];
        
        // Check if order exists and belongs to user
        $check_sql = "SELECT * FROM tbl_order WHERE id=$id AND username='$username' AND status='Đã Đặt'";
        $check_res = mysqli_query($conn, $check_sql);
        
        if($check_res && mysqli_num_rows($check_res) > 0) {
            $sql = "UPDATE tbl_order SET status='Đã Hủy' WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            
            if($res) {
                $_SESSION['order'] = "<div class='notification success'>Hủy đơn hàng thành công.</div>";
            } else {
                $_SESSION['order'] = "<div class='notification error'>Không thể hủy đơn hàng. Lỗi: " . mysqli_error($conn) . "</div>";
            }
        } else {
            $_SESSION['order'] = "<div class='notification error'>Không thể hủy đơn hàng này.</div>";
        }
        header('location:'.SITEURL.'my-orders.php');
        exit();
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h2 class="text-center">Đơn hàng của tôi</h2>
        <br>

        <?php 
            if(isset($_SESSION['order'])) {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>Món ăn</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Họ và Tên</th>
                <th>Sđt</th>
                <th>Địa chỉ</th>
                <th>Thao tác</th>
            </tr>

            <?php
                // Debug information
                echo "<!-- Debug: username = " . $username . " -->";
                
                // Lấy danh sách đơn hàng chưa được xác nhận
                $sql = "SELECT * FROM tbl_order WHERE username='$username'";
                if(isset($_SESSION['confirmed_orders']) && !empty($_SESSION['confirmed_orders'])) {
                    $confirmed_ids = implode(',', array_map('intval', $_SESSION['confirmed_orders']));
                    $sql .= " AND id NOT IN ($confirmed_ids)";
                }
                $sql .= " ORDER BY id DESC";
                
                echo "<!-- Debug: SQL Query = " . $sql . " -->";
                
                $res = mysqli_query($conn, $sql);
                
                if(!$res) {
                    echo "<!-- Debug: MySQL Error = " . mysqli_error($conn) . " -->";
                    echo "<tr><td colspan='9'><div class='notification error'>Không thể tải danh sách đơn hàng. Lỗi: " . mysqli_error($conn) . "</div></td></tr>";
                } else {
                    $count = mysqli_num_rows($res);
                    echo "<!-- Debug: Number of rows = " . $count . " -->";

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            // Kiểm tra nếu đơn hàng đã được xác nhận thì bỏ qua
                            if(isset($_SESSION['confirmed_orders']) && in_array($row['id'], $_SESSION['confirmed_orders'])) {
                                continue;
                            }
                            
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_address = $row['customer_address'];
                            ?>
                            <tr id="order_<?php echo $id; ?>">
                                <td><?php echo $food; ?></td>
                                <td><?php echo number_format($price, 0, ',', '.'); ?>đ</td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo number_format($total, 0, ',', '.'); ?>đ</td>
                                <td>
                                    <?php 
                                        $status_class = '';
                                        switch($status) {
                                            case 'Đã Đặt':
                                                $status_class = 'order-placed';
                                                break;
                                            case 'Đang Giao':
                                                $status_class = 'order-delivering';
                                                break;
                                            case 'Đã Giao':
                                                $status_class = 'order-delivered';
                                                break;
                                            case 'Đã Hủy':
                                                $status_class = 'order-cancelled';
                                                break;
                                        }
                                    ?>
                                    <span class="status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <form method="POST" onsubmit="return confirmCancel();" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button type="submit" name="cancel_order" class="btn-cancel <?php echo ($status != 'Đã Đặt') ? 'disabled' : ''; ?>" <?php echo ($status != 'Đã Đặt') ? 'disabled' : ''; ?>>
                                            Hủy đơn
                                        </button>
                                    </form>
                                    <form method="POST" onsubmit="return confirmReceived();" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button type="submit" name="confirm_order" class="btn-confirm <?php echo ($status != 'Đã Giao') ? 'disabled' : ''; ?>" <?php echo ($status != 'Đã Giao') ? 'disabled' : ''; ?>>
                                            Đã nhận
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'><div class='notification info'>Bạn chưa có đơn hàng nào. <a href='".SITEURL."categories.php'>Đặt hàng ngay</a></div></td></tr>";
                    }
                }
            ?>
        </table>
    </div>
</div>

<script>
function confirmCancel() {
    return confirm("Bạn có chắc chắn muốn hủy đơn hàng này không?");
}

function confirmReceived() {
    return confirm("Xác nhận đã nhận được đơn hàng?");
}
</script>

<?php include('partials-front/footer.php'); ?>