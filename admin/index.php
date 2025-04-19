<!-- filepath: c:\xampp\htdocs\food-order\admin\index.php -->
<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Bảng điều khiển</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <a href="manage-category.php" class="dashboard-box">
                    <div class="col-4 text-center">
                        <?php 
                            $sql = "SELECT * FROM tbl_category";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <br />
                        Danh Mục Món Ăn
                    </div>
                </a>

                <a href="manage-food.php" class="dashboard-box">
                    <div class="col-4 text-center">
                        <?php 
                            $sql2 = "SELECT * FROM tbl_food";
                            $res2 = mysqli_query($conn, $sql2);
                            $count2 = mysqli_num_rows($res2);
                        ?>
                        <h1><?php echo $count2; ?></h1>
                        <br />
                        Món Ăn
                    </div>
                </a>

                <a href="manage-order.php" class="dashboard-box">
                    <div class="col-4 text-center">
                        <?php 
                            $sql3 = "SELECT * FROM tbl_order";
                            $res3 = mysqli_query($conn, $sql3);
                            $count3 = mysqli_num_rows($res3);
                        ?>
                        <h1><?php echo $count3; ?></h1>
                        <br />
                        Tổng Đơn Hàng
                    </div>
                </a>

                <a href="manage-order.php" class="dashboard-box">
                    <div class="col-4 text-center">
                        <?php 
                            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Đã Giao'";
                            $res4 = mysqli_query($conn, $sql4);
                            $row4 = mysqli_fetch_assoc($res4);
                            $total_revenue = $row4['Total'];
                        ?>
                        <h1><?php echo number_format($total_revenue, 0, ',', '.'); ?> đ</h1>
                        <br />
                        Doanh Thu
                    </div>
                </a>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>