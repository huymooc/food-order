<?php include('partials-front/menu.php'); ?>

<?php 
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if(!isset($_SESSION['user'])) {
        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
        $_SESSION['no-login-message'] = "<div class='error text-center'>Vui lòng đăng nhập để đặt hàng.</div>";
        header('location:'.SITEURL.'login-user.php');
        exit();
    }

    // Kiểm tra xem food_id có được truyền qua URL hay không
    if(isset($_GET['food_id'])) {
        // Lấy ID món ăn và thông tin chi tiết món ăn đã chọn
        $food_id = $_GET['food_id'];

        // Lấy thông tin chi tiết món ăn từ cơ sở dữ liệu
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        // Kiểm tra xem dữ liệu có tồn tại hay không
        if($count == 1) {
            // Lấy dữ liệu từ cơ sở dữ liệu
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        } else {
            // Nếu món ăn không tồn tại, chuyển hướng về trang chủ
            header('location:'.SITEURL);
        }
    } else {
        // Nếu không có food_id, chuyển hướng về trang chủ
        header('location:'.SITEURL);
    }
?>

<!-- Phần thông tin thanh toán bắt đầu -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Thông Tin Thanh Toán</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Món ăn đã chọn</legend>

                <div class="food-menu-img">
                    <?php 
                        // Kiểm tra xem hình ảnh có tồn tại hay không
                        if($image_name == "") {
                            // Nếu không có hình ảnh
                            echo "<div class='error'>Hình ảnh không khả dụng.</div>";
                        } else {
                            // Nếu có hình ảnh
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo mb_strtoupper($title, 'UTF-8'); ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price"><?php echo number_format($price, 0, ',', '.'); ?> đ</p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Số lượng</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Chi tiết giao hàng</legend>
                <div class="order-label">Họ và Tên</div>
                <input type="text" name="full-name" placeholder="VD: Nguyễn Văn A" class="input-responsive" required>

                <div class="order-label">Số Điện Thoại</div>
                <input type="tel" name="contact" placeholder="VD: 0832389112" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="VD: abcxyz@gmail.com" class="input-responsive" required>

                <div class="order-label">Địa Chỉ</div>
                <textarea name="address" rows="10" placeholder="VD: Phố Tân Mai, Hà Nội" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Xác nhận đặt hàng" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
            // Kiểm tra xem nút "Xác nhận đặt hàng" có được nhấn hay không
            if(isset($_POST['submit'])) {
                // Lấy tất cả thông tin từ form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; // Tổng tiền = giá x số lượng
                $status = "Đã Đặt"; // Trạng thái: Đã Đặt, Đang Giao, Đã Giao, Đã Hủy
                $username = $_SESSION['user']; // Lưu tên đăng nhập
                $customer_name = $_POST['full-name']; // Lưu tên khách hàng thật
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // Lưu thông tin đặt hàng vào cơ sở dữ liệu
                $sql2 = "INSERT INTO tbl_order SET 
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    username = '$username',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'";

                // Thực thi truy vấn
                $res2 = mysqli_query($conn, $sql2);

                // Kiểm tra xem truy vấn có thành công hay không
                if($res2 == true) {
                    // Đặt hàng thành công
                    $_SESSION['order'] = "<div class='success text-center'>Đặt hàng thành công.</div>";
                    header('location:'.SITEURL);
                } else {
                    // Đặt hàng thất bại
                    $_SESSION['order'] = "<div class='error text-center'>Đặt hàng thất bại.</div>";
                    header('location:'.SITEURL);
                }
            }
        ?>
    </div>
</section>
<!-- Phần thông tin thanh toán kết thúc -->

<?php include('partials-front/footer.php'); ?>
<!-- require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/SMTP.php'; -->