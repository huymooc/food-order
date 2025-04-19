<?php 
include('partials/menu.php'); 

// Kiểm tra xem ID có được truyền qua URL hay không
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin món ăn từ cơ sở dữ liệu
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);

    if($res2 == true) {
        $row2 = mysqli_fetch_assoc($res2);

        // Lấy dữ liệu món ăn
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        // Nếu không tìm thấy món ăn, chuyển hướng về trang quản lý món ăn
        $_SESSION['no-food-found'] = "<div class='error'>Food Not Found.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
        exit();
    }
} else {
    // Nếu không có ID, chuyển hướng về trang quản lý món ăn
    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper form-container">
        <h1 class="form-title">Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tên Món Ăn: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="input-field">
                    </td>
                </tr>

                <tr>
                    <td>Mô Tả: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" class="input-field"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Đơn Giá: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>" class="input-field">
                    </td>
                </tr>

                <tr>
                    <td>Hình Ảnh Cũ: </td>
                    <td>
                        <?php 
                        if($current_image != "") {
                            echo "<img src='".SITEURL."images/food/$current_image' width='150px'>";
                        } else {
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Hình Ảnh Mới: </td>
                    <td>
                        <input type="file" name="image" class="input-field">
                    </td>
                </tr>

                <tr>
                    <td>Danh Mục: </td>
                    <td>
                        <select name="category" class="input-field">
                            <?php 
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);

                            if($res == true) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    echo "<option value='$category_id' ".($current_category == $category_id ? "selected" : "").">$category_title</option>";
                                }
                            } else {
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nổi Bật: </td>
                    <td>
                        <input <?php if($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Hiển Thị: </td>
                    <td>
                        <input <?php if($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active == "No") echo "checked"; ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        if(isset($_POST['submit'])) {
            // Lấy dữ liệu từ form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Xử lý hình ảnh mới
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $temp = explode('.', $image_name);
                $ext = end($temp);
                $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;

                $src_path = $_FILES['image']['tmp_name'];
                $dest_path = "../images/food/".$image_name;

                $upload = move_uploaded_file($src_path, $dest_path);

                if($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    exit();
                }

                if($current_image != "") {
                    $remove_path = "../images/food/".$current_image;
                    if(file_exists($remove_path)) {
                        $remove = unlink($remove_path);

                        if($remove == false) {
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            exit();
                        }
                    }
                }
            } else {
                $image_name = $current_image;
            }

            // Cập nhật món ăn trong cơ sở dữ liệu
            $sql3 = "UPDATE tbl_food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id";

            $res3 = mysqli_query($conn, $sql3);

            if($res3 == true) {
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>