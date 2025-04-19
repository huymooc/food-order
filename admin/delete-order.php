<?php
    // Include constants.php for SITEURL
    include('../config/constants.php');

    // Check whether the ID is set or not
    if (isset($_GET['id'])) {
        // Get the ID of the order to be deleted
        $id = $_GET['id'];

        // Create SQL Query to delete the order
        $sql = "DELETE FROM tbl_order WHERE id=$id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully
        if ($res == true) {
            // Order deleted successfully
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
        } else {
            // Failed to delete order
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Order. Try Again Later.</div>";
        }

        // Redirect to manage-order.php
        header('location:' . SITEURL . 'admin/manage-order.php');
    } else {
        // Redirect to manage-order.php if ID is not set
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:' . SITEURL . 'admin/manage-order.php');
    }
?>